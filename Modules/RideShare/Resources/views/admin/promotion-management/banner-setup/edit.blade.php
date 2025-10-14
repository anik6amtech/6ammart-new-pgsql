@extends('layouts.admin.app')

@section('title', translate('messages.banner'))

@push('css_or_js')
@endpush

@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <h1 class="page-header-title">
                <span class="page-header-icon">
                    <img src="{{ asset('public/assets/admin/img/banner.png') }}" class="w--26" alt="">
                </span>
                <span>
                    {{ translate('messages.Banners') }}
                </span>
            </h1>
        </div>

        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <h5 class="text-title mb-1">
                                {{ translate('messages.Edit_Banner') }}
                            </h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.ride-share.promotion.banner-setup.update', $banner->id) }}" method="post" id="banner_form" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row g-4">
                                <div class="col-lg-6">
                                   <div class="__bg-FAFAFA p-4 radius-10 mb-3">
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
                                                <label class="form-label">{{ translate('title') }}   ({{ translate('Default') }}) <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="title[]"
                                                    value="{{  $banner?->getRawOriginal('title') }}" placeholder="{{ translate('title') }}" maxlength="255"
                                                    data-preview-text="preview-title">
                                            </div>
                                            <input type="hidden" name="lang[]" value="default">
                                        </div>
                                        @foreach ($language as $lang)
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
                                                    <label class="form-label">{{ translate('title') }}    ({{ strtoupper($lang) }})</label>
                                                    <input type="text" class="form-control" name="title[]"
                                                    value="{{$translate[$lang]['title']??''}}"  placeholder="{{ translate('title') }}" maxlength="255"
                                                        data-preview-text="preview-title">
                                                </div>
                                                <input type="hidden" name="lang[]" value="{{ $lang }}">
                                            </div>
                                        @endforeach
									</div>

                                    <div class="form-group mb-0">
                                        <label class="input-label font-semibold"
                                            for="">{{ translate('messages.Redirect_Link') }} <span class="text-danger">*</span></label>
                                        <input type="url" name="redirect_link" value="{{ $banner->default_link }}" class="form-control" placeholder="Insert link" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="h-100 d-flex flex-column justify-content-between gap-20px">
                                        <div>
                                            <label class="fs-16 text-title font-semibold  mb-0">{{ translate('messages.Banner_Image') }} <span class="text-danger">*</span></label>
                                            <p class="mb-0">{{ translate('JPG, JPEG, PNG Less Than 1MB') }} <span
                                                    class="font-weight-bold">({{ translate('Ratio 3:1') }})</span>
                                            </p>
                                        </div>

                                        <div class="upload-file image-general flex-grow-1">
                                            <a href="javascript:void(0);" class="remove-btn opacity-0 z-index-99">
                                                <i class="tio-clear"></i>
                                            </a>
                                            <input type="file" name="banner_image" class="upload-file__input single_file_input" accept=".webp, .jpg, .jpeg, .png"
                                                >
                                            <label class="upload-file-wrapper fullwidth h-100">
                                                <div class="upload-file-textbox text-center" style="display: none;">
                                                    <img width="40" height="40" src="{{ asset('public/assets/admin/img/document-upload.svg') }}" alt="">
                                                    <h6 class="mt-2 font-semibold text-center d-flex d-sm-block flex-column gap-1">
                                                        <span>{{ translate('Click_to_upload') }}</span>
                                                        <span class="text--title text-lowercase"> {{ translate('or_drag_and_drop') }}</span>
                                                    </h6>
                                                </div>
                                                <img class="upload-file-img " src="{{ $banner->image_full_url }}" loading="lazy" alt="">
                                            </label>
                                        </div>
                                    </div>
                                </div>
								<div class="col-lg-6">
									<div class="form-group mb-0">
                                        <label class="input-label font-semibold"
                                            for="time_period">{{ translate('messages.Time_Period') }} <span class="text-danger">*</span></label>
                                        <select name="time_period" id="time_period" class="custom-select js-select2-custom" required>
                                            <option value="all_time" {{ ($banner->time_period == 'all_time') ? 'selected':'' }}>{{ translate('messages.Show_Always') }}</option>
                                            <option value="period" {{ ($banner->time_period == 'period') ? 'selected':'' }}>{{ translate('messages.Specific_Time_Period') }}</option>
                                        </select>
                                    </div>
								</div>
								<div class="col-lg-3 time_period_details {{ ($banner->time_period == 'all_time') ? 'd-none':'' }}">
									<div class="form-group mb-0">
                                        <label class="input-label font-semibold"
                                            for="">{{ translate('messages.Start_Date') }} <span class="text-danger">*</span></label>
										<!-- <div class="position-relative">
{{--											<i class="fi fi-sr-calendar fs-16 icon-absolute-on-right"></i>--}}
											<input type="text" class="form-control h-45 position-relative bg-transparent" name="start_date" value="{{ $banner->start_date }}" placeholder="{{ translate('messages.Select_Start_Date') }}">
										</div> -->


                                        
                                        <!-- Date Range Picker -->
                                        <div class="position-relative">
                                            <span class="tio-calendar icon-absolute-on-right"></span>
                                            <input type="text" name="start_date" value="{{ $banner->start_date?->format('m/d/Y') }}" class="single-reangepicker form-control bg-white">
                                        </div>
                                        <!-- Date Range Picker -->
                                    </div>
								</div>
								<div class="col-lg-3 time_period_details {{ ($banner->time_period == 'all_time') ? 'd-none':'' }}">
									<div class="form-group mb-0">
                                        <label class="input-label font-semibold"
                                            for="">{{ translate('messages.End_Date') }} <span class="text-danger">*</span></label>
										<!-- <div class="position-relative">
{{--											<i class="fi fi-sr-calendar fs-16 icon-absolute-on-right"></i>--}}
											<input type="text" class="form-control h-45 position-relative bg-transparent" name="end_date" value="{{ $banner->end_date }}" placeholder="{{ translate('messages.Select_End_Date') }}">
										</div> -->



                                        <!-- Date Range Picker -->
                                        <div class="position-relative">
                                            <span class="tio-calendar icon-absolute-on-right"></span>
                                            <input type="text" name="end_date" value="{{ $banner->end_date?->format('m/d/Y') }}" class="single-reangepicker form-control bg-white">
                                        </div>
                                        <!-- Date Range Picker -->
                                    </div>
								</div>
								<div class="col-12">
									<div class="btn--container justify-content-end">
										<button type="reset" id="reset_btn" class="btn btn--reset">{{ translate('messages.reset') }}</button>
										<button type="submit" class="btn btn--primary">{{ translate('messages.submit') }}</button>
									</div>
								</div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>
