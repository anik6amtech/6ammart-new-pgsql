<div class="d-flex flex-wrap justify-content-between align-items-center mb-5 __gap-12px">
    <div class="js-nav-scroller hs-nav-scroller-horizontal mt-2">
        <!-- Nav -->
        <ul class="nav nav-tabs border-0 nav--tabs nav--pills">
            <li class="nav-item">
                <a class="nav-link {{ ($type == 'customer') ? 'active' : '' }}" href="{{ route('admin.ride-share.safety-alert.index', ['type' => 'customer']) }}" aria-disabled="true">{{ translate('Customer') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ ($type == 'driver') ? 'active' : '' }}" href="{{ route('admin.ride-share.safety-alert.index', ['type' => 'driver']) }}" aria-disabled="true">{{ translate('Rider') }}</a>
            </li>
        </ul>
        <!-- End Nav -->
        
    </div>
</div>