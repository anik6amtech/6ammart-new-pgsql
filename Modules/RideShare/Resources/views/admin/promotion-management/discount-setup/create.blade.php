@extends('layouts.admin.app')

@section('title', translate('messages.add_new_discount'))

@push('css_or_js')
@endpush

@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <h1 class="page-header-title">
                <span class="page-header-icon">
                    <img src="{{ asset('public/assets/admin/img/icons/coupon-icon.png') }}" class="w--26" alt="">
                </span>
                <span>
                    {{ translate('messages.Discounts') }}
                </span>
            </h1>
        </div>
        <div class="card">
            <div class="card-header">
                <div>
                    <h5 class="text-title mb-1">
                        {{ translate('messages.Add_Discount') }}
                    </h5>
                    {{-- <p class="mb-0 fs-12">Vendor Logo & Covers</p> --}}
                </div>
            </div>
            <div class="card-body">

                <form action="{{ route('admin.ride-share.promotion.discount-setup.store') }}" method="POST" id="discount_form" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-4">
                        <div class="col-6">
                            <div class="__bg-FAFAFA p-4 radius-10">
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
                                    <div class="row g-4">
                                        <div class="col-lg-12">
                                            <div class="form-group mb-0">
                                                <label class="input-label font-semibold" for="default_title">{{ translate('title') }} ({{ translate('Default') }}) <span class="text-danger">*</span></label>
                                                <input type="text" name="title[]" id="default_title" class="form-control" value="{{ old('title.0') }}"
                                                       placeholder="Auto Focus Car Service" required="">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group mb-0">
                                                <label class="input-label font-semibold" for="default_description">{{ translate('description') }} ({{ translate('Default') }}) <span class="text-danger">*</span></label>
                                                <textarea name="short_description[]" id="default_description" class="form-control" placeholder="Auto Focus Car Service" required="">{{ old('short_description.0') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group mb-0">
                                                <label class="input-label font-semibold" for="default_terms_conditions">{{ translate('terms_conditions') }} ({{ translate('Default') }}) <span class="text-danger">*</span></label>
                                                <textarea name="terms_conditions[]" id="default_terms_conditions" class="form-control" placeholder="Auto Focus Car Service" required="">{{ old('terms_conditions.0') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="lang[]" value="default">
                                </div>

                                @foreach ($language as $key => $lang)
                                    <div class="d-none lang_form" id="{{ $lang }}-form">
                                        <div class="row g-4">
                                            <div class="col-lg-12">
                                                <div class="form-group mb-0">
                                                    <label class="input-label font-semibold">{{ translate('title') }}   ({{ strtoupper($lang) }})</label>
                                                    <input type="text" name="title[]" id="{{ $lang }}_title" class="form-control" value="{{ old('title.'.($key + 1)) }}"
                                                           placeholder="Auto Focus Car Service">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group mb-0">
                                                    <label class="input-label font-semibold" for="{{ $lang }}_description">{{ translate('description') }}
                                                        ({{ strtoupper($lang) }})
                                                    </label>
                                                    <textarea name="short_description[]" id="{{ $lang }}_description" class="form-control" placeholder="Auto Focus Car Service">{{ old('short_description.'.($key + 1)) }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group mb-0">
                                                    <label class="input-label font-semibold" for="{{ $lang }}_terms_conditions">{{ translate('terms_conditions') }}
                                                        ({{ strtoupper($lang) }})
                                                    </label>
                                                    <textarea name="terms_conditions[]" id="{{ $lang }}_terms_conditions" class="form-control" placeholder="Auto Focus Car Service">{{ old('terms_conditions.'.($key + 1)) }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="lang[]" value="{{ $lang }}">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="h-100 d-flex flex-column justify-content-between gap-20px __bg-FAFAFA p-4 radius-10">
                                <div>
                                    <label class="fs-16 text-title font-semibold  mb-0">{{ translate('messages.Discount_Image') }} <span class="text-danger">*</span></label>
                                    <p class="mb-0">{{ translate('JPG, JPEG, PNG Less Than 1MB') }} <span
                                            class="font-weight-bold">({{ translate('Ratio 3:1') }})</span>
                                    </p>
                                </div>

                                <div class="upload-file image-general flex-grow-1">
                                    <a href="javascript:void(0);" class="remove-btn opacity-0 z-index-99">
                                        <i class="tio-clear"></i>
                                    </a>
                                    <input type="file" name="image" class="upload-file__input single_file_input" accept=".webp, .jpg, .jpeg, .png"
                                           required>
                                    <label class="upload-file-wrapper fullwidth h-100 bg-white">
                                        <div class="upload-file-textbox text-center">
                                            <img width="40" height="40" src="{{ asset('public/assets/admin/img/document-upload.svg') }}" alt="">
                                            <h6 class="mt-2 font-semibold text-center d-flex d-sm-block flex-column gap-1">
                                                <span>{{ translate('Click_to_upload') }}</span>
                                                <span class="text--title text-lowercase"> {{ translate('or_drag_and_drop') }}</span>
                                            </h6>
                                        </div>
                                        <img class="upload-file-img d-none" loading="lazy" alt="">
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-0">
                                <label class="input-label" for="limit_per_user">
                                    {{ translate('messages.limit_for_same_user') }} <span class="text-danger">*</span>
                                </label>
                                <input type="number" id="limit_per_user" name="limit_per_user" class="form-control" placeholder="{{ translate('messages.Ex: 10') }}" value="{{old('limit_per_user')}}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-0">
                                <label class="input-label" for="dates">
                                    {{ translate('messages.Duration') }} <span class="text-danger">*</span>
                                </label>
                                <div class="position-relative">
                                    <i class="fi fi-sr-calendar fs-16 icon-absolute-on-right"></i>
                                    <input type="text"
                                           class="form-control h-45 position-relative bg-transparent" name="dates" min="{{date('Y-m-d',strtotime(now()))}}"
                                           value="{{ old('dates') }}" placeholder="{{ translate('messages.select_discount_active_duration') }}" required autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-0">
                                <label class="input-label" for="">
                                    {{ translate('messages.discount_amount') }} ($) <span class="text-danger">*</span>
                                </label>
                                <div class="custom-group-btn border">
                                    <div class="flex-sm-grow-1">
                                        <input id="discount_amount" type="number" name="discount_amount" class="form-control h--45px border-0 pl-unset"
                                               value="{{ old('discount_amount') }}" placeholder="{{ translate('messages.Ex: 5') }}" min="0"
                                               step="0.001" required>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <select name="discount_amount_type" id="discount_amount_type" class="custom-select ltr border-0" required>
                                            <option value="amount" {{ (old('discount_amount_type','amount') === 'amount') ? 'selected' : '' }}>{{session()->get('currency_symbol') ?? '$'}}</option>
                                            <option value="percentage" {{ (old('discount_amount_type') === 'percentage') ? 'selected' : '' }}>%</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6" id="max-discount-box">
                            <div class="form-group mb-0">
                                <label class="input-label" for="">
                                    {{ translate('messages.maximum_discount') }} ($) <span class="text-danger">*</span>
                                </label>
                                <input type="number" id="max_coupon" name="max_discount_amount" class="form-control" placeholder="{{ translate('messages.Ex: 5') }}" value="{{ old('max_discount_amount') }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-0">
                                <label class="input-label" for="minimum_trip_amount">
                                    {{ translate('messages.minimum_ride_amount') }} ($) <span class="text-danger">*</span>
                                </label>
                                <input type="number" id="minimum_trip_amount" name="min_trip_amount" class="form-control" placeholder="{{ translate('messages.Ex: 100') }}" value="{{ old('min_trip_amount') }}" required>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-0">
                                <label class="input-label" for="">
                                    {{ translate('messages.Customer') }} <span class="text-danger">*</span>
                                </label>
                                <select name="customer_discount_type[]" id="customer" class="form-control  multiple-select2" multiple="multiple" required
                                        data-placeholder="{{ translate('messages.Select_Customer') }}">
                                    <option value="all" {{ collect(old('customer_discount_type', []))->contains('all') ? 'selected' : '' }}>{{translate('ALL')}}</option>

                                    @foreach(\App\Models\User::get(['id','f_name','l_name']) as $user)
                                        <option class="" value="{{$user->id}}" {{ collect(old('customer_discount_type', []))->contains((string)$user->id) ? 'selected' : '' }}>{{$user->f_name.' '.$user->l_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-5 pickup-zone-tag">
                                <label class="input-label" for="">
                                    {{ translate('messages.vechicle_category') }} <span class="text-danger">*</span>
                                </label>
                                <select name="module_discount_type[]" id="vechicle_category" class="form-control  multiple-select2" multiple="multiple" data-placeholder="{{ translate('messages.select_vechicle_category') }}" required>
                                    <option value="all" {{ collect(old('module_discount_type', []))->contains('all') ? 'selected' : '' }}>{{translate('ALL')}}</option>
                                    @foreach($vehicleCategories as $vehicleCategory)
                                        <option
                                            value="{{$vehicleCategory->id}}" {{ collect(old('module_discount_type', []))->contains((string)$vehicleCategory->id) ? 'selected' : '' }}>{{ $vehicleCategory->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-5 pickup-zone-tag">
                                <label class="input-label" for="">
                                    {{ translate('messages.zones') }} <span class="text-danger">*</span>
                                </label>
                                <select name="zone_discount_type[]" id="zoneDiscountType" class="form-control  multiple-select2" multiple="multiple" data-placeholder="{{ translate('messages.select_zones') }}" required>
                                    <option value="all" {{ collect(old('zone_discount_type', []))->contains('all') ? 'selected' : '' }}>{{translate('ALL')}}</option>
                                    @foreach($zones as $zone)
                                        <option value="{{$zone->id}}" {{ collect(old('zone_discount_type', []))->contains((string)$zone->id) ? 'selected' : '' }}>{{$zone->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="btn--container justify-content-end">
                                <button type="reset" id="reset_btn"
                                        class="btn btn--reset">{{ translate('messages.reset') }}</button>
                                <button type="submit" class="btn btn--primary">{{ translate('messages.submit') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script_2')
    <script>
        $(function() {
            $('input[name="dates"]').daterangepicker({
                drops: 'down',
                opens: 'right',
                startDate: moment().startOf('day'),
                endDate: moment().endOf('day'),
                minDate: new Date(),
                autoUpdateInput: false,
                autoApply: false,
                alwaysShowCalendars: true,
                locale: {
                    format: 'YYYY-MM-DD',
                    cancelLabel: 'Clear'
                },
                ranges: {
                    'Today': [moment(), moment()],
                    'Tomorrow': [moment().add(1, 'days'), moment().add(1, 'days')],
                    'Next 7 Days': [moment(), moment().add(6, 'days')],
                    'Next 30 Days': [moment(), moment().add(29, 'days')],
                    'This Month': [moment(), moment().endOf('month')]
                }
            });

            // If there's an old value, set it on the picker input so the UI shows the selection
            var oldDates = '{{ old('dates') }}';
            if (oldDates) {
                $('input[name="dates"]').val(oldDates);
            }

            $('input[name="dates"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(
                    picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD')
                );
            });

            $('input[name="dates"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });

            $('input[name="dates"]').on('hide.daterangepicker', function(ev, picker) {
                if (!picker.autoApply) {
                    picker.show();
                }
            });

            $('#zoneDiscountType').on('change', function() {
                var selectedValues = $(this).val() || [];

                if (selectedValues.includes('all')) {
                    var allValues = [];
                    $(this).find('option').not('[value="all"]').each(function() {
                        allValues.push($(this).val());
                    });
                    $(this).val(allValues).trigger('change');
                }
            });

            $('#vechicle_category').on('change', function() {
                var selectedValues = $(this).val() || [];

                if (selectedValues.includes('all')) {
                    var allValues = [];
                    $(this).find('option').not('[value="all"]').each(function() {
                        allValues.push($(this).val());
                    });
                    $(this).val(allValues).trigger('change');
                }
            });

            $('#customer').on('change', function() {
                var selectedValues = $(this).val() || [];
                var previousValue = $(this).data('previous') || [];

                if(selectedValues.includes('all') && !previousValue?.includes('all') && selectedValues.length > 1){
                    var allValues = ['all'];
                    $(this).val(allValues).trigger('change');
                } else if(selectedValues.includes('all') && previousValue?.includes('all') && selectedValues.length > 1){
                    selectedValues = selectedValues.filter(function(value) {
                        return value !== 'all';
                    });
                    $(this).val(selectedValues).trigger('change');
                }
                $(this).data('previous', $(this).val());
            });

            $(document).ready(function () {
                const $couponInput = $('#discount_amount');
                const $couponType  = $('#discount_amount_type');
                const $maxDiscountBox = $('#max-discount-box');
                const $maxCoupon = $('#max_coupon');

                function checkCouponLimit() {
                    if ($couponType.val() === 'percentage') {
                        $couponInput.attr('max', 100);
                        if (parseFloat($couponInput.val()) > 100) {
                            $couponInput.val(100);
                        }
                    } else {
                        $couponInput.removeAttr('max');
                    }
                }

                function toggleMaxDiscount() {
                    if ($couponType.val() === 'amount') {
                        $maxDiscountBox.hide();
                        $maxCoupon.prop('required', false);
                    } else {
                        $maxDiscountBox.show();
                        $maxCoupon.prop('required', true);
                    }
                }

                $couponType.on('change', function () {
                    checkCouponLimit();
                    toggleMaxDiscount();
                });

                $couponInput.on('input', checkCouponLimit);

                checkCouponLimit();
                toggleMaxDiscount();
            });
        });
    </script>
@endpush
