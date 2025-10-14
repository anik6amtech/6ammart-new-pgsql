@extends('layouts.admin.app')

@section('title',translate('messages.Rider Vehicle'))


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

        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex flex-wrap gap-4">
                    <div class="flex-grow-1">
                        <div class="mb-4">
                            <h4 class="text--title font-bold mb-0">
                                {{ translate('messages.Vehicle_Info') }}
                            </h4>
                        </div>
                        <div class="d-flex gap-4 align-items-center">
                            <img class="w-100px aspect-1-1 object--cover rounded" src="{{ asset('public/assets/admin/img/100x100/1.png') }}" alt="">
                            <div class="flex-grow-1">
                                <h5 class="font-bold text--title">{{ $vehicle?->name }}</h5>
                                <div class="d-flex gap-2 flex-column">
                                   <h5 class="mb-0 text--title"><span class="opacity-70">{{ translate('messages.Brand')}} - </span><span>{{ $vehicle?->brand?->name }} </span></h5>
                                    <h5 class="mb-0 text--title"><span class="opacity-70">{{ translate('messages.Category')}} - </span><span>{{ $vehicle?->category?->name }}</span></h5>
                                    <h5 class="mb-0 text--title"><span class="opacity-70">{{ translate('messages.Model')}} - </span><span>{{ $vehicle?->model?->name }}</span></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <div class="mb-3">
                            <h4 class="text--title font-bold mb-0">
                                {{ translate('messages.Attached_documents') }}
                            </h4>
                        </div>
                         <div class="d-flex gap-3 flex-wrap">
                            @if(isset($vehicle['documentsFullUrl']))
                                @foreach($vehicle['documentsFullUrl'] as $doc)
                                <div class="pdf-single" data-pdf-url="{{ $doc }}">
                                    <div class="pdf-frame">
                                        <canvas class="pdf-preview display-none" ></canvas>
                                        <img class="pdf-thumbnail" src="{{ $doc }}" alt="File Thumbnail">
                                    </div>
                                    <div class="overlay">
                                        <a href="javascript:void(0);" class="download-btn" title="">
                                            <i class="tio-download-to"></i>
                                        </a>
                                        <div class="pdf-info d-flex gap-10px align-items-center">
                                            <img src="{{ asset('public/assets/admin/img/document.svg') }}" width="34" alt="Document Logo">
                                            <div class="fs-13 text--title d-flex flex-column">
                                                <span class="file-name"></span>
                                                <span class="opacity-50">{{ translate('Click to view the file') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h4 class="text-title font-bold mb-3">
                    {{ translate('messages.Vehicle_Specification') }}
                </h4>
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap text-title">
                        <tbody>
                            <tr>
                                <td>{{ translate('VIN') }}</td>
                                <td>{{ $vehicle?->vin_number }}</td>
                                <td>{{ translate('Category') }}</td>
                                <td>{{ $vehicle?->category?->name }}</td>
                            </tr>
                            <tr>
                                <td>{{ translate('Licence Plate Number') }}</td>
                                <td>{{ $vehicle?->licence_plate_number }}</td>
                                <td>{{ translate('Brand') }}</td>
                                <td>{{ $vehicle?->brand?->name }}</td>
                            </tr>
                            <tr>
                                <td>{{ translate('Licence Expiry Date') }}</td>
                                <td>{{ App\CentralLogics\Helpers::date_format($vehicle?->licence_expire_date) }}</td>
                                <td>{{ translate('Model') }}</td>
                                <td>{{ $vehicle?->model?->name }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script_2')
    <script src="{{ asset('public/assets/admin/js/view-pages/pdf.min.js') }}"></script>
    <script src="{{ asset('public/assets/admin/js/view-pages/vehicle-details.js') }}"></script>
@endpush
