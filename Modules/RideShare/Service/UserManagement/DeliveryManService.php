<?php

namespace Modules\RideShare\Service\UserManagement;

use Modules\RideShare\Interface\UserManagement\Repository\DeliveryManRepositoryInterface;
use Modules\RideShare\Interface\UserManagement\Service\DeliveryManServiceInterface;
use Modules\RideShare\Service\BaseService;

class DeliveryManService extends BaseService implements DeliveryManServiceInterface
{
    protected $deliveryManRepository;

    public function __construct(DeliveryManRepositoryInterface $deliveryManRepository)
    {
        parent::__construct($deliveryManRepository);
        $this->deliveryManRepository = $deliveryManRepository;
    }

}
