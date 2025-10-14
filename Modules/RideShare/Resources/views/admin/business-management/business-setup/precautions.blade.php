@extends('layouts.admin.app')

@section('title', translate('messages.Safety_&_Precaution'))

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
                        <span>{{ translate('messages.Safety_&_Precaution_Setup') }}</span>
                    </h1>
                </div>
            </div>
        </div>
        <div class="js-nav-scroller hs-nav-scroller-horizontal mb-4">
            @include('ride-share::admin.business-management.business-setup.partials.safety-precaution._safety-precaution-setup-inline')
        </div>


        <div class="card mb-4">
            <div class="card-body">
                <div class="row g-3 align-items-center">
                    <div class="col-lg-4">
                        <div>
                            <h4 class="text--title mb-0">
                                {{ translate('messages.Safety_Precautions') }}
                            </h4>
                            <p class="fs-12 mb-0">
                                {{ translate('messages.Define safety precaution contents that will appear for users and drivers in the app.') }}
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <form action="{{route('admin.business-settings.safety-precaution.precaution.store')}}" method="POST">
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
                                <div class="lang_form1 default-form1">
                                    <div class="form-group">
                                        <label for="" class="form-label d-flex">
                                            <span class="line--limit-1">
                                                {{ translate('messages.Title') }} ({{ translate('Default') }})
                                            </span>
                                            <span class="form-label-secondary text-danger d-flex" data-toggle="tooltip" data-placement="right" data-original-title="Add a short, clear title that represents the safety precautions shown to users and drivers."><img src="{{ asset('public/assets/admin/img/info-circle.svg') }}" alt="Prescription order status"></span>
                                        </label>
                                        <textarea name="title[]" id="" class="form-control" rows="1" placeholder="Type here safety precaution title" data-maxlength="150"></textarea>
                                        <div class="text-right fs-12 text_count">0/150</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="form-label d-flex">
                                            <span class="line--limit-1">
                                                {{ translate('messages.Description') }} ({{ translate('Default') }})
                                            </span>
                                            <span class="form-label-secondary text-danger d-flex" data-toggle="tooltip" data-placement="right" data-original-title="Describe the purpose or details for this safety precaution."><img src="{{ asset('public/assets/admin/img/info-circle.svg') }}" alt="Prescription order status"></span>
                                        </label>
                                        <textarea name="description[]" id="" class="form-control" rows="2" placeholder="Type description" data-maxlength="350"></textarea>
                                        <div class="text-right fs-12 text_count">0/350</div>
                                    </div>
                                    <input type="hidden" name="lang[]" value="default">
                                </div>
                                @if ($language)
                                    @foreach (json_decode($language) as $lang)
                                        <div class="d-none lang_form1" id="{{ $lang }}-form1">
                                            <div class="form-group">
                                                <label for="" class="form-label d-flex">
                                                    <span class="line--limit-1">
                                                        {{ translate('messages.Title') }} ({{ strtoupper($lang) }})
                                                    </span>
                                                    <span class="form-label-secondary text-danger d-flex" data-toggle="tooltip" data-placement="right" data-original-title="When this field is active  user can cancel an order with proper reason."><img src="{{ asset('public/assets/admin/img/info-circle.svg') }}" alt="Prescription order status"></span>
                                                </label>
                                                <textarea name="title[]" id="" class="form-control" rows="1" placeholder="Type here safety precaution title" data-maxlength="150"></textarea>
                                                <div class="text-right fs-12 text_count">0/150</div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="form-label d-flex">
                                                    <span class="line--limit-1">
                                                        {{ translate('messages.Description') }} ({{ strtoupper($lang) }})
                                                    </span>
                                                    <span class="form-label-secondary text-danger d-flex" data-toggle="tooltip" data-placement="right" data-original-title="When this field is active  user can cancel an order with proper reason."><img src="{{ asset('public/assets/admin/img/info-circle.svg') }}" alt="Prescription order status"></span>
                                                </label>
                                                <textarea name="description[]" id="" class="form-control" rows="2" placeholder="Type description" data-maxlength="350"></textarea>
                                                <div class="text-right fs-12 text_count">0/350</div>
                                            </div>
                                            <input type="hidden" name="lang[]" value="{{ $lang }}">
                                        </div>
                                    @endforeach
                                @endif

                                <div class="form-group d-flex align-items-center flex-wrap gap-3">
                                    <div class="form-check form-check-inline gap-2">
                                        <input class="form-check-input form-check-input--primary m-0" type="checkbox" id="inlineCheckbox0" value="{{ CUSTOMER }}" name="for_whom[]">
                                        <label class="form-check-label text--title" for="inlineCheckbox0">{{ translate('For Customer') }}</label>
                                    </div>
                                    <div class="form-check form-check-inline gap-2">
                                        <input class="form-check-input form-check-input--primary m-0" type="checkbox" id="inlineCheckbox1" value="{{ DRIVER }}" name="for_whom[]">
                                        <label class="form-check-label text--title" for="inlineCheckbox1">{{ translate('For Driver') }}</label>
                                    </div>
                                </div>
                                <div class="btn--container  justify-content-end">
                                    <button type="reset" id="reset_btn" class="btn btn--reset">{{ translate('messages.reset') }}</button>
                                    <button type="submit" class="btn btn--primary">{{ translate('messages.submit') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header py-2">
                <div class="search--button-wrapper justify-content-between gap-20px">
                    <h5 class="card-title text--title flex-grow-1">{{ translate('messages.Precautions_list') }}</h5>
                    {{-- <form class="search-form m-0 flex-grow-1 max-w-353px">

                        <div class="input-group input--group">
                            <input id="datatableSearch_" type="search" value="{{ request()?->search ?? null }}" name="search"
                                class="form-control"
                                placeholder="{{ translate('messages.Search by Vendor name, owner info...') }}"
                                aria-label="{{ translate('messages.Search by Vendor name, owner info...') }}">
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
                                href="{{ route('admin.rental.banner.export', ['type' => 'excel', request()->getQueryString()]) }}">
                                <img class="avatar avatar-xss avatar-4by3 mr-2"
                                    src="{{ asset('public/assets/admin') }}/svg/components/excel.svg" alt="Image Description">
                                {{ translate('messages.excel') }}
                            </a>
                            <a id="export-csv" class="dropdown-item"
                                href="{{ route('admin.rental.banner.export', ['type' => 'csv', request()->getQueryString()]) }}">
                                <img class="avatar avatar-xss avatar-4by3 mr-2"
                                    src="{{ asset('public/assets/admin') }}/svg/components/placeholder-csv-format.svg"
                                    alt="Image Description">
                                .{{ translate('messages.csv') }}
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
                            <th class="border-0">{{ translate('messages.For_Whom') }}</th>
                            <th class="border-0">{{ translate('messages.Title') }}</th>
                            <th class="border-0">{{ translate('messages.Description') }}</th>
                            <th class="border-0 text-center">{{ translate('messages.status') }}</th>
                            <th class="border-0 text-center">{{ translate('messages.action') }}</th>
                        </tr>
                    </thead>

                    <tbody id="set-rows">
                        @foreach($safetyPrecautions as $key => $safetyPrecaution)
                            <tr>
                                <td>{{ $key + $safetyPrecautions->firstItem() }}</td>
                                <td>{{ is_array($safetyPrecaution->for_whom) ? ucwords(implode(', ', $safetyPrecaution->for_whom)) : ucwords($safetyPrecaution->for_whom) }}</td>
                                <td>
                                    <div class="max-w-176px text-truncate">{{ ucwords($safetyPrecaution->title) }}</div>
                                </td>
                                <td>
                                    <div class="line--limit-2 max-349">
                                        {{ ucwords($safetyPrecaution->description) }}
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <label class="toggle-switch toggle-switch-sm" for="statusCheckbox{{$safetyPrecaution->id}}">
                                            <input type="checkbox"
                                            data-id="statusCheckbox{{$safetyPrecaution->id}}"
                                            data-type="status"
                                            data-image-on="{{ asset('/public/assets/admin/img/modal/basic_campaign_on.png') }}"
                                            data-image-off="{{ asset('/public/assets/admin/img/modal/basic_campaign_off.png') }}"
                                            data-title-on="{{ translate('Are you sure to turn On this Safety Precaution') }}"
                                            data-title-off="{{ translate('Are you sure to turn off this Safety Precaution') }}"
                                            data-text-on="<p>{{ translate('Once you turn On this Safety Precaution') . ', ' . translate('drivers will see this Safety Precaution.') }}</p>"
                                            data-text-off="<p>{{ translate('Once you turn off this Safety Precaution') . ', ' .translate('drivers will no longer see this Safety Precaution.')  }}</p>"
                                            class="toggle-switch-input  dynamic-checkbox" id="statusCheckbox{{$safetyPrecaution->id}}" {{$safetyPrecaution->is_active?'checked':''}}>
                                            <span class="toggle-switch-label">
                                                <span class="toggle-switch-indicator"></span>
                                            </span>
                                        </label>
                                        <form action="{{route('admin.business-settings.safety-precaution.precaution.status')}}" method="get" id="statusCheckbox{{$safetyPrecaution->id}}_form">
                                            <input type="hidden" name="status" value="{{$safetyPrecaution->is_active?0:1}}">
                                            <input type="hidden" name="id" value="{{$safetyPrecaution->id}}">
                                        </form>
                                    </div>
                                </td>
                                <td>
                                    <div class="btn--container justify-content-center">
                                        <a class="btn btn-sm btn--primary btn-outline-primary action-btn edit-reason"
                                            title="{{ translate('messages.edit') }}"
                                            data-toggle="modal"
                                            data-target="#add_update_reason_{{ $safetyPrecaution->id }}"><i
                                                class="tio-edit"></i>
                                        </a>

                                        <a class="btn btn-sm btn--danger btn-outline-danger action-btn form-alert"
                                            href="javascript:"
                                            data-id="order-cancellation-reason-{{ $safetyPrecaution['id'] }}"
                                            data-message="{{ translate('messages.If_you_want_to_delete_this_reason,_please_confirm_your_decision.') }}"
                                            title="{{ translate('messages.delete') }}">
                                            <i class="tio-delete-outlined"></i>
                                        </a>
                                        <form
                                            action="{{ route('admin.business-settings.safety-precaution.precaution.delete', $safetyPrecaution['id']) }}"
                                            method="post" id="order-cancellation-reason-{{ $safetyPrecaution['id'] }}">
                                            @csrf @method('delete')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="add_update_reason_{{$safetyPrecaution->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ translate('messages.safety_precaution') }}
                                            {{ translate('messages.Update') }}</label></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('admin.business-settings.safety-precaution.precaution.update', ['id' => $safetyPrecaution?->id]) }}" method="post">
                                        <div class="modal-body">
                                            @csrf

                                            @php($safetyPrecaution=  Modules\RideShare\Entities\BusinessManagement\SafetyPrecaution::withoutGlobalScope('translate')->with('translations')->find($safetyPrecaution->id))
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
                                                            data-reason-id="{{$safetyPrecaution->id}}"
                                                            id="{{ $lang }}-link">{{ \App\CentralLogics\Helpers::get_language_name($lang) . '(' . strtoupper($lang) . ')' }}</a>
                                                    </li>
                                                @endforeach
                                                @endif
                                            </ul>
                                            <div class="add_active_2  update-lang_form" id="default-form_{{$safetyPrecaution->id}}">
                                                <div class="form-group">
                                                    <label for="" class="form-label d-flex">
                                                        <span class="line--limit-1">
                                                            {{ translate('messages.Title') }} ({{ translate('Default') }})
                                                        </span>
                                                        <span class="form-label-secondary text-danger d-flex" data-toggle="tooltip" data-placement="right" data-original-title="When this field is active  user can cancel an order with proper reason."><img src="{{ asset('public/assets/admin/img/info-circle.svg') }}" alt="Prescription order status"></span>
                                                    </label>
                                                    <textarea name="title[]" id="" class="form-control" rows="1" placeholder="Type here safety precaution title" data-maxlength="150">{{$safetyPrecaution?->getRawOriginal('title')}}</textarea>
                                                    <div class="text-right fs-12 text_count">0/150</div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="" class="form-label d-flex">
                                                        <span class="line--limit-1">
                                                            {{ translate('messages.Description') }} ({{ translate('Default') }})
                                                        </span>
                                                        <span class="form-label-secondary text-danger d-flex" data-toggle="tooltip" data-placement="right" data-original-title="When this field is active  user can cancel an order with proper reason."><img src="{{ asset('public/assets/admin/img/info-circle.svg') }}" alt="Prescription order status"></span>
                                                    </label>
                                                    <textarea name="description[]" id="" class="form-control" rows="2" placeholder="Type description" data-maxlength="350">{{$safetyPrecaution?->getRawOriginal('description')}}</textarea>
                                                    <div class="text-right fs-12 text_count">0/350</div>
                                                </div>
                                                <input type="hidden" name="lang[]" value="default">
                                            </div>
                                            @if ($language)
                                                @foreach (json_decode($language) as $lang)

                                                    <?php
                                                        if($safetyPrecaution?->translations){
                                                            $translate = [];
                                                            foreach($safetyPrecaution?->translations as $t)
                                                            {
                                                                if($t->locale == $lang && $t->key=="title"){
                                                                    $translate[$lang]['title'] = $t->value;
                                                                }
                                                                if($t->locale == $lang && $t->key=="description"){
                                                                    $translate[$lang]['description'] = $t->value;
                                                                }
                                                            }
                                                        }

                                                    ?>

                                                    <div class="d-none update-lang_form" id="{{$lang}}-langform_{{$safetyPrecaution->id}}">
                                                        <div class="form-group">
                                                            <label for="" class="form-label d-flex">
                                                                <span class="line--limit-1">
                                                                    {{ translate('messages.Title') }} ({{ strtoupper($lang) }})
                                                                </span>
                                                                <span class="form-label-secondary text-danger d-flex" data-toggle="tooltip" data-placement="right" data-original-title="When this field is active  user can cancel an order with proper title."><img src="{{ asset('public/assets/admin/img/info-circle.svg') }}" alt="Prescription order status"></span>
                                                            </label>
                                                            <textarea name="title[]" id="" class="form-control" rows="1" placeholder="Type here safety precaution title" data-maxlength="150">{{ $translate[$lang]['title'] ?? null }}</textarea>
                                                            <div class="text-right fs-12 text_count">0/150</div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="" class="form-label d-flex">
                                                                <span class="line--limit-1">
                                                                    {{ translate('messages.Description') }} ({{ strtoupper($lang) }})
                                                                </span>
                                                                <span class="form-label-secondary text-danger d-flex" data-toggle="tooltip" data-placement="right" data-original-title="When this field is active  user can cancel an order with proper description."><img src="{{ asset('public/assets/admin/img/info-circle.svg') }}" alt="Prescription order status"></span>
                                                            </label>
                                                            <textarea name="description[]" id="" class="form-control" rows="2" placeholder="Type description" data-maxlength="350">{{ $translate[$lang]['description'] ?? null }}</textarea>
                                                            <div class="text-right fs-12 text_count">0/350</div>
                                                        </div>
                                                        <input type="hidden" name="lang[]" value="{{ $lang }}">
                                                    </div>
                                                @endforeach
                                            @endif
                                            <div class="form-group d-flex align-items-center flex-wrap gap-3">
                                                <div class="form-check form-check-inline gap-2">
                                                    <input class="form-check-input form-check-input--primary m-0" type="checkbox" {{ in_array(CUSTOMER, $safetyPrecaution->for_whom) ? 'checked' : '' }} id="inlineCheckbox3" value="{{ CUSTOMER }}" name="for_whom[]">
                                                    <label class="form-check-label text--title" for="inlineCheckbox3">{{ translate('For Customer') }}</label>
                                                </div>
                                                <div class="form-check form-check-inline gap-2">
                                                    <input class="form-check-input form-check-input--primary m-0" type="checkbox" {{ in_array(DRIVER, $safetyPrecaution->for_whom) ? 'checked' : '' }} id="inlineCheckbox4" value="{{ DRIVER }}" name="for_whom[]">
                                                    <label class="form-check-label text--title" for="inlineCheckbox4">{{ translate('For Driver') }}</label>
                                                </div>
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

@endsection

@push('script_2')
    <script src="{{asset('public/assets/admin/js/view-pages/business-settings-order-page.js')}}"></script>
@endpush
