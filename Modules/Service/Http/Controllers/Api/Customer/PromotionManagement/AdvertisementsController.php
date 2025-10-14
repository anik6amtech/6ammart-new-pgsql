<?php

namespace Modules\Service\Http\Controllers\Api\Customer\PromotionManagement;

use App\Models\Advertisement;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use Modules\Service\Entities\ProviderManagement\FavoriteProvider;
use App\Models\Module;

class AdvertisementsController extends Controller
{

    public function __construct(
        private Advertisement $advertisement,
        private FavoriteProvider $favoriteProvider,
    )
    {}

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
    public function AdsList(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'limit' => 'required|numeric|min:1|max:200',
            'offset' => 'required|numeric|min:1|max:100000'
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        $advertisements = $this->advertisement->with(['provider', 'provider.subscribed_services.sub_category'=>function($query){
            $query->withoutGlobalScopes();
        }])
            ->when($this->currentModule(), function($query){
                $query->module($this->currentModule()->id);
            })
            ->where('module_type', 'service')
            ->orderByRaw('ISNULL(priority), priority')
            ->whereIn('status', ['approved', 'resumed'])->where('start_date', '<=', Carbon::today())->where('end_date', '>=', Carbon::today())
            ->whereHas('provider', function ($query) {
                $query->where('zone_id', $this->zoneId());
            })
            ->latest()
            ->paginate($request['limit'], ['*'], 'offset', $request['offset'])->withPath('');

        $filteredAdvertisement = $advertisements->getCollection()->filter(function ($advertisement) {
            return advertisementsEligibility($advertisement->store_id);
        });

        $advertisements->setCollection($filteredAdvertisement->values());

        $isCustomerLoggedIn = (bool)auth('api')->user();
        $customerUserId = $isCustomerLoggedIn ? auth('api')->user()->id : $request['guest_id'];

        foreach($advertisements as $advertisement){

            $advertisement->provider_review = $advertisement?->provider?->rating_count;
            $advertisement->provider_rating = $advertisement?->provider?->avg_rating;

            $advertisement->provider->is_favorite = $this->favoriteProvider
                ->where('customer_user_id', $customerUserId)
                ->where('provider_id', $advertisement->provider->id)
                ->exists() ? 1 : 0;
        }

        return response()->json(response_formatter(DEFAULT_200, $advertisements), 200);
    }

}
