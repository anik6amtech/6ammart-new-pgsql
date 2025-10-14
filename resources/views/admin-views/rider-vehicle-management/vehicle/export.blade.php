<div class="row">
    <div class="col-lg-12 text-center"><h1>{{ translate('Vehicle List') }}</h1></div>
    <div class="col-lg-12">
        <table>
            <thead>
            <tr>
                <th></th>
                <th>
                    @if ($data['search'])
                        <br>
                        {{ translate('search_bar_content') }} : {{ $data['search'] }}
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
                <th>{{ translate('Vehicle Name') }}</th>
                <th>{{ translate('Driver Name') }}</th>
                <th>{{ translate('Vehicle Type') }}</th>
                <th>{{ translate('Brand') }}</th>
                <th>{{ translate('Model') }}</th>
                <th>{{ translate('License Plate') }}</th>
                <th>{{ translate('Ownership') }}</th>
                <th>{{ translate('Fuel Type') }}</th>
                <th>{{ translate('Status') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data['vehicles'] as $key => $vehicle)
                <tr>
                    <td style="border: 1px solid #000000; padding: 5px;">{{ $key + 1 }}</td>
                    <td style="border: 1px solid #000000; padding: 5px;">{{ $vehicle->name ?? 'N/A' }}</td>
                    <td style="border: 1px solid #000000; padding: 5px;">
                        {{ $vehicle?->driver?->full_name ?? $vehicle?->driver?->first_name . ' ' . $vehicle?->driver?->last_name ?? 'N/A' }}
                    </td>
                    <td style="border: 1px solid #000000; padding: 5px;">
                        {{ ucwords(str_replace('_', ' ', $vehicle?->category?->type ?? 'N/A')) }}
                    </td>
                    <td style="border: 1px solid #000000; padding: 5px;">{{ $vehicle?->brand?->name ?? 'N/A' }}</td>
                    <td style="border: 1px solid #000000; padding: 5px;">{{ $vehicle?->model?->name ?? 'N/A' }}</td>
                    <td style="border: 1px solid #000000; padding: 5px;">{{ $vehicle->licence_plate_number ?? 'N/A' }}</td>
                    <td style="border: 1px solid #000000; padding: 5px;">{{ ucwords($vehicle->ownership ?? 'N/A') }}</td>
                    <td style="border: 1px solid #000000; padding: 5px;">{{ ucwords($vehicle->fuel_type ?? 'N/A') }}</td>
                    <td style="border: 1px solid #000000; padding: 5px;">
                        {{ $vehicle->is_active ? 'Active' : 'Inactive' }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
