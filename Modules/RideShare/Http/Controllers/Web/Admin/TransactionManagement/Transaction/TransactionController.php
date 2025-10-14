<?php

namespace Modules\RideShare\Http\Controllers\Web\Admin\TransactionManagement\Transaction;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Modules\RideShare\Entities\TripManagement\RideRequestFee;
use Modules\RideShare\Http\Controllers\BaseController;
use Modules\RideShare\Interface\TransactionManagement\Service\TransactionServiceInterface;
use Modules\RideShare\Interface\TripManagement\Service\TripRequestServiceInterface;
use Modules\RideShare\Interface\UserManagement\Service\CustomerServiceInterface;
use Modules\RideShare\Interface\UserManagement\Service\DriverServiceInterface;

class TransactionController extends BaseController
{

    protected $transactionService;
    protected $tripRequestService;
    protected $customerService;
    protected $driverService;

    public function __construct(
        TripRequestServiceInterface     $tripRequestService, 
        CustomerServiceInterface        $customerService,
        DriverServiceInterface          $driverService,
        TransactionServiceInterface     $transactionService
        )
    {
        parent::__construct($transactionService);
        $this->transactionService = $transactionService;
        $this->tripRequestService = $tripRequestService;
        $this->customerService = $customerService;
        $this->driverService = $driverService;
    }

    public function index(?Request $request)
    {
        /* $transactions = $this->transactionService->index(criteria: $request?->all(), orderBy : ['created_at' => 'desc'], limit: paginationLimit(), offset:$request['page']??1);
        return view('ride-share::admin.transaction.index', compact('transactions')); */
        $attributes = [];
        $search = null;
        $date = null;
        $type = 'all';
        if ($type != 'all') {
            $attributes['current_status'] = $type;
        }

        if ($request->has('data')) {
            $date = getDateRange($request->data);
            $attributes['from'] = $date['start'];
            $attributes['to'] = $date['end'];
        }

        $request->has('search') ? ($search = $attributes['search'] = $request->search) : null;

        //filter
        $customers = $this->customerService->getBy(criteria: ['status' => 1]);
        $drivers = $this->driverService->getBy(criteria: ['application_status' => 'approved', 'status' => 1]);


        #customer filter
        if ($request->has('customer_id')) {
            if ($request->customer_id && $request->customer_id != ALL) {
                $attributes['customer_id'] = $request->customer_id;
            }
        }
        #driver filter
        if ($request->has('driver_id')) {
            if ($request->driver_id && $request->driver_id != ALL) {
                $attributes['driver_id'] = $request->driver_id;
            }
        }

        if (!is_null($request->filter_date) && $request->filter_date != 'custom_date') {
            $attributes['filter_date'] = getDateRange($request->filter_date);
        } elseif (!is_null($request->filter_date)) {
            $attributes['filter_date'] = getDateRange([
                'start' => $request->start_date,
                'end' => $request->end_date
            ]);
        }
        $dateRangeValue = $request->query('date_range');
        $trips = $this->tripRequestService->index(criteria: $attributes, relations: ['tripStatus', 'customer', 'driver', 'fee', 'safetyAlerts'], orderBy: ['created_at' => 'desc'], limit: paginationLimit(), offset: $request['page'] ?? 1, appends: $request->all());
        
        $stats_counts = [
            'total_paid_amount' => 0,
            'completed_transaction' => 0,
            'admin_earning' => 0,
            'driver_earning' => 0,
            'admin_expense' => 0,
        ];
        $stats_counts['total_paid_amount'] = $trips->where('current_status', 'completed')->sum(function ($trip) {
            return ($trip->paid_fare ?? 0);
        });
        $stats_counts['admin_expense'] = $trips->where('current_status', 'completed')->sum(function ($trip) {
            return ($trip->discount_amount ?? 0) + ($trip->coupon_amount ?? 0);
        });
        $stats_counts['completed_transaction'] = $stats_counts['total_paid_amount'];
        $tripIds = $trips->pluck('id')->toArray();
        $stats_counts['admin_earning'] = RideRequestFee::whereIn('ride_request_id', $tripIds)->sum('admin_commission');
        $stats_counts['driver_earning'] = $stats_counts['total_paid_amount'] + $stats_counts['admin_expense'] - $stats_counts['admin_earning'];
        return view('ride-share::admin.transaction.index', compact('trips', 'type', 'dateRangeValue','search', 'customers', 'drivers', 'stats_counts'));
    }

    public function export(Request $request)
    {
        $exportData = $this->transactionService->export(criteria: $request->all());
        return exportData($exportData, $request['file'],'');
    }
}
