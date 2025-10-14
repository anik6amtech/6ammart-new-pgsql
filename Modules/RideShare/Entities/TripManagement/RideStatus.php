<?php

namespace Modules\RideShare\Entities\TripManagement;

use App\Models\DeliveryMan;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class RideStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'ride_request_id',
        'customer_id',
        'driver_id',
        'pending',
        'accepted',
        'out_for_pickup',
        'picked_up',
        'ongoing',
        'completed',
        'cancelled',
        'returning',
        'returned',
        'failed',
        'note',
        'created_at',
        'updated_at',
    ];
    protected $table = 'ride_status';

    public function tripRequest()
    {
        return $this->belongsTo(RideRequest::class);
    }
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function driver()
    {
        return $this->belongsTo(DeliveryMan::class, 'driver_id');
    }
}
