<?php

namespace App\Http\Controllers\API;

use App\DesignPattern\GetWeather;
use App\Http\Controllers\Controller;
use App\Models\Weather;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
     * Get temp for location.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function show(Request $request): JsonResponse
    {
        $result = [];
        return response()->json($result);
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
            $result = Cache::get('weather_temp');
        }
        elseif($weather = Weather::where('latitude', $request->latitude)->where('longitude', $request->longitude)->first())
        {
            $result = $weather->temp;
        }
        else
        {
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
            Cache::put('weather_temp', $temp->temp, $this->expiresAt);
            Cache::put('weather_latitude', $temp->latitude, $this->expiresAt);
            Cache::put('weather_longitude', $temp->longitude, $this->expiresAt);
        }
        return response()->json($result);
    }
}
