<?php

namespace Modules\Service\Http\Controllers\Api\Provider\BidModule;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\Service\Entities\BidModule\IgnoredPost;
use Modules\Service\Entities\BidModule\Post;
use Modules\Service\Entities\ProviderManagement\SubscribedService;
use App\Models\Module;
use function response;
use function response_formatter;

class PostController extends Controller
{
    public function __construct(
        private Post              $post,
        private SubscribedService $subscribed_service,
        private IgnoredPost       $ignored_post,
    )
    {
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
            'offset' => 'required|numeric|min:1|max:100000',
            'status' => 'in:new_request,placed_offer,booking_placed'
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        $subscribed_sub_categories = $this->subscribed_service
            ->where(['provider_id' => $request->user('provider')->id])
            ->where(['is_subscribed' => 1])->pluck('sub_category_id')->toArray();

        $ignored_posts = $this->ignored_post->where('provider_id', $request->user('provider')->id)->pluck('post_id')->toArray();
        $bidding_post_validity = (int)(business_config('post_validation_days', 'service_business_settings'))->value;
        $posts = $this->post
            ->with(['addition_instructions', 'service', 'category', 'sub_category', 'booking', 'customer'])
            ->where('is_booked', 0)
            ->whereNotIn('id', $ignored_posts)
            ->whereIn('sub_category_id', $subscribed_sub_categories)
            ->where('module_id', $this->currentModule()?->id)
            ->where('zone_id', $request->user('provider')->zone_id)
            ->whereBetween('created_at', [Carbon::now()->subDays($bidding_post_validity), Carbon::now()])
            ->when($request->has('status') && $request['status'] != 'new_request', function ($query) use ($request) {
                $query->whereHas('bids', function ($query) use ($request) {
                    if ($request['status'] == 'placed_offer') {
                        $query->where('status', 'pending')->where('provider_id', $request->user('provider')->id);
                    } else if ($request['status'] == 'booking_placed') {
                        $query->where('status', 'accepted');
                    }
                });
            })
            ->when($request->has('status') && $request['status'] == 'new_request', function ($query) use ($request) {
                if($request->user('provider')?->service_availability && (!$request->user('provider')?->is_suspended || !business_config('provider_suspend_on_exceed_cash_limit', 'service_business_settings')->value)){
                    $query->whereDoesntHave('bids', function ($query) use ($request) {
                        $query->where('provider_id', $request->user('provider')->id);
                    });
                }else{
                    $query->whereNull('id');
                }
            })
            ->latest()
            ->paginate($request['limit'], ['*'], 'offset', $request['offset'])
            ->withPath('');

        if ($posts->count() < 1) {
            return response()->json(response_formatter(DEFAULT_404, null), 404);
        }

        $coordinates = auth('provider')->user()->coordinates ?? null;
        foreach ($posts as $post) {
            $distance = null;
            if(!is_null($coordinates) && $post->service_address) {
                $distance = get_distance(
                    [$coordinates['latitude']??null, $coordinates['longitude']??null],
                    [$post->service_address?->latitude, $post->service_address?->longitude]
                );
                $distance = ($distance) ? number_format($distance, 2) .' km' : null;
            }
            $post->distance = $distance;
        }

        return response()->json(response_formatter(DEFAULT_200, $posts), 200);
    }

    /**
     * Display a listing of the resource.
     * @param $post_id
     * @param Request $request
     * @return JsonResponse
     */
    public function show($post_id, Request $request): JsonResponse
    {
        $post = $this->post
            ->where('module_id', $this->currentModule()?->id)
            ->with(['customer', 'addition_instructions', 'service', 'category', 'sub_category', 'booking', 'service_address'])
            ->withCount(['bids'])
            ->where('id', $post_id)
            ->first();

        if (!isset($post)) {
            return response()->json(response_formatter(DEFAULT_404, null), 404);
        }

        $coordinates = auth('provider')->user()->coordinates ?? null;
        $distance = null;
        if(!is_null($coordinates) && $post->service_address) {
            $distance = get_distance(
                [$coordinates['latitude']??null, $coordinates['longitude']??null],
                [$post->service_address?->latitude, $post->service_address?->longitude]
            );
            $distance = ($distance) ? number_format($distance, 2) .' km' : null;
        }
        $post->distance = $distance;

        return response()->json(response_formatter(DEFAULT_200, $post), 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function decline(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'post_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        $this->ignored_post->updateOrCreate(
            ['post_id' => $request['post_id'], 'provider_id' => $request->user('provider')->id], [
            'post_id' => $request['post_id'],
        ]);

        return response()->json(response_formatter(DEFAULT_200, null), 200);
    }
}
