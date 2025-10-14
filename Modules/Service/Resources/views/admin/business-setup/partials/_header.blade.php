    <!-- Page Header -->
    <div class="page-header pb-0">
        <!-- Nav Scroller -->
        <div class="js-nav-scroller hs-nav-scroller-horizontal">
            <span class="hs-nav-scroller-arrow-prev d-none">
                <a class="hs-nav-scroller-arrow-link" href="javascript:;">
                    <i class="tio-chevron-left"></i>
            </a>
            </span>

            <span class="hs-nav-scroller-arrow-next d-none">
                <a class="hs-nav-scroller-arrow-link" href="javascript:;">
                    <i class="tio-chevron-right"></i>
                </a>
            </span>

            <!-- Nav -->
            <ul class="nav nav-tabs page-header-tabs mb-2">
                <li class="nav-item">
                    <a class="nav-link {{request('tab')==null?'active':''}}" href="{{route('admin.business-settings.service.get-business-settings')}}">{{translate('messages.bookings')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{request('tab')=='providers'?'active':''}}" href="{{route('admin.business-settings.service.get-business-settings', ['tab'=> 'providers'])}}"  aria-disabled="true">{{translate('messages.providers')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{request('tab')=='serviceman'?'active':''}}" href="{{route('admin.business-settings.service.get-business-settings', ['tab'=> 'serviceman'])}}"  aria-disabled="true">{{translate('messages.serviceman')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{request('tab')=='promotion'?'active':''}}" href="{{route('admin.business-settings.service.get-business-settings', ['tab'=> 'promotion'])}}"  aria-disabled="true">{{translate('messages.Promotion')}}</a>
                </li>
            </ul>
            <!-- End Nav -->
        </div>
        <!-- End Nav Scroller -->
    </div>
    <!-- End Page Header -->
