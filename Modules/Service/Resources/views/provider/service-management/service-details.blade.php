@extends('service::provider.layouts.app')

@section('title', translate('messages.available_services'))

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-20">
            <h4 class="page-header-title mb-0">{{translate('messages.Service Details')}}</h4>
            <div class="d-flex gap-2 align-items-center flex-wrap">
            </div>
        </div>
        
        <!-- Stats -->
        <div class="mb-20">
            <div class="row g-2">
                <div class="col-sm-6 col-lg-4">
                    <div class="static__card rounded-8 p-20 d-flex align-items-center justify-content-between gap-2" data-bg-color="#EAFBFF">
                        <div>
                            <h2 class="count mb-1 fz-24" data-text-color="#2A95FF">{{ $service['all_booking'] }}</h2>
                            <div class="subtxt fz--14px">{{ translate('messages.total_bookings') }}</div>
                        </div>
                        <img src="{{asset('Modules/Service/public/assets/img/admin/ride-earning.png')}}" alt="{{ translate('messages.dashboard_image') }}">
                    </div>
                </div>

                 <div class="col-sm-6 col-lg-4">
                    <div class="static__card rounded-8 p-20 d-flex align-items-center justify-content-between gap-2" data-bg-color="#FFF7E7">
                        <div>
                            <h2 class="count mb-1 fz-24" data-text-color="#F3A735">{{ $service['ongoing_count'] }}</h2>
                            <div class="subtxt fz--14px">{{ translate('messages.ongoing') }}</div>
                        </div>
                        <img src="{{asset('Modules/Service/public/assets/img/admin/booking-earning.png')}}" alt="{{ translate('messages.dashboard_image') }}">
                    </div>
                </div>
               
                <div class="col-sm-6 col-lg-4">
                    <div class="static__card rounded-8 p-20 d-flex align-items-center justify-content-between gap-2" data-bg-color="#FFF2F2">
                        <div>
                            <h2 class="count mb-1 fz-24" data-text-color="#F05B50">{{ $service['canceled_count'] }}</h2>
                            <div class="subtxt fz--14px">{{ translate('messages.canceled') }}</div>
                        </div>
                        <img src="{{asset('Modules/Service/public/assets/img/admin/commuission-earning.png')}}" alt="{{ translate('messages.dashboard_image') }}">
                    </div>
                </div>
            </div>
        </div>

         <!-- Nav -->
        <div class="js-nav-scroller hs-nav-scroller-horizontal">
            <ul class="nav nav-tabs border-0 nav--tabs nav--pills mb-4">
                <li class="nav-item" role="presentation">
                    <a class="nav-link py-2 px-3 rounded {{!isset($webPage) || $webPage=='general'?'active':''}}" href="#0" id="home-tab-details1" data-toggle="tab"
                        data-target="#home-details1" type="button" role="tab" aria-controls="home-details1"
                        aria-selected="true">{{ translate('messages.overview') }}</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link py-2 px-3 rounded {{!isset($webPage) || $webPage=='faq'?'active':''}}" href="#0" id="profile-tab-details2" data-toggle="tab"
                        data-target="#profile-details2" type="button" role="tab" aria-controls="profile-details2"
                        aria-selected="false">{{ translate('messages.service_faqs') }}</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link py-2 px-3 rounded {{!isset($webPage) || $webPage=='review'?'active':''}}" href="#0" id="profile-tab-details3" data-toggle="tab"
                        data-target="#profile-details3" type="button" role="tab" aria-controls="profile-details3"
                        aria-selected="false">{{ translate('messages.reviews') }}</a>
                </li>
            </ul>
        </div>
        <div class="tab-content" id="myTabContent">
            <!-- Overview -->
            <div class="tab-pane fade {{!isset($webPage) || $webPage=='general'?'show active':''}}" id="home-details1" role="tabpanel" aria-labelledby="home-tab-details1">
                <!-- Commercial Slide option -->
                <div class="card mb-20">
                    <div class="card-body">
                        <div class="d-flex flex-sm-nowrap flex-wrap gap-3">
                            <div class="custom-images-slidewrap mb-20">
                                <div class="custom-images-slideinner d-flex align-items-center gap-2">
                                    <div class="view-img-popup">
                                        <img width="143" height="143" src="{{ $service->thumbnail_full_path }}" alt="{{ translate('messages.service_image') }}">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="custom-images-slidewrap mb-2">
                                    <div class="custom-images-slideinner d-flex align-items-center gap-2">
                                        <div class="view-img-popup">
                                            <img width="40" height="40" src="{{ $service->cover_image_full_path }}" alt="{{ translate('messages.service_image') }}">
                                        </div>  
                                    </div>
                                </div>
                                <ul class="nav nav-tabs nav--tabs mb-3 border-0">
                                    <li class="nav-item">
                                        <a class="nav-link lang_link1 active" data-toggle="tab" href="#default-details2">{{ translate('messages.default') }}</a>
                                    </li>
                                    @foreach($language as $lang)
                                    <li class="nav-item">
                                        <a class="nav-link lang_link1" data-toggle="tab" href="#{{ $lang }}-details2">{{ \App\CentralLogics\Helpers::get_language_name($lang) . '(' . strtoupper($lang) . ')' }}</a>
                                    </li>
                                    @endforeach
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="default-details2">
                                        <div class="mb-0">
                                            <h2 class="mb-1">{{ $service->getRawOriginal('name') }}</h2>
                                            <p class="mb-0">{{ $service->getRawOriginal('short_description') }}</p>
                                        </div>
                                    </div>
                                    @foreach($language as $lang)
                                    <?php
                                        if (count($service['translations'])) {
                                            $translate = [];
                                            foreach ($service['translations'] as $t) {
                                                if ($t->locale == $lang && $t->key == 'name') {
                                                    $translate[$lang]['name'] = $t->value;
                                                }
                                                if ($t->locale == $lang && $t->key == 'short_description') {
                                                    $translate[$lang]['short_description'] = $t->value;
                                                }
                                            }
                                        }
                                    ?>
                                    <div class="tab-pane fade" id="{{ $lang }}-details2">
                                        <div class="mb-0">
                                            <h2 class="mb-1">{{ $translate[$lang]['name'] ?? '' }}</h2>
                                            <p class="mb-0">{{ $translate[$lang]['short_description'] ?? '' }}</p>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- General Info -->
                <div class="card mb-20">
                    <div class="table-responsive">
                        <table id="example" class="table m-0 align-middle align-middle-cus table-custom-space tr-hover">
                            <thead class="text-nowrap bg-light">
                                <tr>
                                    <th class="fz--14px text-title border-0">{{ translate('messages.general_info') }}</th>
                                    <th class="fz--14px text-title border-0">{{ translate('messages.price_and_tax') }}</th>
                                    <th class="fz--14px text-title border-0">{{ translate('messages.service_zone') }}</th>
                                    <th class="fz--14px text-title border-0">{{ translate('messages.tags') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex flex-column gap-2">
                                            <div class="d-flex align-items-start gap-1">
                                                <span class="w-120 d-block fz--14px lh--12 text-title">
                                                    {{ translate('messages.category') }}
                                                </span>
                                                <span>:</span>
                                                <span class="text-title font-medium">
                                                    {{ $service->category->name }}
                                                </span>
                                            </div>
                                            <div class="d-flex align-items-start gap-1">
                                                <span class="w-120 d-block fz--14px lh--12 text-title">
                                                    {{ translate('messages.sub_category') }}
                                                </span>
                                                <span>:</span>
                                                <span class="text-title font-medium">
                                                    {{ $service->subCategory->name }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column gap-2">
                                            <div class="d-flex align-items-start gap-1">
                                                <span class="w-120 d-block fz--14px lh--12 text-title">
                                                    {{ translate('messages.minimum_bidding_price') }} ($)
                                                </span>
                                                <span>:</span>
                                                <span class="text-title font-medium">
                                                    {{ $service->min_bidding_price }}
                                                </span>
                                            </div>
                                            <div class="d-flex align-items-start gap-1">
                                                <span class="w-120 d-block fz--14px lh--12 text-title">
                                                    {{ translate('messages.service_tax') }}
                                                </span>
                                                <span>:</span>
                                                <span class="text-title font-medium">
                                                    {{ $service->tax }}%
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-title fz--14px">
                                            @foreach($service->category->zones as $zone)
                                                <span class="badge badge--primary">{{ $zone->name }}</span>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-title fz--14px">
                                           @foreach($service->tags as $tag)
                                                <span class="badge badge--secondary">{{ $tag->tag }}</span>
                                            @endforeach
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--Description-->
                <div class="card mb-20">
                    <div class="p-20 bg-light">
                        <h4 class="mb-0">{{ translate('messages.description') }}</h4>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs nav--tabs mb-20 border-0">
                            <li class="nav-item">
                                <a class="nav-link lang_link1 active" data-toggle="tab" href="#default-details3">{{ translate('messages.default') }}</a>
                            </li>
                            @foreach($language as $lang)
                            <li class="nav-item">
                                <a class="nav-link lang_link1" data-toggle="tab" href="#{{ $lang }}-details3">{{ \App\CentralLogics\Helpers::get_language_name($lang) . '(' . strtoupper($lang) . ')' }}</a>
                            </li>
                            @endforeach
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="default-details3">
                                <div class="description-listing-wrap">
                                    {!! $service->getRawOriginal('description') !!}
                                </div>
                            </div>
                                @foreach($language as $lang)
                                <?php
                                    if (count($service['translations'])) {
                                        $translate = [];
                                        foreach ($service['translations'] as $t) {
                                            if ($t->locale == $lang && $t->key == 'description') {
                                                $translate[$lang]['description'] = $t->value;
                                            }
                                        }
                                    }
                                ?>
                                <div class="tab-pane fade" id="{{ $lang }}-details3">
                                    <div class="description-listing-wrap">
                                        {!! $translate[$lang]['description'] ?? '' !!}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- Variations Table -->
                <div class="card">
                    <div class="table-responsive">
                        <table id="example" class="table m-0 align-middle align-middle-cus table-custom-space tr-hover">
                            <thead class="text-nowrap bg-light">
                                <tr>
                                    <th class="fz--14px text-title border-0">{{ translate('messages.variations') }}</th>
                                    <th class="fz--14px text-title border-0">{{ translate('messages.default_price') }}($)</th>
                                    @foreach($service->category->zones as $zone)
                                        <th class="fz--14px text-title border-0">{{$zone->name}}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($service->variations))
                                    @php($variant_keys = $service->variations->pluck('variant_key')->unique()->toArray())
                                    @foreach($variant_keys as $key=>$item)
                                        <tr>
                                            <td class="text-title" style="background-color: #f9fafc;">
                                                {{str_replace('-',' ',$item)}}
                                            </td>
                                            <td class="max-w-170px" style="background-color: #f9fafc;">
                                                {{$service->variations->where('price','>',0)->where('variant_key',$item)->first()->price??0}}
                                            </td>
                                            @foreach($service->category->zones as $zone)
                                                <td>
                                                    {{$service->variations->where('zone_id',$zone->id)->where('variant_key',$item)->first()->price??0}}
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Service Faq -->
            <div class="tab-pane fade {{!isset($webPage) || $webPage=='faq'?'show active':''}}" id="profile-details2" role="tabpanel" aria-labelledby="profile-tab-details2">
               
               <div class="card">
                    <div class="card-body">
                        <h4 class="mb-20">{{translate('messages.FAQ List')}}</h4>
                        <div class="accordion d-flex flex-column gap-4" id="faq-list">
                            @include('service::provider.service-management.partials._faq-list',['faqs'=>$faqs])
                        </div>
                    </div>
               </div>
            </div>
            <!-- Service Review -->
            <div class="tab-pane fade {{!isset($webPage) || $webPage=='review'?'show active':''}}" id="profile-details3" role="tabpanel" aria-labelledby="profile-tab-details3">
                <div class="card mb-20">
                    <div class="card-body">
                        <div class="row g-4 align-items-center">
                            <!-- Rating Summary -->
                            <div class="col-lg-6 col-sm-5">
                                <div class="text-center">
                                    <h2 class="text--primary mb-1">
                                        {{ $service->avg_rating }} <small class="opacity-30">/5</small>
                                    </h2>
                                    <div class="d-flex align-items-center gap-1 justify-content-center text-primary">
                                        <i class="{{ $service->avg_rating >= 1 ? 'tio-star' : 'tio-star-outlined' }}"></i>
                                        <i class="{{ $service->avg_rating >= 2 ? 'tio-star' : 'tio-star-outlined' }}"></i>
                                        <i class="{{ $service->avg_rating >= 3 ? 'tio-star' : 'tio-star-outlined' }}"></i>
                                        <i class="{{ $service->avg_rating >= 4 ? 'tio-star' : 'tio-star-outlined' }}"></i>
                                        <i class="{{ $service->avg_rating >= 5 ? 'tio-star' : 'tio-star-outlined' }}"></i>
                                    </div>
                                    @php($total_review_count = $service->reviews->where('is_active', 1)->whereNotNull('review_rating')->whereNotNull('review_comment')->count())
                                    @php($totalReviews = $service->reviews->where('is_active', 1)->whereNotNull('review_rating')->count())
                                    <span class="fs-12 opacity-70" data-text-color="#334257B2">
                                        {{ $totalReviews }} {{ translate('ratings') }} • {{ $total_review_count }} {{ translate('reviews') }}
                                    </span>
                                </div>
                            </div>

                            <!-- Rating Distribution -->
                            <div class="col-lg-6 col-sm-7">
                                <ul class="list-unstyled list-unstyled-py-2 mb-0 py-3 flex-grow-1 review-color-progress">

                                    <!-- Excellent -->
                                    @php($excellent_count=$service->reviews->where('is_active', 1)->where('review_rating',5)->count())
                                    @php($excellent=(divnum($excellent_count,$total_review_count))*100)
                                    <li class="d-flex align-items-center font-size-sm">
                                        <span class="progress-name mr-3">{{ translate('excellent') }}</span>
                                        <div class="progress flex-grow-1">
                                            <div class="progress-bar" role="progressbar"
                                                style="width: {{ $excellent }}%"
                                                aria-valuenow="{{ $excellent }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <span class="ml-3">{{ $excellent_count }}</span>
                                    </li>

                                    <!-- Good -->
                                    @php($good_count=$service->reviews->where('is_active', 1)->where('review_rating',4)->count())
                                    @php($good=(divnum($good_count,$total_review_count))*100)
                                    <li class="d-flex align-items-center font-size-sm">
                                        <span class="progress-name mr-3">{{ translate('good') }}</span>
                                        <div class="progress flex-grow-1">
                                            <div class="progress-bar" role="progressbar"
                                                style="width: {{ $good }}%"
                                                aria-valuenow="{{ $good }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <span class="ml-3">{{ $good_count }}</span>
                                    </li>

                                    <!-- Average -->
                                    @php($average_count=$service->reviews->where('is_active', 1)->where('review_rating',3)->count())
                                    @php($average=(divnum($average_count,$total_review_count))*100)
                                    <li class="d-flex align-items-center font-size-sm">
                                        <span class="progress-name mr-3">{{ translate('average') }}</span>
                                        <div class="progress flex-grow-1">
                                            <div class="progress-bar" role="progressbar"
                                                style="width: {{ $average }}%"
                                                aria-valuenow="{{ $average }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <span class="ml-3">{{ $average_count }}</span>
                                    </li>

                                    <!-- Below Average -->
                                    @php($below_average_count=$service->reviews->where('is_active', 1)->where('review_rating',2)->count())
                                    @php($below_average=(divnum($below_average_count,$total_review_count))*100)
                                    <li class="d-flex align-items-center font-size-sm">
                                        <span class="progress-name mr-3">{{ translate('below_average') }}</span>
                                        <div class="progress flex-grow-1">
                                            <div class="progress-bar" role="progressbar"
                                                style="width: {{ $below_average }}%"
                                                aria-valuenow="{{ $below_average }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <span class="ml-3">{{ $below_average_count }}</span>
                                    </li>

                                    <!-- Poor -->
                                    @php($poor_count=$service->reviews->where('is_active', 1)->where('review_rating',1)->count())
                                    @php($poor=(divnum($poor_count,$total_review_count))*100)
                                    <li class="d-flex align-items-center font-size-sm">
                                        <span class="progress-name mr-3">{{ translate('poor') }}</span>
                                        <div class="progress flex-grow-1">
                                            <div class="progress-bar" role="progressbar"
                                                style="width: {{ $poor }}%"
                                                aria-valuenow="{{ $poor }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <span class="ml-3">{{ $poor_count }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="data-table-top border-bottom d-flex align-items-center flex-wrap gap-3 justify-content-between p-3">
                        <h4 class="text-title mb-0">{{ translate('Reviews') }}</h4>
                        <div class="d-flex flex-wrap align-items-center gap-3">
                            <form class="search-form">
                                    <!-- Search -->
                                <div class="input-group input--group">
                                    <input id="datatableSearch_" type="search" value="{{ request()?->review_search ?? null }}" name="review_search" class="form-control"
                                            placeholder="{{translate('search_review_id')}}" aria-label="{{translate('messages.search')}}" >
                                    <button type="submit" class="btn btn--secondary"><i class="tio-search"></i></button>

                                </div>
                                <!-- End Search -->
                            </form>
                            {{-- <div class="hs-unfold mr-2">
                                <a class="js-hs-unfold-invoker btn btn-sm btn-white dropdown-toggle h--45px border" href="javascript:;" data-hs-unfold-options="{
                                        &quot;target&quot;: &quot;#usersExportDropdown&quot;,
                                        &quot;type&quot;: &quot;css-animation&quot;
                                    }" data-hs-unfold-target="#usersExportDropdown" data-hs-unfold-invoker="">
                                    <i class="tio-download-to mr-1"></i> {{ translate('Export') }}
                                </a>

                                <div id="usersExportDropdown" class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right hs-unfold-content-initialized hs-unfold-css-animation animated hs-unfold-hidden" data-hs-target-height="131.516" data-hs-unfold-content="" data-hs-unfold-content-animation-in="slideInUp" data-hs-unfold-content-animation-out="fadeOut" style="animation-duration: 300ms;">
                                    <span class="dropdown-header">{{ translate('Download options') }}</span>
                                    <a id="export-excel" class="dropdown-item" href="{{route('admin.service.service.reviews.download',['review_search'=>$search, 'service_id' => request()->id])}}">
                                        <img class="avatar avatar-xss avatar-4by3 mr-2" src="{{asset('/public/assets/admin/svg/components/excel.svg')}}" alt="Image Description">
                                        {{ translate('Excel') }}
                                    </a>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="">
                        <div class="table-responsive">
                            <table id="example" class="table align-middle">
                                <thead class="text-capitalize">
                                    <tr>
                                        <th>{{translate('SL')}}</th>
                                        <th class="text-nowrap">{{translate('Review ID')}}</th>
                                        <th>{{translate('reviewer')}}</th>
                                        <th>{{translate('date')}}</th>
                                        <th>{{translate('ratings')}}</th>
                                        <th>{{translate('reviews')}}</th>
                                        <th>{{translate('reply')}}</th>
                                        {{-- <th>{{translate('status')}}</th> --}}
                                        <th>{{translate('action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($reviews as $key => $review)
                                    <tr>
                                        <td>{{$key+$reviews?->firstItem()}}</td>
                                        <td>{{ $review->id == 0 ? 'N/A' : $review->id }}</td>
                                        <td>
                                            @if(isset($review->customer))
                                                <span>{{$review->customer->f_name . ' ' .$review->customer->l_name}}</span><br>
                                                <span>{{ translate('Booking ID #') . $review?->booking?->id }}</span>
                                            @else
                                                <span class="opacity-50">{{translate('Customer_not_available')}}</span>
                                            @endif
                                        </td>
                                        <td>{{$review->created_at}}</td>
                                        <td>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="15" viewBox="0 0 14 15" fill="none">
                                                <path d="M7 1.81445L8.854 5.76398L13 6.4012L10 9.47376L10.708 13.8145L7 11.764L3.292 13.8145L4 9.47376L1 6.4012L5.146 5.76398L7 1.81445Z" fill="#FFB900" stroke="#FFB900" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            {{$review->review_rating}}
                                        </td>
                                        <td data-bs-custom-class="review-tooltip" data-bs-toggle="tooltip" title="{{$review->review_comment}}">{{ Str::limit($review->review_comment, 100) ?? translate('No review yet') }}</td>
                                        <td data-bs-custom-class="review-tooltip" data-bs-toggle="tooltip" title="{{$review->reviewReply?->reply}}">{{ Str::limit($review->reviewReply?->reply, 100) ?? translate('No reply yet') }}</td>
                                        {{-- <td>
                                            @if(!empty($review->review_comment))
                                                <div class="d-flex justify-content-center">
                                                    <label class="toggle-switch toggle-switch-sm" for="statusCheckbox{{$review->id}}">
                                                        <input type="checkbox"
                                                        data-id="statusCheckbox{{$review->id}}"
                                                        data-type="status"
                                                        data-image-on="{{ asset('/public/assets/admin/img/modal/basic_campaign_on.png') }}"
                                                        data-image-off="{{ asset('/public/assets/admin/img/modal/basic_campaign_off.png') }}"
                                                        data-title-on="{{ translate('By_Turning_ON_review!') }}"
                                                        data-title-off="{{ translate('By_Turning_OFF_review!') }}"
                                                        data-text-on="<p>{{ translate('If_you_turn_on_this_status,_it_will_show_on_user_app.') }}</p>"
                                                        data-text-off="<p>{{ translate('If_you_turn_off_this_status,_it_won’t_show_on_user_app') }}</p>"
                                                        class="toggle-switch-input  dynamic-checkbox" id="statusCheckbox{{$review->id}}" {{$review->is_active?'checked':''}}>
                                                        <span class="toggle-switch-label">
                                                            <span class="toggle-switch-indicator"></span>
                                                        </span>
                                                    </label>
                                                    <form action="{{route('admin.service.service.review-status-update',$review->id)}}"
                                                    method="get" id="statusCheckbox{{$review->id}}_form">
                                                        <input type="hidden" name="status" value="{{$review->is_active?0:1}}">
                                                        <input type="hidden" name="id" value="{{$review->id}}">
                                                    </form>
                                                </div>
                                            @endif
                                        </td> --}}
                                        <td>
                                            @if(!empty($review->review_comment))
                                            <div class="d-flex gap-2 justify-content-center">
                                                <button
                                                    class="btn action-btn btn--primary btn-outline-primary"
                                                    data-toggle="modal" id="replyModalBtn"
                                                    data-target="#replyModal"
                                                    data-booking_id="{{$review?->booking?->id}}"
                                                    data-readable_id="{{$review->id}}"
                                                    data-service_name="{{$review->service->name}}"
                                                    data-service_img="{{$review->service->cover_image_full_path}}"
                                                    data-review="{{$review->review_comment ?? translate('No review yet')}}"
                                                    data-review_reply="{{$review->reviewReply?->reply ?? translate('No reply yet')}}"
                                                    data-variant_key="{{ $review->booking?->detail[0]?->variant_key }}"
                                                >
                                                    <i class="tio-visible"></i>
                                                </button>
                                            </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if(count($reviews) !== 0)
                            <hr>
                        @endif
                        <div class="page-area mt-3">
                            {!! $reviews->appends($_GET)->links() !!}
                        </div>
                        @if(count($reviews) === 0)
                            <div class="empty--data">
                                <img src="{{asset('/public/assets/admin/svg/illustrations/sorry.svg')}}" alt="public">
                                <h5>
                                    {{translate('no_data_found')}}
                                </h5>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="imagePopup" style="display:none;">
        <div class="popup-overlay"></div>
        <div class="popup-content">
            <div class="d-flex justify-content-between align-items-center gap-2">
                <div class="popup-counter"></div>
                <span class="popup-close">&times;</span>
            </div>
            <div class="popup-slider"></div>
            <button class="popup-prev">&#10094;</button>
            <button class="popup-next">&#10095;</button>
        </div>
    </div>

    <div class="modal fade" id="replyModal" tabindex="-1" aria-labelledby="replyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pt-0">
                <div class="p-3 pt-0">
                    <div class="d-flex gap-3">
                        <img src="" class="rounded aspect-square object-fit-cover" width="80" alt="Service Image">
                        <div class="w-0 flex-grow-1">
                            <div class="mb-2">
                                <span>{{translate('Booking ID #')}}</span> <label class="booking_id"></label>
                            </div>
                            <h5 class="service_name"></h5>
                            <div class="mt-2">
                                <span class="variant_key"></span>
                            </div>
                        </div>
                    </div>
                    <div class="review_section mb-3 mt-3">
                        <h4 class="mb-2">{{translate('Review')}}</h4>
                        <div class="p-3 rounded bg--secondary">
                            <p class="review_content"></p>
                        </div>
                    </div>
                    <div class="reply_section">
                        <div>
                            <h4 class="mb-3">{{translate('Reply')}}</h4>
                            <div class="form-group">
                                <textarea id="reply_content" class="form-control" name="reply_content" rows="4"
                                            readonly disabled></textarea>
                                <input type="hidden" class="form-control" name="readable_id" value="">
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
    
    
    {{-- <script>
        $(document).ready(function () {
            var visibleCount = 3;
            $(".description-listing-wrap ul").each(function () {
                var $list = $(this);
                var $items = $list.find("li");
                var $button = $list.siblings(".see-all-listBtn");

                if ($items.length > visibleCount) {
                $items.slice(visibleCount).hide();
                $button.show();
                } else {
                $button.hide();
                }

                $button.on("click", function () {
                var isExpanded = $button.hasClass("expanded");

                if (isExpanded) {
                    $items.slice(visibleCount).slideUp();
                    $button.removeClass("expanded").text("See more");
                } else {
                    $items.slideDown();
                    $button.addClass("expanded").text("See less");
                }
                });
            });
        });

    </script> --}}

    <!--Custom Images Show slider-->
    <script>
        $('#replyModal').on('show.bs.modal', function (event) {
            const button = $(event.relatedTarget);
            const modal = $(this);
            const serviceImg = button.data('service_img');
            const serviceName = button.data('service_name');
            const bookingID = button.data('booking_id');
            const readableID = button.data('readable_id');
            const review = button.data('review');
            const reviewReply = button.data('review_reply');
            const variantKey = button.data('variant_key');
            const action = button.data('action');

            modal.find('.service_name').text(serviceName);
            modal.find('.variant_key').text(variantKey);
            modal.find('.booking_id').text(bookingID);
            modal.find('.review_content').text(review);
            modal.find('img').attr('src', serviceImg);

            modal.find('textarea[name=reply_content]').val(reviewReply);
            modal.find('input[name=readable_id]').val(readableID);
            modal.find('form').attr('action', action);
        });
        $(document).ready(function () {
            let currentIndex = 0;
            const $popup = $('#imagePopup');
            const $slider = $popup.find('.popup-slider');
            const $counter = $popup.find('.popup-counter');

            $('.custom-images-slidewrap .view-img-popup').click(function () {
                const $allImages = $('.custom-images-slidewrap .view-img-popup img');
                $slider.empty();

                $allImages.each(function (index) {
                    const src = $(this).attr('src');
                    const $img = $('<img>').attr('src', src);
                    if ($(this).parent().is($(event.currentTarget))) {
                        currentIndex = index;
                        $img.addClass('active');
                    }
                    $slider.append($img);
                });

                updateCounter();
                $popup.fadeIn();
            });

            $('.popup-close, .popup-overlay').click(function () {
                $popup.fadeOut();
            });

            $('.popup-prev').click(function () {
                navigate(-1);
            });

            $('.popup-next').click(function () {
                navigate(1);
            });

            function navigate(direction) {
                const $images = $slider.find('img');
                $images.eq(currentIndex).removeClass('active');
                currentIndex = (currentIndex + direction + $images.length) % $images.length;
                $images.eq(currentIndex).addClass('active');
                updateCounter();
            }

            function updateCounter() {
                const total = $slider.find('img').length;
                $counter.text('{{ translate('messages.image_counter') }}' + (currentIndex + 1) + ' {{ translate('messages.of') }} ' + total);
            }
        });
    </script>
@endpush
