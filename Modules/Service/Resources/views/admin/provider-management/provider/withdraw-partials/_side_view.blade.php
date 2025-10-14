

<div class="d-flex flex-column align-items-center gap-1 mb-3">
    <h3 class="mb-3">{{translate('withdraw_Information')}}</h3>
    <div class="d-flex gap-2 align-items-center mb-1 flex-wrap">
        <span>{{translate('withdraw_Amount')}}:</span>
        <span class="font-semibold">{{\App\CentralLogics\Helpers::format_currency($withdraw['amount'])}}</span>
@if ($withdraw->request_status == 'approved')
<label class="badge badge-soft-success mb-0">{{translate('approved')}}</label>

@elseif($withdraw->request_status == 'pending')
<label class="badge badge-soft-primary mb-0">{{translate('Pending')}}</label>
@else

<label class="badge badge-soft-danger mb-0">{{translate('Denied')}}</label>
@endif


    </div>
    <div class="d-flex gap-2 align-items-center fs-12">
        <span>{{translate('request_time')}}:</span>
        <span>{{ \App\CentralLogics\Helpers::time_date_format($withdraw->created_at) }}</span>
    </div>
</div>

<div class="card mb-3">
    <div class="card-header">
        <h6 class="mb-0 font-medium">{{translate('Provider_Info')}}</h6>
    </div>
    <div class="card-body">
        <div class="key-val-list d-flex flex-column gap-2" style="--min-width: 60px">
            <div class="key-val-list-item d-flex gap-3">
                <span>{{ translate('Name') }}:</span>
                <span>{{$withdraw->provider->first_name.' '.$withdraw->provider->last_name}}</span>
            </div>
        </div>

        <div class="rounded bg-light p-3 mt-3">
            <div class="key-val-list-item d-flex gap-3">
                <span>{{ translate('Provider_Balance') }}:</span>
                <span class="font-semibold text-primary fs-16"> {{ \App\CentralLogics\Helpers::format_currency($withdraw->provider->account->received_balance + $withdraw->provider->account->total_withdrawn) }}</span>
            </div>
        </div>
    </div>
</div>

<div class="card mb-3">
    <div class="card-header">
        <h6 class="mb-0 font-medium">{{translate('payment_Info')}}</h6>
    </div>
    <div class="card-body">
        <div class="key-val-list d-flex flex-column gap-2" style="--min-width: 60px">
          <div class="key-val-list-item d-flex gap-3">
            <span>{{ translate('method') }}:</span>
            <span>{{ $withdraw?->withdraw_method?->method_name }}</span>
        </div>
        @if($withdraw?->withdrawal_method_fields)
        @foreach($withdraw?->withdrawal_method_fields as $key => $item)
            <div class="key-val-list-item d-flex gap-3">
                <span>{{ translate($key) }}:</span>
                <span>{{ is_array($item) ? '' : htmlspecialchars($item) }}</span>
            </div>
        @endforeach
        @else
            <h5 class="text-capitalize">{{ translate('messages.No_Data_found') }}</h5>
        @endif
        </div>
    </div>
</div>

    @if ($withdraw->request_status == 'approved')
    <div class="">
        <h5 class="font-medium">{{translate('approved_Note')}}</h5>
        <div class="rounded bg-light p-3">
            {{str_replace('_' ,' ' ,$withdraw->admin_note)}}
        </div>
        @elseif($withdraw->request_status == 'denied')
    </div> <div class="">
        <h5 class="font-medium">{{translate('Denied_Note')}}</h5>
        <div class="rounded bg-light p-3">
            {{str_replace('_' ,' ' ,$withdraw->admin_note)}}
        </div>
    </div>
    @endif

    @if ($withdraw->request_status == 'pending')
    <div class="mt-4 d-flex justify-content-center gap-3">
        <button type="button" data-id="{{$withdraw->id}}" class="btn btn-soft-danger withdraw-info-hide min-w-100px show-deny-view">{{translate('deny')}}</button>
        <button type="button" data-id="{{$withdraw->id}}" class="btn btn-success withdraw-info-hide min-w-100px show-approve-view">{{translate('approve')}}</button>
    </div>
    @endif
