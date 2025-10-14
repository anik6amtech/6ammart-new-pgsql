<div class="row">
    <div class="col-lg-12 text-center "><h1 >{{ translate('messages.Customized Booking Requests list') }}</h1></div>
    <div class="col-lg-12">
        <table>
            <thead>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th>
                    @if ($data['search'])
                        <br>
                        {{ translate('search_bar_content' )}} : {{ $data['search'] }}
                    @endif

                    @if ($data['type'])
                        <br>
                        {{ translate('Type' )}} : {{ translate($data['type']) }}
                    @endif

                </th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            <tr>
                <th>{{ translate('messages.sl') }}</th>
                <th>{{ translate('messages.Booking ID') }}</th>
                <th>{{ translate('messages.customer_info') }}</th>
                <th>{{ translate('messages.Booking Request Time') }}</th>
                <th>{{ translate('messages.Service Time') }}</th>
                <th>{{ translate('messages.Category') }}</th>
                <th>{{ translate('messages.Sub Category') }}</th>
                <th>{{ translate('messages.Service') }}</th>
                <th>{{ translate('messages.Budget') }}</th>
                <th>{{ translate('messages.Bids Count') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data['posts'] as $key => $item)
                <tr>
                    <td style="border: 1px solid #000000; padding: 5px;">{{ $key + 1 }}</td>
                    <td style="border: 1px solid #000000; padding: 5px;">{{ $item['booking_id'] ?? 'N/A' }}</td>
                    <td style="border: 1px solid #000000; padding: 5px;">
                        @if(!empty($item['customer']))
                            {{ $item['customer']['f_name'] ?? '' }} {{ $item['customer']['l_name'] ?? '' }}
                            @if(!empty($item['customer']['phone']))
                                <br>{{ $item['customer']['phone'] }}
                            @endif
                        @else
                            N/A
                        @endif
                    </td>
                    <td style="border: 1px solid #000000; padding: 5px;">
                        <div>
                            <div>{{date('d-m-Y',strtotime($item['created_at']))}}</div><br>
                            <div>{{date('h:ia',strtotime($item['created_at']))}}</div>
                        </div>
                    </td>
                    <td style="border: 1px solid #000000; padding: 5px;">
                        <div>
                            <div>{{date('d-m-Y',strtotime($item['booking_schedule']))}}</div><br>
                            <div>{{date('h:ia',strtotime($item['booking_schedule']))}}</div>
                        </div>
                    </td>
                    <td style="border: 1px solid #000000; padding: 5px;">{{ $item['category']['name'] ?? 'N/A' }}</td>
                    <td style="border: 1px solid #000000; padding: 5px;">{{ $item['sub_category']['name'] ?? 'N/A' }}</td>
                    <td style="border: 1px solid #000000; padding: 5px;">{{ $item['service']['name'] ?? 'N/A' }}</td>
                    <td style="border: 1px solid #000000; padding: 5px;">{{ $item['budget'] ?? '0' }}</td>
                    <td style="border: 1px solid #000000; padding: 5px;">{{ $item['bids_count'] ?? '0' }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
