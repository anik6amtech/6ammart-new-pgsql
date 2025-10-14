<?php

namespace Modules\RideShare\Service\VehicleManagement;

use App\CentralLogics\Helpers;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Config;
use Modules\RideShare\Interface\VehicleManagement\Repository\VehicleModelRepositoryInterface;
use Modules\RideShare\Interface\VehicleManagement\Service\VehicleModelServiceInterface;
use Modules\RideShare\Service\BaseService;

class VehicleModelService extends BaseService implements VehicleModelServiceInterface
{
    protected $vehicleModelRepository;
    public function __construct(VehicleModelRepositoryInterface $vehicleModelRepository)
    {
        parent::__construct($vehicleModelRepository);
        $this->vehicleModelRepository = $vehicleModelRepository;
    }

    public function create(array|Request $data): ?Model
    {
        $storeData = [
            'name' => $data['name'][array_search('default', $data['lang'])],
            'description' => $data['short_desc'][array_search('default', $data['lang'])],
            'brand_id' => $data['brand_id'],
            'seat_capacity' => $data['seat_capacity'] ?? 0,
            'maximum_weight' => $data['maximum_weight'] ?? 0,
            'hatch_bag_capacity' => $data['hatch_bag_capacity'] ?? 0,
            'engine' => $data['engine'] ?? null,
            'image' => fileUploader('vehicle/model/', 'png', $data['model_image']),
            'module_id' => Config::get('module.current_module_id'),
        ];
        $model = $this->vehicleModelRepository->create($storeData);

        Helpers::add_or_update_translations(
            request: $data, 
            key_data:'name', 
            name_field:'name', 
            model_name: get_class($model),
            data_id: $model->id,
            data_value: $model->name,
            model_class: true
        );
        Helpers::add_or_update_translations(
            request: $data, 
            key_data:'description', 
            name_field:'short_desc', 
            model_name: get_class($model),
            data_id: $model->id,
            data_value: $model->description,
            model_class: true
        );

        return $model;
    }

    public function update(int|string $id, array|Request $data = []): ?Model
    {
        $model = $this->findOne(id: $id);
        $updateData = [
            'name' => $data['name'][array_search('default', $data['lang'])],
            'brand_id' => $data['brand_id'],
            'seat_capacity' => $data['seat_capacity'] ?? 0,
            'maximum_weight' => $data['maximum_weight'] ?? 0,
            'hatch_bag_capacity' => $data['hatch_bag_capacity'] ?? 0,
            'engine' => $data['engine'] ?? null,
            'description' => $data['short_desc'][array_search('default', $data['lang'])],
        ];

        if (($data->hasFile('model_image'))) {
            $updateData = array_merge($updateData, [
                'image' => fileUploader('vehicle/model/', 'png', $data['model_image'], $model?->image)
            ]);
        }
        $model = $this->vehicleModelRepository->update($id, $updateData);

        Helpers::add_or_update_translations(
            request: $data, 
            key_data:'name', 
            name_field:'name', 
            model_name: get_class($model),
            data_id: $model->id,
            data_value: $model->name,
            model_class: true
        );
        Helpers::add_or_update_translations(
            request: $data, 
            key_data:'description', 
            name_field:'short_desc', 
            model_name: get_class($model),
            data_id: $model->id,
            data_value: $model->description,
            model_class: true
        );

        return $model;
    }

    public function export(array $criteria = [], array $relations = [], array $orderBy = [], int $limit = null, int $offset = null, array $withCountQuery = []): Collection|LengthAwarePaginator|\Illuminate\Support\Collection
    {
        return $this->index(criteria: $criteria, relations: $relations, orderBy: $orderBy)->map(function ($item) {
            return [
                'id' => $item['id'],
                'name' => $item['name'],
                'description' => $item['description'],
                'brand_id' => $item['brand_id'],
                'seat_capacity' => $item['seat_capacity'],
                'maximum_weight' => $item['maximum_weight'],
                "hatch_bag_capacity" => $item['hatch_bag_capacity'],
                "engine" => $item['engine'],
                "total_vehicles" => /* $item->vehicles->count() */0,
                "is_active" => $item['is_active'],
                "created_at" => $item['created_at'],
            ];
        });
    }

}
