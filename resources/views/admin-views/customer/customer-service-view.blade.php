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

                    <a href="{{ route('admin.service.coupon.create',['customer' => $customer['id'], 'module_id' => $module_id]) }}" class="btn btn-warning text-white font-semibold">
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
                                    <h2 class="title"> {{ $bookings->total() }} </h2>
                                    <div class="subtitle">
                                        {{ translate('total_booking') }}
                                    </div>
                                </div>
                            </div>
                            <div class="color-card flex-column align-items-center justify-content-center color-5 flex-grow-1">
                                <div class="img-box">
                                    <img class="resturant-icon w--30" src="{{asset('/public/assets/admin/img/icons/order-icon-2.png')}}" alt="">
                                </div>
                                <div class="d-flex flex-column align-items-center">
                                    <h2 class="title"> {{ \App\CentralLogics\Helpers::format_currency($total_booking_amount[0]->total_booking_amount) }} </h2>
                                    <div class="subtitle">
                                        {{ translate('total_booking_amount') }}
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
                <div class="card">
                    <div class="card-header border-0 py-2 d-flex flex-wrap gap-2">
                        <div class="search--button-wrapper">
                            <h5 class="card-title d-flex gap-2 align-items-center">
                                {{translate('booking_list')}}
                                <span class="badge badge-soft-secondary">{{ $bookings->total() }}</span>
                            </h5>

                            <div class="min--260">
                                <form class="search-form theme-style">
                                    <div class="input-group input--group">
                                        <input  type="search" name="search" class="form-control"
                                        placeholder="{{translate('ex_: search_by_booking_id')}}" aria-label="{{translate('messages.search')}}" value="{{request()?->search}}" >
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
                                    <th class="fz--14px text-title border-0">{{translate('SL')}}</th>
                                    <th class="fz--14px text-title border-0">{{translate('Booking ID')}}</th>
                                    <th class="fz--14px text-title border-0">{{translate('Booking Date')}}</th>
                                    <th class="fz--14px text-title border-0">{{translate('Schedule Date')}}</th>
                                    <th class="fz--14px text-title border-0">{{translate('Service Will be Provided')}}</th>
                                    <th class="fz--14px text-title border-0">{{translate('Total Amount')}}</th>
                                    <th class="fz--14px text-title border-0">{{translate('Payment Status')}}</th>
                                    <th class="fz--14px text-title border-0">{{translate('Action')}}</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($bookings as $key => $booking)
                                    <tr>
                                        <td class="text-title">{{$key+$bookings->firstItem()}}</td>
                                        <td class="text-title">
                                            <a href="{{ route($booking->is_repeated ? 'admin.service.booking.repeat_details' : 'admin.service.booking.details', [$booking->id, 'web_page' => 'details', 'module_id' => $booking->module_id]) }}">
                                            {{ $booking->id }}
                                            @if($booking->is_repeated)
                                                <img src="{{asset('/public/assets/admin/img/repeat2.png')}}" alt="img">
                                            @endif
                                            </a>
                                        </td>
                                        <td>
                                            <div class="font-medium text-title">{{ date('d-M-Y', strtotime($booking?->created_at))}}</div>
                                            <div>{{date('h:ia', strtotime($booking?->created_at)) }}</div>
                                        </td>
                                        <td>
                                            @if($booking->is_repeated)
                                                @if(empty($booking->nextService))
                                                    <div class="text-title">{{ date('d-M-Y h:ia', strtotime($booking?->lastRepeat?->service_schedule)) }}
                                                    </div>
                                                @else
                                                    <span>{{translate('Next upcoming')}}</span>
                                                    <div class="text-title">{{ date('d-M-Y h:ia', strtotime($booking?->lastRepeat?->service_schedule)) }}</div>
                                                @endif
                                            @else
                                                <div class="font-medium text-title">{{ date('d-M-Y', strtotime($booking?->service_schedule))}}</div>
                                                <div>{{date('h:ia', strtotime($booking?->service_schedule)) }}</div>
                                            @endif
                                        </td>
                                        <td class="text-title">
                                            {{ translate($booking->service_location) }} {{ translate('Place') }}
                                        </td>
                                        <td class="text-title">
                                            {{\App\CentralLogics\Helpers::format_currency($booking->total_booking_amount)}}
                                        </td>
                                        <td>
                                            <span class="badge rounded-pill py-2 px-3 text-capitalize text-{{$booking->is_paid?'success':'danger'}}"
                                                data-bg-color="#{{$booking->is_paid?'16B5591A':'b516160f'}}">{{$booking->is_paid?translate('paid'):translate('unpaid')}}</span>
                                        </td>
                                        <td>
                                            <div class="table-actions d-flex gap-2">
                                                <a href="{{ route($booking->is_repeated ?  'admin.service.booking.repeat_details' : 'admin.service.booking.details', [$booking->id, 'web_page' => 'details' , 'module_id' => $booking->module_id]) }}" type="button"
                                                class="btn action-btn btn--primary btn-outline-primary"
                                                style="--size: 30px">
                                                    <i class="tio-visible"></i>
                                                </a>
                                                <a href="{{ route($booking->is_repeated ?  'admin.service.booking.full_repeat_invoice' : 'admin.service.booking.invoice', [$booking->id, 'module_id' => $booking->module_id]) }}" type="button" class="action-btn btn--varify btn-outline-varify"
                                                style="--size: 30px" target="_blank">
                                                    <i class="tio-download-to"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if(count($bookings) !== 0)
                    <hr>
                    @endif
                    <div class="page-area">
                        {!! $bookings->links() !!}
                    </div>
                    @if(count($bookings) === 0)
                    <div class="empty--data">
                        <img src="{{asset('/public/assets/admin/svg/illustrations/sorry.svg')}}" alt="public">
                        <h5>
                            {{translate('no_data_found')}}
                        </h5>
                    </div>
                    @endif
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
                            <span class="badge badge-soft-info">{{ translate('total_booking') }}: {{ $bookings->total() }}</span>
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
@endpush
