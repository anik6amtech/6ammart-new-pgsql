<div class="accordion mb-30" id="accordionExample">
    @if($faqs->count() < 1)
        <div class="empty--data">
            <img src="{{asset('/public/assets/admin/svg/illustrations/sorry.svg')}}" alt="{{translate('FAQ')}}">
            <h5>
                {{translate('no_data_found')}}
            </h5>
        </div>
    @endif
    @foreach($faqs as $faq)
        <div class="card rounded overflow-hidden mb-4" data-bg-color="#F9F9F9">
            <div class="card-header" id="headingOne" data-bg-color="#F9F9F9">
                <div class="mb-0 d-flex align-items-center justify-content-between gap-2 w-100 flex-sm-nowrap flex-wrap">
                    <button class="btn p-0 btn-link btn-block text-left font-semibold text-title d-flex align-items-center gap-2 text-wrap" type="button" data-toggle="collapse" data-target="#collapse-{{$faq->id}}" aria-expanded="false" aria-controls="collapse-{{$faq->id}}">
                        <i class="tio-down-ui fs-16 text-title faq-icon"></i>
                        {{$faq->question}}
                    </button>
                    <div class="d-flex gap-3">

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

@endonce


