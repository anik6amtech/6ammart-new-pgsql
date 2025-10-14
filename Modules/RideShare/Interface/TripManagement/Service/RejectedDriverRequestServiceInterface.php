<?php

namespace Modules\RideShare\Interface\TripManagement\Service;

use Modules\RideShare\Interface\BaseServiceInterface;

interface RejectedDriverRequestServiceInterface extends BaseServiceInterface
{
    function store(array $attributes): mixed;
    function destroyData(array $attributes): mixed;
}
