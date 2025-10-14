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

         <form action="{{ route('admin.users.delivery-man.vehicle.brand.store') }}"
                              enctype="multipart/form-data" method="POST">
            @csrf
            <div class="card mb-4">
                {{-- <div class="card-header">
                    <div>
                        <h5 class="text-title mb-1">
                            {{ translate('messages.add_new_brand') }}
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
                                    <div class="mb-20 position-relative">
                                        <label class="form-label">
                                            {{ translate('brand_name') }} ({{ translate('Default') }}) <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control char-count-input"
                                               name="brand_name[]"
                                               value="{{ old('title.0') }}"
                                               placeholder="{{ translate('brand_name') }}"
                                               maxlength="150"
                                               data-preview-text="preview-title"
                                               required>

                                        {{-- counter --}}
                                        <small class="text-muted d-flex justify-content-end">
                                            <span class="char-counter">{{ strlen(old('title.0') ?? '') }}</span>/150
                                        </small>
                                    </div>

                                    <div class="form-floating mb-20 position-relative">
                                        <label class="form-label">
                                            {{ translate('short_description') }} ({{ translate('Default') }}) <span class="text-danger">*</span>
                                        </label>
                                        <textarea class="form-control resize-none char-count-input"
                                                  required
                                                  placeholder="{{ translate('short_description') }}"
                                                  name="short_desc[]"
                                                  maxlength="350"
                                                  data-preview-text="preview-description">{{ old('description.0') }}</textarea>

                                        {{-- counter --}}
                                        <small class="text-muted d-flex justify-content-end">
                                            <span class="char-counter">{{ strlen(old('description.0') ?? '') }}</span>/350
                                        </small>
                                    </div>

                                    <input type="hidden" name="lang[]" value="default">
                                </div>

                                @foreach ($language as $key => $lang)
                                    <div class="d-none lang_form" id="{{ $lang }}-form">
                                        <div class="mb-20 position-relative">
                                            <label class="form-label">
                                                {{ translate('brand_name') }} ({{ strtoupper($lang) }})
                                            </label>
                                            <input type="text" class="form-control char-count-input"
                                                   name="brand_name[]"
                                                   value="{{ old('title.'.$key+1) }}"
                                                   placeholder="{{ translate('brand_name') }}"
                                                   maxlength="150"
                                                   data-preview-text="preview-title">

                                            {{-- counter --}}
                                            <small class="text-muted d-flex justify-content-end">
                                                <span class="char-counter">{{ strlen(old('title.'.$key+1) ?? '') }}</span>/150
                                            </small>
                                        </div>

                                        <div class="form-floating mb-20 position-relative">
                                            <label class="form-label">
                                                {{ translate('short_description') }} ({{ strtoupper($lang) }})
                                            </label>
                                            <textarea class="form-control resize-none char-count-input"
                                                      placeholder="{{ translate('short_description') }}"
                                                      name="short_desc[]"
                                                      maxlength="350"
                                                      data-preview-text="preview-description">{{ old('description.'.$key+1) }}</textarea>

                                            {{-- counter --}}
                                            <small class="text-muted d-flex justify-content-end">
                                                <span class="char-counter">{{ strlen(old('description.'.$key+1) ?? '') }}</span>/350
                                            </small>
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
                                        {{ translate('Brand_Logo') }} <span class="text-danger">*</span>
                                    </label>
                                </div>
                                <div class="h-100 d-flex align-items-center flex-column">
                                    <label class="text-center my-auto position-relative d-inline-block">
                                        <img class="img--176 border" id="viewer"
                                            src="{{asset('public/assets/admin/img/upload-img.png')}}"
                                            alt="image"/>
                                        <div class="icon-file-group">
                                            <div class="icon-file">
                                                <input type="file" name="brand_logo" id="customFileEg1" class="custom-file-input read-url"
                                                    accept=".webp, .jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
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


        <div class="card">
            <div class="card-header py-2">
                <div class="search--button-wrapper justify-content-between gap-20px">
                    <div class="flex-grow-1 d-flex flex-column gap-2">
                        <h5 class="card-title text--title mb-0">
                            {{ translate('messages.Brand_list') }}
                            <span class="text-primary fs-16 fw-bold" id="total_record_count"> : {{ $brands->total() }}</span>
                        </h5>
                        <!-- Nav (moved under Brand list title) -->
                        <div class="js-nav-scroller hs-nav-scroller-horizontal ml-2">
                            <ul class="nav nav-tabs align-items-start border-0 gap-20px nav--tabs tabs__style-border" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link {{ (isset($status) && $status=='all') ? 'active' : '' }}" href="{{ url()->current() }}?status=all">{{ translate('all') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ (isset($status) && $status=='active') ? 'active' : '' }}" href="{{ url()->current() }}?status=active">{{ translate('active') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ (isset($status) && $status=='inactive') ? 'active' : '' }}" href="{{ url()->current() }}?status=inactive">{{ translate('inactive') }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <form class="search-form m-0 flex-grow-1 max-w-353px" action="{{ url()->current() }}?status={{ $status ?? 'all' }}" method="GET">

                        <div class="input-group input--group">
                            <input id="datatableSearch_" type="search" value="{{ request()?->search ?? null }}" name="search"
                                class="form-control"
                                placeholder="{{ translate('messages.Search by brand name, description...') }}"
                                aria-label="{{ translate('messages.Search by brand name, description...') }}">
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
                                href="{{ route('admin.users.delivery-man.vehicle.brand.export', ['file' => 'excel', request()->getQueryString()]) }}">
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
                            <th class="border-0">{{ translate('messages.Brand_info') }}</th>
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
                                    <div class="text--title text-hover-primary font-semibold line--limit-1 max--200">
                                        <img class="rounded" width="50" height="50" src="{{ $brand?->image_full_url }}" alt="{{ $brand->name }}">
                                        {{ $brand->name }}
                                    </div>
                                </td>
                                <td>
                                    <div class="font-medium text-center">
                                        {{ $brand->vehicles?->count() ?? 0 }}
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
{{--                                            data-text-on="<p>{{ translate('If_you_turn_on_this_status,_it_will_show_on_user_app.') }}</p>"--}}
                                            data-text-on="<p> </p>"
{{--                                            data-text-off="<p>{{ translate('If you disable this brand, it won’t appear in the user app.') }}</p>"--}}
                                            data-text-off="<p></p>"
                                            class="toggle-switch-input  dynamic-checkbox" id="statusCheckbox{{$brand->id}}" {{$brand->is_active?'checked':''}}>
                                            <span class="toggle-switch-label">
                                                <span class="toggle-switch-indicator"></span>
                                            </span>
                                        </label>
                                        <form action="{{route('admin.users.delivery-man.vehicle.brand.status',['id' => $brand->id, 'status' => $brand->is_active?0:1])}}"
                                        method="get" id="statusCheckbox{{$brand->id}}_form">
                                            <input type="hidden" name="status" value="{{$brand->is_active?0:1}}">
                                            <input type="hidden" name="id" value="{{$brand->id}}">
                                        </form>
                                    </div>
                                </td>
                                <td>
                                    <div class="btn--container justify-content-center">
                                        <a class="btn action-btn btn--primary btn-outline-primary"
                                            href="{{route('admin.users.delivery-man.vehicle.brand.edit', ['id'=>$brand->id])}}" title="{{translate('messages.edit_brand')}}"><i class="tio-edit"></i>
                                        </a>
                                        <a class="btn action-btn btn--danger btn-outline-danger form-alert" href="javascript:"
                                        data-id="brand-{{$brand['id']}}" data-message="{{ translate('Want to delete this brand') }}" title="{{translate('messages.delete_brand')}}"><i class="tio-delete-outlined"></i>
                                        </a>
                                        <form action="{{ route('admin.users.delivery-man.vehicle.brand.delete', ['id'=>$brand->id]) }}" method="post" id="brand-{{$brand['id']}}">
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
    <script>
        "use strict";
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
