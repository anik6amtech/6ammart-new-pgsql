@extends('layouts.admin.app')

@section('title',translate('messages.Delivery Man Preview'))

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-header-title text-break">
                <span class="page-header-icon">
                    <img src="{{asset('public/assets/admin/img/delivery-man.png')}}" class="w--26" alt="">
                </span>
                <span>{{$deliveryMan['f_name'].' '.$deliveryMan['l_name']}}</span>
            </h1>
            <div class="">
                @include('admin-views.delivery-man.partials._tab_menu')
            </div>
        </div>
        <!-- End Page Header -->

        <div class="js-nav-scroller hs-nav-scroller-horizontal mt-2">
            <!-- Nav -->
            <ul class="nav nav-tabs mb-3 border-0 nav--tabs">
                <li class="nav-item">
                    <a class="nav-link {{((request()?->tab == 'transaction' &&  request()?->type == 'order') || (!request()?->type)) ? 'active' : ''}}"
                        href="{{ route('admin.users.delivery-man.preview', ['id' => $deliveryMan->id, 'tab' => 'transaction', 'type' => 'order']) }}"
                        aria-disabled="true">{{ translate('messages.order') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{request()?->tab == 'transaction' &&  request()?->type == 'ride' ? 'active' : ''}}"
                        href="{{ route('admin.users.delivery-man.preview', ['id' => $deliveryMan->id, 'tab' => 'transaction', 'type' => 'ride']) }}"
                        aria-disabled="true">{{ translate('messages.ride') }}</a>
                </li>
            </ul>
            <!-- End Nav -->
        </div>

        @if(request()?->type != 'ride')
            @include('admin-views.delivery-man.partials._order_transaction')
        @else
            @include('admin-views.delivery-man.partials._ride_transaction')
        @endif
    </div>
@endsection

@push('script_2')

@endpush
