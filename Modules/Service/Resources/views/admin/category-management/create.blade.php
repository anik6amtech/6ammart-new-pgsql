@extends('layouts.admin.app')

@section('title', translate('category_setup'))

@push('css_or_js')

@endpush

@section('content')

<div class="content container-fluid">
     <!-- Page Title -->
    <h2 class="h1 mb-sm-3 mb-2 text-capitalize d-flex align-items-center gap-2">
        {{ translate('category_setup') }}
    </h2>
    <div class="card mb-20">
        <div class="card-body p-20">
            <form action="{{route('admin.service.category.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row g-3 align-items-center">
                    <div class="col-lg-6">
                        <div class="d-flex flex-column gap-24px">
                            <div class="bg-light rounded p-3">
                                <ul class="nav nav-tabs nav--tabs mb-20 border-0">
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
                                        <label class="form-label">{{ translate('category_name') }} ({{ translate('Default') }}) <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name[]" required
                                            value="{{ old('name.0') }}" placeholder="{{ translate('category_name') }}" maxlength="255"
                                            data-preview-text="preview-title">
                                    </div>
                                    <input type="hidden" name="lang[]" value="default">
                                </div>
                                @foreach ($language as $key => $lang)
                                    <div class="d-none lang_form" id="{{ $lang }}-form">
                                        <div class="mb-20">
                                            <label class="form-label">{{ translate('category_name') }}   ({{ strtoupper($lang) }})</label>
                                            <input type="text" class="form-control" name="name[]"
                                                value="{{ old('name.'.$key) }}" placeholder="{{ translate('category_name') }}" maxlength="255"
                                                data-preview-text="preview-title">
                                        </div>
                                        <input type="hidden" name="lang[]" value="{{ $lang }}">
                                    </div>
                                @endforeach
                            </div>
                            <div class="d-flex flex-column gap-4">
                                <div class="form-group mb-0 select-couting position-relative">
                                    <label class="input-label" for="select-zones">{{translate('messages.Select Zone')}} <span class="text-danger">*</span></label>
                                    <select required name="zone_ids[]" id="select-zones"
                                        class="form-control js-select2-custom"
                                        multiple="multiple" data-placeholder="{{translate('messages.Select your preferable zone for this category')}}">
                                        <option value="all" {{ (old('zone_ids') && in_array('all', old('zone_ids'))) ? 'selected' : '' }}>{{translate('Select All')}}</option>
                                        @foreach($zones as $zone)
                                            <option value="{{$zone['id']}}" {{ (old('zone_ids') && in_array($zone['id'], old('zone_ids'))) ? 'selected' : '' }}>{{$zone->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="d-flex flex-column gap-4">
                            <div class="">
                                <div class="mb-xl-4 mb-3">
                                    <div class="text-center mb-xl-3 mb-2">
                                        <h5 class="mb-1">{{ translate('Image') }} <span class="text-danger">*</span></h5>
                                        <span class="fz-12px">{{ translate('JPG, JPEG, PNG Less Than 1MB') }} <strong>(Ratio 1:1)</strong></span>
                                    </div>
                                    <div class="global-image-upload ratio-1 border-dashed rounded-10 bg-light position-relative max-w-100 overflow-hidden border-dashed mx-auto h-130 d-center">
                                        <input type="file" accept="image/*" name="image" required style="position: absolute; width: 100%; height: 100%; opacity: 0; cursor: pointer;">
                                        <div class="global-upload-box">
                                            <div class="upload-content text-center">
                                                <img src="{{asset('Modules/Service/public/assets/img/admin/do-upload.png')}}" alt="upload-your-image" class="mb-2">
                                                <div class="d-flex flex-column align-items-center gap-1 justify-content-center">
                                                    <span class="fz-12px text-theme d-block">{{ translate('Click to upload') }}</span> <span class="fz-12px text-title d-block">{{ translate('or drag and drop') }}</span>
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
                    <button type="reset" class="btn btn--reset">{{ translate('Reset') }}</button>
                    <button type="submit" class="btn btn--primary call-demo">{{ translate('Submit') }}</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Nav -->
    <div class="js-nav-scroller hs-nav-scroller-horizontal mb-20">
        <ul class="nav nav-tabs align-items-start border-0 gap-20px nav--tabs tabs__style-border" id="myTab"
            role="tablist">
            <li class="nav-item">
                <a class="nav-link {{$status=='all'?'active':''}}"
                    href="{{url()->current()}}?status=all">
                    {{translate('all')}}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{$status=='active'?'active':''}}"
                    href="{{url()->current()}}?status=active">
                    {{translate('active')}}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{$status=='inactive'?'active':''}}"
                    href="{{url()->current()}}?status=inactive">
                    {{translate('inactive')}}
                </a>
            </li>
        </ul>
    </div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="card">
                <div class="data-table-top border-bottom d-flex align-items-center flex-wrap gap-3 justify-content-between p-3">
                    <h4 class="text-title mb-0">{{ translate('Category List') }}</h4>
                    <div class="d-flex flex-wrap align-items-center gap-3">
                        <form action="{{url()->current()}}?status={{$status}}" method="GET">
                            <div class="input-group input-group-custom input-group-merge">
                                <input id="datatableSearch_" type="search" name="search" class="form-control"
                                    placeholder="Search by name" aria-label="Search by ID or name" value="{{ request()->search }}" required="">
                                <button type="submit" class="btn btn--primary input-group-text"><i
                                        class="tio-search fz-15px"></i></button>
                            </div>
                        </form>
                        <div class="hs-unfold mr-2">
                            <a class="js-hs-unfold-invoker btn btn-sm btn-white dropdown-toggle h--45px border" href="javascript:;" data-hs-unfold-options="{
                                    &quot;target&quot;: &quot;#usersExportDropdown&quot;,
                                    &quot;type&quot;: &quot;css-animation&quot;
                                }" data-hs-unfold-target="#usersExportDropdown" data-hs-unfold-invoker="">
                                <i class="tio-download-to mr-1"></i> {{ translate('Export') }}
                            </a>

                            <div id="usersExportDropdown" class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right hs-unfold-content-initialized hs-unfold-css-animation animated hs-unfold-hidden" data-hs-target-height="131.516" data-hs-unfold-content="" data-hs-unfold-content-animation-in="slideInUp" data-hs-unfold-content-animation-out="fadeOut" style="animation-duration: 300ms;">
                                <span class="dropdown-header"> {{ translate('Download Options') }} </span>
                                <a id="export-excel" class="dropdown-item" href="{{route('admin.service.category.download')}}?search={{$search}}&status={{$status}}">
                                    <img class="avatar avatar-xss avatar-4by3 mr-2" src="{{ asset('public/assets/admin/svg/components/excel.svg') }}" alt="Image Description">
                                    {{ translate('Excel') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="">
                    @include('service::admin.category-management.partials._table')
                </div>
                @if(count($categories) !== 0)
                    <hr>
                @endif
                <div class="page-area">
                    {!! $categories->links() !!}
                </div>
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
        $(document).ready(function() {
            $('#select-zones').on('change', function () {
                var selectedValues = $(this).val();
                if (selectedValues !== null && selectedValues.includes('all')) {
                    $(this).find('option').not(':disabled').prop('selected', 'selected');
                    $(this).find('option[value="all"]').prop('selected', false);
                }
            });
            $('button[type="reset"]').on('click', function () {
                $('#select-zones option').prop('selected', false).trigger('change');
            });
        });
    </script>
@endpush
