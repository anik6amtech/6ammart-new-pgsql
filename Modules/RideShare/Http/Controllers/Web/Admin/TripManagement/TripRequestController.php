<?php

namespace Modules\RideShare\Http\Controllers\Web\Admin\TripManagement;

use Modules\RideShare\Http\Controllers\BaseController;
use Carbon\Factory;
use Illuminate\Console\Application;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Brian2694\Toastr\Facades\Toastr;
use Modules\RideShare\Interface\TripManagement\Service\SafetyAlertServiceInterface;
use Modules\RideShare\Interface\TripManagement\Service\TripRequestServiceInterface;
use Modules\RideShare\Interface\UserManagement\Service\CustomerServiceInterface;
use Modules\RideShare\Interface\UserManagement\Service\DriverServiceInterface;
use Modules\RideShare\Repositories\TripManagement\TripRequestRepository;
use Modules\RideShare\Traits\PdfGenerator;

use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Modules\RideShare\Exports\TripRequestListExport;

class TripRequestController extends BaseController
{
    use PdfGenerator;
    protected $tripRequestService;
    protected $customerService;
    protected $driverService;
    protected $safetyAlertService;
    protected $trip;

    public function __construct(
        TripRequestServiceInterface $tripRequestService,
        CustomerServiceInterface $customerService,
        DriverServiceInterface      $driverService,
        SafetyAlertServiceInterface $safetyAlertService,
        TripRequestRepository $trip
    )
    {
        parent::__construct($tripRequestService);
        $this->tripRequestService = $tripRequestService;
        $this->customerService = $customerService;
        $this->driverService = $driverService;
        $this->safetyAlertService = $safetyAlertService;
        $this->trip = $trip;
    }

    public function tripList(?Request $request, $type = 'all')
    {
        $attributes = [];
        $search = null;
        $date = null;
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

        #trip type filter
        /* if ($request->has('ride_type')) {
            if ($request->ride_type && $request->ride_type != ALL) {
                $attributes['type'] = $request->ride_type;
            }
        } */

        #trip status filter
        if ($request->has('ride_status')) {
            if ($request->ride_status && $request->ride_status != ALL) {
                $attributes['current_status'] = $request->ride_status;
            }
        }

        #date filter
        if (!is_null($request->filter_date) && $request->filter_date != 'custom_date') {
            $attributes['filter_date'] = getDateRange($request->filter_date);
        } elseif (!is_null($request->filter_date)) {
            $attributes['filter_date'] = getDateRange([
                'start' => $request->start_date,
                'end' => $request->end_date
            ]);
        }
        $trips = $this->tripRequestService->index(criteria: $attributes, relations: ['tripStatus', 'customer', 'driver', 'fee', 'safetyAlerts'], orderBy: ['created_at' => 'desc'], limit: paginationLimit(), offset: $request['page'] ?? 1, appends: $request->all());
        $trip_counts = null;
        if ($type == 'all') {
            $trip_counts = $this->tripRequestService->statusWiseTotalTripRecords(['from' => $date['start'] ?? null, 'to' => $date['end'] ?? null]);
        }
        $dateRangeValue = $request->query('date_range');
        if ($request->ajax()) {
            return response()->json(view('ride-share::admin.trip-management.partials._trip-list-stat', compact('trip_counts', 'dateRangeValue'))->render());
        }
        return view('ride-share::admin.trip-management.index', compact('trips', 'type', 'dateRangeValue', 'trip_counts', 'search', 'customers', 'drivers'));
    }

    public function show($id, Request $request): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|RedirectResponse
    {
        $trip = $this->tripRequestService->findOne(id: $id, relations: ['customer', 'driver', 'tripStatus'], withTrashed: true);
        if (!$trip) {
            Toastr::error(TRIP_REQUEST_404['message']);
            return back();
        }
        $safetyAlerts = $this->safetyAlertService->getBy(criteria: ['ride_request_id' => $id], relations: ['sentBy', 'solvedBy', 'trip', 'lastLocation'], orderBy: ['created_at' => 'desc']);
        if ($request['page'] == 'log') {
            return view('ride-share::admin.trip-management.log', compact('trip'));
        }

        return view('ride-share::admin.trip-management.details', compact('trip', 'safetyAlerts'));
    }

    public function destroy($id)
    {
        $this->tripRequestService->delete($id);

        Toastr::success(TRIP_REQUEST_DELETE_200['message']);
        return back();
    }

    public function export(Request $request): BinaryFileResponse
    {
        $attributes = [];
        if ($request->has('data')) {
            $date = getDateRange($request->data);
            $attributes['from'] = $date['start'];
            $attributes['to'] = $date['end'];
        }
        if ($request->has('type')) {
            if ($request->type && $request->type != ALL) {
                $attributes['current_status'] = $request->type;
            }
        }
        $request->has('search') ? ($search = $attributes['search'] = $request->search) : null;

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

        #trip type filter
        if ($request->has('ride_type')) {
            if ($request->ride_type && $request->ride_type != ALL) {
                $attributes['type'] = $request->ride_type;
            }
        }

        #trip status filter
        if ($request->has('ride_status')) {
            if ($request->ride_status && $request->ride_status != ALL) {
                $attributes['current_status'] = $request->ride_status;
            }
        }

        #date filter
        if (!is_null($request->filter_date) && $request->filter_date != 'custom_date') {
            $attributes['filter_date'] = getDateRange($request->filter_date);
        } elseif (!is_null($request->filter_date)) {
            $attributes['filter_date'] = getDateRange([
                'start' => $request->start_date,
                'end' => $request->end_date
            ]);
        }

        $trips = $this->tripRequestService->index(criteria: $attributes, relations: ['tripStatus', 'customer', 'driver', 'fee'], orderBy: ['created_at' => 'desc'], appends: $request->all());

        $data = [
            'trips' => $trips,
            'search' => $request->search ?? null,
            'type' => $request->type ?? translate('all'),
            'date_range' => $request->data ?? translate('N/A'),
        ];

        if ($request['file'] == 'excel') {
            return Excel::download(new TripRequestListExport($data), 'Rides.xlsx');
        }
        return Excel::download(new TripRequestListExport($data), 'Rides.csv');
    }


    /**
     * @param Request $request
     * @param $id
     * @return Application|Factory|View|Response|string|StreamedResponse
     * @throws AuthorizationException
     */
    public function invoice(Request $request, $id)
    {
        $type = $request->get('file', 'pdf');
        $data = $this->trip->getBy(column: 'id', value: $id, attributes: ['relations' => ['tripStatus', 'coordinate', 'customer']]);
        if ($type != 'pdf'){
            return exportData($data, $type, 'ride-share::admin.trip-management.invoice');
        }else{
            $mpdf_view = \Illuminate\Support\Facades\View::make('ride-share::admin.trip-management.invoice',
                compact('data')
            );
            $this->generatePdf(view: $mpdf_view, filePrefix: 'trip_invoice_',filePostfix: $data->ref_id.time());
        }
        // return view('tripmanagement::admin.trip.invoice', compact('data'));
    }

    /**
     * @param Request $request
     * @return View
     */
    public function trashed(Request $request): View
    {
        $search = $request->has('search') ? $request->search : null;
        $trips = $this->trip->trashed(['search' => $search]);

        return view('ride-share::admin.trip-management.trashed', compact('trips', 'search'));

    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function restore($id): RedirectResponse
    {
        $this->trip->restore($id);

        Toastr::success(DEFAULT_RESTORE_200['message']);
        return redirect()->route('admin.ride-share.ride.index', ['all']);

    }

}
