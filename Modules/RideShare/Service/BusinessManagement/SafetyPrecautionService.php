<?php

namespace Modules\RideShare\Service\BusinessManagement;

use App\CentralLogics\Helpers;
use Modules\RideShare\Interface\BusinessManagement\Repository\SafetyPrecautionRepositoryInterface;
use Modules\RideShare\Interface\BusinessManagement\Service\SafetyPrecautionServiceInterface;
use Modules\RideShare\Service\BaseService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class SafetyPrecautionService extends BaseService implements SafetyPrecautionServiceInterface
{
    protected $safetyPrecautionRepository;
    public function __construct(SafetyPrecautionRepositoryInterface $safetyPrecautionRepository)
    {
        parent::__construct($safetyPrecautionRepository);
        $this->safetyPrecautionRepository = $safetyPrecautionRepository;
    }

    public function create(Request|array $data): ?Model
    {
        $storeData = [
            'title' => $data['title'][array_search('default', $data['lang'])],
            'description' => $data['description'][array_search('default', $data['lang'])],
            'for_whom' => $data['for_whom'],
            'is_active' => 1,
        ];
        $precaution = $this->safetyPrecautionRepository->create($storeData);

        Helpers::add_or_update_translations(
            request: $data,
            key_data:'title',
            name_field:'title',
            model_name: get_class($precaution),
            data_id: $precaution->id,
            data_value: $precaution->title,
            model_class: true
        );
        
        Helpers::add_or_update_translations(
            request: $data,
            key_data:'description',
            name_field:'description',
            model_name: get_class($precaution),
            data_id: $precaution->id,
            data_value: $precaution->description,
            model_class: true
        );

        return $precaution;
    }

    public function update(int|string $id, array|Request $data = []): ?Model
    {
        $model = $this->findOne(id: $id);
        $updateData = [
            'title' => $data['title'][array_search('default', $data['lang'])],
            'description' => $data['description'][array_search('default', $data['lang'])],
            'for_whom' => $data['for_whom'],
        ];
        $precaution = $this->safetyPrecautionRepository->update($id, $updateData);

        Helpers::add_or_update_translations(
            request: $data, 
            key_data:'title', 
            name_field:'title', 
            model_name: get_class($precaution),
            data_id: $precaution->id,
            data_value: $precaution->title,
            model_class: true
        );
                
        Helpers::add_or_update_translations(
            request: $data,
            key_data:'description',
            name_field:'description',
            model_name: get_class($precaution),
            data_id: $precaution->id,
            data_value: $precaution->description,
            model_class: true
        );

        return $precaution;
    }
}
