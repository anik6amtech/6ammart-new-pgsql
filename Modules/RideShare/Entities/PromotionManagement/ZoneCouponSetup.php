<?php

namespace Modules\RideShare\Entities\PromotionManagement;

use App\Models\Zone;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ZoneCouponSetup extends Model
{
    use HasFactory;

    protected $table = 'ride_zone_coupon_setups';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['id','zone_id', 'coupon_setup_id'];


    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    public function coupon()
    {
        return $this->belongsTo(CouponSetup::class);
    }
}
