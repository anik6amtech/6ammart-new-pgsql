<?php

namespace Modules\RideShare\Repository\TripManagement;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use MatanYadaev\EloquentSpatial\Objects\Point;
use Modules\RideShare\Entities\TripManagement\RideRequest;
use Modules\RideShare\Interface\TripManagement\Repository\TripRequestRepositoryInterface;
use Modules\RideShare\Repository\BaseRepository;

class TripRequestRepository extends BaseRepository implements TripRequestRepositoryInterface
{
    public function __construct(RideRequest $model)
    {
        parent::__construct($model);
    }

    public function get(int $limit, int $offset, bool $dynamic_page = false, array $except = [], array $attributes = [], array $relations = []): LengthAwarePaginator|array|Collection
    {
        $search = $attributes['search'] ?? null;
        $extraColumn = $attributes['column_name'] ?? null;
        $extraColumnValue = $attributes['column_value'] ?? null;
        $queryParams = ['search' => $search];

        $query = $this->model
            ->query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $keys = explode(' ', $search);
                    foreach ($keys as $key) {
                        $query->where('ref_id', 'like', '%' . $key . '%');
                    }
                });
            })
            ->when(($attributes['relations'] ?? null), fn($query) => $query->with($attributes['relations']))
            ->when(!empty($relations), fn($query) => $query->with($relations))
            ->when($attributes['from'] ?? null,
                fn($query) => $query->whereBetween('created_at', [$attributes['from'], $attributes['to']]))
            ->when($attributes['column'] ?? null,
                fn($query) => $query->where($attributes['column'], $attributes['value']))
            ->when($extraColumn && $extraColumnValue,
                fn($query) => $query->whereIn($extraColumn, $extraColumnValue))
            ->when(($attributes['whereNotInColumn'] ?? null),
                fn($query) => $query->whereNotIn($attributes['whereNotInColumn'], $attributes['whereNotInValue']))
            ->when(($attributes['withAvgRelation'] ?? null),
                fn($query) => $query->withAvg($attributes['withAvgRelation'], $attributes['withAvgColumn']))
            ->when(($attributes['type'] ?? null), fn($query) => $query->type($attributes['type']))
            ->latest();

        if ($dynamic_page) {
            return $query->paginate(perPage: $limit, page: $offset);
        }
        return $query->paginate($limit)
            ->appends($queryParams);
    }


    public function calculateCouponAmount($startDate = null, $endDate = null, $startTime = null, $month = null, $year = null): mixed
    {
        $query = $this->model->whereNotNull('coupon_amount');

        if ($startDate !== null && $endDate !== null) {
            $query->whereBetween('created_at', [
                "{$startDate->format('Y-m-d')} 00:00:00",
                "{$endDate->format('Y-m-d')} 23:59:59"
            ]);
        } elseif ($startTime !== null) {
            $query->whereBetween('created_at', [
                date('Y-m-d', strtotime(TODAY)) . ' ' . date('H:i:s', $startTime),
                date('Y-m-d', strtotime(TODAY)) . ' ' . date('H:i:s', strtotime('+2 hours', $startTime))
            ]);
        } elseif ($month !== null) {
            $query->whereMonth('created_at', $month)
                ->whereYear('created_at', now()->format('Y'));
        } elseif ($year !== null) {
            $query->whereYear('created_at', $year);
        } else {
            $query->whereDay('created_at', now()->format('d'))
                ->whereMonth('created_at', now()->format('m'));
        }

        return $query->sum('coupon_amount');
    }

    public function fetchTripData($dateRange): Collection
    {
        $query = $this->model->whereNotNull('coupon_amount');

        switch ($dateRange) {
            case THIS_WEEK:
                $startDate = Carbon::now()->startOfWeek();
                $endDate = Carbon::now()->endOfWeek();
                $query->whereBetween('created_at', [$startDate, $endDate]);
                break;

            case THIS_MONTH:
                $query->whereYear('created_at', Carbon::now()->year)
                    ->whereMonth('created_at', Carbon::now()->month);
                break;

            case THIS_YEAR:
                $query->whereYear('created_at', Carbon::now()->year);
                break;
            case TODAY:
                $query->whereDate('created_at', Carbon::today());
            default:
                $query;
                break;
        }

        return $query->get();
    }


    public function statusWiseTotalTripRecords(array $attributes): Collection
    {
        return $this->model->query()
            ->when($attributes['from'] ?? null, fn($query) => $query->whereBetween('created_at', [$attributes['from'], $attributes['to']]))
            ->selectRaw('current_status, count(*) as total_records')
            ->groupBy('current_status')->get();
    }


    public function pendingParcelList(array $attributes)
    {
        return $this->model->query()
            ->with([
                'customer', 'driver', 'vehicleCategory', 'vehicleCategory.tripFares', 'vehicle', 'coupon', 'time',
                'coordinate', 'fee', 'tripStatus', 'zone', 'vehicle.model', 'fare_biddings', 'parcel', 'parcelUserInfo'
            ])
            ->where(['type' => 'parcel', $attributes['column'] => $attributes['value']])
            ->when($attributes['whereNotNull'] ?? null, fn($query) => $query->whereNotNull($attributes['whereNotNull']))
            ->whereNotIn('current_status', ['cancelled', 'completed'])
            ->paginate(perPage: $attributes['limit'], page: $attributes['offset']);
    }


    public function updateRelationalTable($attributes): mixed
    {
        $trip = $this->findOne(id: $attributes['value']);

        if ($attributes['trip_status'] ?? null) {
            $tripData['current_status'] = $attributes['trip_status'];

            $trip->update($tripData);
            $trip->tripStatus()->update([
                $attributes['trip_status'] => now()
            ]);
        }
        if ($attributes['driver_id'] ?? null) {
            $trip->driver_id = null;
            $trip->save();
        }

        if ($attributes['coordinate'] ?? null) {
            $trip->coordinate()->update($attributes['coordinate']);
        }
        if ($attributes['fee'] ?? null) {
            $trip->fee()->update($attributes['fee']);
        }
        return $trip->tripStatus;
    }


    public function findOneWithAvg(array $criteria = [], array $relations = [], array $withCountQuery = [], bool $withTrashed = false, bool $onlyTrashed = false, array $withAvgRelation = []): ?Model
    {
        $data = $this->prepareModelForRelationAndOrder(relations: $relations)
            ->where($criteria)
            ->when(!empty($withCountQuery), function ($query) use ($withCountQuery) {
                $this->withCountQuery($query, $withCountQuery);
            })
            ->when(($onlyTrashed || $withTrashed), function ($query) use ($onlyTrashed, $withTrashed) {
                $this->withOrWithOutTrashDataQuery($query, $onlyTrashed, $withTrashed);
            })
            ->when(!empty($withAvgRelation), function ($query) use ($withAvgRelation) {
                $query->withAvg($withAvgRelation[0], $withAvgRelation[1]);
            })
            ->first();
        return $data;
    }


    public function getWithAvg(array $criteria = [], array $searchCriteria = [], array $whereInCriteria = [], array $relations = [], array $orderBy = [], int $limit = null, int $offset = null, bool $onlyTrashed = false, bool $withTrashed = false, array $withCountQuery = [], array $withAvgRelation = [], array $whereBetweenCriteria = [], array $whereNotNullCriteria = []): Collection|LengthAwarePaginator
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
            ->when(!empty($whereNotNullCriteria), function ($whereQuery) use ($whereNotNullCriteria) {
                foreach ($whereNotNullCriteria as $column) {
                    $whereQuery->whereNotNull($column);
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


    public function getPendingRides($attributes): mixed
    {
        return $this->model->query()
            ->when($attributes['relations'] ?? null, fn($query) => $query->with($attributes['relations']))
            ->with([
                'fare_biddings' => fn($query) => $query->where('driver_id', auth('delivery_men')->id()),
                'coordinate' => fn($query) => $query->distanceSphere('pickup_coordinates', $attributes['driver_locations'], $attributes['distance'])
            ])
            ->whereHas('coordinate',
                fn($query) => $query->distanceSphere('pickup_coordinates', $attributes['driver_locations'], $attributes['distance']))
            ->when($attributes['withAvgRelation'] ?? null,
                fn($query) => $query->withAvg($attributes['withAvgRelation'], $attributes['withAvgColumn']))
            ->whereDoesntHave('ignoredRequests', fn($query) => $query->where('user_id', auth('delivery_men')->id()))
            ->where(fn($query) => $query->where('vehicle_category_id', $attributes['vehicle_category_id'])
                ->orWhereNull('vehicle_category_id')
            )
            ->where(['zone_id' => $attributes['zone_id'], 'current_status' => PENDING,])
            ->orderBy('created_at', 'desc')
            ->paginate(perPage: $attributes['limit'], page: $attributes['offset']);
    }

    public function getZoneWiseStatistics(array $criteria = [], array $searchCriteria = [], array $whereInCriteria = [], array $whereBetweenCriteria = [], array $whereHasRelations = [], array $withAvgRelations = [], array $relations = [], array $orderBy = [], int $limit = null, int $offset = null, bool $onlyTrashed = false, bool $withTrashed = false, array $withCountQuery = [], array $appends = []): Collection|LengthAwarePaginator
    {
        $model = $this->prepareModelForRelationAndOrder(relations: $relations, orderBy: $orderBy)
            ->when(!empty($criteria), function ($whereQuery) use ($criteria) {
                $whereQuery->where($criteria);
            })->when(!empty($whereInCriteria), function ($whereInQuery) use ($whereInCriteria) {
                foreach ($whereInCriteria as $column => $values) {
                    $whereInQuery->whereIn($column, $values);
                }
            })->when(!empty($whereHasRelations), function ($whereHasQuery) use ($whereHasRelations) {
                foreach ($whereHasRelations as $relation => $conditions) {
                    $whereHasQuery->whereHas($relation, function ($query) use ($conditions) {
                        $query->where($conditions);
                    });
                }
            })->when(!empty($whereBetweenCriteria), function ($whereBetweenQuery) use ($whereBetweenCriteria) {
                foreach ($whereBetweenCriteria as $column => $range) {
                    $whereBetweenQuery->whereBetween($column, $range);
                }
            })->when(!empty($searchCriteria), function ($whereQuery) use ($searchCriteria) {
                $this->searchQuery($whereQuery, $searchCriteria);
            })->when(($onlyTrashed || $withTrashed), function ($query) use ($onlyTrashed, $withTrashed) {
                $this->withOrWithOutTrashDataQuery($query, $onlyTrashed, $withTrashed);
            })
            ->when(!empty($withCountQuery), function ($query) use ($withCountQuery) {
                $this->withCountQuery($query, $withCountQuery);
            })->when(!empty($withAvgRelations), function ($query) use ($withAvgRelations) {
                foreach ($withAvgRelations as $relation) {
                    $query->withAvg($relation);
                }
            })->whereNotNull('zone_id')
            ->selectRaw('count(completed) as completed_trips,count(cancelled) as cancelled_trips,count(pending) as pending_trips,count(accepted) as accepted_trips,count(ongoing) as ongoing_trips,zone_id, count(*) as total_records')
            ->groupBy('zone_id')->orderBy('total_records', 'asc');
        if ($limit) {
            return !empty($appends) ? $model->paginate($limit)->appends($appends) : $model->paginate($limit);
        }
        return $model->get();
    }

    public function getZoneWiseEarning(array $criteria = [], array $searchCriteria = [], array $whereInCriteria = [], array $whereBetweenCriteria = [], array $whereHasRelations = [], array $withAvgRelations = [], array $relations = [], array $orderBy = [], int $limit = null, int $offset = null, bool $onlyTrashed = false, bool $withTrashed = false, array $withCountQuery = [], array $appends = [], $startDate = null, $endDate = null, $startTime = null, $month = null, $year = null): Collection|LengthAwarePaginator
    {
        $model = $this->prepareModelForRelationAndOrder(relations: $relations, orderBy: $orderBy)
             ->when(!empty($criteria), function ($whereQuery) use ($criteria) {
                $whereQuery->where($criteria);
            })
            /* ->when(!empty($whereInCriteria), function ($whereInQuery) use ($whereInCriteria) {
                foreach ($whereInCriteria as $column => $values) {
                    $whereInQuery->whereIn($column, $values);
                }
            })
            ->when(!empty($whereHasRelations), function ($whereHasQuery) use ($whereHasRelations) {
                foreach ($whereHasRelations as $relation => $conditions) {
                    $whereHasQuery->whereHas($relation, function ($query) use ($conditions) {
                        $query->where($conditions);
                    });
                }
            })
            ->when(!empty($searchCriteria), function ($whereQuery) use ($searchCriteria) {
                $this->searchQuery($whereQuery, $searchCriteria);
            })
            ->when(($onlyTrashed || $withTrashed), function ($query) use ($onlyTrashed, $withTrashed) {
                $this->withOrWithOutTrashDataQuery($query, $onlyTrashed, $withTrashed);
            })
            ->when(!empty($withCountQuery), function ($query) use ($withCountQuery) {
                $this->withCountQuery($query, $withCountQuery);
            })->when(!empty($withAvgRelations), function ($query) use ($withAvgRelations) {
                foreach ($withAvgRelations as $relation) {
                    $query->withAvg($relation);
                }
            }) */;
        if ($startDate !== null && $endDate !== null) {
            $model->whereBetween('created_at', [
                "{$startDate->format('Y-m-d')} 00:00:00",
                "{$endDate->format('Y-m-d')} 23:59:59"
            ]);
        } elseif ($startDate !== null && $startTime !== null) {
            $model->whereBetween('created_at', [
                date('Y-m-d', strtotime($startDate)) . ' ' . date('H:i:s', $startTime),
                date('Y-m-d', strtotime($startDate)) . ' ' . date('H:i:s', strtotime('+2 hours', $startTime))
            ]);
        } elseif ($month !== null && $year) {
            $model->whereMonth('created_at', $month)
                ->whereYear('created_at', $year);
        } elseif ($month !== null && $year !== null) {
            $model->whereMonth('created_at', $month)
                ->whereYear('created_at', $year);
        } elseif ($month !== null) {
            $model->whereMonth('created_at', $month)
                ->whereYear('created_at', now()->format('Y'));
        } elseif ($year !== null) {
            $model->whereYear('created_at', $year);
        } else {
            $model->whereDay('created_at', now()->format('d'))
                ->whereMonth('created_at', now()->format('m'));
        }
        if ($limit) {
            return !empty($appends) ? $model->paginate($limit)->appends($appends) : $model->paginate($limit);
        }
        return $model->get();
    }

    public function getLeaderBoard(string $userType, array $criteria = [], array $searchCriteria = [], array $whereInCriteria = [], array $whereBetweenCriteria = [], array $whereHasRelations = [], array $withAvgRelations = [], array $relations = [], array $orderBy = [], int $limit = null, int $offset = null, bool $onlyTrashed = false, bool $withTrashed = false, array $withCountQuery = [], array $appends = []): Collection|LengthAwarePaginator
    {
        $model = $this->prepareModelForRelationAndOrder(relations: $relations, orderBy: $orderBy)
            ->when(!empty($criteria), function ($whereQuery) use ($criteria) {
                $whereQuery->where($criteria);
            })
            ->when(!empty($whereInCriteria), function ($whereInQuery) use ($whereInCriteria) {
                foreach ($whereInCriteria as $column => $values) {
                    $whereInQuery->whereIn($column, $values);
                }
            })
            ->when(!empty($whereHasRelations), function ($whereHasQuery) use ($whereHasRelations) {
                foreach ($whereHasRelations as $relation => $conditions) {
                    $whereHasQuery->whereHas($relation, function ($query) use ($conditions) {
                        $query->where($conditions);
                    });
                }
            })
            ->when(!empty($whereBetweenCriteria), function ($whereBetweenQuery) use ($whereBetweenCriteria) {
                foreach ($whereBetweenCriteria as $column => $range) {
                    $whereBetweenQuery->whereBetween($column, $range);
                }
            })
            ->when(!empty($searchCriteria), function ($whereQuery) use ($searchCriteria) {
                $this->searchQuery($whereQuery, $searchCriteria);
            })
            ->when(($onlyTrashed || $withTrashed), function ($query) use ($onlyTrashed, $withTrashed) {
                $this->withOrWithOutTrashDataQuery($query, $onlyTrashed, $withTrashed);
            })
            ->when(!empty($withCountQuery), function ($query) use ($withCountQuery) {
                $this->withCountQuery($query, $withCountQuery);
            })->when(!empty($withAvgRelations), function ($query) use ($withAvgRelations) {
                foreach ($withAvgRelations as $relation) {
                    $query->withAvg($relation);
                }
            }) 
            ->whereNotNull($userType)
            ->selectRaw($userType . ', count(*) as total_records ,SUM(paid_fare) as income')
            ->groupBy($userType)
            ->orderBy('total_records', 'desc');
        if ($limit) {
            return !empty($appends) ? $model->paginate($limit)->appends($appends) : $model->paginate($limit);
        }
        return $model->get();
    }

    public function getPopularTips()
    {
        return $this->model->whereNot('tips', 0)->groupBy('tips')->selectRaw('tips, count(*) as total')->orderBy('total', 'desc')->first();
    }

    public function getTripHeatMapCompareDataBy(array $criteria = [], array $searchCriteria = [], array $whereInCriteria = [], array $whereBetweenCriteria = [], array $whereHasRelations = [], array $withAvgRelations = [], array $relations = [], array $orderBy = [], int $limit = null, int $offset = null, bool $onlyTrashed = false, bool $withTrashed = false, array $withCountQuery = [], array $appends = [], $startDate = null, $endDate = null): Collection|LengthAwarePaginator
    {
        $startDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $startDate)->setTime(0, 0); // Start at 6 AM
        $endDateTime = $startDateTime->copy()->endOfDay(); // End of the same day
        $model = $this->prepareModelForRelationAndOrder(relations: $relations, orderBy: $orderBy)
            ->when(!empty($criteria), function ($whereQuery) use ($criteria) {
                $whereQuery->where($criteria);
            })->when(!empty($whereInCriteria), function ($whereInQuery) use ($whereInCriteria) {
                foreach ($whereInCriteria as $column => $values) {
                    $whereInQuery->whereIn($column, $values);
                }
            })->when(!empty($whereHasRelations), function ($whereHasQuery) use ($whereHasRelations) {
                foreach ($whereHasRelations as $relation => $conditions) {
                    $whereHasQuery->whereHas($relation, function ($query) use ($conditions) {
                        $query->where($conditions);
                    });
                }
            })->when(!empty($whereBetweenCriteria), function ($whereBetweenQuery) use ($whereBetweenCriteria) {
                foreach ($whereBetweenCriteria as $column => $range) {
                    $whereBetweenQuery->whereBetween($column, $range);
                }
            })->when(!empty($searchCriteria), function ($whereQuery) use ($searchCriteria) {
                $this->searchQuery($whereQuery, $searchCriteria);
            })->when(($onlyTrashed || $withTrashed), function ($query) use ($onlyTrashed, $withTrashed) {
                $this->withOrWithOutTrashDataQuery($query, $onlyTrashed, $withTrashed);
            })
            ->when(!empty($withCountQuery), function ($query) use ($withCountQuery) {
                $this->withCountQuery($query, $withCountQuery);
            })->when(!empty($withAvgRelations), function ($query) use ($withAvgRelations) {
                foreach ($withAvgRelations as $relation) {
                    $query->withAvg($relation['relation'], $relation['column']);
                }
            });

        if ($startDate->isSameDay($endDate)) {
            $model->select(
                DB::raw('DATE(created_at) as date'), // Extract the date part from created_at
                DB::raw('HOUR(created_at) AS hour'), // Get the hour part
                DB::raw('COUNT(CASE WHEN type = "parcel" THEN 1 END) as parcel_count'), // Count for parcel type
                DB::raw('COUNT(CASE WHEN type = "ride_request" THEN 1 END) as ride_count') // Count for ride type
            )
                ->whereBetween('created_at', [$startDateTime, $endDateTime]) // Full day range
                ->groupBy('date', 'hour')
                ->orderBy('hour', 'asc'); // Group by date and hour
        } elseif ($startDate->isSameWeek($endDate)) {
            $model->select(
                DB::raw('DATE(created_at) as date'), // Extract the date part from created_at
                DB::raw('DAYNAME(created_at) AS day'), // Get the hour part
                DB::raw('COUNT(CASE WHEN type = "parcel" THEN 1 END) as parcel_count'), // Count for parcel type
                DB::raw('COUNT(CASE WHEN type = "ride_request" THEN 1 END) as ride_count') // Count for ride type
            )
                ->whereBetween('created_at', [$startDate, $endDate]) // Full day range
                ->groupBy('date', 'day'); // Group by date and hour
        } elseif ($startDate->isSameMonth($endDate)) {

            $model->select(
                DB::raw('DATE(created_at) as date'), // Extract the date part from created_at
                DB::raw('COUNT(CASE WHEN type = "parcel" THEN 1 END) as parcel_count'), // Count for parcel type
                DB::raw('COUNT(CASE WHEN type = "ride_request" THEN 1 END) as ride_count') // Count for ride type
            )
                ->whereBetween('created_at', [$startDate, $endDate]) // Full day range
                ->groupBy('date')
                ->orderBy('date', 'asc');
        } elseif ($startDate->isSameYear($endDate)) {

            $model->select(
                DB::raw('MONTH(created_at) as month'), // Group by month (Year-Month format)
                DB::raw('YEAR(created_at) as year'), // Group by month (Year-Month format)
                DB::raw('COUNT(CASE WHEN type = "parcel" THEN 1 END) as parcel_count'), // Count for parcel type
                DB::raw('COUNT(CASE WHEN type = "ride_request" THEN 1 END) as ride_count') // Count for ride type
            )
                ->whereBetween('created_at', [$startDate, $endDate]) // Full day range
                ->groupBy('month', 'year')
                ->orderBy('month', 'asc');
        } else {

            $model->select(
                DB::raw('YEAR(created_at) as year'), // Group by year
                DB::raw('COUNT(CASE WHEN type = "parcel" THEN 1 END) as parcel_count'), // Count for parcel type
                DB::raw('COUNT(CASE WHEN type = "ride_request" THEN 1 END) as ride_count') // Count for ride type
            )
                ->whereBetween('created_at', [$startDate, $endDate]) // Full day range
                ->groupBy('year')
                ->orderBy('year', 'asc');
        }

        if ($limit) {
            return !empty($appends) ? $model->paginate(perPage: $limit, page: $offset ?? 1)->appends($appends) : $model->paginate(perPage: $limit, page: $offset ?? 1);
        }
        return $model->get();
    }

    public function allRideList(array $criteria = [], array $relations = [], array $orderBy = []): mixed
    {
        return $this->prepareModelForRelationAndOrder(relations: $relations, orderBy: $orderBy)
            ->when(!empty($criteria), function ($whereQuery) use ($criteria) {
                $whereQuery->where($criteria);
            })
            ->where(function ($query) {
                $query->whereIn('current_status', ['ongoing', 'accepted'])
                    ->orWhere(fn($query1) => $query1->where('current_status', 'completed')->where('payment_status', 'unpaid'))
                    ->orWhere(fn($query2) => $query2->where('current_status', 'cancelled')->where('payment_status', 'unpaid')->whereHas('fee', fn($query3) => $query3->where('cancelled_by', 'customer')));
            })
            ->get();
    }

    public function getPendingParcel(array $criteria = [], array $relations = [], array $orderBy = [], int $limit = null, int $offset = null): mixed
    {
        return $this->prepareModelForRelationAndOrder(relations: $relations, orderBy: $orderBy)
            ->when(!empty($criteria), function ($whereQuery) use ($criteria) {
                $whereQuery->where($criteria);
            })
            ->when(isset($criteria['driver_id']), function ($query) { // Removed extra arrow here
                $query->where(function ($query) {
                    $query->where(function ($query1) {
                        $query1->where('current_status', COMPLETED)
                            ->where('payment_status', UNPAID);
                    })->orWhere(function ($query) {
                        $query->whereIn('current_status', [PENDING, ACCEPTED, ONGOING, RETURNING]);
                    });
                });
            })
            ->when(isset($criteria['customer_id']), function($query) {
                $query->whereNotIn('current_status', [CANCELLED, COMPLETED, RETURNED]);
            })
            ->paginate(perPage: $limit, page: $offset ?? 1);
    }


    public function getPendingRide(array $criteria = [], array $relations = [], array $whereHasRelations = [], array $orderBy = [], array $attributes = []): mixed
    {
        $model = $this->prepareModelForRelationAndOrder(relations: $relations, orderBy: $orderBy)
            ->when(!empty($criteria), function ($whereQuery) use ($criteria) {
                $whereQuery->where($criteria);
            })
            ->when(!empty($whereHasRelations), function ($whereHasQuery) use ($whereHasRelations) {
                foreach ($whereHasRelations as $relation => $conditions) {
                    $whereHasQuery->whereHas($relation, function ($query) use ($conditions) {
                        foreach ($conditions as $field => $value) {
                            if (is_array($value) && count($value) === 3) {
                                // Handle complex conditions with custom operators
                                [$field, $operator, $val] = $value;
                                $query->where($field, $operator, $val);
                            } elseif (is_array($value)) {
                                // Handle OR conditions for arrays (e.g., ['ongoing', 'accepted', 'completed'])
                                $query->where(function ($subQuery) use ($field, $value) {
                                    foreach ($value as $v) {
                                        $subQuery->orWhere($field, $v);
                                    }
                                });
                            } else {
                                // Handle single key-value pairs
                                $query->where($field, $value);
                            }
                        }
                    });
                }
            })
            ->whereDoesntHave('ignoredRequests', fn($query) => $query->where('user_id', auth('delivery_men')->id()))
            ->where(fn($query) => $query->where('vehicle_category_id', $attributes['vehicle_category_id'])
                ->orWhereNull('vehicle_category_id')
            )
            ->where(function ($query) use ($attributes) {
                if ($attributes['ride_count'] < 3) {
                    $query->where('type', RIDE_REQUEST);
                }

                // 2. Parcel request logic based on parcel follow status and parcel count
                /* $query->orWhere(function ($query) use ($attributes) {
                    if ($attributes['parcel_follow_status']) {
                        // Only include parcels if parcel_count < 2
                        if ($attributes['parcel_count'] < $attributes['max_parcel_request_accept_limit_count']) {
                            $query->where('type', PARCEL);
                        } else {
                            $query->whereNotIn('type', [PARCEL, RIDE_REQUEST]);
                        }
                    } else {
                        // Include all parcels when parcel_follow_status is false
                        $query->where('type', PARCEL);
                    }
                }); */
            });
        if ($attributes['limit']) {
            return !empty($appends) ? $model->paginate(perPage: $attributes['limit'], page: $attributes['offset'] ?? 1)->appends($appends) : $model->paginate(perPage: $attributes['limit'], page: $attributes['offsetr'] ?? 1);
        }
        return $model->get();
    }

    public function getLockedTrip(array $data = []): mixed
    {
        return $this->model->where($data)->lockForUpdate()->first();
    }

    /**
     * @param array $criteria
     * @param array $relations
     * @param array $orderBy
     * @return mixed
     */
    public function getIncompleteRide(array $criteria = []): mixed
    {
        return $this->model
            ->where(fn($query) => $query->whereNotIn('current_status', ['completed', 'cancelled'])
                ->orWhere(fn($query) => $query->whereNotNull('driver_id')
                    ->whereHas('fee', function ($query) {
                        $query->where('cancelled_by', '!=', 'driver');
                    })
                    ->whereIn('current_status', ['completed', 'cancelled'])
                    ->where('payment_status', 'unpaid')
                ))
            ->when(!empty($criteria), function ($whereQuery) use ($criteria) {
                $whereQuery->where($criteria);
            })
            ->first();
    }

    public function create(array $data): Model
    {
        try {

            DB::beginTransaction();

            $trip = $this->model;
            $trip->customer_id = $data['customer_id'] ?? null;
            $trip->vehicle_category_id = $data['vehicle_category_id'] ?? null;
            $trip->zone_id = $data['zone_id'] ?? null;
            $trip->area_id = $data['area_id'] ?? null;
            $trip->actual_fare = $data['actual_fare'];
            $trip->estimated_fare = $data['estimated_fare'] ?? 0;
            $trip->return_fee = $data['return_fee'] ?? 0;
            $trip->cancellation_fee = $data['cancellation_fee'] ?? 0;
            $trip->extra_fare_fee = $data['extra_fare_fee'] ?? 0;
            $trip->extra_fare_amount = $data['extra_fare_amount'] ?? 0;
            $trip->rise_request_count = $data['rise_request_count'] ?? 0;
            $trip->estimated_distance = str_replace(',', '', $data['estimated_distance']) ?? null;
            $trip->payment_method = $data['payment_method'] ?? null;
            $trip->note = $data['note'] ?? null;
            $trip->type = $data['type'];
            $trip->entrance = $data['entrance'] ?? null;
            $trip->encoded_polyline = $data['encoded_polyline'] ?? null;
            $trip->save();

            $trip->tripStatus()->create([
                'customer_id' => $data['customer_id'],
                'pending' => now()
            ]);

            $coordinates = [
                'pickup_coordinates' => $data['pickup_coordinates'],
                'start_coordinates' => $data['pickup_coordinates'],
                'destination_coordinates' => $data['destination_coordinates'],
                'pickup_address' => $data['pickup_address'],
                'destination_address' => $data['destination_address'],
                'customer_request_coordinates' => $data['customer_request_coordinates']
            ];
            $int_coordinates = json_decode($data['intermediate_coordinates']);
            if (!is_null($int_coordinates)) {
                foreach ($int_coordinates as $key => $ic) {
                    if ($key == 0) {
                        $coordinates['int_coordinate_1'] = new Point($ic[0], $ic[1]);
                    } elseif ($key == 1) {
                        $coordinates['int_coordinate_2'] = new Point($ic[0], $ic[1]);
                    }
                }

            }
            $coordinates['intermediate_coordinates'] = $data['intermediate_coordinates'] ?? null;
            $coordinates['intermediate_addresses'] = $data['intermediate_addresses'] ?? null;

            $trip->coordinate()->create($coordinates);
            $trip->fee()->create();
            $trip->time()->create([
                'estimated_time' => str_replace(',', '', $data['estimated_time'])
            ]);

            if ($data['type'] == 'parcel') {
                $trip->parcel()->create([
                    'payer' => $data['payer'],
                    'weight' => $data['weight'],
                    'parcel_category_id' => $data['parcel_category_id'],
                ]);

                $sender = [
                    'name' => $data['sender_name'],
                    'contact_number' => $data['sender_phone'],
                    'address' => $data['sender_address'],
                    'user_type' => 'sender'
                ];
                $receiver = [
                    'name' => $data['receiver_name'],
                    'contact_number' => $data['receiver_phone'],
                    'address' => $data['receiver_address'],
                    'user_type' => 'receiver'
                ];
                $trip->parcelUserInfo()->createMany([$sender, $receiver]);

            }

            DB::commit();

        } catch (\Exception $e) {
            //throw $th;
            DB::rollback();
            abort(403, message: $e->getMessage());
        }

        return $this->model;

    }

    public function getLastRideDetails($rider_id): mixed
    {
        return $this->model->query()
            ->select('ride_requests.*')
            ->with(['fee'])
            ->join('ride_status', 'ride_requests.id', '=', 'ride_status.ride_request_id')
            ->where('ride_requests.driver_id', $rider_id)
            ->orderBy('ride_status.accepted', 'desc')
            ->orderBy('ride_requests.created_at', 'desc')
            ->first();
    }
}
