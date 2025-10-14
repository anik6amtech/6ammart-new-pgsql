@extends('layouts.admin.app')

@section('title',translate('Onboarding Provider'))

@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-header-title">
                <span class="page-header-icon">
                    <img src="{{ asset('public/assets/admin/img/rental/provider.png') }}" class="w--22" alt="">
                </span>
                <span>
                    {{translate('messages.Onboarding Provider')}}
                </span></h1>
            <div class="page-header-select-wrapper">
            </div>
        </div>
        <!-- End Page Header -->

        <div class="js-nav-scroller hs-nav-scroller-horizontal mb-20 mt-5">
            <ul class="nav nav-tabs align-items-start border-0 gap-20px nav--tabs tabs__style-border" id="myTab"
                role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{request()->status!='denied'?'active':''}}" href="{{url()->current()}}?status=onboarding">
                        {{ translate('messages.onboarding_requests') }}
                         <span class="badge badge-soft-dark ml-2" id="itemCount">{{$providersCount['onboarding']}}</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{request()->status=='denied'?'active':''}}" href="{{url()->current()}}?status=denied">
                        {{ translate('messages.denied_requests') }}
                        <span class="badge badge-soft-dark ml-2" id="itemCount">{{$providersCount['denied']}}</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Card -->
        <div class="card">
            <!-- Header -->
            <div class="card-header py-2">
                <div class="search--button-wrapper">
                    <h5 class="card-title">{{translate('messages.providers_list')}}</h5>
                    <form class="search-form">
                        <!-- Search -->
                        <div class="input-group input--group">
                            <input id="datatableSearch_" type="search" value="{{ request()?->search ?? null }}" name="search" class="form-control"
                                    placeholder="{{translate('ex_:_Search_provider_Name')}}" aria-label="{{translate('messages.search')}}" >
                            <button type="submit" class="btn btn--secondary"><i class="tio-search"></i></button>

                        </div>
                        <!-- End Search -->
                    </form>
                    @if(request()->get('search'))
                    <button type="reset" class="btn btn--primary ml-2 location-reload-to-base" data-url="{{url()->full()}}">{{translate('messages.reset')}}</button>
                    @endif
                    <!-- End Unfold -->
                </div>
            </div>
            <!-- End Header -->

            <!-- Table -->
            <div class="table-responsive datatable-custom">
                <table id="columnSearchDatatable"
                        class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                        data-hs-datatables-options='{
                            "order": [],
                            "orderCellsTop": true,
                            "paging":false
                        }'>
                    <thead class="thead-light">
                    <tr>
                        <th class="border-0">{{translate('sl')}}</th>
                        <th class="border-0">{{translate('messages.provider_info')}}</th>
                        <th class="border-0">{{translate('messages.contact_info')}}</th>
                        <th class="border-0">{{translate('messages.Zone')}}</th>
                        <th class="text-center border-0">{{translate('messages.action')}}</th>
                    </tr>
                    </thead>

                    <tbody id="set-rows">
                    @foreach($providers as $key=>$provider)
                        <tr>
                            <td>{{$key+$providers->firstItem()}}</td>
                            <td>
                                <div>
                                    <a href="{{route('admin.service.provider.onboarding_details', $provider->id)}}" class="table-rest-info" alt="{{translate('view provider')}}">
                                    <img class="img--60 circle onerror-image" data-onerror-image="{{asset('public/assets/admin/img/160x160/img1.jpg')}}"

                                            src="{{ $provider['logo_full_path'] ?? asset('public/assets/admin/img/160x160/img1.jpg') }}"

                                            >
                                        <div class="info"><div title="{{ $provider?->company_name }}" class="text--title">
                                            {{Str::limit($provider->company_name,20,'...')}}
                                            </div>
                                            <div class="font-light">
                                                {{translate('messages.id')}}:{{$provider->id}}
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </td>

                            <td>
                                <span title="{{ $provider?->full_name }}" class="d-block font-size-sm text-body">
                                    {{Str::limit($provider->full_name,20,'...')}}
                                </span>
                                <div>
                                    <a href="tel:{{ $provider['phone'] }}">
                                        {{$provider['phone']}}
                                    </a>
                                </div>
                            </td>
                            <td>
                                {{$provider->zone->name}}
                            </td>

                            <td>
                                <div class="btn--container justify-content-center">
                                    @if($provider->is_approved != 2)
                                        <a class="btn action-btnss btn--danger btn-outline-danger form-alert22" href="javascript:" data-href="{{route('admin.service.provider.update-approval',[$provider['id'], 'deny'])}}"
                                        data-id="vendor-{{$provider['id']}}" data-message="{{translate('You want to deny this provider')}}" title="{{translate('messages.deny_provider')}}">
                                            {{translate('Deny')}}
                                        </a>
                                    @endif
                                    <a class="btn action-btnss btn--primary btn-outline-primary form-alert22" data-href="{{route('admin.service.provider.update-approval',[$provider['id'], 'approve'])}}"
                                    href="javascript:void(0)" title="{{translate('messages.edit_provider')}}" data-id="vendor-{{$provider['id']}}"
                                    data-message="{{translate('You want to approve this provider')}}">
                                        {{translate('Approve')}}
                                    </a>
                                    <form action="#" method="get" id="vendor-{{$provider['id']}}"></form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
                @if(count($providers) !== 0)
                <hr>
                @endif
                <div class="page-area">
                    {!! $providers->withQueryString()->links() !!}
                </div>
                @if(count($providers) === 0)
                <div class="empty--data">
                    <img src="{{asset('/public/assets/admin/svg/illustrations/sorry.svg')}}" alt="public">
                    <h5>
                        {{translate('no_data_found')}}
                    </h5>
                </div>
                @endif
            <!-- End Table -->
        </div>
        <!-- End Card -->
    </div>


    <div class="d-none" id="data-set"
        data-translate-are-you-sure="{{ translate('Are_you_sure?') }}"
        data-translate-no="{{ translate('no') }}"
        data-translate-yes="{{ translate('yes') }}"
    ></div>


@endsection

@push('script_2')
<script src="{{asset('Modules/Rental/public/assets/js/admin/view-pages/provider-list.js')}}"></script>

<script>
    $('.form-alert22').on('click',function (){
        let id = $(this).data('id');
        let message = $(this).data('message');
        let url = $(this).data('href');
        Swal.fire({
            title: '{{ translate('messages.Are you sure?') }}',
            text: message,
            type: 'warning',
            showCancelButton: true,
            cancelButtonColor: 'default',
            confirmButtonColor: '#FC6A57',
            cancelButtonText: '{{ translate('messages.no') }}',
            confirmButtonText: '{{ translate('messages.Yes') }}',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $('#'+id).attr('action', url).submit();
            }
        })
    })
</script>
@endpush
