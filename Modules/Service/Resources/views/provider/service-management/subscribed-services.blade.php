@extends('service::provider.layouts.app')

@section('title', translate('messages.available_services'))

@push('css_or_js')

@endpush

@section('content')
<div class="offCanvasoverlay" id="overlayPayment"></div>
    <div class="content container-fluid">
        <!-- Page Header -->
        <h2 class="h1 mb-20 text-capitalize d-flex align-items-center gap-2">
            <img width="24" height="24" src="{{asset('Modules/Service/public/assets/img/admin/subscription-badge.png')}}" alt="{{ translate('messages.services') }}"> {{translate('messages.My Subscriptions')}}
        </h2>

         <!-- Nav -->
        <div class="js-nav-scroller hs-nav-scroller-horizontal">
            <ul class="nav nav-tabs align-items-start border-0 gap-20px nav--tabs tabs__style-border mb-20">
                <li class="nav-item" role="presentation">
                    <a class="nav-link py-2 {{ !in_array(request()->status, ['subscribed', 'unsubscribed']) ? 'active' : '' }}" href="{{ route('provider.service.service.subscribed') }}" id="home-tab-details1">{{ translate('messages.all') }}</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link py-2 {{ request()->status == 'subscribed' ? 'active' : '' }}" href="{{ route('provider.service.service.subscribed', ['status' => 'subscribed']) }}" id="profile-tab-details2">{{ translate('messages.subscribed_sub_categories') }}</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link py-2 {{ request()->status == 'unsubscribed' ? 'active' : '' }}" href="{{ route('provider.service.service.subscribed', ['status' => 'unsubscribed']) }}" id="profile-tab-details3">{{ translate('messages.unsubscribed_sub_categories') }}</a>
                </li>
            </ul>
        </div>
        <div class="tab-content" id="myTabContent">
            <!-- All -->
            <div class="tab-pane fade show active" id="home-details1" role="tabpanel" aria-labelledby="home-tab-details1">
                <div class="card overflow-visible">
                    <div
                        class="data-table-top border-bottom d-flex align-items-center flex-wrap gap-3 justify-content-between p-3">
                        <h4 class="text-title mb-0">{{ translate('messages.subcategory_list') }}</h4>
                        <div class="d-flex flex-wrap align-items-center gap-3">
                            <form action="" method="GET">
                                <div class="input-group input-group-custom input-group-merge">
                                    <input id="datatableSearch_" type="search" name="searchq" class="form-control" value="{{ request()->searchq ?? '' }}"
                                        placeholder="{{ translate('messages.search_by_sub_category_name') }}" aria-label="{{ translate('messages.search_by_id_or_name') }}" required="">
                                    <button type="submit" class="btn btn--primary input-group-text"><i
                                            class="tio-search fz-15px"></i></button>
                                </div>
                            </form>
                            {{-- <div class="hs-unfold mr-2">
                                <a class="js-hs-unfold-invoker btn btn-sm btn-white dropdown-toggle h--45px border" href="javascript:;" data-hs-unfold-options="{
                                        &quot;target&quot;: &quot;#usersExportDropdown&quot;,
                                        &quot;type&quot;: &quot;css-animation&quot;
                                    }" data-hs-unfold-target="#usersExportDropdown" data-hs-unfold-invoker="">
                                    <i class="tio-download-to mr-1"></i> {{ translate('messages.export') }}
                                </a>

                                <div id="usersExportDropdown" class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right hs-unfold-content-initialized hs-unfold-css-animation animated hs-unfold-hidden" data-hs-target-height="131.516" data-hs-unfold-content="" data-hs-unfold-content-animation-in="slideInUp" data-hs-unfold-content-animation-out="fadeOut" style="animation-duration: 300ms;">
                                    <span class="dropdown-header">{{ translate('messages.download_options') }}</span>
                                    <a id="export-excel" class="dropdown-item" href="javascript:;">
                                        <img class="avatar avatar-xss avatar-4by3 mr-2" src="{{asset('/public/assets/admin/svg/components/excel.svg')}}" alt="{{ translate('messages.excel_icon') }}">
                                        {{ translate('messages.excel') }}
                                    </a>
                                    <a id="export-csv" class="dropdown-item" href="javascript:;">
                                        <img class="avatar avatar-xss avatar-4by3 mr-2" src="{{asset('/public/assets/admin/svg/components/placeholder-csv-format.svg')}}" alt="{{ translate('messages.csv_icon') }}">
                                        {{ translate('messages.csv') }}
                                    </a>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="">
                        <div class="table-responsive">
                            <table id="example" class="table m-0 align-middle table-custom-space tr-hover">
                                <thead class="text-nowrap bg-light">
                                    <tr>
                                        <th class="fz--14px text-title border-0">{{ translate('messages.sl') }}</th>
                                        <th class="fz--14px text-title border-0">{{ translate('messages.subcategory') }}</th>
                                        <th class="fz--14px text-title border-0">{{ translate('messages.category') }}</th>
                                        <th class="fz--14px text-title border-0">{{ translate('messages.services') }}</th>
                                        <th class="fz--14px text-title border-0 text-center">{{ translate('messages.subscribe_unsubscribe') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subCategories as $key => $subCategory)
                                        <tr>
                                            <td class="text-title">{{ $key + 1 }}</td>
                                            <td class="text-title">
                                                {{ $subCategory->name }}
                                            </td>
                                            <td>
                                                <div class="text-title">{{ $subCategory->parent->name ?? translate('messages.n_a') }}</div>
                                            </td>
                                            <td class="position-relative">
                                                <div class="btn-group service-hover position-relative">
                                                    <button type="button" class="border-0 bg-transparent offcanvas-toggle" data-toggle="offcanvas" data-target="#available-services-{{ $subCategory->id }}">
                                                        {{ $subCategory->services->count() }} {{ translate('messages.services') }}
                                                    </button>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <form action="{{ route('provider.service.service.update-subscription') }}" method="POST" id="subscribe-{{ $subCategory->id }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="sub_category_id" value="{{ $subCategory->id }}">
                                                    @if(in_array($subCategory->id, $subscribedCategoryIds))
                                                        <button type="button" class="btn btn--danger px-xxl-4 px-2 form-alert" data-id="subscribe-{{ $subCategory->id }}" data-message="{{translate('messages.you_want_to_unsubscribe_this_category')}}" title="{{translate('messages.unsubscribe_category')}}">{{ translate('messages.unsubscribe') }}</button>
                                                    @else
                                                        <button type="button" class="btn btn--primary px-xxl-4 px-2 form-alert" data-id="subscribe-{{ $subCategory->id }}" data-message="{{translate('messages.you_want_to_subscribe_this_category')}}" title="{{translate('messages.subscribe_category')}}">{{ translate('messages.subscribe') }}</button>
                                                    @endif
                                                </form>
                                            </td>

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
                                                            <img width="80" height="80" class="rounded-pill border" src="{{ $subCategory->image_full_path }}" alt="{{ translate('messages.subcategory_image') }}">
                                                            <div>
                                                                <h2 class="mb-1">{{ $subCategory->name }}</h2>
                                                                <p class="mb-0 fz--14px">{{ $subCategory->services_count }} {{ translate('messages.services_available') }}</p>
                                                            </div>
                                                    </div>
                                                    <div class="d-flex flex-column gap-20px">
                                                        @foreach($subCategory->services as $service)
                                                        <a href="{{ route('provider.service.service.service-details', $service->id) }}" class="d-flex align-items-center gap-3">
                                                            <img width="80" height="80" class="rounded" src="{{ $service->thumbnail_full_path }}" alt="{{ translate('messages.service_image') }}">
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
                                                        @if(in_array($subCategory->id, $subscribedCategoryIds))
                                                        <button type="button" class="btn w-100 btn--danger px-4 font-semibold form-alert" data-id="subscribe-{{ $subCategory->id }}" data-message="{{translate('messages.you_want_to_unsubscribe_this_category')}}" title="{{translate('messages.unsubscribe_category')}}">{{ translate('messages.unsubscribe_from_this_category') }}</button>
                                                        @else
                                                        <button type="button" class="btn w-100 btn--primary px-4 font-semibold form-alert" data-id="subscribe-{{ $subCategory->id }}" data-message="{{translate('messages.you_want_to_subscribe_this_category')}}" title="{{translate('messages.subscribe_category')}}">{{ translate('messages.subscribe_to_this_category') }}</button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if(count($subCategories) === 0)
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

    </div>


@endsection

@push('script_2')

    <script>

    </script>
@endpush
