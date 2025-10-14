@section('title', 'Ride Details')

@extends('layouts.admin.app')

@push('css_or_js')
@endpush

@section('content')
    @php($current_status = $trip->current_status)
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
                            {{ translate('ride_Log') }}
                        </span>
                    </h1>
                </div>
            </div>
        </div>
        <!-- Page Header -->

        @include('ride-share::admin.trip-management.partials._details-top-menu')

        <h2 class="fs-22 mb-4">{{ translate('trip')}} # {{$trip->ref_id}}</h2>

            {{-- @include('tripmanagement::admin.trip.partials._details-partials-inline') --}}

            <div class="card">
                <div class="card-body p-xxl-5 p-xl-4 p-3">
                    <div class="bg-FAFAFA rounded p-3 mb-30">
                        <div class="row gy-lg-4 gy-3">
                            <div class="col-lg-3 col-sm-6 col-6 d-flex justify-content-center">
                                <div class="d-flex flex-column gap-2 text-center">
                                    <h3 class="text-primary mb-0 text-capitalize">{{ translate('request_placed')}}</h3>
                                    @php($time_format = getSession('time_format'))
                                    <div class="fs-14">{{date('h:i A', strtotime($trip->created_at))}}</div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-6 d-flex justify-content-center">
                                <div class="d-flex flex-column gap-2 text-center">
                                    <h3 class="text-primary mb-0 text-capitalize">{{ translate('biding_status')}}</h3>
                                    <div
                                        class="fs-14">{{translate($trip->rise_request_count>0?spellOutNumber($trip->rise_request_count):"unavailable")}}</div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-6 d-flex justify-content-center">
                                <div class="d-flex flex-column gap-2 text-center">
                                    <h3 class="text-primary mb-0">{{translate('payment')}}</h3>
                                    @if(!is_null($trip->payment_method))
                                        <div class="fs-14 text-capitalize">{{$trip->payment_method}}</div>
                                    @else
                                        <div class="fs-14 text-capitalize">{{translate('payment_not_selected')}}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-6 d-flex justify-content-center">
                                <div class="d-flex flex-column gap-2 text-center">
                                    <h3 class="text-primary mb-0 text-capitalize">{{translate('ride_status')}}</h3>
                                    <div class="fs-14">{{translate($trip->current_status)}}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="ride-process-steps ">
                        <div class="row">
                            <div class="col-lg-3 col-sm-6 d-flex flex-column align-items-center gap-2 mb-4">
                                <div
                                    class="check-circle p-1 d-flex justify-content-center align-items-center bg-success text-white rounded-circle mb-2">
                                    <i class="tio tio-checkmark-circle"></i>
                                </div>
                                <h5 class="text-capitalize mb-1">{{translate('ride_request_by_customer')}}</h5>
                                <div class="fs-12 text-capitalize">{{translate('request_created')}}
                                    : {{date('h:i A', strtotime($trip->created_at))}} </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 d-flex flex-column align-items-center gap-2 mb-4">
                                @php($accepted = $trip->tripStatus->accepted)
                                <div
                                    class="check-circle p-1 d-flex justify-content-center align-items-center {{$accepted? 'bg-success': 'bg-danger'}} text-white rounded-circle mb-2">
                                    @if($accepted)
                                        <i class="tio tio-checkmark-circle"></i>
                                    @else
                                        <i class="tio tio-clear"></i>
                                    @endif
                                </div>
                                <h5 class="text-capitalize mb-1">{{translate('request_accepted_by_rider')}}</h5>
                                @if($accepted)
                                    <div class="fs-12 text-capitalize">{{translate('request_accepted')}}
                                        : {{date('h:i A', strtotime($accepted))}} </div>
                                @endif
                            </div>
                            <div class="col-lg-3 col-sm-6 d-flex flex-column align-items-center gap-2 mb-4">
                                @php($ongoing = $trip->tripStatus->ongoing)
                                <div
                                    class="check-circle p-1 d-flex justify-content-center align-items-center {{$ongoing? 'bg-success': 'bg-danger'}} text-white rounded-circle mb-2">
                                    @if($ongoing)
                                        <i class="tio tio-checkmark-circle"></i>
                                    @else
                                        <i class="tio tio-clear"></i>
                                    @endif
                                </div>
                                <h5 class="text-capitalize mb-1">{{translate('ride_ongoing_to_destination')}}</h5>
                                @if($ongoing)
                                    <div class="fs-12 text-capitalize">{{translate('ongoing_ride')}}
                                        : {{date('h:i A', strtotime($trip->tripStatus->ongoing))}} </div>
                                @endif
                            </div>

                            @if($current_status == 'completed' || $current_status == 'cancelled'|| $current_status == 'failed')
                                <div class="col-lg-3 col-sm-6 d-flex flex-column align-items-center gap-2 mb-4">
                                    <div
                                        class="check-circle p-1 d-flex justify-content-center align-items-center {{$current_status == 'completed'? 'bg-success': 'bg-danger'}} text-white rounded-circle mb-2">
                                        @if($current_status == 'completed')
                                            <i class="tio tio-checkmark-circle"></i>
                                        @else
                                            <i class="tio tio-clear"></i>
                                        @endif
                                    </div>
                                    <h5 class="">{{translate($current_status)}}</h5>
                                    @if($current_status == 'completed')
                                        <div class="fs-12 text-capitalize mb-1">{{translate('destination_arrived')}}
                                            : {{date('h:i A', strtotime($trip->tripStatus->$current_status))}} </div>
                                    @else
                                        <div
                                            class="fs-12 text-capitalize mb-1">{{translate($current_status)}} {{translate('time')}}
                                            : {{date('h:i A', strtotime($trip->tripStatus->$current_status))}} </div>
                                    @endif
                                </div>
                            @else
                                <div class="col-lg-3 col-sm-6 d-flex flex-column align-items-center gap-2 mb-4">
                                    <div
                                        class="check-circle p-1 d-flex justify-content-center align-items-center bg-primary text-white rounded-circle mb-2">
                                        <i class="tio tio-checkmark-circle"></i>
                                    </div>
                                    <h5 class="">{{translate($current_status)}}</h5>
                                    <div
                                        class="fs-12 text-capitalize mb-1">{{translate($current_status)}} {{translate('time')}}
                                        : {{date('h:i A', strtotime($trip->tripStatus->$current_status))}} </div>
                                </div>
                            @endif
                        </div>
                    </div> -->
                    <div class="ride-process-steps__wrap position-relative">
                        <div class="ride-process-steps d-flex flex-nowrap overflow-auto text-nowrap">
                            <div class="steps-item">
                                <div class="d-flex flex-column align-items-center gap-2 max-w-250 mx-auto">
                                    <div
                                        class="check-circle p-1 d-flex justify-content-center align-items-center bg-success text-white rounded-circle mb-2">
                                        <i class="tio tio-checkmark-circle"></i>
                                    </div>
                                    <h5 class="text-capitalize mb-1">{{translate('ride_request_by_customer')}}</h5>
                                    <div class="fs-12 text-capitalize">{{translate('request_created')}}
                                        : {{date('h:i A', strtotime($trip->created_at))}} </div>
                                </div>
                            </div>
                            <div class="steps-item">
                                <div class="d-flex flex-column align-items-center gap-2 max-w-250 mx-auto">
                                    @php($accepted = $trip->tripStatus->accepted)
                                    <div
                                        class="check-circle p-1 d-flex justify-content-center align-items-center {{$accepted? 'bg-success': 'bg-danger'}} text-white rounded-circle mb-2">
                                        @if($accepted)
                                            <i class="tio tio-checkmark-circle"></i>
                                        @else
                                            <i class="tio tio-clear"></i>
                                        @endif
                                    </div>
                                    <h5 class="text-capitalize mb-1">{{translate('request_accepted_by_rider')}}</h5>
                                    @if($accepted)
                                        <div class="fs-12 text-capitalize">{{translate('request_accepted')}}
                                            : {{date('h:i A', strtotime($accepted))}} </div>
                                    @endif
                                </div>
                            </div>
                            <div class="steps-item">
                                <div class="d-flex flex-column align-items-center gap-2 max-w-250 mx-auto">
                                    @php($ongoing = $trip->tripStatus->ongoing)
                                    <div
                                        class="check-circle p-1 d-flex justify-content-center align-items-center {{$ongoing? 'bg-success': 'bg-danger'}} text-white rounded-circle mb-2">
                                        @if($ongoing)
                                            <i class="tio tio-checkmark-circle"></i>
                                        @else
                                            <i class="tio tio-clear"></i>
                                        @endif
                                    </div>
                                    <h5 class="text-capitalize mb-1">{{translate('ride_ongoing_to_destination')}}</h5>
                                    @if($ongoing)
                                        <div class="fs-12 text-capitalize">{{translate('ongoing_ride')}}
                                            : {{date('h:i A', strtotime($trip->tripStatus->ongoing))}} </div>
                                    @endif
                                </div>
                            </div>
                            @if($current_status == 'completed' || $current_status == 'cancelled'|| $current_status == 'failed')
                                <div class="steps-item">
                                    <div class="d-flex flex-column align-items-center gap-2 max-w-250 mx-auto">
                                        <div
                                            class="check-circle p-1 d-flex justify-content-center align-items-center {{$current_status == 'completed'? 'bg-success': 'bg-danger'}} text-white rounded-circle mb-2">
                                            @if($current_status == 'completed')
                                                <i class="tio tio-checkmark-circle"></i>
                                            @else
                                                <i class="tio tio-clear"></i>
                                            @endif
                                        </div>
                                        <h5 class="">{{translate($current_status)}}</h5>
                                        @if($current_status == 'completed')
                                            <div class="fs-12 text-capitalize mb-1">{{translate('destination_arrived')}}
                                                : {{date('h:i A', strtotime($trip->tripStatus->$current_status))}} </div>
                                        @else
                                            <div
                                                class="fs-12 text-capitalize mb-1">{{translate($current_status)}} {{translate('time')}}
                                                : {{date('h:i A', strtotime($trip->tripStatus->$current_status))}} </div>
                                        @endif
                                    </div>
                                </div>
                            @else
                                <div class="steps-item">
                                    <div class="d-flex flex-column align-items-center gap-2 max-w-250 mx-auto">
                                        <div
                                            class="check-circle p-1 d-flex justify-content-center align-items-center bg-primary text-white rounded-circle mb-2">
                                            <i class="tio tio-checkmark-circle"></i>
                                        </div>
                                        <h5 class="">{{translate($current_status)}}</h5>
                                        <div
                                            class="fs-12 text-capitalize mb-1">{{translate($current_status)}} {{translate('time')}}
                                            : {{date('h:i A', strtotime($trip->tripStatus->$current_status))}} </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="arrow-area">
                            <div class="button-prev align-items-center">
                                <button type="button" class="btn-click-prev mr-auto rounded-circle fs-12 p-2 d-center">
                                    <i class="tio-chevron-left top-02"></i>
                                </button>
                            </div>
                            <div class="button-next align-items-center">
                                <button type="button" class="btn-click-next ml-auto rounded-circle fs-12 p-2 d-center">
                                    <i class="tio-chevron-right top-02"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- End Row -->
    </div>
