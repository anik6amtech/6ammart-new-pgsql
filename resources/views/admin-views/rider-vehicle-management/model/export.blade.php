<div class="row">
    <div class="col-lg-12 text-center"><h1>{{ translate('Vehicle Model List') }}</h1></div>
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

                    @if ($data['status'])
                        <br>
                        {{ translate('status') }} : {{ translate($data['status']) }}
                    @endif
                </th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            <tr>
                <th>{{ translate('messages.sl') }}</th>
                <th>{{ translate('Model ID') }}</th>
                <th>{{ translate('Model Name') }}</th>
                <th>{{ translate('Model Description') }}</th>
                <th>{{ translate('Brand Name') }}</th>
                <th>{{ translate('Total Vehicle') }}</th>
                <th>{{ translate('Status') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data['models'] as $key => $model)
                <tr>
                    <td style="border: 1px solid #000000; padding: 5px;">{{ $key + 1 }}</td>
                    <td style="border: 1px solid #000000; padding: 5px;">{{ $model->id ?? 'N/A' }}</td>
                    <td style="border: 1px solid #000000; padding: 5px;">{{ $model->description ?? 'N/A' }}</td>
                    <td style="border: 1px solid #000000; padding: 5px;">{{ $model->name ?? 'N/A' }}</td>
                    <td style="border: 1px solid #000000; padding: 5px;">{{ $model->brand->name ?? 'N/A' }}</td>
                    <td style="border: 1px solid #000000; padding: 5px;">{{ $model?->vehicles?->count() ?? 0 }}</td>
                    <td style="border: 1px solid #000000; padding: 5px;">
                        {{ $model->is_active ? 'Active' : 'Inactive' }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
