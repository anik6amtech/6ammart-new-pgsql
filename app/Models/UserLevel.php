<?php

namespace App\Models;

use App\CentralLogics\Helpers;
use App\Models\DeliveryMan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class UserLevel extends Model
{
    use HasFactory;

    protected $fillable = [
        'sequence',
        'name',
        'reward_type',
        'reward_amount',
        'image',
        'targeted_ride',
        'targeted_ride_point',
        'targeted_amount',
        'targeted_amount_point',
        'targeted_cancel',
        'targeted_cancel_point',
        'targeted_review',
        'targeted_review_point',
        'user_type',
        'is_active',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'sequence' => 'integer',
        'reward_amount'=>'string',
        'targeted_ride'=>'double',
        'targeted_ride_point'=>'double',
        'targeted_amount'=>'double',
        'targeted_amount_point'=>'double',
        'targeted_cancel'=>'double',
        'targeted_cancel_point'=>'double',
        'targeted_review'=>'double',
        'targeted_review_point'=>'double',
        'is_active'=> 'integer'
    ];

    protected $appends = ['image_full_url'];

    public function storage()
    {
        return $this->morphMany(Storage::class, 'data');
    }

    public function getImageFullUrlAttribute(){
        $value = $this->image;
        if (count($this->storage) > 0) {
            foreach ($this->storage as $storage) {
                if ($storage['key'] == 'image') {
                    return Helpers::get_full_url('driver/level/',$value,$storage['value'],'brand');
                }
            }
        }

        return Helpers::get_full_url('driver/level/',$value,'public');
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

    public function scopeUserType($query, $type){
        $query->where('user_type', $type);
    }

    public function access()
    {
        return $this->hasOne(LevelAccess::class, 'level_id');
    }

    public function users()
    {
        return $this->hasMany(DeliveryMan::class, 'user_level_id');
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
