<?php

namespace Modules\RideShare\Repository\TripManagement;

use Modules\RideShare\Entities\TripManagement\RejectedDriverRequest;
use Modules\RideShare\Interface\TripManagement\Repository\RejectedDriverRequestRepositoryInterface;
use Modules\RideShare\Repository\BaseRepository;

class RejectedDriverRequestRepository extends BaseRepository implements RejectedDriverRequestRepositoryInterface
{
    public function __construct(RejectedDriverRequest $model)
    {
        parent::__construct($model);
    }

    function store(array $attributes): mixed
    {
        $rejectedRequest = $this->model;
        $rejectedRequest->ride_request_id = $attributes['ride_request_id'];
        $rejectedRequest->user_id = $attributes['user_id'];
        $rejectedRequest->save();

        return $rejectedRequest;
    }

    public function destroyData($attributes): mixed
    {
        return $this->model
            ->query()
            ->where($attributes['column'], $attributes['value'])
            ->delete();
    }


}
