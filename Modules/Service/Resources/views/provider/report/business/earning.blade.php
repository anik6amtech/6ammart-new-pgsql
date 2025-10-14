@extends('service::provider.layouts.app')
@section('title',translate('Earning_Report'))

@push('css_or_js')

@endpush

@section('content')
    <div class="main-content">
        <div class="container-fluid content content-provider">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-wrap mb-3">
                        <h2 class="page-title">{{translate('Business_Reports')}}</h2>
                    </div>

                    <div class="mb-3">
                        <ul class="nav nav--tabs nav--pills nav--tabs__style2">
                            <li class="nav-item">
                                <a href="{{route('provider.service.report.business.overview')}}"
                                   class="nav-link">{{translate('Overview')}}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('provider.service.report.business.earning')}}"
                                   class="nav-link active">{{translate('Earning_Report')}}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('provider.service.report.business.expense')}}"
                                   class="nav-link">{{translate('Expense_Report')}}</a>
                            </li>
                        </ul>
                    </div>

                    <div class="card mb-1">
                        <div class="card-body">
                            <div class="mb-3 fs-16 text-dark">{{translate('Search_Data')}}</div>

                            <form action="{{route('provider.service.report.business.earning')}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-4 col-sm-6 mb-20 search-data__field">
                                        <label class="mb-2 fs-14 text-dark">{{translate('zone')}}</label>
                                        <select class="js-select2-custom js-select2-counting zone__select" name="zone_ids[]" multiple>
                                            @foreach($zones as $zone)
                                                <option
                                                    value="{{$zone['id']}}" {{array_key_exists('zone_ids', $queryParams) && in_array($zone['id'], $queryParams['zone_ids']) ? 'selected' : '' }}>{{$zone['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-sm-6 mb-20 search-data__field">
                                        <label class="mb-2 fs-14 text-dark">{{translate('category')}}</label>
                                        <select class="js-select2-custom js-select2-counting category__select" name="category_ids[]" multiple>
                                            @foreach($categories as $category)
                                                <option
                                                    value="{{$category['id']}}" {{array_key_exists('category_ids', $queryParams) && in_array($category['id'], $queryParams['category_ids']) ? 'selected' : '' }}>{{$category['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-sm-6 mb-20 search-data__field">
                                        <label class="mb-2 fs-14 text-dark">{{translate('sub_category')}}</label>
                                        <select class="js-select2-custom js-select2-counting sub-category__select" name="sub_category_ids[]"
                                                multiple>
                                            @foreach($subCategories as $subCategory)
                                                <option
                                                    value="{{$subCategory['id']}}" {{array_key_exists('sub_category_ids', $queryParams) && in_array($subCategory['id'], $queryParams['sub_category_ids']) ? 'selected' : '' }}>{{$subCategory['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-sm-6 mb-20 search-data__field">
                                        <label class="mb-2 fs-14 text-dark">{{translate('date_range')}}</label>
                                        <select class="js-select h-40 fs-12 form-control" id="date-range" name="date_range">
                                            <option value="0" disabled selected>{{translate('Date_Range')}}</option>
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
                                    <div class="col-lg-4 col-sm-6 {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='custom_date'?'':'d-none'}} align-self-end"
                                        id="from-filter__div">
                                        <div class="form-floating mb-30">
                                            <label for="from" class="mb-2 text--clr fs-14">{{translate('From')}}</label>
                                            <input type="date" class="form-control" id="from" name="from"
                                                   value="{{array_key_exists('from', $queryParams)?$queryParams['from']:''}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6 {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='custom_date'?'':'d-none'}} align-self-end"
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
                                <div class="card justify-content-center flex-row gap-3 p-30 flex-wrap flex-grow-1">
                                    <img width="35" class="avatar"
                                 src="{{asset('public/assets/admin')}}/img/net-profit.png" alt="">
                                    <div class="">
                                        <h2 class="fs-24 lh-1 m-0">{{\App\CentralLogics\Helpers::format_currency(array_sum($chartData['net_profit']))}}</h2>
                                        <span class="fs-12 lh--1">{{translate('Net_Profit')}}</span>
                                    </div>
                                </div>

                                <div class="card justify-content-center flex-row gap-3 p-30 flex-wrap flex-grow-1">
                                    <img width="35" class="avatar"
                                         src="{{asset('public/assets/admin')}}/img/report-earning.png" alt="">
                                    <div class="">
                                        <h2 class="fs-24 lh-1 m-0">{{\App\CentralLogics\Helpers::format_currency(array_sum($chartData['total_earning']))}}</h2>
                                        <span class="fs-12 lh--1">{{translate('Total_Earnings')}}</span>
                                    </div>
                                </div>

                                <div class="card justify-content-center flex-row gap-3 p-30 flex-wrap flex-grow-1">
                                    <img width="35" class="avatar"
                                        src="{{asset('public/assets/admin')}}/img/report-expense.png" alt="">
                                    <div class="">
                                        <h2 class="fs-24 lh-1 m-0">{{\App\CentralLogics\Helpers::format_currency(array_sum($chartData['total_expense']))}}</h2>
                                        <span class="fs-12 lh--1">{{translate('Total_Expenses')}}</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-xl-9">
                            <div class="card">
                                <div class="card-body ps-0">
                                    <h4 class="ps-20">{{translate('Earning_Statistics')}}</h4>
                                    <div id="apex_line-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-body p-0">
                            <div class="data-table-top py-3 px-3 d-flex align-items-center flex-wrap gap-3 justify-content-between">
                                <form action="{{url()->current()}}" class="search-form rounded overflow-hidden d-flex align-items-center search-form_style-two" method="GET">
                                    <div class="input-group d-flex search-form__input_group">
                                        <!-- <span class="search-form__icon">
                                            <span class="material-icons">search</span>
                                        </span> -->
                                        <input type="search" class="theme-input-style form-control rounded-0 h-40 search-form__input"
                                               value="{{array_key_exists('search', $queryParams)?$queryParams['search']:''}}" name="search"
                                               placeholder="{{translate('search_by_Booking_ID')}}">
                                    </div>
                                    <button type="submit" class="btn px-sm-3 px-2  btn--primary h-40 rounded-0"><i class="tio-search"></i></button>
                                </form>
                                <div class="d-flex align-items-center justiy-content-end gap-3 flex-wrap">
                                    <div class="d-flex flex-wrap align-items-center gap-3">
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-sm text-capitalize min-height-40 font-medium rounded border text--title dropdown-toggle"
                                                data-toggle="dropdown">
                                                <i class="tio-download-to"></i> {{translate('Export')}}
                                            </button>
                                            <ul class="dropdown-menu z--2 bg-white dropdown-menu-lg dropdown-menu-right">
                                                <li><a class="dropdown-item"
                                                    href="{{route('provider.service.report.business.earning.download').'?'.http_build_query($queryParams)}}">{{translate('Excel')}}</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive pb-0">
                                <table class="table align-middle table-borderless align-middle-cus m-0">
                                    <thead class="text-nowrap z--0" data-bg-color="#F3F8F8">
                                        <tr>
                                            <th class="align-middle">{{translate('SL')}}</th>
                                            <th class="align-middle">{{translate('Booking_ID')}}</th>
                                            <th class="align-middle">{{translate('Booking_Amount')}}</th>

                                            <th class="align-middle">{{translate('Total_Service_Discount')}}</th>
                                            <th class="align-middle">{{translate('Provider_Paid_From')}} <br> {{translate('Total_Service_Discount')}}</th>
                                            <th class="align-middle">{{translate('Total_Coupon_Discount')}}</th>
                                            <th class="align-middle">{{translate('Provider_Paid_From')}} <br> {{translate('Total_Coupon_Discount')}}</th>
                                            <th class="align-middle">{{translate('Total_Campaign_Discount')}}</th>
                                            <th class="align-middle">{{translate('Provider_Paid_From')}} <br> {{translate('Total_Campaign_Discount')}}</th>

                                            <th class="align-middle">{{translate('Subtotal')}}</th>
                                            <th class="align-middle">{{translate('VAT_/_Tax')}}</th>
                                            <th class="align-middle">{{translate('Admin_Commission')}}</th>
                                            <th class="align-middle">{{translate('Provider_Net_Income')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($bookings as $key=>$booking)
                                        @php($provider_total_expense = ($booking->booking_details_amounts->discount_by_provider??0) + ($booking->booking_details_amounts->coupon_discount_by_provider??0) + ($booking->booking_details_amounts->campaign_discount_by_provider??0))
                                        @php($provider_total_earning = $booking->booking_details_amounts->provider_earning??0)
                                        @php($provider_net_profit = $provider_total_earning - $booking->extra_fee)

                                        <tr>
                                            <td>{{$bookings->firstitem()+$key}}</td>
                                            <td>{{$booking['id']}}</td>
                                            <td>{{\App\CentralLogics\Helpers::format_currency($booking['total_booking_amount'])}}</td>

                                            <td>{{\App\CentralLogics\Helpers::format_currency($booking['total_discount_amount'])}}</td>
                                            <td>{{\App\CentralLogics\Helpers::format_currency($booking->booking_details_amounts->discount_by_provider??0)}}</td>
                                            <td>{{\App\CentralLogics\Helpers::format_currency($booking['total_coupon_discount_amount'])}}</td>
                                            <td>{{\App\CentralLogics\Helpers::format_currency($booking->booking_details_amounts->coupon_discount_by_provider??0)}}</td>
                                            <td>{{\App\CentralLogics\Helpers::format_currency($booking['total_campaign_discount_amount'])}}</td>
                                            <td>{{\App\CentralLogics\Helpers::format_currency($booking->booking_details_amounts->campaign_discount_by_provider??0)}}</td>

                                            <td>{{\App\CentralLogics\Helpers::format_currency($booking['total_booking_amount'])}}</td>
                                            <td>{{\App\CentralLogics\Helpers::format_currency($booking['total_tax_amount'])}}</td>
                                            <td>{{\App\CentralLogics\Helpers::format_currency(($booking->booking_details_amounts->admin_commission??0) + $booking->extra_fee)}}</td>
                                            <td>{{\App\CentralLogics\Helpers::format_currency($provider_net_profit)}}</td>
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
                            <div class="d-flex justify-content-end pt-3">
                                {!! $bookings->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="formulaModal" tabindex="-1" aria-labelledby="formulaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="{{asset('public/assets/admin-module')}}/img/media/formula.png" class="dark-support"
                         alt="">
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script_2')

<script src="{{asset('public/assets/admin')}}/js/apex-charts/apexcharts.js"></script>

    <script>
        "use strict";

        $(document).ready(function () {
            $('.zone__select').select2({
                placeholder: "{{translate('Select_zone')}}",
            });
            $('.category__select').select2({
                placeholder: "{{translate('Select_category')}}",
            });
            $('.sub-category__select').select2({
                placeholder: "{{translate('Select_sub_category')}}",
            });
        });

        $(document).ready(function () {
            $('#date-range').on('change', function () {
                //show 'from' & 'to' div
                if (this.value === 'custom_date') {
                    $('#from-filter__div').removeClass('d-none');
                    $('#to-filter__div').removeClass('d-none');
                }

                //hide 'from' & 'to' div
                if (this.value !== 'custom_date') {
                    $('#from-filter__div').addClass('d-none');
                    $('#to-filter__div').addClass('d-none');
                }
            });
        });

        var options = {
            series: [
                {
                    name: "{{translate('net_profit')}}",
                    data: {{json_encode($chartData['net_profit'])}}
                },
                {
                    name: "{{translate('total_earning')}}",
                    data: {{json_encode($chartData['total_earning'])}}
                },
                {
                    name: "{{translate('total_expense')}}",
                    data: {{json_encode($chartData['total_expense'])}}
                },
            ],
            chart: {
                height: 278,
                type: 'line',
                dropShadow: {
                    enabled: true,
                    color: '#000',
                    top: 18,
                    left: 7,
                    blur: 10,
                    opacity: 0.2
                },
                toolbar: {
                    show: false
                }
            },
            colors: ['#A7C9E8', '#67CA93', '#67cab8'],
            dataLabels: {
                enabled: true,
            },
            stroke: {
                curve: 'smooth',
            },
            grid: {
                xaxis: {
                    lines: {
                        show: true
                    }
                },
                yaxis: {
                    lines: {
                        show: true
                    }
                },
                borderColor: '#CAD2FF',
                strokeDashArray: 5,
            },
            markers: {
                size: 1
            },
            theme: {
                mode: 'light',
            },
            xaxis: {
                categories: {{json_encode($chartData['timeline'])}}
            },
            legend: {
                position: 'top',
                horizontalAlign: 'center',
                floating: true,
                offsetY: 0,
                offsetX: 0
            },
            padding: {
                top: 0,
                right: 0,
                bottom: 200,
                left: 10
            },
        };

        var chart = new ApexCharts(document.querySelector("#apex_line-chart"), options);
        chart.render();
    </script>
@endpush
