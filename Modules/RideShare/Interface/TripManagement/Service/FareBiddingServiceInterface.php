<?php

namespace Modules\RideShare\Interface\TripManagement\Service;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Modules\RideShare\Interface\BaseServiceInterface;

interface FareBiddingServiceInterface extends BaseServiceInterface
{
    public function updateBy(array $criteria, array $data = []);

    public function getWithAvg(array $criteria = [], array $searchCriteria = [], array $whereInCriteria = [], array $relations = [], array $orderBy = [], int $limit = null, int $offset = null, bool $onlyTrashed = false, bool $withTrashed = false, array $withCountQuery = [], array $withAvgRelation = [],array $whereBetweenCriteria = []): Collection|LengthAwarePaginator;

    public function get(int $limit, int $offset, bool $dynamic_page = false, array $except = [], array $attributes = [], array $relations = []): LengthAwarePaginator|array|Collection;

    function destroyData($attributes): mixed;
}
