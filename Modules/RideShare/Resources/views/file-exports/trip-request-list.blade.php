<div class="row">
    <div class="col-lg-12 text-center"><h1>{{ translate('Rides_List') }}</h1></div>
    <div class="col-lg-12">
        <table>
            <thead>
                <tr>
                    <th>{{ translate('Search_Criteria') }}</th>
                    <th></th>
                    <th></th>
                    <th>
                        {{ translate('Search_Bar_Content') }}- {{ $data['search'] ?? translate('N/A') }}
                        <br>
                        {{ translate('Status') }}- {{ $data['type'] ?? translate('all') }}
                        <br>
                        {{ translate('Date_Range') }}- {{ $data['date_range'] ?? translate('N/A') }}
                    </th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <th>{{ translate('Analytics') }}</th>
                    <th></th>
                    <th></th>
                    <th>
                        {{ translate('total_trips') }}- {{ $data['trips']->count() }}
                        <br>
                        {{ translate('completed_trips') }}- {{ $data['trips']->where('current_status', 'completed')->count() }}
                        <br>
                        {{ translate('cancelled_trips') }}- {{ $data['trips']->where('current_status', 'cancelled')->count() }}
                    </th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <th>{{ translate('sl') }}</th>
                    <th>{{ translate('Trip_ID') }}</th>
                    <th>{{ translate('Date') }}</th>
                    <th>{{ translate('Customer') }}</th>
                    <th>{{ translate('Driver') }}</th>
                    <th>{{ translate('Trip_Cost') }}</th>
                    <th>{{ translate('Coupon_Discount') }}</th>
                    <th>{{ translate('Delay_Fee') }}</th>
                    <th>{{ translate('Idle_Fee') }}</th>
                    <th>{{ translate('Cancellation_Fee') }}</th>
                    <th>{{ translate('Vat_Tax_Fee') }}</th>
                    <th>{{ translate('Total_Additional_Fee') }}</th>
                    <th>{{ translate('Total_Trip_Cost') }}</th>
                    <th>{{ translate('Payment_Status') }}</th>
                    <th>{{ translate('Trip_Status') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['trips'] as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item['ref_id'] }}</td>
                    <td>{{ date('d F Y', strtotime($item['created_at'])) . ' ' . date('h:i a', strtotime($item['created_at'])) }}</td>
                    <td>{{ $item['customer'] ? $item['customer']->f_name . ' ' . $item['customer']->l_name : translate('N/A') }}</td>
                    <td>{{ $item['driver'] ? $item['driver']->f_name . ' ' . $item['driver']->l_name : translate('no_driver_assigned') }}</td>
                    <td>{{ $item['current_status'] == 'completed' ? \App\CentralLogics\Helpers::format_currency($item['actual_fare'] ?? 0) : \App\CentralLogics\Helpers::format_currency($item['estimated_fare'] ?? 0) }}</td>
                    <td>{{ \App\CentralLogics\Helpers::format_currency($item['coupon_amount'] ?? 0) }}</td>
                    <td>{{ \App\CentralLogics\Helpers::format_currency($item['fee'] ? ($item['fee']->delay_fee) : 0) }}</td>
                    <td>{{ \App\CentralLogics\Helpers::format_currency($item['fee'] ? ($item['fee']->idle_fee) : 0) }}</td>
                    <td>{{ \App\CentralLogics\Helpers::format_currency($item['fee'] ? ($item['fee']->cancellation_fee) : 0) }}</td>
                    <td>{{ \App\CentralLogics\Helpers::format_currency($item['fee'] ? ($item['fee']->vat_tax) : 0) }}</td>
                    <td>{{ \App\CentralLogics\Helpers::format_currency($item['fee'] ? ($item['fee']->waiting_fee + $item['fee']->delay_fee + $item['fee']->idle_fee + $item['fee']->cancellation_fee + $item['fee']->vat_tax) : 0) }}</td>
                    <td>{{ \App\CentralLogics\Helpers::format_currency($item['paid_fare'] - $item['tips']) }}</td>
                    <td>{{ ucwords($item['payment_status']) }}</td>
                    <td>{{ ucwords($item['current_status']) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
