<?php

namespace Modules\RideShare\Service\TripManagement;

use Modules\RideShare\Interface\TripManagement\Repository\TempTripNotificationRepositoryInterface;
use Modules\RideShare\Interface\TripManagement\Service\TempTripNotificationServiceInterface;
use Modules\RideShare\Service\BaseService;

class TempTripNotificationService extends BaseService implements TempTripNotificationServiceInterface
{
    protected $tempTripNotificationRepository;

    
    public function __construct(TempTripNotificationRepositoryInterface $tempTripNotificationRepository)
    {
        parent::__construct($tempTripNotificationRepository);
        $this->tempTripNotificationRepository = $tempTripNotificationRepository;
    }
    
    public function get(array $attributes)
    {
        return $this->tempTripNotificationRepository->get(attributes: $attributes);
    }

    // Add your specific methods related to TempTripNotificationService here
    public function getData(array $data = []): mixed
    {
        return $this->tempTripNotificationRepository->getData(criteria: $data, orderBy: ['id' => 'desc'], whereNotInCriteria: ['user_id', [auth('delivery_men')->id()]]);
    }

    public function createMany(array $data): mixed
    {
        return $this->tempTripNotificationRepository->createMany(data: $data);
    }
}
