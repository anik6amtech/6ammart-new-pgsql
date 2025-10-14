@extends('service::provider.layouts.app')

@section('title',translate('Settings'))

@push('css_or_js')
    <!-- Custom styles for this page -->
    <link href="{{asset('public/assets/admin/css/croppie.css')}}" rel="stylesheet">

@endpush

@section('content')
    <div class="content container-fluid">
        <div class="page-header mb-20">
            <div class="d-flex align-items-sm-center align-items-start">
                <img src="{{asset('/public/assets/admin/img/setting-user.png')}}" width="25" height="25" alt="img">
                <div class="w-0 flex-grow pl-2">
                    <h2 class="page-header-title mb-0">{{translate($provider->company_name)}}</h2>
                </div>
            </div>
        </div>
        <form action="{{ route('provider.service.business-settings.update-setup', $provider->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card mb-20">
                <div class="card-body p-20">
                    <div class="row g-2 align-items-center justify-content-between">
                        <div class="col-lg-6 col-md-6">
                            <h4 class="mb-0">{{ translate('messages.service_temporarily_closed') }}</h4>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="border rounded d-flex align-items-center justify-content-between py-2 px-3">
                                <span class="fz--14px text-title d-block">{{ translate('messages.status') }}</span>
                                <label class="toggle-switch toggle-switch-sm" for="serviceStatus">
                                    <input type="checkbox" class="toggle-switch-input "
                                           id="serviceStatus" name="service_availability" value="1" {{ $provider->service_availability ? 'checked' : '' }}>
                                    <span class="toggle-switch-label">
                                    <span class="toggle-switch-indicator"></span>
                                </span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-20">
                <div class="p-20 border-bottom">
                    <h4 class="mb-1">{{ translate('messages.basic_settings') }}</h4>
                    <p class="m-0">{{ translate('messages.vendor_logo_and_covers') }}</p>
                </div>
                <div class="card-body p-20">
                    <div class="row g-4 align-items-end">
                        {{-- <div class="col-md-6 col-lg-4">
                            <div class="form-group mb-0">
                                <label class="form-label text-capitalize" for="vat">{{ translate('messages.vat_tax') }} <span
                                        class="text-danger">*</span></label>
                                <input type="number" name="provider_vat_percent" class="form-control" id="vat" min="1"
                                       placeholder="{{ translate('messages.ex_1') }}" value="{{ $settings['provider_vat_percent'] ?? '' }}" required>
                            </div>
                        </div> --}}
                        {{-- <div class="col-md-6 col-lg-4">
                            <div class="form-group mb-0">
                                <label class="input-label text-capitalize" for="maximum_delivery_time">{{ translate('messages.approximate_service_time') }} <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" name="minimum_service_time" class="form-control"
                                           placeholder="{{ translate('messages.min_10') }}" value="{{ $provider->minimum_service_time }}" data-toggle="tooltip" data-placement="top"
                                           data-original-title="{{ translate('messages.minimum_service_time') }}">
                                    <input type="number" name="maximum_service_time" class="form-control"
                                           placeholder="{{ translate('messages.max_20') }}" value="{{ $provider->maximum_service_time }}" data-toggle="tooltip" data-placement="top"
                                           data-original-title="{{ translate('messages.maximum_service_time') }}">
                                    <select name="service_time_type" class="custom-select max-w-100px bg-light text-capitalize"
                                            id="" required>
                                        <option value="min" {{ $provider->service_time_type == 'min' ? 'selected' : '' }}>{{ translate('messages.minutes') }}</option>
                                        <option value="hours" {{ $provider->service_time_type == 'hours' ? 'selected' : '' }}>{{ translate('messages.hours') }}</option>
                                        <option value="days" {{ $provider->service_time_type == 'days' ? 'selected' : '' }}>{{ translate('messages.days') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div> --}}
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group mb-0">
                                <label
                                    class="toggle-switch toggle-switch-sm d-flex justify-content-between border border-secondary rounded px-4 form-control"
                                    for="instantBooking">
                                    <span class="pr-2 font-400" data-text-color="#334257">{{ translate('messages.instant_booking') }}</span>
                                    <input type="checkbox" class="toggle-switch-input"
                                           id="instantBooking" name="instant_booking" value="1" {{ ($settings['instant_booking']??0) == 1 ? 'checked':'' }} >
                                    <span class="toggle-switch-label">
                                    <span class="toggle-switch-indicator"></span>
                                </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group mb-0">
                                <label
                                    class="toggle-switch toggle-switch-sm d-flex justify-content-between border border-secondary rounded px-4 form-control"
                                    for="repeatBooking">
                                    <span class="pr-2 font-400" data-text-color="#334257">{{ translate('messages.repeat_booking') }}</span>
                                    <input type="checkbox" name="repeat_booking" class="toggle-switch-input"
                                           id="repeatBooking" value="1" {{ ($settings['repeat_booking'] ?? 0) == 1 ? 'checked' : '' }}>
                                    <span class="toggle-switch-label">
                                    <span class="toggle-switch-indicator"></span>
                                </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group mb-0">
                                <label
                                    class="toggle-switch toggle-switch-sm d-flex justify-content-between border border-secondary rounded px-4 form-control"
                                    for="schedule_booking">
                                    <span class="pr-2 font-400" data-text-color="#334257">{{ translate('messages.schedule_booking') }}</span>
                                    <input type="checkbox" name="schedule_booking" class="toggle-switch-input"
                                           id="schedule_booking" value="1" {{ ($settings['schedule_booking'] ?? 0) == 1 ? 'checked' : '' }}>
                                    <span class="toggle-switch-label">
                                    <span class="toggle-switch-indicator"></span>
                                </span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="bg-light rounded p-3 mt-20">
                        <div class="row g-2 align-items-center">
                            <div class="col-xxl-6 col-lg-5 col-md-5">
                                <label class="form-check form--check mr-2 mr-md-4">
                                    <input class="form-check-input" type="checkbox" value="1"
                                           name="time_restriction_on_schedule_booking" {{ ($settings['time_restriction_on_schedule_booking'] ?? 0) == 1 ? 'checked' : '' }}>
                                    <span class="form-check-label font-400">
                                    {{ translate('messages.check_the_box_if_you_want_to_add_time_restriction_on_schedule_booking') }}
                                </span>
                                </label>
                            </div>
                            <div class="col-xxl-6 col-lg-7 col-md-7">
                                <div class="d-flex align-items-center restriction-time rounded border">
                                    <div class="flex-grow-1">
                                        <input class="form-control border-0" placeholder="Schedule Booking"
                                               type="number" value="{{ $settings['time_restriction_on_schedule_booking_value'] ?? '' }}" name="time_restriction_on_schedule_booking_value">
                                    </div>
                                    <select class="custom-select max-w-100px border-0 h--45px px-2" name="time_restriction_on_schedule_booking_type"
                                            data-bg-color="#F0F2F7">
                                        <option value="hours" {{ ($settings['time_restriction_on_schedule_booking_type'] ?? '') == 'hours' ? 'selected' : '' }}>{{ translate('messages.hours') }}</option>
                                        <option value="min" {{ ($settings['time_restriction_on_schedule_booking_type'] ?? '') == 'min' ? 'selected' : '' }}>{{ translate('messages.minutes') }}</option>
                                        <option value="days" {{ ($settings['time_restriction_on_schedule_booking_type'] ?? '') == 'days' ? 'selected' : '' }}>{{ translate('messages.days') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-light rounded p-3 mt-20">
                        <div class="row g-2 align-items-center">
                            <div class="col-xxl-6 col-lg-5 col-md-5">
                                <h3 class="mb-1">{{ translate('messages.choose_your_service_location') }}</h3>
                                <p class="m-0">{{ translate('messages.select_service_location_option') }}</p>
                            </div>
                            <div class="col-xxl-6 col-lg-7 col-md-7">
                                <div
                                    class="border rounded p-10px px-3 d-flex flex-lg-nowrap flex-wrap gap-1 align-items-center bg-white">
                                    <label class="form-check w-100 form--check mr-2 mr-md-4">
                                        <input class="form-check-input" type="checkbox" value="1"
                                               name="service_at_customer_location" {{ ($settings['service_at_customer_location'] ?? 0) == 1 ? 'checked' : '' }}>
                                        <span class="form-check-label fz--14px font-500">
                                        {{ translate('messages.go_to_customer_location') }}
                                    </span>
                                    </label>
                                    <label class="form-check w-100 form--check mr-2 mr-md-4">
                                        <input class="form-check-input" type="checkbox" value="1" name="service_at_provider_location" {{ ($settings['service_at_provider_location'] ?? 0) == 1 ? 'checked' : '' }}>
                                        <span class="form-check-label fz--14px font-500">
                                        {{ translate('messages.customer_will_come_to_my_location') }}
                                    </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-light rounded p-3 mt-20">
                        <div class="row g-2 align-items-center">
                            <div class="col-xxl-6 col-lg-5 col-md-5">
                                <h3 class="mb-1">{{ translate('messages.servicemen_permission') }}</h3>
                                <p class="m-0">{{ translate('messages.select_servicemen_permissions') }}</p>
                            </div>
                            <div class="col-xxl-6 col-lg-7 col-md-7">
                                <div
                                    class="border rounded p-10px px-3 d-flex flex-lg-nowrap flex-wrap gap-1 align-items-center bg-white">
                                    <label class="form-check w-100 form--check mr-2 mr-md-4">
                                        <input class="form-check-input" type="checkbox" value="1"
                                               name="serviceman_can_cancel_booking" {{ ($settings['serviceman_can_cancel_booking'] ?? 0) == 1 ? 'checked' : '' }}>
                                        <span class="form-check-label fz--14px font-500">
                                        {{ translate('messages.can_cancel_booking') }}
                                    </span>
                                    </label>
                                    <label class="form-check w-100 form--check mr-2 mr-md-4">
                                        <input class="form-check-input" type="checkbox" value="1" name="serviceman_can_edit_booking" {{ ($settings['serviceman_can_edit_booking'] ?? 0) == 1 ? 'checked' : '' }}>
                                        <span class="form-check-label fz--14px font-500">
                                        {{ translate('messages.can_edit_booking') }}
                                    </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="justify-content-end btn--container">
                            <button type="reset" class="btn btn--reset">{{translate('messages.reset')}}</button>
                            <button type="submit" class="btn btn--primary">{{translate('save_changes')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        {{-- @if (!config('module.'.$provider->module_type)['always_open']) --}}
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title">
                    <span class="card-header-icon"><i class="tio-clock"></i></span>
                    <span class="p-md-1">{{translate('messages.Daily time schedule')}}</span>
                </h5>
            </div>
            <div class="card-body" id="schedule">
                @include('service::provider.business-management.partials._schedule', $provider)
            </div>
        </div>
        {{-- @endif --}}
    </div>

    <!-- Create schedule modal -->

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-message="{{translate('messages.Create Schedule For ') }} ">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{translate('messages.Create Schedule')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="javascript:" method="post" id="add-schedule" data-route="{{route('provider.add-schedule')}}">
                        @csrf
                        <input type="hidden" name="day" id="day_id_input">
                        <input type="hidden" name="service_provider_id" value="{{$provider->id}}">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">{{translate('messages.Start time')}}:</label>
                            <input type="time" class="form-control" name="start_time" required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">{{translate('messages.End time')}}:</label>
                            <input type="time" class="form-control" name="end_time" required>
                        </div>
                        <button type="submit" class="btn btn-primary">{{translate('messages.Submit')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="title" data-title="{{ translate('Want_to_delete_this_schedule?') }}"></div>
    <div id="subTitle" data-sub-title="{{ translate('If_you_select_Yes,_the_time_schedule_will_be_deleted') }}"></div>
    <div id="buttonNo" data-no="{{ translate('no') }}"></div>
    <div id="buttonYes" data-yes="{{ translate('yes') }}"></div>
    <div id="removed" data-removed="{{ translate('messages.Schedule removed successfully') }}"></div>
    <div id="added" data-added="{{ translate('messages.Schedule added successfully') }}"></div>
    <div id="notFound" data-not-found="{{ translate('Schedule not found') }}"></div>

@endsection

@push('script_2')
    <script src="{{asset('Modules/Rental/public/assets/js/admin/view-pages/provider-setting.js')}}"></script>
@endpush
