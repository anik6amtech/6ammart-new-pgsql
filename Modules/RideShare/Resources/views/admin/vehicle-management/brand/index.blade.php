@section('title', 'Vehicle Attribute')

@extends('layouts.admin.app')

@push('css_or_js')
@endpush

@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <h1 class="page-header-title">
                <span class="page-header-icon">
                    <img src="{{ asset('Modules/RideShare/public/assets/img/ride-share/driver.png') }}" class="w--26" alt="">
                </span>
                <span>
                    {{ translate('messages.Add_New_Brand') }}
                </span>
            </h1>
        </div>

         <form action="{{ route('admin.ride-share.vehicle.attribute-setup.brand.store') }}"
                              enctype="multipart/form-data" method="POST">
            @csrf
            <div class="card mb-4">
                <div class="card-header">
                    <div>
                        <h5 class="text-title mb-1">
                            {{ translate('messages.add_new_brand') }}
                        </h5>
                        <p class="fs-12 mb-0">
                            {{ translate('messages.the_current_level_setup_automatically_assigns_drivers_the_default_level_upon_their_initial_app_login') }}
                        </p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-lg-6">
                            <div class="">
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
                                        <label class="form-label">{{ translate('brand_name') }} ({{ translate('Default') }})</label>
                                        <input type="text" class="form-control" name="brand_name[]"
                                            value="{{ old('title.0') }}" placeholder="{{ translate('brand_name') }}" maxlength="255"
                                            data-preview-text="preview-title">
                                    </div>
                                    <div class="form-floating mb-20">
                                        <label class="form-label">{{ translate('short_description') }} ({{ translate('Default') }})</label>
                                        <textarea class="form-control resize-none"
                                            placeholder="{{ translate('short_description') }}" name="short_desc[]"
                                            data-preview-text="preview-description">{{ old('description.0') }}</textarea>
                                    </div>

                                    <input type="hidden" name="lang[]" value="default">
                                </div>

                                @foreach ($language as $key => $lang)
                                    <div class="d-none lang_form" id="{{ $lang }}-form">
                                        <div class="mb-20">
                                            <label class="form-label">{{ translate('brand_name') }}   ({{ strtoupper($lang) }})</label>
                                            <input type="text" class="form-control" name="brand_name[]"
                                                value="{{ old('title.0') }}" placeholder="{{ translate('brand_name') }}" maxlength="255"
                                                data-preview-text="preview-title">
                                        </div>
                                        <div class="form-floating mb-20">
                                            <label class="form-label">{{ translate('short_description') }}   ({{ strtoupper($lang) }})</label>
                                            <textarea class="form-control resize-none"
                                                placeholder="{{ translate('short_description') }}" name="short_desc[]"
                                                data-preview-text="preview-description">{{ old('description.0') }}</textarea>
                                            </div>

                                        <input type="hidden" name="lang[]" value="{{ $lang }}">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="text-center d-flex flex-column justify-content-center align-items-center gap-20px">
                                <div>
                                    <label class="text--title fs-16 font-semibold mb-1">
                                        {{ translate('Brand_Logo') }}
                                    </label>
                                </div>
                                <div class="upload-file image-general d-inline-block w-auto">
                                    <a href="javascript:void(0);" class="remove-btn opacity-0 z-index-99">
                                        <i class="tio-clear"></i>
                                    </a>
                                    <input type="file" name="brand_logo" class="upload-file__input single_file_input"
                                        accept=".webp, .jpg, .jpeg, .png" value="" required>
                                    <label class="upload-file-wrapper aspect-1-1">
                                        <div class="upload-file-textbox text-center w-100">
                                            <img width="34" height="34"
                                                src="{{ asset('public/assets/admin/img/document-upload.svg') }}" alt="">
                                            <h6 class="mt-2 font-semibold text-center">
                                                <span>{{ translate('Click to upload') }}</span>
                                                <br>
                                                {{ translate('or drag and drop') }}
                                            </h6>
                                        </div>
                                        <img class="upload-file-img d-none" loading="lazy" src=""
                                            alt="">
                                    </label>
                                </div>
                                <div>
                                    <p class="fs-12">
                                        {{ translate('JPG, JPEG, PNG Less Than 1MB') }} <strong
                                            class="font-semibold">({{ translate('Ratio 1:1') }})</strong>
                                    </p>
                                </div>
                            </div>

                        </div>
                        <div class="col-12">
                            <div class="btn--container justify-content-end">
                                <button type="reset" id="reset_btn" class="btn btn--reset min-w-120px">{{ translate('messages.reset') }}</button>
                                <button type="submit" class="btn btn--primary min-w-120px">{{ translate('messages.submit') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="card">
            <div class="card-header py-2">
                <div class="search--button-wrapper justify-content-between gap-20px">
                    <h5 class="card-title text--title flex-grow-1">
                        {{ translate('messages.Total_Brands') }}
                        <span class="text-primary fs-16 fw-bold"
                                  id="total_record_count"> : {{ $brands->total() }}</span>
                    </h5>

                    <form class="search-form m-0 flex-grow-1 max-w-353px">

                        <div class="input-group input--group">
                            <input id="datatableSearch_" type="search" value="{{ request()?->search ?? null }}" name="search"
                                class="form-control"
                                placeholder="{{ translate('messages.Search by Vendor name, owner info...') }}"
                                aria-label="{{ translate('messages.Search by Vendor name, owner info...') }}">
                            <button type="submit" class="btn btn--secondary bg--primary"><i class="tio-search"></i></button>

                        </div>

                    </form>
                    @if (request()->get('search'))
                    <button type="reset" class="btn btn--primary ml-2 location-reload-to-base"
                        data-url="{{ url()->full() }}">{{ translate('messages.reset') }}</button>
                    @endif

                    <div class="hs-unfold m-0">
                        <a class="js-hs-unfold-invoker btn btn-sm btn-white dropdown-toggle min-height-40 font-semibold text--title"
                            href="javascript:;" data-hs-unfold-options='{
                                                            "target": "#usersExportDropdown",
                                                            "type": "css-animation"
                                                        }'>
                            <i class="tio-download-to mr-1"></i> {{ translate('messages.export') }}
                        </a>

                        <div id="usersExportDropdown"
                            class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right">

                            <span class="dropdown-header">{{ translate('messages.download_options') }}</span>
                            <a id="export-excel" class="dropdown-item"
                                href="{{ route('admin.ride-share.vehicle.attribute-setup.brand.export', ['file' => 'excel', request()->getQueryString()]) }}">
                                <img class="avatar avatar-xss avatar-4by3 mr-2"
                                    src="{{ asset('public/assets/admin') }}/svg/components/excel.svg" alt="Image Description">
                                {{ translate('messages.excel') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive datatable-custom">
                <table id="columnSearchDatatable"
                    class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table text--title">
                    <thead class="thead-light">
                        <tr>
                            <th class="border-0">{{ translate('messages.SL') }}</th>
                            <th class="border-0">{{ translate('messages.Brand_ID') }}</th>
                            <th class="border-0">{{ translate('messages.Brand_Name') }}</th>
                            <th class="border-0 text-center">{{ translate('messages.Total_Vehicle') }}</th>
                            <th class="border-0 text-center">{{ translate('messages.status') }}</th>
                            <th class="border-0 text-center">{{ translate('messages.action') }}</th>
                        </tr>
                    </thead>

                    <tbody id="set-rows">
                        @forelse ($brands as $key => $brand)
                            <tr id="hide-row-{{$brand->id}}" class="record-row">
                                <td>{{ $brands->firstItem() +$key }}</td>
                                <td>
                                    <div class="font-medium">
                                        #{{ $brand->id }}
                                    </div>
                                </td>
                                <td>
                                    <a href="" class="text--title text-hover-primary font-semibold line--limit-1 max--200">
                                        {{ $brand->name }}
                                    </a>
                                </td>
                                <td>
                                    <div class="font-medium text-center">
                                        {{ /* $brand->vehicles?->count() */ 0 }}
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <label class="toggle-switch toggle-switch-sm" for="statusCheckbox{{$brand->id}}">
                                            <input type="checkbox"
                                            data-id="statusCheckbox{{$brand->id}}"
                                            data-type="status"
                                            data-image-on="{{ asset('/public/assets/admin/img/modal/basic_campaign_on.png') }}"
                                            data-image-off="{{ asset('/public/assets/admin/img/modal/basic_campaign_off.png') }}"
                                            data-title-on="{{ translate('By_Turning_ON_Brand!') }}"
                                            data-title-off="{{ translate('By_Turning_OFF_Brand!') }}"
                                            data-text-on="<p>{{ translate('If_you_turn_on_this_status,_it_will_show_on_user_app.') }}</p>"
                                            data-text-off="<p>{{ translate('If_you_turn_off_this_status,_it_won’t_show_on_user_app') }}</p>"
                                            class="toggle-switch-input  dynamic-checkbox" id="statusCheckbox{{$brand->id}}" {{$brand->is_active?'checked':''}}>
                                            <span class="toggle-switch-label">
                                                <span class="toggle-switch-indicator"></span>
                                            </span>
                                        </label>
                                        <form action="{{route('admin.ride-share.vehicle.attribute-setup.brand.status',['id' => $brand->id, 'status' => $brand->is_active?0:1])}}"
                                        method="get" id="statusCheckbox{{$brand->id}}_form">
                                            <input type="hidden" name="status" value="{{$brand->is_active?0:1}}">
                                            <input type="hidden" name="id" value="{{$brand->id}}">
                                        </form>
                                    </div>
                                </td>
                                <td>
                                    <div class="btn--container justify-content-center">
                                        <a class="btn action-btn btn-outline-edit" href="{{route('admin.ride-share.vehicle.attribute-setup.brand.edit', ['id'=>$brand->id])}}"
                                            title="{{translate('messages.edit')}}"><i class="fi fi-sr-pencil"></i>
                                        </a>
                                        <a class="btn action-btn btn--danger btn-outline-danger form-alert" href="javascript:"
                                            data-id="delete-{{ $brand->id }}" data-message="{{ translate('Want to delete this ?') }}">
                                            <i class="fi fi-rr-trash"></i>
                                        </a>
                                        <form action="{{ route('admin.ride-share.vehicle.attribute-setup.brand.delete', ['id'=>$brand->id]) }}"
                                                                    id="delete-{{ $brand->id }}" method="post" >
                                            @csrf @method('delete')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="13">
                                    <div class="text-center p-4">
                                        <div class="empty--data">
                                            <img src="{{asset('/public/assets/admin/svg/illustrations/sorry.svg')}}" alt="public">
                                            <h5>
                                                {{translate('no_ride_found')}}
                                            </h5>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection

@push('script')
    <script>
        "use strict";
        $('.js-select-ajax').select2({
            ajax: {
                url: '{{ route('admin.ride-share.vehicle.attribute-setup.brand.all-brands') }}',
                data: function (params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function (data) {
                    //
                    return {
                        results: data
                    };
                },
                __port: function (params, success, failure) {
                    var $request = $.ajax(params);
                    $request.then(success);
                    $request.fail(failure);
                    return $request;
                }
            }
        });
    </script>
@endpush
