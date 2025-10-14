<?php

namespace Modules\RideShare\Repository\UserManagement;

use Modules\RideShare\Entities\UserManagement\TimeTrack;
use Modules\RideShare\Interface\UserManagement\Repository\TimeTrackRepositoryInterface;
use Modules\RideShare\Repository\BaseRepository;

class TimeTrackRepository extends BaseRepository implements TimeTrackRepositoryInterface
{
    public function __construct(TimeTrack $model)
    {
        parent::__construct($model);
    }
}
