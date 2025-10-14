<?php

namespace Modules\RideShare\Entities\TripManagement;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RideRequestTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'ride_request_id',
        'estimated_time',
        'actual_time',
        'waiting_time',
        'delay_time',
        'idle_timestamp',
        'idle_time',
        'driver_arrival_time',
        'driver_arrival_timestamp',
        'driver_arrives_at',
        'customer_arrives_at',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'estimated_time' => 'float',
        'actual_time' => 'float',
        'waiting_time' => 'float',
        'delay_time' => 'float',
        'idle_time' => 'float',
        'driver_arrival_time' => 'float',
    ];

    public function tripRequest()
    {
        $this->belongsTo(RideRequest::class, 'ride_request_id');
    }
}
