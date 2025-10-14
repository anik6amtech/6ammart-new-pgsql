<?php

namespace Modules\Service\Http\Controllers\Web\Admin\ProviderManagement;

use App\CentralLogics\Helpers;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Modules\Service\Entities\BookingModule\Booking;
use Modules\Service\Entities\ProviderManagement\Provider;
use Modules\Service\Entities\ProviderManagement\Serviceman;

class ServicemanController extends Controller
{
    protected Provider $provider;
    private Serviceman $serviceman;

    public function __construct
    (
        Serviceman $serviceman,
        Provider $provider
    )
    {
        $this->provider = $provider;
        $this->serviceman = $serviceman;
    }

    private function currentModuleId(): int
    {
        return Config::get('module.current_module_id');
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Renderable
     */
    /* public function index(Request $request): Renderable
    {

        Validator::make($request->all(), [
            'search' => 'string',
        ]);

        $search = $request->has('search') ? $request['search'] : '';
        $queryParam = ['search' => $search];

        $providers = $this->serviceman->where(['is_approved' => 1])
            ->when($request->has('search'), function ($query) use ($request) {
                $keys = explode(' ', $request['search']);
                return $query->where(function ($query) use ($keys) {
                    foreach ($keys as $key) {
                        $query->orWhere('first_name', 'LIKE', '%' . $key . '%')
                            ->orWhere('last_name', 'LIKE', '%' . $key . '%');
                    }
                });
            })
            ->latest()
            ->paginate(pagination_limit())->appends($queryParam);

        return view('service::admin.provider-management.provider.index', compact('providers', 'search'));
    } */

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create($id): Renderable
    {
        $language = getWebConfig('language');
        $provider = $this->provider->find($id);
        return view('service::admin.provider-management.provider.serviceman.create', compact('language', 'provider'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request, $id): RedirectResponse
    {
        // dd($request->all());
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            // 'address' => 'required',
            // 'business_phone' => 'required',
            'image' => 'required|image|mimes:jpeg,jpg,png,gif',
            // 'cover_photo' => 'required|image|mimes:jpeg,jpg,png,gif',
            // 'zone_id' => 'required',
            // 'latitude' => 'required',
            // 'longitude' => 'required',
            // 'minimum_service_time' => 'required|integer|min:0',
            // 'maximum_service_time' => 'required|integer|min:0',
            // 'service_time_type' => 'required|in:min,hours,days',
            // 'f_name' => 'required|string|max:191',
            // 'l_name' => 'required|string|max:191',
            'phone' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',

            'identity_type' => 'required|in:passport,driving_license,nid,trade_license,company_id',
            'identity_number' => 'required',
            'identity_images' => 'nullable|array',
            'identity_images.*' => 'image|mimes:jpeg,jpg,png,gif',
        ]);

        if (Serviceman::where('email', $request['email'])->first()) {
            Toastr::error(translate('Email already taken'));
            return back();
        }
        if (Serviceman::where('phone', $request['phone'])->first()) {
            Toastr::error(translate('Phone already taken'));
            return back();
        }

        //verify provider
        $provider = $this->provider->withoutGlobalScope('translate')->find($id);
        if (!$provider) {
            Toastr::error(translate('Provider not found'));
            return back();
        }

        $identityImages = [];
        if ($request->has('identity_images')) {
            foreach ($request->identity_images as $image) {
                $imageName = file_uploader('provider/identity/', 'png', $image);
                $identityImages[] = ['image'=>$imageName, 'storage'=> getDisk()];
            }
        }

        DB::beginTransaction();

        $serviceman = $this->serviceman;
        $serviceman->module_id = $this->currentModuleId();
        $serviceman->service_provider_id = $id;
        $serviceman->first_name = $request->first_name;
        $serviceman->last_name = $request->last_name;
        $serviceman->phone = $request->phone;
        $serviceman->email = $request->email;
        $serviceman->password = bcrypt($request->password);
        $serviceman->identification_type = $request->identity_type;
        $serviceman->identification_number = $request->identity_number;
        $serviceman->identification_image = json_encode($identityImages);

        $serviceman->profile_image = file_uploader('provider/serviceman/', 'png', $request->file('image'));

        $serviceman->is_approved = 1; // auto approved
        $serviceman->save();
        DB::commit();

        Toastr::success(translate(PROVIDER_STORE_200['message']));
        return redirect()->route('admin.service.provider.details', ['id' => $id, 'tab' => 'serviceman_list']);

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @param Request $request
     * @return Application|Factory|View|\Illuminate\Foundation\Application|RedirectResponse
     */
    public function details(Request $request, int $id, $serviceman_id)
    {
        $provider = $this->provider->find($id);
        $serviceman = $this->serviceman->find($serviceman_id);

        if (empty($serviceman)) {
            Toastr::error(translate('Invalid Serviceman'));
            return redirect()->back();
        }

        // -------------------------
        // 1) Determine date range (from / to) based on date_range param
        // -------------------------
        $dateRange = $request->input('date_range', null);
        $from = null;
        $to = null;

        if (is_null($dateRange) || $dateRange == 'all_time') {
            // leave $from/$to null => no date filter (all time)
        } elseif ($dateRange == 'this_week') {
            $from = Carbon::now()->startOfWeek()->startOfDay();
            $to = Carbon::now()->endOfWeek()->endOfDay();
        } elseif ($dateRange == 'last_week') {
            $from = Carbon::now()->subWeek()->startOfWeek()->startOfDay();
            $to = Carbon::now()->subWeek()->endOfWeek()->endOfDay();
        } elseif ($dateRange == 'this_month') {
            $from = Carbon::now()->startOfMonth()->startOfDay();
            $to = Carbon::now()->endOfMonth()->endOfDay();
        } elseif ($dateRange == 'last_month') {
            $from = Carbon::now()->subMonth()->startOfMonth()->startOfDay();
            $to = Carbon::now()->subMonth()->endOfMonth()->endOfDay();
        } elseif ($dateRange == 'last_15_days') {
            $from = Carbon::now()->subDays(14)->startOfDay(); // last 15 days (including today)
            $to = Carbon::now()->endOfDay();
        } elseif ($dateRange == 'this_year') {
            $from = Carbon::now()->startOfYear()->startOfDay();
            $to = Carbon::now()->endOfYear()->endOfDay();
        } elseif ($dateRange == 'last_year') {
            $from = Carbon::now()->subYear()->startOfYear()->startOfDay();
            $to = Carbon::now()->subYear()->endOfYear()->endOfDay();
        } elseif ($dateRange == 'custom_date') {
            // expect 'from' and 'to' in request
            if ($request->has('from') && $request->has('to')) {
                $from = Carbon::parse($request->input('from'))->startOfDay();
                $to = Carbon::parse($request->input('to'))->endOfDay();
            }
        } else {
            // fallback: treat as all_time
        }

        // -------------------------
        // 2) Decide grouping (deterministic) for chart
        // -------------------------
        if (is_null($dateRange) || $dateRange == 'all_time') {
            $deterministic = 'year';
        } elseif (in_array($dateRange, ['this_week', 'last_week'])) {
            $deterministic = 'week';
        } elseif (in_array($dateRange, ['this_month', 'last_month', 'last_15_days'])) {
            $deterministic = 'day';
        } elseif (in_array($dateRange, ['this_year', 'last_year'])) {
            $deterministic = 'month';
        } elseif ($dateRange == 'custom_date' && isset($from, $to)) {
            $diff = $from->diffInDays($to);
            $deterministic = $diff <= 7 ? 'week' : ($diff <= 30 ? 'day' : ($diff <= 365 ? 'month' : 'year'));
        } else {
            $deterministic = 'year';
        }

        $groupByDeterministic = $deterministic === 'week' ? 'day' : $deterministic; // week charts by day number

        // -------------------------
        // 3) Helper: apply same filters to any query builder
        // -------------------------
        $applyCommonFilters = function ($q) use ($request, $serviceman_id, $from, $to) {
            $q->where('serviceman_id', $serviceman_id);

            if ($request->has('zone_ids')) {
                $q->whereIn('zone_id', (array)$request->input('zone_ids'));
            }
            if ($request->has('category_ids')) {
                $q->whereIn('category_id', (array)$request->input('category_ids'));
            }
            if ($request->has('sub_category_ids')) {
                $q->whereIn('sub_category_id', (array)$request->input('sub_category_ids'));
            }
            if ($request->has('booking_status')) {
                $q->whereIn('booking_status', (array)$request->input('booking_status'));
            }
            if (isset($from) && isset($to)) {
                $q->whereBetween('created_at', [$from, $to]);
            }
        };

        // -------------------------
        // 4) Build combined overview (service_bookings + service_booking_repeats)
        //    - grouped by booking_status for counts (to fill existing keys)
        // -------------------------
        $bookingOverviewQuery = DB::table('service_bookings')
            ->select('booking_status', DB::raw('COUNT(*) as total'));
        $applyCommonFilters($bookingOverviewQuery);
        $bookingOverviewQuery->groupBy('booking_status');

        $repeatOverviewQuery = DB::table('service_booking_repeats')
            ->select('booking_status', DB::raw('COUNT(*) as total'));
        $applyCommonFilters($repeatOverviewQuery);
        $repeatOverviewQuery->groupBy('booking_status');

        $combinedOverview = collect($bookingOverviewQuery->unionAll($repeatOverviewQuery)->get())
            ->groupBy('booking_status')
            ->map(fn($group) => $group->sum('total'));

        // ensure keys exist and default to 0
        $assigned = $combinedOverview->sum() ?? 0;
        $ongoing = $combinedOverview->get('ongoing', 0);
        $completed = $combinedOverview->get('completed', 0);
        $cancelled = $combinedOverview->get('canceled', 0);

        $countData = [
            'assigned_bookings'  => $assigned,
            'ongoing_bookings'   => $ongoing,
            'completed_bookings' => $completed,
            'cancelled_bookings' => $cancelled,
        ];

        // -------------------------
        // 5) Build chart data from merged tables using SAME filters
        //    - group by month/day/year depending on $groupByDeterministic
        // -------------------------
        // determine DB raw expression name & alias
        if ($groupByDeterministic === 'month') {
            $groupRaw = "MONTH(created_at)";
            $alias = 'month';
        } elseif ($groupByDeterministic === 'day') {
            $groupRaw = "DAY(created_at)";
            $alias = 'day';
        } elseif ($groupByDeterministic === 'year') {
            $groupRaw = "YEAR(created_at)";
            $alias = 'year';
        } else {
            // fallback to day
            $groupRaw = "DAY(created_at)";
            $alias = 'day';
        }

        $bookingChartQuery = DB::table('service_bookings')
            ->select(DB::raw("COUNT(id) as total_booking"), DB::raw("$groupRaw as $alias"));
        $applyCommonFilters($bookingChartQuery);
        $bookingChartQuery->groupBy($alias);

        $repeatChartQuery = DB::table('service_booking_repeats')
            ->select(DB::raw("COUNT(id) as total_booking"), DB::raw("$groupRaw as $alias"));
        $applyCommonFilters($repeatChartQuery);
        $repeatChartQuery->groupBy($alias);

        $merged = collect($bookingChartQuery->unionAll($repeatChartQuery)->get())
            ->groupBy($alias)
            ->map(fn($g) => (int)$g->sum('total_booking'))
            ->toArray();

        // -------------------------
        // 6) Fill chartdata timeline & totals according to deterministic
        // -------------------------
        $chartdata = ['total_booking' => [], 'timeline' => []];

        if ($deterministic === 'month') {
            // months 1..12
            for ($m = 1; $m <= 12; $m++) {
                $chartdata['timeline'][] = $m;
                $chartdata['total_booking'][] = isset($merged[$m]) ? (int)$merged[$m] : 0;
            }
        } elseif ($deterministic === 'year') {
            // years present in merged keys (sorted)
            $years = array_keys($merged);
            sort($years, SORT_NUMERIC);
            foreach ($years as $y) {
                $chartdata['timeline'][] = (int)$y;
                $chartdata['total_booking'][] = (int)$merged[$y];
            }
        } elseif ($deterministic === 'day') {
            // day numbers -> if a specific month range was used, use that month's days
            if (isset($from) && isset($to) && $from->copy()->startOfMonth()->eq($to->copy()->startOfMonth())) {
                // single month range -> use that month's day count
                $daysInMonth = $from->daysInMonth;
                for ($d = 1; $d <= $daysInMonth; $d++) {
                    $chartdata['timeline'][] = $d;
                    $chartdata['total_booking'][] = $merged[$d] ?? 0;
                }
            } else {
                // default: use last 30 days or daysInMonth of 'to' if set else current month
                $reference = $to ?? Carbon::now();
                $daysInMonth = $reference->daysInMonth;
                for ($d = 1; $d <= $daysInMonth; $d++) {
                    $chartdata['timeline'][] = $d;
                    $chartdata['total_booking'][] = $merged[$d] ?? 0;
                }
            }
        } else { // week -> show days 1..7
            for ($d = 1; $d <= 7; $d++) {
                $chartdata['timeline'][] = $d;
                $chartdata['total_booking'][] = $merged[$d] ?? 0;
            }
        }

        return view('service::admin.provider-management.provider.serviceman.details', compact(
            'serviceman',
            'countData',
            'chartdata',
            'dateRange',
            'provider'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     * @param string $id
     * @return Application|Factory|View
     */
    public function edit($id, $serviceman_id): View|Factory|Application
    {
        $provider = $this->provider->find($id);
        $serviceman = $this->serviceman->find($serviceman_id);
        $language = getWebConfig('language');
        return view('service::admin.provider-management.provider.serviceman.edit', compact('serviceman', 'language', 'provider'));
    }


    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param string $id
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, $id, $serviceman_id): RedirectResponse
    {
        $serviceman = $this->serviceman->find($serviceman_id);
        if(empty($serviceman)) {
            Toastr::error(translate('Invalid Serviceman'));
            return redirect()->back()->withInput($request->all());
        }

        Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            // 'address' => 'required',
            // 'business_phone' => 'required',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif',
            // 'cover_photo' => 'nullable|image|mimes:jpeg,jpg,png,gif',
            // 'zone_id' => 'required',
            // 'latitude' => 'required',
            // 'longitude' => 'required',
            // 'minimum_service_time' => 'required|integer|min:0',
            // 'maximum_service_time' => 'required|integer|min:0',
            // 'service_time_type' => 'required|in:min,hours,days',
            // 'f_name' => 'required|string|max:191',
            // 'l_name' => 'required|string|max:191',
            'phone' => 'required',
            'email' => 'required|email',
            'password' => 'nullable|min:8|confirmed',

            'identity_type' => 'required|in:passport,driving_license,nid,trade_license,company_id',
            'identity_number' => 'required',
            'identity_images' => 'nullable|array',
            'identity_images.*' => 'image|mimes:jpeg,jpg,png,gif',
        ])->validate();

        if (Serviceman::where('email', $request['email'])->where('id', '!=', $serviceman->id)->first()) {
            Toastr::error(translate('Email already taken'));
            return back();
        }
        if (Serviceman::where('phone', $request['phone'])->where('id', '!=', $serviceman->id)->first()) {
            Toastr::error(translate('Phone already taken'));
            return back();
        }

        $identityImages = [];
        if (!is_null($request->identity_images)) {
            foreach ($request->identity_images as $image) {
                $imageName = file_uploader('provider/identity/', 'png', $image);
                $identityImages[] = ['image'=>$imageName, 'storage'=> getDisk()];
            }
        } else {
            if(is_array($serviceman->identification_image)) {
                $identityImages = $serviceman->identification_image;
            } else {
                $identityImages = json_decode($serviceman->identification_image ?? "");
            }
        }

        $serviceman->module_id = $this->currentModuleId();
        $serviceman->service_provider_id = $id;
        $serviceman->first_name = $request->first_name;
        $serviceman->last_name = $request->last_name;
        $serviceman->phone = $request->phone;
        $serviceman->email = $request->email;
        if($request->has('password') && !empty($request->password)) {
            $serviceman->password = bcrypt($request->password);
        }
        $serviceman->identification_type = $request->identity_type;
        $serviceman->identification_number = $request->identity_number;
        $serviceman->identification_image = json_encode($identityImages);

        if ($request->hasFile('image')) {
            $serviceman->profile_image = file_uploader('provider/serviceman/', 'png', $request->file('image'));
        }

        $serviceman->is_approved = 1; // auto approved
        $serviceman->save();

        Toastr::success(translate(PROVIDER_STORE_200['message']));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function destroy(Request $request, $id, $serviceman_id): RedirectResponse
    {
        $serviceman = $this->serviceman->where('id', $serviceman_id)->delete();

        Toastr::success(translate(DEFAULT_DELETE_200['message']));
        return redirect()->route('admin.service.provider.details', ['id'=>$id, 'tab'=> 'serviceman_list']);
    }

    /**
     * Remove the specified resource from storage.
     * @param $id
     * @return RedirectResponse
     */
    public function statusUpdate($id, $serviceman_id): RedirectResponse
    {
        $serviceman = $this->serviceman->where('id', $serviceman_id)->first();
        $this->serviceman->where('id', $serviceman_id)->update(['is_active' => !$serviceman->is_active]);

        if ($serviceman->is_active == 1) {
            $serviceman->auth_token = null;
            $serviceman->save();
        }

        Toastr::success(translate(DEFAULT_STATUS_UPDATE_200['message']));
        return redirect()->back();
    }

}
