<?php

namespace Modules\Service\Http\Controllers\Web\Admin\Report;

use Auth;
use Box\Spout\Common\Exception\InvalidArgumentException;
use Box\Spout\Common\Exception\IOException;
use Box\Spout\Common\Exception\UnsupportedTypeException;
use Box\Spout\Writer\Exception\WriterNotOpenedException;
use Carbon\Carbon;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Rap2hpoutre\FastExcel\FastExcel;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Models\User;
use App\Models\UserAccount;
use App\Models\Zone;
use Modules\Service\Entities\BookingModule\Booking;
use Modules\Service\Entities\BookingModule\BookingDetailsAmount;
use Modules\Service\Entities\CategoryManagement\Category;
use Modules\Service\Entities\ProviderManagement\Provider;
use Modules\Service\Entities\ServiceManagement\Service;
use Modules\Service\Entities\TransactionModule\Transaction;
use function pagination_limit;
use function view;
use function with_currency_symbol;

class ProviderReportController extends Controller
{
    protected Zone $zone;
    protected Provider $provider;
    protected Category $categories;
    protected Booking $booking;

    protected UserAccount $account;
    protected Service $service;
    protected User $user;
    protected Transaction $transaction;
    private BookingDetailsAmount $booking_details_amount;

    public function __construct(Zone $zone, Provider $provider, Category $categories, Service $service, Booking $booking, UserAccount $account, User $user, Transaction $transaction, BookingDetailsAmount $booking_details_amount)
    {
        $this->zone = $zone;
        $this->provider = $provider;
        $this->categories = $categories;
        $this->booking = $booking;

        $this->service = $service;
        $this->account = $account;
        $this->user = $user;
        $this->transaction = $transaction;
        $this->booking_details_amount = $booking_details_amount;
    }


    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Renderable
     * @throws AuthorizationException
     */
    public function getProviderReport(Request $request): Renderable
    {
        Validator::make($request->all(), [
            'zone_ids' => 'array',
            'zone_ids.*' => 'integer',
            'provider_ids' => 'array',
            'provider_ids.*' => 'integer',
            'sub_category_ids' => 'array',
            'sub_category_ids.*' => 'integer',
            'date_range' => 'in:all_time, this_week, last_week, this_month, last_month, last_15_days, this_year, last_year, last_6_month, this_year_1st_quarter, this_year_2nd_quarter, this_year_3rd_quarter, this_year_4th_quarter, custom_date',
            'from' => $request['date_range'] == 'custom_date' ? 'required' : '',
            'to' => $request['date_range'] == 'custom_date' ? 'required' : '',
        ]);

        $search = $request['search'];

        $zones = $this->zone->select('id', 'name')->get();
        $providers = $this->provider->ofApproval(1)->select('id', 'company_name', 'company_phone')->get();
        $sub_categories = $this->categories->ofType('sub')->select('id', 'name')->get();


        $queryParams = $request->only('search', 'zone_ids', 'provider_ids', 'sub_category_ids', 'date_range');
        if ($request->date_range === 'custom_date') {
            $queryParams['from'] = $request->from;
            $queryParams['to'] = $request->to;
        }

        $filtered_providers = $this->provider->with(['account'])
            ->ofApproval(1)
            ->withCount(['reviews', 'subscribed_services', 'bookings', 'servicemen',])
            ->withCount(['bookings as incomplete_bookings_count' => function ($query) {
                $query->where('booking_status', 'canceled');
            }])
            ->with(['transactions_for_from_user' => function ($query) {
                $query->where('trx_type', 'received_commission');
            }])
            ->when($request->has('zone_ids'), function ($query) use ($request) {
                $query->whereIn('zone_id', $request['zone_ids']);
            })
            ->when($request->has('provider_ids'), function ($query) use ($request) {
                $query->whereIn('id', $request['provider_ids']);
            })
            ->when($request->has('sub_category_ids'), function ($query) use ($request) {
                $query->whereHas('subscribed_services.sub_category', function ($query) use ($request) {
                    $query->whereIn('id', $request['sub_category_ids']);
                });
            })
            ->when($request->has('date_range') && $request['date_range'] == 'custom_date', function ($query) use ($request) {
                $query->whereBetween('created_at', [Carbon::parse($request['from'])->startOfDay(), Carbon::parse($request['to'])->endOfDay()]);
            })
            ->when($request->has('date_range') && $request['date_range'] != 'custom_date', function ($query) use ($request) {
                if ($request['date_range'] == 'this_week') {
                    $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);

                } elseif ($request['date_range'] == 'last_week') {
                    $query->whereBetween('created_at', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()]);

                } elseif ($request['date_range'] == 'this_month') {
                    $query->whereMonth('created_at', Carbon::now()->month);

                } elseif ($request['date_range'] == 'last_month') {
                    $query->whereMonth('created_at', Carbon::now()->subMonth()->month);

                } elseif ($request['date_range'] == 'last_15_days') {
                    $query->whereBetween('created_at', [Carbon::now()->subDay(15), Carbon::now()]);

                } elseif ($request['date_range'] == 'this_year') {
                    $query->whereYear('created_at', Carbon::now()->year);

                } elseif ($request['date_range'] == 'last_year') {
                    $query->whereYear('created_at', Carbon::now()->subYear()->year);

                } elseif ($request['date_range'] == 'last_6_month') {
                    $query->whereBetween('created_at', [Carbon::now()->subMonth(6), Carbon::now()]);

                } elseif ($request['date_range'] == 'this_year_1st_quarter') {
                    $query->whereBetween('created_at', [Carbon::now()->month(1)->startOfQuarter(), Carbon::now()->month(1)->endOfQuarter()]);

                } elseif ($request['date_range'] == 'this_year_2nd_quarter') {
                    $query->whereBetween('created_at', [Carbon::now()->month(4)->startOfQuarter(), Carbon::now()->month(4)->endOfQuarter()]);

                } elseif ($request['date_range'] == 'this_year_3rd_quarter') {
                    $query->whereBetween('created_at', [Carbon::now()->month(7)->startOfQuarter(), Carbon::now()->month(7)->endOfQuarter()]);

                } elseif ($request['date_range'] == 'this_year_4th_quarter') {
                    $query->whereBetween('created_at', [Carbon::now()->month(10)->startOfQuarter(), Carbon::now()->month(10)->endOfQuarter()]);
                }
            })
            ->when($request->has('search'), function ($query) use ($request) {
                $keys = explode(' ', $request['search']);
                return $query->where(function ($query) use ($keys) {
                    foreach ($keys as $key) {
                        $query->orWhere('company_phone', 'LIKE', '%' . $key . '%')
                            ->orWhere('company_email', 'LIKE', '%' . $key . '%')
                            ->orWhere('company_name', 'LIKE', '%' . $key . '%');
                    }
                });
            })
            ->latest()->paginate(pagination_limit())->appends($queryParams);

        return view('service::admin.report.provider', compact('zones', 'providers', 'sub_categories', 'search', 'filtered_providers', 'queryParams'));
    }


    /**
     * @param Request $request
     * @return string|StreamedResponse
     * @throws \OpenSpout\Common\Exception\IOException
     * @throws \OpenSpout\Common\Exception\InvalidArgumentException
     * @throws \OpenSpout\Common\Exception\UnsupportedTypeException
     * @throws \OpenSpout\Writer\Exception\WriterNotOpenedException
     */
    public function getProviderReportDownload(Request $request): string|StreamedResponse
    {
        $search = $request['search'];

        $zones = $this->zone->select('id', 'name')->get();
        $providers = $this->provider->ofApproval(1)->select('id', 'company_name', 'company_phone')->get();
        $sub_categories = $this->categories->ofType('sub')->select('id', 'name')->get();


        $queryParams = $request->only('search', 'zone_ids', 'provider_ids', 'sub_category_ids', 'date_range');
        if ($request->date_range === 'custom_date') {
            $queryParams['from'] = $request->from;
            $queryParams['to'] = $request->to;
        }

        $filtered_providers = $this->provider->with(['account'])
            ->ofApproval(1)
            ->withCount(['reviews', 'subscribed_services', 'bookings', 'servicemen',])
            ->withCount(['bookings as incomplete_bookings_count' => function ($query) {
                $query->where('booking_status', 'canceled');
            }])
            ->with(['transactions_for_from_user' => function ($query) {
                $query->where('trx_type', 'received_commission');
            }])
            ->when($request->has('zone_ids'), function ($query) use ($request) {
                $query->whereIn('zone_id', $request['zone_ids']);
            })
            ->when($request->has('provider_ids'), function ($query) use ($request) {
                $query->whereIn('id', $request['provider_ids']);
            })
            ->when($request->has('sub_category_ids'), function ($query) use ($request) {
                $query->whereHas('subscribed_services.sub_category', function ($query) use ($request) {
                    $query->whereIn('id', $request['sub_category_ids']);
                });
            })
            ->when($request->has('date_range') && $request['date_range'] == 'custom_date', function ($query) use ($request) {
                $query->whereBetween('created_at', [Carbon::parse($request['from'])->startOfDay(), Carbon::parse($request['to'])->endOfDay()]);
            })
            ->when($request->has('date_range') && $request['date_range'] != 'custom_date', function ($query) use ($request) {
                if ($request['date_range'] == 'this_week') {
                    $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);

                } elseif ($request['date_range'] == 'last_week') {
                    $query->whereBetween('created_at', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()]);

                } elseif ($request['date_range'] == 'this_month') {
                    $query->whereMonth('created_at', Carbon::now()->month);

                } elseif ($request['date_range'] == 'last_month') {
                    $query->whereMonth('created_at', Carbon::now()->subMonth()->month);

                } elseif ($request['date_range'] == 'last_15_days') {
                    $query->whereBetween('created_at', [Carbon::now()->subDay(15), Carbon::now()]);

                } elseif ($request['date_range'] == 'this_year') {
                    $query->whereYear('created_at', Carbon::now()->year);

                } elseif ($request['date_range'] == 'last_year') {
                    $query->whereYear('created_at', Carbon::now()->subYear()->year);

                } elseif ($request['date_range'] == 'last_6_month') {
                    $query->whereBetween('created_at', [Carbon::now()->subMonth(6), Carbon::now()]);

                } elseif ($request['date_range'] == 'this_year_1st_quarter') {
                    $query->whereBetween('created_at', [Carbon::now()->month(1)->startOfQuarter(), Carbon::now()->month(1)->endOfQuarter()]);

                } elseif ($request['date_range'] == 'this_year_2nd_quarter') {
                    $query->whereBetween('created_at', [Carbon::now()->month(4)->startOfQuarter(), Carbon::now()->month(4)->endOfQuarter()]);

                } elseif ($request['date_range'] == 'this_year_3rd_quarter') {
                    $query->whereBetween('created_at', [Carbon::now()->month(7)->startOfQuarter(), Carbon::now()->month(7)->endOfQuarter()]);

                } elseif ($request['date_range'] == 'this_year_4th_quarter') {
                    $query->whereBetween('created_at', [Carbon::now()->month(10)->startOfQuarter(), Carbon::now()->month(10)->endOfQuarter()]);
                }
            })
            ->when($request->has('search'), function ($query) use ($request) {
                $keys = explode(' ', $request['search']);
                return $query->where(function ($query) use ($keys) {
                    foreach ($keys as $key) {
                        $query->orWhere('company_phone', 'LIKE', '%' . $key . '%')
                            ->orWhere('company_email', 'LIKE', '%' . $key . '%')
                            ->orWhere('company_name', 'LIKE', '%' . $key . '%');
                    }
                });
            })
            ->latest()->get();

        return (new FastExcel($filtered_providers))->download(time() . '-provider-report.xlsx', function ($provider) {
            return [
                'Company Name' => $provider->company_name,
                'Company Phone' => $provider->company_phone,
                'Company Mail' => $provider->company_email,
                'Company Address' => $provider->company_address,
                'Total Bookings' => $provider->bookings_count,
                'Subscribed Services Count' => $provider->subscribed_services_count,
                'Total Servicemen' => $provider->servicemen_count,
                'Completion Rate' => (100 - ($provider->bookings_count * $provider->incomplete_bookings_count) / 100) . '%',
                'Total Earning' => \App\CentralLogics\Helpers::format_currency($provider?->account?->received_balance ?? 0),
            ];
        });
    }

}
