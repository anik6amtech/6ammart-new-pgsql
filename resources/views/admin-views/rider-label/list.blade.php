@extends('layouts.admin.app')

@section('title', translate('Rider_Level'))

@section('content')
	<div class="content container-fluid">
        <div class="page-header">
            <h1 class="page-header-title">
                <span class="page-header-icon">
                    <img src="{{ asset('public/assets/admin/img/rider-label-logo.png') }}" class="w--22" alt="">
                </span>
                <span>
                    {{ translate('messages.Rider_Level') }}
                </span>
            </h1>
        </div>
        <div class="card card-body mb-2">
            <div class="auto-items gap-3">
                @forelse($levels as $level)
                    <div class="__bg-FAFAFA card">
                        <div class="card-body">
                            <div class="d-flex gap-2 justify-content-between">
                                <div class="">
                                    <h5 class="text-primary line--limit-2 font-bold mb-3">{{ $level->name }}</h5>
                                    <div class="font-medium text-muted">{{ translate('messages.Riders') }}</div>
                                    <h3 class="fs-27">{{ $level->users->count() ?? 0 }}</h3>
                                </div>

                                <img class="h--40px aspect-1-1 rounded onerror-image" src="{{ $level->image_full_url }}" alt="Level image">
                            </div>
                        </div>
                    </div>
                @empty
                    <div
                        class="d-flex flex-column justify-content-center align-items-center gap-2 py-3">
                        <img
                            src="{{ asset('public/assets/admin-module/img/empty-icons/no-data-found.svg') }}"
                            alt="" width="100">
                        <p class="text-center">{{translate('no_data_available')}}</p>
                    </div>
                @endforelse
            </div>
        </div>
        <div>
            <ul class="nav nav-tabs dark border-0 mb-4" role="tablist">
                <li class="nav-item px-2" role="presentation">
                    <a class="nav-link border-bottom px-1 {{ !request()->has('status') || request()->get('status') === 'all' ? 'active' : '' }}" id="all-tab" href="{{ url()->current() }}?status=all" role="tab"
                        aria-controls="all" aria-selected="true">{{ translate('messages.All') }}</a>
                </li>
                <li class="nav-item px-2" role="presentation">
                    <a class="nav-link border-bottom px-1 {{ !request()->has('status') || request()->get('status') === 'active' ? 'active' : '' }}" id="active-tab" href="{{ url()->current() }}?status=active" role="tab"
                        aria-controls="active" aria-selected="true">{{ translate('messages.active') }}</a>
                </li>
                <li class="nav-item px-2" role="presentation">
                    <a class="nav-link border-bottom px-1 {{ !request()->has('status') || request()->get('status') === 'inactive' ? 'active' : '' }}" id="inactive-tab" href="{{ url()->current() }}?status=inactive" role="tab"
                        aria-controls="inactive" aria-selected="true">{{ translate('messages.inactive') }}</a>
                </li>
            </ul>

                <div class="tab-pane fade show active" id="tab_all" role="tabpanel" aria-labelledby="all-tab">
                    <div class="card">
                        <div class="card-header py-2">
                            <div class="search--button-wrapper justify-content-between gap-20px">
                                <h5 class="card-title text--title flex-grow-1">{{ translate('messages.Level_List') }}</h5>
                                <form class="search-form m-0 flex-grow-1 max-w-353px">
                                    <input type="hidden" name="status" value="{{ request()->get('status') ?? 'all' }}">

                                    <div class="input-group input--group">
                                        <input id="datatableSearch_" type="search" value="{{ request()?->search ?? null }}" name="search"
                                            class="form-control"
                                            placeholder="{{ translate('messages.Search here...') }}"
                                            aria-label="{{ translate('messages.Search here...') }}">
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
                                            href="{{ route('admin.users.delivery-man.level.export') }}?status={{ request()->get('status') ?? 'all' }}&&search={{ request()->get('search') }}&&file=excel">
                                            <img class="avatar avatar-xss avatar-4by3 mr-2"
                                                src="{{ asset('public/assets/admin') }}/svg/components/excel.svg" alt="Image Description">
                                            {{ translate('messages.excel') }}
                                        </a>
                                        <a id="export-csv" class="dropdown-item"
                                            href="{{ route('admin.users.delivery-man.level.export') }}?status={{ request()->get('status') ?? 'all' }}&&search={{ request()->get('search') }}&&file=csv">
                                            <img class="avatar avatar-xss avatar-4by3 mr-2"
                                                src="{{ asset('public/assets/admin') }}/svg/components/placeholder-csv-format.svg"
                                                alt="Image Description">
                                            .{{ translate('messages.csv') }}
                                        </a>

                                    </div>
                                </div>
                                <a href="{{ route('admin.users.delivery-man.level.create') }}" class="btn btn--primary"><i class="tio-add"></i> {{ translate('messages.Add_Label') }}</a>
                            </div>
                        </div>

                        <div class="table-responsive datatable-custom">
                            <table id="columnSearchDatatable"
                                class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table text--title">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="border-0">{{ translate('messages.SL') }}</th>
                                        <th class="border-0">{{ translate('messages.level_name') }}</th>
                                        <th class="border-0">{{ translate('messages.Target_to_proceed_level') }}</th>
                                        <th class="border-0 text-center">{{ translate('messages.total_trip') }}</th>
                                        <th class="border-0 text-center">{{ translate('messages.maximum') }} <br> {{ translate('messages.cancellation_rate') }}</th>
                                        <th class="border-0 text-center">{{ translate('messages.total_rider') }}</th>
                                        <th class="border-0 text-center">{{ translate('messages.status') }}</th>
                                        <th class="border-0 text-center">{{ translate('messages.action') }}</th>
                                    </tr>
                                </thead>

                                <tbody id="set-rows">
                                    @foreach($levels as $key => $level)
                                            <?php
                                            $totalTrip = 0;
                                            $completedTrip = 0;
                                            $cancelledTrip = 0;
                                            $trip_earning = 0;
                                            ?>

                                        @forelse($level->users as $user)
                                            @php($totalTrip += $user->driverTrips->count())
                                            @php($completedTrip += $user->driverTrips?->where('current_status', 'completed')->count())
                                            @php($cancelledTrip += $user->driverTrips?->where('current_status', 'cancelled')->count())
                                        @empty
                                        @endforelse
                                    <tr>
                                        <td>{{ $levels->firstItem() + $key }}</td>
                                        <td>
                                            <div href="" class="d-flex gap-2 align-items-center" alt="">
                                                <img class="h--40px aspect-1-1 rounded mr-2 onerror-image" src="{{ $level->image_full_url }}"
                                                     alt="Level image">
                                                <div class="text--title font-medium">
                                                    {{ $level->name }}
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                           <div class="d-flex flex-column gap-1 fs-12">
                                                <div class="d-flex gap-4 align-items-center">
                                                    <span class="w-100px text-wrap text-muted">{{translate('Ride Complete')}}</span>:
                                                    <span>{{ $level->targeted_ride }} ({{$level->targeted_ride_point}} {{translate('points')}})</span>
                                                </div>
                                                <div class="d-flex gap-4 align-items-center">
                                                    <span class="w-100px text-wrap text-muted">{{translate('Earning Amount')}}</span>:
                                                    <span>{{ set_currency_symbol($level->targeted_amount ?? 0) }} ({{$level->targeted_amount_point}} {{translate('points')}})</span>
                                                </div>
                                                <div class="d-flex gap-4 align-items-center">
                                                    <span class="w-100px text-wrap text-muted">{{ translate('Cancellation Rate') }}</span>:
                                                    <span>{{ $level->targeted_cancel }}% ({{$level->targeted_cancel_point}} {{translate('points')}})</span>
                                                </div>
                                                <div class="d-flex gap-4 align-items-center">
                                                    <span class="w-100px text-wrap text-muted">{{translate("Given Review")}}</span>:
                                                    <span>{{ $level->targeted_review }} ({{$level->targeted_review_point}} {{ translate('points') }})</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center"> {{ $completedTrip }}</td>
                                        <td class="text-center"> {{ number_format($totalTrip == 0 ? 0 : ($cancelledTrip / $totalTrip) * 100, 2) }} %</td>
                                        <td class="text-center">{{ $level->users->count() }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <label class="toggle-switch toggle-switch-sm" for="statusCheckbox{{$level->id}}">
                                                    <input type="checkbox"
                                                    data-id="statusCheckbox{{$level->id}}"
                                                    data-type="status"
                                                    data-image-on="{{ asset('/public/assets/admin/img/modal/basic_campaign_on.png') }}"
                                                    data-image-off="{{ asset('/public/assets/admin/img/modal/basic_campaign_off.png') }}"
                                                    data-title-on="{{ translate('By_Turning_ON_Level!') }}"
                                                    data-title-off="{{ translate('By_Turning_OFF_Level!') }}"
                                                    data-text-on="<p>{{ translate('If_you_turn_on_this_status,_it_will_show_on_user_app.') }}</p>"
                                                    data-text-off="<p>{{ translate('If_you_turn_off_this_status,_it_won’t_show_on_user_app') }}</p>"
                                                    class="toggle-switch-input  dynamic-checkbox" id="statusCheckbox{{$level->id}}" {{$level->is_active?'checked':''}}>
                                                    <span class="toggle-switch-label">
                                                        <span class="toggle-switch-indicator"></span>
                                                    </span>
                                                </label>
                                                <form action="{{route('admin.users.delivery-man.level.status',['id' => $level->id, 'status' => $level->is_active?0:1])}}"
                                                method="get" id="statusCheckbox{{$level->id}}_form">
                                                    <input type="hidden" name="status" value="{{$level->is_active?0:1}}">
                                                    <input type="hidden" name="id" value="{{$level->id}}">
                                                </form>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="btn--container justify-content-center">
                                                <a class="btn action-btn btn--primary btn-outline-primary"
                                                    href="{{route('admin.users.delivery-man.level.edit', ['id'=>$level->id])}}" title="{{translate('messages.edit_level')}}"><i class="tio-edit"></i>
                                                </a>
                                                <a class="btn action-btn btn--danger btn-outline-danger form-alert" href="javascript:"
                                                data-id="level-{{$level['id']}}" data-message="{{ translate('Want to delete this level') }}" title="{{translate('messages.delete_level')}}"><i class="tio-delete-outlined"></i>
                                                </a>
                                                <form action="{{ route('admin.users.delivery-man.level.delete', ['id'=>$level->id]) }}" method="post" id="level-{{$level['id']}}">
                                                    @csrf @method('delete')
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

        </div>
	</div>
@endsection

@push('script_2')

@endpush
