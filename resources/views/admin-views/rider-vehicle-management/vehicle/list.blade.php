@extends('layouts.admin.app')

@section('title', translate('Vehicle List'))

@section('content')
	<div class="content container-fluid">
        <div class="mb-4 d-flex justify-content-between align-items-center gap-3 flex-wrap">
            <h1 class="page-header-title mb-0 pb-0">
                <span class="page-header-icon">
                    <img class="w--22" src="{{asset('public/assets/admin/img/vehicle.png')}}" loading="eager" alt="">
                </span>
                <span>
                    {{ translate('messages.Vehicle_List') }}
                </span>
            </h1>
            {{-- <div class="min-w-176px">
                <select name="" id="" class="form-control custom-select">
                    <option value="1">All Times</option>
                    <option value="2">Test</option>
                </select>
            </div> --}}
        </div>
        <div class="card mb-4">
			<div class="card-body">
				<div class="row g-2">
                    @foreach ($categories as $category)
					<div class="col-lg-3 col-sm-6">
						<div class="border rounded-10 p-20 d-flex flex-column">
							<div class="text-right">
								<img width="40" class="aspect-1-1" src="{{ $category->image_full_url }}" alt="">
							</div>
							<div>
								<h5 class="text--primary mb-0 font-semibold"> {{ $category->name }}</h5>
								<h2 class="fs-27 mb-0">{{ $category->vehicles->count() }}</h2>
							</div>
						</div>
					</div>
                    @endforeach
				</div>
			</div>
		</div>
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

                    <a type="button" href="{{ route('admin.users.delivery-man.vehicle.create') }}" class="btn btn--primary lh-1 d-flex gap-2 justify-content-center">
                        <i class="fi fi-rr-plus"></i>
                        {{ translate('messages.Add_New_Vehicle') }}
                    </a>
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
                            <th class="border-0 text-center">{{ translate('messages.status') }}</th>
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
                                <div class="d-flex justify-content-center">
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
                                </div>
                            </td>
                            <td>
                                <div class="btn--container justify-content-center">
                                    <a class="btn action-btn btn--warning btn-outline-warning" href="{{route('admin.users.delivery-man.vehicle.show', ['id'=>$vehicle->id])}}">
                                        <i class="tio-invisible"></i>
                                    </a>
                                    <a class="btn action-btn btn--primary btn-outline-primary"
                                        href="{{route('admin.users.delivery-man.vehicle.edit', ['id'=>$vehicle->id])}}" title="{{translate('messages.edit_vehicle')}}"><i class="tio-edit"></i>
                                    </a>
                                    <a class="btn action-btn btn--danger btn-outline-danger form-alert" href="javascript:"
                                    data-id="vehicle-{{$vehicle['id']}}" data-message="{{ translate('Want to delete this vehicle') }}" title="{{translate('messages.delete_vehicle')}}"><i class="tio-delete-outlined"></i>
                                    </a>
                                    <form action="{{ route('admin.users.delivery-man.vehicle.delete', ['id'=>$vehicle->id]) }}" method="post" id="vehicle-{{$vehicle['id']}}">
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

@endpush
