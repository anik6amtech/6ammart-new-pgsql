@extends('layouts.admin.app')

@section('title', translate('messages.Additional_Settings'))

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

        <div class="card">
            <div class="card-header">
                <h4 class="text--title font-bold mb-0 d-flex gap-2 align-items-center lh-1">
                    <i class="fi fi-rr-settings"></i>
                    {{ translate('messages.fare_&_penalty_setting') }}
                </h4>
            </div>
            <div class="card-body">
                <form action="{{route('admin.business-settings.ride-fare.store')."?type=".TRIP_FARE_SETTINGS}}" id="fare_and_penalty_form" method="POST">
                        @csrf
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="form-group mb-0">
                                <label for="" class="form-label d-flex">
                                    <span class="line--limit-1">
                                        {{ translate('messages.start_count_idle_fee_after_(min)') }}
                                    </span>
                                    <span class="form-label-secondary text-danger d-flex" data-toggle="tooltip" data-placement="right" data-original-title="{{ translate('The idle fee will be applied after the specified time (in minutes)') . '.' . translate('No fees will be charged for durations shorter than this time') }}"><img src="{{ asset('public/assets/admin/img/info-circle.svg') }}" alt="{{ translate('messages.start_count_idle_fee_after_(min)') }}"></span>
                                </label>
                                <input type="number" name="min_idle_fee_time" id="" class="form-control" placeholder="Ex: 5" value="{{$settings->where('key', 'min_idle_fee_time')->first()?->value}}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-0">
                                <label for="" class="form-label d-flex">
                                    <span class="line--limit-1">
                                        {{ translate('messages.start_count_delay_fee_after_(min)') }}
                                    </span>
                                    <span class="form-label-secondary text-danger d-flex" data-toggle="tooltip" data-placement="right" data-original-title="{{ translate('The delay fee will be applied after the specified time (in minutes)') . '. ' .translate('No fees will be charged for durations shorter than this time') }}"><img src="{{ asset('public/assets/admin/img/info-circle.svg') }}" alt="{{ translate('messages.start_count_delay_fee_after_(min)') }}"></span>
                                </label>
                                <input type="number" name="min_delay_fee_time" id="" class="form-control" placeholder="Ex: 5" value="{{$settings->where('key', 'min_delay_fee_time')->first()?->value}}" required>
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
@endpush
