@extends('layouts.admin.app')

@section('title', translate('messages.Additional_Setup'))

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header pb-20">
            <div class="d-flex justify-content-between flex-wrap gap-3">
                <div>
                    <h1 class="page-header-title">
                        <span class="page-header-icon">
                            <img src="{{ asset('Modules/RideShare/public/assets/img/ride-share/business-icon.png') }}" alt="" class="w--20px aspect-1-1">
                        </span>
                        <span>{{ translate('messages.Additional_Setup') }}</span>
                    </h1>
                </div>
            </div>
        </div>
        <div class="js-nav-scroller hs-nav-scroller-horizontal mb-4">
            @include('ride-share::admin.business-management.business-setup.partials._business-setup-inline')
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h4 class="text--title font-bold mb-0 d-flex gap-2 align-items-center lh-1">
                    <i class="fi fi-rr-settings"></i>
                    {{ translate('messages.Business_information') }}
                </h4>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="form-group mb-0">
                            <label class="toggle-switch toggle-switch-sm d-flex justify-content-between border rounded px-3 form-control">
                                <span class="pr-1 d-flex align-items-center"><span class="line--limit-1">{{ translate('messages.rider_self_registration') }}</span>
                                    <span class="form-label-secondary" data-toggle="tooltip" data-placement="right"
                                        data-original-title="If enabled  the customer will see the total product price  including VAT/Tax. If it’s disabled  the VAT/Tax will be added separately with the total cost of the product.">
                                        <img src="{{ asset('public/assets/admin/img/info-circle.svg') }}" alt="">
                                    </span>
                                </span>
                                <input class="status toggle-switch-input update-business-setting"
                                    id="updateVehicle" type="checkbox" name="driver_self_registration"
                                    data-name="driver_self_registration" data-type="{{ DRIVER_SETTINGS }}"
                                    data-url="{{ route('admin.business-settings.ride-share.update-business-setting') }}"
                                    data-icon="{{ ($settings->firstWhere('key', 'driver_self_registration')?->value ?? 0) == 1 ? asset('/public/assets/admin/img/modal/package-status-disable.png') : asset('/public/assets/admin/img/modal/package-status-disable.png') }}"
                                    data-title="{{ translate('Are you sure?') }}"
                                    data-sub-title="{{ ($settings->firstWhere('key', 'driver_self_registration')?->value ?? 0) == 1 ? translate('Do you want to turn OFF rider self registration?') : translate('Do you want to turn ON rider self registration?') }}"
                                    data-confirm-btn="{{ ($settings->firstWhere('key', 'driver_self_registration')?->value ?? 0) == 1 ? translate('Turn Off') : translate('Turn On') }}"
                                {{ ($settings->firstWhere('key', 'driver_self_registration')?->value ?? 0) == 1 ? 'checked' : '' }}>
                                <span class="toggle-switch-label text">
                                    <span class="toggle-switch-indicator"></span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-0">
                            <label class="toggle-switch toggle-switch-sm d-flex justify-content-between border rounded px-3 form-control">
                                <span class="pr-1 d-flex align-items-center"><span class="line--limit-1">{{ translate('messages.rider_verification') }}</span>
                                    <span class="form-label-secondary" data-toggle="tooltip" data-placement="right"
                                        data-original-title="If enabled  the customer will see the total product price  including VAT/Tax. If it’s disabled  the VAT/Tax will be added separately with the total cost of the product.">
                                        <img src="{{ asset('public/assets/admin/img/info-circle.svg') }}" alt="">
                                    </span>
                                </span>
                                <input class="status toggle-switch-input update-business-setting"
                                    id="updateVehicle" type="checkbox" name="driver_verification"
                                    data-name="driver_verification" data-type="{{ DRIVER_SETTINGS }}"
                                    data-url="{{ route('admin.business-settings.ride-share.update-business-setting') }}"
                                    data-icon="{{ ($settings->firstWhere('key', 'driver_verification')?->value ?? 0) == 1 ? asset('/public/assets/admin/img/modal/package-status-disable.png') : asset('/public/assets/admin/img/modal/package-status-disable.png') }}"
                                    data-title="{{ translate('Are you sure?') }}"
                                    data-sub-title="{{ ($settings->firstWhere('key', 'driver_verification')?->value ?? 0) == 1 ? translate('Do you want to turn OFF rider verification?') : translate('Do you want to turn ON rider verification?') }}"
                                    data-confirm-btn="{{ ($settings->firstWhere('key', 'driver_verification')?->value ?? 0) == 1 ? translate('Turn Off') : translate('Turn On') }}"
                                {{ ($settings->firstWhere('key', 'driver_verification')?->value ?? 0) == 1 ? 'checked' : '' }}>
                                <span class="toggle-switch-label text">
                                    <span class="toggle-switch-indicator"></span>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <h4 class="text--title font-bold mb-0">
                    {{ translate('messages.Rider_Review') }}
                </h4>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="form-group mb-0">
                            <label class="toggle-switch toggle-switch-sm d-flex justify-content-between border rounded px-3 form-control">
                                <span class="pr-1 d-flex align-items-center"><span class="line--limit-1">{{ translate('messages.rider_can_review_customer') }}</span>
                                    <span class="form-label-secondary" data-toggle="tooltip" data-placement="right"
                                        data-original-title="If enabled  the customer will see the total product price  including VAT/Tax. If it’s disabled  the VAT/Tax will be added separately with the total cost of the product.">
                                        <img src="{{ asset('public/assets/admin/img/info-circle.svg') }}" alt="">
                                    </span>
                                </span>
                                <input class="status toggle-switch-input update-business-setting"
                                    id="updateVehicle" type="checkbox" name="driver_can_review_customer"
                                    data-name="driver_can_review_customer" data-type="{{ DRIVER_SETTINGS }}"
                                    data-url="{{ route('admin.business-settings.ride-share.update-business-setting') }}"
                                    data-icon="{{ ($settings->firstWhere('key', 'driver_can_review_customer')?->value ?? 0) == 1 ? asset('/public/assets/admin/img/modal/package-status-disable.png') : asset('/public/assets/admin/img/modal/package-status-disable.png') }}"
                                    data-title="{{ translate('Are you sure?') }}"
                                    data-sub-title="{{ ($settings->firstWhere('key', 'driver_can_review_customer')?->value ?? 0) == 1 ? translate('Do you want to turn OFF rider review?') : translate('Do you want to turn ON rider review?') }}"
                                    data-confirm-btn="{{ ($settings->firstWhere('key', 'driver_can_review_customer')?->value ?? 0) == 1 ? translate('Turn Off') : translate('Turn On') }}"
                                {{ ($settings->firstWhere('key', 'driver_can_review_customer')?->value ?? 0) == 1 ? 'checked' : '' }}>
                                <span class="toggle-switch-label text">
                                    <span class="toggle-switch-indicator"></span>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <div class="w-100">
                    <label class="toggle-switch toggle-switch-sm d-flex justify-content-between">
                        <span class="pr-1 d-flex align-items-center fs-16 font-semibold text--title">
                            <span
                                class="line--limit-1">{{ translate('messages.Update_Vehicle') }}
                            </span>
                        </span>

                        <input class="status toggle-switch-input update-business-setting"
                              id="updateVehicle" type="checkbox" name="update_vehicle_approval_status"
                            data-name="update_vehicle_approval_status" data-type="{{ DRIVER_SETTINGS }}"
                            data-url="{{ route('admin.business-settings.ride-share.update-business-setting') }}"
                            data-icon="{{ ($settings->firstWhere('key', 'update_vehicle_approval_status')?->value ?? 0) == 1 ? asset('/public/assets/admin/img/modal/package-status-disable.png') : asset('/public/assets/admin/img/modal/package-status-disable.png') }}"
                            data-title="{{ translate('Are you sure?') }}"
                            data-sub-title="{{ ($settings->firstWhere('key', 'update_vehicle_approval_status')?->value ?? 0) == 1 ? translate('Do you want to turn OFF update vehicle?') : translate('Do you want to turn ON update vehicle?') }}"
                            data-confirm-btn="{{ ($settings->firstWhere('key', 'update_vehicle_approval_status')?->value ?? 0) == 1 ? translate('Turn Off') : translate('Turn On') }}"
                        {{ ($settings->firstWhere('key', 'update_vehicle_approval_status')?->value ?? 0) == 1 ? 'checked' : '' }}>
                        <span class="toggle-switch-label text">
                            <span class="toggle-switch-indicator"></span>
                        </span>
                    </label>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.business-settings.rider.vehicle-update') . '?type=' . DRIVER_SETTINGS }}"
                    id="updateVehicleForm" method="POST">
                    @csrf
                    <div class="d-flex justify-content-between flex-wrap gap-3">
                        @foreach(UPDATE_VEHICLE as $updateVehicle)
                            <div class="form-check form-check-inline ">
                                <input class="form-check-input mx-2" type="checkbox" value="{{$updateVehicle}}" {{in_array($updateVehicle, json_decode($settings->firstWhere('key', 'update_vehicle_approval')?->value ?? '[]'), true) ? "checked" : ""}} name="update_vehicle_approval[]">
                                <label class=" form-check-label"> {{translate($updateVehicle)}}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn--primary min-w-120px">{{ translate('messages.submit') }}</button>
                    </div>
                </form>
            </div>
        </div>


    </div>

    {{--Custom Modal Start--}}
