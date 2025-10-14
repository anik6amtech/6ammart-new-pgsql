<?php

namespace Modules\RideShare\Entities\PromotionManagement;

use App\Models\RiderVehicleCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VehicleCategoryCouponSetup extends Model
{
    use HasFactory;
    protected $table = 'ride_vehicle_category_coupon_setups';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['rider_vehicle_category_id', 'coupon_setup_id'];


    public function vehicleCategory()
    {
        return $this->belongsTo(RiderVehicleCategory::class);
    }

    public function coupon()
    {
        return $this->belongsTo(CouponSetup::class);
    }
}
