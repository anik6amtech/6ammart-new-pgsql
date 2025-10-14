<?php

namespace Modules\RideShare\Service\VehicleManagement;

use App\CentralLogics\Helpers;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Config;
use Modules\RideShare\Interface\VehicleManagement\Repository\VehicleBrandRepositoryInterface;
use Modules\RideShare\Interface\VehicleManagement\Service\VehicleBrandServiceInterface;
use Modules\RideShare\Service\BaseService;

class VehicleBrandService extends BaseService implements VehicleBrandServiceInterface
{
    protected $vehicleBrandRepository;

    public function __construct(VehicleBrandRepositoryInterface $vehicleBrandRepository)
    {
        parent::__construct($vehicleBrandRepository);
        $this->vehicleBrandRepository = $vehicleBrandRepository;
    }

    public function create(Request|array $data): ?Model
    {
        $storeData = [
            'name' => $data['brand_name'][array_search('default', $data['lang'])],
            'description' => $data['short_desc'][array_search('default', $data['lang'])],
            'image' => fileUploader('vehicle/brand/', 'png', $data['brand_logo']),
            'module_id' => Config::get('module.current_module_id'),
        ];
        $brand = $this->vehicleBrandRepository->create($storeData);

        Helpers::add_or_update_translations(
            request: $data, 
            key_data:'name', 
            name_field:'brand_name', 
            model_name: get_class($brand),
            data_id: $brand->id,
            data_value: $brand->name,
            model_class: true
        );
        Helpers::add_or_update_translations(
            request: $data, 
            key_data:'description', 
            name_field:'short_desc', 
            model_name: get_class($brand),
            data_id: $brand->id,
            data_value: $brand->description,
            model_class: true
        );

        return $brand;
    }

    public function update(int|string $id, array|Request $data = []): ?Model
    {
        $model = $this->findOne(id: $id);
        $updateData = [
            'name' => $data['brand_name'][array_search('default', $data['lang'])],
            'description' => $data['short_desc'][array_search('default', $data['lang'])],
        ];
        if (($data->hasFile('brand_logo'))) {
            $updateData = array_merge($updateData, [
                'image' => fileUploader('vehicle/brand/', 'png', $data['brand_logo'], $model?->image)
            ]);
        }
        $brand = $this->vehicleBrandRepository->update($id, $updateData);

        Helpers::add_or_update_translations(
            request: $data, 
            key_data:'name', 
            name_field:'brand_name', 
            model_name: get_class($brand),
            data_id: $brand->id,
            data_value: $brand->name,
            model_class: true
        );
        Helpers::add_or_update_translations(
            request: $data, 
            key_data:'description', 
            name_field:'short_desc', 
            model_name: get_class($brand),
            data_id: $brand->id,
            data_value: $brand->description,
            model_class: true
        );
        return $brand;
    }

    public function export(array $criteria = [], array $relations = [], array $orderBy = [], int $limit = null, int $offset = null, array $withCountQuery = []): Collection|LengthAwarePaginator|\Illuminate\Support\Collection
    {
        return $this->index(criteria: $criteria, relations: $relations, orderBy: $orderBy)->map(function ($item) {
            return [
                'Id' => $item['id'],
                'Brand Name' => $item['name'],
                'Description' => $item['description'],
                'Total Vehicles' => $item->vehicles->count(),
                'Status' => $item['is_active'] ? 'Active' : 'Inactive',
            ];
        });
    }

}
