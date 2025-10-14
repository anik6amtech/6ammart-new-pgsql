<?php

namespace Modules\RideShare\Entities\TripManagement;

use App\Models\DeliveryMan;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\RideShare\Entities\ReviewModule\RideReview;
use Modules\RideShare\Entities\TripManagement\RideRequest;
use Modules\RideShare\Entities\UserManagement\UserLastLocation;

class FareBidding extends Model
{
    use HasFactory;

    protected $fillable = [
        'ride_request_id',
        'driver_id',
        'customer_id',
        'bid_fare',
        'is_ignored',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'bid_fare' => 'string',
        'is_ignored' => 'boolean'
    ];

    protected $guarded = [];

    public function trip_request(){
        return $this->belongsTo(RideRequest::class, 'ride_request_id');
    }

    public function customer(){
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function driver(){
        return $this->belongsTo(DeliveryMan::class, 'driver_id');
    }

    public function driver_last_location(){
        return $this->belongsTo(UserLastLocation::class, 'driver_id', 'user_id');
    }

    public function customerReceivedReviews(){
        return $this->hasMany(RideReview::class, 'received_by', 'customer_id');
    }
    public function driverReceivedReviews(){
        return $this->hasMany(RideReview::class, 'received_by', 'driver_id');
    }

    protected function scopeOfIsNotIgnored($query, $status = 0)
    {
        $query->where('is_ignored', $status);
    }

    // protected static function boot()
    // {
    //     parent::boot();


    //     static::deleted(function($item) {
    //         $log = new FareBiddingLog();
    //         $log->id = $item->original['id'];
    //         $log->ride_request_id = $item->original['ride_request_id'];
    //         $log->driver_id = $item->original['driver_id'];
    //         $log->customer_id = $item->original['customer_id'] ;
    //         $log->bid_fare = $item->original['bid_fare'] ;
    //         $log->created_at = $item->original['created_at'] ;
    //         $log->updated_at = $item->original['updated_at'] ;

    //         $log->save();
    //     });

    // }


}
