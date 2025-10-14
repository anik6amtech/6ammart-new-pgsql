@forelse($customers as $customer)
    @php
        $trip = $customer?->customerRides()?->whereIn('current_status',[ACCEPTED,ONGOING])->where('type', RIDE_REQUEST)->first()
    @endphp
    <li class="user-details">
        <label class="form-check" data-id="{{$customer->id}}">
            <img class="form-check-img svg"
                 src="{{ $trip ? asset('Modules/RideShare/public/assets/img/ride-share/paper-plane.svg') :asset('Modules/RideShare/public/assets/img/ride-share/idle.svg') }}"
                 alt="">
            <div class="form-check-label">
                <div class="d-flex gap-2 align-items-center mb-2">
                    <h5 class="zone-name flex-grow-1 mb-0">{{ $customer->f_name .' '.$customer->l_name }}
                        <div
                            class="badge badge-pill badge-info ms-2">{{ $customer?->customerRides()?->whereIn('current_status',[ACCEPTED,ONGOING])->first() ? translate("On-Trip") : ""}}</div>
                    </h5>
                    @if($trip?->customerSafetyAlertPending)
                        <div class="flex-shrink-0 position-relative hover-like-tooltip">
                            <img class="svg" src="{{asset('Modules/RideShare/public/assets/img/ride-share/shield-red.svg')}}"
                                 alt="">
                            <div class="like-tooltip">
                                @if($trip?->customerSafetyAlertPending?->reason || $trip?->customerSafetyAlertPending?->comment)
                                    @if($trip?->customerSafetyAlertPending?->reason)
                                        @foreach($trip?->customerSafetyAlertPending?->reason as $reason)
                                            {{ $reason }}
                                            <br>
                                        @endforeach
                                    @endif
                                    @if($trip?->customerSafetyAlertPending?->comment)
                                        {{ $trip?->customerSafetyAlertPending?->comment }}
                                    @endif
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <div class="w-100">
                        <span>{{translate("phone")}}</span>
                        <span>:</span>
                        <span>{{$customer->phone}}</span>
                    </div>
                    @if($trip)
                        <div>
                            <span>{{translate("Trip ID")}}</span>
                            <span>:</span>
                            <span>
                            {{ $trip->ref_id }}
                            <a href="{{route('admin.ride-share.ride.show', ['type' => ALL, 'id' => $trip->id, 'page' => 'summary'])}}"
                               target="_blank">
                                <img
                                    src="{{asset('Modules/RideShare/public/assets/img/ride-share/up-right-arrow-square.svg')}}"
                                    class="svg" alt="">
                            </a>
                            </span>
                        </div>
                    @endif
                </div>
            </div>
        </label>
    </li>
@empty
    <div class="text-center p-4">
        <div class="empty--data">
            <img src="{{asset('/public/assets/admin/svg/illustrations/sorry.svg')}}" alt="public">
            <h5>
                {{translate('no Customer found')}}
            </h5>
        </div>
    </div>
@endforelse
