<?php

namespace Modules\RideShare\Repository\UserManagement;

use Modules\RideShare\Entities\UserManagement\UserLastLocation;
use Modules\RideShare\Interface\UserManagement\Repository\UserLastLocationRepositoryInterface;
use Modules\RideShare\Repository\BaseRepository;

class UserLastLocationRepository extends BaseRepository implements UserLastLocationRepositoryInterface
{
    public function __construct(UserLastLocation $model)
    {
        parent::__construct($model);
    }

    public function getNearestDrivers($attributes): mixed
    {
        return $this->model
            ->selectRaw("* ,( 6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude)
            - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance",
                [$attributes['latitude'], $attributes['longitude'], $attributes['latitude']])
            ->where('type', 'driver')
            ->where('zone_id', $attributes['zone_id'])
            ->having('distance', '<', $attributes['radius'])
            ->with(['driver.rider_vehicle.category', 'driverDetails', 'driver'])
            ->whereHas('driver', fn($query) => $query->where('status', true))
            ->whereHas('driverDetails', fn($query) => $query->where('is_online', true)
                ->whereNotIn('availability_status', ['unavailable', 'on_trip'])
            )
            ->whereHas('driver.rider_vehicle', fn($query) => $query->where('is_active', true))
            ->when(array_key_exists('vehicle_category_id', $attributes), function ($query) use ($attributes) {
                $query->whereHas('driver.rider_vehicle', fn($query) => $query->ofStatus(1)->where('category_id', $attributes['vehicle_category_id']));
            })
            ->when(array_key_exists('service', $attributes),
                fn($query) => $query->whereHas('driverDetails',
                    fn($query) => $query->where(fn($query) => $query->whereNull('service')
                        ->orWhere(fn($query) => $query->whereNotNull('service')
                            ->whereJsonContains('service', $attributes['service'])
                        )
                    )
                )
            )
            // ->when($attributes['parcel_weight_capacity'] ?? null,
            //     fn($query) => $query->whereHas('driverDetails',
            //         fn($query) => $query->where(fn($query) => $query->whereNull('service')
            //             ->orWhere(fn($query) => $query->whereNotNull('service')
            //                 ->whereJsonContains('service', 'parcel')
            //             )
            //         )
            //     )->whereHas('user.rider_vehicle',
            //         fn($query) => $query->whereNull('parcel_weight_capacity')
            //             ->orWhere('parcel_weight_capacity', '>=', $attributes['parcel_weight_capacity'])
            //     )
            // )
            ->orderBy('distance')
            ->get();
    }
}
