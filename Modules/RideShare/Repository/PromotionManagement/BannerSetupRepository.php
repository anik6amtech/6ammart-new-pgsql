<?php

namespace Modules\RideShare\Repository\PromotionManagement;

use App\Models\Banner;
use Modules\RideShare\Interface\PromotionManagement\Repository\BannerSetupRepositoryInterface;
use Modules\RideShare\Repository\BaseRepository;

class BannerSetupRepository extends BaseRepository implements BannerSetupRepositoryInterface
{
    public function __construct(Banner $model)
    {
        parent::__construct($model);
    }
    public function list($data, $limit, $offset, $withoutGlobalScope = [])
    {
        return $this->model
            // ->whereHas('zone.modules', function($query){
            //         $query->where('modules.id', config('module.current_module_data')['id']);
            //     })
            // ->module(config('module.current_module_data')['id'])
            ->where('status', 1)
            ->when(!empty($withoutGlobalScope), function ($query) use ($withoutGlobalScope) {
                    foreach ($withoutGlobalScope as $scope) {
                        $query->withoutGlobalScope($scope);
                    }
                })
            ->where(function ($query) use ($data) {
                $query->where('time_period', '!=', 'period') // Exclude rows where time_period is not "period"
                    ->orWhere(function ($periodQuery) use ($data) {
                        $periodQuery->whereNull('start_date')
                            ->orWhere(function ($dateQuery) use ($data) {
                                $dateQuery->where('start_date', '<=', $data)
                                    ->where('end_date', '>=', $data);
                            });
                    });
            })
            ->module(config('module.current_module_data')['id'])
            ->paginate($limit, ['*'], 'page', $offset ?? 1);
    }
}
