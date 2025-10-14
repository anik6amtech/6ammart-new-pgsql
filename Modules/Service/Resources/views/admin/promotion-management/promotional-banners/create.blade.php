@extends('layouts.admin.app')

@section('title', translate('Banner'))

@push('css_or_js')

@endpush

@section('content')

<div class="content container-fluid">
     <!-- Page Title -->
    <h2 class="h1 mb-sm-3 mb-2 text-capitalize d-flex align-items-center gap-2">
        {{ translate('messages.create_new_banner') }}
    </h2>
    <div class="card mb-20">
        <div class="card-body p-20">
            <form action="{{route('admin.service.banner.store')}}" method="POST"
                                      enctype="multipart/form-data"
                                      onSubmit="return validate();">
                                    @csrf
                <div class="row g-3">
                    <div class="col-lg-6">
                        <div class="d-flex flex-column gap-24px">
                            <div class="bg-light rounded p-3">
                                <ul class="nav nav-tabs mb-3 border-0">
                                    <li class="nav-item">
                                        <a class="nav-link lang_link active"
                                        href="#"
                                        id="default-link">{{translate('messages.default')}}</a>
                                    </li>

                                    @foreach ($language as $lang)
                                        <li class="nav-item">
                                            <a class="nav-link lang_link"
                                                href="#"
                                                id="{{ $lang }}-link">{{ \App\CentralLogics\Helpers::get_language_name($lang) . '(' . strtoupper($lang) . ')' }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="lang_form" id="default-form">
                                    <div class="mb-20">
                                        <label class="form-label">{{ translate('banner_title') }} ({{ translate('Default') }})</label>
                                        <input type="text" class="form-control" name="banner_title[]"
                                            value="{{ old('banner_title.0') }}" placeholder="{{ translate('type_banner_title') }}" maxlength="255"
                                            data-preview-text="preview-title">
                                    </div>
                                    <input type="hidden" name="lang[]" value="default">
                                </div>
                                @foreach ($language as $key => $lang)
                                    <div class="d-none lang_form" id="{{ $lang }}-form">
                                        <div class="mb-20">
                                            <label class="form-label">{{ translate('banner_title') }}   ({{ strtoupper($lang) }})</label>
                                            <input type="text" class="form-control" name="banner_title[]"
                                                value="{{ old('banner_title.'.$key) }}" placeholder="{{ translate('type_banner_title') }}" maxlength="255"
                                                data-preview-text="preview-title">
                                        </div>
                                        <input type="hidden" name="lang[]" value="{{ $lang }}">
                                    </div>
                                @endforeach
                            </div>
                            <div class="d-flex flex-column gap-4">
                                <div>
                                    <span class="fz--14px d-block text-title mb-2 d-flex align-items-center gap-1">
                                        {{ translate('resource_type') }} <span class="text-danger">*</span>
                                    </span>
                                    <div class="form-group mb-0 d-flex flex-wrap px-2 custom-select-wrap border rounded align-items-center gap-4">
                                        <label class="form-check form--check">
                                            <input class="form-check-input" type="radio" value="category" name="resource_type" id="category" checked>
                                            <span class="form-check-label">
                                                {{translate('category_wise')}}
                                            </span>
                                        </label>
                                        <label class="form-check form--check">
                                            <input class="form-check-input" type="radio" value="service" name="resource_type" id="service">
                                            <span class="form-check-label">
                                                {{translate('service_wise')}}
                                            </span>
                                        </label>
                                        <label class="form-check form--check">
                                            <input class="form-check-input" type="radio" value="redirect_link" name="resource_type" id="redirect_link">
                                            <span class="form-check-label">
                                                {{translate('redirect_link')}}
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group mb-0" id="category_selector">
                                    <label class="form-label text-capitalize" for="serviceWise">
                                        {{ translate('messages.Service Category') }}
                                    </label>
                                    <select id="category_id" name="category_id" class="form-control  js-select2-custom">
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-0" id="service_selector">
                                    <label class="form-label text-capitalize" for="serviceWise">
                                        {{ translate('messages.Service') }}
                                    </label>
                                    <select id="service_id" name="service_id" class="form-control  js-select2-custom">
                                       @foreach($services as $service)
                                            <option value="{{$service->id}}">{{$service->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-0 link_selector" id="link_selector">
                                    <label class="form-label text-capitalize" for="serviceWise">
                                        {{ translate('messages.redirect_link') }}
                                    </label>
                                    <input type="url" class="form-control"
                                            placeholder="{{translate('redirect_link')}}"
                                            name="redirect_link">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="d-flex flex-column gap-4">
                            <div class="">
                                <div class="mb-xl-4 mb-3">
                                    <div class="text-center mb-xl-3 mb-2">
                                        <h5 class="mb-1">{{ translate('messages.banner_image') }}</h5>
                                        <span class="fz-12px">{{ translate('messages.JPG,_JPEG,_PNG,_GIF_Less_Than_1MB') }} <strong>(Ratio 3:1)</strong></span>
                                    </div>
                                    <div class="global-image-upload ratio-4-1 border-dashed rounded-10 bg-light position-relative max-w-100 overflow-hidden border-dashed mx-auto h-130 d-center">
                                        <input type="file" name="banner_image" accept="image/*" required style="position: absolute; width: 100%; height: 100%; opacity: 0; cursor: pointer;">
                                        <div class="global-upload-box">
                                            <div class="upload-content text-center">
                                                <img src="{{asset('/Modules/Service/public/assets/img/admin/do-upload.png')}}" alt="upload-your-image" class="mb-2">
                                                <div class="d-flex align-items-center gap-1 justify-content-center">
                                                    <span class="fz-12px text-theme d-block">{{ translate('messages.click_to_upload') }}</span> <span class="fz-12px text-title d-block">{{ translate('messages.or_drag_and_drop') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <img class="global-image-preview d-none" src="" alt="Preview" style="max-height: 100%; max-width: 100%;" />
                                        <div class="overlay-icons d-none">
                                            <button type="button" class="btn btn--info p-2 action-btn view-icon" title="View" data-toggle="modal" data-target="#imageShowingMOdal">
                                                <i class="tio-invisible"></i>
                                            </button>
                                            <button type="button" class="btn btn--info p-2 action-btn edit-icon" title="Edit">
                                                <i class="tio-edit"></i>
                                            </button>
                                        </div>
                                        <div class="image-file-name d-none mt-2 text-center text-muted" style="font-size: 12px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="btn--container justify-content-end mt-3">
                    <button type="reset" class="btn btn--reset">{{ translate('messages.reset') }}</button>
                    <button type="submit" class="btn btn--primary call-demo">{{ translate('messages.submit') }}</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Nav -->
    <div class="js-nav-scroller hs-nav-scroller-horizontal mb-20">
        <ul class="nav nav-tabs align-items-start border-0 gap-20px nav--tabs tabs__style-border" id="myTab"
            role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link {{$resourceType=='all'?'active':''}}" href="{{url()->current()}}?resource_type=all">{{ translate('messages.all') }}</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link {{$resourceType=='category'?'active':''}}" href="{{url()->current()}}?resource_type=category">{{ translate('messages.category_wise') }}</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link {{$resourceType=='service'?'active':''}}" href="{{url()->current()}}?resource_type=service">{{ translate('messages.service_wise') }}</a>
            </li>
        </ul>
    </div>
    <div class="tab-content" id="myTabContent">

     <div class="mb-3 mb-lg-2">
                <div class="card">
                    <div class="card-header py-2 border-0">
                        <div class="search--button-wrapper">
                            <h5 class="card-title">
                                {{translate('messages.banner_list')}}<span class="badge badge-soft-dark ml-2" id="itemCount">{{$banners->count()}}</span>
                            </h5>
                            <form  class="search-form">
                                <!-- Search -->
                                <div class="input-group input--group">
                                    <input id="datatableSearch" type="search" value="{{ request()->get('search')?? '' }}" name="search" class="form-control" placeholder="{{translate('messages.search_by_title')}}" aria-label="{{translate('messages.search_here')}}">
                                    <button type="submit" class="btn btn--secondary"><i class="tio-search"></i></button>
                                </div>
                                <!-- End Search -->
                            </form>
                            @if(request()->get('search'))
                            <button type="reset" class="btn btn--primary ml-2 location-reload-to-base" data-url="{{url()->full()}}">{{translate('messages.reset')}}</button>
                            @endif

                            <div class="hs-unfold mr-2">
                                <a class="js-hs-unfold-invoker btn btn-sm btn-white dropdown-toggle h--45px border" href="javascript:;" data-hs-unfold-options="{
                                        &quot;target&quot;: &quot;#usersExportDropdown&quot;,
                                        &quot;type&quot;: &quot;css-animation&quot;
                                    }" data-hs-unfold-target="#usersExportDropdown" data-hs-unfold-invoker="">
                                    <i class="tio-download-to mr-1"></i> {{ translate('export') }}
                                </a>

                                <div id="usersExportDropdown" class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right hs-unfold-content-initialized hs-unfold-css-animation animated hs-unfold-hidden" data-hs-target-height="131.516" data-hs-unfold-content="" data-hs-unfold-content-animation-in="slideInUp" data-hs-unfold-content-animation-out="fadeOut" style="animation-duration: 300ms;">
                                    <span class="dropdown-header">{{ translate('download_options') }}</span>
                                    <a id="export-excel" class="dropdown-item" href="{{route('admin.service.banner.download')}}?search={{$search}}">
                                        <img class="avatar avatar-xss avatar-4by3 mr-2" src="{{ asset('public/assets/admin/svg/components/excel.svg') }}" alt="Image Description">
                                        {{ translate('excel') }}
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Table -->
                    <div class="table-responsive datatable-custom">
                        <table id="columnSearchDatatable"
                                class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                                data-hs-datatables-options='{
                                    "order": [],
                                    "orderCellsTop": true,
                                    "search": "#datatableSearch",
                                    "entries": "#datatableEntries",
                                    "isResponsive": false,
                                    "isShowPaging": false,
                                    "paging": false
                                }'
                                >
                            <thead class="thead-light">
                                <tr>
                                    <th class="border-0">{{ translate('messages.SL') }}</th>
                                    <th class="border-0">{{translate('messages.banner_title')}}</th>
                                    <th class="border-0">{{translate('messages.banner_type')}}</th>
                                    <th class="border-0 text-center">{{translate('messages.status')}}</th>
                                    <th class="border-0 text-center">{{translate('messages.action')}}</th>
                                </tr>
                            </thead>

                            <tbody id="set-rows">
                            @foreach($banners as $key=>$banner)
                                <tr>
                                    <td>{{$key+$banners->firstItem()}}</td>
                                    <td>
                                        <span class="media align-items-center">
                                            <img class="img--ratio-3 w-auto h--50px rounded mr-2 onerror-image" src="{{ $banner['image_full_url'] }}"
                                                data-onerror-image="{{asset('/public/assets/admin/img/900x400/img1.jpg')}}" alt="{{$banner->name}} image">
                                            <div class="media-body">
                                                <h5 title="{{ $banner['title'] }}" class="text-hover-primary mb-0">{{Str::limit($banner['title'], 25, '...')}}</h5>
                                            </div>
                                        </span>
                                    <span class="d-block font-size-sm text-body">

                                    </span>
                                    </td>
                                    <td>{{translate('messages.'.$banner['type'])}}</td>

                                  <td  >
                                        <div class="d-flex justify-content-center">
                                            <label class="toggle-switch toggle-switch-sm" for="statusCheckbox{{$banner->id}}">
                                            <input type="checkbox"
                                            data-id="statusCheckbox{{$banner->id}}"
                                            data-type="status"
                                            data-image-on="{{ asset('/public/assets/admin/img/modal/basic_campaign_on.png') }}"
                                            data-image-off="{{ asset('/public/assets/admin/img/modal/basic_campaign_off.png') }}"
                                            data-title-on="{{ translate('By_Turning_ON_Banner!') }}"
                                            data-title-off="{{ translate('By_Turning_OFF_Banner!') }}"
                                            data-text-on="<p>{{ translate('If_you_turn_on_this_status,_it_will_show_on_user_website_and_app.') }}</p>"
                                            data-text-off="<p>{{ translate('If_you_turn_off_this_status,_it_won’t_show_on_user_website_and_app') }}</p>"
                                            class="toggle-switch-input  dynamic-checkbox" id="statusCheckbox{{$banner->id}}" {{$banner->status?'checked':''}}>
                                            <span class="toggle-switch-label">
                                                <span class="toggle-switch-indicator"></span>
                                            </span>
                                        </label>
                                        </div>
                                    </td>


                                    <form action="{{route('admin.banner.status',[$banner['id'],$banner->status?0:1])}}"
                                        method="get" id="statusCheckbox{{$banner->id}}_form">
                                        </form>
                                    <td>
                                        <div class="btn--container justify-content-center">
                                            <a class="btn action-btn btn--primary btn-outline-primary" href="{{route('admin.service.banner.edit',[$banner['id']])}}" title="{{translate('messages.edit_banner')}}"><i class="tio-edit"></i>
                                            </a>
                                            <a class="btn action-btn btn--danger btn-outline-danger form-alert" href="javascript:" data-id="banner-{{$banner['id']}}" data-message="{{ translate('Want to delete this banner ?') }}"><i class="tio-delete-outlined"></i>
                                            </a>
                                            <form action="{{route('admin.service.banner.delete',[$banner['id']])}}"
                                                        method="post" id="banner-{{$banner['id']}}">
                                                    @csrf @method('delete')
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                    @if(count($banners) !== 0)
                    <hr>
                    @endif
                    <div class="page-area">
                        {!! $banners->links() !!}
                    </div>
                    @if(count($banners) === 0)
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


    <!--image showing-->
    <div class="modal fade custom-confirmation-modal" id="imageShowingMOdal" tabindex="-1" aria-labelledby="imageShowingMOdalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body py-3 px-sm-4 px-3">
                    <button type="button" class="btn-close image-show__close bg-light rounded-full" data-dismiss="modal" aria-label="Close">
                        <i class="tio-clear"></i>
                    </button>
                    <div class="image-display-container">
                        <!-- Push Inside any images -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('script_2')

 <script>
        "use Strict";



        $('.delete_section').on('click', function () {
            let itemId = $(this).data('id');
            form_alert('delete-' + itemId, '{{ translate('want_to_delete_this') }}');
        })

        $(document).ready(function () {
            $('.js-select').select2();
            $('#service_selector').hide();
            $('#link_selector').hide();
        });

        $('#category').on('click', function () {
            $('#category_selector').show();
            $('#service_selector').hide();
            $('#link_selector').hide();
        });

        $('#service').on('click', function () {
            $('#category_selector').hide();
            $('#service_selector').show();
            $('#link_selector').hide();
        });

        $('#redirect_link').on('click', function () {
            $('#category_selector').hide();
            $('#service_selector').hide();
            $('#link_selector').show();
        });

        $('.btn--reset').on('click', function () {
            $('#category_selector').show();
            $('#service_selector').hide();
            $('#link_selector').hide();
        });


    </script>

@endpush
