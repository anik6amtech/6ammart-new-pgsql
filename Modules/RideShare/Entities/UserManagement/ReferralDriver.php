<?php

namespace Modules\RideShare\Entities\UserManagement;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReferralDriver extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'driver_id',
        'ref_by',
        'ref_by_earning_amount',
        'driver_earning_amount',
        'is_used'
    ];
}
