
<div class="row">
    <div class="col-lg-12 text-center "><h1 > {{translate('service_request_List')}}
        </h1></div>
    <div class="col-lg-12">

        <table>
            <thead>
            <tr>
                <th>{{ translate('Filter_Criteria') }}</th>
                <th></th>
                <th>
                    {{ translate('Search_Bar_Content')  }}: {{ $data['search'] ?? translate('N/A') }}

                </th>
                <th> </th>
            </tr>


            <tr>
                <th>{{ translate('sl') }}</th>
                <th>{{ translate('Category') }}</th>
                @if(isset($data['export_type']) ?? false)
                    <th>{{ translate('User') }}</th>
                @endif
                <th>{{ translate('Suggested Service Name') }}</th>
                <th>{{ translate('Service Description') }}</th>
                <th>{{ translate('admin Feedback') }}</th>
                <th>{{ translate('Status') }}</th>

            </thead>
            <tbody>
            @foreach($data['data'] as $key => $service)
                <tr>
                    <td>{{ $loop->index+1}}</td>
                    <td>{{ $service?->category?->name }}</td>
                    @if(isset($data['export_type']) ?? false)
                        @if($service->type == PROVIDER) 
                            <td>{{ $service?->provider?->company_name }} ({{PROVIDER}})</td>
                        @else
                            <td>{{ $service?->user?->f_name . ' ' . $service?->user?->l_name }} ({{CUSTOMER}})</td>
                        @endif
                    @endif
                    <td>{{ $service->service_name }}</td>
                    <td>{{ $service?->service_description }}</td>
                    <td>{{ $service?->admin_feedback }}</td>
                    <td>{{ $service->status }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
