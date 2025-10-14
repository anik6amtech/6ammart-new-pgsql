@push('css_or_js')
    <style>
        #map-layer {
            max-width: 706px;
            min-height: 430px;
        }
    </style>

@endpush
<div class="col-lg-4 order-print-area-right">
    <div class="max-h-340px overflow-auto mb-3">
        @foreach($safetyAlerts as $safetyAlert)
            @php
                $userType = match (true) {
                    $safetyAlert?->sent_by_type == DRIVER && ($safetyAlert?->trip?->current_status == 'ongoing' || $safetyAlert?->trip?->current_status == 'completed') => 'driver-on-trip',
                    $safetyAlert?->sent_by_type == 'driver' => 'driver-idle',
                    default => 'all-customer',
                };
                $route = route('admin.ride-share.fleet-map.fleet-map', ['type' => $userType]) . '?zone_id=' . $safetyAlert?->trip?->zone_id;
            @endphp
            <div class="card mb-2">
                <div class="card-header">
                    <h4 class="text--title font-bold mb-0">{{ translate('messages.safety_alert') }}</h4>
                </div>
                <div class="card-body d-flex flex-column gap-20px">
                    <div class="d-flex justify-content-between align-items-center gap-2 flex-wrap text--title">
                        <span>
                            <span class="font-semibold">{{ translate('Sent By') }} :</span>
                            <span class="opacity-70">{{ translate($safetyAlert->sent_by_type) }}</span>
                        </span>
                        <span class="opacity-70">{{ \Carbon\Carbon::parse($safetyAlert->created_at)->format('d M Y, h:i A') }}</span>
                    </div>
                    @if($safetyAlert?->reason || $safetyAlert?->comment)
                        <div class="alert alert--danger border-0 p-10px text--title rounded mb-0">
                            <ol class="pl-4 mb-0 d-flex flex-column gap-2">
                                @foreach($safetyAlert?->reason as $reason)
                                    <li>{{ $reason }}</li>
                                @endforeach
                                @if($safetyAlert?->comment)
                                    <li>{{ $safetyAlert?->comment }}</li>
                                @endif
                            </ol>
                        </div>
                    @endif
                    <div>
                        <h5 class="mb-1">{{ translate('messages.Alert_Location') }}</h5>
                        <p class="mb-0">{{ $safetyAlert?->alert_location }}</p>
                    </div>
                    @if($safetyAlert->resolved_by)
                        <div>
                            <h5 class="mb-1">{{ translate('messages.Resolved_Location') }}</h5>
                            <p class="mb-0">{{ $safetyAlert?->resolved_location }}</p>
                        </div>
                    @endif
                    @if($safetyAlert?->status == PENDING)
                        <div class="d-flex gap-3 justify-content-between flex-wrap">
                            <a href="{{ $route }}" class="btn btn--reset flex-grow-1" data-user-id="{{ $safetyAlert?->sentBy?->id }}">{{ translate('messages.Feel_View') }}</a>
                            <form action="{{ route('admin.ride-share.safety-alert.mark-as-solved', $safetyAlert->id) }}"
                                    method="post"
                                    class="">
                                    @csrf
                                    @method('PUT')
                                <button type="submit" class="btn btn--primary flex-grow-1">{{ translate('messages.Mark_As_Solved') }}</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="text-center mb-3 text-capitalize">{{translate('ride_setup')}}</h5>

            <div class="mb-3">
                <label for="trip_status" class="mb-2">{{translate('ride_status')}}</label>
                <select name="trip_status" id="trip_status" class="js-select form-control" disabled>
                    <option selected>{{translate($trip->current_status)}}</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="payment_status" class="mb-2">{{translate('payment_status')}}</label>
                <select name="payment_status" id="payment_status" class="js-select form-control" disabled>
                    <option selected>{{translate($trip->payment_status)}}</option>
                </select>
            </div>
            <div class="mb-4">
                <div id="map-layer"></div>
            </div>

            <div>
                <ul class="trip-details-address text--title px-0 pt-2">
                    <li>
                        <span class="svg">
                            <span class="text--title bg--F6F6F6 p-10px rounded"><i class="tio-poi"></i></span>
                        </span>
                        <span class="w-0 flex-grow-1">
                            <span class="font-medium">{{ translate('Home') }}:</span>
                            <span class="opacity-70">{{$trip->coordinate->pickup_address}}</span>
                        </span>
                    </li>
                    <li>
                        <span class="svg">
                            <span class="text--title bg--F6F6F6 p-10px rounded"><i
                                    class="tio-navigate-outlined rotate-45 d-inline-block"></i></span>
                        </span>
                        <span class="w-0 flex-grow-1 font-medium">
                            <div>{{$trip->coordinate->destination_address}}</div>
                            @if($trip->entrance)
                                <a href="#" class="text-primary d-flex">{{$trip->entrance}}</a>
                            @endif
                        </span>
                    </li>
                    <li>
                        <div class="media gap-2">
                            <img width="18" src="{{asset('public/assets/admin-module/img/svg/distance.svg')}}"
                                 class="svg" alt="">
                            @if($trip->current_status == 'completed')
                                <div class="media-body text-capitalize">{{translate('total_distance')}}
                                    - {{$trip->actual_distance}} {{translate('km')}}</div>
                            @else
                                <div class="media-body text-capitalize">{{translate('total_distance')}}
                                    - {{$trip->estimated_distance}} {{translate('km')}}</div>
                            @endif
                        </div>
                    </li>
                </ul>
               
            </div>
        </div>
    </div>
    <div class="card mt-2">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h4 class="text--title font-bold mb-0 mb-3 d-flex flex-wrap align-items-center">
                    <span>{{ translate('customer_info') }}</span>
                </h4>
            </div>
            <div class="media align-items-center deco-none customer--information-single" href="#">
                <div class="avatar avatar-circle">
                    <img class="avatar-img onerror-image"
                        src="{{ $trip->customer->image_full_url }}"
                        alt="Image Description">
                </div>
                <div class="media-body">
                    <span class="text--title fs-14 font-semibold d-block text-hover-primary mb-1">{{ $trip->customer->full_name }}</span>
                    <div class="text--title">
                        {{ $trip->customer->phone }}
                    </div>
                    <div class="text--title">
                        {{ $trip->customer->email }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($trip->driver)
        <div class="card mt-2">
            <div class="card-body">
                <h4 class="text--title font-bold mb-0 mb-3 d-flex flex-wrap align-items-center">
                    <span>{{ translate('provider_info') }}</span>
                </h4>
                
                <div class="media align-items-center deco-none resturant--information-single"
                    >
                    <div class="avatar avatar-circle">
                        <img class="avatar-img w-75px border-000-01 onerror-image"
                            src="{{ $trip->driver->image_full_url }}"
                            alt="Image Description">
                    </div>
                    <div class="media-body">
                        <div class="text--title fs-14 font-semibold d-block text-hover-primary mb-1">
                            <a href="{{ route("admin.users.delivery-man.preview", ['id' => $trip->driver?->id, 'tab' => 'ride_list']) }}" class="deco-none">{{ $trip->driver->f_name . ' ' . $trip->driver->l_name }}</a>
                        </div>

                        <div class="text--title">
                            <span class="font-bold">${{ $trip->driver?->driverTrips->count() }}</span>
                                {{ translate('messages.Trip_served') }}
                        </div>

                        <div class="text--title d-flex align-items-center">
                            {{ $trip->driver->email }}
                        </div>

                    </div>
                </a>
            </div>
        </div>
    @endif
    <div class="modal fade" id="make-refund">
        <div class="modal-dialog modal-lg extra-fare-setup-modal">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title">Make Refund</h5>
                    <button type="submit" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-4">
                            <label for="refund_amount" class="form-label">{{translate('Refund Amount')}} ($) <i
                                    class="bi bi-info-circle-fill text-primary"></i></label>
                            <input type="text" class="form-control" id="refund_amount"
                                   placeholder="{{translate("Ex : 10")}}">
                        </div>
                        <label class="form-label">{{translate('Refund Method')}} <i
                                class="bi bi-info-circle-fill text-primary"></i></label>
                        <div class="border rounded border-ced4da p-3 mb-4">
                            <div class="d-flex flex-wrap gap-5">
                                <div>
                                    <input type="radio" name="refund_method" id="pay-manually" checked>
                                    <label class="form-check-label" for="pay-manually">Pay Manually</label>
                                </div>
                                <div>
                                    <input type="radio" name="refund_method" id="pay-in-wallet">
                                    <label class="form-check-label" for="pay-in-wallet">Pay in Wallet</label>
                                </div>
                                <div>
                                    <input type="radio" name="refund_method" id="create-refund-coupon">
                                    <label class="form-check-label" for="create-refund-coupon">Create a refund
                                        Coupon</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="refund_reason" class="form-label">{{translate('Refund Note')}}</label>
                            <textarea class="form-control" id="refund_reason" rows="3"
                                      placeholder="{{translate('Type a refund note for your customer')}}"></textarea>
                        </div>
                        <div class="d-flex gap-10px justify-content-end">
                            <button class="btn btn-secondary" data-bs-dismiss="modal"
                                    type="button">{{ translate('Cancel') }}</button>
                            <button class="btn btn-primary" data-bs-dismiss="modal"
                                    type="button">{{ translate('Make Refund') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        let map;
        let waypoints;

        function initMap() {
            const mapLayer = document.getElementById("map-layer");
            const defaultOptions = {zoom: 9};
            map = new google.maps.Map(mapLayer, defaultOptions);

            const directionsService = new google.maps.DirectionsService;
            const directionsDisplay = new google.maps.DirectionsRenderer;
            directionsDisplay.setMap(map);

            const start = ({
                lat: {{$trip->coordinate->pickup_coordinates->latitude}},
                lng: {{$trip->coordinate->pickup_coordinates->longitude}}
            });
            const end = ({
                lat: {{$trip->coordinate->destination_coordinates->latitude}},
                lng: {{$trip->coordinate->destination_coordinates->longitude}}
            });
            drawPath(directionsService, directionsDisplay, start, end);
        }

        function drawPath(directionsService, directionsDisplay, start, end) {

            directionsService.route({
                    origin: start,
                    destination: end,
                    travelMode: "DRIVING"
                },
                function (response, status) {
                    if (status === 'OK') {
                        directionsDisplay.setDirections(response);
                    } else {
                        toastr.error('{{translate('problem_in_showing_direction._status:_')}}' + status);
                    }
                });
        }
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key={{ \App\Models\BusinessSetting::where('key', 'map_api_key')->first()->value }}&callback=initMap">
    </script>

    <script>
        document.on('click', '.show-safety-alert-user-details', function () {
            console.log("OKKK");
            // localStorage.setItem('safetyAlertUserDetailsStatus', true);
            // localStorage.setItem('safetyAlertUserIdFromTrip', $(this).data('user-id'));
        });
        /* $(document).ready(function () {
            let showSafetyAlertUserDetails = $('.show-safety-alert-user-details');
            
            showSafetyAlertUserDetails.on('click', function () {
                localStorage.setItem('safetyAlertUserDetailsStatus', true);
                localStorage.setItem('safetyAlertUserIdFromTrip', $(this).data('user-id'));
            });
        }) */
    </script>
@endpush
