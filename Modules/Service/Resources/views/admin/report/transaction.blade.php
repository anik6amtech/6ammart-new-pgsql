@extends('layouts.admin.app')

@section('title',translate('Transaction_Report'))

@push('css_or_js')

@endpush

@section('content')
<div class="main-content content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-wrap mb-3">
                    <h2 class="page-title">{{translate('Transaction_Reports')}}</h2>
                </div>

                <div class="card mb-20">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-lg-4 col-md-6">
                                <div class="statistics-card p--20 rounded-10 statistics-card__primary flex-grow-1 d-flex gap-2 justify-content-between h-100 align-items-center"
                                    data-bg-color="#AE22FF0D">
                                    <div>
                                        <h2 class="mb-1" data-text-color="#AE22FF">
                                            {{\App\CentralLogics\Helpers::format_currency($adminTotalEarning ?? 0)}}
                                        </h2>
                                        <h3 class="fw-normal fs-14 m-0" data-text-color="#334257B2">
                                            {{translate('Admin_earning')}}</h3>
                                    </div>
                                    <div class="absolute-img position-static align-self-start fs-15"
                                        data-text-color="#AE22FF" data-toggle="tooltip"
                                        data-title="{{translate('Admin balance means total Earning of the admin')}}">
                                        <i class="tio-info"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="statistics-card p--20 rounded-10 statistics-card__info flex-grow-1 d-flex gap-2 justify-content-between h-100 align-items-center"
                                    data-bg-color="#1C8EFF0D">
                                    <div>
                                        <h2 class="mb-1" data-text-color="#1C8EFF">
                                            {{\App\CentralLogics\Helpers::format_currency($commission_earning??0)}}</h2>
                                        <h3 class="fw-normal fs-14 m-0" data-text-color="#334257B2">
                                            {{translate('Admin_commission')}}</h3>
                                    </div>
                                    <div class="absolute-img position-static align-self-start fs-15"
                                        data-text-color="#1C8EFF" data-toggle="tooltip"
                                        data-title="{{translate('Admin balance means total Earning of the admin')}}">
                                        <i class="tio-info"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="statistics-card p--20 rounded-10 statistics-card__ongoing flex-grow-1 flex-grow-1 d-flex gap-2 justify-content-between h-100 align-items-center"
                                    data-bg-color="#3BC5750D">
                                    <div>
                                        <h2 class="mb-1" data-text-color="#3BC575">
                                            {{\App\CentralLogics\Helpers::format_currency($extra_fee)}}</h2>
                                        <h3 class="fw-normal fs-14 m-0" data-text-color="#334257B2">
                                            {{translate('extra_fee')}}</h3>
                                    </div>
                                    <div class="absolute-img position-static align-self-start fs-15"
                                        data-text-color="#3BC575" data-toggle="tooltip"
                                        data-title="{{translate('extra fee means the earning from booking extra fee')}}">
                                        <i class="tio-info"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="statistics-card p--20 rounded-10 statistics-card__subscribed-providers flex-grow-1 flex-grow-1 d-flex gap-2 justify-content-between h-100 align-items-center"
                                    data-bg-color="#F3A7350D">
                                    <div>
                                        <h2 class="mb-1" data-text-color="#F3A735">
                                            {{\App\CentralLogics\Helpers::format_currency(($adminAccount->balance_pending??0))}}
                                        </h2>
                                        <h3 class="fw-normal fs-14 m-0" data-text-color="#334257B2">
                                            {{translate('Pending_Balance')}}</h3>
                                    </div>
                                    <div class="absolute-img position-static align-self-start fs-15"
                                        data-text-color="#F3A735" data-toggle="tooltip"
                                        data-title="{{translate('Pending balance means digitally placed booking amount which is yet to disperse')}}">
                                        <i class="tio-info"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="statistics-card p--20 rounded-10 statistics-card__canceled flex-grow-1 flex-grow-1 d-flex gap-2 justify-content-between h-100 align-items-center"
                                    data-bg-color="#FF67670D">
                                    <div>
                                        <h2 class="mb-1" data-text-color="#FF6767">
                                            {{\App\CentralLogics\Helpers::format_currency($adminAccount->account_payable??0)}}
                                        </h2>
                                        <h3 class="fw-normal fs-14 m-0" data-text-color="#334257B2">
                                            {{translate('Account_Payable')}}</h3>
                                    </div>
                                    <div class="absolute-img position-static align-self-start fs-15"
                                        data-text-color="#FF6767" data-toggle="tooltip"
                                        data-title="{{translate('Account payable means the booking amount that the admin has to pay to the providers')}}">
                                        <i class="tio-info"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="statistics-card p--20 rounded-10 statistics-card__purple flex-grow-1 flex-grow-1 d-flex gap-2 justify-content-between h-100 align-items-center"
                                    data-bg-color="#AA80F90D">
                                    <div>
                                        <h2 class="mb-1" data-text-color="#AA80F9">
                                            {{\App\CentralLogics\Helpers::format_currency($adminAccount->account_receivable??0)}}
                                        </h2>
                                        <h3 class="fw-normal fs-14 m-0" data-text-color="#334257B2">
                                            {{translate('Account_Receivable')}}</h3>
                                    </div>
                                    <div class="absolute-img position-static align-self-start fs-15"
                                        data-text-color="#AA80F9" data-toggle="tooltip"
                                        data-title="{{translate('Account receivable means the booking commission that the admin will get from the providers for Cash After the Services')}}">
                                        <i class="tio-info"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-20">
                    <div class="card-body">
                        <div class="mb-3 fs-16 text-dark">{{translate('Search_Data')}}</div>
                        <form
                            action="{{route('admin.transactions.service.report.transaction', ['transaction_type'=>$queryParams['transaction_type']])}}"
                            method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-4 col-sm-6 mb-20 search-data__field">
                                    <label class="mb-2 fs-14 text-dark">{{translate('zone')}}</label>
                                    <select class="js-select2-custom zone__select js-select2-counting" name="zone_ids[]" multiple="multiple"
                                        id="zone_selector__select">
                                        <option value="0" disabled>{{translate('Select Zone')}}</option>
                                        <option value="all">{{translate('Select All')}}</option>
                                        @foreach($zones as $zone)
                                        <option value="{{$zone['id']}}"
                                            {{array_key_exists('zone_ids', $queryParams) && in_array($zone['id'], $queryParams['zone_ids']) ? 'selected' : '' }}>
                                            {{$zone['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-4 col-sm-6 mb-20 search-data__field">
                                    <label class="mb-2 fs-14 text-dark">{{translate('provider')}}</label>
                                    <select class="js-select2-custom js-select2-counting provider__select" name="provider_ids[]"
                                        id="provider_selector__select" multiple>
                                        <option value="all">{{translate('Select All')}}</option>
                                        @foreach($providers as $provider)
                                        <option value="{{$provider['id']}}"
                                            {{array_key_exists('provider_ids', $queryParams) && in_array($provider['id'], $queryParams['provider_ids']) ? 'selected' : '' }}>
                                            {{$provider['company_name']}} ({{$provider['company_phone']}})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-4 col-sm-6 mb-20 d-none">
                                    <label class="mb-2 fs-14 text-dark">{{translate('type')}}</label>
                                    <select class="js-select type__select" id="filter-by" name="filter_by">
                                        <option value="all"
                                            {{array_key_exists('filter_by', $queryParams) && $queryParams['filter_by']=='all'?'selected':''}}>
                                            {{translate('All')}}</option>
                                        <option value="collect_cash"
                                            {{array_key_exists('filter_by', $queryParams) && $queryParams['filter_by']=='collect_cash'?'selected':''}}>
                                            {{translate('Collect Cash')}}</option>
                                        <option value="withdraw"
                                            {{array_key_exists('filter_by', $queryParams) && $queryParams['filter_by']=='withdraw'?'selected':''}}>
                                            {{translate('withdraw')}}</option>
                                        <option value="payment"
                                            {{array_key_exists('filter_by', $queryParams) && $queryParams['filter_by']=='payment'?'selected':''}}>
                                            {{translate('payment')}}</option>
                                        <option value="commission"
                                            {{array_key_exists('filter_by', $queryParams) && $queryParams['filter_by']=='commission'?'selected':''}}>
                                            {{translate('commission')}}</option>
                                    </select>
                                </div>
                                <div class="col-lg-4 col-sm-6 mb-20 search-data__field">
                                    <label class="mb-2 fs-14 text-dark">{{translate('date_range')}}</label>
                                    <select class="js-select h-40 fs-12 form-control" id="date-range" name="date_range">
                                        <option value="0" disabled selected>{{translate('Select Date Range')}}</option>
                                        <option value="all_time"
                                            {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='all_time'?'selected':''}}>
                                            {{translate('All_Time')}}</option>
                                        <option value="this_week"
                                            {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='this_week'?'selected':''}}>
                                            {{translate('This_Week')}}</option>
                                        <option value="last_week"
                                            {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='last_week'?'selected':''}}>
                                            {{translate('Last_Week')}}</option>
                                        <option value="this_month"
                                            {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='this_month'?'selected':''}}>
                                            {{translate('This_Month')}}</option>
                                        <option value="last_month"
                                            {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='last_month'?'selected':''}}>
                                            {{translate('Last_Month')}}</option>
                                        <option value="last_15_days"
                                            {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='last_15_days'?'selected':''}}>
                                            {{translate('Last_15_Days')}}</option>
                                        <option value="this_year"
                                            {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='this_year'?'selected':''}}>
                                            {{translate('This_Year')}}</option>
                                        <option value="last_year"
                                            {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='last_year'?'selected':''}}>
                                            {{translate('Last_Year')}}</option>
                                        <option value="last_6_month"
                                            {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='last_6_month'?'selected':''}}>
                                            {{translate('Last_6_Month')}}</option>
                                        <option value="this_year_1st_quarter"
                                            {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='this_year_1st_quarter'?'selected':''}}>
                                            {{translate('This_Year_1st_Quarter')}}</option>
                                        <option value="this_year_2nd_quarter"
                                            {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='this_year_2nd_quarter'?'selected':''}}>
                                            {{translate('This_Year_2nd_Quarter')}}</option>
                                        <option value="this_year_3rd_quarter"
                                            {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='this_year_3rd_quarter'?'selected':''}}>
                                            {{translate('This_Year_3rd_Quarter')}}</option>
                                        <option value="this_year_4th_quarter"
                                            {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='this_year_4th_quarter'?'selected':''}}>
                                            {{translate('this_year_4th_quarter')}}</option>
                                        <option value="custom_date"
                                            {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='custom_date'?'selected':''}}>
                                            {{translate('Custom_Date')}}</option>
                                    </select>
                                </div>
                                <div class="col-lg-4 col-sm-6 {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='custom_date'?'':'d-none'}}"
                                    id="from-filter__div">
                                    <div class="form-floating mb-30">
                                        <label class=" mb-2 text-dark" for="from">{{translate('From')}}</label>
                                        <input type="date" class="form-control" id="from" name="from"
                                            value="{{array_key_exists('from', $queryParams)?$queryParams['from']:''}}">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6 {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='custom_date'?'':'d-none'}}"
                                    id="to-filter__div">
                                    <div class="form-floating mb-30">
                                        <label class=" mb-2 text-dark" for="to">{{translate('To')}}</label>
                                        <input type="date" class="form-control" id="to" name="to"
                                            value="{{array_key_exists('to', $queryParams)?$queryParams['to']:''}}">
                                    </div>
                                </div>
                                <div class="col-12 d-flex gap-3 justify-content-end">
                                    <button type="reset" class="btn btn--reset btn-sm">{{translate('Reset')}}</button>
                                    <button type="submit" class="btn btn--primary btn-sm">{{translate('Submit')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div
                    class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <ul class="nav nav--tabs">
                        <li class="nav-item">
                            <a class="nav-link {{!isset($queryParams['transaction_type']) || $queryParams['transaction_type']=='all'?'active':''}}"
                                href="{{url()->current()}}?transaction_type=all">{{translate('All')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{isset($queryParams['transaction_type']) && $queryParams['transaction_type']=='debit'?'active':''}}"
                                href="{{url()->current()}}?transaction_type=debit">{{translate('Debit')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{isset($queryParams['transaction_type']) && $queryParams['transaction_type']=='credit'?'active':''}}"
                                href="{{url()->current()}}?transaction_type=credit">{{translate('Credit')}}</a>
                        </li>
                    </ul>
                    {{--<div class="d-flex gap-2 fw-medium">
                        <span class="opacity-75 text-dark">{{translate('Total_Transactions')}}: </span>
                        <span class="title-color text-dark">{{$filteredTransactions->total()}}</span>
                    </div>--}}
                </div>
                <div class="card mt-3">
                    <div class="card-body p-0">
                        <div class="data-table-top py-3 px-3 d-flex align-items-center flex-wrap gap-3 justify-content-between">
                            <div class="d-flex gap-2 fw-medium">
                                <span class="opacity-75 text-dark">{{translate('Total_Transactions')}}: </span>
                                <span class="title-color text-dark">{{$filteredTransactions->total()}}</span>
                            </div>
                            <div class="d-flex align-items-center justiy-content-end gap-3 flex-wrap">
                                <form action="{{url()->current()}}" class="search-form rounded overflow-hidden d-flex align-items-center search-form_style-two" method="GET">
                                    <div class="input-group d-flex search-form__input_group">
                                        <!-- <span class="search-form__icon">
                                            <span class="material-icons">search</span>
                                        </span> -->
                                        <input type="search" class="theme-input-style form-control rounded-0 h-40 search-form__input"
                                            value="{{$queryParams['search']??''}}" name="search"
                                            placeholder="{{translate('search by transaction ID')}}">
                                    </div>
                                    <button type="submit" class="btn px-sm-3 px-2  btn--primary h-40 rounded-0"><i class="tio-search"></i></button>
                                </form>
                                <div class="d-flex flex-wrap align-items-center gap-3">
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-sm text-capitalize min-height-40 font-medium rounded border text--title dropdown-toggle"
                                            data-toggle="dropdown">
                                            <i class="tio-download-to"></i> {{translate('Export')}}
                                        </button>
                                        <ul class="dropdown-menu z--2 bg-white dropdown-menu-lg dropdown-menu-right">
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{route('admin.transactions.service.report.transaction.download').'?'.http_build_query($queryParams)}}">
                                                    {{translate('Excel')}}
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                {{-- @can('report_export')
                                <div class="d-flex flex-wrap align-items-center gap-3">
                                    <div class="dropdown">
                                        <button type="button" class="btn btn--secondary text-capitalize dropdown-toggle"
                                            data-toggle="dropdown">
                                            <span class="material-icons">file_download</span> {{translate('download')}}
                                        </button>
                                        <ul class="dropdown-menu bg-white dropdown-menu-lg dropdown-menu-right">
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{route('admin.transactions.service.report.transaction.download').'?'.http_build_query($queryParams)}}">
                                                    {{translate('Excel')}}
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                @endcan --}}
                            </div>
                        </div>

                        <div class="table-responsive pb-0">
                            <table class="table m-0 align-middle align-middle-cus table-borderless">
                                <thead class="text-nowrap z--0" data-bg-color="#F3F8F8">
                                    <tr>
                                        <th class="border-0">{{translate('SL')}}</th>
                                        <th class="border-0">{{translate('Transaction_ID')}}</th>
                                        <th class="border-0">{{translate('Transaction_Date')}}</th>
                                        <th class="border-0">{{translate('Transaction_From')}}</th>
                                        <th class="border-0">{{translate('Transaction_To')}}</th>
                                        <th class="border-0">{{translate('Debit')}}</th>
                                        <th class="border-0">{{translate('Credit')}}</th>
                                        <th class="border-0">{{translate('Balance')}}</th>
                                        <th class="border-0">{{translate('Transaction Type')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($filteredTransactions as $key=>$transaction)
                                    <tr>
                                        <td>{{$filteredTransactions->firstitem()+$key}}</td>
                                        <td>{{$transaction->id}}</td>
                                        <td>
                                            <div>
                                                <div>{{date('d-M-Y',strtotime($transaction->created_at))}}</div>
                                                <div>{{date('h:ia',strtotime($transaction->created_at))}}</div>
                                            </div>
                                        </td>

                                        <td>
                                            @if($transaction->from_user_type == 'admin')
                                                {{translate('Admin')}}
                                            @elseif($transaction->from_user_type == 'provider' && isset($transaction->from_provider))
                                                {{$transaction?->from_provider?->company_name}}
                                            @elseif($transaction->from_user_type == 'customer' && isset($transaction->from_user))
                                                {{$transaction?->from_user?->full_name}}
                                            @else
                                                {{translate('User_Unavailable')}}
                                            @endif
                                        </td>
                                        <td>
                                            @if($transaction->to_user_type == 'admin')
                                                {{translate('Admin')}}
                                            @elseif($transaction->to_user_type == 'provider' && isset($transaction->to_provider))
                                                {{$transaction?->to_provider?->company_name}}
                                            @elseif($transaction->to_user_type == 'customer' && isset($transaction->to_user))
                                                {{$transaction?->to_user?->full_name}}
                                            @else
                                                {{translate('User_Unavailable')}}
                                            @endif
                                        </td>
                    <td> -
                        @if($transaction->debit > 0)
                        <span>{{\App\CentralLogics\Helpers::format_currency($transaction->debit)}}</span>
                        @else
                        <span
                            class="disabled">{{\App\CentralLogics\Helpers::format_currency($transaction->debit)}}</span>
                        @endif
                    </td>
                    <td>+
                        @if($transaction->credit > 0)
                        <span>{{\App\CentralLogics\Helpers::format_currency($transaction->credit)}}</span>
                        @else
                        <span
                            class="disabled">{{\App\CentralLogics\Helpers::format_currency($transaction->credit)}}</span>
                        @endif
                    </td>
                    <td>
                        @if($transaction->balance > 0)
                        <span>{{\App\CentralLogics\Helpers::format_currency($transaction->balance)}}</span>
                        @else
                        <span
                            class="disabled">{{\App\CentralLogics\Helpers::format_currency($transaction->balance)}}</span>
                        @endif
                    </td>
                    <td>
                        <span>{{str_replace('_', ' ', $transaction->trx_type)}}</span>
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
            @if(count($filteredTransactions) !== 0)
                <hr>
            @endif
            <div class="page-area">
                {!! $filteredTransactions->links() !!}
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection

@push('script_2')

<script>
"use strict"

$('#zone_selector__select').on('change', function() {
    var selectedValues = $(this).val();
    if (selectedValues !== null && selectedValues.includes('all')) {
        $(this).find('option').not(':disabled').prop('selected', 'selected');
        $(this).find('option[value="all"]').prop('selected', false);
    }
});

$('#provider_selector__select').on('change', function() {
    var selectedValues = $(this).val();
    if (selectedValues !== null && selectedValues.includes('all')) {
        $(this).find('option').not(':disabled').prop('selected', 'selected');
        $(this).find('option[value="all"]').prop('selected', false);
    }
});

$(document).ready(function() {
    $('.zone__select').select2({
        placeholder: "{{translate('Select_zone')}}",
    });
    $('.provider__select').select2({
        placeholder: "{{translate('Select_provider')}}",
    });
    $('.type__select').select2({
        placeholder: "{{translate('Select_Type')}}",
    });
});

$(document).ready(function() {
    $('#date-range').on('change', function() {
        if (this.value === 'custom_date') {
            $('#from-filter__div').removeClass('d-none');
            $('#to-filter__div').removeClass('d-none');
        }
        if (this.value !== 'custom_date') {
            $('#from-filter__div').addClass('d-none');
            $('#to-filter__div').addClass('d-none');
        }
    });
});
</script>
@endpush
