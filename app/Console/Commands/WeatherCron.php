<?php

namespace App\Console\Commands;

use App\Models\Weather;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class WeatherCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $current = Carbon::now();
        $data = Weather::all();
        foreach($data as $weather) {
            if($current->gt($weather->expires_at)) {
                Weather::find($weather->id)->delete();
                if(
                    Cache::get('weather_latitude') &&
                    Cache::get('weather_longitude') && 
                    $weather->latitude == Cache::get('weather_latitude') &&
                    $weather->longitude == Cache::get('weather_longitude')
                ){
                    Cache::pull('weather_temp');
                    Cache::pull('weather_latitude');
                    Cache::pull('weather_longitude');
                }
            }
        }
        return 0;
    }
}
