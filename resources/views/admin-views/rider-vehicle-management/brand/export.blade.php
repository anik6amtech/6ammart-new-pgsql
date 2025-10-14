<div class="row">
    <div class="col-lg-12 text-center "><h1 >{{ translate('Brand list') }}</h1></div>
    <div class="col-lg-12">
        <table>
            <thead>
            <tr>
                <th></th>
                <th>
                    @if ($data['search'])
                        <br>
                        {{ translate('search_bar_content' )}} : {{ $data['search'] }}
                    @endif

                    @if ($data['status'])
                        <br>
                        {{ translate('status' )}} : {{ translate($data['status']) }}
                    @endif
                </th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            <tr>
                <th>{{ translate('messages.sl') }}</th>
                <th>{{ translate('Brand ID') }}</th>
                <th>{{ translate('messages.brand_name') }}</th>
                <th>{{ translate('Brand description') }}</th>
                <th>{{ translate('Total Vehicle') }}</th>
                <th>{{ translate('messages.Status') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data['brands'] as $key => $item)
                <tr>
                    <td style="border: 1px solid #000000; padding: 5px;">{{ $key + 1 }}</td>
                    <td style="border: 1px solid #000000; padding: 5px;">{{ $item['id'] ?? 'N/A' }}</td>
                    <td style="border: 1px solid #000000; padding: 5px;">{{ ucwords($item['name']) ?? 'N/A' }}</td>
                    <td style="border: 1px solid #000000; padding: 5px;">{{ $item['description'] ?? 'N/A' }}</td>
                    <td style="border: 1px solid #000000; padding: 5px;">{{ $item?->vehicles?->count() ?? 0 }}</td>
                    <td style="border: 1px solid #000000; padding: 5px;">
                        {{ $item['is_active'] ? 'Active' : 'Inactive' }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
