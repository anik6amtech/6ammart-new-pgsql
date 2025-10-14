@extends('layouts.admin.app')

@section('title', translate('edit_coupon'))

@push('css_or_js')
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/admin/vendor/daterangepicker/daterangepicker.css')}}"/>
@endpush

@section('content')

    <div class="content container-fluid">
        <!-- Page Title -->
        <h2 class="h1 mb-sm-3 mb-2 text-capitalize d-flex align-items-center gap-2">
            {{ translate('update_coupon') }}
        </h2>
        <div class="card">
            <div class="card-body p-20">
                <form action="{{ route('admin.service.coupon.update', $coupon->id) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="row g-4">
                        <div class="col-lg-12">
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
                                        <label class="form-label">{{ translate('title') }}   ({{ translate('Default') }}) <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="discount_title[]" required
                                               value="{{  $discount?->getRawOriginal('discount_title') }}" placeholder="{{ translate('title') }}" maxlength="255"
                                               data-preview-text="preview-title">
                                    </div>
                                    <input type="hidden" name="lang[]" value="default">
                                </div>
                                @foreach ($language as $lang)
                                        <?php
                                        if(count($discount['translations'])){
                                            $translate = [];
                                            foreach($discount['translations'] as $t)
                                            {
                                                if($t->locale == $lang && $t->key=="discount_title"){
                                                    $translate[$lang]['discount_title'] = $t->value;
                                                }
                                            }
                                        }
                                        ?>
                                    <div class="d-none lang_form" id="{{ $lang }}-form">
                                        <div class="mb-20">
                                            <label class="form-label">{{ translate('title') }}    ({{ strtoupper($lang) }})</label>
                                            <input type="text" class="form-control" name="discount_title[]"
                                                   value="{{$translate[$lang]['discount_title']??''}}"  placeholder="{{ translate('discount_title') }}" maxlength="255"
                                                   data-preview-text="preview-title">
                                        </div>
                                        <input type="hidden" name="lang[]" value="{{ $lang }}">
                                    </div>

                                @endforeach
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-0">
                                <label for="couponCode" class="form-label font-normal fz--14px">
                                    {{ translate('coupon_type') }} <span class="text-danger">*</span>
                                </label>
                                <select class="form-control w-100" name="coupon_type"
                                        id="coupon-type">
                                    <option>{{translate('select_coupon_type')}}</option>
                                    @foreach(COUPON_TYPES as $index=>$coupon_type)
                                        <option
                                            value="{{$index}}" {{$coupon->coupon_type==$index?'selected':''}}>
                                            {{$coupon_type}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 d-none" id="customer-select__div">
                            <div class="mb-30">
                                <select class="form-control w-100" id="customer-select"
                                        name="customer_user_ids[]" multiple>
                                    @foreach($customers as $key=>$customer)
                                        <option
                                            value="{{$customer->id}}">{{$customer->f_name .' '. $customer->l_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-0">
                                <label for="couponCode" class="form-label font-normal fz--14px">
                                    {{ translate('coupon_code') }} <span class="text-danger">*</span>
                                </label>
                                <input type="string" class="form-control h--45px" name="coupon_code" value="{{ $coupon->coupon_code }}" id="couponCode" placeholder="NEW2025" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                            <span class="fz--14px d-block text-title mb-2 d-flex align-items-center gap-1">
                                {{ translate('coupon_discount_type') }}<span class="text-danger">*</span>
                            </span>
                                <div class="form-group mb-0 d-flex flex-wrap px-2 custom-select-wrap border rounded align-items-center gap-4">
                                    <label class="form-check form--check">
                                        <input class="form-check-input" type="radio" value="category" name="discount_type" id="discount_type_category"  {{$coupon->discount->discount_type=='category'?'checked':''}}>
                                        <span class="form-check-label">
                                        {{ translate('category_wise') }}
                                    </span>
                                    </label>
                                    <label class="form-check form--check">
                                        <input class="form-check-input" type="radio" value="service" name="discount_type" id="discount_type_service" {{$coupon->discount->discount_type=='service'?'checked':''}}>
                                        <span class="form-check-label">
                                        {{ translate('service_wise') }}
                                    </span>
                                    </label>
                                    <label class="form-check form--check">
                                        <input class="form-check-input" type="radio" value="mixed" name="discount_type" id="discount_type_mixed" {{$coupon->discount->discount_type=='mixed'?'checked':''}}>
                                        <span class="form-check-label">
                                        {{ translate('mixed') }}
                                    </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6" id="select_category_wrapper" style="display: {{($coupon->discount->discount_type=='category' || $coupon->discount->discount_type=='mixed')?'block':'none'}}">
                            <div class="form-group mb-0">
                                <label class="form-label text-capitalize" for="category_ids">
                                    {{ translate('messages.Service Category') }} <span class="text-danger">*</span>
                                </label>
                                <select id="select_category" name="category_ids[]" class="form-control  js-select2-custom" data-placeholder="{{translate('messages.select_category')}}" multiple>
                                    <option value="all">{{translate('All')}}</option>
                                    @foreach($categories as $category)
                                        <option
                                            value="{{$category->id}}" {{in_array($category->id,$coupon->discount->category_types->pluck('type_wise_id')->toArray())?'selected':''}}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-3 " style="display: {{($coupon->discount->discount_type=='service' || $coupon->discount->discount_type=='mixed')?'block':'none'}}" id="select_service_wrapper">
                            <div class="form-group mb-0">
                                <label class="form-label text-capitalize" for="multiCagory">
                                    {{ translate('messages.Services') }} <span class="text-danger">*</span>
                                </label>
                                <select name="service_ids[]" id="select_service"
                                    class="form-control js-select2-custom"
                                    multiple="multiple" data-placeholder="{{translate('messages.select_service')}}">
                                    <option value="all">{{translate('messages.all')}} </option>
                                    @foreach($services as $service)
                                        <option value="{{$service->id}}" {{in_array($service->id,$coupon->discount->service_types->pluck('type_wise_id')->toArray())?'selected':''}}>{{$service->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-0 select-couting position-relative">
                                <label class="input-label" for="zone_ids">{{translate('messages.Zones')}} <span class="text-danger">*</span></label>
                                <select required name="zone_ids[]" id="select_zone"
                                        class="form-control js-select2-custom"
                                        multiple="multiple" data-placeholder="{{translate('messages.select_zone')}}" multiple>
                                    <option value="all">{{translate('All')}}</option>
                                    @foreach($zones as $zone)
                                        <option
                                            value="{{$zone->id}}" {{in_array($zone->id,$coupon->discount->zone_types->pluck('type_wise_id')->toArray())?'selected':''}}>
                                            {{$zone->name}}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="countBox w-30px h-25px bg-primary rounded p-1 text-white fz-12px">+0</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label class="form-label" for="">{{ translate('messages.Discount Amount') }} <span class="text-danger">*</span></label>
                                <div class="d-flex align-items-center restriction-time rounded border">
                                    <div class="flex-grow-1">
                                        <input class="form-control border-0" placeholder="Ex: 5" min="1" type="number" value="{{$coupon->discount->discount_amount}}" name="discount_amount"
                                               id="discount_amount">
                                    </div>
                                    <select class="form-select w-auto bg-light border-0 h--45px px-2" name="discount_amount_type"
                                            id="discount_amount_type">
                                        <option value="0" disabled="">calc</option>
                                        <option value="percent" {{$coupon->discount->discount_amount_type=='percent'?'selected':''}}>%</option>
                                        <option value="amount" {{$coupon->discount->discount_amount_type=='amount'?'selected':''}}>$</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-0">
                                <label for="discount_max" class="form-label font-normal fz--14px">
                                    {{ translate('Maximum Discount') }} ($) <span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control h--45px" name="max_discount_amount" id="discount_max" placeholder="100" value="{{$coupon->discount->max_discount_amount}}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-0">
                                <label class="form-label" for="">{{ translate('messages.Coupon Duration') }}</label>
                                <div class="position-relative date-picker__custom">
                                    <input type="text" class="form-control date-range-picker2" name="coupon_duration" value="{{$coupon->discount->start_date->format('m/d/Y')}} - {{$coupon->discount->end_date->format('m/d/Y')}}" data-placeholder="{{ translate('messages.03/05/2025 - 03/08/2025') }}" autocomplete="off">
                                    <span class="calender-icon">
                                    <i class="tio-calendar-month"></i>
                                </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-0">
                                <label for="discount_min" class="form-label font-normal fz--14px">
                                    {{ translate('Minimum Booking amount') }} ($) <span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control h--45px" name="min_purchase" id="discount_min" placeholder="Ex: 5" value="{{$coupon->discount->min_purchase}}" step="0.01" min="0">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-0">
                                <label for="userLimit" class="form-label font-normal fz--14px">
                                    {{ translate('Limit for same user') }} <span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control h--45px" name="limit_per_user" id="userLimit" placeholder="10" value="{{$coupon->discount->limit_per_user}}" min="1">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="btn--container justify-content-end mt-3">
                                <button type="reset" class="btn btn--reset">{{ translate('messages.reset') }}</button>
                                <button type="submit" class="btn btn--primary call-demo">{{ translate('messages.submit') }}</button>
                            </div>
                        </div>

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

        $('#customer-select').on('change', function() {
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

        $('#percentage').on('click', function () {
            $('#max_discount_amount').show();

            //Attribute Update
            $('#discount_amount').attr({"max": 100});
            $('#discount_amount__label').html('{{translate('amount')}} (%)');
        });

        $('#fixed_amount').on('click', function () {
            $('#max_discount_amount').hide();

            //Attribute Update
            $('#discount_amount').removeAttr('max');
            $('#discount_amount__label').html('{{translate('amount')}} ({{currency_symbol()}})');
        });

        $('#coupon-type').change(function () {
            if ($(this).val() === 'customer_wise') {
                $("#customer-select__div").removeClass('d-none');
                $("#customer-select").prop('required', true);

            } else {
                $("#customer-select__div").addClass('d-none');
                $("#customer-select").prop('required', false);
            }

            if ($(this).val() === 'first_booking') {
                $("#limit_per_user__div").addClass('d-none');
                $("#limit_per_user").prop('required', false);
            } else {
                $("#limit_per_user__div").removeClass('d-none');
                $("#limit_per_user").prop('required', true);
            }
        });

        //Select 2
        $(".category-select").select2({
            placeholder: "{{translate('Select Category')}}",
        });
        $(".service-select").select2({
            placeholder: "{{translate('Select Service')}}",
        });
        $(".zone-select").select2({
            placeholder: "{{translate('Select Zone')}}",
        });
        $(document).ready(function () {
            const $discountInput = $('#discount_amount');
            const $discountType  = $('#discount_amount_type');

            function checkDiscountLimit() {
                if ($discountType.val() === 'percent') {
                    $discountInput.attr('max', 100);
                    if (parseFloat($discountInput.val()) > 100) {
                        $discountInput.val(100);
                    }
                } else {
                    $discountInput.removeAttr('max');
                }
            }

            $discountType.on('change', checkDiscountLimit);
            $discountInput.on('input', checkDiscountLimit);

            checkDiscountLimit();
        });
    </script>
@endpush
