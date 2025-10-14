@extends('layouts.admin.app')

@section('title',translate('Single Booking Details'))

@push('css_or_js')

@endpush

@section('content')

    <div class="content container-fluid">
        <div class="pb-3 d-flex justify-content-between align-items-center gap-3 flex-wrap">
            <div>
                <div class="d-flex align-items-center gap-2 flex-wrap mb-sm-1 mb-2">
                    <h3 class="mb-0 font-bold">{{translate('Repeat Booking')}} # {{$booking->readable_id}}</h3>
                    <img src="{{asset('/public/assets/admin/img/repeat2.png')}}" alt="img">
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
                <p class="opacity-75 fz-12px mb-0">
                    {{translate('Booking_Schedule')}}
                    : {{date('d-M-Y h:ia',strtotime($booking->service_schedule))}}
                </p>
            </div>
            <div class="d-flex flex-wrap flex-xxl-nowrap gap-3">
                <div class="d-flex flex-wrap gap-3">
                    @if (in_array($booking['booking_status'], ['accepted', 'ongoing']) && $booking['payment_method'] == 'cash_after_service' && !$booking['is_paid'])

                    <button class="btn btn--primary btn-outline-primary" data-toggle="modal"
                            data-target="#serviceUpdateModal--{{ $booking['id'] }}" data-toggle="tooltip"
                            title="{{ translate('Add or remove services') }}">
                        <i class="tio-edit"></i>
                        {{translate('Edit Services')}}
                    </button>
                    @endif
                    <a href="{{route('admin.service.booking.single_invoice',[$booking->id])}}" class="btn d-flex align-items-center gap-1 btn--primary"  target="_blank">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8.75001 10.9991H4.25001C4.05109 10.9991 3.86033 11.0781 3.71968 11.2187C3.57902 11.3594 3.50001 11.5502 3.50001 11.7491C3.50001 11.948 3.57902 12.1388 3.71968 12.2794C3.86033 12.4201 4.05109 12.4991 4.25001 12.4991H8.75001C8.94892 12.4991 9.13968 12.4201 9.28034 12.2794C9.42099 12.1388 9.50001 11.948 9.50001 11.7491C9.50001 11.5502 9.42099 11.3594 9.28034 11.2187C9.13968 11.0781 8.94892 10.9991 8.75001 10.9991ZM5.75001 6.49907H7.25001C7.44892 6.49907 7.63968 6.42006 7.78034 6.2794C7.92099 6.13875 8.00001 5.94799 8.00001 5.74907C8.00001 5.55016 7.92099 5.3594 7.78034 5.21874C7.63968 5.07809 7.44892 4.99907 7.25001 4.99907H5.75001C5.55109 4.99907 5.36033 5.07809 5.21968 5.21874C5.07902 5.3594 5.00001 5.55016 5.00001 5.74907C5.00001 5.94799 5.07902 6.13875 5.21968 6.2794C5.36033 6.42006 5.55109 6.49907 5.75001 6.49907ZM14.75 7.99907H12.5V1.24907C12.5005 1.11692 12.4661 0.986967 12.4003 0.872384C12.3344 0.757801 12.2395 0.662653 12.125 0.596575C12.011 0.530749 11.8817 0.496094 11.75 0.496094C11.6184 0.496094 11.489 0.530749 11.375 0.596575L9.12501 1.88657L6.87501 0.596575C6.76099 0.530749 6.63166 0.496094 6.50001 0.496094C6.36835 0.496094 6.23902 0.530749 6.12501 0.596575L3.87501 1.88657L1.62501 0.596575C1.51099 0.530749 1.38166 0.496094 1.25001 0.496094C1.11835 0.496094 0.98902 0.530749 0.875006 0.596575C0.760553 0.662653 0.665592 0.757801 0.59974 0.872384C0.533887 0.986967 0.499481 1.11692 0.500006 1.24907V13.2491C0.500006 13.8458 0.737059 14.4181 1.15902 14.8401C1.58097 15.262 2.15327 15.4991 2.75001 15.4991H13.25C13.8467 15.4991 14.419 15.262 14.841 14.8401C15.263 14.4181 15.5 13.8458 15.5 13.2491V8.74907C15.5 8.55016 15.421 8.3594 15.2803 8.21875C15.1397 8.07809 14.9489 7.99907 14.75 7.99907ZM2.75001 13.9991C2.55109 13.9991 2.36033 13.9201 2.21968 13.7794C2.07902 13.6388 2.00001 13.448 2.00001 13.2491V2.54657L3.50001 3.40157C3.61576 3.46203 3.74441 3.49361 3.87501 3.49361C4.0056 3.49361 4.13425 3.46203 4.25001 3.40157L6.50001 2.11157L8.75001 3.40157C8.86576 3.46203 8.99441 3.49361 9.12501 3.49361C9.2556 3.49361 9.38425 3.46203 9.50001 3.40157L11 2.54657V13.2491C11.002 13.5049 11.0477 13.7586 11.135 13.9991H2.75001ZM14 13.2491C14 13.448 13.921 13.6388 13.7803 13.7794C13.6397 13.9201 13.4489 13.9991 13.25 13.9991C13.0511 13.9991 12.8603 13.9201 12.7197 13.7794C12.579 13.6388 12.5 13.448 12.5 13.2491V9.49907H14V13.2491ZM8.75001 7.99907H4.25001C4.05109 7.99907 3.86033 8.07809 3.71968 8.21875C3.57902 8.3594 3.50001 8.55016 3.50001 8.74907C3.50001 8.94799 3.57902 9.13875 3.71968 9.2794C3.86033 9.42006 4.05109 9.49907 4.25001 9.49907H8.75001C8.94892 9.49907 9.13968 9.42006 9.28034 9.2794C9.42099 9.13875 9.50001 8.94799 9.50001 8.74907C9.50001 8.55016 9.42099 8.3594 9.28034 8.21875C9.13968 8.07809 8.94892 7.99907 8.75001 7.99907Z"
                                fill="white"/>
                        </svg>
                        {{translate('Print Invoice')}}
                    </a>
                </div>
            </div>
        </div>
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
                                                        <span class="fz--14px">{{translate('Payment_Method')}}</span>
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
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="fz--14px">{{translate('Payment by')}} :</span>
                                                        <span class="font-normal text-title">{{ $booking?->booking?->customer?->fullName }}</span>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column gap-1 text-md-end">
                                                    @if($booking->payment_method == 'offline_payment')
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

                                                    <?php
                                                    $dueAmount = 0;

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
                                            <input class="on-off-toggle__input {{$booking->booking_status == 'canceled' ? 'canceled_booking' : 'switcher_input'}}"
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

                                    <div class="mt-3">
                                        <div class="modal fade" id="upload_picture_modal" data-bs-backdrop="static"
                                             tabindex="-1" aria-labelledby="upload_picture_modalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header border-0">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
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
                                        <div class="modal fade" id="otpModal" tabindex="-1" data-bs-backdrop="static"
                                             aria-labelledby="otpModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header border-0">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
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
                                    @if($booking?->provider)
                                    <div class="bg-light rounded-8 mb-20">
                                        <div class="border-bottom d-flex align-items-center justify-content-between gap-2 py-3 px-4 mb-2 mt-20">
                                            <h4 class="d-flex align-items-center gap-2 mb-0">
                                                <i class="tio-user-big opacity-50"></i>
                                                {{translate('Provider_Information')}}
                                            </h4>
                                        </div>
                                        <div class="p-3 d-flex gap-2">
                                                <img width="58" height="58" class="rounded-circle border border-white aspect-square object-fit-cover"
                                                     src="{{$booking?->provider?->logo_full_path}}" alt="{{translate('provider_image')}}">
                                            <div>
                                                <a href="{{ route('admin.service.provider.details', $booking->provider_id) }}">
                                                    <span class="font-semibold mb-1 d-block text-title fz--14px">
                                                        {{ Str::limit($booking?->provider?->company_name ?? '', 30) }}
                                                    </span>
                                                </a>
                                                <span class="font-semibold d-block text-title fz-12px mb-2">{{$booking?->provider?->company_phone}}</span>
                                                @if(!empty($booking?->provider?->company_address))
                                                    <p class="fz--14px">{{Str::limit($booking?->provider?->company_address ?? translate('not_available'), 100)}}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endif
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


                                            @php($name = $booking->service_address?->contact_person_name)
                                            @php($phone = $booking->service_address?->contact_person_number)

                                            @if(!$booking?->is_guest && $booking?->booking->customer)
                                                <img width="58" height="58" class="rounded-circle border border-white aspect-square object-fit-cover"
                                                     src="{{$booking?->booking->customer?->image_full_url}}" alt="{{translate('user_image')}}">
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


    <div class="modal fade" id="changeScheduleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="changeScheduleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeScheduleModalLabel">{{translate('Change_Booking_Schedule')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="datetime-local" id="service_schedule" name="service_schedule" class="form-control"
                           value="{{$booking->service_schedule}}">
                </div>
                <div class="p-3 d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{translate('Close')}}</button>
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

    <div class="modal fade" id="serviceUpdateModal--{{ $booking['id'] }}" tabindex="-1"
         aria-labelledby="serviceUpdateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <h3 class="text-capitalize">{{translate('update_booking')}}</h3>
                    <button type="button" class="close bg-white text-dark border d-center w-30px h-30 rounded-circle" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body px-4">
                    <div class="d-flex align-items-end justify-content-between gap-3 flex-wrap mb-4">
                        <div>
                            <h5 class="mb-2">
                                {{ translate('Booking') }} # {{ $booking['id'] }}
                            </h5>
                            <h3 class="c1 fw-bold mb-2">{{ translate('Sub-Booking') }} # {{ $booking['readable_id']}}
                            </h3>
                        </div>
                        <h5 class="d-flex gap-1 flex-wrap align-items-center justify-content-end fw-normal mb-2">
                            <div>{{ translate('Schedule_Date') }} :</div>
                            <div id="service_schedule__span">
                                <div class="fw-semibold">{{ date('d-M-Y h:ia', strtotime($booking->created_at)) }}</div>
                            </div>
                        </h5>
                    </div>

                    <div class="bg-F8F8F8 p-3 mb-3">
                        <h4 class="mb-3"> {{ translate('Service') }} : {{ translate('AC_Repairing') }}
                        </h4>
                        <div class="d-flex flex-wrap gap-3">
                            <h4> {{ translate('Category') }} : {{ $booking->booking->category->name }}</h4>
                            <h4> {{ translate('SubCategory') }} : {{ $booking->booking->subCategory->name }}</h4>
                        </div>
                    </div>

                    <div class="mb-30">
                        <span class="c1 fw-semibold"> # {{ translate('Note') }}:</span>
                        <span class="title-color">
                        {{ translate('Please provide extra layer in the packaging') }}</span>
                    </div>

                    <form action="{{ route('admin.service.booking.service.update_repeat_booking_service') }}" method="POST"
                          id="booking-edit-table" class="mb-30">
                        <div class="table-responsive">
                            <table class="table text-nowrap align-middle mb-0" id="service-edit-table">
                                @csrf
                                @method('put')
                                <thead>
                                <tr>
                                    <th class="ps-lg-3 fw-bold">{{ translate('Service') }}</th>
                                    <th class="fw-bold text--end">{{ translate('Price') }}</th>
                                    <th class="fw-bold text-center">{{ translate('Qty') }}</th>
                                    <th class="fw-bold text--end">{{ translate('Discount') }}</th>
                                    <th class="fw-bold text--end">{{ translate('Total') }}</th>
                                </tr>
                                </thead>

                                <tbody id="service-edit-tbody">
                                @php($sub_total = 0)
                                @foreach ($booking->detail as $key => $detail)
                                    <tr id="service-row--{{ $detail?->variant_key }}">
                                        <td class="text-wrap ps-lg-3">
                                            @if (isset($detail->service))
                                                <div class="d-flex flex-column">
                                                    <a class="fw-bold">{{ Str::limit($detail->service->name, 30) }}</a>
                                                    <div>{{ Str::limit($detail ? $detail->variant_key : '', 50) }}
                                                    </div>
                                                </div>
                                            @else
                                                <span
                                                    class="badge badge-pill badge-danger">{{ translate('Service_unavailable') }}</span>
                                            @endif
                                        </td>
                                        <td class="text--end" id="service-cost-{{ $detail?->variant_key }}">
                                            {{ currency_symbol() . ' ' . $detail->service_cost }}</td>
                                        <td>
                                            <input type="number" min="1" name="qty[]"
                                                   class="form-control qty-width dark-color-bo m-auto"
                                                   id="qty-{{ $detail?->variant_key }}"
                                                   value="{{ $detail->quantity }}"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                        </td>
                                        <td class="text--end" id="discount-amount-{{ $detail?->variant_key }}">
                                            {{ currency_symbol() . ' ' . $detail->discount_amount }}</td>
                                        <td class="text--end" id="total-cost-{{ $detail?->variant_key }}">
                                            {{ currency_symbol() . ' ' . $detail->total_cost }}
                                        </td>
                                        <input type="hidden" name="service_ids[]"
                                               value="{{ $detail->service->id }}">
                                        <input type="hidden" name="variant_keys[]"
                                               value="{{ $detail->variant_key }}">
                                    </tr>
                                    @php($sub_total += $detail->service_cost * $detail->quantity)
                                @endforeach
                                <input type="hidden" name="zone_id" value="{{ $booking->booking->zone_id }}">
                                <input type="hidden" name="booking_id" value="{{ $booking->booking_id }}">
                                <input type="hidden" name="booking_repeat_id" value="{{ $booking->id }}">
                                </tbody>
                            </table>
                        </div>
                    </form>

                </div>
                <div class="modal-footer d-flex justify-content-end gap-3 border-0 pt-0 pb-4">
                    <button type="button" class="btn btn--secondary" data-bs-dismiss="modal"
                            aria-label="Close">{{ translate('Cancel') }}</button>
                    <button type="submit" class="btn btn--primary"
                            form="booking-edit-table">{{ translate('update_cart') }}</button>
                </div>
            </div>
        </div>
    </div>

    @include('service::admin.BookingModule.partials.details._repeat-details-service-location-modal')

    @include('service::admin.BookingModule.partials.details._update-customer-address-modal')

@endsection

@push('script_2')

    <script type="text/javascript">
        "use strict";


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
        });

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
                var route = '{{route('admin.service.booking.status_update',[$booking->id])}}' + '?booking_status=' + booking_status + '&is_repeat=1';
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
            const route = '{{ url('admin/service/booking/serviceman-update') }}' + '/' + bookingId + '&is_repeat=1';
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
                    is_repeat: 1,
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
            let route = '{{route('admin.service.booking.payment_update',[$booking->id])}}' + '?payment_status=' + paymentStatus + '&is_repeat=1';
            update_booking_details(route, '{{translate('want_to_update_status')}}', 'payment_status', paymentStatus);
        }

        function service_schedule_update() {
            var service_schedule = $("#service_schedule").val();
            var route = '{{route('admin.service.booking.schedule_update',[$booking->id])}}' + '?service_schedule=' + service_schedule + '&is_repeat=1';

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
