<?php

namespace Modules\RideShare\Interface\TripManagement\Repository;

use Modules\RideShare\Interface\BaseRepositoryInterface;

interface RejectedDriverRequestRepositoryInterface extends BaseRepositoryInterface
{
    function store(array $attributes): mixed;
    function destroyData(array $attributes): mixed;
}
