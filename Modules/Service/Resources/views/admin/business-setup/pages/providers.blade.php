<form action="{{ route('admin.business-settings.service.update-business-setting') }}" method="POST">
    @csrf
    @method('put')
    <input type="hidden" name="type" value="providers">
    <div class="card">
        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="form-group mb-0">
                        <label class="toggle-switch toggle-switch-sm d-flex justify-content-between border border-secondary rounded px-4 form-control"
                            for="provider_can_cancel_booking">
                            <span class="font-size-sm">
                                {{ translate('messages.provider_can_cancel_booking') }}
                                <span data-text-color="#334257" data-toggle="tooltip" data-placement="right" data-original-title="{{translate('messages.When enabled, service providers will have the ability to cancel bookings made by customers.')}}"><i class="tio-info" data-text-color="#A7A7A7"></i></span>
                            </span>
                            <input type="checkbox" class="toggle-switch-input" id="provider_can_cancel_booking" name="provider_can_cancel_booking" value="1" {{ ($settings['provider_can_cancel_booking'] ?? 0 == '1') ? 'checked' : '' }}>
                            <span class="toggle-switch-label">
                                <span class="toggle-switch-indicator"></span>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="form-group mb-0">
                        <label class="toggle-switch toggle-switch-sm d-flex justify-content-between border border-secondary rounded px-4 form-control"
                            for="provider_can_edit_booking">
                            <span class="font-size-sm">
                                {{ translate('messages.provider_can_edit_booking') }}
                                <span data-text-color="#334257" data-toggle="tooltip" data-placement="right" data-original-title="{{translate('messages.When turned on, providers can edit the details of a booking, such as time, date, or service notes.')}}"><i class="tio-info" data-text-color="#A7A7A7"></i></span>
                            </span>
                            <input type="checkbox" class="toggle-switch-input" id="provider_can_edit_booking" name="provider_can_edit_booking" value="1" {{ ($settings['provider_can_edit_booking'] ?? 0 == '1') ? 'checked' : '' }}>
                            <span class="toggle-switch-label">
                                <span class="toggle-switch-indicator"></span>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="form-group mb-0">
                        <label class="toggle-switch toggle-switch-sm d-flex justify-content-between border border-secondary rounded px-4 form-control"
                            for="provider_suspend_on_exceed_cash_limit">
                            <span class="font-size-sm">
                                {{ translate('messages.provider_suspend_on_exceed_cash_limit') }}
                                <span data-text-color="#334257" data-toggle="tooltip" data-placement="right" data-original-title="{{translate('messages.Automatically suspends a provider’s account if their cash earnings exceed the configured limit.')}}"><i class="tio-info" data-text-color="#A7A7A7"></i></span>
                            </span>
                            <input type="checkbox" class="toggle-switch-input" id="provider_suspend_on_exceed_cash_limit" name="provider_suspend_on_exceed_cash_limit" value="1" {{ ($settings['provider_suspend_on_exceed_cash_limit'] ?? 0 == '1') ? 'checked' : '' }}>
                            <span class="toggle-switch-label">
                                <span class="toggle-switch-indicator"></span>
                            </span>
                        </label>
                    </div>
                </div>
                {{-- <div class="col-md-6 col-lg-4">
                    <div class="form-group mb-0">
                        <label class="toggle-switch toggle-switch-sm d-flex justify-content-between border border-secondary rounded px-4 form-control"
                            for="provider_self_registration">
                            <span class="font-size-sm">
                                {{ translate('messages.provider_self_registration') }}
                                <span data-text-color="#334257" data-toggle="tooltip" data-placement="right" data-original-title="{{translate('messages.Allows providers to register themselves on the platform without admin intervention.')}}"><i class="tio-info" data-text-color="#A7A7A7"></i></span>
                            </span>
                            <input type="checkbox" class="toggle-switch-input" id="provider_self_registration" name="provider_self_registration" value="1" {{ ($settings['provider_self_registration'] ?? 0 == '1') ? 'checked' : '' }}>
                            <span class="toggle-switch-label">
                                <span class="toggle-switch-indicator"></span>
                            </span>
                        </label>
                    </div>
                </div> --}}
                <div class="col-md-6 col-lg-4">
                    <div class="form-group mb-0">
                        <label class="toggle-switch toggle-switch-sm d-flex justify-content-between border border-secondary rounded px-4 form-control"
                            for="provider_self_delete">
                            <span class="font-size-sm">
                                {{ translate('messages.provider_self_delete') }}
                                <span data-text-color="#334257" data-toggle="tooltip" data-placement="right" data-original-title="{{translate('messages.Enables providers to delete their accounts from the system on their own.')}}"><i class="tio-info" data-text-color="#A7A7A7"></i></span>
                            </span>
                            <input type="checkbox" class="toggle-switch-input" id="provider_self_delete" name="provider_self_delete" value="1" {{ ($settings['provider_self_delete'] ?? 0 == '1') ? 'checked' : '' }}>
                            <span class="toggle-switch-label">
                                <span class="toggle-switch-indicator"></span>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="form-group mb-0">
                        <label class="toggle-switch toggle-switch-sm d-flex justify-content-between border border-secondary rounded px-4 form-control"
                            for="provider_commission_base">
                            <span class="font-size-sm">
                                {{ translate('messages.provider_commission_base') }}
                                <span data-text-color="#334257" data-toggle="tooltip" data-placement="right" data-original-title="{{translate('messages.Enables a commission-based earning model where providers pay a percentage of each booking to the admin.')}}"><i class="tio-info" data-text-color="#A7A7A7"></i></span>
                            </span>
                            <input type="checkbox" class="toggle-switch-input" id="provider_commission_base" name="provider_commission_base" value="1" {{ ($settings['provider_commission_base'] ?? 0 == '1') ? 'checked' : '' }}>
                            <span class="toggle-switch-label">
                                <span class="toggle-switch-indicator"></span>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="form-group mb-0">
                        <label class="toggle-switch toggle-switch-sm d-flex justify-content-between border border-secondary rounded px-4 form-control"
                            for="provider_subscription_base">
                            <span class="font-size-sm">
                                {{ translate('messages.provider_subscription_base') }}
                                <span data-text-color="#334257" data-toggle="tooltip" data-placement="right" data-original-title="{{translate('messages.Activates a subscription-based model for providers. They must subscribe to offer services.')}}"><i class="tio-info" data-text-color="#A7A7A7"></i></span>
                            </span>
                            <input type="checkbox" class="toggle-switch-input" id="provider_subscription_base" name="provider_subscription_base" value="1" {{ ($settings['provider_subscription_base'] ?? 0 == '1') ? 'checked' : '' }}>
                            <span class="toggle-switch-label">
                                <span class="toggle-switch-indicator"></span>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="form-group mb-0">
                        <label class="toggle-switch toggle-switch-sm d-flex justify-content-between border border-secondary rounded px-4 form-control"
                            for="provider_can_reply_review">
                            <span class="font-size-sm">
                                {{ translate('messages.provider_can_reply_review') }}
                                <span data-text-color="#334257" data-toggle="tooltip" data-placement="right" data-original-title="{{translate('messages.When enabled, providers can respond to reviews left by customers on their services.')}}"><i class="tio-info" data-text-color="#A7A7A7"></i></span>
                            </span>
                            <input type="checkbox" class="toggle-switch-input" id="provider_can_reply_review" name="provider_can_reply_review" value="1" {{ ($settings['provider_can_reply_review'] ?? 0 == '1') ? 'checked' : '' }}>
                            <span class="toggle-switch-label">
                                <span class="toggle-switch-indicator"></span>
                            </span>
                        </label>
                    </div>
                </div>
                {{-- <div class="col-md-6 col-lg-4">
                    <div class="form-group mb-0">
                        <label class="toggle-switch toggle-switch-sm d-flex justify-content-between border border-secondary rounded px-4 form-control"
                            for="service_at_provider_place">
                            <span class="font-size-sm">
                                {{ translate('messages.service_at_provider_place') }}
                                <span data-text-color="#334257" data-toggle="tooltip" data-placement="right" data-original-title="{{translate('messages.content_need')}}"><i class="tio-info" data-text-color="#A7A7A7"></i></span>
                            </span>
                            <input type="checkbox" class="toggle-switch-input" id="service_at_provider_place" name="service_at_provider_place" value="1" {{ ($settings['service_at_provider_place'] ?? 0 == '1') ? 'checked' : '' }}>
                            <span class="toggle-switch-label">
                                <span class="toggle-switch-indicator"></span>
                            </span>
                        </label>
                    </div>
                </div> --}}
                <div class="col-md-6 col-lg-4">
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="form-group mb-0">
                        <label for="provider_maximum_booking_amount" class="pr-2 mb-2 font-400 font-size-sm" data-text-color="#334257">{{ translate('messages.provider_maximum_booking_amount') }} ({{ \App\CentralLogics\Helpers::currency_symbol() }}) <span class="text-danger">*</span></label>
                        <input type="number" placeholder="{{ translate('messages.amount_placeholder') }}" class="form-control" id="provider_maximum_booking_amount" name="provider_maximum_booking_amount" value="{{ $settings['provider_maximum_booking_amount'] ?? '' }}" min="0" step="0.01">
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="form-group mb-0">
                        <label for="provider_minimum_payable_amount" class="pr-2 mb-2 font-400 font-size-sm" data-text-color="#334257">{{ translate('messages.provider_minimum_payable_amount') }} ({{ \App\CentralLogics\Helpers::currency_symbol() }}) <span class="text-danger">*</span></label>
                        <input type="number" placeholder="{{ translate('messages.amount_placeholder') }}" class="form-control" id="provider_minimum_payable_amount" name="provider_minimum_payable_amount" value="{{ $settings['provider_minimum_payable_amount'] ?? '' }}" min="0" step="0.01">
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="form-group mb-0">
                        <label for="provider_max_cash_in_hand_limit" class="pr-2 mb-2 font-400 font-size-sm" data-text-color="#334257">{{ translate('messages.provider_max_cash_in_hand_limit') }} ({{ \App\CentralLogics\Helpers::currency_symbol() }}) <span class="text-danger">*</span></label>
                        <input type="number" placeholder="{{ translate('messages.provider_max_cash_in_hand_limit') }}" class="form-control" id="provider_max_cash_in_hand_limit" name="provider_max_cash_in_hand_limit" value="{{ $settings['provider_max_cash_in_hand_limit'] ?? '' }}">
                    </div>
                </div>
            </div>
            <div class="card bg-light rounded mt-4">
                <div class="card-body">
                    <div class="row g-3 align-items-center">
                        <div class="col-xl-8 col-md-6">
                            <p class="fz--14px max-w-640 mb-0" data-text-color="#334257B2">
                                {{ translate('messages.When enabled. providers can choose where they want to provide service. Customers can book services at the providers location when this feature is active') }}
                            </p>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="form-group mb-0">
                                <label class="toggle-switch toggle-switch-sm d-flex justify-content-between border border-secondary rounded px-4 form-control"
                                    for="service_at_provider_place">
                                    <span class="font-size-sm" data-text-color="#334257">{{ translate('messages.service_at_provider_place') }}</span>
                                    <input type="checkbox" class="toggle-switch-input" id="service_at_provider_place" name="service_at_provider_place" value="1" {{ ($settings['service_at_provider_place'] ?? 0 == '1') ? 'checked' : '' }}>
                                    <span class="toggle-switch-label">
                                        <span class="toggle-switch-indicator"></span>
                                    </span>
                                </label>
                            </div>
                        </div>
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
