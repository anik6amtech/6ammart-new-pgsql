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
                    {{ translate('messages.edit_model') }}
                </span>
            </h1>
        </div>

         <form action="{{ route('admin.ride-share.vehicle.attribute-setup.model.update', ['id' => $model->id]) }}"
                        enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('PUT')
            <div class="card mb-4">
                <div class="card-header">
                    <div>
                        <h5 class="text-title mb-1">
                            {{ translate('messages.edit_model') }}
                        </h5>
                        <p class="fs-12 mb-0">
                            {{ translate('messages.the_current_level_setup_automatically_assigns_drivers_the_default_level_upon_their_initial_app_login') }}
                        </p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-lg-6">
                            <div class="">
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
                                    <div class="mb-20">
                                        <label class="form-label">{{ translate('name') }}   ({{ translate('Default') }})</label>
                                        <input type="text" class="form-control" name="name[]"
                                            value="{{  $model?->getRawOriginal('name') }}" placeholder="{{ translate('name') }}" maxlength="255"
                                            data-preview-text="preview-title">
                                    </div>
                                    <div class="form-floating mb-20">
                                        <label class="form-label">{{ translate('Short_Description') }}  ({{ translate('Default') }})</label>
                                        <textarea class="form-control resize-none" 
                                            placeholder="{{ translate('Short_Description') }}" name="short_desc[]"
                                            data-preview-text="preview-description">{{$model?->getRawOriginal('description') }}</textarea>
                                    </div>
                                    <input type="hidden" name="lang[]" value="default">
                                </div>

                                @foreach ($language as $lang)
                                    <?php
                                        if(count($model['translations'])){
                                            $translate = [];
                                            foreach($model['translations'] as $t)
                                            {
                                                if($t->locale == $lang && $t->key=="name"){
                                                    $translate[$lang]['name'] = $t->value;
                                                }
                                                if($t->locale == $lang && $t->key=="description"){
                                                    $translate[$lang]['description'] = $t->value;
                                                }
                                            }
                                        }
                                    ?>

                                    <div class="d-none lang_form" id="{{ $lang }}-form">
                                        <div class="mb-20">
                                            <label class="form-label">{{ translate('name') }}    ({{ strtoupper($lang) }})</label>
                                            <input type="text" class="form-control" name="name[]"
                                            value="{{$translate[$lang]['name']??''}}"  placeholder="{{ translate('name') }}" maxlength="255"
                                                data-preview-text="preview-title">
                                        </div>
                                        <div class="form-floating mb-20">
                                            <label class="form-label">{{ translate('Short_Description') }}   ({{ strtoupper($lang) }})</label>
                                            <textarea class="form-control resize-none"
                                                placeholder="{{ translate('Short_Description') }}" name="short_desc[]"
                                                data-preview-text="preview-description">{{$translate[$lang]['description']??'' }}</textarea>
                                        </div>
                                        <input type="hidden" name="lang[]" value="{{ $lang }}">
                                    </div>

                                @endforeach

                                 <div class="mb-4">
                                    <label for="brand_select"
                                        class="mb-2">{{ translate('brand_name') }}</label>
                                    <select name="brand_id" id="brand_select"
                                        class="js-select-ajax text-capitalize">
                                        @if (isset($model->brand))
                                            <option value="{{ $model->brand->id }}" selected="selected">
                                                {{ $model->brand->name }}</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="text-center d-flex flex-column justify-content-center align-items-center gap-20px">
                                <div>
                                    <label class="text--title fs-16 font-semibold mb-1">
                                        {{ translate('model_image') }}
                                    </label>
                                </div>
                                <div class="upload-file image-general d-inline-block w-auto">
                                    <a href="javascript:void(0);" class="remove-btn opacity-0 z-index-99">
                                        <i class="tio-clear"></i>
                                    </a>
                                    <input type="file" name="model_image" class="upload-file__input single_file_input"
                                        accept=".webp, .jpg, .jpeg, .png">
                                    <label class="upload-file-wrapper aspect-1-1">
                                        <div class="upload-file-textbox text-center w-100" style="display: none;">
                                            <img width="34" height="34"
                                                src="{{ asset('public/assets/admin/img/document-upload.svg') }}" alt="">
                                            <h6 class="mt-2 font-semibold text-center">
                                                <span>{{ translate('Click to upload') }}</span>
                                                <br>
                                                {{ translate('or drag and drop') }}
                                            </h6>
                                        </div>
                                        <img class="upload-file-img" loading="lazy" src="{{ $model?->image_full_url }}"
                                            alt="">
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
                url: '{{ route('admin.ride-share.vehicle.attribute-setup.brand.all-brands') }}',
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

        // Assuming you have a reset button with ID 'reset-button'
        let resetButton = $('#reset_btn');
        let defaultImageSrc = '{{ asset('public/assets/admin-module/img/media/upload-file.png') }}';
        let imageElement = $('#image_id');
        let fileInput = $('.upload-file__input');

        resetButton.on('click', function() {
            imageElement.attr('src', defaultImageSrc);
            fileInput.val('');
        });
    </script>
@endpush
