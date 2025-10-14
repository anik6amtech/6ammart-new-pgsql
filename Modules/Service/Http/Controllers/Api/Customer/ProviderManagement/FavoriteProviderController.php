<?php

namespace Modules\Service\Http\Controllers\Api\Customer\ProviderManagement;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use Modules\Service\Entities\ProviderManagement\FavoriteProvider;
use Modules\Service\Entities\ProviderManagement\Provider;
use App\Models\Module;

class FavoriteProviderController extends Controller
{
    private Provider $provider;
    private FavoriteProvider $favoriteProvider;

    public function __construct(Provider $provider, FavoriteProvider $favoriteProvider)
    {
        $this->provider = $provider;
        $this->favoriteProvider = $favoriteProvider;
    }

    private function currentModule() {
        return config('module.current_module_data') ?? Module::where('module_type','service')->first();
    }

    private function zoneId() {
        return Config::get('zone_id');
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'limit' => 'required|numeric|min:1|max:200',
            'offset' => 'required|numeric|min:1|max:100000',
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        $providers = $this->provider->with(['subscribed_services.sub_category'=>function($query){
            $query->withoutGlobalScopes();
        }])
            ->withCount(['bookings as total_service_served' => function($query) {
                $query->where('booking_status', 'completed');
                }, 'subscribed_services'])
            ->ofStatus(1)
            ->when($request->has('category_ids'), function ($query) use($request) {
                $query->whereHas('subscribed_services', function ($query) use($request) {
                    if ($request->has('category_ids')) $query->whereIn('category_id', $request['category_ids']);
                });
            })
            ->when($this->currentModule(), function($query){
                $query->module($this->currentModule()->id);
            })
            ->when($request->has('rating'), function ($query) use($request) {
                $query->where('avg_rating', '>=', $request['rating']);
            })
            ->when($request->has('sort_by'), function ($query) use($request) {
                $query->orderBy('company_name', $request['sort_by']);
            })
            ->when(!$request->has('sort_by'), function ($query) use($request) {
                $query->latest();
            })
            ->whereHas('favorites', function($query){
                $query->where('customer_user_id', auth('api')->user()->id);
            })
            ->where('is_suspended',0)
            ->paginate($request['limit'], ['*'], 'offset', $request['offset'])->withPath('');

//        $filteredProviders = $providers->getCollection()->filter(function ($provider) {
//            return advertisementsEligibility($provider->id);
//        });
//
//        $providers->setCollection($filteredProviders->values());

        return response()->json(response_formatter(DEFAULT_200, $providers), 200);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'provider_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        $validateProvider = $this->provider
            ->where('id', $request->provider_id)
            ->ofStatus(1)
            ->when($this->currentModule(), function ($query) {
                $query->module($this->currentModule()->id);
            })
            ->first();
        if(!$validateProvider) {
            return response()->json(response_formatter(DEFAULT_404, null, ['booking' => 'Provider not found']), 404);
        }

        $favorite = $this->favoriteProvider
            ->where('customer_user_id',$request->user()->id)
            ->where('provider_id',$request->provider_id)
            ->when($this->currentModule(), function ($query) {
                $query->module($this->currentModule()->id);
            })
            ->first();

        if ($favorite){
            $favorite->delete();
            $status = 0;
        }else {
            $favorite = $this->favoriteProvider;
            $favorite->module_id = $this->currentModule()->id ?? null;
            $favorite->customer_user_id = $request->user()->id;
            $favorite->provider_id = $request->provider_id;
            $favorite->save();
            $status = 1;
        }

        if($status){
            return response()->json(response_formatter(PROVIDER_ADD_TO_FAVORITE_200,  ['status' => $status]), 200);
        }else{
            return response()->json(response_formatter(PROVIDER_REMOVE_FAVORITE_200,  ['status' => $status]), 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(Request $request ,$id): JsonResponse
    {
        $favorite = $this->favoriteProvider
            ->where('customer_user_id',$request->user()->id)
            ->when($this->currentModule(), function ($query) {
                $query->module($this->currentModule()->id);
            })
            ->where('provider_id',$id)
            ->first();

        if ($favorite){
            $favorite->delete();
            return response()->json(response_formatter(PROVIDER_REMOVE_FAVORITE_200), 200);
        }

        return response()->json(response_formatter(DEFAULT_404), 400);
    }
}
