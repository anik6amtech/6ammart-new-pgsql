@extends('layouts.admin.app')

@section('title',translate('Service_Request_List'))

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <h2 class="h1 mb-sm-3 mb-2 text-capitalize d-flex align-items-center gap-2">
            {{translate('New Service Request')}}
        </h2>

        <div class="card">
            <div
                class="data-table-top border-bottom d-flex align-items-center flex-wrap gap-3 justify-content-between p-3">
                <h4 class="text-title mb-0">{{ translate('All Services') }}</h4>
                <div class="d-flex flex-wrap align-items-center gap-3">
                    <form action="{{url()->current()}}" method="GET">
                        <div class="input-group input-group-custom input-group-merge">
                            <input id="datatableSearch_" type="search" name="search" class="form-control"
                                   placeholder="Search by name" aria-label="Search by ID or name" value="{{ request()->search }}" required="">
                            <button type="submit" class="btn btn--primary input-group-text"><i
                                    class="tio-search fz-15px"></i></button>
                        </div>
                    </form>
                    <div class="hs-unfold mr-2">
                        <a class="js-hs-unfold-invoker btn btn-sm btn-white dropdown-toggle h--45px border"
                           data-hs-unfold-options="{
                            &quot;target&quot;: &quot;#usersExportDropdown&quot;,
                            &quot;type&quot;: &quot;css-animation&quot;
                        }" data-hs-unfold-target="#usersExportDropdown" data-hs-unfold-invoker="">
                            <i class="tio-download-to mr-1"></i> {{translate('Export')}}
                        </a>

                        <div id="usersExportDropdown" class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right hs-unfold-content-initialized hs-unfold-css-animation animated hs-unfold-hidden" data-hs-target-height="131.516" data-hs-unfold-content="" data-hs-unfold-content-animation-in="slideInUp" data-hs-unfold-content-animation-out="fadeOut" style="animation-duration: 300ms;">
                            <span class="dropdown-header">{{translate('Download options')}}</span>
                            <a id="export-excel" class="dropdown-item" href="{{ route('admin.service.service.export', ['type' => 'excel', request()->getQueryString()]) }}">
                                <img class="avatar avatar-xss avatar-4by3 mr-2" src="{{asset('/public/assets/admin/svg/components/excel.svg')}}" alt="Image Description">
                                {{translate('Excel')}}
                            </a>
{{--                            <a id="export-csv" class="dropdown-item" href="{{ route('admin.service.service.export', ['type' => 'csv', request()->getQueryString()]) }}">--}}
{{--                                <img class="avatar avatar-xss avatar-4by3 mr-2" src="{{asset('/public/assets/admin/svg/components/placeholder-csv-format.svg')}}" alt="Image Description">--}}
{{--                                {{translate('.Csv')}}--}}
{{--                            </a>--}}
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
                            <th class="fz--14px text-title border-0">{{translate('Category')}}</th>
                            <th class="fz--14px text-title border-0">{{translate('User')}}</th>
                            <th class="fz--14px text-title border-0">{{translate('Service Name')}}</th>
                            <th class="fz--14px text-title border-0">{{translate('Service Description')}}</th>
                            <th class="fz--14px text-title border-0">{{translate('Given feedback')}}</th>
                            <th class="fz--14px text-title border-0 text-center">{{translate('Action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($requests as $key=>$item)
                            <tr>
                                <td class="text-title fz--14px">{{$requests->firstitem()+$key}}</td>
                                <td class="text-title fz--14px">
                                    @if($item->category)
                                        {{translate($item->category->name)}}
                                    @else
                                        {{translate('Not available')}}
                                    @endif
                                </td>
                                <td>
                                    <div  class="text-title max-w-165 fz--14px mb-1">
                                        @if($item->type == 'customer')
                                            {{--                                                        --}}
                                            <a href="{{route('admin.users.customer.service.view',[$item->user->id])}}">
                                                {{$item->user->f_name}} {{$item->user->l_name}}
                                                <br>
                                                <span class="fs-12 font-semibold py-1 px-2 rounded" data-bg-color="#0788FF1A" data-text-color="#0788FF">{{translate('Customer')}}</span>
                                            </a>
                                        @endif

                                        @if($item->type == 'provider')
                                            <a href="{{route('admin.service.provider.details',[$item?->provider?->id, 'web_page'=>'overview'])}}">
                                                {{$item?->provider?->company_name}}
                                                <br>
                                                <span class="fs-12 font-semibold py-1 px-2 rounded" data-bg-color="#0788FF1A" data-text-color="#0788FF">{{translate('Provider')}}</span>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                                <td class="text-title fz--14px">{{$item->service_name}}</td>
                                <td class="text-title">
{{--                                    <p class="max-w-187px fz--14px line--limit-3"></p>--}}
                                    <div class="max-w-187px fz--14px line--limit-3" data-toggle="modal" data-target="#serviceRequestModal--{{$item['id']}}">
                                        {{Str::limit($item->service_description, 150)}}
                                    </div>
                                    <div class="modal fade" id="serviceRequestModal--{{$item['id']}}" tabindex="-1" aria-labelledby="serviceRequestModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="text-center">{{translate('service_Request_List')}}</h3>
                                                    <button type="button" class="close bg-white text-dark border d-center w-30px h-30 rounded-circle" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body p-sm-4">
                                                    <div class="d-flex flex-column gap-2">
                                                        <div class="d-flex flex-wrap gap-2 align-items-center">
                                                            <span>{{translate('category')}} </span>:
                                                            @if($item->category)
                                                                <span>{{translate($item->category->name)}}</span>
                                                            @else
                                                                <span>{{translate('Not available')}}</span>
                                                            @endif
                                                        </div>
                                                        <div class="d-flex flex-wrap gap-2 align-items-center">
                                                            @if($item->type == PROVIDER)
                                                                <span>{{translate('user_Name')}} </span>:
                                                                <span> {{$item->provider->company_name}}</span>
                                                                <span class="badge-pill badge-info p-1 rounded">{{translate('provider')}}</span>
                                                            @endif

                                                            @if($item->type == CUSTOMER)
                                                                <span>{{translate('user_Name')}} </span>:
                                                                <span> {{$item->user->f_name}} {{$item->user->l_name}}</span>
                                                                <span class="badge-pill badge-info p-1 rounded">{{translate('Customer')}}</span>
                                                            @endif
                                                        </div>
                                                        <div class="d-flex flex-wrap gap-2 align-items-center">
                                                            <span>{{translate('service_Name')}} </span>:
                                                            <span> {{$item->service_name}} </span>
                                                        </div>
                                                    </div>

                                                    <div class="c1-light-bg rounded py-2 px-3 mt-4 mb-3">
                                                        <h5 class="fw-medium">{{translate('service_Description')}}</h5>
                                                    </div>

                                                    <p>{{$item->service_description}}</p>

                                                    <div class="c1-light-bg rounded py-2 px-3 mt-4 mb-3">
                                                        <h5 class="fw-medium">{{translate('given_Feedback')}}</h5>
                                                    </div>

                                                    <p>{{$item->admin_feedback}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-title fz--14px">
                                    @if($item->admin_feedback)
                                        <div class="max-w-187px fz--14px line--limit-3" data-toggle="modal" data-target="#serviceRequestModal--{{$item['id']}}">
                                            {{Str::limit($item->admin_feedback, 150)}}
                                        </div>
                                    @else
                                        <span class="text--primary" data-text-color="#0177CD">{{translate('No Feedback Given')}}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="d-flex align-items-center gap-2">
                                        @if($item->status == 'approved')
                                            <span  class="btn px-3 min-w-140 text-success" data-bg-color="#039D551A">{{translate('Feedback Sent')}}</span>
                                        @elseif($item->status == 'denied')
                                            <span class="btn px-3 min-w-140 text-danger" data-bg-color="#FF5B5B1A">{{translate('Feedback Sent')}}</span>
                                        @elseif($item->status == 'pending')
                                            <button type="button" class="btn min-w-140 btn--primary" data-toggle="modal" data-target="#review-modal--{{$key}}">
                                            {{translate('Give Feedback')}}
                                            </button>

                                            <div class="modal fade" id="review-modal--{{$key}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header align-items-start text-left">
                                                            <div class="d-flex flex-column gap-1 text-left">
                                                                <h4 class="modal-title">{{translate('Admin Feedback')}}</h4>
                                                                <div class="d-flex gap-1 mt-2">
                                                                    <h5 class="text-muted">{{translate('Category Name')}} : </h5>
                                                                    <div class="fs-12">{{translate($item->category->name??'')}} </div>
                                                                </div>
                                                                <div class="d-flex gap-1">
                                                                    <h5 class="text-muted">{{translate('Service Name')}} : </h5>
                                                                    <div class="fs-12">{{$item->service_name}} </div>
                                                                </div>
                                                            </div>
                                                            <button type="button" class="close bg-white text-dark border d-center w-30px h-30 rounded-circle" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <form action="{{route('admin.service.service.request.update', [$item->id])}}" method="POST">
                                                            @csrf
                                                            <div class="modal-body text-left">
                                                                <div class="form-floating mb-30 text-left">
                                                                    <label class="text-left" for="floatingTextarea">{{translate('Give feedback')}} <small>{{translate('(optional)')}}</small></label>
                                                                    <textarea class="form-control" placeholder="{{translate('Give feedback')}}" name="admin_feedback"></textarea>
                                                                </div>

                                                                <div class="d-flex justify-content-start ml-4">
                                                                    <div class="form-check p-0 gap-2">
                                                                        <input class="form-check-input" type="radio" name="review_status" id="flexRadioDefault{{$key}}" value="1" checked required>
                                                                        <label class="form-check-label" for="flexRadioDefault{{$key}}">{{translate('Review')}}</label>
                                                                    </div>
                                                                    <div class="form-check ml-3">
                                                                        <input class="form-check-input" type="radio" name="review_status" id="flexRadioDefault2{{$key}}" value="0" required>
                                                                        <label class="form-check-label" for="flexRadioDefault2{{$key}}">{{translate('Reject')}}</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn--secondary" data-dismiss="modal">{{translate('Close')}}</button>
                                                                <button type="submit" class="btn btn--primary">{{translate('Submit')}}</button>
                                                            </div>
                                                        </form>
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
        @if(count($requests) !== 0)
            <hr>
        @endif
        <div class="page-area">
            {!! $requests->links() !!}
        </div>
    </div>
</div>
@endsection
