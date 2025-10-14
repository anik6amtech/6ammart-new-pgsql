@extends('layouts.admin.app')

@section('title', translate('messages.Provider_Preview'))

@push('css_or_js')
    <!-- Custom styles for this page -->
    <link href="{{ asset('public/assets/admin/css/croppie.css') }}" rel="stylesheet">
    <link href="{{ asset('Modules/Rental/public/assets/css/admin/provider-overview.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="content container-fluid">

        <div class="page-header pb-0">
            <div class="page-header">
                <div class="d-flex justify-content-between flex-wrap gap-3">
                    <div>
                        <h1 class="page-header-title text-break">
                            <span class="page-header-icon">
                                <img src="{{ asset('public/assets/admin/img/store.png') }}" class="w--22" alt="">
                            </span>
                            <span>{{ translate('messages.Provider_Preview') }}</span>
                        </h1>
                    </div>
                    <div class="d-flex align-items-start flex-wrap gap-2">
                        <a href="{{ route('admin.service.provider.edit', $provider->id)}}" class="btn btn--info font-weight-bold float-right mr-2 mb-0">
                            <i class="tio-edit"></i> {{ translate('messages.Edit & Approve') }}
                        </a>
                        @if($provider->is_approved != 2)
                            <a href="javascript:" data-href="{{route('admin.service.provider.update-approval',[$provider['id'], 'deny'])}}"
                                        data-id="vendor-{{$provider['id']}}" data-message="{{translate('You want to deny this provider')}}" title="{{translate('messages.deny_provider')}}" class="btn btn--danger font-weight-bold float-right mr-2 mb-0 form-alert22">
                                 {{ translate('messages.Reject') }}
                            </a>
                        @endif
                        <a href="javascript:" data-href="{{route('admin.service.provider.update-approval',[$provider['id'], 'approve'])}}"
                                       data-id="vendor-{{$provider['id']}}" data-message="{{translate('You want to approve this provider')}}" title="{{translate('messages.approve_provider')}}" class="btn btn--primary font-weight-bold float-right mr-2 mb-0 form-alert22">
                             {{ translate('messages.Approve') }}
                        </a>
                        <form action="#" method="get" id="vendor-{{$provider['id']}}"></form>
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
                                        <span class="fz-12px">
                                            @if ($provider->business_model == 'subscription')
                                                {{translate('subscription')}}: <span>{{ $provider->store_sub?->package?->package_name ?? 'package not available' }}</span>
                                            @else
                                                {{translate('commission base')}}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
{{--                            <div class="col-sm-6 col-lg-4">--}}
{{--                                <div class="d-flex align-items-center gap-2 align-items-center">--}}
{{--                                    <img width="36" height="36"--}}
{{--                                        src="{{ asset('Modules/Service/public/assets/img/admin/approx-time.png') }}"--}}
{{--                                        alt="img" class="rounded-circle">--}}
{{--                                    <div>--}}
{{--                                        <h5 class="mb-0">{{ translate('messages.approx_service_time') }}</h5>--}}
{{--                                        <span class="fz-12px">{{ $provider->minimum_service_time }} ---}}
{{--                                            {{ $provider->maximum_service_time }}--}}
{{--                                            {{ $provider->service_time_type }}</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
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
                                <div class="pdf-single" data-pdf-url="{{ $value }}">
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
    <script src="{{ asset('Modules/Service/public/assets/js/admin/provider-details.js') }}"></script>
    <script>
    $('.form-alert22').on('click',function (){
        let id = $(this).data('id');
        let message = $(this).data('message');
        let url = $(this).data('href');
        Swal.fire({
            title: '{{ translate('messages.Are you sure?') }}',
            text: message,
            type: 'warning',
            showCancelButton: true,
            cancelButtonColor: 'default',
            confirmButtonColor: '#FC6A57',
            cancelButtonText: '{{ translate('messages.no') }}',
            confirmButtonText: '{{ translate('messages.Yes') }}',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $('#'+id).attr('action', url).submit();
            }
        })
    })
</script>
@endpush
