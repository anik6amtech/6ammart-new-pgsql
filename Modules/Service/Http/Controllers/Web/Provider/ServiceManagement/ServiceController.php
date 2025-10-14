<?php

namespace Modules\Service\Http\Controllers\Web\Provider\ServiceManagement;

use Illuminate\Http\Request;
use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Models\StoreSubscription;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Service\Entities\BookingModule\Booking;
use Modules\Service\Entities\CategoryManagement\Category;
use Modules\Service\Entities\ProviderManagement\SubscribedService;
use Modules\Service\Entities\Review\Review;
use Modules\Service\Entities\Review\ReviewReply;
use Modules\Service\Entities\ServiceManagement\Faq;
use Modules\Service\Entities\ServiceManagement\Service;
use Modules\Service\Entities\ServiceManagement\ServiceRequest;
use Modules\Service\Exports\ServiceRequestExport;
use Rap2hpoutre\FastExcel\FastExcel;

class ServiceController extends Controller
{
    private Service $service;
    private Review $review;
    private ReviewReply $reviewReply;
    private SubscribedService $subscribed_service;
    private Category $category;
    private Booking $booking;
    private Faq $faq;

    public function __construct(Service $service, Review $review, ReviewReply $reviewReply, SubscribedService $subscribed_service, Category $category, Booking $booking, Faq $faq)
    {
        $this->service = $service;
        $this->review = $review;
        $this->reviewReply = $reviewReply;
        $this->subscribed_service = $subscribed_service;
        $this->category = $category;
        $this->booking = $booking;
        $this->faq = $faq;
    }

    private function currentModuleId(): int
    {
        return Helpers::get_provider_data()->module_id ?? 0;
    }

    private function providerId(): int
    {
        return Helpers::get_provider_id();
    }

    private function provider()
    {
        return Helpers::get_provider_data();
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request): View|Factory|Application
    {
        if ($request->has('active_category') && $request['active_category'] != '') {
            $activeCategory = $request['active_category'];
        } else {
            $activeCategory = 'all';
        }

        $subscribedIds = $this->subscribed_service->where('provider_id', $this->providerId())
            ->ofStatus(1)
            ->pluck('sub_category_id')
            ->toArray();

        $categories = $this->category
            ->where('module_id', $this->currentModuleId())
            ->ofStatus(1)->ofType('main')
            ->whereHas('zones', function ($query) use ($request) {
                return $query->where('zone_id', $this->provider()->zone_id);
            })->latest()->get();

        $subCategories = $this->category
            ->with(['services'])
            ->with(['services' => function ($query) {
                $query->where(['is_active' => 1]);
            }])
            ->withCount(['services' => function ($query) {
                $query->where(['is_active' => 1]);
            }])
            ->where('module_id', $this->currentModuleId())
            ->when($activeCategory != 'all', function ($query) use ($activeCategory) {
                $query->where(['parent_id' => $activeCategory]);
            })
            /* ->when($request->has('category_id') && $request['category_id'] != 'all', function ($query) use ($request) {
                $query->where('parent_id', $request['category_id']);
            }) */
            ->whereHas('parent.zones', function ($query) use ($request) {
                $query->where('zone_id', $this->provider()->zone_id);
            })
            ->whereHas('parent', function ($query) {
                $query->where('is_active', 1);
            })
            ->ofStatus(1)->ofType('sub')
            ->latest()->get();

        return view('service::provider.service-management.available-services', compact('categories', 'subCategories', 'subscribedIds', 'activeCategory'));
    }

