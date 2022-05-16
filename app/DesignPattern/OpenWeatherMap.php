<?php

namespace App\DesignPattern;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OpenWeatherMap 
{
    private object $location;

    private string $url = 'https://api.openweathermap.org/data/2.5/';

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
        return $this->url .'weather?lat=' . $this->location->latitude."&lon=" . $this->location->longitude."&appid=".env('OPENWEATHERMAP_KEY')."&units=metric";
    }

    /**
     * @return int
     */
    private function getTemp(): int
    {
        return (int) json_decode($this->result->body())->main->temp;
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