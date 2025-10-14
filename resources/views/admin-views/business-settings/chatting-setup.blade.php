@extends('layouts.admin.app')

@section('title', translate('messages.chatting_setup'))

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
        
    </div>
@endsection
