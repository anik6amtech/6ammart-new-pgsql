@extends('service::provider.layouts.app')

@section('title', translate('Advertisement List'))

@push('css_or_js')

@endpush

@section('content')
<div class="content container-fluid overflow-hidden">



    @if ($ads_count == 0)




    <h1 class="page-header-title mb-3">{{ translate('Advertisement List') }}</h1>

    <div class="card">
        <div class="card-body">
            <div class="text-center max-w-700 mb-10 mt-10 mx-auto pt-5">
                <img src="{{asset('public/assets/admin/img/advertisement-list.png')}}" class="mw-100 mb-3" alt="">
                <h4 class="mb-2">{{ translate('Advertisement List') }}</h4>
                <p class="mb-4">{{ translate('Create an advertisement for your targeted audience, as none has been created yet.') }}</p>
                {{-- <div class="pb-4">
                    <a href="{{ route('vendor.advertisement.create') }}" class="btn btn--primary">{{ translate('Create Ads') }}</a>
                </div> --}}
                {{-- <hr>
                <div class="max-w-471 mx-auto fs-12 py-4">
                    {{ translate('By') }} <strong>{{ translate('Creating Advertisement') }}</strong> {{ translate('you can showcase your items or store to a wider audience through targeted ad campaigns.') }}
                </div> --}}
            </div>
        </div>
    </div>

    @else


    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="page-header-title d-flex align-items-center gap-2">
            <img src="{{asset('public/assets/admin/img/advertisement.png')}}" alt="">
            {{ translate('messages.Ads_list') }}
            <span class="badge badge-soft-dark ml-2">{{ $adds->total() }}</span>
        </h1>
        <a href="{{ route('provider.service.advertisement.create') }}" class="btn btn-primary">  <i class="tio-add"></i> {{ translate('New Advertisement') }}</a>
    </div>
    <!-- Title -->


    <div class="card">

        <div class="card-header py-2 border-0">
            <div class="search--button-wrapper">
            <h5 class="card-title"></h5>
            <form >
                <!-- Search -->
                <div class="input--group input-group input-group-merge input-group-flush">
                    <input id="datatableSearch" type="search" name="search"  value="{{ request()?->search ?? null }}"  class="form-control" placeholder="{{ translate('Search by ads ID') }}" aria-label="{{translate('messages.search_here')}}">
                    <button type="submit" class="btn btn--secondary"><i class="tio-search"></i></button>
                </div>
                <!-- End Search -->
            </form>
            <div class="select-item min-w-135px">
                <select name="subscription_list" class="form-control js-select2-custom set-filter"
                data-url="{{url()->full()}}" data-filter="ads_type">
                    <option  value="all">{{translate('messages.All Ads')}}</option>
                    <option {{ request()?->ads_type =='running'?'selected':''}} value="running">{{translate('running')}} </option>
                    <option {{request()?->ads_type =='paused'?'selected':''}} value="paused">{{translate('paused')}} </option>
                    <option {{request()?->ads_type =='approved'?'selected':''}} value="approved">{{translate('approved')}} </option>
                    <option {{request()?->ads_type =='expired'?'selected':''}} value="expired">{{translate('expired')}} </option>
                </select>
            </div>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive datatable-custom">
                <table class="font-size-sm table table-borderless table-thead-bordered table-nowrap table-align-middle card-table min-h-225px">
                    <thead class="thead-light">
                        <tr>
                            <th>{{ translate('sl') }}</th>
                            <th >{{translate('Ads ID')}}</th>
                            <th >{{translate('Ads Title')}}</th>
                            {{-- <th >{{translate('Store Info')}}</th> --}}
                            <th >{{translate('Ads Type')}}</th>
                            <th >{{translate('Duration')}}</th>
                            <th >{{translate('Status')}}</th>
                            <th >{{translate('Priority')}}</th>
                            <th >{{translate('Action')}}</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($adds as $key=> $add)

                        <tr>

                            <td>{{$key+$adds->firstItem()}}</td>
                            <td> <a href="{{ route('provider.service.advertisement.show',$add->id) }}"> {{ $add->id }}</a></td>
                            <td>{{ Str::limit($add->title, 20) }}</td>
                            {{-- <td>
                                <a class="media align-items-center text-body" href="{{route('admin.store.view', $add?->store_id)}}">
                                    <img class="avatar avatar-lg mr-3" src="{{ $add->store['logo_full_path'] ?? asset('public/assets/admin/img/100x100/food-default-image.png') }}" alt="">
                                    <div class="media-body">
                                        <h5 class="mb-0">{{ $add?->store?->company_name }}</h5>
                                        <small class="text-body">{{ $add?->store?->email }}</small>
                                    </div>
                                </a>
                            </td> --}}

