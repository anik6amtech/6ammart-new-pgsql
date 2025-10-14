<div class="row">
    <div class="col-lg-12 text-center">
        <h1>{{ translate('messages.Campaign List') }}</h1>
    </div>
    <div class="col-lg-12">
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th style="padding-left: 10px;">
                        {{ translate('search_bar_content') }}: {{ $data['search'] }}
                        @if($data['discount_type'] && $data['discount_type'] != 'all')
                            <br>
                            {{ translate('Type') }}: {{ ucfirst($data['discount_type']) }}
                        @endif
                    </th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <th>{{ translate('messages.sl') }}</th>
                    <th>{{ translate('messages.Campaign Name') }}</th>
                    <th>{{ translate('messages.Campaign description') }}</th>
                    <th>{{ translate('messages.Discount') }}</th>
                    <th>{{ translate('messages.Discount Type') }}</th>
                    <th>{{ translate('messages.Valid Until') }}</th>
                    <th>{{ translate('messages.Status') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['campaigns'] as $key => $campaign)
                    <tr>
                        <td style="border: 1px solid #000000; padding: 5px;">{{ $key + 1 }}</td>
                        <td style="border: 1px solid #000000; padding: 5px;">
                            {{ $campaign->campaign_name ?? 'N/A' }}
                        </td>
                        <td style="border: 1px solid #000000; padding: 5px;">
                            {{ $campaign->short_description ?? 'N/A' }}
                        </td>
                        <td style="border: 1px solid #000000; padding: 5px;">
                            @if($campaign->discount)
                                @if($campaign->discount->discount_type === 'percentage')
                                    {{ $campaign->discount->discount_amount }}%
                                @else
                                    {{ \App\CentralLogics\Helpers::format_currency($campaign->discount->discount_amount) }}
                                @endif
                            @else
                                N/A
                            @endif
                        </td>
                        <td style="border: 1px solid #000000; padding: 5px; text-transform: capitalize;">
                            {{ $campaign->discount->discount_type ?? 'N/A' }}
                        </td>
                        <td style="border: 1px solid #000000; padding: 5px;">
                            @if($campaign->discount && $campaign->discount->end_date)
                                {{ \Carbon\Carbon::parse($campaign->discount->end_date)->format('d M Y') }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td style="border: 1px solid #000000; padding: 5px; text-transform: capitalize;">
                            {{ $campaign->is_active ? translate('Active') : translate('Inactive') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
