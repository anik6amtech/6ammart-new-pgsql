@extends('layouts.admin.app')
<?php

$country=\App\Models\BusinessSetting::where('key','country')->first();
$countryCode= strtolower($country?$country->value:'auto');
?>
@section('title', translate('messages.Safety_&_Precaution'))

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
                        <span>{{ translate('messages.Safety_&_Precaution_Setup') }}</span>
                    </h1>
                </div>
            </div>
        </div>
        <div class="js-nav-scroller hs-nav-scroller-horizontal mb-4">
            @include('ride-share::admin.business-management.business-setup.partials.safety-precaution._safety-precaution-setup-inline')
        </div>

        {{-- demo modal button --}}
        {{-- <button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#toggle-modal">show modal</button> --}}
        {{-- demo modal button ends --}}

        <div class="card mb-4">
            <div class="card-header">
                <div>
                    <h4 class="text--title mb-0 text-capitalize">
                        {{ translate('messages.Safety_Feature') }}
                    </h4>
                    <p class="fs-12 mb-0">
                        {{ translate('messages.if_the_feature_is_on,_customer_and_drive_can_send_safety_alert_or_make_a_call_to_emergency_numbers._you_can_see_all_the_safety_alert_from_here.') }}
                    </p>
                </div>
                <div>
                    <label id="" class="toggle-switch toggle-switch-sm">
                        <input class="status toggle-switch-input update-business-setting"
                            id="safetyFeatureStatus"
                            type="checkbox"
                            name="safety_feature_status"
                            data-name="safety_feature_status"
                            data-type="{{SAFETY_FEATURE_SETTINGS}}"
                            data-url="{{route('admin.business-settings.ride-share.update-business-setting')}}"
                            data-icon=" {{($settings->firstWhere('key', 'safety_feature_status')->value ?? 0) == 1 ? asset('Modules/RideShare/public/assets/img/ride-share/shield.png') : asset('Modules/RideShare/public/assets/img/ride-share/shield.png')}}"
                            data-title="{{translate('Are you sure')}}?"
                            data-sub-title="{{
                                         ($settings->firstWhere('key', 'safety_feature_status')->value?? 0) == 1 ?
                                         translate('Do you want to turn Off '). "<b>" . translate('Safety Feature') ."</b>? " . translate("When it is off") . ', ' . translate('the customer and the driver can not send safety alert & communicate with emergency number.') :
                                         translate('Do you want to turn ON '). "<b>" . translate('Safety Feature') ."</b>? " . translate("When it is on") . ', ' . translate('the customer and the driver can send safety alert & communicate with emergency number.')
                                         }}"
                            data-confirm-btn="{{($settings->firstWhere('key', 'safety_feature_status')->value?? 0) == 1 ? translate('Turn Off') : translate('Turn On')}}"
                            data-target-content=".safety_view-card"
                        {{($settings->firstWhere('key', 'safety_feature_status')->value?? 0) == 1? 'checked' : ''}}
                        >
                        <span class="toggle-switch-label text">
                            <span class="toggle-switch-indicator"></span>
                        </span>
                    </label>
                </div>
            </div>
            <div class="card-body {{($settings->firstWhere('key', 'safety_feature_status')->value?? 0) == 1? '' : 'd--none'}}">
                <form action="{{ route('admin.business-settings.safety-precaution.store') }}" method="post">
                    @csrf
                    <div class="row g-3 align-items-center mb-4">
                        <div class="col-lg-4">
                            <div>
                                <h4 class="text--title mb-0 text-capitalize">
                                    {{ translate('messages.for_ride_delay') }}
                                </h4>
                                <p class="fs-12 mb-0">
                                    {{ translate('messages.Enter the minimum ride delay time.') }}
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="__bg-FAFAFA p-20 rounded-10">
                                <label for="" class="input-label d-flex">
                                    <span class="line--limit-1">
                                        {{ translate('messages.Minimum_Delay_Time') }}
                                    </span>
                                </label>
                                <div class="custom-group-btn justify-content-between">
                                    <div class="flex-grow-1">
                                        <input type="text" name="ride_safety_delay_time" value="{{ $settings->firstWhere('key', 'ride_safety_delay_time')?->value ?? null }}" class="form-control h--45px border-0"
                                            placeholder="Ex : 20">
                                    </div>
                                    <div class="flex-shrink-0">
                                        <select name="ride_safety_delay_time_format" id="delivery_time_type" class="custom-select border-0" required>
                                            <option
                                                value="minute" {{ $settings->firstWhere('key', 'ride_safety_delay_time_format')?->value== 'minute' ? 'selected' : '' }}> {{ translate('minute') }}</option>
                                            <option
                                                value="hour" {{ $settings->firstWhere('key', 'ride_safety_delay_time_format')?->value== 'hour' ? 'selected' : '' }}> {{ translate('hour') }}</option>
                                            <option
                                                value="second" {{ $settings->firstWhere('key', 'ride_safety_delay_time_format')?->value== 'second' ? 'selected' : '' }}> {{ translate('second') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 align-items-center">
                        <div class="col-lg-4">
                            <div>
                                <h4 class="text--title mb-0 text-capitalize">
                                    {{ translate('messages.After_Ride_Complete') }}
                                </h4>
                                <p class="fs-12 mb-0">
                                    {{ translate('messages.Enter the duration for how long the safety alert should be displayed on the ride details page after the ride completion.') }}
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="__bg-FAFAFA p-20 rounded-10">
                                <div class="form-group">
                                    <label for="" class="form-control border rounded bg-white d-flex justify-content-between align-items-center gap-3 mb-0 h-auto">
                                        <span class="text--title">{{ translate('messages.safety_feature_active_after_ride_completed') }}</span>
                                        <label id="" class="toggle-switch toggle-switch-sm">
                                            <input id="safety_feature_after_ride_complete_status" type="checkbox" name="safety_feature_after_ride_complete_status" value="1"
                                                class="toggle-switch-input dark" {{ $settings->firstWhere('key', 'safety_feature_after_ride_complete_status')?->value == '1' ? 'checked' : '' }}>
                                            <span class="toggle-switch-label text">
                                                <span class="toggle-switch-indicator"></span>
                                            </span>
                                        </label>
                                    </label>
                                </div>
                                <div id="safety_feature_after_ride_complete_status_label" class="{{ $settings->firstWhere('key', 'safety_feature_after_ride_complete_status')?->value == '1' ? '' : 'd--none' }}">
                                    <label for="" class="input-label d-flex">
                                        <span class="line--limit-1">
                                            {{ translate('messages.Set_Time') }}
                                        </span>
                                        <span class="input-label-secondary text-danger d-flex" data-toggle="tooltip" data-placement="right" data-original-title="When this field is active  user can cancel an order with proper reason."><img src="{{ asset('public/assets/admin/img/info-circle.svg') }}" alt=""></span>
                                    </label>
                                    <div class="custom-group-btn justify-content-between">
                                        <div class="flex-grow-1">
                                            <input type="text" name="safety_feature_after_ride_complete_time" value="{{ $settings->firstWhere('key', 'safety_feature_after_ride_complete_time')?->value ?? null }}" class="form-control h--45px border-0"
                                                placeholder="Ex : 20">
                                        </div>
                                        <div class="flex-shrink-0">
                                            <select name="safety_feature_after_ride_complete_time_format" id="delivery_time_type" class="custom-select border-0">
                                                <option
                                                    value="minute" {{ $settings->firstWhere('key', 'safety_feature_after_ride_complete_time_format')?->value == 'minute' ? 'selected' : '' }}> {{ translate('minute') }}</option>
                                                <option
                                                    value="hour" {{ $settings->firstWhere('key', 'safety_feature_after_ride_complete_time_format')?->value == 'hour' ? 'selected' : '' }}> {{ translate('hour') }}</option>
                                                <option
                                                    value="second" {{ $settings->firstWhere('key', 'safety_feature_after_ride_complete_time_format')?->value == 'second' ? 'selected' : '' }}> {{ translate('second') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-12">
                            <div class="btn--container  justify-content-end">
                                <button type="reset" id="reset_btn" class="btn btn--reset">{{ translate('messages.reset') }}</button>
                                <button type="submit" class="btn btn--primary">{{ translate('messages.submit') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mb-4 {{($settings->firstWhere('key', 'safety_feature_status')->value?? 0) == 1? '' : 'd--none'}}">
            <div class="card-header">
                <div>
                    <h4 class="text--title mb-0 text-capitalize">
                        {{ translate('messages.emergency_number_for_call') }}
                    </h4>
                    <p class="fs-12 mb-0">
                        {{ translate('messages.Enabling this option will allow customers and drivers to contact the emergency number during a ride.') }}
                    </p>
                </div>
                <div>
                    <label id="" class="toggle-switch toggle-switch-sm">
                        <input class="status toggle-switch-input update-business-setting"
                            id="emergencyNumberCallForStatus"
                           type="checkbox"
                           name="emergency_call_status"
                           data-name="emergency_call_status"
                           data-type="{{SAFETY_FEATURE_SETTINGS}}"
                           data-url="{{route('admin.business-settings.ride-share.update-business-setting')}}"
                           data-icon=" {{($settings->firstWhere('key', 'emergency_call_status')->value ?? 0) == 1 ? asset('Modules/RideShare/public/assets/img/ride-share/shield.png') : asset('Modules/RideShare/public/assets/img/ride-share/shield.png')}}"
                           data-title="{{translate('Are you sure')}}?"
                           data-sub-title="{{
                                                ($settings->firstWhere('key', 'emergency_call_status')->value?? 0) == 1 ?
                                                 translate('Do you want to turn OFF Emergency Number for Call option for driver and customer')."? ":
                                                 translate('Do you want to turn ON Emergency Number for Call option for driver and customer')."? "
                                                  }}"
                           data-confirm-btn="{{($settings->firstWhere('key', 'emergency_call_status')->value?? 0) == 1 ? translate('Turn Off') : translate('Turn On')}}"
                        {{($settings->firstWhere('key', 'emergency_call_status')->value?? 0) == 1? 'checked' : ''}}
                    >
                        <span class="toggle-switch-label text">
                            <span class="toggle-switch-indicator"></span>
                        </span>
                    </label>
                </div>
            </div>
            <div class="card-body {{($settings->firstWhere('key', 'emergency_call_status')->value?? 0) == 1? '' : 'd--none'}}">
                <form id="emergencyNumberForCallForm">
                    @csrf
                    <div class="row g-3 mb-4">
                        @php
                            $currentType = $settings->firstWhere('key', 'emergency_number_type')?->value ?? 'phone';
                            $currentValue = $settings->firstWhere('key', 'emergency_number')?->value ?? '';
                            // mapping for input attributes
                            $map = [
                                'phone' => ['type'=>'tel','placeholder'=>'017********'],
                                'telephone' => ['type'=>'tel','placeholder'=>'017********'],
                                'hotline' => ['type'=>'number','placeholder'=>'999'],
                            ];
                        @endphp

                        <div class="col-lg-6">
                            <div class="form-group mb-0">
                                <label class="input-label d-flex justify-content-between align-items-center gap-3">
                                    <span class="text--title">{{ translate('messages.choose_number_type') }}</span>
                                </label>
                                <div class="resturant-type-group border bg-white justify-content-between">
                                    @foreach(GOVT_EMERGENCY_NUMBER_TYPE as $key => $number_type)
                                        <label class="form-check form--check flex-grow-1">
                                            <input class="form-check-input" id="type_{{ $key }}" type="radio" name="emergency_number_type"
                                                value="{{ $key }}"
                                                {{ $currentType === $key ? 'checked' : '' }}>
                                            <span class="form-check-label">{{ translate($number_type) }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        @foreach(GOVT_EMERGENCY_NUMBER_TYPE as $key => $number_type)
                            @php
                                $attrs = $map[$key] ?? ['type'=>'text','placeholder'=>''];
                            @endphp
                            <div class="col-lg-6 emergency-input-wrapper {{ $currentType !== $key ? 'd-none' : '' }}"
                                data-type="{{ $key }}">
                                <div class="form-group mb-0">
                                    <label for="emergency_{{ $key }}" class="input-label d-flex">
                                        <span class="line--limit-1">
                                            {{ translate($number_type) . ' ' . translate('Number') }}
                                        </span>
                                        <span class="input-label-secondary text-danger d-flex"
                                            data-toggle="tooltip" data-placement="right"
                                            data-original-title="{{ translate('Hotline Number') }}">
                                            <img src="{{ asset('public/assets/admin/img/info-circle.svg') }}" alt="">
                                        </span>
                                    </label>
                                    <input type="{{ $attrs['type'] }}"
                                        id="emergency_{{ $key }}"
                                        name="emergency_{{ $key }}_number"
                                        class="form-control"
                                        placeholder="{{ translate('messages.Ex:') }} {{ $attrs['placeholder'] }}"
                                        value="{{ $settings->firstWhere('key', 'emergency_govt_number')?->value ?? '' }}">
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="">
                        <div class="">
                            <div class="view-advance-content d--none">
                                <div class="__bg-FAFAFA p-4 rounded-10">
                                    <div class="collapsible-card-body">
                                        <div class="order-number-row-container d-flex gap-2 gap-3 flex-column">
                                           @if($settings->firstWhere('key', 'emergency_other_number')?->value)
                                                @foreach($emergencyNumbers as $key => $value)
                                                    <div class="order-number-row d-flex gap-3 align-items-end">
                                                        <div class="flex-shrink-0 fs-16 fw-bold mb-3">{{ $key + 1 }}.
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <label class="form-label">{{ translate('Title') }}</label>
                                                            <input type="text" class="form-control"
                                                                   name="emergency_other_number_title[]"
                                                                   value="{{ $value['title'] ?? '' }}"
                                                                   placeholder="{{ translate('Ex: Medical') }}">
                                                        </div>
                                                        <div class="flex-grow-1 number-field-wrapper">
                                                            <label class="form-label">{{ translate('Number') }}</label>
                                                            <div class="">
                                                                <input type="tel"
                                                                       id="phone_number{{ $key }}"
                                                                       class="form-control w-100 text-dir-start"
                                                                       name="emergency_other_number_init[]"
                                                                       value="{{ $value['number'] ?? '' }}"
                                                                       placeholder="{{ translate('Ex: xxxxx xxxxxx') }}">
                                                                <input type="hidden"
                                                                       id="hidden-element{{ $key }}"
                                                                       name="emergency_other_number[]"
                                                                       value="{{ $value['number'] ?? '' }}">
                                                            </div>
                                                        </div>
                                                        <div class="flex-shrink-0 cursor-pointer order-number-close">
                                                            <i class="fi fi-rr-cross-circle fs-32 lh-1 text-danger"></i>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                            <div class="order-number-row d-flex gap-3 align-items-end"
                                                 data-extra-row="true">
                                                <div class="flex-shrink-0 fs-16 fw-bold mb-3">2.</div>
                                                <div class="flex-grow-1">
                                                    <label
                                                        class="form-label">{{ translate('title') }}</label>
                                                    <input type="text" min="0" class="form-control"
                                                           name="emergency_other_number_title[]"
                                                           placeholder="{{ translate('Ex : Medical') }}">
                                                </div>
                                                <div class="flex-grow-1">
                                                    <label
                                                        class="form-label">{{ translate('Number') }}</label>
                                                    <div class="">
                                                        <input type="tel"
                                                               id="phone_number"
                                                               value=""
                                                               name="emergency_other_number_init[]"
                                                               class="form-control w-100 text-dir-start"
                                                               placeholder="{{ translate('Ex: xxxxx xxxxxx') }}"
                                                        >
                                                        <input type="hidden"
                                                               id="hidden-element"
                                                               name="emergency_other_number[]"
                                                               value=""
                                                        >
                                                    </div>
                                                </div>
                                                <div class="flex-shrink-0 cursor-pointer order-number-close">
                                                    <i class="fi fi-rr-cross-circle fs-32 lh-1 text-danger"></i>
                                                </div>
                                                <div class="flex-shrink-0 cursor-pointer order-number-clone">
                                                    <i class="fi fi-rr-add fs-32 lh-1 text-primary"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center mt-4">
                                <a href="#"
                                    class="fs-16 text-nowrap d-flex gap-2 align-items-center lh-1 view-advance-btn">
                                    <i class="fi fi-rr-plus-small"></i>
                                    <span>{{ translate('messages.View_Advance') }}</span>
                                </a>
                            </div>
                        </div>

                        <div class="btn--container  justify-content-end mt-4">
                            {{-- <button type="reset" id="reset_btn" class="btn btn--reset">{{ translate('messages.reset') }}</button> --}}
                            <button type="submit" class="btn btn--primary">{{ translate('messages.submit') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mb-4 {{($settings->firstWhere('key', 'safety_feature_status')->value?? 0) == 1? '' : 'd--none'}}">
            <div class="card-header">
                <div>
                    <h4 class="text--title mb-0 text-capitalize">
                        {{ translate('messages.setup_safety_alert_reasons') }}
                    </h4>
                    <p class="fs-12 mb-0">
                        {{ translate('messages.if_the_toggle_is_turned_on,_customers_or_driver_will_see_a_list_of_reasons_when_sending_a_safety_alert.') }}
                    </p>
                </div>
                <div>
                    <label id="" class="toggle-switch toggle-switch-sm">
                        <input class="status toggle-switch-input update-business-setting"
                            id="safetyAlertReasonsStatus"
                            type="checkbox"
                            name="safety_alert_reason_status"
                            data-name="safety_alert_reason_status"
                            data-type="{{SAFETY_FEATURE_SETTINGS}}"
                            data-url="{{route('admin.business-settings.ride-share.update-business-setting')}}"
                            data-icon=" {{($settings->firstWhere('key', 'safety_alert_reason_status')->value ?? 0) == 1 ? asset('Modules/RideShare/public/assets/img/ride-share/shield.png') : asset('Modules/RideShare/public/assets/img/ride-share/shield.png')}}"
                            data-title="{{translate('Are you sure')}}?"
                            data-sub-title="{{
                                            ($settings->firstWhere('key', 'safety_alert_reason_status')->value?? 0) == 1 ?
                                             translate('Do you want to turn OFF Safety Alert Reasons option for customer and driver')."? ":
                                              translate('Do you want to turn ON Safety Alert Reasons option for customer and driver')."? "
                                              }}"
                           data-confirm-btn="{{($settings->firstWhere('key', 'safety_alert_reason_status')->value?? 0) == 1 ? translate('Turn Off') : translate('Turn On')}}"
                        {{($settings->firstWhere('key', 'safety_alert_reason_status')->value?? 0) == 1? 'checked' : ''}}
                    >
                        <span class="toggle-switch-label text">
                            <span class="toggle-switch-indicator"></span>
                        </span>
                    </label>
                </div>
            </div>
            <div class="card-body {{($settings->firstWhere('key', 'safety_alert_reason_status')->value?? 0) == 1? '' : 'd--none'}}">
                <div class="__bg-FAFAFA p-20 rounded-10">
                    <form
                        action="{{route('admin.business-settings.safety-precaution.safety-alert-reason.store')}}"
                        method="POST">
                        @csrf
                        <div class="row g-3 align-items-center">
                            <div class="col-lg-4">
                                <div>
                                    <h4 class="text--title mb-0 text-capitalize">
                                        {{ translate('messages.setup_safety_alert_reasons') }}
                                    </h4>
                                    <p class="fs-12 mb-0">
                                        {{ translate('messages.here_you_can_set_the_reasons_that_customers_or_diver_choose_when_safety_alert_send.') }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="bg-white p-20 rounded-10">
                                    @php($language = \App\Models\BusinessSetting::where('key', 'language')->first())
                                    @php($language = $language->value ?? null)
                                    @php($defaultLang = str_replace('_', '-', app()->getLocale()))
                                    @if ($language)
                                        <ul class="nav nav-tabs nav--tabs mb-3 border-0">
                                            <li class="nav-item">
                                                <a class="nav-link lang_link1 active" href="#"
                                                    id="default-link1">{{ translate('Default') }}</a>
                                            </li>
                                            @foreach (json_decode($language) as $lang)
                                                <li class="nav-item">
                                                    <a class="nav-link lang_link1" href="#"
                                                        id="{{ $lang }}-link1">{{ \App\CentralLogics\Helpers::get_language_name($lang) . '(' . strtoupper($lang) . ')' }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                    <label for="" class="input-label d-flex">
                                        <span class="line--limit-1 lang_form1 default-form1">
                                            {{ translate('messages.Safety_Alert_Reasons') }} ({{ translate('messages.default') }})
                                        </span>
                                        @if ($language)
                                            @foreach (json_decode($language) as $lang)
                                                <span class="line--limit-1 d-none lang_form1" id="{{ $lang }}-form2">
                                                    {{ translate('messages.Safety_Alert_Reasons') }} ({{ strtoupper($lang) }})
                                                </span>
                                            @endforeach
                                        @endif
                                    </label>
                                    <div class="custom-group-btn justify-content-between">
                                        <div class="flex-grow-1 lang_form1 default-form1">
                                            <input type="text" name="reason[]" value="" class="form-control h--45px border-0"
                                                placeholder="Ex: Driver taking unusual route">
                                            <input type="hidden" name="lang[]" value="default">
                                        </div>
                                        @if ($language)
                                            @foreach (json_decode($language) as $lang)
                                                <div class="flex-grow-1 d-none lang_form1" id="{{ $lang }}-form1">
                                                    <input type="text" name="reason[]" value="" class="form-control h--45px border-0"
                                                        placeholder="Ex: Driver taking unusual route">
                                                    <input type="hidden" name="lang[]" value="{{ $lang }}">
                                                </div>
                                            @endforeach
                                        @endif
                                        <div class="flex-shrink-0">
                                            <select name="reason_for_whom" id="reason_for_whom" class="custom-select border-0">
                                                <option value="{{ DRIVER }}" selected> {{ translate(DRIVER) }}</option>
                                                <option value="{{ CUSTOMER }}"> {{ translate(CUSTOMER) }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="btn--container  justify-content-end mt-4">
                                    <button type="submit" class="btn btn--primary">{{ translate('messages.submit') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card {{(($settings->firstWhere('key', 'safety_feature_status')->value?? 0) == 1) && (($settings->firstWhere('key', 'safety_alert_reason_status')->value?? 0) == 1)? '' : 'd--none'}}">
            <div class="card-header py-2">
                <div class="search--button-wrapper justify-content-between gap-20px">
                    <h5 class="card-title text--title flex-grow-1">{{ translate('messages.Safety_Alert_Reason_list') }}</h5>
                    {{-- <form class="search-form m-0 flex-grow-1 max-w-353px">

                        <div class="input-group input--group">
                            <input id="datatableSearch_" type="search" value="{{ request()?->search ?? null }}" name="search"
                                class="form-control"
                                placeholder="{{ translate('messages.Search_by_title') }}"
                                aria-label="{{ translate('messages.Search_by_title') }}">
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
                                href="{{ route('admin.rental.banner.export', ['type' => 'excel', request()->getQueryString()]) }}">
                                <img class="avatar avatar-xss avatar-4by3 mr-2"
                                    src="{{ asset('public/assets/admin') }}/svg/components/excel.svg" alt="Image Description">
                                {{ translate('messages.excel') }}
                            </a>
                            <a id="export-csv" class="dropdown-item"
                                href="{{ route('admin.rental.banner.export', ['type' => 'csv', request()->getQueryString()]) }}">
                                <img class="avatar avatar-xss avatar-4by3 mr-2"
                                    src="{{ asset('public/assets/admin') }}/svg/components/placeholder-csv-format.svg"
                                    alt="Image Description">
                                .{{ translate('messages.csv') }}
                            </a>

                        </div>
                    </div> --}}
                </div>
            </div>

            <div class="table-responsive datatable-custom">
                <table id="columnSearchDatatable"
                    class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table text--title">
                    <thead class="thead-light">
                        <tr>
                            <th class="border-0">{{ translate('messages.SL') }}</th>
                            <th class="border-0">{{ translate('messages.Reason') }}</th>
                            <th class="border-0">{{ translate('messages.For_Whom') }}</th>
                            <th class="border-0 text-center">{{ translate('messages.status') }}</th>
                            <th class="border-0 text-center">{{ translate('messages.action') }}</th>
                        </tr>
                    </thead>

                    <tbody id="set-rows">
                        @foreach ($safetyAlertReasons as $key => $safetyAlertReason)
                        <tr>
                            <td>{{ $key + $safetyAlertReasons->firstItem() }}</td>
                            <td>{{ $safetyAlertReason->reason }}</td>
                            <td> {{ ucwords($safetyAlertReason->reason_for_whom) }}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <label class="toggle-switch toggle-switch-sm"
                                        for="stocksCheckbox{{ $safetyAlertReason->id }}">
                                        <input type="checkbox"
                                                data-url="{{ route('admin.business-settings.safety-precaution.safety-alert-reason.status', [$safetyAlertReason['id'], $safetyAlertReason->is_active ? 0 : 1]) }}"
                                            class="toggle-switch-input redirect-url"
                                            id="stocksCheckbox{{ $safetyAlertReason->id }}"
                                            {{ $safetyAlertReason->is_active ? 'checked' : '' }}>
                                        <span class="toggle-switch-label">
                                            <span class="toggle-switch-indicator"></span>
                                        </span>
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="btn--container justify-content-center">
                                    <a class="btn btn-sm btn--primary btn-outline-primary action-btn edit-reason"
                                        title="{{ translate('messages.edit') }}"
                                        data-toggle="modal"
                                        data-target="#add_update_reason_{{ $safetyAlertReason->id }}"><i
                                            class="tio-edit"></i>
                                    </a>

                                    <a class="btn btn-sm btn--danger btn-outline-danger action-btn form-alert"
                                        href="javascript:"
                                        data-id="order-cancellation-reason-{{ $safetyAlertReason['id'] }}"
                                        data-message="{{ translate('messages.If_you_want_to_delete_this_reason,_please_confirm_your_decision.') }}"
                                        title="{{ translate('messages.delete') }}">
                                        <i class="tio-delete-outlined"></i>
                                    </a>
                                    <form
                                        action="{{ route('admin.business-settings.safety-precaution.safety-alert-reason.delete', $safetyAlertReason['id']) }}"
                                        method="post" id="order-cancellation-reason-{{ $safetyAlertReason['id'] }}">
                                        @csrf @method('delete')
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="add_update_reason_{{$safetyAlertReason->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ translate('messages.safety_alert_reason') }}
                                            {{ translate('messages.Update') }}</label></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('admin.business-settings.safety-precaution.safety-alert-reason.update', ['id' => $safetyAlertReason?->id]) }}" method="post">
                                        <div class="modal-body">
                                            @csrf

                                            @php($safetyAlertReason=  Modules\RideShare\Entities\BusinessManagement\SafetyAlertReason::withoutGlobalScope('translate')->with('translations')->find($safetyAlertReason->id))
                                            @php($language=\App\Models\BusinessSetting::where('key','language')->first())
                                            @php($language = $language->value ?? null)
                                            @php($defaultLang = str_replace('_', '-', app()->getLocale()))
                                            <ul class="nav nav-tabs nav--tabs mb-3 border-0">
                                                <li class="nav-item">
                                                    <a class="nav-link update-lang_link add_active active"
                                                    href="#"
                                                    id="default-link">{{ translate('Default') }}</a>
                                                </li>
                                                @if($language)
                                                @foreach (json_decode($language) as $lang)
                                                    <li class="nav-item">
                                                        <a class="nav-link update-lang_link"
                                                            href="#"
                                                            data-reason-id="{{$safetyAlertReason->id}}"
                                                            id="{{ $lang }}-link">{{ \App\CentralLogics\Helpers::get_language_name($lang) . '(' . strtoupper($lang) . ')' }}</a>
                                                    </li>
                                                @endforeach
                                                @endif
                                            </ul>

                                            <label for="" class="input-label d-flex">
                                                <span class="line--limit-1 add_active_2 update-lang_form" id="default-form_{{$safetyAlertReason->id}}_2">
                                                    {{ translate('messages.Safety_Alert_Reasons') }} ({{ translate('messages.default') }})
                                                </span>
                                                @if ($language)
                                                    @foreach (json_decode($language) as $lang)
                                                        <span class="line--limit-1 d-none update-lang_form" id="{{$lang}}-langform_{{$safetyAlertReason->id}}_2">
                                                            {{ translate('messages.Safety_Alert_Reasons') }} ({{ strtoupper($lang) }})
                                                        </span>
                                                    @endforeach
                                                @endif
                                            </label>
                                            <div class="custom-group-btn justify-content-between">
                                                <div class="flex-grow-1 add_active_2  update-lang_form" id="default-form_{{$safetyAlertReason->id}}">
                                                    <input type="text" name="reason[]" value="{{$safetyAlertReason?->getRawOriginal('reason')}}" class="form-control h--45px border-0"
                                                        placeholder="Ex: Driver taking unusual route">
                                                    <input type="hidden" name="lang[]" value="default">
                                                </div>
                                                @if ($language)
                                                    @foreach (json_decode($language) as $lang)

                                                        <?php
                                                            if($safetyAlertReason?->translations){
                                                                $translate = [];
                                                                foreach($safetyAlertReason?->translations as $t)
                                                                {
                                                                    if($t->locale == $lang && $t->key=="reason"){
                                                                        $translate[$lang]['reason'] = $t->value;
                                                                    }
                                                                }
                                                            }

                                                        ?>

                                                        <div class="flex-grow-1 d-none update-lang_form" id="{{$lang}}-langform_{{$safetyAlertReason->id}}">
                                                            <input type="text" name="reason[]" value="{{ $translate[$lang]['reason'] ?? null }}" class="form-control h--45px border-0"
                                                                placeholder="Ex: Driver taking unusual route">
                                                            <input type="hidden" name="lang[]" value="{{ $lang }}">
                                                        </div>
                                                    @endforeach
                                                @endif
                                                <div class="flex-shrink-0">
                                                    <select name="reason_for_whom" id="reason_for_whom" class="custom-select border-0">
                                                        <option value="{{ DRIVER }}" {{ $safetyAlertReason->reason_for_whom == DRIVER ? 'selected' : '' }}> {{ translate(DRIVER) }}</option>
                                                        <option value="{{ CUSTOMER }}" {{ $safetyAlertReason->reason_for_whom == CUSTOMER ? 'selected' : '' }}> {{ translate(CUSTOMER) }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ translate('Close') }}</button>
                                            <button type="submit" class="btn btn-primary">{{ translate('Save_changes') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    {{-- modal --}}
        <div class="modal fade" id="toggle-modal">
        <div class="modal-dialog modal-dialog-centered status-warning-modal">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true" class="tio-clear"></span>
                    </button>
                </div>
                <div class="modal-body pb-5 pt-0">
                    <div class="max-349 mx-auto mb-20">
                        <div>
                            <div class="text-center">
                                <img width="80" height="80" src="{{ asset('public/assets/admin/img/ride-share/shield.png') }}" alt="" class="mb-20 aspect-1-1">
                                <h3 class="text--title mb-2" id="toggle-title">{{ translate('messages.are_you_sure?') }}</h3>
                            </div>
                            <div class="text-center fs-12">
                                Do you want to turn On Safety Feature? When it’s on the customer and driver can send safety alert & communicate with emergency number.
                            </div>
                        </div>
                        <div class="btn--container justify-content-center mt-5">
                            <button id="reset_btn" type="reset" class="btn btn--reset min-w-120" data-dismiss="modal">
                                {{translate("Cancel")}}
                            </button>
                            <button type="button" id="toggle-ok-button" class="btn btn--primary min-w-120 confirm-Toggle" data-dismiss="modal" >{{translate('Turn_On')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{--Custom Modal Start--}}
<div class="modal fade" id="customModal">
    <div class="modal-dialog status-warning-modal">
        <div class="modal-content">
            <div class="modal-header border-0">
                    <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true" class="tio-clear"></span>
                </button>
            </div>
            <div class="modal-body pb-5 pt-0">
                <div class="max-349 mx-auto">
                    <div>
                        <div class="text-center">
                            <img alt="" class="mb-4" id="icon"
                                 src="{{asset('public/assets/admin-module/img/svg/blocked_customer.svg')}}">
                            <h5 class="modal-title mb-3" id="title">{{translate("Are you sure?")}}</h5>
                        </div>
                        <div class="text-center mb-4 pb-2">
                            <p id="subTitle">{{translate("Want to change status")}}</p>
                        </div>
                    </div>
                    <div class="btn--container justify-content-center">
                        <button type="button" class="btn btn--cancel min-w-120" id="modalCancelBtn">
                            {{translate('Cancel')}}
                        </button>
                        <button type="button" class="btn btn-primary min-w-120"
                                id="modalConfirmBtn">{{translate('Ok')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{--Custom Modal End--}}
<span class="system-default-country-code" data-value="{{ App\CentralLogics\Helpers::get_business_settings('country') ?? 'us' }}"></span>

@endsection

@push('script_2')
    <script src="{{asset('public/assets/admin/js/view-pages/business-settings-order-page.js')}}"></script>
<script>
    // view-advance-content
    $('.view-advance-btn').on('click', function (e) {
        e.preventDefault();

        const $btn = $(this);
        const $content = $('.view-advance-content');
        const span = $btn.find('span');
        const icon = $btn.find('i');

        const isVisible = $content.is(':visible');

        $content.slideToggle('fast');
        if (isVisible) {
            span.text("View Advance");
            icon.removeClass('fi-rr-minus-small').addClass('fi-rr-plus-small');
        } else {
            span.text("Hide Advance");
            icon.removeClass('fi-rr-plus-small').addClass('fi-rr-minus-small');
        }
    });

    $(document).ready(function () {
        "use strict";

        function renumberRows() {
            $('.order-number-row').each(function (index) {
                $(this).find('.fs-16').text((index + 1) + '.');
            });
        }

        function updateButtons() {
            $('.order-number-clone').addClass('d-none');
            $('.order-number-close').removeClass('d-none');

            const lastRow = $('.order-number-row').last();
            lastRow.find('.order-number-clone').removeClass('d-none');
            lastRow.find('.order-number-close').addClass('d-none');

            if ($('.order-number-row').length === 1) {
                $('.order-number-close').addClass('d-none');
            }
        }

        function initializePhoneInput(input) {
            const iti = window.intlTelInput(input, {
                initialCountry: "{{$countryCode}}",
                utilsScript: "{{ asset('public/assets/admin/intltelinput/js/utils.js') }}",
                autoInsertDialCode: true,
                nationalMode: false,
                formatOnDisplay: false,
            });
            input.intlTelInputInstance = iti;
        }

        $(document).on('click', '.order-number-close', function (e) {
            e.preventDefault();
            const row = $(this).closest('.order-number-row');
            const input = row.find('input[type="tel"]')[0];

            if (input && input.intlTelInputInstance) {
                input.intlTelInputInstance.destroy();
                delete input.intlTelInputInstance;
            }

            row.remove();
            renumberRows();
            updateButtons();
        });

        $(document).on('click', '.order-number-clone', function (e) {
            e.preventDefault();

            const originalRow = $(this).closest('.order-number-row');
            const clonedRow = originalRow.clone();

            // Generate unique IDs
            let newIndex = $('.order-number-row').length;
            let phoneInputId = `phone_number${newIndex}`;
            let hiddenElementId = `hidden-element${newIndex}`;
            while ($(`#${phoneInputId}`).length > 0 || $(`#${hiddenElementId}`).length > 0) {
                newIndex++;
                phoneInputId = `phone_number${newIndex}`;
                hiddenElementId = `hidden-element${newIndex}`;
            }

            // Remove intlTelInput wrapper
            clonedRow.find('.iti').children().unwrap();
            clonedRow.find('.iti__flag-container').remove();

            // Update IDs
            clonedRow.find('input[type="tel"]').attr('id', phoneInputId).val('');
            clonedRow.find('input[name="emergency_other_number[]"]').attr('id', hiddenElementId).val('');
            clonedRow.find('input[name="emergency_other_number_title[]"]').val('');

            // Insert and reinitialize
            originalRow.after(clonedRow);
            const newInput = document.getElementById(phoneInputId);
            initializePhoneInput(newInput);

            renumberRows();
            updateButtons();
        });

        // Initial load
        renumberRows();
        updateButtons();

        $('input[type="tel"]').each(function () {
            if (!this.intlTelInputInstance) {
                initializePhoneInput(this);
            }
        });

        $('#emergencyNumberForCallForm').on('submit', function (e) {
            e.preventDefault();

            $('.order-number-row').each(function () {
                const input = $(this).find('input[type="tel"]')[0];
                const hidden = $(this).find('input[name="emergency_other_number[]"]');

                if (input && input.intlTelInputInstance) {
                    const number = input.intlTelInputInstance.getNumber(); // Full international number
                    hidden.val(number);
                }
            });

            const formData = $(this).serialize();

            $.ajax({
                url: '{{ route('admin.business-settings.safety-precaution.emergency-number-for-call.store') }}',
                type: 'POST',
                data: formData,
                success: function (response) {
                    toastr.success(response.message);
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        showValidationErrors(xhr.responseJSON.errors);
                    } else {
                        toastr.error('An unexpected error occurred.');
                    }
                }
            });
        });

        function showValidationErrors(errors) {
            for (const key in errors) {
                if (errors.hasOwnProperty(key)) {
                    toastr.error(errors[key][0], 'Validation Error');
                }
            }
        }
    });

</script>
<script>
    let currentToggle = null;
    let currentStatus = 0;

    $(document).ready(function () {
        $('.update-business-setting').on('change', function (e) {
            e.preventDefault();

            currentToggle = this;
            currentStatus = $(this).prop('checked') ? 1 : 0;

            $('#icon').attr('src', $(this).data('icon'));
            $('#title').html($(this).data('title'));
            $('#subTitle').html($(this).data('sub-title'));
            $('#modalConfirmBtn').html($(this).data('confirm-btn'));
            $('#modalCancelBtn').html($(this).data('cancel-btn') ?? '{{ translate("Cancel") }}');

            $('#customModal').modal('show');
        });

        $('#modalConfirmBtn').off().on('click', function () {
            if (!currentToggle) return;

            const $el = $(currentToggle);
            $.ajax({
                url: $el.data('url'),
                _method: 'PUT',
                data: {
                    value: currentStatus,
                    name: $el.data('name'),
                    type: $el.data('type')
                },
                success: function () {
                    toastr.success("{{ translate('status_changed_successfully') }}");
                    // $('#customModal').modal('hide');
                    setTimeout(() => location.reload(), 1000);
                },
                error: function () {
                    toastr.error("{{ translate('status_change_failed') }}");
                    // $('#customModal').modal('hide');
                    resetCheckbox();
                }
            });
        });

        $('#modalCancelBtn').off().on('click', function () {
            $('#customModal').modal('hide');
            resetCheckbox();
        });

        $('#customModal').on('hidden.bs.modal', function () {
            resetCheckbox();
        });

        function resetCheckbox() {
            if (!currentToggle) return;
            $(currentToggle).prop('checked', !currentStatus);
            currentToggle = null;
        }

        $('#safety_feature_after_ride_complete_status').on('change', function () {
            if ($(this).is(':checked')) {
                $('#safety_feature_after_ride_complete_status_label').removeClass('d--none');
            } else {
                $('#safety_feature_after_ride_complete_status_label').addClass('d--none');
            }
        });
    });
</script>

<script>
    $(function(){
        $('input[name="emergency_number_type"]').on('change', function(){
            const sel = $(this).val();
            // hide all
            $('.emergency-input-wrapper').addClass('d-none');
            // show the one matching selected type
            $('.emergency-input-wrapper[data-type="'+ sel +'"]').removeClass('d-none');
        });
    });
</script>

@endpush
