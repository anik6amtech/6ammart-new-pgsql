<div class="row g-2">
    <div class="col-lg-3 col-sm-6">
        <div class="border rounded-10 p-20 d-flex flex-column">
            <div class="text-right">
                <img width="40" class="aspect-1-1" src="{{asset('Modules/RideShare/public/assets/img/ride-share/pending-req.png')}}" alt="">
            </div>
            <div>
                <h5 class="text--primary mb-0 font-semibold"> {{ translate('messages.Pending_Req.') }}</h5>
                <h2 class="fs-27 mb-0">{{ $trip_counts->firstWhere('current_status', PENDING)?->total_records + 0 }}</h2>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="border rounded-10 p-20 d-flex flex-column">
            <div class="text-right">
                <img width="40" class="aspect-1-1" src="{{asset('Modules/RideShare/public/assets/img/ride-share/accepted-req.png')}}" alt="">
            </div>
            <div>
                <h5 class="text--primary mb-0 font-semibold"> {{ translate('messages.Accepted_Req.') }}</h5>
                <h2 class="fs-27 mb-0">{{$trip_counts->firstWhere('current_status', ACCEPTED)?->total_records + 0}}</h2>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="border rounded-10 p-20 d-flex flex-column">
            <div class="text-right">
                <img width="40" class="aspect-1-1" src="{{asset('Modules/RideShare/public/assets/img/ride-share/ongoing.png')}}" alt="">
            </div>
            <div>
                <h5 class="text--primary mb-0 font-semibold"> {{ translate('messages.Ongoing') }}</h5>
                <h2 class="fs-27 mb-0">{{$trip_counts->firstWhere('current_status', ONGOING)?->total_records + 0}}</h2>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="border rounded-10 p-20 d-flex flex-column">
            <div class="text-right">
                <img width="40" class="aspect-1-1" src="{{asset('Modules/RideShare/public/assets/img/ride-share/completed.png')}}" alt="">
            </div>
            <div>
                <h5 class="text--primary mb-0 font-semibold"> {{ translate('messages.Completed') }}</h5>
                <h2 class="fs-27 mb-0">{{$trip_counts->firstWhere('current_status', COMPLETED)?->total_records + 0}}</h2>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-sm-6">
        <div class="border rounded-10 p-20 d-flex flex-column">
            <div class="text-right">
                <img width="40" class="aspect-1-1" src="{{asset('Modules/RideShare/public/assets/img/ride-share/canceled.png')}}" alt="">
            </div>
            <div>
                <h5 class="text--primary mb-0 font-semibold"> {{ translate('messages.Canceled') }}</h5>
                <h2 class="fs-27 mb-0">{{$trip_counts->firstWhere('current_status', CANCELLED)?->total_records + 0}}</h2>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-sm-6">
        <div class="border rounded-10 p-20 d-flex flex-column">
            <div class="text-right">
                <img width="40" class="aspect-1-1" src="{{asset('Modules/RideShare/public/assets/img/ride-share/ongoing.png')}}" alt="">
            </div>
            <div>
                <h5 class="text--primary mb-0 font-semibold"> {{ translate('messages.Returning') }}</h5>
                <h2 class="fs-27 mb-0">{{$trip_counts->firstWhere('current_status', RETURNING)?->total_records + 0}}</h2>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-sm-6">
        <div class="border rounded-10 p-20 d-flex flex-column">
            <div class="text-right">
                <img width="40" class="aspect-1-1" src="{{asset('Modules/RideShare/public/assets/img/ride-share/completed.png')}}" alt="">
            </div>
            <div>
                <h5 class="text--primary mb-0 font-semibold"> {{ translate('messages.Returned') }}</h5>
                <h2 class="fs-27 mb-0">{{$trip_counts->firstWhere('current_status', RETURNED)?->total_records + 0}}</h2>
            </div>
        </div>
    </div>
</div>