<div class="row">
    <div class="col-lg-12 text-center">
        <h1>{{ translate('messages.Provider List') }}</h1>
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

                        @if ($data['zone'])
                            <br>
                            {{ translate('Zone') }}: {{ $data['providers']?->first()?->zone?->name  }}
                        @endif
                    </th>
                    <th></th>
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
                    <th>{{ translate('messages.Provider ID') }}</th>
                    <th>{{ translate('messages.Provider Info') }}</th>
                    <th>{{ translate('messages.Contact info') }}</th>
                    <th>{{ translate('messages.company_phone') }}</th>
                    <th>{{ translate('messages.company_email') }}</th>
                    <th>{{ translate('messages.Zone') }}</th>
                    <th>{{ translate('messages.No Of Services') }}</th>
                    <th>{{ translate('messages.No Of Booking Served') }}</th>
                    <th>{{ translate('messages.Status') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['providers'] as $key => $provider)
                    <tr>
                        <td style="border: 1px solid #000000; padding: 5px;">{{ $key + 1 }}</td>
                        <td style="border: 1px solid #000000; padding: 5px;">{{ $provider->id ?? 'N/A' }}</td>
                        <td style="border: 1px solid #000000; padding: 5px;">
                            {{ $provider->company_name ?? 'N/A' }}
                        </td>
                        <td style="border: 1px solid #000000; padding: 5px;">
                            <div>
                                <div>{{ $provider->first_name ?? '' }} {{ $provider->last_name ?? '' }}</div><br>
                                <div>{{ $provider->phone ?? '' }}</div><br>
                                <div>{{ $provider->email ?? '' }}</div>
                            </div>
                        </td>
                        <td style="border: 1px solid #000000; padding: 5px;">
                            {{ $provider->company_phone ?? 'N/A' }}
                        </td>
                        <td style="border: 1px solid #000000; padding: 5px;">
                            {{ $provider->company_email ?? 'N/A' }}
                        </td>
                        <td style="border: 1px solid #000000; padding: 5px;">
                            {{ $provider?->zone?->name ?? 'N/A' }}
                        </td>
                        <td style="border: 1px solid #000000; padding: 5px; text-align: center;">
                            {{ $provider?->subscribed_services->count() ?? 0 }}
                        </td>
                        <td style="border: 1px solid #000000; padding: 5px; text-align: center;">
                            {{ $provider?->bookings?->count() ?? 0 }}
                        </td>
                        <td style="border: 1px solid #000000; padding: 5px; text-transform: capitalize;">
                            {{ $provider->is_active ? translate('Active') : translate('Inactive') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
