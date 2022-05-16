<?php 

namespace App\DesignPattern;

class WeatherStrategy 
{
    /**
     * @var FirstTemp
     * @var SecondTemp
     * @var GetAverageTemp
    */
    protected $firstTemp;
    protected $secondTemp;
    protected $getAverageTemp;

    public function __construct(FirstTemp $firstTemp, SecondTemp $secondTemp,GetAverageTemp $getAverageTemp)
    {
        $this->firstTemp      = $firstTemp;
        $this->secondTemp     = $secondTemp;
        $this->getAverageTemp = $getAverageTemp;
    }

    public function getResult($data) {
        $firstWeather = $this->firstTemp->firstWeather($data); 
        $secondWeather = $this->secondTemp->secondWeather($data);
        $getAverageTemp = $this->getAverageTemp->avarageWeather($firstWeather, $secondWeather);
        return $getAverageTemp;
    }
}