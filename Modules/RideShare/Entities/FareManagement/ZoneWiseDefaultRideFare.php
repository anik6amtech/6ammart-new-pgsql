<?php

namespace Modules\RideShare\Entities\FareManagement;

use App\Models\Zone;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ZoneWiseDefaultRideFare extends Model
{
    use HasFactory;

    protected $fillable = [
        'zone_id',
        'base_fare',
        'base_fare_per_km',
        'waiting_fee_per_min',
        'cancellation_fee_percent',
        'min_cancellation_fee',
        'idle_fee_per_min',
        'ride_delay_fee_per_min',
        'penalty_fee_for_cancel',
        'fee_add_to_next',
        'category_wise_different_fare',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'base_fare'=>'double',
        'base_fare_per_km'=>'double',
        'waiting_fee_per_min'=>'double',
        'cancellation_fee_percent'=>'double',
        'min_cancellation_fee'=>'double',
        'idle_fee_per_min'=>'double',
        'ride_delay_fee_per_min'=>'double',
        'penalty_fee_for_cancel'=>'double',
        'fee_add_to_next'=>'double',
        'category_wise_different_fare'=>'integer'
    ];
    public function zone()
    {
        return $this->belongsTo(Zone::class, 'zone_id');
    }

    public function tripFares(): HasMany
    {
        return $this->hasMany(RideFare::class,'zone_wise_default_ride_fare_id');
    }
}
