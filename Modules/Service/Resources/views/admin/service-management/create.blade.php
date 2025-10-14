@extends('layouts.admin.app')

@section('title', translate('add_new_service'))

@push('css_or_js')
<link rel="stylesheet" href="{{asset('public/assets/admin/css/view-pages/email-templates.css')}}">
<link href="{{ asset('public/assets/admin/css/tags-input.min.css') }}" rel="stylesheet">
@endpush

@section('content')

<div class="content container-fluid">
    <!-- Page Title -->
    <h2 class="h1 mb-sm-3 mb-2 text-capitalize d-flex align-items-center gap-2">
        {{ translate('messages.add_new_service') }}
    </h2>
    <form action="{{ route('admin.service.service.store') }}" method="post" enctype="multipart/form-data" id="serviceCreateForm">
        @csrf
        <div class="card mb-20">
            <div class="card-body p-20">
                <ul class="nav nav-tabs nav--tabs mb-20 border-0">
                     <li class="nav-item">
                        <a class="nav-link lang_link active"
                        href="#"
                        id="default-link">{{translate('messages.default')}}</a>
                    </li>
                    @foreach ($language as $lang)
                        <li class="nav-item">
                            <a class="nav-link lang_link"
                                href="#"
                                id="{{ $lang }}-link">{{ \App\CentralLogics\Helpers::get_language_name($lang) . '(' . strtoupper($lang) . ')' }}</a>
                        </li>
                    @endforeach
                </ul>
                <div class="row g-3">
                    <div class="col-12">
                        <div class="lang_form" id="default-form">
                            <div class="mb-20">
                                <label class="form-label">{{ translate('service_name') }} ({{ translate('Default') }}) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name[]"
                                    value="{{ old('name.0') }}" placeholder="{{ translate('service_name') }}" maxlength="255"
                                    data-preview-text="preview-title" required>
                            </div>
                            <div class="mb-20">
                                <label class="form-label">{{ translate('short_description') }} ({{ translate('Default') }}) <span class="text-danger">*</span></label>
                                <textarea name="short_description[]" rows="3" class="form-control" placeholder="{{ translate('short_description') }}" required>{{ old('short_description.0') }}</textarea>
                            </div>
                            <div class="form-group custom-editor mb-0">
                                <label class="form-label">
                                    {{ translate('messages.Long Description') }} ({{ translate('Default') }}) <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control position-relative ckeditor" data-id="mail-body" name="description[]" required>{{ old('description.0') }}</textarea>
                            </div>
                            <input type="hidden" name="lang[]" value="default">
                        </div>
                        @foreach ($language as $key => $lang)
                            <div class="d-none lang_form" id="{{ $lang }}-form">
                                <div class="mb-20">
                                <label class="form-label">{{ translate('service_name') }} ({{ strtoupper($lang) }})</label>
                                <input type="text" class="form-control" name="name[]"
                                    value="{{ old('name.'.$key) }}" placeholder="{{ translate('service_name') }}" maxlength="255"
                                    data-preview-text="preview-title">
                            </div>
                            <div class="mb-20">
                                <label class="form-label">{{ translate('short_description') }} ({{ strtoupper($lang) }})</label>
                                <textarea name="short_description[]" rows="3" class="form-control" placeholder="{{ translate('short_description') }}">{{ old('short_description.'.$key) }}</textarea>
                            </div>
                            <div class="form-group custom-editor mb-0">
                                <label class="form-label">
                                    {{ translate('messages.Long Description') }} ({{ strtoupper($lang) }})
                                </label>
                                <textarea class="form-control position-relative ckeditor" data-id="mail-body" name="description[]">{{ old('description.'.$key) }}</textarea>
                            </div>
                            <input type="hidden" name="lang[]" value="{{ $lang }}">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-20">
            <div class="p-20 border-bottom">
                <h4 class="mb-1">{{ translate('messages.Media Files') }}</h4>
                <p class="m-0">{{ translate('messages.Service Variation') }}</p>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    <div class="col-lg-4 col-md-6">
                        <div>
                            <div class="mb-xl-3 mb-2">
                                <h5 class="mb-1">{{ translate('messages.Thumbnail Image') }} <span class="text-danger">*</span></h5>
                                <span class="fz-12px">{{ translate('messages.JPG, JPEG, PNG Less Than 1MB') }} <strong>(Ratio 1:1)</strong></span>
                            </div>
                            <div class="global-image-upload ratio-1 border-dashed rounded-10 bg-light position-relative max-w-100 overflow-hidden border-dashed h-130 d-center">
                                <input type="file" name="thumbnail" accept="image/*" required style="position: absolute; width: 100%; height: 100%; opacity: 0; cursor: pointer;">
                                <div class="global-upload-box">
                                    <div class="upload-content text-center">
                                        <img src="{{asset('Modules/Service/public/assets/img/admin/do-upload.png')}}" alt="upload-your-image" class="mb-2">
                                        <div class="d-grid align-items-center gap-1 justify-content-center">
                                            <span class="fz-12px text-theme d-block">{{ translate('messages.Click to upload') }}</span> <span class="fz-12px text-title d-block">{{ translate('messages.or drag and drop') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <img class="global-image-preview d-none" src="" alt="Preview" style="max-height: 100%; max-width: 100%;" />
                                <div class="overlay-icons d-none">
                                    <button type="button" class="btn btn--info p-2 action-btn view-icon" title="View" data-toggle="modal" data-target="#imageShowingMOdal">
                                        <i class="tio-invisible"></i>
                                    </button>
                                    <button type="button" class="btn btn--info p-2 action-btn edit-icon" title="Edit">
                                        <i class="tio-edit"></i>
                                    </button>
                                </div>
                                <div class="image-file-name d-none mt-2 text-center text-muted" style="font-size: 12px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-6">
                        <div>
                            <div class="mb-xl-3 mb-2">
                                <h5 class="mb-1">{{ translate('messages.Additional Image') }} <span class="text-danger">*</span></h5>
                                <span class="fz-12px">{{ translate('messages.JPG, JPEG, PNG Less Than 1MB') }} <strong>(Ratio 1:1)</strong></span>
                            </div>
                            <div class="global-image-upload ratio-1 border-dashed rounded-10 bg-light position-relative max-w-100 overflow-hidden border-dashed h-130 d-center">
                                <input type="file" accept="image/*" name="cover_image" required style="position: absolute; width: 100%; height: 100%; opacity: 0; cursor: pointer;">
                                <div class="global-upload-box">
                                    <div class="upload-content text-center">
                                        <img src="{{asset('Modules/Service/public/assets/img/admin/do-upload.png')}}" alt="upload-your-image" class="mb-2">
                                        <div class="d-grid align-items-center gap-1 justify-content-center">
                                            <span class="fz-12px text-theme d-block">{{ translate('messages.Click to upload') }}</span> <span class="fz-12px text-title d-block">{{ translate('messages.or drag and drop') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <img class="global-image-preview d-none" src="" alt="Preview" style="max-height: 100%; max-width: 100%;" />
                                <div class="overlay-icons d-none">
                                    <button type="button" class="btn btn--info p-2 action-btn view-icon" title="View" data-toggle="modal" data-target="#imageShowingMOdal">
                                        <i class="tio-invisible"></i>
                                    </button>
                                    <button type="button" class="btn btn--info p-2 action-btn edit-icon" title="Edit">
                                        <i class="tio-edit"></i>
                                    </button>
                                </div>
                                <div class="image-file-name d-none mt-2 text-center text-muted" style="font-size: 12px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-20">
            <div class="p-20 border-bottom">
                <h4 class="mb-1">{{ translate('messages.Business Info') }}</h4>
                <p class="m-0">{{ translate('messages.Service Variation') }}</p>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-sm-6">
                        <div class="form-group mb-0">
                            <label for="choose-category" class="text-title fz--14px">{{ translate('messages.Choose Service Category') }} <span class="text-danger">*</span></label>
                            <select name="category_id" id="category-id" class="form-control js-select2-custom"
                                data-placeholder="{{ translate('messages.select_category') }}" required>
                                <option value="" selected disabled>
                                    {{ translate('messages.Select service categories') }}
                                </option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group mb-0">
                            <label for="choose-category" class="text-title fz--14px">{{ translate('messages.Choose Service Sub Category') }} <span class="text-danger">*</span></label>
                            <div id="sub-category-selector">
                                <select name="sub_category_id" class="form-control js-select2-custom"
                                    data-placeholder="{{ translate('messages.select_sub_category') }}" required>
                                    <option value="" selected disabled>
                                        {{ translate('messages.Select service category first') }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group mb-0">
                            <label for="choose-category" class="text-title fz--14px">{{ translate('messages.Service Tax') }} (%) <span class="text-danger">*</span></label>
                            <div class="d-flex align-items-center border rounded overflow hidden">
                                <input type="number" name="tax" min="0" step="0.01" placeholder="Ex : 5" class="form-control w-100 border-0" value="{{ old('tax') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group mb-0">
                            <label for="choose-category" class="text-title fz--14px">{{ translate('messages.Minimum Bidding Price ($)') }} <span class="text-danger">*</span></label>
                            <input type="number" name="min_bidding_price" class="form-control h--45px" placeholder="100" value="{{ old('min_bidding_price') }}" min="1" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group mb-0 select-couting position-relative">
                            <label class="input-label" for="taxservice">{{translate('messages.Service Tags')}}</label>
                            <input type="text" class="form-control" name="tags" placeholder="{{translate('messages.search_tags')}}" data-role="tagsinput" value="{{ old('tags') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-20 variation-card-wrapper" style="display: none;">
            <div class="p-20 border-bottom">
                <h4 class="mb-1">{{ translate('messages.Price & Variation') }}</h4>
                <p class="m-0">{{ translate('messages.Service Variation') }}</p>
            </div>
            <div class="card-body">
                 <div class="row g-3 mb-3 variation-bodywrap_add">
                    <div class="col-12 variation-items_add">
                        <div class="d-flex align-items-md-end gap-20px">
                            <div class="row g-3 w-100">
                                <div class="col-md-6">
                                    <div class="form-group mb-0">
                                        <label class="input-label" for="v_name">{{ translate('messages.Variation Name') }} <span class="text-danger">*</span></label>
                                        <input type="text" name="v_name" class="form-control" id="v_name" placeholder="3 Ton">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-0">
                                        <label class="input-label" for="v_price">{{ translate('messages.Variation Price ($)') }} <span class="text-danger">*</span></label>
                                        <input type="number" name="v_price" class="form-control" id="v_price" placeholder="20.52" min="0">
                                    </div>
                                </div>
                            </div>
                            <div class="justify-content-center mb-md-1 mt-md-0 mt-2 d-flex gap-2">
                                <button type="button"
                                    class="variation-add_btn action-btn btn--primary btn-outline-primary rounded-pill"
                                    style="--size: 30px" id="add-new-variation">
                                    <i class="tio-add"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Variations Table -->
                <div class="table-responsive">
                    <table id="variation-table" class="table m-0 align-middle align-middle-cus table-custom-space tr-hover">
                        <thead class="text-nowrap bg-light" id="category-wise-zone">
                            <tr>
                                <th class="fz--14px text-title border-0">{{ translate('messages.Variations') }}</th>
                                <th class="fz--14px text-title border-0">{{ translate('messages.Default price($)') }}</th>
                                <th class="fz--14px text-title border-0">{{ translate('messages.All over the World ($)') }}</th>
                                <th class="fz--14px text-title border-0">{{ translate('messages.Test Zone 2 ($)') }}</th>
                                <th class="fz--14px text-title border-0 text-center">{{ translate('messages.Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="btn--container justify-content-end mt-3">
            <button type="reset" class="btn min-w-120 btn--reset">{{ translate('messages.Reset') }}</button>
            <button type="submit" class="btn min-w-120 btn--primary call-demo">{{ translate('messages.Submit') }}</button>
        </div>
    </form>

    <!--image showing-->
    <div class="modal fade custom-confirmation-modal" id="imageShowingMOdal" tabindex="-1" aria-labelledby="imageShowingMOdalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body py-3 px-sm-4 px-3">
                    <button type="button" class="btn-close image-show__close bg-light rounded-full" data-dismiss="modal" aria-label="Close">
                        <i class="tio-clear"></i>
                    </button>
                    <div class="image-display-container">
                        <!-- Push Inside any images -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('script_2')
    <!-- Email Template-->
    <script src="{{asset('public/assets/admin/ckeditor/ckeditor.js')}}"></script>
    <script src="{{ asset('public/assets/admin') }}/js/tags-input.min.js"></script>
    <script src="{{asset('public/assets/admin/js/view-pages/email-templates.js')}}"></script>
    <!-- Email Template End-->

    <script>
        var variationCount = $("#variation-table > tbody > tr").length;

        function toggleVariationInputs() {
            if($("#variation-table > tbody > tr").length > 0) {
                $('#v_name, #v_price').removeAttr('required');
            } else {
                $('#v_name, #v_price').attr('required', 'required');
            }
        }

        $(document).ready(function () {

            toggleVariationInputs();

            $("#add-new-variation").on('click', function (){
                let route = "{{route('admin.service.service.ajax-add-variant')}}";
                let id = "variation-table";
                ajax_variation(route, id);
            })

            function ajax_variation(route, id) {
                let nameInput = $('#v_name');
                let priceInput = $('#v_price');
                if(!nameInput.val()) {
                    toastr.error("{{translate('messages.Variation name is required')}}");
                    return;
                }
                if(!priceInput.val()) {
                    toastr.error("{{translate('messages.Variation price is required')}}");
                    return;
                }
                if (isNaN(parseFloat(priceInput.val())) || parseFloat(priceInput.val()) <= 0) {
                    toastr.error("{{translate('messages.Variation price must be greater than 0')}}");
                    return;
                }

                if (nameInput.val().length > 0 && priceInput.val() > 0) {
                    $.get({
                        url: route,
                        dataType: 'json',
                        data: {
                            name: nameInput.val(),
                            price: priceInput.val(),
                        },
                        success: function (response) {
                            if (response.flag == 0) {
                                toastr.info('Already added');
                            } else {
                                $('#new-variations-table').show();
                                $('#' + id + " tbody").html(response.template);
                                nameInput.val("");
                                priceInput.val("");
                            }
                            variationCount++;
                            toggleVariationInputs();
                        },
                    });
                }
            }

            $("#category-id").change(function (){
                let id = this.value;
                let route = "{{ url('/admin/service/category/ajax-childes/') }}/" + id;
                $(".variation-card-wrapper").show();
                ajax_switch_category(route);
            });

            function ajax_switch_category(route) {
                $.get({
                    url: route,
                    dataType: 'json',
                    data: {},
                    success: function (response) {
                        $('#sub-category-selector').html(response.template);
                        $('#category-wise-zone').html(response.template_for_zone);
                        $('#variation-table tbody').html(response.template_for_variant);

                        toggleVariationInputs();
                    }
                });
            }

            document.querySelectorAll('.service-ajax-remove-variant').forEach(function(element) {
                element.addEventListener('click', function() {
                    var route = this.getAttribute('data-route');
                    var id = this.getAttribute('data-id');
                    ajax_remove_variant(route, id);
                });
            });

        });

        function ajax_remove_variant(route, id) {
            Swal.fire({
                title: "{{translate('are_you_sure')}}?",
                text: "{{translate('want_to_remove_this_variation')}}",
                type: 'warning',
                showCloseButton: true,
                showCancelButton: true,
                cancelButtonText: 'Cancel',
                confirmButtonText: 'Yes',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $.get({
                        url: route,
                        dataType: 'json',
                        success: function (response) {
                            $('#' + id + ' tbody').html(response.template);

                            toggleVariationInputs();
                        }
                    });
                }
            })
        }

        $("#serviceCreateForm").on('submit', function (e) {
            let isValid = true;

            if($("#variation-table > tbody > tr").length < 1) {
                isValid = false;
                toastr.error("{{ translate('messages.variation_required') }}");
            }

            let description = $("textarea[name='description[]']").val();
            if(!description || description.trim() === "") {
                isValid = false;
                toastr.error("{{ translate('messages.description_required') }}");
            }

            if(!isValid) {
                e.preventDefault();
            }
            return isValid;
        });
    </script>

@endpush
