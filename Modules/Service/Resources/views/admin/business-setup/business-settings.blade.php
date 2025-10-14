@extends('layouts.admin.app')

@section('title', translate('messages.business_settings'))

@push('css_or_js')
@endpush

@section('content')
    <div class="content container-fluid">

        @include('service::admin.business-setup.partials._header')

        @if(request('tab') == 'providers')
            @include('service::admin.business-setup.pages.providers')
        @elseif(request('tab') == 'serviceman')
            @include('service::admin.business-setup.pages.serviceman')
        @elseif(request('tab') == 'promotion')
            @include('service::admin.business-setup.pages.promotion')
        @else
            @include('service::admin.business-setup.pages.bookings')
        {{-- @else
            <div class="alert alert-danger">
                {{ translate('messages.invalid_tab') }}
            </div> --}}
        @endif
    </div>

@endsection

@push('script_2')
    <script>
        function checkboxToggleElement(checkbox, elementId) {
            const element = document.getElementById(elementId);
            if (checkbox.checked) {
                element.classList.remove('d-none');
            } else {
                element.classList.add('d-none');
            }
        }
        //use jQuery
        function radioToggleElement(radioName, targetValue, elementSelector) {
            if($(`input[name="${radioName}"]:checked`).val() === targetValue) {
                $(elementSelector).removeClass('d-none');
            } else {
                $(elementSelector).addClass('d-none');
            }
        }

        $(document).ready(function() {
            $(".hundred_percent").on('input', function() {
                let total = 0;
                currentInputVal = parseFloat($(this).val()) || 0;
                let type = $(this).data('type') || 'default';
                let currentInputClass = $(this).attr('class');
                // select other input with the .hundred_percent and data type which is not the current input
                $(".hundred_percent[data-type=" + type + "]").each(function() {
                    if ($(this).attr('class') !== currentInputClass) {
                        $(this).val(100 - currentInputVal);
                    }
                });
            });
        });
    </script>
@endpush
