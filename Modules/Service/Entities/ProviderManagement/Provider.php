<?php

namespace Modules\Service\Entities\ProviderManagement;

use App\Models\Module;
use App\Models\Storage;
use App\Models\StoreSubscription;
use App\Models\SubscriptionTransaction;
use App\Models\Translation;
use App\Models\UserAccount;
use App\Models\Zone;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Modules\Service\Entities\BookingModule\Booking;
use Modules\Service\Entities\BookingModule\BookingIgnore;
use Modules\Service\Entities\Review\Review;
use Modules\Service\Entities\ServiceManagement\Service;
use Modules\Service\Entities\TransactionModule\Transaction;

class Provider extends Authenticatable
{
    use Notifiable;
    use HasFactory;
    use SoftDeletes;

    protected $table = 'service_providers';

    protected $casts = [
        'module_id' => 'integer',
        'zone_id' => 'integer',
        'wallet_balance' => 'float',
        'loyalty_point' => 'float',
        'login_hit_count' => 'integer',
        'order_count' => 'integer',
        'service_man_count' => 'integer',
        'service_capacity_per_day' => 'integer',
        'rating_count' => 'integer',
        'avg_rating' => 'float',
        'commission_status' => 'integer',
        'commission_percentage' => 'float',
        'is_active' => 'integer',
        'is_approved' => 'integer',
        'coordinates' => 'json'
    ];

    protected $fillable = [
        'module_id',
        'zone_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'password',
        'image',
        'logo',
        'cover_image',
        'meta_image',
        'identification_image',
        'address',
        'coordinates',
        'commission_status',
        'commission_percentage',
        'is_active',
        'is_approved',
        'service_capacity_per_day',
        'service',
        'remember_token',
    ];

    protected $hidden = [
        'password',
        'auth_token',
        'remember_token',
    ];

    protected $appends = ['logo_full_path','cover_image_full_path'];

    public function getIsValidSubscriptionAttribute(): mixed
    {
        if( $this->business_model == 'subscription' && isset($this->store_sub)){
            return (int)   1 ;
            unset($this->store_sub);
        }
        return 0;
    }

    public function scopeOfStatus($query, $status)
    {
        $query->where('is_active', '=', $status);
    }

    public function scopeOfApproval($query, $status)
    {
        $query->where('is_approved', '=', $status);
    }

    public function scopeModule($query, $module_id)
    {
        return $query->where('module_id', $module_id);
    }

    /* public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id')->where('user_type', 'provider-admin');
    } */

    public function zone(): BelongsTo
    {
        return $this->belongsTo(Zone::class, 'zone_id');
    }

    public function bank_detail(): HasOne
    {
        return $this->hasOne(BankDetail::class, 'provider_id');
    }

    public function account(): HasOne
    {
        return $this->hasOne(UserAccount::class, 'user_id', 'id')->where('user_type', PROVIDER);
    }

    public function bookings($booking_status = null): HasMany
    {
        if ($booking_status == null) {
            return $this->hasMany(Booking::class, 'provider_id');
        }

        return $this->hasMany(Booking::class, 'provider_id')->where('booking_status', $booking_status);
    }

    public function favorites(): HasMany
    {
        return $this->hasMany(FavoriteProvider::class, 'provider_id', 'id');
    }

    public function subscribed_services(): HasMany
    {
        return $this->hasMany(SubscribedService::class, 'provider_id')->where('is_subscribed', 1);
    }

