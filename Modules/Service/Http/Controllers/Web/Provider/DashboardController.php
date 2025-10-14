<?php

namespace Modules\Service\Http\Controllers\Web\Provider;

use App\Models\UserAccount;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Modules\Service\Entities\BidModule\IgnoredPost;
use Modules\Service\Entities\BidModule\Post;
use Modules\Service\Entities\BookingModule\Booking;
use Modules\Service\Entities\BookingModule\BookingDetailsAmount;
use Modules\Service\Entities\ProviderManagement\Serviceman;
use Modules\Service\Entities\ProviderManagement\SubscribedService;
use Modules\Service\Entities\TransactionModule\Transaction;

class DashboardController extends Controller
{
    private UserAccount $account;
    private SubscribedService $subscribedService;
    private Serviceman $serviceman;
    private BookingDetailsAmount $booking_details_amount;
    private Booking $booking;
    private Transaction $transaction;
    private IgnoredPost $ignoredPost;
    private Post $post;

    public function __construct(
        UserAccount $account,
        SubscribedService $subscribedService,
        Serviceman $serviceman,
        BookingDetailsAmount $booking_details_amount,
        Booking $booking,
        Transaction $transaction,
        IgnoredPost $ignoredPost,
        Post $post
    )
    {
        $this->account = $account;
        $this->subscribedService = $subscribedService;
        $this->serviceman = $serviceman;
        $this->booking_details_amount = $booking_details_amount;
        $this->booking = $booking;
        $this->transaction = $transaction;
        $this->ignoredPost = $ignoredPost;
        $this->post = $post;
    }

