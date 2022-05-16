<?php 

namespace App\DesignPattern;

class GetAverageTemp implements AverageTempInterface
{
    public function avarageWeather ($firstTemp, $secondTemp) {
        $averageTemp = number_format(($firstTemp + $secondTemp) / 2, 1); 
        return (int)$averageTemp;
    }
}