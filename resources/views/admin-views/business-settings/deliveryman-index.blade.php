@extends('layouts.admin.app')

@section('title', translate('messages.delivery_man_settings'))


@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-header-title mr-3">
                <span class="page-header-icon">
                    <img src="{{ asset('public/assets/admin/img/business.png') }}" class="w--26" alt="">
                </span>
                <span>
                    {{translate('business_setup')}}
                </span>
            </h1>
            @include('admin-views.business-settings.partials.nav-menu')
        </div>
        <!-- Page Header -->

        <!-- End Page Header -->
        <form action="{{ route('admin.business-settings.update-dm') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row g-2">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-sm-6 col-lg-4">
                                    @php($dm_tips_status = \App\Models\BusinessSetting::where('key', 'dm_tips_status')->first())
                                    @php($dm_tips_status = $dm_tips_status ? $dm_tips_status->value : 'deliveryman')
                                    <div class="form-group mb-0">

                                        <label
                                            class="toggle-switch h--45px toggle-switch-sm d-flex justify-content-between border rounded px-3 py-0 form-control">
                                            <span class="pr-1 d-flex align-items-center switch--label">
                                                <span class="line--limit-1">
                                                    {{ translate('messages.Tips_for_Rider') }}
                                                </span>
                                                <span class="form-label-secondary text-danger d-flex"
                                                    data-toggle="tooltip" data-placement="right"
                                                    data-original-title="{{ translate('messages.Customer will have an option to  give tips to rider during checkout from the customer app & website. Admin has no commission over this tip. This feature is not available for service and rental module.') }}"><img
                                                        src="{{ asset('/public/assets/admin/img/info-circle.svg') }}"
                                                        alt="{{ translate('messages.dm_tips_model_hint') }}"> * </span>
                                            </span>
                                            <input type="checkbox"
                                                   data-id="dm_tips_status"
                                                   data-type="toggle"
                                                   data-image-on="{{ asset('/public/assets/admin/img/modal/dm-tips-on.png') }}"
                                                   data-image-off="{{ asset('/public/assets/admin/img/modal/dm-tips-off.png') }}"
                                                   data-title-on="{{ translate('messages.Want_to_enable') }} <strong>{{ translate('messages.Tips_for_Rider_feature?') }}</strong>"
                                                   data-title-off="{{ translate('messages.Want_to_disable') }} <strong>{{ translate('messages.Tips_for_Rider_feature?') }}</strong>"
                                                   data-text-on="<p>{{ translate('messages.If_you_enable_this,_Customers_can_give_tips_to_a_rider_during_checkout.') }}</p>"
                                                   data-text-off="<p>{{ translate('messages.If_you_disable_this,_the_Tips_for_Rider_feature_will_be_hidden_from_the_Customer_App_and_Website.') }}</p>"
                                                   class="status toggle-switch-input dynamic-checkbox-toggle"
                                                    value="1"
                                                name="dm_tips_status" id="dm_tips_status"
                                                {{ $dm_tips_status == '1' ? 'checked' : '' }}>
                                            <span class="toggle-switch-label text">
                                                <span class="toggle-switch-indicator"></span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-4">
                                    @php($show_dm_earning = \App\Models\BusinessSetting::where('key', 'show_dm_earning')->first())
                                    @php($show_dm_earning = $show_dm_earning ? $show_dm_earning->value : 0)
                                    <div class="form-group mb-0">

                                        <label
                                            class="toggle-switch h--45px toggle-switch-sm d-flex justify-content-between border rounded px-3 py-0 form-control">
                                            <span class="pr-1 d-flex align-items-center switch--label">
                                                <span class="line--limit-1">
                                                    {{ translate('Show Earnings in App') }}
                                                </span>
                                                <span class="form-label-secondary text-danger d-flex"
                                                    data-toggle="tooltip" data-placement="right"
                                                    data-original-title="{{ translate('messages.With this feature, deliverymen can view their earnings for a specific order before accepting it. This option applies only to orders, not to rides.') }}"><img
                                                        src="{{ asset('/public/assets/admin/img/info-circle.svg') }}"
                                                        alt="{{ translate('messages.customer_verification_toggle') }}"> *
                                                </span>
                                            </span>
                                            <input type="checkbox"
                                                   data-id="show_dm_earning"
                                                   data-type="toggle"
                                                   data-image-on="{{ asset('/public/assets/admin/img/modal/show-earning-in-apps-on.png') }}"
                                                   data-image-off="{{ asset('/public/assets/admin/img/modal/show-earning-in-apps-off.png') }}"
                                                   data-title-on="{{ translate('messages.Want_to_enable') }} <strong>{{ translate('messages.Show_Earnings_in_App?') }}</strong>"
                                                   data-title-off="{{ translate('messages.Want_to_disable') }} <strong>{{ translate('messages.Show_Earnings_in_App?') }}</strong>"
                                                   data-text-on="<p>{{ translate('messages.If_you_enable_this,_Deliverymen_can_see_their_earning_per_order_request_from_the_Order_Details_page_in_the_Deliveryman_App.') }}</p>"
                                                   data-text-off="<p>{{ translate('messages.If_you_disable_this,_the_feature_will_be_hidden_from_the_Deliveryman_App.') }}</p>"
                                                   class="status toggle-switch-input dynamic-checkbox-toggle"

                                                   value="1"
                                                name="show_dm_earning" id="show_dm_earning"
                                                {{ $show_dm_earning == 1 ? 'checked' : '' }}>
                                            <span class="toggle-switch-label text">
                                                <span class="toggle-switch-indicator"></span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-4">
                                    @php($dm_self_registration = \App\Models\BusinessSetting::where('key', 'toggle_dm_registration')->first())
                                    {{-- {{ dd($dm_self_registration) }} --}}
                                    @php($dm_self_registration = $dm_self_registration ? $dm_self_registration->value : 0)
                                    <div class="form-group mb-0">

                                        <label
                                            class="toggle-switch h--45px toggle-switch-sm d-flex justify-content-between border rounded px-3 py-0 form-control">
                                            <span class="pr-1 d-flex align-items-center switch--label">
                                                <span class="line--limit-1">
                                                    {{ translate('messages.rider_self_registration') }}
                                                </span>
                                                <span class="form-label-secondary text-danger d-flex"
                                                    data-toggle="tooltip" data-placement="right"
                                                    data-original-title="{{ translate('messages.With this feature, riders can register via the Customer App, Website, Rider App, or Admin Landing Page. The admin receives an email notification and can accept or reject the request. This feature is not available for the service module.') }}"><img
                                                        src="{{ asset('/public/assets/admin/img/info-circle.svg') }}"
                                                        alt="{{ translate('messages.dm_self_registration') }}"> * </span>
                                            </span>
                                            <input type="checkbox"
                                                   data-id="dm_self_registration1"
                                                   data-type="toggle"
                                                   data-image-on="{{ asset('/public/assets/admin/img/modal/dm-self-reg-on.png') }}"
                                                   data-image-off="{{ asset('/public/assets/admin/img/modal/dm-self-reg-off.png') }}"
                                                   data-title-on="{{ translate('messages.Want_to_enable') }} <strong>{{ translate('messages.Rider_Self_Registration?') }}</strong>"
                                                   data-title-off="{{ translate('messages.Want_to_disable') }} <strong>{{ translate('messages.Rider_Self_Registration?') }}</strong>"
                                                   data-text-on="<p>{{ translate('messages.If_you_enable_this,_users_can_register_as_Riders_from_the_Customer_App,_Website_or_Rider_App_or_Admin_Landing_Page.') }}</p>"
                                                   data-text-off="<p>{{ translate('messages.If_you_disable_this,_this_feature_will_be_hidden_from_the_Customer_App,_Website_or_Rider_App_or_Admin_Landing_Page.') }}</p>"
                                                   class="status toggle-switch-input dynamic-checkbox-toggle"

                                                   value="1"
                                                name="dm_self_registration" id="dm_self_registration1"
                                                {{ $dm_self_registration == 1 ? 'checked' : '' }}>
                                            <span class="toggle-switch-label text">
                                                <span class="toggle-switch-indicator"></span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-4">
                                    @php($dm_maximum_orders = \App\Models\BusinessSetting::where('key', 'dm_maximum_orders')->first())
                                    <div class="form-group mb-0">
                                        <label class="form-label text-capitalize"
                                            for="dm_maximum_orders">
                                            <div class="d-flex align-items-center">
                                                <span class="line--limit-1 flex-grow">{{ translate('Maximum Assigned Order Limit') }} </span> <small
                                                class="text-danger d-flex align-items-center mt-1"> *<span class="form-label-secondary"
                                                    data-toggle="tooltip" data-placement="right"
                                                    data-original-title="{{ translate('messages.Set_the_maximum_order_limit_a_Deliveryman_can_take_at_a_time. This feature applies only to orders, not to rides or trips.') }}"><img
                                                        src="{{ asset('/public/assets/admin/img/info-circle.svg') }}"
                                                        alt="{{ translate('messages.dm_maximum_order_hint') }}"></span>
                                                </small>
                                            </div>
                                        </label>
                                        <input type="number" name="dm_maximum_orders" class="form-control"
                                            id="dm_maximum_orders" min="1"
                                            value="{{ $dm_maximum_orders ? $dm_maximum_orders->value : 1 }}" required>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-4">
                                    @php($canceled_by_deliveryman = \App\Models\BusinessSetting::where('key', 'canceled_by_deliveryman')->first())
                                    @php($canceled_by_deliveryman = $canceled_by_deliveryman ? $canceled_by_deliveryman->value : 0)
                                    <div class="form-group mb-0">
                                        <label class="input-label text-capitalize d-flex align-items-center"><span
                                                class="line--limit-1">{{ translate('messages.Can_A_Rider_Cancel_Order?') }}</span>
                                            <span class="form-label-secondary"
                                            data-toggle="tooltip" data-placement="right"
                                            data-original-title="{{ translate('messages.Admin_can_enable/disable_Rider’s_order_cancellation_option_in_the_respective_app. This feature applies only to orders, not to rides or trips.') }}"><img
                                                src="{{ asset('/public/assets/admin/img/info-circle.svg') }}"
                                                alt="{{ translate('messages.dm_cancel_order_hint') }}"></span></label>
                                        <div class="resturant-type-group border">
                                            <label class="form-check form--check mr-2 mr-md-4">
                                                <input class="form-check-input" type="radio" value="1"
                                                    name="canceled_by_deliveryman" id="canceled_by_deliveryman"
                                                    {{ $canceled_by_deliveryman == 1 ? 'checked' : '' }}>
                                                <span class="form-check-label">
                                                    {{ translate('yes') }}
                                                </span>
                                            </label>
                                            <label class="form-check form--check mr-2 mr-md-4">
                                                <input class="form-check-input" type="radio" value="0"
                                                    name="canceled_by_deliveryman" id="canceled_by_deliveryman2"
                                                    {{ $canceled_by_deliveryman == 0 ? 'checked' : '' }}>
                                                <span class="form-check-label">
                                                    {{ translate('no') }}
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-4 mt-5">
                                    @php($dm_picture_upload_status = \App\Models\BusinessSetting::where('key', 'dm_picture_upload_status')->first())
                                    @php($dm_picture_upload_status = $dm_picture_upload_status ? $dm_picture_upload_status->value : 0)

                                    <div class="form-group mb-0">
                                        <label
                                            class="toggle-switch h--45px toggle-switch-sm d-flex justify-content-between border rounded px-3 py-0 form-control">
                                            <span class="pr-1 d-flex align-items-center switch--label">
                                                <span class="line--limit-1">
                                                    {{ translate('messages.Take_Picture_For_Completing_Delivery') }}
                                                </span>
                                                <span class="form-label-secondary text-danger d-flex"
                                                    data-toggle="tooltip" data-placement="right"
                                                    data-original-title="{{ translate('messages.If_enabled,_deliverymen_will_see_an_option_to_take_pictures_of_the_delivered_products_when_he_swipes_the_delivery_confirmation_slide. This feature applies only to orders, not to rides or trips.') }}"><img
                                                        src="{{ asset('/public/assets/admin/img/info-circle.svg') }}"
                                                        alt="{{ translate('messages.dm_picture_upload_status') }}"> * </span>
                                            </span>
                                            <input type="checkbox"
                                                   data-id="dm_picture_upload_status"
                                                   data-type="toggle"
                                                   data-image-on="{{ asset('/public/assets/admin/img/modal/dm-self-reg-on.png') }}"
                                                   data-image-off="{{ asset('/public/assets/admin/img/modal/dm-self-reg-off.png') }}"
                                                   data-title-on="{{ translate('messages.Want_to_enable') }} <strong>{{ translate('messages.picture_upload_before_complete?') }}</strong>"
                                                   data-title-off="{{ translate('messages.Want_to_disable') }} <strong>{{ translate('messages.picture_upload_before_complete?') }}</strong>"
                                                   data-text-on="<p>{{ translate('messages.If_you_enable_this,_delivery_man_can_upload_order_proof_before_order_delivery.') }}</p>"
                                                   data-text-off="<p>{{ translate('messages.If_you_disable_this,_this_feature_will_be_hidden_from_the_delivery_man_app.') }}</p>"
                                                   class="status toggle-switch-input dynamic-checkbox-toggle"
                                                   value="1"
                                                name="dm_picture_upload_status" id="dm_picture_upload_status"
                                                {{ $dm_picture_upload_status == 1 ? 'checked' : '' }}>
                                            <span class="toggle-switch-label text">
                                                <span class="toggle-switch-indicator"></span>
                                            </span>
                                        </label>
                                    </div>
                                </div>




                                <div class="col-sm-6 col-lg-4">
                                    @php($cash_in_hand_overflow = \App\Models\BusinessSetting::where('key', 'cash_in_hand_overflow_delivery_man')->first())
                                    @php($cash_in_hand_overflow = $cash_in_hand_overflow ? $cash_in_hand_overflow->value : 0)
                                    <div class="form-label  mb-0 ">
                                        <label>&nbsp;</label>
                                        <label
                                            class="toggle-switch h--45px toggle-switch-sm d-flex justify-content-between border rounded px-3 py-0 form-control">
                                            <span class="pr-1 d-flex align-items-center switch--label">
                                                <span class="line--limit-1">
                                                    {{ translate('messages.Cash_In_Hand_Overflow') }}
                                                </span>
                                                <span class="form-label-secondary text-danger d-flex"
                                                      data-toggle="tooltip" data-placement="right"
                                                      data-original-title="{{ translate('If_enabled,_delivery_men_will_be_automatically_suspended_by_the_system_when_their_‘Cash_in_Hand’_limit_is_exceeded. This feature applies only to orders, not to rides or trips.') }}"><img
                                                        src="{{ asset('/public/assets/admin/img/info-circle.svg') }}"
                                                        alt="{{ translate('messages.cash_in_hand_overflow') }}"> *
                                                </span>
                                            </span>
                                            <input type="checkbox"
                                                   data-id="cash_in_hand_overflow"
                                                   data-type="toggle"
                                                   data-image-on="{{ asset('/public/assets/admin/img/modal/show-earning-in-apps-on.png') }}"
                                                   data-image-off="{{ asset('/public/assets/admin/img/modal/show-earning-in-apps-off.png') }}"
                                                   data-title-on="{{ translate('Want_to_enable') }} <strong>{{ translate('Cash_In_Hand_Overflow') }}</strong>?"
                                                   data-title-off="{{ translate('Want_to_disable') }} <strong>{{ translate('Cash_In_Hand_Overflow') }}</strong>?"
                                                   data-text-on="<p>{{ translate('If_enabled,_delivery_men_have_to_provide_collected_cash_by_themselves.') }}</p>"
                                                   data-text-off="<p>{{ translate('If_disabled,_delivery_men_do_not_have_to_provide_collected_cash_by_themselves.') }}</p>"
                                                   class="status toggle-switch-input dynamic-checkbox-toggle"
                                                   value="1"
                                                   name="cash_in_hand_overflow_delivery_man" id="cash_in_hand_overflow"
                                                {{ $cash_in_hand_overflow == 1 ? 'checked' : '' }}>
                                            <span class="toggle-switch-label text">
                                                <span class="toggle-switch-indicator"></span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-4">
                                    @php($dm_max_cash_in_hand = \App\Models\BusinessSetting::where('key', 'dm_max_cash_in_hand')->first())
                                    <div class="form-label mb-0">
                                        <label class="d-flex text-capitalize"
                                               for="dm_max_cash_in_hand">
                                            <span class="line--limit-1">
                                                {{translate('Rider_Maximum_Cash_in_Hand')}} ({{ \App\CentralLogics\Helpers::currency_symbol() }})
                                            </span>
                                            <span data-toggle="tooltip" data-placement="right" data-original-title="{{translate('Deliveryman_can_not_accept_any_orders_when_the_Cash_In_Hand_limit_exceeds_and_must_deposit_the_amount_to_the_admin_before_accepting_new_orders. This feature applies only to orders, not to rides or trips.')}}" class="input-label-secondary"><img src="{{ asset('/public/assets/admin/img/info-circle.svg') }}" alt="{{ translate('messages.dm_maximum_order_hint') }}"></span>
                                        </label>
                                        <input type="number" name="dm_max_cash_in_hand" class="form-control"
                                               id="dm_max_cash_in_hand" min="0" step=".001"
                                               value="{{ $dm_max_cash_in_hand ? $dm_max_cash_in_hand->value : '' }}" {{ $cash_in_hand_overflow  == 1 ? 'required' : 'readonly' }} >
                                    </div>
                                </div>



                                <div class="col-sm-6 col-lg-4">
                                    @php($min_amount_to_pay_dm = \App\Models\BusinessSetting::where('key', 'min_amount_to_pay_dm')->first())
                                    <div class="form-label mb-0">
                                        <label class="text-capitalize"
                                               for="min_amount_to_pay_dm">
                                            <span>
                                                {{ translate('Minimum_Amount_To_Pay') }} ({{ \App\CentralLogics\Helpers::currency_symbol() }})

                                            </span>

                                            <span class="form-label-secondary"
                                                  data-toggle="tooltip" data-placement="right"
                                                  data-original-title="{{ translate('Enter_the_minimum_cash_amount_delivery_men_can_pay. This feature applies only to orders, not to rides or trips.') }}"><img
                                                    src="{{ asset('/public/assets/admin/img/info-circle.svg') }}"
                                                    alt="{{ translate('messages.dm_cancel_order_hint') }}"></span>
                                        </label>
                                        <input type="number" name="min_amount_to_pay_dm" class="form-control"
                                               id="min_amount_to_pay_dm" min="0" step=".001"
                                               value="{{ $min_amount_to_pay_dm ? $min_amount_to_pay_dm->value : '' }}"  {{ $cash_in_hand_overflow  == 1 ? 'required' : 'readonly' }} >
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>




                    <div class="card mb-4 mt-4">
                        <div class="card-header">
                            <h4 class="text--title font-bold mb-0 d-flex gap-2 align-items-center lh-1">
                                {{ translate('messages.loyalty_point') }}
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row g-4">
                                <div class="col-sm-6 col-lg-6">
                                    @php($dm_loyalty_point_status = \App\Models\BusinessSetting::where('key', 'dm_loyalty_point_status')->first())
                                    @php($dm_loyalty_point_status = $dm_loyalty_point_status ? $dm_loyalty_point_status->value : 0)
                                    <div class="form-label  mb-0 ">
                                        <label>&nbsp;</label>
                                        <label
                                            class="toggle-switch h--45px toggle-switch-sm d-flex justify-content-between border rounded px-3 py-0 form-control">
                                            <span class="pr-1 d-flex align-items-center switch--label">
                                                <span class="line--limit-1">
                                                    {{ translate('Rider Can Earn Loyalty Point') }}
                                                </span>
                                            </span>
                                            <input type="checkbox"
                                                   data-id="dm_loyalty_point_status"
                                                   data-type="toggle"
                                                   data-image-on="{{ asset('/public/assets/admin/img/modal/loyalty-on.png') }}"
                                                   data-image-off="{{ asset('/public/assets/admin/img/modal/loyalty-off.png') }}"
                                                   data-title-on="{{ translate('messages.Want_to_enable') }} <strong>{{ translate('Rider Loyalty Points') }}</strong>"
                                                   data-title-off="{{ translate('messages.Want_to_disable') }} <strong>{{ translate('Rider Loyalty Points') }}</strong>"
                                                   data-text-on="<p>{{ translate(' If enabled, riders will earn loyalty points for each completed order.') }}</p>"
                                                   data-text-off="<p>{{ translate(' If disabled, riders will not earn loyalty points for each completed order.') }}</p>"
                                                   class="status toggle-switch-input dynamic-checkbox-toggle"
                                                   value="1"
                                                   name="dm_loyalty_point_status" id="dm_loyalty_point_status"
                                                {{ $dm_loyalty_point_status == 1 ? 'checked' : '' }}>
                                            <span class="toggle-switch-label text">
                                                <span class="toggle-switch-indicator"></span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-6">
                                    @php($dm_loyalty_point_exchange_rate = \App\Models\BusinessSetting::where('key', 'dm_loyalty_point_exchange_rate')->first())
                                    <div class="form-label mb-0">
                                        <label class="d-flex text-capitalize"
                                               for="dm_loyalty_point_exchange_rate">
                                            <span class="line--limit-1">1
                                                {{ \App\CentralLogics\Helpers::currency_code() }}
                                                {{ translate('equivalent point amount') }}
                                            </span>
                                        </label>
                                        <input type="number" name="dm_loyalty_point_exchange_rate" class="form-control"
                                               id="dm_loyalty_point_exchange_rate" min="0" step=".001"
                                               value="{{ $dm_loyalty_point_exchange_rate ? $dm_loyalty_point_exchange_rate->value : '' }}"
                                               {{-- {{ $dm_loyalty_point_status  == 1 ? 'required' : 'readonly' }}  --}}
                                               >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (addon_published_status('RideShare'))
                        <div class="card mb-4">
                            <div class="card-header">
                                <h4 class="text--title font-bold mb-0">
                                    {{ translate('messages.Rider_Setup') }}
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <div class="form-group mb-0">
                                            <label class="toggle-switch toggle-switch-sm d-flex justify-content-between border rounded px-3 form-control">
                                                <span class="pr-1 d-flex align-items-center"><span class="line--limit-1">{{ translate('messages.rider_can_review_customer') }}</span>
                                                    <span class="form-label-secondary" data-toggle="tooltip" data-placement="right"
                                                        data-original-title="If enabled, riders can rate and review customers after completing a ride. This feature applies only to rides, not to orders or trips.">
                                                        <img src="{{ asset('public/assets/admin/img/info-circle.svg') }}" alt="">
                                                    </span>
                                                </span>
                                                <input type="checkbox"
                                                    data-id="driver_can_review_customer"
                                                    data-type="toggle"
                                                    data-image-on="{{ asset('/public/assets/admin/img/modal/loyalty-on.png') }}"
                                                    data-image-off="{{ asset('/public/assets/admin/img/modal/loyalty-off.png') }}"
                                                        data-title-on="{{ translate('messages.Want_to_enable') }} <strong>{{ translate('Rider Review') }}</strong>"
                                                        data-title-off="{{ translate('messages.Want_to_disable') }} <strong>{{ translate('Rider Review') }}</strong>"
                                                        data-text-on="<p>{{ translate('If enabled, riders can rate and review customers after completing an order.') }}</p>"
                                                        data-text-off="<p>{{ translate('If disable, riders can not rate and review customers after completing an order.') }}</p>"
                                                    class="status toggle-switch-input dynamic-checkbox-toggle"
                                                    value="1"
                                                    name="driver_can_review_customer" id="driver_can_review_customer"
                                                    {{ ($settings->firstWhere('key', 'driver_can_review_customer')?->value ?? 0) == 1 ? 'checked' : '' }}>
                                                <span class="toggle-switch-label text">
                                                    <span class="toggle-switch-indicator"></span>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-0">
                                            <label class="toggle-switch toggle-switch-sm d-flex justify-content-between border rounded px-3 form-control">
                                                <span class="pr-1 d-flex align-items-center"><span class="line--limit-1">{{ translate('messages.active_rider_level') }}</span>
                                                    <span class="form-label-secondary" data-toggle="tooltip" data-placement="right"
                                                        data-original-title="When enabled, riders will be assigned to levels based on their performance metrics, such as completed orders and ratings. This feature applies only to rides, not to orders or trips.">
                                                        <img src="{{ asset('public/assets/admin/img/info-circle.svg') }}" alt="">
                                                    </span>
                                                </span>
                                                    <input type="checkbox"
                                                    data-id="rider_level_feature_status"
                                                    data-type="toggle"
                                                    data-image-on="{{ asset('/public/assets/admin/img/modal/loyalty-on.png') }}"
                                                    data-image-off="{{ asset('/public/assets/admin/img/modal/loyalty-off.png') }}"
                                                        data-title-on="{{ translate('messages.Want_to_enable') }} <strong>{{ translate('Rider Level') }}</strong>"
                                                        data-title-off="{{ translate('messages.Want_to_disable') }} <strong>{{ translate('Rider Level') }}</strong>"
                                                        data-text-on="<p>{{ translate('When enabled, riders will be assigned to levels based on their performance metrics, such as completed orders and ratings.') }}</p>"
                                                        data-text-off="<p>{{ translate('When disabled, riders will not be assigned to levels based on their performance metrics, such as completed orders and ratings.') }}</p>"
                                                    class="status toggle-switch-input dynamic-checkbox-toggle"
                                                    value="1"
                                                    name="rider_level_feature_status" id="rider_level_feature_status"
                                                    {{ ($settings->firstWhere('key', 'rider_level_feature_status')?->value ?? 0) == 1 ? 'checked' : '' }}>
                                                <span class="toggle-switch-label text">
                                                    <span class="toggle-switch-indicator"></span>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                {{--<div class="card border-0 mt-3 __bg-FAFAFA">
                                    <div class="card-header __bg-FAFAFA">
                                        <div class="w-100">
                                            <label class="toggle-switch toggle-switch-sm d-flex justify-content-between">
                                                <span class="pr-1 d-flex align-items-center fs-16 font-semibold text--title">
                                                    <span
                                                        class="line--limit-1">{{ translate('messages.Update_Vehicle') }}
                                                    </span>
                                                </span>

                                                <input type="checkbox"
                                                    data-id="update_vehicle_approval_status"
                                                    data-type="toggle"
                                                    data-image-on="{{ asset('/public/assets/admin/img/modal/loyalty-on.png') }}"
                                                    data-image-off="{{ asset('/public/assets/admin/img/modal/loyalty-off.png') }}"
                                                        data-title-on="{{ translate('messages.Want_to_enable') }} <strong>{{ translate('Loyalty Point') }}</strong>"
                                                        data-title-off="{{ translate('messages.Want_to_disable') }} <strong>{{ translate('Loyalty Point') }}</strong>"
                                                        data-text-on="<p>{{ translate('Rider will see loyalty point option in his profile settings & can earn & convert this point to wallet money') }}</p>"
                                                        data-text-off="<p>{{ translate('Rider will not see loyalty point option from his profile settings') }}</p>"
                                                    class="status toggle-switch-input dynamic-checkbox-toggle"
                                                    value="1"
                                                    name="update_vehicle_approval_status" id="update_vehicle_approval_status"
                                                    {{ ($settings->firstWhere('key', 'update_vehicle_approval_status')?->value ?? 0) == 1 ? 'checked' : '' }}>
                                                <span class="toggle-switch-label text">
                                                    <span class="toggle-switch-indicator"></span>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between flex-wrap gap-3">
                                            @foreach(UPDATE_VEHICLE as $updateVehicle)
                                                <div class="form-check form-check-inline ">
                                                    <input class="form-check-input mx-2" type="checkbox" value="{{$updateVehicle}}" {{ in_array($updateVehicle, json_decode($settings->firstWhere('key','update_vehicle_approval')?->value ?? '[]', true) ?? [], true) ? "checked" : "" }}
                                                    name="update_vehicle_approval[]">
                                                    <label class=" form-check-label"> {{translate($updateVehicle)}}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>--}}
                            </div>
                        </div>
                        <div class="card mt-2">
                            <div class="card-header card-header-shadow">
                                <h5 class="card-title">
                                    <img src="{{ asset('/public/assets/admin/img/loyalty.png') }}" alt=""
                                        class="card-header-icon align-self-center mr-1">
                                    <span>
                                        {{ translate('Setup_Rider_Referral_Earning') }}
                                    </span>
                                    <span class="form-label-secondary text-danger d-flex"
                                          data-toggle="tooltip" data-placement="right"
                                          data-original-title="{{ translate('messages.The  Refer & Earn feature is available only for the  ride-sharing module.