    /**
     * @param Request $request
     */
    public function dashboard(Request $request)
    {
        $module_type = Config::get('module.current_module_type');
        if ($module_type == 'settings') {
            return redirect()->route('admin.business-settings.business-setup');
        }

        $provider = auth('provider')->user();

        $maxBookingAmount = (business_config('maximum_booking_amount'))->value;

        //top_cards
        $account = getUserAccount($provider?->id, PROVIDER);
        $data[] = ['top_cards' => [
            'total_earning' => $account['received_balance'] + $account['total_withdrawn'],
            'total_subscribed_services' => $this->subscribedService->where('provider_id', $provider?->id)
                ->with(['sub_category'])
                ->whereHas('category', function ($query) {
                    $query->where('is_active', 1);
                })->whereHas('sub_category', function ($query) {
                    $query->where('is_active', 1);
                })
                ->ofStatus(1)
                ->count(),
            'total_service_man' => $this->serviceman->where(['service_provider_id' => $provider?->id])->count(),
            'total_booking_served' => $provider?->bookings('completed')->count()
        ]];

        //provider total earning
        $totalEarning = $this->booking_details_amount
            ->whereHas('booking', function ($query) use ($provider) {
                $query->where('provider_id',  $provider?->id)
                    ->ofBookingStatus('completed');
            })
            ->get()->sum('provider_earning');

        $data[] = ['provider_total_earning' => $totalEarning];


        //booking_stats
        $bookingOverview = DB::table('service_bookings')->where('provider_id',  $provider?->id)
            ->select('booking_status', DB::raw('count(*) as total'))
            ->groupBy('booking_status')
            ->get();
        $totalBookings = $this->booking->where('provider_id',  $provider?->id)->count();
        $data[] = ['booking_stats' => $bookingOverview, 'total_bookings' => $totalBookings];


        //recent_bookings
        $subCategoryIds = $this->subscribedService->where('provider_id',  $provider?->id)->ofSubscription(1)->pluck('sub_category_id')->toArray();
        $recent_bookings = $this->booking->with(['detail.service' => function ($query) {
            $query->select('id', 'name', 'thumbnail');
        }])
            ->whereIn('sub_category_id', $subCategoryIds)
            ->when($maxBookingAmount > 0, function ($query) use ($maxBookingAmount, $provider) {
                if (!$provider?->is_suspended || !business_config('provider_suspend_on_exceed_cash_limit')->value) {
                    $query->where(function ($query) use ($maxBookingAmount) {
                        $query->where('payment_method', 'cash_after_service')
                            ->where(function ($query) use ($maxBookingAmount) {
                                $query->where('is_verified', 1)
                                    ->orWhere('total_booking_amount', '<=', $maxBookingAmount);
                            })
                            ->orWhere('payment_method', '<>', 'cash_after_service');
                    });
                } else {
                    $query->whereNull('id');
                }
            })
            ->where('booking_status', 'pending')
            ->where('zone_id', $provider?->zone_id)
            ->latest()
            ->take(5)
            ->get();
        $data[] = ['recent_bookings' => $recent_bookings];

        //my_subscriptions
        $subscriptions = $this->subscribedService
            ->with(['sub_category'])
            ->withCount(['services', 'completed_booking'])
            ->where(['provider_id' =>  $provider?->id])
            ->whereHas('category', function ($query) {
                $query->where('is_active', 1);
            })->whereHas('sub_category', function ($query) {
                $query->where('is_active', 1);
            })
            ->ofStatus(1)
            ->take(5)->get();

        $data[] = ['subscriptions' => $subscriptions];


        //serviceman_list
        $servicemanList = $this->serviceman
            ->where(['service_provider_id' =>  $provider?->id])
            ->latest()
            ->take(5)->get();

        $data[] = ['serviceman_list' => $servicemanList];

        //recent transactions
        $recentTransactions = $this->transaction
            ->where(['to_user_id' =>  $provider?->id])
            ->where('credit', '>', 0)
            ->with(['booking'])
            ->latest()
            ->take(5)
            ->get();
        $data[] = [
            'recent_transactions' => $recentTransactions,
            'this_month_trx_count' => $this->transaction->where(['to_user_id' =>  $provider?->id])
                ->where('credit', '>', 0)->whereMonth('created_at', date('m'))->count()
        ];

        //customize booking
        $subCategories = $this->subscribedService
            ->where(['provider_id' =>  $provider?->id])
            ->where(['is_subscribed' => 1])->pluck('sub_category_id')->toArray();

        $ignoredPosts = $this->ignoredPost->where('provider_id',  $provider?->id)->pluck('post_id')->toArray();
        $biddingPostValidity = (int)(business_config('post_validation_days'))->value;
        $posts = $this->post
            ->with(['addition_instructions', 'service', 'category', 'sub_category', 'booking', 'customer'])
            ->where('is_booked', 0)
            ->whereNotIn('id', $ignoredPosts)
            ->whereIn('sub_category_id', $subCategories)
            ->where('zone_id', $provider?->zone_id)
            ->whereBetween('created_at', [Carbon::now()->subDays($biddingPostValidity), Carbon::now()])
            ->when(true, function ($query) use ($provider) {
                if($provider?->service_availability && (!$provider?->is_suspended || !business_config('provider_suspend_on_exceed_cash_limit')->value)){
                    $query->whereDoesntHave('bids', function ($query) use ($provider) {
                        $query->where('provider_id',  $provider?->id);
                    });
                }else{
                    $query->whereNull('id');
                }
            })
            ->latest()
            ->take(5)->get();

        $data[] = ['customized_bookings' => $posts];


        // Data for chart
        $year = session()->has('dashboard_earning_graph_year') ? session('dashboard_earning_graph_year') : date('Y');
        $amounts = $this->booking_details_amount
            ->whereHas('booking', function ($query) use ($provider, $year) {
                $query->where('provider_id',  $provider?->id)
                    ->whereYear('created_at', '=', $year)
                    ->ofBookingStatus('completed');
            })
            ->select(
                DB::raw('sum(provider_earning) as provider_earning'),

                DB::raw('MONTH(created_at) month')
            )
            ->groupby('month')->get()->toArray();

        $months = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
        foreach ($months as $month) {
            $found = 0;
            foreach ($amounts as $key => $item) {
                if ($item['month'] == $month) {
                    $chart_data['total_earning'][] = with_decimal_point($item['provider_earning']);
                    $found = 1;
                }
            }
            if (!$found) {
                $chart_data['total_earning'][] = with_decimal_point(0);
            }
        }
        //chart data end

        $postCount = $this->post
            ->where('is_booked', 0)
            ->whereNotIn('id', $ignoredPosts)
            ->whereIn('sub_category_id', $subCategories)
            ->where('zone_id', $provider?->zone_id)
            ->whereBetween('created_at', [Carbon::now()->subDays($biddingPostValidity), Carbon::now()])
            ->when(true, function ($query) use ($provider) {
                if($provider?->service_availability && (!$provider?->is_suspended || !business_config('provider_suspend_on_exceed_cash_limit')->value)){
                    $query->whereDoesntHave('bids', function ($query) use ($provider) {
                        $query->where('provider_id',  $provider?->id);
                    });
                }else{
                    $query->whereNull('id');
                }
            })
            ->latest()->count();

        $pendingBookingCount = $this->booking->where('booking_status', 'pending')
            ->whereIn('sub_category_id', $subCategories)
            ->when($maxBookingAmount > 0, function ($query) use ($maxBookingAmount) {
                $query->where(function ($query) use ($maxBookingAmount) {
                    $query->where('payment_method', 'cash_after_service')
                        ->where(function ($query) use ($maxBookingAmount) {
                            $query->where('is_verified', 1)
                                ->orWhere('total_booking_amount', '<=', $maxBookingAmount);
                        })
                        ->orWhere('payment_method', '<>', 'cash_after_service');
                });
            })
            ->where('zone_id', $provider?->zone_id)
            ->count();

        $booking_counts = [
            'normal_booking_count' => $pendingBookingCount,
            'post_count' => $postCount,
        ];

        return view("service::provider.dashboard", compact('data', 'chart_data', 'booking_counts'));
    }


    public function updateDashboardEarningGraph(Request $request)
    {
        $provider = auth('provider')->user();

        $year = $request['year'];
        $amounts = $this->booking_details_amount
            ->whereHas('booking', function ($query) use ($year, $provider) {
                $query->where('provider_id',  $provider?->id)
                    ->whereYear('created_at', '=', $year)
                    ->ofBookingStatus('completed');
            })
            ->select(
                DB::raw('sum(provider_earning) as provider_earning'),

                DB::raw('MONTH(created_at) month')
            )
            ->groupby('month')->get()->toArray();

        $months = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
        foreach ($months as $month) {
            $found = 0;
            foreach ($amounts as $key => $item) {
                if ($item['month'] == $month) {
                    $chart_data['total_earning'][] = with_decimal_point($item['provider_earning']);
                    $found = 1;
                }
            }
            if (!$found) {
                $chart_data['total_earning'][] = with_decimal_point(0);
            }
        }
        //chart data end

        session()->put('dashboard_earning_graph_year', $request['year']);

        return response()->json($chart_data);
    }
}
