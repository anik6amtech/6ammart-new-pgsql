<?php

namespace Modules\RideShare\Entities\TripManagement;

use App\Models\DeliveryMan;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TempRideNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'ride_request_id',
        'user_id',
        'user_type'
    ];

    public function user(){
        if($this->user_type == DRIVER) {
            return $this->belongsTo(DeliveryMan::class, 'user_id');
        } 
        return $this->belongsTo(User::class, 'user_id');
    }

    public function driver() {
        return $this->belongsTo(DeliveryMan::class, 'user_id');
    }
}
