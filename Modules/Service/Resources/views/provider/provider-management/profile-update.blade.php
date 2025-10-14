@extends('service::provider.layouts.app')

@section('title', translate('messages.available_services'))

@push('css_or_js')

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
        <form action="" method="post"
              enctype="multipart/form-data" id="providerFormSubmit">
            @csrf

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
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-0 mt-3">
                                                <label class="input-label"
                                                       for="phone">{{ translate('messages.business_phone_number') }} <span
                                                        class="text-danger">*</span></label>
                                                <input type="tel" id="phone" name="business_phone"
                                                       value="{{ $provider->company_phone }}" class="form-control"
                                                       placeholder="{{ translate('messages.Ex:') }} 017********" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-0 mt-3">
                                                <label class="input-label"
                                                       for="email_business">{{ translate('messages.business_email_address') }} <span
                                                        class="text-danger">*</span></label>
                                                <input type="email" id="email_business" name="business_email"
                                                       value="{{ $provider->company_email }}" class="form-control"
                                                       placeholder="{{ translate('messages.Ex:') }} abc@g*******.com" required>
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
                                    <div class="position-relative">
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
                                    </div>
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
                                               for="exampleFormControlInput1">{{ translate('messages.email') }}</label>
                                        <input type="email" name="email" class="form-control" id="email"
                                               placeholder="{{ translate('messages.Ex:') }} ex@example.com"
                                               value="{{ $provider->email }}" required readonly>
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
                                               for="phone">{{ translate('messages.phone') }}</label>
                                        <input type="tel" id="phone" name="phone" class="form-control"
                                               placeholder="{{ translate('messages.Ex:') }} 017********"
                                               value="{{ $provider->phone }}" required readonly>
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
                    <div class="btn--container justify-content-end mt-3">
                        <button type="reset" id="reset_btn"
                                class="btn btn--warning-light min-w-100px justify-content-center">{{ translate('messages.reset') }}</button>
                        <button type="submit"
                                class="btn btn--primary min-w-100px justify-content-center "
                        >{{ translate('messages.submit') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @php($default_location = \App\Models\BusinessSetting::where('key', 'default_location')->first())
    @php($default_location = $default_location->value ? json_decode($default_location->value, true) : 0)

@endsection

@push('script_2')
    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ \App\Models\BusinessSetting::where('key', 'map_api_key')->first()->value }}&libraries=drawing,places&v=3.45.8">
    </script>
    <script src="{{ asset('Modules/Service/public/assets/js/admin/provider-edit.js') }}"></script>
@endpush
