@extends('layouts.admin.app')

@section('title', translate('messages.Additional_Setup'))

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header pb-20">
            <div class="d-flex justify-content-between flex-wrap gap-3">
                <div>
                    <h1 class="page-header-title">
                        <span class="page-header-icon">
                            <img src="{{ asset('Modules/RideShare/public/assets/img/ride-share/business-icon.png') }}" alt="" class="w--20px aspect-1-1">
                        </span>
                        <span>{{ translate('messages.Additional_Setup') }}</span>
                    </h1>
                </div>
            </div>
        </div>
        <div class="js-nav-scroller hs-nav-scroller-horizontal mb-4">
            @include('ride-share::admin.business-management.business-setup.partials._business-setup-inline')
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h4 class="text--title font-bold mb-0 d-flex gap-2 align-items-center lh-1">
                    <i class="fi fi-rr-settings"></i>
                    {{ translate('messages.General_settings') }}
                </h4>
            </div>
            <div class="card-body">
                <form action="{{route('admin.business-settings.ride-share.update-settings')}}" id="rides_form"
                      method="POST">
                    @csrf
                    <div class="row g-4">
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group mb-0">
                                <label for="" class="form-label d-flex">
                                    <span class="line--limit-1">
                                        {{ translate('messages.Ride_Commission') }} (%)
                                    </span>
                                    <span class="form-label-secondary text-danger d-flex" data-toggle="tooltip" data-placement="right" data-original-title="{{translate('Set the commission (in percentage) the admin will receive from riders')}}"><img src="{{ asset('public/assets/admin/img/info-circle.svg') }}" alt="{{ translate('messages.Ride_Commission') }}"></span>
                                </label>
                                <input type="number" name="ride_commission" value="{{$settings->firstWhere('key', 'ride_commission')?->value}}" id="" class="form-control" placeholder="Ex: 5">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group mb-0">
                                <label for="" class="form-label d-flex">
                                    <span class="line--limit-1">
                                        {{ translate('messages.vat') }} (%)
                                    </span>
                                    <span class="form-label-secondary text-danger d-flex" data-toggle="tooltip" data-placement="right" data-original-title="{{translate('Set the vat (in percentage) the admin will receive from customer')}}"><img src="{{ asset('public/assets/admin/img/info-circle.svg') }}" alt="{{ translate('messages.vat') }}"></span>
                                </label>
                                <input type="number" name="ride_vat" value="{{$settings->firstWhere('key', 'ride_vat')?->value}}" id="" class="form-control" placeholder="Ex: 5">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group mb-0">
                                <label for="" class="form-label d-flex">
                                    <span class="line--limit-1">
                                        {{ translate('messages.Search_Radius') }} ({{ translate('km')}})
                                    </span>
                                    <span class="form-label-secondary text-danger d-flex" data-toggle="tooltip" data-placement="right" data-original-title="{{translate('Customers can search for riders within the radius (in kilometer) you have set here. By default  it is set to 5 kilometers')}}"><img src="{{ asset('public/assets/admin/img/info-circle.svg') }}" alt="{{ translate('messages.Search_Radius') }}"></span>
                                </label>
                                <input type="number" name="search_radius" value="{{$settings->firstWhere('key', 'search_radius')?->value}}" id="" class="form-control" placeholder="Ex: 5">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group mb-0">
                                <label for="" class="form-label d-flex">
                                    <span class="line--limit-1">
                                        {{ translate('messages.Rider_completion_radius') }} ({{ translate('Meter')}})
                                    </span>
                                    <span class="form-label-secondary text-danger d-flex" data-toggle="tooltip" data-placement="right" data-original-title="{{translate('Riders can complete this ride within the radius (in meter) you have set here. By default  it is set to 10 meters')}}"><img src="{{ asset('public/assets/admin/img/info-circle.svg') }}" alt="{{ translate('messages.Rider_completion_radius') }}"></span>
                                </label>
                                <input type="number" name="rider_completion_radius" value="{{$settings->firstWhere('key', 'rider_completion_radius')?->value}}" id="" class="form-control" placeholder="Ex: 5">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group mb-0">
                                <label for="" class="form-label d-flex">
                                    <span class="line--limit-1">
                                        {{ translate('messages.Bid on fare') }}
                                    </span>
                                    <span class="form-label-secondary text-danger d-flex" data-toggle="tooltip" data-placement="right" data-original-title="{{ translate('When this option is enabled, then rider can negotiate fare with customer') }}"><img src="{{ asset('public/assets/admin/img/info-circle.svg') }}" alt="{{ translate('messages.Bid on fare') }}"></span>
                                </label>
                                <label
                                    class="toggle-switch h--45px toggle-switch-sm d-flex justify-content-between border rounded px-3 py-0 form-control">
                                    <span class="pr-1 d-flex align-items-center switch--label">
                                        <span class="line--limit-1">
                                            {{ translate('messages.Bid_on_fare_for_ride') }}
                                        </span>
                                    </span>
                                    <input type="checkbox" data-id="bid_on_fare" data-type="toggle"
                                        data-image-on="{{ asset('public/assets/admin/img/modal/prescription-on.png') }}"
                                        data-image-off="{{ asset('public/assets/admin/img/modal/prescription-off.png') }}"
                                        data-title-on="{{ translate('messages.Want_to_enable_Bid_for_Ride') }}"
                                        data-title-off="{{ translate('messages.Want_to_disable_Bid_for_Ride') }}"
                                        data-text-on="{{ translate('messages.If_enabled_this_feature_will_be_visible_in_the_Customer_App_and_Rider_App') }}"
                                        data-text-off="{{ translate('messages.If_disabled_this_feature_will_be_hidden_from_the_Customer_App_and_Rider_App') }}"
                                        class="status toggle-switch-input dynamic-checkbox-toggle" value="1" name="bid_on_fare"
                                        id="bid_on_fare" {{ $settings->firstWhere('key', 'bid_on_fare')?->value ? 'checked' : '' }}>
                                    <span class="toggle-switch-label text">
                                        <span class="toggle-switch-indicator"></span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn--primary min-w-120px">{{ translate('messages.submit') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('script_2')
    <script src="{{asset('public/assets/admin/js/view-pages/business-settings-order-page.js')}}"></script>
@endpush
