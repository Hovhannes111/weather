<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\State;

class SiteController extends Controller
{
    public function index() {
        $countries = Country::all();
        return view('index', compact('countries'));
    }
    
    public function getStatesByCountry($countryId) {
        $states = Country::find($countryId)->states()->get();
        return response()->json($states);
    }

    public function getCitiesByState($stateId) {
        $cities = State::find($stateId)->cities()->get();
        return response()->json($cities);
    }
}
