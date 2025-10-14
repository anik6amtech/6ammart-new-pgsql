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

        @include('ride-share::admin.trip-management.partials._details-top-menu')

        <div class="row flex-xl-nowrap" id="printableArea">

            <div class="col-lg-8 order-print-area-left">
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
											{{ translate($trip->current_status) }}
										</span>
									</h6>
									<h6 class="font-regular">
										<span>{{translate('Payment status')}}</span> <span>:</span>
										<strong class="{{ $trip->payment_status == UNPAID ? 'text-danger' : 'text-primary' }} font-semibold">{{ translate($trip->payment_status) }}</strong>

									</h6>
								</div>
                            </div>
                            <div class="order-invoice-right mt-3 mt-sm-0">
                                <div class="btn--container ml-auto align-items-center justify-content-end">
                                    {{-- <button class="btn btn--primary btn-outline-primary font-bold lh-1" type="button"
                                            data-toggle="modal" data-target="#editTripModal">
                                        <i class="fi fi-rr-pencil mr-sm-1"></i> {{translate('Edit_Ride')}}
                                    </button> --}}
                                    <a class="btn btn--primary print--btn font-bold d-none d-sm-block lh-1" target="_blank" href="{{ route('admin.ride-share.ride.invoice', [$trip->id]) }}?file=print">
                                        <i class="fi fi-rr-receipt mr-sm-1"></i> <span>{{translate('Print_invoice')}}</span>
                                    </a>
                                </div>
                                <div class="text-right mt-3 order-invoice-right-contents text-capitalize">
                                    <h6 class="font-regular">
                                        <span>{{translate('Payment_Method')}}</span> <span>:</span>
                                        <strong class="font-semibold">{{ translate($trip->payment_method) }}</strong>
                                    </h6>
                                    {{-- <h6 class="font-regular">
                                        <span>{{translate('Reference_Code')}}</span> <span>:</span>
                                        <strong class="font-semibold">68973</strong>
                                    </h6> --}}
                                </div>
                            </div>
                        </div>
                        @if($trip->note)
                            <div class="__bg-FAFAFA p-2 rounded">
                                <h6 class="fs-14 text-title">
                                    {{translate('Note')}}:
                                    <span class="font-regular">{{ $trip->note }}</span>
                                </h6>
                            </div>
                        @endif
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
														src="{{ $trip->vehicleCategory?->image_full_url }}"
														alt="Image Description">
												</a>
												<div class="media-body">
													<div class="fs-12 text--title d-flex flex-column gap-1">
														<div class="d-flex gap-2"><span class="font-semibold mr-2 w--50px">{{translate('Category')}}</span>: <span>{{ $trip->vehicleCategory?->name ?? 'N/A' }}</span></div>
														<div class="d-flex gap-2"><span class="font-semibold mr-2 w--50px">{{translate('Vehicle')}}</span>: <span>{{ $trip->driver?->rider_vehicle?->model?->name ?? 'N/A' }}</span></div>
														<div class="d-flex gap-2"><span class="font-semibold mr-2 w--50px">{{translate('License')}}</span>: <span>{{ $trip->driver?->rider_vehicle?->licence_plate_number ?? 'N/A' }}</span></div>
													</div>
												</div>
											</div>
										</td>

										<td class="text-center">
											<div class="fs-14 text--title">
												{{ $trip->actual_distance }} {{translate('km')}}
											</div>
										</td>
										<td class="text-right">
											<div class="fs-14 text--title">
												{{-- {{ getCurrencyFormat($trip->actual_fare) }} --}}
                                                {{ getCurrencyFormat($trip->actual_fare-($trip?->extra_fare_fee>0?$trip?->extra_fare_amount :0)) }}
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
                                        @if($trip->current_status == ACCEPTED)
                                            <strong>{{ getCurrencyFormat($trip->estimated_fare) }}</strong>
                                        @else
                                            <strong>{{ getCurrencyFormat($trip->paid_fare) }}</strong>
                                        @endif
                                    </dd>
                                </dl>
                                {{-- <dl class="row text-right text-title">
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
                                </dl> --}}
                                <!-- End Row -->
                            </div>
                        </div>
                        <!-- End Row -->
                    </div>
                    <!-- End Body -->
                </div>
                <!-- End Card -->
            </div>
            @include('ride-share::admin.trip-management.partials._trip-details-status')
        </div>
        <!-- End Row -->
    </div>
@endsection

@push('script')
    <script src="{{ asset('Modules/public/assets/js/ride-details.js') }}"></script>
@endpush
