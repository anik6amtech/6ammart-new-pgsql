<form action="{{ route('admin.business-settings.service.update-business-setting') }}" method="POST">
    @csrf
    @method('put')
    <input type="hidden" name="type" value="promotion">
    <div class="card">
        <div class="p-20 border-bottom">
            <h4 class="mb-0">{{ translate('messages.normal_discount') }}</h4>
        </div>
        <div class="card-body p-20">
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="form-group mb-0">
                        <label class="form-label text-capitalize font-size-sm" for="admin_parcentage">{{ translate('messages.discount_cost_bearer') }} <span
                                    class="text-danger">*</span></label>
                        <div class="rounded border p-10px d-flex align-items-center gap-2 flex-sm-nowrap flex-wrap justify-content-between">
                            <label class="form-check w-100 form--check mr-2 mr-md-4">
                                <input class="form-check-input" type="radio" value="admin" onchange="radioToggleElement('service_discount_cost_bearer[bearer]', 'both', '.discount-cost-bearer-section')" name="service_discount_cost_bearer[bearer]" {{ ($settings['service_discount_cost_bearer']['bearer']?? '') == 'admin' ? 'checked' : '' }}>
                                <span class="form-check-label fz--14px" data-text-color="#334257B2">
                                    {{ translate('messages.admin') }}
                                </span>
                            </label>
                            <label class="form-check w-100 form--check mr-2 mr-md-4">
                                <input class="form-check-input" type="radio" value="provider" onchange="radioToggleElement('service_discount_cost_bearer[bearer]', 'both', '.discount-cost-bearer-section')" name="service_discount_cost_bearer[bearer]" {{ ($settings['service_discount_cost_bearer']['bearer']?? '') == 'provider' ? 'checked' : '' }}>
                                <span class="form-check-label fz--14px" data-text-color="#334257B2">
                                    {{ translate('messages.provider') }}
                                </span>
                            </label>
                            <label class="form-check w-100 form--check mr-2 mr-md-4">
                                <input class="form-check-input" type="radio" value="both" onchange="radioToggleElement('service_discount_cost_bearer[bearer]', 'both', '.discount-cost-bearer-section')" name="service_discount_cost_bearer[bearer]" {{ ($settings['service_discount_cost_bearer']['bearer']?? '') == 'both' ? 'checked' : '' }}>
                                <span class="form-check-label fz--14px" data-text-color="#334257B2">
                                    {{ translate('messages.both') }}
                                </span>
                            </label>
                        </div>
                    </div> 
                </div>

                <div class="col-md-6 col-lg-4 discount-cost-bearer-section {{ ($settings['service_discount_cost_bearer']['bearer']?? '') != 'both' ? 'd-none' : '' }}">
                    <div class="form-group mb-0">
                        <label class="form-label text-capitalize font-size-sm">{{ translate('messages.admin_percentage') }} (%) <span
                                class="text-danger">*</span></label>
                        <input type="number" name="service_discount_cost_bearer[admin_percentage]" class="form-control hundred_percent admin_percent" data-type="discount" min="0"
                            placeholder="60" value="{{ $settings['service_discount_cost_bearer']['admin_percentage'] ?? 0 }}">
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 discount-cost-bearer-section {{ ($settings['service_discount_cost_bearer']['bearer']?? '') != 'both' ? 'd-none' : '' }}">
                    <div class="form-group mb-0">
                        <label class="form-label text-capitalize font-size-sm">{{ translate('messages.provider_percentage') }} (%) <span
                                class="text-danger">*</span></label>
                        <input type="number" name="service_discount_cost_bearer[provider_percentage]" class="form-control hundred_percent provider_percent" data-type="discount" min="0"
                            placeholder="40" value="{{ $settings['service_discount_cost_bearer']['provider_percentage'] ?? 0 }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-4">
        <div class="p-20 border-bottom">
            <h4 class="mb-0">{{ translate('messages.campaign_discount') }}</h4>
        </div>
        <div class="card-body p-20">
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="form-group mb-0">
                        <label class="form-label text-capitalize font-size-sm" for="admin_parcentage">{{ translate('messages.campaign_cost_bearer') }} <span
                                    class="text-danger">*</span></label>
                        <div class="rounded border p-10px d-flex align-items-center gap-2 flex-sm-nowrap flex-wrap justify-content-between">
                            <label class="form-check w-100 form--check mr-2 mr-md-4">
                                <input class="form-check-input" type="radio" value="admin" onchange="radioToggleElement('service_campaign_cost_bearer[bearer]', 'both', '.campaign-cost-bearer-section')" name="service_campaign_cost_bearer[bearer]"  {{ ($settings['service_campaign_cost_bearer']['bearer']?? '') == 'admin' ? 'checked' : '' }}>
                                <span class="form-check-label fz--14px" data-text-color="#334257B2">
                                    {{ translate('messages.admin') }}
                                </span>
                            </label>
                            <label class="form-check w-100 form--check mr-2 mr-md-4">
                                <input class="form-check-input" type="radio" value="provider" onchange="radioToggleElement('service_campaign_cost_bearer[bearer]', 'both', '.campaign-cost-bearer-section')" name="service_campaign_cost_bearer[bearer]" {{ ($settings['service_campaign_cost_bearer']['bearer']?? '') == 'provider' ? 'checked' : '' }}>
                                <span class="form-check-label fz--14px" data-text-color="#334257B2">
                                    {{ translate('messages.provider') }}
                                </span>
                            </label>
                            <label class="form-check w-100 form--check mr-2 mr-md-4">
                                <input class="form-check-input" type="radio" value="both" onchange="radioToggleElement('service_campaign_cost_bearer[bearer]', 'both', '.campaign-cost-bearer-section')" name="service_campaign_cost_bearer[bearer]" {{ ($settings['service_campaign_cost_bearer']['bearer']?? '') == 'both' ? 'checked' : '' }}>
                                <span class="form-check-label fz--14px" data-text-color="#334257B2">
                                    {{ translate('messages.both') }}
                                </span>
                            </label>
                        </div>
                    </div> 
                </div>

                <div class="col-md-6 col-lg-4 campaign-cost-bearer-section {{ ($settings['service_campaign_cost_bearer']['bearer']?? '') != 'both' ? 'd-none' : '' }}">
                    <div class="form-group mb-0">
                        <label class="form-label text-capitalize font-size-sm">{{ translate('messages.admin_percentage') }} (%) <span
                                class="text-danger">*</span></label>
                        <input type="number" name="service_campaign_cost_bearer[admin_percentage]" class="form-control hundred_percent admin_percent" data-type="campaign" min="0"
                            placeholder="60" value="{{ $settings['service_campaign_cost_bearer']['admin_percentage'] ?? 0 }}">
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 campaign-cost-bearer-section {{ ($settings['service_campaign_cost_bearer']['bearer']?? '') != 'both' ? 'd-none' : '' }}">
                    <div class="form-group mb-0">
                        <label class="form-label text-capitalize font-size-sm">{{ translate('messages.provider_percentage') }} (%) <span
                                class="text-danger">*</span></label>
                        <input type="number" name="service_campaign_cost_bearer[provider_percentage]" class="form-control hundred_percent provider_percent" data-type="campaign" min="0"
                            placeholder="40" value="{{ $settings['service_campaign_cost_bearer']['provider_percentage'] ?? 0 }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-4">
        <div class="p-20 border-bottom">
            <h4 class="mb-0">{{ translate('messages.coupon_discount') }}</h4>
        </div>
        <div class="card-body p-20">
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="form-group mb-0">
                        <label class="form-label text-capitalize font-size-sm" for="admin_parcentage">{{ translate('messages.coupon_cost_bearer') }} <span
                                    class="text-danger">*</span></label>
                        <div class="rounded border p-10px d-flex align-items-center gap-2 flex-sm-nowrap flex-wrap justify-content-between">
                            <label class="form-check w-100 form--check mr-2 mr-md-4">
                                <input class="form-check-input" type="radio" value="admin" onchange="radioToggleElement('service_coupon_cost_bearer[bearer]', 'both', '.coupon-cost-bearer-section')" name="service_coupon_cost_bearer[bearer]" {{ ($settings['service_coupon_cost_bearer']['bearer']?? '') == 'admin' ? 'checked' : '' }}>
                                <span class="form-check-label fz--14px" data-text-color="#334257B2">
                                    {{ translate('messages.admin') }}
                                </span>
                            </label>
                            <label class="form-check w-100 form--check mr-2 mr-md-4">
                                <input class="form-check-input" type="radio" value="provider" onchange="radioToggleElement('service_coupon_cost_bearer[bearer]', 'both', '.coupon-cost-bearer-section')" name="service_coupon_cost_bearer[bearer]" {{ ($settings['service_coupon_cost_bearer']['bearer']?? '') == 'provider' ? 'checked' : '' }}>
                                <span class="form-check-label fz--14px" data-text-color="#334257B2">
                                    {{ translate('messages.provider') }}
                                </span>
                            </label>
                            <label class="form-check w-100 form--check mr-2 mr-md-4">
                                <input class="form-check-input" type="radio" value="both" onchange="radioToggleElement('service_coupon_cost_bearer[bearer]', 'both', '.coupon-cost-bearer-section')" name="service_coupon_cost_bearer[bearer]" {{ ($settings['service_coupon_cost_bearer']['bearer']?? '') == 'both' ? 'checked' : '' }}>
                                <span class="form-check-label fz--14px" data-text-color="#334257B2">
                                    {{ translate('messages.both') }}
                                </span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 coupon-cost-bearer-section {{ ($settings['service_coupon_cost_bearer']['bearer']?? '') != 'both' ? 'd-none' : '' }}">
                    <div class="form-group mb-0">
                        <label class="form-label text-capitalize font-size-sm">{{ translate('messages.admin_percentage') }} (%) <span
                                class="text-danger">*</span></label>
                        <input type="number" name="service_coupon_cost_bearer[admin_percentage]" class="form-control hundred_percent admin_percent" data-type="coupon" min="0"
                            placeholder="60" value="{{ $settings['service_coupon_cost_bearer']['admin_percentage'] ?? 0 }}">
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 coupon-cost-bearer-section {{ ($settings['service_coupon_cost_bearer']['bearer']?? '') != 'both' ? 'd-none' : '' }}">
                    <div class="form-group mb-0">
                        <label class="form-label text-capitalize font-size-sm">{{ translate('messages.provider_percentage') }} (%) <span
                                class="text-danger">*</span></label>
                        <input type="number" name="service_coupon_cost_bearer[provider_percentage]" class="form-control hundred_percent provider_percent" data-type="coupon" min="0"
                            placeholder="40" value="{{ $settings['service_coupon_cost_bearer']['provider_percentage'] ?? 0 }}">
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