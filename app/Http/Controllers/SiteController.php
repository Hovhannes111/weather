<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;

class SiteController extends Controller
{
    public function index() {
        $countries = Country::all();
        // dd($countries->cities()->first());
        return view('index', compact('countries'));
    }
    public function getCitiesByCountryCode(Request $request) {
        dd($request->all());
    }
}
