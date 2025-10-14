@extends('layouts.admin.app')

@section('title', translate('messages.banner'))

@push('css_or_js')
@endpush

@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <h1 class="page-header-title">
                <span class="page-header-icon">
                    <img src="{{ asset('public/assets/admin/img/banner.png') }}" class="w--26" alt="">
                </span>
                <span>
                    {{ translate('messages.Banners') }}
                </span>
            </h1>
        </div>

        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <h5 class="text-title mb-1">
                                {{ translate('messages.Add_New_Banner') }}
                            </h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.ride-share.promotion.banner-setup.store') }}" method="post" id="banner_form" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-4">
                                <div class="col-lg-6">
                                   <div class="__bg-FAFAFA p-4 radius-10 mb-3">
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
                                                <label class="form-label">{{ translate('title') }} ({{ translate('Default') }}) <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="title[]"
                                                    value="{{ old('title.0') }}" placeholder="{{ translate('title') }}" maxlength="255"
                                                    data-preview-text="preview-title" required>
                                            </div>
                                            <input type="hidden" name="lang[]" value="default">
                                        </div>

                                        @foreach ($language as $key => $lang)
                                            <div class="d-none lang_form" id="{{ $lang }}-form">
                                                <div class="mb-20">
                                                    <label class="form-label">{{ translate('title') }}   ({{ strtoupper($lang) }})</label>
                                                    <input type="text" class="form-control" name="title[]"
                                                        value="{{ old('title.'.($key + 1)) }}" placeholder="{{ translate('title') }}" maxlength="255"
                                                        data-preview-text="preview-title">
                                                </div>
                                                <input type="hidden" name="lang[]" value="{{ $lang }}">
                                            </div>
                                        @endforeach
									</div>

                                    <div class="form-group mb-0">
                                        <label class="input-label font-semibold"
                                            for="">{{ translate('messages.Redirect_Link') }} <span class="text-danger">*</span></label>
                                        <input type="url" name="redirect_link" class="form-control" placeholder="Insert link" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="h-100 d-flex flex-column justify-content-between gap-20px">
                                        <div>
                                            <label class="fs-16 text-title font-semibold  mb-0">{{ translate('messages.Banner_Image') }} <span class="text-danger">*</span></label>
                                            <p class="mb-0">{{ translate('JPG, JPEG, PNG Less Than 1MB') }} <span
                                                    class="font-weight-bold">({{ translate('Ratio 3:1') }})</span>
                                            </p>
                                        </div>

                                        <div class="upload-file image-general flex-grow-1">
                                            <a href="javascript:void(0);" class="remove-btn opacity-0 z-index-99">
                                                <i class="tio-clear"></i>
                                            </a>
                                            <input type="file" name="banner_image" class="upload-file__input single_file_input" accept=".webp, .jpg, .jpeg, .png"
                                                required>
                                            <label class="upload-file-wrapper fullwidth h-100">
                                                <div class="upload-file-textbox text-center">
                                                    <img width="40" height="40" src="{{ asset('public/assets/admin/img/document-upload.svg') }}" alt="">
                                                    <h6 class="mt-2 font-semibold text-center d-flex d-sm-block flex-column gap-1">
                                                        <span>{{ translate('Click_to_upload') }}</span>
                                                        <span class="text--title text-lowercase"> {{ translate('or_drag_and_drop') }}</span>
                                                    </h6>
                                                </div>
                                                <img class="upload-file-img d-none" loading="lazy" alt="">
                                            </label>
                                        </div>
                                    </div>
                                </div>
								<div class="col-lg-6">
									<div class="form-group mb-0">
                                        <label class="input-label font-semibold"
                                            for="time_period">{{ translate('messages.Time_Period') }} <span class="text-danger">*</span></label>
                                        <select name="time_period" id="time_period" class="custom-select js-select2-custom" required>
                                            <option value="all_time" selected>{{ translate('messages.Show_Always') }}</option>
                                            <option value="period">{{ translate('messages.Specific_Time_Period') }}</option>
                                        </select>
                                    </div>
								</div>
								<div class="col-lg-3 time_period_details d-none">
									<div class="form-group mb-0">
                                        <label class="input-label font-semibold"
                                            for="">{{ translate('messages.Start_Date') }} <span class="text-danger">*</span></label>
										<!-- <div class="position-relative">
{{--											<i class="fi fi-sr-calendar fs-16 icon-absolute-on-right"></i>--}}
											<input type="date" class="form-control h-45 position-relative bg-transparent" name="start_date" value="" placeholder="{{ translate('messages.Select_Start_Date') }}">
										</div> -->

                                        <!-- Date Range Picker -->
                                        <div class="position-relative">
                                            <span class="tio-calendar icon-absolute-on-right"></span>
                                            <input type="text" readonly name="start_date" value="" class="single-reangepicker form-control bg-white">
                                        </div>
                                        <!-- Date Range Picker -->
                                    </div>
								</div>
								<div class="col-lg-3 time_period_details d-none">
									<div class="form-group mb-0">
                                        <label class="input-label font-semibold"
                                            for="">{{ translate('messages.End_Date') }} <span class="text-danger">*</span></label>
										<!-- <div class="position-relative">
{{--											<i class="fi fi-sr-calendar fs-16 icon-absolute-on-right"></i>--}}
											<input type="date" class="form-control h-45 position-relative bg-transparent" name="end_date" value="" placeholder="{{ translate('messages.Select_End_Date') }}">
										</div> -->

                                        <!-- Date Range Picker -->
                                        <div class="position-relative">
                                            <span class="tio-calendar icon-absolute-on-right"></span>
                                            <input type="text" readonly name="end_date" value="" class="single-reangepicker form-control bg-white">
                                        </div>
                                        <!-- Date Range Picker -->
                                    </div>
								</div>
								<div class="col-12">
									<div class="btn--container justify-content-end">
										<button type="reset" id="reset_btn" class="btn btn--reset">{{ translate('messages.reset') }}</button>
										<button type="submit" class="btn btn--primary">{{ translate('messages.submit') }}</button>
									</div>
								</div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <div class="card">
                    <div class="card-header py-2">
                        <div class="search--button-wrapper gap-20px">
                            <h5 class="card-title text--title flex-grow-1">{{ translate('messages.total_banners') }}</h5>

                            <form class="search-form m-0 flex-grow-1 max-w-353px">

                                <div class="input-group input--group">
                                    <input id="datatableSearch_" type="search" value="{{ request()?->search ?? null }}"
                                        name="search" class="form-control"
                                        placeholder="{{ translate('messages.Search by banner title...') }}"
                                        aria-label="{{ translate('messages.Search by banner title...') }}">
                                    <button type="submit" class="btn btn--secondary bg--primary"><i
                                            class="tio-search"></i></button>

                                </div>

                            </form>
                            @if (request()->get('search'))
                                <button type="reset" class="btn btn--primary ml-2 location-reload-to-base"
                                    data-url="{{ url()->full() }}">{{ translate('messages.reset') }}</button>
                            @endif

                            {{-- <div class="hs-unfold m-0">
                                <a class="js-hs-unfold-invoker btn btn-sm btn-white dropdown-toggle min-height-40 font-semibold text--title"
                                    href="javascript:;"
                                    data-hs-unfold-options='{
                                    "target": "#usersExportDropdown",
                                    "type": "css-animation"
                                }'>
                                    <i class="tio-download-to mr-1"></i> {{ translate('messages.export') }}
                                </a>

                                <div id="usersExportDropdown"
                                    class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right">
                                    <span class="dropdown-header">{{ translate('messages.download_options') }}</span>
                                    <a id="export-excel" class="dropdown-item"
                                        href="{{ route('admin.ride-share.promotion.banner-setup.export', ['type' => 'excel', request()->getQueryString()]) }}">
                                        <img class="avatar avatar-xss avatar-4by3 mr-2"
                                            src="{{ asset('public/assets/admin') }}/svg/components/excel.svg"
                                            alt="Image Description">
                                        {{ translate('messages.excel') }}
                                    </a>
                                </div>
                            </div> --}}

                        </div>
                    </div>

                    <div class="table-responsive datatable-custom">
                        <table id="columnSearchDatatable"
                            class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table text--title">
                            <thead class="thead-light">
                                <tr>
                                    <th class="border-0">{{ translate('messages.SL') }}</th>
                                    <th class="border-0">{{ translate('messages.Image') }}</th>
                                    <th class="border-0">{{ translate('messages.Banner_Info') }}</th>
                                    <th class="border-0">{{ translate('messages.Redirect_Link') }}</th>
                                    <th class="border-0">{{ translate('messages.no_of_total_redirection') }}</th>
                                    <th class="border-0">{{ translate('messages.Time_Period') }}</th>
                                    <th class="border-0 text-center">{{ translate('messages.featured') }}</th>
                                     <th class="border-0 text-center">{{ translate('messages.status') }}</th>
                                    <th class="border-0 text-center">{{ translate('messages.action') }}</th>
                                </tr>
                            </thead>

                            <tbody id="set-rows">
                                @forelse($banners as $key=>$banner)
                                    <tr>
                                        <td>{{ $banners->firstItem() +$key }}</td>
                                        <td>
                                            <img class="img--ratio-3 w-auto h--50px rounded mr-2 onerror-image" src="{{ $banner->image_full_url }}"
                                                    data-onerror-image="{{ $banner->image_full_url }}" alt="Banner image">
                                        </td>
                                        <td>
                                            <h5 title="" class="text--title font-medium mb-0">{{ $banner->title }} </h5>
                                        </td>
                                        <td>
                                            <a href="#" class="text--title text-hover-primary">{{ $banner->default_link }}</a>
                                        </td>
                                        <td>{{ round($banner->total_redirection) }}</td>
                                        <td>
                                            <div class="text-wrap w-160px">
                                                @if($banner->time_period == 'all_time')
                                                    <span class="badge badge-soft-success">{{ translate('messages.Show_Always') }}</span>
                                                @else
                                                    {{ $banner->start_date ? \Carbon\Carbon::parse($banner->start_date)->format('d M Y') : '' }} -
                                                    {{ $banner->end_date ? \Carbon\Carbon::parse($banner->end_date)->format('d M Y') : '' }}
                                                @endif
                                            </div>
                                        </td>

                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <label class="toggle-switch toggle-switch-sm" for="featuredCheckbox{{$banner->id}}">
                                                    <input type="checkbox"
                                                    data-id="featuredCheckbox{{$banner->id}}"
                                                    data-type="status"
                                                    data-image-on="{{ asset('/public/assets/admin/img/modal/basic_campaign_on.png') }}"
                                                    data-image-off="{{ asset('/public/assets/admin/img/modal/basic_campaign_off.png') }}"
                                                    data-title-on="{{ translate('By_Turning_ON_As_Featured!') }}"
                                                    data-title-off="{{ translate('By_Turning_OFF_As_Featured!') }}"
                                                    data-text-on="<p>{{ translate('If_you_turn_on_this_featured,_then_promotional_banner_will_show_on_website_and_user_app_with_store_or_item.') }}</p>"
                                                    data-text-off="<p>{{ translate('If_you_turn_off_this_featured,_then_promotional_banner_won’t_show_on_website_and_user_app') }}</p>"
                                                    class="toggle-switch-input  dynamic-checkbox" id="featuredCheckbox{{$banner->id}}" {{$banner->featured?'checked':''}}>
                                                    <span class="toggle-switch-label">
                                                        <span class="toggle-switch-indicator"></span>
                                                    </span>
                                                </label>
                                                <form action="{{route('admin.ride-share.promotion.banner-setup.featured',['id' => $banner->id, 'featured' => $banner->featured?0:1])}}"
                                                method="get" id="featuredCheckbox{{$banner->id}}_form">
                                                    <input type="hidden" name="featured" value="{{$banner->featured?0:1}}">
                                                    <input type="hidden" name="id" value="{{$banner->id}}">
                                                </form>
                                        </td>

                                        <td>
                                             <div class="d-flex justify-content-center">
                                                <label class="toggle-switch toggle-switch-sm" for="statusCheckbox{{$banner->id}}">
                                                    <input type="checkbox"
                                                    data-id="statusCheckbox{{$banner->id}}"
                                                    data-type="status"
                                                    data-image-on="{{ asset('/public/assets/admin/img/modal/basic_campaign_on.png') }}"
                                                    data-image-off="{{ asset('/public/assets/admin/img/modal/basic_campaign_off.png') }}"
                                                    data-title-on="{{ translate('By_Turning_ON_Banner!') }}"
                                                    data-title-off="{{ translate('By_Turning_OFF_Banner!') }}"
                                                    data-text-on="<p>{{ translate('If_you_turn_on_this_status,_it_will_show_on_user_app.') }}</p>"
                                                    data-text-off="<p>{{ translate('If_you_turn_off_this_status,_it_won’t_show_on_user_app') }}</p>"
                                                    class="toggle-switch-input  dynamic-checkbox" id="statusCheckbox{{$banner->id}}" {{$banner->status?'checked':''}}>
                                                    <span class="toggle-switch-label">
                                                        <span class="toggle-switch-indicator"></span>
                                                    </span>
                                                </label>
                                                <form action="{{route('admin.ride-share.promotion.banner-setup.status',['id' => $banner->id, 'status' => $banner->status?0:1])}}"
                                                method="get" id="statusCheckbox{{$banner->id}}_form">
                                                    <input type="hidden" name="status" value="{{$banner->status?0:1}}">
                                                    <input type="hidden" name="id" value="{{$banner->id}}">
                                                </form>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="btn--container justify-content-center">
                                                <a class="btn action-btn btn-outline-edit" href="{{ route('admin.ride-share.promotion.banner-setup.edit', $banner->id) }}" title="{{translate('messages.edit_banner')}}"><i class="fi fi-sr-pencil"></i>
                                                </a>
                                                <a class="btn action-btn btn--danger btn-outline-danger form-alert" href="javascript:"
                                                    data-id="delete-{{ $banner->id }}" data-message="{{ translate('Want to delete this ?') }}">
                                                    <i class="fi fi-rr-trash"></i>
                                                </a>
                                                <form action="{{ route('admin.ride-share.promotion.banner-setup.delete', $banner->id) }}"
                                                                            id="delete-{{ $banner->id }}" method="post" >
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
                                                        {{translate('no_data_found')}}
                                                    </h5>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{-- @if(count($banners) !== 0)
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
                    @endif --}}
                </div>
            </div>

        </div>
    </div>
