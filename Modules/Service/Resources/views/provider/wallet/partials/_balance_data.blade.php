
<!-- Content Row -->
<div class="row mt-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">

                <ul class="nav nav-tabs page-header-tabs pb-2">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('vendor-panel/wallet') ?'active':''}}"  href="{{ route('vendor.wallet.index') }}">{{translate('messages.withdraw_request')}}</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link  {{Request::is('vendor-panel/wallet/wallet-payment-list') ?'active':''}}" href="{{route('vendor.wallet.wallet_payment_list')}}"  aria-disabled="true">{{translate('messages.Payment_history')}}</a>
                    </li>

                    {{-- <li class="nav-item">
                        <a class="nav-link  {{Request::is('vendor-panel/wallet/disbursement-list') ?'active':''}}" href="{{route('vendor.wallet.getDisbursementList')}}"  aria-disabled="true">{{translate('messages.Next_Payouts')}}</a>
                    </li> --}}
                </ul>

            </div>
