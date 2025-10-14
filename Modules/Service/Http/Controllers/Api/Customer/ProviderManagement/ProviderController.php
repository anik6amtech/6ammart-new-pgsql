<?php

namespace Modules\Service\Http\Controllers\Api\Customer\ProviderManagement;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Modules\Service\Entities\BookingModule\Booking;
use Modules\Service\Entities\CategoryManagement\Category;
use Modules\Service\Entities\ProviderManagement\FavoriteProvider;
use Modules\Service\Entities\ProviderManagement\Provider;
use Modules\Service\Entities\ProviderManagement\SubscribedService;
use Modules\Service\Entities\Review\Review;
use Modules\Service\Entities\ServiceManagement\FavoriteService;
use Modules\Service\Entities\ServiceManagement\Service;
use Modules\Service\Entities\ServiceManagement\Variation;
use App\Models\Module;

class ProviderController extends Controller
{
    private Provider $provider;
    private Category $category;
    private SubscribedService $subscribed_service;
    private Booking $booking;
    private Review $review;
    private Service $service;
    private FavoriteProvider $favoriteProvider;
    private FavoriteService $favoriteService;
    private Variation $variation;

    private bool $is_customer_logged_in;
    private mixed $customer_user_id;

    public function __construct(Provider $provider, Review $review, Category $category, SubscribedService $subscribed_service, Booking $booking, Service $service, Variation $variation, FavoriteProvider $favoriteProvider, FavoriteService $favoriteService, Request $request)
    {
        $this->provider = $provider;
        $this->category = $category;
        $this->subscribed_service = $subscribed_service;
        $this->booking = $booking;
        $this->service = $service;
        $this->variation = $variation;
        $this->favoriteProvider = $favoriteProvider;
        $this->favoriteService = $favoriteService;
        $this->review = $review;

        $this->is_customer_logged_in = (bool)auth('api')->user();
        $this->customer_user_id = $this->is_customer_logged_in ? auth('api')->user()->id : $request['guest_id'];
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
    public function getProviderList(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'limit' => 'required|numeric|min:1|max:200',
            'offset' => 'required|numeric|min:1|max:100000',
            'sort_by' => 'in:asc,desc,default,popular',
            'service_availability' => 'in:0,1',
            'category_ids' => 'array',
            'rating' => '',
            'search' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        $providersIds =  $this->provider
            ->ofStatus(1)
            ->ofApproval(1)
            ->where('is_suspended', 0)
            ->when($this->currentModule(), function ($query) {
                $query->module($this->currentModule()->id);
            })
            ->pluck('id');

        $eligibleProviderIds = $providersIds->filter(function ($id) {
            return nextBookingEligibility($id);
        })->values()->all();
        $eligibleProviderIds = $providersIds->toArray();

        $providersQuery = $this->provider->with(['subscribed_services.sub_category' => function ($query) {
            $query->withoutGlobalScopes();
        }])
            ->where('zone_id', $this->zoneId())
            ->whereIn('id', $eligibleProviderIds)
            ->ofStatus(1)
            ->withCount(['bookings as total_service_served' => function ($query) {
                $query->where('booking_status', 'completed');
            }, 'subscribed_services'])
            ->when($request->has('category_ids') || $request->has('sub_category_ids'), function ($query) use ($request) {
                $query->whereHas('subscribed_services', function ($q) use ($request) {
                    $q->when($request->has('category_ids'), function ($q) use ($request) {
                        $q->whereIn('category_id', $request->category_ids);
                    });

                    $q->when($request->has('sub_category_ids'), function ($q) use ($request) {
                        $q->whereIn('sub_category_id', $request->sub_category_ids);
                    });
                });
            })
            ->when($request->has('rating'), function ($query) use ($request) {
                $query->where('avg_rating', '>=', $request['rating']);
            })
            ->when($request->has('service_availability'), function ($query) use ($request) {
                $query->where('service_availability', $request['service_availability']);
            })
            ->when($request->has('search') && $request->search != null, function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('company_name', 'like', '%' . $request->search . '%')
                        ->orWhere('company_phone', 'like', '%' . $request->search . '%');
                });
            })
            ->when($request->has('sort_by'), function ($query) use ($request) {
                if ($request['sort_by'] == 'asc' || $request['sort_by'] == 'desc') {
                    $query->orderBy('company_name', $request['sort_by']);
                } elseif ($request['sort_by'] == 'popular') {
                    $query->orderBy('avg_rating', 'desc');
                }
            })
            ->when(!$request->has('sort_by') || $request['sort_by'] === 'default', function ($query) {
                $query->latest();
            })
            ->where('is_suspended', 0);

        $providers = $providersQuery->paginate($request['limit'], ['*'], 'page', $request['offset'])->withPath('');

        foreach ($providers as $provider) {
            $provider['is_favorite'] = $this->favoriteProvider
                ->where('customer_user_id', $this->customer_user_id)
                ->where('provider_id', $provider->id)
                ->exists() ? 1 : 0;
        }

        return response()->json(response_formatter(DEFAULT_200, $providers), 200);

    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return JsonResponse
     */
    public function getProviderDetails(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'limit' => 'required|numeric|min:1|max:200',
            'offset' => 'required|numeric|min:1|max:100000',
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        $provider = $this->provider
            ->with(['schedules'])
            ->withCount(['bookings as total_service_served' => function($query) {
                $query->where('booking_status', 'completed');
            }, 'subscribed_services'])
            ->find($request['id']);

        $provider['is_favorite'] = $this->favoriteProvider
            ->where('customer_user_id', $this->customer_user_id)
            ->where('provider_id', $provider->id)
            ->exists() ? 1 : 0;

        if (!isset($provider)) return response()->json(response_formatter(DEFAULT_404), 404);

        $review = $this->review
            ->with(['customer', 'reviewReply', 'service' => function ($query) {
                $query->select('id', 'name', 'cover_image', 'thumbnail')
                    ->withoutGlobalScopes();
            }])
            ->where('provider_id', $provider->id)
            ->where('review_comment', '!=', null)
            ->when($this->currentModule(), function ($query) {
                $query->module($this->currentModule()->id);
            })
            ->ofStatus(1)
            ->latest()
            ->paginate($request['limit'], ['*'], 'page', $request['offset'])
            ->withPath('');

       /* // NOTE: this is added in with('schedules') above
        $timeSchedule = provider_config('time_schedule', 'service_business_settings', $provider['id'])?->value;
        $weekEnds = provider_config('weekends', 'service_business_settings', $provider['id'])->value ?? '';
        $weekEnds = json_decode($weekEnds);
        $timeSchedule = json_decode($timeSchedule);

        $provider['time_schedule'] = $timeSchedule ?? null;
        $provider['weekends'] = $weekEnds ?? [];
       */

        $provider['nextBookingEligibility'] = nextBookingEligibility($provider->id);
        $provider['scheduleBookingEligibility'] = scheduleBookingEligibility($provider->id);
        $provider['instantBookingEligibility'] = instantBookingEligibility($provider->id);
        $provider['repeatBookingEligibility'] = repeatBookingEligibility($provider->id);

        $userAccount = getUserAccount($provider->id, PROVIDER);
        $limitStatus = provider_warning_amount_calculate($userAccount->payable_balance, $userAccount->receivable_balance);
        $provider['cash_limit_status'] = $limitStatus == false ? 'available' : $limitStatus;

        $subscribedSubCategoryIds = $this->subscribed_service
            ->ofStatus(1)
            ->where('provider_id', $provider->id)
            ->pluck('sub_category_id')
            ->toArray();

        $subCategories = $this->category->withoutGlobalScopes()
            ->with(['services' => function ($query) {
                $query->ofStatus(1)
                    ->where(function ($query) {
                        $query->whereDoesntHave('service_discount')
                            ->orWhereHas('service_discount');
                    })
                    ->where(function ($query) {
                        $query->whereDoesntHave('category.category_discount')
                            ->orWhereHas('category.category_discount');
                    })
                    ->with(['variations', 'service_discount', 'category.category_discount']);
            }])
            ->whereHas('services', function ($query) {
                $query->ofStatus(1);
            })
            ->whereIn('id', $subscribedSubCategoryIds)
            ->get();

        foreach ($subCategories as $item) {
            if ($item->services) {
                $item->services = self::variationMapper($item->services);

                foreach ($item->services as $service) {
                    $service->is_favorite = $this->favoriteService
                        ->where('customer_user_id', $this->customer_user_id)
                        ->where('service_id', $service->id)
                        ->exists() ? 1 : 0;
                }
            }
        }

        $ratingGroupCount = DB::table('service_reviews')->where('provider_id', $provider->id)
            ->where('is_active', 1)
            ->select('review_rating', DB::raw('count(review_comment) as total_comment'), DB::raw('count(*) as total'))
            ->groupBy('review_rating')
            ->get();

        $totalRating = 0;
        $ratingCount = 0;
        $reviewCount = 0;
        $positiveCount = 0;

        foreach ($ratingGroupCount as $count) {
            $totalRating += round($count->review_rating * $count->total, 2);
            $ratingCount += $count->total;
            $reviewCount += $count->total_comment;
            
            // Count positive ratings (4 or 5 stars)
            if ($count->review_rating >= 4) {
                $positiveCount += $count->total;
            }
        }

        $positivePercentage = $ratingCount > 0 ? round(($positiveCount / $ratingCount) * 100, 2) : 0;

        $ratingInfo = [
            'rating_count' => $ratingCount,
            'review_count' => $reviewCount,
            'average_rating' => round(divnum($totalRating, $ratingCount), 2),
            'positive_rating_percentage' => $positivePercentage,
            'rating_group_count' => $ratingGroupCount,
        ];

        return response()->json(response_formatter(DEFAULT_200, ['provider' => $provider, 'sub_categories' => $subCategories, 'reviews' => $review, 'rating' => $ratingInfo]), 200);
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return JsonResponse
     */
    public function getProviderListBySubCategory(Request $request): JsonResponse
    {
        $providers = $this->provider
            ->where('zone_id', Config::get('zone_id'))
            ->whereHas('subscribed_services', function ($query) use ($request) {
                $query->where('sub_category_id', $request['sub_category_id']);
            })
            ->when($this->currentModule(), function ($query) {
                $query->module($this->currentModule()->id);
            })
            ->where('service_availability', 1)
            ->where('is_suspended', 0)
            ->where('is_active', 1)
            ->get();

        $eligibleProviders = [];

        foreach ($providers as $provider) {
            if (!nextBookingEligibility($provider->id)) {
                continue;
            }

            $providerAccount = getUserAccount($provider->id, PROVIDER);
            $limitStatus = provider_warning_amount_calculate(
                $providerAccount->payable_balance,
                $providerAccount->receivable_balance
            );
            $provider['cash_limit_status'] = $limitStatus === false ? 'available' : $limitStatus;
            $provider['cash_limit_status'] = 'available';

            $provider['is_favorite'] = $this->favoriteProvider
                ->where('customer_user_id', $this->customer_user_id)
                ->where('provider_id', $provider->id)
                ->exists() ? 1 : 0;

            $eligibleProviders[] = $provider;
        }

        return response()->json(response_formatter(DEFAULT_200, $eligibleProviders), 200);
    }

    private function variationMapper($services)
    {
        $services->map(function ($service) {
            $service['variations_app_format'] = self::variationsAppFormat($service);
            return $service;
        });
        return $services;
    }

    private function variationsAppFormat($service): array
    {
        $formatting = [];
        $filtered = $service['variations']->where('zone_id', Config::get('zone_id'));
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

    public function getAvailableProvider(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'limit' => 'required|numeric|min:1|max:200',
            'offset' => 'required|numeric|min:1|max:100000',
            'sort_by' => 'in:asc,desc',
            'booking_id' => 'required',
            'rating' => '',
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        $booking = $this->booking->where('id', $request->booking_id)->first();
        if(!$booking) {
            return response()->json(response_formatter(DEFAULT_404, null, ['booking' => 'Booking not found']), 404);
        }

        $providers = $this->provider
            ->where('zone_id', $booking->zone_id)
            ->when($this->currentModule(), function ($query) {
                $query->module($this->currentModule()->id);
            })
            ->ofStatus(1)
            ->when(isset($booking->sub_category_id), function ($query) use ($request, $booking) {
                $query->whereHas('subscribed_services', function ($query) use ($request, $booking) {
                    $query->where('sub_category_id', $booking->sub_category_id)->where('is_subscribed', 1);
                });
            })
            ->when($request->has('rating'), function ($query) use ($request) {
                $query->where('avg_rating', '>=', $request['rating']);
            })
            ->when($request->has('sort_by'), function ($query) use ($request) {
                $query->orderBy('company_name', $request['sort_by']);
            })
            ->when(!$request->has('sort_by'), function ($query) use ($request) {
                $query->latest();
            })
            ->paginate($request['limit'], ['*'], 'offset', $request['offset'])->withPath('');

        foreach ($providers as $provider) {
            $provider['is_favorite'] = $this->favoriteProvider->where('customer_user_id', $this->customer_user_id)->where('provider_id', $provider->id)->exists() ? 1 : 0;
        }


        return response()->json(response_formatter(DEFAULT_200, $providers), 200);
    }

    public function getAvailableService(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'limit' => 'required|numeric|min:1|max:200',
            'offset' => 'required|numeric|min:1|max:100000',
            'service_ids' => 'required|array',
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        $services = $this->service
            ->where('is_active', 1)
            ->when($this->currentModule(), function ($query) {
                $query->module($this->currentModule()->id);
            })
            ->whereIn('id', $request['service_ids'])
            ->paginate($request['limit'], ['*'], 'offset', $request['offset'])->withPath('');

        return response()->json(response_formatter(DEFAULT_200, $services), 200);
    }

    public function rebookingInformation(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'limit' => 'required|numeric|min:1|max:200',
            'offset' => 'required|numeric|min:1|max:100000',
            'booking_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        $booking = $this->booking->with('detail')
            ->where('id', $request->booking_id)
            ->when($this->currentModule(), function ($query) {
                $query->module($this->currentModule()->id);
            })
            ->first();
        if(!$booking) {
            return response()->json(response_formatter(DEFAULT_404, null, ['booking' => 'Booking not found']), 404);
        }
        $bookingServices = $booking->detail ?? [];

        //provider ...
        $provider = $this->provider
            ->where('id', $booking?->provider_id)
            ->ofStatus(1)
            ->where('zone_id', $this->zoneId())
            ->when(business_config('provider_suspend_on_exceed_cash_limit', 'service_business_settings')->value, function ($query) {
                $query->where('is_suspended', 0);
            })
            ->whereHas('subscribed_services', function ($query) use ($request, $booking) {
                $query->where('sub_category_id', $booking?->sub_category_id)->where('is_subscribed', 1);
            })
            ->first();

        //service ...
        $services = [];
        foreach ($bookingServices as $key => $service) {
            $serviceData = $this->service
                ->with(['variations' => function ($query) use ($service, $booking, $request) {
                    $query->where('variant_key', $service->variant_key)->where('zone_id', $this->zoneId());
                }])
                ->where('id', $service->service_id)
                ->active()
                ->first();

            $services[] = [
                'service_id' => $service->service_id,
                'service_name' => $service->service_name,
                'variant_key' => $service->variant_key,

                'service_unit_cost' => $serviceData?->variations?->first()?->price,
                'booking_service_unit_cost' => $service->service_cost,

                'is_available' => $serviceData?->variations?->first() ? 1 : 0,
                'is_price_changed' => ($serviceData?->variations?->first()?->price == $service->service_cost) || $serviceData?->variations?->first()?->price == null ? 0 : 1,
            ];
        }

        $isServiceInfoUnchanged = count(array_filter($services, function ($service) {
            return $service['is_price_changed'] === 1;
        })) === 0 ? 1 : 0;

        $data = [
            'is_provider_available' => $provider ? 1 : 0,
            'is_service_info_unchanged' => $isServiceInfoUnchanged,
            'services' => $services,
        ];

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        return response()->json(response_formatter(DEFAULT_200, $data), 200);
    }

}
