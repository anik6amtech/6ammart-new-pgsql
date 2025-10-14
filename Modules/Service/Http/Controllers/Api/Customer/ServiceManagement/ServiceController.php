<?php

namespace Modules\Service\Http\Controllers\Api\Customer\ServiceManagement;

use App\Models\Zone;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Modules\Service\Entities\BookingModule\Booking;
use Modules\Service\Entities\Review\Review;
use Modules\Service\Entities\ServiceManagement\FavoriteService;
use Modules\Service\Entities\ServiceManagement\RecentSearch;
use Modules\Service\Entities\ServiceManagement\RecentView;
use Modules\Service\Entities\ServiceManagement\Service;
use Modules\Service\Entities\ServiceManagement\Variation;
use Modules\Service\Traits\CustomerManagement\CustomerSearchTrait;
use Modules\Service\Traits\ServiceManagement\VisitedServiceTrait;
use Stevebauman\Location\Facades\Location;
use App\Models\Module;
use Modules\Service\Entities\CategoryManagement\Category;
use Modules\Service\Entities\ServiceManagement\ServiceRequest;

class ServiceController extends Controller
{
    use VisitedServiceTrait;
    use CustomerSearchTrait;

    private Service $service;
    private Review $review;
    private RecentView $recentView;
    private RecentSearch $recentSearch;
    private Booking $booking;
    private Zone $zone;
    private FavoriteService $favoriteService;

    private bool $is_customer_logged_in;
    private mixed $customer_user_id;

    public function __construct(Service $service, Review $review, RecentView $recentView, Booking $booking, Zone $zone, FavoriteService $favoriteService, Request $request, RecentSearch $recentSearch)
    {
        $this->service = $service;
        $this->review = $review;
        $this->recentView = $recentView;
        $this->recentSearch = $recentSearch;
        $this->booking = $booking;
        $this->zone = $zone;
        $this->favoriteService = $favoriteService;

        $this->is_customer_logged_in = (bool)auth('api')->user();
        $this->customer_user_id = $this->is_customer_logged_in ? auth('api')->user()->id : $request['guest_id'];
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

        $services = $this->service
            ->with(['category.zonesBasicInfo', 'variations', 'service_discount', 'category.category_discount'])
            ->where(function ($query) {
                $query->whereDoesntHave('service_discount')
                    ->orWhereHas('service_discount');
            })
            ->orWhere(function ($query) {
                $query->whereDoesntHave('category.category_discount')
                    ->orWhereHas('category.category_discount');
            })
            ->when($this->currentModule(), function($query){
                $query->module($this->currentModule()->id);
            })
            ->active()
            ->latest()
            ->paginate($request['limit'], ['*'], 'offset', $request['offset'])
            ->withPath('');

        foreach ($services as $service){
            $service['is_favorite'] = $this->favoriteService->where('customer_user_id',$this->customer_user_id)->where('service_id',$service->id)->exists() ? 1 : 0;
        }

        return response()->json(response_formatter(DEFAULT_200, self::variationMapper($services)), 200);
    }

