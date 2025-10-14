@extends('layouts.admin.app')

@section('title', translate('Transaction'))

@section('content')
    <!-- Main Content -->
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-between gap-3 align-items-center mb-4">
                <h2 class="fs-22 text-capitalize">{{translate('transaction_list')}}</h2>
                <div class="d-flex align-items-center gap-2 text-capitalize">
                    <span class="text-muted">{{translate('total_transactions')}} : </span>
                    <span class="text-primary fs-16 fw-bold" id="">{{$transactions->total()}}</span>
                </div>
            </div>

            <div class="card">
                <div class="card-header py-2">
                        <div class="search--button-wrapper gap-20px">
                            <h5 class="card-title text--title flex-grow-1">{{ translate('messages.transaction_List') }}</h5>

                            <form class="search-form m-0 flex-grow-1 max-w-353px">

                                <div class="input-group input--group">
                                    <input id="datatableSearch_" type="search" value="{{ request()?->search ?? null }}" name="search"
                                        class="form-control" placeholder="{{ translate('search_here_by_transaction_id') }}"
                                        aria-label="{{ translate('search_here_by_transaction_id') }}">
                                    <button type="submit" class="btn btn--secondary bg--primary"><i class="tio-search"></i></button>

                                </div>

                            </form>
                            @if (request()->get('search'))
                            <button type="reset" class="btn btn--primary ml-2 location-reload-to-base"
                                data-url="{{ url()->full() }}">{{ translate('messages.reset') }}</button>
                            @endif

                            <div class="hs-unfold m-0">
                                <a class="js-hs-unfold-invoker btn btn-sm btn-white dropdown-toggle min-height-40 font-semibold text--title"
                                    href="javascript:;" data-hs-unfold-options='{
                                                    "target": "#usersExportDropdown",
                                                    "type": "css-animation"
                                                }'>
                                    <i class="tio-download-to mr-1"></i> {{ translate('messages.export') }}
                                </a>

                                <div id="usersExportDropdown"
                                    class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right">

                                    <span class="dropdown-header">{{ translate('messages.download_options') }}</span>
                                    <a id="export-excel" class="dropdown-item"
                                        href="{{route('admin.transactions.ride-share.transaction.export', ['file' => 'excel', request()->getQueryString()])}}">
                                        <img class="avatar avatar-xss avatar-4by3 mr-2"
                                            src="{{ asset('public/assets/admin') }}/svg/components/excel.svg" alt="Image Description">
                                        {{ translate('messages.excel') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                </div>

                <div class="table-responsive datatable-custom">
                    <table id="columnSearchDatatable"
                        class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table text--title">
                        <thead class="thead-light">
                            <tr>
                            <th class="sl">{{translate('SL')}}</th>
                            <th class="text-center">{{translate('transaction_id')}}</th>
                            <th class="text-center">{{translate('reference')}}</th>
                            <th class="text-center">{{translate('transaction_date')}}</th>
                            <th class="text-center">{{translate('transaction_to')}}</th>
                            <th class="text-center">{{translate('credit')}}</th>
                            <th class="text-center">{{translate('debit')}}</th>
                            <th class="text-center">{{translate('balance')}}</th>
                            </tr>
                        </thead>

                        <tbody id="set-rows">
                            @foreach ($transactions as $key => $transaction)
                            <tr>
                                <td class="sl">{{$key + $transactions->firstItem()}}</td>
                                <td class="text-center">{{$transaction->id}}</td>
                                <td class="text-center">{{ $transaction->trx_ref_id ?? '-' }}</td>
                                <td class="text-center">{{date('d-m-Y h:i A', strtotime($transaction->created_at))}}</td>
                                <td class="text-center">
                                    {{ $transaction?->user?->f_name . ' ' . $transaction?->user?->l_name }}
                                    <small class="opacity-75 d-block">
                                        {{ ucwords(str_replace('_', ' ', $transaction->account) )}} {{ $transaction->transaction_type != null ? '(' . ucwords($transaction->transaction_type) .')' : ""}}
                                    </small>
                                </td>
                                <td class="text-center">{{getCurrencyFormat($transaction->credit)}}</td>
                                <td class="text-center">{{getCurrencyFormat($transaction->debit)}}</td>
                                <td class="text-center">{{getCurrencyFormat($transaction->balance)}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if(count($transactions) !== 0)
                    <hr>
                    @endif
                    <div class="page-area">
                        {!! $transactions->withQueryString()->links() !!}
                    </div>
                    @if(count($transactions) === 0)
                    <div class="empty--data">
                        <img src="{{asset('/public/assets/admin/svg/illustrations/sorry.svg')}}" alt="public">
                        <h5>
                            {{translate('no_data_found')}}
                        </h5>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- End Main Content -->
@endsection

@push('script')
    <script>

    </script>
@endpush

