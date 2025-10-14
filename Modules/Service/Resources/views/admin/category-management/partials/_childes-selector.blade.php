<select class="js-select theme-input-style w-100" name="sub_category_id" data-placeholder="{{ (request()->has('allOption') && request()->get('allOption') == 'yes') ? translate('messages.All Subcategory') : translate('messages.select_sub_category') }}">
    @if(request()->has('allOption') && request()->get('allOption') == 'yes')
        <option value="">{{ translate('messages.all_subcategory') }}</option>
    @endif
    @foreach($categories as $category)
        <option value="{{$category->id}}" {{isset($subCategoryId) && $subCategoryId == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
    @endforeach
</select>

<script>
    $(document).ready(function () {
        $('.js-select').select2();
    });
</script>
