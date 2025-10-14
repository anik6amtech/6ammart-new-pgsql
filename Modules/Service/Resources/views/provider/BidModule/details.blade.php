@extends('service::provider.layouts.app')

@section('title',translate('Request Details'))

@section('content')

    <div class="content container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-wrap mb-3 d-flex align-items-center justify-content-between">
                    <h2 class="page-title">{{translate('Request Details')}}</h2>

                    <div class=""><i class="tio-info ripple-animation" data-toggle="modal" data-target="#alertModal"></i></div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-lg-6">
                                <div class="card bg-light shadow-none">
                                    <div class="card-body pb-5">
                                        <div class="media flex-wrap gap-3">
                                            <img width="140" style="max-height: 200px;" class="radius-10 object-fit-cover"
                                                 src="{{$post?->customer?->image_full_url}}"
                                                 alt="{{ translate('profile_image') }}">
                                            <div class="media-body">
                                                <div class="d-flex gap-2 mb-3">
                                                    <i class="tio-user"></i>
                                                    <h4>{{translate('Customer Information')}}</h4>
                                                </div>
                                                <h5 class="text-primary mb-2">{{$post?->customer?->f_name.' '.$post?->customer?->l_name}}</h5>

                                                <div class="fs-12 text-muted">0.8km away from you</div>

                                                <p class="text-muted fs-12">
                                                    @if($distance)
                                                        {{$distance}} {{translate('away from you')}}
                                                    @endif
                                                </p>
                                                <div class="d-flex align-items-center gap-2 mb-2">
                                                    <i class="tio-call"></i>
                                                    <a href="tel:{{$post?->customer?->phone}}">{{$post?->customer?->phone}}</a>
                                                </div>
                                                <div class="d-flex align-items-center gap-2">
                                                    <i class="tio-map"></i>
                                                    <p>{{Str::limit($post?->service_address?->address??translate('not_available'), 100)}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card bg-light shadow-none">
                                    <div class="card-body pb-5">
                                        <div class="d-flex align-items-center gap-2 mb-3">
                                            <img width="18"
                                                 src="{{asset('public/assets/admin/img/more-info.png')}}"
                                                 alt="">
                                            <h4>{{translate('Service Information')}}</h4>
                                        </div>
                                        <div class="media gap-2 mb-4">
                                            <img width="50"
                                                 src="{{$post?->sub_category?->image_full_path}}"
                                                 alt="{{ translate('sub_category') }}">
                                            <div class="media-body">
                                                <h5>{{$post?->service?->name}}</h5>
                                                <div class="text-muted fs-12">{{$post?->sub_category?->name}}</div>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-column gap-2">
                                            <div class="fw-medium">{{translate('Booking Request Time')}} : <span
                                                    class="fw-bold">{{$post->created_at->format('d/m/Y h:ia')}}</span>
                                            </div>
                                            <div class="fw-medium">{{translate('Service Time')}} : <span
                                                    class="fw-bold">{{date('d/m/Y h:ia',strtotime($post->booking_schedule))}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header bg-primary-light shadow-none">
                                        <div style="display:inline-flex; align-items:center; gap:8px;">
                                            <img width="18"
                                                 src="{{ asset('public/assets/admin/img/instruction.png') }}"
                                                 alt="icon">
                                            <h5 style="margin:0; text-transform:uppercase; white-space:nowrap;">
                                                {{ translate('Additional Instruction') }}
                                            </h5>
                                        </div>
                                    </div>

                                    <div class="card-body pb-4">
                                        <ul class="d-flex flex-column gap-3 px-3 instruction-details">
                                            @forelse($post?->addition_instructions as $item)
                                                <li>{{$item->details}}</li>
                                            @empty
                                                <span>{{translate('No_Addition_Instructions')}}</span>
                                            @endforelse
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card h-100">
                                    <div class="card-header bg-primary-light shadow-none">
                                        <div style="display:inline-flex; align-items:center; gap:8px;">
                                            <img width="18"
                                                 src="{{asset('public/assets/admin/img/edit-info.png')}}"
                                                 alt="icon">
                                            <h5 style="margin:0; text-transform:uppercase; white-space:nowrap;">
                                                {{ translate('Service Description') }}
                                            </h5>
                                        </div>
                                    </div>

                                    <div class="card-body pb-4">
                                        <p>{{$post->service_description}}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="{{$bid_offers_visibility_for_providers ? 'col-lg-6' : 'col-lg-12'}}">
                                <div class="card h-100">
                                    <div class="card-header bg-primary-light shadow-none">
                                        <div style="display:inline-flex; align-items:center; gap:8px;">
                                            <img width="18"
                                                 src="{{asset('public/assets/admin/img/provider.png')}}"
                                                 alt="icon">
                                            <h5 style="margin:0; text-transform:uppercase; white-space:nowrap;">
                                                {{ translate('PLACED OFFER DETAILS') }}
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="card-body pb-4">
                                        <div class="d-flex gap-2 flex-wrap mb-3">
                                            <span class="text-danger mt-1">{{translate('Price Offered')}}</span>
                                            <h3 class="text-primary">{{\App\CentralLogics\Helpers::format_currency($post?->bids->where('provider_id', auth('provider')->user()->id)->first()?->offered_price ?? 0)}}</h3>
                                            <span class="text-muted fs-12 mt-1">({{$post->updated_at->diffForHumans()}})</span>
                                        </div>

                                        <h3 class="text-muted mb-2">{{translate('Note')}} :</h3>
                                        <p>{{$post?->bids?->where('provider_id', auth('provider')->user()->id)->first()?->provider_note ?? translate('No description available')}}</p>
                                    </div>
                                </div>
                            </div>
                            @if($bid_offers_visibility_for_providers)
                                <div class="col-lg-6">
                                    <div class="card h-100">
                                        <div class="card-header bg-primary-light shadow-none">
                                            <div style="display:inline-flex; align-items:center; gap:8px;">
                                                <img width="18"
                                                     src="{{asset('public/assets/admin/img/provider.png')}}"
                                                     alt="icon">
                                                <h5 style="margin:0; text-transform:uppercase; white-space:nowrap;">
                                                    {{ translate('other_provider_offering') }}
                                                </h5>
                                            </div>
                                        </div>

                                        <div class="card-body pb-4">
                                            @foreach($post->bids as $item)
                                                @if($item?->provider?->id != auth('provider')->user()->id)
                                                    <div class="d-flex align-items-center justify-content-between gap-3 mb-4">
                                                        <div class="media gap-3">
                                                            <div class="avatar avatar-lg">
                                                                <img class="rounded"
                                                                     src="{{onErrorImage(
                                                                    $item?->provider?->logo,
                                                                    asset('storage/app/public/provider/logo').'/' . $item?->provider?->logo,
                                                                    asset('public/assets/placeholder.png') ,
                                                                    'provider/logo/')}}" height="50px" width="50px"
                                                                     alt="{{ translate('provider-logo') }}">
                                                            </div>
                                                            <div class="media-body">
                                                                <h5>{{$item?->provider?->company_name}}</h5>
                                                                <div class="d-flex flex-wrap gap-2 mt-1">
                                                            <span class="common-list_rating d-flex gap-1">
                                                                <i class="tio-star text--primary"></i>
                                                                {{$item?->provider?->avg_rating??0}}
                                                            </span>
                                                                    <span>{{$item?->provider?->rating_count??0}} {{translate('Reviews')}}</span>
                                                                </div>
                                                                <div class="d-flex gap-2 flex-wrap mt-1">
                                                                    <span class="text-danger">{{translate('price offered')}}</span>
                                                                    <h4 class="text-primary">{{\App\CentralLogics\Helpers::format_currency($item->offered_price??0)}}</h4>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div>
                                                            <button class="btn btn--primary gap-2" data-toggle="modal"
                                                                    data-target="#providerInformationModal--{{$item?->provider?->id}}">
                                                                {{translate('View Details')}}
                                                                <i class="tio-arrow-long-right"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                            @if($post->bids->count() == 0 || ($post->bids->count() == 1 && $post->bids->contains('provider_id', auth('provider')->user()->id)))
                                                <div class="d-flex justify-content-between gap-3 mb-4">
                                                    <span>{{translate('No other provider offering for the post')}}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        @if(!$post->is_booked && !$post?->bids->contains('provider_id', auth('provider')->user()->id))
                            <div class="d-flex justify-content-end gap-3 mt-4">
                                <a href="{{route('provider.service.booking.post.update_status', [$post->id, 'status' => 'ignore'])}}"
                                   class="btn btn-danger">{{translate('Ignore')}}</a>

                                <a class="btn btn--primary" href="#" data-toggle="modal"
                                   data-target="#newBookingModal">{{translate('Place Offer')}}</a>
                            </div>
                        @elseif(!$post->is_booked && $post?->bids->contains('provider_id', auth('provider')->user()->id))
                            <div class="d-flex justify-content-end gap-3 mt-4">
                                <button class="btn btn--danger" data-toggle="modal"
                                        data-target="#withdrawRequestModal--{{$post['id']}}">{{translate('Withdraw Offer')}}</button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="newBookingModal" tabindex="-1"
         aria-labelledby="newBookingModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form
                    action="{{route('provider.service.booking.post.update_status', [$post->id])}}"
                    method="GET">
                    <div class="modal-header">
                        <h5 class="modal-title"
                            id="newBookingModalLabel">{{translate('New Booking Request Form')}}</h5>
                        <button type="button" class="close bg-white text-dark border d-center w-30px h-30 rounded-circle" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card border bg-light">
                            <div class="card-body">
                                <div class="d-flex gap-4 mb-4">
                                    <div class="media gap-2">
                                        <div class="avatar avatar-lg rounded">
                                            <img width="30" src="{{ $post->customer['image_full_url'] }}"
                                                 alt="{{translate('image')}}">
                                        </div>
                                        <div class="media-body">
                                            <h5 class="text-primary">{{$post?->customer?->f_name.' '.$post?->customer?->l_name}}</h5>
                                            <div class="text-muted fs-12">
                                                @if($distance)
                                                    {{$distance . ' ' . translate('away from you')}}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="media gap-2 border-start ps-4">
                                            <img width="30"
                                                 src="{{onErrorImage(
                                                                                    $post?->sub_category?->image,
                                                                                    asset('storage/app/public/category').'/' . $post?->sub_category?->image,
                                                                                    asset('public/assets/placeholder.png') ,
                                                                                    'category/')}}"
                                                 alt="{{translate('image')}}">
                                            <div class="media-body">
                                                <h5>{{$post?->service?->name}}</h5>
                                                <div
                                                    class="text-muted fs-12">{{$post?->sub_category?->name}}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <h4>{{translate('Service Requirement')}}</h4>
                                </div>

                                @if($post->service_description)
                                    <p class="fs-12">{{$post->service_description}}</p>
                                @else
                                    <span
                                        class="small">{{translate('Not Available')}}</span>
                                @endif

                            </div>
                        </div>

                        <div class="card border mt-3">
                            <div class="card-body">
                                <div class="mb-30">
                                    <div class="form-floating">
                                        <input type="number" class="form-control"
                                               name="offered_price"
                                               min="{{$post?->service?->min_bidding_price??0}}"
                                               step="0.01"
                                               required
                                               value="{{old('offered_price')}}"
                                               placeholder="{{translate('Offer Price')}}"
                                               id="offer-price"
                                               data-toggle="tooltip"
                                               data-placement="top"
                                               title="{{translate('Minimum Offer price')}} {{\App\CentralLogics\Helpers::format_currency($post?->service?->min_bidding_price??0)}}">
                                    </div>
                                </div>
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="{{translate('Add Your Note')}}" name="provider_note"
                                              id="add-your-note"></textarea>
                                    <input type="hidden" name="status" value="accept">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-end border-0 pt-0">
                        <button type="submit" class="btn btn--primary">{{translate('Send Your Offer')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="alertModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header pb-0 border-0">

                </div>
                <div class="modal-body pb-sm-5 px-sm-5">
                    <div class="d-flex flex-column align-items-center gap-2 text-center">
                        <img src="{{asset('public/assets/provider-module')}}/img/icons/alert.png" alt="">
                        <h3>{{translate('Alert')}}!</h3>
                        <p class="fw-medium">
                            {{translate('This request is with customized instructions. Please read the customer description and instructions thoroughly and place your pricing according to this')}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="withdrawRequestModal--{{$post['id']}}" tabindex="-1"
         aria-labelledby="withdrawRequestModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="close bg-white text-dark border d-center w-30px h-30 rounded-circle" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-column gap-2 align-items-center">
                        <img width="75" class="mb-2"
                             src="{{asset('public/assets/provider-module')}}/img/media/withdraw.png"
                             alt="">
                        <h3>{{translate('Are you sure you want to withdraw this offer?')}}
                            ?</h3>
                        <div
                            class="text-muted fs-12">{{translate('You offer will be removed for the post')}}</div>
                    </div>
                </div>
                <div
                    class="modal-footer d-flex justify-content-center gap-3 border-0 pt-0 pb-4">
                    <button type="button" class="btn btn--secondary"
                            data-dismiss="modal"
                            aria-label="{{translate('Close')}}">{{translate('Cancel')}}</button>
                    <a href="{{route('provider.service.booking.post.withdraw', [$post->id])}}"
                       type="button"
                       class="btn btn--primary">{{translate('Withdraw Offer')}}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
