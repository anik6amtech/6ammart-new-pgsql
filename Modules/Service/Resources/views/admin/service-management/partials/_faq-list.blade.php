<div class="accordion mb-30" id="accordionExample">
    @if($faqs->count() < 1)
        <div class="text-center p-4">
            <div class="empty--data">
                <img src="{{asset('/public/assets/admin/svg/illustrations/sorry.svg')}}" alt="public">
                <h5>
                    {{translate('no_data_found')}}
                </h5>
            </div>
        </div>
    @endif
    @foreach($faqs as $faq)
        <form action="{{route('admin.service.service.faq.update',[$faq->service_id, $faq->id])}}" method="POST" class="mb-2 mt-30 service-edit-form"
              id="edit-{{$faq->id}}" style="display: none;">
            @csrf
            @method('PUT')
            <div class="row g-4">
                <div class="col-12">
                    <label>{{translate('question')}}</label>
                    <input type="text" class="form-control" placeholder="{{translate('question')}}" name="question"
                        value="{{$faq->question}}"
                        required="">
                </div>
                <div class="col-12">
                    <label>{{translate('answer')}}</label>
                    <textarea class="form-control" placeholder="{{translate('answer')}}"
                            name="answer">{{$faq->answer}}</textarea>
                </div>
            </div>
            <div class="btn--container justify-content-end mt-20">
                <button type="submit" class="btn min-w-120 btn--primary service-faq-update"
                        data-id="edit-{{$faq->id}}">
                    {{translate('update_faq')}}
                </button>
            </div>
        </form>

        <div class="card rounded overflow-hidden mb-4" data-bg-color="#F9F9F9">
            <div class="card-header" id="headingOne" data-bg-color="#F9F9F9">
                <div class="mb-0 d-flex align-items-center justify-content-between gap-2 w-100 flex-sm-nowrap flex-wrap">
                    <button class="btn p-0 btn-link btn-block text-left font-semibold text-title d-flex align-items-center gap-2 text-wrap" type="button" data-toggle="collapse" data-target="#collapse-{{$faq->id}}" aria-expanded="false" aria-controls="collapse-{{$faq->id}}">
                        <i class="tio-down-ui fs-16 text-title faq-icon"></i>
                        {{$faq->question}}
                    </button>
                    <div class="d-flex gap-3">
                        {{-- <label class="toggle-switch toggle-switch-sm" for="stocksCheckbox8">
                            <input type="checkbox" data-url="#0" class="toggle-switch-input redirect-url" id="stocksCheckbox8" checked="">
                            <span class="toggle-switch-label">
                                <span class="toggle-switch-indicator"></span>
                            </span>
                        </label> --}}
                        <label class="toggle-switch toggle-switch-sm" for="statusCheckbox{{$faq->id}}">
                            <input type="checkbox"
                            data-id="statusCheckbox{{$faq->id}}"
                            data-type="status"
                            data-image-on="{{ asset('/public/assets/admin/img/modal/basic_campaign_on.png') }}"
                            data-image-off="{{ asset('/public/assets/admin/img/modal/basic_campaign_off.png') }}"
                            data-title-on="{{ translate('By_Turning_ON_faq!') }}"
                            data-title-off="{{ translate('By_Turning_OFF_faq!') }}"
                            data-text-on="<p>{{ translate('If_you_turn_on_this_status,_it_will_show_on_user_app.') }}</p>"
                            data-text-off="<p>{{ translate('If_you_turn_off_this_status,_it_won’t_show_on_user_app') }}</p>"
                            class="toggle-switch-input  dynamic-checkbox" id="statusCheckbox{{$faq->id}}" {{$faq->is_active?'checked':''}}>
                            <span class="toggle-switch-label">
                                <span class="toggle-switch-indicator"></span>
                            </span>
                        </label>
                        <form action="{{route('admin.service.service.faq.status-update',['service_id' => $faq->service_id, 'id' => $faq->id, 'status' => $faq->is_active?0:1])}}"
                        method="get" id="statusCheckbox{{$faq->id}}_form">
                            <input type="hidden" name="status" value="{{$faq->is_active?0:1}}">
                            <input type="hidden" name="id" value="{{$faq->id}}">
                        </form>
                        <a href="#0" type="button" class="action-btn btn--info btn-outline-info show-service-edit-section"
                            style="--size: 30px"
                            data-id="{{$faq->id}}"
                            >
                            <i class="tio-edit"></i>
                        </a>
                        {{-- <a href="#0" type="button"
                            class="btn action-btn btn-outline-danger faq-list-ajax-delete"
                            style="--size: 30px" data-route="{{route('admin.service.service.faq.delete',[$faq->service_id, $faq->id])}}">
                            <i class="tio-delete"></i>
                        </a> --}}
                        <a href="javascript:" type="button"
                            class="btn action-btn btn-outline-danger btn-danger form-alert"
                            style="--size: 30px" data-id="delete-{{ $faq->id }}" data-message="{{ translate('Want to delete this ?') }}">
                            <i class="tio-delete"></i>
                        </a>

                        <form action="{{ route('admin.service.service.faq.delete', [$faq->service_id, $faq->id]) }}"
                                                    id="delete-{{ $faq->id }}" method="post" >
                            @csrf @method('delete')
                        </form>
                    </div>
                </div>
            </div>
            <div id="collapse-{{$faq->id}}" class="collapse {{ ($loop->first) ? 'show' : '' }}" aria-labelledby="headingOne" data-parent="#faq-list">
                <div class="card-body bg-white">
                    <p class="fs-14 text-title opacity-70 mb-0">
                        {{$faq->answer}}
                    </p>
                </div>
            </div>
        </div>
    @endforeach
</div>

@once
    <script>
        /* $(".faq-list-ajax-delete").on('click', function (){
            let route = $(this).data('route');
            ajax_delete(route)
        });  */
    </script>
@endonce


