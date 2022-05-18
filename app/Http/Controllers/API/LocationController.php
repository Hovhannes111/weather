<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use App\Http\Resources\CountryResource;
use App\Http\Resources\StateResource;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LocationController extends Controller
{
    /**
     * Get countries list
     *
     * @return AnonymousResourceCollection
     */
    public function countries(): AnonymousResourceCollection
    {
        return CountryResource::collection(Country::all());
    }

    /**
     * Get states related to country.
     *
     * @param Country $country
     * @return AnonymousResourceCollection
     */
    public function states(Country $country): AnonymousResourceCollection
    {
        return StateResource::collection($country->states()->get());
    }

    /**
     * Get cities related to state.
     *
     * @param State $state
     * @return AnonymousResourceCollection
     */
    public function citiesByState(State $state): AnonymousResourceCollection
    {
        return CityResource::collection($state->cities()->get());
    }

    /**
     * Get cities related to state.
     *
     * @param Country $country
     * @return AnonymousResourceCollection
     */
    public function citiesByCountry(Country $country): AnonymousResourceCollection
    {
        return CityResource::collection($country->cities()->get());
    }
}
