<?php

namespace Modules\RideShare\Entities\TripManagement;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use MatanYadaev\EloquentSpatial\Objects\Polygon;
use MatanYadaev\EloquentSpatial\Traits\HasSpatial;

class RideRoute extends Model
{
    use HasFactory,HasSpatial;

    protected $fillable = [
        'ride_request_id',
        'coordinates',
        'created_at',
        'updated_at',
    ];
    protected $casts = [
        'coordinates' => Polygon::class
    ];

    public function tripRequest()
    {
        return $this->belongsTo(RideRequest::class);
    }
}
