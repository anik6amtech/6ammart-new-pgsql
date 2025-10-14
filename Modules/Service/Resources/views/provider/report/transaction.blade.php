@extends('service::provider.layouts.app')

@section('title',translate('Transaction_Reports'))

@push('css_or_js')

@endpush

@section('content')
    <div class="main-content content content-provider">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-wrap mb-3">
                        <h2 class="page-title">{{translate('Transaction_Reports')}}</h2>
                    </div>

                    <div class="card mb-20">
                        <div class="card-body">
                            <div class="mb-3 fw-bold text-dark fs-16">{{translate('Search_Data')}}</div>
                            <form
                                action="{{route('provider.service.report.transaction', ['transaction_type'=>$queryParams['transaction_type']])}}"
                                method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-4 col-sm-6 mb-20 search-data__field">
                                        <label class="mb-2 fs-14 text-dark">{{translate('date_range')}}</label>
                                        <select class="js-select h-40 fs-12 form-control" id="date-range" name="date_range">
                                            <option value="0" disabled selected>{{translate('Date_Range')}}</option>
                                            <option
                                                value="all_time" {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='all_time'?'selected':''}}>{{translate('All_Time')}}</option>
                                            <option
                                                value="this_week" {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='this_week'?'selected':''}}>{{translate('This_Week')}}</option>
                                            <option
                                                value="last_week" {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='last_week'?'selected':''}}>{{translate('Last_Week')}}</option>
                                            <option
                                                value="this_month" {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='this_month'?'selected':''}}>{{translate('This_Month')}}</option>
                                            <option
                                                value="last_month" {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='last_month'?'selected':''}}>{{translate('Last_Month')}}</option>
                                            <option
                                                value="last_15_days" {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='last_15_days'?'selected':''}}>{{translate('Last_15_Days')}}</option>
                                            <option
                                                value="this_year" {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='this_year'?'selected':''}}>{{translate('This_Year')}}</option>
                                            <option
                                                value="last_year" {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='last_year'?'selected':''}}>{{translate('Last_Year')}}</option>
                                            <option
                                                value="last_6_month" {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='last_6_month'?'selected':''}}>{{translate('Last_6_Month')}}</option>
                                            <option
                                                value="this_year_1st_quarter" {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='this_year_1st_quarter'?'selected':''}}>{{translate('This_Year_1st_Quarter')}}</option>
                                            <option
                                                value="this_year_2nd_quarter" {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='this_year_2nd_quarter'?'selected':''}}>{{translate('This_Year_2nd_Quarter')}}</option>
                                            <option
                                                value="this_year_3rd_quarter" {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='this_year_3rd_quarter'?'selected':''}}>{{translate('This_Year_3rd_Quarter')}}</option>
                                            <option
                                                value="this_year_4th_quarter" {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='this_year_4th_quarter'?'selected':''}}>{{translate('this_year_4th_quarter')}}</option>
                                            <option
                                                value="custom_date" {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='custom_date'?'selected':''}}>{{translate('Custom_Date')}}</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-sm-6 {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='custom_date'?'':'d-none'}} align-self-end"
                                        id="from-filter__div">
                                        <div class="form-floating mb-30">
                                            <label for="from" class="mb-2 text--clr fs-14">{{translate('From')}}</label>
                                            <input type="date" class="form-control" id="from" name="from"
                                                   value="{{array_key_exists('from', $queryParams)?$queryParams['from']:''}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6 {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='custom_date'?'':'d-none'}} align-self-end"
                                        id="to-filter__div">
                                        <div class="form-floating mb-30">
                                            <label for="to" class="mb-2 text--clr fs-14">{{translate('To')}}</label>
                                            <input type="date" class="form-control" id="to" name="to"
                                                   value="{{array_key_exists('to', $queryParams)?$queryParams['to']:''}}">
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end gap-3">
                                        <button type="reset" class="btn btn--reset btn-sm">{{translate('Reset')}}</button>
                                        <button type="submit" class="btn btn--primary btn-sm">{{translate('Submit')}}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card mb-20">
                        <div class="card-body">
                            <div class="d-flex flex-wrap gap-3">
                                <div class="statistics-card p--20 rounded-10 h-100 d-flex gap-2 justify-content-between statistics-card__total-orders  flex-grow-1" data-bg-color="#AE22FF0D">
                                    <div>
                                        <h2 class="mb-1 fs-24" data-text-color="#AE22FF">{{\App\CentralLogics\Helpers::format_currency($account_info->received_balance + $account_info->total_withdrawn)}}</h2>
                                        <h3 class="font-normal fs-14 m-0" data-text-color="#334257B2">{{translate('provider_Balance')}}</h3>
                                    </div>
                                    <div class="absolute-img" data-text-color="#AE22FF" data-toggle="tooltip"
                                         data-title="{{translate('provider balance means total Earning of booking')}}">
                                        <i class="tio-info"></i>
                                    </div>
                                </div>

                                <div class="statistics-card p--20 rounded-10 h-100 d-flex gap-2 justify-content-between  flex-grow-1" data-bg-color="#1C8EFF0D">
                                    <div>
                                        <h2 class="mb-1 fs-24" data-text-color="#1C8EFF">{{\App\CentralLogics\Helpers::format_currency(($account_info->balance_pending??0))}}</h2>
                                        <h3 class="font-normal fs-14 m-0" data-text-color="#334257B2">{{translate('Pending_Balance')}}</h3>
                                    </div>
                                    <div class="absolute-img" data-text-color="#1C8EFF" data-toggle="tooltip"
                                         data-title="{{translate('Pending balance means the amount requested for withdraw to admin')}}">
                                        <i class="tio-info"></i>
                                    </div>
                                </div>

                                <div class="statistics-card p--20 rounded-10 h-100 d-flex gap-2 justify-content-between statistics-card__subscribed-providers  flex-grow-1" data-bg-color="#3BC5750D">
                                    <div>
                                        <h2 class="mb-1 fs-24" data-text-color="#3BC575">{{\App\CentralLogics\Helpers::format_currency($account_info->total_withdrawn)}}</h2>
                                        {{-- <h3>{{translate('Already_withdrawn')}}</h3> --}}
                                        <h3 class="font-normal fs-14 m-0" data-text-color="#334257B2">{{translate('Commission_Given')}}</h3>
                                    </div>
                                    <div class="absolute-img" data-text-color="#3BC575" data-toggle="tooltip"
                                         data-title="{{translate('Total withdrawn means the amount provider has already withdrawn from admin which was got from digitally paid booking')}}">
                                        <i class="tio-info"></i>
                                    </div>
                                </div>

                                <div class="statistics-card p--20 rounded-10 h-100 d-flex gap-2 justify-content-between statistics-card__canceled  flex-grow-1" data-bg-color="#F3A7350D">
                                    <div>
                                        <h2 class="mb-1 fs-24" data-text-color="#F3A735">{{\App\CentralLogics\Helpers::format_currency($account_info->account_payable??0)}}</h2>
                                        <h3 class="font-normal fs-14 m-0" data-text-color="#334257B2">{{translate('Account_Payable')}}</h3>
                                    </div>
                                    <div class="absolute-img" data-text-color="#F3A735" data-toggle="tooltip"
                                         data-title="{{translate('Account payable means the admin commission for CAS bookings that is yet to pay')}}">
                                        <i class="tio-info"></i>
                                    </div>
                                </div>

                                <div class="statistics-card p--20 rounded-10 h-100 d-flex gap-2 justify-content-between statistics-card__ongoing  flex-grow-1" data-bg-color="#FF67670D">
                                    <div>
                                        <h2 class="mb-1 fs-24" data-text-color="#FF6767">{{\App\CentralLogics\Helpers::format_currency($account_info->account_receivable??0)}}</h2>
                                        <h3 class="font-normal fs-14 m-0" data-text-color="#334257B2">{{translate('Account_Receivable')}}</h3>
                                    </div>
                                    <div class="absolute-img" data-text-color="#FF6767" data-toggle="tooltip"
                                         data-title="{{translate('Account receivable means booking earning by digitally paid bookings that is yet to collect from admin')}}">
                                        <i class="tio-info"></i>
                                    </div>
                                </div>
                            </div>
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
                    </div>
                    <div class="card mt-3">
                        <div class="card-body p-0">                        
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="all-tab-pane">
                                    <div class="data-table-top py-3 px-3 d-flex align-items-center flex-wrap gap-3 justify-content-between">
                                        <div class="d-flex gap-2 fw-medium">
                                            <span class="text--clr fs-16 font-bold">{{translate('Total_Transactions')}}: </span>
                                            <span class="text-opacity">{{$filteredTransactions->total()}}</span>
                                        </div>
                                        <div class="d-flex align-items-center justiy-content-end gap-3 flex-wrap">
                                            <form action="{{url()->current()}}"
                                                  class="search-form rounded overflow-hidden d-flex align-items-center search-form_style-two"
                                                  method="GET">
                                                <div class="input-group search-form__input_group">
                                                {{--<span class="search-form__icon">
                                                    <span class="material-icons">search</span>
                                                </span>--}}
                                                    <input type="search" class="theme-input-style form-control rounded-0 h-40 search-form__input"
                                                           value="{{$queryParams['search']?? ''}}" name="search"
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
                                                               href="{{route('provider.service.report.transaction.download').'?'.http_build_query($queryParams)}}">
                                                                {{translate('Excel')}}
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="table-responsive pb-0">
                                        <table class="table m-0 align-middle align-middle-cus table-borderless">
                                            <thead class="text-nowrap z--0" data-bg-color="#F3F8F8">
                                            <tr>
                                                <th class="text-center">{{translate('SL')}}</th>
                                                <th>{{translate('Transaction_ID')}}</th>
                                                <th>{{translate('Transaction_Date')}}</th>
                                                <th>{{translate('Transaction_To')}}</th>
                                                <th>{{translate('Debit')}}</th>
                                                <th>{{translate('Credit')}}</th>
                                                <th>{{translate('Balance')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($filteredTransactions as $key=>$transaction)
                                                <tr>
                                                    <td class="text-center">{{$filteredTransactions->firstitem()+$key}}</td>
                                                    <td>{{$transaction->id}}</td>
                                                    <td>{{date('d-M-Y h:ia',strtotime($transaction->created_at))}}</td>
                                                    <td>
                                                        @if(isset($transaction->to_user))
                                                            {{$transaction->to_user->first_name.' '.$transaction->to_user->last_name}}
                                                            <div
                                                                class="d-flex fz-10">{{translate($transaction->trx_type)}}</div>
                                                        @else
                                                            {{translate('User_available')}}
                                                        @endif
                                                    </td>
                                                    <td> -
                                                        @if($transaction->debit > 0)
                                                            <span>{{\App\CentralLogics\Helpers::format_currency($transaction->debit)}}</span>
                                                        @else
                                                            <span
                                                                class="disabled">{{\App\CentralLogics\Helpers::format_currency($transaction->debit)}}</span>
                                                        @endif</td>
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
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center">
                                                        <div class="d-flex flex-column justify-content-center align-items-center gap-2 py-3">
                                                            <img src="{{ asset('public/assets/admin/svg/illustrations/sorry.svg') }}"
                                                                alt="{{ translate('messages.no_data_found') }}" width="80">
                                                            <p class="text-muted">{{ translate('messages.No_Transaction_Found') }}</p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-flex justify-content-end pt-3">
                                        {!! $filteredTransactions->links() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script_2')
    <script>
        "use strict";

        $(document).ready(function () {
            $('.zone__select').select2({
                placeholder: "{{translate('Select_zone')}}",
            });
            $('.provider__select').select2({
                placeholder: "{{translate('Select_provider')}}",
            });
        });

        $(document).ready(function () {
            $('#date-range').on('change', function () {
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

