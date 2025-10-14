<?php

namespace Modules\RideShare\Repository\PromotionManagement;

use Modules\RideShare\Entities\PromotionManagement\DiscountSetup;
use Modules\RideShare\Interface\PromotionManagement\Repository\DiscountSetupRepositoryInterface;
use Modules\RideShare\Repository\BaseRepository;

class DiscountSetupRepository extends BaseRepository implements DiscountSetupRepositoryInterface
{
    public function __construct(DiscountSetup $model)
    {
        parent::__construct($model);
    }

    public function getUserDiscountList(array $data, $limit = null, $offset = null)
    {
        $model = $this->model
            ->where(fn($query) => $query->where('customer_discount_type', ALL)
                ->orWhereHas('customers', function ($query1) use ($data) {
                    $query1->where('id', $data['user_id']);
                }))
            // ->where(fn($query) => $query->where('customer_level_discount_type', ALL)
            //     ->orWhereHas('customerLevels', function ($query1) use ($data) {
            //         $query1->where('id', $data['level_id']);
            //     }))
            ->where('is_active', $data['is_active'])
            ->whereDate('start_date', '<=', $data['date'])
            ->whereDate('end_date', '>=', $data['date'])
            ->module(config('module.current_module_data')['id']);
        if ($limit) {
            return $model->paginate(perPage: $limit, page: $offset);
        }
        return $model->get();
    }

    public function getUserTripApplicableDiscountList($tripType, $vehicleCategoryId, array $data, $limit = null, $offset = null)
    {
        $model = $this->model
            ->where(fn($query) => $query->where('customer_discount_type', ALL)
                ->orWhereHas('customers', function ($query1) use ($data) {
                    $query1->where('id', $data['user_id']);
                }))
            // ->where(fn($query) => $query->where('customer_level_discount_type', ALL)
            //     ->orWhereHas('customerLevels', function ($query1) use ($data) {
            //         $query1->where('id', $data['level_id']);
            //     }))
            ->where(fn($query) => $query->where('zone_discount_type', ALL)
                ->orWhereHas('zones', function ($query1) use ($data) {
                    $query1->where('id', $data['zone_id']);
                }))
            ->where(function ($query) use ($tripType, $vehicleCategoryId) {
                $query->whereRaw("JSON_CONTAINS(module_discount_type, '\"all\"')")
                    ->orWhereRaw("JSON_CONTAINS(module_discount_type, '\"$tripType\"')");

                if ($tripType != 'parcel' && $vehicleCategoryId != null) {
                    $query->orWhereHas('vehicleCategories', function ($query1) use ($vehicleCategoryId) {
                        $query1->where('id', $vehicleCategoryId);
                    });
                }
            })
            ->where('min_trip_amount', '<=', $data['fare'])
            ->where('is_active', $data['is_active'])
            ->whereDate('start_date', '<=', $data['date'])
            ->whereDate('end_date', '>=', $data['date']);
        if ($limit) {
            return $model->paginate(perPage: $limit, page: $offset);
        }
        return $model->get();
    }

}
