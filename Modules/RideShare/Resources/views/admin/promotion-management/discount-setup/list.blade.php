@extends('layouts.admin.app')

@section('title', translate('messages.discount_list'))

@push('css_or_js')
@endpush

@section('content')
    <div class="content container-fluid">

        <div class="page-header d-flex gap-3 flex-wrap justify-content-end align-items-center mb-4">
            <h1 class="page-header-title mb-0 flex-grow-1">
                <span>
                    {{ translate('messages.All_Discount') }}
                </span>
            </h1>
        </div>
        <div class="row g-4">
            <div class="col-12">
                 <div class="card">
                    <div class="card-header py-2">
                        <div class="search--button-wrapper gap-20px">
                            <h5 class="card-title text--title flex-grow-1">{{ translate('messages.Discount_List') }}</h5>

                            <form class="search-form m-0 flex-grow-1 max-w-353px">

                                <div class="input-group input--group">
                                    <input id="datatableSearch_" type="search" value="{{ request()?->search ?? null }}" name="search"
                                        class="form-control" placeholder="{{ translate('search_here_by_Discount_Title') }}"
                                        aria-label="{{ translate('search_here_by_Discount_Title') }}">
                                    <button type="submit" class="btn btn--secondary bg--primary"><i class="tio-search"></i></button>

                                </div>

                            </form>
                            @if (request()->get('search'))
                            <button type="reset" class="btn btn--primary ml-2 location-reload-to-base"
                                data-url="{{ url()->full() }}">{{ translate('messages.reset') }}</button>
                            @endif

                            <div class="hs-unfold m-0">
                                <a class="js-hs-unfold-invoker btn btn-sm btn-white dropdown-toggle min-height-40 font-semibold text--title"
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
                                        href="{{route('admin.ride-share.promotion.discount-setup.export')}}?status={{request()->get('status') ?? "all"}}&&file=excel">
                                        <img class="avatar avatar-xss avatar-4by3 mr-2"
                                            src="{{ asset('public/assets/admin') }}/svg/components/excel.svg" alt="Image Description">
                                        {{ translate('messages.excel') }}
                                    </a>
                                    {{-- <a id="export-csv" class="dropdown-item"
                                        href="{{ route('admin.rental.banner.export', ['type' => 'csv', request()->getQueryString()]) }}">
                                        <img class="avatar avatar-xss avatar-4by3 mr-2"
                                            src="{{ asset('public/assets/admin') }}/svg/components/placeholder-csv-format.svg"
                                            alt="Image Description">
                                        .{{ translate('messages.csv') }}
                                    </a> --}}

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive datatable-custom">
                        <table id="columnSearchDatatable"
                            class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table text--title">
                            <thead class="thead-light">
                                <tr>
                                    <th class="border-0">{{ translate('messages.SL') }}</th>
                                    <th class="border-0">{{ translate('messages.discount_info') }}</th>
                                    <th class="border-0">{{ translate('messages.Zone') }}</th>
                                    <th class="border-0">{{ translate('messages.Customer') }}</th>
                                    <th class="border-0">{{ translate('messages.Category') }}</th>
                                    <th class="border-0">{{ translate('messages.Discount_Amount') }}</th>
                                    <th class="border-0">{{ translate('messages.Duration') }}</th>
                                    <th class="border-0">{{ translate('messages.Total_Times_Used') }}</th>
                                    <th class="border-0">{{ translate('messages.Total_Discount_Amount') }} ({{session()->get('currency_symbol') ?? '$'}})</th>
                                    <th class="border-0 text-center">{{ translate('messages.status') }}</th>
                                    <th class="border-0 text-center">{{ translate('messages.action') }}</th>
                                </tr>
                            </thead>

                            <tbody id="set-rows">
                                @foreach ($discounts as $key => $discount)
                                    <tr>
                                        <td>{{ $discounts->firstItem() + $key }}</td>
                                        <td>
{{--                                            <a class="media align-items-center" href="#">--}}
                                            <div class="media align-items-center">
                                                <img class="avatar avatar-lg mr-3 onerror-image"

                                                     src="{{ $discount->image_full_url }}"

                                                     data-onerror-image="{{asset('public/assets/admin/img/160x160/img2.jpg')}}" alt="{{$discount->title}} image">
                                                <div title="{{ ucfirst($discount->title) }}" class="media-body">
                                                    <h5 class="text-hover-primary mb-0">{{ucfirst(Str::limit($discount->title,20,'...'))}}</h5>
                                                </div>
                                            </div>
{{--                                            </a>--}}
                                        </td>
                                        <td>
                                            @if($discount->zone_discount_type == ALL)
                                                <span class="badge bg-info rounded-pill badge-sm text-capitalize">{{ALL}}</span>
                                            @else
                                                @foreach($discount->zones as $key => $zone)
                                                    <span
                                                            class="badge bg-info rounded-pill badge-sm text-capitalize  mb-2">{{ $zone->name }}</span>
                                                    @if($key % 2 == 1)
                                                        <br>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            @if($discount->customer_discount_type == ALL)
                                                    <span class="badge bg-success rounded-pill badge-sm text-capitalize">{{ALL}}</span>
                                            @else
                                                @foreach($discount->customers as $key => $customer)
                                                    <span
                                                            class="badge bg-success rounded-pill badge-sm text-capitalize  mb-2">{{ $customer->f_name }}</span>
                                                    @if($key % 2 == 1)
                                                        <br>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            @if(in_array(ALL,$discount->module_discount_type))
                                                <span
                                                    class="badge bg-warning rounded-pill badge-sm text-capitalize">{{ALL}}</span>
                                            @elseif(in_array(CUSTOM,$discount->module_discount_type))
                                                @foreach($discount->vehicleCategories as $key => $category)
                                                    <span
                                                        class="badge bg-warning rounded-pill badge-sm text-capitalize  mb-2">{{ $category->name }}</span>
                                                    @if($key % 2 == 1)
                                                        <br>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>{{ $discount->discount_amount_type == 'percentage'? $discount->discount_amount.'%': set_currency_symbol($discount->discount_amount) }}</td>
                                        <td>
                                            <div class="text-wrap w-160px">
                                                {{translate('start')}} : {{$discount->start_date}} <br>
                                                {{translate('end')}} : {{$discount->end_date}} <br>
                                                {{translate('duration')}}
                                                : {{ Carbon\Carbon::parse($discount->end_date)->diffInDays($discount->start_date)+1}}
                                                Days
                                            </div>
                                        </td>
                                        <td>{{ (int)$discount->total_used }}</td>
                                        <td>{{ set_currency_symbol(round($discount->total_amount,2)) }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <label class="toggle-switch toggle-switch-sm" for="statusCheckbox{{$discount->id}}">
                                                    <input type="checkbox"
                                                    data-id="statusCheckbox{{$discount->id}}"
                                                    data-type="status"
                                                    data-image-on="{{ asset('/public/assets/admin/img/modal/basic_campaign_on.png') }}"
                                                    data-image-off="{{ asset('/public/assets/admin/img/modal/basic_campaign_off.png') }}"
                                                    data-title-on="{{ translate('By_Turning_ON_discount!') }}"
                                                    data-title-off="{{ translate('By_Turning_OFF_discount!') }}"
                                                    data-text-on="<p>{{ translate('If_you_turn_on_this_status,_it_will_show_on_user_app.') }}</p>"
                                                    data-text-off="<p>{{ translate('If_you_turn_off_this_status,_it_won’t_show_on_user_app') }}</p>"
                                                    class="toggle-switch-input  dynamic-checkbox" id="statusCheckbox{{$discount->id}}" {{$discount->is_active?'checked':''}}>
                                                    <span class="toggle-switch-label">
                                                        <span class="toggle-switch-indicator"></span>
                                                    </span>
                                                </label>
                                                <form action="{{route('admin.ride-share.promotion.discount-setup.status',['id' => $discount->id, 'status' => $discount->is_active?0:1])}}"
                                                method="get" id="statusCheckbox{{$discount->id}}_form">
                                                    <input type="hidden" name="status" value="{{$discount->is_active?0:1}}">
                                                    <input type="hidden" name="id" value="{{$discount->id}}">
                                                </form>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="btn--container justify-content-center">
                                                <a class="btn action-btn btn-outline-edit" href="{{route('admin.ride-share.promotion.discount-setup.edit', ['id'=>$discount->id])}}" title="{{translate('messages.edit_banner')}}"><i
                                                        class="fi fi-sr-pencil"></i>
                                                </a>
                                                <a class="btn action-btn btn--danger btn-outline-danger form-alert" href="javascript:"
                                                                data-id="delete-{{ $discount->id }}" data-message="{{ translate('Want to delete this ?') }}">
                                                    <i class="fi fi-rr-trash"></i>
                                                </a>
                                                <form action="{{ route('admin.ride-share.promotion.discount-setup.delete', ['id'=>$discount->id]) }}"
                                                                            id="delete-{{ $discount->id }}" method="post" >
                                                    @csrf @method('delete')
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if(count($discounts) !== 0)
                        <hr>
                        @endif
                        <div class="page-area">
                            {!! $discounts->withQueryString()->links() !!}
                        </div>
                        @if(count($discounts) === 0)
                        <div class="empty--data">
                            <img src="{{asset('/public/assets/admin/svg/illustrations/sorry.svg')}}" alt="public">
                            <h5>
                                {{translate('no_data_found')}}
                            </h5>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
@endsection

@push('script_2')
    <!-- Apex Charts -->
    <script src="{{ asset('/public/assets/admin/js/apex-charts/apexcharts.js') }}"></script>
    <!-- Apex Charts -->

    <script>
        // --- Line Charts
        $(document).ready(function () {
			// Static data
			let couponAmount = {
				Jan: 270,
				Feb: 310,
				Mar: 350,
				Apr: 390,
				May: 370
			};

			let noOfCouponUse = {
				Jan: 150,
				Feb: 180,
				Mar: 200,
				Apr: 220,
				May: 210
			};


			let label = ['Jan', 'Feb', 'Mar', 'Apr', 'May'];

			let options = {
				series: [
					{
						name: 'discount Amount',
						data: [0].concat(Object.values(couponAmount))
					},
					{
						name: 'No. Of Use',
						data: [0].concat(Object.values(noOfCouponUse))
					},
				],
				chart: {
					height: 290,
					type: 'line',
					dropShadow: {
						enabled: true,
						color: '#000',
						top: 18,
						left: 0,
						blur: 10,
						opacity: 0.1
					},
					toolbar: {
						show: false
					},
				},
				colors: ['#14B19E', '#107980'],
				dataLabels: {
					enabled: false,
				},
				stroke: {
					curve: 'smooth',
					width: 2,
				},
				grid: {
					yaxis: {
						lines: {
							show: true
						}
					},
					borderColor: '#ddd',
				},
				markers: {
					size: 2,
					strokeColors: ['#14B19E', '#107980'],
					strokeWidth: 1,
					fillOpacity: 0,
					hover: {
						sizeOffset: 2
					}
				},
				theme: {
					mode: 'light',
				},
				xaxis: {
					categories: ['00'].concat(label),
					labels: {
						offsetX: 0,
					},
				},
				legend: {
					show: false,
					position: 'bottom',
					horizontalAlign: 'center',
					floating: false,
					offsetY: 0,
					itemMargin: {
						vertical: 10
					},
				},
				yaxis: {
					tickAmount: 5,
					labels: {
						offsetX: 0,
					},
				}
			};

			if (localStorage.getItem('dir') === 'rtl') {
				options.yaxis.labels.offsetX = -20;
			}

			let chart = new ApexCharts(document.querySelector("#apex_line-chart"), options);
			chart.render();
		});
    </script>
@endpush
