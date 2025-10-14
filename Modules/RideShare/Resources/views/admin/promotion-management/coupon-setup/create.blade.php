@extends('layouts.admin.app')

@section('title', translate('messages.add_new_coupon'))

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
                    {{ translate('messages.Coupons') }}
                </span>
            </h1>
        </div>
        <div class="card">
            <div class="card-header">
                <div>
                    <h5 class="text-title mb-1">
                        {{ translate('messages.Add_Coupon') }}
                    </h5>
                    {{-- <p class="mb-0 fs-12">Vendor Logo & Covers</p> --}}
                </div>
            </div>
            <div class="card-body">

            <form action="{{ route('admin.ride-share.promotion.coupon-setup.store') }}" method="POST" id="coupon_form">
                @csrf
                    <div class="row g-4">
                        <div class="col-12">
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
                                        <div class="col-lg-6">
                                            <div class="form-group mb-0">
                                                <label class="input-label font-semibold" for="default_title">{{ translate('title') }} ({{ translate('Default') }}) <span class="text-danger">*</span></label>
                                                <input type="text" name="coupon_title[]" id="default_title" class="form-control" value="{{ old('coupon_title.0') }}"
                                                    placeholder="{{translate('coupon_title')}}" required="">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mb-0">
                                                <label class="input-label font-semibold" for="default_des">{{ translate('description') }} ({{ translate('Default') }}) <span class="text-danger">*</span></label>
                                                <input type="text" name="short_desc[]" id="default_des" class="form-control" value="{{ old('short_desc.0') }}"
                                                    placeholder="{{translate('coupon_description')}}" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="lang[]" value="default">
                                </div>

                                @foreach ($language as $key => $lang)
                                    <div class="d-none lang_form" id="{{ $lang }}-form">
                                        <div class="row g-4">
                                            <div class="col-lg-6">
                                                <div class="form-group mb-0">
                                                    <label class="input-label font-semibold">{{ translate('title') }}   ({{ strtoupper($lang) }})</label>
                                                    <input type="text" name="coupon_title[]" id="{{ $lang }}_title" class="form-control" value="{{ old('coupon_title.'.($key + 1)) }}"
                                                        placeholder="Auto Focus Car Service">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-0">
                                                    <label class="input-label font-semibold" for="{{ $lang }}_des">{{ translate('description') }}
                                                        ({{ strtoupper($lang) }})
                                                    </label>
                                                    <input type="text" name="short_desc[]" id="{{ $lang }}_des" class="form-control" value="{{ old('short_desc.'.($key + 1)) }}"
                                                        placeholder="Auto Focus Car Service">
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="lang[]" value="{{ $lang }}">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <input type="hidden" name="coupon_type" value="default">
                        {{--<div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="input-label" for="coupon_type">
                                    {{ translate('messages.Coupon_Type') }} <span class="text-danger">*</span>
                                </label>
                                <select name="coupon_type" id="coupon_type" class="form-control js-select2-custom" required
                                    data-placeholder="{{ translate('messages.Select_Coupon_Type') }}">
                                    <option value="" selected disabled>{{ translate('messages.Select_Coupon_Type') }}</option>
                                    <option value="default">{{ translate('messages.default') }}</option>
                                </select>
                            </div>
                        </div>--}}
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="input-label" for="coupon_code">
                                    {{ translate('messages.Coupon_Code') }} <span class="text-danger">*</span>
                                </label>
                                <input type="text" id="coupon_code" name="coupon_code" class="form-control" placeholder="Ex: New Year 23" value="{{ old('coupon_code') }}" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="input-label" for="limit_same_user">
                                    {{ translate('messages.limit_for_same_user') }} <span class="text-danger">*</span>
                                </label>
                                <input type="number" id="limit_same_user" name="limit_same_user" class="form-control" placeholder="{{ translate('messages.Ex: 10') }}" value="{{ old('limit_same_user') }}" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="input-label" for="dates">
                                    {{ translate('messages.Duration') }} <span class="text-danger">*</span>
                                </label>
                                <div class="position-relative">
                                    <i class="fi fi-sr-calendar fs-16 icon-absolute-on-right"></i>
                                    <input type="text"
                                        class="form-control h-45 position-relative bg-transparent" name="dates" min="{{date('Y-m-d',strtotime(now()))}}"
                                        value="{{ old('dates') }}" placeholder="{{ translate('messages.select_coupon_active_duration') }}" required autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="input-label" for="minimum_trip_amount">
                                    {{ translate('messages.minimum_ride_amount') }} ($) <span class="text-danger">*</span>
                                </label>
                                <input type="number" id="minimum_trip_amount" name="minimum_trip_amount" class="form-control" placeholder="{{ translate('messages.Ex: 100') }}" value="{{ old('minimum_trip_amount') }}" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="input-label" for="">
                                    {{ translate('messages.coupon_amount') }} ($) <span class="text-danger">*</span>
                                </label>
                                <div class="custom-group-btn border">
                                    <div class="flex-sm-grow-1">
                                        <input id="coupon_amount" type="number" name="coupon_amount"
                                               class="form-control h--45px border-0 pl-unset"
                                               value="{{ old('coupon_amount') }}" placeholder="{{ translate('messages.Ex: 5') }}" required
                                               min="0" step="0.001">
                                    </div>
                                    <div class="flex-shrink-0">
                                        <select name="coupon_amount_type" id="coupon_amount_type" class="custom-select ltr border-0">
                                            <option value="amount" {{ old('coupon_amount_type', $coupon->coupon_amount_type ?? '') == 'amount' ? 'selected' : '' }}>
                                                {{ session()->get('currency_symbol') ?? '$' }}
                                            </option>
                                            <option value="percentage" {{ old('coupon_amount_type', $coupon->coupon_amount_type ?? '') == 'percentage' ? 'selected' : '' }}>
                                                %
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4" id="max-discount-box">
                            <div class="form-group mb-0">
                                <label class="input-label" for="">
                                    {{ translate('messages.maximum_discount') }} ($) <span class="text-danger">*</span>
                                </label>
                                <input type="number" id="max_coupon" name="max_coupon_amount"
                                       class="form-control"
                                       placeholder="{{ translate('messages.Ex: 5') }}"
                                       value="{{ old('max_coupon_amount') }}" required>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="input-label" for="">
                                    {{ translate('messages.Customer') }} <span class="text-danger">*</span>
                                </label>
                                <select name="customer_coupon_type[]" id="customer" class="form-control  js-select2-custom" multiple="multiple" required
                                        data-placeholder="{{ translate('messages.Select_Customer') }}">
                                    <option value="all"
                                        {{ collect(old('customer_coupon_type', $selectedCustomers ?? []))->contains('all') ? 'selected' : '' }}>
                                        {{ translate('ALL') }}
                                    </option>

                                    @foreach(\App\Models\User::get(['id','f_name','l_name']) as $user)
                                        <option value="{{ $user->id }}"
                                            {{ collect(old('customer_coupon_type', $selectedCustomers ?? []))->contains($user->id) ? 'selected' : '' }}>
                                            {{ $user->f_name.' '.$user->l_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-5 pickup-zone-tag">
                                <label class="input-label" for="">
                                    {{ translate('messages.vechicle_category') }} <span class="text-danger">*</span>
                                </label>
                                <select name="category_coupon_type[]" id="vechicle_category" required
                                        class="form-control js-select2-custom" multiple="multiple"
                                        data-placeholder="{{ translate('messages.select_vechicle_category') }}">

                                    <option value="all"
                                        {{ collect(old('category_coupon_type', $selectedCategories ?? []))->contains('all') ? 'selected' : '' }}>
                                        {{ translate('ALL') }}
                                    </option>

                                    @foreach($vehicleCategories as $vehicleCategory)
                                        <option value="{{ $vehicleCategory->id }}"
                                            {{ collect(old('category_coupon_type', $selectedCategories ?? []))->contains($vehicleCategory->id) ? 'selected' : '' }}>
                                            {{ $vehicleCategory->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-5 pickup-zone-tag">
                                <label class="input-label" for="">
                                    {{ translate('messages.zones') }} <span class="text-danger">*</span>
                                </label>
                                <select name="zone_coupon_type[]" id="zoneDiscountType"
                                        class="form-control js-select2-custom" multiple required
                                        data-placeholder="{{ translate('messages.select_zones') }}">

                                    <option value="all"
                                        {{ collect(old('zone_coupon_type', $selectedZones ?? []))->contains('all') ? 'selected' : '' }}>
                                        {{ translate('ALL') }}
                                    </option>

                                    @foreach($zones as $zone)
                                        <option value="{{ $zone->id }}"
                                            {{ collect(old('zone_coupon_type', $selectedZones ?? []))->contains($zone->id) ? 'selected' : '' }}>
                                            {{ $zone->name }}
                                        </option>
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
                const $couponInput = $('#coupon_amount');
                const $couponType  = $('#coupon_amount_type');

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
                        $('#max-discount-box').hide();
                        $('#max_coupon').prop('required', false);
                    } else {
                        $('#max-discount-box').show();
                        $('#max_coupon').prop('required', true);
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
