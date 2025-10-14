<?php

namespace Modules\RideShare\Interface\ReviewModule\Service;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\RideShare\Interface\BaseServiceInterface;

interface ReviewServiceInterface extends BaseServiceInterface
{
    public function export($id, $reviewed, $request , $type): Collection|LengthAwarePaginator|\Illuminate\Support\Collection;
    public function apiReviewStore($user,$tripRequest,array $data);

    public function getWithAvg(array $criteria = [], array $searchCriteria = [], array $whereInCriteria = [], array $relations = [], array $orderBy = [], int $limit = null, int $offset = null, bool $onlyTrashed = false, bool $withTrashed = false, array $withCountQuery = [],array $whereBetweenCriteria = []): Collection|LengthAwarePaginator;
}
