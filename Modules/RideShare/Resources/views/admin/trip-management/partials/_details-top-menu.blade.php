<div class="js-nav-scroller hs-nav-scroller-horizontal mt-2">
        <!-- Nav -->
    <ul class="nav nav-tabs border-0 nav--tabs nav--pills mb-4">
        <li class="nav-item" role="presentation">
            <a class="nav-link py-2 px-3 rounded {{request()->page != 'log'?'active':''}}" href="{{url()->current()}}?page=summary">{{translate('Ride Summary')}}</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link py-2 px-3 rounded {{request()->page == 'log'?'active':''}}" href="{{url()->current()}}?page=log">{{translate('Activity Log')}}</a>
        </li>
    </ul>
</div>