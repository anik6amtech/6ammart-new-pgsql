<?php

namespace Modules\RideShare\Entities\TripManagement;

use App\Models\User;
use App\Models\Zone;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\Traits\HasSpatial;

class RecentAddress extends Model
{
    use HasFactory, HasSpatial;

    protected $fillable = [
        'user_id',
        'zone_id',
        'pickup_coordinates',
        'pickup_address',
        'destination_coordinates',
        'destination_address',
        'created_at',
        'updated_at',
    ];
    protected $cast = [
        'pickup_coordinates' => Point::class,
        'destination_coordinates' => Point::class
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function zone()
    {
        return $this->belongsTo(Zone::class, 'zone_id');
    }
}
