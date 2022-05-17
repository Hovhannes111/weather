<?php

namespace App\Http\Controllers;

use App\DesignPattern\GetWeather;
use App\Models\Weather;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use stdClass;

class WeatherController extends Controller
{
    /**
     * @var GetWeather
    */
    protected $getWeather;
    protected $expiresAt = 3600;

    public function __construct(GetWeather $getWeather)
    {
        $this->getWeather = $getWeather;
    }

    /**
    * @return JsonResponse
    */
    public function getWeather(Request $request): JsonResponse
    {
        if( Cache::get('weather_latitude') && 
            Cache::get('weather_longitude') && 
            Cache::get('weather_latitude') == $request->latitude &&
            Cache::get('weather_longitude') == $request->longitude)
        {
            $weather_latitude = Cache::get('weather_latitude');
            $weather_longitude = Cache::get('weather_longitude');
            $data = Weather::where('latitude', $weather_latitude)->where('longitude', $weather_longitude)->first();
            $result = $data->temp;
        } else {
            if($weather = Weather::where('latitude', $request->latitude)->where('longitude', $request->longitude)->first()) {
                return response()->json($weather->temp);
            }
            $expires_at = Carbon::now()->addHour(1)->format('Y-m-d H:i:s');
            $data = new stdClass;
            $data->latitude = $request->latitude;
            $data->longitude = $request->longitude;
            $result = $this->getWeather->getResult($data);
            $temp = Weather::updateOrCreate([
                'country_id' => $request->country_id,
                'state_id'   => $request->state_id ?? null,
                'city_id'    => $request->city_id ?? null,
                'latitude'   => $request->latitude,
                'longitude'  => $request->longitude,
                'temp'       => $result,
                'expires_at' => $expires_at
            ]);
            $temp->save;
            Cache::put('weather_latitude', $temp->latitude, $this->expiresAt);
            Cache::put('weather_longitude', $temp->longitude, $this->expiresAt);
        }
        return response()->json($result);
    }
}