Riders can use and share their referral code from app . Deliverymen who register only as delivery personnel will not see this feature in the Rider App.') }}"><img
                                            src="{{ asset('/public/assets/admin/img/info-circle.svg') }}"
                                            alt="{{ translate('messages.dm_self_registration') }}"></span>
                                </h5>
                                <label
                                    class="toggle-switch h--45px toggle-switch-sm rounded px-3 py-0">
                                    <input type="checkbox"
                                            class="status toggle-switch-input"
                                            value="1"
                                            name="driver_referral_earning_status" id="driver_referral_earning_status"
                                            {{ ($settings->firstWhere('key', 'driver_referral_earning_status')?->value ?? 0) == 1 ? 'checked' : '' }}>

                                    <span class="toggle-switch-label text">
                                        <span class="toggle-switch-indicator"></span>
                                    </span>
                                </label>
                            </div>
                            <div class="card-body" id="referral-earning-body">
                                <div class="py-2">
                                    <div class="row g-3 align-items-end">

                                        <div class="align-self-center  col-4">
                                            <div class="text-left">
                                                <h4 class="align-items-center">
                                                    <img src="{{ asset('/public/assets/admin/img/referral.png') }}"
                                                        alt="" class="card-header-icon align-self-center mr-1">
                                                    <span>
                                                        {{ translate('Who_Share_the_code') }}
                                                    </span>
                                                </h4>
                                                <p>
                                                    {{ translate('Set_the_reward_for_the_rider_who_is_sharing_the_code_with_friends_&_family_to_refer_the_app.') }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <div class="card __bg-F8F9FC-card text-left">
                                                <div class="card-body">
                                                    <div class="form-group mb-0">
                                                        <label class="input-label" for="driver_share_code_earning">
                                                            {{ translate('Earning Per Referral') }}
                                                            ({{ \App\CentralLogics\Helpers::currency_code() }})
                                                        </label>
                                                        <input {{ ($settings->firstWhere('key', 'driver_referral_earning_status')?->value ?? 0) == 1 ? '' : 'readonly' }}
                                                        id="driver_share_code_earning" type="number" step=".001" min="0" max="99999999999"
                                                            class="form-control" name="driver_share_code_earning"
                                                            value="{{ $settings->firstWhere('key', 'driver_share_code_earning')?->value ?? '0' }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row g-3 align-items-end">
                                        <div class="align-self-center col-4 text-center">
                                            <div class="text-left">

                                                <h4 class="align-items-center">
                                                    <img src="{{ asset('/public/assets/admin/img/Who_Use_the_code.png') }}"
                                                        alt="" class="card-header-icon align-self-center mr-1">
                                                    <span>
                                                        {{ translate('Who_Use_the_code') }}
                                                    </span>
                                                </h4>
                                                <p>
                                                    {{ translate('Set_up_the_reward_that_the_rider_will_receive_when_using_the_refer_code_in_signup.') }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <div class="card __bg-F8F9FC-card text-left">
                                                <div class="card-body">
                                                    <div class="form-group mb-0">
                                                        <label class="input-label" for="driver_use_code_earning">
                                                            {{ translate('Bonus_In_Wallet') }}
                                                            ({{ \App\CentralLogics\Helpers::currency_code() }})
                                                        </label>
                                                        <input {{ ($settings->firstWhere('key', 'driver_referral_earning_status')?->value ?? 0) == 1 ? '' : 'readonly' }}
                                                        id="driver_use_code_earning" type="number" step=".001" min="0" max="99999999999"
                                                            class="form-control" name="driver_use_code_earning"
                                                            value="{{ $settings->firstWhere('key', 'driver_use_code_earning')?->value ?? '0' }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="btn--container justify-content-end mt-5">
                        <button type="reset" id="reset_btn" class="btn btn--reset location-reload">{{ translate('messages.reset') }}</button>
                        <button type="submit" id="submit" class="btn btn--primary">{{ translate('messages.save_information') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('script_2')
<script>
    // Form validation for vehicle approval
    $(document).ready(function() {
        $('form').on('submit', function(e) {
            const isApprovalRequired = $('#update_vehicle_approval_status').is(':checked');
            const hasApprovalChecked = $('input[name="update_vehicle_approval[]"]:checked').length > 0;

            if (isApprovalRequired && !hasApprovalChecked) {
                e.preventDefault();
                toastr.error('{{ translate("Please select at least one vehicle approval option") }}');
                $('html, body').animate({
                    scrollTop: $('#update_vehicle_approval_status').offset().top - 200
                }, 500);
                return false;
            }
            return true;
        });
    });

    function toggleReferralEarningBody() {
        if ($('#driver_referral_earning_status').is(':checked')) {
            $('#referral-earning-body').show();
            $('#referral-earning-body').find('input, select, textarea').prop('readonly', false);

        } else {
            $('#referral-earning-body').hide();
            $('#referral-earning-body').find('input, select, textarea').prop('readonly', true);

        }
    }

    $(document).ready(function () {
        toggleReferralEarningBody();
        $(document).on('change', '#driver_referral_earning_status', function () {
            toggleReferralEarningBody();
        });
    });

    // $(document).ready(function() {
    //     $('#update_vehicle_approval_status').on('click', function() {
    //         var featureId = $(this).data('id');
    //         var status = $(this).is(':checked') ? 1 : 0;
    //
    //         console.log('Feature ID:', featureId, 'Status:', status);
    //         $('input[name="update_vehicle_approval[]"]').each(function() {
    //             $(this).prop('checked', status);
    //         });
    //
    //         var updateValues = [];
    //         $('input[name="update_vehicle_approval[]"]:checked').each(function() {
    //             updateValues.push($(this).val());
    //         });
    //     });
    // });
</script>
@endpush
