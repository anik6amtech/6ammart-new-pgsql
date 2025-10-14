<?php

namespace Modules\RideShare\Service\ReviewModule;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\RideShare\Interface\ReviewModule\Repository\ReviewRepositoryInterface;
use Modules\RideShare\Interface\ReviewModule\Service\ReviewServiceInterface;
use Modules\RideShare\Service\BaseService;

class ReviewService extends BaseService implements ReviewServiceInterface
{
    protected $reviewRepository;

    public function __construct(ReviewRepositoryInterface $reviewRepository)
    {
        parent::__construct($reviewRepository);
        $this->reviewRepository = $reviewRepository;
    }

    public function index(array $criteria = [], array $relations = [], array $whereHasRelations = [], array $orderBy = [], int $limit = null, int $offset = null, array $withCountQuery = [], array $appends = [], array $groupBy = [], bool $allModule=false): Collection|LengthAwarePaginator
    {
        $data = $criteria;
        unset($data['status']);
        if (array_key_exists('status', $criteria) && $criteria['status'] !== 'all') {
            $data['is_active'] = $criteria['status'] == 'active' ? 1 : 0;
        }
        $searchData = [];
        if (array_key_exists('search', $criteria) && $criteria['search'] != '') {
            $searchData['fields'] = ['name'];
            $searchData['value'] = $criteria['search'];
        }
        $whereInCriteria = [];
        $whereBetweenCriteria = [];
        $whereHasRelations = [];
        return $this->reviewRepository->getBy(criteria: $data, searchCriteria: $searchData, whereInCriteria: $whereInCriteria, whereBetweenCriteria: $whereBetweenCriteria, whereHasRelations: $whereHasRelations, relations: $relations, orderBy: $orderBy, limit: $limit, offset: $offset, withCountQuery: $withCountQuery,appends: $appends);
    }

    public function export($id, $reviewed, $request, $type): Collection|LengthAwarePaginator|\Illuminate\Support\Collection
    {
        $criteria = [];
        if ($type === 'driver') {
            if ($reviewed == 'customer') {
                $criteria['received_by'] = $id;
            } elseif ($reviewed == 'driver') {
                $criteria['given_by'] = $id;
            }
            return $this->index(criteria: $criteria,orderBy: ['created_at'=>'desc'])->map(function ($item) {
                return [
                    'Trip Id' => $item?->trip?->ref_id,
                    'Reviewer' => $item?->givenUser?->first_name . ' ' . $item?->givenUser?->last_name,
                    'Rating' => $item['rating'],
                    'Review' => $item['feedback'],
                ];
            });
        }

        if ($reviewed == 'customer') {
            $criteria['given_by'] = $id;
        } elseif ($reviewed == 'driver') {
            $criteria['received_by'] = $id;
        }
        return $this->index(criteria: $criteria,orderBy: ['created_at'=>'desc'])->map(function ($item) {
            return [
                'Id' => $item['id'],
                'Trip Id' => $item?->trip?->ref_id,
                'Reviewer' => $item?->givenUser?->first_name . ' ' . $item?->givenUser?->last_name,
                'Rating' => $item['rating'],
                'Review' => $item['feedback'],
            ];
        });
    }


    public function apiReviewStore($user, $tripRequest, array $data)
    {
        $given_by = $user == 'driver' ? $tripRequest->driver_id : $tripRequest->customer_id;
        $received_by = $user == 'driver' ? $tripRequest->customer_id : $tripRequest->driver_id;
        $given_for = $user == 'driver' ? CUSTOMER : DRIVER;

        $data = array_merge($data, [
            'given_by' => $given_by,
            'received_by' => $received_by,
            'review_for' => $given_for,
            'ride_type' => $tripRequest->type,
            'ride_request_id' => $tripRequest->id,
        ]);
        $this->reviewRepository->create(data: $data);
    }



    public function getWithAvg(array $criteria = [], array $searchCriteria = [], array $whereInCriteria = [], array $relations = [], array $orderBy = [], int $limit = null, int $offset = null, bool $onlyTrashed = false, bool $withTrashed = false, array $withCountQuery = [], array $withAvgRelation = [], array $whereBetweenCriteria = []): Collection|LengthAwarePaginator
    {

       return  $this->reviewRepository->getWithAvg(criteria:$criteria,searchCriteria: $searchCriteria,whereInCriteria: $whereInCriteria,relations: $relations,orderBy: $orderBy,limit: $limit,offset: $offset,onlyTrashed: $onlyTrashed,withTrashed: $withTrashed,whereBetweenCriteria: $whereBetweenCriteria);


    }
}
