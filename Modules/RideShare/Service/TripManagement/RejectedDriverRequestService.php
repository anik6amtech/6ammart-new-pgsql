<?php

namespace Modules\RideShare\Service\TripManagement;

use Modules\RideShare\Interface\TripManagement\Repository\RejectedDriverRequestRepositoryInterface;
use Modules\RideShare\Interface\TripManagement\Service\RejectedDriverRequestServiceInterface;
use Modules\RideShare\Service\BaseService;

class RejectedDriverRequestService extends BaseService implements RejectedDriverRequestServiceInterface
{
    protected $rejectedDriverRequestRepository;

    public function __construct(RejectedDriverRequestRepositoryInterface $rejectedDriverRequestRepository)
    {
        parent::__construct($rejectedDriverRequestRepository);
        $this->rejectedDriverRequestRepository = $rejectedDriverRequestRepository;
    }

    // Add your specific methods related to RejectedDriverRequestService here

    function store(array $attributes): mixed
    {
        return $this->rejectedDriverRequestRepository->store($attributes);
    }


    public function destroyData($attributes): mixed
    {
        return $this->rejectedDriverRequestRepository->destroyData($attributes);
    }
}
