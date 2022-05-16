<?php 

namespace App\DesignPattern;

class GetAverageTemp implements AverageTempInterface
{
    /**
    * @return int
    */
    public function avarageWeather ($openWeatherMap, $weatherbit): int
    {
        $averageTemp = number_format(($openWeatherMap + $weatherbit) / 2, 1); 
        return (int) $averageTemp;
    }
}