@extends('layouts.admin.app')

@section('title', translate('messages.Update Provider'))

@push('css_or_js')
    {{-- <link rel="stylesheet" href="{{asset('Modules/Rental/public/assets/css/admin/provider-create.css')}}"> --}}
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header pb-20">
            <div class="d-flex justify-content-between flex-wrap gap-3">
                <div>
                    <h1 class="page-header-title text-break">
                        <span class="page-header-icon">
                            <img src="{{ asset('public/assets/admin/img/provider.png') }}" class="w--22" alt="">
                        </span>
                        <span>{{ translate('messages.Update Provider') }}
                        </span>
                    </h1>

                </div>
            </div>
        </div>

        <!-- End Page Header -->
        <form action="{{ route('admin.service.provider.update', $provider->id) }}" method="post"
            enctype="multipart/form-data" id="providerFormSubmit">
            @csrf
            @method('PUT')

            <div id="businessSetup">
                <div class="custom-timeline d-flex flex-wrap gap-40px text-title mb-2">
                    <h4 class="single">{{ translate('Business Basic Setup') }}</h4>
                    {{-- <h4 class="single opacity-70"><span class="count2">2</span>{{ translate('Business Plan Setup') }}</h4> --}}
                </div>

                <div class="row g-2">
                    <div class="col-lg-12">
                        <div class="card mt-4">
                            <div class="card-header">
                                <div>
                                    <h5 class="text-title mb-1">
                                        {{ translate('messages.General_Info') }}
                                    </h5>
                                    <p class="fs-12 mb-0">
                                        {{ translate('messages. Insert the basic information of the provider ') }}
                                    </p>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-lg-6">
                                        <div class="card __bg-FAFAFA border-0">
                                            <div class="card-body">
                                                @if ($language)
                                                    <ul class="nav nav-tabs mb-4 flex-nowrap">
                                                        <li class="nav-item">
                                                            <a class="nav-link lang_link text-nowrap active" href="#"
                                                                id="default-link">{{ translate('Default') }}</a>
                                                        </li>
                                                        @foreach ($language as $lang)
                                                            <li class="nav-item">
                                                                <a class="nav-link lang_link text-nowrap" href="#"
                                                                    id="{{ $lang }}-link">{{ \App\CentralLogics\Helpers::get_language_name($lang) . '(' . strtoupper($lang) . ')' }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                                @if ($language)
                                                    <div class="lang_form" id="default-form">
                                                        <div class="form-group">
                                                            <label class="input-label"
                                                                for="default_name">{{ translate('messages.name') }}
                                                                ({{ translate('messages.Default') }})
                                                            </label>
                                                            <input type="text" name="name[]" id="default_name"
                                                                class="form-control"
                                                                placeholder="{{ translate('messages.provider_name') }}"
                                                                value="{{ $provider->getRawOriginal('company_name') }}"
                                                                required>
                                                        </div>
                                                        <input type="hidden" name="lang[]" value="default">
                                                        <div class="form-group mb-0">
                                                            <label class="input-label"
                                                                for="exampleFormControlInput1">{{ translate('messages.address') }}
                                                                ({{ translate('messages.default') }})</label>
                                                            <textarea type="text" name="address[]" placeholder="{{ translate('messages.provider address') }}"
                                                                class="form-control min-h-90px ckeditor">{{ $provider->getRawOriginal('company_address') }}</textarea>
                                                        </div>
                                                    </div>
                                                    @foreach ($language as $lang)
                                                        <?php
                                                        if (count($provider['translations'])) {
                                                            $translate = [];
                                                            foreach ($provider['translations'] as $t) {
                                                                if ($t->locale == $lang && $t->key == 'company_name') {
                                                                    $translate[$lang]['company_name'] = $t->value;
                                                                }
                                                                if ($t->locale == $lang && $t->key == 'company_address') {
                                                                    $translate[$lang]['company_address'] = $t->value;
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                        <div class="d-none lang_form" id="{{ $lang }}-form">
                                                            <div class="form-group">
                                                                <label class="input-label"
                                                                    for="{{ $lang }}_name">{{ translate('messages.name') }}
                                                                    ({{ strtoupper($lang) }})
                                                                </label>
                                                                <input type="text" name="name[]"
                                                                    id="{{ $lang }}_name" class="form-control"
                                                                    value="{{ $translate[$lang]['company_name'] ?? '' }}"
                                                                    placeholder="{{ translate('messages.provider_name') }}">
                                                            </div>
                                                            <input type="hidden" name="lang[]"
                                                                value="{{ $lang }}">
                                                            <div class="form-group mb-0">
                                                                <label class="input-label"
                                                                    for="exampleFormControlInput1">{{ translate('messages.address') }}
                                                                    ({{ strtoupper($lang) }})</label>
                                                                <textarea type="text" name="address[]" placeholder="{{ translate('messages.provider address') }}"
                                                                    class="form-control min-h-90px ckeditor">{{ $translate[$lang]['company_address'] ?? '' }}</textarea>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div id="default-form">
                                                        <div class="form-group">
                                                            <label class="input-label"
                                                                for="exampleFormControlInput1">{{ translate('messages.name') }}
                                                                ({{ translate('messages.default') }})</label>
                                                            <input type="text" name="name[]" class="form-control"
                                                                placeholder="{{ translate('messages.provider_name') }}"
                                                                required>
                                                        </div>
                                                        <input type="hidden" name="lang[]" value="default">
                                                        <div class="form-group mb-0">
                                                            <label class="input-label"
                                                                for="exampleFormControlInput1">{{ translate('messages.address') }}
                                                            </label>
                                                            <textarea type="text" name="address[]" placeholder="{{ translate('messages.provider address') }}"
                                                                class="form-control min-h-90px ckeditor"></textarea>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row g-2">
                                            <div class="col-md-6">
                                                <div class="form-group mb-0 mt-3">
                                                    <label class="input-label" for="email">{{ translate('messages.business_email_address') }} <span class="text-danger">*</span></label>
                                                    <input type="email" id="business_email" name="business_email" value="{{ $provider->company_email }}" class="form-control"
                                                           placeholder="{{ translate('messages.Ex:') }} abc@gmail.com"
                                                           required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-0 mt-3">
                                                    <label class="input-label" for="phone">{{ translate('messages.business_phone_number') }} <span class="text-danger">*</span></label>
                                                    <input type="tel" id="business_phone" name="business_phone" value="{{ $provider->company_phone }}" class="form-control business-phone-input"
                                                           placeholder="{{ translate('messages.Ex:') }} 017********"
                                                           required>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-lg-6">
                                        <div class="d-flex flex-column flex-sm-row gap-4">
                                            <div class="__custom-upload-img">
                                                <label class="form-label mb-1">
                                                    {{ translate('logo') }}
                                                </label>
                                                <div class="mb-20">
                                                    <p class="fs-12 max-width-170px">
                                                        {{ translate('JPG, JPEG, PNG Less Than 2MB') }} <strong
                                                            class="font-semibold">({{ translate('Ratio 1:1') }})</strong>
                                                    </p>
                                                </div>
                                                <label
                                                    class="position-relative d-inline-block image--border cursor-pointer w-100 h-165 max-w-165">
                                                    <img class="h-165 aspect-ratio-1 rounded-10" id="logoImageViewer"
                                                        onerror="this.onerror=null; this.className='h-165 aspect-ratio-1 rounded-10 display-none';this.nextElementSibling.style.display='flex';"
                                                        data-onerror-image="{{ asset('public/assets/admin/img/upload-img.png') }}"
                                                        src="{{ $provider->logo_full_path }}" alt="logo image" />
                                                    <div class="upload-file__textbox p-2 h-100" style="display: none;">
                                                        <img width="34" height="34"
                                                            src="{{ asset('public/assets/admin/img/document-upload.png') }}"
                                                            alt="" class="svg">
                                                        <h6 class="mt-2 text-center font-semibold fs-12">
                                                            <span
                                                                class="text-info">{{ translate('messages.Click to upload') }}</span>
                                                            <br>
                                                            {{ translate('messages.or drag and drop') }}
                                                        </h6>
                                                    </div>
                                                    <div class="icon-file-group outside">
                                                        <input type="file" name="logo" id="customFileEg1"
                                                            class="custom-file-input req-file"
                                                            accept=".webp, .jpg, .png, .jpeg|image/*">
                                                    </div>
                                                </label>
                                            </div>

                                            <div class="__custom-upload-img">
                                                <label class="form-label mb-1">
                                                    {{ translate('Cover') }}
                                                </label>
                                                <div class="mb-20">
                                                    <p class="fs-12">
                                                        {{ translate('JPG, JPEG, PNG Less Than 2MB') }}
                                                        <br>
                                                        <strong
                                                            class="font-semibold">({{ translate('Ratio 2:1') }})</strong>
                                                    </p>
                                                </div>
                                                <label
                                                    class="position-relative d-inline-block image--border cursor-pointer w-100 h-165 min-w-330 min-w-100-mobile">
                                                    <img class="img--vertical-2 h-165 rounded-10 image--border"
                                                        id="coverImageViewer"
                                                        onerror="this.onerror=null; this.className='h-165 aspect-ratio-1 rounded-10 display-none';this.nextElementSibling.style.display='flex';"
                                                        data-onerror-image="{{ asset('public/assets/admin/img/upload-img.png') }}"
                                                        src="{{ $provider->cover_image_full_path }}" alt="Fav icon" />
                                                    <div class="upload-file__textbox p-2 h-100" style="display: none;">
                                                        <img width="34" height="34"
                                                            src="{{ asset('public/assets/admin/img/document-upload.png') }}"
                                                            alt="" class="svg">
                                                        <h6 class="mt-2 text-center font-semibold fs-12">
                                                            <span
                                                                class="text-info">{{ translate('messages.Click to upload') }}</span>
                                                            <br>
                                                            {{ translate('messages.or drag and drop') }}
                                                        </h6>
                                                    </div>
                                                    <div class="icon-file-group outside">

                                                        <input type="file" name="cover_photo" id="coverImageUpload"
                                                            class="custom-file-inpu  req-file"
                                                            accept=".webp, .jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <div>
                                    <h5 class="text-title mb-1">
                                        {{ translate('messages.Business_Info') }}
                                    </h5>
                                    <p class="fs-12 mb-0">
                                        {{ translate('messages.Insert the necessary information to operate the business') }}
                                    </p>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row g-3 my-0">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="input-label font-semibold"
                                                for="choice_zones">{{ translate('messages.business_zone') }}
                                                <span class="form-label-secondary" data-toggle="tooltip"
                                                    data-placement="right"
                                                    data-original-title="{{ translate('messages.Select the zone from where the business will be operated') }}">
                                                    <i class="tio-info text--title opacity-60"></i>
                                                </span>
                                            </label>
                                            <select name="zone_id"
                                                data-zone-coordinates-url="{{ route('admin.zone.get-coordinates', ['id' => 'PLACEHOLDER_ID']) }}"
                                                id="choice_zones" required class="form-control js-select2-custom"
                                                data-placeholder="{{ translate('messages.select_zone') }}">
                                                <option value="" selected disabled>
                                                    {{ translate('messages.select_zone') }}</option>
                                                @foreach ($zones as $zone)
                                                    @if ($provider->zone_id == $zone->id)
                                                        <option value="{{ $zone->id }}" selected>{{ $zone->name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $zone->id }}">{{ $zone->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label class="input-label"
                                                for="latitude">{{ translate('messages.latitude') }}
                                                <span class="input-label-secondary"
                                                    title="{{ translate('messages.provider_lat_lng_warning') }}"><img
                                                        src="{{ asset('/public/assets/admin/img/info-circle.svg') }}"
                                                        alt="{{ translate('messages.provider_lat_lng_warning') }}"></span></label>
                                            <input type="text" id="latitude" name="latitude"
                                                class="form-control __form-control"
                                                placeholder="{{ translate('messages.Ex:') }} -94.22213"
                                                value="{{ $provider->coordinates['latitude'] ?? '' }}" required readonly>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label class="input-label"
                                                for="longitude">{{ translate('messages.longitude') }}
                                                <span class="input-label-secondary"
                                                    title="{{ translate('messages.provider_lat_lng_warning') }}"><img
                                                        src="{{ asset('/public/assets/admin/img/info-circle.svg') }}"
                                                        alt="{{ translate('messages.provider_lat_lng_warning') }}"></span></label>
                                            <input type="text" name="longitude" class="form-control __form-control"
                                                placeholder="{{ translate('messages.Ex:') }} 103.344322" id="longitude"
                                                value="{{ $provider->coordinates['longitude'] ?? '' }}" required readonly>
                                        </div>
                                        {{--<div class="position-relative">
                                            <label class="input-label font-semibold"
                                                for="tax">{{ translate('Approx. Service Time') }}</label>
                                            <div class="custom-group-btn">
                                                <div class="item flex-sm-grow-1">
                                                    <label class="floating-label"
                                                        for="min">{{ translate('Min') }}:</label>
                                                    <input id="min" type="number" name="minimum_service_time"
                                                        value="{{ $provider->minimum_service_time ?? '' }}"
                                                        class="form-control h--45px border-0"
                                                        placeholder="{{ translate('messages.Ex :') }} 20"
                                                        pattern="^[0-9]{2}$" required>
                                                </div>
                                                <div class="separator"></div>
                                                <div class="item flex-sm-grow-1">
                                                    <label class="floating-label"
                                                        for="max">{{ translate('Max') }}:</label>
                                                    <input id="max" type="number" name="maximum_service_time"
                                                        value="{{ $provider->maximum_service_time ?? '' }}"
                                                        class="form-control h--45px border-0"
                                                        placeholder="{{ translate('messages.Ex :') }} 30"
                                                        pattern="[0-9]{2}$" required>
                                                </div>
                                                <div class="separator"></div>
                                                <div class="item flex-shrink-0">
                                                    <select name="service_time_type" id="service_time_type"
                                                        class="custom-select border-0">
                                                        <option value="min"
                                                            {{ $provider->service_time_type == 'min' ? 'selected' : '' }}>
                                                            {{ translate('messages.minutes') }}
                                                        </option>
                                                        <option value="hours"
                                                            {{ $provider->service_time_type == 'hours' ? 'selected' : '' }}>
                                                            {{ translate('messages.hours') }}
                                                        </option>
                                                        <option value="days"
                                                            {{ $provider->service_time_type == 'days' ? 'selected' : '' }}>
                                                            {{ translate('messages.days') }}
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>--}}
                                    </div>
                                    <div class="col-lg-6">
                                        <input id="pac-input1" class="controls rounded" data-toggle="tooltip"
                                            data-placement="right"
                                            data-original-title="{{ translate('messages.search_your_location_here') }}"
                                            type="text" placeholder="{{ translate('messages.search_here') }}" />
                                        <div id="map" class="min-h-100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <div>
                                    <h5 class="text-title mb-1">
                                        {{ translate('messages.owner_information') }}
                                    </h5>
                                    <p class="fs-12 mb-0">
                                        {{ translate('messages.Add the information of the Owner who operate the business') }}
                                    </p>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-group mb-0">
                                            <label class="input-label"
                                                for="f_name">{{ translate('messages.first_name') }}</label>
                                            <input type="text" name="f_name" class="form-control" id="f_name"
                                                placeholder="{{ translate('messages.first_name') }}"
                                                value="{{ $provider->first_name }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-group mb-0">
                                            <label class="input-label"
                                                for="l_name">{{ translate('messages.last_name') }}</label>
                                            <input type="text" name="l_name" class="form-control" id="l_name"
                                                placeholder="{{ translate('messages.last_name') }}"
                                                value="{{ $provider->last_name }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-group mb-0">
                                            <label class="input-label"
                                                for="phone">{{ translate('messages.phone') }}</label>
                                            <input type="tel" id="phone" name="phone" class="form-control"
                                                placeholder="{{ translate('messages.Ex:') }} 017********"
                                                value="{{ $provider->phone }}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <div>
                                    <h5 class="text-title mb-1">
                                        {{ translate('messages.account_information') }}
                                    </h5>
                                    <p class="fs-12 mb-0">
                                        {{ translate('messages.Insert the necessary information to account information') }}
                                    </p>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-group mb-0">
                                            <label class="input-label"
                                                for="exampleFormControlInput1">{{ translate('messages.email') }}</label>
                                            <input type="email" name="email" class="form-control" id="email"
                                                placeholder="{{ translate('messages.Ex:') }} ex@example.com"
                                                value="{{ $provider->email }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="js-form-message form-group mb-0">
                                            <label class="input-label"
                                                for="signupSrPassword">{{ translate('password') }}<span
                                                    class="form-label-secondary" data-toggle="tooltip"
                                                    data-placement="right"
                                                    data-original-title="{{ translate('messages.Must_contain_at_least_one_number_and_one_uppercase_and_lowercase_letter_and_symbol,_and_at_least_8_or_more_characters') }}">
                                                    <i class="tio-info text--title opacity-60"></i>
                                                </span></label>

                                            <div class="input-group input-group-merge">
                                                <input type="password" class="js-toggle-password form-control"
                                                    name="password" id="signupSrPassword"
                                                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                                    title="{{ translate('messages.Must_contain_at_least_one_number_and_one_uppercase_and_lowercase_letter_and_symbol,_and_at_least_8_or_more_characters') }}"
                                                    placeholder="{{ translate('messages.password_length_placeholder', ['length' => '8+']) }}"
                                                    aria-label="8+ characters required"
                                                    data-msg="Your password is invalid. Please try again."
                                                    data-hs-toggle-password-options='{
                                                "target": [".js-toggle-password-target-1", ".js-toggle-password-target-2"],
                                                "defaultClass": "tio-hidden-outlined",
                                                "showClass": "tio-visible-outlined",
                                                "classChangeTarget": ".js-toggle-passowrd-show-icon-1"
                                                }'>
                                                <div class="js-toggle-password-target-1 input-group-append">
                                                    <a class="input-group-text" href="javascript:;">
                                                        <i class="js-toggle-passowrd-show-icon-1 tio-visible-outlined"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="password-feedback" class="pass password-feedback">
                                            {{ translate('messages.password_not_matched') }}
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="js-form-message form-group mb-0">
                                            <label class="input-label"
                                                for="signupSrConfirmPassword">{{ translate('messages.Confirm Password') }}</label>

                                            <div class="input-group input-group-merge">
                                                <input type="password" class="js-toggle-password form-control"
                                                    name="password_confirmation" id="signupSrConfirmPassword"
                                                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                                    title="{{ translate('messages.Must_contain_at_least_one_number_and_one_uppercase_and_lowercase_letter_and_symbol,_and_at_least_8_or_more_characters') }}"
                                                    placeholder="{{ translate('messages.password_length_placeholder', ['length' => '8+']) }}"
                                                    aria-label="8+ characters required"
                                                    data-msg="Password does not match the confirm password."
                                                    data-hs-toggle-password-options='{
                                                    "target": [".js-toggle-password-target-1", ".js-toggle-password-target-2"],
                                                    "defaultClass": "tio-hidden-outlined",
                                                    "showClass": "tio-visible-outlined",
                                                    "classChangeTarget": ".js-toggle-passowrd-show-icon-2"
                                                    }'>
                                                <div class="js-toggle-password-target-2 input-group-append">
                                                    <a class="input-group-text" href="javascript:;">
                                                        <i class="js-toggle-passowrd-show-icon-2 tio-visible-outlined"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="invalid-feedback" class="pass invalid-feedback">
                                            {{ translate('messages.password_not_matched') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card mb-20">
                            <div class="p-20 border-bottom">
                                <h4 class="mb-1">{{ translate('messages.identity_information') }}</h4>
                                <p class="m-0">{{ translate('messages.provider_logo_and_covers') }}</p>
                            </div>
                            <div class="card-body">
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <label for="identity_type" class="form-label font-normal fz--14px">
                                            {{ translate('messages.identity_type') }}
                                        </label>
                                        <select name="identity_type" id="identity_type"
                                            class="form-control js-select2-custom"
                                            data-placeholder="{{ translate('messages.select_zone') }}">
                                            <option selected disabled>{{ translate('Select_Identity_Type') }}</option>
                                            <option value="passport"
                                                {{ $provider->identification_type == 'passport' ? 'selected' : '' }}>
                                                {{ translate('Passport') }}</option>
                                            <option value="driving_license"
                                                {{ $provider->identification_type == 'driving_license' ? 'selected' : '' }}>
                                                {{ translate('Driving_License') }}</option>
                                            <option value="nid"
                                                {{ $provider->identification_type == 'nid' ? 'selected' : '' }}>
                                                {{ translate('nid') }}</option>
                                            <option value="trade_license"
                                                {{ $provider->identification_type == 'trade_license' ? 'selected' : '' }}>
                                                {{ translate('Trade_License') }}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-0">
                                            <label for="identification_number" class="form-label font-normal fz--14px">
                                                {{ translate('messages.identification_number') }} <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control h--45px"
                                                value="{{ $provider->identification_number }}"
                                                name="identity_number" id="identification_number"
                                                placeholder="{{ translate('messages.type_your_identification_number') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div>
                                            <div class="mb-xl-3 mb-2">
                                                <h5 class="mb-1">{{ translate('messages.identity_documents') }}</h5>
                                                <span
                                                    class="fz-12px">{{ translate('messages.pdf,_doc,_jpg_file_size_max_2_mb') }}</span>
                                            </div>
                                            <div class="row">
                                                @if(count($provider->identification_images) > 0)
                                                    <div class="col-lg-6">
                                                        <h5>{{ translate('messages.available_images') }}</h5>
                                                        <div class="row">
                                                            @foreach($provider->identification_images as $img)
                                                                <div class="col-6 col-md-4 spartan_item_wrapper size--md spartan_item_wrapper"
                                                                    data-spartanindexrow="0" style="margin-bottom : 20px; ">
                                                                    <div style="position: relative;">
                                                                        <div class="spartan_item_loader" data-spartanindexloader="0"
                                                                            style=" position: absolute; width: 100%; height: 150px; background: rgba(255,255,255, 0.7); z-index: 22; text-align: center; align-items: center; margin: auto; justify-content: center; flex-direction: column; display : none; font-size : 1.7em; color: #CECECE">
                                                                            <i class="fas fa-sync fa-spin"></i>
                                                                        </div>
                                                                        <label class="file_upload"
                                                                            style="width: 100%; height: 150px; border: 2px dashed #ddd; border-radius: 3px; cursor: pointer; text-align: center; overflow: hidden; padding: 5px; margin-top: 5px; margin-bottom : 5px; position : relative; display: flex; align-items: center; margin: auto; justify-content: center; flex-direction: column;">
                                                                            <img style="width: 100%; margin: 0px auto; vertical-align: middle; display: none;"
                                                                                data-spartanindexi="0"
                                                                                src="{{ $img }}"
                                                                                class="spartan_image_placeholder">
                                                                            <p data-spartanlbldropfile="0"
                                                                                style="color : #5FAAE1; display: none; width : auto; ">Drop
                                                                                Here
                                                                            </p>
                                                                            <img style="width: 100%; vertical-align: middle;"
                                                                                class="img_" data-spartanindeximage="0" src="{{ $img }}">
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="col-lg-6">
                                                    <h5>{{ translate('messages.Update Identification Images') }}</h5>
                                                    <div id="coba" class="row">

                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="btn--container justify-content-end mt-3">
                            <button type="reset" id="reset_btn"
                                class="btn btn--warning-light min-w-100px justify-content-center">{{ translate('messages.reset') }}</button>
                            <button type="submit"
                                class="btn btn--primary min-w-100px justify-content-center "
                                >{{ translate('messages.submit') }}</button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="businessPlan" class="d-none">
                <div class="custom-timeline d-flex flex-wrap gap-40px text-title mb-2">
                    <h4 class="single text-primary checked"><span
                            class="count-checked">1</span>{{ translate('messages.Business Basic Setup') }}</h4>
                    <h4 class="single font-semibold"><span
                            class="count btn-primary">2</span>{{ translate('messages.Business Plan Setup') }}</h4>
                </div>
                <div class="row g-2">
                    <div class="col-lg-12">
                        <div class="card mt-3">
                            <div class="card-header">
                                <div>
                                    <h5 class="text-title mb-1">
                                        {{ translate('messages.Choose Business Plan') }}
                                    </h5>
                                    <p class="fs-12 mb-0">
                                        {{ translate('messages.Pay per transaction or enjoy unlimited access with a subscription.') }}
                                    </p>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-lg-6">
                                        <label class="business-plan-card-wrapper">
                                            <input type="radio" name="business_plan" class="business-plan-radio"
                                                value="commission-base" checked />
                                            <div class="business-plan-card">
                                                <h4 class="fs-16 title text-title mb-10px opacity-70">
                                                    {{ translate('messages.Commission Base') }}
                                                </h4>
                                                <p class="fs-14 text-title opacity-70 mb-0">
                                                    {{ translate('messages.You have to give a certain percentage of commission to admin for every Trip request.') }}
                                                </p>
                                            </div>
                                        </label>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="business-plan-card-wrapper">
                                            <input type="radio" name="business_plan" class="business-plan-radio"
                                                value="subscription-base" />
                                            <div class="business-plan-card">
                                                <h4 class="fs-16 title text-title mb-10px opacity-70">
                                                    {{ translate('messages.Subscription Base') }}
                                                </h4>
                                                <p class="fs-14 text-title opacity-70 mb-0">
                                                    {{ translate('messages.You have to pay certain amount in every month/year to admin as subscription fee.') }}
                                                </p>
                                            </div>
                                        </label>
                                    </div>

                                    <div class="col-lg-12 mt-20" id="subscription-plan">
                                        <div>
                                            <div class="text-center mb-20">
                                                <h3 class="modal-title fs-16 opacity-lg font-bold">
                                                    {{ translate('Choose Subscription Package') }}</h3>
                                            </div>
                                            <div class="plan-slider owl-theme owl-carousel owl-refresh">
                                                @forelse ($packages as $key=> $package)
                                                    <label
                                                        class="__plan-item d-block hover {{ (count($packages) > 4 && $key == 2) || (count($packages) < 5 && $key == 1) ? 'active' : '' }}">
                                                        <input type="radio" name="package_id" id="package_id"
                                                            value="{{ $package->id }}" class="d-none"
                                                            {{ (count($packages) > 4 && $key == 2) || (count($packages) < 5 && $key == 1) ? 'checked' : '' }}>
                                                        <div class="inner-div">
                                                            <div class="text-center">
                                                                <h3 class="title">{{ $package->package_name }}</h3>
                                                                <h2 class="price">
                                                                    {{ \App\CentralLogics\Helpers::format_currency($package->price) }}
                                                                </h2>
                                                                <div class="day-count">{{ $package->validity }}
                                                                    {{ translate('messages.days') }}</div>
                                                            </div>
                                                            <ul class="info">

                                                                @if ($package->mobile_app)
                                                                    <li>
                                                                        <i class="tio-checkmark-circle"></i>
                                                                        <span>{{ translate('messages.mobile_app') }}</span>
                                                                    </li>
                                                                @endif
                                                                @if ($package->chat)
                                                                    <li>
                                                                        <i class="tio-checkmark-circle"></i>
                                                                        <span>{{ translate('messages.chatting_options') }}</span>
                                                                    </li>
                                                                @endif
                                                                @if ($package->review)
                                                                    <li>
                                                                        <i class="tio-checkmark-circle"></i>
                                                                        <span>{{ translate('messages.review_section') }}</span>
                                                                    </li>
                                                                @endif

                                                                @if ($package->max_order == 'unlimited')
                                                                    <li>
                                                                        <i class="tio-checkmark-circle"></i>
                                                                        <span>{{ translate('messages.Unlimited_Trips') }}</span>
                                                                    </li>
                                                                @else
                                                                    <li>
                                                                        <i class="tio-checkmark-circle"></i>
                                                                        <span>{{ $package->max_order }}
                                                                            {{ translate('messages.Trips') }} </span>
                                                                    </li>
                                                                @endif
                                                                @if ($package->max_product == 'unlimited')
                                                                    <li>
                                                                        <i class="tio-checkmark-circle"></i>
                                                                        <span>{{ translate('messages.Unlimited_uploads') }}</span>
                                                                    </li>
                                                                @else
                                                                    <li>
                                                                        <i class="tio-checkmark-circle"></i>
                                                                        <span>{{ $package->max_product }}
                                                                            {{ translate('messages.uploads') }}</span>
                                                                    </li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </label>
                                                @empty
                                                    <div class="text-center">
                                                        {{ translate('No Package Found') }}
                                                    </div>
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="btn--container justify-content-end mt-3">
                            <button type="button" class="btn btn--reset min-w-100px justify-content-center"
                                id="backBusinessSetup">{{ translate('messages.back') }}</button>
                            <button type="submit" class="btn btn--primary min-w-100px justify-content-center"
                                id="submit">{{ translate('messages.Submit') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @php($default_location = \App\Models\BusinessSetting::where('key', 'default_location')->first())
    @php($default_location = $default_location->value ? json_decode($default_location->value, true) : 0)

    <div class="d-none" id="data-set" data-admin-zone-id="{{ auth('admin')->user()->zone_id }}"
        data-lat="{{ $default_location ? $default_location['lat'] : '23.757989' }}"
        data-lng="{{ $default_location ? $default_location['lng'] : '90.360587' }}"
        data-store-lat="{{ $provider->coordinates['latitude'] ?? $default_location['lat'] }}"
        data-store-lng="{{ $provider->coordinates['longitude'] ?? $default_location['lng'] }}"
        data-logoImageViewer="{{ asset('public/assets/admin/img/upload.png') }}"
        data-get-all-modules-url="{{ route('restaurant.get-all-modules') }}"
        data-password-valid="{{ translate('Password is valid') }}"
        data-password-invalid="{{ translate('Password format is invalid') }}"
        data-password-matched="{{ translate('Passwords Matched') }}"
        data-password-not-matched="{{ translate('confirmPassword not match') }}"
        data-store-logo-required="{{ translate('Store_logo_&_cover_photos_are_required') }}"
        data-store-name-required="{{ translate('Store_name_is_required') }}"
        data-store-address-required="{{ translate('Store_address_is_required') }}"
        data-select-zone="{{ translate('You_must_select_a_zone') }}"
        data-map-latlong-required="{{ translate('Must_click_on_the_map_for_lat/long') }}"
        data-tax-required="{{ translate('tax_is_required') }}"
        data-pickup-zone-required="{{ translate('You_must_select_a_pickup_zone') }}"
        data-min-delivery-time-required="{{ translate('minimum_delivery_time_is_required') }}"
        data-max-delivery-time-required="{{ translate('max_delivery_time_is_required') }}"
        data-first-name-required="{{ translate('first_name_is_required') }}"
        data-last-name-required="{{ translate('last_name_is_required') }}"
        data-phone-required="{{ translate('valid_phone_number_is_required') }}"
        data-email-required="{{ translate('email_is_required') }}"
        data-password-required="{{ translate('password_is_required') }}"
        data-confirm-password-mismatch="{{ translate('confirm_password_does_not_match') }}"
        data-select_pickup_zone="{{ translate('select_pickup_zone') }}"
        data-identity-type-required="{{ translate('messages.identity_type_is_required') }}"
        data-identification-number-required="{{ translate('messages.identification_number_is_required') }}"></div>

@endsection

@push('script_2')
    <script src="{{ asset('public/assets/admin/js/spartan-multi-image-picker.js') }}"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ \App\Models\BusinessSetting::where('key', 'map_api_key')->first()->value }}&libraries=drawing,places&v=3.45.8">
    </script>
    <script src="{{ asset('Modules/Service/public/assets/js/admin/provider-edit.js') }}"></script>

    <script>
        $(function() {
            $("#coba").spartanMultiImagePicker({
                fieldName: 'identity_images[]',
                maxCount: 2,
                rowHeight: '150px',
                rowWidth: '100%',
                groupClassName: 'col-6 col-md-4 spartan_item_wrapper size--md',
                maxFileSize: '',
                placeholderImage: {
                    image: '{{ asset('public/assets/admin/img/400x400/img2.jpg') }}',
                    width: '100%'
                },
                dropFileLabel: "Drop Here",
                onAddRow: function(index, file) {

                },
                onRenderedPreview: function(index) {

                },
                onRemoveRow: function(index) {

                },
                onExtensionErr: function(index, file) {
                    toastr.error(
                        '{{ translate('messages.please_only_input_png_or_jpg_type_file') }}', {
                            CloseButton: true,
                            ProgressBar: true
                        });
                },
                onSizeErr: function(index, file) {
                    toastr.error('{{ translate('messages.file_size_too_big') }}', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }
            });
        });
    </script>
@endpush
