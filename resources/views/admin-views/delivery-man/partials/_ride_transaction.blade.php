<!-- Card -->
<div class="card mb-3 mb-lg-5 mt-2">
    <div class="card-header flex-wrap py-2 border-0 gap-2">
        <div class="search--button-wrapper">
            <h4 class="card-title">{{ translate('messages.ride_transactions')}}</h4>
            {{-- <div class="min--260">
                <input type="date" class="form-control set-filter" placeholder="{{ translate('mm/dd/yyyy') }}" data-url="{{route('admin.users.delivery-man.preview',['id'=>$deliveryMan->id, 'tab'=> 'transaction', 'type' => 'ride'])}}" data-filter="date" value="{{$date}}">
            </div> --}}
        </div>
        <!-- Unfold -->
        {{-- <div class="hs-unfold mr-2">
            <a class="js-hs-unfold-invoker btn btn-sm btn-white dropdown-toggle min-height-40" href="javascript:;"
                data-hs-unfold-options='{
                        "target": "#usersExportDropdown",
                        "type": "css-animation"
                    }'>
                <i class="tio-download-to mr-1"></i> {{ translate('messages.export') }}
            </a>

            <div id="usersExportDropdown"
                class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right">
                <span class="dropdown-header">{{ translate('messages.download_options') }}</span>
                <a id="export-excel" class="dropdown-item" href="{{route('admin.users.delivery-man.earning-export', ['type'=>'excel','id'=>$deliveryMan->id,request()->getQueryString()])}}">
                    <img class="avatar avatar-xss avatar-4by3 mr-2"
                        src="{{ asset('public/assets/admin') }}/svg/components/excel.svg"
                        alt="Image Description">
                    {{ translate('messages.excel') }}
                </a>
                <a id="export-csv" class="dropdown-item" href="{{route('admin.users.delivery-man.earning-export', ['type'=>'csv','id'=>$deliveryMan->id,request()->getQueryString()])}}">
                    <img class="avatar avatar-xss avatar-4by3 mr-2"
                        src="{{ asset('public/assets/admin') }}/svg/components/placeholder-csv-format.svg"
                        alt="Image Description">
                    .{{ translate('messages.csv') }}
                </a>
            </div>
        </div> --}}
        <!-- End Unfold -->
    </div>
    <!-- Body -->
    <div class="card-body p-0">
        <div class="table-responsive">
            <table id="datatable" class="table table-borderless table-thead-bordered table-nowrap justify-content-between table-align-middle card-table">
                <thead class="table-light">
                    <tr>
                        <th class="border-0">{{translate('SL')}}</th>
                        <th class="border-0">{{translate('transaction_ID')}}</th>
                        <th class="border-0">{{translate('type')}}</th>
                        <th class="border-0 text-capitalize">{{translate('transaction_to')}}</th>
                        <th class="border-0">{{ translate('debit')}} ({{session()->get('currency_symbol') ?? '$'}})</th>
                        <th class="border-0">{{ translate('credit')}} ({{session()->get('currency_symbol') ?? '$'}})</th>
                        <th class="border-0 text-capitalize">{{translate('last_balance')}}</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($transactions as $key => $item)
                    <tr>
                        <td>{{$key + $transactions->firstItem()}}</td>
                        <td>{{$item->id}}</td>
                        <td>{{ translate($item->account)}} {{ $item->transaction_type ? '('.translate($item->transaction_type).')' : "" }}</td>
                        <td>{{$item->driver?->f_name . ' ' . $item->driver?->l_name}}</td>
                        <td>{{$item->debit}}</td>
                        <td>+ {{$item->credit}}</td>
                        <td>{{set_currency_symbol($item->balance)}}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="15">
                            <div class="d-flex flex-column justify-content-center align-items-center gap-2 py-3">
                                <img src="{{ asset('public/assets/admin-module/img/empty-icons/no-data-found.svg') }}" alt="" width="100">
                                <p class="text-center">{{translate('no_data_available')}}</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <!-- End Body -->
    <div class="card-footer">
        {!!$transactions->appends(request()->except('page'))->links()!!}
    </div>
</div>
<!-- End Card -->