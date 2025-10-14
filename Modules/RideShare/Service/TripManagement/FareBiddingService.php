<?php

namespace Modules\RideShare\Service\TripManagement;


use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Modules\RideShare\Interface\TripManagement\Repository\FareBiddingRepositoryInterface;
use Modules\RideShare\Interface\TripManagement\Service\FareBiddingServiceInterface;
use Modules\RideShare\Service\BaseService;

class FareBiddingService extends BaseService implements FareBiddingServiceInterface
{
    protected $fareBiddingRepository;

    public function __construct(FareBiddingRepositoryInterface $fareBiddingRepository)
    {
        parent::__construct($fareBiddingRepository);
        $this->fareBiddingRepository = $fareBiddingRepository;
    }
    public function get(int $limit, int $offset, bool $dynamic_page = false, array $except = [], array $attributes = [], array $relations = []): LengthAwarePaginator|array|Collection
    {
        return $this->fareBiddingRepository->get($limit, $offset, $dynamic_page, $except, $attributes, $relations);
    }
    
    public function updateBy(array $criteria, array $data = []){
        $this->fareBiddingRepository->updateBy($criteria,$data);
    }
    // Add your specific methods related to FareBiddingService here


    public function getWithAvg(array $criteria = [], array $searchCriteria = [], array $whereInCriteria = [], array $relations = [], array $orderBy = [], int $limit = null, int $offset = null, bool $onlyTrashed = false, bool $withTrashed = false, array $withCountQuery = [], array $withAvgRelation = [],array $whereBetweenCriteria = []): Collection|LengthAwarePaginator
    {
        return $this->fareBiddingRepository->getWithAvg( $criteria ,  $searchCriteria ,  $searchCriteria ,  $relations ,  $orderBy ,  $limit ,  $offset ,  $onlyTrashed ,  $withTrashed ,  $withCountQuery ,  $withAvgRelation );
    }

    public function destroyData($attributes): mixed
    {
        return $this->fareBiddingRepository->destroyData($attributes);
    }
}
