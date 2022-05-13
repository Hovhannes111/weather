<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function getWeather($cityId){
        $city = City::find($cityId);
        $firstRequest = Http::get("https://api.openweathermap.org/data/2.5/weather?lat=".$city->latitude."&lon=".$city->longitude."&appid=".env('OPENWEATHERMAP_KEY')."&units=metric")->body();
        $secondRequest = Http::get("https://api.weatherbit.io/v2.0/current?lat=".$city->latitude."&lon=".$city->longitude."&key=".env('WEATHERBIT_KEY')."&include=minutely")->body();
        $firstTemp = json_decode($firstRequest)->main->temp;
        $secondTemp = json_decode($secondRequest)->data[0]->temp; 
        $averageTemp = number_format(($firstTemp + $secondTemp) / 2, 1); 
        return response()->json((int)$averageTemp);
    }
}
