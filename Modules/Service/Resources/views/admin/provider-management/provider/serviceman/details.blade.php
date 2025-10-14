@extends('layouts.admin.app')

@section('title',$serviceman->full_name."'s ".translate('messages.serviceman_details'))

@push('css_or_js')
    <!-- Custom styles for this page -->
    <script src="{{ asset('/public/assets/admin/js/apex-charts/apexcharts.js') }}"></script>
@endpush

@section('content')

<div class="content container-fluid">
    <!-- Page Title -->
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-20">
        <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
            <img width="24" height="24" src="{{ asset('public/assets/admin/img/provider.png') }}" alt="services"> {{ translate('messages.serviceman_details') }}
        </h2>
        <div class="d-flex gap-2 align-items-center flex-wrap">
            <button type="button" class="btn d-flex align-items-center gap-2 text-danger px-3 h--45px font-medium form-alert" data-bg-color="#FF6D6D1A"
            data-id="vendor-{{$serviceman['id']}}" data-message="{{translate('messages.you_want_to_remove_this_serviceman')}}" title="{{translate('messages.delete_serviceman')}}">
                <i class="tio-delete"></i> {{ translate('messages.delete') }}
            </button>
            <form action="{{ route('admin.service.provider.serviceman.delete', ['id' => $serviceman->service_provider_id, 'serviceman_id' => $serviceman->id]) }}" method="post" id="vendor-{{$serviceman['id']}}">
                @csrf @method('delete')
            </form>
            <div class="rounded h--45px px-3 py-2 d-flex align-items-center gap-24px" data-bg-color="#F1F1F1">
                <h5 class="mb-0">{{ translate('messages.status') }}</h5>
                <label class="toggle-switch toggle-switch-sm" for="statusToggle{{ $serviceman->id }}">
                    <input type="checkbox"
                        data-url="{{ route('admin.service.provider.serviceman.status_update', ['id' => $serviceman->service_provider_id, 'serviceman_id' => $serviceman->id, 'status' => $serviceman->is_active ? 0 : 1]) }}"
                        class="toggle-switch-input redirect-url"
                        id="statusToggle{{ $serviceman->id }}"
                        {{ $serviceman->is_active ? 'checked' : '' }}>
                    <span class="toggle-switch-label">
                        <span class="toggle-switch-indicator"></span>
                    </span>
                </label>
            </div>
            <a href="{{ route('admin.service.provider.serviceman.edit', ['id' => $serviceman->service_provider_id, 'serviceman_id' => $serviceman->id]) }}" class="btn btn--primary">
                <i class="tio-add"></i> {{ translate('messages.edit_details') }}
            </a>
        </div>
    </div>

    <div class="mb-20">
        <div class="row g-3">
            <div class="col-lg-3 col-md-4">
                <div class="d-flex flex-column h-100 gap-20px">
                    <div class="bg-white shadow-sm h-100 rounded p-xxl-4 p-3 d-flex flex-column justify-content-center align-items-center gap-2">
                        <h2 class="mb-0 h1">{{ $countData['assigned_bookings'] }}</h2>
                        <div class="d-flex align-items-center gap-2">
                            <span class="fs-12">{{ translate('messages.assigned_bookings') }}</span>
                            <span class="" data-text-color="#1C8EFF" data-toggle="tooltip" data-placement="left" data-original-title="{{translate('messages.The total number of bookings currently assigned to this serviceman. This includes all upcoming and ongoing appointments.')}}">
                                <i class="tio-info"></i>
                            </span>
                        </div>
                    </div>
                    <div class="bg-white shadow-sm h-100 rounded p-xxl-4 p-3 d-flex flex-column justify-content-center align-items-center gap-2">
                        <h2 class="mb-0 h1">{{ $countData['ongoing_bookings'] }}</h2>
                        <span class="fs-12">{{ translate('messages.ongoing_bookings') }}</span>
                    </div>
                    <div class="bg-white shadow-sm h-100 rounded p-xxl-4 p-3 d-flex flex-column justify-content-center align-items-center gap-2">
                        <h2 class="mb-0 h1">{{ $countData['completed_bookings'] }}</h2>
                        <span class="fs-12">{{ translate('messages.completed_bookings') }}</span>
                    </div>
                    <div class="bg-white shadow-sm h-100 rounded p-xxl-4 p-3 d-flex flex-column justify-content-center align-items-center gap-2">
                        <h2 class="mb-0 h1">{{ $countData['cancelled_bookings'] }}</h2>
                        <span class="fs-12">{{ translate('messages.cancelled_bookings') }}</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-8">
                <div class="shadow-sm rounded pt-3 px-3">
                    <div class="d-flex flex-wrap align-items-center gap-2 justify-content-between">
                        <h4 class="mb-0">{{ translate('messages.booking_history') }}</h4>
                        <select class="custom-select max-w-170px" id="date-range" name="date_range">
                            <option value="0" disabled {{ $dateRange == '0' ? 'selected' : '' }}>{{ translate('Date_Range') }}</option>
                            <option value="all_time" {{ $dateRange == 'all_time' ? 'selected' : '' }}>{{ translate('All_Time') }}</option>
                            <option value="this_month" {{ $dateRange == 'this_month' ? 'selected' : '' }}>{{ translate('This_Month') }}</option>
                            <option value="last_month" {{ $dateRange == 'last_month' ? 'selected' : '' }}>{{ translate('Last_Month') }}</option>
                            <option value="this_year" {{ $dateRange == 'this_year' ? 'selected' : '' }}>{{ translate('This_Year') }}</option>
                        </select>
                    </div>
                    <div class="booking-line_chart" id="apex_line-chart"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="mb-20 border rounded p-20">
                <div class="row g-3 align-items-center justify-content-between">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-3 flex-wrap">
                            <img width="100" height="100" src="{{ $serviceman->profile_image_full_path }}" alt="img" class="rounded-8">
                            <div>
                                <h4 class="mb-1">{{ $serviceman->full_name }}</h4>
                                <div class="d-flex flex-column gap-1">
                                    <div class="d-flex align-items-center gap-1 mb-1">
                                        <span class="fs-12 d-block w-40px" data-text-color="#334257">{{ translate('messages.phone') }}</span>
                                        <a href="#0" class="fs-12 d-block" data-text-color="#334257">: {{ $serviceman->phone }}</a>
                                    </div>
                                    <div class="d-flex align-items-center gap-1 mb-1">
                                        <span class="fs-12 d-block w-40px" data-text-color="#334257">{{ translate('messages.email') }}</span>
                                        <a href="#0" class="fs-12 d-block" data-text-color="#334257">: {{ $serviceman->email }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
                            <h4 class="mb-1">{{ translate('messages.identity_information') }}</h4>
                            <div class="d-flex flex-column gap-1">
                                <div class="d-flex align-items-center gap-1 mb-1">
                                    <span class="fs-12 d-block w-100px" data-text-color="#334257">{{ translate('messages.identity_type') }}</span>
                                    <a href="#0" class="fs-12 d-block" data-text-color="#334257">: {{ translate($serviceman->identification_type) }}</a>
                                </div>
                                <div class="d-flex align-items-center gap-1 mb-1">
                                    <span class="fs-12 d-block w-100px" data-text-color="#334257">{{ translate('messages.identity_number') }}</span>
                                    <a href="#0" class="fs-12 d-block" data-text-color="#334257">: {{ $serviceman->identification_number }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if(is_array($serviceman?->identification_image_full_path) && count($serviceman?->identification_image_full_path) > 0)
                <h4 class="mb-20">{{ translate('messages.identity_image') }}</h4>
                <div class="row g-3">
                    @foreach($serviceman->identification_image_full_path as $image)
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="rounded-8 w-100">
                            <img src="{{ $image }}" alt="img" class="rounded-8 w-100">
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('script_2')
    <!-- Page level plugins -->
    <script>
        'use strict';

        $("#date-range").change(function () {
            location.href = "{{ route('admin.service.provider.serviceman.details', [$provider->id, $serviceman->id]) }}?date_range=" + $(this).val();
        });

        const chartElement = document.querySelector("#apex_line-chart");
        const chartData = @json($chartdata);

        let chartOptions = {
            series: [
                {
                    name: "{{ translate('messages.total_booking') }}",
                    data: chartData.total_booking
                }
            ],
            chart: {
                height: 420,
                type: 'line',
                dropShadow: {
                    enabled: true,
                    color: '#000',
                    top: 18,
                    left: 7,
                    blur: 10,
                    opacity: 0.2
                },
                toolbar: { show: false }
            },
            responsive: [
                {
                    breakpoint: 767,
                    options: {
                        chart: { height: 350 },
                        xaxis: { labels: { rotate: -45 } },
                        legend: { show: false }
                    }
                },
                {
                    breakpoint: 575,
                    options: {
                        chart: { height: 280 },
                        xaxis: { labels: { rotate: -45 } },
                        legend: { show: false }
                    }
                }
            ],
            yaxis: {
                labels: {
                    offsetX: localStorage.getItem('dir') === 'rtl' ? -20 : 0,
                    formatter: function (value) {
                        return Math.abs(value);
                    }
                }
            },
            colors: ['#33425780'],
            dataLabels: { enabled: false },
            stroke: { curve: 'smooth', width: 2 },
            grid: {
                xaxis: { lines: { show: true } },
                yaxis: { lines: { show: true } },
                borderColor: '#CAD2FF',
                strokeDashArray: 3
            },
            markers: { size: 1 },
            theme: { mode: 'light' },

            xaxis: {
                categories: chartData.timeline
            },

            legend: { show: false },
            padding: { top: 0, right: 0, bottom: 0, left: 10 }
        };

        let chart = new ApexCharts(chartElement, chartOptions);
        chart.render();
    </script>

@endpush
