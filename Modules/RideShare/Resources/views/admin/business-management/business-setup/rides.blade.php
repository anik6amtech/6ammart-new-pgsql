@extends('layouts.admin.app')

@section('title', translate('messages.Additional_Setup'))

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header pb-20">
            <div class="d-flex justify-content-between flex-wrap gap-3">
                <div>
                    <h1 class="page-header-title">
                        <span class="page-header-icon">
                            <img src="{{ asset('Modules/RideShare/public/assets/img/ride-share/business-icon.png') }}" alt="" class="w--20px aspect-1-1">
                        </span>
                        <span>{{ translate('messages.Additional_Setup') }}</span>
                    </h1>
                </div>
            </div>
        </div>
        <div class="js-nav-scroller hs-nav-scroller-horizontal mb-4">
            @include('ride-share::admin.business-management.business-setup.partials._business-setup-inline')
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h4 class="text--title font-bold mb-0 d-flex gap-2 align-items-center lh-1">
                    <i class="fi fi-rr-settings"></i>
                    {{ translate('messages.Rides_settings') }}
                </h4>
            </div>
            <div class="card-body">
                <form action="{{route('admin.business-settings.ride-fare.store')."?type=".TRIP_SETTINGS}}" id="rides_form"
                      method="POST">
                    @csrf
                    <div class="row g-4">
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group mb-0">
                                <label for="" class="form-label d-flex">
                                    <span class="line--limit-1">
                                        {{ translate('messages.add_route_between_pickup_&_destination') }}
                                    </span>
                                    <span class="form-label-secondary text-danger d-flex" data-toggle="tooltip" data-placement="right" data-original-title="{{ translate('If Yes, customers can add routes between pickup and destination') }}"><img src="{{ asset('public/assets/admin/img/info-circle.svg') }}" alt="{{ translate('messages.add_route_between_pickup_&_destination') }}"></span>
                                </label>
                                <div class="resturant-type-group border bg-white justify-content-between">
                                    <label class="form-check form--check flex-grow-1">
                                        <input name="customer_route_preference" class="form-check-input" type="radio" value="1" {{($settings->firstWhere('key', 'customer_route_preference')->value?? 0) == 1 ? 'checked' : ''}} required>
                                        <span class="form-check-label">
                                            {{ translate('messages.yes') }}
                                        </span>
                                    </label>
                                    <label class="form-check form--check flex-grow-1">
                                        <input name="customer_route_preference" class="form-check-input" type="radio" value="0" {{($settings->firstWhere('key', 'customer_route_preference')->value?? 0) == 0 ? 'checked' : ''}} required>
                                        <span class="form-check-label">
                                            {{ translate('messages.no') }}
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group mb-0">
                                <label for="" class="form-label d-flex">
                                    <span class="line--limit-1">
                                        {{ translate('messages.ride_request_active_time_for_customer') }}
                                    </span>
                                    <span class="form-label-secondary text-danger d-flex" data-toggle="tooltip" data-placement="right" data-original-title="{{translate('Customers’ ride requests will be visible to drivers for the time (in minutes) you have set here') . '. '. translate('When the time is over, the requests get removed automatically.')}}"><img src="{{ asset('public/assets/admin/img/info-circle.svg') }}" alt="{{ translate('messages.ride_request_active_time_for_customer') }}"></span>
                                </label>
                                <input type="number" name="ride_request_active_time" value="{{$settings->firstWhere('key', 'ride_request_active_time')?->value}}" id="" class="form-control" placeholder="Ex: 5">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group mb-0">
                                <label for="" class="form-label d-flex">
                                    <span class="line--limit-1">
                                        {{ translate('messages.Ride_OTP') }}
                                    </span>
                                    <span class="form-label-secondary text-danger d-flex" data-toggle="tooltip" data-placement="right" data-original-title="{{ translate('When this option is enabled, for starting the ride, the driver will need to get an OTP from the customer') }}"><img src="{{ asset('public/assets/admin/img/info-circle.svg') }}" alt="{{ translate('messages.Ride_OTP') }}"></span>
                                </label>
                                <label
                                    class="toggle-switch h--45px toggle-switch-sm d-flex justify-content-between border rounded px-3 py-0 form-control">
                                    <span class="pr-1 d-flex align-items-center switch--label">
                                        <span class="line--limit-1">
                                            {{ translate('messages.driver_otp_confirmation_for_ride') }}
                                        </span>
                                    </span>
                                    <input type="checkbox" data-id="ride_otp_confirmation" data-type="toggle"
                                        data-image-on="{{ asset('public/assets/admin/img/modal/prescription-on.png') }}"
                                        data-image-off="{{ asset('public/assets/admin/img/modal/prescription-off.png') }}"
                                        data-title-on="{{ translate('messages.Want_to_enable_Driver_OTP_Confirmation_for_Ride') }}"
                                        data-title-off="{{ translate('messages.Want_to_disable_Driver_OTP_Confirmation_for_Ride') }}"
                                        data-text-on="{{ translate('messages.If_enabled_this_feature_will_be_visible_in_the_Customer_App_and_Rider_App') }}"
                                        data-text-off="{{ translate('messages.If_disabled_this_feature_will_be_hidden_from_the_Customer_App_and_Rider_App') }}"
                                        class="status toggle-switch-input dynamic-checkbox-toggle" value="1" name="ride_otp_confirmation"
                                        id="ride_otp_confirmation" {{ $settings->firstWhere('key', 'ride_otp_confirmation')?->value ? 'checked' : '' }}>
                                    <span class="toggle-switch-label text">
                                        <span class="toggle-switch-indicator"></span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn--primary min-w-120px">{{ translate('messages.submit') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h4 class="text--title font-bold mb-0 d-flex gap-2 align-items-center lh-1">
                    <i class="fi fi-rr-settings"></i>
                    {{ translate('messages.Rides_cancellation_messages') }}
                </h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.business-settings.ride-fare.cancellation_reason.store') }}"
                          method="post">
                        @csrf
                    <div class="__bg-FAFAFA p-20 rounded-10">
                        @php($language = \App\Models\BusinessSetting::where('key', 'language')->first())
                        @php($language = $language->value ?? null)
                        @php($defaultLang = str_replace('_', '-', app()->getLocale()))
                        @if ($language)
                            <ul class="nav nav-tabs nav--tabs mb-3 border-0">
                                <li class="nav-item">
                                    <a class="nav-link lang_link1 active" href="#"
                                        id="default-link1">{{ translate('Default') }}</a>
                                </li>
                                @foreach (json_decode($language) as $lang)
                                    <li class="nav-item">
                                        <a class="nav-link lang_link1" href="#"
                                            id="{{ $lang }}-link1">{{ \App\CentralLogics\Helpers::get_language_name($lang) . '(' . strtoupper($lang) . ')' }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="row g-4">
                            <div class="col-lg-4 col-md-6 lang_form1 default-form1">
                                <div class="form-group mb-0">
                                    <label for="" class="form-label d-flex">
                                        <span class="line--limit-1">
                                            {{ translate('messages.ride_cancellation_reason') }} ({{ translate('messages.default') }})
                                        </span>
                                        <span class="form-label-secondary text-danger d-flex" data-toggle="tooltip" data-placement="right" data-original-title="{{ translate('Driver & Customer cancel ride confirmation reason') }}"><img src="{{ asset('public/assets/admin/img/info-circle.svg') }}" alt="{{ translate('messages.ride_cancellation_reason') }}"></span>
                                    </label>
                                    <textarea name="title[]" id="" class="form-control" rows="1" placeholder="Type here" data-maxlength="150"></textarea>
                                    <div class="text-right fs-12 text_count">0/150</div>
                                    <input type="hidden" name="lang[]" value="default">
                                </div>
                            </div>
                            @if ($language)
                                @foreach (json_decode($language) as $lang)
                                    <div class="col-lg-4 col-md-6 d-none lang_form1" id="{{ $lang }}-form1">
                                        <div class="form-group mb-0">
                                            <label for="" class="form-label d-flex">
                                                <span class="line--limit-1">
                                                    {{ translate('messages.ride_cancellation_reason') }} ({{ strtoupper($lang) }})
                                                </span>
                                                <span class="form-label-secondary text-danger d-flex" data-toggle="tooltip" data-placement="right" data-original-title="{{ translate('Driver & Customer cancel ride confirmation reason') }}"><img src="{{ asset('public/assets/admin/img/info-circle.svg') }}" alt="{{ translate('messages.ride_cancellation_reason') }}"></span>
                                            </label>
                                            <textarea name="title[]" id="" class="form-control" rows="1" placeholder="Type here" data-maxlength="150"></textarea>
                                            <div class="text-right fs-12 text_count">0/150</div>
                                            <input type="hidden" name="lang[]" value="{{ $lang }}">
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group mb-0">
                                    <label for="" class="form-label d-flex">
                                        <span class="line--limit-1">
                                            {{ translate('messages.Cancellation_type') }}
                                        </span>
                                    </label>
                                    <select name="cancellation_type" id="" class="form-control js-select2-custom"
                                        data-placeholder="{{ translate('messages.Select_Cancellation_Type') }}">
                                        <option value="" selected disabled>{{ translate('messages.Select_Cancellation_Type') }}</option>
                                            @foreach(CANCELLATION_TYPE as $key=> $item)
                                                <option value="{{$key}}">{{translate($item)}}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group mb-0">
                                    <label for="" class="form-label d-flex">
                                        <span class="line--limit-1">
                                            {{ translate('messages.user_type') }}
                                        </span>
                                    </label>
                                    <select name="user_type" id="" class="form-control js-select2-custom"
                                        data-placeholder="{{ translate('messages.Select_user_type') }}">
                                        <option value="" selected disabled>{{ translate('messages.Select_user_type') }}</option>
                                        <option value="driver">{{translate('driver')}}</option>
                                        <option value="customer">{{translate('customer')}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="btn--container  justify-content-end">
                                    <button type="reset" id="reset_btn" class="btn btn--reset">{{ translate('messages.reset') }}</button>
                                    <button type="submit" class="btn btn--primary">{{ translate('messages.submit') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header py-2">
                <div class="search--button-wrapper justify-content-between gap-20px">
                    <h5 class="card-title text--title flex-grow-1">{{ translate('messages.ride_cancellation_reason_list') }}</h5>
                    <form class="search-form m-0 flex-grow-1 max-w-353px">

                        <div class="input-group input--group">
                            <input id="datatableSearch_" type="search" value="{{ request()?->search ?? null }}" name="search"
                                class="form-control"
                                placeholder="{{ translate('messages.Search by Vendor name, owner info...') }}"
                                aria-label="{{ translate('messages.Search by Vendor name, owner info...') }}">
                            <button type="submit" class="btn btn--secondary"><i class="tio-search"></i></button>

                        </div>

                    </form>
                    @if (request()->get('search'))
                    <button type="reset" class="btn btn--primary ml-2 location-reload-to-base"
                        data-url="{{ url()->full() }}">{{ translate('messages.reset') }}</button>
                    @endif
                </div>
            </div>

            <div class="table-responsive datatable-custom">
                <table id="columnSearchDatatable"
                    class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table text--title">
                    <thead class="thead-light">
                        <tr>
                            <th class="border-0">{{ translate('messages.SL') }}</th>
                            <th class="border-0">{{ translate('messages.Reason') }}</th>
                            <th class="border-0">{{ translate('messages.Cancellation_type') }}</th>
                            <th class="border-0">{{ translate('messages.User type') }}</th>
                            <th class="border-0 text-center">{{ translate('messages.status') }}</th>
                            <th class="border-0 text-center">{{ translate('messages.action') }}</th>
                        </tr>
                    </thead>

                    <tbody id="set-rows">
                        @foreach ($cancellationReasons as $key => $cancellationReason)
                        <tr>
                            <td>{{ $key + $cancellationReasons->firstItem() }}</td>
                            <td>
                                <div class="max-w-176px text-truncate">{{$cancellationReason->title}}</div>
                            </td>
                            <td>{{ CANCELLATION_TYPE[$cancellationReason->cancellation_type] }}</td>
                            <td>           
                                {{ $cancellationReason->user_type == 'driver' ? translate('driver') : translate('customer') }}
                            </td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <label class="toggle-switch toggle-switch-sm"
                                        for="stocksCheckbox{{ $cancellationReason->id }}">
                                        <input type="checkbox"
                                                data-url="{{ route('admin.business-settings.ride-fare.cancellation_reason.status', [$cancellationReason['id'], $cancellationReason->is_active ? 0 : 1]) }}"
                                            class="toggle-switch-input redirect-url"
                                            id="stocksCheckbox{{ $cancellationReason->id }}"
                                            {{ $cancellationReason->is_active ? 'checked' : '' }}>
                                        <span class="toggle-switch-label">
                                            <span class="toggle-switch-indicator"></span>
                                        </span>
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="btn--container justify-content-center">
                                    <a class="btn btn-sm btn--primary btn-outline-primary action-btn edit-reason"
                                        title="{{ translate('messages.edit') }}"
                                        data-toggle="modal"
                                        data-target="#add_update_reason_{{ $cancellationReason->id }}"><i
                                            class="tio-edit"></i>
                                    </a>

                                    <a class="btn btn-sm btn--danger btn-outline-danger action-btn form-alert"
                                        href="javascript:"
                                        data-id="order-cancellation-reason-{{ $cancellationReason['id'] }}"
                                        data-message="{{ translate('messages.If_you_want_to_delete_this_reason,_please_confirm_your_decision.') }}"
                                        title="{{ translate('messages.delete') }}">
                                        <i class="tio-delete-outlined"></i>
                                    </a>
                                    <form
                                        action="{{ route('admin.business-settings.ride-fare.cancellation_reason.delete', $cancellationReason['id']) }}"
                                        method="post" id="order-cancellation-reason-{{ $cancellationReason['id'] }}">
                                        @csrf @method('delete')
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="add_update_reason_{{$cancellationReason->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ translate('messages.ride_cancellation_reason') }}
                                            {{ translate('messages.Update') }}</label></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('admin.business-settings.ride-fare.cancellation_reason.update', ['id' => $cancellationReason?->id]) }}" method="post">
                                            <div class="modal-body">
                                                @csrf
                                                @method('put')

                                                @php($cancellationReason=  Modules\RideShare\Entities\BusinessManagement\CancellationReason::withoutGlobalScope('translate')->with('translations')->find($cancellationReason->id))
                                                @php($language=\App\Models\BusinessSetting::where('key','language')->first())
                                                @php($language = $language->value ?? null)
                                                @php($defaultLang = str_replace('_', '-', app()->getLocale()))
                                                <ul class="nav nav-tabs nav--tabs mb-3 border-0">
                                                    <li class="nav-item">
                                                        <a class="nav-link update-lang_link add_active active"
                                                        href="#"
                                                        id="default-link">{{ translate('Default') }}</a>
                                                    </li>
                                                    @if($language)
                                                    @foreach (json_decode($language) as $lang)
                                                        <li class="nav-item">
                                                            <a class="nav-link update-lang_link"
                                                                href="#"
                                                                data-reason-id="{{$cancellationReason->id}}"
                                                                id="{{ $lang }}-link">{{ \App\CentralLogics\Helpers::get_language_name($lang) . '(' . strtoupper($lang) . ')' }}</a>
                                                        </li>
                                                    @endforeach
                                                    @endif
                                                </ul>

                                                <div class="form-group mb-3 add_active_2  update-lang_form" id="default-form_{{$cancellationReason->id}}">
                                                    <label class="form-label">{{translate('Ride Cancellation Reason')}} ({{translate('messages.default')}}) </label>
                                                    <textarea class="form-control" name='title[]'>{{$cancellationReason?->getRawOriginal('title')}}</textarea>
                                                    <input type="hidden" name="lang[]" value="default">
                                                </div>
                                                @if($language)
                                                    @foreach(json_decode($language) as $lang)
                                                    <?php
                                                        if($cancellationReason?->translations){
                                                            $translate = [];
                                                            foreach($cancellationReason?->translations as $t)
                                                            {
                                                                if($t->locale == $lang && $t->key=="title"){
                                                                    $translate[$lang]['title'] = $t->value;
                                                                }
                                                            }
                                                        }

                                                        ?>
                                                        <div class="form-group mb-3 d-none update-lang_form" id="{{$lang}}-langform_{{$cancellationReason->id}}">
                                                            <label for="reason{{$lang}}" class="form-label">{{translate('Ride Cancellation Reason')}} ({{strtoupper($lang)}})</label>
                                                            <textarea id="reason{{$lang}}" class="form-control" name='title[]' placeholder="{{ translate('type_here') }}">{{ $translate[$lang]['title'] ?? null }}</textarea>
                                                            <input type="hidden" name="lang[]" value="{{$lang}}">
                                                        </div>
                                                    @endforeach
                                                @endif
                                                <div class="form-group mb-3">
                                                    <label for="" class="form-label d-flex">
                                                        <span class="line--limit-1">
                                                            {{ translate('messages.Cancellation_type') }}
                                                        </span>
                                                    </label>
                                                    <select name="cancellation_type" id="" class="form-control js-select2-custom"
                                                        data-placeholder="{{ translate('messages.Select_Cancellation_Type') }}">
                                                        <option value="" selected disabled>{{ translate('messages.Select_Cancellation_Type') }}</option>
                                                            @foreach(CANCELLATION_TYPE as $key=> $item)
                                                                <option value="{{$key}}" {{$cancellationReason->cancellation_type == $key ? 'selected' : ''}}>{{translate($item)}}</option>
                                                            @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group mb-0">
                                                    <label for="" class="form-label d-flex">
                                                        <span class="line--limit-1">
                                                            {{ translate('messages.user_type') }}
                                                        </span>
                                                    </label>
                                                    <select name="user_type" id="" class="form-control js-select2-custom"
                                                        data-placeholder="{{ translate('messages.Select_user_type') }}">
                                                        <option value="" selected disabled>{{ translate('messages.Select_user_type') }}</option>
                                                        <option value="driver" {{$cancellationReason->user_type == 'driver' ? 'selected' : ''}}>{{translate('driver')}}</option>
                                                        <option value="customer" {{$cancellationReason->user_type == 'customer' ? 'selected' : ''}}>{{translate('customer')}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ translate('Close') }}</button>
                                                <button type="submit" class="btn btn-primary">{{ translate('Save_changes') }}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

@endsection

@push('script_2')
    <script src="{{asset('public/assets/admin/js/view-pages/business-settings-order-page.js')}}"></script>
@endpush
