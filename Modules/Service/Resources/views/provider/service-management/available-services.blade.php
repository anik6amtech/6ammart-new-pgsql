@extends('service::provider.layouts.app')

@section('title', translate('messages.available_services'))

@push('css_or_js')

@endpush

@section('content')
    
<div class="content container-fluid">
    <!-- Page Title -->
    <h2 class="h1 mb-sm-3 mb-2 text-capitalize d-flex align-items-center gap-2">
       <img width="24" height="24" src="{{ asset('Modules/Service/public/assets/img/admin/service-time.png') }}" alt="services"> {{ translate('messages.available_services') }} <span class="rounded py-1 fz-12px px-2 mb-0 text-title" data-bg-color="#3342571A">{{ $subCategories->count() }}</span>
    </h2>
    <div class="card">
        <div class="card-body">
            <div class="row g-4">
                <div class="col-lg-3 col-md-4">
                    <div class="js-nav-scroller hs-nav-scroller-horizontal">
                        <ul class="nav nav-tabs nav--tabs_menu flex-column border-0" id="myTab"
                            role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link {{ (request()->active_category == 'all' || !request()->has('active_category')) ? 'active' : '' }}" href="{{ route('provider.service.service.available', ['active_category' => 'all']) }}" type="button"
                                    role="tab" aria-controls="home" aria-selected="true">{{ translate('messages.all') }}</a>
                            </li>
                            @foreach($categories as $category)
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link {{ $category->id == request()->active_category ? 'active' : '' }}" href="{{ route('provider.service.service.available', ['active_category' => $category->id]) }}" type="button"
                                        role="tab" aria-controls="profile" aria-selected="false">{{ $category->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row g-3">
                                <div class="offCanvasoverlay" id="overlayPayment"></div>
                                @foreach($subCategories as $subCategory)
                                    <div class="col-sm-6 col-lg-4">
                                        <div class="available-service-item shadow-sm rounded-8 overflow-hidden bg-white">
                                            <a href="#0" class="d-block">
                                                <img class="w-100" src="{{ $subCategory->image_full_path }}" alt="images">
                                            </a>
                                            <a href="#0" class="d-block fz--14px bg-white py-3 text-title px-3">
                                                {{ $subCategory->name }}
                                            </a>
                                            <div class="d-flex align-items-center gap-1 justify-content-between py-3 px-3" data-bg-color="#F6F6F6">
                                                <a href="#0" class="fz--14px font-medium text-underline m-0 offcanvas-toggle" data-toggle="offcanvas" data-target="#available-services-{{ $subCategory->id }}" data-text-color="#107980">{{ $subCategory->services_count }} <small>{{ translate('messages.services') }}</small></a>
                                                @if(in_array($subCategory->id, $subscribedIds))
                                                    <button type="button" class="btn btn--danger px-xxl-4 px-2 form-alert" data-id="subscribe-{{ $subCategory->id }}" data-message="{{translate('messages.you_want_to_unsubscribe_this_category')}}" title="{{translate('messages.unsubscribe_category')}}">{{ translate('messages.unsubscribe') }}</button>
                                                @else
                                                    <button type="button" class="btn btn--primary px-xxl-4 px-2 form-alert" data-id="subscribe-{{ $subCategory->id }}" data-message="{{translate('messages.you_want_to_subscribe_this_category')}}" title="{{translate('messages.subscribe_category')}}">{{ translate('messages.subscribe') }}</button>
                                                @endif
                                                {{--  --}}
                                                <form action="{{ route('provider.service.service.update-subscription') }}" method="post" id="subscribe-{{ $subCategory->id }}">
                                                    <input type="hidden" name="sub_category_id" value="{{ $subCategory->id }}">
                                                    @csrf @method('put')
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Offcanvas -->
                                    <div class="offcanvas" id="available-services-{{ $subCategory->id }}" data-overlay="#overlayPayment">
                                        <div class="offcanvas__header d-flex justify-content-between align-items-center gap-3 pb-0">
                                            <h3 class="mb-0 text-capitalize"></h3>
                                            <div class="d-flex gap-3 align-items-center">
                                                <button class="bg-light text-dark border d-center w-30px h-30 rounded-circle closeOfcanvus">
                                                    <i class="tio-clear"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="offcanvas__body">
                                            <div class="d-flex align-items-center gap-3 border-bottom pb-3 mb-3">
                                                    <img width="80" height="80" class="rounded-pill border" src="{{ $subCategory->image_full_path }}" alt="images">
                                                    <div>
                                                        <h2 class="mb-1">{{ $subCategory->name }}</h2>
                                                        <p class="mb-0 fz--14px">{{ $subCategory->services_count }} {{ translate('messages.services_available') }}</p>
                                                    </div>
                                            </div>
                                            <div class="d-flex flex-column gap-20px">
                                                @foreach($subCategory->services as $service)
                                                <a href="{{ route('provider.service.service.service-details', $service->id) }}" class="d-flex align-items-center gap-3">
                                                    <img width="80" height="80" class="rounded" src="{{ $service->thumbnail_full_path }}" alt="images">
                                                    <span>
                                                        <h5 class="mb-1">{{ $service->name }}</h5>
                                                        <span data-text-color="#334257">{{ $service->variations_count }} {{ translate('messages.variations') }}</span>
                                                    </span>
                                                </a>
                                                @endforeach    
                                            </div>
                                        </div>
                                        <div class="offcanvas__footer d-center bg-white py-2">
                                            <div class="d-flex justify-content-center align-items-center gap-3 w-100">
                                                @if(in_array($subCategory->id, $subscribedIds))
                                                <button type="button" class="btn w-100 btn--danger px-4 font-semibold form-alert" data-id="subscribe-{{ $subCategory->id }}" data-message="{{translate('messages.you_want_to_unsubscribe_this_category')}}" title="{{translate('messages.unsubscribe_category')}}">{{ translate('messages.unsubscribe_from_this_category') }}</button>
                                                @else
                                                <button type="button" class="btn w-100 btn--primary px-4 font-semibold form-alert" data-id="subscribe-{{ $subCategory->id }}" data-message="{{translate('messages.you_want_to_subscribe_this_category')}}" title="{{translate('messages.subscribe_category')}}">{{ translate('messages.subscribe_to_this_category') }}</button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('script_2')
    
    <script>
        
    </script>
@endpush