    public function search(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'limit' => 'required|numeric|min:1|max:200',
            'offset' => 'required|numeric|min:1|max:100000',
            'string' => 'nullable',
            'sort_by' => 'nullable|in:default,a_to_z,z_to_a,high_to_low,low_to_high',
            'sort_by_type' => 'nullable|in:default,top_rated,most_loved,popular,newest,recommended,trending',
            'provider_id' => 'nullable'
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        $searchString = $request->input('string');
        $decodedString = $searchString;
        $keys = explode(' ', $decodedString);
        $zoneId = Config::get('zone_id');

        $authUser = auth('api')->user();

        if((isset($request['sub_category_ids']) && is_array($request['sub_category_ids']) && (count($request['sub_category_ids']) > 0))){
            $subCategoryIds = array_filter($request['sub_category_ids']);
        } else {
            $subCategoryIds = [];
        }

        if((isset($request['category_ids']) && is_array($request['category_ids']) && (count($request['category_ids']) > 0))){
            $categoryIds = array_filter($request['category_ids']);
        } else {
            $categoryIds = [];
        }

        $subCategoriesCategoryIds = Category::withoutGlobalScope('zone_wise_data')->whereIn('id', $subCategoryIds)->pluck('parent_id')->toArray();
        $categoryIds = array_values(array_diff($categoryIds, $subCategoriesCategoryIds));

        $servicesQuery = $this->service
            ->select('service_services.*')
            ->selectRaw('CAST((SELECT MIN(service_variations.price) FROM service_variations WHERE service_variations.service_id = service_services.id AND service_variations.price > 0 AND service_variations.zone_id = ?) AS DECIMAL(24, 2)) as service_filter_min_price', [$zoneId])
            ->with(['category.zonesBasicInfo', 'variations', 'tags', 'faqs', 'favorites', 'service_discount', 'category.category_discount'])
            ->withCount('favorites', 'bookings')
            ->active()
            ->when($this->currentModule(), function($query){
                $query->module($this->currentModule()->id);
            })
            ->where(function ($query) use ($decodedString, $keys) {
                foreach ($keys as $key) {
                    $query->orWhere('name', 'LIKE', '%' . $key . '%');
                    $query->orWhere('short_description', 'LIKE', '%' . $decodedString . '%');
                    $query->orWhere('description', 'LIKE', '%' . $decodedString . '%');
                    $query->orWhereHas('variations', function ($query) use ($key) {
                        $query->where('variant', 'like', "%{$key}%");
                    });
                    $query->orWhereHas('category', function ($query) use ($key) {
                        $query->where('name', 'like', "%{$key}%");
                    });
                    $query->orWhereHas('subCategory', function ($query) use ($key) {
                        $query->where('name', 'like', "%{$key}%");
                    });
                    $query->orWhereHas('tags', function ($query) use ($key) {
                        $query->where('tag', 'like', "%{$key}%");
                    });
                    $query->orWhereHas('faqs', function ($query) use ($key) {
                        $query->where('question', 'like', "%{$key}%");
                    });
                    $query->orWhereHas('translations', function ($query) use ($key) {
                        $query->where(function ($query) use ($key) {
                            $query->where('key', 'name')
                                ->where('value', 'like', "%{$key}%");
                        })
                            ->orWhere(function ($query) use ($key) {
                                $query->where('key', 'short_description')
                                    ->where('value', 'like', "%{$key}%");
                            })
                            ->orWhere(function ($query) use ($key) {
                                $query->where('key', 'description')
                                    ->where('value', 'like', "%{$key}%");
                            });
                    });
                }
            })

            ->when(!is_null($request['rating']), function ($query) use ($request){
                return $query->where('avg_rating', '>=', $request['rating']);
            })
            ->when(!is_null($request['provider_id']), function ($query) use ($request){
                $query->whereHas('subCategory', function  ($query) use ($request) {
                    $query->whereHas('subscribedServices', function  ($query) use ($request) {
                        $query->where('provider_id', $request['provider_id'])
                            ->where('is_subscribed', 1);
                    });
                });
            })
            /* ->when(isset($request['category_ids']) && is_array($request['category_ids']), function ($query) use ($request) {
                return $query->whereIn('category_id', $request['category_ids']);
            }) */
            /* ->when(isset($request['category_ids']) && is_array($request['category_ids']), function ($query) use ($request) {
                return $query->whereIn('category_id', $request['category_ids']);
            })
            ->when(isset($request['sub_category_ids']) && is_array($request['sub_category_ids']), function ($query) use ($request) {
                return $query->whereIn('sub_category_id', $request['sub_category_ids']);
            }) */
            /* ->when((count($subCategoryIds) > 0), function ($query) use ($subCategoryIds) {
                return $query->whereIn('sub_category_id', $subCategoryIds);
            }) */
            ->where(function ($query) use ($categoryIds, $subCategoryIds) {
                if (count($categoryIds) > 0) {
                    $query->whereIn('category_id', $categoryIds);
                }
                if (count($subCategoryIds) > 0) {
                    if(count($categoryIds) > 0){
                        $query->orWhereIn('sub_category_id', $subCategoryIds);
                    } else {
                        $query->whereIn('sub_category_id', $subCategoryIds);
                    }
                }
            })
            ->when(isset($request['sort_by_type']) && !is_null($request['sort_by_type']), function ($query) use ($request) {
                return $query->when($request['sort_by_type'] == 'top_rated', function ($query) {
                    return $query->orderBy('avg_rating', 'DESC');
                })
                    ->when($request['sort_by_type'] == 'most_loved', function ($query) {
                        return $query->orderBy('order_count', 'DESC')
                            ->orderByDesc('favorites_count');
                    })
                    ->when($request['sort_by_type'] == 'popular', function ($query) {
                        return $query->orderByDesc('bookings_count');
                    })
                    ->when($request['sort_by_type'] == 'newest', function ($query) {
                        return $query->orderBy('created_at', 'DESC');
                    })
                    ->when($request['sort_by_type'] == 'recommended', function ($query) {
                        return $query->when($this->is_customer_logged_in, function ($query) {
                            $categoryIds = $this->booking->where('customer_id', auth('api')->user()->id)->get()->pluck('category_id');
                            if ($categoryIds->count() > 0) {
                                $query->whereHas('category', function ($query) use ($categoryIds) {
                                    $query->whereIn('category_id', $categoryIds);
                                });
                            } else {
                                $query->inRandomOrder();}
                        })->when(!$this->is_customer_logged_in, function ($query) {
                            $query->inRandomOrder();
                        });
                    })
                    ->when($request['sort_by_type'] == 'trending', function ($query) {
                        return $query->when($this->booking->count() > 0, function ($query){
                            $query->whereHas('bookings', function ($query) {
                                $query->where('created_at', '>', now()->subDays(30)->endOfDay());
                            })->orderBy('bookings_count', 'desc');
                        });
                    });
            })
            ->when(isset($request['sort_by']) && $request['sort_by'] != 'null', function ($query) use ($request) {
                switch ($request['sort_by']) {
                    case 'a_to_z':
                        $query->orderBy('name', 'asc');
                        break;
                    case 'z_to_a':
                        $query->orderBy('name', 'desc');
                        break;
                    case 'high_to_low':
                        $query->orderBy('service_filter_min_price', 'desc');
                        break;
                    case 'low_to_high':
                        $query->orderBy('service_filter_min_price', 'asc');
                        break;
                    default:
                        $query->orderBy('created_at', 'desc');
                        break;
                }
            })
            ->when($request['min_price'] !== null && $request['max_price'] !== null && $request['max_price'] > 0, function ($query) use ($request) {
                $query->havingRaw('service_filter_min_price >= ? AND service_filter_min_price <= ?', [$request['min_price'], $request['max_price']]);
            })
//            ->when(is_null($request['sort_by_type']) && is_null($request['sort_by']), function ($query) use ($decodedString) {
//                $search = '%'.$decodedString.'%';
//                $query->addSelect(\DB::raw("
//                    (
//                        (CASE WHEN service_services.name = '".addslashes($decodedString)."' THEN 50 ELSE 0 END) +
//                        (CASE WHEN service_services.name LIKE '".addslashes($decodedString)."%' THEN 40 ELSE 0 END) +
//                        (CASE WHEN service_services.short_description LIKE '".addslashes($search)."' THEN 20 ELSE 0 END) +
//                        (CASE WHEN service_services.description LIKE '".addslashes($search)."' THEN 10 ELSE 0 END)
//                    ) as relevance_score
//                "))
//                ->orderByDesc('relevance_score')
//                ->orderBy('name', 'asc');
//            });
            ->when(is_null($request['sort_by_type']) && is_null($request['sort_by']), function ($query) use ($decodedString) {
                $search = '%'.$decodedString.'%';
                $query->selectRaw("
                    (
                        (CASE WHEN service_services.name = ? THEN 50 ELSE 0 END) +
                        (CASE WHEN service_services.name LIKE ? THEN 40 ELSE 0 END) +
                        (CASE WHEN service_services.short_description LIKE ? THEN 20 ELSE 0 END) +
                        (CASE WHEN service_services.description LIKE ? THEN 10 ELSE 0 END)
                    ) as relevance_score
                ", [$decodedString, $decodedString.'%', $search, $search])
                    ->orderByDesc('relevance_score')
                    ->orderBy('name', 'asc');
            });

        $variationPriceFilter = $servicesQuery->get();

        if ($authUser) {
            if($decodedString != null) {
                $this->recentSearch->create([
                    'user_id' => $authUser->id,
                    'keyword' => $decodedString,
                    'module_id' => config('module.current_module_data')['id'] ?? null
                ]);

                $recentSearch = RecentSearch::where('keyword', $decodedString)->oldest()->first();
                $this->Searched_data_log($authUser->id, 'search', $recentSearch->id, count($variationPriceFilter), $this->currentModule()->id ?? null);
            }
        }

        $price = [];
        foreach ($variationPriceFilter as $key => $service) {
            $minPrice = null;
            $minPriceVariation = null;
            foreach ($service->variations as $variation) {
                if ($minPrice === null || $variation->price < $minPrice) {
                    $minPrice = $variation->price;
                    $minPriceVariation = $variation;
                }
            }
            if ($minPriceVariation !== null) {
                $price[] = $minPriceVariation->price;
            }
        }

        $filterMinPrice = count($price) > 0 ? min($price) : 0;
        $filterMaxPrice = count($price) > 0 ? max($price) : 0;

        $initialMinPrice = Variation::min('price');
        $initialMaxPrice = Variation::max('price');

        $services = $servicesQuery->paginate($request['limit'], ['*'], 'offset', $request['offset'])->withPath('');

        foreach ($services as $service){
            $service['is_favorite'] = $this->favoriteService
                ->where('customer_user_id',$this->customer_user_id)
                ->when($this->currentModule(), function($query){
                    $query->module($this->currentModule()->id);
                })
                ->where('service_id',$service->id)
                ->exists() ? 1 : 0;
            unset($service->tags, $service->faqs, $service->favorites);
        }
        return response()->json(response_formatter(DEFAULT_200, [
            'filter_min_price' => $filterMinPrice == $filterMaxPrice ? 0 : $filterMinPrice,
            'filter_max_price' => $filterMaxPrice,
            'initial_min_price' => $initialMinPrice == $initialMaxPrice ? 0 : $initialMinPrice,
            'initial_max_price' => $initialMaxPrice,
            'services' => self::variationMapper($services)
        ]), 200);
    }

    public function searchSuggestions(Request $request)
    {
        $searchString = $request->input('string');
        $decodedString = $searchString;
        $searchWords = explode(' ', $decodedString);

        $services = $this->service->whereHas('category.zones', function ($query) {
            $query->where('zone_id', Config::get('zone_id'));
        })
        ->when($this->currentModule(), function($query){
            $query->module($this->currentModule()->id);
        });

        $bindings = [
            $decodedString,
            "$decodedString%",
            "%$decodedString%",
            "%$decodedString"
        ];

        $searchQuery = $services->orderByRaw("
            CASE
                WHEN name = ? THEN 0
                WHEN name LIKE ? THEN 1
                WHEN name LIKE ? THEN 2
                WHEN name LIKE ? THEN 3
                ELSE 4
            END
        ", $bindings);

        foreach ($searchWords as $word) {
            $searchQuery->orWhere('name', 'LIKE', "%$word%");
        }

        $servicesResult = $searchQuery->active()->take(100)->get();

        $categoryServices = $this->service->withoutGlobalScopes()->with('category')
            ->whereHas('category', function ($query) use ($decodedString) {
                $query->where('name', 'LIKE', "%$decodedString%");
            })
            ->whereHas('category.zones', function ($query) {
                $query->where('zone_id', Config::get('zone_id'));
            })
            ->when($this->currentModule(), function($query){
                $query->module($this->currentModule()->id);
            })
            ->take(100)
            ->get();

        $subCategoryServices = $this->service->withoutGlobalScopes()->with('subCategory')
            ->whereHas('subCategory', function ($query) use ($decodedString) {
                $query->where('name', 'LIKE', "%$decodedString%");
            })
            ->whereHas('category.zones', function ($query) {
                $query->where('zone_id', Config::get('zone_id'));
            })
            ->when($this->currentModule(), function($query){
                    $query->module($this->currentModule()->id);
                })
            ->take(100)
            ->get();

        $tagServices = $this->service->withoutGlobalScopes()
            ->whereHas('tags', function ($query) use ($decodedString) {
                $query->where('tag', 'LIKE', "%$decodedString%");
            })
            ->whereHas('category.zones', function ($query) {
                $query->where('zone_id', Config::get('zone_id'));
            })
            ->when($this->currentModule(), function($query){
                $query->module($this->currentModule()->id);
            })
            ->take(100)
            ->get();

        $results = $servicesResult->pluck('name')
            ->merge($categoryServices->pluck('name'))
            ->merge($subCategoryServices->pluck('name'))
            ->merge($tagServices->pluck('name'))
            ->unique();

        $authUser = auth('api')->user();
        $services = $results->map(function ($serviceName) use ($authUser) {
            $recentSearched = 0;
            if ($authUser) {
                $recentSearched = $this->recentSearch
                    ->when($this->currentModule(), function($query){
                        $query->module($this->currentModule()->id);
                    })
                    ->where('keyword', $serviceName)->exists() ? 1 : 0;
            }
            return [
                'name' => $serviceName,
                'is_searched' => $recentSearched
            ];
        });

        $servicesArray = $services->values()->toArray();
        return response()->json(response_formatter(DEFAULT_200, $servicesArray), 200);
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return JsonResponse
     */
    public function popular(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'limit' => 'required|numeric|min:1|max:200',
            'offset' => 'required|numeric|min:1|max:100000'
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        $servicesQuery = $this->service->with(['category.zonesBasicInfo', 'variations', 'service_discount', 'category.category_discount'])
            ->where(function ($q) {
                $q->where(function ($j) {
                    $j->where(function ($query) {
                        $query->whereDoesntHave('service_discount')
                            ->orWhereHas('service_discount');
                    })
                    ->when($this->currentModule(), function($query){
                        $query->module($this->currentModule()->id);
                    });
                })
                ->orWhere(function ($query) {
                    $query->whereDoesntHave('category.category_discount')
                        ->orWhereHas('category.category_discount');
                });
            })
            ->when(!is_null($request['provider_id']), function ($query) use ($request){
                $query->whereHas('subCategory', function  ($query) use ($request) {
                    $query->whereHas('subscribedServices', function  ($query) use ($request) {
                        $query->where('provider_id', $request['provider_id']);
                    });
                });
            })
            ->withCount('bookings')
            ->orderBy('bookings_count', 'desc')
            ->active();

        if ($this->booking->count() > 0) {
            $servicesQuery->has('bookings');
        }

        $services = $servicesQuery->paginate($request['limit'], ['*'], 'offset', $request['offset'])->withPath('');

        foreach ($services as $service) {
            $service['is_favorite'] = $this->favoriteService
                ->where('customer_user_id', $this->customer_user_id)
                ->where('service_id', $service->id)
                ->exists() ? 1 : 0;
        }

        return response()->json(response_formatter(DEFAULT_200, self::variationMapper($services)), 200);
    }

    /**
     * Display a listing of the resource.
     *  #   if not authenticated > Random Services
     *  #   if authenticated
     *      ##  has booking > Services of booked category
     *      ##  no booking > Random services
     * @param Request $request
     * @return JsonResponse
     */
    public function recommended(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'limit' => 'required|numeric|min:1|max:200',
            'offset' => 'required|numeric|min:1|max:100000'
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        $servicesQuery = $this->service->with([
            'category.zonesBasicInfo',
            'variations',
            'service_discount',
            'category.category_discount'
        ])
        ->where(function ($query) {
            $query->whereDoesntHave('service_discount')
                ->orWhereHas('service_discount');
        })
        ->where(function ($query) {
            $query->whereDoesntHave('category.category_discount')
                ->orWhereHas('category.category_discount');
        })
        ->when($this->currentModule(), function($query){
            $query->module($this->currentModule()->id);
        });

        if (auth('api')->user()) {
            $user = auth('api')->user();
            $categoryIds = $this->booking->where('customer_id', $user->id)
                ->when($this->currentModule(), function($query){
                    $query->module($this->currentModule()->id);
                })
                ->pluck('category_id');

            if ($categoryIds->isNotEmpty()) {
                $servicesQuery->whereHas('category', function ($query) use ($categoryIds) {
                    $query->whereIn('category_id', $categoryIds);
                });
            }

            $services = $servicesQuery->active()
                ->latest()
                ->paginate($request['limit'], ['*'], 'offset', $request['offset'])
                ->withPath('');

            foreach ($services as $service) {
                $service['is_favorite'] = $this->favoriteService
                    ->where('customer_user_id', $user->id)
                    ->where('service_id', $service->id)
                    ->exists() ? 1 : 0;
            }
        } else {
            $services = $servicesQuery->active()
                ->inRandomOrder()
                ->latest()
                ->paginate($request['limit'], ['*'], 'offset', $request['offset'])
                ->withPath('');

            foreach ($services as $service) {
                $service['is_favorite'] = $this->favoriteService
                    ->where('customer_user_id', $this->customer_user_id)
                    ->where('service_id', $service->id)
                    ->exists() ? 1 : 0;
            }
        }

        return response()->json(response_formatter(DEFAULT_200, self::variationMapper($services)), 200);
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return JsonResponse
     */
    public function searchRecommended(Request $request): JsonResponse
    {
        $services = $this->service->select('id', 'name')
            ->active()
            ->when($this->currentModule(), function($query){
                $query->module($this->currentModule()->id);
            })
            ->inRandomOrder()
            ->take(5)
            ->get();

        foreach ($services as $service){
            $service['is_favorite'] = $this->favoriteService->where('customer_user_id', $this->customer_user_id)->where('service_id',$service->id)->exists() ? 1 : 0;
        }

        return response()->json(response_formatter(DEFAULT_200, self::variationMapper($services)), 200);
    }

    /**
     * Trending products (Last 30days order based)
     * @param Request $request
     * @return JsonResponse
     */
    public function trending(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'limit' => 'required|numeric|min:1|max:200',
            'offset' => 'required|numeric|min:1|max:100000'
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        $servicesQuery = $this->service
            ->with(['category.zonesBasicInfo', 'variations', 'service_discount', 'category.category_discount'])
            ->where(function ($query) {
                $query->whereDoesntHave('service_discount')
                    ->orWhereHas('service_discount');
            })
            ->orWhere(function ($query) {
                $query->whereDoesntHave('category.category_discount')
                    ->orWhereHas('category.category_discount');
            })
            ->when($this->currentModule(), function($query){
                $query->module($this->currentModule()->id);
            })
            ->withCount(['bookings' => function ($query) {
                $query->where('created_at', '>', now()->subDays(30)->endOfDay());
            }])
            ->orderBy('bookings_count', 'desc')
            ->active();

        if ($this->booking->count() > 0) {
            $servicesQuery->whereHas('bookings', function ($query) {
                $query->where('created_at', '>', now()->subDays(30)->endOfDay());
            });
        }

        $services = $servicesQuery->paginate($request['limit'], ['*'], 'offset', $request['offset'])->withPath('');

        foreach ($services as $service) {
            $service['is_favorite'] = $this->favoriteService
                ->where('customer_user_id', $this->customer_user_id)
                ->where('service_id', $service->id)
                ->exists() ? 1 : 0;
        }

        return response()->json(response_formatter(DEFAULT_200, self::variationMapper($services)), 200);
    }

    /**
     * Recently viewed by customer (service view based)
     * @param Request $request
     * @return JsonResponse
     */
    public function recentlyViewed(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'limit' => 'required|numeric|min:1|max:200',
            'offset' => 'required|numeric|min:1|max:100000'
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        $serviceIds = $this->recentView
            ->where('user_id', $request->user()->id)
            ->select(
                DB::raw('count(total_service_view) as total_service_view'),
                DB::raw('service_id as service_id')
            )
            ->when($this->currentModule(), function($query){
                $query->module($this->currentModule()->id);
            })
            ->groupBy('total_service_view', 'service_id')
            ->pluck('service_id')
            ->toArray();

        $services = $this->service->with(['category.zonesBasicInfo', 'variations', 'service_discount', 'category.category_discount'])
            ->whereIn('id', $serviceIds)
            ->where(function ($query) {
                $query->where(function ($query) {
                    $query->whereDoesntHave('service_discount')
                        ->orWhereHas('service_discount');
                })->orWhere(function ($query) {
                    $query->whereDoesntHave('category.category_discount')
                        ->orWhereHas('category.category_discount');
                });
            })
            ->when($this->currentModule(), function($query){
                $query->module($this->currentModule()->id);
            })
            ->active()
            ->orderBy('avg_rating', 'DESC')
            ->paginate($request['limit'], ['*'], 'offset', $request['offset'])
            ->withPath('');

        foreach ($services as $service){
            $service['is_favorite'] = $this->favoriteService->where('customer_user_id', $this->customer_user_id)->where('service_id',$service->id)->exists() ? 1 : 0;
        }

        return response()->json(response_formatter(DEFAULT_200, self::variationMapper($services)), 200);
    }

    /**
     * Recently searched keywords by customer
     * @param Request $request
     * @return JsonResponse
     */
    public function recentlySearchedKeywords(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'limit' => 'required|numeric|min:1|max:200',
            'offset' => 'required|numeric|min:1|max:100000'
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        $searchedKeywords = $this->recentSearch
            ->where('user_id', $request->user()->id)
            ->when($this->currentModule(), function($query){
                $query->module($this->currentModule()->id);
            })
            ->select('id', 'keyword')
            ->latest()
            ->paginate($request['limit'], ['*'], 'offset', $request['offset'])->withPath('');

        if (count($searchedKeywords) > 0) {
            return response()->json(response_formatter(DEFAULT_200, $searchedKeywords), 200);
        }

        return response()->json(response_formatter(DEFAULT_404), 404);
    }

    /**
     * Remove searched keywords by customer
     * @param Request $request
     * @return JsonResponse
     */
    public function removeSearchedKeywords(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'id' => 'array',
            'id.*' => 'uuid',
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        $this->recentSearch
            ->where('user_id', $request->user()->id)
            ->when($request->has('id'), function ($query) use ($request) {
                $query->whereIn('id', $request->id);
            })
            ->when($this->currentModule(), function($query){
                $query->module($this->currentModule()->id);
            })
            ->delete();

        return response()->json(response_formatter(DEFAULT_DELETE_200), 200);
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return JsonResponse
     */
    public function offers(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'limit' => 'required|numeric|min:1|max:200',
            'offset' => 'required|numeric|min:1|max:100000'
        ]);

        if (!session()->has('location')) {
            $data = Location::get($request->ip());
            $location = [
                'lat' => $data ? $data->latitude : '23.757989',
                'lng' => $data ? $data->longitude : '90.360587'
            ];
            session()->put('location', $location);
        }

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        $services = $this->service
            ->with(['category.zonesBasicInfo', 'variations', 'service_discount', 'category.category_discount'])
            ->whereHas('service_discount')
            ->orWhereHas('category.category_discount')
            ->active()
            ->when($this->currentModule(), function($query){
                $query->module($this->currentModule()->id);
            })
            ->orderBy('avg_rating', 'DESC')
            ->paginate($request['limit'], ['*'], 'offset', $request['offset'])->withPath('');

        foreach ($services as $service){
            $service['is_favorite'] = $this->favoriteService->where('customer_user_id', $this->customer_user_id)->where('service_id',$service->id)->exists() ? 1 : 0;
        }

        return response()->json(response_formatter(DEFAULT_200, self::variationMapper($services)), 200);
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

    /**
     * Show the specified resource.
     * @param Request $request
     * @param string $id
     * @return JsonResponse
     */
    public function show(Request $request, string $id): JsonResponse
    {
        $service = $this->service->where('id', $id)
            ->with(['service_discount', 'category.children', 'category.category_discount', 'category.campaign_discount', 'variations', 'faqs' => function ($query) {
                return $query->where('is_active', 1);
            }])
            ->when($this->currentModule(), function($query){
                $query->module($this->currentModule()->id);
            })
            ->ofStatus(1)
            ->first();

        if (isset($service)) {
            if ($request->has('attribute') && $request->attribute == 'service' && auth('api')->user()) {
                $this->Searched_data_log(auth('api')->user()->id, 'service', $service->id, null, $this->currentModule()->id ?? null);
            }

            if (auth('api')->user()) {
                $this->visited_service_update(auth('api')->user()->id, $id);

                //search log volume update
                if ($request->has('attribute') && $request->attribute != 'service') {
                    $this->search_log_volume_update(auth('api')->user()->id, $service->id, $this->currentModule()->id ?? null);
                }
            }

            $authUser = auth('api')->user();
            if ($authUser) {
                $recentView = $this->recentView->firstOrNew(['service_id' => $service->id, 'user_id' => $authUser->id, 'module_id' => $this->currentModule()->id ?? null]);
                $recentView->total_service_view += 1;
                $recentView->save();
            }

            $service['variations_app_format'] = self::variationsAppFormat($service);
            return response()->json(response_formatter(DEFAULT_200, $service), 200);
        }
        return response()->json(response_formatter(DEFAULT_204), 200);
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @param string $serviceId
     * @return JsonResponse
     */
    public function review(Request $request, string $serviceId): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'limit' => 'required|numeric|min:1|max:200',
            'offset' => 'required|numeric|min:1|max:100000'
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        $reviews = $this->review->with(['provider', 'customer','reviewReply'])
            ->when($this->currentModule(), function($query){
                $query->module($this->currentModule()->id);
            })
            ->where('service_id', $serviceId)->ofStatus(1)->latest()
            ->paginate($request['limit'], ['*'], 'offset', $request['offset'])->withPath('');

        $ratingGroupCount = DB::table('service_reviews')->where('service_id', $serviceId)
            ->when($this->currentModule(), function($query) {
                $query->where('module_id', $this->currentModule()->id);
            })
            ->where('is_active', 1)
            ->select('review_rating', DB::raw('count(review_comment) as total_comment'), DB::raw('count(*) as total'))
            ->groupBy('review_rating')
            ->get();

        $totalRating = 0;
        $ratingCount = 0;
        $reviewCount = 0;

        foreach ($ratingGroupCount as $count) {
            $totalRating += round($count->review_rating * $count->total, 2);
            $ratingCount += $count->total;
            $reviewCount += $count->total_comment;
        }

        $ratingInfo = [
            'rating_count' => $ratingCount,
            'review_count' => $reviewCount,
            'average_rating' => round(divnum($totalRating, $ratingCount), 2),
            'rating_group_count' => $ratingGroupCount,
        ];

        return response()->json(response_formatter(DEFAULT_200, ['reviews' => $reviews, 'rating' => $ratingInfo]), 200);
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @param string $subCategoryId
     * @return JsonResponse
     */
    public function servicesBySubcategory(Request $request, string $subCategoryId): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'limit' => 'required|numeric|min:1|max:200',
            'offset' => 'required|numeric|min:1|max:100000'
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        $servicesQuery = $this->service
            ->with(['category.zonesBasicInfo', 'variations', 'service_discount', 'category.category_discount'])
            ->where('sub_category_id', $subCategoryId)
            ->where('is_active', 1)
            ->when($this->currentModule(), function($query){
                $query->module($this->currentModule()->id);
            })
            ->where(function ($query) {
                $query->whereDoesntHave('service_discount')
                    ->orWhereHas('service_discount')
                    ->orWhere(function ($query) {
                        $query->whereDoesntHave('category.category_discount')
                            ->orWhereHas('category.category_discount');
                    });
            })
            ->latest();

        $services = $servicesQuery
            ->paginate($request['limit'], ['*'], 'offset', $request['offset'])
            ->withPath('');

        foreach ($services as $service){
            $service['is_favorite'] = $this->favoriteService->where('customer_user_id', $this->customer_user_id)->where('service_id',$service->id)->exists() ? 1 : 0;
        }

        if (count($services) > 0) {
            $authUser = auth('api')->user();
            if ($authUser) {
                $recentView = $this->recentView->firstOrNew(['sub_category_id' => $subCategoryId, 'user_id' => $authUser->id, 'module_id' => $this->currentModule()->id ?? null]);
                $recentView->total_sub_category_view += 1;
                $recentView->save();
            }

            return response()->json(response_formatter(DEFAULT_200, self::variationMapper($services)), 200);
        }

        return response()->json(response_formatter(DEFAULT_204), 200);
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return JsonResponse
     */
    public function makeRequest(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'nullable',
            'service_name' => 'required|max:255',
            'service_description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        ServiceRequest::create([
            'module_id' => $this->currentModule()->id ?? null,
            'category_id' => strtolower($request['category_id']) == 'null' || $request['category_id'] == '' ? null : $request['category_id'],
            'service_name' => $request['service_name'],
            'service_description' => $request['service_description'],
            'status' => 'pending',
            'type' => CUSTOMER,
            'user_id' => auth('api')->user()->id,
        ]);

        return response()->json(response_formatter(DEFAULT_STORE_200), 200);
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return JsonResponse
     */
    public function requestList(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'limit' => 'required|numeric|min:1|max:200',
            'offset' => 'required|numeric|min:1|max:100000',
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        $requests = ServiceRequest::with(['category'])
            ->where('user_id', $request->user()->id)
            ->where('type', CUSTOMER)
            ->when($this->currentModule(), function($query){
                $query->module($this->currentModule()->id);
            })
            ->latest()
            ->paginate($request['limit'], ['*'], 'offset', $request['offset'])->withPath('');

        if ($requests->count() > 0) {
            return response()->json(response_formatter(DEFAULT_200, $requests), 200);
        }
        return response()->json(response_formatter(DEFAULT_204, $requests), 200);
    }

    public function serviceAreaAvailability(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'limit' => 'required|numeric|min:1|max:200',
            'offset' => 'required|numeric|min:1|max:100000',
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        $zones = $this->zone
            ->active()
            ->whereHas('modules', function ($query) {
                $query->where('module_id', $this->currentModule()->id ?? null);
            })
            ->latest()
            ->paginate($request['limit'], ['*'], 'offset', $request['offset'])
            ->withPath('');

        foreach ($zones as $key=>$zone) {
            $object = json_decode($zone->coordinates[0]->toJson(),true)['coordinates'];
            $data = [];
            foreach ($object as $coordinate) {
                $data[] = (object)['latitude' => $coordinate[1], 'longitude' => $coordinate[0]]; //unusual case for lat long
            }

            $formatted_coordinates = $data;
            $zone['formatted_coordinates'] = $formatted_coordinates;
            unset($zones[$key]['coordinates']);
            unset($zones[$key]['is_active']);
        }

        return response()->json(response_formatter(DEFAULT_200, $zones), 200);
    }
}
