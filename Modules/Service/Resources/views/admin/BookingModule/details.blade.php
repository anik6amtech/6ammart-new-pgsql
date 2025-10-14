@extends('layouts.admin.app')

@section('title',translate('Booking Details'))

@push('css_or_js')

@endpush

@section('content')

    <div class="content container-fluid">
        <div class="pb-3 d-flex justify-content-between align-items-center gap-3 flex-wrap">
            <div>
                <div class="d-flex align-items-center gap-2 flex-wrap mb-sm-1 mb-2">
                    <h3 class="mb-0 font-bold">{{translate('Booking')}} # {{$booking->id}}</h3>
                    <span class="badge rounded-4 py-2 px-3 text-capitalize badge-{{
                            $booking->booking_status == 'ongoing' ? 'warning' :
                            ($booking->booking_status == 'completed' ? 'success' :
                            ($booking->booking_status == 'canceled' ? 'danger' : 'info'))
                        }}">
                            {{ ucwords($booking->booking_status) }}
                        </span>
                </div>
                <p class="opacity-75 fz-12px mb-0">
                    {{translate('Booking_Placed')}}
                    : {{date('d-M-Y h:ia',strtotime($booking->created_at))}}
                </p>
            </div>
            @php($max_booking_amount = business_config('maximum_booking_amount', 'service_business_settings')->value ?? 0)
            <div class="d-flex flex-wrap flex-xxl-nowrap gap-3">
                <div class="d-flex flex-wrap gap-3">
                    @if (
                            $booking['payment_method'] == 'cash_after_service' &&
                                $booking->is_verified == '0' &&
                                $booking->total_booking_amount >= $max_booking_amount)
                            <span class="btn btn--primary btn-outline-primary verify-booking-request" data-id="{{ $booking->id }}"
                                  data-toggle="modal" data-target="#exampleModal--{{ $booking->id }}">
                                    <i class="tio-done"></i>
                                    {{ translate('verify booking request') }}
                                </span>

                        <div class="modal fade" id="exampleModal--{{ $booking->id }}" tabindex="-1"
                             aria-labelledby="exampleModalLabel--{{ $booking->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body p-4 py-5">
                                        <button type="button" class="close bg-white text-dark border d-center w-30px h-30 rounded-circle" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <div class="text-center mb-4 pb-3">
                                            <div class="text-center">
                                                <img class="mb-4"
                                                     src="{{ asset('/public/assets/admin-module/img/booking-req-status.png') }}"
                                                     alt="">
                                            </div>
                                            <h3 class="mb-1 fw-medium">
                                                {{ translate('Verify the booking request status?') }}</h3>
                                            <p class="fs-12 fw-medium text-muted">
                                                {{ translate('Need verification for max booking amount') }}</p>
                                        </div>
                                        <form method="post"
                                              action="{{ route('admin.service.booking.verification-status', [$booking->id]) }}">
                                            @csrf
                                            <div class="c1-light-bg p-4 rounded">
                                                <h5 class="mb-3">{{ translate('Request Status') }}</h5>
                                                <div class="d-flex flex-wrap gap-2">
                                                    <div class="form-check-inline cursor-pointer">
                                                        <input
                                                            class="form-check-input approve-request check-approve-status"
                                                            checked type="radio" name="status" id="inlineRadio1"
                                                            value="approve">
                                                        <label class="form-check-label cursor-pointer"
                                                               for="inlineRadio1">{{ translate('Approve the Request') }}</label>
                                                    </div>
                                                    <div class="form-check-inline cursor-pointer">
                                                        <input class="form-check-input deny-request" type="radio"
                                                               name="status" id="inlineRadio2" value="deny">
                                                        <label class="form-check-label cursor-pointer"
                                                               for="inlineRadio2">{{ translate('Deny the Request') }}</label>
                                                    </div>
                                                </div>
                                                <div class="mt-4 cancellation-note" style="display: none;">
                                                        <textarea class="form-control h-69px" placeholder="{{ translate('Cancellation Note ...') }}" name="booking_deny_note"
                                                                  id="add-your-note"></textarea>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center mt-4">
                                                <button type="submit"
                                                        class="btn btn--primary">{{ translate('submit') }}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if (
                        $booking['payment_method'] == 'cash_after_service' &&
                            $booking->is_verified == '2' &&
                            $booking->total_booking_amount >= $max_booking_amount)
                            <span class="btn btn--primary btn-outline-primary  change-booking-request" data-id="{{ $booking->id }}"
                                  data-toggle="modal" data-target="#exampleModals--{{ $booking->id }}">
                                    <i class="tio-done"></i> {{ translate('Change Request Status') }}
                                </span>

                        <div class="modal fade" id="exampleModals--{{ $booking->id }}" tabindex="-1"
                             aria-labelledby="exampleModalLabels--{{ $booking->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body pt-5 p-md-5">
                                        <button type="button" class="close bg-white text-dark border d-center w-30px h-30 rounded-circle" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <div class="text-center pb-3">
                                            <img class="mb-4"
                                                 src="{{ asset('/public/assets/admin-module/img/booking-req-status.png') }}"
                                                 alt="">
                                            <h3 class="mb-1 fw-medium">
                                                {{ translate('Verify the booking request status?') }}</h3>
                                            <p class="text-start fs-12 fw-medium text-muted">
                                                {{ translate('Need verification for max booking amount') }}</p>
                                        </div>
                                        <form method="post"
                                              action="{{ route('admin.service.booking.verification-status', [$booking->id]) }}">
                                            @csrf

                                            <div class="c1-light-bg p-4 rounded">
                                                <h5 class="mb-3">{{ translate('Request Status') }}</h5>
                                                <div class="d-flex flex-wrap gap-2">
                                                    <div class="form-check-inline">
                                                        <input class="form-check-input approve-request" checked
                                                               type="radio" name="status" id="inlineRadio1"
                                                               value="approve">
                                                        <label class="form-check-label"
                                                               for="inlineRadio1">{{ translate('Approve the Request') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center mt-4">
                                                <button type="submit"
                                                        class="btn btn--primary">{{ translate('submit') }}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @php($provider_can_edit_booking = (int)(business_config('provider_can_edit_booking', 'service_business_settings'))?->value)

                    @if($provider_can_edit_booking && in_array($booking['booking_status'], ['accepted', 'ongoing']) && $booking?->booking_partial_payments->isEmpty() && empty($booking->customizeBooking))
                        <button class="btn btn--primary btn-outline-primary"
                            data-toggle="modal"
                            data-target="#serviceUpdateModal--{{$booking['id']}}"
                            title="{{translate('Add or remove services')}}">
                            <i class="tio-edit"></i>
                            {{translate('Edit Services')}}
                        </button>
                    @endif

                    <a href="{{route('admin.service.booking.invoice',[$booking->id])}}" class="btn d-flex align-items-center gap-1 btn--primary"  target="_blank">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8.75001 10.9991H4.25001C4.05109 10.9991 3.86033 11.0781 3.71968 11.2187C3.57902 11.3594 3.50001 11.5502 3.50001 11.7491C3.50001 11.948 3.57902 12.1388 3.71968 12.2794C3.86033 12.4201 4.05109 12.4991 4.25001 12.4991H8.75001C8.94892 12.4991 9.13968 12.4201 9.28034 12.2794C9.42099 12.1388 9.50001 11.948 9.50001 11.7491C9.50001 11.5502 9.42099 11.3594 9.28034 11.2187C9.13968 11.0781 8.94892 10.9991 8.75001 10.9991ZM5.75001 6.49907H7.25001C7.44892 6.49907 7.63968 6.42006 7.78034 6.2794C7.92099 6.13875 8.00001 5.94799 8.00001 5.74907C8.00001 5.55016 7.92099 5.3594 7.78034 5.21874C7.63968 5.07809 7.44892 4.99907 7.25001 4.99907H5.75001C5.55109 4.99907 5.36033 5.07809 5.21968 5.21874C5.07902 5.3594 5.00001 5.55016 5.00001 5.74907C5.00001 5.94799 5.07902 6.13875 5.21968 6.2794C5.36033 6.42006 5.55109 6.49907 5.75001 6.49907ZM14.75 7.99907H12.5V1.24907C12.5005 1.11692 12.4661 0.986967 12.4003 0.872384C12.3344 0.757801 12.2395 0.662653 12.125 0.596575C12.011 0.530749 11.8817 0.496094 11.75 0.496094C11.6184 0.496094 11.489 0.530749 11.375 0.596575L9.12501 1.88657L6.87501 0.596575C6.76099 0.530749 6.63166 0.496094 6.50001 0.496094C6.36835 0.496094 6.23902 0.530749 6.12501 0.596575L3.87501 1.88657L1.62501 0.596575C1.51099 0.530749 1.38166 0.496094 1.25001 0.496094C1.11835 0.496094 0.98902 0.530749 0.875006 0.596575C0.760553 0.662653 0.665592 0.757801 0.59974 0.872384C0.533887 0.986967 0.499481 1.11692 0.500006 1.24907V13.2491C0.500006 13.8458 0.737059 14.4181 1.15902 14.8401C1.58097 15.262 2.15327 15.4991 2.75001 15.4991H13.25C13.8467 15.4991 14.419 15.262 14.841 14.8401C15.263 14.4181 15.5 13.8458 15.5 13.2491V8.74907C15.5 8.55016 15.421 8.3594 15.2803 8.21875C15.1397 8.07809 14.9489 7.99907 14.75 7.99907ZM2.75001 13.9991C2.55109 13.9991 2.36033 13.9201 2.21968 13.7794C2.07902 13.6388 2.00001 13.448 2.00001 13.2491V2.54657L3.50001 3.40157C3.61576 3.46203 3.74441 3.49361 3.87501 3.49361C4.0056 3.49361 4.13425 3.46203 4.25001 3.40157L6.50001 2.11157L8.75001 3.40157C8.86576 3.46203 8.99441 3.49361 9.12501 3.49361C9.2556 3.49361 9.38425 3.46203 9.50001 3.40157L11 2.54657V13.2491C11.002 13.5049 11.0477 13.7586 11.135 13.9991H2.75001ZM14 13.2491C14 13.448 13.921 13.6388 13.7803 13.7794C13.6397 13.9201 13.4489 13.9991 13.25 13.9991C13.0511 13.9991 12.8603 13.9201 12.7197 13.7794C12.579 13.6388 12.5 13.448 12.5 13.2491V9.49907H14V13.2491ZM8.75001 7.99907H4.25001C4.05109 7.99907 3.86033 8.07809 3.71968 8.21875C3.57902 8.3594 3.50001 8.55016 3.50001 8.74907C3.50001 8.94799 3.57902 9.13875 3.71968 9.2794C3.86033 9.42006 4.05109 9.49907 4.25001 9.49907H8.75001C8.94892 9.49907 9.13968 9.42006 9.28034 9.2794C9.42099 9.13875 9.50001 8.94799 9.50001 8.74907C9.50001 8.55016 9.42099 8.3594 9.28034 8.21875C9.13968 8.07809 8.94892 7.99907 8.75001 7.99907Z"
                                  fill="white"/>
                        </svg>
                        {{translate('Print Invoice')}}
                    </a>
                </div>
            </div>
        </div>

        @if ($booking->is_verified == 2 && $booking->payment_method == 'cash_after_service' && $max_booking_amount <= $booking->total_booking_amount)
            <div class="border border-danger-light bg-soft-danger rounded py-3 px-3 text-dark">
                <span class="text-danger"># {{ translate('Note: ') }}</span>
                <span>{{ $booking?->bookingDeniedNote?->value }}</span>
            </div>
        @endif

        @if ($booking->is_verified == 0 && $booking->payment_method == 'cash_after_service' && $max_booking_amount <= $booking->total_booking_amount)
            <div class="border border-danger-light bg-soft-danger rounded py-3 px-3 text-dark">
                <span class="text-danger"># {{ translate('Note: ') }}</span>
                <span>
                            {{ translate('You have to verify the booking because of maximum amount exceed') }}
                        </span>
                <span>{{ $booking?->bookingDeniedNote?->value }}</span>
            </div>
        @endif
        @if ($booking->booking_offline_payments->isNotEmpty() && $booking->payment_method == 'offline_payment' && $booking?->booking_offline_payments?->first()?->payment_status != 'approved')
            <div class="border border-danger-light bg-soft-danger rounded py-3 px-3 text-dark">
                @if($booking?->booking_offline_payments?->first()?->payment_status == 'pending')
                    <span>
                        <span class="text-danger fw-semibold"> # {{ translate('Note: ') }} </span>
                        {{ translate('Please Check & Verify the payment information weather it is correct or not before confirm the booking. ') }}
                    </span>
                @endif
                @if($booking?->booking_offline_payments?->first()?->payment_status == 'denied')
                    <span>
                        <span class="text-danger fw-semibold"> # {{ translate('Denied Note: ') }} </span>
                        {{ $booking?->booking_offline_payments?->first()?->denied_note }}
                    </span>
                @endif

            </div>
        @endif
        <div class="mb-4">
            <div class="js-nav-scroller hs-nav-scroller-horizontal mt-2">
                <!-- Nav -->
                <ul class="nav nav-tabs border-0 nav--tabs nav--pills mb-4">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link py-2 px-3 rounded {{$webPage=='details'?'active':''}}" href="{{url()->current()}}?web_page=details">{{translate('details')}}</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link py-2 px-3 rounded {{$webPage=='status'?'active':''}}" href="{{url()->current()}}?web_page=status">{{translate('status')}}</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="home-details" role="tabpanel"
                     aria-labelledby="home-tab-details">
                    <div class="row gy-3">
                        <div class="col-lg-8">
                            <!-- This is Regular Booking Start  -->
                            <div class="card mb-3">
                                <div class="card-body pb-5">
                                    <div class="border-bottom pb-3">
                                        <div class="mb-40">
                                            <h4 class="mb-2">{{translate('Payment Info')}}</h4>
                                            <div
                                                class="d-flex justify-content-between flex-md-nowrap flex-wrap gap-md-3 gap-2 mb-4">
                                                <div class="d-flex flex-column gap-1">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="fz--14px">{{translate('Payment_Method')}}:</span>
                                                        <span class="font-medium" data-text-color="#00B2FF">{{ str_replace(['_', '-'], ' ', $booking->payment_method) }}
                                                            @if($booking->payment_method == 'offline_payment' && $booking?->booking_offline_payments?->first()?->method_name)
                                                                ({{($booking?->booking_offline_payments?->first()?->method_name)}})
                                                            @endif
                                                        </span>
                                                    </div>
                                                    @if($booking->payment_method == 'offline_payment')
                                                        @if($booking->booking_offline_payments->isNotEmpty())
                                                            <div class="d-flex gap-1 flex-column">
                                                                @foreach($booking?->booking_offline_payments?->first()?->customer_information??[] as $key=>$item)
                                                                    <div><span>{{translate($key)}}</span>:
                                                                        <span>{{translate($item)}}</span>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        @else
                                                            <p class="text-muted">{{ translate('Customer did not submit any payment information yet') }}</p>
                                                        @endif
                                                    @endif
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="fz--14px">{{translate('Amount')}} :</span>
                                                        <span class="font-normal" data-text-color="#0461A5"> {{\App\CentralLogics\Helpers::format_currency($booking->total_booking_amount)}}</span>
                                                    </div>
                                                    @if($booking->is_paid == 1)
                                                        <div class="d-flex align-items-center gap-2">
                                                            <span class="fz--14px">{{translate('Payment by')}} :</span>
                                                            <span class="font-normal text-title">{{ $booking->is_guest == 0 ? $booking?->service_address?->contact_person_name : $booking?->customer?->fullName }}</span>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="d-flex flex-column gap-1 text-md-end">
                                                    @if($booking->payment_method == 'offline_payment' && $booking->booking_offline_payments->isNotEmpty())
                                                        <div class="d-flex align-items-center gap-2">
                                                            <span class="fz--14px">{{ translate('Request Verify Status') }} :</span>
{{--                                                            <span class="font-medium"--}}
{{--                                                                  data-text-color="#00B2FF">Accept</span>--}}
                                                            @if($booking?->booking_offline_payments?->first()?->payment_status == 'pending')
                                                                <span class="text-info text-capitalize font-medium">{{ translate('Pending') }}</span>
                                                            @endif
                                                            @if($booking?->booking_offline_payments?->first()?->payment_status == 'denied')
                                                                <span class="text-danger text-capitalize font-medium">{{ translate('Denied') }}</span>
                                                            @endif
                                                            @if($booking?->booking_offline_payments?->first()?->payment_status == 'approved')
                                                                <span class="text-primary text-capitalize font-medium">{{ translate('Approved') }}</span>
                                                            @endif
                                                        </div>
                                                    @endif
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="fz--14px">{{translate('Payment_Status')}} :</span>
{{--                                                        <span class="font-medium"--}}
{{--                                                              data-text-color="#FF6D6D">Unpaid</span>--}}
                                                        <span class="text-{{$booking->is_paid ? 'success' : 'danger'}}"
                                                              id="payment_status__span">{{$booking->is_paid ? translate('Paid') : translate('Unpaid')}}</span>

                                                        @if(!$booking->is_paid && $booking->booking_partial_payments->isNotEmpty())
                                                            <span class="small badge badge-info text-success p-1 fz-10">{{translate('Partially paid')}}</span>
                                                        @endif
                                                    </div>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="fz--14px">{{translate('Booking_Otp')}} :</span>
                                                        <span class="">{{ $booking?->booking_otp ?? '' }}</span>
                                                    </div>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="fz--14px">{{translate('Schedule_Date')}} :</span>
                                                        <span class="font-normal">{{date('d-M-Y h:ia',strtotime($booking->service_schedule))}}</span>
                                                    </div>
                                                </div>
                                            </div>
{{--                                            <div class="alert d-flex flex-sm-nowrap flex-wrap text-title align-items-center gap-1" data-bg-color="#F6F6F6">--}}
{{--                                                <strong data-text-color="#0461A5"># Note:</strong> PLease provide extra layer in the packaging--}}
{{--                                            </div>--}}
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-start gap-2 p-20">
                                        <h3 class="mb-0 text-title">{{translate('Booking_Summary')}}</h3>
                                    </div>

                                    <div class="table-responsive border-bottom p-0">
                                        <table class="table text-nowrap align-middle mb-0">
                                            <thead class="" data-bg-color="#DDECED">
                                            <tr>
                                                <th class="fz--14px fw-semibold text-title ps-lg-3">{{translate('Service')}}</th>
                                                <th class="fz--14px fw-semibold text-title">{{translate('Price')}}</th>
                                                <th class="fz--14px fw-semibold text-title">{{translate('Qty')}}</th>
                                                <th class="fz--14px fw-semibold text-title">{{translate('Discount')}}</th>
                                                <th class="fz--14px fw-semibold text-title text-end">{{translate('Total')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php($sub_total=0)
                                            @foreach($booking->detail as $detail)
                                            <tr>
                                                <td class="text-wrap ps-lg-3">
                                                    <div class="d-flex flex-column">
                                                        @if(isset($detail->service))
                                                            <a href="{{route('admin.service.service.detail',[$detail->service->id])}}" class="font-semibold text-title fz--14px line--limit-2 lh--12">
                                                                {{Str::limit($detail->service->name, 30)}}
                                                            </a>
                                                            <div class="text-capitalize">
                                                                {{Str::limit($detail ? $detail->variant_key : '', 50)}}
{{--                                                                <small--}}
{{--                                                                    class="fz-10 text-capitalize">{{translate('coupon_discount')}}--}}
{{--                                                                    :--}}
{{--                                                                    -{{\App\CentralLogics\Helpers::format_currency($detail->overall_coupon_discount_amount)}}</small>--}}
                                                            </div>
                                                        @else
                                                            <span class="badge badge-pill badge-danger">{{translate('Service not available')}}</span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>{{\App\CentralLogics\Helpers::format_currency($detail->service_cost)}}</td>
                                                <td>
                                                    <span>{{$detail->quantity}}</span>
                                                </td>
                                                <td>
                                                    @if($detail?->discount_amount > 0)
                                                        {{\App\CentralLogics\Helpers::format_currency($detail->discount_amount)}}
                                                    @elseif($detail?->campaign_discount_amount > 0)
                                                        {{\App\CentralLogics\Helpers::format_currency($detail->campaign_discount_amount)}}
{{--                                                        <br><span--}}
{{--                                                            class="fz-12 text-capitalize">{{translate('campaign')}}</span>--}}
                                                    @endif
                                                </td>
                                                <td class="text-end">{{\App\CentralLogics\Helpers::format_currency($detail->total_cost)}}</td>
                                            </tr>
                                            @php($sub_total+=$detail->service_cost*$detail->quantity)
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row justify-content-end mt-3">
                                        <div class="col-sm-10 col-md-6 col-xl-5">
                                            <div class="table-responsive">
                                                <table class="table-md table-space-md title-color align-right w-100">
                                                    <tbody>
                                                    <tr>
                                                        <td class="text-capitalize">{{translate('Sub Total')}} <small
                                                                class="fz-12">({{translate('Vat Excluded')}})</small></td>
                                                        <td class="text-end pe--4">{{\App\CentralLogics\Helpers::format_currency($sub_total)}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-capitalize">{{translate('Discount')}}</td>
                                                        <td class="text-end pe--4">{{\App\CentralLogics\Helpers::format_currency($booking->total_discount_amount)}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-capitalize">{{translate('coupon_discount')}}</td>
                                                        <td class="text-end pe--4">{{\App\CentralLogics\Helpers::format_currency($booking->total_coupon_discount_amount)}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-capitalize">{{translate('campaign_discount')}}</td>
                                                        <td class="text-end pe--4">
                                                            {{\App\CentralLogics\Helpers::format_currency($booking->total_campaign_discount_amount)}}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-capitalize">{{translate('Referral Discount')}}</td>
                                                        <td class="text-end pe--4">
                                                            {{\App\CentralLogics\Helpers::format_currency($booking->total_referral_discount_amount)}}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-capitalize">{{translate('vat_/_tax')}}</td>
                                                        <td class="text-end pe--4">+{{\App\CentralLogics\Helpers::format_currency($booking->total_tax_amount)}}</td>
                                                    </tr>
                                                    @if ($booking->extra_fee > 0)
                                                        @php($additional_charge_label_name = \App\CentralLogics\Helpers::get_business_data('additional_charge_name') ?? 'Fee')
                                                        <tr>
                                                            <td class="text-capitalize">{{ $additional_charge_label_name }}</td>
                                                            <td class="text-end pe--4">
                                                                {{ \App\CentralLogics\Helpers::format_currency($booking->extra_fee) }}</td>
                                                        </tr>
                                                    @endif
                                                    <tr>
                                                        <td class="text-capitalize"><strong>{{translate('Grand_Total')}}</strong></td>
                                                        <td class="text-end pe--4">
                                                            <strong>{{\App\CentralLogics\Helpers::format_currency($booking->total_booking_amount)}}</strong>
                                                        </td>
                                                    </tr>
                                                    @if ($booking->booking_partial_payments->isNotEmpty())
                                                        @foreach($booking->booking_partial_payments as $partial)
                                                            <tr>
                                                                <td class="text-capitalize">{{translate('Paid_by')}} {{str_replace('_', ' ',$partial->paid_with)}}</td>
                                                                <td class="text-end pe--4">{{\App\CentralLogics\Helpers::format_currency($partial->paid_amount)}}</td>
                                                            </tr>
                                                        @endforeach
                                                    @endif

                                                    <?php
                                                    $dueAmount = 0;

                                                    if (!$booking->is_paid && $booking?->booking_partial_payments?->count() == 1) {
                                                        $dueAmount = $booking->booking_partial_payments->first()?->due_amount;
                                                    }

                                                    if (in_array($booking->booking_status, ['pending', 'accepted', 'ongoing']) && $booking->payment_method != 'cash_after_service' && $booking->additional_charge > 0) {
                                                        $dueAmount += $booking->additional_charge;
                                                    }

                                                    if (!$booking->is_paid && $booking->payment_method == 'cash_after_service') {
                                                        $dueAmount = $booking->total_booking_amount;
                                                    }
                                                    ?>

                                                    @if($dueAmount > 0)
                                                        <tr>
                                                            <td class="text-capitalize">{{ translate('Due_Amount') }}</td>
                                                            <td class="text-end pe--4">{{ \App\CentralLogics\Helpers::format_currency($dueAmount) }}</td>
                                                        </tr>
                                                    @endif

                                                    @if($booking->payment_method != 'cash_after_service' && $booking->additional_charge < 0)
                                                        <tr>
                                                            <td class="text-capitalize">{{translate('Refund')}}</td>
                                                            <td class="text-end pe--4">{{\App\CentralLogics\Helpers::format_currency(abs($booking->additional_charge))}}</td>
                                                        </tr>
                                                    @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- This is Regular Booking End  -->
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <h3 class="p-20 mb-0 border-bottom">{{translate('Booking Setup')}}</h3>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center gap-10 form-control mb-3" id="payment-status-div">
                                        <span class="title-color">
                                            {{translate('Payment Status')}}
                                        </span>
                                        <div class="on-off-toggle">
                                            <input class="on-off-toggle__input cursor-pointer {{$booking->booking_status == 'canceled' ? 'canceled_booking' : 'switcher_input'}}"
                                                   value="{{$booking['is_paid'] ? '1' : '0'}}"
                                                   {{$booking['is_paid'] ? 'checked' : ''}} type="checkbox"
                                                   id="payment_status"/>
                                            <label for="payment_status" class="on-off-toggle__slider cursor-pointer">
                                                <span class="on-off-toggle__on">
                                                    <span class="on-off-toggle__text">{{translate('Paid')}}</span>
                                                    <span class="on-off-toggle__circle"></span>
                                                </span>
                                                <span class="on-off-toggle__off">
                                                    <span class="on-off-toggle__circle"></span>
                                                    <span class="on-off-toggle__text">{{translate('Unpaid')}}</span>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                    @if($booking->booking_status != 'pending')
                                        <select name="order_status" class="status form-control js-select2-custom w-100" id="booking_status" {{ $booking->booking_status == 'canceled' ? 'disabled' : '' }}>
                                            @if($booking->booking_status == 'completed')
                                                <option value="completed" {{$booking['booking_status'] == 'completed' ? 'selected' : ''}}>{{translate('Completed')}}</option>
                                            @else
                                                <option value="0">--{{translate('Booking_status')}}--</option>
                                                @if($booking->booking_status == 'pending')
                                                    <option
                                                        value="accepted" {{$booking['booking_status'] == 'accepted' ? 'selected' : ''}} >{{translate('Accepted')}}</option>
                                                @else
                                                    <option
                                                        value="0"
                                                        disabled {{$booking['booking_status'] == 'accepted' ? 'selected' : ''}}>{{translate('Accepted')}}</option>
                                                    <option
                                                        value="ongoing" {{$booking['booking_status'] == 'ongoing' ? 'selected' : ''}}>{{translate('Ongoing')}}</option>
                                                    <option
                                                        value="completed" {{$booking['booking_status'] == 'completed' ? 'selected' : ''}}>{{translate('Completed')}}</option>
                                                    @if((business_config('provider_can_cancel_booking', 'service_business_settings'))->value)
                                                        <option
                                                            value="canceled" {{$booking['booking_status'] == 'canceled' ? 'selected' : ''}}>{{translate('Canceled')}}</option>
                                                    @endif
                                                @endif
                                            @endif
                                        </select>
                                    @endif
                                    <div class="{{ $booking->booking_status == 'canceled' ? 'booking_canceled' : '' }}"></div>

                                    <div class="mt-3" id="change_schedule">
                                        @if(!in_array($booking->booking_status,['ongoing','completed']))
                                            <input type="datetime-local" class="form-control service_schedule"
                                                   name="service_schedule"
                                                   value="{{$booking->service_schedule}}" id="service_schedule"
                                                   min="<?php echo date('Y-m-d\TH:i'); ?>">
                                        @endif
                                    </div>


                                    @if($booking->payment_method == 'offline_payment')
                                        <div class="mt-3 border border-color-primary rounded">
                                            <div class="card">
                                                <div class="card-header bg-light">
                                                    <h5 class="mb-0 font-weight-bold text-center">{{ translate('Offline Payment Verification') }}</h5>
                                                </div>
                                                <div class="card-body">
                                                    @if($booking->booking_offline_payments->isNotEmpty())
                                                        @php($offlinePayment = $booking->booking_offline_payments->first())
                                                        @php($paymentStatus = $offlinePayment->payment_status)

                                                        <!-- Payment Status Badge -->
                                                        <div class="text-center mb-4">
                                                            @if($paymentStatus == 'pending')
                                                                <span class="badge badge-warning p-2">
                                                                    <i class="tio-time"></i> {{ translate('Pending Verification') }}
                                                                </span>
                                                            @elseif($paymentStatus == 'approved')
                                                                <span class="badge badge-success p-2">
                                                                    <i class="tio-check-circle"></i> {{ translate('Payment Verified') }}
                                                                </span>
                                                            @elseif($paymentStatus == 'denied')
                                                                <span class="badge badge-danger p-2">
                                                                    <i class="tio-clear-circle"></i> {{ translate('Payment Denied') }}
                                                                </span>
                                                            @endif
                                                        </div>

                                                        <!-- Payment Details -->
                                                        <div class="border rounded p-3 mb-4">
                                                            <h6 class="font-weight-bold mb-3">{{ translate('Payment Details') }}</h6>
                                                            <div class="table-responsive">
                                                                <table class="table table-borderless table-sm">
                                                                    <tbody>
                                                                        @php($hasPaymentInfo = false)
                                                                        @foreach ($offlinePayment->customer_information ?? [] as $key => $value)
                                                                            @if(!in_array($key, ['payment_note', 'additional_notes']) && !empty($value))
                                                                                @php($hasPaymentInfo = true)
                                                                                <tr>
                                                                                    <td class="text-muted" width="40%">{{ translate(ucfirst(str_replace('_', ' ', $key))) }}:</td>
                                                                                    <td class="font-weight-medium">{{ $value }}</td>
                                                                                </tr>
                                                                            @endif
                                                                        @endforeach
                                                                        @if(!$hasPaymentInfo)
                                                                            <tr>
                                                                                <td colspan="2" class="text-center text-muted">
                                                                                    <i class="tio-info-outlined"></i> {{ translate('No payment details provided') }}
                                                                                </td>
                                                                            </tr>
                                                                        @endif
                                                                    </tbody>
                                                                </table>
                                                            </div>

                                                            @if(!empty($offlinePayment->customer_information['payment_note']))
                                                                <div class="bg-light p-3 rounded mt-3">
                                                                    <h6 class="font-weight-bold mb-2">{{ translate('Payment Note') }}</h6>
                                                                    <p class="mb-0">{{ $offlinePayment->customer_information['payment_note'] }}</p>
                                                                </div>
                                                            @endif
                                                        </div>

                                                        <!-- Action Buttons -->
                                                        @if($paymentStatus == 'pending')
                                                            <div class="d-flex flex-column gap-2">
                                                                <button type="button" class="btn btn-success btn-block py-2 verify-payment" data-status="approved">
                                                                    <i class="tio-check-circle-outlined"></i> {{ translate('Approve Payment') }}
                                                                </button>
                                                                <button type="button" class="btn btn-outline-danger btn-block py-2" data-toggle="modal" data-target="#denyPaymentModal-{{$booking->id}}">
                                                                    <i class="tio-clear-circle-outlined"></i> {{ translate('Deny Payment') }}
                                                                </button>
                                                            </div>
                                                        @elseif($paymentStatus == 'denied' && $booking->booking_status != 'canceled')
                                                            <div class="d-flex flex-column gap-2">
                                                                <button type="button" class="btn btn-outline-primary btn-block py-2 switch-to-cash-after-service">
                                                                    <i class="tio-swap-horiz"></i> {{ translate('Switch to Cash After Service') }}
                                                                </button>
                                                                <button type="button" class="btn btn-outline-danger btn-block py-2 change-booking-status">
                                                                    <i class="tio-cancel"></i> {{ translate('Cancel Booking') }}
                                                                </button>
                                                            </div>
                                                        @elseif($paymentStatus == 'approved')
                                                            <div class="alert alert-success mb-0">
                                                                <i class="tio-check-circle"></i>
                                                                {{ translate('Payment was approved on ') }}
                                                                {{ date('M d, Y h:i A', strtotime($offlinePayment->updated_at)) }}
                                                            </div>
                                                        @endif

                                                    @else
                                                        <div class="text-center py-4">
                                                            <img src="{{ asset('public/assets/admin/img/offline_payment.png') }}" alt="Payment Icon" class="mb-3" style="max-height: 80px;">
                                                            <p class="text-muted mb-4">{{ translate('No payment information has been submitted for this booking') }}</p>

                                                            @if($booking->booking_status != 'canceled')
                                                                <div class="d-flex flex-column gap-2">
                                                                    <button type="button" class="btn btn-outline-primary btn-block py-2 switch-to-cash-after-service">
                                                                        <i class="tio-swap-horiz"></i> {{ translate('Switch to Cash After Service') }}
                                                                    </button>
                                                                    <button type="button" class="btn btn-outline-danger btn-block py-2 change-booking-status">
                                                                        <i class="tio-cancel"></i> {{ translate('Cancel Booking') }}
                                                                    </button>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Deny Payment Modal -->
                                        <div class="modal fade" id="denyPaymentModal-{{$booking->id}}" tabindex="-1" role="dialog" aria-labelledby="denyPaymentModalLabel-{{$booking->id}}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="denyPaymentModalLabel-{{$booking->id}}">{{ translate('Deny Payment') }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form id="denyPaymentForm-{{$booking->id}}">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="denyReason-{{$booking->id}}">{{ translate('Reason for Denial') }} <span class="text-danger">*</span></label>
                                                                <textarea class="form-control" id="denyReason-{{$booking->id}}" name="deny_reason" rows="3" required placeholder="{{ translate('Please specify the reason for denying this payment...') }}"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ translate('Cancel') }}</button>
                                                            <button type="submit" class="btn btn-danger">{{ translate('Confirm Deny') }}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="mt-3">
                                        <div class="modal fade" id="upload_picture_modal" data-backdrop="static"
                                             tabindex="-1" aria-labelledby="upload_picture_modalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header border-0">
                                                        <button type="button" class="btn-close" data-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h3 class="text-center mb-4">{{translate('Upload_Picture_Before_Completing_The')}}
                                                            <br class="d-none d-sm-block"> {{translate('Service')}} ? </h3>
                                                        <form id="uploadPictureForm" name="uploadPictureForm"
                                                              enctype="multipart/form-data" action="javascript:void(0)">
                                                            @csrf
                                                            <div class="d-flex justify-content-center">
                                                                <div class="mx-auto">
                                                                    <div class="d-flex flex-wrap gap-3 __new-coba"
                                                                         id="evidence-photoss"></div>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex gap-4 flex-wrap justify-content-center mt-20">
                                                                <button type="button" class="btn btn--secondary"
                                                                        id="skip_button">Skip
                                                                </button>
                                                                <button type="submit"
                                                                        class="btn btn--primary">{{translate('Save')}}</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="otpModal" tabindex="-1" data-backdrop="static"
                                             aria-labelledby="otpModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header border-0">
                                                        <button type="button" class="btn-close" data-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="otp-form mx-auto" id="otp_form" name="otp_form"
                                                              enctype="multipart/form-data" action="javascript:void(0)">
                                                            <h4 class="text-center mb-5">{{translate('Please Collect OTP from your customer
                                                        &
                                                        Insert Here')}}</h4>
                                                            <div
                                                                class="d-flex gap-2 gap-sm-3 align-items-end justify-content-center">
                                                                <input class="otp-field" type="number" name="otp_field[]"
                                                                       maxlength="1" autofocus>
                                                                <input class="otp-field" type="number" name="otp_field[]"
                                                                       maxlength="1" autocomplete="off">
                                                                <input class="otp-field" type="number" name="otp_field[]"
                                                                       maxlength="1" autocomplete="off">
                                                                <input class="otp-field" type="number" name="otp_field[]"
                                                                       maxlength="1" autocomplete="off">
                                                                <input class="otp-field" type="number" name="otp_field[]"
                                                                       maxlength="1" autocomplete="off">
                                                                <input class="otp-field" type="number" name="otp_field[]"
                                                                       maxlength="1" autocomplete="off">
                                                            </div>

                                                            <input class="otp-value" type="hidden" name="opt-value">

                                                            <div class="d-flex justify-content-between gap-2 mb-5 mt-30">
                                                        <span
                                                            class="text-muted">{{translate('Did not get any OTP')}} ?</span>
                                                                <span
                                                                    class="text-muted cursor-pointer resend-otp">{{translate('Resend it')}}</span>
                                                            </div>

                                                            <div class="d-flex justify-content-center mb-4">
                                                                <button type="submit"
                                                                        class="btn btn--primary">{{translate('Submit')}}</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div></div>
                                        @if($booking->evidence_photos && $booking->booking_status == 'completed')
                                            <div class="bg-light rounded-8">
                                                <div class="border-bottom d-flex align-items-center justify-content-between gap-2 py-3 px-4">
                                                    <h4 class="d-flex align-items-center gap-2">
                                                        <span class="material-icons title-color">image</span>
                                                        {{translate('uploaded_Images')}}
                                                    </h4>
                                                </div>

                                                <div class="py-3 px-4">
                                                    <div class="d-flex flex-wrap gap-3 justify-content-lg-start">
                                                        @foreach ($booking->evidence_photos_full_path ?? [] as $key => $img)
                                                            <img width="100" class="max-height-100"
                                                                 src="{{ $img }}">
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                        @php($serviceAtProviderPlace = (int)((business_config('service_at_provider_place', 'service_business_settings'))->value ?? 0))
                                    <div class="bg-light rounded-8 mb-20">
                                        <div class="border-bottom d-flex align-items-center justify-content-between gap-2 py-3 px-4 mb-2 mt-20">
                                            <h4 class="d-flex align-items-center gap-2 mb-0">
                                                <i class="tio-poi opacity-50"></i>
                                                {{ translate('Service_location') }}
                                            </h4>
                                            @if($serviceAtProviderPlace == 1 && $booking->booking_status != 'pending' && $booking->booking_status != 'completed'  && $booking->booking_status != 'canceled')
                                                 <?php
                                                    $serviceAtCustomer = getProviderSettings(
                                                        providerId: $booking->provider_id,
                                                        key: 'service_at_customer_location',
                                                        type: 'provider_config'
                                                    );

                                                    $serviceAtProvider = getProviderSettings(
                                                        providerId: $booking->provider_id,
                                                        key: 'service_at_provider_location',
                                                        type: 'provider_config'
                                                    );
                                                ?>

                                                @if($serviceAtCustomer == 1 && $serviceAtProvider == 1)
                                                    <a href="#0" type="button"
                                                       class="btn action-btn btn--primary btn-outline-primary"
                                                       style="--size: 30px"
                                                       data-toggle="modal"
                                                       data-target="#serviceLocationModal--{{ $booking['id'] }}" data-placement="top">
                                                        <i class="tio-edit"></i>
                                                    </a>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="p-3">
                                            @if($booking->service_location == 'provider')
                                                <div class="px-3 py-2 rounded text-title mb-3 fz--14px" data-bg-color="#FFDB71">
                                                    {{translate('Provider has to go to the Customer Location to provide the service')}}
                                                </div>
                                                @if($booking->provider_id != null)
                                                    @if($booking->provider)
                                                        <h6 class="mb-0 fz--14px" data-text-color="#334257B2">{{translate('messages.Service Location')}}:</h6>
                                                        <div class="d-flex justify-content-between align-items-center gap-2">
                                                            <span class="fs-12" data-text-color="#334257">{{ Str::limit($booking?->provider?->company_address ?? translate('not_available'), 100) }}</span>
                                                            <a href="#0" type="button"
                                                               class="btn action-btn min-w-32 btn--primary btn-outline-primary"
                                                               style="--size: 30px">
                                                                <i class="tio-poi"></i>
                                                            </a>
                                                        </div>
                                                    @else
                                                        <p>{{ translate('Provider Unavailable') }}</p>
                                                    @endif
                                                @else
                                                    <h5 class="mb-1">{{ translate('Service Location') }}:</h5>
                                                    <p>{{ translate('The Service Location will be available after this booking accepts or assign to a provider') }}</p>
                                                @endif
                                            @else
                                                <div class="px-3 py-2 rounded text-title mb-3 fz--14px" data-bg-color="#FFDB71">
                                                    {{ translate('You need to go to the Customer Location to provide the service') }}
                                                </div>
                                                <h6 class="mb-0 fz--14px" data-text-color="#334257B2">{{translate('messages.Service Location:')}}</h6>
                                                <div class="d-flex justify-content-between align-items-center gap-2">
                                                    <span class="fs-12" data-text-color="#334257">{{ Str::limit($booking?->service_address?->address ?? translate('not_available'), 100) }}</span>
                                                    <span class="btn action-btn min-w-32 btn--primary btn-outline-primary"
                                                          style="--size: 30px; pointer-events: none;">
                                                        <i class="tio-poi"></i>
                                                    </span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="bg-light rounded-8 mb-20">
                                        <div class="border-bottom d-flex align-items-center justify-content-between gap-2 py-3 px-4 mb-2 mt-20">
                                            <h4 class="d-flex align-items-center gap-2 mb-0">
                                                <i class="tio-user-big opacity-50"></i>
                                                {{translate('Customer_Information')}}
                                            </h4>
                                            {{--                                            TODO: need to implement chat with customer--}}
                                            {{--                                            @if(!$booking?->is_guest && $booking?->customer)--}}
                                            {{--                                                <div class="btn-group">--}}
                                            {{--                                                    <div class="cursor-pointer" data-toggle="dropdown" aria-expanded="false">--}}
                                            {{--                                                        <i class="tio-more-vertical fz-24"></i>--}}
                                            {{--                                                    </div>--}}
                                            {{--                                                    <ul class="dropdown-menu border-none dropdown-menu-right px-3">--}}
                                            {{--                                                        <li>--}}
                                            {{--                                                            <div class="d-flex align-items-center text-nowrap gap-2 cursor-pointer text-title">--}}
                                            {{--                                                                <i class="tio-sms-chat"></i>--}}
                                            {{--                                                                {{translate('Chat With Customer')}}--}}
                                            {{--                                                            </div>--}}
                                            {{--                                                        </li>--}}
                                            {{--                                                    </ul>--}}
                                            {{--                                                </div>--}}
                                            {{--                                            @endif--}}
                                        </div>
                                        <div class="p-3 d-flex gap-2">

                                            @php($customer_name = $booking?->service_address?->contact_person_name)
                                            @php($customer_phone = $booking?->service_address?->contact_person_number)
                                            @if(!$booking?->is_guest && $booking?->customer)
                                                <img width="58" height="58" class="rounded-circle border border-white aspect-square object-fit-cover"
                                                     src="{{$booking?->customer?->image_full_url}}" alt="{{translate('user_image')}}">
                                            @else
                                                <img width="56" height="56" src="{{asset('/public/assets/admin/img/160x160/img10.jpg')}}" alt="img" class="rounded-circle">
                                            @endif
                                            <div>
                                                <span class="font-semibold mb-1 d-block text-title fz--14px">{{Str::limit($customer_name??'', 30)}}</span>
                                                <span class="font-semibold d-block text-title fz-12px mb-2">{{$customer_phone}}</span>
                                                @if(!empty($booking?->service_address?->address))
                                                    <p class="fz--14px">{{Str::limit($booking?->service_address?->address??translate('not_available'), 100)}}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-light rounded-8 mb-20">
                                        <div class="border-bottom d-flex align-items-center justify-content-between gap-2 py-3 px-4 mt-20">
                                            <h4 class="d-flex align-items-center gap-2 mb-0">
                                                <i class="tio-user-big opacity-50"></i>
                                                {{translate('Provider Information')}}
                                            </h4>
                                            @if (isset($booking->provider))
                                                @if (in_array($booking->booking_status, ['ongoing', 'accepted']))
                                                <div class="btn-group">
                                                    <div class="cursor-pointer" data-toggle="dropdown" aria-expanded="false">
                                                        <i class="tio-more-vertical fz-24"></i>
                                                    </div>
                                                    <ul class="dropdown-menu border-none dropdown-menu-right px-3">
{{--                                                        <li class="mb-2">--}}
{{--                                                            <div class="d-flex align-items-center gap-2 cursor-pointer provider-chat flex-nowrap">--}}
{{--                                                                <i class="tio-chat"></i>--}}
{{--                                                                <span class="text-nowrap text-dark">{{ translate('chat_with_Provider') }}</span>--}}
{{--                                                                <form action=""--}}
{{--                                                                      method="post" id="chatForm-{{ $booking->id }}">--}}
{{--                                                                    @csrf--}}
{{--                                                                    <input type="hidden" name="provider_id"--}}
{{--                                                                           value="{{ $booking?->provider?->owner?->id }}">--}}
{{--                                                                    <input type="hidden" name="type" value="booking">--}}
{{--                                                                    <input type="hidden" name="user_type"--}}
{{--                                                                           value="provider-admin">--}}
{{--                                                                </form>--}}
{{--                                                            </div>--}}
{{--                                                        </li>--}}

                                                        <li class="mb-2">
                                                            <div class="d-flex align-items-center text-nowrap gap-2 cursor-pointer text-title"
                                                                 data-target="#providerModal" data-toggle="modal">
                                                                <i class="tio-edit"></i>
                                                                {{ translate('change_Provider') }}
                                                            </div>
                                                        </li>
                                                        <li class="mb-2">
                                                            <div class="d-flex align-items-center text-nowrap gap-2 cursor-pointer text-title">
                                                                <a class="text-dark"
                                                                   href="{{ route('admin.service.provider.details', [$booking?->provider?->id, 'web_page' => 'overview']) }}">
                                                                    <i class="tio-user"></i>
                                                                    {{ translate('View_Details') }}
                                                                </a>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                @endif
                                            @endif
                                        </div>
                                        @if (isset($booking->provider))
                                            <div class="py-3 px-4">
                                                <div class="media gap-2 flex-wrap">
                                                    <img width="58" height="58" class="rounded-circle border border-white aspect-square object-fit-cover"
                                                         src="{{$booking?->provider?->logo_full_path}}" alt="{{translate('provider')}}">
                                                    <div class="media-body">
                                                        <h5 class="c1 mb-3">{{Str::limit($booking->provider && $booking->provider ? $booking->provider->company_name : '', 30)}}</h5>
                                                        {{--                                                        <ul class="list-info">--}}
                                                        {{--                                                            <li>--}}
                                                        <i class="tio-call"></i>
                                                        <a href="tel:{{$booking->provider ? $booking->provider->company_phone:''}}">
                                                            {{$booking->provider ? $booking->provider->company_phone : ''}}
                                                        </a>
                                                        {{--                                                            </li>--}}
                                                        {{--                                                        </ul>--}}
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="py-4 px-3 d-flex align-items-center justify-content-center gap-2">
                                                <div class="text-center">
                                                    <i class="tio-account-circle fz-24 opacity-50"></i>
                                                    <span class="font-semibold mb-3 d-block fz--14px mt-2">{{translate('No Provider assigned')}}</span>
                                                    <button
                                                        class="btn btn--primary"
                                                        data-target="#providerModal"
                                                        data-toggle="modal"
                                                        @if($booking['booking_status'] == 'completed' || $booking['booking_status'] == 'canceled')
                                                            disabled
                                                        @endif>
                                                        {{ translate('assign Provider') }}
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="bg-light rounded-8 mb-20">
                                        <div class="border-bottom d-flex align-items-center justify-content-between gap-2 py-3 px-4 mt-20">
                                            <h4 class="d-flex align-items-center gap-2 mb-0">
                                                <i class="tio-user-big opacity-50"></i>
                                                {{translate('Serviceman Information')}}
                                            </h4>
                                            @if (isset($booking->serviceman))

                                                <div class="btn-group">
                                                    <div class="cursor-pointer" data-toggle="dropdown" aria-expanded="false">
                                                        <i class="tio-more-vertical fz-24"></i>
                                                    </div>
                                                    <ul class="dropdown-menu border-none dropdown-menu-right px-3">
                                                        @if (in_array($booking->booking_status, ['ongoing', 'accepted']))
                                                        <li class="mb-2">
                                                            <div class="d-flex align-items-center text-nowrap gap-2 cursor-pointer text-title"
                                                                 data-target="#servicemanModal" data-toggle="modal">
                                                                <i class="tio-edit"></i>
                                                                {{ translate('change serviceman') }}
                                                            </div>
                                                        </li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>
                                        @if (isset($booking->serviceman))
                                            <div class="py-3 px-4">
                                                <div class="media gap-2 flex-wrap">
                                                    <img width="58" height="58" class="rounded-circle border border-white aspect-square object-fit-cover"
                                                         src="{{$booking?->serviceman?->profile_image_full_path}}" alt="{{translate('serviceman')}}">
                                                    <div class="media-body">
                                                        <h5 class="c1 mb-3">{{Str::limit($booking->serviceman && $booking->serviceman ? $booking->serviceman->first_name.' '.$booking->serviceman->last_name:'', 30)}}</h5>
{{--                                                        <ul class="list-info">--}}
{{--                                                            <li>--}}
                                                                <i class="tio-call"></i>
                                                                <a href="tel:{{$booking->serviceman && $booking->serviceman ? $booking->serviceman->phone:''}}">
                                                                    {{$booking->serviceman && $booking->serviceman ? $booking->serviceman->phone:''}}
                                                                </a>
{{--                                                            </li>--}}
{{--                                                        </ul>--}}
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="py-4 px-3 d-flex align-items-center justify-content-center gap-2">
                                                <div class="text-center">
                                                    <i class="tio-account-circle fz-24 opacity-50"></i>
                                                    <span class="font-semibold mb-3 d-block fz--14px mt-2">{{translate('No Serviceman assigned')}}</span>
                                                    <button
                                                        class="btn btn--primary"
                                                        data-target="#servicemanModal"
                                                        data-toggle="modal"
                                                        @if($booking['booking_status'] == 'completed' || $booking['booking_status'] == 'pending' || $booking['booking_status'] == 'canceled' || !isset($booking->provider))
                                                            disabled
                                                        @endif>
                                                        {{ translate('assign Serviceman') }}
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="profile-details" role="tabpanel" aria-labelledby="profile-tab-details">

                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="changeScheduleModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
         aria-labelledby="changeScheduleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeScheduleModalLabel">{{translate('Change_Booking_Schedule')}}</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="datetime-local" id="service_schedule" name="service_schedule" class="form-control"
                           value="{{$booking->service_schedule}}">
                </div>
                <div class="p-3 d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{translate('Close')}}</button>
                    <button type="button" class="btn btn-primary"
                            id="service_schedule__submit">{{translate('Submit')}}</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="servicemanModal" tabindex="-1" aria-labelledby="servicemanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content modal-content-data1" id="modal-data-info1">
                @include('service::admin.BookingModule.partials.details.serviceman-info-modal-data')
            </div>
        </div>
    </div>

    @include('service::admin.BookingModule.partials.details._service-modal')

{{--    @include('service::admin.BookingModule.partials.details._service-address-modal')--}}

    @include('service::admin.BookingModule.partials.details._service-location-modal')

    @include('service::admin.BookingModule.partials.details._update-customer-address-modal')


    <div class="modal fade" id="providerModal" tabindex="-1" aria-labelledby="providerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content modal-content-data" id="modal-data-info">
                @include('service::admin.BookingModule.partials.details.provider-info-modal-data')
            </div>
        </div>
    </div>

    <div class="modal fade" id="deniedModal-{{$booking->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body pt-5 p-md-5">
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    <div class="d-flex justify-content-center mb-4">
                        <img width="75" height="75" src="{{asset('public/assets/admin-module/img/icons/info-round.svg')}}" class="rounded-circle" alt="">
                    </div>

                    <h3 class="text-start mb-1 fw-medium text-center">{{translate('Are you sure you want to deny?')}}</h3>
                    <p class="text-start fs-12 fw-medium text-muted text-center">{{translate('Please insert the deny note for this payment request')}}</p>
                    <form method="post" action="{{route('admin.service.booking.offline-payment.verify',['booking_id' => $booking->id, 'payment_status' => 'denied'])}}">
                        @csrf
                        <div class="form-floating">
                            <textarea class="form-control h-69px" placeholder="{{translate('Type here your note')}}" name="note" id="add-your-note" maxlength="255" required></textarea>
                            <label for="add-your-note" class="d-flex align-items-center gap-1">{{translate('Deny Note')}}</label>
                            <div class="d-flex justify-content-center mt-3 gap-3">
                                <button type="button" class="btn btn--secondary min-w-92px px-2" data-dismiss="modal" aria-label="Close">{{translate('Not Now')}}</button>
                                <button type="submit" class="btn btn-primary min-w-92px">{{translate('Submit')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script_2')

    <script type="text/javascript">
        "use strict";

        // Handle offline payment verification
        $(document).on('click', '.verify-payment', function(e) {
            e.preventDefault();
            let bookingId = '{{ $booking->id }}';
            let button = $(this);

            Swal.fire({
                title: '{{ translate("Are you sure?") }}',
                text: '{{ translate("You are about to approve this payment. This action cannot be undone.") }}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#107980',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{ translate("Yes, approve it!") }}',
                cancelButtonText: '{{ translate("Cancel") }}',
                reverseButtons: true,
                allowOutsideClick: false,
                allowEscapeKey: false
            }).then(function(result) {
                if (result && result.value) {
                    processPaymentVerification(bookingId, 'approved');
                } else if (result && result.dismiss === Swal.DismissReason.cancel) {
                    // User clicked cancel
                    return false;
                }
            }).catch(swal.noop);
        });

        // Handle deny payment form submission
        $(document).on('submit', '[id^=denyPaymentForm]', function(e) {
            e.preventDefault();
            let form = $(this);
            let bookingId = '{{ $booking->id }}';
            let reason = form.find('textarea[name="deny_reason"]').val().trim();

            if (!reason) {
                toastr.error('{{ translate("Please provide a reason for denial") }}');
                return false;
            }

            processPaymentVerification(bookingId, 'denied', reason);
            form.closest('.modal').modal('hide');
            form[0].reset();
            return false;
        });

        // Process payment verification via AJAX
        function processPaymentVerification(bookingId, status, reason = '') {
            // Get the appropriate button based on the action
            let button = status === 'approved' ? $('.verify-payment') : $('.deny-payment');
            let buttonText = button.html();

            button.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> {{ translate("Processing...") }}');

            // Prepare form data
            let formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('booking_id', bookingId);
            formData.append('status', status);

            // Add reason for denied payments
            if (status === 'denied' && reason) {
                formData.append('deny_reason', reason);
            }

            console.log('Sending request with data:', {
                booking_id: bookingId,
                status: status,
                deny_reason: status === 'denied' ? reason : 'N/A'
            });

            $.ajax({
                url: '{{ route("admin.service.booking.offline-payment.verify") }}',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.message) {
                        toastr.success(response.message);
                    }

                    // Small delay to show success message before reload
                    setTimeout(() => {
                        if (response.redirect_url) {
                            window.location.href = response.redirect_url;
                        } else {
                            window.location.reload();
                        }
                    }, 1000);
                },
                error: function(xhr) {
                    let errorMessage = xhr.responseJSON?.message || '{{ translate("An error occurred. Please try again.") }}';
                    toastr.error(errorMessage);
                    button.prop('disabled', false).html(buttonText);
                    console.error('Error:', xhr.responseText || xhr.statusText);
                }
            });
        }

        // Handle switch to cash after service
        $(document).on('click', '.switch-to-cash-after-service', function() {
            Swal.fire({
                title: '{{ translate("Switch to Cash After Service") }}',
                text: '{{ translate("Are you sure you want to switch this booking to cash after service?") }}',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#107980',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{ translate("Yes, switch it!") }}',
                cancelButtonText: '{{ translate("Cancel") }}',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    window.location.href = '{{ route("admin.service.booking.switch-payment-method", ["id" => $booking->id]) }}';
                }
            });
        });

        $(document).ready(function() {

            $('.cancellation-note').hide();

            $('.deny-request').click(function() {
                $('.cancellation-note').show();
            });

            $('.approve-request').click(function() {
                $('.cancellation-note').hide();
            });
        });


        $(document).ready(function () {
            $("#customerAddressModalSubmit").on("submit", function (e) {
                e.preventDefault(); // Prevent form submission

                var bookingId = "{{ $booking['id'] }}";

                let customerAddressModal = $("#customerAddressModal--" + bookingId);
                let serviceLocationModal = $("#serviceLocationModal--" + bookingId);

                // Copy updated data from customerAddressModal inputs
                let contactPersonName = customerAddressModal.find("input[name='contact_person_name']").val();
                let contactPersonNumber = customerAddressModal.find("input[name='contact_person_number_with_code']").val();
                let addressLabel = customerAddressModal.find("select[name='address_label']").val();
                let address = customerAddressModal.find("input[name='address']").val();
                let latitude = customerAddressModal.find("input[name='latitude']").val();
                let longitude = customerAddressModal.find("input[name='longitude']").val();
                let city = customerAddressModal.find("input[name='city']").val();
                let street = customerAddressModal.find("input[name='street']").val();
                let zipCode = customerAddressModal.find("input[name='zip_code']").val();
                let country = customerAddressModal.find("input[name='country']").val();

                // Update the corresponding hidden inputs in serviceLocationModal
                serviceLocationModal.find("input[name='contact_person_name']").val(contactPersonName);
                serviceLocationModal.find("input[name='contact_person_number']").val(contactPersonNumber);
                serviceLocationModal.find("input[name='address_label']").val(addressLabel);
                serviceLocationModal.find("input[name='address']").val(address);
                serviceLocationModal.find("input[name='latitude']").val(latitude);
                serviceLocationModal.find("input[name='longitude']").val(longitude);
                serviceLocationModal.find("input[name='city']").val(city);
                serviceLocationModal.find("input[name='street']").val(street);
                serviceLocationModal.find("input[name='zip_code']").val(zipCode);
                serviceLocationModal.find("input[name='country']").val(country);

                $('.updated_customer_name').text(contactPersonName); // Update the customer name
                $('#updated_customer_phone').text(contactPersonNumber); // Update the customer
                $('#customer_service_location').removeClass('text-danger'); // Update the customer service location
                $('#customer_service_location').text(address); // Update the customer service location
                $('.customer-address-update-btn').removeAttr('disabled'); // Update the customer service location update button

                // Close the customerAddressModal
                customerAddressModal.modal("hide");

                // Open the serviceLocationModal to show updated data
                serviceLocationModal.modal("show");
            });
        });

        $(".switch-to-cash-after-service").on('click', function() {
            var payment_method = 'cash_after_service';
            var route = '{{ route('admin.service.booking.switch-payment-method', [$booking->id]) }}' + '?payment_method=' + payment_method;
            update_booking_details(route, '{{ translate('want_to_switch_payment_method_to_cash_after_service') }}', 'payment_method', payment_method);
        });

        $(".change-booking-status").on('click', function() {
            var booking_status = 'canceled';
            var route = '{{ route('admin.service.booking.status_update', [$booking->id]) }}' + '?booking_status=' + booking_status;
            update_booking_details(route, '{{ translate('want_to_cancel_booking_status') }}', 'booking_status', booking_status);
        });

        $(".remove-service-row").on('click', function (){
            let row = $(this).data('row');
            removeServiceRow(row)
        })

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('keyup', '.search-form-input1', function() {
                const route = '{{ url('admin/service/booking/serviceman-update', $booking->id) }}';
                let searchTerm = $('.search-form-input1').val();

                $.ajax({
                    url: route,
                    type: 'PUT',
                    dataType: 'json',
                    data: {
                        booking_id: "{{ $booking->id }}",
                        search: searchTerm,
                    },
                    beforeSend: function() {},
                    success: function(response) {
                        $('.modal-content-data1').html(response.view);
                    },
                    complete: function() {},
                    error: function(xhr) {
                        if (xhr.status === 419) {
                            toastr.error('{{ translate('Session expired, please refresh the page.') }}');
                        } else {
                            toastr.error('{{ translate('Failed to load') }}');
                        }
                    }
                });
            });

            $(document).on('keyup', '.search-form-input', function() {
                const route = '{{ url('admin/service/booking/available-provider') }}';
                let sortOption = document.querySelector('input[name="sort"]:checked').value;
                let bookingId = "{{ $booking->id }}";
                let searchTerm = $('.search-form-input').val();

                $.get({
                    url: route,
                    dataType: 'json',
                    data: {
                        sort_by: sortOption,
                        booking_id: bookingId,
                        search: searchTerm,
                    },
                    beforeSend: function() {},
                    success: function(response) {
                        $('.modal-content-data').html(response.view);


                        var cursorPosition = searchTerm.lastIndexOf(searchTerm.charAt(searchTerm
                            .length - 1)) + 1;
                        $('.search-form-input').focus().get(0).setSelectionRange(cursorPosition,
                            cursorPosition);
                    },
                    complete: function() {},
                    error: function() {
                        toastr.error('{{ translate('Failed to load') }}');
                    }
                });
            });

        });

        $('.reassign-provider').on('click', function() {
            let id = $(this).data('provider-reassign');
            updateProvider(id)
        })

        function updateProvider(providerId) {
            const bookingId = "{{ $booking->id }}";
            const route = '{{ url('admin/service/booking/reassign-provider') }}' + '/' + bookingId;
            const sortOption = document.querySelector('input[name="sort"]:checked').value;
            const searchTerm = $('.search-form-input').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: route,
                type: 'PUT',
                dataType: 'json',
                data: {
                    sort_by: sortOption,
                    booking_id: bookingId,
                    search: searchTerm,
                    provider_id: providerId
                },
                beforeSend: function () {
                    toastr.info('{{ translate('Processing request...') }}');
                },
                success: function (response) {
                    $('.modal-content-data').html(response.view);
                    toastr.success('{{ translate('Successfully reassign provider') }}');
                    setTimeout(function () {
                        location.reload()
                    }, 600);
                },
                complete: function () {
                },
                error: function () {
                    toastr.error('{{ translate('Failed to load') }}');
                }
            });
        }

        $(document).ready(function () {
            $('#category_selector__select').select2({dropdownParent: "#serviceUpdateModal--{{$booking['id']}}"});
            $('#sub_category_selector__select').select2({dropdownParent: "#serviceUpdateModal--{{$booking['id']}}"});
            $('#service_selector__select').select2({dropdownParent: "#serviceUpdateModal--{{$booking['id']}}"});
            $('#service_variation_selector__select').select2({dropdownParent: "#serviceUpdateModal--{{$booking['id']}}"});
        });

        $("#service_selector__select").on('change', function () {
            $("#service_variation_selector__select").html('<option value="" selected disabled>{{translate('Select Service Variant')}}</option>');

            const serviceId = this.value;
            const route = '{{route('admin.service.booking.service.ajax-get-variant')}}' + '?service_id=' + serviceId + '&zone_id=' + "{{$booking->zone_id}}";

            $.get({
                url: route,
                dataType: 'json',
                data: {},
                beforeSend: function () {
                    $('.preloader').show();
                },
                success: function (response) {
                    var selectString = '<option value="" selected disabled>{{translate('Select Service Variant')}}</option>';
                    response.content.forEach((item) => {
                        selectString += `<option value="${item.variant_key}">${item.variant}</option>`;
                    });
                    $("#service_variation_selector__select").html(selectString)
                },
                complete: function () {
                    $('.preloader').hide();
                },
                error: function () {
                    toastr.error('{{translate('Failed to load')}}')
                }
            });
        })

        $("#serviceUpdateModal--{{$booking['id']}}").on('hidden.bs.modal', function () {
            $('#service_selector__select').prop('selectedIndex', 0);
            $("#service_variation_selector__select").html('<option value="" selected disabled>{{translate('Select Service Variant')}}</option>');
            $("#service_quantity").val('');
        });

        $("#add-service").on('click', function () {
            const service_id = $("[name='service_id']").val();
            const variant_key = $("[name='variant_key']").val();
            const quantity = parseInt($("[name='service_quantity']").val());
            const zone_id = '{{$booking->zone_id}}';

            if (service_id === '' || service_id === null) {
                toastr.error('{{translate('Select a service')}}', {CloseButton: true, ProgressBar: true});
                return;
            } else if (variant_key === '' || variant_key === null) {
                toastr.error('{{translate('Select a variation')}}', {CloseButton: true, ProgressBar: true});
                return;
            } else if (!quantity || Number(quantity) < 1) {
                toastr.error('{{translate('Quantity must not be empty')}}', {CloseButton: true, ProgressBar: true});
                return;
            }

            let variant_key_array = [];
            $('input[name="variant_keys[]"]').each(function () {
                variant_key_array.push($(this).val());
            });

            if (variant_key_array.includes(variant_key)) {
                const decimal_point = parseInt('{{(\App\Models\BusinessSetting::where(['key' => 'digit_after_decimal_point'])->first()->value) ?? 2}}');

                const old_qty = parseInt($(`#qty-${variant_key}`).val());
                const updated_qty = old_qty + quantity;

                const old_total_cost = parseFloat($(`#total-cost-${variant_key}`).text());
                const updated_total_cost = ((old_total_cost * updated_qty) / old_qty).toFixed(decimal_point);

                const old_discount_amount = parseFloat($(`#discount-amount-${variant_key}`).text());
                const updated_discount_amount = ((old_discount_amount * updated_qty) / old_qty).toFixed(decimal_point);


                $(`#qty-${variant_key}`).val(updated_qty);
                $(`#total-cost-${variant_key}`).text(updated_total_cost);
                $(`#discount-amount-${variant_key}`).text(updated_discount_amount);

                toastr.success('{{translate('Added successfully')}}', {CloseButton: true, ProgressBar: true});
                return;
            }

            let query_string = 'service_id=' + service_id + '&variant_key=' + variant_key + '&quantity=' + quantity + '&zone_id=' + zone_id;
            $.ajax({
                type: 'GET',
                url: "{{route('admin.service.booking.service.ajax-get-service-info')}}" + '?' + query_string,
                data: {},
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $('.preloader').show();
                },
                success: function (response) {
                    $("#service-edit-tbody").append(response.view);
                    toastr.success('{{translate('Added successfully')}}', {CloseButton: true, ProgressBar: true});
                },
                complete: function () {
                    $('.preloader').hide();
                },
            });
        })

        function removeServiceRow(row) {
            const row_count = $('#service-edit-tbody tr').length;
            if (row_count <= 1) {
                toastr.error('{{translate('Can not remove the only service')}}');
                return;
            }

            Swal.fire({
                title: "{{translate('are_you_sure')}}?",
                text: '{{translate('want to remove the service from the booking')}}',
                type: 'warning',
                showCloseButton: true,
                showCancelButton: true,
                cancelButtonColor: 'var(--c2)',
                confirmButtonColor: 'btn--primary',
                cancelButtonText: 'Cancel',
                confirmButtonText: 'Yes',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $(`#${row}`).remove();
                }
            })
        }

        $(document).ready(function() {
            var bookingId = "{{ $booking['id'] }}";

            $('input[name="service_location"]').on('change', function() {
                toggleServiceLocation();
            });

            $('#serviceLocationModal--' + bookingId).on('shown.bs.modal', function () {
                toggleServiceLocation();
            });

            $('#customerAddressModal--' + bookingId).on('show.bs.modal', function () {
                $('#serviceLocationModal--' + bookingId).modal('hide');
            });

            $('#customerAddressModal--' + bookingId).on('hidden.bs.modal', function () {
                $('#serviceLocationModal--' + bookingId).modal('show');
            });
        });

        const bookingStatus = "{{ $booking->booking_status }}";
        $('#payment_status').on('click', function (event) {
            let paymentStatus = $(this).is(':checked') === true ? 1 : 0;
            payment_status_change(paymentStatus)
        })

        $('.service_schedule').on('input', function () {
            service_schedule_update();
        });

        $("#booking_status").change(function () {
            var booking_status = $("#booking_status option:selected").val();
            if (parseInt(booking_status) !== 0) {
                var route = '{{route('admin.service.booking.status_update',[$booking->id])}}' + '?booking_status=' + booking_status;
                update_booking_details(route, '{{translate('want_to_update_status')}}', 'booking_status', booking_status, 'PUT');
            } else {
                toastr.error('{{translate('choose_proper_status')}}');
            }
        });



        $('.reassign-serviceman').on('click', function() {
            let id = $(this).data('serviceman-reassign');
            updateServiceman(id)
        })
        function updateServiceman(servicemanId) {
            const bookingId = "{{ $booking->id }}";
            const route = '{{ url('admin/service/booking/serviceman-update') }}' + '/' + bookingId;
            const searchTerm = $('.search-form-input1').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: route,
                type: 'PUT',
                dataType: 'json',
                data: {
                    booking_id: bookingId,
                    search: searchTerm,
                    serviceman_id: servicemanId
                },
                beforeSend: function() {
                    toastr.info('{{ translate('Processing request...') }}');
                },
                success: function(response) {
                    $('.modal-content-data').html(response.view);
                    toastr.success('{{ translate('Successfully reassign provider') }}');
                    setTimeout(function() {
                        location.reload()
                    }, 600);
                },
                complete: function() {},
                error: function() {
                    toastr.error('{{ translate('Failed to load') }}');
                }
            });
        }

        function canceled_booking() {
            toastr.info('contact with admin to change the status', {
                CloseButton: true,
                ProgressBar: true
            });
        }

        function payment_status_change(paymentStatus) {
            let route = '{{route('admin.service.booking.payment_update',[$booking->id])}}' + '?payment_status=' + paymentStatus;
            update_booking_details(route, '{{translate('want_to_update_status')}}', 'payment_status', paymentStatus);
        }

        function service_schedule_update() {
            var service_schedule = $("#service_schedule").val();
            var route = '{{route('admin.service.booking.schedule_update',[$booking->id])}}' + '?service_schedule=' + service_schedule;

            update_booking_details(route, '{{translate('want_to_update_the_booking_schedule')}}', 'service_schedule', service_schedule);
        }

        function update_booking_details(route, message, componentId, updatedValue, type = 'get') {
            Swal.fire({
                title: "{{translate('are_you_sure')}}?",
                text: message,
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: 'danger',
                confirmButtonColor: 'primary',
                cancelButtonText: '{{translate('Cancel')}}',
                confirmButtonText: '{{translate('Yes')}}',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    proceed_with_main_ajax_request(route, componentId, updatedValue, 'PUT');
                }
            });
        }

        function proceed_with_main_ajax_request(route, componentId, updatedValue, type = 'get', formData = null) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: route,
                type: type,
                dataType: 'json',
                data: formData,
                beforeSend: function () {
                },
                success: function (data) {
                    update_component(componentId, updatedValue);
                    toastr.success(data.message, {
                        CloseButton: true,
                        ProgressBar: true
                    });
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                },
                complete: function () {
                },
            });
        }

        function update_component(componentId, updatedValue) {

            if (componentId === 'booking_status') {
                if (updatedValue === 'accepted') {
                    location.reload();
                }

                $("#booking_status__span").html(updatedValue);

                selectElementVisibility('serviceman_assign', true);
                selectElementVisibility('payment_status', true);
                if ($("#change_schedule").hasClass('d-none')) {
                    $("#change_schedule").removeClass('d-none');
                }

            } else if (componentId === 'payment_status') {
                $("#payment_status__span").html(updatedValue ? 'Paid' : 'Unpaid');
                if (updatedValue === 1) {
                    $("#payment_status__span").addClass('text-success').removeClass('text-danger');
                } else if (updatedValue === 0) {
                    $("#payment_status__span").addClass('text-danger').removeClass('text-success');
                }

            } else if (componentId === 'service_schedule__submit') {
                $('#changeScheduleModal').modal('hide');
                let date = new Date(updatedValue);
                $('#service_schedule__span').html(date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear() + " " +
                    date.getHours() + ":" + date.getMinutes());

            }
        }

        function selectElementVisibility(componentId, visibility) {
            if (visibility === true) {
                $('#' + componentId).next(".select2-container").show();
            } else if (visibility === false) {
                $('#' + componentId).next(".select2-container").hide();
            } else {
            }
        }

        function open_otp_modal() {
            $('#otpModal').modal('show');
            $('.otp-field:first').focus();
        }

        function toggleServiceLocation() {
            if ($('#customer_location').is(':checked')) {
                $('.customer-details').show();
                $('.provider-details').hide();
            } else {
                $('.customer-details').hide();
                $('.provider-details').show();
            }
        }
    </script>
@endpush
