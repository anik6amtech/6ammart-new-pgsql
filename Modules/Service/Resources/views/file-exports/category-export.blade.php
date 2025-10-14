<div class="row">
    <div class="col-lg-12 text-center">
        <h1>{{ translate('messages.Category List') }}</h1>
    </div>
    <div class="col-lg-12">
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th style="padding-left: 10px;">
                        {{ translate('search_bar_content') }}: {{ $data['search'] }}
                        @if($data['status'] && $data['status'] != 'all')
                            <br>
                            {{ translate('Status') }}: {{ ucfirst($data['status']) }}
                        @endif
                    </th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <th>{{ translate('messages.sl') }}</th>
                    <th>{{ translate('messages.Name') }}</th>
                    <th>{{ translate('messages.Zones') }}</th>
                    <th>{{ translate('messages.Sub Categories') }}</th>
                    <th>{{ translate('messages.is_featured') }}</th>
                    <th>{{ translate('messages.Status') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['categories'] as $key => $category)
                    <tr>
                        <td style="border: 1px solid #000000; padding: 5px;">{{ $key + 1 }}</td>
                        <td style="border: 1px solid #000000; padding: 5px;">
                            {{ $category->name ?? 'N/A' }}
                        </td>
                        <td style="border: 1px solid #000000; padding: 5px;">
                            {{ $category->zones_count ?? 0 }}
                        </td>
                        <td style="border: 1px solid #000000; padding: 5px;">
                            {{ $category->children_count ?? 0 }}
                        </td>
                        <td style="border: 1px solid #000000; padding: 5px; text-transform: capitalize;">
                            {{ $category->is_featured ? translate('Yes') : translate('No') }}
                        </td>
                        <td style="border: 1px solid #000000; padding: 5px; text-transform: capitalize;">
                            {{ $category->is_active ? translate('Active') : translate('Inactive') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
