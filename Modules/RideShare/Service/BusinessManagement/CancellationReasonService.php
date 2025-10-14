<?php

namespace Modules\RideShare\Service\BusinessManagement;

use App\CentralLogics\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Modules\RideShare\Interface\BusinessManagement\Repository\CancellationReasonRepositoryInterface;
use Modules\RideShare\Interface\BusinessManagement\Service\CancellationReasonServiceInterface;
use Modules\RideShare\Service\BaseService;

class CancellationReasonService extends BaseService implements CancellationReasonServiceInterface
{
    protected $cancellationReasonRepository;
    public function __construct(CancellationReasonRepositoryInterface $cancellationReasonRepository)
    {
        parent::__construct($cancellationReasonRepository);
        $this->cancellationReasonRepository = $cancellationReasonRepository;
    }

    public function create(Request|array $data): ?Model
    {
        $storeData = [
            'title' => $data['title'][array_search('default', $data['lang'])],
            'cancellation_type' => $data['cancellation_type'],
            'user_type' => $data['user_type'],
            'is_active' => 1,
        ];
        $reason = $this->cancellationReasonRepository->create($storeData);

        Helpers::add_or_update_translations(
            request: $data,
            key_data:'title',
            name_field:'title',
            model_name: get_class($reason),
            data_id: $reason->id,
            data_value: $reason->title,
            model_class: true
        );

        return $reason;
    }

    public function update(int|string $id, array|Request $data = []): ?Model
    {
        $model = $this->findOne(id: $id);
        $updateData = [
            'title' => $data['title'][array_search('default', $data['lang'])],
            'cancellation_type' => $data['cancellation_type'],
            'user_type' => $data['user_type'],
        ];
        $reason = $this->cancellationReasonRepository->update($id, $updateData);

        Helpers::add_or_update_translations(
            request: $data, 
            key_data:'title', 
            name_field:'title', 
            model_name: get_class($reason),
            data_id: $reason->id,
            data_value: $reason->title,
            model_class: true
        );
        return $reason;
    }
}
