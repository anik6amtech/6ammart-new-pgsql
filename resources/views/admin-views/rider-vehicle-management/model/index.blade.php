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
                    {{ translate('messages.Attribute_Setup') }}
                </span>
            </h1>
        </div>

        @include('admin-views.rider-vehicle-management.partials._attribute_header')

         <form action="{{ route('admin.users.delivery-man.vehicle.model.store') }}"
                            enctype="multipart/form-data" , method="POST">
            @csrf
            <div class="card mb-4">
                {{-- <div class="card-header">
                    <div>
                        <h5 class="text-title mb-1">
                            {{ translate('messages.add_new_model') }}
                        </h5>
                        <p class="fs-12 mb-0">
                            {{ translate('messages.the_current_level_setup_automatically_assigns_drivers_the_default_level_upon_their_initial_app_login') }}
                        </p>
                    </div>
                </div> --}}
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-lg-6">
                            <div class="__bg-F8F9FC-card">
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
                                    {{-- Default name --}}
                                    <div class="mb-20 position-relative">
                                        <label class="form-label">{{ translate('name') }} ({{ translate('Default') }}) <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control char-count-input"
                                               name="name[]"
                                               value="{{ old('title.0') }}"
                                               placeholder="{{ translate('name') }}"
                                               maxlength="150"
                                               required
                                               data-preview-text="preview-title">

                                        <small class="text-muted d-flex justify-content-end">
                                            <span class="char-counter">{{ strlen(old('title.0') ?? '') }}</span>/150
                                        </small>
                                    </div>

                                    {{-- Default description --}}
                                    <div class="form-floating mb-20 position-relative">
                                        <label class="form-label">{{ translate('short_description') }} ({{ translate('Default') }}) <span class="text-danger">*</span></label>
                                        <textarea class="form-control resize-none char-count-input"
                                                  name="short_desc[]"
                                                  placeholder="{{ translate('short_description') }}"
                                                  maxlength="350"
                                                  required
                                                  data-preview-text="preview-description">{{ old('description.0') }}</textarea>

                                        <small class="text-muted d-flex justify-content-end">
                                            <span class="char-counter">{{ strlen(old('description.0') ?? '') }}</span>/350
                                        </small>
                                    </div>

                                    <input type="hidden" name="lang[]" value="default">
                                </div>

                                {{-- Other languages --}}
                                @foreach ($language as $key => $lang)
                                    <div class="d-none lang_form" id="{{ $lang }}-form">
                                        {{-- Name --}}
                                        <div class="mb-20 position-relative">
                                            <label class="form-label">{{ translate('name') }} ({{ strtoupper($lang) }})</label>
                                            <input type="text" class="form-control char-count-input"
                                                   name="name[]"
                                                   value="{{ old('title.'.($key+1)) }}"
                                                   placeholder="{{ translate('name') }}"
                                                   maxlength="150"
                                                   data-preview-text="preview-title">

                                            <small class="text-muted d-flex justify-content-end">
                                                <span class="char-counter">{{ strlen(old('title.'.($key+1)) ?? '') }}</span>/150
                                            </small>
                                        </div>

                                        {{-- Description --}}
                                        <div class="form-floating mb-20 position-relative">
                                            <label class="form-label">{{ translate('short_description') }} ({{ strtoupper($lang) }})</label>
                                            <textarea class="form-control resize-none char-count-input"
                                                      name="short_desc[]"
                                                      placeholder="{{ translate('short_description') }}"
                                                      maxlength="350"
                                                      data-preview-text="preview-description">{{ old('description.'.($key+1)) }}</textarea>

                                            <small class="text-muted d-flex justify-content-end">
                                                <span class="char-counter">{{ strlen(old('description.'.($key+1)) ?? '') }}</span>/350
                                            </small>
                                        </div>

                                        <input type="hidden" name="lang[]" value="{{ $lang }}">
                                    </div>
                                @endforeach


                            </div>
                            <div class="mt-3 mb-4 text-capitalize">
                               <label for="brand_select"
                                       class="mb-2 form-label">{{ translate('brand_name') }}</label>
                               <select name="brand_id" id="brand_select"
                                       class="js-data-example-ajax form-control"
                                       data-placeholder='{{ translate('select_brand') }}'
                                       required>

                               </select>
                           </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="text-center d-flex flex-column justify-content-center align-items-center gap-20px">
                                <div>
                                    <label class="text--title fs-16 font-semibold mb-1">
                                        {{ translate('Model_Image') }} <span class="text-danger">*</span>
                                    </label>
                                </div>
                                <div class="h-100 d-flex align-items-center flex-column">
                                    <label class="text-center my-auto position-relative d-inline-block">
                                        <img class="img--176 border" id="viewer"
                                            src="{{asset('public/assets/admin/img/upload-img.png')}}"
                                            alt="image"/>
                                        <div class="icon-file-group">
                                            <div class="icon-file">
                                                <input type="file" name="model_image" id="customFileEg1" class="custom-file-input read-url"
                                                    accept=".webp, .jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" >
                                                    <i class="tio-edit"></i>
                                            </div>
                                        </div>
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

        <div class="d-flex flex-wrap justify-content-between align-items-center my-3 gap-3">
            <ul class="nav nav--tabs p-1 rounded bg-white" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{!request()->has('status') || request()->get('status')=='all'?'active':''}}"
                        href="{{url()->current()}}?status=all">
                        {{ translate('all') }}
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{request()->get('status')=='active'?'active':''}}"
                        href="{{url()->current()}}?status=active">
                        {{ translate('active') }}
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{request()->get('status')=='inactive'?'active':''}}"
                        href="{{url()->current()}}?status=inactive">
                        {{ translate('inactive') }}
                    </a>
                </li>
            </ul>
            <div class="d-flex align-items-center gap-2">
                <span class="text-muted text-capitalize">{{ translate('total_models') }} : </span>
                <span class="text-primary fs-16 fw-bold"
                        id="total_record_count">{{ $models->total() }}</span>
            </div>
        </div>

        <div class="card">
            <div class="card-header py-2">
                <div class="search--button-wrapper justify-content-between gap-20px">
                    <h5 class="card-title text--title flex-grow-1">
                        {{ translate('messages.model_list') }}
                    </h5>

                    <form class="search-form m-0 flex-grow-1 max-w-353px">

                        <div class="input-group input--group">
                            <input id="datatableSearch_" type="search" value="{{ request()?->search ?? null }}" name="search"
                                class="form-control"
                                placeholder="{{ translate('messages.search_here_by_Model_Name') }}"
                                aria-label="{{ translate('messages.search_here_by_Model_Name') }}">
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
                            <a id="export-csv" class="dropdown-item"
                                href="{{route('admin.users.delivery-man.vehicle.model.export')}}?status={{request()->get('status') ?? 'all'}}&file=excel">
                                <img class="avatar avatar-xss avatar-4by3 mr-2"
                                    src="{{ asset('public/assets/admin') }}/svg/components/excel.svg"
                                    alt="Image Description">
                                .{{ translate('messages.excel') }}
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
                            <th>{{ translate('SL') }}</th>
                            <th class="text-capitalize name">{{ translate('model_name') }}</th>
                            <th class="text-capitalize name">{{ translate('brand_name') }}</th>
                            <th class="text-capitalize total-vehicle">{{ translate('total_vehicle') }}</th>
                            <th class="status">{{ translate('status') }}</th>
                            <th class="text-center action">{{ translate('action') }}</th>
                        </tr>
                    </thead>

                    <tbody id="set-rows">
                        @forelse ($models as $key => $model)
                            <tr id="hide-row-{{$model->id}}" class="record-row">
                                <td>{{ $models->firstItem() +$key }}</td>
                                <td class="name">{{ $model->name }}</td>
                                <td class="name">{{ $model->brand->name }}</td>
                                <td class="total-vehicle">{{ $model->vehicles->count() ?? 0 }}</td>
                                <td>
                                    <div class="d-flex">
                                        <label class="toggle-switch toggle-switch-sm" for="statusCheckbox{{$model->id}}">
                                            <input type="checkbox"
                                            data-id="statusCheckbox{{$model->id}}"
                                            data-type="status"
                                            data-image-on="{{ asset('/public/assets/admin/img/modal/basic_campaign_on.png') }}"
                                            data-image-off="{{ asset('/public/assets/admin/img/modal/basic_campaign_off.png') }}"
                                            data-title-on="{{ translate('By_Turning_ON_model!') }}"
                                            data-title-off="{{ translate('By_Turning_OFF_model!') }}"
                                            data-text-on="<p>{{ translate('If_you_turn_on_this_status,_it_will_show_on_user_app.') }}</p>"
                                            data-text-off="<p>{{ translate('If_you_turn_off_this_status,_it_won’t_show_on_user_app') }}</p>"
                                            class="toggle-switch-input  dynamic-checkbox" id="statusCheckbox{{$model->id}}" {{$model->is_active?'checked':''}}>
                                            <span class="toggle-switch-label">
                                                <span class="toggle-switch-indicator"></span>
                                            </span>
                                        </label>
                                        <form action="{{route('admin.users.delivery-man.vehicle.model.status',['id' => $model->id, 'status' => $model->is_active?0:1])}}"
                                        method="get" id="statusCheckbox{{$model->id}}_form">
                                            <input type="hidden" name="status" value="{{$model->is_active?0:1}}">
                                            <input type="hidden" name="id" value="{{$model->id}}">
                                        </form>
                                    </div>
                                </td>
                                <td>
                                    <div class="btn--container justify-content-center">
                                        <a class="btn action-btn btn--primary btn-outline-primary"
                                            href="{{route('admin.users.delivery-man.vehicle.model.edit', ['id'=>$model->id])}}" title="{{translate('messages.edit_model')}}"><i class="tio-edit"></i>
                                        </a>
                                        <a class="btn action-btn btn--danger btn-outline-danger form-alert" href="javascript:"
                                        data-id="model-{{$model['id']}}" data-message="{{ translate('Want to delete this model') }}" title="{{translate('messages.delete_model')}}"><i class="tio-delete-outlined"></i>
                                        </a>
                                        <form action="{{ route('admin.users.delivery-man.vehicle.model.delete', ['id'=>$model->id]) }}" method="post" id="model-{{$model['id']}}">
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

@push('script_2')
    {{-- <script src="{{ asset('public/assets/admin-module/js/single-image-upload.js') }}"></script> --}}
    <script>
        "use strict";

        $('#brand_select').select2({
            ajax: {
                url: '{{ route('admin.users.delivery-man.vehicle.brand.all-brands') }}',
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

        $("#customFileEg1").change(function() {
            readURL(this);
            $('#viewer').show(1000)
        });
        $('#reset_btn').click(function(){
            $('#exampleFormControlSelect1').val(null).trigger('change');
                $('#viewer').attr('src', "{{asset('public/assets/admin/img/upload-img.png')}}");
        })

        $(document).on('keyup', '.char-count-input', function () {
            let max = $(this).attr('maxlength') ?? 255;
            let count = $(this).val().length;
            $(this).closest('.position-relative').find('.char-counter').text(count);
        });

    </script>
@endpush
