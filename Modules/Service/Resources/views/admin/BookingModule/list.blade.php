@extends('layouts.admin.app')

@section('title',translate('Booking list'))

@push('css_or_js')
    <!-- Custom styles for this page -->
    <link href="{{asset('public/assets/admin/css/croppie.css')}}" rel="stylesheet">

@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <h2 class="h1 mb-sm-3 mb-2 text-capitalize d-flex align-items-center gap-2">
            {{translate('Booking Request')}} <span class="rounded py-1 fz-12px px-2 mb-0 text-title" data-bg-color="#3342571A">{{ $bookings->total() }}</span>
        </h2>
        <!-- Nav -->
        <div class="js-nav-scroller hs-nav-scroller-horizontal mb-20">
            <ul class="nav nav-tabs align-items-start border-0 gap-20px nav--tabs tabs__style-border" id="myTab"
                role="tablist">
                <li class="nav-item">
                    <a class="nav-link {{ request('service_type') === 'all' || !request('service_type') ? 'active' : '' }}"
                       href="{{ url()->current() }}?booking_status={{ $queryParams['booking_status'] }}&service_type=all">
                        {{ translate('All Booking') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request('service_type') === 'regular' ? 'active' : '' }}"
                       href="{{ url()->current() }}?booking_status={{ $queryParams['booking_status'] }}&service_type=regular">
                        {{ translate('Regular Booking') }}
                    </a>
                </li>
                <li class="nav-item text">
                    <a class="nav-link {{ request('service_type') === 'repeat' ? 'active' : '' }}"
                       href="{{ url()->current() }}?booking_status={{ $queryParams['booking_status'] }}&service_type=repeat">
                        {{ translate('Repeat Booking') }}
                    </a>
                </li>
            </ul>
        </div>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="card">
                    <div class="data-table-top border-bottom d-flex flex-wrap gap-3 justify-content-between p-3">
                        <form action="{{url()->current()}}?booking_status={{$queryParams['booking_status']}}&service_type={{$queryParams['service_type']}}" method="post">
                            @csrf
                            <div class="input-group input-group-custom input-group-merge">
                                <input type="search" class="form-control"
                                       value="{{$queryParams['search']??''}}" name="search"
                                       placeholder="{{translate('search_here')}}">
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
                                  <a id="export-excel" class="dropdown-item" href="{{ route('admin.service.booking.download',$queryParams) }}">
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
                                    <th class="fz--14px text-title border-0">{{translate('Booking ID')}}</th>
                                    <th class="fz--14px text-title border-0">{{translate('Booking Date')}}</th>
                                    <th class="fz--14px text-title border-0">{{translate('Schedule Date')}}</th>
                                    <th class="fz--14px text-title border-0">{{translate('Service Will be Provided')}}</th>
                                    <th class="fz--14px text-title border-0">{{translate('Customer Info')}}</th>
                                    <th class="fz--14px text-title border-0">{{translate('Total Amount')}}</th>
                                    <th class="fz--14px text-title border-0">{{translate('Payment Status')}}</th>
                                    <th class="fz--14px text-title border-0">{{translate('Action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($bookings as $key=>$booking)
                                <tr>
                                    <td class="text-title">{{$key+$bookings->firstItem()}}</td>
                                    <td class="text-title">
                                        <a href="{{ route($booking->is_repeated ? 'admin.service.booking.repeat_details' : 'admin.service.booking.details', [$booking->id, 'web_page' => 'details']) }}">
                                        {{ $booking->id }}
                                        @if($booking->is_repeated)
                                            <img src="{{asset('/public/assets/admin/img/repeat2.png')}}" alt="img">
                                        @endif
                                        </a>
                                    </td>
                                    <td>
                                        <div class="font-medium text-title">{{ date('d-M-Y', strtotime($booking?->created_at))}}</div>
                                        <div>{{date('h:ia', strtotime($booking?->created_at)) }}</div>
                                    </td>
                                    <td>
                                        @if($booking->is_repeated)
                                            @if(empty($booking->nextService))
                                                <div class="text-title">{{ date('d-M-Y h:ia', strtotime($booking?->lastRepeat?->service_schedule)) }}
                                                </div>
                                            @else
                                                <span>{{translate('Next upcoming')}}</span>
                                                <div class="text-title">{{ date('d-M-Y h:ia', strtotime($booking?->lastRepeat?->service_schedule)) }}</div>
                                            @endif
                                        @else
                                            <div class="text-title">{{ date('d-M-Y h:ia', strtotime($booking?->service_schedule)) }}</div>
                                        @endif
                                    </td>
                                    <td class="text-title">
                                        @if($booking->service_location == 'provider')
                                            {{ translate('Provider Location') }}
                                        @else
                                            {{ translate('Customer Location') }}
                                        @endif
                                    </td>
                                    <td>
                                        <div class="font-medium text-title">
                                            @if(isset($booking->customer) && $booking->is_guest == 0)
                                                <a class="text-body" href="{{route('admin.users.customer.service.view',[$booking->customer['id']])}}">
                                                    <strong>
                                                        <div> {{Str::limit($booking?->customer?->fullName, 30)}} </div>
                                                    </strong>
                                                </a>
                                                {{$booking?->customer?->phone}}
                                            @else
                                                {{Str::limit($booking?->service_address?->contact_person_name, 30)}}
                                                <br/>
                                                {{$booking?->service_address?->contact_person_number}}
                                            @endif
                                        </div>
                                    </td>
                                    <td class="text-title">
                                        {{\App\CentralLogics\Helpers::format_currency($booking->total_booking_amount)}}
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill py-2 px-3 text-capitalize text-{{$booking->is_paid?'success':'danger'}}"
                                              data-bg-color="#{{$booking->is_paid?'16B5591A':'b516160f'}}">{{$booking->is_paid?translate('paid'):translate('unpaid')}}</span>
                                    </td>
                                    <td>
                                        <div class="table-actions d-flex gap-2">
                                            <a href="{{ route($booking->is_repeated ?  'admin.service.booking.repeat_details' : 'admin.service.booking.details', [$booking->id, 'web_page' => 'details']) }}" type="button"
                                               class="btn action-btn btn--primary btn-outline-primary"
                                               style="--size: 30px">
                                                <i class="tio-visible"></i>
                                            </a>
                                            <a href="{{ route($booking->is_repeated ?  'admin.service.booking.full_repeat_invoice' : 'admin.service.booking.invoice', $booking->id) }}" type="button" class="action-btn btn--varify btn-outline-varify"
                                               style="--size: 30px" target="_blank">
                                                <i class="tio-download-to"></i>
                                            </a>
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
                    @if(count($bookings) !== 0)
                        <hr>
                    @endif
                    <div class="page-area">
                        {!! $bookings->links() !!}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
