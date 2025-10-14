@extends('layouts.admin.app')

@section('title', translate('messages.Create New Serviceman'))

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
                        <span>{{ translate('messages.Create New Serviceman') }}
                    </span> </h1>

                </div>
            </div>
        </div>

        @php($language = \App\Models\BusinessSetting::where('key', 'language')->first()?->value ?? null)
        <!-- End Page Header -->
        <form action="{{ route('admin.service.provider.serviceman.store', ['id' => $provider->id]) }}" method="post" enctype="multipart/form-data" id="providerFormSubmit">
            @csrf
            <div id="businessSetup">
                <div class="row g-2">
                    <div class="col-lg-12">
                        <div class="card mt-4">
                            <div class="card-header">
                                <div>
                                    <h5 class="text-title mb-1">
                                        {{ translate('messages.General_Info') }}
                                    </h5>
                                    <p class="fs-12 mb-0">
                                        {{ translate('messages. Insert the basic information of the serviceman ') }}
                                    </p>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-lg-6">
                                        <div class="card __bg-FAFAFA border-0">
                                            <div class="card-body">
                                                <div>
                                                    <div class="form-group">
                                                        <label class="input-label font-semibold"
                                                            for="default_name">{{ translate('messages.first_name') }}
                                                        </label>
                                                        <input type="text" name="first_name" id="first_name"
                                                            class="form-control"
                                                            placeholder="{{ translate('messages.first_name') }}" value="{{old('first_name')}}" required>
                                                    </div>
                                                    <div class="form-group mb-0">
                                                        <label class="input-label font-semibold"
                                                            for="exampleFormControlInput1">{{ translate('messages.last_name') }}</label>
                                                        <input type="text" name="last_name" id="last_name"
                                                            class="form-control"
                                                            placeholder="{{ translate('messages.last_name') }}" value="{{old('last_name')}}" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mb-0 mt-3">
                                            <label class="input-label"
                                                   for="exampleFormControlInput1">{{ translate('messages.email') }}</label>
                                            <input type="email" name="email" class="form-control" id="email"
                                                   placeholder="{{ translate('messages.Ex:') }} ex@example.com"
                                                   value="{{old('email')}}" required>
                                        </div>

                                    </div>
                                    <div class="col-lg-6">
                                        <div class="d-flex justify-content-center text-center">
                                            <div class="__custom-upload-img">
                                                @php($logo = \App\Models\BusinessSetting::where('key', 'logo')->first())
                                                @php($logo = $logo->value ?? '')
                                                <label class="form-label mb-1">
                                                    {{ translate('logo') }}
                                                </label>
                                                <div class="mb-20">
                                                    <p class="fs-12">{{ translate('JPG, JPEG, PNG Less Than 2MB') }} <strong
                                                            class="font-semibold">({{ translate('Ratio 1:1') }})</strong></p>
                                                </div>
                                                <label
                                                    class="position-relative d-inline-block image--border cursor-pointer w-100 h-165 max-w-165">
                                                    <img class="h-165 aspect-ratio-1 rounded-10 display-none"
                                                        id="logoImageViewer"
                                                        data-onerror-image="{{ asset('public/assets/admin/img/upload.png') }}"
                                                        src="{{ asset('public/assets/admin/img/upload-img.png') }}"
                                                        alt="logo image"/>
                                                    <div class="upload-file__textbox p-2 h-100">
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

                                                        <input type="file" name="image" id="customFileEg1"
                                                                class="custom-file-input req-file"
                                                                accept=".webp, .jpg, .png, .jpeg|image/*">
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
                        <div class="card mb-20">
                            <div class="p-20 border-bottom">
                                <h4 class="mb-1">{{ translate('messages.identity_information') }}</h4>
                                <p class="m-0">{{ translate('messages.vendor_logo_and_covers') }}</p>
                            </div>
                            <div class="card-body">
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <label for="identity_type" class="form-label font-normal fz--14px">
                                            {{ translate('messages.identity_type') }}
                                        </label>
                                        <select name="identity_type" id="identity_type" class="form-control js-select2-custom"
                                            data-placeholder="{{ translate('messages.select_zone') }}">
                                            <option selected disabled>{{translate('Select_Identity_Type')}}</option>
                                            <option value="passport"
                                                {{old('identity_type') == 'passport' ? 'selected': ''}}>
                                                {{translate('Passport')}}</option>
                                            <option value="driving_license"
                                                {{old('identity_type') == 'driving_license' ? 'selected': ''}}>
                                                {{translate('Driving_License')}}</option>
                                            <option value="nid"
                                                {{old('identity_type') == 'passport' ? 'selected': ''}}>
                                                {{translate('nid')}}</option>
                                            <option value="trade_license"
                                                {{old('identity_type') == 'nid' ? 'selected': ''}}>
                                                {{translate('Trade_License')}}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-0">
                                            <label for="identification_number" class="form-label font-normal fz--14px">
                                                {{ translate('messages.identification_number') }} <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control h--45px" name="identity_number" id="identification_number" placeholder="{{ translate('messages.type_your_identification_number') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div>
                                            <div class="mb-xl-3 mb-2">
                                                <h5 class="mb-1">{{ translate('messages.identity_documents') }}</h5>
                                                <span class="fz-12px">{{ translate('messages.pdf_doc_jpg_file_size_max_2_mb') }}</span>
                                            </div>
                                            <div id="coba" class="row"></div>
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
                                            <label class="input-label" for="phone">{{ translate('messages.phone_number') }} <span class="text-danger">*</span></label>
                                            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" class="form-control"
                                                   placeholder="{{ translate('messages.Ex:') }} 017********"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="js-form-message form-group mb-0">
                                            <label class="input-label"
                                                for="signupSrPassword">{{ translate('password') }}<span
                                                    class="form-label-secondary" data-toggle="tooltip" data-placement="right"
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
                            <button type="reset" class="btn btn--reset min-w-100px justify-content-center">{{ translate('messages.reset') }}</button>
                            <button type="submit" class="btn btn--primary min-w-100px justify-content-center" id="submit">{{ translate('messages.Submit') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @php($default_location = \App\Models\BusinessSetting::where('key', 'default_location')->first())
    @php($default_location = $default_location->value ? json_decode($default_location->value, true) : 0)

<div class="d-none" id="data-set"
    data-admin-zone-id="{{auth('admin')->user()->zone_id}}"
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
    data-identification-number-required="{{ translate('messages.identification_number_is_required') }}"

></div>

@endsection

@push('script_2')
    <script src="{{ asset('public/assets/admin/js/spartan-multi-image-picker.js') }}"></script>

    <script src="{{asset('Modules/Service/public/assets/js/admin/serviceman-create.js')}}"></script>

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
