<form action="{{ route('admin.business-settings.service.update-business-setting') }}" method="POST">
    @csrf
    @method('put')
    <input type="hidden" name="type" value="bookings">
    <div class="card">
        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="form-group mb-0">
                        <label class="toggle-switch toggle-switch-sm d-flex justify-content-between border border-secondary rounded px-4 form-control"
                            for="bidding_system">
                            <span class="font-size-sm" data-text-color="#334257">{{ translate('messages.bidding_system') }}</span>
                            <input type="checkbox" class="toggle-switch-input" id="bidding_system" name="bidding_system" value="1" {{ ($settings['bidding_system'] ?? 0 == '1') ? 'checked' : '' }}>
                            <span class="toggle-switch-label">
                                <span class="toggle-switch-indicator"></span>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="form-group mb-0">
                        <label class="toggle-switch toggle-switch-sm d-flex justify-content-between border border-secondary rounded px-4 form-control"
                            for="otp_system">
                            <span class="font-size-sm" data-text-color="#334257">{{ translate('messages.otp_for_complete_service') }}</span>
                            <input type="checkbox" class="toggle-switch-input" id="otp_system" name="otp_for_complete_service" value="1" {{ ($settings['otp_for_complete_service'] ?? 0 == '1') ? 'checked' : '' }}>
                            <span class="toggle-switch-label">
                                <span class="toggle-switch-indicator"></span>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="form-group mb-0">
                        <label class="toggle-switch toggle-switch-sm d-flex justify-content-between border border-secondary rounded px-4 form-control"
                            for="offer_system">
                            <span class="font-size-sm" data-text-color="#334257">{{ translate('messages.see_other_providers_offers') }}</span>
                            <input type="checkbox" class="toggle-switch-input" id="offer_system" name="see_other_providers_offers" value="1" {{ ($settings['see_other_providers_offers'] ?? 0 == '1') ? 'checked' : '' }}>
                            <span class="toggle-switch-label">
                                <span class="toggle-switch-indicator"></span>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="form-group mb-0">
                        <label for="post_system" class="pr-2 mb-2 font-400 font-size-sm" data-text-color="#334257">{{ translate('messages.post_validation_days') }}</label>
                        <input type="text" placeholder="{{ translate('messages.day_placeholder') }}" class="form-control" id="post_system" name="post_validation_days" value="{{ $settings['post_validation_days'] ?? '' }}">
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="form-group mb-0">
                        <label for="max_amount" class="pr-2 mb-2 font-400 font-size-sm" data-text-color="#334257">{{ translate('messages.maximum_booking_amount') }} ({{ \App\CentralLogics\Helpers::currency_symbol() }}) <span class="text-danger">*</span></label>
                        <input type="number" placeholder="{{ translate('messages.amount_placeholder') }}" class="form-control" id="max_amount" name="maximum_booking_amount" value="{{ $settings['maximum_booking_amount'] ?? '' }}">
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="form-group mb-0">
                        <label for="min_amount" class="pr-2 mb-2 font-400 font-size-sm" data-text-color="#334257">{{ translate('messages.minimum_booking_amount') }} ({{ \App\CentralLogics\Helpers::currency_symbol() }}) <span class="text-danger">*</span></label>
                        <input type="number" placeholder="{{ translate('messages.amount_placeholder') }}" class="form-control" id="min_amount" name="minimum_booking_amount" value="{{ $settings['minimum_booking_amount'] ?? '' }}">
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="form-group mb-0">
                        <label for="default_commission" class="pr-2 mb-2 font-400 font-size-sm" data-text-color="#334257">{{ translate('messages.default_commission') }} (%) <span class="text-danger">*</span></label>
                        <input type="number" placeholder="{{ translate('messages.default_commission') }}" class="form-control" id="default_commission" name="default_commission" value="{{ $settings['default_commission'] ?? '' }}">
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="form-group mb-0">
                        <label class="toggle-switch toggle-switch-sm d-flex justify-content-between border border-secondary rounded px-4 form-control"
                            for="photo_system">
                            <span class="font-size-sm" data-text-color="#334257">{{ translate('messages.service_complete_photo_evidence') }}</span>
                            <input type="checkbox" class="toggle-switch-input" id="photo_system" name="service_complete_photo_evidence" value="1" {{ ($settings['service_complete_photo_evidence'] ?? 0 == '1') ? 'checked' : '' }}>
                            <span class="toggle-switch-label">
                                <span class="toggle-switch-indicator"></span>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="form-group mb-0">
                        <label class="toggle-switch toggle-switch-sm d-flex justify-content-between border border-secondary rounded px-4 form-control"
                            for="instant_system">
                            <span class="font-size-sm" data-text-color="#334257">{{ translate('messages.instant_booking') }}</span>
                            <input type="checkbox" class="toggle-switch-input" id="instant_system" name="instant_booking" value="1" {{ ($settings['instant_booking'] ?? 0 == '1') ? 'checked' : '' }}>
                            <span class="toggle-switch-label">
                                <span class="toggle-switch-indicator"></span>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="form-group mb-0">
                        <label class="toggle-switch toggle-switch-sm d-flex justify-content-between border border-secondary rounded px-4 form-control"
                            for="repeat_system">
                            <span class="font-size-sm" data-text-color="#334257">{{ translate('messages.repeat_booking') }}</span>
                            <input type="checkbox" class="toggle-switch-input" id="repeat_system" name="repeat_booking" value="1" {{ ($settings['repeat_booking'] ?? 0 == '1') ? 'checked' : '' }}>
                            <span class="toggle-switch-label">
                                <span class="toggle-switch-indicator"></span>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="form-group mb-0">
                        <label class="toggle-switch toggle-switch-sm d-flex justify-content-between border border-secondary rounded px-4 form-control"
                            for="shedule_system">
                            <span class="font-size-sm" data-text-color="#334257">{{ translate('messages.schedule_booking') }}</span>
                            <input type="checkbox" class="toggle-switch-input" id="shedule_system" name="schedule_booking" value="1" {{ ($settings['schedule_booking'] ?? 0 == '1') ? 'checked' : '' }}>
                            <span class="toggle-switch-label">
                                <span class="toggle-switch-indicator"></span>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="form-group mb-0">
                        <label class="toggle-switch toggle-switch-sm d-flex justify-content-between border border-secondary rounded px-4 form-control"
                            for="direct_provider_booking">
                            <span class="font-size-sm" data-text-color="#334257">{{ translate('messages.direct_provider_booking') }}</span>
                            <input type="checkbox" class="toggle-switch-input" id="direct_provider_booking" name="direct_provider_booking" value="1" {{ ($settings['direct_provider_booking'] ?? 0 == '1') ? 'checked' : '' }}>
                            <span class="toggle-switch-label">
                                <span class="toggle-switch-indicator"></span>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="form-group mb-0">
                        <label class="toggle-switch toggle-switch-sm d-flex justify-content-between border border-secondary rounded px-4 form-control"
                            for="booking_notification">
                            <span class="font-size-sm" data-text-color="#334257">{{ translate('messages.booking_notification') }}</span>
                            <input type="checkbox" class="toggle-switch-input" id="booking_notification" name="booking_notification" value="1" {{ ($settings['booking_notification'] ?? 0 == '1') ? 'checked' : '' }}>
                            <span class="toggle-switch-label">
                                <span class="toggle-switch-indicator"></span>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="col-md-6 col-lg-8">
                    <div class="form-group mb-0">
                        <div class="rounded border p-10px d-flex align-items-center gap-2 flex-sm-nowrap flex-wrap justify-content-between">
                            <label class="form-label  w-100 text-capitalize font-size-sm">{{ translate('messages.booking_notification_type') }}</label>
                            <label class="form-check w-100 form--check mr-2 mr-md-4">
                                <input class="form-check-input" type="radio" value="manual" name="booking_notification_type"  {{ ($settings['booking_notification_type']?? '') == 'manual' ? 'checked' : '' }}>
                                <span class="form-check-label fz--14px" data-text-color="#334257B2">
                                    {{ translate('messages.manual') }}
                                </span>
                            </label>
                            <label class="form-check w-100 form--check mr-2 mr-md-4">
                                <input class="form-check-input" type="radio" value="firebase" name="booking_notification_type" {{ ($settings['booking_notification_type']?? '') == 'firebase' ? 'checked' : '' }}>
                                <span class="form-check-label fz--14px" data-text-color="#334257B2">
                                    {{ translate('messages.firebase') }}
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card bg-light rounded mt-4">
                <div class="card-body">
                    <div class="row g-3 align-items-center">
                        <div class="col-md-6">
                            <label class="form-check form--check mr-2 mr-md-4">
                                <input class="form-check-input rounded" type="checkbox" onchange="checkboxToggleElement(this,'time_restriction_on_schedule_booking_container')" value="1" name="time_restriction_on_schedule_booking" {{ ($settings['time_restriction_on_schedule_booking'] ?? 0 == '1') ? 'checked' : '' }}>
                                <span class="form-check-label text-title font-400">
                                    {{ translate('messages.check_the_box') }}
                                    {{ translate('messages.if_you_want_to_add_time_restriction_on_schedule_booking') }}
                                </span>
                            </label>
                        </div>
                        <div class="col-md-6  {{ (isset($settings['time_restriction_on_schedule_booking']) && $settings['time_restriction_on_schedule_booking'] == '1') ? '' : 'd-none' }}" id="time_restriction_on_schedule_booking_container">
                            <div class="d-flex align-items-center restriction-time rounded border">
                                <div class="flex-grow-1">
                                    <input class="form-control border-0" placeholder="{{ translate('messages.schedule_booking') }}"
                                        type="number" value="{{ $settings['time_restriction_on_schedule_booking_value'] ?? '' }}" name="time_restriction_on_schedule_booking_value">
                                </div>
                                <select class="form-select w-auto border-0 h--45px px-2" name="time_restriction_on_schedule_booking_value_type"
                                    data-bg-color="#F0F2F7">
                                    <option value="hours" {{ (isset($settings['time_restriction_on_schedule_booking_value_type']) && $settings['time_restriction_on_schedule_booking_value_type'] == 'hours') ? 'selected' : '' }}>{{ translate('messages.hour') }}</option>
                                    <option value="days" {{ (isset($settings['time_restriction_on_schedule_booking_value_type']) && $settings['time_restriction_on_schedule_booking_value_type'] == 'days') ? 'selected' : '' }}>{{ translate('messages.day') }}</option>
                                    <option value="min" {{ (isset($settings['time_restriction_on_schedule_booking_value_type']) && $settings['time_restriction_on_schedule_booking_value_type'] == 'min') ? 'selected' : '' }}>{{ translate('messages.minutes') }}</option>
                                </select>
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
