
<div class="d-flex flex-wrap justify-content-between align-items-center mb-5 __gap-12px">
    <div class="js-nav-scroller hs-nav-scroller-horizontal mt-2">
        <!-- Nav -->
        <ul class="nav nav-tabs border-0 nav--tabs nav--pills">
            <li class="nav-item">
                <a class="nav-link   {{ Request::is('admin/users/delivery-man/vehicle/brand*') ? 'active' : '' }}" href="{{ route('admin.users.delivery-man.vehicle.brand.index') }}"   aria-disabled="true">{{translate('vehicle_brand')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link   {{ Request::is('admin/users/delivery-man/vehicle/model*') ? 'active' : '' }}" href="{{ route('admin.users.delivery-man.vehicle.model.index') }}"   aria-disabled="true">{{translate('vehicle_model')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link   {{ Request::is('admin/users/delivery-man/vehicle/category*') ? 'active' : '' }}" href="{{ route('admin.users.delivery-man.vehicle.category.index') }}"   aria-disabled="true">{{translate('vehicle_category')}}</a>
            </li>
        </ul>
        <!-- End Nav -->
    </div>
</div>
