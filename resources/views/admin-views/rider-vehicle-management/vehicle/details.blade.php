@extends('layouts.admin.app')

@section('title', translate('messages.vehicle_details'))

@push('css_or_js')
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header pb-4">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h1 class="page-header-title mb-0">
                        <span class="page-header-icon">
                            <img src="{{ asset('public/assets/admin/img/vehicle.png') }}" alt="">
                        </span>
                        <span>{{ $vehicle->name }}</span>
                    </h1>
                </div>
                <div class="d-flex align-items-stretch flex-wrap gap-2">
                    <a class="btn btn--cancel h--45px d-flex gap-2 align-items-center form-alert" href="javascript:"
                       data-id="vehicle-{{$vehicle['id']}}" data-message="{{ translate('Want to delete this vehicle') }}" title="{{translate('messages.delete_vehicle')}}">
                        <i class="tio-delete"></i>
                        {{ translate('messages.delete') }}
                    </a>

                    <form action="{{route('admin.users.delivery-man.vehicle.delete',[$vehicle['id']])}}" method="post" id="vehicle-{{$vehicle->id}}">
                        @csrf @method('delete')
                    </form>
                    <button class="btn btn--reset d-flex justify-content-between align-items-center gap-1 lh--1 h--45px shadow-none">
                        {{ translate('messages.status') }}
                               <label class="toggle-switch toggle-switch-sm" for="statusCheckbox{{$vehicle->id}}">
                                    <input type="checkbox"
                                    data-id="statusCheckbox{{$vehicle->id}}"
                                    data-type="status"
                                    data-image-on="{{ asset('/public/assets/admin/img/modal/basic_campaign_on.png') }}"
                                    data-image-off="{{ asset('/public/assets/admin/img/modal/basic_campaign_off.png') }}"
                                    data-title-on="{{ translate('By_Turning_ON_vehicle!') }}"
                                    data-title-off="{{ translate('By_Turning_OFF_vehicle!') }}"
                                    data-text-on="<p>{{ translate('If_you_turn_on_this_status,_it_will_show_on_user_app.') }}</p>"
                                    data-text-off="<p>{{ translate('If_you_turn_off_this_status,_it_won’t_show_on_user_app') }}</p>"
                                    class="toggle-switch-input  dynamic-checkbox" id="statusCheckbox{{$vehicle->id}}" {{$vehicle->is_active?'checked':''}}>
                                    <span class="toggle-switch-label">
                                        <span class="toggle-switch-indicator"></span>
                                    </span>
                                </label>
                                <form action="{{route('admin.users.delivery-man.vehicle.status',['id' => $vehicle->id, 'status' => $vehicle->is_active?0:1])}}"
                                method="get" id="statusCheckbox{{$vehicle->id}}_form">
                                    <input type="hidden" name="status" value="{{$vehicle->is_active?0:1}}">
                                    <input type="hidden" name="id" value="{{$vehicle->id}}">
                                </form>
                    </button>
                     @if($vehicle->vehicle_request_status == 'pending' || $vehicle->vehicle_request_status == 'denied')
                     <form action="{{route('admin.users.delivery-man.vehicle.request.denied',[$vehicle['id']])}}" method="post" id="vehicle-denied-{{$vehicle->id}}">
                        @csrf @method('put')
                    </form>
                     <form action="{{route('admin.users.delivery-man.vehicle.request.approved',[$vehicle['id']])}}" method="post" id="vehicle-approved-{{$vehicle->id}}">
                        @csrf @method('put')
                    </form>
                    @if($vehicle->vehicle_request_status == 'approved' || $vehicle->vehicle_request_status == 'pending')
                    <a class="btn btn--cancel h--45px d-flex gap-2 align-items-center lh-1 form-alert" href="javascript:void(0)" data-url="{{route('admin.users.delivery-man.vehicle.request.denied', [$vehicle->id])}}"
                       data-id="vehicle-denied-{{$vehicle->id}}" data-message="You want to decline this vehicle request" title="{{translate('messages.deny')}}">
                        <i class="tio-clear"></i>
                        {{ translate('messages.deny') }}
                    </a>
                    @endif
                    <a class="btn btn--primary-light h--45px d-flex gap-2 align-items-center lh-1 form-alert" href="javascript:void(0)" data-url="{{route('admin.users.delivery-man.vehicle.request.approved', [$vehicle->id])}}"
                       data-id="vehicle-approved-{{$vehicle->id}}" data-message="You want to approve this vehicle request" title="{{translate('messages.Approved')}}">
                        <i class="tio-done"></i>
                        {{ translate('messages.Approved') }}
                    </a>
                    @endif
                    <a href="{{route('admin.users.delivery-man.vehicle.edit', ['id'=>$vehicle->id])}}" class="btn btn--primary h--45px d-flex gap-2 align-items-center">
                        <i class="tio-edit"></i>
                        {{ translate('messages.Edit_Vechicle') }}
                    </a>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="mb-4">
                            <h4 class="text--title font-bold mb-0">
                                <span class="opacity-70 mr-1">
                                    <img class="svg" src="{{ asset('public/assets/admin/img/ride-share/vehicle-info-icon.svg') }}" alt="">
                                </span>
                                <span>
                                    {{ translate('messages.Vehicle_Info') }}
                                </span>
                            </h4>
                        </div>
                        <div class="d-flex gap-4 align-items-center">
                            <img class="w-100px aspect-1-1 object--cover rounded" src="{{$vehicle->model?->image_full_url }}" alt="">
                            <div class="flex-grow-1">
                                <h5 class="font-bold text--title">{{ $vehicle->name }}</h5>
                                <div class="d-flex justify-content-between flex-wrap gap-2 flex-column flex-sm-row max-w-300px">
                                   <h5 class="mb-0 text--title"><span class="opacity-70">{{ translate('Brand') }} - </span><span>{{ $vehicle?->brand?->name }}</span></h5>
                                    <h5 class="mb-0 text--title"><span class="opacity-70">{{ translate('Category') }} - </span><span>{{ $vehicle?->category?->name }}</span></h5>
                                    <h5 class="mb-0 text--title"><span class="opacity-70">{{ translate('Model') }} - </span><span>{{ $vehicle?->model?->name }}</span></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($vehicle->ownership == 'rider')
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <h4 class="text--title font-bold mb-0">
                                    <span class="opacity-70 mr-1">
                                        <img class="svg" src="{{ asset('public/assets/admin/img/ride-share/vehicle-info-icon.svg') }}" alt="">
                                    </span>
                                    <span>
                                        {{ translate('messages.Owner_Details') }}
                                    </span>
                                </h4>
                            </div>
                            <div class="d-flex gap-4 align-items-center">
                                <img class="w-100px aspect-1-1 object--cover rounded" src="{{ asset('public/assets/admin/img/100x100/1.png') }}" alt="">
                                <div class="flex-grow-1">
                                    <h5 class="font-bold text--title">{{ $vehicle?->driver?->f_name.' '.$vehicle?->driver?->l_name }}</h5>
                                    <div class="fs-12 text--title opacity-80">
                                        <div class="mb-1">{{ $vehicle?->driver?->phone }}</div>
                                        <div>{{ $vehicle?->driver?->email }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-body">
                <h4 class="text-title font-bold mb-3">
                    {{ translate('messages.Vehicle_Specification') }}
                </h4>
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap text-title">
                        <tbody>
                            <tr>
                                <td>{{ translate('VIN') }}</td>
                                <td>{{ $vehicle?->vin_number }}</td>
                                <td>{{ translate('Category') }}</td>
                                <td>{{ $vehicle?->category?->name }}</td>
                            </tr>
                            <tr>
                                <td>{{ translate('Licence Plate Number') }}</td>
                                <td>{{ $vehicle?->licence_plate_number }}</td>
                                <td>{{ translate('Brand') }}</td>
                                <td>{{ $vehicle?->brand?->name }}</td>
                            </tr>
                            <tr>
                                <td>{{ translate('Licence Expiry Date') }}</td>
                                <td>{{ App\CentralLogics\Helpers::date_format($vehicle?->licence_expire_date) }}</td>
                                <td>{{ translate('Model') }}</td>
                                <td>{{ $vehicle?->model?->name }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
       <div class="card">
            <div class="card-header">
                <div>
                    <h5 class="text-title mb-1">
                        {{ translate('messages.Additional_Documents') }}
                    </h5>
                    <p class="fs-12">
                        {{ translate('messages.Here you can see all images & document for the provider') }}
                    </p>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex gap-3 flex-wrap">
                    @foreach($vehicle['documentsFullUrl'] as $doc)
                    <div class="pdf-single" data-pdf-url="{{ $doc }}">
                        <div class="pdf-frame">
                            <canvas class="pdf-preview display-none" ></canvas>
                            <img class="pdf-thumbnail" src="{{ $doc }}" alt="File Thumbnail">
                        </div>
                        <div class="overlay">
                            <a href="javascript:void(0);" class="download-btn" title="">
                                <i class="tio-download-to"></i>
                            </a>
                            <div class="pdf-info d-flex gap-10px align-items-center">
                                <img src="{{ asset('public/assets/admin/img/document.svg') }}" width="34" alt="Document Logo">
                                <div class="fs-13 text--title d-flex flex-column">
                                    <span class="file-name"></span>
                                    <span class="opacity-50">{{ translate('Click to view the file') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

    <div id="file-assets"
        data-document-path="{{ asset('public/assets/admin/img/icons') }}"
        data-default-thumbnail="{{ asset('public/assets/admin/img/blank2.png') }}">
    </div>

@endsection



@push('script_2')
    <script src="{{ asset('public/assets/admin/js/view-pages/pdf.min.js') }}"></script>
    <script src="{{ asset('public/assets/admin/js/view-pages/vehicle-details.js') }}"></script>
@endpush
