<?php

namespace Modules\Service\Http\Controllers\Web\Admin;

use App\CentralLogics\Helpers;
use App\Models\User;
use App\Models\UserAccount;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Modules\Service\Entities\BookingModule\Booking;
use Modules\Service\Entities\BookingModule\BookingDetailsAmount;
use Modules\Service\Entities\ProviderManagement\Provider;
use Modules\Service\Entities\ServiceManagement\Service;
use Modules\Service\Entities\TransactionModule\Transaction;

class DashboardController extends Controller
{
    protected Transaction $transaction;
    protected Provider $provider;
    protected UserAccount $account;
    protected Service $service;
    protected User $user;
    protected BookingDetailsAmount $booking_details_amount;
    protected Booking $booking;

    public function __construct(
        Transaction $transaction,
        Provider $provider,
        UserAccount $account,
        Service $service,
        User $user,
        BookingDetailsAmount $booking_details_amount,
        Booking $booking
    ) {
        $this->transaction = $transaction;
        $this->provider = $provider;
        $this->account = $account;
        $this->service = $service;
        $this->user = $user;
        $this->booking_details_amount = $booking_details_amount;
        $this->booking = $booking;
    }

    /**
     * @param Request $request
     * @return Application|Factory|View|RedirectResponse|JsonResponse
     */
    public function dashboard(Request $request, Transaction $transaction): Application|Factory|View|RedirectResponse|JsonResponse
    {

        $module_type = Config::get('module.current_module_type');
        if ($module_type == 'settings') {
            return redirect()->route('admin.business-settings.business-setup');
        }

        $baseQuery = BookingDetailsAmount::whereHas('booking', function ($query) use ($request) {
            $query->ofBookingStatus('completed');
        })
        ->orWhereHas('repeat', function ($subQuery) {
            $subQuery->ofBookingStatus('completed');
        });
        //->sum('admin_commission');
        $admin_commission = $baseQuery->sum('admin_commission');
        $discount_by_admin = $baseQuery->sum('discount_by_admin');
        $coupon_discount_by_admin = $baseQuery->sum('coupon_discount_by_admin');
        $campaign_discount_by_admin = $baseQuery->sum('campaign_discount_by_admin');

        $commission_earning = $admin_commission - $discount_by_admin - $coupon_discount_by_admin - $campaign_discount_by_admin;

        $fee_amounts = $this->transaction->where('trx_type', TRX_TYPE['received_extra_fee'])->sum('credit');
        $subscription_amounts = $this->transaction->whereIn('trx_type', ['subscription_purchase', 'subscription_renew', 'subscription_shift'])->sum('credit');

        $data = [];
        $data[] = ['top_cards' => [
            'total_commission_earning' => $commission_earning ?? 0,
            'total_fee_earning' => $fee_amounts ?? 0,
            'total_subscription_earning' => $subscription_amounts ?? 0,
            'total_system_earning' => $this->account->sum('received_balance') + $this->account->sum('total_withdrawn'),
            'total_customer' => $this->user->count(),
            'total_provider' => $this->provider->where(['is_approved' => 1])->count(),
            'total_services' => $this->service->count()
        ]];

        $total_earning = $this->booking_details_amount
            ->whereHas('booking', function ($query) use ($request) {
                $query->ofBookingStatus('completed');
            })->orWhereHas('repeat', function ($subQuery) {
                $subQuery->ofBookingStatus('completed');
            })->get()->sum('admin_commission');

        $data[] = ['admin_total_earning' => $total_earning];

        $recent_transactions = $this->transaction
            ->with(['booking'])
            ->whereMonth('created_at', now()->month)
            ->latest()
            ->get();
        $data[] = [
            'recent_transactions' => $recent_transactions,
            'this_month_trx_count' => $recent_transactions->count()
        ];

        $bookings = $this->booking->with(['detail.service' => function ($query) {
            $query->select('id', 'name', 'thumbnail');
        }])
            ->where('booking_status', 'pending')
            ->take(5)->latest()->get();
        $data[] = ['bookings' => $bookings];

        $top_providers = $this->provider
            ->withCount(['reviews'])
            ->with(['reviews'])
            ->ofApproval(1)
            ->take(5)
            ->orderBy('avg_rating', 'DESC')
            ->get();
        $data[] = ['top_providers' => $top_providers];

        $zone_wise_bookings = $this->booking
            ->with(['zone' => function ($query) {
                $query->withoutGlobalScope('translate');
            }])
            ->whereHas('zone', function ($query) {
                $query->active()->withoutGlobalScope('translate');
            })
            ->whereMonth('created_at', now()->month)
            ->select('zone_id', DB::raw('count(*) as total'))
            ->groupBy('zone_id')
            ->get();
        $data[] = ['zone_wise_bookings' => $zone_wise_bookings, 'total_count' => $this->booking->count()];

        $year = session()->has('dashboard_earning_graph_year') ? session('dashboard_earning_graph_year') : date('Y');
        $amounts = $this->booking_details_amount
            ->whereHas('booking', function ($query) use ($request, $year) {
                $query->whereYear('created_at', '=', $year)->ofBookingStatus('completed');
            })->orWhereHas('repeat', function ($subQuery) {
                $subQuery->ofBookingStatus('completed');
            })
            ->select(
                DB::raw('sum(admin_commission) as admin_commission'),

                DB::raw('MONTH(created_at) month')
            )
            ->groupby('month')->get()->toArray();

        $fee_amounts = $this->transaction
            ->whereIn('trx_type', [
                TRX_TYPE['received_extra_fee'],
                TRX_TYPE['subscription_purchase'],
                TRX_TYPE['subscription_renew'],
                TRX_TYPE['subscription_shift']
            ])
            ->select(
                DB::raw('sum(credit) as fee'),

                DB::raw('MONTH(created_at) month')
            )
            ->groupby('month')->get()->toArray();

        $all_earnings = [];
        if (empty($amounts) && !empty($fee_amounts)) {
            foreach ($fee_amounts as $key => $fee) {
                $all_earnings[$key] = $fee;
                if (!array_key_exists('fee', $all_earnings[$key])) {
                    $all_earnings[$key]['fee'] = 0;
                }
            }
        } else {
            foreach ($amounts as $amount) {
                foreach ($fee_amounts as $key => $fee) {
                    if ($amount['month'] == $fee['month']) {
                        $all_earnings[$key] = array_merge($amount, $fee);
                    }
                    if (!isset($all_earnings[$key])) {
                        $all_earnings[$key] = $amount;
                    }
                    if (!array_key_exists('fee', $all_earnings[$key])) {
                        $all_earnings[$key]['fee'] = 0;
                    }
                }
            }
        }

        $months = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
        foreach ($months as $month) {
            $found = 0;
            foreach ($all_earnings as $key => $item) {
                if (isset($item['month']) && $item['month'] == $month) {
                    $admin_commission = $item['admin_commission'] ?? 0;
                    $itemFee = $item['fee'] ?? 0;

                    $chart_data['total_earning'][] = with_decimal_point($admin_commission + $itemFee);
                    $chart_data['commission_earning'][] = with_decimal_point($admin_commission);
                    $found = 1;
                    break;
                }
            }
            if (!$found) {
                $chart_data['total_earning'][] = with_decimal_point(0);
                $chart_data['commission_earning'][] = with_decimal_point(0);
            }
        }


        return view("service::admin.dashboard-{$module_type}", compact('data', 'chart_data'));
    }


