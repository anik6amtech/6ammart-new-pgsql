<ul class="nav nav-tabs dark border-0 mb-4">
    <li class="nav-item px-2">
        <a class="nav-link border-bottom px-1 {{ Request::is('admin/users/delivery-man/vehicle/request/list/pending') ? 'active' : '' }}" id="pending-tab" href="{{ route('admin.users.delivery-man.vehicle.request.list',['status'=>'pending']) }}"
            aria-controls="pending" aria-selected="true">{{ translate('messages.Pending_Request') }}</a>
    </li>
    <li class="nav-item px-2">
        <a class="nav-link border-bottom px-1 {{ Request::is('admin/users/delivery-man/vehicle/request/list/denied') ? 'active' : '' }}" id="denied-tab" href="{{ route('admin.users.delivery-man.vehicle.request.list',['status'=>'denied']) }}"
            aria-controls="denied" aria-selected="true">{{ translate('messages.Denied_Request') }}</a>
    </li>
</ul>