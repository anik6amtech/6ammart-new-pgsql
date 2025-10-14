@foreach($withdraw_req as $k=>$wr)
<tr>
    <td scope="row">{{$k+1}}</td>
    <td>{{\App\CentralLogics\Helpers::format_currency($wr['amount'])}}</td>
    <td>
        @if($wr->deliveryman)
        <a class="deco-none" title="{{ $wr->deliveryman->f_name.' '.$wr->deliveryman->l_name }}"
            href="#">{{ Str::limit($wr->deliveryman->f_name.' '.$wr->deliveryman->l_name, 20, '...') }}</a>
        @else
        {{translate('messages.rider deleted!') }}
        @endif
    </td>
    <td>  {{ \App\CentralLogics\Helpers::time_date_format($wr->created_at) }} </td>
    <td>
        @if($wr->approved==0)
            <label class="badge badge-soft-primary">{{ translate('messages.pending') }}</label>
        @elseif($wr->approved==1)
            <label class="badge badge-soft-success">{{ translate('messages.approved') }}</label>
        @else
            <label class="badge badge-soft-danger">{{ translate('messages.denied') }}</label>
        @endif
    </td>
    <td>
        @if($wr->deliveryman)

        <a href="#"
            data-id="{{$wr->id}}"
            class="btn action-btn btn--warning btn-outline-warning withdraw-info-show"><i class="tio-visible-outlined"></i>
        </a>
        @else
        {{translate('messages.rider_deleted') }}
        @endif
    </td>
</tr>
@endforeach
