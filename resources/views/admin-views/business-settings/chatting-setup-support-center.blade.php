@extends('layouts.admin.app')

@section('title', translate('messages.Support_Center_Chatting_Setup'))

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-header-title mr-3">
                <span class="page-header-icon">
                    <img src="{{ asset('public/assets/admin/img/business.png') }}" class="w--26" alt="">
                </span>
                <span>
                    {{translate('business_setup')}}
                </span>
            </h1>
            @include('admin-views.business-settings.partials.nav-menu')
        </div>
        <!-- Page Header -->

        @include('admin-views.business-settings.partials.chatting-setup-menu')

        <!-- End Page Header -->


        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between gap-2">
                <div class="w-0 flex-grow-1">
                    <h5 class="mb-2 text-capitalize">{{ translate('Support Saved Replies') }}</h5>
                    <div class="fs-12">
                        {{ translate('Here admin can save some predefined replies for common questions asked by driver to reply in chat') }}
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row g-3 align-items-center">
                    <div class="col-lg-4">
                        <div>
                            <h4 class="text--title mb-0">
                                {{ translate('messages.Setup Answer & Topics') }}
                            </h4>
                            <p class="fs-12 mb-0">
                                {{ translate('messages.Here you can set predefine answer & the topics for the answer that will help when anyone reply any common topics.') }}
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <form action="{{route('admin.business-settings.chatting-setup.support-center.store')}}" method="POST">
                            @csrf
                            <div class="__bg-FAFAFA p-20 rounded-10">

                                <div class="lang_form1 default-form1">
                                    <div class="form-group">
                                        <label for="topic" class="form-label d-flex">
                                            <span class="line--limit-1">
                                                {{ translate('messages.Topic') }}
                                            </span>
                                            <span class="form-label-secondary text-danger d-flex" data-toggle="tooltip" data-placement="right" data-original-title="You can ask topic here"><img src="{{ asset('public/assets/admin/img/info-circle.svg') }}" alt="Topic"></span>
                                        </label>
                                        <textarea name="topic" id="topic" class="form-control" rows="1" placeholder="Type your topic here" data-maxlength="150"></textarea>
                                        <div class="text-right fs-12 text_count">0/150</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="answer" class="form-label d-flex">
                                            <span class="line--limit-1">
                                                {{ translate('messages.Answer') }}
                                            </span>
                                            <span class="form-label-secondary text-danger d-flex" data-toggle="tooltip" data-placement="right" data-original-title="Type answer here"><img src="{{ asset('public/assets/admin/img/info-circle.svg') }}" alt="Prescription order status"></span>
                                        </label>
                                        <textarea name="answer" id="answer" class="form-control" rows="2" placeholder="Type answer" data-maxlength="350"></textarea>
                                        <div class="text-right fs-12 text_count">0/350</div>
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
                    <h5 class="card-title text--title flex-grow-1">{{ translate('messages.Topics & Answer List') }}</h5>
                </div>
            </div>

            <div class="table-responsive datatable-custom">
                <table id="columnSearchDatatable"
                    class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table text--title">
                    <thead class="thead-light">
                        <tr>
                            <th class="border-0">{{ translate('messages.SL') }}</th>
                            <th class="border-0">{{ translate('messages.Topic') }}</th>
                            <th class="border-0">{{ translate('messages.Answer') }}</th>
                            <th class="border-0 text-center">{{ translate('messages.status') }}</th>
                            <th class="border-0 text-center">{{ translate('messages.action') }}</th>
                        </tr>
                    </thead>

                    <tbody id="set-rows">
                        @foreach($savedReplies as $key => $savedReply)
                            <tr>
                                <td>{{ $key + $savedReplies->firstItem() }}</td>
                                <td>
                                    <div class="max-w-176px text-truncate">{{ $savedReply->topic }}</div>
                                </td>
                                <td>
                                    <div class="line--limit-2 max-349">
                                        {{ $savedReply->answer }}
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <label class="toggle-switch toggle-switch-sm" for="statusCheckbox{{$savedReply->id}}">
                                            <input type="checkbox"
                                            data-id="statusCheckbox{{$savedReply->id}}"
                                            data-type="status"
                                            data-image-on="{{ asset('/public/assets/admin/img/modal/basic_campaign_on.png') }}"
                                            data-image-off="{{ asset('/public/assets/admin/img/modal/basic_campaign_off.png') }}"
                                            data-title-on="{{ translate('Are you sure to turn On this Topic & Answer') }}"
                                            data-title-off="{{ translate('Are you sure to turn off this Topic & Answer') }}"
                                            data-text-on="<p>{{ translate('Once you turn On this Topic & Answer') . ', ' . translate('the support section will see this Topic & Answer.') }}</p>"
                                            data-text-off="<p>{{ translate('Once you turn off this Topic & Answer') . ', ' .translate('the support section will no longer see this Topic & Answer.')  }}</p>"
                                            class="toggle-switch-input  dynamic-checkbox" id="statusCheckbox{{$savedReply->id}}" {{$savedReply->is_active?'checked':''}}>
                                            <span class="toggle-switch-label">
                                                <span class="toggle-switch-indicator"></span>
                                            </span>
                                        </label>
                                        <form action="{{route('admin.business-settings.chatting-setup.support-center.status')}}" method="get" id="statusCheckbox{{$savedReply->id}}_form">
                                            <input type="hidden" name="status" value="{{$savedReply->is_active?0:1}}">
                                            <input type="hidden" name="id" value="{{$savedReply->id}}">
                                        </form>
                                    </div>
                                </td>
                                <td>
                                    <div class="btn--container justify-content-center">
                                        <a class="btn btn-sm btn--primary btn-outline-primary action-btn edit-reason"
                                            title="{{ translate('messages.edit') }}"
                                            data-toggle="modal"
                                            data-target="#add_update_reason_{{ $savedReply->id }}"><i
                                                class="tio-edit"></i>
                                        </a>

                                        <a class="btn btn-sm btn--danger btn-outline-danger action-btn form-alert"
                                            href="javascript:"
                                            data-id="order-cancellation-reason-{{ $savedReply['id'] }}"
                                            data-message="{{ translate('messages.If_you_want_to_delete_this_Topic & Answer,_please_confirm_your_decision.') }}"
                                            title="{{ translate('messages.delete') }}">
                                            <i class="tio-delete-outlined"></i>
                                        </a>
                                        <form
                                            action="{{ route('admin.business-settings.chatting-setup.support-center.delete', $savedReply['id']) }}"
                                            method="post" id="order-cancellation-reason-{{ $savedReply['id'] }}">
                                            @csrf @method('delete')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="add_update_reason_{{$savedReply->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ translate('messages.Edit Topic & Answer') }}
                                            {{ translate('messages.Update') }}</label></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('admin.business-settings.chatting-setup.support-center.update', ['id' => $savedReply->id]) }}" method="post">
                                        <div class="modal-body">
                                            @csrf

                                            <div class="add_active_2  update-lang_form" id="default-form_{{$savedReply->id}}">
                                                <div class="form-group">
                                                    <label for="" class="form-label d-flex">
                                                        <span class="line--limit-1">
                                                            {{ translate('messages.Topic') }}<span class="text-danger">*</span>
                                                        </span>
                                                        <span class="form-label-secondary text-danger d-flex" data-toggle="tooltip" data-placement="right" data-original-title="You can ask Topic here"><img src="{{ asset('public/assets/admin/img/info-circle.svg') }}" alt="Topic"></span>
                                                    </label>
                                                    <textarea name="topic" id="" class="form-control" rows="1" placeholder="Type topic here" data-maxlength="150" required>{{ $savedReply->topic }}</textarea>
                                                    <div class="text-right fs-12 text_count">0/150</div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="" class="form-label d-flex">
                                                        <span class="line--limit-1">
                                                            {{ translate('messages.Answer') }}<span class="text-danger">*</span>
                                                        </span>
                                                        <span class="form-label-secondary text-danger d-flex" data-toggle="tooltip" data-placement="right" data-original-title="Type answer here"><img src="{{ asset('public/assets/admin/img/info-circle.svg') }}" alt="Prescription order status"></span>
                                                    </label>
                                                    <textarea name="answer" id="" class="form-control" rows="2" placeholder="Type description" data-maxlength="350">{{ $savedReply?->answer }}</textarea>
                                                    <div class="text-right fs-12 text_count">0/350</div>
                                                </div>
                                                <input type="hidden" name="lang[]" value="default">
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
                @if (count($savedReplies) === 0)
                    <div class="empty--data">
                        <img src="{{ asset('/public/assets/admin/svg/illustrations/sorry.svg') }}" alt="public">
                        <h5>
                            {{ translate('no_data_found') }}
                        </h5>
                    </div>
                @endif
            </div>
        </div>

    </div>
@endsection
