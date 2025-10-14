<?php

namespace Modules\RideShare\Service\UserManagement;

use Modules\RideShare\Interface\UserManagement\Repository\TimeTrackRepositoryInterface;
use Modules\RideShare\Interface\UserManagement\Service\TimeTrackServiceInterface;
use Modules\RideShare\Service\BaseService;

class TimeTrackService extends BaseService implements TimeTrackServiceInterface
{
    protected $timeTrackRepository;

    public function __construct(TimeTrackRepositoryInterface $timeTrackRepository)
    {
        parent::__construct($timeTrackRepository);
        $this->timeTrackRepository = $timeTrackRepository;
    }

    // Add your specific methods related to TimeTrackService here
}
