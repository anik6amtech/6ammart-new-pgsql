@extends('layouts.admin.app')

@section('title',translate('messages.Delivery Man Preview'))


@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-header-title text-break">
                <span class="page-header-icon">
                    <img src="{{asset('public/assets/admin/img/delivery-man.png')}}" class="w--26" alt="">
                </span>
                <span>{{$deliveryMan['f_name'].' '.$deliveryMan['l_name']}}</span>
            </h1>
            <div class="">
                @include('admin-views.delivery-man.partials._tab_menu')
            </div>
        </div>
        <!-- End Page Header -->

        <div class="card">
            <div class="card-body">
                <div class="row gy-3">
                    <div class="col-sm-6 col-xl-3">
                        <div class="color-card flex-column align-items-center justify-content-center color-2">
                            <div class="img-box">
                                <img class="resturant-icon w--30" src="{{asset('/public/assets/admin/img/icons/order-icon-1.png')}}" alt="transactions">
                            </div>

                            <div class="d-flex flex-column align-items-center">
                                <h2 class="title"> {{$deliveryMan->driverTrips->count()}} </h2>
                                <div class="subtitle">
                                    {{translate('messages.total_rides')}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="color-card flex-column align-items-center justify-content-center color-5">
                            <div class="img-box">
                                <img class="resturant-icon w--30" src="{{asset('/public/assets/admin/img/icons/order-icon-2.png')}}" alt="transactions">
                            </div>
                            <div class="d-flex flex-column align-items-center">
                                <h2 class="title"> {{$deliveryMan?->driverCompletedTrips?->count() ?? 0}} </h2>
                                <div class="subtitle">
                                    {{translate('messages.completed_rides')}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="color-card flex-column align-items-center justify-content-center color-7">
                            <div class="img-box">
                                <img class="resturant-icon w--30" src="{{asset('/public/assets/admin/img/icons/order-icon-3.png')}}" alt="transactions">
                            </div>
                            <div class="d-flex flex-column align-items-center">
                                <h2 class="title"> {{$deliveryMan?->driverCancelledTrips?->count() ?? 0}} </h2>
                                <div class="subtitle">
                                    {{translate('messages.cancelled_rides')}}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="card mb-3 mb-lg-5 mt-2">
            <div class="card-header py-2 border-0 gap-2">
                <div class="search--button-wrapper">
                    <h4 class="card-title">{{ translate('messages.ride_list')}}
                        <span class="badge badge-soft-dark ml-2" id="itemCount">
                            {{$ride_lists->total()}}
                        </span>
                    </h4>
                </div>
            </div>
            <!-- Body -->
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table id="datatable"
                        class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                        data-hs-datatables-options='{
                            "order": [],
                            "orderCellsTop": true,
                            "paging":false
                        }'>
                        <thead class="thead-light">
                            <tr>
                                <th class="border-0">{{translate('messages.SL')}}</th>
                                <th class="border-0">{{translate('messages.Ride_ID')}}</th>
                                <th class="border-0">{{translate('messages.Date_&_Time')}}</th>
                                <th class="border-0">{{translate('messages.Customer')}}</th>
                                <th class="border-0">{{translate('messages.Ride_Category')}}</th>
                                <th class="border-0 text-right">{{translate('messages.Ride_cost')}} ($)</th>
                                <th class="border-0 text-right">{{translate('messages.Coupon_Discount')}} ($)</th>
                                <th class="border-0 text-center">{{translate('messages.Additional_Fee')}} ($)</th>
                                <th class="border-0 text-right">{{translate('messages.Admin_Commission')}} ($)</th>
                                <th class="border-0 text-right">{{translate('messages.Total_Ride_cost')}} ($)</th>
                                <th class="text-center border-0">{{translate('messages.Ride_Status')}}</th>
                                <th class="text-center border-0">{{translate('messages.Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ride_lists as $key=>$trip)
                            <tr>
                                <td scope="row">{{$key+$ride_lists->firstItem()}}</td>
                                <td>
                                    <a href="{{ route('admin.ride-share.ride.show', $trip->id) }}" class="text--title font-medium">{{$trip->ref_id}}</a>
                                </td>
                                <td>
                                    <div class="text--title">
                                        {{date('d F Y', strtotime($trip->created_at))}}, {{date('h:i a', strtotime($trip->created_at))}}
                                    </div>
                                </td>
                                <td>
                                    <div class="text--title font-medium">
                                        <a href="{{route('admin.users.customer.ride-share.view', ['user_id' => $trip->customer_id])}}" class="text--title">
                                            {{ $trip?->customer?->full_name }}
                                            @if($trip?->customerSafetyAlert)
                                                <span class="text-danger cursor-pointer" data-toggle="tooltip" data-placement="bottom" title="Customer doing unusual behavior">
                                                    <img width="16" height="16" class="svg w-16px h-16px" src="{{ asset('Modules/RideShare/public/assets/img/ride-share/safety-alert-shield-icon-red.png') }}" alt="">
                                                </span>
                                            @endif
                                        </a>
                                        <div class="opacity-lg">
                                            {{ $trip?->customer?->email }}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="text--title font-medium">
                                        {{ $trip?->vehicleCategory?->name }}
                                    </div>
                                </td>
                                <td>
                                    <div class="text--title font-medium text-right">
                                        {{ getCurrencyFormat($trip->actual_fare) }}
                                    </div>
                                </td>
                                <td>
                                    <div class="text--title font-medium text-right">
                                        {{ getCurrencyFormat($trip->coupon_amount + 0) }}
                                    </div>
                                </td>
                                <td>
                                    <div class="text--title text-right">
                                        <table>
                                            <tr>
                                                <td class="py-0"><span class="w-100px d-inline-flex mr-2">{{translate('Delay fee')}}</span> :</td>
                                                <td class="py-0 pr-0"> {{getCurrencyFormat($trip?->fee?->delay_fee)}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-0"><span class="w-100px d-inline-flex mr-2">{{translate('Idle fee')}}</span> :</td>
                                                <td class="py-0 pr-0"> {{getCurrencyFormat($trip?->fee?->idle_fee)}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-0"><span class="w-100px d-inline-flex mr-2">{{translate('Cancellation fee')}}</span> :</td>
                                                <td class="py-0 pr-0"> {{getCurrencyFormat($trip?->fee?->cancellation_fee)}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-0"><span class="w-100px d-inline-flex mr-2">{{translate('Vat/Tax')}}</span> :</td>
                                                <td class="py-0 pr-0"> {{getCurrencyFormat($trip?->fee?->vat_tax)}}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                                <td>
                                    <div class="text--title font-medium text-right">
                                        {{ getCurrencyFormat($trip->admin_commission) }}
                                    </div>
                                </td>
                                <td>
                                    <div class="font-medium ">
                                        <div class="text--title text-right">
                                            {{ getCurrencyFormat($trip->paid_fare) }}
                                        </div>
                                        <div class="text--{{ $trip->payment_status == PAID? 'success' : 'danger' }} text-right">
                                            {{translate($trip->payment_status)}}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                        <span class="badge badge-soft-{{$trip->current_status == 'completed' ? 'success' : ($trip->current_status == 'cancelled' ? 'danger' : 'info')}}">
                                            {{ translate($trip->current_status) }}
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <div class="btn--container justify-content-center">
                                        <a class="btn action-btn btn-primary-dark btn-outline-primary lh-1"
                                        href="{{ route('admin.ride-share.ride.show', $trip->id) }}" title="View">
                                            <i class="tio-visible"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    @if(count($ride_lists) !== 0)
                <hr>
                @endif
                <div class="page-area">
                    {!! $ride_lists->links() !!}
                </div>
                @if(count($ride_lists) === 0)
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
@endsection
