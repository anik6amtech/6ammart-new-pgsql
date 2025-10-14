<ul class="nav nav-tabs border-0 nav--tabs nav--pills">
    <li class="nav-item">
        <a class="nav-link {{ Request::is('admin/business-settings/safety-precaution/safety-alert') ?'active':'' }}" href="{{ route('admin.business-settings.safety-precaution.index', SAFETY_ALERT) }}" aria-disabled="true">{{ translate('Safety Alert') }}</a>
    </li>
        <li class="nav-item">
        <a class="nav-link {{ Request::is('admin/business-settings/safety-precaution/precaution') ?'active':'' }}" href="{{ route('admin.business-settings.safety-precaution.index', PRECAUTION) }}" aria-disabled="true">{{ translate('Precautions') }}</a>
    </li>
</ul>
