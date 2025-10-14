
@if(session()->has('variations'))
    @foreach(session('variations') as $key=>$item)
        <tr>
            <td class="text-title" style="background-color: #f9fafc;">
                {{$item['variant']}}
                <input name="variants[]" value="{{str_replace(' ','-',$item['variant'])}}" class="d-none">
            </td>
            <td class="max-w-170px" style="background-color: #f9fafc;">
                <input type="number" value="{{$item['price']}}" class="form-control h-35px bg-white" id="default-set-{{$key}}"
                       onkeyup="set_values('{{$key}}')" min="0.00001" step="any" required>
            </td>
            @foreach($zones as $zone)
                <td>
                    <input type="number" name="{{$item['variant_key']}}_{{$zone->id}}_price" value="{{$item['price']}}"
                           class="form-control h-35px bg-white default-get-{{$key}}" min="0.00001" step="any" required>
                </td>
            @endforeach
            <td>
                <a class="btn action-btn btn-outline-danger service-ajax-remove-variant"
                style="--size: 30px"
                   data-id="variation-table"
                   data-route="{{route('admin.service.service.ajax-remove-variant',[$item['variant_key']])}}">
                    <i class="tio-delete"></i>
                </a>
            </td>
        </tr>
    @endforeach
@endif

<script>
    "use strict";

    // Equivalent JavaScript code
    document.querySelectorAll('.service-ajax-remove-variant').forEach(function(element) {
        element.addEventListener('click', function() {
            var route = this.getAttribute('data-route');
            var id = this.getAttribute('data-id');
            ajax_remove_variant(route, id);
        });
    });

    function set_values(key) {
        document.querySelectorAll('.default-get-' + key).forEach(function(element) {
            element.value = document.getElementById('default-set-' + key).value;
        });
    }

</script>
