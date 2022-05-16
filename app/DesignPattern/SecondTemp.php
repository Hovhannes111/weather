<?php

namespace App\DesignPattern;
use Illuminate\Support\Facades\Http;

class SecondTemp
{
    
    public function secondWeather ($location) {
        $req = Http::get("https://api.weatherbit.io/v2.0/current?lat=".$location->latitude."&lon=".$location->longitude."&key=".env('WEATHERBIT_KEY')."&include=minutely");
        $temp = json_decode($req->body())->data[0]->temp; 
        return $temp;
    }
}