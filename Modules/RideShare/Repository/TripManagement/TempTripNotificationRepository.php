<?php

namespace Modules\RideShare\Repository\TripManagement;

use Modules\RideShare\Entities\TripManagement\TempRideNotification;
use Modules\RideShare\Interface\TripManagement\Repository\TempTripNotificationRepositoryInterface;
use Modules\RideShare\Repository\BaseRepository;

class TempTripNotificationRepository extends BaseRepository implements TempTripNotificationRepositoryInterface
{
    public function __construct(TempRideNotification $model)
    {
        parent::__construct($model);
    }

    public function get(array $attributes)
    {
        return $this->model->query()
            ->when(array_key_exists('ride_request_id', $attributes), function ($query) use ($attributes){
                $query->where('ride_request_id', $attributes['ride_request_id']);
            })
            ->when(array_key_exists('relations', $attributes), fn($query) => $query->with($attributes['relations']))
            ->when(array_key_exists('whereNotInColumn', $attributes), function ($query) use($attributes){
                $query->whereNotIn($attributes['whereNotInColumn'], $attributes['whereNotInValue']);
            })
            ->get();
    }

    public function getData(array $criteria = [], array $relations = [], array $orderBy = [], array $whereNotInCriteria = []): mixed
    {
        $query = $this->model->where($criteria)
            ->with($relations);

        // Handle ordering properly
        if (!empty($orderBy)) {
            foreach ($orderBy as $column => $direction) {
                $query->orderBy($column, $direction); // Separate column and direction
            }
        }

        // Handle whereNotIn criteria properly
        if (!empty($whereNotInCriteria) && count($whereNotInCriteria) === 2) {
            $query->whereNotIn($whereNotInCriteria[0], $whereNotInCriteria[1]);
        }

        return $query->get();
    }
}
