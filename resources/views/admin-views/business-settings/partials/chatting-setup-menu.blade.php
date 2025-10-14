<div class="d-flex flex-wrap justify-content-between align-items-center">
    <div class="js-nav-scroller hs-nav-scroller-horizontal mb-2">
        <!-- Nav -->
        <ul class="nav nav-tabs border-0 nav--tabs">
            <li class="nav-item">
                <a class="nav-link px-2 {{ Request::is('admin/business-settings/business-setup/chatting-setup/automated-message*') ?'active':'' }} " href="{{ route('admin.business-settings.business-setup',  ['tab' => 'chatting-setup', 'subTab' => 'automated-message']) }}">{{ translate('User') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link px-2 {{ Request::is('admin/business-settings/business-setup/chatting-setup/rider*') ?'active':'' }} " href="{{ route('admin.business-settings.business-setup',  ['tab' => 'chatting-setup', 'subTab' => 'rider']) }}">{{ translate('Rider') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link px-2 {{ Request::is('admin/business-settings/business-setup/chatting-setup/support-center*') ?'active':'' }} " href="{{ route('admin.business-settings.business-setup',  ['tab' => 'chatting-setup', 'subTab' => 'support-center']) }}">{{ translate('Support Center') }}</a>
            </li>
        </ul>
        <!-- End Nav -->
    </div>
</div>