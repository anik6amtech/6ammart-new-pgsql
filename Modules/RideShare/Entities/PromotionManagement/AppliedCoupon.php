<?php

namespace Modules\RideShare\Entities\PromotionManagement;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AppliedCoupon extends Model
{
    use HasFactory;

    protected $table = 'ride_applied_coupons';

    /**
     * The attributes that are mass assignable.
     */

    protected $fillable = ['user_id', 'coupon_setup_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function coupon()
    {
        return $this->belongsTo(CouponSetup::class);
    }
}
