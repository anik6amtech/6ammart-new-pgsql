<?php

namespace Modules\RideShare\Interface\TripManagement\Repository;

use Modules\RideShare\Interface\BaseRepositoryInterface;

interface TempTripNotificationRepositoryInterface extends BaseRepositoryInterface
{
    public function getData(array $criteria = [], array $relations = [], array $orderBy = [], array $whereNotInCriteria = []): mixed;
    public function get(array $attributes);
    // public function store($attributes);

    // public function ignoreNotification(array $attributes);
}