    /**
     * Display a listing of the resource.
     * @return Application|Factory|View
     */
    public function requestList(Request $request): View|Factory|Application
    {
        $search = $request['search'];
        $categories = $this->category->ofType('main')->select('id', 'name')->get();
        $requests = ServiceRequest::with(['category'])
            ->where('user_id', $this->providerId())
            ->where('type', PROVIDER)
            ->when($request->has('search'), function ($query) use ($request) {
                $keys = explode(' ', $request['search']);
                return $query->whereHas('category', function ($query) use ($keys) {
                    foreach ($keys as $key) {
                        $query->where('name', 'LIKE', '%' . $key . '%');
                    }
                });
            })
            ->latest()
            ->paginate(pagination_limit());

        return view('service::provider.service-management.request-list', compact('requests', 'search', 'categories'));
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return RedirectResponse
     */

    public function storeRequest(Request $request): RedirectResponse
    {
        Validator::make($request->all(), [
            'category_ids' => 'nullable',
            'service_name' => 'required|max:255',
            'service_description' => 'required',
        ])->validate();

        ServiceRequest::create([
            'category_id' => strtolower($request['category_id']) == 'null' || $request['category_id'] == '' ? null : $request['category_id'],
            'service_name' => $request['service_name'],
            'service_description' => $request['service_description'],
            'status' => 'pending',
            'user_id' => $request->user('provider')->id,
            'type' => PROVIDER,
            'module_id' => $request->user('provider')->module_id,
        ]);

        Toastr::success(translate(SERVICE_REQUEST_STORE_200['message']));
        return back();
    }


    public function updateSubscription(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'sub_category_id' => 'required'
        ]);

        if ($validator->fails()) {
            Toastr::error(translate(DEFAULT_400['message']));
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $packageSubscriber = StoreSubscription::where('store_id',  $this->providerId())
            ->orderBy('created_at', 'desc')
            ->where('store_type', 'service_provider')
            ->first();
        if(!$packageSubscriber) {
            $packageSubscriberLimit = 'unlimited';
            $isLimit = 0;
        } else {
            if ($packageSubscriber->max_product == 'unlimited') {
                $packageSubscriberLimit = $packageSubscriber?->max_product;
                $isLimit = 0;
            } else {
                $packageSubscriberLimit = $packageSubscriber?->max_product;
                $isLimit = 1;
            }
        }

        $endDate = $packageSubscriber?->expiry_date;
        $currentDate = Carbon::now()->subDays();
        $packageEndDate = $endDate ? Carbon::parse($endDate)->endOfDay() : null;
        $isPackageEnded = $packageEndDate ? $currentDate->diffInDays($packageEndDate, false) : null;
        $providerId = $this->providerId();

        $categoryCount = $this->subscribed_service->where('provider_id', $providerId)->where('is_subscribed', 1)
            ->count();

        $subscribedService = $this->subscribed_service::where('sub_category_id', $request['sub_category_id'])->where('provider_id', $this->providerId())->first();

        if (!$subscribedService) {
            if ($packageSubscriberLimit <= $categoryCount && $packageSubscriber && $isLimit && $isPackageEnded) {
                Toastr::error(translate(CATEGORY_LIMIT_END['message']));
                return redirect()->back()->withInput();
            }

            $subscribedService = new $this->subscribed_service;
            $subscribedService->is_subscribed = 1;
        } elseif ($subscribedService) {
            if ($subscribedService->is_subscribed == 0) {
                if ($packageSubscriberLimit <= $categoryCount && $packageSubscriber && $isLimit && $isPackageEnded) {
                    Toastr::error(translate(CATEGORY_LIMIT_END['message']));
                    return redirect()->back()->withInput();
                }
            }

            $subscribedService->is_subscribed = !$subscribedService->is_subscribed;
        }

        $subscribedService->provider_id = $this->providerId();
        $subscribedService->sub_category_id = $request['sub_category_id'];

        $parent = $this->category->where('id', $request['sub_category_id'])->whereHas('parent.zones', function ($query) {
            $query->where('zone_id', $this->provider()->zone_id);
        })->first();

        if ($parent) {
            $subscribedService->category_id = $parent->parent_id;
            $subscribedService->save();
            Toastr::success(translate(DEFAULT_200['message']));
            return redirect()->back();
        }

        Toastr::error(translate(DEFAULT_204['message']));
        return redirect()->back();
    }


