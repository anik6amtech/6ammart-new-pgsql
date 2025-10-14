@extends('layouts.admin.app')

@section('title', translate('messages.Service Module Dashboard'))

@push('css_or_js')
    <!-- Apex Charts -->
    <script src="{{ asset('/public/assets/admin/js/apex-charts/apexcharts.js') }}"></script>
    <!-- Apex Charts -->
@endpush

@section('content')
@php($mod = \App\Models\Module::find(Config::get('module.current_module_id')))
<div class="content container-fluid">
    @if(auth('admin')->user()->role_id == 1)
        <!-- Page Header -->
        <div class="page-header mb-1">
            <div class="row align-items-center py-2">
                <div class="col-sm mb-2 mb-sm-0">
                    <div class="d-flex align-items-sm-center align-items-start">
                        <img width="38" class="onerror-image" data-onerror-image="{{asset('Modules/Service/public/assets/img/admin/location-car.png')}}" alt="img"
                            src="{{$mod->icon_full_url }}">
                        <div class="w-0 flex-grow pl-2">
                            <h2 class="page-header-title mb-0">{{translate('On Demand Dashboard')}}, {{auth('admin')->user()->f_name}}.</h2>
                            <p class="page-header-text m-0">{{translate('Monitor your service business')}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-auto min--280">
                    {{-- <select name="zone_id" class="form-control js-select2-custom">
                        <option value="all">{{ translate('messages.All_Zones') }}</option>
                        <option value="1">
                            Select your Zone
                        </option>
                        <option value="2">
                            Select your Zone
                        </option>
                        <option value="3">
                            Select your Zone
                        </option>
                        <option value="4">
                            Select your Zone
                        </option>
                    </select> --}}
                </div>
            </div>
        </div>
        <!-- Stats -->
        <div class="card mb-3">
            <div class="card-body pt-0">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 py-2 mb-1">
                    <h5 class="card-header-title">
                        {{translate('Earning Statisticsss')}}
                        {{-- <span class="badege badge-soft-info py-1 px-2 border-0 rounded fz-12px">Zone : All</span> --}}
                    </h5>
                    {{-- <select class="custom-select border-0 shadow-0 py-0 text-center w-auto user_overview_stats_update" name="">
                        <option value="all">
                            {{translate('All Time')}}
                        </option>
                        <option value="1">
                            {{translate('messages.example text')}}
                        </option>
                        <option value="2">
                            {{translate('messages.example text')}}
                        </option>
                        <option value="3">
                            {{translate('messages.example text')}}
                        </option>
                    </select> --}}
                </div>
                <div class="row g-2">
                    <div class="col-sm-6 col-lg-3">
                        <div class="static__card rounded-8 p-20 d-flex align-items-center justify-content-between gap-2" data-bg-color="#EAFBFF">
                            <div>
                                <h2 class="count mb-1 fz-24">{{ \App\CentralLogics\Helpers::format_currency(data_get($data[0], 'top_cards.total_commission_earning', 0) + data_get($data[0], 'top_cards.total_fee_earning', 0) + data_get($data[0], 'top_cards.total_subscription_earning', 0))}}</h2>
                                <div class="subtxt fz--14px">{{ translate('Total Earning') }}</div>
                            </div>
                            <img src="{{asset('Modules/Service/public/assets/img/admin/ride-earning.png')}}" alt="dashboard/grocery">
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="static__card rounded-8 p-20 d-flex align-items-center justify-content-between gap-2" data-bg-color="#E6F6EE">
                            <div>
                                <h2 class="count mb-1 fz-24">{{\App\CentralLogics\Helpers::format_currency(data_get($data[0], 'top_cards.total_commission_earning', 0))}}</h2>
                                <div class="subtxt fz--14px">{{ translate('Commission Earning') }}</div>
                            </div>
                            <img src="{{asset('Modules/Service/public/assets/img/admin/commuission-earning.png')}}" alt="dashboard/grocery">
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="static__card rounded-8 p-20 d-flex align-items-center justify-content-between gap-2" data-bg-color="#FFF7E7">
                            <div>
                                <h2 class="count mb-1 fz-24">{{\App\CentralLogics\Helpers::format_currency(data_get($data[0], 'top_cards.total_fee_earning', 0))}}</h2>
                                <div class="subtxt fz--14px">{{ translate('Total Fee Earning') }}</div>
                            </div>
                            <img src="{{asset('Modules/Service/public/assets/img/admin/booking-earning.png')}}" alt="dashboard/grocery">
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="static__card rounded-8 p-20 d-flex align-items-center justify-content-between gap-2" data-bg-color="#FFF2F2">
                            <div>
                                <h2 class="count mb-1 fz-24">{{$data[0]['top_cards']['total_provider']}}</h2>
                                <div class="subtxt fz--14px">{{ translate('Providers') }}</div>
                            </div>
                            <img src="{{asset('Modules/Service/public/assets/img/admin/providers.png')}}" alt="dashboard/grocery">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card my-3">
            <div class="card-body">
                <div class="d-flex flex-wrap justify-content-between gap-2 mb-4">
                    <div class="d-flex flex-column gap-1">
                        <h3 class="text-capitalize" id="chart_total_earning_sum"></h3>
                        <p class="mb-0">{{translate('Gross Earnings')}}</p>
                    </div>
                    <div class="chart--label __chart-label p-0 d-flex align-items-center">
                        <span class="indicator fs-16" data-bg-color="#00aa6d"></span>
                        <span class="info">
                                {{ translate('Earnings statistics') }}
                        </span>
                    </div>
                    <div class="d-flex flex-wrap flex-sm-nowrap gap-2 align-items-center">
                        <select class="form-control border-0 js-select update-chart">
                            @php($from_year=date('Y'))
                            @php($to_year=$from_year-10)
                            @while($from_year!=$to_year)
                                <option
                                    value="{{$from_year}}" {{session()->has('dashboard_earning_graph_year') && session('dashboard_earning_graph_year') == $from_year?'selected':''}}>
                                    {{$from_year}}
                                </option>
                                @php($from_year--)
                            @endwhile
                        </select>
                    </div>
                </div>
                <div id="commission-overview-board">
                    {{-- <div id="grow-sale-chart"></div> --}}
                    <div id="apex_line-chart"></div>
                </div>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-md-6 col-lg-4">
                <div class="card h-100">
                    <div class="card-header shadow-sm border-0 d-flex justify-content-between gap-10 py-lg-4 py-3">
                        <h5 class="mb-0">{{ translate('Top Providers') }}</h5>
                        <a href="{{ route('admin.service.provider.list') }}" class="btn-link font-semibold">{{ translate('View all') }}</a>
                    </div>
                    <div class="card-body">
                        <ul class="common-list p-0 mb-0 d-flex flex-column gap-30px">
                            @forelse($data[4]['top_providers'] as $provider)
                                <li class="d-flex flex-wrap gap-2 align-items-center justify-content-between cursor-pointer recent-booking-redirect" data-route="{{route('admin.service.provider.details',[$provider->id])}}">
                                    <div class="media align-items-center gap-3">
                                        <div class="avatar">
                                            <img width="48" height="48" src="{{ $provider->logo_full_path }}" alt="img" class="rounded-circle">
                                        </div>
                                        <div class="media-body ">
                                            <h5 class="d-flex mb-0 align-items-center">{{ \Illuminate\Support\Str::limit($provider->company_name, 20) }}</h5>
                                            <p class="fz-12px mb-0 pt-1">{{ $provider->phone }}</p>
                                        </div>
                                    </div>
                                    <span class="text-success d-flex align-items-center gap-1 font-semibold">
                                        <i class="tio-star"></i>{{ $provider->avg_rating }}
                                    </span>
                                </li>
                            @empty
                                <div class="text-center p-4">
                                    <div class="empty--data">
                                        <img src="{{asset('/public/assets/admin/svg/illustrations/sorry.svg')}}" alt="public">
                                        <h5>
                                            {{translate('no_data_found')}}
                                        </h5>
                                    </div>
                                </div>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100">
                    <div class="card-header shadow-sm border-0 d-flex justify-content-between gap-10 py-lg-4 py-3">
                        <h5 class="mb-0">{{ translate('Recent Bookings') }}</h5>
                        <a href="{{ route('admin.service.booking.list') }}?booking_status=pending&service_type=all" class="btn-link font-semibold">{{ translate('View all') }}</a>
                    </div>
                    <div class="card-body">
                        <ul class="common-list p-0 mb-0 d-flex flex-column gap-30px">
                            @forelse($data[3]['bookings'] as $booking)
                                <li class="d-flex flex-sm-nowrap flex-wrap gap-3 align-items-center justify-content-between cursor-pointer recent-booking-redirect" data-route="{{ route('admin.service.booking.details', [$booking->id, 'web_page' => 'details']) }}">
                                    <div class="media align-items-center gap-3">
                                        <div class="avatar">
                                            <img width="48" height="48" src="{{ $booking->detail[0]->service?->thumbnail_full_path }}" alt="img" class="rounded-8">
                                        </div>
                                        <div class="media-body ">
                                            <h5 class="mb-0">{{translate('Booking')}}#  {{$booking->id}} </h5>
                                            <p class="fz-12px mb-0 pt-1">{{date('d-m-Y, H:i a',strtotime($booking->created_at))}}</p>
                                        </div>
                                    </div>
                                    @if($booking->booking_status == 'ongoing')
                                        <span class="badge rounded-pill py-2 px-3 text-capitalize" data-text-color="#2B95FF" data-bg-color="#2B95FF1A">{{ translate('Ongoing') }}</span>
                                    @elseif($booking->booking_status == 'accepted')
                                        <span class="badge rounded-pill py-2 px-3 text-capitalize" data-text-color="#2B95FF" data-bg-color="#2B95FF1A">{{ translate('Accepted') }}</span>
                                    @elseif($booking->booking_status == 'pending')
                                        <span class="badge rounded-pill py-2 px-3 text-capitalize" data-text-color="#4153B3" data-bg-color="#4153B31A">{{ translate('Pending') }}</span>
                                    @elseif($booking->booking_status == 'completed')
                                        <span class="badge rounded-pill py-2 px-3 text-capitalize" data-text-color="#28A745" data-bg-color="#28A7451A">{{ translate('Completed') }}</span>
                                    @elseif($booking->booking_status == 'canceled')
                                        <span class="badge badge--cancel rounded-pill py-2 px-3 text-capitalize" data-text-color="#DC3545" data-bg-color="#DC35451A">{{ translate('Canceled') }}</span>

                                    @endif
                                </li>
                            @empty
                                <div class="text-center p-4">
                                    <div class="empty--data">
                                        <img src="{{asset('/public/assets/admin/svg/illustrations/sorry.svg')}}" alt="public">
                                        <h5>
                                            {{translate('no_data_found')}}
                                        </h5>
                                    </div>
                                </div>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-4">
                <div class="card h-100">
                    <div class="card-header shadow-sm border-0 d-flex justify-content-between gap-10 py-lg-3 py-2">
                        <div>
                            <h5 class="mb-1">{{translate('recent_transactions')}}</h5>
                            @if(isset($data[2]['recent_transactions']) && count($data[2]['recent_transactions']) > 0)
                                <div class="d-flex align-items-center gap-2 fz-12px">
                                    <i class="tio-arrow-upward text-success"></i>
                                    {{$data[2]['this_month_trx_count']}} {{translate('transactions_this_month')}}
                                </div>
                            @endif
                        </div>
                        <a href="{{ route('admin.transactions.service.report.transaction') }}?transaction_type=all" class="btn-link font-semibold">{{translate('View all')}}</a>
                    </div>
                    <div class="card-body">
                        <ul class="common-list p-0 mb-0 d-flex flex-column gap-2">
                            @forelse($data[2]['recent_transactions']->take(5) as $transaction)
                                <li class="bg-light rounded py-2 px-3 d-flex flex-sm-nowrap flex-wrap gap-2 align-items-center justify-content-between" data-route="">
                                    <div class="media-body ">
                                        @if($transaction->debit>0)
                                            <h5 class="mb-0">{{\App\CentralLogics\Helpers::format_currency($transaction->debit)}}</h5>
                                            <p class="fz-12px mb-0 pt-1">{{translate('debited_from')}} {{ translate($transaction->from_user_account) }}</p>
                                        @else
                                            <h5 class="mb-0">{{\App\CentralLogics\Helpers::format_currency($transaction->credit)}}</h5>
                                            <p class="fz-12px mb-0 pt-1">{{translate('credited_to')}} {{ translate($transaction->to_user_account) }}</p>
                                        @endif
                                    </div>
                                    <div class="d-flex flex-column gap-0">
                                        <span class="fz-12px d-block">{{date('d M H:i a',strtotime($transaction->created_at))}}</span>
                                        <span class="fz-12px d-block text-title"> {{translate('TrxID')}} #{{ $transaction->id }}</span>
                                    </div>
                                </li>
                            @empty
                                <div class="text-center p-4">
                                    <div class="empty--data">
                                        <img src="{{asset('/public/assets/admin/svg/illustrations/sorry.svg')}}" alt="public">
                                        <h5>
                                            {{translate('no_data_found')}}
                                        </h5>
                                    </div>
                                </div>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title">{{translate('messages.welcome')}}, {{auth('admin')->user()->f_name}}.</h1>
                    <p class="page-header-text">{{translate('messages.employee_welcome_message')}}</p>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection


@push('script_2')
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function () {
            const initialTotalSell = [1600, 200, 1400, 300, 400, 400, 1600, 500, 1500, 99, 400, 1200];
            const initialLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

            initializeAreaChart(initialTotalSell, initialLabels);
        });
        let apexChartInstance = null;
        function initializeAreaChart(totalSell, labels) {
            const options = {
                series: [
                    {
                        name: 'Total Earning',
                        data: totalSell
                    },
                    {
                        name: 'Commission Earning',
                        data: new Array(labels.length).fill(632) // Flat line
                    },
                    {
                        name: 'Booking Earning',
                        data: new Array(labels.length).fill(632) // Flat line
                    }
                ],
                chart: {
                    height: 350,
                    type: 'area',
                    toolbar: { show: false }
                },
                legend: {
                    show: false,
                },
                colors: ['#00aa6d', '#ffaa00', '#007bff'], // Add distinct colors
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 2
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.6,
                        opacityTo: 0.1,
                        stops: [0, 90, 100]
                    }
                },
                xaxis: {
                    categories: labels
                },
                yaxis: {
                    labels: {
                        show: true
                    },
                    axisBorder: {
                        show: true
                    },
                    axisTicks: {
                        show: true
                    },
                },
                tooltip: {
                    x: {
                        format: 'MMM'
                    }
                }
            };

            if (apexChartInstance) {
                apexChartInstance.destroy();
            }

            apexChartInstance = new ApexCharts(document.querySelector("#grow-sale-chart"), options);
            apexChartInstance.render();
        }
    </script> --}}

    {{-- <script src="{{asset('public/assets/admin-module')}}/plugins/apex/apexcharts.min.js"></script> --}}
    <script>
        'use strict';

        $('.js-select.update-chart').on('change', function() {
            var selectedYear = $(this).val();
            localStorage.setItem('selectedYear', selectedYear); // Store the selected year in local storage
            update_chart(selectedYear);
        });

        // On page load, check if a year is stored in local storage
        $(document).ready(function() {
            var storedYear = localStorage.getItem('selectedYear');
            if (storedYear) {
                $('.js-select.update-chart').val(storedYear); // Set the select to the stored year
                update_chart(storedYear); // Update the chart with the stored year
            }
        });

        var options = {
            series: [
                {
                    name: "{{translate('total_earnings')}}",
                    data: @json($chart_data['total_earning'])
                },
                {
                    name: "{{translate('admin_commission')}}",
                    data: @json($chart_data['commission_earning'])
                }
            ],
            chart: {
                height: 386,
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
            yaxis: {
                labels: {
                    offsetX: 0,
                    formatter: function (value) {
                        return Math.abs(value)
                    }
                },
            },
            colors: ['#4FA7FF', '#82C662'],
            dataLabels: {
                enabled: false,
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
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            legend: {
                position: 'bottom',
                horizontalAlign: 'center',
                floating: false,
                offsetY: -10,
                offsetX: 0,
                itemMargin: {
                    horizontal: 10,
                    vertical: 10
                },
            },
            padding: {
                top: 0,
                right: 0,
                bottom: 200,
                left: 10
            },
        };

        if (localStorage.getItem('dir') === 'rtl') {
            options.yaxis.labels.offsetX = -20;
        }

        var chart = new ApexCharts(document.querySelector("#apex_line-chart"), options);
        chart.render();

        function update_chart(year) {
            var url = '{{route('admin.service.update-dashboard-earning-graph')}}?year=' + year;

            $.getJSON(url, function (response) {
                chart.updateSeries([{
                    name: "{{translate('total_earning')}}",
                    data: response.total_earning
                }, {
                    name: "{{translate('admin_commission')}}",
                    data: response.commission_earning
                }]);

                $('#chart_total_earning_sum').text(response.total_earning_sum);
            });

        }


        $(".provider-redirect").on('click', function(){
            location.href = $(this).data('route');
        });

        $(".recent-booking-redirect").on('click', function(){
            location.href = $(this).data('route');
        });
    </script>


@endpush
