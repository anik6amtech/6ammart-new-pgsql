<div class="js-nav-scroller hs-nav-scroller-horizontal mt-2">
    <!-- Nav -->
    <ul class="nav nav-tabs mb-3 border-0 nav--tabs">
        <li class="nav-item">
            <a class="nav-link {{request()?->tab == 'orders' ||  !request()?->tab ? 'active' : ''}}"
                href="{{ route('admin.users.delivery-man.preview', ['id'=>$deliveryMan['id']]) }}?tab=orders"
                aria-disabled="true">{{ translate('messages.orders') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{request()?->tab == 'rides' ? 'active' : ''}}"
                href="{{ route('admin.users.delivery-man.preview', ['id'=>$deliveryMan['id']]) }}?tab=rides"
                aria-disabled="true">{{ translate('messages.rides') }}</a>
        </li>
    </ul>
    <!-- End Nav -->
</div>