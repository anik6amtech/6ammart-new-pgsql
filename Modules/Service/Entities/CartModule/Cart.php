<?php

namespace Modules\Service\Entities\CartModule;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Service\Entities\CategoryManagement\Category;
use Modules\Service\Entities\PromotionManagement\Coupon;
use Modules\Service\Entities\ProviderManagement\Provider;
use Modules\Service\Entities\ServiceManagement\Service;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'service_carts';

    protected $casts = [
        'service_cost' => 'float',
        'quantity' => 'integer',
        'discount_amount' => 'float',
        'coupon_discount' => 'float',
        'campaign_discount' => 'float',
        'tax_amount' => 'float',
        'total_cost' => 'float',
        'referral_discount' => 'float',
    ];

    protected $fillable = [];

    public function customer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
    public function coupon(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Coupon::class, 'coupon_id');
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class, 'provider_id');
    }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function sub_category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class, 'sub_category_id');
    }

    public function service(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function scopeModule($query, $module_id)
    {
        return $query->where('module_id', $module_id);
    }
}
