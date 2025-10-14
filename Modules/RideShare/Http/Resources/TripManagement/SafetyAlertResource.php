<?php

namespace Modules\RideShare\Http\Resources\TripManagement;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SafetyAlertResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'alert_location' => $this->alert_location,
            'reason' => $this->reason,
            'comment' => $this->comment,
            'status' => $this->status,
            'ride_request_id' => $this->ride_request_id,
            'sent_by' => $this->sent_by,
            'sent_by_type' => $this->sent_by_type,
            'resolved_location' => $this->resolved_location,
            'number_of_alert' => $this->number_of_alert,
            'resolved_by' => $this->resolved_by,
            'resolved_by_type' => $this->resolved_by_type,
            'ride_status_when_make_alert' => $this->ride_status_when_make_alert,
        ];
    }
}
