@extends('service::provider.layouts.app')

@section('title',$provider->company_name."'s ".translate('messages.serviceman_list'))

@push('css_or_js')
    <!-- Custom styles for this page -->
    <link href="{{asset('public/assets/admin/css/croppie.css')}}" rel="stylesheet">
    <link href="{{asset('Modules/Rental/public/assets/css/admin/provider-overview.css')}}" rel="stylesheet">
@endpush

@section('content')
    <div class="content container-fluid">

        <div class="card">
            <div
                class="data-table-top border-bottom d-flex align-items-center flex-wrap gap-3 justify-content-between p-3">
                <h4 class="text-title mb-0">{{ translate('messages.all_servicemen_list') }}</h4>
                <div class="d-flex flex-wrap align-items-center gap-3">
                    <form action="{{ request()->url() }}" method="GET">
                        <input type="hidden" name="tab" value="serviceman_list">
                        <div class="input-group input-group-custom input-group-merge">
                            <input id="datatableSearch_" type="search" name="searchq" class="form-control"
                                placeholder="{{ translate('messages.search_by_name') }}" aria-label="{{ translate('messages.search_by_name') }}" value="{{ request()->get('searchq') }}">
                            <button type="submit" class="btn btn--primary input-group-text"><i
                                    class="tio-search fz-15px"></i></button>
                        </div>
                    </form>
                    <div class="hs-unfold mr-2">
                        <a class="js-hs-unfold-invoker btn btn-sm btn-white dropdown-toggle h--45px border"
                            href="javascript:;" data-hs-unfold-options="{
                                    &quot;target&quot;: &quot;#usersExportDropdown&quot;,
                                    &quot;type&quot;: &quot;css-animation&quot;
                                }" data-hs-unfold-target="#usersExportDropdown" data-hs-unfold-invoker="">
                            <i class="tio-download-to mr-1"></i> {{ translate('messages.export') }}
                        </a>

                        <div id="usersExportDropdown"
                            class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right hs-unfold-content-initialized hs-unfold-css-animation animated hs-unfold-hidden"
                            data-hs-target-height="131.516" data-hs-unfold-content=""
                            data-hs-unfold-content-animation-in="slideInUp"
                            data-hs-unfold-content-animation-out="fadeOut" style="animation-duration: 300ms;">
                            <span class="dropdown-header">{{ translate('messages.download_options') }}</span>
                            <a id="export-excel" class="dropdown-item" href="{{route('provider.service.serviceman.download', request()->query())}}">
                                <img class="avatar avatar-xss avatar-4by3 mr-2"
                                    src="{{asset('public/assets/admin/svg/components/excel.svg')}}"
                                    alt="{{ translate('messages.excel') }}">
                                {{ translate('messages.excel') }}
                            </a>
                        </div>
                    </div>
                    <a href="{{ route('provider.service.serviceman.create') }}" class="btn btn--primary">
                        <i class="tio-add"></i> {{ translate('messages.add_serviceman') }}
                    </a>
                </div>
            </div>
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table m-0 align-middle table-custom-space tr-hover">
                        <thead class="text-nowrap bg-light">
                            <tr>
                                <th class="fz--14px text-title border-0">{{ translate('messages.sl') }}</th>
                                <th class="fz--14px text-title border-0">{{ translate('messages.serviceman_info') }}</th>
                                <th class="fz--14px text-title border-0">{{ translate('messages.contact_info') }}</th>
                                <th class="fz--14px text-title border-0">{{ translate('messages.total_bookings') }}</th>
                                <th class="fz--14px text-title border-0">{{ translate('messages.status') }}</th>
                                <th class="fz--14px text-title border-0 text-end">{{ translate('messages.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($servicemen as $key => $serviceman)
                                <tr>
                                    <td class="text-title">{{ $key+$servicemen->firstItem() }}</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="d-block">
                                                <img width="50" height="50"
                                                    src="{{ $serviceman->profile_image_full_path }}"
                                                    alt="{{ $serviceman->first_name }}" class="rounded-circle">
                                            </div>
                                            <div class="__body">
                                                <a href="{{ route('provider.service.serviceman.details', ['id' => $serviceman->id]) }}" class="text-title text-decoration-none">
                                                    <h5 class="d-flex mb-0 font-medium align-items-center">
                                                        {{ $serviceman->first_name }} {{ $serviceman->last_name }}
                                                    </h5>
                                                </a>
{{--                                                <div class="d-flex align-items-center gap-2">--}}
{{--                                                    <div class="rating">--}}
{{--                                                        @for($i = 1; $i <= 5; $i++)--}}
{{--                                                            @if($i <= floor($serviceman->avg_rating))--}}
{{--                                                                <i class="tio-star text-warning"></i>--}}
{{--                                                            @else--}}
{{--                                                                <i class="tio-star-outlined text-warning"></i>--}}
{{--                                                            @endif--}}
{{--                                                        @endfor--}}
{{--                                                    </div>--}}
{{--                                                    <span class="text-muted">({{ number_format($serviceman->avg_rating, 1) }})</span>--}}
{{--                                                </div>--}}
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column gap-0">
                                            <span class="fz-12px text-title d-block">{{ $serviceman->phone }}</span>
                                            <span class="fz-12px text-title d-block">{{ $serviceman->email }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="text-title">
                                            {{ $serviceman->total_booking ?? 0 }}
                                        </a>
                                    </td>
                                    <td>
                                        <label class="toggle-switch toggle-switch-sm" for="statusToggle{{ $serviceman->id }}">
                                            <input type="checkbox"
                                                data-url="{{ route('provider.service.serviceman.status_update', ['id' => $serviceman->id, 'status' => $serviceman->is_active ? 0 : 1]) }}"
                                                class="toggle-switch-input redirect-url"
                                                id="statusToggle{{ $serviceman->id }}"
                                                {{ $serviceman->is_active ? 'checked' : '' }}>
                                            <span class="toggle-switch-label">
                                                <span class="toggle-switch-indicator"></span>
                                            </span>
                                        </label>
                                    </td>
                                    <td>
                                        <div class="table-actions justify-content-end d-flex gap-2">
                                            <a href="{{ route('provider.service.serviceman.details', ['id' => $serviceman->id]) }}"
                                                class="btn action-btn btn--primary btn-outline-primary"
                                                style="--size: 30px"
                                                title="{{ translate('messages.view') }}">
                                                <i class="tio-visible"></i>
                                            </a>
                                            <a href="{{ route('provider.service.serviceman.edit', ['id' => $serviceman->id]) }}"
                                                class="action-btn btn--info btn-outline-info"
                                                style="--size: 30px"
                                                title="{{ translate('messages.edit') }}">
                                                <i class="tio-edit"></i>
                                            </a>
                                            <a class="btn action-btn btn--danger btn-outline-danger form-alert" href="javascript:"
                                                data-id="vendor-{{$serviceman['id']}}" data-message="{{translate('You want to remove this serviceman')}}" title="{{translate('messages.delete_provider')}}"><i class="tio-delete-outlined"></i>
                                            </a>
                                            <form action="{{ route('provider.service.serviceman.delete', ['id' => $serviceman->id]) }}" method="post" id="vendor-{{$serviceman['id']}}">
                                                @csrf @method('delete')
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">
                                        <div class="d-flex flex-column justify-content-center align-items-center gap-2 py-3">
                                            <img src="{{ asset('public/assets/admin/svg/illustrations/sorry.svg') }}"
                                                alt="{{ translate('messages.no_data_found') }}" width="80">
                                            <p class="text-muted">{{ translate('messages.no_servicemen_found') }}</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if(count($servicemen) !== 0)
                <hr>
            @endif
            <div class="page-area">
                {!! $servicemen->withQueryString()->links() !!}
            </div>
            {{-- @if(count($servicemen) === 0)
            <div class="empty--data">
                <img src="{{asset('/public/assets/admin/svg/illustrations/sorry.svg')}}" alt="public">
                <h5>
                    {{translate('no_data_found')}}
                </h5>
            </div>
            @endif --}}
        </div>
    </div>

@endsection

@push('script_2')
    <!-- Page level plugins -->
    <script src="https://maps.googleapis.com/maps/api/js?key={{\App\Models\BusinessSetting::where('key', 'map_api_key')->first()->value}}&callback=initMap&v=3.45.8"></script>
    <script src="{{asset('Modules/Rental/public/assets/js/admin/view-pages/provider-overview.js')}}"></script>

@endpush
