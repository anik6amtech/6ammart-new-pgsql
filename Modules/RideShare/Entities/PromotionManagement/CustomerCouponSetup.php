<?php

namespace Modules\RideShare\Entities\PromotionManagement;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerCouponSetup extends Model
{
    use HasFactory;

    protected $table = 'ride_customer_coupon_setups';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['id','user_id', 'discount_setup_id','limit_per_user'];

    protected $casts = [
        'limit_per_user' => 'integer',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function coupon()
    {
        return $this->belongsTo(CouponSetup::class);
    }
}
