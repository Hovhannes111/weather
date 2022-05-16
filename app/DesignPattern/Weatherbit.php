<?php

namespace App\DesignPattern;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Weatherbit 
{
    private object $location;

    private string $url = 'https://api.weatherbit.io/v2.0/';

    /**
     * @param object $location
     * 
     * @return int
     */
    public function execute(object $location): int
    {
        $this->location = $location;
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
        return $this->url .'current?lat=' . $this->location->latitude."&lon=" . $this->location->longitude."&key=".env('WEATHERBIT_KEY')."&include=minutely";
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
            Log::channel('errorException')->info($e);
        }
    }
}