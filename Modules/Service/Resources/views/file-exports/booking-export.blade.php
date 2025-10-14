<div class="row">
    <div class="col-lg-12 text-center">
        <h1>
            {{ isset($data['is_verify'])
                ? translate('messages.Verify ')
                : translate(ucfirst($data['status']))
            }} {{ translate('messages.Booking List') }}
        </h1>
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

                        @if ($data['status'] && $data['status'] != 'all')
                            <br>
                            {{ translate('Status') }}: {{ translate(ucfirst($data['status'])) }}
                        @endif

                        @if ($data['service_type'])
                            <br>
                            {{ translate('Service Type') }}: {{ translate(ucfirst($data['service_type'])) }}
                        @endif

                        @if ($data['provider_assigned'])
                            <br>
                            {{ translate('Provider') }}: {{ translate(ucfirst($data['provider_assigned'])) }}
                        @endif

                        @if ($data['start_date'] && $data['end_date'])
                            <br>
                            {{ translate('Date Range') }}: {{ $data['start_date'] }} {{ translate('to') }} {{ $data['end_date'] }}
                        @endif</th>
                    <th>
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
                    <th>{{ translate('messages.Booking ID') }}</th>
                    <th>{{ translate('messages.customer_info') }}</th>
                    <th>{{ translate('messages.Booking Time') }}</th>
                    <th>{{ translate('messages.Service Time') }}</th>
                    <th>{{ translate('messages.Category') }}</th>
                    <th>{{ translate('messages.Sub Category') }}</th>
                    <th>{{ translate('messages.Service') }}</th>
                    <th>{{ translate('messages.Provider') }}</th>
                    <th>{{ translate('messages.Serviceman') }}</th>
                    <th>{{ translate('messages.Amount') }}</th>
                    <th>{{ translate('messages.Status') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['bookings'] as $key => $booking)
                    <tr>
                        <td style="border: 1px solid #000000; padding: 5px;">{{ $key + 1 }}</td>
                        <td style="border: 1px solid #000000; padding: 5px;">{{ $booking->id ?? 'N/A' }}</td>
                        <td style="border: 1px solid #000000; padding: 5px;">
                            @if(!empty($booking->customer))
                                {{ $booking->customer->f_name ?? '' }} {{ $booking->customer->l_name ?? '' }}
                                @if(!empty($booking->customer->phone))
                                    <br>{{ $booking->customer->phone }}
                                @endif
                            @else
                                N/A
                            @endif
                        </td>
                        <td style="border: 1px solid #000000; padding: 5px;">
                            <div>
                                <div>{{ date('d-m-Y', strtotime($booking->created_at)) }}</div><br>
                                <div>{{ date('h:i A', strtotime($booking->created_at)) }}</div>
                            </div>
                        </td>
                        <td style="border: 1px solid #000000; padding: 5px;">
                            <div>
                                <div>{{ date('d-m-Y', strtotime($booking->service_schedule)) }}</div><br>
                                <div>{{ date('h:i A', strtotime($booking->service_schedule)) }}</div>
                            </div>
                        </td>
                        <td style="border: 1px solid #000000; padding: 5px;">{{ $booking->category->name ?? 'N/A' }}</td>
                        <td style="border: 1px solid #000000; padding: 5px;">{{ $booking->subCategory->name ?? 'N/A' }}</td>
                        <td style="border: 1px solid #000000; padding: 5px;">{{ $booking?->detail->first()->service->name ?? 'N/A' }}</td>
                        <td style="border: 1px solid #000000; padding: 5px;">
                            @if(!empty($booking->provider))
                                {{ $booking->provider->company_name ?? $booking->provider->company_phone ?? 'N/A' }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td style="border: 1px solid #000000; padding: 5px;">
                            @if(!empty($booking?->serviceman))
                                {{ $booking->serviceman->first_name ?? '' }} {{ $booking->serviceman->last_name ?? '' }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td style="border: 1px solid #000000; padding: 5px; text-align: right;">
                            {{ \App\CentralLogics\Helpers::format_currency($booking->total_booking_amount, 2) }}
                        </td>
                        <td style="border: 1px solid #000000; padding: 5px; text-transform: capitalize;">
                            {{ $booking->booking_status }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
