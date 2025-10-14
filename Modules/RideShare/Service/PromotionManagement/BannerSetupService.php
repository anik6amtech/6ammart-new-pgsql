<?php

namespace Modules\RideShare\Service\PromotionManagement;

use App\CentralLogics\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Modules\RideShare\Interface\PromotionManagement\Repository\BannerSetupRepositoryInterface;
use Modules\RideShare\Interface\PromotionManagement\Service\BannerSetupServiceInterface;
use Modules\RideShare\Service\BaseService;

class BannerSetupService extends BaseService implements BannerSetupServiceInterface
{
    protected $bannerSetupRepository;
    public function __construct(BannerSetupRepositoryInterface $baseRepository)
    {
        parent::__construct($baseRepository);
        $this->bannerSetupRepository = $baseRepository;
    }

    public function list($data,$limit,$offset, $withoutGlobalScope = []){
        return $this->bannerSetupRepository->list($data,$limit,$offset, $withoutGlobalScope);
    }

    public function create(array|Request $data): ?Model
    {
        $storeData = [
            'title'=>$data['title'][array_search('default', $data['lang'])],
            // 'description'=>$data['short_desc'],
            // 'display_position'=>$data['display_position'] ?? null,
            'time_period'=>$data['time_period'],
            'default_link'=>$data['redirect_link'],
            // 'banner_group'=>$data['banner_group'] ?? null,
            'start_date'=>$data['start_date'] ?? null,
            'end_date'=>$data['end_date'] ?? null,
            'image'=> fileUploader('banner', 'png', $data['banner_image']),
            'type' => 'default',
            'data' => '',
            'module_id' => Config::get('module.current_module_id'),
            'status' => 1,
        ];
        $banner = parent::create($storeData);

        Helpers::add_or_update_translations(
            request: $data, 
            key_data:'title', 
            name_field:'title', 
            model_name: get_class($banner),
            data_id: $banner->id,
            data_value: $banner->title,
            model_class: true
        );
       
        return $banner;
    }

    public function update(int|string $id, array|Request $data = []): ?Model
    {
        $model = $this->findOne(id: $id);
        $updateData = [
            'title'=>$data['title'][array_search('default', $data['lang'])],
            // 'description'=>$data['short_desc'],
            // 'display_position'=>$data['display_position'] ?? null,
            'time_period'=>$data['time_period'],
            'default_link'=>$data['redirect_link'],
            // 'banner_group'=>$data['banner_group'] ?? null,
            'start_date'=>$data['start_date'] ?? null,
            'end_date'=>$data['end_date'] ?? null,
        ];
        if (($data->hasFile('banner_image'))) {
            $updateData = array_merge($updateData,[
                'image'=>fileUploader('banner', 'png', $data['banner_image'], $model->image),
            ]);
        }
        $banner = parent::update($id, $updateData);

        Helpers::add_or_update_translations(
            request: $data, 
            key_data:'title', 
            name_field:'title', 
            model_name: get_class($banner),
            data_id: $banner->id,
            data_value: $banner->title,
            model_class: true
        );
       
        return $banner;
    }

    public function statusChange(string|int $id, array $data): ?Model
    {
        $data = [
            'status' => $data['status'] == 0 ? $data['status'] : 1
        ];
        return $this->baseRepository->update(id: $id, data: $data);
    }

    public function featuredChange(string|int $id, array $data): ?Model
    {
        $data = [
            'featured' => $data['featured'] == 0 ? $data['featured'] : 1
        ];
        return $this->baseRepository->update(id: $id, data: $data);
    }
}
