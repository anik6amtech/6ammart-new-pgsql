@extends('layouts.admin.app')

@section('title', translate('messages.coupon_list'))

@push('css_or_js')
@endpush

@section('content')
    <div class="content container-fluid">

        <div class="page-header d-flex gap-3 flex-wrap justify-content-end align-items-center mb-4">
            <h1 class="page-header-title mb-0 flex-grow-1">
                <span>
                    {{ translate('messages.Coupon_Statistics') }}
                </span>
            </h1>
            <div class="d-flex gap-2 align-items-center">
                <h5 class="mb-0 text--primary">{{ translate('messages.see_how_it_works') }}</h5>
                <div class="blinkings">

                    <span><i class="tio-info-outined"></i></span>
                    <div class="business-notes">
                        <div>
                            <div class="container">
                                <div class="mb-1">
                                    <label class="fw-bold d-block mb-1 text-primary">1. {{translate('Create_a_Coupon')}}</label>
                                    <p class="mb-0 text-muted">
                                        {{translate('Set_up_new_coupons_by_defining_the_title_code_discount_type_percentage_or_fixed_and_usage_limit')}}
                                    </p>
                                </div>

                                <div class="mb-1">
                                    <label class="fw-bold d-block mb-1 text-success">2. {{translate('Set_Conditions')}}</label>
                                    <p class="mb-0 text-muted">
                                        {{translate('Specify_the_applicable_modules_vendors_minimum_order_amount_and_customer_eligibility')}}
                                    </p>
                                </div>

                                <div class="mb-1">
                                    <label class="fw-bold d-block mb-1 text-warning">3. {{translate('Select_activation_time')}}</label>
                                    <p class="mb-0 text-muted">
                                        {{translate('Choose_whether_to_activate_the_coupon_immediately_or_schedule_it_for_a_future_date_range')}}
                                    </p>
                                </div>

                                <div class="mb-1">
                                    <label class="fw-bold d-block mb-1 text-info">4. {{translate('Monitor_Performance')}}</label>
                                    <p class="mb-0 text-muted">
                                        {{translate('Track_coupon_usage_total_discount_given_and_redemption_statistics_from_the_coupon_list_or_reports_section')}}
                                    </p>
                                </div>

                                <div class="mb-1">
                                    <label class="fw-bold d-block mb-1 text-danger">5. {{translate('Manage_Status')}}</label>
                                    <p class="mb-0 text-muted">
                                        {{translate('You_can_edit_disable_or_delete_coupons_anytime_Once_turned_off_they_will_no_longer_be_available_to_users_in_the_app')}}
                                    </p>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <div class="min-w-176px">
                        @php($queryString = request()->getQueryString())
                <form id="dateRangeForm" method="GET" action="{{ url()->current() }}">
                        <select name="date_range" id="dateRange" class="js-select2-custom date-range-change"
                                data-url="{{url()->full()}}">
                            <option
                                    value="{{ALL_TIME}}"
                                    {{$dateRangeValue == ALL_TIME || $dateRangeValue == null?'selected':''}} selected>{{translate(ALL_TIME)}}</option>
                            <option
                                    value="{{TODAY}}" {{$dateRangeValue == TODAY?'selected':''}}>{{translate(TODAY)}}</option>
                            <option
                                    value="{{THIS_WEEK}}" {{$dateRangeValue == THIS_WEEK?'selected':''}}>{{translate(THIS_WEEK)}}</option>
                            <option
                                    value="{{THIS_MONTH}}" {{$dateRangeValue == THIS_MONTH?'selected':''}}>{{translate(THIS_MONTH)}}</option>
                            <option
                                    value="{{THIS_YEAR}}" {{$dateRangeValue == THIS_YEAR?'selected':''}}>{{translate(THIS_YEAR)}}</option>
                        </select>
                </form>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="text-title font-bold mb-20">
                            {{ translate('messages.Coupon_Overview') }}
                        </h5>
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="__bg-FAFAFA p-20 border rounded d-flex flex-column justify-content-center align-items-center gap-30px h-100">
                                    <img width="45" height="45" src="{{asset('/Modules/RideShare/public/assets/img/ride-share/coupon-overview.png')}}" alt="">
                                    <div class="text-center">
                                        <div class="mb-2">{{ translate('messages.total_coupon_amount_given') }}</div>
                                        <h2 class="text--title font-bold fs-24">{{set_currency_symbol($cardValues['total_coupon_amount'])}}</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="__bg-FAFAFA p-20 border rounded d-flex flex-column justify-content-center align-items-center gap-30px h-100">
                                    <img width="45" height="45" src="{{asset('/Modules/RideShare/public/assets/img/ride-share/coupon-overview.png')}}" alt="">
                                    <div class="text-center">
                                        <div class="mb-2">{{ translate('messages.Active Coupon Offer') }}</div>
                                        <h2 class="text--title font-bold fs-24">{{$cardValues['total_active']}}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border-0 h-100">
                    <div class="card-header border-0 bg-transparent shadow-sm">
                        <div>
                            <h5 class="fs-14 mb-1">{{translate("messages.Coupon_Analytics")}}</h5>
                            <p class="fs-12 mb-0">{{translate("messages.monitor_coupon_statistics")}}</p>
                        </div>
                    </div>
                    <div class="card-body" id="updating_line_chart">
                        <div id="apex_line-chart"></div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                 <div class="card">
                    <div class="card-header py-2">
                        <div class="search--button-wrapper gap-20px">
                            <h5 class="card-title text--title flex-grow-1">{{ translate('messages.Coupon_List') }}</h5>

                            <form class="search-form m-0 flex-grow-1 max-w-353px">

                                <div class="input-group input--group">
                                    <input id="datatableSearch_" type="search" value="{{ request()?->search ?? null }}" name="search"
                                        class="form-control" placeholder="{{ translate('search_here_by_Coupon_Title') }}"
                                        aria-label="{{ translate('search_here_by_Coupon_Title') }}">
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
                                        href="{{route('admin.ride-share.promotion.coupon-setup.export')}}?status={{request()->get('status') ?? "all"}}&&file=excel">
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
                            <a href="{{route('admin.ride-share.promotion.coupon-setup.create')}}" type="button"
                            class="btn btn--primary lh-1 d-flex gap-2 justify-content-center">
                                <i class="fi fi-rr-plus"></i>
                                {{ translate('messages.add_coupon') }}
                            </a>
                        </div>
                    </div>

                    <div class="table-responsive datatable-custom">
                        <table id="columnSearchDatatable"
                            class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table text--title">
                            <thead class="thead-light">
                                <tr>
                                    <th class="border-0">{{ translate('messages.SL') }}</th>
                                    <th class="border-0">{{ translate('messages.Coupon_Title') }}</th>
                                    <th class="border-0">{{ translate('messages.Coupon_Code') }}</th>
                                    <th class="border-0">{{ translate('messages.Coupon_Type') }}</th>
                                    <th class="border-0">{{ translate('messages.Zone') }}</th>
                                    <th class="border-0">{{ translate('messages.Customer') }}</th>
                                    <th class="border-0">{{ translate('messages.Category') }}</th>
                                    <th class="border-0">{{ translate('messages.Coupon_Amount') }}</th>
                                    <th class="border-0">{{ translate('messages.Duration') }}</th>
                                    <th class="border-0">{{ translate('messages.Total_Times_Used') }}</th>
                                    <th class="border-0">{{ translate('messages.Total_Coupon_Discount') }} ({{session()->get('currency_symbol') ?? '$'}})</th>
                                    <th class="border-0">{{ translate('messages.Average_Coupon_Discount') }} ({{session()->get('currency_symbol') ?? '$'}})</th>
                                    <th class="border-0 text-center">{{ translate('messages.coupon_status') }}</th>
                                    <th class="border-0 text-center">{{ translate('messages.status') }}</th>
                                    <th class="border-0 text-center">{{ translate('messages.action') }}</th>
                                </tr>
                            </thead>

                            <tbody id="set-rows">
                                @foreach ($coupons as $key => $coupon)
                                    <tr>
                                        <td>{{ $coupons->firstItem() + $key }}</td>
                                        <td>
                                            <div class="font-medium w-160px text-wrap">{{ $coupon->name }}</div>
                                        </td>
                                        <td>{{ $coupon->coupon_code }}</td>
                                        <td>{{ str_replace('_', ' ', $coupon->coupon_type) }}</td>
                                        <td>
                                            @if($coupon->zone_coupon_type == ALL)
                                                <span class="badge bg-info rounded-pill badge-sm text-capitalize">{{ALL}}</span>
                                            @else
                                                @foreach($coupon->zones as $key => $zone)
                                                    <span
                                                            class="badge bg-info rounded-pill badge-sm text-capitalize  mb-2">{{ $zone->name }}</span>
                                                    @if($key % 2 == 1)
                                                        <br>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            @if($coupon->customer_coupon_type == ALL)
                                                    <span class="badge bg-success rounded-pill badge-sm text-capitalize">{{ALL}}</span>
                                            @else
                                                @foreach($coupon->customers as $key => $customer)
                                                    <span
                                                            class="badge bg-success rounded-pill badge-sm text-capitalize  mb-2">{{ $customer->f_name }}</span>
                                                    @if($key % 2 == 1)
                                                        <br>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                             @if(in_array(ALL,$coupon->category_coupon_type))
                                                    <span class="badge bg-warning rounded-pill badge-sm text-capitalize">{{ALL}}</span>
                                                @elseif(in_array(PARCEL,$coupon->category_coupon_type) && in_array(CUSTOM,$coupon->category_coupon_type))
                                                    <span
                                                            class="badge bg-warning rounded-pill badge-sm text-capitalize  mb-2">{{ PARCEL }}</span>
                                                    @foreach($coupon->vehicleCategories as $key => $category)
                                                        <span
                                                                class="badge bg-warning rounded-pill badge-sm text-capitalize  mb-2">{{ $category->name }}</span>
                                                        @if($key % 2 == 0)
                                                            <br>
                                                        @endif
                                                    @endforeach
                                                @elseif(in_array(PARCEL,$coupon->category_coupon_type))
                                                    <span
                                                            class="badge bg-warning rounded-pill badge-sm text-capitalize">{{ PARCEL }}</span>
                                                @elseif(in_array(CUSTOM,$coupon->category_coupon_type))
                                                    @foreach($coupon->vehicleCategories as $key => $category)
                                                        <span
                                                                class="badge bg-warning rounded-pill badge-sm text-capitalize  mb-2">{{ $category->name }}</span>
                                                        @if($key % 2 == 1)
                                                            <br>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </td>
                                        <td>{{ $coupon->amount_type == 'percentage'? $coupon->coupon.'%': set_currency_symbol($coupon->coupon) }}</td>
                                        <td>
                                            <div class="text-wrap w-160px">
                                                {{translate('start')}} : {{$coupon->start_date}} <br>
                                                {{translate('end')}} : {{$coupon->end_date}} <br>
                                                {{translate('duration')}}
                                                : {{ Carbon\Carbon::parse($coupon->end_date)->diffInDays($coupon->start_date)+1}}
                                                Days
                                            </div>
                                        </td>
                                        <td>{{ (int)$coupon->total_used }}</td>
                                        <td>{{ set_currency_symbol(round($coupon->total_amount,2)) }}</td>
                                        <td>{{ set_currency_symbol(round($coupon->total_used > 0?($coupon->total_amount/$coupon->total_used):0,2)) }}</td>
                                        <td>
                                            @php($date = Carbon\Carbon::now()->startOfDay())
                                            @if($date->gt($coupon->end_date))
                                                <span
                                                        class="badge badge-danger">{{ translate(EXPIRED) }}</span>
                                            @elseif (!$coupon->is_active)
                                                <span
                                                        class="badge badge-warning">{{ translate(CURRENTLY_OFF) }}</span>
                                            @elseif ($date->lt($coupon->start_date))
                                                <span
                                                        class="badge badge-info">{{ translate(UPCOMING) }}</span>
                                            @elseif ($date->lte($coupon->end_date))
                                                <span
                                                        class="badge badge-success">{{ translate(RUNNING) }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <label class="toggle-switch toggle-switch-sm" for="statusCheckbox{{$coupon->id}}">
                                                    <input type="checkbox"
                                                    data-id="statusCheckbox{{$coupon->id}}"
                                                    data-type="status"
                                                    data-image-on="{{ asset('/public/assets/admin/img/modal/basic_campaign_on.png') }}"
                                                    data-image-off="{{ asset('/public/assets/admin/img/modal/basic_campaign_off.png') }}"
                                                    data-title-on="{{ translate('By_Turning_ON_Coupon!') }}"
                                                    data-title-off="{{ translate('By_Turning_OFF_Coupon!') }}"
                                                    data-text-on="<p>{{ translate('If_you_turn_on_this_status,_it_will_show_on_user_app.') }}</p>"
                                                    data-text-off="<p>{{ translate('If_you_turn_off_this_status,_it_won’t_show_on_user_app') }}</p>"
                                                    class="toggle-switch-input  dynamic-checkbox" id="statusCheckbox{{$coupon->id}}" {{$coupon->is_active?'checked':''}}>
                                                    <span class="toggle-switch-label">
                                                        <span class="toggle-switch-indicator"></span>
                                                    </span>
                                                </label>
                                                <form action="{{route('admin.ride-share.promotion.coupon-setup.status',['id' => $coupon->id, 'status' => $coupon->is_active?0:1])}}"
                                                method="get" id="statusCheckbox{{$coupon->id}}_form">
                                                    <input type="hidden" name="status" value="{{$coupon->is_active?0:1}}">
                                                    <input type="hidden" name="id" value="{{$coupon->id}}">
                                                </form>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="btn--container justify-content-center">
                                                <a class="btn action-btn btn-outline-edit" href="{{route('admin.ride-share.promotion.coupon-setup.edit', ['id'=>$coupon->id])}}" title="{{translate('messages.edit_banner')}}"><i
                                                        class="fi fi-sr-pencil"></i>
                                                </a>
                                                <a class="btn action-btn btn--danger btn-outline-danger form-alert" href="javascript:"
                                                                data-id="delete-{{ $coupon->id }}" data-message="{{ translate('Want to delete this ?') }}">
                                                    <i class="fi fi-rr-trash"></i>
                                                </a>
                                                <form action="{{ route('admin.ride-share.promotion.coupon-setup.delete', ['id'=>$coupon->id]) }}"
                                                                            id="delete-{{ $coupon->id }}" method="post" >
                                                    @csrf @method('delete')
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if(count($coupons) !== 0)
                        <hr>
                        @endif
                        <div class="page-area">
                            {!! $coupons->withQueryString()->links() !!}
                        </div>
                        @if(count($coupons) === 0)
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
        $(document).ready(function () {
            $('#dateRange').on('change', function () {
                $('#dateRangeForm').submit();
            });
        });
        $(document).ready(function () {
            let couponAmount = @json($couponAmount);
            let noOfCouponUse = @json($noOfCouponUse);

            let label = Object.keys(couponAmount);

            let options = {
                series: [
                    {
                        name: 'Coupon Amount',
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
                    toolbar: { show: false },
                },
                colors: ['#14B19E', '#107980'],
                dataLabels: { enabled: false },
                stroke: {
                    curve: 'smooth',
                    width: 2,
                },
                grid: {
                    yaxis: { lines: { show: true } },
                    borderColor: '#ddd',
                },
                markers: {
                    size: 2,
                    strokeColors: ['#14B19E', '#107980'],
                    strokeWidth: 1,
                    fillOpacity: 0,
                    hover: { sizeOffset: 2 }
                },
                theme: { mode: 'light' },
                xaxis: {
                    categories: ['00'].concat(label),
                    labels: { offsetX: 0 },
                },
                legend: {
                    show: false,
                    position: 'bottom',
                    horizontalAlign: 'center',
                    floating: false,
                    offsetY: 0,
                    itemMargin: { vertical: 10 },
                },
                yaxis: {
                    tickAmount: 5,
                    labels: { offsetX: 0 },
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