    public function servicemen(): HasMany
    {
        return $this->hasMany(Serviceman::class, 'service_provider_id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'provider_id', 'id');
    }

    public function storage()
    {
        return $this->morphOne(Storage::class, 'data');
    }

    public function transactions_for_from_user(): HasMany
    {
        return $this->hasMany(Transaction::class, 'from_user_id')->where('from_user_type', PROVIDER);
    }

    public function packageSubscriptions()
    {
        return $this->hasOne(PackageSubscriber::class);
    }
    public function ignoredBookings()
    {
        return $this->hasMany(BookingIgnore::class);
    }

    public function getLogoFullPathAttribute()
    {
        $image = $this->logo;
        $defaultPath =  asset('public/assets/admin/img/160x160/img1.jpg');

        if (!$image) {
            if (request()->is('api/*')) {
                $defaultPath = null;
            }
            return $defaultPath;
        }

        $s3Storage = $this->storage;
        $path = 'provider/logo/';
        $imagePath = $path . $image;

        return getSingleImageFullPath(imagePath: $imagePath, s3Storage: $s3Storage, defaultPath: $defaultPath);
    }
    public function getCoverImageFullPathAttribute()
    {
        $image = $this->cover_image;
        $defaultPath =  asset('public/assets/admin/img/160x160/img1.jpg');

        if (!$image) {
            if (request()->is('api/*')) {
                $defaultPath = null;
            }
            return $defaultPath;
        }

        $s3Storage = $this->storage;
        $path = 'provider/cover-image/';
        $imagePath = $path . $image;

        return getSingleImageFullPath(imagePath: $imagePath, s3Storage: $s3Storage, defaultPath: $defaultPath);
    }

    public function getMetaImageFullUrlAttribute()
    {
        $image = $this->meta_image;
        $defaultPath =  asset('public/assets/admin/img/160x160/img1.jpg');

        if (!$image) {
            if (request()->is('api/*')) {
                $defaultPath = null;
            }
            return $defaultPath;
        }

        $s3Storage = $this->storage;
        $path = 'provider/meta-image/';
        $imagePath = $path . $image;

        return getSingleImageFullPath(imagePath: $imagePath, s3Storage: $s3Storage, defaultPath: $defaultPath);
    }

    public function getIdentificationImagesAttribute()
    {
        $images = $this->identification_image;
        if (is_string($images)) {
            $images = json_decode($images, true);
        }
        if (is_array($images)) {
            return array_map(function ($image) {
                return getSingleImageFullPath(imagePath: 'provider/identity/' . $image['image'], s3Storage: $this->storage);
            }, $images);
        }
        return [];
    }



    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function translations(): MorphMany
    {
        return $this->morphMany(Translation::class, 'translationable');
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
            if ($model->isDirty('zone_id')) {
                DB::table('service_subscribed_services')->where(['provider_id' => $model->id])->update(['is_subscribed' => 0]);
            }
        });

        self::updated(function ($model) {
            // ... code here
        });

        self::deleting(function ($model) {
            // ... code here
        });

        self::deleted(function ($model) {
            $model->servicemen->each(function ($serviceman) {
                $serviceman->update(['is_active' => 0]);
            });
        });

        static::saved(function ($model) {
            $storageType = getDisk();
            if($model->isDirty('logo') && $storageType != 'public'){
                saveSingleImageDataToStorage(model: $model, modelColumn : 'logo', storageType : $storageType);
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


    public function store_sub(): HasOne
    {
        return $this->hasOne(StoreSubscription::class, 'store_id', 'id')->where('store_type', 'service_provider')->where('status',1)->latestOfMany();
    }
    public function store_sub_update_application(): HasOne
    {
        return $this->hasOne(StoreSubscription::class, 'store_id', 'id')->where('store_type', 'service_provider')->latestOfMany();
    }
    public function store_sub_trans(): HasOne
    {
        return $this->hasOne(SubscriptionTransaction::class, 'store_id', 'id')->where('store_type', 'service_provider')->latest();
    }
    public function store_all_sub_trans(): HasMany
    {
        return $this->hasMany(SubscriptionTransaction::class,'store_id', 'id')->where('store_type', 'service_provider')->latest();
    }
    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }
    public function schedules(): HasMany
    {
        return $this->hasMany(ProviderSchedule::class, 'service_provider_id', 'id')->orderBy('opening_time');
    }

    public function getLatitudeAttribute() {
        return $this->coordinates['latitude'] ?? null;
    }

    public function getLongitudeAttribute() {
        return $this->coordinates['longitude'] ?? null;
    }

    public static function active_subscription($id) {
        return StoreSubscription::where('store_id', $id)
                ->where('store_type', 'service_provider')
                ->where('status', 1)
                ->where('is_canceled', 0)
                ->where('expiry_date', '>=', now())
                ->first();
    }
}
