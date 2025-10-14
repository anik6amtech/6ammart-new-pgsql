@extends('service::provider.layouts.app')

@section('title', translate('messages.New_Service_Request'))

@push('css_or_js')

@endpush

@section('content')

    <div class="content container-fluid">
        <!-- Page Title -->
        <h2 class="h1 mb-sm-3 mb-2 text-capitalize d-flex align-items-center gap-2">
            <img width="24" height="24" src="{{asset('/public/assets/admin/img/service-details-img.png')}}" alt="services">
            {{translate('New Service Request')}}
        </h2>

        <div class="card">
            <div
                class="data-table-top border-bottom d-flex align-items-center flex-wrap gap-3 justify-content-between p-3">
                <h4 class="text-title mb-0">{{translate('All Services')}}</h4>
                <div class="d-flex flex-wrap align-items-center gap-3">
                    <form action="{{url()->current()}}" method="GET">
                        <div class="input-group input-group-custom input-group-merge">
                            <input id="datatableSearch_" type="search" name="search" class="form-control"
                                   placeholder="{{translate('Search by category')}}" aria-label="Search by ID or name" value="{{$search??''}}" required="">
                            <button type="submit" class="btn btn--primary input-group-text"><i
                                    class="tio-search fz-15px"></i></button>
                        </div>
                    </form>
                    {{-- <div class="hs-unfold mr-2">
                        <a class="js-hs-unfold-invoker btn btn-sm btn-white dropdown-toggle h--45px border"
                           data-hs-unfold-options="{
                            &quot;target&quot;: &quot;#usersExportDropdown&quot;,
                            &quot;type&quot;: &quot;css-animation&quot;
                        }" data-hs-unfold-target="#usersExportDropdown" data-hs-unfold-invoker="">
                            <i class="tio-download-to mr-1"></i> {{translate('Export')}}
                        </a>

                        <div id="usersExportDropdown" class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right hs-unfold-content-initialized hs-unfold-css-animation animated hs-unfold-hidden" data-hs-target-height="131.516" data-hs-unfold-content="" data-hs-unfold-content-animation-in="slideInUp" data-hs-unfold-content-animation-out="fadeOut" style="animation-duration: 300ms;">
                            <span class="dropdown-header">{{translate('Download options')}}</span>
                            <a id="export-excel" class="dropdown-item" href="{{ route('provider.service.service.export', ['type' => 'excel', request()->getQueryString()]) }}">
                                <img class="avatar avatar-xss avatar-4by3 mr-2" src="{{asset('/public/assets/admin/svg/components/excel.svg')}}" alt="Image Description">
                                {{translate('Excel')}}
                            </a>
                            <a id="export-csv" class="dropdown-item" href="{{ route('provider.service.service.export', ['type' => 'csv', request()->getQueryString()]) }}">
                                <img class="avatar avatar-xss avatar-4by3 mr-2" src="{{asset('/public/assets/admin/svg/components/placeholder-csv-format.svg')}}" alt="Image Description">
                                {{translate('.Csv')}}
                            </a>
                        </div>
                    </div> --}}
                    <button type="button" class="btn btn--primary offcanvas-toggle" data-toggle="offcanvas" data-target="#sendRequest">
                        <i class="tio-add"></i> {{translate('Send Request')}}
                    </button>
                </div>
            </div>
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table m-0 align-middle align-middle-cus table-custom-space tr-hover">
                        <thead class="text-nowrap bg-light">
                        <tr>
                            <th class="fz--14px text-title border-0">{{translate('SL')}}</th>
                            <th class="fz--14px text-title border-0">{{translate('Category')}}</th>
                            <th class="fz--14px text-title border-0">{{translate('Suggested Service Name')}}</th>
                            <th class="fz--14px text-title border-0">{{translate('Service Description')}}</th>
                            <th class="fz--14px text-title border-0 text-center">{{translate('Action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($requests as $key=>$item)
                            <tr>
                                <td class="text-title fz--14px">{{$requests->firstitem()+$key}}</td>
                                <td class="text-title fz--14px text--limit-2">
                                    @if($item->category)
                                        {{translate($item->category->name)}}
                                    @else
                                        {{translate('Not available')}}
                                    @endif
                                </td>
                                <td class="text-title fz--14px text--limit-2">
                                    {{$item->service_name}}
                                </td>
                                <td class="text-title">
                                    <p class="max-w-187px fz--14px line--limit-3">
                                        {{Str::limit($item->service_description, 150)}}
                                    </p>
                                </td>
                                <td class="text-center">
                                    @if($item->status == 'approved')
                                        <div class="d-flex align-items-center justify-content-center gap-2" data-toggle="modal" data-target="#view_feedbackPsitive--{{$key}}">
                                            <button type="button" class="btn rounded-pill py-3 px-4 font-medium" data-text-color="#fff" data-bg-color="#018C4B">
                                                {{translate('View Feedback')}}
                                            </button>
                                        </div>
                                    @elseif($item->status == 'denied')
                                        <div class="d-flex align-items-center justify-content-center gap-2" data-toggle="modal" data-target="#view_feedbackNagative--{{$key}}">
                                            <button type="button" class="btn rounded-pill py-3 px-4 font-medium" data-text-color="#fff" data-bg-color="#FF6D6D">
                                                {{translate('View Feedback')}}
                                            </button>
                                        </div>
                                    @elseif($item->status == 'pending')
                                        <div class="d-flex align-items-center justify-content-center gap-2">
                                            <button type="button" class="btn py-3 px-4 font-medium" data-text-color="#0177CD" data-bg-color="#0177CD1A">
                                                {{translate('Pending Review')}}
                                            </button>
                                        </div>
                                    @endif

                                    <!-- Service Request Details -->
                                    <div class="modal fade" id="view_feedbackPsitive--{{$key}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="text-center m-0">{{translate('Service Request Details')}}</h3>
                                                    <button type="button" class="close bg-white text-dark border d-center w-30px h-30 rounded-circle" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-left py-4">
                                                    <div class="d-flex flex-column gap-1 mb-20">
                                                        <div class="d-flex align-items-center gap-1">
                                                            <span class="fz--14px text-title w-100px d-block">{{translate('Title')}}</span>
                                                            <h5 class="fz--14px text-title">: {{translate($item->service_name)}}</h5>
                                                        </div>
                                                        <div class="d-flex align-items-center gap-1">
                                                            <span class="fz--14px text-title w-100px d-block">{{translate('Category')}}</span>
                                                            <h5 class="fz--14px text-title">: {{translate($item?->category?->name)}}</h5>
                                                        </div>
{{--                                                        <div class="d-flex align-items-center gap-1">--}}
{{--                                                            <span class="fz--14px text-title w-100px d-block">Sub Category</span>--}}
{{--                                                            <h5 class="fz--14px text-title">: Office Shifting</h5>--}}
{{--                                                        </div>--}}
                                                    </div>
                                                    <div class="mb-20">
                                                        <h5 class="mb-1">{{translate('Description')}}:</h5>
                                                        <p class="fs-12 mb-0">
                                                            {{translate($item->service_description)}}
                                                        </p>
                                                    </div>
                                                    <div class="rounded p-10px" data-bg-color="#0C9B561A">
                                                        <h5 class="mb-2">{{translate('Feedback')}}:</h5>
                                                        <p class="fs-12 mb-0">
                                                            {{translate($item->admin_feedback)}}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Service Request Details -->
                                    <div class="modal fade" id="view_feedbackNagative--{{$key}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="text-center m-0">{{translate('Service Request Details')}}</h3>
                                                    <button type="button" class="close bg-white text-dark border d-center w-30px h-30 rounded-circle" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-left py-4">
                                                    <div class="d-flex flex-column gap-1 mb-20">
                                                        <div class="d-flex align-items-center gap-1">
                                                            <span class="fz--14px text-title w-100px d-block">{{translate('Title')}}</span>
                                                            <h5 class="fz--14px text-title">: {{translate($item->service_name)}}</h5>
                                                        </div>
                                                        <div class="d-flex align-items-center gap-1">
                                                            <span class="fz--14px text-title w-100px d-block">{{translate('Category')}}</span>
                                                            <h5 class="fz--14px text-title">: {{translate($item?->category?->name)}}</h5>
                                                        </div>
{{--                                                        <div class="d-flex align-items-center gap-1">--}}
{{--                                                            <span class="fz--14px text-title w-100px d-block">Sub Category</span>--}}
{{--                                                            <h5 class="fz--14px text-title">: Office Shifting</h5>--}}
{{--                                                        </div>--}}
                                                    </div>
                                                    <div class="mb-20">
                                                        <h5 class="mb-1">{{translate('Description')}}:</h5>
                                                        <p class="fs-12 mb-0">
                                                            {{translate($item->service_description)}}
                                                        </p>
                                                    </div>
                                                    <div class="rounded p-10px" data-bg-color="#FF6D6D1A">
                                                        <h5 class="mb-2">{{translate('Feedback')}}:</h5>
                                                        <p class="fs-12 mb-0">
                                                            {{translate($item->admin_feedback)}}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            {{-- <tr class="text-center"><td colspan="5">{{translate('No request is available')}}</td></tr> --}}
                        @endforelse
                        </tbody>
                    </table>
                    @if(count($requests) === 0)
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


        <!-- Offcanvas -->
        <div class="offCanvasoverlay" id="overlayPayment"></div>
        <div class="offcanvas" id="sendRequest" data-overlay="#overlayPayment">
            <div class="offcanvas__header bg-light d-flex justify-content-between align-items-center gap-3 bg-body">
                <h3 class="mb-0 text-capitalize">{{ translate('messages.Request for Service') }}</h3>
                <div class="d-flex gap-3 align-items-center">
                    <button class="bg-white text-dark border d-center w-30px h-30 rounded-circle closeOfcanvus">
                        <i class="tio-clear"></i>
                    </button>
                </div>
            </div>
            <form action="" method="post">
                @csrf
                <div class="offcanvas__body">
                    <div class="mb-20">
                        <h4 class="mb-1">{{translate('Tell us more about your desired services')}}</h4>
                        <p class="fs-12 mb-0">
                            {{translate('Suggest more services that are willing to book and help us make more efficient platform for
                            you.')}}
                        </p>
                    </div>
                    <div class="bg-light rounded p-20">
                        <div class="d-flex flex-column gap-24px">
                            <div class="form-group mb-0">
                                <label for="cate_name" class="mb-2 d-block text-title font-400">
                                    {{translate('Select Category')}}
                                </label>
                                <select name="category_id" id="cate_name" class="custom-select">
                                    <option value="" selected disabled>{{translate('Select your preferable category')}}</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category['id']}}" {{old('category_id') == $category['id'] ? 'selected' : ''}}>{{ucwords($category['name'])}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-0">
                                <label for="service_name" class="mb-2 d-block text-title font-400">
                                    {{translate('Service name')}}
                                </label>
                                <input type="text" id="service_name" name="service_name" placeholder="{{translate('Shifting Service')}}" class="form-control">
                            </div>
                            <div class="form-group mb-0">
                                <label for="service_description" class="mb-2 d-block text-title font-400">
                                    {{translate('Description')}}
                                </label>
                                <textarea name="service_description" id="service_description" placeholder="{{translate('Type description')}}" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="offcanvas__footer d-center bg-white py-2">
                    <div class="d-flex justify-content-center align-items-center gap-3 w-100">
                        <button type="reset" class="w-100 btn btn--reset">{{ translate('messages.Reset') }}</button>
                        <button type="submit" class="btn w-100 btn--primary px-4 font-semibold closeOfcanvus">{{ translate('messages.Submit') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
