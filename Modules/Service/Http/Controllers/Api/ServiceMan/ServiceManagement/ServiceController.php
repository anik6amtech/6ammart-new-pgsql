<?php

namespace Modules\Service\Http\Controllers\Api\ServiceMan\ServiceManagement;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\Service\Entities\ProviderManagement\Provider;
use Modules\Service\Entities\ProviderManagement\SubscribedService;
use Modules\Service\Entities\Review\Review;
use Modules\Service\Entities\ServiceManagement\Service;

class ServiceController extends Controller
{
    private Service $service;
    private Review $review;
    private SubscribedService $subscribed_service;

    public function __construct(Service $service, Review $review, SubscribedService $subscribed_service)
    {
        $this->service = $service;
        $this->review = $review;
        $this->subscribed_service = $subscribed_service;
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return JsonResponse
     */
    public function servicesBySubcategory(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'limit' => 'required|numeric|min:1|max:200',
            'offset' => 'required|numeric|min:1|max:100000',
            'sub_category_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        $provider = Provider::find(request()?->user('serviceman')->service_provider_id);
        if (!$provider) {
            return response()->json(response_formatter(DEFAULT_404), 404);
        }
        $services = $this->service
            ->with(['category.zonesBasicInfo', 'service_discount', 'campaign_discount', 'variations' => function ($query) use ($provider) {
        $query->where('zone_id', $provider->zone_id)->with('zone:id,name');
    }])
            ->whereHas('subCategory', fn ($query) => $query->where('sub_category_id', $request['sub_category_id']))
            ->whereHas('category.zones', function ($query) use ($provider) {
                $query->where('zone_id', $provider->zone_id);
            })
            ->latest()
            ->paginate($request['limit'], ['*'], 'offset', $request['offset'])
            ->withPath('');

        if (!isset($services)) return response()->json(response_formatter(DEFAULT_404), 404);

        return response()->json(response_formatter(DEFAULT_200, $services), 200);
    }
}
