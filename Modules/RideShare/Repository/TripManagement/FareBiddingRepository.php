<?php

namespace Modules\RideShare\Repository\TripManagement;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\RideShare\Entities\TripManagement\FareBidding;
use Modules\RideShare\Interface\TripManagement\Repository\FareBiddingRepositoryInterface;
use Modules\RideShare\Repository\BaseRepository;

class FareBiddingRepository extends BaseRepository implements FareBiddingRepositoryInterface
{
    public function __construct(FareBidding $model)
    {
        parent::__construct($model);
    }


    public function updateBy(array $criteria, array $data = []): ?Model
    {
        $resource = $this->model->where($criteria)->first();

        if ($resource) {
            if (is_array($data) && count($data) > 0) {
                $resource->fill($data)->save();
            }
            return $resource;
        }

        return null;
    }




    public function getWithAvg(array $criteria = [], array $searchCriteria = [], array $whereInCriteria = [], array $relations = [], array $orderBy = [], int $limit = null, int $offset = null, bool $onlyTrashed = false, bool $withTrashed = false, array $withCountQuery = [], array $withAvgRelation = [], array $whereBetweenCriteria = []): Collection|LengthAwarePaginator
    {
        $model = $this->prepareModelForRelationAndOrder(relations: $relations, orderBy: $orderBy)
            ->when(!empty($criteria), function ($whereQuery) use ($criteria) {
                $whereQuery->where($criteria);
            })->when(!empty($whereInCriteria), function ($whereInQuery) use ($whereInCriteria) {
                foreach ($whereInCriteria as $column => $values) {
        $whereInQuery->whereIn($column, $values);
    }
            })->when(!empty($searchCriteria), function ($whereQuery) use ($searchCriteria) {
                $this->searchQuery($whereQuery, $searchCriteria);
            })->when(($onlyTrashed || $withTrashed), function ($query) use ($onlyTrashed, $withTrashed) {
                $this->withOrWithOutTrashDataQuery($query, $onlyTrashed, $withTrashed);
            })
            ->when(!empty($withCountQuery), function ($query) use ($withCountQuery) {
                $this->withCountQuery($query, $withCountQuery);
            })
            ->when(!empty($whereBetweenCriteria), function ($whereQuery) use ($whereBetweenCriteria) {
                foreach ($whereBetweenCriteria as $column => $values) {
                    $whereQuery->whereBetween($column, $values);
                }
            })
            ->when(!empty($withAvgRelation), function ($query) use ($withAvgRelation) {
                $query->withAvg($withAvgRelation[0], $withAvgRelation[1]);
            });
        if ($limit) {
            return !empty($criteria) ? $model->paginate($limit)->appends($criteria) : $model->paginate($limit);
        }
        return $model->get();
    }

    public function get(int $limit, int $offset, bool $dynamic_page = false, array $except = [], array $attributes = [], array $relations = []): LengthAwarePaginator|array|Collection
    {
        $query = $this->model
            ->query()
            ->when(array_key_exists('relations', $attributes), function ($query) use ($attributes){
                $query->with($attributes['relations']);
            })
            ->when(array_key_exists('withAvgRelation', $attributes), function ($query) use($attributes){
                $query->withAvg($attributes['withAvgRelation'], $attributes['withAvgColumn']);
            })
            ->when(array_key_exists('ride_request_id', $attributes), function ($query) use ($attributes){
                $query->where('ride_request_id', $attributes['ride_request_id']);
            })
            ->when(array_key_exists('driver_id', $attributes), function ($query) use ($attributes){
                $query->where('driver_id', $attributes['driver_id']);
            })
            ->when(array_key_exists('customer_id', $attributes), function ($query) use ($attributes){
                $query->where('customer_id', $attributes['customer_id']);
            })
            ->when(array_key_exists('without_ids', $attributes), function ($query) use ($attributes){
                $query->whereNotIn('id', $attributes['without_ids']);
            })
            ->ofIsNotIgnored();

        if($dynamic_page) {
            return $query->paginate(perPage: $limit, page: $offset);
        }
        return $query->get();
    }


    public function destroyData($attributes): mixed
    {
        return $this->model->query()->whereIn($attributes['column'], $attributes['ids'])->delete();
    }

}
