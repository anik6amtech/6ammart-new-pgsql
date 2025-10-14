<div class="row">
    <div class="col-lg-12 text-center">
        <h1>{{ translate('messages.Sub Category List') }}</h1>
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
                    <th>{{ translate('messages.description') }}</th>
                    <th>{{ translate('messages.Parent Category') }}</th>
                    <th>{{ translate('messages.Services') }}</th>
                    <th>{{ translate('messages.Status') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['subCategories'] as $key => $subCategory)
                    <tr>
                        <td style="border: 1px solid #000000; padding: 5px;">{{ $key + 1 }}</td>
                        <td style="border: 1px solid #000000; padding: 5px;">
                            {{ $subCategory->name ?? 'N/A' }}
                        </td>
                        <td style="border: 1px solid #000000; padding: 5px; text-transform: capitalize;">
                            {{ $subCategory->description }}
                        </td>
                        <td style="border: 1px solid #000000; padding: 5px;">
                            {{ $subCategory->parent->name ?? 'N/A' }}
                        </td>
                        <td style="border: 1px solid #000000; padding: 5px;">
                            {{ $subCategory->services_count ?? 0 }}
                        </td>
                        <td style="border: 1px solid #000000; padding: 5px; text-transform: capitalize;">
                            {{ $subCategory->is_active ? translate('Active') : translate('Inactive') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
