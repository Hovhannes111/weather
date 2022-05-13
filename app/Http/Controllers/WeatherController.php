<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function getWeather(Request $request){
        if($request->cityId){
            $data = City::find($request->cityId, ['latitude', 'longitude']);
        } else {
            $data = City::find($request->countryId, ['latitude', 'longitude']);
        }
        $firstRequest = Http::get("https://api.openweathermap.org/data/2.5/weather?lat=".$data->latitude."&lon=".$data->longitude."&appid=".env('OPENWEATHERMAP_KEY')."&units=metric")->body();
        $secondRequest = Http::get("https://api.weatherbit.io/v2.0/current?lat=".$data->latitude."&lon=".$data->longitude."&key=".env('WEATHERBIT_KEY')."&include=minutely")->body();
        $firstTemp = json_decode($firstRequest)->main->temp;
        $secondTemp = json_decode($secondRequest)->data[0]->temp; 
        $averageTemp = number_format(($firstTemp + $secondTemp) / 2, 1); 
        return response()->json((int)$averageTemp);
    }
}
