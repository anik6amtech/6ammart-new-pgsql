@extends('layouts.admin.app')

@section('title', translate('Create Campaign'))

@push('css_or_js')
<link rel="stylesheet" type="text/css" href="{{asset('public/assets/admin/vendor/daterangepicker/daterangepicker.css')}}"/>
@endpush

@section('content')

<div class="content container-fluid">
    <!-- Page Title -->
    <h2 class="h1 mb-sm-3 mb-2 text-capitalize d-flex align-items-center gap-2">
        {{ translate('messages.Create Campaign') }}
    </h2>
    <div class="card">
        <div class="card-body p-20">
            <form action="{{ route('admin.service.campaign.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="bg-light rounded p-3">
                            <ul class="nav nav-tabs nav--tabs mb-20 border-0">
                                <li class="nav-item">
                                    <a class="nav-link lang_link active" href="#" id="default-link">{{translate('messages.default')}}</a>
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
                                    <label class="form-label">{{ translate('campaign_name') }} ({{ translate('Default') }})</label>
                                    <input type="text" class="form-control" name="campaign_name[]"
                                        value="{{ old('campaign_name.0') }}" placeholder="{{ translate('campaign_name') }}" maxlength="255"
                                        data-preview-text="preview-title">
                                </div>
                                <div class="mb-20">
                                    <label class="form-label">{{ translate('title') }} ({{ translate('Default') }})</label>
                                    <input type="text" class="form-control" name="discount_title[]"
                                        value="{{ old('discount_title.0') }}" placeholder="{{ translate('title') }}" maxlength="255"
                                        data-preview-text="preview-title">
                                </div>
                                <div class="mb-20">
                                    <label class="form-label">{{ translate('short_description') }} ({{ translate('Default') }})</label>
                                    <textarea class="form-control" name="short_description[]" rows="3" placeholder="{{ translate('short_description') }}" maxlength="255">{{ old('short_description.0') }}</textarea>
                                </div>
                                <input type="hidden" name="lang[]" value="default">
                            </div>
                            @foreach ($language as $key => $lang)
                                <div class="d-none lang_form" id="{{ $lang }}-form">
                                    <div class="mb-20">
                                        <label class="form-label">{{ translate('campaign_name') }}   ({{ strtoupper($lang) }})</label>
                                        <input type="text" class="form-control" name="campaign_name[]"
                                            value="{{ old('campaign_name.'.$key) }}" placeholder="{{ translate('campaign_name') }}" maxlength="255"
                                            data-preview-text="preview-title">
                                    </div>
                                    <div class="mb-20">
                                        <label class="form-label">{{ translate('title') }}   ({{ strtoupper($lang) }})</label>
                                        <input type="text" class="form-control" name="discount_title[]"
                                            value="{{ old('discount_title.'.$key) }}" placeholder="{{ translate('title') }}" maxlength="255"
                                            data-preview-text="preview-title">
                                    </div>
                                    <div class="mb-20">
                                        <label class="form-label">{{ translate('short_description') }}   ({{ strtoupper($lang) }})</label>
                                        <textarea class="form-control" name="short_description[]" rows="3" placeholder="{{ translate('short_description') }}" maxlength="255">{{ old('short_description.'.$key) }}</textarea>
                                    </div>

                                    <input type="hidden" name="lang[]" value="{{ $lang }}">
                                </div>
                            @endforeach
                        </div>

                        <div class="form-group mb-2 mt-3">
                            <span class="fz--14px d-block text-title mb-2 d-flex align-items-center gap-1">
                                {{translate('discount_type')}} <span class="text-danger">*</span>
                            </span>
                            <div class="form-group mb-2 d-flex flex-wrap px-2 custom-select-wrap border rounded align-items-center gap-4">
                                <label class="form-check form--check">
                                    <input class="form-check-input" type="radio" value="category" name="discount_type" id="discount_type_category" checked>
                                    <span class="form-check-label">
                                        {{ translate('category_wise') }}
                                    </span>
                                </label>
                                <label class="form-check form--check">
                                    <input class="form-check-input" type="radio" value="service" name="discount_type" id="discount_type_service">
                                    <span class="form-check-label">
                                        {{ translate('service_wise') }}
                                    </span>
                                </label>
                                <label class="form-check form--check">
                                    <input class="form-check-input" type="radio" value="mixed" name="discount_type" id="discount_type_mixed">
                                    <span class="form-check-label">
                                        {{ translate('mixed') }}
                                    </span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group mb-2" id="select_category_wrapper">
                            <label class="form-label text-capitalize" for="multiCagory">
                                {{ translate('messages.Service Category') }}
                            </label>
                            <select required name="category_ids[]" id="select_category"
                                class="form-control js-select2-custom"
                                multiple="multiple" data-placeholder="{{translate('messages.select_category')}}">
                                <option value="all">{{translate('messages.all')}} </option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" {{ old('category_ids') && in_array($category->id, old('category_ids')) ? 'selected' : '' }}>{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-0" style="display: none;" id="select_service_wrapper">
                            <label class="form-label text-capitalize" for="multiCagory">
                                {{ translate('messages.Services') }}
                            </label>
                            <select name="service_ids[]" id="select_service"
                                class="form-control js-select2-custom"
                                multiple="multiple" data-placeholder="{{translate('messages.select_service')}}">
                                <option value="all">{{translate('messages.all')}} </option>
                                @foreach($services as $service)
                                    <option value="{{$service->id}}">{{$service->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="d-flex flex-column gap-4">
                            <div class="">
                                <div class="bg-light rounded p-xl-4 p-3">
                                    <div class="mb-xl-4 mb-3">
                                        <div class="text-center mb-xl-3 mb-2">
                                            <h5 class="mb-1">{{ translate('messages.campaign_image') }}</h5>
                                            <span class="fz-12px">{{ translate('messages.image_formats') }} <strong>({{ translate('messages.ratio') }} 2:1)</strong></span>
                                        </div>
                                        <div class="global-image-upload ratio-4-1 border-dashed rounded-10 bg-white position-relative max-w-100 overflow-hidden border-dashed mx-auto h-130 d-center">
                                            <input type="file" accept="image/*" name="campaign_image" required style="position: absolute; width: 100%; height: 100%; opacity: 0; cursor: pointer;">
                                            <div class="global-upload-box">
                                                <div class="upload-content text-center">
                                                    <img src="{{asset('Modules/Service/public/assets/img/admin/do-upload.png')}}" alt="upload-your-image" class="mb-2">
                                                    <div class="d-flex align-items-center gap-1 justify-content-center">
                                                        <span class="fz-12px text-theme d-block">{{ translate('messages.click_to_upload') }}</span> <span class="fz-12px text-title d-block">{{ translate('messages.or_drag_and_drop') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <img class="global-image-preview d-none" src="" alt="Preview" style="max-height: 100%; max-width: 100%;" />
                                            <div class="overlay-icons d-none">
                                                <button type="button" class="btn btn--info p-2 action-btn view-icon" title="View" data-toggle="modal" data-target="#imageShowingMOdal">
                                                    <i class="tio-invisible"></i>
                                                </button>
                                                <button type="button" class="btn btn--info p-2 action-btn edit-icon" title="Edit">
                                                    <i class="tio-edit"></i>
                                                </button>
                                            </div>
                                            <div class="image-file-name d-none mt-2 text-center text-muted" style="font-size: 12px;"></div>
                                        </div>
                                    </div>
                                     <div>
                                        <div class="text-center mb-xl-3 mb-2">
                                            <h5 class="mb-1">{{ translate('messages.thumbnail_image') }}</h5>
                                            <span class="fz-12px">{{ translate('messages.image_formats') }} <strong>({{ translate('messages.ratio') }} 1:1)</strong></span>
                                        </div>
                                        <div class="global-image-upload ratio-1 border-dashed rounded-10 bg-white position-relative max-w-100 overflow-hidden border-dashed mx-auto h-130 d-center">
                                            <input type="file" accept="image/*" name="thumbnail" required style="position: absolute; width: 100%; height: 100%; opacity: 0; cursor: pointer;">
                                            <div class="global-upload-box">
                                                <div class="upload-content text-center">
                                                    <img src="{{asset('Modules/Service/public/assets/img/admin/do-upload.png')}}" alt="upload-your-image" class="mb-2">
                                                    <div class="d-grid align-items-center gap-1 justify-content-center">
                                                        <span class="fz-12px text-theme d-block">{{ translate('messages.click_to_upload') }}</span> <span class="fz-12px text-title d-block">{{ translate('messages.or_drag_and_drop') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <img class="global-image-preview d-none" src="" alt="Preview" style="max-height: 100%; max-width: 100%;" />
                                            <div class="overlay-icons d-none">
                                                <button type="button" class="btn btn--info p-2 action-btn view-icon" title="View" data-toggle="modal" data-target="#imageShowingMOdal">
                                                    <i class="tio-invisible"></i>
                                                </button>
                                                <button type="button" class="btn btn--info p-2 action-btn edit-icon" title="Edit">
                                                    <i class="tio-edit"></i>
                                                </button>
                                            </div>
                                            <div class="image-file-name d-none mt-2 text-center text-muted" style="font-size: 12px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-6 mb-3" id="select_zone_wrapper">
                                <div class="form-group mb-0 select-couting position-relative">
                                    <label class="input-label" for="select_customer">{{translate('messages.Zones')}}</label>
                                    <select required name="zone_ids[]" id="select_zone"
                                        class="form-control js-select2-custom"
                                        multiple="multiple" data-placeholder="{{translate('messages.select_zone')}}">
                                        <option value="all">{{translate('messages.all')}} </option>
                                        @foreach($zones as $zone)
                                            <option value="{{$zone->id}}" {{ old('zone_ids') && in_array($zone->id, old('zone_ids')) ? 'selected' : '' }}>{{$zone->name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="countBox w-30px h-25px bg-primary rounded p-1 text-white fz-12px">+0</span>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <div>
                                    <label class="form-label">{{ translate('messages.Discount Amount') }}</label>
                                    <div class="d-flex align-items-center restriction-time rounded border">
                                        <div class="flex-grow-1">
                                            <input class="form-control border-0"
                                                   placeholder="Ex: 5"
                                                   min="1"
                                                   type="number"
                                                   value="{{ old('discount_amount') }}"
                                                   name="discount_amount"
                                                   id="discount_amount">
                                        </div>
                                        <select class="form-select w-auto bg-light border-0 h--45px px-2"
                                                name="discount_amount_type"
                                                id="discount_amount_type"
                                                required>
                                            <option value="percent" {{ old('discount_amount_type') == 'percent' ? 'selected': '' }}>%</option>
                                            <option value="amount" {{ old('discount_amount_type') == 'amount' ? 'selected': '' }}>$</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <div class="form-group mb-0">
                                    <label class="form-label" for="">{{ translate('messages.Discount Duration') }}</label>
                                    <div class="position-relative date-picker__custom">
                                        <input type="text" class="form-control date-range-picker2" name="discount_duration" value="{{ old('discount_duration') }}" data-placeholder="{{ translate('messages.03/05/2025 - 03/08/2025') }}" autocomplete="off">
                                        <span class="calender-icon">
                                            <i class="tio-calendar-month"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <div class="form-group mb-0">
                                    <label for="discount_max" class="form-label font-normal fz--14px">
                                        {{ translate('messages.Maximum Discount') }} ($)
                                    </label>
                                    <input type="number" class="form-control h--45px" name="max_discount_amount" id="discount_max" value="{{ old('max_discount_amount') }}" placeholder="Ex: 5">
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <div class="form-group mb-0">
                                    <label for="discount_min" class="form-label font-normal fz--14px">
                                    {{ translate('messages.Minimum Booking amount') }} ($)
                                    </label>
                                    <input type="number" class="form-control h--45px" name="min_purchase" id="discount_min" value="{{ old('min_purchase') }}" placeholder="100">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="btn--container justify-content-end mt-3">
                    <button type="reset" class="btn btn--reset">{{ translate('messages.Reset') }}</button>
                    <button type="submit" class="btn btn--primary call-demo">{{ translate('messages.Submit') }}</button>
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
    <script type="text/javascript" src="{{asset('public/assets/admin/vendor/daterangepicker/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/admin/vendor/daterangepicker/daterangepicker.min.js')}}"></script>

    <script>
        $('#select_category').on('change', function() {
            var selectedValues = $(this).val();
            if (selectedValues !== null && selectedValues.includes('all')) {
                $(this).find('option').not(':disabled').prop('selected', 'selected');
                $(this).find('option[value="all"]').prop('selected', false);
            }
        });

        $('#select_service').on('change', function() {
            var selectedValues = $(this).val();
            if (selectedValues !== null && selectedValues.includes('all')) {
                $(this).find('option').not(':disabled').prop('selected', 'selected');
                $(this).find('option[value="all"]').prop('selected', false);
            }
        });

        $('#select_zone').on('change', function() {
            var selectedValues = $(this).val();
            if (selectedValues !== null && selectedValues.includes('all')) {
                $(this).find('option').not(':disabled').prop('selected', 'selected');
                $(this).find('option[value="all"]').prop('selected', false);
            }
        });

        $('#discount_type_category').on('click', function () {
            $('#select_category_wrapper').show();
            $('#select_service_wrapper').hide();

            $('#select_category').prop('required',true);
            $('#select_service').prop('required',false);
        });

        $('#discount_type_service').on('click', function () {
            $('#select_category_wrapper').hide();
            $('#select_service_wrapper').show();

            $('#select_service').prop('required',true);
            $('#select_category').prop('required',false);
        });

        $('#discount_type_mixed').on('click', function () {
            $('#select_category_wrapper').show();
            $('#select_service_wrapper').show();

            $('#select_service').prop('required',true);
            $('#select_category').prop('required',true);
        });

        const discountInput = document.getElementById('discount_amount');
        const discountType = document.getElementById('discount_amount_type');

        function checkDiscountLimit() {
            if (discountType.value === 'percent') {
                discountInput.setAttribute('max', 100);
                if (discountInput.value > 100) {
                    discountInput.value = 100;
                }
            } else {
                discountInput.removeAttribute('max');
            }
        }

        discountType.addEventListener('change', checkDiscountLimit);
        discountInput.addEventListener('input', checkDiscountLimit);

        checkDiscountLimit();
    </script>
@endpush
