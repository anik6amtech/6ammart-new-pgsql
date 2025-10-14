@extends('layouts.admin.app')

@section('title', translate('Create Discount'))

@push('css_or_js')
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/admin/vendor/daterangepicker/daterangepicker.css')}}"/>
@endpush

@section('content')

    <div class="content container-fluid">
        <!-- Page Title -->
        <h2 class="h1 mb-sm-3 mb-2 text-capitalize d-flex align-items-center gap-2">
            {{ translate('messages.Create Discount') }}
        </h2>
        <div class="card">
            <div class="card-body p-20">
                <form action="{{ route('admin.service.discount.store') }}" method="post">
                    @csrf
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="bg-light rounded p-3">
                                <ul class="nav nav-tabs nav--tabs mb-20 border-0">
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
                                        <label class="form-label">{{ translate('title') }} ({{ translate('Default') }}) <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="discount_title[]" required
                                               value="{{ old('discount_title.0') }}" placeholder="{{ translate('title') }}" maxlength="255"
                                               data-preview-text="preview-title">
                                    </div>
                                    <input type="hidden" name="lang[]" value="default">
                                </div>
                                @foreach ($language as $key => $lang)
                                    <div class="d-none lang_form" id="{{ $lang }}-form">
                                        <div class="mb-20">
                                            <label class="form-label">{{ translate('title') }}   ({{ strtoupper($lang) }})</label>
                                            <input type="text" class="form-control" name="discount_title[]"
                                                   value="{{ old('discount_title.'.($key+1)) }}" placeholder="{{ translate('title') }}" maxlength="255"
                                                   data-preview-text="preview-title">
                                        </div>
                                        <input type="hidden" name="lang[]" value="{{ $lang }}">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <div>
                                    <span class="fz--14px d-block text-title mb-2 d-flex align-items-center gap-1">
                                        {{translate('discount_type')}} <span class="text-danger">*</span>
                                    </span>
                                        <div class="form-group mb-0 d-flex flex-wrap px-2 custom-select-wrap border rounded align-items-center gap-4">
                                            <label class="form-check form--check">
                                                <input class="form-check-input" type="radio" value="category" name="discount_type" id="discount_type_category" {{ (old('discount_type', 'category') == 'category') ? 'checked' : '' }}>
                                                <span class="form-check-label">
                                                {{ translate('category_wise') }}
                                            </span>
                                            </label>
                                            <label class="form-check form--check">
                                                <input class="form-check-input" type="radio" value="service" name="discount_type" id="discount_type_service" {{ (old('discount_type') == 'service') ? 'checked' : '' }}>
                                                <span class="form-check-label">
                                                {{ translate('service_wise') }}
                                            </span>
                                            </label>
                                            <label class="form-check form--check">
                                                <input class="form-check-input" type="radio" value="mixed" name="discount_type" id="discount_type_mixed" {{ (old('discount_type') == 'mixed') ? 'checked' : '' }}>
                                                <span class="form-check-label">
                                                {{ translate('mixed') }}
                                            </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3" id="select_category_wrapper">
                                    <div class="form-group mb-0">
                                        <label class="form-label text-capitalize" for="multiCagory">
                                            {{ translate('messages.Service Category') }} <span class="text-danger">*</span>
                                        </label>
                                        <select required name="category_ids[]" id="select_category"
                                                class="form-control js-select2-custom"
                                                multiple="multiple" data-placeholder="{{translate('messages.select_category')}}">
                                            <option value="all" {{ old('category_ids') && in_array('all', old('category_ids')) ? 'selected' : '' }}>{{translate('messages.all')}} </option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}" {{ old('category_ids') && in_array($category->id, old('category_ids')) ? 'selected' : '' }}>{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3 " style="display: none;" id="select_service_wrapper">
                                    <div class="form-group mb-0">
                                        <label class="form-label text-capitalize" for="multiCagory">
                                            {{ translate('messages.Services') }} <span class="text-danger">*</span>
                                        </label>
                                        <select name="service_ids[]" id="select_service"
                                                class="form-control js-select2-custom"
                                                multiple="multiple" data-placeholder="{{translate('messages.select_service')}}">
                                            <option value="all" {{ old('service_ids') && in_array('all', old('service_ids')) ? 'selected' : '' }}>{{translate('messages.all')}} </option>
                                            @foreach($services as $service)
                                                <option value="{{$service->id}}" {{ old('service_ids') && in_array($service->id, old('service_ids')) ? 'selected' : '' }}>{{$service->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3" id="select_zone_wrapper">
                                    <div class="form-group mb-0 select-couting position-relative">
                                        <label class="input-label" for="select_customer">{{translate('messages.Zones')}} <span class="text-danger">*</span></label>
                                        <select required name="zone_ids[]" id="select_zone"
                                                class="form-control js-select2-custom"
                                                multiple="multiple" data-placeholder="{{translate('messages.select_zone')}}">
                                            <option value="all" {{ old('zone_ids') && in_array('all', old('zone_ids')) ? 'selected' : '' }}>{{translate('messages.all')}} </option>
                                            @foreach($zones as $zone)
                                                <option value="{{$zone->id}}" {{ old('zone_ids') && in_array($zone->id, old('zone_ids')) ? 'selected' : '' }}>{{$zone->name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="countBox w-30px h-25px bg-primary rounded p-1 text-white fz-12px">+0</span>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div>
                                        <label class="form-label">{{ translate('messages.Discount Amount') }} <span class="text-danger">*</span></label>
                                        <div class="d-flex align-items-center restriction-time rounded border">
                                            <div class="flex-grow-1">
                                                <input class="form-control border-0"
                                                       placeholder="Ex: 5"
                                                       min="1"
                                                       type="number"
                                                       value="{{ old('discount_amount') }}"
                                                       name="discount_amount"
                                                       id="discount_amount" required>
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
                                        <label class="form-label" for="">{{ translate('messages.Discount Duration') }} <span class="text-danger">*</span></label>
                                        <div class="position-relative date-picker__custom">
                                            <input type="text" class="form-control date-range-picker2" name="discount_duration" value="{{ old('discount_duration') }}" data-placeholder="{{ translate('messages.03/05/2025 - 03/08/2025') }}" autocomplete="off" required>
                                            <span class="calender-icon">
                                            <i class="tio-calendar-month"></i>
                                        </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3" id="max-discount-box">
                                    <div class="form-group mb-0">
                                        <label for="discount_max" class="form-label font-normal fz--14px">
                                            {{ translate('messages.Maximum Discount') }} ($) <span class="text-danger">*</span>
                                        </label>
                                        <input type="number" class="form-control h--45px" name="max_discount_amount" id="discount_max" value="{{ old('max_discount_amount') }}" placeholder="Ex: 5" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div class="form-group mb-0">
                                        <label for="discount_min" class="form-label font-normal fz--14px">
                                            {{ translate('messages.Minimum Booking amount') }} ($) <span class="text-danger">*</span>
                                        </label>
                                        <input type="number" class="form-control h--45px" name="min_purchase" id="discount_min" value="{{ old('min_purchase') }}" placeholder="100" required>
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
        $(function() {
            var oldCategory = @json(old('category_ids', []));
            var oldService = @json(old('service_ids', []));
            var oldZone = @json(old('zone_ids', []));
            var oldType = '{{ old('discount_type', 'category') }}';
            var oldDiscountDuration = '{{ old('discount_duration') }}';

            function selectAllIfNeeded($select, oldArr) {
                if (!oldArr || !$select.length) return;
                if (oldArr.includes('all')) {
                    var vals = $select.find('option').not('[value="all"]').map(function() { return this.value; }).get();
                    $select.val(vals).trigger('change');
                }
            }

            selectAllIfNeeded($('#select_category'), oldCategory);
            selectAllIfNeeded($('#select_service'), oldService);
            selectAllIfNeeded($('#select_zone'), oldZone);

            function updateZoneCount() {
                var $zone = $('#select_zone');
                var vals = $zone.val() || [];
                var count = vals.length;
                if (count > 0) {
                    $('.countBox').text('+' + count);
                } else {
                    $('.countBox').text('+0');
                }
            }
            updateZoneCount();

            function applyDiscountType(type) {
                if (type === 'category') {
                    $('#select_category_wrapper').show();
                    $('#select_service_wrapper').hide();

                    $('#select_category').prop('required',true);
                    $('#select_service').prop('required',false);
                } else if (type === 'service') {
                    $('#select_category_wrapper').hide();
                    $('#select_service_wrapper').show();

                    $('#select_service').prop('required',true);
                    $('#select_category').prop('required',false);
                } else if (type === 'mixed') {
                    $('#select_category_wrapper').show();
                    $('#select_service_wrapper').show();

                    $('#select_service').prop('required',true);
                    $('#select_category').prop('required',true);
                }
            }

            applyDiscountType(oldType);

            $('#discount_type_category').on('click', function () { applyDiscountType('category'); });
            $('#discount_type_service').on('click', function () { applyDiscountType('service'); });
            $('#discount_type_mixed').on('click', function () { applyDiscountType('mixed'); });

            $('#select_category').on('change', function() {
                var selectedValues = $(this).val();
                if (selectedValues !== null && selectedValues.includes('all')) {
                    $(this).find('option').not(':disabled').prop('selected', 'selected');
                    $(this).find('option[value="all"]').prop('selected', false);
                    $(this).trigger('change');
                }
            });

            $('#select_service').on('change', function() {
                var selectedValues = $(this).val();
                if (selectedValues !== null && selectedValues.includes('all')) {
                    $(this).find('option').not(':disabled').prop('selected', 'selected');
                    $(this).find('option[value="all"]').prop('selected', false);
                    $(this).trigger('change');
                }
            });

            $('#select_zone').on('change', function() {
                var selectedValues = $(this).val();
                if (selectedValues !== null && selectedValues.includes('all')) {
                    $(this).find('option').not(':disabled').prop('selected', 'selected');
                    $(this).find('option[value="all"]').prop('selected', false);
                    $(this).trigger('change');
                }
                updateZoneCount();
            });

            $(document).ready(function () {
                const $couponInput = $('#discount_amount');
                const $couponType  = $('#discount_amount_type');
                const $maxDiscountBox = $('#max-discount-box');
                const $maxCoupon = $('#discount_max');

                function checkCouponLimit() {
                    if ($couponType.val() === 'percent') {
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

            var $drInput = $('.date-range-picker2');
            var drStart = moment().startOf('day');
            var drEnd = moment().endOf('day');
            if (oldDiscountDuration) {
                var parts = oldDiscountDuration.split(' - ');
                if (parts.length === 2) {
                    var s = moment(parts[0], ['MM/DD/YYYY', 'YYYY-MM-DD', 'DD/MM/YYYY']);
                    var e = moment(parts[1], ['MM/DD/YYYY', 'YYYY-MM-DD', 'DD/MM/YYYY']);
                    if (s.isValid() && e.isValid()) {
                        drStart = s;
                        drEnd = e;
                    }
                }
            }

            $drInput.daterangepicker({
                opens: 'right',
                startDate: drStart,
                endDate: drEnd,
                autoApply: true,
                locale: { format: 'MM/DD/YYYY' }
            });

            if (oldDiscountDuration) {
                $drInput.val(oldDiscountDuration);
            }

        });
    </script>
@endpush
