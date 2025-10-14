@extends('layouts.admin.app')

@section('title',translate('Customized Booking Requests'))

@push('css_or_js')
    <!-- Custom styles for this page -->
    <link href="{{asset('public/assets/admin/css/croppie.css')}}" rel="stylesheet">

    <style>
        .custom-dropdown {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }

        .dropdown-label {
            background-color: #f5f5f5;
            padding: 5px 12px;
            border-radius: 6px;
            font-weight: 500;
            transition: background 0.3s;
        }

        .dropdown-label:hover {
            background-color: #e0e0e0;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            top: 110%;
            left: 0;
            background-color: #fff;
            min-width: 250px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border-radius: 8px;
            z-index: 100;
        }

        .dropdown-item {
            padding: 8px 12px;
            border-bottom: 1px solid #f0f0f0;
        }

        .dropdown-item:last-child {
            border-bottom: none;
        }

        .dropdown-item:hover {
            background-color: #f9f9f9;
        }

    </style>

@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <h2 class="h1 mb-sm-3 mb-2 text-capitalize d-flex align-items-center gap-2">
            {{translate('Customized Booking Requests')}} <span class="rounded py-1 fz-12px px-2 mb-0 text-title" data-bg-color="#3342571A">{{ $posts->total() }}</span>
        </h2>
        <!-- Nav -->
        <div class="js-nav-scroller hs-nav-scroller-horizontal mb-20">
            <ul class="nav nav-tabs align-items-start border-0 gap-20px nav--tabs tabs__style-border" id="myTab"
                role="tablist">
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
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="card">
                    <div class="data-table-top border-bottom d-flex flex-wrap gap-3 justify-content-between p-3">
                        <form action="{{url()->current()}}?type={{$type}}" method="post">
                            @csrf
                            <div class="input-group input-group-custom input-group-merge">
                                <input type="search" class="form-control"
                                       value="{{$search??''}}" name="search"
                                       placeholder="{{translate('search_by_customer_name_or_phone')}}" aria-label="Search">
                                <button type="submit" class="btn btn--primary input-group-text"><i
                                        class="tio-search fz-15px"></i></button>
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
                                   <a id="export-excel" class="dropdown-item"  href="{{ route('admin.service.booking.post.export', [
                                                    'type' => $type ?? '',
                                                    'search' => $search ?? '',
                                                    'category_id' => $category_id ?? '',
                                                    'select_date' => $select_date ?? '',
                                                    'start_date' => $start_date ?? '',
                                                    'end_date' => $end_date ?? ''
                                                ]) }}">
                                       <img class="avatar avatar-xss avatar-4by3 mr-2" src="{{ asset('public/assets/admin/svg/components/excel.svg') }}" alt="Image Description">
                                       {{ translate('Excel') }}
                                   </a>
                                   {{-- <a id="export-csv" class="dropdown-item" href="javascript:;">
                                       <img class="avatar avatar-xss avatar-4by3 mr-2" src="{{ asset('public/assets/admin/svg/components/placeholder-csv-format.svg') }}" alt="Image Description">
                                       {{ translate('CSV') }}
                                   </a> --}}
                               </div>
                           </div>
                       </div>
                    </div>
                    <div class="">
                        <div class="table-responsive">
                            <table id="example" class="table m-0 align-middle align-middle-cus table-custom-space tr-hover">
                                <thead class="text-nowrap bg-light">
                                <tr>
                                    <th class="fz--14px text-title border-0">{{translate('SL')}}</th>
                                    @if($type != 'new_booking_request')
                                    <th class="fz--14px text-title border-0">{{translate('Booking ID')}}</th>
                                    @endif
                                    <th class="fz--14px text-title border-0">{{translate('Customer Info')}}</th>
                                    <th class="fz--14px text-title border-0">{{translate('Booking Request Time')}}</th>
                                    <th class="fz--14px text-title border-0">{{translate('Service Time')}}</th>
                                    <th class="fz--14px text-title border-0">{{translate('Category')}}</th>
                                    <th class="fz--14px text-title border-0">{{translate('Provider Offering')}}</th>
                                    <th class="fz--14px text-title border-0">{{translate('Action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($posts as $key=>$post)
                                <tr>
                                    <td class="text-title">{{$key+$posts->firstItem()}}</td>
                                    @if($type != 'new_booking_request')
                                        @if($post->booking)
                                            <td class="text-title">
                                                <a href="{{route('admin.service.booking.details', [$post?->booking->id,'web_page'=>'details'])}}">{{$post?->booking->id}}</a>
                                            </td>
                                        @else
                                            <td class="text-title">
                                                <small class="badge-pill badge-primary">{{translate('Not Booked Yet')}}</small>
                                            </td>
                                        @endif
                                    @endif
                                    <td>
                                        @if($post->customer)
                                            <div>
                                                <a class="text-body" href="{{route('admin.users.customer.service.view',[$post->customer['id']])}}">
                                                    <strong>
                                                        <div> {{Str::limit($post->customer?->fullName, 30)}} </div>
                                                    </strong>
                                                </a>
                                                {{$post->customer?->phone}}
                                            </div>
                                        @else
                                            <div>
                                                <small class="disabled">{{translate('Customer not available')}}</small>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div>
                                            <div>{{$post->created_at->format('Y-m-d')}}</div>
                                            <div>{{$post->created_at->format('h:ia')}}</div>
                                        </div>
                                    </td>
                                    <td class="text-title">
                                        <div>
                                            <div>{{date('d-m-Y',strtotime($post->booking_schedule))}}</div>
                                            <div>{{date('h:ia',strtotime($post->booking_schedule))}}</div>
                                        </div>
                                    </td>
                                    <td>
                                        @if($post->category)
                                            {{$post->category?->name}}
                                        @else
                                            <div>
                                                <small class="disabled">{{translate('Category not available')}}</small>
                                            </div>
                                        @endif
                                    </td>
                                    @php($bids = $post->bids)
                                    <td class="text-title">
                                        <div class="custom-dropdown">
                                            <div class="dropdown-label" onclick="toggleDropdown('dropdown-{{$post->id}}')">
                                                {{$bids->count() ?? 0}} {{translate('Providers')}}
                                            </div>

                                            @if($bids->count() > 0)
                                                <div class="dropdown-content" id="dropdown-{{$post->id}}">
                                                    @foreach($bids as $bid)
                                                        <div class="dropdown-item">
                                                            <div class="media gap-3 p-2">
                                                                <div class="avatar border rounded" onclick="openModal({{$bid->id}})">
                                                                    <img width="50" class="rounded"
                                                                         src="{{onErrorImage(
                                                                             $bid->provider?->logo,
                                                                             asset('storage/app/public/provider/logo').'/' . $bid->provider?->logo,
                                                                             asset('public/assets/admin-module/img/placeholder.png'),
                                                                             'provider/logo/')}}"
                                                                         alt="{{ translate('logo') }}">
                                                                </div>
                                                                <div class="media-body">
                                                                    @if($bid->provider)
                                                                        <h5 onclick="openModal({{$bid->id}})">{{$bid->provider->company_name}}</h5>
                                                                    @else
                                                                        <small>{{translate('Provider not available')}}</small>
                                                                    @endif
                                                                    <div class="d-flex gap-2 flex-wrap align-items-center fs-12 mt-1">
                                                                        <span class="text-danger">{{translate('price offered')}}</span>
                                                                        <h5 class="text-primary">{{\App\CentralLogics\Helpers::format_currency($bid->offered_price)}}</h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </td>

                                    <td>
                                        <div class="table-actions d-flex gap-2">
                                            <a href="{{route('admin.service.booking.post.details', [$post->id])}}" type="button"
                                               class="btn action-btn btn--primary btn-outline-primary"
                                               style="--size: 30px">
                                                <i class="tio-visible"></i>
                                            </a>
                                            @if(!$post->booking)
                                                    <a type="button" class="action-btn btn--danger booking-deny"
                                                       data-toggle="modal"
                                                       data-target="#exampleModal--{{$post['id']}}"
                                                       style="--size: 30px">
                                                        <i class="tio-delete"></i>
                                                    </a>
                                                <div class="modal fade" id="exampleModal--{{$post['id']}}"
                                                     tabindex="-1"
                                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-body pt-5 p-md-5">
                                                                <button type="button" class="btn-close"
                                                                        data-dismiss="modal"
                                                                        aria-label="Close"></button>

                                                                <div class="d-flex justify-content-center mb-4">
                                                                    <img width="75" height="75"
                                                                         src="{{asset('public/assets/admin-module/img/media/delete.png')}}"
                                                                         class="rounded-circle" alt="">
                                                                </div>

                                                                <h3 class="text-center mb-1 fw-medium">{{translate('Are you sure you want to delete the post?')}}</h3>
                                                                <p class="text-center fs-12 fw-medium text-muted">{{translate('You will lost the custom booking request?')}}</p>
                                                                <form method="post"
                                                                      action="{{route('admin.service.booking.post.delete', [$post->id])}}">
                                                                    @csrf
                                                                    <div class="form-floating">
                                                                            <textarea class="form-control h-69px"
                                                                                      placeholder="{{translate('Cancellation Note')}}"
                                                                                      name="post_delete_note" required
                                                                                      id="add-your-notes"></textarea>
                                                                        <label for="add-your-notes"
                                                                               class="d-flex align-items-center gap-1">
                                                                            {{translate('Cancellation Note')}}
                                                                        </label>
                                                                    </div>
                                                                    <div
                                                                        class="d-flex justify-content-center gap-3 mt-3">
                                                                        <button type="button"
                                                                                class="btn btn--secondary"
                                                                                data-dismiss="modal">{{translate('cancel')}}</button>
                                                                        <button type="submit"
                                                                                class="btn btn-danger">{{translate('Delete')}}</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                    <tr class="text-center">
                                        <td colspan="10">
                                            <div class="empty--data">
                                                <img src="{{asset('/public/assets/admin/svg/illustrations/sorry.svg')}}" alt="public">
                                                <h5>
                                                    {{translate('no_data_found')}}
                                                </h5>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if(count($posts) !== 0)
                        <hr>
                    @endif
                    <div class="page-area">
                        {!! $posts->links() !!}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

<script>
    function toggleDropdown(id) {
        const el = document.getElementById(id);
        el.style.display = (el.style.display === 'block') ? 'none' : 'block';
    }

    function openModal(id) {
        const modal = document.getElementById('providerInfoModal--' + id);
        if(modal) modal.style.display = 'block';
    }
</script>

