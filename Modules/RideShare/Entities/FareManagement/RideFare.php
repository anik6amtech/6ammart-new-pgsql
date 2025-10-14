<?php

namespace Modules\RideShare\Entities\FareManagement;

use App\Models\RiderVehicleCategory;
use App\Models\Zone;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RideFare extends Model
{
    use HasFactory;

    protected $fillable = [
        'zone_wise_default_ride_fare_id',
        'zone_id',
        'vehicle_category_id',
        'base_fare',
        'base_fare_per_km',
        'waiting_fee_per_min',
        'cancellation_fee_percent',
        'min_cancellation_fee',
        'idle_fee_per_min',
        'ride_delay_fee_per_min',
        'penalty_fee_for_cancel',
        'fee_add_to_next',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'cancellation_fee_percent' => 'float',
        'base_fare' => 'float',
        'base_fare_per_km' => 'float',
        'waiting_fee_per_min' => 'float',
        'min_cancellation_fee' => 'float',
        'idle_fee_per_min' => 'float',
        'ride_delay_fee_per_min' => 'float',
        'penalty_fee_for_cancel' => 'float',
        'fee_add_to_next' => 'float',
    ];

    public function zone()
    {
        return $this->belongsTo(Zone::class, 'zone_id');
    }

    public function vehicleCategory()
    {
        return $this->belongsTo(RiderVehicleCategory::class, 'vehicle_category_id');
    }

    public function defaultFare(): BelongsTo
    {
        return $this->belongsTo(ZoneWiseDefaultRideFare::class, 'zone_wise_default_ride_fare_id');
    }
}
