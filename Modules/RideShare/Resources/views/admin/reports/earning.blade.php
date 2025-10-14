@extends('layouts.admin.app')

@section('title', translate('earning_reports'))

@push('css_or_js')
<link rel="stylesheet" href="{{asset('Modules/RideShare/public/assets/js/apex/apexcharts.css')}}"/>
@endpush
@section('content')

    <div class="content">
        <div class="container-fluid">
            <h4 class="text-capitalize mb-3">{{ translate('Report Analytics') }}</h4>
            <div class="d-flex mb-3">
                <ul class="nav nav--tabs p-1 rounded bg-white" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="{{route('admin.transactions.ride-share.report.earning')}}" class="nav-link active">Earning</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="{{route('admin.transactions.ride-share.report.expense')}}" class="nav-link">Expense</a>
                    </li>
                </ul>
            </div>
            <div class="mb-4 row g-4">
                <div class="col-md-5">
                    <div class="card h-100">
                        <div
                            class="card-header d-flex flex-wrap justify-content-between gap-10 border-0 align-items-center pb-0">
                            <h5 class="text-capitalize m-0">{{translate('Earning Statistics')}}</h5>
                            <div class="d-flex flex-wrap flex-sm-nowrap gap-2 align-items-center">
                                <select class="form-control js-select" id="dateRangeForEarningStatistics">
                                    <option value="{{ALL_TIME}}" selected>{{translate(ALL_TIME)}}</option>
                                    <option value="{{TODAY}}">{{translate(TODAY)}}</option>
                                    <option value="{{PREVIOUS_DAY}}">{{translate(PREVIOUS_DAY)}}</option>
                                    <option value="{{LAST_7_DAYS}}">{{translate(LAST_7_DAYS)}}</option>
                                    <option value="{{THIS_WEEK}}">{{translate(THIS_WEEK)}}</option>
                                    <option value="{{THIS_MONTH}}">{{translate(THIS_MONTH)}}</option>
                                    <option value="{{LAST_MONTH}}">{{translate(LAST_MONTH)}}</option>
                                    <option value="{{THIS_YEAR}}">{{translate(THIS_YEAR)}}</option>
                                </select>
                            </div>
                            <div class="w-100 border-bottom pt-3"></div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-wrap">
                                <div class="d-flex justify-content-center">
                                    <div class="position-relative pie-chart">
                                        <div class="pie-placeholder"></div>
                                        <div id="dognut-pie" class="pie-chart-inner"></div>
                                        <div class="total--rides">
                                            <h4 class="text-uppercase mb-xxl-2">{{\App\CentralLogics\Helpers::currency_symbol()}}<span id="totalEarning"></span></h4>
                                            <span class="text-capitalize">{{translate("Earnings")}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="d-flex flex-wrap gap-2 bg--F6F6F6 p-2">
                                        <div class="icon bg-info">
                                            <img src="{{asset('Modules/RideShare/public/assets/img/ride-share/ride-sharing.svg')}}" alt="">
                                        </div>
                                        <div>
                                            <span>{{translate("Ride Request")}}</span>
                                            <h5 class="m-0">{{\App\CentralLogics\Helpers::currency_symbol()}}<span id="rideEarning"></span></h5>
                                        </div>
                                    </div>
                                    {{-- <div class="expense-info bg-F6F6F6">
                                        <div class="icon bg-warning">
                                            <img src="{{asset('public/assets/admin-module/img/svg/parcel.svg')}}" alt="">
                                        </div>
                                        <div class="w-0 flex-grow-1">
                                            <span>{{translate("Parcel")}}</span>
                                            <h5 class="m-0">{{\App\CentralLogics\Helpers::currency_symbol()}}<span id="parcelEarning"></span></h5>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="card h-100">
                        <div
                            class="card-header d-flex flex-wrap justify-content-between gap-10 pb-0 border-0 align-items-center">
                            <h5 class="text-capitalize m-0">{{translate('Zone Wise  Statistics')}}</h5>
                            <div class="d-flex flex-wrap flex-sm-nowrap gap-2 align-items-center">
                                <select class="form-control js-select" id="dateRange" name="date_range">
                                    <option value="{{ALL_TIME}}" selected>{{translate(ALL_TIME)}}</option>
                                    <option value="{{TODAY}}">{{translate(TODAY)}}</option>
                                    <option value="{{PREVIOUS_DAY}}">{{translate(PREVIOUS_DAY)}}</option>
                                    <option value="{{LAST_7_DAYS}}">{{translate(LAST_7_DAYS)}}</option>
                                    <option value="{{THIS_WEEK}}">{{translate(THIS_WEEK)}}</option>
                                    <option value="{{THIS_MONTH}}">{{translate(THIS_MONTH)}}</option>
                                    <option value="{{LAST_MONTH}}">{{translate(LAST_MONTH)}}</option>
                                    <option value="{{THIS_YEAR}}">{{translate(THIS_YEAR)}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-body hide-apexcharts-tooltip-title hide-1st-line-of-chart hide-2nd-line-of-chart" id="updating_line_chart">
                            <div id="apex_line-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card pt-2 mb-4">
                <div class="card-header py-2">
                        <div class="search--button-wrapper gap-20px">
                            <h5 class="card-title text--title flex-grow-1">{{ translate('messages.Ride Wise Earning') }}</h5>

                            <form class="search-form m-0 flex-grow-1 max-w-353px">

                                <div class="input-group input--group">
                                    <input id="datatableSearch_" type="search" value="{{ request()?->search ?? null }}" name="search"
                                        class="form-control" placeholder="{{ translate('search_here_by_trip_id') }}"
                                        aria-label="{{ translate('search_here_by_trip_id') }}">
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
                                        href="{{route('admin.transactions.ride-share.report.earningReportExport',['file' => 'excel', request()->getQueryString()])}}">
                                        <img class="avatar avatar-xss avatar-4by3 mr-2"
                                            src="{{ asset('public/assets/admin') }}/svg/components/excel.svg" alt="Image Description">
                                        {{ translate('messages.excel') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                </div>

                <div class="table-responsive datatable-custom">
                    <table id="columnSearchDatatable"
                        class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table text--title">
                        <thead class="thead-light">
                             <tr>
                                <th class="sl">{{translate("SL")}}</th>
                                <th>{{translate("Ride ID")}}</th>
                                <th>{{translate("Date")}}</th>
                                <th>{{translate("Zone")}}</th>
                                <th class="text-center">{{translate("Ride Type")}}</th>
                                <th class="text-end">{{translate("Total Ride Cost")}} ({{\App\CentralLogics\Helpers::currency_symbol()}}
                                    )
                                </th>
                                <th class="text-end">{{translate("Commission Earning")}}
                                    ({{\App\CentralLogics\Helpers::currency_symbol()}})
                                </th>
                                <th class="text-end">{{translate("Tax Collected")}}({{\App\CentralLogics\Helpers::currency_symbol()}})
                                <th class="text-end">{{translate("Earning")}}({{\App\CentralLogics\Helpers::currency_symbol()}})
                                </th>
                                <th class="text-center">{{translate("Action")}}</th>
                            </tr>
                        </thead>

                        <tbody id="set-rows">
                            @foreach ($trips as $key => $trip)
                                <tr>
                                    <td>{{$trips->firstItem() + $key}}</td>
                                    <td><a href="{{route('admin.ride-share.ride.show', $trip->id)}}">#{{$trip->ref_id}}</a></td>
                                    <td>
                                        {{date('d F Y', strtotime($trip->created_at))}},
                                        <br/> {{date('h:i a', strtotime($trip->created_at))}}
                                    </td>
                                    <td>{{$trip?->zone?->name}}</td>
                                    <td>
                                        @if($trip->type=="parcel")
                                            <div class="text-center">
                                                <span class="badge badge-warning">{{translate($trip->type)}}</span>
                                            </div>
                                        @else
                                            <div class="text-center">
                                                <span class="badge badge-info">{{translate($trip->type)}}</span>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="text-end">{{ getCurrencyFormat($trip->paid_fare) }}</td>
                                    <td class="text-end">{{ getCurrencyFormat($trip?->fee?->admin_commission-$trip?->fee?->vat_tax) }}</td>
                                    <td class="text-end">{{ getCurrencyFormat($trip?->fee?->vat_tax) }}</td>
                                    <td class="text-end">{{ getCurrencyFormat($trip?->fee?->admin_commission) }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2 align-items-center">
                                            <a target="_blank" href="{{route('admin.transactions.ride-share.report.singleEarningReportExport',$trip->id)}}" class="btn btn-outline-primary btn-action">
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M12.6667 6H10V2H6V6H3.33333L8 11.3333L12.6667 6ZM2.66666 12.6667H13.3333V14H2.66666V12.6667Z"
                                                        fill="currentColor"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if(count($trips) !== 0)
                    <hr>
                    @endif
                    <div class="page-area">
                        {!! $trips->withQueryString()->links() !!}
                    </div>
                    @if(count($trips) === 0)
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
@endsection

@push('script_2')
    <script src="{{asset('Modules/RideShare/public/assets/js/apex/apexcharts.min.js')}}"></script>
    <script>
        "use strict";
        let point = {{(int)config('round_up_to_digit') ?? 0}};
        $("#dateRange").on('change', function () {
            let date = $("#dateRange").val();
            dateZoneWiseEarningStatistics(date)
        })
        function dateZoneWiseEarningStatistics(date) {
            $.get({
                url: '{{route('admin.transactions.ride-share.report.dateZoneWiseEarningStatistics')}}',
                dataType: 'json',
                data: {date: date},
                beforeSend: function () {
                    $('#resource-loader').show();
                },
                success: function (response) {

                    let hours = response.label;
                    // Remove double quotes from each string value
                    hours = hours.map(function (hour) {
                        return hour.replace(/"/g, '');
                    });
                    document.getElementById('apex_line-chart').remove();
                    let graph = document.createElement('div');
                    graph.setAttribute("id", "apex_line-chart");
                    document.getElementById("updating_line_chart").appendChild(graph);
                    let options = {
                        series: [
                            {
                                name: "{{translate("Total Commission Earning")}}",
                                data: [0].concat(Object.values(response.totalAdminCommission))
                            },
                            {
                                name: "{{translate("Total Tax Earning")}}",
                                data: [0].concat(Object.values(response.totalVatTax))
                            },
                            {
                                name: "{{translate("Total Trips")}}",
                                data: [0].concat(Object.values(response.totalTripRequest))
                            }
                        ],
                        chart: {
                            height: 330,
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
                            }
                        },
                        colors: [ '#14B19E','#F4A164'],
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
                            strokeColors: [ '#14B19E','#F4A164'],
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

                    let chart = new ApexCharts(document.querySelector("#apex_line-chart"), options);
                    chart.render();
                },
                complete: function () {
                    $('#resource-loader').hide();
                },
                error: function (xhr, status, error) {
                    let err = eval("(" + xhr.responseText + ")");
                    $('#resource-loader').hide();
                    toastr.error('{{translate('failed_to_load_data')}}')
                },
            });
        }
        dateZoneWiseEarningStatistics("{{ALL_TIME}}")
        $("#dateRangeForEarningStatistics").on('change', function () {
            let date = $("#dateRangeForEarningStatistics").val();
            dateRideTypeWiseEarningStatistics(date)
        })
        function abbreviateNumber(num) {
            if (num >= 1_000_000_000_000) {
                return (num / 1_000_000_000_000).toFixed(point) + 'T';
            } else if (num >= 1_000_000_000) {
                return (num / 1_000_000_000).toFixed(point) + 'B';
            } else if (num >= 1_000_000) {
                return (num / 1_000_000).toFixed(point) + 'M';
            } else if (num >= 1_000) {
                return (num / 1_000).toFixed(point) + 'K';
            } else {
                return num.toString();
            }
        }

        function dateRideTypeWiseEarningStatistics(date) {
            $.get({
                url: '{{route('admin.transactions.ride-share.report.dateRideTypeWiseEarningStatistics')}}',
                dataType: 'json',
                data: {date: date},
                beforeSend: function () {
                    $('#resource-loader').show();
                },
                success: function (response) {
                    let rideEarning = parseFloat(response.totalAdminCommission.ride_request);
                    $("#rideEarning").html(rideEarning.toFixed(point))
                    $("#totalEarning").html(abbreviateNumber(rideEarning.toFixed(point)))
                    let options;
                    let chart;
                    if(rideEarning > 0){
                        $('.pie-placeholder').hide()
                        $('.pie-chart-inner').css('opacity', '1');
                    } else {
                        $('.pie-placeholder').show();
                        $('.pie-chart-inner').css('opacity', '0');
                    }
                    options = {
                        series: [rideEarning],
                        chart: {
                            width: 240,
                            type: 'donut',
                        },
                        labels: ['{{ translate('Ride Request') }}'],
                        dataLabels: {
                            enabled: false,
                            style: {
                                colors: ['#0177CD']
                            }
                        },
                        responsive: [{
                            breakpoint: 1650,
                            options: {
                                chart: {
                                    width: 240
                                },
                            }
                        }],
                        colors: ['#0177CD'],
                        fill: {
                            colors: ['#0177CD']
                        },
                        stroke:{
                            colors: ['#0177CD00']
                        },
                        legend: {
                            show: false
                        },
                    };

                    chart = new ApexCharts(document.querySelector("#dognut-pie"), options);
                    chart.render();
                },
                complete: function () {
                    $('#resource-loader').hide();
                },
                error: function (xhr, status, error) {
                    let err = eval("(" + xhr.responseText + ")");
                    // alert(err.Message);
                    $('#resource-loader').hide();
                    toastr.error('{{translate('failed_to_load_data')}}')
                },
            });
        }
        dateRideTypeWiseEarningStatistics("{{ALL_TIME}}")

    </script>
@endpush
