<?php

namespace Modules\RideShare\Entities\UserManagement;

use App\Models\DeliveryMan;
use App\Models\RiderVehicle;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserLastLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'latitude',
        'longitude',
        'zone_id',
        'created_at',
        'updated_at',
    ];

    public function zone()
    {
        return $this->belongsTo(Zone::class, 'zone_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function driver()
    {
        return $this->belongsTo(DeliveryMan::class, 'user_id');
    }

    public function driverDetails()
    {
        return $this->belongsTo(RiderDetail::class, 'user_id', 'user_id');
    }

    public function vehicle(){
        return $this->belongsTo(RiderVehicle::class, 'user_id', 'driver_id');
    }
}
