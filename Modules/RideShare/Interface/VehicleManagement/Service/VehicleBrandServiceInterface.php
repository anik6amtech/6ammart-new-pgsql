<?php

namespace Modules\RideShare\Interface\VehicleManagement\Service;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\RideShare\Interface\BaseServiceInterface;

interface VehicleBrandServiceInterface extends BaseServiceInterface
{
    public function export(array $criteria = [], array $relations = [], array $orderBy = [], int $limit = null, int $offset = null, array $withCountQuery = []): Collection|LengthAwarePaginator|\Illuminate\Support\Collection;
}
