@extends('layouts.admin.app')

@section('title', translate('discount_list'))

@push('css_or_js')

@endpush

@section('content')

<div class="content container-fluid">
    <!-- Page Title -->
    <h2 class="h1 mb-sm-3 mb-2 text-capitalize d-flex align-items-center gap-2">
        {{ translate('discount_list') }}
    </h2>
    <!-- Nav -->
    <div class="js-nav-scroller hs-nav-scroller-horizontal mb-20">
        <ul class="nav nav-tabs align-items-start border-0 gap-20px nav--tabs tabs__style-border">
            <li class="nav-item">
                <a class="nav-link {{$type=='all'?'active':''}}"
                    href="{{url()->current()}}?type=all">
                    {{translate('all')}}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{$type=='service'?'active':''}}"
                    href="{{url()->current()}}?type=service">
                    {{translate('service_wise')}}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{$type=='category'?'active':''}}"
                    href="{{url()->current()}}?type=category">
                    {{translate('category_wise')}}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{$type=='mixed'?'active':''}}"
                    href="{{url()->current()}}?type=mixed">
                    {{translate('mixed')}}
                </a>
            </li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade show active" >
            <div class="card">
                <div class="data-table-top border-bottom d-flex align-items-center flex-wrap gap-3 justify-content-between p-3">
                    <h4 class="text-title mb-0">{{ translate('all_discounts') }}</h4>
                    <div class="d-flex flex-wrap align-items-center gap-3">
                        <form action="" method="GET">
                            <div class="input-group input-group-custom input-group-merge">
                                <input id="datatableSearch_" type="search" name="search" class="form-control"
                                    placeholder="{{ translate('search_by_name') }}" aria-label="{{ translate('search_by_name') }}" value="{{ request()->search }}" required="">
                                <button type="submit" class="btn btn--primary input-group-text"><i
                                        class="tio-search fz-15px"></i></button>
                            </div>
                        </form>
                       <div class="hs-unfold mr-2">
                            <a class="js-hs-unfold-invoker btn btn-sm btn-white dropdown-toggle h--45px border" href="javascript:;" data-hs-unfold-options="{
                                    &quot;target&quot;: &quot;#usersExportDropdown&quot;,
                                    &quot;type&quot;: &quot;css-animation&quot;
                                }" data-hs-unfold-target="#usersExportDropdown" data-hs-unfold-invoker="">
                                <i class="tio-download-to mr-1"></i> {{ translate('export') }}
                            </a>

                            <div id="usersExportDropdown" class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right hs-unfold-content-initialized hs-unfold-css-animation animated hs-unfold-hidden" data-hs-target-height="131.516" data-hs-unfold-content="" data-hs-unfold-content-animation-in="slideInUp" data-hs-unfold-content-animation-out="fadeOut" style="animation-duration: 300ms;">
                                <span class="dropdown-header">{{ translate('download_options') }}</span>
                                <a id="export-excel" class="dropdown-item" href="{{route('admin.service.discount.download')}}?search={{$search}}&type={{$type}}">
                                    <img class="avatar avatar-xss avatar-4by3 mr-2" src="{{ asset('public/assets/admin/svg/components/excel.svg') }}" alt="Image Description">
                                    {{ translate('excel') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="table-responsive">
                        <table id="example" class="table m-0 align-middle table-custom-space tr-hover">
                            <thead class="text-nowrap bg-light">
                                <tr>
                                    <th class="fz--14px text-title border-0">{{ translate('sl') }}</th>
                                    <th class="fz--14px text-title border-0">{{ translate('discount_title') }}</th>
                                    <th class="fz--14px text-title border-0">{{ translate('discount_type') }}</th>
                                    <th class="fz--14px text-title border-0">{{ translate('zones') }}</th>
                                    <th class="fz--14px text-title border-0">{{ translate('discount_duration') }}</th>
                                    <th class="fz--14px text-title border-0">{{ translate('amount') }}</th>
                                    <th class="fz--14px text-title border-0">{{ translate('status') }}</th>
                                    <th class="fz--14px text-title border-0 text-center">{{ translate('action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($discounts as $key => $discount)
                                    <tr>
                                        <td>{{$key+$discounts->firstItem()}}</td>
                                        <td>{{$discount->discount_title}}</td>
                                        <td>{{$discount->discount_type}}</td>
                                        <td>
                                            @foreach($discount->zone_types as $type)
                                                {{$type->zone?$type->zone->name.',':''}}
                                            @endforeach
                                        </td>
                                        <td>
                                            @if($discount->start_date && $discount->end_date)
                                                {{ \App\CentralLogics\Helpers::date_format($discount->start_date) }}
                                                -
                                                {{ \App\CentralLogics\Helpers::date_format($discount->end_date) }}
                                            @else
                                                {{translate('no_duration')}}
                                            @endif
                                        </td>
                                        <td>
                                            @if($discount->discount_amount_type == 'percent')
                                                {{ $discount->discount_amount }}%
                                            @else
                                                {{ \App\CentralLogics\Helpers::format_currency($discount->discount_amount) }}
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <label class="toggle-switch toggle-switch-sm" for="statusCheckbox{{$discount->id}}">
                                                    <input type="checkbox"
                                                    data-id="statusCheckbox{{$discount->id}}"
                                                    data-type="status"
                                                    data-image-on="{{ asset('/public/assets/admin/img/modal/basic_campaign_on.png') }}"
                                                    data-image-off="{{ asset('/public/assets/admin/img/modal/basic_campaign_off.png') }}"
                                                    data-title-on="{{ translate('By_Turning_ON_discount!') }}"
                                                    data-title-off="{{ translate('By_Turning_OFF_discount!') }}"
                                                    data-text-on="<p>{{ translate('If_you_turn_on_this_status,_it_will_show_on_user_app.') }}</p>"
                                                    data-text-off="<p>{{ translate('If_you_turn_off_this_status,_it_won’t_show_on_user_app') }}</p>"
                                                    class="toggle-switch-input  dynamic-checkbox" id="statusCheckbox{{$discount->id}}" {{$discount->is_active?'checked':''}}>
                                                    <span class="toggle-switch-label">
                                                        <span class="toggle-switch-indicator"></span>
                                                    </span>
                                                </label>
                                                <form action="{{route('admin.service.discount.status-update',['id' => $discount->id, 'status' => $discount->is_active?0:1])}}"
                                                method="get" id="statusCheckbox{{$discount->id}}_form">
                                                    <input type="hidden" name="status" value="{{$discount->is_active?0:1}}">
                                                    <input type="hidden" name="id" value="{{$discount->id}}">
                                                </form>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="btn--container justify-content-center">
                                                <a class="btn action-btn btn-outline-edit" href="{{route('admin.service.discount.edit', ['id'=>$discount->id])}}"
                                                    title="{{translate('messages.edit')}}"><i class="fi fi-sr-pencil"></i>
                                                </a>
                                                <a class="btn action-btn btn--danger btn-outline-danger form-alert" href="javascript:"
                                                    data-id="delete-{{ $discount->id }}" data-message="{{ translate('Want to delete this ?') }}">
                                                    <i class="fi fi-rr-trash"></i>
                                                </a>
                                                <form action="{{ route('admin.service.discount.delete', ['id'=>$discount->id]) }}"
                                                                            id="delete-{{ $discount->id }}" method="post" >
                                                    @csrf @method('delete')
                                                </form>
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
                @if(count($discounts) !== 0)
                    <hr>
                @endif
                <div class="page-area">
                    {!! $discounts->links() !!}
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('script_2')



@endpush
