<?php

namespace Modules\RideShare\Http\Resources\UserManagement;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TimeTrackResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request $request
     * @return array
     */
    public function toArray($request)
    {
        $latestLog = $this->latestLog;

        $totalOnline = $this->total_online;
        $totalOffline = $this->total_offline;

        if($latestLog){
            if($latestLog->online_at && !$latestLog->offline_at){
                $totalOnline += Carbon::parse($latestLog->online_at)->diffInMinutes(now());
            }
            if($latestLog->offline_at){
                $totalOffline += Carbon::parse($latestLog->offline_at)->diffInMinutes(now());
            }
        }
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'date' => $this->date,
            'total_online' => $totalOnline,
            'total_offline' => $totalOffline,
            'total_idle' => $this->total_idle,
            'total_driving' => $this->total_driving,
            'last_ride_started_at' => $this->last_ride_started_at,
            'last_ride_completed_at' => $this->last_ride_completed_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
