<?php

namespace Modules\RideShare\Service\PromotionManagement;

use App\CentralLogics\Helpers;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Modules\RideShare\Interface\PromotionManagement\Repository\DiscountSetupRepositoryInterface;
use Modules\RideShare\Interface\PromotionManagement\Service\DiscountSetupServiceInterface;
use Modules\RideShare\Service\BaseService;

class DiscountSetupService extends BaseService implements DiscountSetupServiceInterface
{
    protected $discountSetupRepository;

    public function __construct(DiscountSetupRepositoryInterface $discountSetupRepository)
    {
        parent::__construct($discountSetupRepository);
        $this->discountSetupRepository = $discountSetupRepository;

    }

    public function index(array $criteria = [], array $relations = [], array $whereHasRelations = [], array $orderBy = [], int $limit = null, int $offset = null, array $withCountQuery = [], array $appends = [], array $groupBy = [], bool $allModule=false): Collection|LengthAwarePaginator
    {
        $data = [];
        if (array_key_exists('status', $criteria) && $criteria['status'] !== 'all') {
            $data['is_active'] = $criteria['status'] == 'active' ? 1 : 0;
        }
        $searchData = [];
        if (array_key_exists('search', $criteria) && $criteria['search'] != '') {
            $searchData['fields'] = ['title'];
            $searchData['value'] = $criteria['search'];
        }
        $whereInCriteria = [];
        $whereBetweenCriteria = [];
        return $this->discountSetupRepository->getBy(criteria: $data, searchCriteria: $searchData, whereInCriteria: $whereInCriteria, whereBetweenCriteria: $whereBetweenCriteria, whereHasRelations: $whereHasRelations, relations: $relations, orderBy: $orderBy, limit: $limit, offset: $offset, appends: $criteria);
    }

    public function create(array|Request $data): ?Model
    {
        DB::beginTransaction();
        list($startDate, $endDate) = explode(' - ', $data->dates);
        $startDate = date('Y-m-d', strtotime($startDate));
        $endDate = date('Y-m-d', strtotime($endDate));
        $storeData = [
            'title' => $data['title'][array_search('default', $data['lang'])],
            'short_description' => $data['short_description'][array_search('default', $data['lang'])],
            'terms_conditions' => $data['terms_conditions'][array_search('default', $data['lang'])],
            'min_trip_amount' => $data['min_trip_amount'],
            'max_discount_amount' => $data['max_discount_amount'] == null ? 0 : $data['max_discount_amount'],
            'discount_amount' => $data['discount_amount'],
            'discount_amount_type' => $data['discount_amount_type'],
            'limit_per_user' => $data['limit_per_user'],
            'start_date' => $startDate,
            'end_date' => $endDate,
            'image' => fileUploader('promotion/discount/', 'png', $data['image']),
            'module_id' => Config::get('module.current_module_id'),
        ];
        if (in_array(ALL, $data['zone_discount_type'], true)) {
            $storeData = array_merge($storeData, ['zone_discount_type' => ALL]);
        }
        // if (in_array(ALL, $data['customer_level_discount_type'], true)) {
        //     $storeData = array_merge($storeData, ['customer_level_discount_type' => ALL]);
        // }
        if (in_array(ALL, $data['customer_discount_type'], true)) {
            $storeData = array_merge($storeData, ['customer_discount_type' => ALL]);
        }
        if (in_array(ALL, $data['module_discount_type'], true)) {
            $storeData = array_merge($storeData, ['module_discount_type' => [ALL]]);
            $moduleDiscount = null;
        }
        if (in_array(PARCEL, $data['module_discount_type'], true) && count($data['module_discount_type']) === 1) {
            $storeData = array_merge($storeData, ['module_discount_type' => [PARCEL]]);
            $moduleDiscount = null;
        }
        if (in_array(PARCEL, $data['module_discount_type'], true) && count($data['module_discount_type']) > 1) {
            $storeData = array_merge($storeData, ['module_discount_type' => [PARCEL, CUSTOM]]);
            $moduleDiscount = CUSTOM;
        }
        if (!in_array(ALL, $data['module_discount_type'], true) && !in_array(PARCEL, $data['module_discount_type'], true) && count($data['module_discount_type']) > 0) {
            $storeData = array_merge($storeData, ['module_discount_type' => [CUSTOM]]);
            $moduleDiscount = CUSTOM;
        }
        $discount = $this->discountSetupRepository->create(data: $storeData);

        Helpers::add_or_update_translations(
            request: $data,
            key_data:'title',
            name_field:'title',
            model_name: get_class($discount),
            data_id: $discount->id,
            data_value: $discount->title,
            model_class: true
        );
        Helpers::add_or_update_translations(
            request: $data,
            key_data:'short_description',
            name_field:'short_description',
            model_name: get_class($discount),
            data_id: $discount->id,
            data_value: $discount->short_description,
            model_class: true
        );
        Helpers::add_or_update_translations(
            request: $data,
            key_data:'terms_conditions',
            name_field:'terms_conditions',
            model_name: get_class($discount),
            data_id: $discount->id,
            data_value: $discount->terms_conditions,
            model_class: true
        );

        if (!in_array(ALL, $data['zone_discount_type'], true)) {
            $discount?->zones()->attach($data['zone_discount_type']);
        }
        // if (!in_array(ALL, $data['customer_level_discount_type'], true)) {
        //     $discount?->customerLevels()->attach($data['customer_level_discount_type']);
        // }
        if (!in_array(ALL, $data['customer_discount_type'], true)) {
            $discount?->customers()->attach($data['customer_discount_type']);
        }
        if ($moduleDiscount && $moduleDiscount == CUSTOM) {
            $data = array_diff($data['module_discount_type'], array(PARCEL));
            $data = array_diff($data, array(ALL));
             $discount?->vehicleCategories()->attach($data);
        }
        DB::commit();
        return $discount;
    }

