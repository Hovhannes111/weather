<?php

namespace App\DesignPattern;
use Illuminate\Support\Facades\Http;

class FirstTemp 
{

    public function firstWeather ($location) {
        $req = Http::get("https://api.openweathermap.org/data/2.5/weather?lat=".$location->latitude."&lon=".$location->longitude."&appid=".env('OPENWEATHERMAP_KEY')."&units=metric");
        $temp = json_decode($req->body())->main->temp;
        return $temp;
    }
}