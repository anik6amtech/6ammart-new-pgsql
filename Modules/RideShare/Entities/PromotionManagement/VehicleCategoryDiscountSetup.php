<?php

namespace Modules\RideShare\Entities\PromotionManagement;

use App\Models\RiderVehicleCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VehicleCategoryDiscountSetup extends Model
{
    use HasFactory;
    protected $table = 'ride_vehicle_category_discount_setups';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['rider_vehicle_category_id', 'discount_setup_id'];


    public function vehicleCategory()
    {
        return $this->belongsTo(RiderVehicleCategory::class);
    }

    public function discount()
    {
        return $this->belongsTo(DiscountSetup::class);
    }
}
