<?php

namespace Modules\RideShare\Entities\TripManagement;

use App\Models\Admin;
use App\Models\DeliveryMan;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\RideShare\Entities\UserManagement\UserLastLocation;

class RideSafetyAlert extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'ride_request_id',
        'sent_by',
        'sent_by_type',
        'alert_location',
        'resolved_location',
        'number_of_alert',
        'resolved_by',
        'resolved_by_type',
        'ride_status_when_make_alert',
        'status',
        'reason',
        'comment',
    ];

    protected $casts = [
        'reason' => 'array',
    ];

    public function sentBy()
    {
        if ($this->sent_by_type === 'customer') {
            return $this->belongsTo(User::class, 'sent_by');
        } else{
            return $this->belongsTo(DeliveryMan::class, 'sent_by');
        }
    }

    public function solvedBy()
    {
        if ($this->resolved_by_type === 'customer') {
            return $this->belongsTo(User::class, 'resolved_by');
        } elseif($this->resolved_by_type === 'admin-employee') {
            return $this->belongsTo(Admin::class, 'resolved_by');
        } elseif($this->resolved_by_type === 'admin') {
            return $this->belongsTo(Admin::class, 'resolved_by');
        } else {
            return $this->belongsTo(DeliveryMan::class, 'resolved_by');
        }
    }

    public function trip()
    {
        return $this->belongsTo(RideRequest::class, 'ride_request_id');
    }

    public function lastLocation()
    {
        return $this->belongsTo(UserLastLocation::class, 'sent_by', 'user_id');
    }
}
