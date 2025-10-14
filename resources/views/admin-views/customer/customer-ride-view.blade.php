@extends('layouts.admin.app')

@section('title',translate('Customer Details'))

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="d-print-none pb-3">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title mb-1">{{translate('messages.customer_id')}} #{{$customer['id']}}</h1>
                    <span class="fs-12">
                        {{translate('messages.joined_at')}} : {{date('d M Y '.config('timeformat'),strtotime($customer['created_at']))}}
                    </span>

                </div>
            </div>
        </div>
        @include('admin-views.customer.partials._tab_view')
        <!-- End Page Header -->
        @if ($customer['f_name'])
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div class="d-flex gap-2 align-items-center">
                        <img src="{{asset('public/assets/admin/img/icons/coupon-icon.png')}}" width="16" height="16" alt="">
                        <p class="mb-0">{{ translate('If you want to make a customized COUPON for this customer, click the Create Coupon button and influence them buy more from your store.') }}</p>
                    </div>

                    <a href="{{ route('admin.ride-share.promotion.coupon-setup.create',['customer' => $customer['id'], 'module_id' => $module_id]) }}" class="btn btn-warning text-white font-semibold">
                        <i class="tio-add"></i>
                        {{translate('messages.create_coupon')}}
                    </a>
                </div>
            </div>
        </div>
        @endif

        <div class="row mb-3 g-2">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-wrap gap-3">
                            <div class="color-card flex-column align-items-center justify-content-center color-2 flex-grow-1">
                                <div class="img-box">
                                    <img class="resturant-icon w--30" src="{{asset('/public/assets/admin/img/icons/order-icon-1.png')}}" alt="">
                                </div>
                                <div class="d-flex flex-column align-items-center">
                                    <h2 class="title"> {{ $rides->total() }} </h2>
                                    <div class="subtitle">
                                        {{ translate('total_ride') }}
                                    </div>
                                </div>
                            </div>
                            <div class="color-card flex-column align-items-center justify-content-center color-5 flex-grow-1">
                                <div class="img-box">
                                    <img class="resturant-icon w--30" src="{{asset('/public/assets/admin/img/icons/order-icon-2.png')}}" alt="">
                                </div>
                                <div class="d-flex flex-column align-items-center">
                                    <h2 class="title"> {{ \App\CentralLogics\Helpers::format_currency($total_rides_amount[0]->total_ride_amount) }} </h2>
                                    <div class="subtitle">
                                        {{ translate('total_ride_amount') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-wrap gap-3">
                            <div class="color-card flex-column align-items-center justify-content-center color-7 flex-grow-1">
                                <div class="img-box">
                                    <img class="resturant-icon w--30" src="{{asset('/public/assets/admin/img/icons/order-icon-3.png')}}" alt="transactions">
                                </div>
                                <div class="d-flex flex-column align-items-center">
                                    <h2 class="title"> {{$customer->wallet_balance??0}} </h2>
                                    <div class="subtitle">
                                        {{translate('messages.wallet_balance')}}
                                    </div>
                                </div>
                            </div>
                            <div class="color-card flex-column align-items-center justify-content-center color-4 flex-grow-1">
                                <div class="img-box">
                                    <img class="resturant-icon w--30" src="{{asset('/public/assets/admin/img/icons/order-icon-4.png')}}" alt="transactions">
                                </div>
                                <div class="d-flex flex-column align-items-center">
                                    <h2 class="title"> {{$customer->loyalty_point??0}} </h2>
                                    <div class="subtitle">
                                        {{translate('messages.loyalty_point')}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="printableArea">
            <div class="col-lg-8 mb-3 mb-lg-0">
                <ul class="nav nav-tabs mb-3 border-0 nav--tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" data-target="#rideList" type="button" role="tab" aria-controls="home" aria-selected="true">
                            {{ translate('ride_list') }}
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" data-target="#reviewList" type="button" role="tab" aria-controls="profile" aria-selected="false">
                            {{ translate('review_list') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="rideList" role="tabpanel" aria-labelledby="home-tab">
                        <div class="card">
                            <div class="card-header border-0 py-2 d-flex flex-wrap gap-2">
                                <div class="search--button-wrapper">
                                    <h5 class="card-title d-flex gap-2 align-items-center">
                                        {{translate('ride_list')}}
                                        <span class="badge badge-soft-secondary">{{ $rides->total() }}</span>
                                    </h5>

                                    <div class="min--260">
                                        <form class="search-form theme-style">
                                            <div class="input-group input--group">
                                                <input  type="search" name="search" class="form-control"
                                                placeholder="{{translate('ex_: search_by_ride_id')}}" aria-label="{{translate('messages.search')}}" value="{{request()?->search}}" >
                                                <button type="submit" class="btn btn--secondary"><i class="tio-search"></i></button>
                                            </div>
                                        </form>

                                    </div>
                                    @if(request()->get('search'))
                                        <button type="reset" class="btn btn--primary ml-2 location-reload-to-base" data-url="{{url()->full()}}">{{translate('messages.reset')}}</button>
                                    @endif
                                </div>
                            <!-- Unfold -->
                            {{-- <div class="hs-unfold mr-2">
                                <a class="js-hs-unfold-invoker btn btn-sm btn-white dropdown-toggle min-height-40" href="javascript:;"
                                    data-hs-unfold-options='{
                                            "target": "#usersExportDropdown",
                                            "type": "css-animation"
                                        }'>
                                    <i class="tio-download-to mr-1"></i> {{ translate('messages.export') }}
                                </a>

                                <div id="usersExportDropdown"
                                    class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right">
                                    <span class="dropdown-header">{{ translate('messages.download_options') }}</span>
                                    <a id="export-excel" class="dropdown-item" href="{{route('admin.customer.trip-export', ['type'=>'excel','id'=>$customer->id,request()->getQueryString()])}}">
                                        <img class="avatar avatar-xss avatar-4by3 mr-2"
                                            src="{{ asset('public/assets/admin') }}/svg/components/excel.svg"
                                            alt="Image Description">
                                        {{ translate('messages.excel') }}
                                    </a>
                                    <a id="export-csv" class="dropdown-item" href="{{route('admin.customer.trip-export', ['type'=>'csv','id'=>$customer->id,request()->getQueryString()])}}">
                                        <img class="avatar avatar-xss avatar-4by3 mr-2"
                                            src="{{ asset('public/assets/admin') }}/svg/components/placeholder-csv-format.svg"
                                            alt="Image Description">
                                        .{{ translate('messages.csv') }}
                                    </a>
                                </div>
                            </div> --}}
                            <!-- End Unfold -->
                            </div>

                            <!-- Table -->
                            <div class="table-responsive datatable-custom">
                                <table id="columnSearchDatatable"
                                    class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                                    data-hs-datatables-options='{
                                        "order": [],
                                        "orderCellsTop": true,
                                        "paging":false
                                    }'>
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="border-0">{{ translate('messages.SL') }}</th>
                                            <th class="border-0">{{ translate('messages.Ride_ID') }}</th>
                                            <th class="border-0">{{ translate('messages.Date_&_Time') }}</th>
                                            <th class="border-0">{{ translate('messages.Driver') }}</th>
                                            <th class="border-0">{{ translate('messages.Ride_Category') }}</th>
                                            <th class="border-0 text-right">{{ translate('messages.Total_Ride_cost') }} ($)</th>
                                            <th class="text-center border-0">{{ translate('messages.Ride_Status') }}</th>
                                            <th class="text-center border-0">{{ translate('messages.Action') }}</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse($rides as $key => $trip)
                                            <tr>
                                                <td>{{$rides->firstItem() + $key}}</td>
                                                <td>
                                                    <a href="{{ route('admin.ride-share.ride.show', ['id' => $trip->id, 'module_id' => $module_id]) }}" class="text--title font-medium">{{$trip->ref_id}}</a>
                                                </td>
                                                <td>
                                                    <div class="text--title">
                                                        {{date('d F Y', strtotime($trip->created_at))}}, {{date('h:i a', strtotime($trip->created_at))}}
                                                    </div>
                                                </td>
                                                
                                                <td>
                                                    <div class="text--title font-medium">
                                                        @if($trip->driver_id)
                                                            <a href="{{ route("admin.users.delivery-man.preview", ['id' => $trip->driver_id, 'tab' => 'ride_list']) }}" class="text--title">
                                                                {{ $trip->driver ? ($trip->driver?->f_name . ' ' . $trip->driver?->l_name) : translate('no_driver_assigned') }}
                                                                @if($trip?->driverSafetyAlert)
                                                                    <span class="text-danger cursor-pointer" data-toggle="tooltip" data-placement="bottom" title="Rider doing unusual behavior">
                                                                        <img width="16" height="16" class="svg w-16px h-16px" src="{{ asset('Modules/RideShare/public/assets/img/ride-share/safety-alert-shield-icon-red.png') }}" alt="">
                                                                    </span>
                                                                @endif
                                                            </a>
                                                            <div class="opacity-lg">
                                                                {{ $trip->driver?->email }}
                                                            </div>
                                                        @else
                                                            <span class="text--title">{{ translate('no_driver_assigned') }}</span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text--title font-medium">
                                                        {{ $trip->vehicleCategory->name }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="font-medium text-right">
                                                        <div class="text--title">
                                                            {{ getCurrencyFormat($trip->paid_fare) }}
                                                        </div>
                                                        <div class="text--{{ $trip->payment_status == PAID? 'success' : 'danger' }}">
                                                            {{translate($trip->payment_status)}}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if($trip->current_status == PENDING)
                                                        <div class="badge badge--pending bg-opacity-10" data-color="#006AB4" data-bg-color="#00E0FF">
                                                            {{translate($trip->current_status)}}
                                                        </div>
                                                    @elseif($trip->current_status == CANCELLED)
                                                        <div class="badge badge--cancel bg-opacity-10" data-color="#FF5A54" data-bg-color="#FFE5E5">
                                                            {{translate($trip->current_status)}}
                                                        </div>
                                                    @elseif($trip->current_status == ONGOING)
                                                        <div class="badge badge--pending-1 bg-opacity-10" data-color="#E19500" data-bg-color="#FFFCDE">
                                                            {{translate($trip->current_status)}}
                                                        </div>
                                                    @elseif($trip->current_status == COMPLETED)
                                                        <div class="badge badge--accepted bg-opacity-10" data-color="#008958" data-bg-color="#DEFFF3">
                                                            {{translate($trip->current_status)}}
                                                        </div>
                                                    @else
                                                        <div class="badge badge--pending bg-opacity-10" data-color="#006AB4" data-bg-color="#00E0FF">
                                                            {{translate($trip->current_status)}}
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn--container justify-content-center">
                                                        <a class="btn action-btn btn--warning btn-outline-warning" target="_blank" href="{{ route('admin.ride-share.ride.show', ['id' => $trip->id, 'module_id' => $module_id]) }}" title="{{translate('messages.view')}} "><i class="tio-visible"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @if(count($rides) !== 0)
                            <hr>
                            @endif
                            <div class="page-area">
                                {!! $rides->links() !!}
                            </div>
                            @if(count($rides) === 0)
                            <div class="empty--data">
                                <img src="{{asset('/public/assets/admin/svg/illustrations/sorry.svg')}}" alt="public">
                                <h5>
                                    {{translate('no_data_found')}}
                                </h5>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="tab-pane fade" id="reviewList" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="card">
                            <div class="card-header border-0 py-2 d-flex flex-wrap gap-2">
                                <div class="search--button-wrapper">
                                    <h5 class="card-title d-flex gap-2 align-items-center">
                                        {{translate('review_list')}}
                                        <span class="badge badge-soft-secondary">{{ $reviews->total() }}</span>
                                    </h5>

                                </div>
                            </div>

                            <!-- Table -->
                            <div class="table-responsive datatable-custom">
                                <table id="columnSearchDatatable"
                                    class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                                    data-hs-datatables-options='{
                                        "order": [],
                                        "orderCellsTop": true,
                                        "paging":false
                                    }'>
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="border-0">{{translate('SL')}}</th>
                                            <th class="border-0">{{translate('Ride_ID')}}</th>
                                            <th class="border-0">{{translate('messages.rider')}}</th>
                                            <th class="border-0">{{translate('messages.customer')}}</th>
                                            <th class="border-0">{{translate('messages.rating')}}</th>
                                            <th class="border-0">{{translate('messages.review')}}</th>
                                            <th class="border-0 text-center">{{translate('messages.action')}}</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($reviews as $key=>$review)
                                            <tr>
                                                <td>{{$key+$reviews->firstItem()}}</td>
                                                <td><a class="text-dark"
                                                    href="{{ (isset($review->trip) ? route('admin.ride-share.ride.show',[$review->ride_request_id,'module_id'=>$review?->trip?->module_id]) : '#') }}" target="_blank">{{$review->trip?->ref_id}}</a>
                                                </td>
                                                <td>
                                                    <span class="d-block font-size-sm text-body">
                                                        <a href="{{route('admin.users.delivery-man.preview',[$review['given_by'], 'tab' => 'ride_list'])}}" target="_blank"
                                                        class="media gap-2 align-items-center text-dark">
                                                            <img  src="{{ $review->givenByDeliveryMan->image_full_url }}"
                                                                class="rounded-circle object-cover" width="48" height="48"
                                                                alt="{{$review->givenByDeliveryMan->f_name.' '.$review->givenByDeliveryMan->l_name}}">
                                                            <div class="meida-body">
                                                                <div
                                                                    title="{{$review->givenByDeliveryMan->f_name.' '.$review->givenByDeliveryMan->l_name}}">{{$review->givenByDeliveryMan->f_name.' '.$review->givenByDeliveryMan->l_name}}</div>
                                                                <div> {{$review?->givenByDeliveryMan?->phone}} </div>
                                                            </div>
                                                        </a>
                                                    </span>
                                                </td>
                                                <td>
                                                    @if ($review->receivedByUser)
                                                        <a href="{{route('admin.users.customer.ride-share.view',[$review->received_by])}}" target="_blank"
                                                        class="text-dark">
                                                            {{$review->receivedByUser->f_name ?? ""}} {{$review->receivedByUser->l_name ?? ""}}
                                                        </a>
                                                    @else
                                                        <div
                                                            class="text-muted">{{translate('messages.customer_not_found')}}</div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <label
                                                            class="badge badge-soft-warning mb-0 d-flex align-items-center gap-1 justify-content-center">
                                                            <span class="d-inline-block mt-3px">{{$review->rating}}</span>
                                                            <i class="tio-star"></i>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="cursor-pointer text-wrap max-349 min-w-100px max-text-2-line"
                                                        data-toggle="tooltip" data-placement="top"
                                                        title="{{$review->feedback}}">
                                                        {{$review->feedback}}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="btn--container justify-content-center">
                                                        <a class="btn action-btn btn--warning btn-outline-warning view-details" href="#"
                                                        title="View" data-order_id="{{$review->trip?->ref_id}}"
                                                        data-date="{{ App\CentralLogics\Helpers::time_date_format($review->created_at) }}"
                                                        data-name="{{$review?->givenByDeliveryMan?->f_name.' '.$review?->givenByDeliveryMan?->l_name}}"
                                                        data-image="{{ $review?->givenByDeliveryMan?->image_full_url }}"
                                                        data-phone="{{$review?->givenByDeliveryMan?->phone}}"
                                                        data-rating="{{$review->rating}}"
                                                        data-comment="{{$review->feedback}}" >
                                                            <i class="tio-visible-outlined"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @if(count($rides) !== 0)
                            <hr>
                            @endif
                            <div class="page-area">
                                {!! $rides->links() !!}
                            </div>
                            @if(count($rides) === 0)
                            <div class="empty--data">
                                <img src="{{asset('/public/assets/admin/svg/illustrations/sorry.svg')}}" alt="public">
                                <h5>
                                    {{translate('no_data_found')}}
                                </h5>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <!-- Header -->
                    <div class="card-header">
                        <h4 class="card-title d-flex flex-wrap align-items-center gap-2">
                            <div class="d-flex align-items-center gap-1">
                                <span class="card-header-icon">
                                    <i class="tio-user"></i>
                                </span>
                                <span class=""> {{ translate('customer_information') }}</span>
                            </div>
                            <span class="badge badge-soft-info">{{ translate('total_ride') }}: {{ $rides->total() }}</span>
                        </h4>
                    </div>
                    <!-- End Header -->

                    <!-- Body -->
                    @if($customer)
                        <div class="card-body">
                            <div class="media gap-3 flex-wrap">
                                <div class="avatar avatar-circle avatar-70">
                                    <img class="avatar-img onerror-image" width="70" height="70" data-onerror-image="{{asset('public/assets/admin/img/160x160/img1.jpg')}}" src="{{ $customer->image_full_url }}"
                                    alt="Image Description">
                                </div>
                                <div class="media-body">
                                    <div class="key-value-list d-flex flex-column gap-2 text-dark" style="--min-width: 60px">
                                        <div class="key-val-list-item d-flex gap-3">
                                            <div>{{ translate('name') }}</div>:
                                            <div class="font-semibold">{{$customer['f_name']? $customer['f_name'].' '.$customer['l_name'] : translate('messages.Incomplete_Profile')}}</div>
                                        </div>
                                        <div class="key-val-list-item d-flex gap-3">
                                            <div>{{ translate('contact') }}</div>:
                                            <a href="tel:{{ $customer['phone'] }}" class="text-dark font-semibold">{{$customer['phone'] ?? translate('messages.N/A')}}</a>
                                        </div>
                                        <div class="key-val-list-item d-flex gap-3">
                                            <div>{{ translate('email') }}</div>:
                                            <a href="mailto:{{ $customer['email'] }}" class="text-dark font-semibold">{{$customer['email'] ?? translate('messages.N/A')}}</a>
                                        </div>
                                        @foreach($customer->addresses as $address)
                                            <div class="key-val-list-item d-flex gap-3">
                                                <div>{{ translate('address') }}</div>:
                                                <a href="https://www.google.com/maps/search/?api=1&query={{ data_get($address,'latitude',0)}},{{ data_get($address,'longitude',0)}}" target="_blank">{{ $address['address'] }}</a>
                                            </div>
                                        @endforeach
                                    </div>

                                    {{-- <ul class="list-unstyled m-0">
                                        <li class="pb-1 d-flex align-items-center">
                                            <i class="tio-shopping-basket-outlined mr-2"></i>
                                            <span>{{$customer->order_count}} {{translate('messages.Completed_orders')}}</span>
                                        </li>
                                    </ul> --}}
                                </div>
                            </div>


                            {{-- @foreach($customer->addresses as $address)
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5>{{translate('messages.addresses')}}</h5>
                                </div>
                                <ul class="list-unstyled list-unstyled-py-2">
                                    <li class="d-flex align-items-center">
                                        <i class="tio-tab mr-2"></i>
                                        <span>{{translate($address['address_type'])}}</span>
                                    </li>
                                    @if($address['contact_person_umber'])
                                    <li class="d-flex align-items-center">
                                        <i class="tio-android-phone-vs mr-2"></i>
                                        <span>{{$address['contact_person_number']}}</span>
                                    </li>
                                    @endif
                                    <li>
                                        <a target="_blank" href="http://maps.google.com/maps?z=12&t=m&q=loc:{{$address['latitude']}}+{{$address['longitude']}}" class="d-flex align-items-center">
                                            <i class="tio-poi mr-2"></i>
                                            {{$address['address']}}
                                        </a>
                                    </li>
                                </ul>
                                <hr>
                            @endforeach --}}

                        </div>
                @endif
                <!-- End Body -->
                </div>
                <!-- End Card -->
            </div>
        </div>
        <!-- End Row -->
    </div>


    <!-- Modal -->
    <div class="modal fade" id="deliverymanReviewModal" tabindex="-1" role="dialog"
         aria-labelledby="deliverymanReviewModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pt-0">
                    <div class="text-center d-flex flex-column align-items-center mb-3">
                        <h5>{{translate('Rider_Review')}}</h5>
                        <div class="fs-12 mb-1">{{ translate('Order#') }} <span id="order-id" class="font-semibold text-dark"></span></div>
                        <div id="date" class="text-muted fs-12"></div>
                    </div>

                    <div class="p-3 card rounded mb-3">
                        <div class="media gap-3">
                            <img width="100" height="100" class="rounded object-cover"
                                 src="" alt="image">
                            <div class="media-body">
                                <h5 id="name"></h5>
                                <div class="d-flex align-items-center gap-2 mb-1">
                                    <i class="tio-android-phone"></i>
                                    <a href="tel:" id="phone" class="text-dark"></a>
                                </div>
                                <div class="d-flex">
                                    <label
                                        class="badge badge-soft-warning mb-0 d-flex align-items-center gap-1 justify-content-center">
                                        <span class="d-inline-block mt-3px" id="rating"></span>
                                        <i class="tio-star"></i>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-3 card rounded">
                        <h5 class="text-warning">{{translate('Review')}}</h5>
                        <p id="comment"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script_2')

    <script>
        $(document).on('ready', function () {
            // INITIALIZATION OF DATATABLES
            // =======================================================
            let datatable = $.HSCore.components.HSDatatables.init($('#columnSearchDatatable'));

            $('#column1_search').on('keyup', function () {
                datatable
                    .columns(1)
                    .search(this.value)
                    .draw();
            });


            $('#column3_search').on('change', function () {
                datatable
                    .columns(2)
                    .search(this.value)
                    .draw();
            });


            // INITIALIZATION OF SELECT2
            // =======================================================
            $('.js-select2-custom').each(function () {
                let select2 = $.HSCore.components.HSSelect2.init($(this));
            });
        });
    </script>

    <script>
        "use strict";
        $(document).on('click', '.view-details', function () {
            let data = $(this).data();
            $('#deliverymanReviewModal .modal-body #deliverymanReviewModalLabel').text('Deliveryman Review');
            $('#deliverymanReviewModal .modal-body #order-id').text(data.order_id);
            $('#deliverymanReviewModal .modal-body #date').text(data.date);
            $('#deliverymanReviewModal .modal-body img').attr('src', data.image);
            $('#deliverymanReviewModal .modal-body #name').text(data.name);
            $('#deliverymanReviewModal .modal-body #phone') .text(data.phone) .attr('href', 'tel:' + data.phone);
            $('#deliverymanReviewModal .modal-body #rating').text(data.rating);
            $('#deliverymanReviewModal .modal-body #comment').text(data.comment);
            $('#deliverymanReviewModal').modal('show');
        });
    </script>
@endpush
