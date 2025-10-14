<?php

namespace Modules\Service\Http\Controllers\Api\Customer\PromotionManagement;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use Modules\Service\Entities\PromotionManagement\Campaign;
use Modules\Service\Entities\PromotionManagement\DiscountType;
use App\Models\Module;

class CampaignController extends Controller
{
    private Campaign $campaign;
    private DiscountType $discountType;

    public function __construct(Campaign $campaign, DiscountType $discountType)
    {
        $this->campaign = $campaign;
        $this->discountType = $discountType;
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

        $campaigns = $this->campaign
            ->with(['discount', 'discount.category_types.category', 'discount.service_types.service.category', 'discount.service_types.service.subCategory' ,'discount.service_types.service.variations'])
            ->whereHas('discount', function ($query) {
                $query->when($this->currentModule(), function($query){
                    $query->module($this->currentModule()->id);
                });
            })
            ->where(function ($query) {
                $query->whereDoesntHave('discount.category_types')
                    ->orWhereHas('discount.category_types', function ($query) {
                        $query->whereHas('category', function ($query) {
                            $query->where('is_active', '!=', 0);
                        });
                    });
            })
            ->where(function ($query) {
                $query->whereDoesntHave('discount.service_types')
                    ->orWhereHas('discount.service_types', function ($query) {
                        $query->whereHas('service.category', function ($query) {
                            $query->where('is_active', '!=', 0);
                        })
                            ->orWhereHas('service.subCategory', function ($query) {
                                $query->where('is_active', '!=', 0);
                            });
                    });
            })
            ->ofStatus(1)
            ->paginate($request['limit'], ['*'], 'offset', $request['offset'])
            ->withPath('');

        return response()->json(response_formatter(DEFAULT_200, $campaigns), 200);
//        return response()->json(response_formatter(DEFAULT_200, self::variationMapper($campaigns)), 200);
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return JsonResponse
     */
    public function campaignItems(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'campaign_id' => 'required',
            'limit' => 'required|numeric|min:1|max:200',
            'offset' => 'required|numeric|min:1|max:100000'
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        $campaign = $this->campaign
            ->whereHas('discount', function ($query) {
                $query->where('promotion_type', 'campaign')
                    ->where('start_date', '<=', now())
                    ->where('end_date', '>=', now())
                    ->where('is_active', 1)
                    ->when($this->currentModule(), function($query){
                        $query->module($this->currentModule()->id);
                    });
            })
            ->whereHas('discount.discount_types', function ($query) {
                $query->where(['discount_type' => 'zone', 'type_wise_id' => config('zone_id')]);
            })
            ->where('id', $request['campaign_id'])
            ->first();

        if (isset($campaign)) {
            $items = $this->discountType->where(['discount_id' => $campaign->discount->id])
                ->with(['category' => function ($query) {
                    $query->where('is_active', 1);
                }])
                ->with(['service' => function ($query) {
                    $query->where('is_active', 1)->with(['variations']);
                }])
                ->with(['discount'])
                ->paginate($request['limit'], ['*'], 'offset', $request['offset'])->withPath('');
            return response()->json(response_formatter(DEFAULT_200, self::variationMapper($items)), 200);
//            return response()->json(response_formatter(DEFAULT_200, $items), 200);
        }

        return response()->json(response_formatter(DEFAULT_404), 200);
    }

    private function variationMapper($services)
    {
        $services->map(function ($service) {
            if($service?->service) {
                $service->service->variations_app_format = self::variationsAppFormat($service->service);
            }
            return $service;
        });

        return $services;
    }

    private function variationsAppFormat($service): array
    {
        $formatting = [];
        $filtered = $service->variations->where('zone_id', Config::get('zone_id'));
        $formatting['zone_id'] = Config::get('zone_id');
        $formatting['default_price'] = $filtered->first() ? $filtered->first()->price : 0;
        foreach ($filtered as $data) {
            $formatting['zone_wise_variations'][] = [
                'variant_key' => $data['variant_key'],
                'variant_name' => $data['variant'],
                'price' => $data['price']
            ];
        }
        return $formatting;
    }

}
