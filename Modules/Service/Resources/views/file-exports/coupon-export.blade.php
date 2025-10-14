<div class="row">
    <div class="col-lg-12 text-center">
        <h1>{{ translate('messages.Coupon List') }}</h1>
    </div>
    <div class="col-lg-12">
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th style="padding-left: 10px;">
                        @if ($data['search'])
                            <br>
                            {{ translate('search_bar_content') }}: {{ $data['search'] }}
                        @endif

                        @if ($data['discount_type'])
                            <br>
                            {{ translate('Discount Type') }}: {{ ucfirst($data['discount_type']) }}
                        @endif
                    </th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <th>{{ translate('messages.sl') }}</th>
                    <th>{{ translate('messages.Coupon title') }}</th>
                    <th>{{ translate('messages.Coupon Code') }}</th>
                    <th>{{ translate('messages.Coupon Type') }}</th>
                    <th>{{ translate('messages.Discount Type') }}</th>
                    <th>{{ translate('messages.Coupon amount') }}</th>
                    <th>{{ translate('messages.limit_per_user') }}</th>
                    <th>{{ translate('messages.Valid Until') }}</th>
                    <th>{{ translate('messages.Status') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['coupons'] as $key => $coupon)
                    <tr>
                        <td style="border: 1px solid #000000; padding: 5px;">{{ $key + 1 }}</td>
                        <td style="border: 1px solid #000000; padding: 5px;">
                            {{ $coupon?->discount?->discount_title ?? 'N/A' }}
                        </td>
                        <td style="border: 1px solid #000000; padding: 5px;">
                            {{ $coupon->coupon_code ?? 'N/A' }}
                        </td>
                        <td style="border: 1px solid #000000; padding: 5px; text-transform: capitalize;">
                            {{ $coupon->coupon_type ?? 'N/A' }}
                        </td>
                        <td style="border: 1px solid #000000; padding: 5px; text-transform: capitalize;">
                            {{ $coupon?->discount?->discount_type ?? 'N/A' }}
                        </td>
                        <td style="border: 1px solid #000000; padding: 5px;">
                            @if(isset($coupon->discount))
                                @if($coupon->discount->discount_type === 'percentage')
                                    {{ $coupon->discount->discount_amount }}%
                                @else
                                    {{ \App\CentralLogics\Helpers::format_currency($coupon->discount->discount_amount) }}
                                @endif
                            @else
                                N/A
                            @endif
                        </td>
                        <td style="border: 1px solid #000000; padding: 5px;">
                            {{ $coupon->discount->limit_per_user }}
                        </td>
                        <td style="border: 1px solid #000000; padding: 5px;">
                            {{ $coupon->discount->end_date ? \Carbon\Carbon::parse($coupon->discount->end_date)->format('d M Y') : 'N/A' }}
                        </td>
                        <td style="border: 1px solid #000000; padding: 5px; text-transform: capitalize;">
                            {{ $coupon->is_active ? translate('Active') : translate('Inactive') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
