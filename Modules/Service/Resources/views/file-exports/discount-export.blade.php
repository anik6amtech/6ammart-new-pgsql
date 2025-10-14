<div class="row">
    <div class="col-lg-12 text-center">
        <h1>{{ translate('messages.Discount List') }}</h1>
    </div>
    <div class="col-lg-12">
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th style="padding-left: 10px;">
                        {{ translate('search_bar_content') }}: {{ $data['search'] }}
                    </th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <th>{{ translate('messages.sl') }}</th>
                    <th>{{ translate('messages.Title') }}</th>
                    <th>{{ translate('messages.Discount Type') }}</th>
                    <th>{{ translate('messages.Discount Amount') }}</th>
                    <th>{{ translate('messages.Valid Until') }}</th>
                    <th>{{ translate('messages.Status') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['discounts'] as $key => $discount)
                    <tr>
                        <td style="border: 1px solid #000000; padding: 5px;">{{ $key + 1 }}</td>
                        <td style="border: 1px solid #000000; padding: 5px;">
                            {{ $discount->discount_title ?? 'N/A' }}
                        </td>
                        <td style="border: 1px solid #000000; padding: 5px; text-transform: capitalize;">
                            {{ $discount->discount_type ?? 'N/A' }}
                        </td>
                        <td style="border: 1px solid #000000; padding: 5px;">
                            @if($discount->discount_type === 'percentage')
                                {{ $discount->discount_amount }}%
                            @else
                                {{ \App\CentralLogics\Helpers::format_currency($discount->discount_amount) }}
                            @endif
                        </td>
                        <td style="border: 1px solid #000000; padding: 5px;">
                            {{ $discount->end_date ? \Carbon\Carbon::parse($discount->end_date)->format('d M Y') : 'N/A' }}
                        </td>
                        <td style="border: 1px solid #000000; padding: 5px; text-transform: capitalize;">
                            {{ $discount->is_active ? translate('Active') : translate('Inactive') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
