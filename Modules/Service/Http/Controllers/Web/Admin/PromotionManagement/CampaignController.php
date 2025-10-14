<?php

namespace Modules\Service\Http\Controllers\Web\Admin\PromotionManagement;

use App\CentralLogics\Helpers;
use App\Models\Zone;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Modules\Service\Entities\CategoryManagement\Category;
use Modules\Service\Entities\PromotionManagement\Campaign;
use Modules\Service\Entities\PromotionManagement\Discount;
use Modules\Service\Entities\PromotionManagement\DiscountType;
use Modules\Service\Entities\ServiceManagement\Service;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Service\Exports\CampaignExport;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CampaignController extends Controller
{
    protected $discount, $campaign, $discountType, $service, $category, $zone, $discountTypes;

    public function __construct(Campaign $campaign, Discount $discount, DiscountType $discountType, Service $service, Category $category, Zone $zone)
    {
        $this->discount = $discount;
        $this->campaign = $campaign;
        $this->discountType = $discountType;
        $this->service = $service;
        $this->category = $category;
        $this->zone = $zone;
    }

    private function currentModuleId(): int
    {
        return Config::get('module.current_module_id');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Factory|View|Application
     */
    public function index(Request $request): Factory|View|Application
    {
        $search = $request->has('search') ? $request['search'] : '';
        $type = $request->has('type') ? $request['type'] : 'all';
        $queryParam = ['search' => $search, 'type' => $type];
        $campaigns = $this->campaign->with(['discount', 'discount.category_types.category', 'discount.service_types.service', 'discount.zone_types'])
            ->when($request->has('search'), function ($query) use ($request) {
                $keys = explode(' ', $request['search']);
                return $query->where(function ($query) use ($keys) {
                    foreach ($keys as $key) {
                        $query->orWhere('campaign_name', 'LIKE', '%' . $key . '%');
                    }
                });
            })
            ->when($request->has('type') && $request['type'] != 'all', function ($query) use ($request) {
                return $query->whereHas('discount',function ($query) use ($request) {
                    $query->where(['discount_type' => $request['type']]);
                });
            })->latest()->paginate(pagination_limit())->appends($queryParam);

        return view('service::admin.promotion-management.campaigns.list', compact('campaigns', 'search', 'type'));
    }


    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Application|Factory|View
     */
    public function create(Request $request): View|Factory|Application
    {
        $categories = $this->category->ofStatus(1)->ofType('main')->latest()->get();
        $zones = $this->zone->active()->latest()->get();
        $services = $this->service->active()->latest()->get();

        $language = getWebConfig('language');
        return view('service::admin.promotion-management.campaigns.create', compact('categories', 'zones', 'services', 'language'));
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'campaign_name' => 'required',
            'campaign_name.0' => 'required',
            'campaign_image' => 'required|image|required|max:10000|mimes:' . implode(',', array_column(IMAGEEXTENSION, 'key')),
            'thumbnail' => 'required|image|required|max:10000|mimes:' . implode(',', array_column(IMAGEEXTENSION, 'key')),
            'discount_type' => 'required',
            'discount_title' => 'required',
            'discount_amount' => 'required|numeric',
            'discount_amount_type' => 'required|in:percent,amount',
            'min_purchase' => 'required|numeric',
            'max_discount_amount' => $request['discount_amount_type'] == 'amount' ? '' : 'required' . '|numeric|min:0',
            // 'start_date' => 'required|date',
            // 'end_date' => 'required|date',
            'limit_per_user' => 'numeric',
            'short_description' => 'required',
        ]);

        DB::transaction(function () use ($request) {

            $dateRange = $request->discount_duration;
            list($startDate, $endDate) = explode(' - ', $dateRange);
            $startDate = \Carbon\Carbon::createFromFormat('m/d/Y', trim($startDate));
            $endDate = \Carbon\Carbon::createFromFormat('m/d/Y', trim($endDate));
            $startDate = $startDate->startOfDay();
            $endDate = $endDate->endOfDay();

            $discount = $this->discount;
            $discount->module_id = $this->currentModuleId();
            $discount->discount_type = $request['discount_type'];
            $discount->discount_title = $request->discount_title[array_search('default', $request->lang)];
            $discount->discount_amount = $request['discount_amount'];
            $discount->discount_amount_type = $request['discount_amount_type'];
            $discount->min_purchase = $request['min_purchase'];
            $discount->max_discount_amount = !is_null($request['max_discount_amount']) ? $request['max_discount_amount'] : 0;
            $discount->limit_per_user = $request['limit_per_user']??0;
            $discount->promotion_type = 'campaign';
            $discount->start_date = $startDate;
            $discount->end_date = $endDate;
            $discount->is_active = 1;
            $discount->save();

            $campaign = $this->campaign;
            $campaign->thumbnail = file_uploader('campaign/', 'png', $request->file('thumbnail'));
            $campaign->cover_image = file_uploader('campaign/', 'png', $request->file('campaign_image'));
            $campaign->campaign_name = $request->campaign_name[array_search('default', $request->lang)];
            $campaign->short_description = $request->short_description[array_search('default', $request->lang)] ?? '';
            $campaign->discount_id = $discount->id;
            $campaign->is_active = 1;
            $campaign->save();

            $disTypes = ['category', 'service', 'zone'];
            foreach ((array)$disTypes as $disType) {
                $types = [];
                foreach ((array)$request[$disType . '_ids'] as $id) {
                    $types[] = [
                        'discount_id' => $discount['id'],
                        'discount_type' => $disType,
                        'type_wise_id' => $id,
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                }
                $discount->discount_types()->createMany($types);
            }

            Helpers::add_or_update_translations(
                request: $request,
                key_data:'discount_title',
                name_field:'discount_title',
                model_name: get_class($discount),
                data_id: $discount->id,
                data_value: $discount->discount_title,
                model_class: true
            );

            Helpers::add_or_update_translations(
                request: $request,
                key_data:'campaign_name',
                name_field:'campaign_name',
                model_name: get_class($campaign),
                data_id: $campaign->id,
                data_value: $campaign->campaign_name,
                model_class: true
            );

            Helpers::add_or_update_translations(
                request: $request,
                key_data:'short_description',
                name_field:'short_description',
                model_name: get_class($campaign),
                data_id: $campaign->id,
                data_value: $campaign->short_description,
                model_class: true
            );

        });

        Toastr::success(translate(DEFAULT_STORE_200['message']));
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     * @param string $id
     * @return Application|Factory|View
     */
    public function edit(string $id): View|Factory|Application
    {
        $campaign = $this->campaign
            ->withoutGlobalScope('translate')
            ->with(['discount' => fn($query) => $query->withoutGlobalScope('translate'), 'discount.category_types', 'discount.service_types', 'discount.zone_types'])->where('id', $id)->first();
        $categories = $this->category->ofStatus(1)->ofType('main')->latest()->get();
        $zones = $this->zone->active()->latest()->get();
        $services = $this->service->active()->latest()->get();
        $language = getWebConfig('language');
        $discount = $campaign->discount;
        return view('service::admin.promotion-management.campaigns.edit', compact('categories', 'zones', 'services', 'campaign', 'language', 'discount'));
    }


    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param string $id
     * @return RedirectResponse
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'campaign_name' => 'required',
            'short_description' => 'required',
            'cover_image' => 'image|max:10000|mimes:' . implode(',', array_column(IMAGEEXTENSION, 'key')),
            'thumbnail' => 'image|max:10000|mimes:' . implode(',', array_column(IMAGEEXTENSION, 'key')),
            'discount_type' => 'required',
            'discount_title' => 'required',
            'discount_amount' => 'required|numeric',
            'discount_amount_type' => 'required|in:percent,amount',
            'min_purchase' => 'required|numeric',
            'max_discount_amount' => $request['discount_amount_type'] == 'amount' ? '' : 'required' . '|numeric|min:0',
            // 'start_date' => 'required|date',
            // 'end_date' => 'required|date',
            'limit_per_user' => 'numeric',
        ]);

        DB::transaction(function () use ($request, $id) {
            $dateRange = $request->discount_duration;
            list($startDate, $endDate) = explode(' - ', $dateRange);
            $startDate = \Carbon\Carbon::createFromFormat('m/d/Y', trim($startDate));
            $endDate = \Carbon\Carbon::createFromFormat('m/d/Y', trim($endDate));
            $startDate = $startDate->startOfDay();
            $endDate = $endDate->endOfDay();

            $campaign = $this->campaign->where(['id' => $id])->first();
            if ($request->has('thumbnail')) {
                $campaign->thumbnail = file_uploader('campaign/', 'png', $request->file('thumbnail'), $campaign->thumbnail);
            }
            if ($request->has('campaign_image')) {
                $campaign->cover_image = file_uploader('campaign/', 'png', $request->file('campaign_image'), $campaign->cover_image);
            }
            $campaign->campaign_name = $request->campaign_name[array_search('default', $request->lang)];
            $campaign->short_description = $request->short_description[array_search('default', $request->lang)] ?? '';
            $campaign->save();

            $discount = $this->discount->find($campaign['discount_id']);
            $discount->discount_type = $request['discount_type'];
            $discount->discount_title = $request->discount_title[array_search('default', $request->lang)];
            $discount->discount_amount = $request['discount_amount'];
            $discount->discount_amount_type = $request['discount_amount_type'];
            $discount->min_purchase = $request['min_purchase'];
            $discount->max_discount_amount = !is_null($request['max_discount_amount']) ? $request['max_discount_amount'] : 0;
            $discount->limit_per_user = $request['limit_per_user']??0;
            $discount->start_date = $startDate;
            $discount->end_date = $endDate;
            $discount->is_active = 1;
            $discount->save();

            $discount->discount_types()->delete();

            $disTypes = ['category', 'service', 'zone'];
            foreach ((array)$disTypes as $disType) {
                $types = [];
                foreach ((array)$request[$disType . '_ids'] as $id) {
                    $types[] = [
                        'discount_id' => $discount['id'],
                        'discount_type' => $disType,
                        'type_wise_id' => $id,
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                }
                $discount->discount_types()->createMany($types);
            }

            Helpers::add_or_update_translations(
                request: $request,
                key_data:'discount_title',
                name_field:'discount_title',
                model_name: get_class($discount),
                data_id: $discount->id,
                data_value: $discount->discount_title,
                model_class: true
            );

            Helpers::add_or_update_translations(
                request: $request,
                key_data:'campaign_name',
                name_field:'campaign_name',
                model_name: get_class($campaign),
                data_id: $campaign->id,
                data_value: $campaign->campaign_name,
                model_class: true
            );

            Helpers::add_or_update_translations(
                request: $request,
                key_data:'short_description',
                name_field:'short_description',
                model_name: get_class($campaign),
                data_id: $campaign->id,
                data_value: $campaign->short_description,
                model_class: true
            );
        });

        Toastr::success(translate(CAMPAIGN_UPDATE_200['message']));
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
        $campaign = $this->campaign->where('id', $id)->first();

        if (isset($campaign)){
            file_remover('campaign/', $campaign['thumbnail']);
            file_remover('campaign/', $campaign['cover_image']);
            $this->discount->where('id', $campaign['discount_id'])->delete();
            $this->discountType->where('discount_id', $campaign['discount_id'])->delete();
            $this->campaign->where('id', $id)->delete();
        }

        Toastr::success(translate(DEFAULT_DELETE_200['message']));
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
        $campaign = $this->campaign->where('id', $id)->first();
        $this->campaign->where('id', $id)->update(['is_active' => !$campaign->is_active]);
        $this->discount->where('id', $campaign->discount_id)->update(['is_active' => !$campaign->is_active]);

        Toastr::success(translate(DEFAULT_STATUS_UPDATE_200['message']));
        return back();
        // return response()->json(response_formatter(DEFAULT_STATUS_UPDATE_200), 200);
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return string|StreamedResponse
     */
    public function download(Request $request)
    {
        $campaigns = $this->campaign->with(['discount', 'discount.category_types.category', 'discount.service_types.service', 'discount.zone_types'])
            ->when($request->has('search'), function ($query) use ($request) {
                $keys = explode(' ', $request['search']);
                return $query->where(function ($query) use ($keys) {
                    foreach ($keys as $key) {
                        $query->orWhere('campaign_name', 'LIKE', '%' . $key . '%');
                    }
                });
            })
            ->when($request->has('type') && $request['type'] != 'all', function ($query) use ($request) {
                return $query->whereHas('discount',function ($query) use ($request) {
                    $query->where(['discount_type' => $request['type']]);
                });
            })->latest()
            ->get();

        $fileName = 'campaigns.xlsx';
        $search = $request->input('search') ?? '';
        $discountType = $request->input('discount_type') ?? '';

        return Excel::download(new CampaignExport([
            'campaigns' => $campaigns,
            'search' => $search,
            'discount_type' => $discountType,
        ]), $fileName);
    }
}
