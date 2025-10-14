<?php

namespace App\Models;

use App\CentralLogics\Helpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class RiderVehicle extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'ref_id',
        'brand_id',
        'model_id',
        'category_id',
        'licence_plate_number',
        'licence_expire_date',
        'vin_number',
        'transmission',
        'parcel_weight_capacity',
        'fuel_type',
        'ownership',
        'rider_id',
        'documents',
        'is_active',
        'deleted_at',
        'created_at',
        'updated_at',
        'vehicle_request_status',
        'deny_note',
        'draft'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'licence_expire_date' => 'date',
        'documents' => 'array',
        'is_active' => 'boolean',
        'vehicle_request_status' => 'string',
        'draft' => 'array'
    ];

    protected $appends = ['documents_full_url'];

    public function translations()
    {
        return $this->morphMany(Translation::class, 'translationable');
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

    protected function scopeOfStatus($query, $status=1)
    {
        $query->where('is_active', $status);
    }

    public function brand()
    {
        return $this->belongsTo(RiderVehicleBrand::class, 'brand_id');
    }

    public function model()
    {
        return $this->belongsTo(RiderVehicleModel::class, 'model_id');
    }

    public function category()
    {
        return $this->belongsTo(RiderVehicleCategory::class, 'category_id');
    }

    public function driver()
    {
        return $this->belongsTo(DeliveryMan::class, 'rider_id');
    }

    public function tripFares()
    {
        // return $this->hasMany(TripFare::class, 'vehicle_category_id');
    }

    public function storage()
    {
        return $this->morphMany(Storage::class, 'data');
    }


    public function getDocumentsFullUrlAttribute(): array
    {
        $images = [];
        $value = is_array($this->documents)
            ? $this->documents
            : ($this->documents && is_string($this->documents) && $this->isValidJson($this->documents)
                ? json_decode($this->documents, true)
                : []);
        if ($value){
            foreach ($value as $item){
                $item = is_array($item)?$item:(is_object($item) && get_class($item) == 'stdClass' ? json_decode(json_encode($item), true):['img' => $item, 'storage' => 'public']);
                $images[] = Helpers::get_full_url('vehicle',$item['img'],$item['storage']);
            }
        }

        return $images;
    }

    private function isValidJson($string): bool
    {
        json_decode($string);
        return (json_last_error() === JSON_ERROR_NONE);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($item){
            $item->ref_id = (static::withTrashed()->max('ref_id') ?? 100000) + 1;
        });

    }

    protected static function booted()
    {
        static::addGlobalScope('storage', function ($builder) {
            $builder->with('storage');
        }); 

        static::addGlobalScope('translate', function (Builder $builder) {
            $builder->with(['translations' => function ($query) {
                return $query->where('locale', app()->getLocale());
            }]);
        });
    }
}

