@section('title', 'Transaction Report')

@extends('layouts.admin.app')

@push('css_or_js')
<style>
    .__card-3 .subtitle {
        max-width: 180px;
    }
</style>
@endpush

@section('content')
    <div class="content container-fluid">
        {{-- @if($type == 'all')
            <div class="card mb-8">
                <div class="card-body">
                    <div class="mb-3 d-flex justify-content-between align-items-center gap-3 flex-wrap">
                        <h1 class="page-header-title mb-0">
                            <img width="24" src="{{asset('Modules/RideShare/public/assets/img/ride-share/car.png')}}" loading="eager" alt="">
                            <span>
                                {{ translate('messages.Transaction Report') }}
                            </span>
                        </h1>
                        <div class="min-w-176px">
                            @php($queryString = request()->getQueryString())
                            <select name="date_range" id="dateRange" class="js-select2-custom date-range-change"
                                    data-url="{{url()->full()}}">
                                <option value="{{ALL_TIME}}"
                                        {{$dateRangeValue == ALL_TIME || $dateRangeValue == null?'selected':''}} selected>{{translate(ALL_TIME)}}</option>
                                <option value="{{TODAY}}" {{$dateRangeValue == TODAY?'selected':''}}>{{translate(TODAY)}}</option>
                                <option value="{{THIS_WEEK}}" {{$dateRangeValue == THIS_WEEK?'selected':''}}>{{translate(THIS_WEEK)}}</option>
                                <option value="{{THIS_MONTH}}" {{$dateRangeValue == THIS_MONTH?'selected':''}}>{{translate(THIS_MONTH)}}</option>
                                <option value="{{THIS_YEAR}}" {{$dateRangeValue == THIS_YEAR?'selected':''}}>{{translate(THIS_YEAR)}}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        @endif --}}
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-header-title text--title">
                <span class="page-header-icon">
                    <img src="{{ asset('Modules/RideShare/public/assets/img/ride-share/bill.svg') }}" class="svg" alt="">
                </span>
                <span>
                    {{ translate('messages.transaction_report') }}
                </span>
            </h1>
        </div>
        <!-- End Page Header -->
		<div class="card mb-20">
			<div class="card-body">
				<h4 class="">{{ translate('Search Data') }}</h4>
				<form action="" method="get">
					<div class="row g-3">
						<div class="col-sm-6 col-md-4">
							<select name="driver_id" class="form-control js-select2-custom ">
								<option
                                value="{{ALL}}" {{request() && request()->input('driver_id') == ALL ? "selected" : ""}}>
                                {{translate("All Drivers")}}
                            </option>
                            @foreach($drivers as $driver)
                                <option
                                    value="{{$driver->id}}" {{request() && request()->input('driver_id') == $driver->id ? "selected" : ""}}>{{ $driver->f_name . ' '. $driver->l_name}}</option>
                            @endforeach
							</select>
						</div>
						<div class="col-sm-6 col-md-4">
							<select name="customer_id" class="form-control js-select2-custom ">
								<option
                                value="{{ALL}}" {{request() && request()->input('customer_id') == ALL ? "selected" : ""}}>
                                {{translate("All Customers")}}
                            </option>
                            @foreach($customers as $customer)
                                <option
                                    value="{{$customer->id}}" {{request() && request()->input('customer_id') == $customer->id ? "selected" : ""}}>{{$customer->full_name ?? $customer->first_name . ' '. $customer->last_name}}</option>
                            @endforeach
							</select>
						</div>
						<div class="col-sm-6 col-md-4">
							<select class="form-control custom-select " name="filter_date">
								<option value="{{ALL_TIME}}" class="text-primary"
                                {{request() && request()->input('filter_date') == ALL_TIME ? "selected" : ""}}>{{translate(ALL_TIME)}}</option>
                            <option
                                value="{{TODAY}}" {{request() && request()->input('filter_date') == TODAY ? "selected" : ""}}>{{translate(TODAY)}}</option>
                            <option
                                value="{{THIS_WEEK}}" {{request() && request()->input('filter_date') == THIS_WEEK ? "selected" : ""}}>{{translate(THIS_WEEK)}}</option>
                            <option
                                value="{{THIS_MONTH}}" {{request() && request()->input('filter_date') == THIS_MONTH ? "selected" : ""}}>{{translate(THIS_MONTH)}}</option>
                            <option
                                value="{{THIS_YEAR}}" {{request() && request()->input('filter_date') == THIS_YEAR ? "selected" : ""}}>{{translate(THIS_YEAR)}}</option>
							</select>
						</div>
						@if (isset($filter) && $filter == 'custom')
						<div class="col-sm-6 col-md-4">

							<input type="date" name="from" id="from_date" class="form-control"
								placeholder="{{ translate('Start Date') }}"
								{{ session()->has('from_date') ? 'value=' . session('from_date') : '' }} required>

						</div>
						<div class="col-sm-6 col-md-4">
							<input type="date" name="to" id="to_date" class="form-control"
								placeholder="{{ translate('End Date') }}"
								{{ session()->has('to_date') ? 'value=' . session('to_date') : '' }} required>
						</div>
						@endif
						<div class="col-sm-6 col-md-4 ml-auto">
							<div class="d-flex justify-content-end">
								<button type="submit" class="btn btn-primary h--45px min-w-120">{{ translate('Filter') }}</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="mb-20">
            <div class="row g-3">
                <div class="col-lg-12">
                    <div class="row g-2">
                        <div class="col-sm-3">
                            <a class="__card-3 h-100" href="#">
                                <img src="{{ asset('/public/assets/admin/img/report/new/trx1.png') }}" class="icon"
                                    alt="report/new">
                                <h3 class="title text-008958">
                                    ${{ $stats_counts['completed_transaction'] }}
                                </h3>
                                <h6 class="subtitle max-w-fit-content">{{ translate('messages.Completed_Transaction') }}</h6>
                                <div class="info-icon" data-toggle="tooltip" data-placement="top"
                                    data-original-title="{{ translate('messages.After a successful trip completion, the full Trip amount goes to this section.') }}">
                                    <img src="{{ asset('/public/assets/admin/img/report/new/info1.png') }}"
                                        alt="report/new">
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-3">
                            <a class="__card-3 h-100" href="#">
                                <img src="{{ asset('/public/assets/admin/img/report/new/trx2.png') }}" class="icon"
                                    alt="report/new">
                                <h3 class="title text-006AE5" data-color="#006AB4">
                                    ${{ $stats_counts['admin_earning'] }}
                                </h3>
                                <h6 class="subtitle max-w-fit-content">{{ translate('messages.Admin_Earnings') }}</h6>
                                <div class="info-icon" data-toggle="tooltip" data-placement="top"
                                    data-original-title="{{ translate('messages.After a successful trip completion, the admin commission and service fee will be added to the admin\'s earnings.') }}">
                                    <img src="{{ asset('/public/assets/admin/img/report/new/info2.png') }}"
                                        alt="report/new">
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-3">
                            <a class="__card-3 h-100" href="#">
                                <img src="{{ asset('/public/assets/admin/img/report/new/trx3.png') }}" class="icon"
                                    alt="report/new">
                                <h3 class="title text-de3f3f" data-color="#de3f3f">
                                    ${{ $stats_counts['admin_expense'] }}
                                </h3>
                                <h6 class="subtitle max-w-fit-content">{{ translate('messages.Admin_Expenses') }}</h6>
                                <div class="info-icon" data-toggle="tooltip" data-placement="top"
                                    data-original-title="{{ translate('messages.After a successful trip completion, the discount and coupon amount will be added to the admin\'s expense.') }}">
                                    <img src="{{ asset('/public/assets/admin/img/report/new/info3.png') }}"
                                        alt="report/new">
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-3">
                            <a class="__card-3 h-100" href="#">
                                <img src="{{ asset('Modules/RideShare/public/assets/img/ride-share/trx4.png') }}" class="icon"
                                    alt="report/new">
                                <h3 class="title text-success" data-color="#107980">
                                    ${{ $stats_counts['driver_earning'] }}
                                </h3>
                                <h6 class="subtitle max-w-fit-content">{{ translate('messages.Driver_Earnings') }}</h6>
                                <div class="info-icon" data-toggle="tooltip" data-placement="top"
                                    data-original-title="{{ translate('messages.After a successful trip completion, the trip amount without discount will be added to the provider’s earnings') }}">
                                    <img src="{{ asset('Modules/RideShare/public/assets/img/ride-share/info4.png') }}"
                                        alt="report/new">
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		 <div class="card">
			<!-- Header -->
			<div class="card-header justify-content-between gap-3 py-2 flex-wrap">
				<div class="flex-grow-1">
					<h3 class="">
						{{ translate('messages.Transaction Report') }}
						<span class="badge badge-soft-dark ml-2" id="">{{ $trips->total() }}</span>
					</h3>
				</div>
				<div class="search--button-wrapper justify-content-end gap-20px">
					<form action="" method="get" class="search-form flex-grow-1 max-w-450px">
						<!-- Search -->
						<input type="hidden" value="{{request()?->status  }}" name="status">
						<div class="input-group input--group">
							<input id="datatableSearch_" type="search" value="{{ request()?->search ?? null }}" name="search"
								class="form-control" placeholder="{{ translate('search_by_ride_ID,_customer_or_vendor_name') }}"
								aria-label="{{ translate('messages.search_by_ride_ID,_customer_or_vendor_name') }}">
							<button type="submit" class="btn btn--secondary bg--primary"><i class="tio-search"></i></button>
						</div>
						<!-- End Search -->
					</form>
					<!-- Unfold -->
					<div class="hs-unfold m-0">
						<a class="js-hs-unfold-invoker btn btn-sm btn-white dropdown-toggle min-height-40 font-semibold rounded border text--title"
							href="javascript:;" data-hs-unfold-options='{
									"target": "#usersExportDropdown",
									"type": "css-animation"
								}'>
							<i class="tio-download-to mr-1"></i> {{ translate('messages.export') }}
						</a>

						<div id="usersExportDropdown"
							class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right">

							<span class="dropdown-header">{{ translate('messages.download_options') }}</span>
							<a id="export-excel" class="dropdown-item"
								href="{{route('admin.transactions.ride-share.transaction.export', ['file' => 'excel', request()->getQueryString()])}}">
								<img class="avatar avatar-xss avatar-4by3 mr-2"
									src="{{ asset('public/assets/admin') }}/svg/components/excel.svg" alt="Image Description">
								{{ translate('messages.excel') }}
							</a>
							{{-- <a id="export-csv" class="dropdown-item"
								href="#">
								<img class="avatar avatar-xss avatar-4by3 mr-2"
									src="{{ asset('public/assets/admin') }}/svg/components/placeholder-csv-format.svg"
									alt="Image Description">
								.{{ translate('messages.csv') }}
							</a> --}}

						</div>
					</div>
					<!-- End Unfold -->
					<div class="hs-unfold mr-2">
						{{-- <button type="button" class="js-hs-unfold-invoker btn btn-sm shadow-none p-0 font-semibold rounded text--title filter-button-show">
							<i class="tio-filter-list mr-1"></i> {{ translate('messages.filter') }} <span
								class="badge badge-success badge-pill ml-1" id="filter_count"></span>
						</button> --}}
					</div>
					{{-- <div class="hs-unfold">
						<a class="js-hs-unfold-invoker btn btn-sm shadow-none p-0 font-semibold rounded text--title" href="javascript:;">
							<i class="fi fi-rr-columns-3 mr-1"></i> {{ translate('messages.columns') }} <span
								class="badge badge-success badge-pill ml-1" id="filter_count"></span>
						</a>
					</div> --}}
				</div>
			</div>
			<!-- End Header -->

			<!-- Table -->
			<div class="table-responsive datatable-custom">
				<table id="columnSearchDatatable"
					class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
					data-hs-datatables-options='{
									"order": [],
									"orderCellsTop": true,
									"paging":false

							}'>
					<thead class="thead-light">
						<tr>
							<th class="border-0">{{ translate('messages.SL') }}</th>
							<th class="border-0">{{ translate('messages.Ride_ID') }}</th>
							<th class="border-0">{{ translate('messages.Date_&_Time') }}</th>
							<th class="border-0">{{ translate('messages.Customer') }}</th>
							<th class="border-0">{{ translate('messages.Driver') }}</th>
							<th class="border-0">{{ translate('messages.Ride_Category') }}</th>
							<th class="border-0 text-right">{{ translate('messages.Ride_cost') }} ($)</th>
							<th class="border-0  text-right">{{ translate('messages.Coupon_Discount') }} ($)</th>
							<th class="border-0  text-right">{{ translate('messages.Discount') }} ($)</th>
							<th class="border-0 text-right">{{ translate('messages.Additional_Fee') }} ($)</th>
							<th class="border-0 text-right">{{ translate('messages.Admin_Earning') }} ($)</th>
							<th class="border-0 text-right">{{ translate('messages.Admin_Expense') }} ($)</th>
							<th class="border-0 text-right">{{ translate('messages.Driver_Earning') }} ($)</th>
							<th class="border-0 text-right">{{ translate('messages.Total_Ride_cost') }} ($)</th>
							<th class="text-center border-0">{{ translate('messages.Ride_Status') }}</th>
							{{-- <th class="text-center border-0">{{ translate('messages.Action') }}</th> --}}
						</tr>
					</thead>

					<tbody id="set-rows">
                        @forelse($trips as $key => $trip)
                            <tr>
                                <td>{{$trips->firstItem() + $key}}</td>
                                <td>
                                    <a href="{{ route('admin.ride-share.ride.show', ['id' => $trip->id, 'module_id' => $trip->module_id]) }}" class="text--title font-medium">{{$trip->ref_id}}</a>
                                </td>
                                <td>
                                    <div class="text--title">
                                        {{date('d F Y', strtotime($trip->created_at))}}, {{date('h:i a', strtotime($trip->created_at))}}
                                    </div>
                                </td>
                                <td>
                                    <div class="text--title font-medium">
                                        <a href="{{route('admin.users.customer.ride-share.view', ['user_id' => $trip->customer_id])}}" class="text--title">
                                            {{ $trip->customer->full_name }}
                                            @if($trip?->customerSafetyAlert)
                                                <span class="text-danger cursor-pointer" data-toggle="tooltip" data-placement="bottom" title="Customer doing unusual behavior">
                                                    <img width="16" height="16" class="svg w-16px h-16px" src="{{ asset('Modules/RideShare/public/assets/img/ride-share/safety-alert-shield-icon-red.png') }}" alt="">
                                                </span>
                                            @endif
                                        </a>
                                        <div class="opacity-lg">
                                            {{ $trip->customer->email }}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="text--title font-medium">
                                        @if($trip->driver_id)
                                            <a href="{{ route("admin.users.delivery-man.preview", ['id' => $trip->driver_id, 'tab' => 'ride_list']) }}" class="text--title">
                                                {{ $trip->driver ? ($trip->driver?->f_name . ' ' . $trip->driver?->l_name) : translate('no_driver_assigned') }}
                                                @if($trip?->driverSafetyAlert)
                                                    <span class="text-danger cursor-pointer" data-toggle="tooltip" data-placement="bottom" title="Rider doing unusual behavior">
                                                        <img width="16" height="16" class="svg w-16px h-16px" src="{{ asset('Modules/RideShare/public/assets/img/ride-share/safety-alert-shield-icon-red.png') }}" alt="">
                                                    </span>
                                                @endif
                                            </a>
                                        @else
                                            <span class="text--title">{{ translate('no_driver_assigned') }}</span>
                                        @endif
                                        <div class="opacity-lg">
                                            {{ $trip->driver?->email }}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="text--title font-medium">
                                        {{ $trip->vehicleCategory->name }}
                                    </div>
                                </td>
                                <td>
                                    <div class="text--title font-medium text-right">
                                        {{ getCurrencyFormat($trip->actual_fare) }}
                                    </div>
                                </td>
                                <td>
                                    <div class="text--title font-medium text-right">
                                        {{ getCurrencyFormat($trip->coupon_amount + 0)}}
                                    </div>
                                </td>
                                <td>
                                    <div class="text--title font-medium text-right">
                                        {{ getCurrencyFormat($trip->discount_amount + 0)}}
                                    </div>
                                </td>

                                <td>
                                    <div class="text--title text-right">
                                        <table>
                                            <tr>
                                                <td class="py-0"><span class="w-100px d-inline-flex mr-2">{{ translate('Delay fee') }}</span> :</td>
                                                <td class="py-0 pr-0"> {{getCurrencyFormat($trip->fee?->delay_fee)}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-0"><span class="w-100px d-inline-flex mr-2">{{ translate('Idle fee') }}</span> :</td>
                                                <td class="py-0 pr-0"> {{getCurrencyFormat($trip->fee?->idle_fee)}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-0"><span class="w-100px d-inline-flex mr-2">{{ translate('Cancellation fee') }}</span> :</td>
                                                <td class="py-0 pr-0"> {{getCurrencyFormat($trip->fee?->cancellation_fee)}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-0"><span class="w-100px d-inline-flex mr-2">{{ translate('Vat/Tax') }}</span> :</td>
                                                <td class="py-0 pr-0"> {{getCurrencyFormat($trip->fee?->vat_tax)}}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                                <td>
                                    <div class="text--title font-medium text-right">
                                         {{getCurrencyFormat($trip->fee?->admin_commission)}}
                                    </div>
                                </td>
                                <td>
                                    <div class="text--title font-medium text-right">
                                         {{getCurrencyFormat($trip->coupon_amount + $trip->discount_amount)}}
                                    </div>
                                </td>
                                <td>
                                    <div class="text--title font-medium text-right">
                                         {{getCurrencyFormat($trip->paid_fare + $trip->coupon_amount + $trip->discount_amount - $trip->fee?->admin_commission)}}
                                    </div>
                                </td>
                                <td>
                                    <div class="font-medium text-right">
                                        <div class="text--title">
                                             {{ getCurrencyFormat($trip->paid_fare) }}
                                        </div>
                                        <div class="text--{{ $trip->payment_status == PAID? 'success' : 'danger' }}">
                                            {{translate($trip->payment_status)}}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($trip->current_status == PENDING)
                                        <div class="badge badge--pending bg-opacity-10" data-color="#006AB4" data-bg-color="#00E0FF">
                                            {{translate($trip->current_status)}}
                                        </div>
                                    @elseif($trip->current_status == CANCELLED)
                                        <div class="badge badge--pending bg-opacity-10" data-color="#FF5A54" data-bg-color="#FFE5E5">
                                            {{translate($trip->current_status)}}
                                        </div>
                                    @elseif($trip->current_status == ONGOING)
                                        <div class="badge badge--pending bg-opacity-10" data-color="#E19500" data-bg-color="#FFFCDE">
                                            {{translate($trip->current_status)}}
                                        </div>
                                    @elseif($trip->current_status == COMPLETED)
                                        <div class="badge badge--pending bg-opacity-10" data-color="#008958" data-bg-color="#DEFFF3">
                                            {{translate($trip->current_status)}}
                                        </div>
                                    @else
                                        <div class="badge badge--pending bg-opacity-10" data-color="#006AB4" data-bg-color="#00E0FF">
                                            {{translate($trip->current_status)}}
                                        </div>
                                    @endif
                                </td>
                                {{-- <td>
                                    <div class="btn--container justify-content-center">
                                        <a class="btn action-btn btn-primary-dark btn-outline-primary lh-1"
                                        href="{{ route('admin.ride-share.ride.show', $trip->id) }}" title="View">
                                            <i class="fi fi-sr-eye"></i>
                                        </a>
                                    </div>
                                </td> --}}
                            </tr>
                        @empty
                            <tr>
                                <td colspan="13">
                                    <div class="text-center p-4">
                                        <div class="empty--data">
                                            <img src="{{asset('/public/assets/admin/svg/illustrations/sorry.svg')}}" alt="public">
                                            <h5>
                                                {{translate('no_ride_found')}}
                                            </h5>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
					</tbody>
				</table>

			</div>
			<!-- End Table -->
            {{ $trips->links() }}
		</div>
	</div>


    {{-- <div id="datatableFilterSidebar" class="hs-unfold-content_ sidebar sidebar-bordered sidebar-box-shadow initial-hidden">
        <div class="card card-lg sidebar-card sidebar-footer-fixed">
            <div class="card-header">
                <h4 class="card-header-title">{{translate('messages.ride_list_filter')}}</h4>

                <!-- Toggle Button -->
                <a class="js-hs-unfold-invoker_ btn btn-icon btn-sm btn-ghost-dark ml-2 filter-button-hide" href="javascript:;">
                    <i class="tio-clear tio-lg"></i>
                </a>
                <!-- End Toggle Button -->
            </div>

            <!-- Body -->
            <form class="card-body sidebar-body sidebar-scrollbar" action="" method="GET" id="order_filter_form">
                <div class="mb-4">
                        <label class="mb-2">
                            {{translate("Select Customer")}}
                        </label>
                        <select class="js-select-offcanvas" name="customer_id">
                            <option
                                value="{{ALL}}" {{request() && request()->input('customer_id') == ALL ? "selected" : ""}}>
                                {{translate("All Customers")}}
                            </option>
                            @foreach($customers as $customer)
                                <option
                                    value="{{$customer->id}}" {{request() && request()->input('customer_id') == $customer->id ? "selected" : ""}}>{{$customer->full_name ?? $customer->first_name . ' '. $customer->last_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="mb-2">
                            {{translate("Select Driver")}}
                        </label>
                        <select class="js-select-offcanvas" name="driver_id">
                            <option
                                value="{{ALL}}" {{request() && request()->input('driver_id') == ALL ? "selected" : ""}}>
                                {{translate("All Drivers")}}
                            </option>
                            @foreach($drivers as $driver)
                                <option
                                    value="{{$driver->id}}" {{request() && request()->input('driver_id') == $driver->id ? "selected" : ""}}>{{ $driver->f_name . ' '. $driver->l_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    @if($type == 'all')
                        <div class="mb-4">
                            <label class="mb-2">
                                {{translate("Ride Status")}}
                            </label>
                            <select class="js-select-offcanvas" name="ride_status">
                                <option
                                    value="{{ALL}}" {{request() && request()->input('ride_status') == ALL ? "selected" : ""}}>
                                    {{translate("All Ride Status")}}
                                </option>
                                <option
                                    value="{{PENDING}}" {{request() && request()->input('ride_status') == PENDING ? "selected" : ""}}>{{translate(PENDING)}}</option>
                                <option
                                    value="{{ACCEPTED}}" {{request() && request()->input('ride_status') == ACCEPTED ? "selected" : ""}}>{{translate(ACCEPTED)}}</option>
                                <option
                                    value="{{ONGOING}}" {{request() && request()->input('ride_status') == ONGOING ? "selected" : ""}}>{{translate(ONGOING)}}</option>
                                <option
                                    value="{{COMPLETED}}" {{request() && request()->input('ride_status') == COMPLETED ? "selected" : ""}}>{{translate(COMPLETED)}}</option>
                                <option
                                    value="{{CANCELLED}}" {{request() && request()->input('ride_status') == CANCELLED ? "selected" : ""}}>{{translate(CANCELLED)}}</option>
                                <option
                                    value="{{RETURNING}}" {{request() && request()->input('ride_status') == RETURNING ? "selected" : ""}}>{{translate(RETURNING)}}</option>
                                <option
                                    value="{{RETURNED}}" {{request() && request()->input('ride_status') == RETURNED ? "selected" : ""}}>{{translate(RETURNED)}}</option>
                            </select>
                        </div>
                    @endif
                    <div class="mb-4">
                        <label class="mb-2">
                            {{ translate('Select Date') }}
                        </label>
                        <select class="js-select-offcanvas" name="filter_date" id="filterDate">
                            <option value="{{ALL_TIME}}" class="text-primary"
                                {{request() && request()->input('filter_date') == ALL_TIME ? "selected" : ""}}>{{translate(ALL_TIME)}}</option>
                            <option
                                value="{{TODAY}}" {{request() && request()->input('filter_date') == TODAY ? "selected" : ""}}>{{translate(TODAY)}}</option>
                            <option
                                value="{{THIS_WEEK}}" {{request() && request()->input('filter_date') == THIS_WEEK ? "selected" : ""}}>{{translate(THIS_WEEK)}}</option>
                            <option
                                value="{{THIS_MONTH}}" {{request() && request()->input('filter_date') == THIS_MONTH ? "selected" : ""}}>{{translate(THIS_MONTH)}}</option>
                            <option
                                value="{{THIS_YEAR}}" {{request() && request()->input('filter_date') == THIS_YEAR ? "selected" : ""}}>{{translate(THIS_YEAR)}}</option>
                            <option
                                value="{{CUSTOM_DATE}}" {{request() && request()->input('filter_date') == CUSTOM_DATE ? "selected" : ""}}>{{translate(CUSTOM_DATE)}}</option>
                        </select>
                    </div>
                    <div id="filterCustomDate" class="d-none">
                        <div class="row">
                            <div class="col-6">
                                <label class="mb-2">{{translate("Start date")}}</label>
                                <input type="date" value="{{request()->input('start_date')}}" id="start_date"
                                       name="start_date" class="form-control">
                            </div>
                            <div class="col-6">
                                <label class="mb-2">{{translate("End date")}}</label>
                                <input type="date" id="end_date" value="{{request()->input('end_date')}}"
                                       name="end_date" class="form-control">
                            </div>
                        </div>
                    </div>


                <!-- Footer -->
                <div class="card-footer sidebar-footer">
                    <div class="row gx-2">
                        <div class="col">
                            <button type="reset" class="btn btn-block btn-white" id="reset">{{ translate('Clear all filters') }}</button>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-block btn-primary">{{ translate('messages.save') }}</button>
                        </div>
                    </div>
                </div>
                <!-- End Footer -->
            </form>
        </div>
    </div> --}}
@endsection

@push('script_2')
<script>
    $(document).ready(function () {
        $('.js-select-offcanvas').select2({
            dropdownParent: $('#datatableFilterSidebar'),
        });
    })
    $('.filter-button-show').on('click', function(){
        $('#datatableFilterSidebar,.hs-unfold-overlay').show(500)
    });
    $('.filter-button-hide').on('click', function(){
        $('#datatableFilterSidebar,.hs-unfold-overlay').hide(500)
    });

    $('#reset').on('click', function(){
        location.href = window.location.pathname;
    });
</script>
@endpush
