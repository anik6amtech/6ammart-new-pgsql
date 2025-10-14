@extends('layouts.admin.app')

@section('title', translate('messages.Add New Vehicle'))

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header pb-20">
            <div class="d-flex justify-content-between flex-wrap gap-3">
                <div>
                    <h1 class="page-header-title text-break">
                        <span class="page-header-icon">
                            <img src="{{ asset('public/assets/admin/img/car-logo.png') }}" alt="">
                        </span>
                        <span>{{ translate('messages.Add New Vehicle') }}
                    </h1>
                </div>
            </div>
        </div>
        @php($language = \App\Models\BusinessSetting::where('key', 'language')->first())
        @php($language = $language->value ?? null)

        <form action="{{ route('admin.users.delivery-man.vehicle.store') }}" method="post" enctype="multipart/form-data" id="vehicle_form">
            @csrf

            <div class="row g-3">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <h5 class="text-title mb-1">
                                    {{ translate('messages.Vehicle_Information') }}
                                </h5>
                                <p class="fs-12 mb-0">
                                    {{ translate('messages.Insert_The_Vehicle\'s_General_Informations') }}
                                </p>
                            </div>
                        </div>
                        <div class="card-body">
                            @if ($language)
                                       <ul class="nav nav-tabs border-0 mb-4">
                                           <li class="nav-item">
                                               <a class="nav-link lang_link active" href="#"
                                                  id="default-link">{{ translate('Default') }}</a>
                                           </li>
                                           @foreach (json_decode($language) as $lang)
                                               <li class="nav-item">
                                                   <a class="nav-link lang_link" href="#"
                                                      id="{{ $lang }}-link">{{ \App\CentralLogics\Helpers::get_language_name($lang) . '(' . strtoupper($lang) . ')' }}</a>
                                               </li>
                                           @endforeach
                                       </ul>
                                   @endif
                            <div class="row g-3">
                                <div class="col-lg-4">
                                    @if ($language)
                                        <div class="lang_form" id="default-form">
                                            <div class="form-group mb-0">
                                                <label class="input-label font-semibold"
                                                       for="default_name">{{ translate('messages.vehicle_name') }}
                                                    ({{ translate('messages.Default') }})
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="name[]" id="default_name"
                                                       class="form-control char-count-input"
                                                       value="{{ old('name.0') }}"
                                                       placeholder="{{ translate('messages.type_vehicle_name') }}"
                                                       maxlength="150"
                                                       required>
                                                <small class="text-muted d-flex justify-content-end">
                                                    <span id="default_name_count">0</span>/150
                                                </small>
                                            </div>
                                            <input type="hidden" name="lang[]" value="default">
                                        </div>

                                        @foreach (json_decode($language) as $key => $lang)
                                            <div class="d-none lang_form" id="{{ $lang }}-form">
                                                <div class="form-group mb-0">
                                                    <label class="input-label font-semibold"
                                                           for="{{ $lang }}_name">{{ translate('messages.vehicle_name') }}
                                                        ({{ strtoupper($lang) }})
                                                    </label>
                                                    <input type="text" name="name[]"
                                                           id="{{ $lang }}_name"
                                                           class="form-control char-count-input"
                                                           value="{{ old('name.'.($key+1)) }}"
                                                           placeholder="{{ translate('messages.vehicle_name') }}"
                                                           maxlength="150">
                                                    <small class="text-muted d-flex justify-content-en">
                                                        <span id="{{ $lang }}_name_count">0</span>/150
                                                    </small>
                                                </div>
                                                <input type="hidden" name="lang[]" value="{{ $lang }}">
                                            </div>
                                        @endforeach
                                    @endif
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group mb-0">
                                        <label class="input-label" for="brand_id">{{ translate('messages.brand') }}<span class="text-danger">*</span></label>
                                        <select class="js-select-ajax" name="brand_id" id="brand_id"
                                                data-placeholder="{{ translate('select_brand') }}"
                                                onchange="ajax_models('{{ url('/') }}/admin/users/delivery-man/vehicle/model/ajax-models/'+this.value)"
                                                required>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-0" id="model-selector" style="display: none;">
                                        <label class="input-label" for="model_id">{{ translate('messages.model') }}<span class="text-danger">*</span></label>
                                        <select class="js-select-ajax theme-input-style w-100 form-control"
                                                name="model_id"
                                                id="model_id"
                                                data-placeholder="{{ translate('please_select_vehicle_model') }}"
                                                required>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-0">
                                        <label class="input-label" for="choice_category">{{ translate('messages.category') }}<span class="text-danger">*</span></label>
                                        <select id="vehicle_category" class="js-select-ajax" name="category_id"
                                                    data-placeholder="{{ translate('select_vehicle_category') }}"
                                                required>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-0">
                                        <label class="input-label" for="choice_fuel_type">{{ translate('messages.fuel_type') }}<span class="text-danger">*</span></label>
                                        <select name="fuel_type" id="choice_fuel_type" class="form-control js-select2-custom"
                                                data-placeholder="{{ translate('messages.select_fuel_type') }}" required>
                                            <option value="" selected disabled>{{ translate('messages.select_vehicle_fuel_type') }}</option>
                                            <option value="octan" {{ old('fuel_type') == 'octan' ? 'selected' : '' }}>{{ translate('messages.Octan') }}</option>
                                            <option value="diesel" {{ old('fuel_type') == 'diesel' ? 'selected' : '' }}>{{ translate('messages.diesel') }}</option>
                                            <option value="cng" {{ old('fuel_type') == 'cng' ? 'selected' : '' }}>{{ translate('messages.CNG') }}</option>
                                            <option value="petrol" {{ old('fuel_type') == 'petrol' ? 'selected' : '' }}>{{ translate('messages.Petrol') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-0">
                                        <label class="input-label" for="choice_transmission_type">{{ translate('messages.transmission_type') }}<span class="text-danger">*</span></label>
                                        <select name="transmission" id="choice_transmission_type" class="form-control js-select2-custom"
                                                data-placeholder="{{ translate('messages.select_vehicle_transmission') }}" required>
                                            <option value="" selected disabled>{{ translate('messages.select_vehicle_transmission') }}</option>
                                            <option value="automatic" {{ old('transmission_type') == 'automatic' ? 'selected' : '' }}>{{ translate('Automatic') }}</option>
                                            <option value="manual" {{ old('transmission_type') == 'manual' ? 'selected' : '' }}>{{ translate('Manual') }}</option>
                                            <option value="continuously_variable" {{ old('transmission_type') == 'continuously_variable' ? 'selected' : '' }}>{{ translate('Continuously Variable') }}</option>
                                            <option value="dual_clutch" {{ old('transmission_type') == 'dual_clutch' ? 'selected' : '' }}>{{ translate('Dual-Clutch') }}</option>
                                            <option value="semi_automatic" {{ old('transmission_type') == 'semi_automatic' ? 'selected' : '' }}>{{ translate('Semi-Automatic') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-0">
                                        <label class="input-label" for="choice_ownership">{{ translate('messages.ownership') }}<span class="text-danger">*</span></label>
                                        <select name="ownership" id="ownership" class="form-control js-select2-custom"
                                                data-placeholder="{{ translate('messages.select_owner') }}" required>
                                            <option value="" selected disabled>{{ translate('messages.select_owner') }}</option>
                                            <option value="admin">{{ translate('admin') }}</option>
                                            <option value="rider">{{ translate('rider') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-0">
                                        <label class="input-label" for="choice_rider">{{ translate('messages.rider') }}</label>
                                         <select required class="js-select-driver" id="driver"
                                                    name="rider_id">
                                                <option value="" selected disabled>
                                                    {{ translate('select_rider') }}</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header flex-wrap gap-3">
                            <div class="flex-grow-1">
                                <h5 class="text-title mb-1">
                                    {{ translate('messages.Vehicle Identity') }}
                                </h5>
                                <p class="fs-12 mb-0">
                                    {{ translate('messages.Insert_The_Vehicle\'s_Unique_Informations') }}
                                </p>
                            </div>
                        </div>
                        <div class="card-body d-flex flex-column gap-20px">
                            <div class="d-flex gap-20px flex-column flex-md-row equal-width" id="input-container">
                                <div class="form-group mb-0">
                                    <label class="input-label"
                                           for="">{{ translate('messages.VIN Number') }}<span class="text-danger">*</span></label>
                                    <input type="text" name="vin_number" class="form-control"
                                           placeholder="Type your vin number" value="" required>
                                </div>
                                <div class="form-group mb-0">
                                    <label class="input-label"
                                           for="">{{ translate('messages.License Plate Number') }}<span class="text-danger">*</span></label>
                                    <input type="text" name="licence_plate_number" class="form-control"
                                           placeholder="Type your license plate number" value="" required>
                                </div>
                                <div class="form-group mb-0">
                                    <label class="input-label"
                                           for="">{{ translate('messages.license_expire_date') }}<span class="text-danger">*</span></label>
                                    <input type="date" name="licence_expire_date" class="form-control" value="">
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
                                    {{ translate('messages.Vehicle_Documents') }}<span class="text-danger">*</span>
                                </h5>
                                <p class="fs-12 mb-0">
                                    {{ translate('messages.Upload_Vehicle\'s_Important_Documents') }}
                                </p>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex py-3 overflow-x-auto">
                                <div class="d-flex gap-3 flex-shrink-0" id="pdf-container">
                                    <div class="upload-file text-wrapper document-wrapper" id="upload-wrapper">
                                        <input type="file" name="documents[]"
                                            class="upload-file__input multiple_document_input" accept="*"
                                            multiple required>
                                        <div
                                            class="upload-file__img d-flex justify-content-center align-items-center h-100 max-w-300px p-0">
                                            <div class="upload-file__textbox pdf">
                                                <img width="34" height="34"
                                                    src="{{ asset('public/assets/admin/img/document-upload.png') }}"
                                                    alt="" class="svg">
                                                <h6 class="font-semibold">
                                                    <span class="text-info">{{ translate('Click to upload') }}</span><br>
                                                    {{ translate('or drag and drop') }}
                                                </h6>
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
                                class="btn btn--reset min-w-120px">{{ translate('messages.reset') }}</button>
                        <button type="submit"
                                class="btn btn--primary min-w-120px">{{ translate('messages.submit') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

<input type="hidden" id="file_size_error_text" value="{{ translate('file_size_too_big') }}">
<input type="hidden" id="file_type_error_text" value="{{ translate('please_only_input_png_or_jpg_type_file') }}">
<input type="hidden" id="max_file_upload_limit_error_text" value="{{ translate('maximum_file_upload_limit_is_') }}">



<div id="file-assets"
    data-picture-icon="{{ asset('public/assets/admin/img/picture.svg') }}"
    data-document-icon="{{ asset('public/assets/admin/img/document.svg') }}"
    data-blank-thumbnail="{{ asset('public/assets/admin/img/blank2.png') }}">
</div>

@endsection

@push('script_2')
    <script src="{{ asset('public/assets/admin/js/spartan-multi-image-picker.js') }}"></script>
    <script src="{{ asset('public/assets/admin/js/view-pages/pdf.min.js') }}"></script>
    <script src="{{ asset('public/assets/admin/js/view-pages/vehicle-create.js') }}"></script>
    <script src="{{ asset('public/assets/admin/js/view-pages/multiple-upload.js') }}"></script>
   <script>
        "use strict";
        $(document).ready(function () {
            $("#brand_id").on("select2:select", function (e) {
                if ($('#brand_id').val() == null) {
                    $('#model-selector').hide();
                    $('#model_id').removeAttr('required');
                    $('#model_id').html(null);
                 } else {
                    $('#model-selector').show();
                    $('#model_id').attr('required', 'required');
                 }
            });
        });

        function ajax_models(route) {
            $.get({
                url: route,
                dataType: 'json',
                data: {},
                beforeSend: function () {
                },
                success: function (response) {
                    $('#model-selector').html(response.template);
                },
                complete: function () {

                },
            });
        }

        $('#brand_id').select2({
            ajax: {
                url: '{{ route('admin.users.delivery-man.vehicle.brand.all-brands', parameters: ['status' => 'active']) }}',
                data: function (params) {
                    return {
                        q: params.term, // search term
                        page: params.page,
                    };
                },
                processResults: function (data) {
                    //
                    return {
                        results: data
                    };
                },
                __port: function (params, success, failure) {
                    var $request = $.ajax(params);
                    $request.then(success);
                    $request.fail(failure);
                    return $request;
                }
            }
        });

        $('#vehicle_category').select2({
            ajax: {
                url: '{{ route('admin.users.delivery-man.vehicle.category.all-categories', parameters: ['status' => 'active']) }}',
                data: function (params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                __port: function (params, success, failure) {
                    let $request = $.ajax(params);
                    $request.then(success);
                    $request.fail(failure);
                    return $request;
                }
            }
        });

        $('.js-select-driver').select2({
            ajax: {
                url: '{{ route('admin.users.delivery-man.get-deliverymen') }}',
                data: function (params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function (data) {

                    return {
                        results: data
                    };
                },
                __port: function (params, success, failure) {
                    var $request = $.ajax(params);
                    $request.then(success);
                    $request.fail(failure);
                    return $request;
                }
            }
        });


        $('#vehicle_form').on('submit', function (event) {
            if ($('#model_id').val() === null) {
                toastr.error('{{ translate('fill_up_vehicle_model') }}')
                event.preventDefault()
            }
            if ($('#fuel_type').val() === null) {
                toastr.error('{{ translate('fill_up_fuel_type') }}')
                event.preventDefault()
            }
            if ($('#ownership').val() === null) {
                toastr.error('{{ translate('fill_up_ownership') }}')
                event.preventDefault()
            }
            if ($('#rider').val() === null) {
                toastr.error('{{ translate('fill_up_rider') }}')
                event.preventDefault()
            }
        })


        $(document).on('keyup', '.char-count-input', function () {
            let id = $(this).attr('id');
            let max = $(this).attr('maxlength') ?? 255;
            let count = $(this).val().length;
            $("#" + id + "_count").text(count);
        });
    </script>
@endpush
