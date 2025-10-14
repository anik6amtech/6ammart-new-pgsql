@extends('service::provider.layouts.app')

@section('title', translate('messages.available_services'))

@push('css_or_js')

@endpush

@section('content')

    <div class="content container-fluid">
        <!-- Page Header -->
        <h2 class="h1 text-capitalize d-flex align-items-center gap-2 mb-20">
            <img width="24" height="24" src="{{asset('Modules/Service/public/assets/img/admin/promotional-cost.png')}}" alt="services"> {{ translate('Promotional Cost Bearer') }}
        </h2>
        
       <div class="card">
            <div class="card-body">
                <h4 class="mb-20 font-medium">{{ translate('Currently you are bearing the mentioned percentage from the promotional cost') }}</h4>
                 <div class="row g-3">
                    <div class="col-sm-6 col-lg-4">
                        <div class="static__card rounded-8 p-20 d-flex align-items-center justify-content-between gap-2" data-bg-color="#0461A50D">
                            <div class="d-flex align-items-center gap-3 gap-mobile-10">
                                <img src="{{asset('Modules/Service/public/assets/img/admin/p-discount.png')}}" alt="dashboard/grocery">
                                <p class="m-0 fz--14px fs-14-to-12 max-w-130px" data-text-color="#334257">
                                    {{ translate('Discount Cost Percentage') }}
                                </p>
                            </div>
                            <h2 class="count mb-1 fz-24 fs-24-to-18" data-text-color="#4153B3">{{ $promotionalCostPercentage['discount']['provider_percentage'] }}%</h2>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="static__card rounded-8 p-20 d-flex align-items-center justify-content-between gap-2" data-bg-color="#07A50412">
                            <div class="d-flex align-items-center gap-3 gap-mobile-10">
                                <img src="{{asset('Modules/Service/public/assets/img/admin/p-campaign.png')}}" alt="dashboard/grocery">
                                <p class="m-0 fz--14px fs-14-to-12 max-w-130px" data-text-color="#334257">
                                    {{ translate('Campaign Cost Percentage') }}
                                </p>
                            </div>
                            <h2 class="count mb-1 fz-24 fs-24-to-18" data-text-color="#00BD6E">{{ $promotionalCostPercentage['campaign']['provider_percentage'] }}%</h2>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="static__card rounded-8 p-20 d-flex align-items-center justify-content-between gap-2" data-bg-color="#C8CB2914">
                            <div class="d-flex align-items-center gap-3 gap-mobile-10">
                                <img src="{{asset('Modules/Service/public/assets/img/admin/p-coupon.png')}}" alt="dashboard/grocery">
                                <p class="m-0 fz--14px fs-14-to-12 max-w-130px" data-text-color="#334257">
                                    {{ translate('Coupon Cost Percentage') }}
                                </p>
                            </div>
                            <h2 class="count mb-1 fz-24 fs-24-to-18" data-text-color="#00BD6E">{{ $promotionalCostPercentage['coupon']['provider_percentage'] }}%</h2>
                        </div>
                    </div>
                </div>
            </div>
       </div>

    </div>

@endsection

@push('script_2')
    
@endpush
