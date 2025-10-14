<?php

namespace Modules\RideShare\Interface\TripManagement\Service;

use Modules\RideShare\Interface\BaseServiceInterface;

interface TempTripNotificationServiceInterface extends BaseServiceInterface
{
    public function getData(array $data = []): mixed;

    public function createMany(array $data): mixed;

    public function get(array $attributes);
    // public function store($attributes);

    // public function ignoreNotification(array $attributes);
}