    public function update(int|string $id, array|Request $data = []): ?Model
    {
        $model = $this->findOne(id: $id);
        DB::beginTransaction();
        list($startDate, $endDate) = explode(' - ', $data->dates);
        $startDate = date('Y-m-d', strtotime($startDate));
        $endDate = date('Y-m-d', strtotime($endDate));
        $updateData = [
             'title' => $data['title'][array_search('default', $data['lang'])],
            'short_description' => $data['short_description'][array_search('default', $data['lang'])],
            'terms_conditions' => $data['terms_conditions'][array_search('default', $data['lang'])],
            'min_trip_amount' => $data['min_trip_amount'],
            'max_discount_amount' => $data['max_discount_amount'] == null ? 0 : $data['max_discount_amount'],
            'discount_amount' => $data['discount_amount'],
            'discount_amount_type' => $data['discount_amount_type'],
            'limit_per_user' => $data['limit_per_user'],
            'start_date' => $startDate,
            'end_date' => $endDate,
        ];
        if (($data->hasFile('image'))) {
            $updateData = array_merge($updateData, [
                'image' => fileUploader('promotion/discount/', 'png', $data['image'], $model->image),
            ]);
        }
        if (in_array(ALL, $data['zone_discount_type'], true)) {
            $updateData = array_merge($updateData, ['zone_discount_type' => ALL]);
            $model?->zones()->detach();
        } else {
            $updateData = array_merge($updateData, ['zone_discount_type' => CUSTOM]);
        }
        // if (in_array(ALL, $data['customer_level_discount_type'], true)) {
        //     $updateData = array_merge($updateData, ['customer_level_discount_type' => ALL]);
        //     $model?->customerLevels()->detach();
        // } else {
        //     $updateData = array_merge($updateData, ['customer_level_discount_type' => CUSTOM]);
        // }
        if (in_array(ALL, $data['customer_discount_type'], true)) {
            $updateData = array_merge($updateData, ['customer_discount_type' => ALL]);
            $model?->customers()->detach();
        } else {
            $updateData = array_merge($updateData, ['customer_discount_type' => CUSTOM]);
        }
        if (in_array(ALL, $data['module_discount_type'], true)) {
            $updateData = array_merge($updateData, ['module_discount_type' => [ALL]]);
            $moduleDiscount = null;
            $model?->vehicleCategories()->detach();
        }
        if (in_array(PARCEL, $data['module_discount_type'], true) && count($data['module_discount_type']) === 1) {
            $updateData = array_merge($updateData, ['module_discount_type' => [PARCEL]]);
            $moduleDiscount = null;
            $model?->vehicleCategories()->detach();
        }
        if (in_array(PARCEL, $data['module_discount_type'], true) && count($data['module_discount_type']) > 1) {
            $updateData = array_merge($updateData, ['module_discount_type' => [PARCEL, CUSTOM]]);
            $moduleDiscount = CUSTOM;
        }
        if (!in_array(ALL, $data['module_discount_type'], true) && !in_array(PARCEL, $data['module_discount_type'], true) && count($data['module_discount_type']) > 0) {
            $updateData = array_merge($updateData, ['module_discount_type' => [CUSTOM]]);
            $moduleDiscount = CUSTOM;
        }
        $discount = $this->discountSetupRepository->update(id: $id, data: $updateData);

        Helpers::add_or_update_translations(
            request: $data,
            key_data:'title',
            name_field:'title',
            model_name: get_class($discount),
            data_id: $discount->id,
            data_value: $discount->title,
            model_class: true
        );
        Helpers::add_or_update_translations(
            request: $data,
            key_data:'short_description',
            name_field:'short_description',
            model_name: get_class($discount),
            data_id: $discount->id,
            data_value: $discount->short_description,
            model_class: true
        );
        Helpers::add_or_update_translations(
            request: $data,
            key_data:'terms_conditions',
            name_field:'terms_conditions',
            model_name: get_class($discount),
            data_id: $discount->id,
            data_value: $discount->terms_conditions,
            model_class: true
        );

        if (!in_array(ALL, $data['zone_discount_type'], true)) {
            $discount?->zones()->sync($data['zone_discount_type']);
        }
        // if (!in_array(ALL, $data['customer_level_discount_type'], true)) {
        //     $discount?->customerLevels()->sync($data['customer_level_discount_type']);
        // }
        if (!in_array(ALL, $data['customer_discount_type'], true)) {
            $discount?->customers()->sync($data['customer_discount_type']);
        }
        if ($moduleDiscount && $moduleDiscount == CUSTOM) {
            $data = array_diff($data['module_discount_type'], array(PARCEL));
            $data = array_diff($data, array(ALL));
             $discount?->vehicleCategories()->sync($data);
        }
        DB::commit();
        return $discount;
    }

    public function trashedData(array $criteria = [], array $relations = [], array $orderBy = [], int $limit = null, int $offset = null, array $withCountQuery = []): Collection|LengthAwarePaginator
    {
        $searchData = [];
        if (array_key_exists('search', $criteria) && $criteria['search'] != '') {
            $searchData['fields'] = ['title'];
            $searchData['value'] = $criteria['search'];
        }
        return $this->discountSetupRepository->getBy(searchCriteria: $searchData, relations: $relations, orderBy: $orderBy, limit: $limit, offset: $offset, onlyTrashed: true, withCountQuery: $withCountQuery);
    }

    public function getUserDiscountList(array $data, $limit = null, $offset = null)
    {
        return $this->discountSetupRepository->getUserDiscountList(data: $data, limit: $limit, offset: $offset);
    }

    public function getUserTripApplicableDiscountList($tripType, $vehicleCategoryId, array $data, $limit = null, $offset = null)
    {
        return $this->discountSetupRepository->getUserTripApplicableDiscountList(tripType: $tripType, vehicleCategoryId: $vehicleCategoryId, data: $data, limit: $limit, offset: $offset);

    }


}
