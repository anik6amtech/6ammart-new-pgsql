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
                    <li class="navbar-vertical-aside-has-menu @yield('dashboard') {{ Request::is('admin/ride-share') ? 'show active' : '' }}">
                        <a class="js-navbar-vertical-aside-menu-link nav-link" href="{{ route('admin.dashboard') }}?module_id={{Config::get('module.current_module_id')}}" title="{{ translate('messages.dashboard') }}">
                            <i class="tio-home-vs-1-outlined nav-icon"></i>
                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                {{ translate('messages.dashboard') }}
                            </span>
                        </a>
                    </li>
                    @if (\App\CentralLogics\Helpers::module_permission_check('heat_map'))
                    <li class="navbar-vertical-aside-has-menu {{ Request::is('admin/ride-share/heat-map*') ? 'show active' : '' }}">
                        <a class="js-navbar-vertical-aside-menu-link nav-link" href="{{ route('admin.ride-share.heat-map') }}" title="{{ translate('messages.heat_map') }}">
                            <i class="tio-machu-picchu nav-icon"></i>
                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                {{ translate('messages.heat_map') }}
                            </span>
                        </a>
                    </li>
                    @endif

                    @if (\App\CentralLogics\Helpers::module_permission_check('fleet_view'))
                    <li class="navbar-vertical-aside-has-menu {{ Request::is('admin/ride-share/fleet-map/*') ? 'show active' : '' }}">
                        <a class="js-navbar-vertical-aside-menu-link nav-link" href="{{ route('admin.ride-share.fleet-map.fleet-map', 'all-driver') }}" title="{{ translate('messages.fleet_view') }}">
                            <i class="tio-map nav-icon"></i>
                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                {{ translate('messages.fleet_view') }}
                            </span>
                        </a>
                    </li>
                    <!-- End Dashboards -->
                    @endif

                    @if (\App\CentralLogics\Helpers::module_permission_check('ride'))
                    <li class="nav-item">
                        <small class="nav-subtitle">{{ translate('messages.Ride_management') }}</small>
                        <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                    </li>

                    <li class="navbar-vertical-aside-has-menu {{ Request::is('admin/ride-share/ride*') ? 'active' : '' }}">
                        <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:" title="{{ translate('messages.Trips') }}">
                            <i class="tio-taxi nav-icon"></i>
                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                {{ translate('messages.Rides') }}
                            </span>
                        </a>
                        <ul class="js-navbar-vertical-aside-submenu nav nav-sub" style="display:{{ Request::is('admin/ride-share/ride*') ? 'block' : 'none' }}">
                            <li class="nav-item {{ Request::is('admin/ride-share/ride/list/all*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.ride-share.ride.index', 'all') }}" title="{{ translate('messages.all_rides') }}">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate sidebar--badge-container">
                                        {{ translate('messages.all_ride') }}
                                        <span class="badge badge-soft-info badge-pill ml-1">
                                            {{ \Modules\RideShare\Entities\TripManagement\RideRequest::count() }}
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item {{ Request::is('admin/ride-share/ride/list/pending*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.ride-share.ride.index', 'pending') }}" title="{{ translate('messages.pending') }}">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate sidebar--badge-container">
                                        {{ translate('messages.pending') }}
                                        <span class="badge badge-soft-info badge-pill ml-1">
                                            {{ \Modules\RideShare\Entities\TripManagement\RideRequest::status('pending')->count() }}
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item {{ Request::is('admin/ride-share/ride/list/accepted*') ? 'active' : '' }}">
                                <a class="nav-link " href="{{ route('admin.ride-share.ride.index', 'accepted') }}" title="{{ translate('messages.accepted_rides') }}">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate sidebar--badge-container">
                                        {{ translate('messages.accepted') }}
                                        <span class="badge badge-soft-info badge-pill ml-1">
                                            {{ \Modules\RideShare\Entities\TripManagement\RideRequest::status('accepted')->count() }}
                                        </span>
                                    </span>
                                </a>
                            </li>

                            <li class="nav-item {{ Request::is('admin/ride-share/ride/list/ongoing*') ? 'active' : '' }}">
                                <a class="nav-link " href="{{ route('admin.ride-share.ride.index', 'ongoing') }}" title="{{ translate('messages.ongoing_rides') }}">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate sidebar--badge-container">
                                        {{ translate('messages.ongoing') }}
                                        <span class="badge badge-soft-info badge-pill ml-1">
                                            {{ \Modules\RideShare\Entities\TripManagement\RideRequest::status('ongoing')->count() }}
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item {{ Request::is('admin/ride-share/ride/list/completed*') ? 'active' : '' }}">
                                <a class="nav-link " href="{{ route('admin.ride-share.ride.index', 'completed') }}" title="{{ translate('messages.Completed_rides') }}">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate sidebar--badge-container">
                                        {{ translate('messages.Completed') }}
                                        <span class="badge badge-soft-info badge-pill ml-1">
                                            {{ \Modules\RideShare\Entities\TripManagement\RideRequest::status('completed')->count() }}
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item {{ Request::is('admin/ride-share/ride/list/cancelled*') ? 'active' : '' }}">
                                <a class="nav-link " href="{{ route('admin.ride-share.ride.index', 'cancelled') }}" title="{{ translate('messages.cancelled_rides') }}">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate sidebar--badge-container">
                                        {{ translate('messages.cancelled') }}
                                        <span class="badge badge-soft-danger  badge-pill ml-1">
                                            {{ \Modules\RideShare\Entities\TripManagement\RideRequest::status('cancelled')->count() }}
                                        </span>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="navbar-vertical-aside-has-menu {{ Request::is('admin/ride-share/safety-alert/list/*') ? 'show active' : '' }}">
                        <a class="js-navbar-vertical-aside-menu-link nav-link" href="{{ route('admin.ride-share.safety-alert.index', 'customer') }}" title="{{ translate('messages.Solved Alert List') }}">
                            <i class="tio-verified nav-icon"></i>
                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                {{ translate('messages.Solved Alert List') }}
                            </span>
                        </a>
                    </li>
                    @endif

                    @if (\App\CentralLogics\Helpers::module_permission_check('ride_promotion'))
                        <!-- Marketing section -->
                        <li class="nav-item">
                            <small class="nav-subtitle" title="{{ translate('Promotion Management') }}">{{ translate('Promotion Management') }}</small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>

                        <!-- Banner -->
                        <li class="navbar-vertical-aside-has-menu {{ Request::is('admin/ride-share/promotion/banner-setup*') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link" href="{{ route('admin.ride-share.promotion.banner-setup.index') }}" title="{{ translate('messages.banners') }}">
                                <i class="tio-image nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{ translate('messages.banners') }}</span>
                            </a>
                        </li>
                        <!-- Coupon -->
                        <li class="navbar-vertical-aside-has-menu {{ Request::is('admin/ride-share/promotion/coupon*') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:" title="{{ translate('Coupon Setup') }}">
                                <i class="tio-gift nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate text-capitalize">{{ translate('Coupon Setup') }}</span>
                            </a>
                            <ul class="js-navbar-vertical-aside-submenu nav nav-sub" style="display:{{ Request::is('admin/ride-share/promotion/coupon*') ? 'block' : 'none' }}">
                                <li class="nav-item {{ Request::is('admin/ride-share/promotion/coupon-setup/create') ? 'active' : '' }}">
                                    <a class="nav-link " href="{{ route('admin.ride-share.promotion.coupon-setup.create') }}" title="{{ translate('messages.create_new') }}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{ translate('messages.create_new') }}</span>
                                    </a>
                                </li>
                                <li class="nav-item {{ Request::is('admin/ride-share/promotion/coupon-setup/list')  ||Request::is('admin/ride-share/promotion/coupon-setup/update/*') ||Request::is('admin/ride-share/promotion/coupon-setup/details/*') || Request::is('admin/ride-share/promotion/coupon-setup/edit/*')  ? 'active' : '' }}">
                                    <a class="nav-link " href="{{ route('admin.ride-share.promotion.coupon-setup.index') }}" title="{{ translate('messages.coupon_list') }}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{ translate('messages.list') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- End Coupon -->
                        <!-- Discount -->
                        <li class="navbar-vertical-aside-has-menu {{ Request::is('admin/ride-share/promotion/discount*') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:" title="{{ translate('Discount Setup') }}">
                                <i class="tio-ticket nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate text-capitalize">{{ translate('Discount Setup') }}</span>
                            </a>
                            <ul class="js-navbar-vertical-aside-submenu nav nav-sub" style="display:{{ Request::is('admin/ride-share/promotion/discount*') ? 'block' : 'none' }}">
                                <li class="nav-item {{ Request::is('admin/ride-share/promotion/discount-setup/create') ? 'active' : '' }}">
                                    <a class="nav-link " href="{{ route('admin.ride-share.promotion.discount-setup.create') }}" title="{{ translate('messages.create_new') }}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{ translate('messages.create_new') }}</span>
                                    </a>
                                </li>
                                <li class="nav-item {{ Request::is('admin/ride-share/promotion/discount-setup/list')  ||Request::is('admin/ride-share/promotion/discount-setup/update/*') ||Request::is('admin/ride-share/promotion/discount-setup/details/*') || Request::is('admin/ride-share/promotion/discount-setup/edit/*')  ? 'active' : '' }}">
                                    <a class="nav-link " href="{{ route('admin.ride-share.promotion.discount-setup.index') }}" title="{{ translate('messages.coupon_list') }}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{ translate('messages.list') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        {{-- <!-- End Discount -->
                         <li class="navbar-vertical-aside-has-menu {{ Request::is('admin/rental/cashback*') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link" href="{{ route('admin.rental.cashback.list') }}" title="{{ translate('messages.cashback') }}">
                                <i class="tio-settings-back nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{ translate('messages.cashback') }}</span>
                            </a>
                        </li>
                        <!-- Notification -->
                        <li class="navbar-vertical-aside-has-menu {{ Request::is('admin/rental/notification*') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link" href="{{ route('admin.rental.notification.list') }}" title="{{ translate('messages.push_notification') }}">
                                <i class="tio-notifications nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    {{ translate('messages.push_notification') }}
                                </span>
                            </a>
                        </li>
                        <!-- End Notification --> --}}
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
                    @endif

                    {{-- @if (\App\CentralLogics\Helpers::module_permission_check('vehicle'))
                        <li class="nav-item">
                            <small class="nav-subtitle" title="{{ translate('messages.vehicle_section') }}">{{ translate('messages.vehicle_management') }}</small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>
                        <li class="navbar-vertical-aside-has-menu {{ Request::is('admin/ride-share/vehicle/attribute-setup') || Request::is('admin/ride-share/vehicle/attribute-setup*') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link" href="{{ route('admin.ride-share.vehicle.attribute-setup.brand.index') }}" title="{{ translate('messages.vehicle_attribute_setup') }}">
                                <i class="tio-car nav-icon"></i>
                                <span class="text-truncate position-relative overflow-visible">
                                    {{ translate('messages.vehicle_attribute_setup') }}
                                </span>
                            </a>
                        </li>
                        <li class="navbar-vertical-aside-has-menu {{ Request::is('admin/rental/brand/list') || Request::is('admin/rental/brand/edit*') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link" href="{{ route('admin.rental.brand.list') }}" title="{{ translate('messages.brands') }}">
                                <i class="tio-medal nav-icon"></i>
                                <span class="text-truncate position-relative overflow-visible">
                                    {{ translate('messages.brands') }}
                                </span>
                            </a>
                        </li>
                        <li class="navbar-vertical-aside-has-menu {{ Request::is('admin/rental/provider/vehicle*') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:" title="{{ translate('Vehicle Setup') }}">
                                <i class="tio-car nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate text-capitalize">{{ translate('Vehicle Setup') }}</span>
                            </a>
                            <ul class="js-navbar-vertical-aside-submenu nav nav-sub" style="display:{{ Request::is('admin/rental/provider/vehicle*') ? 'block' : 'none' }}">
                                <li class="nav-item {{ Request::is('admin/rental/provider/vehicle/create') || Request::is('admin/rental/provider/vehicle/edit/*')  ? 'active' : '' }}">
                                    <a class="nav-link " href="{{ route('admin.rental.provider.vehicle.create') }}" title="{{ translate('messages.create_new') }}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{ translate('messages.create_new') }}</span>
                                    </a>
                                </li>
                                <li class="nav-item {{ Request::is('admin/rental/provider/vehicle/list')  ||Request::is('admin/rental/provider/vehicle/update/*') ||Request::is('admin/rental/provider/vehicle/details/*') || Request::is('admin/rental/provider/vehicle/edit/*')  ? 'active' : '' }}">
                                    <a class="nav-link " href="{{ route('admin.rental.provider.vehicle.list') }}" title="{{ translate('messages.vehicle_list') }}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{ translate('messages.list') }}</span>
                                    </a>
                                </li>
                                <li class="nav-item {{ Request::is('admin/rental/provider/vehicle/review-list') ? 'active' : '' }}">
                                    <a class="nav-link " href="{{ route('admin.rental.provider.vehicle.reviews') }}" title="{{ translate('messages.review_list') }}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{ translate('messages.review') }}</span>
                                    </a>
                                </li>
                                <li class="nav-item {{ Request::is('admin/rental/provider/vehicle/bulk-import') ? 'active' : '' }}">
                                    <a class="nav-link " href="{{ route('admin.rental.provider.vehicle.bulk_import') }}" title="{{ translate('messages.bulk_import') }}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate text-capitalize">{{ translate('messages.bulk_import') }}</span>
                                    </a>
                                </li>
                                <li class="nav-item {{ Request::is('admin/rental/provider/vehicle/bulk-export') ? 'active' : '' }}">
                                    <a class="nav-link " href="{{ route('admin.rental.provider.vehicle.bulk-export-index') }}" title="{{ translate('messages.bulk_export') }}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate text-capitalize">{{ translate('messages.bulk_export') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif

                    @if (\App\CentralLogics\Helpers::module_permission_check('provider'))
                        <li class="nav-item">
                            <small class="nav-subtitle" title="{{ translate('messages.provider_section') }}">{{ translate('messages.provider_management') }}</small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>

                        <li class="navbar-vertical-aside-has-menu {{ Request::is('admin/rental/provider/new-requests') || Request::is('admin/rental/provider/new-requests-details/*') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link" href="{{ route('admin.rental.provider.new-requests') }}?request_type=pending_provider" title="{{ translate('messages.new_providers_request') }}">
                                <span class="tio-calendar-note nav-icon"></span>
                                <span class="text-truncate position-relative overflow-visible">
                                    {{ translate('messages.new_providers_request') }}
                                    @php($new_str = \App\Models\Store::whereHas('vendor', function($query){
                                        return $query->where('status', null);
                                    })->module(Config::get('module.current_module_id'))->get())
                                    @if (count($new_str)>0)

                                    <span class="btn-status btn-status-danger border-0 size-8px"></span>
                                    @endif
                                </span>
                            </a>
                        </li>
                        <li class="navbar-vertical-aside-has-menu {{ Request::is('admin/rental/provider/create') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link" href="{{ route('admin.rental.provider.create') }}" title="{{ translate('add new provider') }}">
                                <span class="tio-add-circle nav-icon"></span>
                                <span class="text-truncate position-relative overflow-visible">
                                    {{ translate('add new provider') }}
                                </span>
                            </a>
                        </li>
                        <li class="navbar-vertical-aside-has-menu {{ Request::is('admin/rental/provider/list') ||  Request::is('admin/rental/provider/details/*') ||  Request::is('admin/rental/provider/driver/*') ||  Request::is('admin/rental/provider/edit*') ||  Request::is('admin/store/withdraw-view*') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link" href="{{ route('admin.rental.provider.list') }}" title="{{ translate('messages.providers_list') }}">
                                <span class="tio-layout nav-icon"></span>
                                <span class="text-truncate">{{ translate('providers list') }}</span>
                            </a>
                        </li>
                        <li class="navbar-vertical-aside-has-menu {{ Request::is('admin/rental/provider/bulk-import') ? 'active' : '' }}">
                            <a class="nav-link " href="{{ route('admin.rental.provider.bulk_import') }}" title="{{ translate('messages.bulk_import') }}">
                                <span class="tio-publish nav-icon"></span>
                                <span class="text-truncate text-capitalize">{{ translate('messages.bulk_import') }}</span>
                            </a>
                        </li>
                        <li class="navbar-vertical-aside-has-menu {{ Request::is('admin/rental/provider/bulk-export') ? 'active' : '' }}">
                            <a class="nav-link " href="{{ route('admin.rental.provider.bulk_export_index') }}" title="{{ translate('messages.bulk_export') }}">
                                <span class="tio-download-to nav-icon"></span>
                                <span class="text-truncate text-capitalize">{{ translate('messages.bulk_export') }}</span>
                            </a>
                        </li>
                   @endif

                    @if (\App\CentralLogics\Helpers::module_permission_check('download_app'))
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

                    @if (\App\CentralLogics\Helpers::module_permission_check('fare'))
                        <li class="nav-item">
                            <small class="nav-subtitle" title="{{ translate('Fare Management') }}">{{ translate('Fare Management') }}</small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>

                        <li class="navbar-vertical-aside-has-menu {{ Request::is('admin/ride-share/fare/trip*') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link" href="{{ route('admin.ride-share.fare.trip.index') }}" title="{{ translate('messages.Trip_Fare_Setup') }}">
                                <i class="tio-settings nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{ translate('messages.Trip_Fare_Setup') }}</span>
                            </a>
                        </li>
                    @endif

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
