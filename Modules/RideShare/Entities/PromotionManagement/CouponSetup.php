<?php

namespace Modules\RideShare\Entities\PromotionManagement;

use App\Models\RiderVehicleCategory;
use App\Models\Translation;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\RideShare\Entities\TripManagement\RideRequest;

class CouponSetup extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ride_coupon_setups';

    protected $fillable = [
        'name',
        'description',
        'zone_coupon_type',
        'customer_coupon_type',
        'category_coupon_type',
        'user_id',
        'min_trip_amount',
        'max_coupon_amount',
        'coupon',
        'amount_type',
        'coupon_type',
        'coupon_code',
        'limit',
        'start_date',
        'end_date',
        'rules',
        'total_used',
        'total_amount',
        'module_id',
        'is_active',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'category_coupon_type' => 'array',
        'min_trip_amount' => 'string',
        'max_coupon_amount' => 'string',
        'coupon' => 'string',
        'limit' => 'integer',
        'total_used' => 'float',
        'total_amount' => 'float',
        'is_active' => 'integer',
    ];

    public function getNameAttribute($value){
        if (count($this->translations) > 0) {
            foreach ($this->translations as $translation) {
                if ($translation['key'] == 'name') {
                    return $translation['value'];
                }
            }
        }
        return $value;
    }
    public function getDescriptionAttribute($value){
        if (count($this->translations) > 0) {
            foreach ($this->translations as $translation) {
                if ($translation['key'] == 'description') {
                    return $translation['value'];
                }
            }
        }

        return $value;
    }

    public function categories()
    {
        return $this->belongsToMany(RiderVehicleCategory::class)->using('Modules\RideShare\Entities\PromotionManagement\CouponSetupVehicleCategory.php')->withTimestamps();
    }

    public function trips()
    {
        return $this->hasMany(RideRequest::class, 'coupon_id');
    }

    public function appliedCoupons()
    {
        return $this->hasMany(AppliedCoupon::class);
    }

    public function vehicleCategories()
    {
        return $this->belongsToMany(RiderVehicleCategory::class, VehicleCategoryCouponSetup::class);
    }

    public function zones()
    {
        return $this->belongsToMany(Zone::class, ZoneCouponSetup::class);
    }

    public function customers()
    {
        return $this->belongsToMany(User::class, CustomerCouponSetup::class);
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getIsAppliedAttribute()
    {
        $user = User::where('id',auth('api')->id())->first();
        return $user && $user->appliedCoupon && $user->appliedCoupon->coupon_setup_id == $this->id;
    }


    public function getZoneCouponAttribute()
    {
        if ($this->zone_coupon_type === ALL) {
            $data[] = ALL;
            return $data;
        }
        $data = [];
        foreach ($this->zones->pluck('name')->toArray() as $zone) {
            $data[] = $zone;
        }
        return $data;
    }

    // public function getCustomerLevelCouponAttribute()
    // {
    //     if ($this->customer_level_coupon_type === ALL) {
    //         $data[] = ALL;
    //         return $data;
    //     }
    //     $data = [];
    //     foreach ($this->customerLevels->pluck('name')->toArray() as $customerLevel) {
    //         $data[] = $customerLevel;
    //     }
    //     return $data;
    // }

    public function scopeModule($query, $module_id): mixed
    {
        return $query->where('module_id', $module_id);
    }

    public function getCustomerCouponAttribute()
    {
        if ($this->customer_coupon_type === ALL) {
            $data[] = ALL;
            return $data;
        }
        $data = [];
        foreach ($this->customers as $customer) {
            $data[] = $customer->first_name . ' ' . $customer->last_name;
        }
        return $data;
    }

    public function getCategoryCouponAttribute()
    {
        if (in_array(ALL, $this->category_coupon_type, true)) {
            $data[] = ALL;
            return $data;
        } elseif (in_array(PARCEL, $this->category_coupon_type, true) && in_array(CUSTOM, $this->category_coupon_type, true)) {
            $data[] = "Parcel";
            foreach ($this->vehicleCategories->pluck('name')->toArray() as $vehicleCategory) {
                $data[] = $vehicleCategory;
            }
            return $data;
        } elseif (in_array(PARCEL, $this->category_coupon_type, true)) {
            $data[] = "Parcel";
            return $data;
        } elseif (in_array(CUSTOM, $this->category_coupon_type, true)) {
            $data = [];
            foreach ($this->vehicleCategories->pluck('name')->toArray() as $vehicleCategory) {
                $data[] = $vehicleCategory;
            }
            return $data;
        } else {
            return [];
        }
    }

    public function getCategoryCouponImageAttribute()
    {
        if (in_array(ALL, $this->category_coupon_type, true)) {
            return asset('public/assets/admin/img/coupon-default.png');
        } elseif (in_array(PARCEL, $this->category_coupon_type, true) && in_array(CUSTOM, $this->category_coupon_type, true)) {
            return asset('public/assets/admin/img/coupon-default.png');
        } elseif (in_array(PARCEL, $this->category_coupon_type, true)) {
            return asset('public/assets/admin-module/img/parcel-coupon.png');
        } elseif (in_array(CUSTOM, $this->category_coupon_type, true)) {
            if (count($this->vehicleCategories) > 1) {
                return asset('public/assets/admin/img/coupon-default.png');
            } else {
                // return onErrorImage(
                //     $this->vehicleCategories[0]?->image,
                //     asset('storage/app/public/vehicle/category') . '/' . $this->vehicleCategories[0]?->image,
                //     asset('public/assets/admin-module/img/media/car.png'),
                //     'vehicle/category/',
                // );
                return $this->vehicleCategories[0]?->image_full_url;
            }
        } else {
            return null;
        }
    }

    public function translations()
    {
        return $this->morphMany(Translation::class, 'translationable');
    }

    protected static function booted()
    {
        static::addGlobalScope('translate', function (Builder $builder) {
            $builder->with(['translations' => function($query){
                return $query->where('locale', app()->getLocale());
            }]);
        });
    }

}
