<?php

namespace Modules\Service\Http\Controllers\Web\Admin\PromotionManagement;

use App\CentralLogics\Helpers;
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
use Modules\Service\Entities\CategoryManagement\Category;
use Modules\Service\Entities\PromotionManagement\Discount;
use Modules\Service\Entities\PromotionManagement\DiscountType;
use Modules\Service\Entities\ServiceManagement\Service;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Service\Exports\DiscountExport;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DiscountController extends Controller
{

    protected $discount, $service, $category, $zone, $discount_types, $discountQuery;

    public function __construct(Discount $discount, Service $service, Category $category, Zone $zone, DiscountType $discount_types)
    {
        $this->discountQuery = $discount->ofPromotionTypes('discount');
        $this->discount = $discount;
        $this->service = $service;
        $this->category = $category;
        $this->zone = $zone;
        $this->discount_types = $discount_types;
    }

    private function currentModuleId(): int
    {
        return Config::get('module.current_module_id');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request): View|Factory|Application
    {
        $search = $request->has('search') ? $request['search'] : '';
        $type = $request->has('type') ? $request['type'] : 'all';
        $queryParam = ['search' => $search, 'type' => $type];

        $discounts = $this->discountQuery->with(['category_types', 'service_types', 'zone_types'])
            ->when($request->has('search'), function ($query) use ($request) {
                $keys = explode(' ', $request['search']);
                return $query->where(function ($query) use ($keys) {
                    foreach ($keys as $key) {
                        $query->orWhere('discount_title', 'LIKE', '%' . $key . '%');
                    }
                });
            })
            ->when($type != 'all', function ($query) use ($type) {
                return $query->where(['discount_type' => $type]);
            })
            ->whereIn('module_id', [$this->currentModuleId()])
            ->orderBy('created_at', 'desc')->paginate(pagination_limit())->appends($queryParam);

        return view('service::admin.promotion-management.discounts.list', compact('discounts', 'search', 'type'));
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Application|Factory|View
     */
    public function create(Request $request): View|Factory|Application
    {
        $categories = $this->category->ofStatus(1)->ofType('main')->latest()->get();
        $zones = $this->zone->withoutGlobalScope('translate')->active()->latest()->get();
         $services = $this->service->active()->latest()->get();
//        $services = [];
        $language = getWebConfig('language');

        return view('service::admin.promotion-management.discounts.create', compact('categories', 'zones', 'services', 'language'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'discount_type' => 'required|in:category,service,zone,mixed',
            'discount_amount' => 'required|numeric',
            'discount_title' => 'required',
            'discount_title.0' => 'required',
            'discount_amount_type' => 'required|in:percent,amount',
            'min_purchase' => 'required|numeric|min:0',
            'max_discount_amount' => $request['discount_amount_type'] == 'amount' ? '' : 'required' . '|numeric|min:0',
            // 'start_date' => 'required|date',
            // 'end_date' => 'required|date',
            'category_ids' => 'array',
            'service_ids' => 'array',
            'zone_ids' => 'required|array',
        ]);
        // dd($request->all());

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
            $discount->promotion_type = 'discount';
            $discount->start_date = $startDate;
            $discount->end_date = $endDate;
            $discount->is_active = 1;
            $discount->module_id = $this->currentModuleId();
            $discount->save();

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
        });

        Toastr::success(translate(DISCOUNT_CREATE_200['message']));
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     * @param string $id
     * @return Application|Factory|View
     */
    public function edit(string $id): View|Factory|Application
    {
        $discount = $this->discountQuery->withoutGlobalScope('translate')->with(['category_types', 'service_types', 'zone_types'])->where('id', $id)->first();
        $categories = $this->category->ofStatus(1)->ofType('main')->latest()->get();
        $zones = $this->zone->withoutGlobalScope('translate')->active()->latest()->get();
         $services = $this->service->active()->latest()->get();
//        $services = [];

        $language = getWebConfig('language');

        return view('service::admin.promotion-management.discounts.edit', compact('categories', 'zones', 'services', 'discount', 'language'));
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
            'discount_type' => 'required|in:category,service,zone,mixed',
            'discount_amount' => 'required|numeric',
            'discount_title' => 'required',
            'discount_amount_type' => 'required|in:percent,amount',
            'min_purchase' => 'required|numeric',
            'max_discount_amount' => $request['discount_amount_type'] == 'amount' ? '' : 'required' . '|numeric|min:0',
            // 'start_date' => 'required|date',
            // 'end_date' => 'required|date',
            'category_ids' => 'array',
            'service_ids' => 'array',
            'zone_ids' => 'required|array',
        ]);
        $discount = $this->discountQuery->where(['id' => $id])->first();
        if (isset($discount)) {
            DB::transaction(function () use ($request, $id, $discount) {

                $dateRange = $request->discount_duration;
                list($startDate, $endDate) = explode(' - ', $dateRange);
                $startDate = \Carbon\Carbon::createFromFormat('m/d/Y', trim($startDate));
                $endDate = \Carbon\Carbon::createFromFormat('m/d/Y', trim($endDate));
                $startDate = $startDate->startOfDay();
                $endDate = $endDate->endOfDay();

                $discount->discount_type = $request['discount_type'];
                $discount->discount_title = $request->discount_title[array_search('default', $request->lang)];
                $discount->discount_amount = $request['discount_amount'];
                $discount->discount_amount_type = $request['discount_amount_type'];
                $discount->min_purchase = $request['min_purchase'];
                $discount->max_discount_amount = !is_null($request['max_discount_amount']) ? $request['max_discount_amount'] : 0;
                $discount->promotion_type = 'discount';
                $discount->start_date = $startDate;
                $discount->end_date = $endDate;
                $discount->is_active = 1;
                $discount->save();

                $discount->discount_types()->delete();

                if ($request['discount_type'] == 'category') {
                    $disTypes = ['category', 'zone'];
                } elseif ($request['discount_type'] == 'service') {
                    $disTypes = ['service', 'zone'];
                } elseif ($request['discount_type'] == 'mixed') {
                    $disTypes = ['category', 'service', 'zone'];
                }

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
            });
        }

        Toastr::success(translate(DISCOUNT_UPDATE_200['message']));
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
        $discount = $this->discountQuery->where('id', $id);
        $this->discount_types->where(['discount_id' => $id])->delete();
        $discount->delete();

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
        $discount = $this->discountQuery->where('id', $id)->first();
        $this->discountQuery->where('id', $id)->update(['is_active' => !$discount->is_active]);

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
        $search = $request->has('search') ? $request['search'] : '';
        $type = $request->has('type') ? $request['type'] : 'all';

        $discounts = $this->discountQuery->with(['category_types', 'service_types', 'zone_types'])
            ->when($request->has('search'), function ($query) use ($request) {
                $keys = explode(' ', $request['search']);
                return $query->where(function ($query) use ($keys) {
                    foreach ($keys as $key) {
                        $query->orWhere('discount_title', 'LIKE', '%' . $key . '%');
                    }
                });
            })
            ->when($type != 'all', function ($query) use ($type) {
                return $query->where(['discount_type' => $type]);
            })
            ->whereIn('module_id', [$this->currentModuleId()])
            ->latest()
            ->get();

        $fileName = 'discounts.xlsx';
        $search = $request->input('search') ?? '';

        return Excel::download(new DiscountExport([
            'discounts' => $discounts,
            'search' => $search,
        ]), $fileName);
    }
}
