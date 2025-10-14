@section('title', 'Vehicle Attribute')

@extends('layouts.admin.app')

@push('css_or_js')
@endpush

@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <h1 class="page-header-title">
                <span class="page-header-icon">
                    <img src="{{ asset('Modules/RideShare/public/assets/img/ride-share/driver.png') }}" class="w--26" alt="">
                </span>
                <span>
                    {{ translate('messages.edit_category') }}
                </span>
            </h1>
        </div>

         <form action="{{ route('admin.users.delivery-man.vehicle.category.update', ['id' => $category->id]) }}"
                        enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('PUT')
            <div class="card mb-4">
                {{-- <div class="card-header">
                    <div>
                        <h5 class="text-title mb-1">
                            {{ translate('messages.edit_category') }}
                        </h5>
                        <p class="fs-12 mb-0">
                            {{ translate('messages.the_current_level_setup_automatically_assigns_drivers_the_default_level_upon_their_initial_app_login') }}
                        </p>
                    </div>
                </div> --}}
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-lg-6">
                            <div class="__bg-F8F9FC-card">
                                <ul class="nav nav-tabs mb-3 border-0">
                                    <li class="nav-item">
                                        <a class="nav-link lang_link active"
                                        href="#"
                                        id="default-link">{{translate('messages.default')}}</a>
                                    </li>
                                    @foreach ($language as $lang)
                                        <li class="nav-item">
                                            <a class="nav-link lang_link"
                                                href="#"
                                                id="{{ $lang }}-link">{{ \App\CentralLogics\Helpers::get_language_name($lang) . '(' . strtoupper($lang) . ')' }}</a>
                                        </li>
                                    @endforeach
                                </ul>

                                <div class="lang_form" id="default-form">
                                    {{-- Default Name --}}
                                    <div class="mb-20 position-relative">
                                        <label class="form-label">{{ translate('name') }} ({{ translate('Default') }})</label>
                                        <input type="text"
                                               class="form-control char-count-input"
                                               name="name[]"
                                               value="{{ $category?->getRawOriginal('name') }}"
                                               placeholder="{{ translate('name') }}"
                                               maxlength="150"
                                               data-preview-text="preview-title">
                                        <small class="text-muted d-flex justify-content-end">
                                            <span class="char-counter">{{ strlen($category?->getRawOriginal('name') ?? '') }}</span>/150
                                        </small>
                                    </div>

                                    {{-- Default Description --}}
                                    <div class="form-floating mb-20 position-relative">
                                        <label class="form-label">{{ translate('Short_Description') }} ({{ translate('Default') }})</label>
                                        <textarea class="form-control resize-none char-count-input"
                                                  name="short_desc[]"
                                                  placeholder="{{ translate('Short_Description') }}"
                                                  maxlength="350"
                                                  data-preview-text="preview-description">{{ $category?->getRawOriginal('description') }}</textarea>
                                        <small class="text-muted d-flex justify-content-end">
                                            <span class="char-counter">{{ strlen($category?->getRawOriginal('description') ?? '') }}</span>/350
                                        </small>
                                    </div>

                                    <input type="hidden" name="lang[]" value="default">
                                </div>

                                {{-- Other languages --}}
                                @foreach ($language as $lang)
                                        <?php
                                        $translate = [];
                                        if(count($category['translations'])){
                                            foreach($category['translations'] as $t){
                                                if($t->locale == $lang && $t->key=="name"){
                                                    $translate[$lang]['name'] = $t->value;
                                                }
                                                if($t->locale == $lang && $t->key=="description"){
                                                    $translate[$lang]['description'] = $t->value;
                                                }
                                            }
                                        }
                                        $translatedName = $translate[$lang]['name'] ?? '';
                                        $translatedDesc = $translate[$lang]['description'] ?? '';
                                        ?>

                                    <div class="d-none lang_form" id="{{ $lang }}-form">
                                        {{-- Name --}}
                                        <div class="mb-20 position-relative">
                                            <label class="form-label">{{ translate('name') }} ({{ strtoupper($lang) }})</label>
                                            <input type="text"
                                                   class="form-control char-count-input"
                                                   name="name[]"
                                                   value="{{ $translatedName }}"
                                                   placeholder="{{ translate('name') }}"
                                                   maxlength="150"
                                                   data-preview-text="preview-title">
                                            <small class="text-muted d-flex justify-content-end">
                                                <span class="char-counter">{{ strlen($translatedName) }}</span>/150
                                            </small>
                                        </div>

                                        {{-- Description --}}
                                        <div class="form-floating mb-20 position-relative">
                                            <label class="form-label">{{ translate('Short_Description') }} ({{ strtoupper($lang) }})</label>
                                            <textarea class="form-control resize-none char-count-input"
                                                      name="short_desc[]"
                                                      placeholder="{{ translate('Short_Description') }}"
                                                      maxlength="350"
                                                      data-preview-text="preview-description">{{ $translatedDesc }}</textarea>
                                            <small class="text-muted d-flex justify-content-end">
                                                <span class="char-counter">{{ strlen($translatedDesc) }}</span>/350
                                            </small>
                                        </div>

                                        <input type="hidden" name="lang[]" value="{{ $lang }}">
                                    </div>
                                @endforeach


                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="text-center d-flex flex-column justify-content-center align-items-center gap-20px">
                                  <div>
                                    <label class="text--title fs-16 font-semibold mb-1">
                                        {{ translate('category_Image') }}
                                    </label>
                                </div>
                                <div class="h-100 d-flex align-items-center flex-column">
                                    <label class="text-center my-auto position-relative d-inline-block">
                                        <img class="img--176 border" id="viewer"
                                            src="{{ $category?->image_full_url }}"
                                            alt="image"/>
                                        <div class="icon-file-group">
                                            <div class="icon-file">
                                                <input type="file" name="category_image" id="customFileEg1" class="custom-file-input read-url"
                                                    accept=".webp, .jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" >
                                                    <i class="tio-edit"></i>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <div>
                                    <p class="fs-12">
                                        {{ translate('JPG, JPEG, PNG Less Than 1MB') }} <strong
                                            class="font-semibold">({{ translate('Ratio 1:1') }})</strong>
                                    </p>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-6">
                            <div class="text-capitalize">
                               <label for="brand_select"
                                       class="input-label text-capitalize">{{ translate('vehicle_type') }}</label>
                               <select name="type" id="type"
                                       class="js-data-example-ajax form-control"
                                       data-placeholder='{{ translate('select_type') }}'
                                       required>
                                       <option value="" disabled
                                                            selected>{{translate('select_category_type')}}</option>
                                            <option value="car" {{ $category->type == 'car' ? 'selected' : '' }}>{{translate('car')}}</option>
                                            <option value="motor_bike" {{ $category->type == 'motor_bike' ? 'selected' : '' }}>{{translate('Motor_Bike')}}</option>
                                            <option value="bicycle" {{ $category->type == 'bicycle' ? 'selected' : '' }}>{{translate('bicycle')}}</option>

                               </select>
                           </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="text-capitalize">
                               <label for=""
                                       class="input-label text-capitalize">{{ translate('category_use_for') }}</label>
                                <div class="d-flex flex-wrap form-control gap-3">
                                    @foreach(VEHICLE_CATEGORY_USE_CASE as $type)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input mx-2 category-use-for-checkbox-{{ $type }}" type="checkbox" value="{{$type}}" name="category_use_for[]" {{ $category->{'is_' . $type} == 1 ? 'checked' : '' }}>
                                            <label class=" form-check-label"> {{translate($type)}}</label>
                                        </div>
                                    @endforeach
                                </div>
                           </div>
                        </div>
                        <div class="col-6 delivery-required-field">
                            <div class="form-group">
                                <label class="input-label text-capitalize"
                                    for="title">{{translate('messages.extra_charges')}} ({{
                                    \App\CentralLogics\Helpers::currency_symbol() }}) <span
                                        class="input-label-secondary" data-toggle="tooltip" data-placement="right"
                                        data-original-title="{{translate('This amount will be added with delivery charge')}}"><img
                                            src="{{asset('public/assets/admin/img/info-circle.svg')}}"
                                            alt="public/img"></span><span class="form-label-secondary text-danger"
                                        data-toggle="tooltip" data-placement="right"
                                        data-original-title="{{ translate('messages.Required.')}}"> *
                                    </span>
                                </label>
                                <input type="number" id="extra_charges" class="form-control h--45px" step="0.001"
                                    min="0" name="extra_charges" value="{{ $category->extra_charges }}">
                            </div>
                        </div>
                        <div class="col-6 delivery-required-field">
                            <div class="form-group">
                                <label class="input-label text-capitalize"
                                    for="title">{{translate('messages.Starting_coverage_area')}} ({{
                                    translate('messages.km') }}) <span class="input-label-secondary"
                                        data-toggle="tooltip" data-placement="right"
                                        data-original-title="{{translate('the_starting_coverage_area_represents_the_location_where_deliveries_are_made.')}}"><img
                                            src="{{asset('public/assets/admin/img/info-circle.svg')}}"
                                            alt="public/img"></span><span class="form-label-secondary text-danger"
                                        data-toggle="tooltip" data-placement="right"
                                        data-original-title="{{ translate('messages.Required.')}}"> *
                                    </span>
                                </label>
                                <input type="number" id="starting_coverage_area" class="form-control h--45px"
                                    step="0.001" min="0" name="starting_coverage_area" value="{{ $category->starting_coverage_area }}">
                            </div>
                        </div>
                        <div class="col-6 delivery-required-field">
                            <div class="form-group">
                                <label class="input-label text-capitalize"
                                    for="title">{{translate('messages.maximum_coverage_area')}} ({{
                                    translate('messages.km') }}) <span class="input-label-secondary"
                                        data-toggle="tooltip" data-placement="right" data-original-title="{{translate('the_maximum_coverage_area_represents_the_farthest_or_widest_extent_to_which_deliveries_can_be_made')}}"><img src="{{asset('public/assets/admin/img/info-circle.svg')}}"
                                            alt="public/img"></span><span class="form-label-secondary text-danger"
                                        data-toggle="tooltip" data-placement="right"
                                        data-original-title="{{ translate('messages.Required.')}}"> *
                                    </span>
                                </label>
                                <input type="number" id="maximum_coverage_area" class="form-control h--45px"
                                    step="0.001" min="0" name="maximum_coverage_area" value="{{ $category->maximum_coverage_area }}">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="btn--container justify-content-end">
                                <button type="reset" id="reset_btn" class="btn btn--reset min-w-120px">{{ translate('messages.reset') }}</button>
                                <button type="submit" class="btn btn--primary min-w-120px">{{ translate('messages.submit') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
@endsection

@push('script_2')
    <script>
        "use strict";
        $('.js-select-ajax').select2({
            ajax: {
                url: '{{ route('admin.users.delivery-man.vehicle.brand.all-brands') }}',
                data: function(params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function(data) {
                    //
                    return {
                        results: data
                    };
                },
                __port: function(params, success, failure) {
                    let $request = $.ajax(params);
                    $request.then(success);
                    $request.fail(failure);
                    return $request;
                }
            }
        });

        $("#customFileEg1").change(function() {
            readURL(this);
            $('#viewer').show(1000)
        });
        $('#reset_btn').click(function(){
            $('#exampleFormControlSelect1').val(null).trigger('change');
                $('#viewer').attr('src', "{{ $category['image_full_url'] }}");
        })

        $(document).ready(function () {
        function toggleDeliveryFields() {
            if ($('.category-use-for-checkbox-delivery:checked').length > 0) {
                $('.delivery-required-field').show();
            } else {
                $('.delivery-required-field').hide();
            }
        }

        toggleDeliveryFields();

        $('.category-use-for-checkbox-delivery').on('change', function () {
            toggleDeliveryFields();
        });
    });
        $(document).on('keyup', '.char-count-input', function () {
            let count = $(this).val().length;
            $(this).closest('.position-relative').find('.char-counter').text(count);
        });
    </script>
@endpush
