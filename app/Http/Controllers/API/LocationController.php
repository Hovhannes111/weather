<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\LocationCountryResource;
use App\Http\Resources\LocationStateResource;
use App\Models\Country;
use App\Models\State;

class LocationController extends Controller
{
    /**
     * @param Country $country
     * @return LocationCountryResource
     */
    public function country(Country $country): LocationCountryResource
    {
        return New LocationCountryResource($country);
    }


    /**
     * Get states related to country.
     *
     * @param State $state
     * @return LocationStateResource
     */
    public function state(State $state): LocationStateResource
    {
        return New LocationStateResource($state);
    }
}
