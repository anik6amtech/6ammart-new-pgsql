@extends('layouts.admin.app')

@section('title',translate('Keyword_Search_Analytics'))

@push('css_or_js')

@endpush

@section('content')
    <div class="main-content content">
        <div class="container-fluid">
            <div class="page-title-wrap mb-3 mt-3">
                <h2 class="page-title">{{translate('Keyword_Search_Analytics')}}</h2>
            </div>

            <div class="row g-3">
                <div class="col-lg-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex flex-wrap justify-content-between gap-3">
                                <h4>{{translate('Trending_Keywords')}}</h4>
                                <div class="select-wrap d-flex flex-wrap gap-10">
                                    <select class="form-control trending-keywords__select">
                                        <option value="" disabled selected>{{translate('Select_Date_Range')}}</option>
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
                                    </select>
                                </div>
                            </div>
                            @if(count($graph_data['count']) < 1 && count($graph_data['keyword']) < 1)
                                <div class="text-center py-4">{{translate('No data available')}}</div>
                            @endif
                            <div id="apex_radial-bar-chart"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex flex-wrap justify-content-between gap-3">
                                <h4>{{translate('Zone_Wise_Search_Volume')}}</h4>
                                <div class="select-wrap d-flex flex-wrap gap-10">
                                    <select class="form-control w-100 zone-search-volume__select" id="date-range"
                                            name="date_range_2">
                                        <option value="" disabled selected>{{translate('Select_Date_Range')}}</option>
                                        <option
                                            value="all_time" {{array_key_exists('date_range_2', $queryParams) && $queryParams['date_range_2']=='all_time'?'selected':''}}>{{translate('All_Time')}}</option>
                                        <option
                                            value="this_week" {{array_key_exists('date_range_2', $queryParams) && $queryParams['date_range_2']=='this_week'?'selected':''}}>{{translate('This_Week')}}</option>
                                        <option
                                            value="last_week" {{array_key_exists('date_range_2', $queryParams) && $queryParams['date_range_2']=='last_week'?'selected':''}}>{{translate('Last_Week')}}</option>
                                        <option
                                            value="this_month" {{array_key_exists('date_range_2', $queryParams) && $queryParams['date_range_2']=='this_month'?'selected':''}}>{{translate('This_Month')}}</option>
                                        <option
                                            value="last_month" {{array_key_exists('date_range_2', $queryParams) && $queryParams['date_range_2']=='last_month'?'selected':''}}>{{translate('Last_Month')}}</option>
                                        <option
                                            value="last_15_days" {{array_key_exists('date_range_2', $queryParams) && $queryParams['date_range_2']=='last_15_days'?'selected':''}}>{{translate('Last_15_Days')}}</option>
                                        <option
                                            value="this_year" {{array_key_exists('date_range_2', $queryParams) && $queryParams['date_range_2']=='this_year'?'selected':''}}>{{translate('This_Year')}}</option>
                                        <option
                                            value="last_year" {{array_key_exists('date_range_2', $queryParams) && $queryParams['date_range_2']=='last_year'?'selected':''}}>{{translate('Last_Year')}}</option>
                                        <option
                                            value="last_6_month" {{array_key_exists('date_range_2', $queryParams) && $queryParams['date_range_2']=='last_6_month'?'selected':''}}>{{translate('Last_6_Month')}}</option>
                                        <option
                                            value="this_year_1st_quarter" {{array_key_exists('date_range_2', $queryParams) && $queryParams['date_range_2']=='this_year_1st_quarter'?'selected':''}}>{{translate('This_Year_1st_Quarter')}}</option>
                                        <option
                                            value="this_year_2nd_quarter" {{array_key_exists('date_range_2', $queryParams) && $queryParams['date_range_2']=='this_year_2nd_quarter'?'selected':''}}>{{translate('This_Year_2nd_Quarter')}}</option>
                                        <option
                                            value="this_year_3rd_quarter" {{array_key_exists('date_range_2', $queryParams) && $queryParams['date_range_2']=='this_year_3rd_quarter'?'selected':''}}>{{translate('This_Year_3rd_Quarter')}}</option>
                                        <option
                                            value="this_year_4th_quarter" {{array_key_exists('date_range_2', $queryParams) && $queryParams['date_range_2']=='this_year_4th_quarter'?'selected':''}}>{{translate('this_year_4th_quarter')}}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mt-4">
                                <div class="row gy-3">
                                    <div class="col-lg-5">
                                        <div
                                            class="bg-light h-100 rounded d-flex justify-content-center align-items-center p-3">
                                            <div class="bg-light bg-adjustment-searchkey d-flex justify-content-center align-items-center">
                                                <div class="max-auto py-3">
                                                    <img class="mb-2" width="50"
                                                         src="{{asset('public/assets/admin')}}/img/search-setting.png"
                                                         alt="">
                                                    <h2 class="mb-2 fs-32">{{$total}}</h2>
                                                    <p class="fs-12 m-0">{{translate('Total Search Volume')}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="max-h320-auto">
                                            <ul class="common-list top_service-max after-none gap-3 d-flex flex-column">
                                                @foreach($zoneWiseVolumes as $item)
                                                    <li>
                                                        <div
                                                            class="mb-2 d-flex align-items-center justify-content-between gap-10 flex-wrap">
                                                            <span class="zone-name">{{$item['zone']['name']}}</span>
                                                            <span class="booking-count">{{with_decimal_point(($item['count']*100)/$total)}} % {{translate('search volume')}}</span>
                                                        </div>
                                                        <div class="progress">
                                                            <div class="progress-bar" role="progressbar"
                                                                 style="width: {{with_decimal_point(($item['count']*100)/$total)}}%"
                                                                 aria-valuenow="25" aria-valuemin="0"
                                                                 aria-valuemax="100"></div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-xxl-4 mt-3">
                <div class="card-body p-0">

                    <div class="data-table-top py-3 px-3 d-flex align-items-center flex-wrap gap-3 justify-content-between">
                        <div class="d-flex gap-2 fw-medium">
                            <span class="opacity-75 text-dark">{{translate('Keyword_List')}}: </span>
                            <span class="title-color text-dark">0</span>
                        </div>
                        <div class="d-flex align-items-center justiy-content-end gap-3 flex-wrap">
                            <form action="{{url()->current()}}" class="search-form rounded overflow-hidden d-flex align-items-center search-form_style-two" method="GET">
                                <div class="input-group d-flex search-form__input_group">
                                    <!-- <span class="search-form__icon">
                                        <span class="material-icons">search</span>
                                    </span> -->
                                    <input type="search" class="theme-input-style form-control rounded-0 h-40 search-form__input"
                                       value="{{$search??''}}" name="search"
                                       placeholder="{{translate('search_by_Keyword')}}">
                                </div>
                                <button type="submit" class="btn px-sm-3 px-2  btn--primary h-40 rounded-0"><i class="tio-search"></i></button>
                            </form>
{{--                            <div class="d-flex flex-wrap align-items-center gap-3">--}}
{{--                                <div class="dropdown">--}}
{{--                                    <button type="button" class="btn btn-sm text-capitalize min-height-40 font-medium rounded border text--title dropdown-toggle"--}}
{{--                                        data-toggle="dropdown">--}}
{{--                                        <i class="tio-download-to"></i> {{translate('Export')}}--}}
{{--                                    </button>--}}
{{--                                    <ul class="dropdown-menu z--2 bg-white dropdown-menu-lg dropdown-menu-right">--}}
{{--                                        <li>--}}
{{--                                            <a class="dropdown-item"--}}
{{--                                                href="{{route('admin.transactions.service.report.transaction.download').'?'.http_build_query($queryParams)}}">--}}
{{--                                                {{translate('Excel')}}--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                    </div>

                    <div class="table-responsive pb-0">
                        <table class="table m-0 align-middle-cus table-borderless">
                            <thead class="text-nowrap z--0" data-bg-color="#F3F8F8">
                            <tr>
                                <th>{{translate('SL')}}</th>
                                <th>{{translate('Keyword')}}</th>
                                <th>{{translate('Search Volume')}}</th>
                                <th>{{translate('Related Services')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($searches as $key=>$item)
                                <tr>
                                    <td>{{$searches->firstitem()+$key}}</td>
                                    <td>{{$item->keyword??''}}</td>
                                    <td>{{$item->total_volume}}</td>
                                    <td>{{$item->total_response_data_count}}</td>
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
                    <div class="d-flex justify-content-end pt-3">
                        {!! $searches->links() !!}
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

        var options = {
            series: @json($graph_data['count']),
            chart: {
                height: 350,
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    hollow: {
                        margin: 10,
                        size: '55%',
                    },
                    dataLabels: {
                        name: {
                            fontSize: '16px',
                        },
                        value: {
                            fontSize: '14px',
                        },
                        total: {
                            show: true,
                            label: 'Total',
                            formatter: function (w) {
                                return {{array_sum($graph_data['count'])}}
                            }
                        }
                    }
                }
            },
            labels: @json(count($graph_data['keyword']) > 0 ? $graph_data['keyword'] : ''),
            colors: ['#286CD1', '#FFC700', '#A2CEEE', '#79CCA5', '#FFB16D'],
            legend: {
                show: true,
                floating: false,
                fontSize: '12px',
                position: 'bottom',
                horizontalAlign: 'center',
                offsetY: -10,
                itemMargin: {
                    horizontal: 5,
                    vertical: 10
                },
                labels: {
                    useSeriesColors: true,
                },
                markers: {
                    size: 0
                },
                formatter: function (seriesName, opts) {
                    return seriesName + ":  " + opts.w.globals.series[opts.seriesIndex]
                },
            },
        };

        var chart = new ApexCharts(document.querySelector("#apex_radial-bar-chart"), options);
        chart.render();


        $(".trending-keywords__select").on('change', function () {
            if (this.value !== "") location.href = "{{route('admin.transactions.service.analytics.search.keyword')}}" + '?date_range=' + this.value + '&date_range_2=' + '{{$queryParams['date_range_2']??'all_time'}}';
        });

        $(".zone-search-volume__select").on('change', function () {
            if (this.value !== "") location.href = "{{route('admin.transactions.service.analytics.search.keyword')}}" + '?date_range=' + '{{$queryParams['date_range']??'all_time'}}' + '&date_range_2=' + this.value;
        });
    </script>
@endpush
