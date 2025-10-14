@extends('layouts.admin.app')

@section('title', $provider->company_name)

@push('css_or_js')
    <!-- Custom styles for this page -->
    <link href="{{ asset('public/assets/admin/css/croppie.css') }}" rel="stylesheet">
    <link href="{{ asset('Modules/Rental/public/assets/css/admin/provider-overview.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="content container-fluid">

        @include('service::admin.provider-management.provider.detail.partials._header', [
            'provider' => $provider,
        ])

        <div class="row g-3 mb-2">
            <div class="col-xxl-3 col-lg-4">
                <div class="static__card h-100 rounded-8 p-xxl-4 p-3 d-flex flex-column align-items-center justify-content-center gap-3"
                    data-bg-color="#EAFDF6">
                    <img src="{{ asset('Modules/Service/public/assets/img/admin/total-c.png') }}" alt="dashboard/grocery">
                    <div>
                        <h2 class="count mb-1 fz-24 ">
                            {{ \App\CentralLogics\Helpers::format_currency($provider->account->payable_balance) }}
                        </h2>
                        <div class="subtxt text-title fz--14px">{{ translate('Collect_Cash_From_Provider') }}</div>
                    </div>
                    <a href="#0" class="btn btn--primary mb-0"  data-toggle="modal" data-target="#collect-cash">
                        {{ translate('Collect_Cash_From_Provider') }}
                    </a>
                </div>
            </div>
            <div class="col-xxl-9 col-lg-8">
                <div class="row g-3">
                    <div class="col-sm-6 col-lg-6">
                        <div class="static__card rounded-8 p-xxl-4 p-3 d-flex align-items-center justify-content-between gap-2"
                            data-bg-color="#FFF7E7">
                            <div>
                                <h2 class="count mb-1 fz-24" data-text-color="#16ABCB">
                                    {{ \App\CentralLogics\Helpers::format_currency($provider->account->pending_balance) }}
                                </h2>
                                <div class="subtxt text-title fz--14px">{{ translate('Pending_withdraw') }}</div>
                            </div>
                            <img src="{{ asset('Modules/Service/public/assets/img/admin/pending-w.png') }}"
                                alt="dashboard/grocery">
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-6">
                        <div class="static__card rounded-8 p-xxl-4 p-3 d-flex align-items-center justify-content-between gap-2"
                            data-bg-color="#EAFDF6">
                            <div>
                                <h2 class="count mb-1 fz-24" data-text-color="#FEB019">
                                    {{ \App\CentralLogics\Helpers::format_currency($provider->account->total_withdrawn) }}
                                </h2>
                                <div class="subtxt text-title fz--14px">{{ translate('Total_withdrawal_amount') }}</div>
                            </div>
                            <img src="{{ asset('Modules/Service/public/assets/img/admin/total-w.png') }}"
                                alt="dashboard/grocery">
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-6">
                        <div class="static__card rounded-8 p-xxl-4 p-3 d-flex align-items-center justify-content-between gap-2"
                            data-bg-color="#FFF2F2">
                            <div>
                                <h2 class="count mb-1 fz-24" data-text-color="#00AA6D">
                                    {{ \App\CentralLogics\Helpers::format_currency($provider->account->receivable_balance) }}
                                </h2>
                                <div class="subtxt text-title fz--14px">{{ translate('Withdrawable_balance') }}</div>
                            </div>
                            <img src="{{ asset('Modules/Service/public/assets/img/admin/total-w.png') }}"
                                alt="dashboard/grocery">
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-6">
                        <div class="static__card rounded-8 p-xxl-4 p-3 d-flex align-items-center justify-content-between gap-2"
                            data-bg-color="#EAFBFF">
                            <div>
                                <h2 class="count mb-1 fz-24" data-text-color="#FF6D6D">
                                    {{ \App\CentralLogics\Helpers::format_currency($provider->account->received_balance + $provider->account->total_withdrawn) }}
                                </h2>
                                <div class="subtxt text-title fz--14px">{{ translate('Total_earning') }}</div>
                            </div>
                            <img src="{{ asset('Modules/Service/public/assets/img/admin/total-e.png') }}"
                                alt="dashboard/grocery">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- All Booking Showing -->
        <div class="card mb-3">
            <div class="card-body p-20">
                <div class="row g-3">
                    <div class="col-sm-6 col-lg-3">
                        <div class="p-20 py-3 d-flex align-items-center justify-content-between gap-2 bg-light rounded">
                            <h5 class="text-title mb-0">{{ translate('Accepted') }}</h5>
                            <h3 class="text-title mb-0">{{ $total['accepted'] }}</h3>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="p-20 py-3 d-flex align-items-center justify-content-between gap-2 bg-light rounded">
                            <h5 class="text-title mb-0">{{ translate('Completed') }}</h5>
                            <h3 class="mb-0" data-text-color="#008958">{{ $total['completed'] }}</h3>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="p-20 py-3 d-flex align-items-center justify-content-between gap-2 bg-light rounded">
                            <h5 class="text-title mb-0">{{ translate('Canceled') }}</h5>
                            <h3 class="mb-0" data-text-color="#FF5A54">{{ $total['canceled'] }}</h3>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="p-20 py-3 d-flex align-items-center justify-content-between gap-2 bg-light rounded">
                            <h5 class="text-title mb-0">{{ translate('Ongoing') }}</h5>
                            <h3 class="mb-0" data-text-color="#FEB019">{{ $total['ongoing'] }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Auto Focus -->
        <div class="card mb-3">
            <div class="card-body p-20">
                <div class="d-flex flex-lg-nowrap flex-wrap align-items-center gap-3">
                    <img width="100" height="100" src="{{ $provider->logo_full_path }}" alt="img"
                        class="border rounded">
                    <div class="w-100">
                        <h3 class="mb-3">{{ $provider->company_name }}</h3>
                        <div class="row g-3">
                            <div class="col-sm-6 col-lg-4">
                                <div class="d-flex align-items-center gap-2 align-items-center">
                                    <img width="36" height="36"
                                        src="{{ asset('Modules/Service/public/assets/img/admin/business-zone.png') }}"
                                        alt="img" class="rounded-circle">
                                    <div>
                                        <h5 class="mb-0">{{ translate('messages.address') }}</h5>
                                        <span class="fz-12px">{{ $provider->company_address }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <div class="d-flex align-items-center gap-2 align-items-center">
                                    <img width="36" height="36"
                                        src="{{ asset('Modules/Service/public/assets/img/admin/business-plan.png') }}"
                                        alt="img" class="rounded-circle">
                                    <div>
                                        <h5 class="mb-0">{{ translate('messages.business_plan') }}</h5>
                                        @if ($provider->business_model == 'subscription')
                                            {{translate('subscription')}}: <span>{{ $provider->store_sub?->package?->package_name ?? 'package not available' }}</span>
                                        @else
                                            {{translate('commission base')}}
                                        @endif
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-sm-6 col-lg-4">
                                <div class="d-flex align-items-center gap-2 align-items-center">
                                    <img width="36" height="36"
                                        src="{{ asset('Modules/Service/public/assets/img/admin/approx-time.png') }}"
                                        alt="img" class="rounded-circle">
                                    <div>
                                        <h5 class="mb-0">{{ translate('messages.approx_service_time') }}</h5>
                                        <span class="fz-12px">{{ $provider->minimum_service_time }} -
                                            {{ $provider->maximum_service_time }}
                                            {{ $provider->service_time_type }}</span>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- General Information -->
        <div class="card mb-20">
            <div class="card-body p-20">
                <div class="row g-3">
                    <div class="col-lg-6 col-md-6">
                        <div class="bg-light rounded p-3 h-100">
                            <h4 class="mb-3">{{ translate('General Information') }}</h4>
                            <div class="d-grid gap-1">
                                <div class="d-flex gap-2 fz--14px font-normal">
                                    {{ translate('Business Phone') }}:
                                    <strong class="text-title">{{ $provider->company_phone }}</strong>
                                </div>
                                <div class="d-flex gap-2 fz--14px font-normal">
                                    {{ translate('Business Zone') }}:
                                    <strong class="text-title">{{ $provider->zone->name }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="bg-light rounded p-3 h-100">
                            <h4 class="mb-3">{{ translate('Owner Information') }}</h4>
                            <div class="d-flex justify-content-between flex-wrap gap-1">
                                <div class="d-grid gap-1">
                                    <div class="d-flex gap-2 fz--14px font-normal">
                                        {{ translate('First Name') }}:
                                        <strong class="text-title">{{ $provider->first_name }}</strong>
                                    </div>
                                    <div class="d-flex gap-2 fz--14px font-normal">
                                        {{ translate('Last Name') }}:
                                        <strong class="text-title">{{ $provider->last_name }}</strong>
                                    </div>
                                </div>
                                <div class="d-grid gap-1">
                                    <div class="d-flex gap-2 fz--14px font-normal">
                                        {{ translate('Phone') }}:
                                        <strong class="text-title">{{ $provider->phone }}</strong>
                                    </div>
                                    <div class="d-flex gap-2 fz--14px font-normal">
                                        {{ translate('Email') }}:
                                        <strong class="text-title text-break">{{ $provider->email }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Identity Documents -->
        <div class="card">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-sm-6 col-lg-4">
                        <div class="bg-light rounded p-3 h-100">
                            <h4 class="mb-3">{{ translate('Identity Documents') }}</h4>
                            <div class="d-grid gap-1">
                                <div class="d-flex gap-2 fz--14px font-normal">
                                    {{ translate('Identification No') }}:
                                    <strong class="text-title">{{ $provider->identification_number }}</strong>
                                </div>
                                <div class="d-flex gap-2 fz--14px font-normal">
                                    {{ translate('Identification Type') }}:
                                    <strong class="text-title">{{ $provider->identification_type }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-8">
                        <div class="d-flex gap-3 flex-wrap">
                            @foreach ($provider->identification_images as $key => $value)
                                @php($vArray = explode('/', $value))
                                @php($fileName = end($vArray))
                                <div class="pdf-single h-190px" data-pdf-url="{{ $value }}">
                                    <div class="pdf-frame">
                                        <canvas class="pdf-preview display-none"></canvas>
                                        <img class="pdf-thumbnail" src="{{ $value }}" alt="File Thumbnail">
                                    </div>
                                    <div class="overlay">
                                        <a href="javascript:void(0);" class="download-btn" title="{{ $fileName }}">
                                            <i class="tio-download-to"></i>
                                        </a>
                                        <div class="pdf-info d-flex gap-10px align-items-center">
                                            <img src="{{ $value }}" width="34" alt="Document Logo">
                                            <div class="fs-13 text--title d-flex flex-column">

                                                <span class="file-name">{{ $fileName }}</span>
                                                <span class="opacity-50">{{ translate('Click to view The file') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="collect-cash" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{translate('messages.collect_cash_from_store')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.transactions.account-transaction.store')}}" method='post'
                          id="add_transaction">
                        @csrf
                        <input type="hidden" name="type" value="{{ PROVIDER }}">
                        <input type="hidden"  name="provider_id" value="{{ $provider->id }}">
                        <div class="form-group">
                            <label class="input-label">{{translate('messages.payment_method')}} <span
                                    class="input-label-secondary text-danger">*</span></label>
                            <input class="form-control" type="text" name="method" id="method" required maxlength="191"
                                   placeholder="{{translate('messages.Ex_:_Card')}}">
                        </div>
                        <div class="form-group">
                            <label class="input-label">{{translate('messages.reference')}}</label>
                            <input class="form-control" type="text" name="ref" id="ref" maxlength="191">
                        </div>
                        <div class="form-group">
                            <label class="input-label">{{translate('messages.amount')}} <span
                                    class="input-label-secondary text-danger">*</span></label>
                            <input class="form-control" type="number" min=".01" step="any" name="amount" id="amount"
                                   max="{{ $provider->account->payable_balance }}" placeholder="{{translate('messages.Ex_:_1000')}}">
                        </div>
                        <div class="btn--container justify-content-end">
                            <button type="submit" id="submit_new_customer"
                                    class="btn btn--primary">{{translate('submit')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="d-none" id="data-set" data-translate-are-you-sure="{{ translate('Are_you_sure?') }}"
        data-translate-no="{{ translate('no') }}" data-translate-yes="{{ translate('yes') }}"
        data-store-transaction-url="{{ route('admin.transactions.account-transaction.store') }}"
        data-translate-transaction-saved="{{ translate('messages.transaction_saved') }}"></div>

@endsection

@push('script_2')
    <!-- Page level plugins -->
    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ \App\Models\BusinessSetting::where('key', 'map_api_key')->first()->value }}&callback=initMap&v=3.45.8">
    </script>
    {{-- <script src="{{ asset('Modules/Service/public/assets/js/admin/provider-details.js') }}"></script> --}}

    <script>
        $('#add_transaction').on('submit', function (e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: $('#data-set').data('store-transaction-url'),
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data.errors) {
                        for (let i = 0; i < data.errors.length; i++) {
                            toastr.error(data.errors[i].message, {
                                CloseButton: true,
                                ProgressBar: true
                            });
                        }
                    } else {
                        /* toastr.success($('#data-set').data('translate-transaction-saved'), {
                            CloseButton: true,
                            ProgressBar: true
                        }); */
                        location.reload();
                        /* setTimeout(function () {
                            location.reload();
                        }, 2000); */
                    }
                }
            });
        });
    </script>
@endpush
