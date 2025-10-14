<?php

namespace App\Models;

use App\CentralLogics\Helpers;
use App\Models\Storage;
use App\Models\Translation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class RiderVehicleModel extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'brand_id',
        'seat_capacity',
        'maximum_weight',
        'hatch_bag_capacity',
        'engine',
        'description',
        'image',
        'is_active',
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
        'seat_capacity' => 'integer',
        'maximum_weight' => 'float',
        'hatch_bag_capacity' => 'integer',
    ];

    protected $appends = ['image_full_url'];

    public function vehicles()
    {
        return $this->hasMany(RiderVehicle::class, 'model_id');
    }

    public function brand()
    {
        return $this->belongsTo(RiderVehicleBrand::class, 'brand_id');
    }

    protected function scopeOfStatus($query, $status = 1)
    {
        $query->where('is_active', $status);
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
                    return Helpers::get_full_url('vehicle/model/',$value,$storage['value'],'model');
                }
            }
        }

        return Helpers::get_full_url('vehicle/model/',$value,'public');
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

    public function translations()
    {
        return $this->morphMany(Translation::class, 'translationable');
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
            $builder->with(['translations' => function($query){
                return $query->where('locale', app()->getLocale());
            }]);
        });
    }

}
