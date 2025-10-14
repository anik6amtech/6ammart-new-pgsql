<?php

namespace Modules\Service\Entities\PromotionManagement;

use App\CentralLogics\Helpers;
use App\Models\Storage;
use App\Models\Translation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\DB;
use Modules\Service\Entities\PromotionManagement\Discount;

class Campaign extends Model
{
    use HasFactory;

    protected $table = 'service_campaigns';

    protected $fillable = [];

    protected $casts = [
        'is_active' => 'integer'
    ];

    protected $appends = ['thumbnail_full_path', 'cover_image_full_path'];

    public function discount(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Discount::class, 'discount_id');
    }

    public function scopeOfStatus($query, $status)
    {
        $query->where('is_active', '=', $status);
    }

    public function storage_cover_image()
    {
        return $this->morphOne(Storage::class, 'data')->where('key', 'cover_image');
    }

    public function storage_thumbnail()
    {
        return $this->morphOne(Storage::class, 'data')->where('key', 'thumbnail');
    }

    public function getThumbnailFullPathAttribute()
    {
        $image = $this->thumbnail;
        $defaultPath = asset('public/assets/admin-module/img/media/upload-file.png');
        if (request()->is('admin/*')) {
            $defaultPath = asset('public/assets/admin-module/img/media/upload-file.png');
        }

        if (!$image) {
            if (request()->is('api/*')) {
                $defaultPath = null;
            }
            return $defaultPath;
        }

        $s3Storage = $this->storage_thumbnail;
        $path = 'campaign/';
        $imagePath = $path . $image;

        return getSingleImageFullPath(imagePath: $imagePath, s3Storage: $s3Storage, defaultPath: $defaultPath);
    }

    public function getCoverImageFullPathAttribute()
    {
        $image = $this->cover_image;
        $defaultPath = asset('public/assets/admin-module/img/media/upload-file.png');
        if (request()->is('admin/*')) {
            $defaultPath = asset('public/assets/admin-module/img/media/upload-file.png');
        }
        if (!$image) {
            if (request()->is('api/*')) {
                $defaultPath = null;
            }
            return $defaultPath;
        }

        $s3Storage = $this->storage_cover_image;
        $path = 'campaign/';
        $imagePath = $path . $image;

        return getSingleImageFullPath( imagePath: $imagePath, s3Storage: $s3Storage, defaultPath: $defaultPath);
    }

    public function translations(): MorphMany
    {
        return $this->morphMany(Translation::class, 'translationable');
    }

    protected static function booted()
    {
        static::addGlobalScope('zone_wise_data', function (Builder $builder) {
            if (request()->is('api/*/customer?*') || request()->is('api/*/customer/*')) {
                $builder->whereHas('discount', function ($query) {
                    $query->where('promotion_type', 'campaign')
                        ->whereDate('start_date', '<=', now())
                        ->whereDate('end_date', '>=', now())
                        ->where('is_active', 1);
                })->whereHas('discount.discount_types', function ($query) {
                    $query->where(['discount_type' => 'zone', 'type_wise_id' => config('zone_id')]);
                })->latest()->with(['discount'])->where(['is_active' => 1]);
            }
        });

        static::saved(function ($model) {
            $storageType = getDisk();
            if($model->isDirty('thumbnail') && $storageType != 'public'){
                saveSingleImageDataToStorage(model: $model, modelColumn : 'thumbnail', storageType : $storageType);
            }
            if($model->isDirty('cover_image') && $storageType != 'public'){
                saveSingleImageDataToStorage(model: $model, modelColumn : 'cover_image', storageType : $storageType);
            }
        });

        static::addGlobalScope('translate', function (Builder $builder) {
            $builder->with(['translations' => function ($query) {
                return $query->where('locale', app()->getLocale());
            }]);
        });
    }

    protected static function boot()
    {
        parent::boot();
        static::saved(function ($model) {
            if($model->isDirty('cover_image')){
                $value = Helpers::getDisk();

                DB::table('storages')->updateOrInsert([
                    'data_type' => get_class($model),
                    'data_id' => $model->id,
                    'key' => 'cover_image',
                ], [
                    'value' => $value,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            if($model->isDirty('thumbnail')){
                $value = Helpers::getDisk();

                DB::table('storages')->updateOrInsert([
                    'data_type' => get_class($model),
                    'data_id' => $model->id,
                    'key' => 'thumbnail',
                ], [
                    'value' => $value,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        });
    }
}
