<?php

namespace Modules\RideShare\Http\Resources\UserManagement;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LastLocationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'user_id' => $this->user_id,
            'type' => $this->type,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'zone_id' => $this->zone_id,
            'category' =>$this->type == 'rider' ? $this->driver->rider_vehicle->category->type : null,
        ];
    }
}
