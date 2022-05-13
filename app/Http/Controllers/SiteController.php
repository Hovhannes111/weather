<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;

class SiteController extends Controller
{
    public function index() {
        $countries = Country::all();
        return view('index', compact('countries'));
    }
    public function getCitiesByCountry($countryId) {
        $cities = Country::find($countryId)->cities()->groupBy('name')->get();
        return response()->json($cities);
    }
}
