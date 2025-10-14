@extends('service::provider.layouts.app')

@section('title', translate('messages.Service Module Dashboard'))

@section('content')

    <div class="content container-fluid">
        @if(auth('provider')->check())
            <!-- Page Header -->
            <div class="page-header mb-1">
                <div class="row align-items-center py-2">
                    {{-- <div class="col-sm mb-2 mb-sm-0">
                        <div class="d-flex align-items-sm-center align-items-start">
                            <img src="{{asset('Modules/Service/public/assets/img/admin/location-car.png')}}" alt="img">
                            <div class="w-0 flex-grow pl-2">
                                <h2 class="page-header-title mb-0">{{translate('messages.On Demand Dashboard')}}, {{auth('provider')->user()->company_name}}.</h2>
                                <p class="page-header-text m-0">{{translate('messages.Monitor your ride sharing business')}}</p>
                            </div>
                        </div>
                    </div> --}}
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
                            {{translate('Business Analytics')}}
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
                            <div class="static__card rounded-8 p-20 d-flex align-items-center justify-content-between gap-2" data-bg-color="#FFF7E7">
                                <div>
                                    <h2 class="count mb-1 fz-24">{{\App\CentralLogics\Helpers::format_currency($data[0]['top_cards']['total_earning'])}}</h2>
                                    <div class="subtxt fz--14px">{{ translate('Total earning') }}</div>
                                </div>
                                <img src="{{asset('Modules/Service/public/assets/img/admin/booking-earning.png')}}" alt="dashboard/grocery">
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="static__card rounded-8 p-20 d-flex align-items-center justify-content-between gap-2" data-bg-color="#EAFBFF">
                                <div>
                                    <h2 class="count mb-1 fz-24">{{$data[0]['top_cards']['total_subscribed_services']}}</h2>
                                    <div class="subtxt fz--14px">{{ translate('Total subscription') }}</div>
                                </div>
                                <img src="{{asset('Modules/Service/public/assets/img/admin/ride-earning.png')}}" alt="dashboard/grocery">
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="static__card rounded-8 p-20 d-flex align-items-center justify-content-between gap-2" data-bg-color="#E6F6EE">
                                <div>
                                    <h2 class="count mb-1 fz-24">{{$data[0]['top_cards']['total_service_man']}}</h2>
                                    <div class="subtxt fz--14px">{{ translate('Total service man') }}</div>
                                </div>
                                <img src="{{asset('Modules/Service/public/assets/img/admin/commuission-earning.png')}}" alt="dashboard/grocery">
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="static__card rounded-8 p-20 d-flex align-items-center justify-content-between gap-2" data-bg-color="#FFF2F2">
                                <div>
                                    <h2 class="count mb-1 fz-24">{{$data[0]['top_cards']['total_booking_served']}}</h2>
                                    <div class="subtxt fz--14px">{{ translate('Total booking served') }}</div>
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
                            <select class="form-control border-0 js-select update-chart" onchange="update_chart(this.value)">
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
                    <div id="commission-overview-board" class="apex-line-chart-container">
                        {{-- <div id="grow-sale-chart"></div> --}}
                        <div id="apex_line-chart"></div>
                    </div>
                </div>
            </div>
            <div class="row g-3">
            <div class="col-md-6 col-lg-6">
                <div class="card h-100">
                    <div class="card-header shadow-sm border-0 d-flex justify-content-between gap-10 py-lg-4 py-3">
                        <h5 class="mb-0">{{ translate('Serviceman List') }}</h5>
                        <a href="{{ route('provider.service.serviceman.index') }}" class="btn-link font-semibold">{{ translate('View all') }}</a>
                    </div>
                    <div class="card-body">
                        <ul class="common-list p-0 mb-0 d-flex flex-column gap-30px">
                            @if(count($data[5]['serviceman_list']) < 1)
                                <span class="opacity-75">{{translate('No_active_servicemen_are_available')}}</span>
                            @endif
                            @foreach($data[5]['serviceman_list'] as $key=>$serviceman)
                                <li class="d-flex flex-wrap gap-2 align-items-center justify-content-between cursor-pointer recent-booking-redirect redirect-link" data-route="{{route('provider.service.serviceman.details', [$serviceman['id']])}}">
                                    <div class="media align-items-center gap-3">
                                        <div class="avatar">
                                            <img width="48" height="48" src="{{$serviceman->profile_image_full_path}}" alt="img" class="rounded">
                                        </div>
                                        <div class="media-body ">
                                            <h5 class="d-flex mb-0 align-items-center">{{Str::limit($serviceman->first_name,30) }}</h5>
                                            <p class="fz-12px mb-0 pt-1">{{ $serviceman->phone }}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center gap-1" data-text-color="#1B1A40">
                                        <span class="text-success d-flex align-items-center gap-1 font-semibold">
                                            <i class="tio-star"></i>{{ $serviceman->avg_rating }}
                                        </span>
                                        ({{ $serviceman->rating_count }})
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6">
                <div class="card h-100">
                    <div class="card-header shadow-sm border-0 d-flex justify-content-between gap-10 py-lg-4 py-3">
                        <div>
                            <h5 class="mb-0">Recent Activities</h5>
                            {{-- <ul class="nav nav--tabs custom-activate-tab gap-2 gap-sm-4">
                                <li class="nav-item cursor-pointer">
                                    <a class="nav-link px-0 active" data-bs-toggle="tab" id="normal-tab"
                                        data-bs-target="#normal-bookings">{{translate('Normal_Bookings')}}</a>
                                </li>
                                <li class="nav-item cursor-pointer">
                                    <a class="nav-link px-0" data-bs-toggle="tab" id="customize-tab"
                                        data-bs-target="#customize-bookings">{{translate('Customize_Booking')}}</a>
                                </li>
                            </ul> --}}
                        </div>

                        <a href="{{ route('provider.service.booking.list') }}?booking_status=pending&service_type=all" class="btn-link font-semibold">View all</a>
                    </div>
                    <div class="card-body">
                        <ul class="common-list p-0 mb-0 d-flex flex-column gap-30px">
                             @if(count($data[3]['recent_bookings']) < 1)
                                <div class="py-5 text-center">
                                    <div class="opacity-75">{{translate('No_recent_bookings_are_available')}}</div>
                                </div>
                            @endif
                            @foreach($data[3]['recent_bookings'] as $key=>$booking)
                                <li class="d-flex flex-sm-nowrap flex-wrap gap-3 align-items-center justify-content-between cursor-pointer recent-booking-redirect redirect-link" data-route="@if($booking->is_repeated) {{ route('provider.service.booking.repeat_details', [$booking->id]) }}?web_page=details @else {{ route('provider.service.booking.details', [$booking->id]) }}?web_page=details @endif">
                                    <div class="media align-items-center gap-3">
                                        <div class="avatar">
                                            <img width="48" height="48" src="{{$booking->detail[0]->service?->thumbnail_full_path}}" alt="img" class="rounded-8">
                                        </div>
                                        <div class="media-body ">
                                            <h5 class="mb-0">Booking#  {{$booking->id}}
                                                @if($booking['is_repeated'])
                                                    <img width="17" height="17"
                                                            src="{{ asset('public/assets/admin/img/repeat2.png') }}"
                                                            class="rounded-circle repeat-icon" alt="{{ translate('repeat') }}">
                                                @endif
                                            </h5>
                                            <p class="fz-12px mb-0 pt-1">{{\Carbon\Carbon::parse($booking->created_at)->format('m-d-Y, h:i A')}}</p>
                                        </div>
                                    </div>
                                    <span class="badge rounded-pill py-2 px-3 text-capitalize" data-text-color="#2B95FF" data-bg-color="#2B95FF1A">{{translate($booking['booking_status'])}}</span>
                                </li>

                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @else
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-sm mb-2 mb-sm-0">
                        <h1 class="page-header-title">{{translate('messages.welcome')}}, {{auth('provider_employee')->user()->f_name}}.</h1>
                        <p class="page-header-text">{{translate('messages.provider_employee_welcome_message')}}</p>
                    </div>
                </div>
            </div>
            <!-- End Page Header -->
        @endif
    </div>

