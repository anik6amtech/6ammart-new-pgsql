<?php

namespace App\Models;

use App\CentralLogics\Helpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Modules\RideShare\Entities\FareManagement\RideFare;

class RiderVehicleCategory extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'image',
        'type',
        'is_active',
        'starting_coverage_area',
        'maximum_coverage_area',
        'extra_charges',
        'is_delivery',
        'is_ride',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
        'is_delivery' => 'boolean',
        'is_ride' => 'boolean',
    ];

    protected $appends = ['image_full_url'];

    public function vehicles()
    {
        return $this->hasMany(RiderVehicle::class, 'category_id');
    }

    public function tripFares()
    {
        return $this->hasMany(RideFare::class, 'vehicle_category_id');
    }

    protected function scopeOfStatus($query, $status=1)
    {
        $query->where('is_active', $status);
    }

        public function translations()
    {
        return $this->morphMany(Translation::class, 'translationable');
    }

    public function delivery_man()
    {
        return $this->hasOne(DeliveryMan::class,'vehicle_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

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

    public function getImageFullUrlAttribute(){
        $value = $this->image;
        if (count($this->storage) > 0) {
            foreach ($this->storage as $storage) {
                if ($storage['key'] == 'image') {
                    return Helpers::get_full_url('vehicle/category',$value,$storage['value'],'category');
                }
            }
        }

        return Helpers::get_full_url('vehicle/category',$value,'public');
    }

    public function storage()
    {
        return $this->morphMany(Storage::class, 'data');
    }

    protected static function boot()
    {
        parent::boot();

        static::saved(function ($model) {
            if($model->isDirty('image')){
                $value = Helpers::getDisk();

                DB::table('storages')->updateOrInsert([
                    'data_type' => get_class($model),
                    'data_id' => $model->id,
                    'key' => 'image',
                ], [
                    'value' => $value,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        });
    }

    protected static function booted()
    {
        static::addGlobalScope('translate', function (Builder $builder) {
            $builder->with(['translations' => function ($query) {
                return $query->where('locale', app()->getLocale());
            }]);
        });
    }
}
