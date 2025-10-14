    <!-- Page Header -->
    <div class="page-header pb-0">
        <div class="page-header">
            <div class="d-flex justify-content-between flex-wrap gap-3">
                <div>
                    <h1 class="page-header-title text-break">
                        <span class="page-header-icon">
                            <img src="{{ asset('public/assets/admin/img/store.png') }}" class="w--22" alt="">
                        </span>
                        <span>{{ translate('messages.Provider_Details') }}
                    </h1></span>
                    </h1>
                </div>
                @if(!request()->tab)
                    <div class="d-flex align-items-start flex-wrap gap-2">
                        <a href="javascript:" class="btn btn--reset d-flex justify-content-between align-items-center gap-4 lh--1 h--45px">
                            {{ translate('messages.status') }}
                            <label class="toggle-switch toggle-switch-sm" for="stocksCheckbox{{$provider->id}}">
                                <input type="checkbox" data-url="{{route('admin.service.provider.status_update',[$provider['id'],$provider->is_active?0:1])}}"
                                       class="toggle-switch-input redirect-url" id="stocksCheckbox{{$provider->id}}" {{$provider->is_active?'checked':''}}>
                                <span class="toggle-switch-label">
                                    <span class="toggle-switch-indicator"></span>
                                </span>
                            </label>
                        </a>
                        <a href="{{ route('admin.service.provider.edit', $provider->id)}}" class="btn btn--primary font-weight-bold float-right mr-2 mb-0">
                            <i class="tio-edit"></i> {{ translate('messages.edit_provider') }}
                        </a>
                    </div>
                @endif
            </div>
        </div>
        @if($provider->is_active)
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
                    <a class="nav-link {{request('tab')==null?'active':''}}" href="{{route('admin.service.provider.details', $provider->id)}}">{{translate('messages.overview')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{request('tab')=='bookings'?'active':''}}" href="{{route('admin.service.provider.details', ['id'=>$provider->id, 'tab'=> 'bookings', 'booking_status' => 'all', 'service_type' => 'all'])}}"  aria-disabled="true">{{translate('messages.Bookings')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{request('tab')=='subscribed_services'?'active':''}}" href="{{route('admin.service.provider.details', ['id'=>$provider->id, 'tab'=> 'subscribed_services'])}}"  aria-disabled="true">{{translate('messages.subscribed services')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{request('tab')=='reviews'?'active':''}}" href="{{route('admin.service.provider.details', ['id'=>$provider->id, 'tab'=> 'reviews'])}}"  aria-disabled="true">{{translate('messages.Reviews')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{request('tab')=='serviceman_list'?'active':''}}" href="{{route('admin.service.provider.details', ['id'=>$provider->id, 'tab'=> 'serviceman_list'])}}"  aria-disabled="true">{{translate('messages.serviceman_list')}}</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link {{request('tab')=='transactions'?'active':''}}" href="{{route('admin.service.provider.details', ['id'=>$provider->id, 'tab'=> 'transactions'])}}"  aria-disabled="true">{{translate('messages.transactions')}}</a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link {{request('tab')=='conversations'?'active':''}}" href="{{route('admin.service.provider.details', ['id'=>$provider->id, 'tab'=> 'conversations'])}}"  aria-disabled="true">{{translate('messages.conversations')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{request('tab')=='meta-data'?'active':''}}" href="{{route('admin.service.provider.details', ['id'=>$provider->id, 'tab'=> 'meta-data'])}}"  aria-disabled="true">{{translate('messages.meta_data')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{request('tab')=='business-plan'?'active':''}}" href="{{route('admin.service.provider.details', ['id'=>$provider->id, 'tab'=> 'business-plan'])}}"  aria-disabled="true">{{translate('messages.business_plan')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{request('tab')=='settings'?'active':''}}" href="{{route('admin.service.provider.details', ['id'=>$provider->id, 'tab'=> 'settings'])}}"  aria-disabled="true">{{translate('messages.settings')}}</a>
                </li>
            </ul>
            <!-- End Nav -->
        </div>
        <!-- End Nav Scroller -->
        @endif
    </div>
    <!-- End Page Header -->
