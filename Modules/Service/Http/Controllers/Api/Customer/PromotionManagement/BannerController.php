<?php

namespace Modules\Service\Http\Controllers\Api\Customer\PromotionManagement;

use App\Models\Banner;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Module;

class BannerController extends Controller
{
    private Banner $banner;

    public function __construct(Banner $banner)
    {
        $this->banner = $banner;
    }

    private function currentModule() {
        return config('module.current_module_data') ?? Module::where('module_type','service')->first();
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'limit' => 'required|numeric|min:1|max:200',
            'offset' => 'required|numeric|min:1|max:100000'
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        $banners = $this->banner
            ->active()
            ->with(['service' => function ($query) {
                $query->where('is_active', 1);
            }])
            ->with(['category' => function ($query) {
                $query->where('is_active', 1);
            }])
            ->when($this->currentModule(), function($query){
                $query->module($this->currentModule()->id);
            })
            ->where(function ($query) {
                $query->where(function ($query) {
                    $query->where('type', 'service')
                        ->whereHas('service', function ($query) {
                            $query->where('is_active', 1);
                        });
                })
                ->orWhere(function ($query) {
                    $query->where('type', 'category')
                        ->whereHas('category', function ($query) {
                            $query->where('is_active', 1);
                        });
                });
            })
            ->paginate($request['limit'], ['*'], 'offset', $request['offset'])->withPath('');
            
        return response()->json(response_formatter(DEFAULT_200, $banners), 200);
    }
}
