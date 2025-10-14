<?php

namespace Modules\Service\Entities\ProviderManagement;

use App\Models\Module;
use App\Models\Storage;
use App\Models\Translation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Modules\Service\Entities\BookingModule\Booking;
use Laravel\Passport\HasApiTokens;

class Serviceman extends Authenticatable
{
    use HasApiTokens, Notifiable, HasFactory, SoftDeletes;

    protected $fillable = [];
    protected $table = 'service_servicemen';


    protected $hidden = [
        'password'
    ];

    protected $casts = [
        'is_phone_verified' => 'integer',
        'is_email_verified' => 'integer',
        'is_active' => 'integer',
        'identification_image' => 'array',
        'wallet_balance' => 'float',
        'loyalty_point' => 'float',
    ];

    protected $appends = ['profile_image_full_path', 'identification_image_full_path'];

    public function getAuthIdentifierName()
    {
        return 'phone';
    }
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'serviceman_id', 'id');
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class, 'service_provider_id');
    }

    public function scopeOfStatus($query, $status)
    {
        $query->where('is_active', '=', $status);
    }

    protected function scopeOfType($query, $type)
    {
        $query->whereIn('user_type', $type);
    }

    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }

    public function storage()
    {
        return $this->morphOne(Storage::class, 'data');
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getIdentificationImageFullPathAttribute()
    {
        $images = $this->identification_image;
        if (is_string($images)) {
            $images = json_decode($images, true);
        }
//        if (is_array($images)) {
//            return array_map(function ($image) {
//                return getSingleImageFullPath(imagePath: 'provider/serviceman/identity/' . $image['image'], s3Storage: $this->storage);
//            }, $images);
//        }

        if (is_array($images) && !empty($images)) {
            $storageImages = array_filter(array_map(function ($image) {
                if (!empty($image['image'])) {
                    return getSingleImageFullPath(
                        imagePath: 'provider/identity/' . $image['image'],
                        s3Storage: $image['storage']
                    );
                }
                return null;
            }, $images));
            return array_values($storageImages);
        }
        return [];
    }

    public function getProfileImageFullPathAttribute()
    {
        $image = $this->profile_image;
        $defaultPath =  asset('public/assets/admin/img/160x160/img1.jpg');

        if (!$image) {
            if (request()->is('api/*')) {
                $defaultPath = null;
            }
            return $defaultPath;
        }

        $s3Storage = $this->storage;
        $path = 'provider/serviceman/';
        $imagePath = $path . $image;
        return getSingleImageFullPath(imagePath: $imagePath, s3Storage: $s3Storage, defaultPath: $defaultPath);
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            // ... code here
        });

        self::created(function ($model) {
            // ... code here
        });

        self::updating(function ($model) {
        });

        self::updated(function ($model) {
        });

        self::deleting(function ($model) {
            file_remover('provider/serviceman/profile/', $model->profile_image);
            $files = is_array($model->identification_image) ? $model->identification_image : json_decode($model->identification_image, true);
            if (!is_array($files)) {
                $files = [];
            }
            foreach ($files as $image) {
                file_remover('provider/serviceman/identity/', $image);
            }
        });

        self::deleted(function ($model) {
            // ... code here
        });
    }


}
