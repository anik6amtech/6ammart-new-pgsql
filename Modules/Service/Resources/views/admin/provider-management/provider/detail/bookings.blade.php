@extends('layouts.admin.app')

@section('title',$provider->company_name."'s ".translate('messages.bookings'))

@push('css_or_js')
    <!-- Custom styles for this page -->
    <link href="{{asset('public/assets/admin/css/croppie.css')}}" rel="stylesheet">
    <link href="{{asset('Modules/Rental/public/assets/css/admin/provider-overview.css')}}" rel="stylesheet">
@endpush

@section('content')
    <div class="content container-fluid">

        @include('service::admin.provider-management.provider.detail.partials._header',['provider'=>$provider])
        <div class="js-nav-scroller hs-nav-scroller-horizontal mb-20">
            <ul class="nav nav-tabs align-items-start border-0 gap-20px nav--tabs tabs__style-border" id="myTab"
                role="tablist">
                <li class="nav-item">
                    <a class="nav-link {{ request('service_type') === 'all' || !request('service_type') ? 'active' : '' }}"
                       href="{{ url()->current() }}?booking_status=all&service_type=all&tab=bookings">
                        {{ translate('All Booking') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request('service_type') === 'regular' ? 'active' : '' }}"
                       href="{{ url()->current() }}?booking_status=all&service_type=regular&tab=bookings">
                        {{ translate('Regular Booking') }}
                    </a>
                </li>
                <li class="nav-item text">
                    <a class="nav-link {{ request('service_type') === 'repeat' ? 'active' : '' }}"
                       href="{{ url()->current() }}?booking_status=all&service_type=repeat&tab=bookings">
                        {{ translate('Repeat Booking') }}
                    </a>
                </li>
            </ul>
        </div>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="card">
                    <div
                        class="data-table-top border-bottom align-items-center d-flex flex-wrap gap-3 justify-content-between p-3">
                        <h4 class="mb-0">{{translate('messages.All Booking')}}</h4>
                        <div class="d-flex flex-wrap align-items-center gap-xl-4 gap-20px">
                            <form action="{{ url()->current() }} }}" method="GET">
                                <div class="input-group input-group-custom input-group-merge">
                                    <input id="datatableSearch_" type="search" name="search" class="form-control"
                                        placeholder="Search by name" aria-label="Search by ID or name" value=""
                                        required="">
                                    <input type="hidden" name="tab" value="{{ $webPage }}">
                                    <input type="hidden" name="service_type" value="{{ request('service_type') ?? 'all' }}">
                                    <button type="submit" class="btn btn--primary input-group-text"><i
                                            class="tio-search fz-15px"></i></button>
                                </div>
                            </form>
{{--                            <div class="dropdown">--}}
{{--                                <button type="button"--}}
{{--                                    class="btn d-flex align-items-center gap-2 text-title font-medium fz-12px border rounded text-capitalize dropdown-toggle h--45px"--}}
{{--                                    data-toggle="dropdown">--}}
{{--                                    <i class="tio-download-to"></i>--}}
{{--                                    {{translate('Export')}}--}}
{{--                                </button>--}}
{{--                                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">--}}
{{--                                    <li>--}}
{{--                                        <a class="dropdown-item" href="#0">{{translate('Excel')}}</a>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
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
                                            {{translate('Customer Place')}}
                                        </td>
                                        <td>
                                            <div class="font-medium text-title">
                                                @if(isset($booking->customer) && $booking->is_guest == 0)
                                                    {{Str::limit($booking?->customer?->fullName, 30)}} <br/>
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

@push('script_2')
    <!-- Page level plugins -->
    <script src="https://maps.googleapis.com/maps/api/js?key={{\App\Models\BusinessSetting::where('key', 'map_api_key')->first()->value}}&callback=initMap&v=3.45.8"></script>
    <script src="{{asset('Modules/Rental/public/assets/js/admin/view-pages/provider-overview.js')}}"></script>

@endpush
