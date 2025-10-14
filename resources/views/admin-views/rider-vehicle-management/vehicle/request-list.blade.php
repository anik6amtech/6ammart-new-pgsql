@extends('layouts.admin.app')

@section('title', translate('New_Vehicle_Request'))

@section('content')
	<div class="content container-fluid">
        <div class="mb-4 d-flex justify-content-between align-items-center gap-3 flex-wrap">
            <h1 class="page-header-title mb-0 pb-0">
                <span class="page-header-icon">
                    <img class="w--22" src="{{asset('public/assets/admin/img/vehicle.png')}}" loading="eager" alt="">
                </span>
                <span>
                    {{ translate('messages.New_Vehicle_Request') }}
                </span>
            </h1>
        </div>
        <div>
            @include('admin-views.rider-vehicle-management.vehicle.partial.request-nav')
            <div class="card">
                <div class="card-header py-2">
                    <div class="search--button-wrapper justify-content-between gap-20px">
                        <h5 class="card-title text--title flex-grow-1">{{ translate('messages.Vehicles_List') }}</h5>
                        <form class="search-form m-0 flex-grow-1 max-w-353px">

                            <div class="input-group input--group">
                                <input id="datatableSearch_" type="search" value="{{ request()?->search ?? null }}" name="search"
                                    class="form-control"
                                    placeholder="{{ translate('messages.Search by Vehicle name') }}"
                                    aria-label="{{ translate('messages.Search by Vehicle name') }}">
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
                                    href="{{ route('admin.users.delivery-man.vehicle.export')}}?status={{ request()->get('status') ?? 'all' }}&&search={{ request()->get('search') }}&&file=excel">
                                    <img class="avatar avatar-xss avatar-4by3 mr-2"
                                        src="{{ asset('public/assets/admin') }}/svg/components/excel.svg" alt="Image Description">
                                    {{ translate('messages.excel') }}
                                </a>
                                <a id="export-csv" class="dropdown-item"
                                    href="{{ route('admin.users.delivery-man.vehicle.export') }}?status={{ request()->get('status') ?? 'all' }}&&search={{ request()->get('search') }}&&file=excel">
                                    <img class="avatar avatar-xss avatar-4by3 mr-2"
                                        src="{{ asset('public/assets/admin') }}/svg/components/placeholder-csv-format.svg"
                                        alt="Image Description">
                                    .{{ translate('messages.csv') }}
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
                                <th class="border-0">{{ translate('messages.Vehicle_Info') }}</th>
                                <th class="border-0">{{ translate('messages.brand_&_model') }}</th>
                                <th class="border-0">{{ translate('messages.vin_&_liencse') }}</th>
                                <th class="border-0">{{ translate('messages.owner_info') }}</th>
                                <th class="border-0 text-center">{{ translate('messages.action') }}</th>
                            </tr>
                        </thead>

                        <tbody id="set-rows">
                            @forelse($vehicles as $key => $vehicle)
                            <tr>
                                <td>{{ $vehicles->firstItem() + $key }}</td>
                                <td>
                                    <div>
                                        <a href="{{route('admin.users.delivery-man.vehicle.show', ['id'=>$vehicle->id])}}" class="table-rest-info" alt="{{translate('view_driver')}}">
                                            <img class="aspect-1-1 w-40px onerror-image"
                                                data-onerror-image="{{asset('public/assets/admin/img/160x160/img1.jpg')}}"
                                                src="{{$vehicle->model?->image_full_url }}">
                                            <div class="info text--title">
                                                <div title="" class="font-medium">
                                                    {{ $vehicle->name }}
                                                </div>
                                                <div class="font-bold opacity-70">
                                                    #{{ $vehicle->id }}
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <div class="font-medium">
                                            {{ $vehicle->brand->name ?? translate('messages.brand_not_found') }}
                                            <span class="text--title">({{ $vehicle->model->name ?? translate('messages.model_not_found') }})</span>
                                        </div>
                                        {{-- <div class="font-bold opacity-70">
                                            #231543
                                        </div> --}}
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <div class="d-flex gap-2 align-items-center fs-12 font-medium">
                                            <span class="w-50px opacity-70">{{ translate('VIN') }}</span>
                                            <span class="opacity-70">:</span>
                                            <span>{{ $vehicle->vin_number }}</span>
                                        </div>
                                        <div class="d-flex gap-2 align-items-center fs-12 font-medium">
                                            <span class="w-50px opacity-70">{{ translate('Lice') }}</span>
                                            <span class="opacity-70">:</span>
                                            <span>{{ $vehicle->licence_plate_number }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        @if($vehicle->ownership == 'admin')
                                        <div class="font-medium">
                                                {{ translate('messages.admin') }}
                                            </div>
                                        @else
                                            <div class="font-medium">
                                                {{ $vehicle?->driver?->f_name? $vehicle?->driver?->f_name .' '. $vehicle?->driver?->l_name :"N/A" }}
                                            </div>
                                            <div class="font-bold opacity-70">
                                                {{ $vehicle?->driver?->phone }}
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="btn--container justify-content-center">
                                        @if($vehicle->vehicle_request_status == 'pending')
                                            <button type="button" class="btn action-btn btn-success btn-outline-success" data-toggle="modal" data-target="#approve_modal-{{$vehicle->id}}" title="{{translate('messages.approve_vehicle')}}">
                                                <i class="tio-done"></i>
                                            </button>
                                            <button type="button" class="btn action-btn btn--danger btn-outline-danger" data-toggle="modal" data-target="#deny_modal-{{$vehicle->id}}" title="{{translate('messages.deny_vehicle')}}">
                                                <i class="tio-clear"></i>
                                            </button>
                                        @endif
                                        <a class="btn action-btn btn--warning btn-outline-warning" href="{{route('admin.users.delivery-man.vehicle.show', ['id'=>$vehicle->id])}}">
                                            <i class="tio-invisible"></i>
                                        </a>
                                        @if($vehicle->vehicle_request_status == 'denied')
                                        <a class="btn action-btn btn--primary btn-outline-primary"
                                            href="{{route('admin.users.delivery-man.vehicle.edit', ['id'=>$vehicle->id])}}" title="{{translate('messages.edit_vehicle')}}"><i class="tio-edit"></i>
                                        </a>
                                        <a class="btn action-btn btn--danger btn-outline-danger form-alert" href="javascript:"
                                        data-id="vehicle-{{$vehicle['id']}}" data-message="{{ translate('Want to delete this vehicle') }}" title="{{translate('messages.delete_vehicle')}}"><i class="tio-delete-outlined"></i>
                                        </a>
                                        <form action="{{ route('admin.users.delivery-man.vehicle.delete', ['id'=>$vehicle->id]) }}" method="post" id="vehicle-{{$vehicle['id']}}">
                                            @csrf @method('delete')
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>



                            {{-- Approve modal --}}
                            <div class="modal fade" id="approve_modal-{{$vehicle->id}}">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">
                                                <span aria-hidden="true" class="tio-clear"></span>
                                            </button>
                                        </div>
                                        <div class="modal-body pb-5 pt-0">
                                            <form action="{{route('admin.users.delivery-man.vehicle.request.approved', [$vehicle->id])}}" method="post">
                                                @csrf
                                                @method('put')
                                                <div class="max-349 mx-auto mb-20">
                                                    <div class="mb-8">
                                                        <div class="text-center">
                                                            <img width="80" src="{{asset('public/assets/admin/img/approve.png')}}" alt="" class="mb-20 aspect-1-1">
                                                            <h4 class="modal-title mb-2">{{translate('messages.Are_you_sure_want_to_approve')}}?</h4>
                                                        </div>
                                                        <div class="text-center fs-12">
                                                            {{translate('Do you want to')}} <span class="font-semibold">{{translate('Approve')}}</span>
                                                            {{translate('this new vehicle request')}}?
                                                        </div>
                                                    </div>
                                                    <div class="btn--container justify-content-center">
                                                        <button type="submit" class="btn btn--primary min-w-120">{{translate('messages.Yes,_Approve')}}</button>
                                                        <button id="reset_btn" type="reset" class="btn btn--reset min-w-120" data-dismiss="modal">
                                                            {{translate("messages.Cancel")}}
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Deny modal --}}
                            <div class="modal fade" id="deny_modal-{{$vehicle->id}}">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">
                                                <span aria-hidden="true" class="tio-clear"></span>
                                            </button>
                                        </div>
                                        <div class="modal-body pb-5 pt-0">
                                            <form action="{{route('admin.users.delivery-man.vehicle.request.denied', [$vehicle->id])}}" method="post">
                                                @csrf
                                                @method('put')
                                                <div class="mx-auto mb-20">
                                                    <div class="mb-4">
                                                        <div class="text-center">
                                                            <img width="80" src="{{asset('public/assets/admin/img/denied.png')}}" alt="" class="mb-20 aspect-1-1">
                                                            <h4 class="modal-title mb-2">{{translate('messages.Are_you_sure')}}?</h4>
                                                        </div>
                                                        <div class="text-center fs-12 mb-6">
                                                            {{translate('Do you want to')}} <span class="font-semibold">{{translate('Denied')}}</span>
                                                            {{translate('this new vehicle request')}}?
                                                        </div>
                                                        <div class="form-group mb-0">
                                                            <label class="input-label fs-12" for="">
                                                                {{translate('messages.Deny_Note')}}
                                                            </label>
                                                            <textarea type="text" name="" placeholder="{{translate('messages.type_a_note_for_the_rider')}}"
                                                                      class="form-control" rows="3" data-maxlength="150"></textarea>
                                                            {{--                                <div class="text-right fs-12 text_count">0/150</div>--}}
                                                        </div>
                                                    </div>
                                                    <div class="btn--container justify-content-center">
                                                        <button id="reset_btn" type="reset" class="btn btn--reset min-w-120" data-dismiss="modal">
                                                            {{translate("messages.Cancel")}}
                                                        </button>
                                                        <button type="submit" class="btn btn--primary min-w-120">{{translate('messages.Submit')}}</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
	</div>
     {{-- Delete modal --}}
    <div class="modal fade" id="delete_modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true" class="tio-clear"></span>
                    </button>
                </div>
                <div class="modal-body pb-5 pt-0">
                    <div class="mx-auto mb-20">
                        <div class="mb-8">
                            <div class="text-center">
                                <img width="80" src="{{asset('public/assets/admin/img/ride-share/delete.png')}}" alt="" class="mb-20 aspect-1-1">
                                <h3 class="mb-2 text-title font-medium">{{translate('messages.Are_you_sure_to_delete_this_Request')}}?</h3>
                            </div>
                            <div class="text-center fs-16">
                                Once you delete it, This will permanently remove from the Vehicle Request list.
                            </div>
                        </div>
                        <div class="btn--container justify-content-center">
                            <button type="button" class="btn btn--danger text-white min-w-120" data-dismiss="modal" >{{translate('messages.Yes,_Delete')}}</button>
                            <button id="reset_btn" type="reset" class="btn btn--reset min-w-120" data-dismiss="modal">
                                {{translate("messages.Not_Now")}}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script_2')

@endpush
