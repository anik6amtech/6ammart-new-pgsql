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

         <form action="{{ route('admin.users.delivery-man.vehicle.model.update', ['id' => $model->id]) }}"
                        enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('PUT')
            <div class="card mb-4">
                {{-- <div class="card-header">
                    <div>
                        <h5 class="text-title mb-1">
                            {{ translate('messages.edit_model') }}
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
                                        <label class="form-label">{{ translate('name') }} ({{ translate('Default') }}) <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control char-count-input"
                                               name="name[]"
                                               value="{{ $model?->getRawOriginal('name') }}"
                                               placeholder="{{ translate('name') }}"
                                               maxlength="150"
                                               required
                                               data-preview-text="preview-title">

                                        <small class="text-muted d-flex justify-content-end">
                                            <span class="char-counter">{{ strlen($model?->getRawOriginal('name') ?? '') }}</span>/150
                                        </small>
                                    </div>

                                    {{-- Default Description --}}
                                    <div class="form-floating mb-20 position-relative">
                                        <label class="form-label">{{ translate('Short_Description') }} ({{ translate('Default') }}) <span class="text-danger">*</span></label>
                                        <textarea class="form-control resize-none char-count-input"
                                                  name="short_desc[]"
                                                  placeholder="{{ translate('Short_Description') }}"
                                                  maxlength="350"
                                                  required
                                                  data-preview-text="preview-description">{{ $model?->getRawOriginal('description') }}</textarea>

                                        <small class="text-muted d-flex justify-content-end">
                                            <span class="char-counter">{{ strlen($model?->getRawOriginal('description') ?? '') }}</span>/350
                                        </small>
                                    </div>

                                    <input type="hidden" name="lang[]" value="default">
                                </div>

                                {{-- Other languages --}}
                                @foreach ($language as $lang)
                                        <?php
                                        $translate = [];
                                        if(count($model['translations'])){
                                            foreach($model['translations'] as $t){
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
                            <div class="mt-3 mb-4">
                               <label for="brand_select"
                                   class="mb-2 form-label">{{ translate('brand_name') }}</label>
                               <select name="brand_id" id="brand_select"
                                   class="js-select-ajax text-capitalize">
                                   @if (isset($model->brand))
                                       <option value="{{ $model->brand->id }}" selected="selected">
                                           {{ $model->brand->name }}</option>
                                   @endif
                               </select>
                           </div>
                        </div>
                       <div class="col-lg-6">
                            <div class="text-center d-flex flex-column justify-content-center align-items-center gap-20px">
                                  <div>
                                    <label class="text--title fs-16 font-semibold mb-1">
                                        {{ translate('Model_Image') }} <span class="text-danger">*</span>
                                    </label>
                                </div>
                                <div class="h-100 d-flex align-items-center flex-column">
                                    <label class="text-center my-auto position-relative d-inline-block">
                                        <img class="img--176 border" id="viewer"
                                            src="{{ $model?->image_full_url }}"
                                            alt="image"/>
                                        <div class="icon-file-group">
                                            <div class="icon-file">
                                                <input type="file" name="model_image" id="customFileEg1" class="custom-file-input read-url"
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
                $('#viewer').attr('src', "{{ $model['image_full_url'] }}");
        })

        $(document).on('keyup', '.char-count-input', function () {
            let count = $(this).val().length;
            $(this).closest('.position-relative').find('.char-counter').text(count);
        });
    </script>
@endpush
