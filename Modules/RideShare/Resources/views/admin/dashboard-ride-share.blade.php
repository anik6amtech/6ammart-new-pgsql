@extends('layouts.admin.app')

@section('title', translate('messages.Ride Share Module Dashboard'))

@section('content')
@php($mod = \App\Models\Module::find(Config::get('module.current_module_id')))
    <div class="content container-fluid">
        @if(auth('admin')->user()->role_id == 1)
        <div class="">
            <div class="row align-items-center justify-content-between mb-3 gy-2">
                <div class="col-sm-8 col-xl-9">
                    <div class="media gap-3">
                        <img width="38" class="onerror-image" data-onerror-image=="{{ asset('Modules/RideShare/public/assets/img/ride-share/car.png') }}"
                            src="{{$mod->icon_full_url }}"
                            loading="eager" alt="">
                        <div class="media-body text-dark">
                            <h3 class="mb-1">{{ translate('Ride Sharing Module Dashboard') }}</h3>
                            <p class="text-capitalize mb-0">{{ translate('Monitor your ride sharing business') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-xl-3">
                    <div class="">
                        {{-- <select class="js-select2-custom" id="zoneWiseRideDate">
                            <option value="all">{{ translate('All Zone') }}</option>
                            <option value="all">{{ translate('All Zone') }}</option>
                            <option value="all">{{ translate('All Zone') }}</option>
                            <option value="all">{{ translate('All Zone') }}</option>
                            <option value="all">{{ translate('All Zone') }}</option>
                        </select> --}}
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between gap-2 align-items-center flex-wrap mb-3">
                        <div class="d-flex gap-2 align-items-center">
                            <h3 class="mb-0">{{ translate('Ride Statistics') }}</h3>
                            <span class="badge badge-soft-success border-0 fs-10">{{ translate('Zone') }} :
                                {{ translate('All') }}</span>
                        </div>

                        <div class="">
                            {{-- <select name="time" class="form-control border-0">
                                <option value="all">{{ translate('All Time') }}</option>
                                <option value="all">{{ translate('All Time') }}</option>
                                <option value="all">{{ translate('All Time') }}</option>
                                <option value="all">{{ translate('All Time') }}</option>
                            </select> --}}
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-lg-4">
                            <div class="card shadow-0 border-0 h-100" data-bg-color="#E6F6EE">
                                <div class="card-body align-content-center">
                                    <div class="d-flex flex-column align-items-center gap-2">
                                        <img width="52" class="mb-2"
                                            src="{{ asset('Modules/RideShare/public/assets/img/ride-share/total-rider.png') }}"
                                            loading="eager" alt="">

                                        <h3 class="fs-24 text-primary mb-0">{{ abbreviateNumber($totalTrips) }}</h3>
                                        <p class="mb-0">{{ translate('Total Rides') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="d-flex gap-3 flex-column">
                                <div class="card shadow-0 border-0" data-bg-color="#EAFBFF">
                                    <div class="card-body">
                                        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                                            <div class="media flex-grow-1 position-relative">
                                                <div class="progress progress-vert position-absolute left-0 bottom-0">
                                                    <div class="progress-bar" role="progressbar"
                                                        style="width: {{ getPercent($pendingTrips, $totalTrips) }}%; --progress-bg: #00c9db" aria-valuenow="25"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <div class="media-body py-3 ps-3">
                                                    <h3 class="fs-24 mb-0">{{ abbreviateNumber($pendingTrips) }}</h3>
                                                    <p class="mb-0">{{ translate('Pending Rides') }}</p>
                                                </div>
                                            </div>

                                            <img width="40"
                                                src="{{ asset('Modules/RideShare/public/assets/img/ride-share/pending-request.png') }}"
                                                loading="eager" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="card shadow-0 border-0" data-bg-color="#E6F6EE">
                                    <div class="card-body">
                                        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                                            <div class="media flex-grow-1 position-relative">
                                                <div class="progress progress-vert position-absolute left-0 bottom-0">
                                                    <div class="progress-bar" role="progressbar" style="width: {{ getPercent($completedTrips, $totalTrips) }}%"
                                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <div class="media-body py-3 ps-3">
                                                    <h3 class="fs-24 text-primary mb-0">{{ abbreviateNumber($completedTrips) }}</h3>
                                                    <p class="mb-0">{{ translate('Completed Rides') }}</p>
                                                </div>
                                            </div>

                                            <img width="40"
                                                src="{{ asset('Modules/RideShare/public/assets/img/ride-share/completed-rides.png') }}"
                                                loading="eager" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="d-flex gap-3 flex-column">
                                <div class="card shadow-0 border-0" data-bg-color="#FFF7E7">
                                    <div class="card-body">
                                        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                                            <div class="media flex-grow-1 position-relative">
                                                <div class="progress progress-vert position-absolute left-0 bottom-0">
                                                    <div class="progress-bar" role="progressbar"
                                                        style="width: {{ getPercent($ongoingTrips, $totalTrips) }}%; --progress-bg: #FEB019" aria-valuenow="25"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <div class="media-body py-3 ps-3">
                                                    <h3 class="fs-24 text-warning mb-0">{{ abbreviateNumber($ongoingTrips) }}</h3>
                                                    <p class="mb-0">{{ translate('Ongoing Rides') }}</p>
                                                </div>
                                            </div>

                                            <img width="40"
                                                src="{{ asset('Modules/RideShare/public/assets/img/ride-share/ongoing-rides.png') }}"
                                                loading="eager" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="card shadow-0 border-0" data-bg-color="#FFF2F2">
                                    <div class="card-body">
                                        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                                            <div class="media flex-grow-1 position-relative">
                                                <div class="progress progress-vert position-absolute left-0 bottom-0">
                                                    <div class="progress-bar" role="progressbar"
                                                        style="width: {{ getPercent($cancelledTrips, $totalTrips) }}%; --progress-bg: #FF6D6D" aria-valuenow="25"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <div class="media-body py-3 ps-3">
                                                    <h3 class="fs-24 text-danger mb-0">{{ abbreviateNumber($cancelledTrips) }}</h3>
                                                    <p class="mb-0">{{ translate('Canceled Rides') }}</p>
                                                </div>
                                            </div>

                                            <img width="40"
                                                src="{{ asset('Modules/RideShare/public/assets/img/ride-share/canceled-rides.png') }}"
                                                loading="eager" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row">
                    <div class="col-md-4">
                        <div class="h-100">
                            <div class="card h-150px pt-2 shadow-0 border-0 mb-3" data-bg-color="#D8FAEE">
                                <div class="card-body">
                                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                                        <div class="media flex-grow-1 position-relative">
                                            <div class="media-body py-3 ps-3">
                                                <h3 class="fs-24 text-warning mb-0">{{abbreviateNumber($drivers)}}</h3>
                                                <p class="mb-0">{{ translate('Total Active Drivers') }}</p>
                                            </div>
                                        </div>
    
                                        <img width="40"
                                             src="{{ asset('public/assets/admin/img/activity-driver.png') }}"
                                             loading="eager" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="card h-150px pt-2 shadow-0 border-0" data-bg-color="#FFF7EE">
                                <div class="card-body">
                                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                                        <div class="media flex-grow-1 position-relative">
                                            <div class="media-body py-3 ps-3">
                                                <h3 class="fs-24 text-danger mb-0">{{abbreviateNumberWithSymbol($totalEarning) }}</h3>
                                                <p class="mb-0">{{ translate('Total Earnings') }}</p>
                                            </div>
                                        </div>
    
                                        <img width="40"
                                             src="{{ asset('public/assets/admin/img/earnings-hand.png') }}"
                                             loading="eager" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card mb-3 h-100">
                            <div class="card-header d-flex flex-wrap justify-content-between gap-10">
                                <div class="d-flex flex-column gap-1">
                                    <h6 class="text-capitalize">{{ translate('zone-wise_trip_statistics')}}</h6>
                                    <p>{{ translate('total')}} {{$zones->count()}} {{ translate('zone')}}</p>
                                </div>
                                <div class="d-flex flex-wrap flex-sm-nowrap gap-2 align-items-center">
                                    <select class="form-control border-0 outline-0 p-0 filter-4 bg-transparent" id="zoneWiseRideDate">
                                        <option disabled>{{ translate('Select_Duration')}}</option>
                                        <option value="{{TODAY}}" {{ env('APP_MODE') != 'demo' ? "selected" : "" }}>{{ translate(TODAY)}}</option>
                                        <option value="{{PREVIOUS_DAY}}">{{ translate(PREVIOUS_DAY)}}</option>
                                        <option value="{{LAST_7_DAYS}}">{{translate(LAST_7_DAYS)}}</option>
                                        <option value="{{THIS_WEEK}}">{{translate(THIS_WEEK)}}</option>
                                        <option value="{{LAST_WEEK}}">{{translate(LAST_WEEK)}}</option>
                                        <option value="{{THIS_MONTH}}">{{translate(THIS_MONTH)}}</option>
                                        <option value="{{LAST_MONTH}}">{{translate(LAST_MONTH)}}</option>
                                        <option value="{{ALL_TIME}}" {{ env('APP_MODE') != 'demo' ?  "" : "selected" }}>{{translate(ALL_TIME)}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="load-all-data">
                                    <div id="zoneWiseTripStatistics"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>

            <div class="card my-3">
                <div class="card-body">
                    <div class="d-flex flex-wrap justify-content-between gap-2 mb-4">
                        <div class="d-flex flex-column gap-1">
                            <h4 class="mb-0 text-capitalize" id="chart-gross-earning">$<span></span></h4>
                            <p class="mb-0">{{ translate('Gross Earnings') }}</p>
                        </div>
                        <div class="chart--label __chart-label p-0 d-flex align-items-center">
                            <span class="indicator fs-16" data-bg-color="#00aa6d"></span>
                            <span class="info">
                                Earnings (<span id="chart-earning-date-type"></span>)
                            </span>
                        </div>
                        <div class="d-flex flex-wrap flex-sm-nowrap gap-2 gap-xxl-40 align-items-right">
                            <select class="form-control w-auto border-0 outline-0 filter-4 bg-transparent" id="rideZone">
                                <option disabled>{{translate('Select_Area')}}</option>
                                <option selected value="all">{{translate('all_over_the_world')}}</option>
                                @forelse($zones as $zone)
                                    <option value="{{$zone->id}}">{{$zone->name}}</option>
                                @empty
                                @endforelse
                            </select>

                            <select class="form-control w-auto border-0 outline-0 filter-4 bg-transparent" id="rideDate">
                                @include('ride-share::admin.partials.dashboard-partials._time_dropdown_options')
                            </select>
                        </div>
                    </div>

                    <div id="updating_line_chart">
                        <div id="grow-sale-chart"></div>
                    </div>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-12">
                    <div class="card h-100">
                        <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-3">
                            <div class="d-flex align-items-center gap-2">
                                <h5 class="text-capitalize mb-0">{{ translate('Leader_Board') }}</h5>
                            </div>

                            <div class="d-flex flex-wrap flex-sm-nowrap gap-2 align-items-center">
                                <select class="form-control w-auto border-0 outline-0 filter-4 bg-transparent" onchange="changeLeaderBoard(this.value)">
                                    @include('ride-share::admin.partials.dashboard-partials._time_dropdown_options')
                                </select>
                            </div>
                        </div>
                        <div class="card-body p-4 p-sm-5">
                            <div id="leader-board-driver">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card h-100" id="top-provider-view">
                        <div class="card-header border-0 order-header-shadow">
                            <div>
                                <h5 class="card-header-title font-bold d-flex justify-content-between">
                                    <span>{{ translate('messages.Recent_Transactions') }}</span>
                                </h5>
                                {{-- <p class="fs-12 mb-0"><i class="tio-arrow-upward mr-1" data-color="#1AA053"></i> 23
                                    transactions this month</p> --}}
                            </div>
                            <a href="{{ route('admin.transactions.ride-share.transaction.index')}}" class="font-semibold" data-color="#2B95FF">{{ translate('view_all') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-column gap-3 recent-transactions">
                                @forelse ($transactions as $transaction)
                                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 rounded p-3"
                                        data-bg-color="#F7F8FA">
                                        <div class="flex-grow-1">
                                            @if($transaction->debit>0)
                                                <h5 class="mb-1">{{ getCurrencyFormat($transaction->debit ?? 0) }}</h5>
                                                <h6 class="fs-10 opacity-lg mb-0">{{translate("Debited from ")}} {{translate($transaction->account)}}</h6>
                                            @else
                                                <h5 class="mb-1">{{ getCurrencyFormat($transaction->credit ?? 0) }}</h5>
                                                <h6 class="fs-10 opacity-lg mb-0">{{translate("Credited to ")}} {{translate($transaction->account)}}</h6>
                                            @endif
                                        </div>
                                        <div class="flex-grow-1 text-end">
                                            <p class="mb-1">{{ date('d M h:i A', strtotime($transaction->created_at)) }}</p>
                                            <h6 class="fs-12 mb-0">{{ translate('TrxID') }} #{{ $transaction->id }}</h6>
                                        </div>
                                    </div>
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
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card h-100" id="top-provider-view">
                        <div class="card-header border-0 order-header-shadow">
                            <div>
                                <h5 class="card-header-title font-bold d-flex justify-content-between">
                                    <span>{{ translate('messages.recent_activity') }}</span>
                                </h5>
                                {{-- <p class="fs-12 mb-0">All Activities</p> --}}
                            </div>
                            <a href="{{ route('admin.ride-share.ride.index') }}" class="font-semibold" data-color="#2B95FF">{{ translate('view_all') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="top--selling">
                                @forelse ($recentTrips as $trip)
                                    <a class="grid--card align-items-center" href="{{ route('admin.ride-share.ride.show', $trip->id) }}">
                                        <img class="onerror-image"
                                            data-onerror-image="{{ asset('public/assets/admin/img/160x160/img1.jpg') }}"
                                            src="{{ $trip->vehicleCategory?->image_full_url }}">
                                        <div class="cont pt-2">
                                            <h5 class="mb-1 font-regular">Rides# <strong class="font-bold">{{ $trip->ref_id }}</strong>
                                            </h5>
                                            <span class="fs-12"> {{ $trip->created_at->format('d M h:i A') }}</span>
                                        </div>
                                        <div class="ml-auto">
                                            @if($trip->current_status == ONGOING)
                                            <span class="badge rounded bg-opacity-10" data-bg-color="#2B95FF"
                                                data-color="#2B95FF">{{ translate($trip->current_status) }}</span>
                                            @elseif($trip->current_status == COMPLETED)
                                            <span class="badge rounded bg-opacity-10" data-bg-color="#16B559"
                                                data-color="#16B559">{{ translate($trip->current_status) }}</span>
                                            @elseif($trip->current_status == PENDING)
                                            <span class="badge rounded bg-opacity-10" data-bg-color="#FFB300"
                                                data-color="#FFB300">{{ translate($trip->current_status) }}</span>
                                            @else
                                            <span class="badge rounded bg-opacity-10" data-bg-color="#FF3737"
                                                data-color="#FF3737">{{ translate($trip->current_status) }}</span>
                                            @endif
                                        </div>
                                    </a>
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
                            </div>
                        </div>
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

@push('script')
    <!-- Apex Charts -->
    <script src="{{ asset('/public/assets/admin/js/apex-charts/apexcharts.js') }}"></script>
    <!-- Apex Charts -->
@endpush

@push('script_2')
    <script>

        $("#zoneWiseRideDate").on('change', function () {
            let date = $("#zoneWiseRideDate").val()
            zoneWiseTripStatistics(date)
        })

        function zoneWiseTripStatistics(date) {
            $.get({
                url: '{{route('admin.ride-share.zone-wise-statistics')}}',
                dataType: 'json',
                data: {date: date},
                beforeSend: function () {
                    $('#resource-loader').show();
                },
                success: function (response) {
                    $('#zoneWiseTripStatistics').empty().html(response)
                },
                complete: function () {
                    $('#resource-loader').hide();
                },
                error: function (xhr, status, error) {
                    $('#resource-loader').hide();
                    toastr.error('{{translate('failed_to_load_data')}}')
                },
            });

        }

        zoneWiseTripStatistics(document.getElementById('zoneWiseRideDate').value);

        function loadPartialView(url, divId, data = null) {
            $.get({
                url: url,
                dataType: 'json',
                data: {
                    data
                },
                beforeSend: function () {
                    $('#resource-loader').show();
                },
                success: function (response) {
                    $(divId).empty().html(response)
                },
                complete: function () {
                    $('#resource-loader').hide();
                },
                error: function () {
                    $('#resource-loader').hide();
                    toastr.error('{{ translate('failed_to_load_data') }}')
                },
            });
        }

        loadPartialView('{{route('admin.ride-share.leader-board-driver')}}', '#leader-board-driver', '{{ env('APP_MODE') != 'live' ? "all_time" : "today" }}');

        function changeLeaderBoard(value) {
            loadPartialView('{{route('admin.ride-share.leader-board-driver')}}', '#leader-board-driver', value);
        }

        $("#rideZone,#rideDate").on('change', function () {
            let date = $("#rideDate").val();
            let zone = $("#rideZone").val();
            adminEarningStatistics(date, zone)
        })

        function adminEarningStatistics(date, zone = null) {
            $.get({
                url: '{{route('admin.ride-share.earning-statistics')}}',
                dataType: 'json',
                data: {date: date, zone: zone},
                beforeSend: function () {
                    // $('#resource-loader').show();
                },
                success: function (response) {
                    let hours = response.label;
                    // Remove double quotes from each string value
                    hours = hours.map(function (hour) {
                        return hour.replace(/"/g, '');
                    });
                    document.getElementById('grow-sale-chart').remove();
                    $('#chart-gross-earning span').text(response.totalAdminCommissionAmount);
                    $('#chart-earning-date-type').text(response.dateType);
                    let graph = document.createElement('div');
                    graph.setAttribute("id", "grow-sale-chart");
                    document.getElementById("updating_line_chart").appendChild(graph);
                    let options = {
                        series: [
                            {
                                name: '{{translate("Total Trips")}}',
                                data: [0].concat(Object.values(response.totalTripRequest))
                            },
                            {
                                name: '{{translate("Admin Commission")}} ($)',
                                data: [0].concat(Object.values(response.totalAdminCommission))
                            }
                        ],
                        chart: {
                            height: 366,
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
                        colors: ['#F4A164', '#14B19E'],
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
                            strokeColors: ['#F4A164', '#14B19E'],
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
                            categories: ['00'].concat(hours),
                            labels: {
                                offsetX: 0,
                            },
                        },
                        legend: {
                            show: false,
                            position: 'bottom',
                            horizontalAlign: 'left',
                            floating: false,
                            offsetY: -10,
                            itemMargin: {
                                vertical: 10
                            },
                        },
                        yaxis: {
                            tickAmount: 10,
                            labels: {
                                offsetX: 0,
                            },
                        }
                    };

                    if (localStorage.getItem('dir') === 'rtl') {
                        options.yaxis.labels.offsetX = -20;
                    }

                    let chart = new ApexCharts(document.querySelector("#grow-sale-chart"), options);
                    chart.render();
                },
                complete: function () {
                    // $('#resource-loader').hide();
                },
                error: function (xhr, status, error) {
                    let err = eval("(" + xhr.responseText + ")");
                    // alert(err.Message);
                    // $('#resource-loader').hide();
                    toastr.error('{{translate('failed_to_load_data')}}')
                },
            });
        }

        $(document).ready(function () {
            // Initialize the admin earning statistics with default value
            adminEarningStatistics('all_time');
        });
    </script>
@endpush
