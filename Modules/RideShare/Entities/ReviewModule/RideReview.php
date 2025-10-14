<?php

namespace Modules\RideShare\Entities\ReviewModule;

use App\Models\DeliveryMan;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\RideShare\Entities\TripManagement\RideRequest;

class RideReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'ride_request_id',
        'given_by', //customer, driver
        'received_by',
        'ride_type',
        'rating',
        'feedback',
        'images',
        'is_saved',
        'deleted_at',
        'review_for',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'rating' => 'integer',
        'images' => 'array',
        'is_saved' => 'boolean',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class,'user_id', 'id');
    }

    public function givenByUser()
    {
        return $this->belongsTo(User::class, 'given_by');
    }

    public function givenByDeliveryMan()
    {
        return $this->belongsTo(DeliveryMan::class, 'given_by');
    }

    public function receivedByUser()
    {
        return $this->belongsTo(User::class, 'received_by');
    }

    public function receivedByDeliveryMan()
    {
        return $this->belongsTo(DeliveryMan::class, 'received_by');
    }

    public function getGivenUserAttribute()
    {
        if ($this->review_for === DRIVER) {
            return $this->givenByUser;
        }
        return $this->givenByDeliveryMan;
    }

    /* public function recievedUser(){
        if($this->review_for == DRIVER){
            return $this->belongsTo(DeliveryMan::class,'received_by');
        }
        return $this->belongsTo(User::class,'received_by');
    } */

    public function trip(){
        return $this->belongsTo(RideRequest::class,'ride_request_id');
    }

}
