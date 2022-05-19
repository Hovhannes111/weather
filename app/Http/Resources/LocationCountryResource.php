<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LocationCountryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        if ($this->states->count()) {
            return [
                'states' => StateResource::collection($this->states)
            ];
        } else if ($this->cities->count()) {
            return [
                'cities' => CityResource::collection($this->cities)
            ];
        }
        return [
            'location' => [
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
            ]
        ];
    }
}
