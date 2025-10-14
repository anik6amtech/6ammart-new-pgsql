@foreach($withdraw_req as $k=>$wr)
<tr>
    <td scope="row">{{$k+1}}</td>
    <td>{{$wr['amount']}}</td>
    <td>
        @if($wr->provider)
        <a class="deco-none"
            href="">{{ Str::limit($wr->provider->company_name, 20, '...') }}</a>
        @else
        {{translate('messages.provider deleted!') }}
        @endif
    </td>
    <td>{{date('Y-m-d '.config('timeformat'),strtotime($wr->created_at))}}</td>
    <td>
        @if($wr->request_status== 'pending')
            <label class="badge badge-primary">{{ translate('messages.pending') }}</label>
        @elseif($wr->request_status=='approved')
            <label class="badge badge-success">{{ translate('messages.approved') }}</label>
        @else
            <label class="badge badge-danger">{{ translate('messages.denied') }}</label>
        @endif
    </td>
    <td>
        @if($wr->provider)
        <a href="{{route('admin.transactions.service.provider.withdraw_view',[$wr['id'],$wr->provider['id']])}}"
            class="btn action-btn btn--warning btn-outline-warning"><i class="tio-visible-outlined"></i>
        </a>
        @else
        {{translate('messages.provider_deleted') }}
        @endif

    </td>
</tr>
@endforeach