{{--                            <td>{{ translate($add?->add_type == 'store_promotion' ? 'Provider Promotion' : $add?->add_type) }}</td>--}}

                            <td>{{ translate($add?->add_type) }} </td>

                            <td>
                                {{  \App\CentralLogics\Helpers::date_format($add->start_date) }} - <br> {{  \App\CentralLogics\Helpers::date_format($add->end_date) }}
                            </td>
                            <td>
                                @if ($add->status == 'approved' && $add->active == 1 )
                                <label class="badge badge-soft-primary rounded-pill">{{ translate('messages.running') }}</label>
                                @elseif ($add->status == 'approved' && $add->active == 2 )
                                <label class="badge badge-soft-success rounded-pill">{{ translate('messages.approved') }}</label>
                                @elseif ($add->status == 'paused' && $add->active == 1 )
                                <label class="badge badge-soft-warning rounded-pill">{{ translate('messages.paused') }}</label>
                                @elseif (in_array($add->status ,['denied','expired'] ))
                                <label class="badge badge-soft-danger rounded-pill">{{ translate($add->status) }}</label>
                                @elseif ($add->active == 0)
                                <label class="badge badge-soft-secondary rounded-pill">{{ translate('messages.Expired') }}</label>
                                @else
                                <label class="badge badge-soft-info rounded-pill">{{ translate($add->status) }}</label>
                                @endif

                            </td>
                            <td>
                                @if ( in_array($add->status ,['denied','expired']) || $add->active == 0)
                                <div class="d-flex align-items-center gap-2 ml-3" data-toggle="tooltip" title="{{ translate('Expired & Denied ads has no priority.') }}">
                                    <span>{{  translate('N/A') }}</span> <img src="{{asset('public/assets/admin/img/na.png')}}" alt="">
                                </div>
                                @else
                                    @if($add?->priority == null || $add?->priority == 0)
                                        <span>{{  translate('N/A') }}</span> <img src="{{asset('public/assets/admin/img/na.png')}}" alt="">
                                    @else
                                        <span>{{  $add?->priority }}</span>
                                    @endif

                                @endif
                            </td>

                            <td>
                                <div class="dropdown dropdown-2">
                                    <button type="button" class="bg-transparent border rounded px-2 py-1 title-color" data-toggle="dropdown" aria-expanded="false">
                                        <i class="tio-more-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu" dir="ltr">
                                        <a class="dropdown-item d-flex gap-2 align-items-center" href="{{ route('provider.service.advertisement.show',$add->id) }}">
                                            <i class="tio-visible-outlined"></i>
                                            {{ translate('View Ads') }}
                                        </a>

                                        @if ($add->active == 0)
                                        <a class="dropdown-item d-flex gap-2 align-items-center" href="{{ route('provider.service.advertisement.edit',$add->id) }}">
                                            <i class="tio-edit"></i>
                                            {{ translate('Edit & Resubmit Ads') }}
                                            </a>

                                            @else
                                            <a class="dropdown-item d-flex gap-2 align-items-center" href="{{ route('provider.service.advertisement.edit',$add->id) }}">
                                                <i class="tio-edit"></i>
                                                {{ translate('Edit Ads') }}
                                            </a>
                                        @endif




                                        @if($add->status == 'paused')
                                            <a class="dropdown-item d-flex gap-2 align-items-center new-dynamic-submit-model"


                                            id="data-add-{{ $add->id }}"
                                            data-id="data-add-{{ $add->id }}"

                                            data-title="{{translate('Are you sure you want to Resume the request?')}}"
                                            data-text="<p>{{translate('This ad will be run again and will show in the user app & websites.')}}</p>"
                                            data-image="{{asset('public/assets/admin/img/modal/resume.png')}}"
                                            data-type="resume"
                                            data-btn_class = "btn-primary"


                                            href="#">
                                                <i class="tio-pause-circle"></i>
                                                {{ translate('Resume_Ads') }}
                                            </a>

                                            <form  id="data-add-{{ $add->id }}_form" action="{{ route('provider.service.advertisement.status',['status' => 'approved' ,'id' => $add->id]) }}" method="get">
                                                @csrf
                                                @method('get')
                                                <input type="hidden"  name="status" value="approved">
                                                <input type="hidden"  name="id" value="{{ $add->id }}">
                                            </form>




                                        @elseif($add->status == 'approved' && $add->active == 1)
                                        <a class="dropdown-item d-flex gap-2 align-items-center new-dynamic-submit-model"
                                        id="data-add-{{ $add->id }}"
                                        data-id="data-add-{{ $add->id }}"
                                        data-title="{{translate('Are you sure you want to Pause the request?')}}"
                                        data-text="<p>{{translate('This ad will be pause and not show in the user app & websites.')}}</p>"
                                        data-image="{{asset('public/assets/admin/img/modal/pause.png')}}"
                                        data-type="pause"

                                        href="#">
                                            <i class="tio-pause-circle"></i>
                                            {{ translate('Pause_Ads') }}
                                            </a>

                                            <form  id="data-add-{{ $add->id }}_form" action="{{ route('provider.service.advertisement.status',['status' => 'paused' ,'id' => $add->id]) }}" method="get">
                                                @csrf
                                                @method('get')
                                                <input type="hidden"  name="pause_note" id="data-add-{{ $add?->id }}_note">
                                                <input type="hidden"  name="status" value="paused">
                                                <input type="hidden"  name="id" value="{{ $add->id }}">
                                            </form>
                                        @endif

                                        <a class="dropdown-item d-flex gap-2 align-items-center new-dynamic-submit-model"
                                        id="delete-add-{{ $add->id }}"
                                            data-id="delete-add-{{ $add->id }}"
                                            @if ($add->status != 'paused' && $add->active == 1)
                                                data-title="{{translate('You can’t delete the ad')}}"
                                                data-text="<p>{{translate('This Advertisement is currently running, To delete this ad from the list, please pause the Ad first . Once the status is updated, you can proceed with deletion')}}</p>"
                                                data-image="{{asset('public/assets/admin/img/modal/package-status-disable.png')}}"
                                                data-type="warning"
                                            @else
                                                data-type="delete"
                                                data-title="{{translate('Confirm Ad Deletion')}}"
                                                data-text="<p>{{translate('Deleting this ad will remove it permanently. Are you sure you want to proceed?')}}</p>"
                                                data-image="{{asset('public/assets/admin/img/modal/delete-icon.png')}}"
                                            @endif
                                            >
                                            <i class="tio-delete"></i>
                                            {{ translate('Delete_Ads') }}
                                            </a>
                                            <form  id="delete-add-{{ $add->id }}_form" action="{{ route('provider.service.advertisement.destroy',$add->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                            </form>
                                    </ul>
                                </div>
                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
                @if(count($adds) === 0)
                <div class="empty--data">
                    <img src="{{asset('/public/assets/admin/svg/illustrations/sorry.svg')}}" alt="public">
                    <h5>
                        {{translate('no_data_found')}}
                    </h5>
                </div>
                @endif
                <div class="page-area px-4 pb-3">
                    <div class="d-flex align-items-center justify-content-end">
                        <div>
                            {!! $adds->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endif


</div>





@endsection

@push('script_2')
<script>
    $(document).ready(function() {


    $('.update-priority').on('change', function() {


        let update_priority_value = $(this).val();
        let update_priority_old_value = $(this).data('priority_old_value');
        let update_priority_id = $(this).data('prority_id');

        $('#update_priority_value').val(update_priority_value)
        $('#update_priority_old_value').val(update_priority_old_value)
        $('#update_priority_id').val(update_priority_id)
        $('#priority-update-modal').modal('show')
    });
    $('#reset_btn').on('click', function() {

        $('#update_priority_id').val()

        $('#select_option_'+$('#update_priority_id').val()).val( $('#update_priority_old_value').val()
        ).trigger('change');

    });

});

</script>
@endpush
