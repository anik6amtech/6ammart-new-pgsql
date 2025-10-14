<?php

namespace Modules\RideShare\Repositories\TripManagement;

use Modules\RideShare\Entities\TripManagement\TempRideNotification;

class TempTripNotificationRepository
{
    public function __construct(
        private TempRideNotification $notification
    )
    {
    }

    public function get(array $attributes)
    {
        return $this->notification->query()
            ->when(array_key_exists('ride_request_id', $attributes), function ($query) use ($attributes){
                $query->where('ride_request_id', $attributes['ride_request_id']);
            })
            ->when(array_key_exists('relations', $attributes), fn($query) => $query->with($attributes['relations']))
            ->when(array_key_exists('whereNotInColumn', $attributes), function ($query) use($attributes){
                $query->whereNotIn($attributes['whereNotInColumn'], $attributes['whereNotInValue']);
            })
            ->get();
    }

    public function getBy(array $attributes)
    {
        return $this->notification->query()
            ->where('ride_request_id', $attributes['ride_request_id'])
            ->where('user_id', $attributes['user_id'])
            ->first();
    }

    public function store($attributes)
    {
        return $this->notification->query()
            ->insert($attributes['data']);
    }

    public function delete($ride_request_id)
    {
        return $this->notification->query()
            ->where('ride_request_id', $ride_request_id)
            ->delete();
    }

    public function ignoreNotification(array $attributes)
    {
        return $this->notification->query()
            ->where('ride_request_id', $attributes['ride_request_id'])
            ->where('user_id', $attributes['user_id'])
            ->first()
            ->delete();
    }


}
