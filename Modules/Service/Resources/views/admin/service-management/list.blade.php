@extends('layouts.admin.app')

@section('title', translate('service_list'))

@push('css_or_js')
    <!-- Apex Charts -->
    <script src="{{ asset('/public/assets/admin/js/apex-charts/apexcharts.js') }}"></script>
    <!-- Apex Charts -->
@endpush

@section('content')

    <div class="content container-fluid">
        <!-- Page Header -->
        <h4 class="page-header-title mb-20">{{translate('messages.All Service')}}</h4>

       <div class="card mb-20">
            <div class="card-body">
                <form action="{{ url()->current() }}" method="GET" class="form-horizontal">
                    <h4 class="mb-20">{{translate('messages.Filter')}}</h4>
                    <div class="row g-4 align-items-end">
                        <div class="col-sm-6 col-lg-4">
                            <label class="d-block mb-2" for="category-list">{{translate('messages.Select Category')}}</label>
                            <select id="category-id" name="category_id" class="form-control  js-select2-custom">
                                <option value="">{{translate('messages.All Category')}}</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == request('category_id') ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <label class="d-block mb-2" for="subcategory-list">{{translate('messages.Select Sub Category')}}</label>
                            <div id="sub-category-selector">
                                <select id="subServiceC" name="sub_category_id" class="form-control  js-select2-custom">
                                    <option value="">{{translate('messages.All Subcategory')}}</option>
                                    @foreach($subCategories as $subCategory)
                                        <option value="{{ $subCategory->id }}" {{ $subCategory->id == request('sub_category_id') ? 'selected' : '' }}>{{ $subCategory->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <div class="btn--container justify-content-lg-end">
                                <a href="{{ url()->current() }}" class="btn btn--reset min-w-100px">{{ translate('messages.reset') }}</a>
                                <button type="submit"
                                    class="btn btn--primary min-w-100px">{{ translate('messages.Submit') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
       </div>

        <div class="card">
            <div class="data-table-top border-bottom d-flex align-items-center flex-wrap gap-3 justify-content-between p-3">
                <h4 class="text-title mb-0">{{translate('messages.Service List')}}</h4>
                <div class="d-flex flex-wrap align-items-center gap-3">
                    <form action="{{ url()->current() }}" method="GET">
                        <div class="input-group input-group-custom input-group-merge">
                            <input id="datatableSearch_" type="search" name="search" value="{{ request()->search }}" class="form-control"
                                placeholder="{{translate('messages.Search by name')}}" aria-label="{{translate('messages.Search by ID or name')}}" required="">
                            <button type="submit" class="btn btn--primary input-group-text"><i
                                    class="tio-search fz-15px"></i></button>
                        </div>
                    </form>
                    {{-- <div class="hs-unfold mr-2">
                        <a class="js-hs-unfold-invoker btn btn-sm btn-white dropdown-toggle h--45px border" href="javascript:;" data-hs-unfold-options="{
                                &quot;target&quot;: &quot;#usersExportDropdown&quot;,
                                &quot;type&quot;: &quot;css-animation&quot;
                            }" data-hs-unfold-target="#usersExportDropdown" data-hs-unfold-invoker="">
                            <i class="tio-download-to mr-1"></i> {{translate('messages.Export')}}
                        </a>

                        <div id="usersExportDropdown" class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right hs-unfold-content-initialized hs-unfold-css-animation animated hs-unfold-hidden" data-hs-target-height="131.516" data-hs-unfold-content="" data-hs-unfold-content-animation-in="slideInUp" data-hs-unfold-content-animation-out="fadeOut" style="animation-duration: 300ms;">
                            <span class="dropdown-header">{{translate('messages.Download options')}}</span>
                            <a id="export-excel" class="dropdown-item" href="javascript:;">
                                <img class="avatar avatar-xss avatar-4by3 mr-2" src="{{ asset('public/assets/admin/svg/components/excel.svg') }}" alt="Image Description">
                                {{translate('messages.Excel')}}
                            </a>
                            <a id="export-csv" class="dropdown-item" href="javascript:;">
                                <img class="avatar avatar-xss avatar-4by3 mr-2" src="{{ asset('public/assets/admin/svg/components/placeholder-csv-format.svg') }}" alt="Image Description">
                                {{translate('messages.Csv')}}
                            </a>
                        </div>
                    </div> --}}
                    <a href="{{ route('admin.service.service.create') }}" class="btn btn--primary">
                        <i class="tio-add"></i> {{translate('messages.Add Service')}}
                    </a>
                </div>
            </div>
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table m-0 align-middle align-middle-cus table-custom-space tr-hover">
                        <thead class="text-nowrap bg-light">
                            <tr>
                                <th class="fz--14px text-title border-0">{{translate('messages.SL')}}</th>
                                <th class="fz--14px text-title border-0">{{translate('messages.Service Info')}}</th>
                                <th class="fz--14px text-title border-0">{{translate('messages.Category')}}</th>
                                <th class="fz--14px text-title border-0">{{translate('messages.Zones')}}</th>
                                <th class="fz--14px text-title border-0">{{translate('messages.Minimum Bidding Price')}}</th>
                                <th class="fz--14px text-title border-0">{{translate('messages.Status')}}</th>
                                <th class="fz--14px text-title border-0 text-end">{{translate('messages.Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($services as $key=>$service)
                                <tr>
                                    <td class="text-title">{{$services->firstitem()+$key}}</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="d-block">
                                                <img width="50" height="50" src="{{ $service->thumbnail_full_path }}" alt="img" class="rounded-10">
                                            </div>
                                            <div class="__body ">
                                                <a href="{{route('admin.service.service.detail', ['id'=>$service->id])}}">
                                                    <h5 class="d-flex mb-0 font-medium align-items-center max-w-130px">{{$service->name}}</h5>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-title">{{$service->category->name}}</div>
                                    </td>
                                    <td>
                                    <div class="text-title">
                                        @if($service->category)
                                            @if(count($service->category->zonesBasicInfo) > 0)
                                                {{implode(', ',$service->category->zonesBasicInfo->pluck('name')->toArray())}}
                                            @else
                                                <i class="material-icons" data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    title="{{translate('This category is not under any zone. Kindly update the category with zone')}}">info
                                                </i>
                                            @endif
                                        @endif
                                    </div>
                                    </td>
                                    <td>
                                        <div class="text-title">
                                            {{\App\CentralLogics\Helpers::format_currency($service->min_bidding_price)}}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <label class="toggle-switch toggle-switch-sm" for="statusCheckbox{{$service->id}}">
                                                <input type="checkbox"
                                                data-id="statusCheckbox{{$service->id}}"
                                                data-type="status"
                                                data-image-on="{{ asset('/public/assets/admin/img/modal/basic_campaign_on.png') }}"
                                                data-image-off="{{ asset('/public/assets/admin/img/modal/basic_campaign_off.png') }}"
                                                data-title-on="{{ translate('By_Turning_ON_service!') }}"
                                                data-title-off="{{ translate('By_Turning_OFF_service!') }}"
                                                data-text-on="<p>{{ translate('If_you_turn_on_this_status,_it_will_show_on_user_app.') }}</p>"
                                                data-text-off="<p>{{ translate('If_you_turn_off_this_status,_it_won’t_show_on_user_app') }}</p>"
                                                class="toggle-switch-input  dynamic-checkbox" id="statusCheckbox{{$service->id}}" {{$service->is_active?'checked':''}}>
                                                <span class="toggle-switch-label">
                                                    <span class="toggle-switch-indicator"></span>
                                                </span>
                                            </label>
                                            <form action="{{route('admin.service.service.status-update',['id' => $service->id, 'status' => $service->is_active?0:1])}}"
                                            method="get" id="statusCheckbox{{$service->id}}_form">
                                                <input type="hidden" name="status" value="{{$service->is_active?0:1}}">
                                                <input type="hidden" name="id" value="{{$service->id}}">
                                            </form>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="table-actions justify-content-end d-flex gap-2">
                                            <a href="{{route('admin.service.service.detail', ['id'=>$service->id])}}" type="button"
                                                class="btn action-btn btn--primary btn-outline-primary"
                                                style="--size: 30px">
                                                <i class="tio-visible"></i>
                                            </a>
                                            <a href="{{route('admin.service.service.edit', ['id'=>$service->id])}}" type="button" class="action-btn btn--info btn-outline-info"
                                                style="--size: 30px">
                                                <i class="tio-edit"></i>
                                            </a>
                                            <a href="javascript:" type="button"
                                                class="btn action-btn btn-outline-danger btn-danger form-alert"
                                                style="--size: 30px" data-id="delete-{{ $service->id }}" data-message="{{ translate('Want to delete this ?') }}">
                                                <i class="tio-delete"></i>
                                            </a>

                                            <form action="{{ route('admin.service.service.delete', ['id'=>$service->id]) }}"
                                                                        id="delete-{{ $service->id }}" method="post" >
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
            @if(count($services) !== 0)
                <hr>
            @endif
            <div class="page-area">
                {!! $services->links() !!}
            </div>
        </div>
    </div>

@endsection

@push('script_2')
    <script>
        $(document).ready(function() {
            $("#category-id").change(function (){
                let id = this.value;
                if (id == '') {
                    $('#sub-category-selector select').html('<option value="">{{translate('messages.all_subcategory')}}</option>').trigger('change');
                    return;
                }
                let route = "{{ url('/admin/service/category/ajax-childes/') }}/" + id;
                ajax_switch_category(route);
            });

            function ajax_switch_category(route) {
                $.get({
                    url: route,
                    dataType: 'json',
                    data: {
                    allOption: "yes",
                    },
                    beforeSend: function () {
                    },
                    success: function (response) {
                        $('#sub-category-selector').html(response.template);
                    },
                    complete: function () {
                    },
                });
            }
        });
    </script>


@endpush
