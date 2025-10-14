@section('title', 'Ride Details')

@extends('layouts.admin.app')

@push('css_or_js')
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title">
                        <span class="page-header-icon">
                            <img src="{{ asset('/public/assets/admin/img/car-logo.png') }}" class="w--20" alt="">
                        </span>
                        <span>
                            {{ translate('ride_details') }}
                        </span>
                    </h1>
                </div>
            </div>
        </div>
        <!-- Page Header -->

        <div class="row flex-xl-nowrap" id="printableArea">
            {{-- <div class="col-lg-8 order-print-area-left">
                <!-- Card -->
                <div class="card mb-3 mb-lg-5">
                    <!-- Header -->
                    <div class="card-header align-items-stretch flex-column border-0 pb-0">
                        <div class="d-flex align-items-start justify-content-between flex-wrap mb-2">
                            <div class="order-invoice-left">
                                <div>
                                    <h1 class="page-header-title d-flex align-items-center __gap-5px">
                                        {{translate('Trip_ID')}} # {{ $trip->ref_id }}
                                    </h1>
                                    <span class="mt-2 d-block d-flex align-items-center __gap-5px text-title">
                                        <span class="opacity-80">{{ translate('Ride_Date') }}:</span> {{ date('d F Y, h:i a', strtotime($trip->created_at)) }}
                                    </span>
                                </div>
								<div class="mt-3 text-capitalize">
									<h6 class="font-regular">
										<span>{{translate('Ride_Status')}}</span> <span>:</span>
										<span class="badge--accepted badge  ml-2 ml-sm-3 text-capitalize">
											Confirmed
										</span>
									</h6>
									<h6 class="font-regular">
										<span>{{translate('Payment status')}}</span> <span>:</span>
										<strong class="text-danger font-semibold">Unpaid</strong>

									</h6>
								</div>
                            </div>
                            <div class="order-invoice-right mt-3 mt-sm-0">
                                <div class="btn--container ml-auto align-items-center justify-content-end">
                                    <button class="btn btn--primary btn-outline-primary font-bold lh-1" type="button"
                                            data-toggle="modal" data-target="#editTripModal">
                                        <i class="fi fi-rr-pencil mr-sm-1"></i> {{translate('Edit_Ride')}}
                                    </button>
                                    <a class="btn btn--primary print--btn font-bold d-none d-sm-block lh-1" href="#">
                                        <i class="fi fi-rr-receipt mr-sm-1"></i> <span>{{translate('Print_invoice')}}</span>
                                    </a>
                                </div>
                                <div class="text-right mt-3 order-invoice-right-contents text-capitalize">
                                    <h6 class="font-regular">

                                        <span>{{translate('Payment_Method')}}</span> <span>:</span>
                                        <strong class="font-semibold">SSL Commerz</strong>
                                    </h6>
                                    <h6 class="font-regular">
                                        <span>{{translate('Reference_Code')}}</span> <span>:</span>
                                        <strong class="font-semibold">68973</strong>

                                    </h6>
                                </div>
                            </div>
                        </div>
                        <div class="__bg-FAFAFA p-2 rounded">
                            <h6 class="fs-14 text-title">
                                {{translate('Note')}}:
                                <span class="font-regular">Please provide Good quality car</span>
                            </h6>
                        </div>
                    </div>
                    <!-- End Header -->

                    <!-- Body -->
                    <div class="card-body px-0">
                        <!-- item cart -->
                        <div class="table-responsive">
                            <table
                                class="table table-thead-bordered table-nowrap table-align-middle card-table dataTable no-footer mb-0">
                                <thead class="thead-light">
                                <tr>
                                    <th class="border-0">#</th>
                                    <th class="border-0">{{translate('Vehicle_Details')}}</th>
                                    <th class="border-0 text-center">{{translate('Total_Distance')}}</th>
                                    <th class="border-0 text-center">{{translate('Total_Duration')}}</th>
                                    <th class="border-0 text-right">{{translate('Fare')}}</th>
                                </tr>
                                </thead>
                                <tbody>
									<tr>
										<td>
											<div>
												1
											</div>
										</td>
										<td>
											<div class="media media--sm align-items-center">
												<a class="avatar avatar-xl mr-3"
													href="#">
													<img class="img-fluid rounded aspect-ratio-1 onerror-image"
														src="{{ asset('public/assets/admin/img/100x100/2.jpg') }}"
														alt="Image Description">
												</a>
												<div class="media-body">
													<div class="fs-12 text--title d-flex flex-column gap-1">
														<div class="d-flex gap-2"><span class="font-semibold mr-2 w--50px">Category</span>: <span>Car</span></div>
														<div class="d-flex gap-2"><span class="font-semibold mr-2 w--50px">Vehicle</span>: <span>Toyota GTR 2020</span></div>
														<div class="d-flex gap-2"><span class="font-semibold mr-2 w--50px">License</span>: <span>GA - 12 - 2352</span></div>
													</div>
												</div>
											</div>
										</td>

										<td class="text-center">
											<div class="fs-14 text--title">
												2 km
											</div>
										</td>
										<td class="text-center">
											<div class="fs-14 text--title">
												1 hr 30min
											</div>
										</td>
										<td class="text-right">
											<div class="fs-14 text--title">
												$ 1,350.25
											</div>
										</td>
									</tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="mx-3">
                            <hr>
                        </div>
                        <div class="row justify-content-md-end mb-3 mt-4 mx-0">
                            <div class="col-md-9 col-lg-8">
                                <dl class="row text-right text-title">
                                    <dt class="col-6 font-regular">{{translate('Ride_Fare')}}</dt>
                                    <dd class="col-6">$ 1,350.25</dd>
                                    <dt class="col-6">{{ translate('Subtotal') }}
                                    </dt>
                                    <dd class="col-6 font-semibold">
                                       $ 1,350.25
                                    </dd>
                                    <dt class="col-6 font-regular">{{translate('Coupon discount')}}</dt>
                                    <dd class="col-6">
                                       -$ 350.25
                                    </dd>
                                    <dt class="col-6 font-regular text-uppercase">{{translate('Vat/tax')}}</dt>
                                    <dd class="col-6 text-right">
                                        +$ 10
                                    </dd>
                                    <dt class="col-6 font-bold">{{translate('Total')}}</dt>
                                    <dd class="col-6 font-bold">$ 1,010.00</dd>
                                </dl>
                                <!-- End Row -->
                            </div>
                        </div>
                        <!-- End Row -->
                    </div>
                    <!-- End Body -->
                </div>
                <!-- End Card -->
            </div>
            <div class="col-lg-4">asd</div> --}}
            <div class="col-lg-8">
                <div class="row g-3">
                    @if ($trip->driver)
                        <div class="col-sm-6">
                            <div class="card border analytical_data">
                                <div class="card-body position-relative">
                                    <div class="d-flex align-items-start justify-content-between gap-2 mb-2">
                                        <h6 class="d-flex align-items-center gap-2 text-capitalize">
                                            <i class="bi bi-person-fill-gear"></i>
                                            {{ translate('driver_details') }}
                                        </h6>
                                    </div>

                                    <div class="media align-items-center gap-3">
                                        <div class="avatar avatar-xxl avatar-hover rounded">
                                            <img src="{{ $trip?->driver?->image_full_url }}"
                                                    class="rounded fit-object" alt="">
                                            <h6 class="level text-center">{{ $trip->driver->level?->name }}</h6>
                                        </div>
                                        <div class="media-body">
                                            <div class="d-flex flex-column align-items-start gap-1">
                                                <h6>{{ $trip->driver?->f_name . ' ' . $trip->driver?->l_name }}
                                                </h6>
                                                <div
                                                    class="badge bg-primary text-white">{{ $trip->driver->level?->name }}</div>
                                                <a href="tel:{{ $trip->driver->phone }}">{{ $trip->driver->phone }}</a>
                                                <a
                                                    href="mailto:{{ $trip->driver->email }}">{{ $trip->driver->email }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif ($trip->current_status == 'cancelled')
                        <div class="col-sm-6">
                            <div class="card border analytical_data h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-center gap-2 h-100">
                                        <div
                                            class="d-flex flex-column align-items-center justify-content-center gap-2">
                                            <img src="{{ asset('public/assets/admin-module/img/svg/driver.svg') }}"
                                                    class="" alt="" width="50">
                                            <h4 class="text-muted ">
                                                {{ translate('trip_was_cancel_before_driver_accepted') }}
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="col-sm-6">
                        <div class="card border analytical_data">
                            <div class="card-body position-relative">
                                <div class="d-flex align-items-start justify-content-between gap-2 mb-2">
                                    <h6 class="d-flex align-items-center gap-2 text-capitalize">
                                        <i class="bi bi-person-fill-gear"></i>
                                        {{ translate('customer_details') }}
                                    </h6>
                                </div>

                                <div class="media align-items-center gap-3">
                                    <div class="avatar avatar-xxl avatar-hover rounded">
                                        <img src="{{ $trip?->customer?->image_full_url }}"
                                                class="rounded fit-object" alt="">
                                        <h6 class="level text-center">{{ $trip->customer->level?->name }}</h6>
                                    </div>
                                    <div class="media-body">
                                        <div class="d-flex flex-column align-items-start gap-1">
                                            <h6>{{ $trip->customer?->full_name }}
                                            </h6>
                                            <div class="badge bg-primary text-white">{{ $trip->customer->level?->name }}</div>
                                            <a
                                                href="tel:{{ $trip->customer?->phone }}">{{ $trip->customer?->phone }}</a>
                                            <a
                                                href="mailto:{{ $trip->customer?->email }}">{{ $trip->customer?->email }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- RIDER NOT FOUND --}}
                    @if (is_null($trip->driver) && $trip->current_status == PENDING)
                        <div class="col-sm-6">
                            <div class="card border analytical_data h-100">
                                <div class="card-body position-relative">
                                    <div class="d-flex flex-column align-items-center gap-4">
                                        <h6 class="text-muted text-capitalize">{{ translate('rider_not_found') }}
                                        </h6>
                                        <img width="62"
                                                src="{{ asset('public/assets/admin-module/img/media/rider-not-found.png') }}"
                                                loading="lazy" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    {{-- END RIDER NOT FOUND --}}
                    @if($trip->ride_cancellation_reason)
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex gap-1">
                                        <div>
                                            <img
                                                src="{{asset('public/assets/admin-module/img/cancellation_reason.png')}}"
                                                alt="" width="20" height="20">
                                        </div>
                                        <div>
                                            <h6 class="text-capitalize mb-1">
                                                {{translate('cancellation_reason')}}
                                            </h6>
                                            <div class="fs-12 ml-4">{{$trip->ride_cancellation_reason}}</div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endif


                    {{-- TRIP SUMMARY FOR PENDING OR CANCELLED RIDE --}}
                    @if ($trip->current_status == PENDING || $trip->current_status == ACCEPTED || $trip->current_status == ONGOING || $trip->current_status == RETURNING)
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-column flex-sm-row gap-3 justify-content-between mb-30">
                                        <div class="media align-items-center gap-3">
                                            <div class="avatar avatar-xxl rounded-10">
                                                <img width="48" style="width: 100%;"
                                                        src="{{ $trip?->vehicleCategory?->image_full_url }}"
                                                        alt="{{ $trip?->vehicleCategory?->name }}">
                                            </div>
                                            <div class="media-body">
                                                <div class="d-flex flex-column align-items-start gap-1">
                                                    <div class="text-dark">{{ translate('trip') }}
                                                        #{{ $trip->ref_id }}</div>
                                                    <div class="fs-12" dir="ltr">
                                                        {{ date('d F Y, h:i a', strtotime($trip->created_at)) }}</div>
                                                    <h6 class="fs-13 text-capitalize">
                                                        {{ translate('total_estimated_price') }}
                                                        {{ getCurrencyFormat($trip->estimated_fare + 0) }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column gap-1">
                                            <div
                                                class="d-flex align-items-center justify-content-sm-end gap-3 gap-sm-0">
                                                <div class="text-capitalize">{{ translate('order_status') }}:
                                                </div>
                                                <h6
                                                    class="fs-12 text-info text-sm-end w-100p {{ $trip->current_status == PENDING ? 'text-warning' : 'text-danger' }}">
                                                    {{ translate($trip->current_status) }}</h6>
                                            </div>
                                            <div
                                                class="d-flex align-items-center justify-content-sm-end gap-3 gap-sm-0">
                                                <div class=" text-capitalize">{{ translate('trip_type') }}:</div>
                                                <h6 class="fs-12 w-100p text-sm-end text-capitalize">
                                                    {{ translate($trip->type) }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    {{-- END TRIP SUMMARY FOR PENDING OR CANCELLED RIDE --}}

                    @if ($trip->current_status == COMPLETED || $trip->current_status == CANCELLED || $trip->current_status == RETURNED)
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    @if(!$trip->parcelRefund)
                                        <div class="mb-4 d-flex justify-content-end gap-3">
                                            <a target="_blank"
                                                href="{{ route('admin.ride-share.ride.invoice', [$trip->id]) }}?file=print"
                                                class="btn-link text-primary text-capitalize">
                                                <i class="bi bi-file-earmark-arrow-down"></i>
                                                {{ translate('print') }}
                                            </a>

                                            <a target="_blank"
                                                href="{{ route('admin.ride-share.ride.invoice', [$trip->id]) }}?file=pdf"
                                                class="btn-link text-primary text-capitalize">
                                                <i class="bi bi-file-earmark-arrow-down"></i>
                                                {{ translate('invoice_download') }}
                                            </a>
                                        </div>
                                    @endif
                                    <div class="d-flex flex-column flex-sm-row gap-3 justify-content-between mb-30">
                                        <div class="media align-items-center gap-3">
                                            <div class="avatar avatar-xxl rounded-10">

                                                <img width="48"
                                                        src="{{ onErrorImage(
                                                        $trip?->vehicleCategory?->image,
                                                        asset('storage/app/public/vehicle/category') . '/' . $trip?->vehicleCategory?->image,
                                                        asset('public/assets/admin-module/img/media/bike.png'),
                                                        'vehicle/category/',
                                                    ) }}"
                                                        alt="">
                                            </div>
                                            <div class="media-body">
                                                <div class="d-flex flex-column align-items-start gap-1">
                                                    <div class="text-dark">{{ translate('trip') }}
                                                        #{{ $trip->ref_id }}</div>
                                                    <div class="fs-12" dir="ltr">
                                                        {{ date('d F Y, h:i a', strtotime($trip->created_at)) }}</div>
                                                    <h6 class="fs-13">{{ translate('total') }}
                                                        {{ getCurrencyFormat($trip->paid_fare) }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column gap-1">
                                            <div
                                                class="d-flex align-items-center justify-content-sm-end gap-3 gap-sm-0">
                                                <div class="text-capitalize">{{ translate('order_status') }}:
                                                </div>
                                                <h6 class="fs-12 text-info text-sm-end w-100p {{ $trip->current_status == CANCELLED ? 'text-danger' : '' }}">
                                                    {{ translate($trip->current_status) }}</h6>
                                            </div>
                                            <div
                                                class="d-flex align-items-center justify-content-sm-end gap-3 gap-sm-0">
                                                <div class="text-capitalize">{{ translate('payment_status') }}:
                                                </div>
                                                <h6
                                                    class="fs-12 {{ $trip->payment_status == UNPAID ? 'text-danger' : 'text-primary' }} text-sm-end w-100p">
                                                    {{ translate($trip->payment_status) }}</h6>
                                            </div>
                                            <div
                                                class="d-flex align-items-center justify-content-sm-end gap-3 gap-sm-0">
                                                <div class="text-capitalize">{{ translate('trip_type') }}:</div>
                                                <h6 class="fs-12 w-100p text-sm-end text-capitalize">
                                                    {{ translate($trip->type) }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="px-xl-3">
                                        <dl class="row text-right text-title">
                                            <dt class="col-6 font-regular">{{translate('Ride_Fare')}}</dt>
                                            <dd class="col-6">{{ getCurrencyFormat($trip->actual_fare-($trip?->extra_fare_fee>0?$trip?->extra_fare_amount :0)) }}</dd>
                                            <dt class="col-6">
                                                {{ translate('delay_fee') }} 
                                                <i class="bi bi-info-circle-fill text-primary tooltip-icon"
                                                data-bs-toggle="tooltip"
                                                data-bs-title="{{ translate('the_Fee_(per_min)_charged_from_the_customer_when_the_trip_took_longer_than_the_estimated_time') }}"></i>
                                            </dt>
                                            <dd class="col-6 font-semibold">
                                            + {{ getCurrencyFormat($trip?->fee?->delay_fee) }}
                                            </dd>
                                            
                                            <dt class="col-6">
                                                {{ translate('idle_fee') }} 
                                                <i class="bi bi-info-circle-fill text-primary tooltip-icon"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-title="{{ translate('the_Fee_(per_min)_charged_from_the_customer_for_make_the_driver_waiting_on_the_ongoing_trip') }}"></i>
                                            </dt>
                                            <dd class="col-6 font-semibold">
                                            + {{ getCurrencyFormat($trip?->fee?->idle_fee) }}
                                            </dd>

                                            <dt class="col-6">
                                                
                                                {{ translate('cancellation_fee') }} 
                                                <i class="bi bi-info-circle-fill text-primary tooltip-icon"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-title="{{ translate('the_Fee(in_percentage)_charged_from_the_customer_to_cancel_the_trip') }}"></i>
                                            </dt>
                                            <dd class="col-6 font-semibold">
                                            + {{ getCurrencyFormat($trip?->fee?->cancellation_fee) }}
                                            </dd>

                                            <dt class="col-6">{{ translate('discount_amount') }}
                                                <i
                                                    class="bi bi-info-circle-fill text-primary tooltip-icon"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-title="{{ translate('This amount have got the customer as discount auto during this trip') }}"></i>
                                            </dt>
                                            <dd class="col-6 font-semibold">
                                                -{{ getCurrencyFormat($trip->discount_amount + 0) }}</dd>

                                            <dt class="col-6">
                                                {{ translate('coupon_discount') }}
                                                <i
                                                    class="bi bi-info-circle-fill text-primary tooltip-icon"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-title="{{ translate('This amount have got the customer as discount after applying the coupon during this trip') }}"></i>
                                            </dt>
                                            <dd class="col-6 font-semibold">
                                                -{{ getCurrencyFormat($trip->coupon_amount + 0) }}</dd>

                                            @if($trip?->extra_fare_fee>0)
                                                <dt class="col-6">
                                                    {{ translate('extra_fare') }}
                                                    <i
                                                        class="bi bi-info-circle-fill text-primary tooltip-icon"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-title="{{ translate('This charge is added to a ride for special conditions, such as extreme weather.') }}"></i>
                                                </dt>
                                                <dd class="col-6 font-semibold">
                                                    +{{ getCurrencyFormat($trip->extra_fare_amount + 0) }}</dd>
                                            @endif

                                                <?php
                                                $totalAmount = $trip->actual_fare + ($trip?->fee?->delay_fee ?? 0) + ($trip?->fee?->idle_fee ?? 0) + ($trip?->fee?->cancellation_fee ?? 0) - ($trip->coupon_amount ?? 0) - ($trip->discount_amount ?? 0);
                                                ?>

                                            <dt class="col-6">
                                                {{ translate('VAT/Tax') }}
                                                <small
                                                    class="font-semi-bold"><strong>({{ round((($trip?->fee?->vat_tax ?? 0) * 100) / ( $totalAmount == 0 ? 1: $totalAmount)) }}
                                                        %)</strong></small>
                                            </dt>
                                            <dd class="col-6 font-semibold">
                                                + {{ getCurrencyFormat($trip?->fee?->vat_tax + 0) }}</dd>

                                            @if ($trip->tips > 0)
                                                <dt class="col-6">
                                                    {{ translate('tips') }}
                                                    <i
                                                        class="bi bi-info-circle-fill text-primary tooltip-icon"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-title="{{ translate('This amount have got the driver from the customer as reward for his trip complete.') }}"></i>
                                                </dt>
                                                <dd class="col-6 font-semibold">+ {{ getCurrencyFormat($trip->tips + 0) }}</dd>
                                            @endif

                                            <dt class="col-6"><strong>{{ translate('total') }}</strong></dt>
                                            <dd class="col-6 font-semibold">
                                                <strong>{{ getCurrencyFormat($trip->paid_fare) }}</strong>
                                            </dd>
                                        </dl>
                                        <dl class="data-list gy-2 text-dark">
             
                                            
                                            
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            @include('ride-share::admin.trip-management.partials._trip-details-status')
        </div>
        <!-- End Row -->
    </div>
@endsection

@push('script')
    <script src="{{ asset('Modules/public/assets/js/ride-details.js') }}"></script>
@endpush
