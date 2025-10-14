@extends('service::provider.layouts.app')
@section('title', translate('messages.provider_wallet'))

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h2 class="page-header-title text-capitalize">
                        <div class="card-header-icon d-inline-flex mr-2 img">
                            <img src="{{ asset('/public/assets/admin/img/image_90.png') }}" alt="public">
                        </div>
                        <span>
                            {{ translate('messages.provider_wallet') }}
                        </span>
                    </h2>
                </div>
            </div>
        </div>
        <!-- End Page Header -->

        <div class="row g-3">
            <!-- Receivable Balance -->
            @php($checkAdjust = $provider->account->payable_balance == $provider->account->receivable_balance && $provider->account->payable_balance == 0 && $provider->account->receivable_balance == 0)
            <div class="@if ($checkAdjust) col-lg-6 @else col-lg-3 @endif">
                <div class="resturant-card shadow--card-2">
                    <h4 class="title">
                        {{ \App\CentralLogics\Helpers::format_currency($provider->account->receivable_balance) }}</h4>
                    <div class="d-flex gap-1 align-items-center">
                        <span class="subtitle">{{ translate('receivable_balance') }}</span>
                        <span class="form-label-secondary d-flex" data-toggle="tooltip" data-placement="right"
                            data-original-title="{{ translate('Total amount of payments that you’ll receive from admin.') }}">
                            <img src="{{ asset('/public/assets/admin/img/info-circle.svg') }}" alt="info">
                        </span>
                        <img class="resturant-icon"
                            src="{{ asset('/public/assets/admin/img/transactions/image_w_balance.png') }}" alt="public">
                    </div>
                </div>
            </div>

            <!-- Cash in Hand -->
            <div class="@if ($checkAdjust) col-lg-6 @else col-lg-3 @endif">
                <div class="resturant-card shadow--card-2">
                    <h4 class="title">
                        {{ \App\CentralLogics\Helpers::format_currency($provider->account->payable_balance) }}</h4>
                    <div class="d-flex gap-1 align-items-center">
                        <span class="subtitle">{{ translate('cash_in_hand') }}</span>
                        <span class="form-label-secondary d-flex" data-toggle="tooltip" data-placement="right"
                            data-original-title="{{ translate('Total amount you’ve received from the customer in cash (Cash after Service)') }}">
                            <img src="{{ asset('/public/assets/admin/img/info-circle.svg') }}" alt="info">
                        </span>
                        <img class="resturant-icon"
                            src="{{ asset('/public/assets/admin/img/transactions/image_total89.png') }}" alt="public">
                    </div>
                </div>
            </div>

            <!-- Conditional Balances -->
            @php($minPayableAmount = business_config('provider_minimum_payable_amount')->value ?? 0)

            @if ($provider?->account?->payable_balance > $provider?->account?->receivable_balance &&
                    $provider?->account?->receivable_balance != 0)
                <div class="col-lg-6">
                    <div class="resturant-card shadow--card-2 d-flex justify-content-between align-items-center gap-2">
                        <div>
                            <h4 class="title">
                                {{ \App\CentralLogics\Helpers::format_currency($provider?->account?->payable_balance - $provider?->account?->receivable_balance) }}
                            </h4>
                            <span class="subtitle">{{ translate('Payable Balance') }}</span>
                        </div>
                        <button type="button" class="btn btn--primary pay-btn"
                            data-amount="{{ $provider?->account->payable_balance - $provider?->account?->receivable_balance }}">
                            {{ translate('adjust_&_pay') }}
                        </button>
                    </div>
                </div>
            @elseif($provider?->account?->payable_balance > $provider?->account?->receivable_balance &&
                    $provider?->account?->receivable_balance == 0)
                <div class="col-lg-6">
                    <div class="resturant-card shadow--card-2 d-flex justify-content-between align-items-center gap-2">
                        <div>
                            <h4 class="title">
                                {{ \App\CentralLogics\Helpers::format_currency($provider?->account?->payable_balance) }}</h4>
                            <span class="subtitle">{{ translate('Payable Balance') }}</span>
                        </div>
                        <button type="button" data-amount="{{ $provider?->account?->payable_balance }}"
                            class="btn btn--primary pay-btn">{{ translate('pay') }}</button>
                    </div>
                </div>
            @elseif($provider?->account?->receivable_balance > $provider?->account?->payable_balance &&
                    $provider?->account?->payable_balance != 0)
                <div class="col-lg-6">
                    <div class="resturant-card shadow--card-2 d-flex justify-content-between align-items-center gap-2">
                        <div>
                            <h4 class="title">
                                {{ \App\CentralLogics\Helpers::format_currency($provider?->account?->receivable_balance - $provider?->account?->payable_balance) }}
                            </h4>
                            <span class="subtitle">{{ translate('Withdraw-able Balance') }}</span>
                        </div>
                        <button class="btn btn--warning" data-toggle="modal"
                            data-target="#withdrawRequestModal">{{ translate('adjust_&_withdraw') }}</button>
                    </div>
                </div>
            @elseif($provider?->account?->receivable_balance > 0 && $provider?->account?->payable_balance == 0)
                <div class="col-lg-6">
                    <div class="resturant-card shadow--card-2 d-flex justify-content-between align-items-center gap-2">
                        <div>
                            <h4 class="title">
                                {{ \App\CentralLogics\Helpers::format_currency($provider?->account?->receivable_balance) }}
                            </h4>
                            <span class="subtitle">{{ translate('Withdraw-able Balance') }}</span>
                        </div>
                        <button class="btn btn--warning" data-toggle="modal" {{ $collectable_cash < 1 ? 'disabled' : '' }}
                            data-target="#withdrawRequestModal">{{ translate('withdraw') }}</button>
                    </div>
                </div>
            @elseif($provider?->account?->payable_balance == $provider?->account?->receivable_balance &&
                    $provider?->account?->payable_balance != 0)
                <div class="col-lg-6">
                    <div class="resturant-card shadow--card-2 d-flex justify-content-between align-items-center gap-2">
                        <div>
                            <h4 class="title">{{ \App\CentralLogics\Helpers::format_currency(0) }}</h4>
                            <span class="subtitle">{{ translate('withdraw_or_payable Balance') }}</span>
                        </div>
                        <a class="btn btn--primary" href="{{ route('provider.adjust') }}">{{ translate('adjust') }}</a>
                    </div>
                </div>
            @endif
        </div>

        <hr>

        <!-- Second Row: Pending, Already Withdrawn, Total -->
        <div class="row g-3 mt-2">
            <div class="col-sm-4">
                <div class="resturant-card bg--3">
                    <h4 class="title">
                        {{ \App\CentralLogics\Helpers::format_currency($provider->account->pending_balance) }}</h4>
                    <span class="subtitle">{{ translate('Pending Withdraw') }}</span>
                    <img class="resturant-icon"
                        src="{{ asset('/public/assets/admin/img/transactions/image_pending.png') }}" alt="public">
                </div>
            </div>

            <div class="col-sm-4">
                <div class="resturant-card bg--2">
                    <h4 class="title">
                        {{ \App\CentralLogics\Helpers::format_currency($provider->account->total_withdrawn) }}</h4>
                    <span class="subtitle">{{ translate('Already Withdrawn') }}</span>
                    <img class="resturant-icon"
                        src="{{ asset('/public/assets/admin/img/transactions/image_withdaw.png') }}" alt="public">
                </div>
            </div>

            <div class="col-sm-4">
                <div class="resturant-card bg--1">
                    <h4 class="title">{{ \App\CentralLogics\Helpers::format_currency($totalEarning) }}</h4>
                    <span class="subtitle">{{ translate('Total Earning') }}</span>
                    <img class="resturant-icon"
                        src="{{ asset('/public/assets/admin/img/transactions/image_total89.png') }}" alt="public">
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table id="datatable"
                                class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                                data-hs-datatables-options='{
                                    "order": [],
                                    "orderCellsTop": true,
                                    "paging":false
                                }'>
                                <thead class="thead-light">
                                    <tr>
                                        <th>{{ translate('SL') }}</th>
                                        <th>{{ translate('Provide_Note') }}</th>
                                        <th>{{ translate('Total_Amount') }}</th>
                                        <th>{{ translate('Admin_Note') }}</th>
                                        <th>{{ translate('Requested_at') }}</th>
                                        <th>{{ translate('Status') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($withdrawRequests as $key => $withdrawRequest)
                                        <tr>
                                            <td>{{ $withdrawRequests->firstitem() + $key }}</td>
                                            <td>{{ $withdrawRequest->note }}</td>
                                            <td>{{ $withdrawRequest->amount }}</td>
                                            <td>
                                                <div title="{{ $withdrawRequest->admin_note }}">
                                                    {{ $withdrawRequest->admin_note }}</div>
                                            </td>
                                            <td>
                                                <div>{{ date('d-M-y', strtotime($withdrawRequest->created_at)) }}</div>
                                                <div>{{ date('H:i a', strtotime($withdrawRequest->created_at)) }}</div>
                                            </td>
                                            <td>
                                                <span class="badge badge badge-success">
                                                    {{ translate($withdrawRequest->request_status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if (count($withdrawRequests) === 0)
                                <div class="empty--data">
                                    <img src="{{ asset('/public/assets/admin/svg/illustrations/sorry.svg') }}"
                                        alt="public">
                                    <h5>
                                        {{ translate('no_data_found') }}
                                    </h5>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer pt-0 border-0">
                        {{ $withdrawRequests->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="modal fade" id="paymentMethodModal" tabindex="-1" aria-labelledby="paymentMethodModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body px-xl-5">
                    <h3 class="mb-2">{{ translate('Payment Method') }}</h3>
                    <p>{{ translate('Payment with secured Digital payment gateways') }}</p>
                    <p class="text-muted fs-12">{{ translate('Select Payment Method') }}</p>

                    <form action="{{ url('payment/') }}?is_pay_to_admin=true" class="payment-method-form"
                        method="post">
                        <div class="payment_method_grid gap-3 gap-lg-4">
                            @foreach ($paymentGateways ?? [] as $gateway)
                                <div class="border bg-white p-4 rounded">
                                    <input type="radio" id="{{ $gateway['gateway'] }}"
                                        name="payment_method" value="{{ $gateway['gateway'] }}" required>
                                    <label for="{{ $gateway['gateway'] }}"
                                        class="d-flex align-items-center gap-3">
                                        <img src="{{ $gateway['gateway_image'] }}"
                                            alt="{{ translate('gateway image') }}">
                                    </label>
                                </div>
                                <input type="hidden" id="{{ $gateway['gateway'] }}" name="provider_id"
                                    value="{{ $provider['id'] }}">
                            @endforeach
                        </div>

                        <div class="d-flex justify-content-end gap-3 my-4">
                            <button type="button" class="btn btn--secondary"
                                data-bs-dismiss="modal">{{ translate('Cancel') }}</button>
                            <button type="submit"
                                class="btn btn--primary">{{ translate('Proceed to Pay') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="modal fade" id="paymentMethodModal" tabindex="-1"  role="dialog" aria-labelledby="paymentMethodModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    {{-- <h5 class="modal-title" id="exampleModalLabel">{{translate('messages.Pay_Via_Online')}}  </h5> --}}
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                <form action="{{ url('service/payment/') }}?is_pay_to_admin=true" method="POST" class="needs-validation">
                    <div class="modal-body">
                        @csrf
                        {{-- <input type="hidden" value="{{ \App\CentralLogics\Helpers::get_store_id() }}" name="store_id"/>
                        <input type="hidden" value="{{ abs($wallet->collected_cash) }}" name="amount"/> --}}
                        <h5 class="mb-5 ">{{ translate('Pay_Via_Online') }} &nbsp; <small>({{ translate('Faster_&_secure_way_to_pay_bill') }})</small></h5>
                        <div class="row g-3">
                            @forelse ($paymentGateways as $item)
                                <div class="col-sm-6">
                                    <div class="d-flex gap-3 align-items-center">
                                        <input type="radio" required id="{{$item['gateway'] }}" name="payment_method" value="{{$item['gateway'] }}">
                                        <label for="{{$item['gateway'] }}" class="d-flex align-items-center gap-3 mb-0">
                                            <img height="24" src="{{ asset('storage/app/public/payment_modules/gateway_image/'. $item['gateway_image']) }}" alt="">
                                            {{ $item['gateway_title'] }}
                                        </label>
                                    </div>
                                </div>
                                <input type="hidden" id="{{ $item['gateway'] }}" name="provider_id"
                                    value="{{ $provider['id'] }}">
                            @empty
                                <h1>{{ translate('no_payment_gateway_found') }}</h1>
                            @endforelse
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button id="reset_btn" type="reset" data-dismiss="modal" class="btn btn-secondary" >{{ translate('Close') }} </button>
                        <button type="submit" class="btn btn-primary">{{ translate('Proceed') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="withdrawRequestModal" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{translate('messages.Withdraw_Request')}}  </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                <form action="{{ route('provider.service.withdraw.store') }}" method="POST">
                    @csrf
                    <div class="modal-body p-30">

                        <select class="js-select form-control" id="withdraw_method" name="withdraw_method" required>
                            <option value="" selected disabled>{{ translate('Select_Withdraw_Method') }}
                            </option>
                            @foreach ($withdrawalMethods as $item)
                                <option value="{{ $item['id'] }}"
                                    @if ($item->is_default == 1) selected @endif>
                                    {{ $item['method_name'] }}</option>
                            @endforeach
                        </select>

                        <div id="method-filed__div">

                        </div>

                        <div class="form-group mt-2">
                            <label for="wr_num" class="fz-16 c1 mb-2">{{ translate('Note') }}</label>
                            <textarea type="text" class="form-control" name="note" placeholder="{{ translate('Note') }}"
                                maxlength="255"></textarea>
                        </div>

                        {{-- <div class="d-flex gap-2 align-items-center justify-content-center">
                <input type="number" class="my-3 fz-34 text-center bg-custom withdraw-input form-control w-auto" step="any"
                    name="amount"
                    value="0" placeholder="{{translate('Amount')}}" id="amount"
                    min="{{$withdrawRequestAmount['minimum']}}"
                    max="{{$withdrawRequestAmount['maximum']}}"
                >
                <label class="my-3 fz-34 text-left">{{currency_symbol()}}</label>
            </div> --}}

                        <div class="max-w220 mx-auto my-4">
                            <div class="input-group">
                                <input type="number" name="amount"
                                    class="form-control withdraw-input" value="0" min="1" max="{{ $provider?->account?->receivable_balance }}"
                                    placeholder="{{ translate('Amount') }}" id="amount"
                                    {{-- min="{{ $withdrawRequestAmount['minimum'] }}"
                                    max="{{ $withdrawRequestAmount['maximum'] }}" --}}
                                    >
                                {{-- <span class="input-group-text">{{ currency_symbol() }}</span> --}}
                            </div>
                        </div>

                        {{-- <div class="fz-15 text-muted border-bottom pb-4 text-center">
                            <div>{{ translate('Available_Balance') }}
                                {{ \App\CentralLogics\Helpers::format_currency($collectable_cash) }}</div>

                            <div>{{ translate('Minimum_Request_Amount') }}
                                {{ \App\CentralLogics\Helpers::format_currency($withdrawRequestAmount['minimum']) }}
                            </div>
                            <div>{{ translate('Maximum_Request_Amount') }}
                                {{ \App\CentralLogics\Helpers::format_currency($withdrawRequestAmount['maximum']) }}
                            </div>
                        </div>

                        <ul class="radio-list justify-content-center mt-4">
                            @forelse($withdrawRequestAmount['random'] as $key=>$item)
                                <li>
                                    <input class="withdraw-dynamic-class" type="radio"
                                        id="withdraw_amount{{ $key + 1 }}" name="withdraw_amount"
                                        data-withdraw-symbol="{{ $item }}" hidden>
                                    <label
                                        for="withdraw_amount{{ $key + 1 }}">{{ \App\CentralLogics\Helpers::format_currency($item) }}</label>
                                </li>
                            @empty
                                <li>
                                    <input class="withdraw-class" type="radio" id="withdraw_amount"
                                        name="withdraw_amount" data-withdraw="500" hidden>
                                    <label for="withdraw_amount">{{ translate('500') }}
                                        {{ currency_symbol() }}</label>
                                </li>
                                <li>
                                    <input type="radio" class="withdraw-class" id="withdraw_amount2"
                                        name="withdraw_amount" data-withdraw="1000" hidden>
                                    <label for="withdraw_amount2">1000 {{ currency_symbol() }}</label>
                                </li>
                                <li>
                                    <input type="radio" class="withdraw-class" id="withdraw_amount3"
                                        name="withdraw_amount" data-withdraw="2000" hidden>
                                    <label for="withdraw_amount3">2000 {{ currency_symbol() }}</label>
                                </li>
                                <li>
                                    <input type="radio" class="withdraw-class" id="withdraw_amount4"
                                        name="withdraw_amount" data-withdraw="5000" hidden>
                                    <label for="withdraw_amount4">5000 {{ currency_symbol() }}</label>
                                </li>
                                <li>
                                    <input type="radio" class="withdraw-class" id="withdraw_amount5"
                                        name="withdraw_amount" data-withdraw="10000" hidden>
                                    <label for="withdraw_amount5">10000 {{ currency_symbol() }}</label>
                                </li>
                            @endforelse
                        </ul> --}}

                        <div class="modal-body_btns d-flex justify-content-center mt-4">
                            <button type="submit"
                                class="btn btn--primary">{{ translate('Send_Withdraw_Request') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('script_2')
    <script src="{{ asset('public/assets/admin') }}/js/apex-charts/apexcharts.js"></script>

    <script>
        "use Strict"

        $(document).ready(function() {
            $('.pay-btn').click(function() {
                let adjustPayableAmount = $(this).data('amount');
                let minPayableAmount = {{ $minPayableAmount }};
                if (minPayableAmount > 0 && adjustPayableAmount < minPayableAmount) {
                    toastr.error('Minimum payable amount is: ' + minPayableAmount);
                } else {
                    $('#paymentMethodModal').modal('show');
                }
            });
        });

        $('.withdraw-dynamic-class').on('click', function() {
            let amount = $(this).data('withdraw-symbol');
            predefined_amount_input(amount)
        });

        $('.withdraw-class').on('click', function() {
            let withdrawAmount = $(this).data('withdraw');
            predefined_amount_input(withdrawAmount)
        });

        var options = {
            labels: ['accepted', 'ongoing', 'completed', 'canceled'],
            series: {{ json_encode($total) }},
            chart: {
                width: 235,
                height: 160,
                type: 'donut',
            },
            dataLabels: {
                enabled: false
            },
            title: {
                text: "{{ $provider->bookings_count }} Bookings",
                align: 'center',
                offsetX: 0,
                offsetY: 58,
                floating: true,
                style: {
                    fontSize: '12px',
                },
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    legend: {
                        show: true
                    }
                }
            }],
            legend: {
                position: 'bottom',
                offsetY: -5,
                height: 30,
            },
        };

        var chart = new ApexCharts(document.querySelector("#apex-pie-chart"), options);
        chart.render();

        $('#withdraw_method').on('change', function() {

            var method_id = this.value;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('provider.service.wallet.method-list') }}" + "?method_id=" + method_id,
                data: {},
                processData: false,
                contentType: false,
                type: 'get',
                success: function(response) {
                    let method_fields = response.content.method_fields;
                    $("#method-filed__div").html("");
                    method_fields.forEach((element, index) => {
                        $("#method-filed__div").append(`
            <div class="form-group mt-2">
                <label for="wr_num" class="fz-16 c1 mb-2">${element.input_name.replaceAll('_', ' ')}</label>
                <input type="${element.input_type}" class="form-control" name="${element.input_name}" placeholder="${element.placeholder}" ${element.is_required === 1 ? 'required' : ''}>
            </div>
        `);
                    })

                },
                error: function() {

                }
            });
        });

        if ($('#withdraw_method').val()) {
            $('#withdraw_method').trigger('change');
        }

        function predefined_amount_input(amount) {
            document.getElementById("amount").value = amount;
        }
    </script>
@endpush
