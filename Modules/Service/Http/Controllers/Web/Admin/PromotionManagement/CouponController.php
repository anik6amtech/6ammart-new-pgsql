<?php

namespace Modules\Service\Http\Controllers\Web\Admin\PromotionManagement;

use App\CentralLogics\Helpers;
use App\Models\Translation;
use App\Models\User;
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
use Modules\Service\Entities\PromotionManagement\Coupon;
use Modules\Service\Entities\PromotionManagement\CouponCustomer;
use Modules\Service\Entities\PromotionManagement\Discount;
use Modules\Service\Entities\PromotionManagement\DiscountType;
use Modules\Service\Entities\ServiceManagement\Service;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Service\Exports\CouponExport;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CouponController extends Controller
{
    protected CouponCustomer $couponCustomer;
    protected User $customer;
    protected Zone $zone;
    protected Coupon $coupon;
    protected Category $category;
    protected Service $service;
    protected DiscountType $discountType;
    protected Discount $discount;
    protected $discountQuery;

    public function __construct(Coupon $coupon, Discount $discount, DiscountType $discountType, Service $service, Category $category, Zone $zone, User $customer, CouponCustomer $couponCustomer)
    {
        $this->discount = $discount;
        $this->discountQuery = $discount->ofPromotionTypes('coupon');
        $this->coupon = $coupon;
        $this->discountType = $discountType;
        $this->service = $service;
        $this->category = $category;
        $this->zone = $zone;
        $this->customer = $customer;
        $this->couponCustomer = $couponCustomer;
    }

    private function currentModuleId(): int
    {
        return Config::get('module.current_module_id');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Factory|View|Application
     * @throws AuthorizationException
     */
    public function index(Request $request): Factory|View|Application
    {
        $search = $request->has('search') ? $request['search'] : '';
        $discountType = $request->has('discount_type') ? $request['discount_type'] : 'all';
        $queryParam = ['search' => $search, 'discount_type' => $discountType];

        $coupons = $this->coupon->with(['discount', 'discount.category_types', 'discount.service_types', 'discount.zone_types'])
            ->when($request->has('search'), function ($query) use ($request) {
                $keys = explode(' ', $request['search']);
                return $query->where(function ($query) use ($keys) {
                    foreach ($keys as $key) {
                        $query->orWhere('coupon_code', 'LIKE', '%' . $key . '%');
                    }
                });
            })
            ->when($request->has('coupon_type') && $request['coupon_type'] != 'all', function ($query) use ($request) {
                return $query->where(['coupon_type' => $request['coupon_type']]);
            })->when($request->has('discount_type') && $request['discount_type'] != 'all', function ($query) use ($request) {
                return $query->whereHas('discount', function ($query) use ($request) {
                    $query->where(['discount_type' => $request['discount_type']]);
                });
            })
            ->whereIn('module_id', [$this->currentModuleId()])
            ->latest()->paginate(pagination_limit())->appends($queryParam);

        return view('service::admin.promotion-management.coupons.list', compact('coupons', 'search', 'discountType'));
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function create(Request $request): View|Factory|Application
    {
        $categories = $this->category->ofStatus(1)->ofType('main')->latest()->get();
        $zones = $this->zone->active()->latest()->get();
        $services = $this->service->active()->latest()->get();
        $customers = $this->customer->ofStatus(1)->get();

        $language = getWebConfig('language');

        return view('service::admin.promotion-management.coupons.create', compact('categories', 'zones', 'services', 'customers', 'language'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'coupon_code' => 'required|unique:service_coupons',
            'discount_type' => 'required|in:category,service,zone,mixed',
            'coupon_title' => 'required',
            'coupon_title.0' => 'required',
             'coupon_type' => 'required|in:' . implode(',', array_keys(COUPON_TYPES)),
            'discount_amount' => 'required|numeric',
            'discount_amount_type' => 'required|in:percentage,amount',
            'min_purchase' => 'required|numeric',
            'max_discount_amount' => $request['discount_amount_type'] == 'amount' ? '' : 'required' . '|numeric|min:0',
            'coupon_duration' => 'required',
            'limit_per_user' => $request['coupon_type'] != 'first_booking' ? 'numeric' : '',
            'customer_user_ids' => $request['coupon_type'] == 'customer_wise' ? 'required|array' : '',
            // 'customer_user_ids.*' => $request['coupon_type'] == 'customer_wise' ? 'uuid' : ''
        ]);


        DB::transaction(function () use ($request) {

            $dateRange = $request->coupon_duration;
            list($startDate, $endDate) = explode(' - ', $dateRange);
            $startDate = \Carbon\Carbon::createFromFormat('m/d/Y', trim($startDate));
            $endDate = \Carbon\Carbon::createFromFormat('m/d/Y', trim($endDate));
            $startDate = $startDate->startOfDay();
            $endDate = $endDate->endOfDay();

            $discount = $this->discount;
            $discount->module_id = $this->currentModuleId();
            $discount->discount_type = $request['discount_type'];
            $discount->discount_title = $request->coupon_title[array_search('default', $request->lang)];
            $discount->discount_amount = $request['discount_amount'];
            $discount->discount_amount_type = $request['discount_amount_type'];
            $discount->min_purchase = $request['min_purchase'];
            $discount->max_discount_amount = !is_null($request['max_discount_amount']) ? $request['max_discount_amount'] : 0;
            $discount->limit_per_user = $request['coupon_type'] != 'first_booking' ? $request['limit_per_user'] : 1;
            $discount->promotion_type = 'coupon';
            $discount->start_date = $startDate;
            $discount->end_date = $endDate;
            $discount->is_active = 1;
            $discount->save();

            $coupon = $this->coupon;
            $coupon->module_id = $this->currentModuleId();
            $coupon->coupon_code = $request['coupon_code'];
            $coupon->coupon_type = $request['coupon_type'];
            $coupon->discount_id = $discount['id'];
            $coupon->is_active = 1;
            $coupon->save();

            $disTypes = ['category', 'service', 'zone'];
            foreach ((array)$disTypes as $disType) {
                $types = [];
                foreach ((array)$request[$disType . '_ids'] as $id) {
                    $types[] = [
                        'module_id' => $this->currentModuleId(),
                        'discount_id' => $discount['id'],
                        'discount_type' => $disType,
                        'type_wise_id' => $id,
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                }
                $discount->discount_types()->createMany($types);
            }

            if ($request->has('customer_user_ids')) {
                $data = [];
                foreach ($request['customer_user_ids'] as $item) {
                    $data[] = [
                        'module_id' => $this->currentModuleId(),
                        'coupon_id' => $coupon['id'],
                        'customer_user_id' => $item,
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                }
                $coupon->coupon_customers()->createmany($data);
            }

            $defaultLang = str_replace('_', '-', app()->getLocale());

            Helpers::add_or_update_translations(
                request: $request,
                key_data:'discount_title',
                name_field:'coupon_title',
                model_name: get_class($discount),
                data_id: $discount->id,
                data_value: $discount->discount_title,
                model_class: true
            );
        });

        Toastr::success(translate(DEFAULT_STORE_200['message']));
        return redirect()->route('admin.service.coupon.list');
    }

    /**
     * Show the form for editing the specified resource.
     * @param string $id
     * @return Application|Factory|View
     */
    public function edit(string $id): View|Factory|Application
    {
        $coupon = $this->coupon->with(['discount', 'discount.category_types', 'discount.service_types', 'discount.zone_types', 'coupon_customers'])->where('id', $id)->first();
        $discount = $this->discount->where('id', $coupon->discount_id)->withoutGlobalScope('translate')->first();
        $categories = $this->category->ofStatus(1)->ofType('main')->latest()->get();
        $zones = $this->zone->active()->latest()->get();
       $services = $this->service->active()->latest()->get();
        // $services = [];
//        $customers = $this->customer->ofType(CUSTOMER_USER_TYPES)->ofStatus(1)->get();
        $customers = $this->customer->ofStatus(1)->get();

        $language = getWebConfig('language');


        return view('service::admin.promotion-management.coupons.edit', compact('categories', 'zones', 'services', 'coupon', 'customers', 'discount', 'language'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param string $id
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'coupon_code' => ['nullable', 'unique:service_coupons,coupon_code,' . $id . ',id'],
            'discount_type' => 'required|in:category,service,zone,mixed',
            'discount_title' => 'required',
            'discount_title.0' => 'required',
             'coupon_type' => 'required|in:' . implode(',', array_keys(COUPON_TYPES)),
            'discount_amount' => 'required|numeric',
            'discount_amount_type' => 'required|in:percent,amount',
            'min_purchase' => 'required|numeric',
            'max_discount_amount' => $request['discount_amount_type'] == 'amount' ? '' : 'required' . '|numeric|min:0',
            // 'start_date' => 'required|date',
            // 'end_date' => 'required|date',
            'limit_per_user' => $request['coupon_type'] != 'first_booking' ? 'numeric' : '',
        ]);

        DB::transaction(function () use ($request, $id) {
            $dateRange = $request->coupon_duration;
            list($startDate, $endDate) = explode(' - ', $dateRange);
            $startDate = \Carbon\Carbon::createFromFormat('m/d/Y', $startDate);
            $endDate = \Carbon\Carbon::createFromFormat('m/d/Y', $endDate);

            $coupon = $this->coupon->where(['id' => $id])->first();
            $coupon->coupon_code = $request['coupon_code'];
            $coupon->coupon_type = $request['coupon_type'];
            $coupon->save();

            $discount = $this->discountQuery->where('id', $coupon['discount_id'])->first();
            $discount->discount_type = $request['discount_type'];
            $discount->discount_title = $request->discount_title[array_search('default', $request->lang)];
            $discount->discount_amount = $request['discount_amount'];
            $discount->discount_amount_type = $request['discount_amount_type'];
            $discount->min_purchase = $request['min_purchase'];
            $discount->max_discount_amount = !is_null($request['max_discount_amount']) ? $request['max_discount_amount'] : 0;
            $discount->limit_per_user = $request['coupon_type'] != 'first_booking' ? $request['limit_per_user'] : 1;
            $discount->promotion_type = 'coupon';
            $discount->start_date = $startDate;
            $discount->end_date = $endDate;
            $discount->is_active = 1;
            $discount->save();

            $this->discountType->where(['discount_id' => $discount['id']])->delete();

            if ($request['discount_type'] == 'service') {
                $disTypes = ['service', 'zone'];
            } elseif ($request['discount_type'] == 'category') {
                $disTypes = ['category', 'zone'];
            } else {
                $disTypes = ['category', 'service', 'zone'];
            }

            foreach ($disTypes as $disType) {
                $types = [];
                foreach ((array)$request[$disType . '_ids'] as $id) {
                    $types[] = [
                        'module_id' => $this->currentModuleId(),
                        'discount_id' => $discount['id'],
                        'discount_type' => $disType,
                        'type_wise_id' => $id,
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                }
                $discount->discount_types()->createMany($types);
            }

            //coupon customers
            if ($request->has('customer_user_ids')) {
                $data = [];
                foreach ($request['customer_user_ids'] as $item) {
                    $data[] = [
                        'module_id' => $this->currentModuleId(),
                        'coupon_id' => $coupon['id'],
                        'customer_user_id' => $item,
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                }

                $this->couponCustomer->where('coupon_id', $coupon->id)->delete();
                $coupon->coupon_customers()->createmany($data);
            }

            $defaultLang = str_replace('_', '-', app()->getLocale());

            Helpers::add_or_update_translations(
                request: $request,
                key_data:'discount_title',
                name_field:'discount_title',
                model_name: get_class($discount),
                data_id: $discount->id,
                data_value: $discount->discount_title,
                model_class: true
            );
            /* foreach ($request->lang as $index => $key) {
                if ($defaultLang == $key && !($request->discount_title[$index])) {
                    if ($key != 'default') {
                        Translation::updateOrInsert(
                            [
                                'translationable_type' => get_class($discount),
                                'translationable_id' => $discount->id,
                                'locale' => $key,
                                'key' => 'discount_title'],
                            ['value' => $coupon->discount_title]
                        );
                    }
                } else {

                    if ($request->discount_title[$index] && $key != 'default') {
                        Translation::updateOrInsert(
                            [
                                'translationable_type' => get_class($discount),
                                'translationable_id' => $discount->id,
                                'locale' => $key,
                                'key' => 'discount_title'],
                            ['value' => $request->discount_title[$index]]
                        );
                    }
                }
            } */
        });


        Toastr::success(trans(COUPON_UPDATE_200['message']));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function destroy(Request $request, $id): RedirectResponse
    {
        $coupon = $this->coupon->where('id', $id)->first();
        $this->discount->where('id', $coupon['discount_id'])->withoutGlobalScope('translate')->delete();
        $this->discount->where('id', $coupon['discount_id'])->withoutGlobalScope('translate')->delete();
        $this->discountType->where('discount_id', $coupon['discount_id'])->delete();
        $this->coupon->where('id', $id)->delete();
        Toastr::success(translate(DEFAULT_DELETE_200['message']));
        return back();
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param $id
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function statusUpdate(Request $request, $id): RedirectResponse
    {
        $coupon = $this->coupon->where('id', $id)->first();
        $this->coupon->where('id', $id)->update(['is_active' => !$coupon->is_active]);
        $this->discount->where('id', $coupon->discount_id)->update(['is_active' => !$coupon->is_active]);

        Toastr::success(trans(COUPON_UPDATE_200['message']));
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
        $coupons = $this->coupon->with(['discount', 'discount.category_types', 'discount.service_types', 'discount.zone_types'])
            ->when($request->has('search'), function ($query) use ($request) {
                $keys = explode(' ', $request['search']);
                return $query->where(function ($query) use ($keys) {
                    foreach ($keys as $key) {
                        $query->orWhere('coupon_code', 'LIKE', '%' . $key . '%');
                    }
                });
            })
            ->when($request->has('coupon_type') && $request['coupon_type'] != 'all', function ($query) use ($request) {
                return $query->where(['coupon_type' => $request['coupon_type']]);
            })->when($request->has('discount_type') && $request['discount_type'] != 'all', function ($query) use ($request) {
                return $query->whereHas('discount', function ($query) use ($request) {
                    $query->where(['discount_type' => $request['discount_type']]);
                });
            })
            ->latest()
            ->get();

        $fileName = 'coupons.xlsx';
        $search = $request->input('search') ?? '';
        $couponType = $request->input('coupon_type') ?? 'all';
        $discountType = $request->input('discount_type') ?? 'all';

        return Excel::download(new CouponExport([
            'coupons' => $coupons,
            'search' => $search,
            'coupon_type' => $couponType,
            'discount_type' => $discountType,
        ]), $fileName);
    }
}
