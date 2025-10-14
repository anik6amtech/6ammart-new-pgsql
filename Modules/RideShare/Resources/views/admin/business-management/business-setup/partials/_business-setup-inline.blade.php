<ul class="nav nav-tabs border-0 nav--tabs nav--pills">
    {{-- <li class="nav-item">
        <a class="nav-link {{ Request::is('admin/business-settings/rider') ?'active':'' }}" href="{{ route('admin.business-settings.rider.index') }}" aria-disabled="true">{{ translate('messages.Rider') }}</a>
    </li> --}}
    <li class="nav-item">
        <a class="nav-link {{ Request::is('admin/business-settings/ride-fare/penalty') ?'active':'' }}" href="{{ route('admin.business-settings.ride-fare.penalty') }}" aria-disabled="true">{{translate('messages.Fare_&_Penalty')}}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Request::is('admin/business-settings/ride-fare/rides') ?'active':'' }}" href="{{ route('admin.business-settings.ride-fare.rides') }}" aria-disabled="true">{{ translate('messages.Rides') }}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Request::is('admin/business-settings/ride-share/settings') ?'active':'' }}" href="{{ route('admin.business-settings.ride-share.settings') }}" aria-disabled="true">{{ translate('messages.Settings') }}</a>
    </li>
    {{-- <li class="nav-item">
        <a class="nav-link {{ Request::is('admin/business-settings/safety-precaution/*') ?'active':'' }}" href="{{ route('admin.business-settings.safety-precaution.index', SAFETY_ALERT) }}" aria-disabled="true">{{ translate('messages.Safety_&_Precaution') }}</a>
    </li> --}}
</ul>