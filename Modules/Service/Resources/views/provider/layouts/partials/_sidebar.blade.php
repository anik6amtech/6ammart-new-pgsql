<?php
$booking = \Modules\Service\Entities\BookingModule\Booking::where('provider_id', \App\CentralLogics\Helpers::get_provider_id())->get();
$maxBookingAmount = (business_config('maximum_booking_amount', 'service_business_settings'))->value;
$subscribed_sub_category_ids = \Modules\Service\Entities\ProviderManagement\SubscribedService::where(['provider_id' => \App\CentralLogics\Helpers::get_provider_id()])->OfStatus(1)->pluck('sub_category_id')->toArray();
$serviceAtProviderPlace = (int)((business_config('service_at_provider_place', 'provider_config'))->live_values ?? 0);
$serviceLocations = getProviderSettings(providerId: \App\CentralLogics\Helpers::get_provider_id(), key: 'service_location', type: 'provider_config') ?? ['customer'];

$pending_booking_count = \Modules\Service\Entities\BookingModule\Booking::providerPendingBookings(\App\CentralLogics\Helpers::get_provider_data(), $maxBookingAmount)
//    ->when($serviceAtProviderPlace == 1, function ($query) use ($serviceLocations) {
//        $query->whereIn('service_location', $serviceLocations);
//    })
    ->whereDoesntHave('ignores', function ($query)  {
        $query->where('provider_id', \App\CentralLogics\Helpers::get_provider_id());
    })

    ->count();
$accepted_booking_count = \Modules\Service\Entities\BookingModule\Booking::providerAcceptedBookings(\App\CentralLogics\Helpers::get_provider_id(), $maxBookingAmount)->count();

$logo = getBusinessSettingsImageFullPath(key: 'business_logo', settingType: 'business_information', path: 'business/',  defaultPath : 'public/assets/admin/img/160x160/img1.jpg');
?>

