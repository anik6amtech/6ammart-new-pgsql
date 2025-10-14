<?php

namespace Modules\RideShare\Http\Resources\VehicleManagement;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\RideShare\Http\Resources\FareManagement\TripFareResource;

class VehicleCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->image_full_url,
            'type' => $this->type,
            'fare' => TripFareResource::collection($this->whenLoaded('tripFares'))
        ];
    }
}
