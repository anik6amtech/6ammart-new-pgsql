@extends('layouts.admin.app')

@section('title',translate('Repeat Booking Service Log'))

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <div class="pb-3 d-flex justify-content-between align-items-center gap-3 flex-wrap">
            <div>
                <div class="d-flex align-items-center gap-2 flex-wrap mb-sm-1 mb-2">
                    <h3 class="mb-0 font-bold">{{translate('Repeat Booking')}} # {{$booking->id}}</h3>
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
            </div>
            <div class="d-flex flex-wrap flex-xxl-nowrap gap-3">
                <div class="d-flex flex-wrap gap-3">
                    @php($provider_can_edit_booking = (int)(business_config('provider_can_edit_booking', 'service_business_settings'))?->value)

                    @if($provider_can_edit_booking && in_array($booking['booking_status'], ['accepted', 'ongoing']) && $booking?->booking_partial_payments->isEmpty() && empty($booking->customizeBooking))
                        <button class="btn btn--primary btn-outline-primary"
                                data-toggle="modal"
                                data-target="#serviceUpdateModal--{{ $booking['id'] }}" data-toggle="tooltip"
                                title="{{ translate('Add or remove services') }}">
                            <i class="tio-edit"></i>
                            {{translate('Edit Services')}}
                        </button>
                    @endif
                    <a href="{{route('admin.service.booking.full_repeat_invoice',[$booking->id])}}" class="btn d-flex align-items-center gap-1 btn--primary"  target="_blank">
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
                    <li class="nav-item">
                        <a class="nav-link {{ $webPage == 'details' ? 'active' : '' }}"
                           href="{{ url()->current() }}?web_page=details">{{ translate('details') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $webPage == 'service_log' ? 'active' : '' }}"
                           href="{{ url()->current() }}?web_page=service_log">{{ translate('service_log') }}</a>
                    </li>
                </ul>

                @php($max_booking_amount = business_config('maximum_booking_amount')->value ?? 0)

                @if (
                    $booking->is_verified == 2 &&
                        $booking->payment_method == 'cash_after_service' &&
                        $max_booking_amount <= $booking->total_booking_amount)
                    <div class="border border-danger-light bg-soft-danger rounded py-3 px-3 text-dark">
                        <span class="text-danger"># {{ translate('Note: ') }}</span>
                        <span>{{ $booking?->bookingDeniedNote?->value }}</span>
                    </div>
                @endif

                @if ($booking->is_paid == 0 && $booking->payment_method == 'offline_payment')
                    <div class="border border-danger-light bg-soft-danger rounded py-3 px-3 text-dark">
                        <span>
                            <span class="text-danger fw-semibold"> # {{ translate('Note: ') }} </span>
                            {{ translate('Please Check & Verify the payment information weather it is correct or not before confirm the booking. ') }}
                        </span>
                    </div>
                @endif
            </div>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="home-details" role="tabpanel"
                     aria-labelledby="home-tab-details">
                    <div class="row gy-3">
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    @if (!empty($booking['nextService'])  && $booking['booking_status'] != 'pending')
                                        <h5 class="mb-3">{{ translate('Ongoing') }}</h5>
                                        <div class="p-4 mb-3 d-flex flex-column gap-3">
                                            <div class="card card-border">
                                                <div class="card-body">
                                                    <div class="d-flex flex-wrap justify-content-between align-content-center gap-3">
                                                        <div>
                                                            <h6 class="fz-13 mb-2">{{ translate('Booking Id') }}
                                                                #{{ $booking->nextService['readable_id'] }}
                                                            </h6>
                                                            <p class="fz-12">{{ date('d-M-Y h:ia', strtotime($booking->nextService['service_schedule'])) }}</p>
                                                        </div>
                                                        <div class="d-flex gap-2 justify-content-center">
                                                            <a href="{{ route('admin.service.booking.single_invoice', [$booking->nextService['id']]) }}" type="button" target="_blank"
                                                               class="action-btn btn--light-primary text-primary fw-medium text-capitalize fz-14"
                                                               style="--size: 30px">
                                                                <i class="tio-file"></i>
                                                            </a>
                                                            <a href="{{ route('admin.service.booking.repeat_single_details', [$booking->nextService['id'], 'web_page' => 'details'])}}" type="button"
                                                               class="action-btn btn--light-primary text-primary fw-medium text-capitalize fz-14"
                                                               style="--size: 30px">
                                                                <i class="tio-visible"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if(!empty($booking['completeCancel']))
                                        <h5 class="mb-3">{{ translate('Completed & Canceled') }}</h5>
                                        @foreach($booking['completeCancel'] as $data)
                                            <div class="d-flex align-items-center mb-3 gap-20">
                                                <div>
                                                    <span class="fz-14 color-93A2AE">#{{ $loop->iteration }}</span>
                                                </div>
                                                <div class="card card-border w-100">
                                                    <div class="card-body">
                                                        <div class="d-flex flex-wrap justify-content-between align-content-center gap-3">
                                                            <div>
                                                                <h6 class="fz-13 mb-2">{{ translate('Booking Id') }}
                                                                    #{{ $data['readable_id']}}
                                                                </h6>
                                                                <p class="fz-12">{{ date('d-M-Y h:ia', strtotime($data['service_schedule'])) }}</p>
                                                            </div>
                                                            <div class="d-flex gap-2 justify-content-center">
                                                                <a href="{{ route('admin.service.booking.single_invoice', [$data['id']]) }}" type="button"
                                                                   class="action-btn btn--light-primary text-primary fw-medium text-capitalize fz-14" target="_blank"
                                                                   style="--size: 30px">
                                                                    <i class="tio-file"></i>
                                                                </a>
                                                                <a href="{{ route('admin.service.booking.repeat_single_details', [$data['id'], 'web_page' => 'details'])}}" type="button"
                                                                   class="action-btn btn--light-primary text-primary fw-medium text-capitalize fz-14"
                                                                   style="--size: 30px">
                                                                    <i class="tio-visible"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif

                                    @if(!empty($booking['upComing']))
                                        <h5 class="mb-3">{{ translate('Upcoming') }}</h5>
                                        @foreach($booking['upComing'] as $upComing)
                                            <div class="d-flex align-items-center mb-3 gap-20">
                                                <div>
                                                    <span class="fz-14 color-93A2AE">#{{ $loop->iteration }}</span>
                                                </div>
                                                <div class="card card-border w-100 shadow-none">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between align-items-center gap-3">
                                                            <div>
                                                                <h6 class="fz-13 mb-2">{{ translate('Booking Id') }}
                                                                    #{{ $upComing['readable_id'] }}
                                                                    @if(count($upComing['schedule_histories']) > 1)
                                                                        <span class="title-color opacity-75">({{ translate('Rescheduled') }})</span>
                                                                    @endif
                                                                </h6>
                                                                <p class="fz-12 mb-1">{{ date('d-M-Y h:ia', strtotime($upComing['service_schedule'])) }}</p>
                                                                @if($upComing['is_reassign'])
                                                                    <span class="text-primary fw-semibold">
                                                                (
                                                                <span class="title-color opacity-75">{{ translate('Reassigned to') }}</span>
                                                                {{ $booking->provider->company_name }}
                                                                )
                                                            </span>
                                                                @endif
                                                            </div>
                                                            <div class="dropstart">
                                                                <a href="javascript:" class="title-color" data-toggle="dropdown">
                                                                    <i class="tio-more-vertical fz-24"></i>
                                                                </a>
                                                                <ul class="dropdown-menu border-none dropdown-menu-right px-3" style="position:fixed; z-index:999999 !important; inset:auto;">
                                                                    @if($booking['booking_status'] != 'pending')
                                                                        <li>
                                                                            <a class="dropdown-item d-flex align-items-center gap-1" type="button" class="btn btn-primary" data-toggle="modal" data-target="#reschedule-{{$upComing['id']}}"
                                                                               href="javascript:"><i class="tio-remaining-time"></i>
                                                                                {{ translate('Reschedule') }}
                                                                            </a>
                                                                        </li>
                                                                    @endif
                                                                    <li>
                                                                        <a class="dropdown-item d-flex align-items-center gap-1" target="_blank"
                                                                           href="{{ route('admin.service.booking.single_invoice', [$upComing['id']]) }}">
                                                                            <i class="tio-download"></i>
                                                                            {{ translate('download_invoice') }}
                                                                        </a>
                                                                    </li>
                                                                    @if($booking['booking_status'] != 'pending')
                                                                        <li>
                                                                            <button type="button" data-id="cancel-{{$upComing['id']}}"
                                                                                    data-message="{{translate('want_to_cancel_this_booking')}}?"
                                                                                    class="dropdown-item d-flex align-items-center gap-1 {{ env('APP_ENV') != 'demo' ? 'form-alert' : 'demo_check' }}">
                                                                                <i class="tio-remove"></i>
                                                                                {{ translate('cancel') }}
                                                                            </button>

                                                                            <form action="{{route('admin.service.booking.up_coming_booking_cancel',[$upComing['id']])}}"
                                                                                method="post" id="cancel-{{$upComing['id']}}"
                                                                                class="hidden">
                                                                                @csrf
                                                                                @method('GET')
                                                                                <input type="hidden" name="booking_status" value="canceled">
                                                                            </form>
                                                                        </li>
                                                                    @endif
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal fade" id="reschedule-{{$upComing['id']}}" tabindex="-1" aria-labelledby="" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="">{{translate('Repeat Booking reschedule')}}</h5>
                                                            <button type="button" class="close bg-white text-dark border d-center w-30px h-30 rounded-circle" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('admin.service.booking.up_coming_booking_schedule_update', [$upComing['id']]) }}" method="post">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <input type="datetime-local" class="form-control h-45" name="service_schedule" value="{{$upComing['service_schedule']}}">
                                                                <div class="pt-3 text-end">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{translate('Close')}}</button>
                                                                    <button type="submit" class="btn btn--primary">{{translate('Save changes')}}</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <h3 class="p-20 mb-0 border-bottom">{{translate('Booking Setup')}}</h3>
                                <div class="card-body">
                                    @if($booking->booking_status != 'pending')
                                        <div>
                                            <select class="status form-control js-select2-custom w-100" id="booking_status">
                                                @if ($booking->booking_status == 'accepted')
                                                    <option value="0" disabled
                                                        {{ $booking['booking_status'] == 'accepted' ? 'selected' : '' }}>
                                                        {{ translate('Booking_Status') }}: {{ translate('Accepted') }}</option>
                                                @elseif($booking->booking_status == 'ongoing')
                                                    <option value="0" disabled
                                                        {{ $booking['booking_status'] == 'ongoing' ? 'selected' : '' }}>
                                                        {{ translate('Booking_Status') }}: {{ translate('Ongoing') }}</option>
                                                @elseif($booking->booking_status == 'canceled')
                                                    <option value="0" disabled
                                                        {{ $booking['booking_status'] == 'canceled' ? 'selected' : '' }}>
                                                        {{ translate('Booking_Status') }}: {{ translate('Canceled') }}</option>
                                                @endif
                                                @if ($booking->booking_status != 'completed' && $booking->booking_status != 'accepted' &&
                                                            isset($booking->nextService) &&
                                                            !$booking->nextService['is_paid'] &&
                                                            $booking->nextService['payment_method'] == 'cash_after_service')
                                                    <option value="canceled"
                                                        {{ $booking->booking_status == 'canceled' ? 'selected' : '' }}>
                                                        {{ translate('Booking_Status') }}: {{ translate('Canceled') }}
                                                    </option>
                                                @elseif($booking->booking_status == 'completed')
                                                    <option value="completed"
                                                        {{ $booking->booking_status == 'completed' ? 'selected' : '' }}>
                                                        {{ translate('Booking_Status') }}: {{ translate('completed') }}
                                                    </option>
                                                @endif

                                            </select>
                                        </div>
                                    @else
                                        <div>
                                            <select class="status form-control js-select2-custom w-100" id="booking_status">
                                                <option value="0"
                                                    {{ $booking['booking_status'] == 'pending' ? 'selected' : '' }}>
                                                    {{ translate('Booking_Status') }}: {{ translate('pending') }}</option>
                                                <option value="canceled"
                                                    {{ $booking['booking_status'] == 'canceled' ? 'selected' : '' }}>
                                                    {{ translate('Booking_Status') }}: {{ translate('Canceled') }}</option>
                                            </select>
                                        </div>
                                    @endif
                                    <div class="{{ $booking->booking_status == 'canceled' ? 'booking_canceled' : '' }}"></div>

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
                                </div>
                            </div>
                        </div>
                    </div>
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

    <div class="modal fade" id="serviceAddressModal--{{$booking['id']}}" tabindex="-1"
         aria-labelledby="serviceAddressModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form action="{{route('admin.service.booking.service_address_update', [$booking['id']])}}">
                <div class="modal-content">
                    <div class="modal-header border-0 pb-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body m-4">
                        <div class="d-flex flex-column gap-2 align-items-center">
                            <img width="75" class="mb-2"
                                 src="{{asset('public/assets/provider-module')}}/img/media/ignore-request.png"
                                 alt="">
                            <h3>{{translate('Update customer service address')}}</h3>

                            <div class="row mt-4">
                                @if($customerAddress)
                                    <div class="form-check col-md-6 col-12">
                                        <input class="form-check-input" type="radio" name="service_address_id"
                                               id="customerAddress-{{$customerAddress->id}}"
                                               value="{{$customerAddress->id}}" {{$booking->service_address_id == $customerAddress->id ? 'checked' : null}}>
                                        <label class="form-check-label" for="customerAddress-{{$customerAddress->id}}">
                                            {{$customerAddress->address_label}} <br>
                                            <small>{{$customerAddress->address}}</small>
                                        </label>

                                    </div>
                                @else
                                    <span>{{translate('No address available')}}</span>
                                @endif
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center gap-3 border-0 pt-0 pb-4">
                        <button type="button" class="btn btn--secondary" data-bs-dismiss="modal" aria-label="Close">
                            {{translate('Cancel')}}</button>
                        <button type="{{isset($customerAddress) ? 'submit' : 'button'}}"
                                class="btn btn--primary">{{translate('Update')}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if (!is_null($booking->nextService))
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
                                <h3 class="c1 fw-bold mb-2">{{ translate('Sub-Booking') }} #
                                    {{ $booking->nextService['readable_id'] }}
                                </h3>
                            </div>
                            <h5 class="d-flex gap-1 flex-wrap align-items-center justify-content-end fw-normal mb-2">
                                <div>{{ translate('Schedule_Date') }} :</div>
                                <div id="service_schedule__span">
                                    <div class="fw-semibold">{{ date('d-M-Y h:ia', strtotime($booking->created_at)) }}
                                    </div>
                                </div>
                            </h5>
                        </div>

                        <div class="bg-F8F8F8 p-3 mb-3">
                            <h4 class="mb-3"> {{ translate('Service') }} : {{ translate('AC_Repairing') }}
                            </h4>
                            <div class="d-flex flex-wrap gap-3">
                                <h4> {{ translate('Category') }} : {{ $booking->category->name }}</h4>
                                <h4> {{ translate('SubCategory') }} : {{ $booking->subCategory->name }}</h4>
                            </div>
                        </div>

                        {{--                    <div class="mb-30"> --}}
                        {{--                        <span class="c1 fw-semibold"> # {{ translate('Note') }}:</span> --}}
                        {{--                        <span class="title-color"> --}}
                        {{--                            {{ translate('Please provide extra layer in the packaging') }}</span> --}}
                        {{--                    </div> --}}

                        <form action="{{ route('admin.service.booking.service.update_repeat_booking_service') }}"
                              method="POST" id="booking-edit-table" class="mb-30">
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
                                    @foreach ($booking->nextService['detail'] as $key => $detail)
                                        <tr id="service-row--{{ $detail['variant_key'] }}">
                                            <td class="text-wrap ps-lg-3">
                                                @if (isset($detail['service']))
                                                    <div class="d-flex flex-column">
                                                        <a
                                                            class="fw-bold">{{ Str::limit($detail['service']['name'], 30) }}</a>
                                                        <div>
                                                            {{ Str::limit($detail ? $detail['variant_key'] : '', 50) }}
                                                        </div>
                                                    </div>
                                                @else
                                                    <span
                                                        class="badge badge-pill badge-danger">{{ translate('Service_unavailable') }}</span>
                                                @endif
                                            </td>
                                            <td class="text--end" id="service-cost-{{ $detail['variant_key'] }}">
                                                {{ currency_symbol() . ' ' . $detail['service_cost'] }}</td>
                                            <td>
                                                <input type="number" min="1" name="qty[]"
                                                       class="form-control qty-width dark-color-bo m-auto"
                                                       id="qty-{{ $detail['variant_key'] }}"
                                                       value="{{ $detail['quantity'] }}"
                                                       oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                            </td>
                                            <td class="text--end" id="discount-amount-{{ $detail['variant_key'] }}">
                                                {{ currency_symbol() . ' ' . $detail['discount_amount'] }}</td>
                                            <td class="text--end" id="total-cost-{{ $detail['variant_key'] }}">
                                                {{ currency_symbol() . ' ' . $detail['total_cost'] }}
                                            </td>
                                            <input type="hidden" name="service_ids[]"
                                                   value="{{ $detail['service']['id'] }}">
                                            <input type="hidden" name="variant_keys[]"
                                                   value="{{ $detail['variant_key'] }}">
                                        </tr>
                                        @php($sub_total += $detail['service_cost'] * $detail['quantity'])
                                    @endforeach
                                    <input type="hidden" name="zone_id" value="{{ $booking->zone_id }}">
                                    <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                                    <input type="hidden" name="booking_repeat_id"
                                           value="{{ $booking?->nextService['id'] }}">
                                    </tbody>
                                </table>
                            </div>

                            <div class="bg-F8F8F8 p-3 mb-30">
                                <div class="form-check d-flex align-items-center gap-1">
                                    <input class="form-check-input check-28" type="checkbox"
                                           name="next_all_booking_change" value="1">
                                    <label class="form-check-label lh-lg" for="">
                                        {{ translate('Check the box') }}
                                        <br>
                                        {{ translate(' If want to Update it for all upcoming bookings') }}

                                    </label>
                                </div>
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
    @endif

    @if ($booking['repeatHistory'])
        <!-- Modal -->
        <div class="modal fade" id="tableModal" tabindex="-1" aria-labelledby="tableModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header border-0 pb-0">
                        <h3 class="text-capitalize">{{translate('edit_history_log')}}</h3>
                        <button type="button" class="close bg-white text-dark border d-center w-30px h-30 rounded-circle" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body flex-grow-1 overflow-y-auto scrollbar-thin py-0">
                        <div class="table-responsive border rounded">
                            <table class="table align-middle fs-12">
                                <thead>
                                <tr>
                                    <th scope="col" class="text-end">{{ translate('SL') }}</th>
                                    <th scope="col">{{ translate('booking_ID') }}</th>
                                    <th scope="col">{{ translate('date_&_Time') }}</th>
                                    <th scope="col" class="text-center">{{ translate('total_Quantity') }}</th>
                                    <th scope="col" class="text-center">{{ translate('remark') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($booking['repeatHistory'] as $repeat)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <button type="button"
                                                        class="table-collapse-btn bg-soft-dark border-0 img-circle"
                                                        style="--size: 40px" data-toggle="collapse"
                                                        data-target="#collapseExample-{{ $repeat['id'] }}"
                                                        aria-expanded="false" aria-controls="collapseExample">
                                                    <i class="tio-down-ui user-select-none"></i>
                                                </button>
                                                {{ $loop->iteration }}
                                            </div>
                                        </td>
                                        <td>#{{ $repeat['readable_id'] }}</td>
                                        <td>
                                            <div>{{ date('d-M-Y h:ia', strtotime($repeat['created_at'])) }}</div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-1 justify-content-center">
                                                {{ $repeat['old_quantity'] }}<i class="tio-caret-right"></i>
                                                {{ $repeat['new_quantity'] }}
                                            </div>
                                        </td>
                                        @if ($repeat['is_multiple'])
                                            <td class="text-center">{{ translate('Edited multiple booking') }}</td>
                                        @else
                                            <td class="text-center">
                                                {{ translate('Edited only this single booking') }}</td>
                                        @endif
                                    </tr>
                                    <tr class="bg--secondary collapse" id="collapseExample-{{ $repeat['id'] }}">
                                        <td colspan="5">
                                            <div class="p-2 rounded bg-white d-flex flex-column gap-1">
                                                @if ($repeat['log_details'])
                                                    @foreach ($repeat['log_details'] as $serviceLog)
                                                        <div
                                                            class="bg--secondary p-3 rounded d-flex align-items-center gap-2 justify-content-between">
                                                            <div>{{ $serviceLog->service_name }}</div>
                                                            <div>{{ $serviceLog->quantity }} x
                                                                {{ $serviceLog->service_cost }}</div>
                                                            <div>
                                                                {{ \App\CentralLogics\Helpers::format_currency($serviceLog->quantity * $serviceLog->service_cost) }}
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    <div class="d-flex gap-4 justify-content-end mt-1 px-2">
                                                        <div>{{ translate('Sub Total') }}:</div>
                                                        <div class="fw-bold">
                                                            {{ \App\CentralLogics\Helpers::format_currency($serviceLog->quantity * $serviceLog->service_cost) }}
                                                        </div>
                                                    </div>
                                                    <div class="d-flex gap-4 justify-content-end px-2">
                                                        <div>{{ 'Service Discount' }}:</div>
                                                        <div class="fw-bold">
                                                            {{ \App\CentralLogics\Helpers::format_currency($serviceLog->discount_amount) }}
                                                        </div>
                                                    </div>
                                                    <div class="d-flex gap-4 justify-content-end px-2">
                                                        <div>{{ 'Service Vat' }}:</div>
                                                        <div class="fw-bold">
                                                            {{ \App\CentralLogics\Helpers::format_currency($repeat['total_tax_amount']) }}
                                                        </div>
                                                        @endif
                                                    </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn--primary" data-dismiss="modal"
                                aria-label="Close">{{ translate('okay') }}</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @include('service::admin.BookingModule.partials.details._repeat-details-service-location-modal')

    @include('service::admin.BookingModule.partials.details._update-customer-address-modal')
@endsection

@push('script_2')

    <script type="text/javascript">
        "use strict";

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
            if(bookingStatus === 'canceled'){
                event.preventDefault();
                canceled_booking()
            }else {
                let paymentStatus = $(this).is(':checked') === true ? 1 : 0;
                payment_status_change(paymentStatus)
            }
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
                $("#payment_status__span").html(updatedValue);
                if (updatedValue === 'paid') {
                    $("#payment_status__span").addClass('text-success').removeClass('text-danger');
                } else if (updatedValue === 'unpaid') {
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