@endsection

@push('script')
    <script src="{{ asset('Modules/public/assets/js/ride-details.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stepsContainer = document.querySelector('.ride-process-steps');
            const btnNext = document.querySelector('.btn-click-next');
            const btnPrev = document.querySelector('.btn-click-prev');
            const stepItems = document.querySelectorAll('.ride-process-steps .steps-item');

            let stepWidth = stepItems[0]?.offsetWidth || 0; // fallback
            const visibleSteps = 1; // slide one item per click

            function updateStepWidth() {
                stepWidth = stepItems[0]?.offsetWidth || 0;
            }

            function updateArrows() {
                const scrollLeft = stepsContainer.scrollLeft;
                const maxScrollLeft = stepsContainer.scrollWidth - stepsContainer.clientWidth;

                // Show/hide next button
                if (maxScrollLeft > 0 && scrollLeft < maxScrollLeft - 10) {
                    btnNext.parentElement.classList.add('active');
                } else {
                    btnNext.parentElement.classList.remove('active');
                }

                // Show/hide prev button
                if (scrollLeft > 10) {
                    btnPrev.parentElement.classList.add('active');
                } else {
                    btnPrev.parentElement.classList.remove('active');
                }
            }

            // Recalculate on resize
            window.addEventListener('resize', () => {
                updateStepWidth();
                updateArrows();
            });

            // Initialize
            updateStepWidth();
            updateArrows();

            stepsContainer.addEventListener('scroll', updateArrows);

            // Next click
            btnNext.addEventListener('click', () => {
                stepsContainer.scrollBy({
                    left: stepWidth * visibleSteps,
                    behavior: 'smooth'
                });
            });

            // Prev click
            btnPrev.addEventListener('click', () => {
                stepsContainer.scrollBy({
                    left: -stepWidth * visibleSteps,
                    behavior: 'smooth'
                });
            });
        });
    </script>

@endpush
