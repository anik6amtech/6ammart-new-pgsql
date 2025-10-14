<form action="{{ route('admin.business-settings.service.update-business-setting') }}" method="POST">
    @csrf
    @method('put')
    <input type="hidden" name="type" value="serviceman">
    <div class="card">
        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="form-group mb-0">
                        <label class="toggle-switch toggle-switch-sm d-flex justify-content-between border border-secondary rounded px-4 form-control"
                            for="serviceman_can_cancel_booking">
                            <span class="font-size-sm">
                                {{ translate('messages.cancel_booking_request') }}
                                <span data-text-color="#334257" data-toggle="tooltip" data-placement="right" data-original-title="{{translate('messages.When enabled, servicemen are allowed to request the cancellation of a booking. The request may require admin or provider approval, depending on system settings.')}}"><i class="tio-info" data-text-color="#A7A7A7"></i></span>
                            </span>
                            <input type="checkbox" class="toggle-switch-input" id="serviceman_can_cancel_booking" name="serviceman_can_cancel_booking" value="1" {{ ($settings['serviceman_can_cancel_booking'] ?? 0 == '1') ? 'checked' : '' }}>
                            <span class="toggle-switch-label">
                                <span class="toggle-switch-indicator"></span>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="form-group mb-0">
                        <label class="toggle-switch toggle-switch-sm d-flex justify-content-between border border-secondary rounded px-4 form-control"
                            for="serviceman_edit_booking">
                            <span class="font-size-sm">
                                {{ translate('messages.edit_booking_req') }}
                                <span data-text-color="#334257" data-toggle="tooltip" data-placement="right" data-original-title="{{translate('messages.Allows servicemen to request changes to existing bookings, such as rescheduling or modifying service details. Requests may need approval before taking effect.')}}"><i class="tio-info" data-text-color="#A7A7A7"></i></span>
                            </span>
                            <input type="checkbox" class="toggle-switch-input" id="serviceman_edit_booking" name="serviceman_edit_booking" value="1" {{ ($settings['serviceman_edit_booking'] ?? 0 == '1') ? 'checked' : '' }}>
                            <span class="toggle-switch-label">
                                <span class="toggle-switch-indicator"></span>
                            </span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="justify-content-end btn--container mt-20">
        <button type="reset" class="btn min-w-120 btn--reset">{{ translate('messages.reset') }}</button>
        <button type="submit" class="btn min-w-120 btn--primary">{{ translate('messages.submit') }}</button>
    </div>
</form>
