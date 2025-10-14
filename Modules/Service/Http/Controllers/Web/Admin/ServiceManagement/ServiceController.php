<?php

namespace Modules\Service\Http\Controllers\Web\Admin\ServiceManagement;

use App\CentralLogics\Helpers;
use App\Models\Tag;
use App\Models\Zone;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Service\Entities\BookingModule\Booking;
use Modules\Service\Entities\CategoryManagement\Category;
use Modules\Service\Entities\ProviderManagement\Provider;
use Modules\Service\Entities\Review\Review;
use Modules\Service\Entities\Review\ReviewReply;
use Modules\Service\Entities\ServiceManagement\Faq;
use Modules\Service\Entities\ServiceManagement\Service;
use Modules\Service\Entities\ServiceManagement\ServiceRequest;
use Modules\Service\Entities\ServiceManagement\Variation;
use Modules\Service\Exports\ServiceRequestExport;
use Rap2hpoutre\FastExcel\FastExcel;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ServiceController extends Controller
{
    private Review $review;
    private ReviewReply $reviewReply;
    private Faq $faq;
    private Variation $variation;
    private Zone $zone;
    private Category $category;
    private Booking $booking;
    private Service $service;
    private Provider $provider;

    public function __construct(Service $service, Booking $booking, Category $category, Zone $zone, Variation $variation, Faq $faq, Review $review, ReviewReply $reviewReply, Provider $provider)
    {
        $this->service = $service;
        $this->booking = $booking;
        $this->category = $category;
        $this->zone = $zone;
        $this->variation = $variation;
        $this->faq = $faq;
        $this->review = $review;
        $this->reviewReply = $reviewReply;
        $this->provider = $provider;
    }

    private function currentModuleId(): int
    {
        return Config::get('module.current_module_id');
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Application|Factory|View
     */
    public function create(Request $request): View|Factory|Application
    {
        $categories = $this->category->where('module_id', $this->currentModuleId())->ofStatus(1)->ofType('main')->latest()->get();
        $zones = $this->zone->active()->latest()->get();

        session()->forget('variations');
        $language = getWebConfig('language');

        return view('service::admin.service-management.create', compact('categories', 'zones', 'language'));
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request): View|Factory|Application
    {
        $request->validate([
            'status' => 'in:active,inactive,all',
            'zone_id' => 'nullable',
        ]);

        $search = $request->has('search') ? $request['search'] : '';
        $status = $request->has('status') ? $request['status'] : 'all';
        $queryParam = ['search' => $search, 'status' => $status];

        $services = $this->service
            ->withoutGlobalScope('translate')
            ->with(['category.zonesBasicInfo'])->latest()
            ->where('module_id', $this->currentModuleId())
            ->when($request->has('search'), function ($query) use ($request) {
                $keys = explode(' ', $request['search']);
                $query->where(function ($query) use ($keys) {
                    $query->where('name', 'LIKE', '%' . $keys[0] . '%');
                });
                foreach ($keys as $keyIndex => $key) {
                    if ($keyIndex == 0) {
                        continue; // Skip the first key as it's already used in the where clause
                    }
                    $query->orWhere('name', 'LIKE', '%' . $key . '%');
                }
            })
            ->when($request->has('category_id'), function ($query) use ($request) {
                if($request->category_id != '') {
                    return $query->where('category_id', $request->category_id);
                }
            })->when($request->has('sub_category_id'), function ($query) use ($request) {
                if($request->sub_category_id != '') {
                    return $query->where('sub_category_id', $request->sub_category_id);
                }
            })->when($request->has('status') && $request['status'] != 'all', function ($query) use ($request) {
                if ($request['status'] == 'active') {
                    return $query->where(['is_active' => 1]);
                } else {
                    return $query->where(['is_active' => 0]);
                }
            })->when($request->has('zone_id'), function ($query) use ($request) {
                return $query->whereHas('category.zonesBasicInfo', function ($queryZone) use ($request) {
                    $queryZone->where('zone_id', $request['zone_id']);
                });
            })->paginate(pagination_limit())->appends($queryParam);

        $categories = $this->category->where('module_id', $this->currentModuleId())->ofStatus(1)->ofType('main')->latest()->get();
        if($request->category_id != null && $request->category_id != '') {
            $subCategories = $this->category->where('module_id', $this->currentModuleId())
                ->ofStatus(1)
                ->ofType('sub')
                ->where('parent_id', $request->category_id)
                ->latest()
                ->get();
        } else {
            $subCategories = collect([]);
        }

        return view('service::admin.service-management.list', compact('services', 'search', 'status', 'categories', 'subCategories'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $variations = session('variations');

        if (empty($variations)) {
            Toastr::error(translate('please_add_at_least_one_variant'));
            return redirect()->back()->withInput();
        }

        session()->forget('variations');

        $request->validate([
                'name' => 'required|max:191',
                'name.0' => 'required|max:191',
                'category_id' => 'required',
                'sub_category_id' => 'nullable',
                'cover_image' => 'required|image|mimes:jpeg,jpg,png,gif|max:10000',
                'description' => 'required',
                'description.0' => 'required',
                'short_description' => 'required',
                'short_description.0' => 'required',
                'thumbnail' => 'required',
                'tax' => 'required|numeric|min:0|max:100',
                'min_bidding_price' => 'required|numeric|min:0|not_in:0',
            ]
        );


        $tagIds = [];
        if ($request->tags != null) {
            $tags = explode(",", $request->tags);
        }
        if (isset($tags)) {
            foreach ($tags as $key => $value) {
                $tag = Tag::firstOrNew(['tag' => $value]);
                $tag->save();
                $tagIds[] = $tag->id;
            }
        }

        $service = $this->service;
        $service->module_id = $this->currentModuleId();
        $service->name = $request->name[array_search('default', $request->lang)];
        $service->category_id = $request->category_id;
        $service->sub_category_id = $request->sub_category_id;
        $service->short_description = $request->short_description[array_search('default', $request->lang)];
        $service->description = $request->description[array_search('default', $request->lang)];
        $service->cover_image = file_uploader('service/', 'png', $request->file('cover_image'));
        $service->thumbnail = file_uploader('service/', 'png', $request->file('thumbnail'));
        $service->tax = $request->tax;
        $service->min_bidding_price = $request->min_bidding_price;
        $service->save();
        $service->tags()->sync($tagIds);

        //decoding url encoded keys
        $data = $request->all();
        $data = collect($data)->map(function ($value, $key) {
            $key = urldecode($key);
            return [$key => $value];
        })->collapse()->all();

        $variationFormat = [];
        if ($variations) {
            $zones = $this->zone->active()->latest()->get();
            foreach ($variations as $item) {
                foreach ($zones as $zone) {
                    $price = $data[$item['variant_key'] . '_' . $zone->id . '_price'] ?? 0;
                    if ($price == 0) {
                        continue;
                    }

                    $variationFormat[] = [
                        'variant' => $item['variant'],
                        'variant_key' => $item['variant_key'],
                        'zone_id' => $zone->id,
                        'price' => $price,
                        'service_id' => $service->id
                    ];
                }
            }
        }else{
            Toastr::error(translate('please_add_at_least_one_variant'));
            return redirect()->back()->withInput();
        }

        $service->variations()->createMany($variationFormat);

        Helpers::add_or_update_translations(
            request: $request,
            key_data:'name',
            name_field:'name',
            model_name: get_class($service),
            data_id: $service->id,
            data_value: $service->name,
            model_class: true
        );

        Helpers::add_or_update_translations(
            request: $request,
            key_data:'description',
            name_field:'description',
            model_name: get_class($service),
            data_id: $service->id,
            data_value: $service->description,
            model_class: true
        );

        Helpers::add_or_update_translations(
            request: $request,
            key_data:'short_description',
            name_field:'short_description',
            model_name: get_class($service),
            data_id: $service->id,
            data_value: $service->short_description,
            model_class: true
        );

        Toastr::success(translate(SERVICE_STORE_200['message']));

        return redirect()->route('admin.service.service.index');
    }

    /**
     * Show the specified resource.
     * @param Request $request
     * @param string $id
     * @return Application|Factory|View|RedirectResponse
     */
    public function show(Request $request, string $id): View|Factory|RedirectResponse|Application
    {
        $service = $this->service
            ->where('id', $id)
            ->where('module_id', $this->currentModuleId())
            ->with(['category' => function ($query) {
                $query->ofStatus(1);
            },'subCategory' => function ($query) {
                $query->ofStatus(1);
            }, 'category.zones', 'category.children', 'variations.zone', 'reviews'])
            // ->withCount(['bookings'])
            ->first();

        $service->total_review_count = $service->reviews->avg('review_rating');

        $allBookings = $this->booking
            ->where('module_id', $this->currentModuleId())
            ->whereHas('detail', function ($query) use ($id) {
                return $query->where('service_id', $id);
            })
            ->count();

        $ongoing = $this->booking
            ->where('module_id', $this->currentModuleId())
            ->whereHas('detail', function ($query) use ($id) {
                return $query->where('service_id', $id);
            })
            ->where(['booking_status' => 'ongoing'])
            ->count();

        $canceled = $this->booking
            ->where('module_id', $this->currentModuleId())
            ->whereHas('detail', function ($query) use ($id) {
                return $query->where('service_id', $id);
            })
            ->where(['booking_status' => 'canceled'])
            ->count();

        $faqs = $this->faq->latest()->where('service_id', $id)->get();

        $search = $request->has('review_search') ? $request['review_search'] : '';
        $webPage = $request->has('review_page') || $request->has('review_search') ? 'review' : 'general';
        $queryParam = ['search' => $search, 'web_page' => $webPage];

        $reviews = $this->review->with(['customer', 'booking'])
            ->where('service_id', $id)
            ->when($request->has('review_search') && !empty($request['review_search']), function ($query) use ($request) {
                $keys = explode(' ', $request['review_search']);
                foreach ($keys as $key) {
                    $query->where('review_comment', 'LIKE', '%' . $key . '%')
                        ->orWhere('id', 'LIKE', '%' . $key . '%');
                }
            })
            ->latest()->paginate(pagination_limit(), ['*'], 'review_page')->appends($queryParam);

        $rating_group_count = DB::table('service_reviews')
            ->where('module_id', $this->currentModuleId())
            ->select('review_rating', DB::raw('count(*) as total'))
            ->groupBy('review_rating')
            ->get();

        if (isset($service)) {
            $service['ongoing_count'] = $ongoing;
            $service['canceled_count'] = $canceled;
            $service['total_booking_count'] = $allBookings;
            $language = getWebConfig('language');
            $zones = $service->category->zones ?? [];

            return view('service::admin.service-management.detail', compact('service', 'faqs', 'reviews', 'rating_group_count', 'webPage', 'search', 'language', 'zones'));
        }

        Toastr::error(translate(DEFAULT_204['message']));
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     * @param string $id
     * @return Application|Factory|View|RedirectResponse
     */
    public function edit(string $id): View|Factory|RedirectResponse|Application
    {
        $service = $this->service->withoutGlobalScope('translate')->where('id', $id)->with(['category.children', 'category.zones', 'variations'])->first();
        if (isset($service)) {
            $editingVariants = $service->variations->pluck('variant_key')->unique()->toArray();
            session()->put('editing_variants', $editingVariants);
            $categories = $this->category->where('module_id', $this->currentModuleId())->ofStatus(1)->ofType('main')->latest()->get();
            $subCategories = $this->category->where('module_id', $this->currentModuleId())
                ->ofStatus(1)
                ->ofType('sub')
                ->where('parent_id', $service->category_id)
                ->latest()
                ->get();

            $category = $this->category->where('id', $service->category_id)->with(['zones'])->first();
            $zones = $category->zones ?? [];
            session()->put('category_wise_zones', $zones);

            $tagNames = [];
            if ($service->tags) {
                foreach ($service->tags as $tag) {
                    $tagNames[] = $tag['tag'];
                }
            }

            session()->forget('variations');
            $language = getWebConfig('language');

            return view('service::admin.service-management.edit', compact('categories', 'zones', 'service', 'tagNames', 'language', 'subCategories'));
        }

        Toastr::info(translate(DEFAULT_204['message']));
        return back();
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param string $id
     * @return JsonResponse|RedirectResponse
     */
    public function update(Request $request, string $id): JsonResponse|RedirectResponse
    {
        $request->validate([
            'name' => 'required|max:191',
            'name.0' => 'required|max:191',
            'category_id' => 'required',
            'sub_category_id' => 'nullable',
            'description' => 'required',
            'description.0' => 'required',
            'short_description' => 'required',
            'short_description.0' => 'required',
            'tax' => 'required|numeric|min:0',
            'variants' => 'required|array',
            'min_bidding_price' => 'required|numeric|min:0|not_in:0',
        ]);

        $service = $this->service->find($id);
        if (!isset($service)) {
            return response()->json(response_formatter(DEFAULT_204), 200);
        }

        $tagIds = [];
        if ($request->tags != null) {
            $tags = explode(",", $request->tags);
        }
        if (isset($tags)) {
            foreach ($tags as $key => $value) {
                $tag = Tag::firstOrNew(['tag' => $value]);
                $tag->save();
                $tagIds[] = $tag->id;
            }
        }

        $service->name = $request->name[array_search('default', $request->lang)];
        $service->category_id = $request->category_id;
        $service->sub_category_id = $request->sub_category_id;
        $service->short_description = $request->short_description[array_search('default', $request->lang)];
        $service->description = $request->description[array_search('default', $request->lang)];

        if ($request->has('cover_image')) {
            $service->cover_image = file_uploader('service/', 'png', $request->file('cover_image'));
        }

        if ($request->has('thumbnail')) {
            $service->thumbnail = file_uploader('service/', 'png', $request->file('thumbnail'));
        }

        $service->tax = $request->tax;
        $service->min_bidding_price = $request->min_bidding_price;
        $service->save();
        $service->tags()->sync($tagIds);

        $service->variations()->delete();

        //decoding url encoded keys
        $data = $request->all();
        $data = collect($data)->map(function ($value, $key) {
            $key = urldecode($key);
            return [$key => $value];
        })->collapse()->all();

        $variationFormat = [];
        $zones = $this->zone->latest()->get();
        foreach ($data['variants'] as $item) {
            foreach ($zones as $zone) {
                $price = $data[$item . '_' . $zone->id . '_price'] ?? 0;

                if ($price == 0) {
                    continue;
                }

                $variationFormat[] = [
                    'variant' => str_replace('_', ' ', $item),
                    'variant_key' => $item,
                    'zone_id' => $zone->id,
                    'price' => $price,
                    'service_id' => $service->id
                ];
            }
        }

        $service->variations()->createMany($variationFormat);
        session()->forget('variations');
        session()->forget('editing_variants');

        $defaultLang = str_replace('_', '-', app()->getLocale());

        Helpers::add_or_update_translations(
            request: $request,
            key_data:'name',
            name_field:'name',
            model_name: get_class($service),
            data_id: $service->id,
            data_value: $service->name,
            model_class: true
        );

        Helpers::add_or_update_translations(
            request: $request,
            key_data:'description',
            name_field:'description',
            model_name: get_class($service),
            data_id: $service->id,
            data_value: $service->description,
            model_class: true
        );

        Helpers::add_or_update_translations(
            request: $request,
            key_data:'short_description',
            name_field:'short_description',
            model_name: get_class($service),
            data_id: $service->id,
            data_value: $service->short_description,
            model_class: true
        );


        Toastr::success(translate(DEFAULT_UPDATE_200['message']));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function destroy(Request $request, $id): RedirectResponse
    {
        $service = $this->service->where('id', $id)->first();
        if (isset($service)) {
            foreach (['thumbnail', 'cover_image'] as $item) {
                file_remover('service/', $service[$item]);
            }
            $service->translations()->delete();
            $service->variations()->delete();
            $service->delete();

            Toastr::success(translate(DEFAULT_DELETE_200['message']));
            return back();
        }
        Toastr::success(translate(DEFAULT_204['message']));
        return back();
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function statusUpdate(Request $request, $id): RedirectResponse
    {
        $service = $this->service->where('id', $id)->first();
        $this->service->where('id', $id)->update(['is_active' => !$service->is_active]);

        Toastr::success(translate(DEFAULT_STATUS_UPDATE_200['message']));
        return back();
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function reviewStatusUpdate(Request $request, $id)
    {
        $review = $this->review->where('id', $id)->first();
        $this->review->where('id', $id)->update(['is_active' => !$review->is_active]);

        foreach (['service_id' => $review->service_id, 'provider_id' => $review->provider_id] as $key => $value) {
            $ratingGroupCount = DB::table('service_reviews')->where($key, $value)->where('is_active', 1)
                ->select('review_rating', DB::raw('count(*) as total'))
                ->groupBy('review_rating')
                ->get();

            $totalRating = 0;
            $ratingCount = 0;
            foreach ($ratingGroupCount as $count) {
                $totalRating += round($count->review_rating * $count->total, 2);
                $ratingCount += $count->total;
            }

            $query = collect([]);
            if ($key == 'service_id') {
                $query = $this->service->where(['id' => $value]);
            } elseif ($key == 'provider_id') {
                $query = $this->provider->where(['id' => $value]);
            }

            // Check if $ratingCount is greater than 0 before calculating the average rating
            if ($ratingCount > 0) {
                $avgRating = round($totalRating / $ratingCount, 2);
            } else {
                $avgRating = 0; // Handle cases where there are no ratings
            }

            $query->update([
                'rating_count' => $ratingCount,
                'avg_rating' => $avgRating
            ]);
        }
        Toastr::success(translate(DEFAULT_STATUS_UPDATE_200['message']));
        return redirect()->back();
        // return response()->json(response_formatter(DEFAULT_STATUS_UPDATE_200), 200);
    }


    public function ajaxAddVariant(Request $request): JsonResponse
    {
        $variation = [
            'variant' => $request['name'],
            'variant_key' => str_replace(' ', '-', $request['name']),
            'price' => $request['price']
        ];

        $zones = session()->has('category_wise_zones') ? session('category_wise_zones') : [];
        $existingData = session()->has('variations') ? session('variations') : [];
        $editingVariants = session()->has('editing_variants') ? session('editing_variants') : [];

        if (!self::searchForKey($request['name'], $existingData) && !in_array(str_replace(' ', '-', $request['name']), $editingVariants)) {
            $existingData[] = $variation;
            session()->put('variations', $existingData);
        } else {
            return response()->json(['flag' => 0, 'message' => translate('already_exist')]);
        }

        return response()->json([
            'flag' => 1,
            'template' => view('service::admin.service-management.partials._variant-data', compact('zones'))->render()
        ]);
    }

    public function ajaxRemoveVariant($variant_key)
    {
        $zones = session()->has('category_wise_zones') ? session('category_wise_zones') : [];
        $existingData = session()->has('variations') ? session('variations') : [];

        $filtered = collect($existingData)->filter(function ($values) use ($variant_key) {
            return $values['variant_key'] != $variant_key;
        })->values()->toArray();

        session()->put('variations', $filtered);

        return response()->json(['flag' => 1, 'template' => view('service::admin.service-management.partials._variant-data', compact('zones'))->render()]);
    }

    public function ajaxDeleteDbVariant($variant_key, $service_id)
    {

        $zones = session()->has('category_wise_zones') ? session('category_wise_zones') : $this->zone->ofStatus(1)->latest()->get();
        $variants = $this->variation->where(['service_id' => $service_id])->get();


        if ($variants->count() <= 1) {
            return response()->json([
                'success' => false,
                'message' => translate('you_must_have_at_least_one_variation'),
                'template' => view('service::admin.service-management.partials._update-variant-data', compact('zones', 'variants'))->render()
            ]);
        }

        $this->variation->where(['variant_key' => $variant_key, 'service_id' => $service_id])->delete();

        return response()->json([
            'success' => true,
            'message' => translate('variation_delete_successfully'),
            'template' => view('service::admin.service-management.partials._update-variant-data', compact('zones', 'variants'))
                ->render()]);
    }

    function searchForKey($variant, $array): int|string|null
    {
        foreach ($array as $key => $val) {
            if ($val['variant'] === $variant) {
                return true;
            }
        }
        return false;
    }


    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return string|StreamedResponse
     */
    public function download(Request $request): string|StreamedResponse
    {
        $items = $this->service->with(['category.zonesBasicInfo'])->latest()
            ->when($request->has('search'), function ($query) use ($request) {
                $keys = explode(' ', $request['search']);
                foreach ($keys as $key) {
                    $query->orWhere('name', 'LIKE', '%' . $key . '%');
                }
            })
            ->when($request->has('category_id'), function ($query) use ($request) {
                return $query->where('category_id', $request->category_id);
            })->when($request->has('sub_category_id'), function ($query) use ($request) {
                return $query->where('sub_category_id', $request->sub_category_id);
            })->when($request->has('zone_id'), function ($query) use ($request) {
                return $query->whereHas('category.zonesBasicInfo', function ($queryZone) use ($request) {
                    $queryZone->where('zone_id', $request['zone_id']);
                });
            })->latest()->get();

        return (new FastExcel($items))->download(time() . '-file.xlsx');
    }

    public function reviewsDownload(Request $request)
    {
        $items = $this->review->with(['customer', 'booking'])
            ->when($request->has('review_search') && !empty($request['review_search']), function ($query) use ($request) {
                $keys = explode(' ', $request['review_search']);
                foreach ($keys as $key) {
                    $query->where('review_comment', 'LIKE', '%' . $key . '%')
                        ->orWhere('id', 'LIKE', '%' . $key . '%');
                }
            })
            ->where('service_id', $request->service_id)
            ->latest()
            ->get();

        return (new FastExcel($items))->download(time() . '-file.xlsx');
    }


    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Application|Factory|View
     */
    public function requestList(Request $request): View|Factory|Application
    {
        $search = $request['search'];
        $requests = ServiceRequest::with('category')
            ->where('module_id', $this->currentModuleId())
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

        return view('service::admin.service-management.service.request-list', compact('requests', 'search'));
    }

    /**
     * Display a listing of the resource.
     * @param $id
     * @param Request $request
     * @return RedirectResponse
     */
    public function updateStatus($id, Request $request): RedirectResponse
    {
        $serviceRequest = ServiceRequest::find($id);
        $serviceRequest->status = $request['review_status'] == 1 ? 'approved' : 'denied';
        $serviceRequest->admin_feedback = $request['admin_feedback'];
        $serviceRequest->save();


        if($serviceRequest->type == PROVIDER) {
            $fcmToken = $serviceRequest?->provider?->fcm_token;
            $languageKey = $serviceRequest?->provider?->current_language_key;
            $userName = $serviceRequest?->provider?->company_name;
        } else {
            $fcmToken = $serviceRequest?->user?->cm_firebase_token;
            $languageKey = $serviceRequest?->user?->current_language_key;
            $userName = $serviceRequest?->user?->full_name;
        }

        if (!is_null($fcmToken)) {
            if ($serviceRequest->status == 'approved') {
                $dataInfo = [
                    'provider_name' => $userName
                ];
                $title = get_push_notification_message('provider_service_request_approve', $languageKey);
                   device_notification($fcmToken, $title, null, null, null, 'service_request', null,null, $dataInfo);
            } elseif ($serviceRequest->status == 'denied') {
                $dataInfo = [
                    'provider_name' => $userName
                ];
                $title = get_push_notification_message('provider_service_request_deny', $languageKey);
                   device_notification($fcmToken, $title, null, null, null, 'service_request', null, null, $dataInfo);
            }
        }

        Toastr::success(translate(DEFAULT_STORE_200['message']));
        return back();
    }


    public function export(Request $request){
        $serviceRequest = ServiceRequest::with(['category'])
            ->where('module_id', $this->currentModuleId())
            ->when($request->has('search'), function ($query) use ($request) {
                $keys = explode(' ', $request['search']);
                return $query->whereHas('category', function ($query) use ($keys) {
                    foreach ($keys as $key) {
                        $query->where('name', 'LIKE', '%' . $key . '%');
                    }
                });
            })
            ->latest()->get();


        $data=[
            'data' => $serviceRequest,
            'search' => $request['search'] ?? null,
            'export_type' => 'admin',
        ];

        if($request->type == 'csv'){
            return Excel::download(new ServiceRequestExport($data), 'ServiceRequest.csv');
        }
        return Excel::download(new ServiceRequestExport($data), 'ServiceRequest.xlsx');


    }

}
