@extends('layouts.admin.app')

@section('title', translate('messages.Ride_Fare_Setup_Zone_List'))

@section('content')
    <div class="content container-fluid">
        <div class="page-header d-flex gap-2 align-items-center pb-4">
            <img class="w--40px aspect-1-1 object-cover" src="{{asset('Modules/RideShare/public/assets/img/ride-share/ride-fare-logo.png')}}" loading="eager" alt="">
            <div>
                <h1 class="page-header-title text--title mb-1">
                    <span>{{ translate('messages.Ride_Fare_Setup') }}</span>
                </h1>
                <p class="fs-16 mb-0">{{ translate('messages.manage_your_ride_sharing_fares_zone_wise') }}</p>
            </div>
        </div>

        <div class="card">
            <div class="card-header justify-content-between align-items-center gap-3 py-2 flex-wrap">
                <div class="flex-grow-1">
                    <h4 class="font-bold mb-0" data-color="#006161">{{ translate('messages.operation_zone_list') }}</h4>
                </div>
                <div class="search--button-wrapper justify-content-end gap-20px">
                    <form method="GET" class="search-form flex-grow-1 max-w-450px">
                        <div class="input-group input--group">
                            <input id="datatableSearch_" type="search" value="{{ request()->get('search') }}" name="search"
                                   class="form-control" placeholder="{{ translate('search_by_zone_or_vehicle') }}">
                            <button type="submit" class="btn btn--secondary btn-primary"><i class="tio-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card-body">
                <div class="d-flex flex-column gap-3">
                    @forelse($zones as $zone)
                        <div class="__bg-FAFAFA card border-0 mb-3">
                            <div class="card-body">
                                <div class="row gy-4 align-items-center">
                                    <div class="col-lg-4">
                                        <div class="media flex-wrap gap-3">
                                            <span class="font-bold text--title btn-circle border border-title bg-opacity-10" data-bg-color="#334257">{{ $loop->iteration }}</span>
                                            <div class="media-body">
                                                <h4 class="text--title font-bold">{{ $zone->name }}</h4>
                                                <h5 class="text--title font-bold mb-0">
                                                    <span class="opacity-70">{{ translate('total_driver') }} :</span>
                                                    <span>{{ $zone->drivers_count }}</span>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <h5 class="text--title opacity-70 font-bold mb-3 text-capitalize">
                                            {{ translate('available_vehicle_category') }}
                                        </h5>
                                        <div class="d-flex flex-wrap align-items-center gap-3">
                                            @foreach($vehicleCategories as $vc)
                                                @if($fares->where('zone_id', $zone->id)->firstWhere('vehicle_category_id', $vc->id))
                                                    <div class="d-flex align-items-center gap-2 min-w-80px">
                                                        <span class="btn-circle btn-circle--16 lh-1 bg-primary text-white" data-bg-color="#006161"><i class="tio-done fs-10"></i></span>
                                                        {{ $vc->name }}
                                                    </div>
                                                @else
                                                    <div class="d-flex align-items-center gap-2 min-w-80px">
                                                        <span class="btn-circle btn-circle--16 p-2 bg-soft-primary bg-opacity-20"></span>
                                                        {{ $vc->name }}
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="d-flex justify-content-lg-end">
                                            <a href="{{ route('admin.ride-share.fare.trip.create', [$zone->id]) }}"
                                               class="btn btn--primary text-capitalize d-flex align-items-center gap-2 lh-1">
                                                <i class="fi fi-sr-settings"></i> {{ translate('view_fare_setup') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="__bg-FAFAFA card border-0 mb-3">
                            <div class="card-body">
                                <div class="text-center">
                                    <h5 class="text--title font-bold mb-3">{{ translate('please_add_or_activate_a_zone') }}</h5>
                                    <a href="{{ route('admin.zone.index') }}" class="btn btn--primary text-capitalize">
                                        <i class="tio-arrow-back"></i> {{ translate('go_to_zone_setup') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script_2')
@endpush
