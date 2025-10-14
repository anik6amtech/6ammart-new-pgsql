@extends('layouts.admin.app')

@section('title', translate('Banner'))

@push('css_or_js')

@endpush

@section('content')

<div class="content container-fluid">
     <!-- Page Title -->
    <h2 class="h1 mb-sm-3 mb-2 text-capitalize d-flex align-items-center gap-2">
        {{ translate('messages.edit_banner') }}
    </h2>
    <div class="card mb-20">
        <div class="card-body p-20">
            <form action="{{route('admin.service.banner.update', $banner->id)}}" method="POST"
                                      enctype="multipart/form-data"
                                      onSubmit="return validate();">
                                        @method('PUT')
                                    @csrf
                <div class="row g-3">
                    <div class="col-lg-6">
                        <div class="d-flex flex-column gap-24px">
                            <div class="bg-light rounded p-3">
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
                                        <label class="form-label">{{ translate('banner_title') }} ({{ translate('Default') }})</label>
                                        <input type="text" class="form-control" name="banner_title[]"
                                            value="{{ $banner?->getRawOriginal('title') }}" placeholder="{{ translate('type_banner_title') }}" maxlength="255"
                                            data-preview-text="preview-title">
                                    </div>
                                    <input type="hidden" name="lang[]" value="default">
                                </div>
                                @foreach ($language as $key => $lang)
                                    <?php
                                        if(count($banner['translations'])){
                                            $translate = [];
                                            foreach($banner['translations'] as $t)
                                            {
                                                if($t->locale == $lang && $t->key=="title"){
                                                    $translate[$lang]['title'] = $t->value;
                                                }
                                            }
                                        }
                                    ?>
                                    <div class="d-none lang_form" id="{{ $lang }}-form">
                                        <div class="mb-20">
                                            <label class="form-label">{{ translate('banner_title') }}   ({{ strtoupper($lang) }})</label>
                                            <input type="text" class="form-control" name="banner_title[]"
                                                value="{{ $translate[$lang]['title']??'' }}" placeholder="{{ translate('type_banner_title') }}" maxlength="255"
                                                data-preview-text="preview-title">
                                        </div>
                                        <input type="hidden" name="lang[]" value="{{ $lang }}">
                                    </div>
                                @endforeach
                            </div>
                            <div class="d-flex flex-column gap-4">
                                <div>
                                    <span class="fz--14px d-block text-title mb-2 d-flex align-items-center gap-1">
                                        {{ translate('resource_type') }} <span class="text-danger">*</span>
                                    </span>
                                    <div class="form-group mb-0 d-flex flex-wrap px-2 custom-select-wrap border rounded align-items-center gap-4">
                                        <label class="form-check form--check">
                                            <input class="form-check-input" type="radio" value="category" name="resource_type" id="category" {{$banner->type=='category'?'checked':''}}>
                                            <span class="form-check-label">
                                                {{translate('category_wise')}}
                                            </span>
                                        </label>
                                        <label class="form-check form--check">
                                            <input class="form-check-input" type="radio" value="service" name="resource_type" id="service" {{$banner->type=='service'?'checked':''}}>
                                            <span class="form-check-label">
                                                {{translate('service_wise')}}
                                            </span>
                                        </label>
                                        <label class="form-check form--check">
                                            <input class="form-check-input" type="radio" value="redirect_link" name="resource_type" id="redirect_link" {{$banner->type=='redirect_link'?'checked':''}}>
                                            <span class="form-check-label">
                                                {{translate('redirect_link')}}
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group mb-0 {{$banner->type=='category'?'selected_resource_type':''}}" id="category_selector" style="{{$banner->type=='category'?'':'display:none;'}}">
                                    <label class="form-label text-capitalize" for="serviceWise">
                                        {{ translate('messages.Service Category') }}
                                    </label>
                                    <select id="category_id" name="category_id" class="form-control  js-select2-custom">
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" {{$category->id==$banner->data?'selected':''}}>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-0 {{$banner->type=='service'?'selected_resource_type':''}}" id="service_selector" style="{{$banner->type=='service'?'':'display:none;'}}">
                                    <label class="form-label text-capitalize" for="serviceWise">
                                        {{ translate('messages.Service') }}
                                    </label>
                                    <select id="service_id" name="service_id" class="form-control  js-select2-custom">
                                       @foreach($services as $service)
                                            <option value="{{$service->id}}" {{$service->id==$banner->data?'selected':''}}>{{$service->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-0 link_selector {{$banner->type=='redirect_link'?'selected_resource_type':''}}" id="link_selector" style="{{$banner->type=='redirect_link'?'':'display:none;'}}">
                                    <label class="form-label text-capitalize" for="serviceWise">
                                        {{ translate('messages.redirect_link') }}
                                    </label>
                                    <input type="url" class="form-control"
                                            placeholder="{{translate('redirect_link')}}"
                                            name="redirect_link" value="{{ $banner->default_link }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="d-flex flex-column gap-4">
                            <div class="">
                                <div class="mb-xl-4 mb-3">
                                    <div class="text-center mb-xl-3 mb-2">
                                        <h5 class="mb-1">{{ translate('messages.banner_image') }}</h5>
                                        <span class="fz-12px">{{ translate('JPG,_JPEG,_PNG,_GIF_Less_Than_1MB') }} <strong>(Ratio 3:1)</strong></span>
                                    </div>
                                    <div class="global-image-upload ratio-4-1 border-dashed rounded-10 bg-light position-relative max-w-100 overflow-hidden border-dashed mx-auto h-130 d-center has-image">
                                        <input type="file" name="banner_image" accept="image/*" style="position: absolute; width: 100%; height: 100%; opacity: 0; cursor: pointer;">
                                        <div class="global-upload-box d-none">
                                            <div class="upload-content text-center">
                                                <img src="{{asset('/public/assets/admin/img/do-upload.png')}}" alt="upload-your-image" class="mb-2">
                                                <div class="d-flex align-items-center gap-1 justify-content-center">
                                                    <span class="fz-12px text-theme d-block">{{ translate('messages.click_to_upload') }}</span> <span class="fz-12px text-title d-block">{{ translate('messages.or_drag_and_drop') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <img class="global-image-preview" src="{{ $banner->image_full_url }}" data-default="{{ $banner->image_full_url }}" alt="Preview" style="max-height: 100%; max-width: 100%;" />
                                        <div class="overlay-icons">
                                            <button type="button" class="btn btn--info p-2 action-btn view-icon" title="View" data-toggle="modal" data-target="#imageShowingMOdal">
                                                <i class="tio-invisible"></i>
                                            </button>
                                            <button type="button" class="btn btn--info p-2 action-btn edit-icon" title="Edit">
                                                <i class="tio-edit"></i>
                                            </button>
                                        </div>
                                        <div class="image-file-name mt-2 text-center text-muted" style="font-size: 12px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="btn--container justify-content-end mt-3">
                    <button type="reset" class="btn btn--reset">{{ translate('messages.reset') }}</button>
                    <button type="submit" class="btn btn--primary call-demo">{{ translate('messages.submit') }}</button>
                </div>
            </form>
        </div>
    </div>

    <!--image showing-->
    <div class="modal fade custom-confirmation-modal" id="imageShowingMOdal" tabindex="-1" aria-labelledby="imageShowingMOdalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body py-3 px-sm-4 px-3">
                    <button type="button" class="btn-close image-show__close bg-light rounded-full" data-dismiss="modal" aria-label="Close">
                        <i class="tio-clear"></i>
                    </button>
                    <div class="image-display-container">
                        <!-- Push Inside any images -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('script_2')

 <script>
        "use Strict";

        $(document).ready(function () {
            $('.js-select').select2();
        });

        $('#category').on('click', function () {
            $('#category_selector').show();
            $('#service_selector').hide();
            $('#link_selector').hide();
        });

        $('#service').on('click', function () {
            $('#category_selector').hide();
            $('#service_selector').show();
            $('#link_selector').hide();
        });

        $('#redirect_link').on('click', function () {
            $('#category_selector').hide();
            $('#service_selector').hide();
            $('#link_selector').show();
        });

        $('.btn--reset').on('click', function () {
            $('#category_selector').hide();
            $('#service_selector').hide();
            $('#link_selector').hide();
            $('.selected_resource_type').show();
            $('.global-image-preview').attr('src', $('.global-image-preview').data('default'));
        });
    </script>

@endpush