<div id="sidebarMain" class="d-none">
    <aside
        class="js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-xl navbar-bordered">
        <div class="navbar-vertical-container">
            <div class="navbar-brand-wrapper justify-content-between">
                <!-- Logo -->

                @php($provider_data=\App\CentralLogics\Helpers::get_provider_data())
                <a class="navbar-brand" href="{{route('provider.dashboard')}}" aria-label="Front">
                    <img class="navbar-brand-logo initial--36  onerror-image"  data-onerror-image="{{asset('public/assets/admin/img/160x160/img2.jpg')}}"
                         src="{{ $provider_data->logo_full_path }}" alt="Logo">
                    <img class="navbar-brand-logo-mini initial--36 onerror-image"  data-onerror-image="{{asset('public/assets/admin/img/160x160/img2.jpg')}}"
                         src="{{ $provider_data->logo_full_path }}" alt="Logo">
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
            <div class="navbar-vertical-content text-capitalize bg--005555" id="navbar-vertical-content">
                <form class="sidebar--search-form">
                    <div class="search--form-group">
                        <button type="button" class="btn"><i class="tio-search"></i></button>
                        <input type="text" class="form-control form--control" placeholder="{{ translate('messages.Search Menu...') }}" id="search-sidebar-menu">
                    </div>
                </form>
                <ul class="navbar-nav navbar-nav-lg nav-tabs">
                    <!-- Dashboards -->
                    <li class="navbar-vertical-aside-has-menu {{Request::is('provider/dashboard')?'active':''}}">
                        <a class="js-navbar-vertical-aside-menu-link nav-link"
                            href="{{route('provider.dashboard')}}" title="{{translate('messages.dashboard')}}">
                            <i class="tio-home-vs-1-outlined nav-icon"></i>
                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                {{translate('messages.dashboard')}}
                            </span>
                        </a>
                    </li>
                    <!-- End Dashboards -->

                    @if (\App\CentralLogics\Helpers::provider_employee_module_permission_check('booking'))
                    <!-- Start Booking -->
                    <li class="nav-item">
                        <small class="nav-subtitle" title="{{translate('messages.booking_management')}}">
                            {{translate('messages.booking_management')}}
                        </small>
                        <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                    </li>
                    <li class="navbar-vertical-aside-has-menu {{Request::is('provider/booking*')?'active':''}}">
                        <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:"
                            title="{{translate('messages.bookings')}}">
                            <i class="tio-shopping-cart nav-icon"></i>
                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                               {{translate('messages.bookings')}}
                            </span>
                        </a>
                        <ul class="js-navbar-vertical-aside-submenu nav nav-sub" style="display: {{Request::is('provider/booking*')?'block':'none'}}">
                            @php($bidding_status = (int)((business_config('bidding_system', 'service_business_settings'))->value ?? 0))
                            @if($bidding_status)
                                    <?php
                                    $ignored_posts = \Modules\Service\Entities\BidModule\IgnoredPost::where('provider_id', \App\CentralLogics\Helpers::get_provider_id())->pluck('post_id')->toArray();
                                    $bidding_post_validity = (int)(business_config('post_validation_days', 'service_business_settings'))->value;
                                    $posts = \Modules\Service\Entities\BidModule\Post::where('is_booked', 0)
                                        ->whereNotIn('id', $ignored_posts)
                                        ->whereIn('sub_category_id', $subscribed_sub_category_ids)
                                        ->where('zone_id', \App\CentralLogics\Helpers::get_provider_data()->zone_id)
                                        ->whereBetween('created_at', [Carbon\Carbon::now()->subDays($bidding_post_validity), Carbon\Carbon::now()])
                                        ->when(!request()->user('provider')?->service_availability || \App\CentralLogics\Helpers::get_provider_data()->is_suspended && business_config('provider_suspend_on_exceed_cash_limit', 'service_business_settings')->value, function ($query) {
                                            $query->whereHas('bids', function ($query) {
                                                $query->where('status', 'pending')->where('provider_id', \App\CentralLogics\Helpers::get_provider_id());
                                            });
                                        })
                                        ->get();

                                    foreach ($posts as $key => $post) {
                                        if ($post->bids) {
                                            foreach ($post->bids as $bid) {
                                                if ($bid->status == 'denied') unset($posts[$key]);
                                            }
                                        }
                                    }

                                    $posts = $posts->count();
                                    ?>
                            <li class="nav-item {{request()->is('provider/booking/post') || request()->is('provider/booking/post/details*') ? 'active' : ''}}">
                                <a class="nav-link" href="{{route('provider.service.booking.post.list', ['type'=>'all','service_type'=>'all'])}}" title="{{translate('messages.customized_request')}}">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate sidebar--badge-container">
                                        {{translate('messages.customized_request')}}
                                        <span class="badge badge-soft-info badge-pill ml-1">
                                            {{$posts??0}}
                                        </span>
                                    </span>
                                </a>
                            </li>
                            @endif

                            <li class="nav-item {{request()->is('provider/booking/list') && request()->query('booking_status')=='pending'?'active':''}}">
                                <a class="nav-link " href="{{route('provider.service.booking.list', ['booking_status'=>'pending','service_type'=>'all'])}}" title="{{translate('messages.booking_request')}}">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate sidebar--badge-container">
                                        {{translate('messages.booking_request')}}
                                        <span class="badge badge-soft-info badge-pill ml-1">
                                        {{\Illuminate\Support\Facades\Request::user('provider')?->is_suspended == 0 || !business_config('provider_suspend_on_exceed_cash_limit', 'service_business_settings')->value ? $pending_booking_count : 0}}
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item {{request()->is('provider/booking/list') && request()->query('booking_status')=='accepted'?'active':''}}">
                                <a class="nav-link " href="{{route('provider.service.booking.list', ['booking_status'=>'accepted','service_type'=>'all'])}}" title="{{translate('messages.accepted')}}">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate sidebar--badge-container">
                                        {{translate('messages.accepted')}}
                                        <span class="badge badge-soft-info badge-pill ml-1">
                                            {{$accepted_booking_count}}
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item {{request()->is('provider/booking/list') && request()->query('booking_status')=='ongoing'?'active':''}}">
                                <a class="nav-link " href="{{route('provider.service.booking.list', ['booking_status'=>'ongoing','service_type'=>'all'])}}" title="{{translate('messages.ongoing')}}">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate sidebar--badge-container">
                                        {{translate('messages.ongoing')}}
                                        <span class="badge badge-soft-info badge-pill ml-1">
                                            {{$booking->where('booking_status', 'ongoing')->count()}}
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item {{request()->is('provider/booking/list') && request()->query('booking_status')=='completed'?'active':''}}">
                                <a class="nav-link " href="{{route('provider.service.booking.list', ['booking_status'=>'completed','service_type'=>'all'])}}" title="{{translate('messages.completed')}}">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate sidebar--badge-container">
                                        {{translate('messages.completed')}}
                                        <span class="badge badge-soft-info badge-pill ml-1">
                                            {{$booking->where('booking_status', 'completed')->count()}}
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item {{request()->is('provider/booking/list') && request()->query('booking_status')=='canceled'?'active':''}}">
                                <a class="nav-link " href="{{route('provider.service.booking.list', ['booking_status'=>'canceled','service_type'=>'all'])}}" title="{{translate('messages.canceled')}}">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate sidebar--badge-container">
                                        {{translate('messages.canceled')}}
                                        <span class="badge badge-soft-info badge-pill ml-1">
                                            {{$booking->where('booking_status', 'canceled')->count()}}
                                        </span>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- End Booking -->
                    @endif

                    @if (\App\CentralLogics\Helpers::provider_employee_module_permission_check('help_support'))
                    <!-- Start Chatting -->
                    <li class="nav-item">
                        <small
                            class="nav-subtitle">{{translate('messages.Help & Support')}}</small>
                        <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                    </li>

                    <li class="navbar-vertical-aside-has-menu {{Request::is('provider/message/list*')?'active':''}}">
                        <a class="js-navbar-vertical-aside-menu-link nav-link"
                            href="{{route('provider.service.message.list')}}" title="{{translate('messages.chat')}}"
                        >
                            <i class="tio-chat nav-icon"></i>
                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                {{translate('messages.chat')}}
                            </span>
                        </a>
                    </li>
                    <!-- End chatting -->
                    @endif

                    @if (\App\CentralLogics\Helpers::provider_employee_module_permission_check('promotion'))
                    <!-- Start Promotion Management -->
                    <li class="nav-item">
                        <small class="nav-subtitle" title="{{translate('messages.promotion_management')}}">{{translate('messages.promotion_management')}}</small>
                        <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                    </li>
                    <li class="navbar-vertical-aside-has-menu {{Request::is('provider/advertisement*')?'active':''}}">
                        <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:"
                            title="{{translate('messages.advertisements')}}">
                            <i class="tio-transform-artboard nav-icon"></i>
                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                {{translate('messages.advertisements')}}
                            </span>
                        </a>
                        <ul class="js-navbar-vertical-aside-submenu nav nav-sub" style="display: {{Request::is('provider/advertisement*')?'block':'none'}}">
                            <li class="nav-item {{ (Request::is('provider/advertisement*') && !Request::is('provider/advertisement/create*'))?'active':''}}">
                                <a class="nav-link" href="{{ route('provider.service.advertisement.index') }}" title="{{translate('messages.advertisement_list')}}">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate sidebar--badge-container">
                                        {{translate('messages.advertisement_list')}}
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item {{Request::is('provider/advertisement/create*')?'active':''}}">
                                <a class="nav-link " href="{{ route('provider.service.advertisement.create') }}" title="{{translate('messages.create_new_advertisement')}}">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate sidebar--badge-container">
                                        {{translate('messages.create_new_advertisement')}}
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- End Promotion Management -->
                    @endif

                    @if (\App\CentralLogics\Helpers::provider_employee_module_permission_check('service'))
                    <!-- Start Service Management -->
                    <li class="nav-item">
                        <small class="nav-subtitle">{{translate('messages.service_management')}}</small>
                        <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                    </li>

                    <li class="navbar-vertical-aside-has-menu {{Request::is('provider/service/available*')?'active':''}}">
                        <a class="js-navbar-vertical-aside-menu-link nav-link" href="{{ route('provider.service.service.available') }}" title="{{translate('messages.available_service')}}">
                            <i class="tio-find-replace nav-icon"></i>
                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                {{translate('messages.available_service')}}
                            </span>
                        </a>
                    </li>
                    <li class="navbar-vertical-aside-has-menu {{Request::is('provider/service/subscribed*')?'active':''}}">
                        <a class="js-navbar-vertical-aside-menu-link nav-link" href="{{ route('provider.service.service.subscribed') }}" title="{{translate('messages.my_subscriptions')}}">
                            <i class="tio-subscribe nav-icon"></i>
                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                {{translate('messages.my_subscriptions')}}
                            </span>
                        </a>
                    </li>
                    <li class="navbar-vertical-aside-has-menu {{Request::is('provider/service/request-list*')?'active':''}}">
                        <a class="js-navbar-vertical-aside-menu-link nav-link" href="{{ route('provider.service.service.request-list') }}" title="{{translate('messages.request_service')}}">
                            <i class="tio-send nav-icon"></i>
                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                {{translate('messages.request_service')}}
                            </span>
                        </a>
                    </li>
                    <!-- End Service Management -->
                    @endif

                    @if (\App\CentralLogics\Helpers::provider_employee_module_permission_check('user'))
                    <!-- Start User Management -->
                    <li class="nav-item">
                        <small class="nav-subtitle" title="{{translate('messages.user_management')}}">{{translate('messages.user_management')}}</small>
                        <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                    </li>
                    <li class="navbar-vertical-aside-has-menu {{Request::is('provider/serviceman*')?'active':''}}">
                        <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:"
                            title="{{translate('messages.servicemen')}}">
                            <i class="tio-poi-user nav-icon"></i>
                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                {{translate('messages.servicemen')}}
                            </span>
                        </a>
                        <ul class="js-navbar-vertical-aside-submenu nav nav-sub" style="display: {{Request::is('provider/serviceman*')?'block':'none'}}">
                            <li class="nav-item {{ (Request::is('provider/serviceman*') && !Request::is('provider/serviceman/create')) ?'active':''}}">
                                <a class="nav-link" href="{{ route('provider.service.serviceman.index') }}" title="{{translate('messages.service_man_list')}}">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate sidebar--badge-container">
                                        {{translate('messages.service_man_list')}}
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item {{Request::is('provider/serviceman/create')?'active':''}}">
                                <a class="nav-link " href="{{ route('provider.service.serviceman.create') }}" title="{{translate('messages.add_new_service_man')}}">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate sidebar--badge-container">
                                        {{translate('messages.add_new_service_man')}}
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- End User Management -->
                    @endif

                    @if (\App\CentralLogics\Helpers::provider_employee_module_permission_check('report_analytics'))
                    <!-- Start reports section -->
                    <li class="nav-item">
                        <small
                            class="nav-subtitle">{{translate('messages.Reports & Analytics')}}</small>
                        <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                    </li>

                    <li class="navbar-vertical-aside-has-menu {{Request::is('provider/report/transaction')?'active':''}}">
                        <a class="js-navbar-vertical-aside-menu-link nav-link" href="{{route('provider.service.report.transaction', ['transaction_type'=>'all'])}}" title="{{translate('messages.transaction_reports')}}">
                            <i class="tio-receipt nav-icon"></i>
                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                {{translate('messages.transaction_reports')}}
                            </span>
                        </a>
                    </li>
                    <li class="navbar-vertical-aside-has-menu {{Request::is('provider/report/booking')?'active':''}}">
                        <a class="js-navbar-vertical-aside-menu-link nav-link" href="{{route('provider.service.report.booking')}}" title="{{translate('messages.booking_reports')}}">
                            <i class="tio-money nav-icon"></i>
                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                {{translate('messages.booking_reports')}}
                            </span>
                        </a>
                    </li>
                    <li class="navbar-vertical-aside-has-menu {{Request::is('provider/report/business*')?'active':''}}">
                        <a class="js-navbar-vertical-aside-menu-link nav-link" href="{{route('provider.service.report.business.overview')}}" title="{{translate('messages.business_report')}}">
                            <i class="tio-chart-pie-1 nav-icon"></i>
                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                {{translate('messages.business_report')}}
                            </span>
                        </a>
                    </li>
                    <!-- End report section -->
                    @endif

                    @if (\App\CentralLogics\Helpers::provider_employee_module_permission_check('business'))
                    <!-- Start business section -->
                    <li class="nav-item">
                        <small
                            class="nav-subtitle">{{translate('messages.business_section')}}</small>
                        <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                    </li>

                    <li class="navbar-vertical-aside-has-menu {{Request::is('provider/my-account*')?'active':''}}">
                        <a class="js-navbar-vertical-aside-menu-link nav-link" href="{{ route('provider.service.my.account') }}" title="{{translate('messages.my_account')}}">
                            <i class="tio-account-square nav-icon"></i>
                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                {{translate('messages.my_account')}}
                            </span>
                        </a>
                    </li>
                    <li class="navbar-vertical-aside-has-menu {{Request::is('provider/wallet*')?'active':''}}">
                        <a class="js-navbar-vertical-aside-menu-link nav-link" href="{{route('provider.service.wallet.index')}}" title="{{translate('messages.my_wallet')}}">
                            <i class="tio-wallet nav-icon"></i>
                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                {{translate('messages.my_wallet')}}
                            </span>
                        </a>
                    </li>
                    <li class="navbar-vertical-aside-has-menu {{Request::is('provider/my-reviews*')?'active':''}}">
                        <a class="js-navbar-vertical-aside-menu-link nav-link" href="{{ route('provider.service.my.reviews') }}" title="{{translate('messages.my_reviews')}}">
                            <i class="tio-star nav-icon"></i>
                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                {{translate('messages.my_reviews')}}
                            </span>
                        </a>
                    </li>
                    <li class="navbar-vertical-aside-has-menu {{Request::is('provider/subscription*')?'active':''}}">
                        <a class="js-navbar-vertical-aside-menu-link nav-link" href="{{route('provider.service.subscriptionackage.subscriberDetail')}}" title="{{translate('messages.my_business_plan')}}">
                            <i class="fi-rr-subscription-user nav-icon"></i>
                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                {{translate('messages.my_business_plan')}}
                            </span>
                        </a>
                    </li>
                    <li class="navbar-vertical-aside-has-menu {{Request::is('provider/promotional-costing*')?'active':''}}">
                        <a class="js-navbar-vertical-aside-menu-link nav-link" href="{{route('provider.service.promotional-costing')}}" title="{{translate('messages.promotional_costing')}}">
                            <i class="tio-premium-outlined nav-icon"></i>
                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                {{translate('messages.promotional_costing')}}
                            </span>
                        </a>
                    </li>
                    <li class="navbar-vertical-aside-has-menu {{Request::is('provider/get-notification-setting')?'active':''}}">
                        <a class="js-navbar-vertical-aside-menu-link nav-link" href="{{ route('provider.service.get-notification-setting') }}" title="{{translate('messages.notification_channel')}}">
                            <i class="tio-notifications nav-icon"></i>
                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                {{translate('messages.notification_channel')}}
                            </span>
                        </a>
                    </li>
                    <li class="navbar-vertical-aside-has-menu {{Request::is('provider/business-settings/provider-setup')?'active':''}}">
                        <a class="nav-link " href="{{route('provider.service.business-settings.provider-setup')}}" title="{{translate('messages.Provider Config')}}">
                            <span class="tio-settings nav-icon"></span>
                            <span class="text-truncate">{{translate('messages.Provider Config')}}</span>
                        </a>
                    </li>
                    @endif

                    @if (\App\CentralLogics\Helpers::provider_employee_module_permission_check('employee'))
                        <li class="nav-item">
                            <small class="nav-subtitle"
                                   title="{{ translate('messages.employee_section') }}">{{ translate('messages.employee_section') }}</small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>
                        <li
                            class="navbar-vertical-aside-has-menu {{ Request::is('provider/custom-role*') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link"
                               href="{{ route('provider.service.custom-role.list') }}"
                               title="{{ translate('messages.employee_Role') }}">
                                <i class="tio-incognito nav-icon"></i>
                                <span
                                    class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{ translate('messages.employee_Role') }}</span>
                            </a>
                        </li>
                        <li
                            class="navbar-vertical-aside-has-menu {{ Request::is('provider/employee*') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:"
                               title="{{ translate('messages.employees') }}">
                                <i class="tio-user nav-icon"></i>
                                <span
                                    class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{ translate('messages.employees') }}</span>
                            </a>
                            <ul class="js-navbar-vertical-aside-submenu nav nav-sub">
                                <li class="nav-item {{ Request::is('provider/employee/add-new') ? 'active' : '' }}">
                                    <a class="nav-link " href="{{ route('provider.service.employee.add-new') }}"
                                       title="{{ translate('messages.add_new_Employee') }}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{ translate('messages.add_new') }}</span>
                                    </a>
                                </li>
                                <li class="nav-item {{ Request::is('provider/employee/list') ? 'active' : '' }}">
                                    <a class="nav-link " href="{{ route('provider.service.employee.list') }}"
                                       title="{{ translate('messages.Employee_list') }}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{ translate('messages.list') }}</span>
                                    </a>
                                </li>

                            </ul>
                        </li>
                    @endif

                    {{-- <li class="navbar-vertical-aside-has-menu {{Request::is('provider/service/withdraw-method*')?'active':''}}">
                        <a class="js-navbar-vertical-aside-menu-link nav-link" href="{{route('provider.service.wallet-method.index')}}" title="{{translate('messages.my_wallet')}}">
                            <i class="tio-museum nav-icon"></i>
                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{translate('messages.disbursement_method')}}</span>
                        </a>
                    </li> --}}
                    <!-- End business section -->
                    @if (\App\CentralLogics\Helpers::provider_employee_module_permission_check('promotion'))
                    <li class="nav-item px-20 pb-5">
                        <div class="promo-card">
                            <div class="position-relative">
                                <img src="{{asset('public/assets/admin/img/promo-2.png')}}" class="mw-100" alt="">
                                <h4 class="mb-2 mt-3">{{ translate('Want_to_get_highlighted?') }}</h4>
                                <p class="mb-4">
                                    {{ translate('Create_ads_to_get_highlighted_on_the_app_and_web_browser') }}
                                </p>
                                <a href="{{ route('provider.service.advertisement.create') }}" class="btn btn--primary">{{ translate('Create_Ads') }}</a>
                            </div>
                        </div>
                    </li>
                    @endif
                </ul>
            </div>
            <!-- End Content -->
        </div>
    </aside>
</div>

<div id="sidebarCompact" class="d-none">

</div>

@push('script_2')
<script>
    $(window).on('load' , function() {
        if($(".navbar-vertical-content li.active").length) {
            $('.navbar-vertical-content').animate({
                scrollTop: $(".navbar-vertical-content li.active").offset().top - 150
            }, 10);
        }
    });

    var $rows = $('#navbar-vertical-content li');
    $('#search-sidebar-menu').keyup(function() {
        var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();

        $rows.show().filter(function() {
            var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
            return !~text.indexOf(val);
        }).hide();
    });
</script>
@endpush
