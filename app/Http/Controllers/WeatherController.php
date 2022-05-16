<?php

namespace App\Http\Controllers;

use App\DesignPattern\WeatherStrategy;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    /**
     * @var WeatherStrategy
    */
    protected $weatherStrategy;

    public function __construct(WeatherStrategy $weatherStrategy)
    {
        $this->weatherStrategy = $weatherStrategy;
    }

    public function getWeather(Request $request){
        if($request->cityId){
            $data = City::find($request->cityId, ['latitude', 'longitude']);
        } elseif(!$request->cityId && $request->stateId) {
            $data = State::find($request->stateId, ['latitude', 'longitude']);
        } else {
            $data = Country::find($request->countryId, ['latitude', 'longitude']);
        }
        $res = $this->weatherStrategy->getResult($data);
        return response()->json($res);
    }
}
