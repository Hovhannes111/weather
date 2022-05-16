<?php

namespace App\DesignPattern;
use Illuminate\Support\Facades\Http;

class SecondTemp
{

    private array $location;

    private $url = 'https://api.weatherbit.io/v2.0/current?lat';

    /**
     * @param array $location
     */
    public function __construct(array $location)
    {
        $this->location = $location;
    }

    /**
     * @return int
     */
    public function execute(): int
    {
        $this->setResult();
        return $this->getTemp();
    }

    /**
     * Get request URI for current API
     *
     * @return string
     */
    private function getRequestUri(): string
    {
        return $this->url . $this->location->latitude."&lon=" . $this->location->longitude."&key=".env('WEATHERBIT_KEY')."&include=minutely";
    }

    /**
     * @return int
     */
    private function getTemp(): int
    {
        return (int) json_decode($this->result->body())->data[0]->temp;
    }

    /**
     * @return void
     */
    private function setResult(): void
    {
        try {
            $this->result = Http::get($this->getRequestUri());
        } catch (\Exception $e) {
            // TODO create log
        }
    }
}
