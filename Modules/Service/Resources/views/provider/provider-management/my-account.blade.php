@extends('service::provider.layouts.app')

@section('title', translate('messages.My_Account'))

@push('css_or_js')

@endpush

@section('content')

    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-20">
            <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
                <img width="24" height="24" src="{{asset('/public/assets/admin/img/myaccounts.png')}}" alt="services">
                {{translate('My Account')}}
            </h2>
            <div class="d-flex gap-2 align-items-center flex-wrap">
                <a href="{{ route('provider.service.profile.update') }}" type="button" class="btn btn--primary">
                    <i class="tio-edit"></i> {{translate('Edit Details')}}
                </a>
            </div>
        </div>

        <div class="mb-20">
            <div class="row g-3 justify-content-between">
                <div class="col-md-6">
                    <div class="card p-xl-4 p-3 h-100">
                        <div class="d-flex align-items-center gap-3 flex-lg-nowrap flex-wrap">
                            <img width="140" height="140" src="{{$provider->logo_full_path}}" alt="img" class="rounded-8">
                            <div>
                                <h4 class="mb-2"> {{Str::limit($provider->company_name, 30)}}</h4>
                                <div class="d-flex flex-column gap-1">
                                    <div class="d-flex align-items-center gap-1">
                                        <span class="d-block text-title"><i class="tio-android-phone"></i></span>
                                        <a href="tel:{{$provider->company_phone}}" class="fz--14px d-block" data-text-color="#334257">: {{$provider->company_phone}}</a>
                                    </div>
                                    <div class="d-flex align-items-center gap-1">
                                        <span class="d-block text-title"><i class="tio-messages-outlined"></i></span>
                                        <a href="mailto:{{$provider->company_email}}" class="fz--14px d-block" data-text-color="#334257">: {{$provider->company_email}}</a>
                                    </div>
                                    <div class="d-flex align-items-center gap-1">
                                        <span class="d-block text-title"><i class="tio-map-outlined"></i></span>
                                        <a href="#0" class="fz--14px d-block" data-text-color="#334257">: {{Str::limit($provider->company_address, 100)}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card p-xl-4 p-3 h-100">
                        <h3 class="mb-2" data-text-color="#334257B2">{{translate('Contact_Person_Information')}}</h3>
                        <h4 class="mb-1">{{Str::limit($provider->first_name.' '.$provider->last_name, 30)}}</h4>
                        <div class="d-flex flex-column gap-1">
                            <div class="d-flex align-items-center gap-1">
                                <span class="d-block text-title"><i class="tio-android-phone"></i></span>
                                <a href="tel:{{$provider->phone}}" class="fz--14px d-block" data-text-color="#334257">: {{$provider->phone}}</a>
                            </div>
                            <div class="d-flex align-items-center gap-1">
                                <span class="d-block text-title"><i class="tio-messages-outlined"></i></span>
                                <a href="mailto:{{$provider->email}}" class="fz--14px d-block" data-text-color="#334257">: {{$provider->email}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4 col-lg-4 col-xl-6">
                        <div>
                            <h4 class="mb-1">{{translate('Business Info')}}</h4>
                            <div class="d-flex flex-column gap-1">
                                <div class="d-flex align-items-center gap-1 mb-1">
                                    <span class="fs-12 d-block w-100px" data-text-color="#334257">{{translate('Identity Type')}}</span>
                                    <a href="#0" class="fs-12 d-block font-semibold text-title">: {{translate($provider->identification_type)}}</a>
                                </div>
                                <div class="d-flex align-items-center gap-1 mb-1">
                                    <span class="fs-12 d-block w-100px" data-text-color="#334257">{{translate($provider->identification_type)}}</span>
                                    <a href="#0" class="fs-12 d-block font-semibold text-title">: {{$provider->identification_number}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-lg-8 col-xl-6">
                        <h4 class="mb-20">{{translate('Identity Image')}}</h4>
                        <div class="row g-3">
                            @if(isset($provider->identification_image) && count(json_decode($provider->identification_image, true)) > 0)
                                @foreach($provider->identification_images as $key => $value)
                                    @php( $vArray = explode('/', $value))
                                    @php($fileName = end($vArray))
                                    <div class="col-sm-6">
                                        <div class="rounded-8 w-100">
                                            <img src="{{$value}}" alt="{{$fileName}}" class="rounded-8 w-100">
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
