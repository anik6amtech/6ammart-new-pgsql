@extends('layouts.admin.app')

@section('title', translate('messages.Edit Vehicle'))

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
                        <span>{{ translate('messages.Edit Vehicle') }}
                    </h1>
                </div>
            </div>
        </div>
        @php($language = \App\Models\BusinessSetting::where('key', 'language')->first())
        @php($language = $language->value ?? null)

        <form action="{{ route('admin.users.delivery-man.vehicle.update', ['id' => $vehicle->id]) }}" enctype="multipart/form-data" id="vehicle_form"
                method="POST">
            @csrf
            @method('PUT')
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
                                        {{-- Default language --}}
                                        <div class="lang_form" id="default-form">
                                            <div class="form-group mb-0 position-relative">
                                                <label class="input-label font-semibold"
                                                       for="default_name">{{ translate('messages.vehicle_name') }}
                                                    ({{ translate('messages.Default') }})<span class="text-danger">*</span>
                                                </label>

                                                <input type="text" name="name[]" id="default_name"
                                                       class="form-control char-count-input"
                                                       value="{{ $vehicle?->getRawOriginal('name') }}"
                                                       placeholder="{{ translate('messages.type_vehicle_name') }}"
                                                       maxlength="150"
                                                       required>

                                                {{-- character counter --}}
                                                <small class="text-muted d-flex justify-content-end">
                                                    <span id="default_name_count">{{ strlen($vehicle?->getRawOriginal('name') ?? '') }}</span>/150
                                                </small>
                                            </div>
                                            <input type="hidden" name="lang[]" value="default">
                                        </div>

                                        {{-- Other languages --}}
                                        @foreach (json_decode($language) as $key => $lang)
                                                <?php
                                                $translate = [];
                                                if(count($vehicle['translations'])){
                                                    foreach($vehicle['translations'] as $t) {
                                                        if($t->locale == $lang && $t->key=="name"){
                                                            $translate[$lang]['name'] = $t->value;
                                                        }
                                                    }
                                                }
                                                $translatedValue = $translate[$lang]['name'] ?? '';
                                                ?>
                                            <div class="d-none lang_form" id="{{ $lang }}-form">
                                                <div class="form-group mb-0 position-relative">
                                                    <label class="input-label font-semibold"
                                                           for="{{ $lang }}_name">{{ translate('messages.vehicle_name') }}
                                                        ({{ strtoupper($lang) }})
                                                    </label>

                                                    <input type="text" name="name[]"
                                                           id="{{ $lang }}_name"
                                                           class="form-control char-count-input"
                                                           value="{{ $translatedValue }}"
                                                           placeholder="{{ translate('messages.vehicle_name') }}"
                                                           maxlength="150">

                                                    {{-- character counter --}}
                                                    <small class="text-muted d-flex justify-content-end">
                                                        <span id="{{ $lang }}_name_count">{{ strlen($translatedValue) }}</span>/150
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
                                                @if (isset($vehicle->category))
                                                    <option value="{{ $vehicle->category->id }}" selected="selected">
                                                        {{ $vehicle->category->name }}</option>
                                                @endif

                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-0" id="model-selector">
                                        <label class="input-label" for="model_id">{{ translate('messages.model') }}<span class="text-danger">*</span></label>
                                        <select class="js-select-ajax theme-input-style w-100 form-control"
                                                name="model_id"
                                                id="model_id"
                                                data-placeholder="{{ translate('please_select_vehicle_model') }}"
                                                required>
                                                @if (isset($vehicle->model))
                                                    <option value="{{ $vehicle->model->id }}" selected="selected">
                                                        {{ $vehicle->model->name }}</option>
                                                @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-0">
                                        <label class="input-label" for="choice_category">{{ translate('messages.category') }}<span class="text-danger">*</span></label>
                                        <select id="vehicle_category" class="js-select-ajax" name="category_id"
                                                    data-placeholder="{{ translate('select_vehicle_category') }}"
                                                required>
                                                @if (isset($vehicle->category))
                                                    <option value="{{ $vehicle->category->id }}" selected="selected">
                                                        {{ $vehicle->category->name }}</option>
                                                @endif

                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-0">
                                        <label class="input-label" for="choice_fuel_type">{{ translate('messages.fuel_type') }}<span class="text-danger">*</span></label>
                                        <select name="fuel_type" id="choice_fuel_type" class="form-control js-select2-custom"
                                                data-placeholder="{{ translate('messages.select_fuel_type') }}" required>
                                            <option value="" selected disabled>{{ translate('messages.select_vehicle_fuel_type') }}</option>
                                            <option value="octan" {{ $vehicle->fuel_type == 'octan' ? 'selected' : '' }}>{{ translate('messages.Octan') }}</option>
                                            <option value="diesel" {{ $vehicle->fuel_type == 'diesel' ? 'selected' : '' }}>{{ translate('messages.diesel') }}</option>
                                            <option value="cng" {{ $vehicle->fuel_type == 'cng' ? 'selected' : '' }}>{{ translate('messages.CNG') }}</option>
                                            <option value="petrol" {{ $vehicle->fuel_type == 'petrol' ? 'selected' : '' }}>{{ translate('messages.Petrol') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-0">
                                        <label class="input-label" for="choice_transmission_type">{{ translate('messages.transmission_type') }}<span class="text-danger">*</span></label>
                                        <select name="transmission" id="choice_transmission_type" class="form-control js-select2-custom"
                                                data-placeholder="{{ translate('messages.select_vehicle_transmission') }}" required>
                                            <option value="" disabled>{{ translate('messages.select_vehicle_transmission') }}</option>
                                            <option value="automatic" {{ $vehicle->transmission == 'automatic' ? 'selected' : '' }} >{{ translate('Automatic') }}</option>
                                            <option value="manual" {{ $vehicle->transmission == 'manual' ? 'selected' : '' }}>{{ translate('Manual') }}</option>
                                            <option value="continuously_variable" {{ $vehicle->transmission == 'continuously_variable' ? 'selected' : '' }}>{{ translate('Continuously Variable') }}</option>
                                            <option value="dual_clutch" {{ $vehicle->transmission == 'dual_clutch' ? 'selected' : '' }}>{{ translate('Dual-Clutch') }}</option>
                                            <option value="semi_automatic" {{ $vehicle->transmission == 'semi_automatic' ? 'selected' : '' }}>{{ translate('Semi-Automatic') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-0">
                                        <label class="input-label" for="choice_ownership">{{ translate('messages.ownership') }}<span class="text-danger">*</span></label>
                                        <select name="ownership" id="ownership" class="form-control js-select2-custom"
                                                data-placeholder="{{ translate('messages.select_owner') }}" required>
                                            <option value="" disabled>{{ translate('messages.select_owner') }}</option>
                                            <option value="admin" {{ $vehicle->ownership == 'admin' ? 'selected' : '' }}>{{ translate('admin') }}</option>
                                            <option value="rider" {{ $vehicle->ownership == 'rider' ? 'selected' : '' }}>{{ translate('rider') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-0">
                                        <label class="input-label" for="choice_rider">{{ translate('messages.rider') }}</label>
                                         <select required class="js-select-driver" id="driver"
                                                    name="rider_id">
                                                <option value="" disabled>
                                                    {{ translate('select_rider') }}</option>
                                                @if (isset($vehicle->driver))
                                                    <option value="{{ $vehicle->driver->id }}" selected="selected">
                                                        {{ $vehicle->driver->f_name.' '.$vehicle->driver->l_name }}</option>
                                                @endif

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
                                           placeholder="Type your vin number" value="{{ $vehicle?->vin_number }}" required>
                                </div>
                                <div class="form-group mb-0">
                                    <label class="input-label"
                                           for="">{{ translate('messages.License Plate Number') }}<span class="text-danger">*</span></label>
                                    <input type="text" name="licence_plate_number" class="form-control"
                                           placeholder="Type your license plate number" value="{{ $vehicle?->licence_plate_number }}" required>
                                </div>
                                <div class="form-group mb-0">
                                    <label class="input-label"
                                           for="">{{ translate('messages.license_expire_date') }}<span class="text-danger">*</span></label>
                                    <input type="date" name="licence_expire_date" class="form-control" value="{{ $vehicle?->licence_expire_date ? $vehicle->licence_expire_date->format('Y-m-d') : '' }}">

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
                                               multiple>
                                        <input type="hidden" name="removed_documents" id="removed_documents" value="">
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
                                    @foreach($vehicle['documents_full_url'] as $doc)
                                        <div class="pdf-single" data-file-name="{{ basename($doc) }}" data-file-url="{{ $doc }}" data-existing="true">
                                            <div class="pdf-frame">
                                                <canvas class="pdf-preview display-none"></canvas>
                                                <img class="pdf-thumbnail" src="{{ asset('public/assets/admin/img/blank2.png') }}" alt="File Thumbnail">
                                            </div>
                                            <div class="overlay">
                                                <a href="javascript:void(0);" class="remove-btn" data-file-name="{{ basename($doc) }}">
                                                    <i class="tio-clear"></i>
                                                </a>
                                                <div class="pdf-info d-flex gap-10px align-items-center">
                                                    <img src="{{ asset('public/assets/admin/img/document.svg') }}" width="34" alt="Document Logo">
                                                    <div class="fs-13 text--title d-flex flex-column">
                                                        <span class="file-name">{{ basename($doc) }}</span>
                                                        <span class="opacity-50">{{ translate('Click to view the file') }}</span>
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
                        search: params.term, // search term
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
    <script>
        (function(){
            const removedSet = new Set();
            const $removedInput = $('#removed_documents');
            $('#pdf-container').on('click', '.remove-btn', function(){
                const $single = $(this).closest('.pdf-single');
                // Only track removals for existing files already saved on server
                const isExisting = $single.data('existing');
                if (isExisting === true || isExisting === 'true') {
                    // Prefer container data-file-name which is set to the basename
                    let fileName = $single.data('file-name');
                    if (!fileName) {
                        fileName = $(this).data('file-name') || $(this).data('fileName');
                    }
                    if (fileName) {
                        removedSet.add(fileName);
                        $removedInput.val(JSON.stringify(Array.from(removedSet)));
                    }
                }
            });
        })();
    </script>
@endpush
