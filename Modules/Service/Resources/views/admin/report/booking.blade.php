@extends('layouts.admin.app')

@section('title',translate('Booking_Report'))

@push('css_or_js')

@endpush

@section('content')
    <div class="main-content content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-wrap mb-3">
                        <h2 class="page-title">{{translate('Booking_Reports')}}</h2>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3 fs-16 text-dark">{{translate('Search_Data')}}</div>

                            <form action="{{route('admin.transactions.service.report.booking')}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-4 col-sm-6 mb-20 search-data__field">
                                        <label class="mb-2 fs-14 text-dark">{{translate('zone')}}</label>
                                        <select class="js-select2-custom js-select2-counting zone__select" name="zone_ids[]"
                                                id="zone_selector__select" multiple>
                                            <option value="all">{{translate('Select All')}}</option>
                                            @foreach($zones as $zone)
                                                <option
                                                    value="{{$zone['id']}}" {{array_key_exists('zone_ids', $queryParams) && in_array($zone['id'], $queryParams['zone_ids']) ? 'selected' : '' }}>{{$zone['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-sm-6 mb-20 search-data__field">
                                        <label class="mb-2 fs-14 text-dark">{{translate('category')}}</label>
                                        <select class="js-select2-custom js-select2-counting category__select" name="category_ids[]"
                                                id="category_selector__select" multiple>
                                            <option value="all">{{translate('Select All')}}</option>
                                            @foreach($categories as $category)
                                                <option
                                                    value="{{$category['id']}}" {{array_key_exists('category_ids', $queryParams) && in_array($category['id'], $queryParams['category_ids']) ? 'selected' : '' }}>{{$category['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-sm-6 mb-20 search-data__field">
                                        <label class="mb-2 fs-14 text-dark">{{translate('sub_category')}}
                                             <i class="tio-info fs-14 text-muted" data-toggle="tooltip"
                                        data-title="{{translate('Content Need')}}"></i>
                                        </label>
                                        <select class="js-select2-custom js-select2-counting sub-category__select" name="sub_category_ids[]"
                                                id="sub_category_selector__select"
                                                multiple>
                                            <option value="all">{{translate('Select All')}}</option>
                                            @foreach($subCategories as $sub_category)
                                                <option
                                                    value="{{$sub_category['id']}}" {{array_key_exists('sub_category_ids', $queryParams) && in_array($sub_category['id'], $queryParams['sub_category_ids']) ? 'selected' : '' }}>{{$sub_category['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-sm-6 mb-20 search-data__field">
                                        <label class="mb-2 fs-14 text-dark">{{translate('provider')}}</label>
                                        <select class="js-select2-custom js-select2-counting provider__select" name="provider_ids[]"
                                                id="provider_selector__select" multiple>
                                            <option value="all">{{translate('Select All')}}</option>
                                            @foreach($providers as $provider)
                                                <option
                                                    value="{{$provider['id']}}" {{array_key_exists('provider_ids', $queryParams) && in_array($provider['id'], $queryParams['provider_ids']) ? 'selected' : '' }}>{{$provider['company_name']}}
                                                    ({{$provider['company_phone']}})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-sm-6 mb-20 search-data__field">
                                        <label class="mb-2 fs-14 text-dark">{{translate('date_range')}}</label>
                                        <select class="js-select h-40 fs-12 form-control" id="date-range" name="date_range">
                                            <option value="0" disabled
                                                    selected>{{translate('Select Date Range')}}</option>
                                            <option
                                                value="all_time" {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='all_time'?'selected':''}}>{{translate('All_Time')}}</option>
                                            <option
                                                value="this_week" {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='this_week'?'selected':''}}>{{translate('This_Week')}}</option>
                                            <option
                                                value="last_week" {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='last_week'?'selected':''}}>{{translate('Last_Week')}}</option>
                                            <option
                                                value="this_month" {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='this_month'?'selected':''}}>{{translate('This_Month')}}</option>
                                            <option
                                                value="last_month" {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='last_month'?'selected':''}}>{{translate('Last_Month')}}</option>
                                            <option
                                                value="last_15_days" {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='last_15_days'?'selected':''}}>{{translate('Last_15_Days')}}</option>
                                            <option
                                                value="this_year" {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='this_year'?'selected':''}}>{{translate('This_Year')}}</option>
                                            <option
                                                value="last_year" {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='last_year'?'selected':''}}>{{translate('Last_Year')}}</option>
                                            <option
                                                value="last_6_month" {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='last_6_month'?'selected':''}}>{{translate('Last_6_Month')}}</option>
                                            <option
                                                value="this_year_1st_quarter" {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='this_year_1st_quarter'?'selected':''}}>{{translate('This_Year_1st_Quarter')}}</option>
                                            <option
                                                value="this_year_2nd_quarter" {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='this_year_2nd_quarter'?'selected':''}}>{{translate('This_Year_2nd_Quarter')}}</option>
                                            <option
                                                value="this_year_3rd_quarter" {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='this_year_3rd_quarter'?'selected':''}}>{{translate('This_Year_3rd_Quarter')}}</option>
                                            <option
                                                value="this_year_4th_quarter" {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='this_year_4th_quarter'?'selected':''}}>{{translate('this_year_4th_quarter')}}</option>
                                            <option
                                                value="custom_date" {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='custom_date'?'selected':''}}>{{translate('Custom_Date')}}</option>
                                        </select>
                                    </div>
                                    <div
                                        class="col-lg-4 col-sm-6 {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='custom_date'?'':'d-none'}}"
                                        id="from-filter__div">
                                        <div class="form-floating mb-30">
                                            <label for="from" class="mb-2 text--clr fs-14">{{translate('From')}}</label>
                                            <input type="date" class="form-control" id="from" name="from"
                                                   value="{{array_key_exists('from', $queryParams)?$queryParams['from']:''}}">
                                        </div>
                                    </div>
                                    <div
                                        class="col-lg-4 col-sm-6 {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='custom_date'?'':'d-none'}}"
                                        id="to-filter__div">
                                        <div class="form-floating mb-30">
                                            <label for="to" class="mb-2 text--clr fs-14">{{translate('To')}}</label>
                                            <input type="date" class="form-control" id="to" name="to"
                                                   value="{{array_key_exists('to', $queryParams)?$queryParams['to']:''}}">
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex gap-3 justify-content-end">
                                        <button type="reset" class="btn btn--reset btn-sm">{{translate('Reset')}}</button>
                                        <button type="submit" class="btn btn--primary btn-sm">{{translate('Submit')}}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row g-2 pt-2">
                        <div class="col-xl-3">
                            <div class="d-flex flex-wrap gap-2">
                                <div class="card p-20 flex-grow-1">
                                    <div class="d-flex gap-2 flex-wrap justify-content-center align-items-center text-center">
                                        <img width="35" class="avatar"
                                             src="{{asset('public/assets/admin')}}/img/not-pen.png"
                                             alt="">
                                        <div class="text-center">
                                            <h2 class="text-dark fs-24 m-0">{{$bookings_count['total_bookings']}}</h2>
                                            <span class="fs-12">{{translate('Total_Bookings')}}</span>
                                        </div>
                                    </div>
                                    <div class="booking-statis-count d-flex flex-wrap justify-content-between gap-2 mt-3">
                                        <div class="d-flex flex-column align-items-center gap-2 fz-12">
                                            <span class="fw-semibold text-danger font-semibold">{{$bookings_count['canceled']}}</span>
                                            <span class="text-opacity10 fs-12">{{translate('Canceled')}}</span>
                                        </div>
                                        <div class="d-flex flex-column align-items-center gap-2 fz-12">
                                            <span
                                                class="fw-semibold text-success font-semibold">{{$bookings_count['accepted']}}</span>
                                            <span class="text-opacity10 fs-12">{{translate('Accepted')}}</span>
                                        </div>
                                        <div class="d-flex flex-column align-items-center gap-2 fz-12">
                                            <span class="c1 fw-semibold font-semibold">{{$bookings_count['ongoing']}}</span>
                                            <span class="text-opacity10 fs-12">{{translate('On_Going')}}</span>
                                        </div>
                                        <div class="d-flex flex-column align-items-center gap-2 fz-12">
                                            <span
                                                class="fw-semibold text-success font-semibold">{{$bookings_count['completed']}}</span>
                                            <span class="text-opacity10 fs-12">{{translate('Completed')}}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="card p-20 flex-grow-1">
                                    <div class="d-flex gap-2 flex-wrap justify-content-center align-items-center text-center">
                                        <img width="35" class="avatar"
                                             src="{{asset('public/assets/admin')}}/img/phone-cart.png"
                                             alt="">
                                        <div class="text-center">
                                            <h2 class="text-dark fs-24 m-0">{{\App\CentralLogics\Helpers::format_currency($booking_amount['total_booking_amount'])}}</h2>
                                            <span class="fs-12">{{translate('Total_Booking_Amount')}}</span>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-wrap justify-content-between gap-2 mt-3">
                                        <div class="d-flex flex-column align-items-center gap-2 fz-12">
                                            <span
                                                class="text-danger fw-semibold">{{\App\CentralLogics\Helpers::format_currency($booking_amount['total_unpaid_booking_amount'])}}</span>
                                            <span class="text-opacity fs-12 lh-1">{{translate('Due_Amount')}}
                                                {{--<i class="material-icons" data-bs-toggle="tooltip"
                                                   data-bs-placement="top"
                                                   title="{{translate('Digitally paid but yet to disburse the amount')}}"
                                                >info</i>--}}
                                            </span>
                                        </div>
                                        <div class="d-flex flex-column align-items-center gap-2 fz-12">
                                            <span
                                                class="text-success fw-semibold">{{\App\CentralLogics\Helpers::format_currency($booking_amount['total_paid_booking_amount'])}}</span>
                                            <span class="text-opacity fs-12 lh-1">{{translate('Already_Settled')}}
                                                {{--<i class="material-icons" data-bs-toggle="tooltip"
                                                   data-bs-placement="top"
                                                   title="{{translate('Digitally paid & already disbursed the amount')}}"
                                                >info</i>--}}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-9">
                            <div class="card">
                                <div class="card-body ps-0">
                                    <h4 class="ps-20">{{translate('Booking_Statistics')}}</h4>
                                    <div id="apex_column-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-2">
                        <div class="card-body p-0">
                            <div class="data-table-top py-3 px-3 d-flex align-items-center flex-wrap gap-3 justify-content-between">
                                <form action="{{url()->current()}}" class="search-form rounded overflow-hidden d-flex align-items-center search-form_style-two" method="GET">
                                    <div class="input-group d-flex search-form__input_group">
                                        <!-- <span class="search-form__icon">
                                            <span class="material-icons">search</span>
                                        </span> -->
                                        <input type="search" class="theme-input-style form-control rounded-0 h-40 search-form__input"
                                            value="{{$queryParams['search']??''}}" name="search"
                                            placeholder="{{translate('search by booking ID')}}">
                                    </div>
                                    <button type="submit" class="btn px-sm-3 px-2  btn--primary h-40 rounded-0"><i class="tio-search"></i></button>
                                </form>

                                <div class="d-flex flex-wrap align-items-center gap-3">
                                    <div>
                                        <select class="js-select booking-status__select" name="booking_status"
                                                id="booking-status">
                                            <option value="" selected disabled>{{translate('Booking_status')}}</option>
                                            <option value="all">{{translate('All')}}</option>
                                            @foreach(BOOKING_STATUSES as $booking_status)
                                                <option
                                                    value="{{$booking_status['key']}}" {{ $booking_status['key'] === request()->input('booking_status') ? 'selected' : '' }}>{{$booking_status['value']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="hs-unfold mr-2">
                                        <a class="js-hs-unfold-invoker btn btn-sm btn-white dropdown-toggle h--45px border" href="javascript:;" data-hs-unfold-options="{
                                    &quot;target&quot;: &quot;#usersExportDropdown&quot;,
                                    &quot;type&quot;: &quot;css-animation&quot;
                                }" data-hs-unfold-target="#usersExportDropdown" data-hs-unfold-invoker="">
                                            <i class="tio-download-to mr-1"></i> {{ translate('export') }}
                                        </a>

                                        <div id="usersExportDropdown" class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right hs-unfold-content-initialized hs-unfold-css-animation animated hs-unfold-hidden" data-hs-target-height="131.516" data-hs-unfold-content="" data-hs-unfold-content-animation-in="slideInUp" data-hs-unfold-content-animation-out="fadeOut" style="animation-duration: 300ms;z-index: 999999;">
                                            <span class="dropdown-header">{{ translate('download_options') }}</span>
                                            <a id="export-excel" class="dropdown-item" href="{{route('admin.transactions.service.report.booking.download').'?'.http_build_query(request()->all())}}">
                                                <img class="avatar avatar-xss avatar-4by3 mr-2" src="{{ asset('public/assets/admin/svg/components/excel.svg') }}" alt="Image Description">
                                                {{ translate('excel') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive pb-0">
                                <table class="table align-middle-cus table-borderless m-0">
                                    <thead class="text-nowrap" data-bg-color="#f3f8f8ff">
                                    <tr>
                                        <th class="border-0">{{translate('SL')}}</th>
                                        <th class="border-0">{{translate('Booking_ID')}}</th>
                                        <th class="border-0">{{translate('Customer_Info')}}</th>
                                        <th class="border-0">{{translate('Provider_Info')}}</th>
                                        <th class="border-0">{{translate('Booking_Amount')}}</th>
                                        <th class="border-0">{{translate('Service_Discount')}}</th>
                                        <th class="border-0">{{translate('Coupon_Discount')}}</th>
                                        <th class="border-0">{{translate('VAT_/_Tax')}}</th>
                                        <th class="border-0">{{translate('Action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($filtered_bookings as $key=>$booking)
                                        <tr>
                                            <td>{{ $filtered_bookings->firstitem()+$key }}</td>
                                            <td>
                                                <a href="{{route('admin.service.booking.details', [$booking->id,'web_page'=>'details','module_id'=>$booking->module_id])}}">
                                                    {{$booking['id']}}
                                                </a>
                                            </td>
                                            <td>
                                                @if(isset($booking->customer) && $booking->is_guest == 0)
                                                    <div class="fw-medium">
                                                        <a href="{{route('admin.users.customer.service.view',[$booking->customer['id']])}}">
                                                            {{$booking->customer->full_name}}
                                                        </a>
                                                    </div>
                                                    <a class="text-opacity fs-12"
                                                       href="tel:{{$booking->customer->phone??''}}">{{$booking->customer->phone??''}}</a>
                                                @elseif( $booking->is_guest == 1)
                                                    <div class="fw-medium">
                                                        {{$booking->service_address->contact_person_name??translate('Guest')}}
                                                    </div>
                                                    <a class="text-opacity fs-12"
                                                       href="tel:{{$booking->service_address->contact_person_number??''}}">{{$booking->service_address->contact_person_number??''}}</a>
                                                @else
                                                    <div
                                                        class="fw-medium badge badge badge-danger radius-50">{{translate('Customer_not_available')}}</div>
                                                @endif
                                            </td>
                                            <td>
                                                @if(isset($booking->provider))
                                                    <div class="fw-medium">
                                                        <a href="{{route('admin.service.provider.details',[$booking->provider->id, 'web_page'=>'overview'])}}">
                                                            {{$booking->provider->company_name}}
                                                        </a>
                                                    </div>
                                                    <a class="fz-12"
                                                       href="tel:{{$booking->provider->company_phone??''}}">{{$booking->provider->company_phone??''}}</a>
                                                @else
                                                    <div
                                                        class="fw-medium badge badge badge-danger radius-50">{{translate('Provider_not_available')}}</div>
                                                @endif
                                            </td>
                                            <td>{{\App\CentralLogics\Helpers::format_currency($booking['total_booking_amount'])}}</td>
                                            <td>
                                                @if($booking['total_campaign_discount_amount'] > $booking['total_discount_amount'])
                                                    {{\App\CentralLogics\Helpers::format_currency($booking['total_campaign_discount_amount'])}}
                                                    <label
                                                        class="fw-medium badge badge badge-info radius-50">{{translate('Campaign')}}</label>
                                                @else
                                                    {{\App\CentralLogics\Helpers::format_currency($booking['total_discount_amount'])}}
                                                @endif
                                            </td>
                                            <td>{{\App\CentralLogics\Helpers::format_currency($booking['total_coupon_discount_amount'])}}</td>
                                            <td>{{\App\CentralLogics\Helpers::format_currency($booking['total_tax_amount'])}}</td>
                                            <td>
                                                @if($booking->is_repeated)
                                                    <a href="{{ route('admin.service.booking.repeat_details', [$booking->id, 'web_page' => 'details']) }}"
                                                       class="action-btn btn btn-outline-primary" style="--size: 30px">
                                                       <i class="tio-invisible"></i>
                                                    </a>
                                                @else
                                                    <a href="{{route('admin.service.booking.details', [$booking->id,'web_page'=>'details'])}}"
                                                       class="action-btn btn btn-outline-primary" style="--size: 30px">
                                                       <i class="tio-invisible"></i>
                                                    </a>
                                                @endif

                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="text-center">
                                            <td colspan="10">
                                                <div class="empty--data">
                                                    <img src="{{asset('/public/assets/admin/svg/illustrations/sorry.svg')}}" alt="public">
                                                    <h5>
                                                        {{translate('no_data_found')}}
                                                    </h5>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        @if(count($filtered_bookings) !== 0)
                            <hr>
                        @endif
                        <div class="page-area">
                            {!! $filtered_bookings->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script_2')

    <script src="{{asset('public/assets/admin')}}/js/apex-charts/apexcharts.js"></script>

    <script>
        "use strict";

        $('#zone_selector__select').on('change', function () {
            var selectedValues = $(this).val();
            if (selectedValues !== null && selectedValues.includes('all')) {
                $(this).find('option').not(':disabled').prop('selected', 'selected');
                $(this).find('option[value="all"]').prop('selected', false);
            }
        });

        $('#category_selector__select').on('change', function () {
            var selectedValues = $(this).val();
            if (selectedValues !== null && selectedValues.includes('all')) {
                $(this).find('option').not(':disabled').prop('selected', 'selected');
                $(this).find('option[value="all"]').prop('selected', false);
            }
        });

        $('#sub_category_selector__select').on('change', function () {
            var selectedValues = $(this).val();
            if (selectedValues !== null && selectedValues.includes('all')) {
                $(this).find('option').not(':disabled').prop('selected', 'selected');
                $(this).find('option[value="all"]').prop('selected', false);
            }
        });

        $('#provider_selector__select').on('change', function () {
            var selectedValues = $(this).val();
            if (selectedValues !== null && selectedValues.includes('all')) {
                $(this).find('option').not(':disabled').prop('selected', 'selected');
                $(this).find('option[value="all"]').prop('selected', false);
            }
        });

        $(document).ready(function () {
            $('.zone__select').select2({
                placeholder: "{{translate('Select_zone')}}",
            });
            $('.provider__select').select2({
                placeholder: "{{translate('Select_provider')}}",
            });
            $('.category__select').select2({
                placeholder: "{{translate('Select_category')}}",
            });
            $('.sub-category__select').select2({
                placeholder: "{{translate('Select_sub_category')}}",
            });
            $('.booking-status__select').select2({
                placeholder: "{{translate('Booking_status')}}",
            });
        });

        $(document).ready(function () {
            $('#date-range').on('change', function () {
                if (this.value === 'custom_date') {
                    $('#from-filter__div').removeClass('d-none');
                    $('#to-filter__div').removeClass('d-none');
                }


                if (this.value !== 'custom_date') {
                    $('#from-filter__div').addClass('d-none');
                    $('#to-filter__div').addClass('d-none');
                }
            });
        });

        $(document).ready(function () {
            $('#booking-status').on('change', function () {
                location.href = "{{route('admin.transactions.service.report.booking')}}" + "?booking_status=" + this.value;
            });
        });

        var options = {
            series: [{
                name: '{{translate('Total_Booking')}}',
                data: {{json_encode($chart_data['booking_amount'])}}
            }, {
                name: '{{translate('Commission')}}',
                data: {{json_encode($chart_data['admin_commission'])}}
            }, {
                name: '{{translate('VAT_/_Tax')}}',
                data: {{json_encode($chart_data['tax_amount'])}}
            }],
            chart: {
                type: 'bar',
                height: 299
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55px',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: {{json_encode($chart_data['timeline'])}},
            },
            yaxis: {
                title: {
                    text: '{{currency_symbol()}}'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return " " + val + " ";
                    }
                }
            },
            legend: {
                show: false
            },
        };

        var chart = new ApexCharts(document.querySelector("#apex_column-chart"), options);
        chart.render();
    </script>
@endpush
