<div class="row">
    <div class="col-lg-12 text-center">
        <h1>{{ translate('messages.Banner List') }}</h1>
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

                        @if ($data['resource_type'])
                            <br>
                            {{ translate('Resource Type') }}: {{ ucfirst($data['resource_type']) }}
                        @endif
                    </th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <th>{{ translate('messages.sl') }}</th>
                    <th>{{ translate('messages.Title') }}</th>
                    <th>{{ translate('messages.Resource Type') }}</th>
                    <th>{{ translate('messages.Resource') }}</th>
                    <th>{{ translate('messages.Status') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['banners'] as $key => $banner)
                    <tr>
                        <td style="border: 1px solid #000000; padding: 5px;">{{ $key + 1 }}</td>
                        <td style="border: 1px solid #000000; padding: 5px;">
                            {{ $banner->title ?? 'N/A' }}
                        </td>
                        <td style="border: 1px solid #000000; padding: 5px; text-transform: capitalize;">
                            {{ $banner->type ?? 'N/A' }}
                        </td>
                        <td style="border: 1px solid #000000; padding: 5px;">
                            @if($banner->type === 'service' && $banner->service)
                                {{ $banner->service->name ?? 'N/A' }}
                            @elseif($banner->type === 'category' && $banner->category)
                                {{ $banner->category->name ?? 'N/A' }}
                            @elseif($banner->type === 'redirect_link')
                                {{ $banner->default_link ?? 'N/A' }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td style="border: 1px solid #000000; padding: 5px; text-transform: capitalize;">
                            {{ $banner->status ? translate('Active') : translate('Inactive') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