<input type="hidden" id="current_module_id" value="{{ Config::get('module.current_module_id') }}" >
@endsection

@push('script_2')
    <script src="{{ asset('public/assets/admin/js/view-pages/banner-index.js') }}"></script>
     <script src="{{ asset('public/assets/admin/js/ride-share/banner-list.js') }}"></script>

	<script>
        $(function() {

            $('.datepicker_input').daterangepicker({
				singleDatePicker: true,
				showDropdowns: false,
				autoUpdateInput: false,
				minDate: new Date()
			});
			$('.datepicker_input').on('apply.daterangepicker', function (ev, picker) {
				$(this).val(picker.startDate.format('M/D/YYYY'));
			});

            $("#time_period").on('change', function() {
                if ($(this).val() === 'period') {
                    $('.time_period_details').removeClass('d-none');
                    $('.datepicker_input').attr('required', true);
                } else {
                    $('.time_period_details').addClass('d-none');
                }
            });

            // single-reangepicker
            $('.single-reangepicker').each(function () {
                const $this = $(this);
                $this.daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true,
                    autoUpdateInput: true,
                    autoApply: true,
                    locale: {
                        format: 'MM/DD/YYYY'
                    }
                });
                $this.on('show.daterangepicker', function (ev, picker) {
                    picker.container.addClass('single-reangepicker__custom');
                    picker.container.find('.calendar.right').hide();
                });
            });
        });
    </script>
@endpush