    /**
     * Display a listing of the resource.
     * @param Request $request
     * @param string $service_id
     * @return JsonResponse
     */
    public function review(Request $request, string $service_id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'limit' => 'required|numeric|min:1|max:200',
            'offset' => 'required|numeric|min:1|max:100000',
            'status' => 'required|in:active,inactive,all'
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        $reviews = $this->review->where('provider_id', $this->providerId())->where('service_id', $service_id)
            ->when($request->has('status') && $request['status'] != 'all', function ($query) use ($request) {
                return $query->ofStatus(($request['status'] == 'active') ? 1 : 0);
            })->latest()->paginate($request['limit'], ['*'], 'offset', $request['offset'])->withPath('');

        $ratingGroupCount = DB::table('service_reviews')->where('provider_id', $this->providerId())
            ->where('service_id', $service_id)
            ->select('review_rating', DB::raw('count(*) as total'))
            ->groupBy('review_rating')
            ->get();

        $totalAvg = 0;
        $mainDivider = 0;
        foreach ($ratingGroupCount as $count) {
            $totalAvg = round($count->review_rating / $count->total, 2);
            $mainDivider += 1;
        }

        $ratingInfo = [
            'rating_count' => $ratingGroupCount->count(),
            'average_rating' => round($totalAvg / ($mainDivider == 0 ? $mainDivider + 1 : $mainDivider), 2),
            'rating_group_count' => $ratingGroupCount,
        ];

        if ($reviews->count() > 0) {
            return response()->json(response_formatter(DEFAULT_200, ['reviews' => $reviews, 'rating' => $ratingInfo]), 200);
        }

        return response()->json(response_formatter(DEFAULT_404), 200);
    }


    /**
     * Show the specified resource.
     * @param Request $request
     * @param string $id
     * @return Application|Factory|View|RedirectResponse
     */
    public function show(Request $request, string $id): View|Factory|RedirectResponse|Application
    {
        $service = $this->service->where('module_id', $this->currentModuleId())
            ->where('id', $id)
            ->with(['category.children', 'variations.zone', 'reviews'])
            ->withCount(['bookings'])
            ->first();

        $allBooking = $this->booking->whereHas('detail', function ($query) use ($id) {
            $query->where('service_id', $id);
        })
            ->where('provider_id', $this->providerId())
            ->count();
        $ongoing = $this->booking->whereHas('detail', function ($query) use ($id) {
            $query->where('service_id', $id);
        })
            ->where('provider_id', $this->providerId())
            ->where(['booking_status' => 'ongoing'])
            ->count();

        $canceled = $this->booking->whereHas('detail', function ($query) use ($id) {
            $query->where('service_id', $id);
        })
            ->where('provider_id', $this->providerId())
            ->where(['booking_status' => 'canceled'])
            ->count();

        $faqs = $this->faq->latest()->where('service_id', $id)->get();

        $search = $request->has('review_search') ? $request['review_search'] : '';
        $webPage = $request->has('review_page') || $request->has('review_search') ? 'review' : 'general';
        $queryParam = ['search' => $search, 'web_page' => $webPage];

        $reviews = $this->review->with(['customer', 'booking'])
            ->where('service_id', $id)
            ->where('is_active', 1)
            ->when($request->has('review_search') && !empty($request['review_search']), function ($query) use ($request) {
                $keys = explode(' ', $request['review_search']);
                foreach ($keys as $key) {
                    $query->where('review_comment', 'LIKE', '%' . $key . '%')
                        ->orWhere('id', 'LIKE', '%' . $key . '%');
                }
            })
            ->where('provider_id', $this->providerId())
            ->latest()->paginate(pagination_limit(), ['*'], 'review_page')->appends($queryParam);

        $rating_group_count = DB::table('service_reviews')->where('provider_id', $this->providerId())
            ->where('service_id', $id)
            ->select('review_rating', DB::raw('count(*) as total'))
            ->groupBy('review_rating')
            ->get();

        if (isset($service)) {
            $service['ongoing_count'] = $ongoing;
            $service['canceled_count'] = $canceled;
            $service['all_booking'] = $allBooking;

            $language = getWebConfig('language');
            return view('service::provider.service-management.service-details', compact('service', 'faqs', 'reviews', 'rating_group_count', 'webPage', 'search', 'language'));
        }

        Toastr::error(translate(DEFAULT_204['message']));
        return back();
    }


