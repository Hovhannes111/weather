<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\State;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class SiteController extends Controller
{
    /**
     * @return View
     */
    public function index():View
    {
        $countries = Country::all();
        return view('index', compact('countries'));
    }

    /**
     * @param Country $country
     * @return JsonResponse
     */
    public function getStatesByCountry(Country $country): JsonResponse
    {
        $states = $country->states()->get();
        return response()->json($states);
    }

    /**
     * @param State $state
     * @return JsonResponse
     */
    public function getCitiesByState(State $state): JsonResponse
    {
        $cities = $state->cities()->get();
        return response()->json($cities);
    }
}
