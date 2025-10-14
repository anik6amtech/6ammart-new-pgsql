<?php

namespace Modules\Service\Entities\PromotionManagement;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CouponCustomer extends Model
{
    use HasFactory;

    protected $table = 'service_coupon_customers';

    protected $fillable = ['coupon_id', 'customer_user_id'];


    public function coupon(): BelongsTo
    {
        return $this->belongsTo(Coupon::class, 'coupon_id');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_user_id');
    }
}
