<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;

class SiteController extends Controller
{
    public function index() {
        $countries = Country::first();
        dd($countries);
        return view('index', compact('countries'));
    }
}
