<tr id="service-row--{{$data['variant_key']}}">
    <td class="text-wrap ps-lg-3">
        <div class="d-flex flex-column">
            <a href="{{route('provider.service.service.service-details',[$data['service_id']])}}"
               class="fw-bold">{{Str::limit($data['service_name'], 30)}}</a>
            <div>{{Str::limit($data['variant_key'], 50)}}</div>
        </div>
    </td>
    <td id="service-cost-{{$data['variant_key']}}">{{\App\CentralLogics\Helpers::format_currency($data['service_cost'])}}</td>
    <td>
        <input type="number" min="1" name="qty[]" class="form-control qty-width"
               id="qty-{{$data['variant_key']}}" value="{{$data['quantity']}}"
               oninput="this.value = this.value.replace(/[^0-9]/g, '');" readonly>
    </td>
    <td id="discount-amount-{{$data['variant_key']}}">{{\App\CentralLogics\Helpers::format_currency($data['total_discount_amount'])}}</td>
    <td id="total-cost-{{$data['variant_key']}}">{{\App\CentralLogics\Helpers::format_currency($data['total_cost'])}}</td>
    <td>
        <div class="d-flex justify-content-center">
            <i class="tio-delete text-danger cursor-pointer remove-service-row" data-row="service-row--{{$data['variant_key']}}"> </i>
        </div>
    </td>
    <input type="hidden" name="service_ids[]" value="{{$data['service_id']}}">
    <input type="hidden" name="variant_keys[]" value="{{$data['variant_key']}}">
</tr>

<script>
    "use strict";

    $(".remove-service-row").on('click', function (){
        let row = $(this).data('row');
        removeServiceRow(row)
    })
</script>
