<div class="row">
    <div class="col-lg-12 text-center"><h1>{{ translate('Vehicle Category List') }}</h1></div>
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
                <th>{{ translate('Category ID') }}</th>
                <th>{{ translate('Category Name') }}</th>
                <th>{{ translate('Category Description') }}</th>
                <th>{{ translate('Vehicle Type') }}</th>
                <th>{{ translate('Category use for') }}</th>
                <th>{{ translate('Distance') }}</th>
                <th>{{ translate('Status') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data['categories'] as $key => $category)
                <tr>
                    <td style="border: 1px solid #000000; padding: 5px;">{{ $key + 1 }}</td>
                    <td style="border: 1px solid #000000; padding: 5px;">{{ $category->id ?? 'N/A' }}</td>
                    <td style="border: 1px solid #000000; padding: 5px;">{{ $category->name ?? 'N/A' }}</td>
                    <td style="border: 1px solid #000000; padding: 5px;">{{ $category->description ?? 'N/A' }}</td>
                    <td style="border: 1px solid #000000; padding: 5px;">{{ ucfirst($category->type) ?? 'N/A' }}</td>
                    <td style="border: 1px solid #000000; padding: 5px;">
                        {{ $category->is_delivery ? 'Delivery' :  '' }}
                        {{ $category->is_delivery && $category->is_ride ? ' , ' :  '' }}
                        {{ $category->is_ride ? 'Ride' :  '' }}
                    </td>
                    <td style="border: 1px solid #000000; padding: 5px;">
                        @if($category->is_delivery)
                            {{ $category->starting_coverage_area ?: '-' }}
                            {{$category->maximum_coverage_area ? ' - '. $category->maximum_coverage_area . ' ' . translate('km') : '-' }}
                        @else
                            -
                        @endif
                    </td>
                    <td style="border: 1px solid #000000; padding: 5px;">
                        {{ $category->is_active ? 'Active' : 'Inactive' }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
