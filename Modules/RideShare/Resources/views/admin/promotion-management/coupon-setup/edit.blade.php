@extends('layouts.admin.app')

@section('title', translate('messages.edit_coupon'))

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
                        {{ translate('messages.Edit_Coupon') }}
                    </h5>
                    {{-- <p class="mb-0 fs-12">Vendor Logo & Covers</p> --}}
                </div>
            </div>
            <div class="card-body">

            <form action="{{ route('admin.ride-share.promotion.coupon-setup.update', ['id'=>$coupon->id]) }}" method="POST"
                  id="coupon_form">
                @csrf
                @method('PUT')
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
                                                <input type="text" name="coupon_title[]" id="default_title" class="form-control" value="{{  $coupon?->getRawOriginal('name') }}"
                                                    placeholder="Auto Focus Car Service" required="">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mb-0">
                                                <label class="input-label font-semibold" for="default_des">{{ translate('description') }} ({{ translate('Default') }}) <span class="text-danger">*</span></label>
                                                <input type="text" name="short_desc[]" id="default_des" class="form-control" value="{{  $coupon?->getRawOriginal('description') }}"
                                                    placeholder="Auto Focus Car Service" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="lang[]" value="default">
                                </div>
                                @foreach ($language as $lang)
                                    <?php
                                        if(count($coupon['translations'])){
                                            $translate = [];
                                            foreach($coupon['translations'] as $t)
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
                                        <div class="row g-4">
                                            <div class="col-lg-6">
                                                <div class="form-group mb-0">
                                                    <label class="input-label font-semibold">{{ translate('title') }}   ({{ strtoupper($lang) }})</label>
                                                    <input type="text" name="coupon_title[]" id="{{ $lang }}_title" class="form-control" value="{{$translate[$lang]['name']??''}}"
                                                        placeholder="Auto Focus Car Service">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-0">
                                                    <label class="input-label font-semibold" for="{{ $lang }}_des">{{ translate('description') }}
                                                        ({{ strtoupper($lang) }})
                                                    </label>
                                                    <input type="text" name="short_desc[]" id="{{ $lang }}_des" class="form-control" value="{{$translate[$lang]['description']??''}}"
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
                                    <option value="default" {{ $coupon->coupon_type == 'default'?'selected':'' }}>{{ translate('default') }}</option>
                                </select>
                            </div>
                        </div>--}}
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="input-label" for="coupon_code">
                                    {{ translate('messages.Coupon_Code') }} <span class="text-danger">*</span>
                                </label>
                                <input type="text" id="coupon_code" name="coupon_code" class="form-control" placeholder="Ex: New Year 23" value="{{ $coupon->coupon_code }}" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="input-label" for="limit_same_user">
                                    {{ translate('messages.limit_for_same_user') }} <span class="text-danger">*</span>
                                </label>
                                <input type="number" id="limit_same_user" name="limit_same_user" class="form-control" placeholder="{{ translate('messages.Ex: 10') }}" value="{{ $coupon->limit }}" required min="1" step="1">
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
                                        value="{{ $coupon->start_date }} - {{ $coupon->end_date }}" placeholder="{{ translate('messages.select_coupon_active_duration') }}" required autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="input-label" for="minimum_trip_amount">
                                    {{ translate('messages.minimum_ride_amount') }} ($) <span class="text-danger">*</span>
                                </label>
                                <input type="number" id="minimum_trip_amount" name="minimum_trip_amount" class="form-control" placeholder="{{ translate('messages.Ex: 100') }}" value="{{ $coupon->min_trip_amount }}" required min="0" step="0.001">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="input-label" for="">
                                    {{ translate('messages.coupon_amount') }} ($) <span class="text-danger">*</span>
                                </label>
                                <div class="custom-group-btn border">
                                    <div class="flex-sm-grow-1">
                                        <input id="coupon_amount" type="number" name="coupon_amount" class="form-control h--45px border-0 pl-unset"
                                            value="{{$coupon->coupon}}" placeholder="{{ translate('messages.Ex: 5') }}" min="0" required
                                            step="0.001">
                                    </div>
                                    <div class="flex-shrink-0">
                                         <select class="custom-select ltr border-0" id="coupon_amount_type"
                                                name="coupon_amount_type" required>
                                            <option
                                                value="amount" {{ $coupon->amount_type == AMOUNT?'selected':'' }}>{{session()->get('currency_symbol') ?? '$'}}</option>
                                            <option
                                                value="percentage" {{ $coupon->amount_type == PERCENTAGE?'selected':'' }}>
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
                                <input type="number" id="max_coupon" name="max_coupon_amount" class="form-control" placeholder="{{ translate('messages.Ex: 5') }}" value="{{ $coupon->max_coupon_amount }}" required min="0" step="0.001">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="input-label" for="">
                                    {{ translate('messages.Customer') }} <span class="text-danger">*</span>
                                </label>
                                <select name="customer_coupon_type[]" id="customer" class="form-control  js-select2-custom" multiple="multiple" required
                                    data-placeholder="{{ translate('messages.Select_Customer') }}" data-previous="{{ $coupon->customer_coupon_type == 'all' ? '[\'all\']' : '[]' }}">
                                    <option value="all" {{ $coupon->customer_coupon_type == 'all' ? 'selected' : '' }}>
                                        All
                                    </option>
                                    @foreach(\App\Models\User::get(['id','f_name','l_name']) as $user)
                                    <option
                                                value="{{$user->id}}" {{ in_array($user->id,$coupon->customers->pluck('id')->toArray()) ? 'selected' : '' }}>{{$user->f_name}} {{$user->l_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-5 pickup-zone-tag">
                                <label class="input-label" for="">
                                    {{ translate('messages.vechicle_category') }} <span class="text-danger">*</span>
                                </label>
                                <select name="category_coupon_type[]" id="vechicle_category" class="form-control  js-select2-custom" multiple="multiple" data-placeholder="{{ translate('messages.select_vechicle_category') }}" required>
                                        <option
                                            value="{{ALL}}" {{ in_array(ALL,$coupon->category_coupon_type) ? 'selected' : '' }}>
                                            All
                                        </option>
                                        @foreach($vehicleCategories as $vehicleCategory)
                                            <option
                                                value="{{$vehicleCategory->id}}" {{ in_array($vehicleCategory->id,$coupon->vehicleCategories->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $vehicleCategory->name }}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-5 pickup-zone-tag">
                                <label class="input-label" for="">
                                    {{ translate('messages.zones') }} <span class="text-danger">*</span>
                                </label>
                                <select name="zone_coupon_type[]" id="zoneDiscountType" class="form-control  js-select2-custom" multiple="multiple" data-placeholder="{{ translate('messages.select_zones') }}" required>
                                    <option
                                        value="{{ALL}}" {{ $coupon->zone_coupon_type == ALL ? 'selected' : '' }}>
                                        All
                                    </option>
                                    @foreach($zones as $zone)
                                        <option
                                            value="{{$zone->id}}" {{ in_array($zone->id,$coupon->zones->pluck('id')->toArray()) ? 'selected' : '' }}>{{$zone->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="btn--container justify-content-end">
                                <button type="reset" id="reset_btn"
                                    class="btn btn--reset">{{ translate('messages.reset') }}</button>
                                <button type="submit" class="btn btn--primary">{{ translate('messages.update') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')

    <script>
        "use strict";

        $(document).ready(function () {

            const amountType = $('#amount_type');
            const maxCoupon = $('#max_coupon');
            if (amountType.val() == 'amount') {

                maxCoupon.attr("readonly", "true");
                maxCoupon.attr("title", "not editable");
                maxCoupon.val(0);

                $("#coupon_amount_label").text("{{translate('Coupon Amount')}} ({{session()->get('currency_symbol') ?? '$'}})");
                $("#coupon").attr("placeholder", "Ex: 500")
            } else {
                maxCoupon.removeAttr("readonly");
                maxCoupon.removeAttr("title");
                $("#coupon_amount_label").text("{{translate('Coupon Percent ')}}(%)")
                $("#coupon").attr("placeholder", "Ex: 50%")
            }
            amountType.on('change', function () {
                if (amountType.val() == 'amount') {

                    maxCoupon.attr("readonly", "true");
                    maxCoupon.attr("title", "not editable");
                    maxCoupon.val(0);

                    $("#coupon_amount_label").text("{{translate('Coupon Amount')}} ({{session()->get('currency_symbol') ?? '$'}})");
                    $("#coupon").attr("placeholder", "Ex: 500")
                } else {
                    maxCoupon.removeAttr("readonly");
                    maxCoupon.removeAttr("title");
                    $("#coupon_amount_label").text("{{translate('Coupon Percent ')}}(%)")
                    $("#coupon").attr("placeholder", "Ex: 50%")
                }
            });
        });

    </script>
@endpush

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

                $couponType.on('change', checkCouponLimit);
                $couponInput.on('input', checkCouponLimit);

                checkCouponLimit();
            });

            $(document).ready(function () {
                function toggleMaxDiscount() {
                    if ($('#coupon_amount_type').val() === 'amount') {
                        $('#max-discount-box').hide();
                        $('#max_coupon').prop('required', false);
                    } else {
                        $('#max-discount-box').show();
                        $('#max_coupon').prop('required', true);
                    }
                }

                toggleMaxDiscount();

                $('#coupon_amount_type').on('change', function () {
                    toggleMaxDiscount();
                });
            });
        });
    </script>
@endpush
