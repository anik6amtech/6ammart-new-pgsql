<?php
$booking = \Modules\Service\Entities\BookingModule\Booking::get();
$max_booking_amount = (business_config('maximum_booking_amount'))->value ?? 0;
$pending_booking_count = \Modules\Service\Entities\BookingModule\Booking::where('booking_status', 'pending')
    ->when($max_booking_amount > 0, function ($query) use ($max_booking_amount) {
        $query->where(function ($query) use ($max_booking_amount) {
            $query->where('payment_method', 'cash_after_service')
                ->where(function ($query) use ($max_booking_amount) {
                    $query->where('is_verified', 1)
                        ->orWhere('total_booking_amount', '<=', $max_booking_amount);
                })
                ->orWhere('payment_method', '<>', 'cash_after_service');
        });
    })
    ->count();

$offline_booking_count = \Modules\Service\Entities\BookingModule\Booking::whereIn('booking_status', ['pending', 'accepted'])
    ->where('payment_method', 'offline_payment')->where('is_paid', 0)->count();

$accepted_booking_count = \Modules\Service\Entities\BookingModule\Booking::where('booking_status', 'accepted')
    ->when($max_booking_amount > 0, function ($query) use ($max_booking_amount) {
        $query->where(function ($query) use ($max_booking_amount) {
            $query->where('payment_method', 'cash_after_service')
                ->where(function ($query) use ($max_booking_amount) {
                    $query->where('is_verified', 1)
                        ->orWhere('total_booking_amount', '<=', $max_booking_amount);
                })
                ->orWhere('payment_method', '<>', 'cash_after_service');
        });
    })
    ->count();
$pending_providers = \Modules\Service\Entities\ProviderManagement\Provider::ofApproval(2)->count();
$denied_providers = \Modules\Service\Entities\ProviderManagement\Provider::ofApproval(0)->count();
?>

