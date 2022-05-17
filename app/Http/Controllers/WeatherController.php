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
    protected $seconds = 3600;

    public function __construct(GetWeather $getWeather)
    {
        $this->getWeather = $getWeather;
    }

    /**
    * @return JsonResponse
    */
    public function getWeather(Request $request): JsonResponse
    {
        if( Cache::get('weather') && 
            Cache::get('weather')->latitude === $request->latitude &&
            Cache::get('weather')->longitude === $request->longitude )
        {
            $data = Cache::get('weather');
            $result = $data->temp;
        } else {
            Cache::pull('weather');
            $expires_at = Carbon::now()->addHour(1)->format('H:i:s'); 
            $data = new stdClass;
            $data->latitude = $request->latitude;
            $data->longitude = $request->longitude;
            $result = $this->getWeather->getResult($data);
            $temp = Weather::firstOrNew([
                'country_id' => $request->country_id,
                'state_id'   => $request->state_id ?? null,
                'city_id'    => $request->city_id ?? null,
                'latitude'   => $request->latitude,
                'longitude'  => $request->longitude,
                'temp'       => $result,
                'expires_at' => $expires_at
            ]);
            $temp->save;
            Cache::add('weather', $temp, $this->seconds);
        }
        return response()->json($result);
    }
}
