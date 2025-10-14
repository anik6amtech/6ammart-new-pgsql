@forelse($drivers as $driver)
    @php
        $trip = $driver?->driverTrips()?->whereIn('current_status',[ACCEPTED,ONGOING])->where('type', RIDE_REQUEST)->first()
    @endphp
    <li class="user-details">
        <label class="form-check" data-id="{{$driver->id}}">
            <img class="form-check-img svg"
                 src="{{$trip ? asset('Modules/RideShare/public/assets/img/ride-share/paper-plane.svg') :asset('Modules/RideShare/public/assets/img/ride-share/idle.svg') }}"
                 alt="">
            <div class="form-check-label">
                <div class="d-flex gap-2 align-items-center mb-2">
                    <h5 class="zone-name flex-grow-1 mb-0">{{ $driver->f_name .' '.$driver->l_name }}
                        <span
                            class="badge badge-info">{{Carbon\Carbon::parse($driver->created_at)->diffInMonths(Carbon\Carbon::now())<6 ? translate("New") : ""}}</span>
                    </h5>
                    @if($trip?->driverSafetyAlertPending)
                        <div class="flex-shrink-0 position-relative hover-like-tooltip">
                            <img class="svg" src="{{asset('Modules/RideShare/public/assets/img/ride-share/shield-red.svg')}}"
                                 alt="">
                            <div class="like-tooltip">
                                @if($trip?->driverSafetyAlertPending?->reason || $trip?->driverSafetyAlertPending?->comment)
                                    @if($trip?->driverSafetyAlertPending?->reason)
                                        @foreach($trip?->driverSafetyAlertPending?->reason as $reason)
                                            {{ $reason }}
                                            <br>
                                        @endforeach
                                    @endif
                                    @if($trip?->driverSafetyAlertPending?->comment)
                                        {{ $trip?->driverSafetyAlertPending?->comment }}
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
                        <span>{{$driver->phone}}</span>
                    </div>
                    <div>
                        <span>{{translate("Vehicle No")}}</span>
                        <span>:</span>
                        <span>{{$driver?->rider_vehicle?->licence_plate_number ?? "N/A"}}</span>
                    </div>
                    <span class="fs-8">|</span>
                    <div>
                        <span>{{translate("Model")}}</span>
                        <span>:</span>
                        <span>{{$driver?->rider_vehicle?->model?->name ?? "N/A"}}</span>
                    </div>
                </div>
            </div>
        </label>
    </li>
@empty
    <div class="text-center p-4">
        <div class="empty--data">
            <img src="{{asset('/public/assets/admin/svg/illustrations/sorry.svg')}}" alt="public">
            <h5>
                {{translate('no_driver_found')}}
            </h5>
        </div>
    </div>
@endforelse
