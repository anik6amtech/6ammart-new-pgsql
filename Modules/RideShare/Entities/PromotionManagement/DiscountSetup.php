<?php

namespace Modules\RideShare\Entities\PromotionManagement;

use App\CentralLogics\Helpers;
use App\Models\RiderVehicleCategory;
use App\Models\Storage;
use App\Models\Translation;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiscountSetup extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ride_discount_setups';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title',
        'short_description',
        'terms_conditions',
        'image',
        'zone_discount_type',
        'customer_level_discount_type',
        'customer_discount_type',
        'module_discount_type',
        'discount_amount_type',
        'limit_per_user',
        'discount_amount',
        'max_discount_amount',
        'min_trip_amount',
        'start_date',
        'end_date',
        'total_used',
        'total_amount',
        'is_active',
        'module_id',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    protected $appends = ['image_full_url'];

    protected $casts = [
        'module_discount_type' => 'array',
        'discount_amount' => 'double',
        'max_discount_amount' => 'double',
        'min_trip_amount' => 'double',
        'limit_per_user' => 'integer',
        'total_used' => 'integer',
        'total_amount' => 'double',
        'is_active' => 'boolean',
    ];

    public function getTitleAttribute($value){
        if (count($this->translations) > 0) {
            foreach ($this->translations as $translation) {
                if ($translation['key'] == 'title') {
                    return $translation['value'];
                }
            }
        }
        return $value;
    }
    public function getShortDescriptionAttribute($value){
        if (count($this->translations) > 0) {
            foreach ($this->translations as $translation) {
                if ($translation['key'] == 'short_description') {
                    return $translation['value'];
                }
            }
        }

        return $value;
    }
    public function getTermsConditionsAttribute($value){
        if (count($this->translations) > 0) {
            foreach ($this->translations as $translation) {
                if ($translation['key'] == 'terms_conditions') {
                    return $translation['value'];
                }
            }
        }

        return $value;
    }

    public function vehicleCategories()
    {
        return $this->belongsToMany(RiderVehicleCategory::class, VehicleCategoryDiscountSetup::class);
    }

    public function zones()
    {
        return $this->belongsToMany(Zone::class, ZoneDiscountSetup::class);
    }

    // public function customerLevels()
    // {
    //     return $this->belongsToMany(UserLevel::class, CustomerLevelDiscountSetup::class);
    // }

    public function customers()
    {
        return $this->belongsToMany(User::class, CustomerDiscountSetup::class);
    }

    public function getZoneDiscountAttribute()
    {
        if ($this->zone_discount_type === ALL) {
            $data[] = ALL;
            return $data;
        }
        $data = [];
        foreach ($this->zones->pluck('name')->toArray() as $zone) {
            $data[] = $zone;
        }
        return $data;
    }

    // public function getCustomerLevelDiscountAttribute()
    // {
    //     if ($this->customer_level_discount_type === ALL) {
    //         $data[] = ALL;
    //         return $data;
    //     }
    //     $data = [];
    //     foreach ($this->customerLevels->pluck('name')->toArray() as $customerLevel) {
    //         $data[] = $customerLevel;
    //     }
    //     return $data;
    // }

    public function getCustomerDiscountAttribute()
    {
        if ($this->customer_discount_type === ALL) {
            $data[] = ALL;
            return $data;
        }
        $data = [];
        foreach ($this->customers as $customer) {
            $data[] = $customer->first_name . ' ' . $customer->last_name;
        }
        return $data;
    }

    public function scopeModule($query, $module_id): mixed
    {
        return $query->where('module_id', $module_id);
    }

    public function getModuleDiscountAttribute()
    {
        if (in_array(ALL, $this->module_discount_type, true)) {
            $data[] = ALL;
            return $data;
        } elseif (in_array(PARCEL, $this->module_discount_type, true) && in_array(CUSTOM, $this->module_discount_type, true)) {
            $data[] = PARCEL;
            foreach ($this->vehicleCategories->pluck('name')->toArray() as $vehicleCategory) {
                $data[] = $vehicleCategory;
            }
            return $data;
        } elseif (in_array(PARCEL, $this->module_discount_type, true)) {
            $data[] = PARCEL;
            return $data;
        } elseif (in_array(CUSTOM, $this->module_discount_type, true)) {
            $data = [];
            foreach ($this->vehicleCategories->pluck('name')->toArray() as $vehicleCategory) {
                $data[] = $vehicleCategory;
            }
            return $data;
        } else {
            return [];
        }
    }

    public function storage()
    {
        return $this->morphMany(Storage::class, 'data');
    }

    public function getImageFullUrlAttribute(){
        $value = $this->image;
        if (count($this->storage) > 0) {
            foreach ($this->storage as $storage) {
                if ($storage['key'] == 'image') {
                    return Helpers::get_full_url('promotion/discount/',$value,$storage['value'],'model');
                }
            }
        }

        return Helpers::get_full_url('promotion/discount/',$value,'public');
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
