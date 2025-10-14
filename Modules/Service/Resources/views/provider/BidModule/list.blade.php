@extends('service::provider.layouts.app')

@section('title',translate('Request list'))

@section('content')

    <div class="content container-fluid">
        <!-- Page Title -->
        <h2 class="h1 mb-sm-3 mb-2 text-capitalize d-flex align-items-center gap-2">
            {{translate('Customized Booking Requests')}} <span class="rounded py-1 fz-12px px-2 mb-0 text-title" data-bg-color="#3342571A">{{ $posts->total() }}</span>
        </h2>
        <!-- Nav -->
        <div class="js-nav-scroller hs-nav-scroller-horizontal mb-20">
            <ul class="nav nav-tabs align-items-start border-0 gap-20px nav--tabs tabs__style-border">
                <li class="nav-item">
                    <a class="nav-link {{$type=='all'?'active':''}}"
                       href="{{url()->current()}}?type=all">{{translate('All')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{$type=='new_booking_request'?'active':''}}"
                       href="{{url()->current()}}?type=new_booking_request">{{translate('No-Bid Request Yet')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{$type=='placed_offer'?'active':''}}"
                       href="{{url()->current()}}?type=placed_offer">{{translate('Already Bid Requested')}}</a>
                </li>
            </ul>
        </div>
        <div class="tab-content">
            <div class="tab-pane fade show active">
                <div class="card">
                    <div class="data-table-top border-bottom d-flex flex-wrap gap-3 justify-content-between p-3">
                        <form action="{{url()->current()}}?type={{$type}}" method="POST" id="searchForm">
                            @csrf
                            <div class="input-group input-group-custom input-group-merge">
                                <input id="datatableSearch_"
                                       type="search"
                                       name="search"
                                       class="form-control"
                                       placeholder="Search by customer name"
                                       aria-label="Search by ID or name"
                                       value="{{$search??''}}"
                                       required>
                                <button type="submit" class="btn btn--primary input-group-text">
                                    <i class="tio-search fz-15px"></i>
                                </button>
                            </div>
                        </form>
                        <div class="d-flex flex-wrap align-items-center gap-3">
                           <div class="hs-unfold mr-2">
                               <a class="js-hs-unfold-invoker btn btn-sm btn-white dropdown-toggle h--45px border" href="javascript:;" data-hs-unfold-options="{
                                   &quot;target&quot;: &quot;#usersExportDropdown&quot;,
                                   &quot;type&quot;: &quot;css-animation&quot;
                               }" data-hs-unfold-target="#usersExportDropdown" data-hs-unfold-invoker="">
                                   <i class="tio-download-to mr-1"></i> {{ translate('Export') }}
                               </a>

                               <div id="usersExportDropdown" class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right hs-unfold-content-initialized hs-unfold-css-animation animated hs-unfold-hidden" data-hs-target-height="131.516" data-hs-unfold-content="" data-hs-unfold-content-animation-in="slideInUp" data-hs-unfold-content-animation-out="fadeOut" style="animation-duration: 300ms;">
                                   <span class="dropdown-header"> {{ translate('Download Options') }} </span>
                                   <a id="export-excel" class="dropdown-item" href="{{route('provider.service.booking.post.export', request()->query())}}">
                                       <img class="avatar avatar-xss avatar-4by3 mr-2" src="{{ asset('public/assets/admin/svg/components/excel.svg') }}" alt="Image Description">
                                       {{ translate('Excel') }}
                                   </a>
                               </div>
                           </div>
                       </div>
                    </div>
                    <div class="">
                        <div class="table-responsive">
                            <table id="example" class="table m-0 align-middle align-middle-cus table-custom-space tr-hover">
                                <thead class="text-nowrap bg-light">
                                <tr>
                                    <th class="fz--14px text-title border-0">SL</th>
                                    <th class="fz--14px text-title border-0">{{translate('Booking ID')}}</th>
                                    <th class="fz--14px text-title border-0">{{translate('Customer Info')}}</th>
                                    <th class="fz--14px text-title border-0">{{translate('Booking Request Time')}}</th>
                                    <th class="fz--14px text-title border-0">{{translate('Service Time')}}</th>
                                    <th class="fz--14px text-title border-0">{{translate('Category')}}</th>
                                    @if($bid_offers_visibility_for_providers)
                                    <th class="fz--14px text-title border-0">{{translate('Provider Offering')}}</th>
                                    @endif
                                    <th class="fz--14px text-title border-0">{{translate('Action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($posts as $key=>$post)
                                <tr>
                                    <td class="text-title">{{$key+$posts->firstItem()}}</td>
                                    <td>
                                        @if($post->booking)
                                            <a href="{{ route('provider.service.booking.details', [$post?->booking->id, 'web_page' => 'details']) }}">
                                                {{ $post?->booking->id }}
                                            </a>
                                        @else
                                            <small class="badge-pill badge-primary">{{ translate('Not Booked Yet') }}</small>
                                        @endif
                                    </td>

                                    <td>
                                        @if($post->customer)
                                            <div class="customer-name fw-medium">
                                                {{ $post->customer?->f_name . ' ' . $post->customer?->l_name }}
                                            </div>
                                        @else
                                            <small class="disabled">{{ translate('Customer not available') }}</small>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="text-title">{{$post->created_at->format('Y-m-d')}}</div>
                                        <div class="text-title">{{$post->created_at->format('h:ia')}}</div>
                                    </td>
                                    <td>
                                        <div class="text-title">{{date('d-m-Y',strtotime($post->booking_schedule))}}</div>
                                        <div class="text-title">{{date('h:ia',strtotime($post->booking_schedule))}}</div>
                                    </td>
                                    <td class="text-title">
                                        @if($post->category)
                                            {{$post->category?->name}}
                                        @else
                                            <div>
                                                <small class="disabled">{{translate('Category not available')}}</small>
                                            </div>
                                        @endif
                                    </td>
                                    @if($bid_offers_visibility_for_providers)
                                        @php($bids = $post->bids->where('provider_id', '!=', auth('provider')->user()->id))

                                    <td class="text-title">
                                        <div class="btn-group dropleft">
                                            <button type="button" class="btn p-0" data-toggle="dropdown" aria-expanded="false">
                                                {{$bids->count() ?? 0}} {{translate('Providers')}}
                                            </button>
                                            @if($bids->count() > 0)
                                            <div class="dropdown-menu dropdown-bordered py-0">
                                                @foreach($bids as $bid)
                                                <a href="#0" class="p-3 d-flex align-items-center gap-2 dropdown-item py-2">
                                                    <img width="50" src="{{onErrorImage($bid?->provider?->logo,
                                                            asset('storage/app/public/provider/logo').'/' . $bid?->provider?->logo,
                                                            asset('public/assets/admin-module/img/placeholder.png'),
                                                             'provider/logo/')}}"
                                                        class="rounded"
                                                        alt="{{ translate('logo') }}">
                                                    <span>
                                                        @if($bid?->provider)
                                                            <span class="font-semibold mb-0 d-block text-title fz--14px">{{$bid?->provider?->company_name}}</span>
                                                        @else
                                                            <small>{{translate('Provider not available')}}</small>
                                                        @endif
                                                        <span class="font-semibold d-block fz-12px" data-text-color="#33425780">
                                                            {{translate('price offered')}} <span class="text-title font-medium">{{\App\CentralLogics\Helpers::format_currency($bid->offered_price)}}</span>
                                                        </span>
                                                    </span>
                                                </a>
                                                @endforeach
                                            </div>
                                            @endif
                                        </div>
                                    </td>
                                    @endif
                                    <td>
                                        <div class="btn-group dropleft">
                                            <button type="button" class="btn rounded action-btn btn--primary btn-outline-primary" data-toggle="dropdown" aria-expanded="false">
                                                <i class="tio-more-vertical fz-24"></i>
                                            </button>
                                            <div class="dropdown-menu overflow-hidden py-2">
                                                <a href="{{route('provider.service.booking.post.details', [$post->id])}}" class="dropdown-item py-2">
                                                    {{translate('View details')}}
                                                </a>
                                                @if($post?->bids->contains('provider_id', auth('provider')->user()->id))
                                                    <a href="#0" class="dropdown-item" data-toggle="modal"
                                                       data-target="#offerDetailsModal--{{$post['id']}}">
                                                        {{translate('See My Offer')}}
                                                    </a>
                                                    <a href="#0" class="dropdown-item py-2" data-toggle="modal"
                                                       data-target="#withdrawRequestModal--{{$post['id']}}">
                                                        {{translate('Withdraw the Offer')}}
                                                    </a>
                                                @endif
                                                @if(!$post->is_booked && !$post?->bids->contains('provider_id', auth('provider')->user()->id))
                                                    <a href="#0" class="dropdown-item" data-toggle="modal"
                                                       data-target="#newBookingModal--{{$post['id']}}">
                                                        {{translate('Placed Offer')}}
                                                    </a>
                                                    <a href="#0" class="dropdown-item py-2" data-toggle="modal"
                                                       data-target="#ignoreRequestModal--{{$post['id']}}">
                                                        {{translate('Ignore/Reject')}}
                                                    </a>
                                                @endif

                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <div class="modal fade" id="offerDetailsModal--{{$post['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content pb-3">
                                            <div class="modal-header">
                                                <button type="button" class="close bg-white text-dark border d-center w-30px h-30 rounded-circle" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body py-4">
                                                <h3 class="text-center mb-20 pb-2">{{translate('My Offer Details')}}</h3>
                                                <div class="bg-light gap-3 rounded p-20 d-flex align-items-center justify-content-between flex-lg-nowrap flex-wrap mb-20">
                                                    <div class="d-flex gap-2 align-items-center">
                                                        <img width="35" height="35" class="rounded" src="{{onErrorImage(
                                                                        $post?->sub_category?->image,
                                                                        asset('storage/app/public/category').'/' . $post?->sub_category?->image,
                                                                        asset('public/assets/placeholder.png') ,
                                                                        'category/')}}" alt="img">
                                                        <div>
                                                            <h5 class="mb-1">{{$post?->service?->name}}</h5>
                                                            <p class="text-break mb-0 fs-12" data-text-color="#334257B2">
                                                                {{$post?->sub_category?->name}}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="line border border-end h-35px d-sm-block d-none"></div>
                                                    <div class="">
                                                        <div class="d-flex align-items-center gap-1 mb-1">
                                                            <span class="fz--14px" data-text-color="#334257B2">{{translate('price offered')}}</span>
                                                            <h3 class="mb-0" data-text-color="#107980">{{\App\CentralLogics\Helpers::format_currency($post?->bids->where('provider_id', auth('provider')->user()->id)->first()?->offered_price ?? 0)}}</h3>
                                                        </div>
                                                        <p class="text-break mb-0 fs-12" data-text-color="#334257B2">
                                                            {{$post->updated_at->diffForHumans()}}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div>
                                                    <h5 class="mb-1">{{translate('Description')}}:</h5>
                                                    <p class="fs-12 mb-0">
                                                        {{$post?->bids?->where('provider_id', auth('provider')->user()->id)?->first()?->provider_note}}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="newBookingModal--{{$post['id']}}" tabindex="-1"
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
                                                                            @if($post->distance)
                                                                                {{$post->distance . ' ' . translate('away from you')}}
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

                                <div class="modal fade" id="ignoreRequestModal--{{$post['id']}}" tabindex="-1"
                                     aria-labelledby="ignoreRequestModalLabel"
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
                                                         src="{{asset('public/assets/provider-module')}}/img/media/ignore-request.png"
                                                         alt="">
                                                    <h3>{{translate('Are you sure you want to ignore this request')}}
                                                        ?</h3>
                                                    <div
                                                        class="text-muted fs-12">{{translate('You will lose the customer booking request')}}</div>
                                                </div>
                                            </div>
                                            <div
                                                class="modal-footer d-flex justify-content-center gap-3 border-0 pt-0 pb-4">
                                                <button type="button" class="btn btn--secondary"
                                                        data-dismiss="modal"
                                                        aria-label="Close">{{translate('Cancel')}}</button>
                                                <a href="{{route('provider.service.booking.post.update_status', [$post->id, 'status' => 'ignore'])}}"
                                                   type="button"
                                                   class="btn btn--primary">{{translate('Ignore')}}</a>
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
                                                        aria-label="Close">{{translate('Cancel')}}</button>
                                                <a href="{{route('provider.service.booking.post.withdraw', [$post->id])}}"
                                                   type="button"
                                                   class="btn btn--primary">{{translate('Withdraw Offer')}}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @empty
                                   {{--  <tr class="text-center">
                                        <td colspan="7">{{translate('No data available')}}</td>
                                    </tr> --}}
                                @endforelse
                                </tbody>
                            </table>
                            @if(count($posts) === 0)
                            <div class="empty--data">
                                <img src="{{asset('/public/assets/admin/svg/illustrations/sorry.svg')}}" alt="public">
                                <h5>
                                    {{translate('no_data_found')}}
                                </h5>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script_2')
    <script>
        "use strict";
            const searchInput = document.getElementById('datatableSearch_');

            searchInput.addEventListener('search', function () {
            if (this.value === '') {
                window.location.href = "{{ url()->current() }}?type=all";
            }
        });
    </script>
@endpush
