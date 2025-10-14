@extends('service::provider.layouts.app')

@section('title', translate('messages.Notification Channel Setup'))

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header pb-0 d-flex align-items-sm-center align-items-start gap-2 justify-content-between mb-20">
            <div class="d-flex gap-2">
                <img width="24" height="24" src="{{asset('/public/assets/admin/img/notify.png')}}" alt="img">
                <div class="">
                    <h2 class="page-header-title mb-1">{{translate('messages.Notification Channel Setup')}}</h2>
                    <p class="fs-14 mb-0">{{ translate('From here you setup what types of notification you can receive from') }} {{ $business_name }}</p>
                </div>
            </div>
            <div class="text--primary-2 d-flex flex-wrap align-items-center" type="button" data-toggle="modal"
                 data-target="#notiifcation-how-it-works">
                <div class="blinkings">
                    <span data-toggle="tooltip" data-placement="right" data-original-title="{{translate('messages.Manage how you receive system notifications for various activities and updates.')}}"><i class="tio-info-outined"></i></span>
                </div>
            </div>
        </div>

        <!-- Nav -->
        <div class="js-nav-scroller hs-nav-scroller-horizontal">
            <ul class="nav nav-tabs border-0 gap-4 nav--tabs tabs__style-border mb-4">
                <li class="nav-item">
                    <a class="nav-link {{ $type != 'serviceman' ? 'active' : '' }}"
                       href="{{ route('provider.service.get-notification-setting') }}">
                        {{ translate('Notification For You') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $type == 'serviceman' ? 'active' : '' }}"
                       href="{{ route('provider.service.get-notification-setting', ['type' => 'serviceman']) }}">
                        {{ translate('Serviceman') }}
                    </a>
                </li>
            </ul>

        </div>
        <div class="tab-content" id="myTabContent">
            <!-- Notification For You -->
            <div class="tab-pane fade show active" id="home-details1" role="tabpanel" aria-labelledby="home-tab-details1">
                <div class="card">
{{--                    <div--}}
{{--                        class="data-table-top border-bottom d-flex align-items-center flex-wrap gap-3 justify-content-between p-3">--}}
{{--                        <h4 class="text-title mb-0">Notifications</h4>--}}
{{--                        <div class="d-flex flex-wrap align-items-center gap-3">--}}
{{--                            <form action="#0" method="GET">--}}
{{--                                <div class="input-group input-group-custom input-group-merge">--}}
{{--                                    <input id="datatableSearch_" type="search" name="search" class="form-control"--}}
{{--                                           placeholder="Search by topics name" aria-label="Search by topics name" value=""--}}
{{--                                           required="">--}}
{{--                                    <button type="submit" class="btn btn--primary input-group-text"><i--}}
{{--                                            class="tio-search fz-15px"></i></button>--}}
{{--                                </div>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="">
                        <div class="table-responsive">
                            <table
                                class="font-size-sm table table-borderless table-thead-bordered table-align-middle card-table">
                                <thead class="thead-light table-nowrap">
                                <tr>
                                    <th>{{translate('Sl')}}</th>
                                    <th>{{translate('Topics')}}</th>
                                    <th class="text-center">{{translate('Push Notification')}}</th>
                                    <th class="text-center">{{translate('Mail')}}</th>
                                    <th class="text-center">{{translate('SMS')}}</th>
                                </tr>
                                </thead>

                                <tbody>
                                @forelse($data as $key => $item)
                                    @php($item_admin_data = \App\CentralLogics\Helpers::getNotificationStatusDataAdmin('provider',$item->key,'service'))
                                <tr>
                                    <td>{{ $key +1 }}</td>
                                    <td>
                                        <h5 class="text-capitalize">{{ translate($item->title) }}</h5>
                                        <div class="white-space-initial text-capitalize max-w-400px">
                                            {{ translate($item->sub_title) }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <div>
                                                @if($item_admin_data?->push_notification_status == 'disable')
                                                    <span class="badge badge-pill badge--info"> {{ translate('N/A') }}</span>
                                                @elseif($item_admin_data?->push_notification_status == 'inactive')
                                                    <label class="toggle-switch toggle-switch-sm" data-toggle="tooltip" title="{{ translate('This_notification_turned_off_by_admin.')  }}">
                                                        <input type="checkbox"
                                                               class="status toggle-switch-input dynamic-checkbox"  disabled>
                                                        <span class="toggle-switch-label text">
                                                            <span class="toggle-switch-indicator"></span>
                                                        </span>
                                                    </label>
                                                @else
                                                    <label class="toggle-switch toggle-switch-sm" data-toggle="tooltip" title=""
                                                           @if ($item->push_notification_status  == 'active')
                                                                data-original-title="{{ translate('Turn_Off_push_notification_for') .' '.translate($item->title)  }}"
                                                           @else
                                                               data-original-title="{{ translate('Turn_On_push_notification_for') .' '.translate($item->title)  }}"
                                                           @endif>
                                                        <input type="checkbox" data-type="toggle" id="push_notification_{{$item->key == 'terms_&_conditions_update' ? 'terms_and_conditions_update' : $item->key}}"
                                                               data-id="push_notification_{{$item->key == 'terms_&_conditions_update' ? 'terms_and_conditions_update' : $item->key}}"
                                                               data-image-on="{{asset('public/assets/admin/img/modal/mail-success.png')}}"
                                                               data-image-off="{{asset('public/assets/admin/img/modal/mail-warning.png')}}"
                                                               data-title-on="{{ translate('Want to enable the Push Notification For') .' '.  translate($item->title) }}  ?"
                                                               data-title-off="{{ translate('Want to disable the Push Notification For') .' '.  translate($item->title) }} ?"
                                                               data-text-on="<p>{{ translate('Push Notification Will Be Enabled For')  .' '.  translate($item->title) }}</p>"
                                                               data-text-off="<p>{{ translate('Push Notification Will Be disabled For')  .' '.  translate($item->title) }}</p>"
                                                               class="status toggle-switch-input dynamic-checkbox" {{ $item->push_notification_status  == 'active' ? 'checked' : '' }}>
                                                        <span class="toggle-switch-label text">
                                                            <span class="toggle-switch-indicator"></span>
                                                        </span>
                                                    </label>
                                                    <form action="{{route('provider.service.set-notification-setting',['user_type'=> $type,'key'=> $item->key  ,'type' => 'push_notification'])}}"
                                                        method="get" id="push_notification_{{$item->key == 'terms_&_conditions_update' ? 'terms_and_conditions_update' : $item->key}}_form">
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <div>
                                                @if($item_admin_data?->mail_status == 'disable')
                                                    <span class="badge badge-pill badge--info"> {{ translate('N/A') }}</span>
                                                @elseif($item_admin_data?->mail_status == 'inactive')
                                                    <label class="toggle-switch toggle-switch-sm" data-toggle="tooltip" title="{{ translate('This_notification_turned_off_by_admin.') }}">
                                                        <input type="checkbox" class="status toggle-switch-input dynamic-checkbox" disabled>
                                                        <span class="toggle-switch-label text">
                                                            <span class="toggle-switch-indicator"></span>
                                                        </span>
                                                    </label>
                                                @else
                                                    <label class="toggle-switch toggle-switch-sm" data-toggle="tooltip"
                                                           @if ($item->mail_status  == 'active')
                                                               title="{{ translate('Turn_Off_Mail_for') .' '.translate($item->title) }}"
                                                           @else
                                                               title="{{ translate('Turn_On_Mail_for') .' '.translate($item->title) }}"
                                                        @endif>
                                                        <input type="checkbox"
                                                               data-type="toggle"
                                                               id="mail_{{$item->key}}"
                                                               data-id="mail_{{$item->key}}"
                                                               data-image-on="{{asset('public/assets/admin/img/modal/mail-success.png')}}"
                                                               data-image-off="{{asset('public/assets/admin/img/modal/mail-warning.png')}}"
                                                               data-title-on="{{ translate('Want to enable the Mail For') .' '.translate($item->title) }}?"
                                                               data-title-off="{{ translate('Want to disable the Mail For') .' '.translate($item->title) }}?"
                                                               data-text-on="<p>{{ translate('Mail Will Be Enabled For') .' '.translate($item->title) }}</p>"
                                                               data-text-off="<p>{{ translate('Mail Will Be disabled For') .' '.translate($item->title) }}</p>"
                                                               class="status toggle-switch-input dynamic-checkbox"
                                                            {{ $item->mail_status  == 'active' ? 'checked' : '' }}>
                                                        <span class="toggle-switch-label text">
                                                            <span class="toggle-switch-indicator"></span>
                                                        </span>
                                                    </label>
                                                    <form action="{{route('provider.service.set-notification-setting',['user_type'=> $type,'key'=> $item->key ,'type' => 'mail'])}}"
                                                          method="get" id="mail_{{$item->key}}_form">
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <div>
                                                @if($item_admin_data?->sms_status == 'disable')
                                                    <span class="badge badge-pill badge--info"> {{ translate('N/A') }}</span>
                                                @elseif($item_admin_data?->sms_status == 'inactive')
                                                    <label class="toggle-switch toggle-switch-sm" data-toggle="tooltip" title="{{ translate('This_notification_turned_off_by_admin.') }}">
                                                        <input type="checkbox" class="status toggle-switch-input dynamic-checkbox" disabled>
                                                        <span class="toggle-switch-label text">
                                                            <span class="toggle-switch-indicator"></span>
                                                        </span>
                                                    </label>
                                                @else
                                                    <label class="toggle-switch toggle-switch-sm" data-toggle="tooltip"
                                                           @if ($item->sms_status  == 'active')
                                                               title="{{ translate('Turn_Off_SMS_for') .' '.translate($item->title) }}"
                                                           @else
                                                               title="{{ translate('Turn_On_SMS_for') .' '.translate($item->title) }}"
                                                        @endif>
                                                        <input type="checkbox"
                                                               data-type="toggle"
                                                               id="sms_{{$item->key}}"
                                                               data-id="sms_{{$item->key}}"
                                                               data-image-on="{{asset('public/assets/admin/img/modal/mail-success.png')}}"
                                                               data-image-off="{{asset('public/assets/admin/img/modal/mail-warning.png')}}"
                                                               data-title-on="{{ translate('Want to enable the SMS For') .' '.translate($item->title) }}?"
                                                               data-title-off="{{ translate('Want to disable the SMS For') .' '.translate($item->title) }}?"
                                                               data-text-on="<p>{{ translate('SMS Will Be Enabled For') .' '.translate($item->title) }}</p>"
                                                               data-text-off="<p>{{ translate('SMS Will Be disabled For') .' '.translate($item->title) }}</p>"
                                                               class="status toggle-switch-input dynamic-checkbox"
                                                            {{ $item->sms_status  == 'active' ? 'checked' : '' }}>
                                                        <span class="toggle-switch-label text">
                                                            <span class="toggle-switch-indicator"></span>
                                                        </span>
                                                    </label>
                                                    <form action="{{route('provider.service.set-notification-setting',['user_type'=> $type,'key'=> $item->key ,'type' => 'sms'])}}"
                                                          method="get" id="sms_{{$item->key}}_form">
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            <div class="text-capitalize">{{ translate('No data found') }}</div>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
