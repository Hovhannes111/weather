<?php

namespace App\Http\Controllers;

use App\DesignPattern\Weather;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use stdClass;

class WeatherController extends Controller
{
    /**
     * @var Weather
    */
    protected $weather;

    public function __construct(Weather $weather)
    {
        $this->weather = $weather;
    }

    /**
    * @return JsonResponse
    */
    public function getWeather(Request $request): JsonResponse
    {
        $data = new stdClass;
        $data->latitude = $request->latitude;
        $data->longitude = $request->longitude;
        $res = $this->weather->getResult($data);
        return response()->json($res);
    }
}