    /**
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    public function reviewReply(Request $request): JsonResponse|RedirectResponse
    {
        $providerUserId = $this->providerId();
        $review_id = $request->review_id;

        $readableId = $this->review->where('id', $review_id)->value('id') ?? 0;


        $reviewReply = $this->reviewReply
            ->where('review_id', 'like', "{$review_id}%")
            ->orderBy('id', 'desc')
            ->first();

        if (!$reviewReply) {
            $reviewReply = $this->reviewReply;
        }
        $reviewReply->module_id = $this->currentModuleId();
        $reviewReply->review_id = $review_id;
        $reviewReply->user_id = $providerUserId;
        $reviewReply->reply = $request->reply_content;
        $reviewReply->save();
        //        dd($reviewReply);

        Toastr::success(translate(DEFAULT_200['message']));
        return back();
    }

    public function reviewsDownload(Request $request)
    {
        $items = $this->review->with(['customer', 'booking'])
            ->where('service_id', $request->service_id)
            ->where('provider_id', $request->user('provider')->provider->id)
            ->when($request->has('review_search') && !empty($request['review_search']), function ($query) use ($request) {
                $keys = explode(' ', $request['review_search']);
                foreach ($keys as $key) {
                    $query->where('review_comment', 'LIKE', '%' . $key . '%')
                        ->orWhere('id', 'LIKE', '%' . $key . '%');
                }
            })
            ->latest()
            ->get();

        return (new FastExcel($items))->download(time() . '-file.xlsx');
    }

    public function subscribedSubCategories(Request $request): View|Factory|Application
    {
        $keys = explode(' ', $request['search']);
        $status = $request['status'] ?? 'all';
        $search = $request['search'];
        $queryParam = ['status' => $request['status'], 'search' => $request['search']];

        $subCategories = Category::with(['services', 'parent'])
            ->ofType('sub')
            ->ofStatus(1)
            ->when($request->has('searchq'), function ($query) use ($request) {
                $keys = explode(' ', $request['searchq']);
                return $query->where(function ($query) use ($keys) {
                    foreach ($keys as $key) {
                        $query->orWhere('name', 'LIKE', '%' . $key . '%');
                    }
                });
            })
            ->when($status != 'all', function ($query) use ($status) {
                if ($status == 'subscribed') {
                    return $query->whereHas('subscribedServices', function ($query) {
                        $query->where('is_subscribed', 1);
                    });
                } else {
                    return $query->where(function ($q) {
                        return $q->whereHas('subscribedServices', function ($query) {
                            $query->where('is_subscribed', 0);
                        })
                            ->orWhereDoesntHave('subscribedServices');
                    });
                }
            })
            ->get();

        $subscribedCategoryIds = $this->subscribed_service->where('provider_id', $this->providerId())
            ->ofSubscription(1)
            ->pluck('sub_category_id')
            ->toArray();

        return view('service::provider.service-management.subscribed-services', compact('subCategories', 'subscribedCategoryIds', 'status', 'search'));
    }

    public function export(Request $request)
    {
        $serviceRequest = ServiceRequest::with(['category'])
            ->where('user_id', $this->providerId())
            ->where('type', PROVIDER)
            ->when($request->has('search'), function ($query) use ($request) {
                $keys = explode(' ', $request['search']);
                return $query->whereHas('category', function ($query) use ($keys) {
                    foreach ($keys as $key) {
                        $query->where('name', 'LIKE', '%' . $key . '%');
                    }
                });
            })
            ->latest()->get();


        $data = [
            'data' => $serviceRequest,
            'search' => $request['search'] ?? null,
        ];
        if ($request->type == 'csv') {
            return Excel::download(new ServiceRequestExport($data), 'ServiceRequest.csv');
        }
        return Excel::download(new ServiceRequestExport($data), 'ServiceRequest.xlsx');
    }
}