<div id="sidebarMain" class="d-none">
    <aside class="js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-xl navbar-bordered  ">
        <div class="navbar-vertical-container">
            <div class="navbar-brand-wrapper justify-content-between">
                <!-- Logo -->
                @php($store_logo = \App\Models\BusinessSetting::where(['key' => 'logo'])->first())
                <a class="navbar-brand" href="{{ route('admin.dispatch.dashboard') }}" aria-label="Front">
                       <img class="navbar-brand-logo initial--36 onerror-image onerror-image" data-onerror-image="{{ asset('public/assets/admin/img/160x160/img2.jpg') }}"
                    src="{{\App\CentralLogics\Helpers::get_full_url('business', $store_logo?->value?? '', $store_logo?->storage[0]?->value ?? 'public','favicon')}}"
                    alt="Logo">
                    <img class="navbar-brand-logo-mini initial--36 onerror-image onerror-image" data-onerror-image="{{ asset('public/assets/admin/img/160x160/img2.jpg') }}"
                    src="{{\App\CentralLogics\Helpers::get_full_url('business', $store_logo?->value?? '', $store_logo?->storage[0]?->value ?? 'public','favicon')}}"
                    alt="Logo">
                </a>
                <!-- End Logo -->

                <!-- Navbar Vertical Toggle -->
                <button type="button" class="js-navbar-vertical-aside-toggle-invoker navbar-vertical-aside-toggle btn btn-icon btn-xs btn-ghost-dark">
                    <i class="tio-clear tio-lg"></i>
                </button>
                <!-- End Navbar Vertical Toggle -->

                <div class="navbar-nav-wrap-content-left">
                    <!-- Navbar Vertical Toggle -->
                    <button type="button" class="js-navbar-vertical-aside-toggle-invoker close">
                        <i class="tio-first-page navbar-vertical-aside-toggle-short-align" data-toggle="tooltip"
                        data-placement="right" title="Collapse"></i>
                        <i class="tio-last-page navbar-vertical-aside-toggle-full-align"
                        data-template='<div class="tooltip d-none d-sm-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'></i>
                    </button>
                    <!-- End Navbar Vertical Toggle -->
                </div>

            </div>

            <!-- Content -->
            <div class="navbar-vertical-content bg--005555" id="navbar-vertical-content">
                <form autocomplete="off"   class="sidebar--search-form">
                    <div class="search--form-group">
                        <button type="button" class="btn"><i class="tio-search"></i></button>
                        <input  autocomplete="false" name="qq" type="text" class="form-control form--control" placeholder="{{ translate('Search Menu...') }}" id="search">

                        <div id="search-suggestions" class="flex-wrap mt-1"></div>
                    </div>
                </form>

                <ul class="navbar-nav navbar-nav-lg nav-tabs">
                    <!-- Dashboards -->
                    <li class="navbar-vertical-aside-has-menu @yield('dashboard') {{ Request::is('admin/service') ? 'active' : '' }}">
                        <a class="js-navbar-vertical-aside-menu-link nav-link" href="{{ route('admin.dashboard') }}?module_id={{Config::get('module.current_module_id')}}" title="{{ translate('messages.dashboard') }}">
                            <i class="tio-home-vs-1-outlined nav-icon"></i>
                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                {{ translate('messages.dashboard') }}
                            </span>
                        </a>
                    </li>
                    <!-- End Dashboards -->
                    @if (\App\CentralLogics\Helpers::module_permission_check('booking'))
                        <li class="nav-item">
                            <small class="nav-subtitle" title="{{translate('messages.booking_management')}}">
                                {{translate('messages.booking_management')}}
                            </small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>
                        <li class="navbar-vertical-aside-has-menu {{Request::is('admin/service/booking*')?'active':''}}">
                        <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:"
                           title="{{translate('messages.bookings')}}">
                            <i class="tio-shopping-cart nav-icon"></i>
                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                               {{translate('messages.bookings')}}
                            </span>
                        </a>
                        <ul class="js-navbar-vertical-aside-submenu nav nav-sub" style="display: {{Request::is('admin/service/booking*')?'block':'none'}}">
                            @php($bidding_status = (int)((business_config('bidding_system', 'service_business_settings'))->value ?? 0))
                            @if($bidding_status)
                                <li class="nav-item {{request()->is('admin/service/booking/post*') ? 'active' : ''}}">
                                    <a class="nav-link" href="{{route('admin.service.booking.post.list', ['type'=>'all','service_type'=>'all'])}}" title="{{translate('messages.customized_request')}}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate sidebar--badge-container">
                                        {{translate('messages.customized_request')}}
                                         <span class="badge badge-soft-info badge-pill ml-1">
                                            {{\Modules\Service\Entities\BidModule\Post::where('is_booked', 0)->count()??0}}
                                        </span>
                                    </span>
                                    </a>
                                </li>
                            @endif

                            <li class="nav-item {{request()->is('admin/service/booking/list/verification') && request()->query('booking_status')=='pending'?'active':''}}">
                                <a class="nav-link " href="{{route('admin.service.booking.list.verification', ['booking_status'=>'pending','type'=>'pending'])}}" title="{{translate('messages.booking_request')}}">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate sidebar--badge-container">
                                        {{translate('messages.verify_requests')}}
                                        <span class="badge badge-soft-info badge-pill ml-1">
                                            {{\Modules\Service\Entities\BookingModule\Booking::where('is_verified', '0')->where('payment_method', 'cash_after_service')->Where('total_booking_amount', '>', $max_booking_amount)->whereIn('booking_status', ['pending', 'accepted'])->count()}}
                                        </span>
                                    </span>
                                </a>
                            </li>

                            <li class="nav-item {{request()->is('admin/service/booking/list') && request()->query('booking_status')=='pending'?'active':''}}">
                                <a class="nav-link " href="{{route('admin.service.booking.list', ['booking_status'=>'pending','service_type'=>'all'])}}" title="{{translate('messages.booking_request')}}">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate sidebar--badge-container">
                                        {{translate('messages.booking_request')}}
                                        <span class="badge badge-soft-info badge-pill ml-1">
                                            {{ $pending_booking_count }}
                                        </span>
                                    </span>
                                </a>
                            </li>

                            <li class="nav-item {{request()->is('admin/service/booking/list/offline-payment') && request()->query('booking_status')=='pending'?'active':''}}">
                                <a class="nav-link " href="{{route('admin.service.booking.offline.payment', ['booking_status'=>'pending','service_type'=>'all'])}}" title="{{translate('messages.Offline Payment List')}}">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate sidebar--badge-container">
                                        {{translate('messages.Offline Payment List')}}
                                        <span class="badge badge-soft-info badge-pill ml-1">
                                            {{ $offline_booking_count }}
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item {{request()->is('admin/service/booking/list') && request()->query('booking_status')=='accepted'?'active':''}}">
                                <a class="nav-link " href="{{route('admin.service.booking.list', ['booking_status'=>'accepted','service_type'=>'all'])}}" title="{{translate('messages.accepted')}}">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate sidebar--badge-container">
                                        {{translate('messages.accepted')}}
                                        <span class="badge badge-soft-info badge-pill ml-1">
                                            {{ $accepted_booking_count }}
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item {{request()->is('admin/service/booking/list') && request()->query('booking_status')=='ongoing'?'active':''}}">
                                <a class="nav-link " href="{{route('admin.service.booking.list', ['booking_status'=>'ongoing','service_type'=>'all'])}}" title="{{translate('messages.ongoing')}}">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate sidebar--badge-container">
                                        {{translate('messages.ongoing')}}
                                        <span class="badge badge-soft-info badge-pill ml-1">
                                            {{ $booking->where('booking_status', 'ongoing')->count() }}
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item {{request()->is('admin/service/booking/list') && request()->query('booking_status')=='completed'?'active':''}}">
                                <a class="nav-link " href="{{route('admin.service.booking.list', ['booking_status'=>'completed','service_type'=>'all'])}}" title="{{translate('messages.completed')}}">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate sidebar--badge-container">
                                        {{translate('messages.completed')}}
                                        <span class="badge badge-soft-info badge-pill ml-1">
                                            {{ $booking->where('booking_status', 'completed')->count() }}
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item {{request()->is('admin/service/booking/list') && request()->query('booking_status')=='canceled'?'active':''}}">
                                <a class="nav-link " href="{{route('admin.service.booking.list', ['booking_status'=>'canceled','service_type'=>'all'])}}" title="{{translate('messages.canceled')}}">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate sidebar--badge-container">
                                        {{translate('messages.canceled')}}
                                        <span class="badge badge-soft-info badge-pill ml-1">
                                            {{ $booking->where('booking_status', 'canceled')->count() }}
                                        </span>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endif

                    @if (\App\CentralLogics\Helpers::module_permission_check('service_provider'))
                         <!-- Provider section -->
                        <li class="nav-item">
                            <small class="nav-subtitle" title="{{ translate('Provider Management') }}">{{ translate('Provider Management') }}</small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>
                        <!-- Provider -->
                         <li class="navbar-vertical-aside-has-menu {{ Request::is('admin/service/provider/onboarding/request*') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link" href="{{ route('admin.service.provider.onboarding_request') }}" title="{{ translate('messages.onboarding_requests') }}">
                                <i class="tio-user-add nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{ translate('messages.onboarding_requests') }}</span>
                                <span class="badge badge-soft-info badge-pill ml-1">
                                    {{ $pending_providers + $denied_providers }}
                                </span>
                            </a>
                        </li>
                        <li class="navbar-vertical-aside-has-menu {{ (Request::is('admin/service/provider*') && !Request::is('admin/service/provider/onboarding/request*')) ? 'active' : '' }}">
                        <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:" title="{{ translate('messages.providers') }}">
                            <i class="tio-group-equal nav-icon"></i>
                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate text-capitalize">{{ translate('messages.providers') }}</span>
                        </a>
                        <ul class="js-navbar-vertical-aside-submenu nav nav-sub" style="display:{{ (Request::is('admin/service/provider*') && !Request::is('admin/service/provider/onboarding/request*')) ? 'block' : 'none' }}">
                            <li class="nav-item {{ Request::is('admin/service/provider/create')  ? 'active' : '' }}">
                                <a class="nav-link " href="{{ route('admin.service.provider.create') }}" title="{{ translate('messages.add_new_provider') }}">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate">{{ translate('messages.add_new_provider') }}</span>
                                </a>
                            </li>
                            <li class="nav-item {{ (Request::is('admin/service/provider*') && (!Request::is('admin/service/provider/create')) && (!Request::is('admin/service/provider/onboarding/request*')))  ? 'active' : '' }}">
                                <a class="nav-link " href="{{ route('admin.service.provider.list') }}" title="{{ translate('messages.provider_list') }}">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate">{{ translate('messages.provider_list') }}</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endif

                    @if (\App\CentralLogics\Helpers::module_permission_check('service_promotion'))
                        <!-- Marketing section -->
                        <li class="nav-item">
                            <small class="nav-subtitle" title="{{ translate('Promotion Management') }}">{{ translate('Promotion Management') }}</small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>

                        <!-- Banner -->
                        <li class="navbar-vertical-aside-has-menu {{ Request::is('admin/service/banner*') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link" href="{{ route('admin.service.banner.create') }}" title="{{ translate('messages.banners') }}">
                                <i class="tio-image nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{ translate('messages.banners') }}</span>
                            </a>
                        </li>
                        <!-- Coupon -->
                        <li class="navbar-vertical-aside-has-menu {{ Request::is('admin/service/coupon*') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:" title="{{ translate('messages.coupons') }}">
                                <i class="tio-gift nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate text-capitalize">{{ translate('messages.coupons') }}</span>
                            </a>
                            <ul class="js-navbar-vertical-aside-submenu nav nav-sub" style="display:{{ Request::is('admin/service/coupon*') ? 'block' : 'none' }}">
                                <li class="nav-item {{ Request::is('admin/service/coupon/create')  ? 'active' : '' }}">
                                    <a class="nav-link " href="{{ route('admin.service.coupon.create') }}" title="{{ translate('messages.add_new_coupon') }}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{ translate('messages.add_new_coupon') }}</span>
                                    </a>
                                </li>
                                <li class="nav-item {{ (Request::is('admin/service/coupon*') && (!Request::is('admin/service/coupon/create')))  ? 'active' : '' }}">
                                    <a class="nav-link " href="{{ route('admin.service.coupon.list') }}" title="{{ translate('messages.coupon_list') }}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{ translate('messages.coupon_list') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- Discount -->
                         <li class="navbar-vertical-aside-has-menu {{ Request::is('admin/service/discount*') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:" title="{{ translate('messages.discounts') }}">
                                <i class="tio-discover nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate text-capitalize">{{ translate('messages.discounts') }}</span>
                            </a>
                            <ul class="js-navbar-vertical-aside-submenu nav nav-sub" style="display:{{ Request::is('admin/service/discount*') ? 'block' : 'none' }}">
                                <li class="nav-item {{ Request::is('admin/service/discount/create')  ? 'active' : '' }}">
                                    <a class="nav-link " href="{{ route('admin.service.discount.create') }}" title="{{ translate('messages.add_new_discount') }}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{ translate('messages.add_new_discount') }}</span>
                                    </a>
                                </li>
                                <li class="nav-item {{ (Request::is('admin/service/discount*') && (!Request::is('admin/service/discount/create')))  ? 'active' : '' }}">
                                    <a class="nav-link " href="{{ route('admin.service.discount.list') }}" title="{{ translate('messages.discount_list') }}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{ translate('messages.discount_list') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- Campaign -->
                         <li class="navbar-vertical-aside-has-menu {{ Request::is('admin/service/campaign*') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:" title="{{ translate('messages.campaigns') }}">
                                <i class="tio-premium nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate text-capitalize">{{ translate('messages.campaigns') }}</span>
                            </a>
                            <ul class="js-navbar-vertical-aside-submenu nav nav-sub" style="display:{{ Request::is('admin/service/campaign*') ? 'block' : 'none' }}">
                                <li class="nav-item {{ Request::is('admin/service/campaign/create')  ? 'active' : '' }}">
                                    <a class="nav-link " href="{{ route('admin.service.campaign.create') }}" title="{{ translate('messages.add_new_campaign') }}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{ translate('messages.add_new_campaign') }}</span>
                                    </a>
                                </li>
                                <li class="nav-item {{ (Request::is('admin/service/campaign*') && (!Request::is('admin/service/campaign/create')))  ? 'active' : '' }}">
                                    <a class="nav-link " href="{{ route('admin.service.campaign.list') }}" title="{{ translate('messages.campaign_list') }}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{ translate('messages.campaign_list') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- Notification -->
                        @if (\App\CentralLogics\Helpers::module_permission_check('notification'))
                        <li class="navbar-vertical-aside-has-menu {{ Request::is('admin/notification*') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link" href="{{ route('admin.notification.add-new') }}" title="{{ translate('messages.push_notification') }}">
                                <i class="tio-notifications nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    {{ translate('messages.push_notification') }}
                                </span>
                            </a>
                        </li>
                        @endif
                        <!-- Advertisement -->
                        <li class="navbar-vertical-aside-has-menu  @yield('advertisement')">
                            <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:"
                                title="{{ translate('messages.advertisement') }}">
                                <i class="tio-tv-old nav-icon"></i>
                                <span
                                    class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{ translate('messages.advertisement') }}</span>
                            </a>
                            <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                style="display: {{ Request::is('admin/service/advertisement*') ? 'block' : 'none' }}">

                                <li class="nav-item @yield('advertisement_create')">
                                    <a class="nav-link " href="{{ route('admin.service.advertisement.create') }}"
                                        title="{{ translate('messages.New_Advertisement') }}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{ translate('messages.New_Advertisement') }}</span>
                                    </a>
                                </li>
                                <li class="nav-item @yield('advertisement_request')">
                                    <a class="nav-link " href="{{ route('admin.service.advertisement.requestList') }}"
                                        title="{{ translate('messages.Ad_Requests') }}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{ translate('messages.Ad_Requests') }}</span>
                                    </a>
                                </li>
                                <li class="nav-item @yield('advertisement_list')">
                                    <a class="nav-link " href="{{ route('admin.service.advertisement.index') }}"
                                        title="{{ translate('messages.Ads_list') }}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{ translate('messages.Ads_list') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif

                    @if (\App\CentralLogics\Helpers::module_permission_check('service'))
                        <!-- Service Section -->
                        <li class="nav-item">
                            <small class="nav-subtitle" title="{{ translate('Service Management') }}">{{ translate('Service Management') }}</small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>

                        <!-- Category -->
                        <li class="navbar-vertical-aside-has-menu {{ (Request::is('admin/service/category/*') || Request::is('admin/service/sub-category/*')) ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:" title="{{ translate('Categories') }}">
                                <i class="tio-category nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate text-capitalize">{{ translate('Categories') }}</span>
                            </a>
                            <ul class="js-navbar-vertical-aside-submenu nav nav-sub" style="display:{{ Request::is('admin/service/category/*') || Request::is('admin/service/sub-category/*') ? 'block' : 'none' }}">
                                <li class="nav-item {{ Request::is('admin/service/category*') ? 'active' : '' }}">
                                    <a class="nav-link " href="{{ route('admin.service.category.create') }}" title="{{ translate('messages.category_setup') }}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{ translate('messages.category_setup') }}</span>
                                    </a>
                                </li>
                                <li class="nav-item {{ Request::is('admin/service/sub-category*')  ? 'active' : '' }}">
                                    <a class="nav-link " href="{{ route('admin.service.sub-category.create') }}" title="{{ translate('messages.sub_category_setup') }}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{ translate('messages.sub_category_setup') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Service -->
                        <li class="navbar-vertical-aside-has-menu {{ Request::is('admin/service/service/*') ? 'active' : '' }}">
                        <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:" title="{{ translate('Service') }}">
                            <i class="tio-stroke-weight nav-icon"></i>
                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate text-capitalize">{{ translate('Service') }}</span>
                        </a>
                        <ul class="js-navbar-vertical-aside-submenu nav nav-sub" style="display:{{ Request::is('admin/service/service/*') ? 'block' : 'none' }}">
                            <li class="nav-item {{ Request::is('admin/service/service/create')  ? 'active' : '' }}">
                                <a class="nav-link " href="{{ route('admin.service.service.create') }}" title="{{ translate('messages.add_new_service') }}">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate">{{ translate('messages.add_new_service') }}</span>
                                </a>
                            </li>
                            <li class="nav-item {{ (Request::is('admin/service/service/list*') && (!Request::is('admin/service/service/create')))  ? 'active' : '' }}">
                                <a class="nav-link " href="{{ route('admin.service.service.index') }}" title="{{ translate('messages.service_list') }}">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate">{{ translate('messages.service_list') }}</span>
                                </a>
                            </li>
                            <li class="nav-item {{ (Request::is('admin/service/service/request/list*') ? 'active' : '') }}">
                                <a class="nav-link " href="{{ route('admin.service.service.request.list') }}" title="{{ translate('messages.new_service_request') }}">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate">{{ translate('messages.new_service_request') }}</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endif




                    {{-- @if (\App\CentralLogics\Helpers::module_permission_check('download_app'))
                        <li class="nav-item">
                            <small class="nav-subtitle" title="{{ translate('messages.Download_Apps') }}">{{ translate('Download_Apps') }}</small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>
                        <li class="navbar-vertical-aside-has-menu {{Request::is('admin/rental/settings*')?'active':''}}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link " href="{{route('admin.rental.settings.down_app')}}" title="{{translate('Download_Apps')}}">
                                <i class="tio-shopping-basket-outlined nav-icon"></i>
                                <span class="text-truncate">{{translate('Download_Apps')}}</span>
                            </a>
                        </li>
                    @endif --}}

                <li class="nav-item py-5">

                </li>


                <li class="__sidebar-hs-unfold px-2" id="tourb-9">
                    <div class="hs-unfold w-100">
                        <a class="js-hs-unfold-invoker navbar-dropdown-account-wrapper" href="javascript:;"
                            data-hs-unfold-options='{
                                    "target": "#accountNavbarDropdown",
                                    "type": "css-animation"
                                }'>
                            <div class="cmn--media right-dropdown-icon d-flex align-items-center">
                                <div class="avatar avatar-sm avatar-circle">
                                   <img class="avatar-img onerror-image"
                                    data-onerror-image="{{asset('public/assets/admin/img/160x160/img1.jpg')}}"

                                    src="{{auth('admin')->user()?->toArray()['image_full_url']}}"

                                    alt="Image Description">
                                    <span class="avatar-status avatar-sm-status avatar-status-success"></span>
                                </div>
                                <div class="media-body pl-3">
                                    <span class="card-title h5">
                                        {{auth('admin')->user()->f_name}}
                                        {{auth('admin')->user()->l_name}}
                                    </span>
                                    <span class="card-text">{{auth('admin')->user()->email}}</span>
                                </div>
                            </div>
                        </a>

                        <div id="accountNavbarDropdown"
                                class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-right navbar-dropdown-menu navbar-dropdown-account min--240">
                            <div class="dropdown-item-text">
                                <div class="media align-items-center">
                                    <div class="avatar avatar-sm avatar-circle mr-2">
                                        <img class="avatar-img onerror-image"
                                    data-onerror-image="{{asset('public/assets/admin/img/160x160/img1.jpg')}}"

                                    src="{{auth('admin')->user()?->toArray()['image_full_url']}}"

                                    alt="Image Description">
                                    </div>
                                    <div class="media-body">
                                        <span class="card-title h5">{{auth('admin')->user()->f_name}}</span>
                                        <span class="card-text">{{auth('admin')->user()->email}}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item" href="{{route('admin.settings')}}">
                                <span class="text-truncate pr-2" title="Settings">{{translate('messages.settings')}}</span>
                            </a>

                            <div class="dropdown-divider"></div>

                           <a class="dropdown-item log-out" href="javascript:">
                                <span class="text-truncate pr-2" title="Sign out">{{translate('messages.sign_out')}}</span>
                            </a>
                        </div>
                    </div>
                </li>
                </ul>
            </div>
            <!-- End Content -->
        </div>
    </aside>
</div>

<div id="sidebarCompact" class="d-none">

</div>


@push('script_2')

<script src="{{ asset('Modules/Rental/public/assets/js/admin/view-pages/rental-sidebar.js') }}"></script>

@endpush
