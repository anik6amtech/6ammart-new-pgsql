@extends('layouts.admin.app')

@section('title',$provider->company_name."'s ".translate('messages.subscribed_services'))

@push('css_or_js')
    <!-- Custom styles for this page -->
    <link href="{{asset('public/assets/admin/css/croppie.css')}}" rel="stylesheet">
    <link href="{{asset('Modules/Rental/public/assets/css/admin/provider-overview.css')}}" rel="stylesheet">
@endpush

@section('content')
    <div class="content container-fluid">

        @include('service::admin.provider-management.provider.detail.partials._header',['provider'=>$provider])

        {{-- <div class="card mb-20">
            <div class="card-body p-20">
                <h4 class="mb-20">{{translate('messages.Filter')}}</h4>
                <div class="row g-3 align-items-end justify-content-end">
                    <div class="col-sm-6 col-lg-4">
                        <span class="d-block mb-xxl-3 mb-2 fz--14px text-title">Select Category</span>
                        <select class="custom-select border shadow-0 py-0 w-100" name="">
                            <option value="all">
                                {{translate('All Categories')}}
                            </option>
                            <option value="1">
                                {{translate('messages.example text')}}
                            </option>
                            <option value="2">
                                {{translate('messages.example text')}}
                            </option>
                            <option value="3">
                                {{translate('messages.example text')}}
                            </option>
                        </select>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <span class="d-block mb-xxl-3 mb-2 fz--14px text-title">Select Subcategory</span>
                        <select class="custom-select border shadow-0 py-0 w-100" name="">
                            <option value="all">
                                {{translate('All Subcategories')}}
                            </option>
                            <option value="1">
                                {{translate('messages.example text')}}
                            </option>
                            <option value="2">
                                {{translate('messages.example text')}}
                            </option>
                            <option value="3">
                                {{translate('messages.example text')}}
                            </option>
                        </select>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="d-flex align-items-center gap-3 justify-content-end">
                            <button type="reset" class="btn min-w-120 btn--reset">Reset</button>
                            <button type="submit" class="btn min-w-120 btn--primary call-demo">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="card overflow-visible">
            <div
                class="data-table-top border-bottom d-flex align-items-center flex-wrap gap-3 justify-content-between p-3">
                <h4 class="text-title mb-0">{{ translate('messages.all_services') }}</h4>
                <div class="d-flex flex-wrap align-items-center gap-3">
                    <form action="{{ request()->url() }}" method="GET">
                        <input type="hidden" name="tab" value="subscribed_services">
                        <div class="input-group input-group-custom input-group-merge">
                            <input id="datatableSearch_" type="search" name="searchq" class="form-control"
                                placeholder="{{ translate('messages.search_by_name') }}" aria-label="{{ translate('messages.search_by_name') }}" value="{{ request('searchq') }}">
                            <button type="submit" class="btn btn--primary input-group-text"><i
                                    class="tio-search fz-15px"></i></button>
                        </div>
                    </form>
{{--                    <div class="dropdown">--}}
{{--                        <button type="button"--}}
{{--                            class="btn d-flex align-items-center gap-2 text-title font-medium fz-12px border rounded text-capitalize dropdown-toggle h--45px"--}}
{{--                            data-toggle="dropdown">--}}
{{--                            <i class="tio-download-to"></i>--}}
{{--                            {{ translate('messages.export') }}--}}
{{--                        </button>--}}
{{--                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">--}}
{{--                            <li>--}}
{{--                                <a class="dropdown-item" href="#0">{{ translate('messages.excel') }}</a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
                </div>
            </div>
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table m-0 align-middle table-custom-space tr-hover">
                        <thead class="text-nowrap bg-light">
                            <tr>
                                <th class="fz--14px text-title border-0">{{ translate('messages.sl') }}</th>
                                <th class="fz--14px text-title border-0">{{ translate('messages.subscribed_subcategory') }}</th>
                                <th class="fz--14px text-title border-0">{{ translate('messages.category') }}</th>
                                <th class="fz--14px text-title border-0">{{ translate('messages.services') }}</th>
                                <th class="fz--14px text-title border-0 text-center">{{ translate('messages.subscribe_unsubscribe') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($subCategories as $key => $subCategory)
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
                                            <button type="button" class="border-0 bg-transparent" data-toggle="dropdown"
                                                aria-expanded="false">
                                                {{ $subCategory->services->count() }} {{ translate('messages.services') }}
                                            </button>
                                            <div class="dropdown-menu p-0 service-hoverbox dropdown-menu-right position-absolute max-w-200px rounded-10 d-flex flex-column gap-2 p-xl-3 p-2"
                                                data-bg-color="#000000E5">
                                                @foreach ($subCategory->services as $service)
                                                    <a href="{{ route('admin.service.service.detail', $service->id) }}" class="dropdown-item p-0 d-flex align-items-center gap-2">
                                                        <img width="35" height="35"
                                                            src="{{ asset('public/assets/admin/img/admin.png') }}"
                                                            class="rounded" alt="">
                                                        <span class="text-white font-bold fz--14px">{{ $service->name }}</span>
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ route('admin.service.provider.update_subscription', $subCategory->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="subscribed" value="{{ $subCategory->is_subscribed ? 0 : 1 }}">
                                            <input type="hidden" name="provider_id" value="{{ $provider->id }}">
                                            <button type="submit" class="btn min-w-140 {{ in_array($subCategory->id, $subscribedCategoryIds) ? 'btn--danger' : 'btn--primary' }}">
                                                {{ in_array($subCategory->id, $subscribedCategoryIds) ? translate('messages.unsubscribe') : translate('messages.subscribe') }}
                                            </button>
                                        </form>
                                        {{-- <button type="button" class="btn min-w-140 btn--primary">
                                            Subscribe
                                        </button> --}}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">
                                        <div class="d-flex flex-column justify-content-center align-items-center gap-2 py-3">
                                            <img src="{{ asset('public/assets/admin/svg/illustrations/sorry.svg') }}"
                                                 alt="{{ translate('messages.no_data_found') }}" width="80">
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if(count($subCategories) !== 0)
                <hr>
            @endif
            {{-- <div class="page-area">
                {!! $subCategories->links() !!}
            </div> --}}
        </div>
    </div>

@endsection

@push('script_2')
    <!-- Page level plugins -->
    <script src="https://maps.googleapis.com/maps/api/js?key={{\App\Models\BusinessSetting::where('key', 'map_api_key')->first()->value}}&callback=initMap&v=3.45.8"></script>
    <script src="{{asset('Modules/Rental/public/assets/js/admin/view-pages/provider-overview.js')}}"></script>

@endpush
