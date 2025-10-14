@extends('layouts.admin.app')

@section('title', translate('sub_category_setup'))

@push('css_or_js')

@endpush

@section('content')

<div class="content container-fluid">
     <!-- Page Title -->
    <h2 class="h1 mb-sm-3 mb-2 text-capitalize d-flex align-items-center gap-2">
        {{ translate('sub_category_setup') }}
    </h2>
    <div class="card mb-20">
        <div class="card-body p-20">
            <form action="{{route('admin.service.sub-category.store')}}" method="post" enctype="multipart/form-data">
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
                                        <label class="form-label">{{ translate('sub_category_name') }} ({{ translate('Default') }}) <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name[]" required
                                            value="{{ old('name.0') }}" placeholder="{{ translate('category_name') }}" maxlength="255"
                                            data-preview-text="preview-title">
                                    </div>
                                    <div class="mb-20">
                                        <label class="form-label">{{ translate('Description') }} ({{ translate('Default') }}) <span class="text-danger">*</span></label>
                                        <textarea name="short_description[]" rows="3" class="form-control" required placeholder="{{ translate('short_description') }}">{{ old('short_description.0') }}</textarea>
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
                                        <div class="mb-20">
                                            <label class="form-label">{{ translate('Description') }} ({{ strtoupper($lang) }})</label>
                                            <textarea name="short_description[]" rows="3" class="form-control" placeholder="{{ translate('short_description') }}">{{ old('short_description.'.$key) }}</textarea>
                                        </div>
                                        <input type="hidden" name="lang[]" value="{{ $lang }}">
                                    </div>
                                @endforeach
                            </div>
                            <div class="d-flex flex-column gap-4">
                                <div class="form-group mb-0 select-couting position-relative">
                                    <label class="input-label" for="category_selector">{{translate('messages.Select Category')}} <span class="text-danger">*</span></label>
                                    <select required name="parent_id" id="category_selector"
                                        class="form-control js-select2-custom"
                                        data-placeholder="{{translate('messages.Select your preferable category for this sub-category')}}">
                                        <option value="" selected
                                                            disabled>{{translate('Select_Category_Name')}}</option>
                                        @foreach($mainCategories as $item)
                                            <option value="{{$item['id']}}" {{ old('parent_id') == $item['id'] ? 'selected': '' }}>{{$item->name}}</option>
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
                    <h4 class="text-title mb-0">{{ translate('Sub Category List') }}</h4>
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
                                <a id="export-excel" class="dropdown-item" href="{{route('admin.service.sub-category.download')}}?search={{$search}}&status={{$status}}">
                                    <img class="avatar avatar-xss avatar-4by3 mr-2" src="{{ asset('public/assets/admin/svg/components/excel.svg') }}" alt="Image Description">
                                    {{ translate('Excel') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="table-responsive">
                        <table id="example" class="table m-0 align-middle table-custom-space tr-hover">
                            <thead class="text-nowrap bg-light">
                                <tr>
                                    <th class="fz--14px text-title border-0">{{ translate('SL') }}</th>
                                    <th class="fz--14px text-title border-0">{{ translate('Sub category Name') }}</th>
                                    <th class="fz--14px text-title border-0">{{ translate('Parent Category') }}</th>
                                    <th class="fz--14px text-title border-0">{{ translate('Service count') }}</th>
                                    <th class="fz--14px text-title border-0">{{ translate('Status') }}</th>
                                    <th class="fz--14px text-title border-0 text-end">{{ translate('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($subCategories as $key=>$category)
                                    <tr>
                                        <td class="text-title">{{ $key + 1 }}</td>
                                        <td class="text-title">
                                            {{ $category->name }}
                                        </td>
                                        <td class="text-title">{{ $category->parent->name ?? '-' }}</td>
                                        <td class="text-title">{{ $category->services_count }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <label class="toggle-switch toggle-switch-sm" for="statusCheckbox{{$category->id}}">
                                                    <input type="checkbox"
                                                    data-id="statusCheckbox{{$category->id}}"
                                                    data-type="status"
                                                    data-image-on="{{ asset('/public/assets/admin/img/modal/basic_campaign_on.png') }}"
                                                    data-image-off="{{ asset('/public/assets/admin/img/modal/basic_campaign_off.png') }}"
                                                    data-title-on="{{ translate('By_Turning_ON_category!') }}"
                                                    data-title-off="{{ translate('By_Turning_OFF_category!') }}"
                                                    data-text-on="<p>{{ translate('If_you_turn_on_this_status,_it_will_show_on_user_app.') }}</p>"
                                                    data-text-off="<p>{{ translate('If_you_turn_off_this_status,_it_won’t_show_on_user_app') }}</p>"
                                                    class="toggle-switch-input  dynamic-checkbox" id="statusCheckbox{{$category->id}}" {{$category->is_active?'checked':''}}>
                                                    <span class="toggle-switch-label">
                                                        <span class="toggle-switch-indicator"></span>
                                                    </span>
                                                </label>
                                                <form action="{{route('admin.service.sub-category.status-update',['id' => $category->id, 'status' => $category->is_active?0:1])}}"
                                                method="get" id="statusCheckbox{{$category->id}}_form">
                                                    <input type="hidden" name="status" value="{{$category->is_active?0:1}}">
                                                    <input type="hidden" name="id" value="{{$category->id}}">
                                                </form>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="btn--container justify-content-center">
                                                <a class="btn action-btn btn-outline-edit" href="{{route('admin.service.sub-category.edit', ['id'=>$category->id])}}"
                                                    title="{{translate('messages.edit')}}"><i class="fi fi-sr-pencil"></i>
                                                </a>
                                                <a class="btn action-btn btn--danger btn-outline-danger form-alert" href="javascript:"
                                                    data-id="delete-{{ $category->id }}" data-message="{{ translate('Want to delete this ?') }}">
                                                    <i class="fi fi-rr-trash"></i>
                                                </a>
                                                <form action="{{ route('admin.service.sub-category.delete', ['id'=>$category->id]) }}"
                                                                            id="delete-{{ $category->id }}" method="post" >
                                                    @csrf @method('delete')
                                                </form>
                                            </div>
                                        </td>
                                    </tr>

                                @empty
                                    <tr class="text-center">
                                        <td colspan="10">
                                            <div class="empty--data">
                                                <img src="{{asset('/public/assets/admin/svg/illustrations/sorry.svg')}}" alt="public">
                                                <h5>
                                                    {{translate('no_data_found')}}
                                                </h5>
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
                <div class="page-area">
                    {!! $subCategories->links() !!}
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
            $('button[type="reset"]').on('click', function () {
                $('#category_selector').val('').trigger('change');
            });
        });
    </script>
@endpush
