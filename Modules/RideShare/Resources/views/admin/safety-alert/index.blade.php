@section('title', 'Solved Alert List')

@extends('layouts.admin.app')

@push('css_or_js')
@endpush

@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <h1 class="page-header-title">
                <span class="page-header-icon">
                    <img src="{{ asset('Modules/RideShare/public/assets/img/ride-share/safety-alert-shield-icon-red.png') }}" class="w--26" alt="">
                </span>
                <span>
                    {{ translate('messages.Solved Alert List') }}
                </span>
            </h1>
        </div>

        @include('ride-share::admin.safety-alert.partials._safety_alert_header')

		 <div class="card">
			<!-- Header -->
			<div class="card-header justify-content-between gap-3 py-2 flex-wrap">
				<div class="flex-grow-1">
					<h3 class="">
						{{ translate('messages.Solved Alert List') }}
						<span class="badge badge-soft-dark ml-2" id="">{{ $safetyAlerts->total() }}</span>
					</h3>
				</div>
				<div class="search--button-wrapper justify-content-end gap-20px">
					<form action="" method="get" class="search-form flex-grow-1 max-w-450px">
						<!-- Search -->
						<div class="input-group input--group">
							<input id="datatableSearch_" type="search" value="{{ request()?->search ?? null }}" name="search"
								class="form-control" placeholder="{{ translate('Search here by safety alert id') }}"
								aria-label="{{ translate('messages.search_by_ride_ID,_customer_or_vendor_name') }}">
							<button type="submit" class="btn btn--secondary bg--primary"><i class="tio-search"></i></button>
						</div>
						<!-- End Search -->
					</form>
				</div>
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
								href="{{route('admin.ride-share.safety-alert.export', $type)}}?search={{request()->get('search')}}&&file=excel">
								<img class="avatar avatar-xss avatar-4by3 mr-2"
									src="{{ asset('public/assets/admin') }}/svg/components/excel.svg" alt="Image Description">
								{{ translate('messages.excel') }}
							</a>
							{{-- <a id="export-csv" class="dropdown-item"
								href="{{ route('admin.rental.trip.export', ['type' => 'csv', request()->getQueryString()]) }}">
								<img class="avatar avatar-xss avatar-4by3 mr-2"
									src="{{ asset('public/assets/admin') }}/svg/components/placeholder-csv-format.svg"
									alt="Image Description">
								.{{ translate('messages.csv') }}
							</a> --}}

						</div>
					</div>
					<!-- End Unfold -->
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
							<th class="border-0">{{ translate('messages.Alert_Location') }}</th>
							<th class="border-0 text-right">{{ translate('messages.Resolved_Location') }}</th>
							<th class="border-0  text-right">{{ translate('messages.No Of Alerts') }}</th>
							<th class="border-0 text-right">{{ translate('messages.Solved By') }}</th>
							<th class="border-0 text-right">{{ translate('messages.Trip Status When Make Alert') }}</th>
						</tr>
					</thead>

					<tbody id="set-rows">
                        @forelse($safetyAlerts as $key => $safetyAlert)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $safetyAlert->ride_request_id }}</td>
                                <td>{{ date('d M Y h:i A', strtotime($safetyAlert->created_at)) }}</td>
                                <td>
                                    {{ $safetyAlert->trip?->customer?->f_name. ' ' . $safetyAlert->trip?->customer?->l_name }}
                                </td>
                                <td>
                                    {{ $safetyAlert->trip?->driver?->f_name. ' ' . $safetyAlert->trip?->driver?->l_name }}
                                </td>
                                <td>{{ $safetyAlert->alert_location }}</td>
                                <td class="text-right">{{ $safetyAlert->resolved_location ?? translate('messages.N/A') }}</td>
                                <td class="text-right">{{ $safetyAlert->number_of_alert }}</td>
                                <td class="text-right">
                                    {{ $safetyAlert->solvedBy?->f_name . ' ' . $safetyAlert->solvedBy?->l_name }}
                                </td>
                                <td class="text-right">
                                    @if($safetyAlert->ride_status_when_make_alert == 'completed')
                                        <span class="badge badge-soft-success">{{ translate('messages.Completed') }}</span>
                                    @elseif($safetyAlert->ride_status_when_make_alert == 'canceled')
                                        <span class="badge badge-soft-danger">{{ translate('messages.Canceled') }}</span>
                                    @else
                                        <span class="badge badge-soft-warning">{{ translate('messages.In Progress') }}</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="13">
                                    <div class="text-center p-4">
                                        <div class="empty--data">
                                            <img src="{{asset('/public/assets/admin/svg/illustrations/sorry.svg')}}" alt="public">
                                            <h5>
                                                {{translate('no_data_found')}}
                                            </h5>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
					</tbody>
				</table>

			</div>
		</div>
	</div>
@endsection

@push('script_2')
<script>

</script>
@endpush
