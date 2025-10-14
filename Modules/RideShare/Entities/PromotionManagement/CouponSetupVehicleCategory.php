<?php

namespace Modules\PromotionManagement\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CouponSetupVehicleCategory extends Pivot
{
    use HasFactory;

    protected $table = 'ride_coupon_setup_vehicle_category';

    protected $fillable = [
        'coupon_setup_id',
        'vehicle_category_id',
        'created_at',
        'updated_at',
    ];
}