<div class="modal fade" id="customModal">
    <div class="modal-dialog status-warning-modal">
        <div class="modal-content">
            <div class="modal-header border-0">
                    <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true" class="tio-clear"></span>
                </button>
            </div>
            <div class="modal-body pb-5 pt-0">
                <div class="max-349 mx-auto">
                    <div>
                        <div class="text-center">
                            <img alt="" class="mb-4" id="icon"
                                 src="{{asset('public/assets/admin-module/img/svg/blocked_customer.svg')}}">
                            <h5 class="modal-title mb-3" id="title">{{translate("Are you sure?")}}</h5>
                        </div>
                        <div class="text-center mb-4 pb-2">
                            <p id="subTitle">{{translate("Want to change status")}}</p>
                        </div>
                    </div>
                    <div class="btn--container justify-content-center">
                        <button type="button" class="btn btn--cancel min-w-120" id="modalCancelBtn">
                            {{translate('Cancel')}}
                        </button>
                        <button type="button" class="btn btn-primary min-w-120"
                                id="modalConfirmBtn">{{translate('Ok')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{--Custom Modal End--}}

@endsection

@push('script_2')

<script>
    let currentToggle = null;
    let currentStatus = 0;

    $(document).ready(function () {
        $('.update-business-setting').on('change', function (e) {
            e.preventDefault();

            currentToggle = this;
            currentStatus = $(this).prop('checked') ? 1 : 0;

            $('#icon').attr('src', $(this).data('icon'));
            $('#title').html($(this).data('title'));
            $('#subTitle').html($(this).data('sub-title'));
            $('#modalConfirmBtn').html($(this).data('confirm-btn'));
            $('#modalCancelBtn').html($(this).data('cancel-btn') ?? '{{ translate("Cancel") }}');

            $('#customModal').modal('show');
        });

        $('#modalConfirmBtn').off().on('click', function () {
            if (!currentToggle) return;

            const $el = $(currentToggle);
            $.ajax({
                url: $el.data('url'),
                _method: 'PUT',
                data: {
                    value: currentStatus,
                    name: $el.data('name'),
                    type: $el.data('type')
                },
                success: function () {
                    toastr.success("{{ translate('status_changed_successfully') }}");
                    // $('#customModal').modal('hide');
                    setTimeout(() => location.reload(), 1000);
                },
                error: function () {
                    toastr.error("{{ translate('status_change_failed') }}");
                    // $('#customModal').modal('hide');
                    resetCheckbox();
                }
            });
        });

        $('#modalCancelBtn').off().on('click', function () {
            $('#customModal').modal('hide');
            resetCheckbox();
        });

        $('#customModal').on('hidden.bs.modal', function () {
            resetCheckbox();
        });

        function resetCheckbox() {
            if (!currentToggle) return;
            $(currentToggle).prop('checked', !currentStatus);
            currentToggle = null;
        }
    });
</script>


@endpush
