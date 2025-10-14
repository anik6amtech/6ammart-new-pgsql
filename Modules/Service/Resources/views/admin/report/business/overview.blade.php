@extends('layouts.admin.app')

@section('title',translate('Business_overview_Report'))

@push('css_or_js')
@endpush

@section('content')
    <div class="main-content content">
        <div class="container-fluid">
            <div class="page-title-wrap mb-3">
                <h2 class="page-title">{{translate('Business_Reports')}}</h2>
            </div>

            <div class="mb-20">
                <ul class="nav nav--tabs nav--tabs nav--pills nav--tabs__style2">
                    <li class="nav-item">
                        <a href="{{route('admin.transactions.service.report.business.overview')}}"
                           class="nav-link active">{{translate('Overview')}}</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.transactions.service.report.business.earning')}}"
                           class="nav-link">{{translate('Earning_Report')}}</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.transactions.service.report.business.expense')}}"
                           class="nav-link">{{translate('Expense_Report')}}</a>
                    </li>
                </ul>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="mb-3 fs-16 text-dark">{{translate('Search_Data')}}</div>

                    <form action="{{route('admin.transactions.service.report.business.overview')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4 col-sm-6 mb-20 search-data__field">
                                <label class="mb-2 fs-14 text-dark">{{translate('zone')}}</label>
                                <select class="js-select2-custom js-select2-counting zone__select" name="zone_ids[]" id="zone_selector__select"
                                        multiple>
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
                                <label class="mb-2 fs-14 text-dark">{{translate('sub_category')}}</label>
                                <select class="js-select2-custom js-select2-counting sub-category__select" name="sub_category_ids[]"
                                        id="sub_category_selector__select"
                                        multiple>
                                    <option value="all">{{translate('Select All')}}</option>
                                    @foreach($sub_categories as $sub_category)
                                        <option
                                            value="{{$sub_category['id']}}" {{array_key_exists('sub_category_ids', $queryParams) && in_array($sub_category['id'], $queryParams['sub_category_ids']) ? 'selected' : '' }}>{{$sub_category['name']}}</option>
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
                            <div
                                class="col-lg-4 col-sm-6 {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='custom_date'?'':'d-none'}} align-self-end"
                                id="from-filter__div">
                                <div class="mb-30">
                                    <label for="from" class="mb-2 fs-14 text-dark">{{translate('From')}}</label>
                                    <input type="date" class="form-control h-45" id="from" name="from" value="{{array_key_exists('from', $queryParams)?$queryParams['from']:''}}">
                                </div>
                            </div>
                            <div
                                class="col-lg-4 col-sm-6 {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='custom_date'?'':'d-none'}} align-self-end"
                                id="to-filter__div">
                                <div class="mb-30">
                                    <label for="to" class="mb-2 fs-14 text-dark">{{translate('To')}}</label>
                                    <input type="date" class="form-control h-45" id="to" name="to" value="{{array_key_exists('to', $queryParams)?$queryParams['to']:''}}">
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

            <div class="row gy-3 pt-4">
                <div class="col-lg-4">
                    <div class="d-flex flex-column gap-3 h-100">
                        <div class="card flex-row gap-4 h-100 p-30 flex-wrap align-items-center">
                            <img width="35" class="avatar"
                                 src="{{asset('public/assets/admin')}}/img/net-profit.png" alt="">
                            <div class="">
                                <h2 class="fs-24 lh-1 m-0">{{\App\CentralLogics\Helpers::format_currency(array_sum($chart_data['earnings']) - array_sum($chart_data['expenses']))}}</h2>
                                <span class="fs-12">{{translate('Net_Profit')}}</span>
                            </div>
                            {{--<div class="ms--auto align-self-start" data-bs-toggle="modal"
                                 data-bs-target="#formulaModal">
                                <img src="{{asset('public/assets/admin')}}/img/icons/info.svg"
                                     class="svg" alt="">
                            </div>--}}
                        </div>
                        <div class="card flex-row gap-4 h-100 p-30 flex-wrap align-items-center">
                            <img width="35" class="avatar"
                                 src="{{asset('public/assets/admin')}}/img/report-earning.png"
                                 alt="">
                            <div class="">
                                <h2 class="fs-24 lh-1 m-0">{{\App\CentralLogics\Helpers::format_currency(array_sum($chart_data['earnings']))}}</h2>
                                <span class="fs-12">{{translate('total_earning')}}</span>
                            </div>
                        </div>
                        <div class="card flex-row gap-4 h-100 p-30 flex-wrap align-items-center">
                            <img width="35" class="avatar"
                                 src="{{asset('public/assets/admin')}}/img/report-expense.png" alt="">
                            <div class="">
                                <h2 class="fs-24 lh-1 m-0">{{\App\CentralLogics\Helpers::format_currency(array_sum($chart_data['expenses']))}}</h2>
                                <span class="fs-12">{{translate('total_expense')}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card chart-space">
                        <div class="card-body ps-0">
                            <h4 class="ps-20">{{translate('Earning_Statistics')}}</h4>
                            <div id="apex_line-chart"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-body p-0">
                    <div class="data-table-top py-3 px-3 d-flex align-items-center flex-wrap gap-3 justify-content-between">
                        <div class="d-flex gap-2 fw-medium">
                            {{-- <span class="opacity-75 text-dark">{{translate('Total_Transactions')}}: </span>
                            <span class="title-color text-dark">0</span> --}}
                        </div>
                        <div class="d-flex align-items-center justiy-content-end gap-3 flex-wrap">
{{--                            <form action="{{url()->current()}}" class="search-form rounded overflow-hidden d-flex align-items-center search-form_style-two" method="GET">--}}
{{--                                <div class="input-group d-flex search-form__input_group">--}}
{{--                                    <!-- <span class="search-form__icon">--}}
{{--                                        <span class="material-icons">search</span>--}}
{{--                                    </span> -->--}}
{{--                                    <input type="search" class="theme-input-style form-control rounded-0 h-40 search-form__input"--}}
{{--                                        value="{{$queryParams['search']??''}}" name="search"--}}
{{--                                        placeholder="{{translate('search by transaction ID')}}">--}}
{{--                                </div>--}}
{{--                                <button type="submit" class="btn px-sm-3 px-2  btn--primary h-40 rounded-0"><i class="tio-search"></i></button>--}}
{{--                            </form>--}}
                            <div class="d-flex flex-wrap align-items-center gap-3">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-sm text-capitalize min-height-40 font-medium rounded border text--title dropdown-toggle"
                                        data-toggle="dropdown">
                                        <i class="tio-download-to"></i> {{translate('Export')}}
                                    </button>
                                    <ul class="dropdown-menu z--2 bg-white dropdown-menu-lg dropdown-menu-right">
                                        <li>
                                            <a class="dropdown-item" href="{{route('admin.transactions.service.report.business.overview.download').'?'.http_build_query($queryParams)}}">{{translate('Excel')}}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--<div class="data-table-top py-3 px-3 d-flex flex-wrap gap-10 justify-content-between">
                        <div></div>
                        @can('report_export')
                            <div class="d-flex flex-wrap align-items-center gap-3">
                                <div class="dropdown">
                                    <button type="button"
                                            class="btn btn--secondary text-capitalize dropdown-toggle"
                                            data-bs-toggle="dropdown">
                                        <span class="material-icons">file_download</span> {{translate('download')}}
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                        <li>
                                            <a class="dropdown-item" href="{{route('admin.transactions.service.report.business.overview.download').'?'.http_build_query($queryParams)}}">{{translate('Excel')}}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @endcan
                    </div>--}}

                    <div class="table-responsive pb-0">
                        <table class="table align-middle table-borderless align-middle-cus m-0">
                            <thead class="text-nowrap z--0" data-bg-color="#F3F8F8">
                            <tr>
                                <th class="border-0">{{translate('SL')}}</th>
                                <th class="border-0">{{translate('Duration')}}</th>
                                <th class="border-0">{{translate('Commission_Earnings')}}</th>
                                <th class="border-0">{{translate('Other_Earnings')}}</th>
                                <th class="border-0">{{translate('Total_Expenses')}}</th>
                                <th class="border-0">{{translate('Net_Profit')}}</th>
                                <th class="border-0 text--end">{{translate('Net_Profit_Rate')}} </th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($all_expenses_and_earnings as $key=>$item)
                                @php($total_earning = $item['admin_commission'])
                                @php($total_extra_fee = $item['earning'])
                                @php($total_expense = $item['discount_by_admin'] + $item['coupon_discount_by_admin'] + $item['campaign_discount_by_admin'])

                                @php($net_profit = $total_earning + $total_extra_fee -$total_expense)
                                @php($net_profit_rate = $total_earning!=0 ? ($net_profit*100)/($total_earning+$total_extra_fee) : $net_profit*100)

                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>
                                        @if($deterministic == 'month')
                                            {{DateTime::createFromFormat('!m', $item['month'])->format('F')}}
                                        @elseif($deterministic == 'week')
                                            {{$chart_data['timeline'][$key]??''}}
                                        @else
                                            {{$item[$deterministic]}}
                                        @endif
                                    </td>
                                    <td>{{\App\CentralLogics\Helpers::format_currency($item['admin_commission'])}}</td>
                                    <td>{{\App\CentralLogics\Helpers::format_currency($total_extra_fee)}}</td>
                                    <td>{{\App\CentralLogics\Helpers::format_currency($total_expense)}}</td>
                                    <td>{{\App\CentralLogics\Helpers::format_currency($net_profit)}}</td>
                                    <td class="text--end"><span class="text-success">{{\App\CentralLogics\Helpers::format_currency($net_profit_rate)}} %</span>
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
                    <img src="{{asset('public/assets/admin')}}/img/media/net_profit.png" class="dark-support"
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

        var options = {
            series: [
                {
                    name: "{{translate('Earnings')}}",
                    data: {{json_encode($chart_data['earnings'])}}
                },
                {
                    name: "{{translate('Expenses')}}",
                    data: {{json_encode($chart_data['expenses'])}}
                }
            ],
            chart: {
                height: 290,
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
                    show: true
                }
            },
            colors: ['#6F8AED', '#CAD2FF'],
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
                categories: {{json_encode($chart_data['timeline'])}}
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