<input type="hidden" id="current_module_id" value="{{ Config::get('module.current_module_id') }}" >
@endsection

@push('script_2')
    <script src="{{ asset('public/assets/admin/js/view-pages/banner-index.js') }}"></script>
     <script src="{{ asset('public/assets/admin/js/ride-share/banner-list.js') }}"></script>

	<script>
        $(function() {

            $('.datepicker_input').daterangepicker({
				singleDatePicker: true,
				showDropdowns: true,
				autoUpdateInput: false,
				minDate: new Date()
			});
			$('.datepicker_input').on('apply.daterangepicker', function (ev, picker) {
				$(this).val(picker.startDate.format('M/D/YYYY'));
			});

            $("#time_period").on('change', function() {
                if ($(this).val() === 'period') {
                    $('.time_period_details').removeClass('d-none');
                    $('.datepicker_input').attr('required', true);
                } else {
                    $('.time_period_details').addClass('d-none');
                }
            });

            // single-reangepicker
            $('.single-reangepicker').each(function () {
                const $this = $(this);
                $this.daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true,
                    autoUpdateInput: true,
                    autoApply: true,
                    locale: {
                        format: 'MM/DD/YYYY'
                    }
                });
                $this.on('show.daterangepicker', function (ev, picker) {
                    picker.container.addClass('single-reangepicker__custom');
                    picker.container.find('.calendar.right').hide();
                });
            });

        });
    </script>
@endpush
