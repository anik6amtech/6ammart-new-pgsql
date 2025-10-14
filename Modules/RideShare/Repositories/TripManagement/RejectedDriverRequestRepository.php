<?php

namespace Modules\RideShare\Repositories\TripManagement;

use Modules\RideShare\Entities\TripManagement\RejectedDriverRequest;

class RejectedDriverRequestRepository
{
    public function __construct(private RejectedDriverRequest $request)
    {
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    function store(array $attributes): mixed
    {
        $rejectedRequest = $this->request;
        $rejectedRequest->ride_request_id = $attributes['ride_request_id'];
        $rejectedRequest->user_id = $attributes['user_id'];
        $rejectedRequest->save();

        return $rejectedRequest;
    }


    /**
     * @param $attributes
     * @return mixed
     */
    public function destroyData($attributes): mixed
    {
        return $this->request
            ->query()
            ->where($attributes['column'], $attributes['value'])
            ->delete();
    }
}