    public function updateDashboardEarningGraph(Request $request): JsonResponse
    {
        $year = $request['year'];
        $amounts = $this->booking_details_amount
            ->whereHas('booking', function ($query) use ($request, $year) {
                $query->whereYear('created_at', '=', $year)->ofBookingStatus('completed');
            })
            ->select(
                DB::raw('sum(admin_commission) as admin_commission'),

                DB::raw('MONTH(created_at) month')
            )
            ->groupby('month')->get()->toArray();

        $fee_amounts = $this->transaction
            ->whereYear('created_at', '=', $year)
            ->whereIn('trx_type', [
                TRX_TYPE['received_extra_fee'],
                TRX_TYPE['subscription_purchase'],
                TRX_TYPE['subscription_renew'],
                TRX_TYPE['subscription_shift']
            ])
            ->select(
                DB::raw('sum(credit) as fee'),

                DB::raw('MONTH(created_at) month')
            )
            ->groupby('month')->get()->toArray();

        $all_earnings = [];
        foreach ($amounts as $amount) {
            foreach ($fee_amounts as $key=>$fee) {
                if ($amount['month'] == $fee['month']) {
                    $all_earnings[$key] = array_merge($amount, $fee);
                }
                if (!isset($all_earnings[$key])) {
                    $all_earnings[$key] = $amount;
                }
                if (!array_key_exists('fee', $all_earnings[$key])) {
                    $all_earnings[$key]['fee'] = 0;
                }
            }
        }

        $months = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
        foreach ($months as $month) {
            $found = 0;
            foreach ($all_earnings as $key => $item) {
                if ($item['month'] == $month) {
                    $chart_data['total_earning'][] = with_decimal_point($item['admin_commission']+$item['fee']);
                    $chart_data['commission_earning'][] = with_decimal_point($item['admin_commission']);
                    $found = 1;
                }
            }
            if (!$found) {
                $chart_data['total_earning'][] = with_decimal_point(0);
                $chart_data['commission_earning'][] = with_decimal_point(0);
            }
        }

        $chart_data['total_earning_sum'] = Helpers::format_currency(with_decimal_point(array_sum($chart_data['total_earning'])));
        $chart_data['commission_earning_sum'] = Helpers::format_currency(with_decimal_point(array_sum($chart_data['commission_earning'])));

        session()->put('dashboard_earning_graph_year', $request['year']);

        return response()->json($chart_data);
    }

}
