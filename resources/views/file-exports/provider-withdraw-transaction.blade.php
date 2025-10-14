<div class="row">
    <div class="col-lg-12 text-center "><h1 >{{ translate('messages.provider_withdraw_transactions') }}</h1></div>
    <div class="col-lg-12">



    <table>
        <thead>
            <tr>
                <th>{{ translate('filter_criteria') }} -</th>
                <th></th>
                <th></th>
                <th> 
                    {{ translate('request_status')  }}- {{  $data['request_status']?translate($data['request_status']):translate('all') }}
                    <br>
                    {{ translate('Search_Bar_Content')  }}- {{ $data['search'] ??translate('N/A') }}

                </th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            <tr>
                <th>{{ translate('messages.sl') }}</th>
                <th>{{ translate('messages.request_time') }}</th>
                <th>{{ translate('messages.requested_amount') }}</th>
                <th>{{ translate('messages.provider_name') }}</th>
                <th>{{ translate('messages.phone') }}</th>
                <th>{{ translate('messages.email') }}</th>
                <th>{{ translate('messages.bank_account_no.') }}</th>
                <th>{{ translate('messages.request_status') }}</th>
            </tr>
        </thead>
        <tbody>
        @foreach($data['withdraw_requests'] as $key => $wr)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{date('Y-m-d '.config('timeformat'),strtotime($wr->created_at))}}</td>
                <td>{{$wr['amount']}}</td>
                <td>
                    @if($wr->provider)
                    {{ $wr->provider->first_name }} {{ $wr->provider->last_name }}
                    @else
                    {{translate('messages.provider deleted!') }}
                    @endif
                </td>
                <td>{{$wr->provider->phone}}</td>
                <td>{{$wr->provider->email}}</td>
                <td>{{$wr->provider && $wr->provider->account_no ? $wr->provider->account_no : 'No Data found'}}</td>
                <td>
                    @if($wr->request_status=='pending')
                        {{ translate('messages.pending') }}
                    @elseif($wr->request_status=='approved')
                        {{ translate('messages.approved') }}
                    @else
                        {{ translate('messages.denied') }}
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
</div>