@endsection

@push('script_2')
    <script src="{{ asset('/public/assets/admin/js/apex-charts/apexcharts.js') }}"></script>

   <script>
        "use strict";

        var options = {
            series: [
                {
                    name: "{{translate('total_earnings')}}",
                    data: @json($chart_data['total_earning'])
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
                        return value;
                    }
                },
            },
            colors: ['#82C662', '#4FA7FF'],
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
                floating: true,
                offsetY: -10,
                offsetX: 0
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
            var chartElement = document.querySelector('#apex_line-chart');
            if (chartElement) {
                chartElement.remove();
            }

            var container = document.querySelector('.apex-line-chart-container');
            var newChartElement = document.createElement('div');
            newChartElement.id = 'apex_line-chart';
            container.appendChild(newChartElement);

            var url = '{{route('provider.update-dashboard-earning-graph')}}?year=' + year;

            $.getJSON(url, function (response) {
                var options = {
                    series: [{
                        name: "{{translate('total_earnings')}}",
                        data: response.total_earning
                    }],
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
                                return value;
                            }
                        }
                    },
                    colors: ['#82C662', '#4FA7FF'],
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        curve: 'smooth'
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
                        strokeDashArray: 5
                    },
                    markers: {
                        size: 1
                    },
                    theme: {
                        mode: 'light'
                    },
                    xaxis: {
                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                    },
                    legend: {
                        position: 'bottom',
                        horizontalAlign: 'center',
                        floating: true,
                        offsetY: -10,
                        offsetX: 0
                    },
                    padding: {
                        top: 0,
                        right: 0,
                        bottom: 200,
                        left: 10
                    }
                };

                // Recreate the chart with the new data
                var chart = new ApexCharts(document.querySelector('#apex_line-chart'), options);
                chart.render();  // Render the chart
            });
        }

        $(document).ready(function () {
            let routeName = '{{ route('provider.service.booking.details', ['id' => ':id']) }}';

            $(".booking-item").on('click', function(){
                location.href = $(this).data('route');
            });

            $('.custom-activate-tab li a').on('click', function (e) {
                e.preventDefault();
                $('.custom-activate-tab li a').removeClass('active');
                $(this).addClass('active');
            })
        });
    </script>
    <script>
        var options = {
            series: [{{$booking_counts['normal_booking_count']}}, {{$booking_counts['post_count']}}],
            chart: {
                type: 'donut',
                // width: '200',
            },
            labels: ["Total Normal Bookings", "Total Customized Bookings"],
            colors: ['#2A95FF', '#00C8A4'],
            legend: {
                position: 'bottom'
            },
        };

        var chart = new ApexCharts(document.querySelector("#apex-donut-chart"), options);
        var chart2 = new ApexCharts(document.querySelector("#apex-donut-chart2"), options);
        chart.render();
        chart2.render();
    </script>
    <script>
        $(document).ready(function() {
            $('#normal-tab').click(function() {
                var target = $(this).attr('data-bs-target');
                $('#view-all-link').attr('href', "{{route('provider.service.booking.list', ['booking_status'=>'pending'])}}");
            });
        });
        $(document).ready(function() {
            $('#customize-tab').click(function() {
                var target = $(this).attr('data-bs-target');
                $('#view-all-link').attr('href', "{{route('provider.service.booking.post.list', ['type'=>'all'])}}");
            });
        });

        $(".redirect-link").on('click', function(){
            location.href = $(this).data('route');
        });
    </script>
@endpush
