<?php

namespace Modules\RideShare\Service\BusinessManagement;

use App\CentralLogics\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Modules\RideShare\Interface\BusinessManagement\Repository\SafetyAlertReasonRepositoryInterface;
use Modules\RideShare\Interface\BusinessManagement\Service\SafetyAlertReasonServiceInterface;
use Modules\RideShare\Service\BaseService;

class SafetyAlertReasonService extends BaseService implements SafetyAlertReasonServiceInterface
{
    protected $safetyAlertReasonRepository;
    public function __construct(SafetyAlertReasonRepositoryInterface $safetyAlertReasonRepository)
    {
        parent::__construct($safetyAlertReasonRepository);
        $this->safetyAlertReasonRepository = $safetyAlertReasonRepository;
    }

    public function create(Request|array $data): ?Model
    {
        $storeData = [
            'reason' => $data['reason'][array_search('default', $data['lang'])],
            'reason_for_whom' => $data['reason_for_whom'],
            'is_active' => 1,
        ];
        $reason = $this->safetyAlertReasonRepository->create($storeData);

        Helpers::add_or_update_translations(
            request: $data,
            key_data:'reason',
            name_field:'reason',
            model_name: get_class($reason),
            data_id: $reason->id,
            data_value: $reason->reason,
            model_class: true
        );

        return $reason;
    }

    public function update(int|string $id, array|Request $data = []): ?Model
    {
        $model = $this->findOne(id: $id);
        $updateData = [
            'reason' => $data['reason'][array_search('default', $data['lang'])],
            'reason_for_whom' => $data['reason_for_whom'],
        ];
        $reason = $this->safetyAlertReasonRepository->update($id, $updateData);

        Helpers::add_or_update_translations(
            request: $data, 
            key_data:'reason', 
            name_field:'reason', 
            model_name: get_class($reason),
            data_id: $reason->id,
            data_value: $reason->reason,
            model_class: true
        );
        return $reason;
    }
}
