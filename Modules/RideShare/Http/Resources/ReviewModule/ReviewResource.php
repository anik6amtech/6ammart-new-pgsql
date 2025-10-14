<?php

namespace Modules\RideShare\Http\Resources\ReviewModule;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\RideShare\Http\Resources\TripManagement\TripRequestResource;
use Modules\RideShare\Http\Resources\UserManagement\CustomerResource;

class ReviewResource extends JsonResource
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
            'id' => $this->id,
            'trip_request_id' => $this->ride_request_id,
            'trip' => TripRequestResource::make($this->whenLoaded('trip')),
            'trip_ref_id' =>$this->whenLoaded(relationship: 'trip', value: $this->trip->ref_id),
            // 'given_user' => CustomerResource::make($this->whenLoaded('givenUser')),
            'given_user' => CustomerResource::make($this->givenUser),
            'trip_type' => $this->ride_type,
            'rating' => $this->rating,
            'feedback' => $this->feedback,
            'is_saved' => (boolean) $this->is_saved,
            'created_at' => $this->created_at,
        ];
        // if($this->relation)
    }
}
