<?php 

namespace App\DesignPattern;

class GetWeather 
{
    /**
     * @var OpenWeatherMap
     * @var Weatherbit
     * @var GetAverageTemp
    */
    protected $openWeatherMap;
    protected $weatherbit;
    protected $getAverageTemp;

    public function __construct(OpenWeatherMap $openWeatherMap, Weatherbit $weatherbit,GetAverageTemp $getAverageTemp)
    {
        $this->openWeatherMap = $openWeatherMap;
        $this->weatherbit     = $weatherbit;
        $this->getAverageTemp = $getAverageTemp;
    }

    public function getResult($data) 
    {
        $firstWeather   = $this->openWeatherMap->execute($data); 
        $secondWeather  = $this->weatherbit->execute($data);
        $getAverageTemp = $this->getAverageTemp->avarageWeather($firstWeather, $secondWeather);
        return $getAverageTemp;
    }
}