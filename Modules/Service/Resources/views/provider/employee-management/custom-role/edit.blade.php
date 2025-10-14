@extends('service::provider.layouts.app')
@section('title','Edit Role')
@push('css_or_js')

@endpush

@section('content')
<div class="content container-fluid">

    <!-- Page Heading -->
    <div class="page-header">
        <h1 class="page-header-title">
            <span class="page-header-icon">
                <img src="{{asset('public/assets/admin/img/edit.png')}}" class="w--26" alt="">
            </span>
            <span>
                {{translate('messages.edit_role')}}
            </span>
        </h1>
    </div>
    <!-- Page Heading -->

    <!-- Content Row -->
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">
                <span class="card-header-icon">
                    <i class="tio-document-text-outlined"></i>
                </span>
                <span>{{translate('messages.role_form')}}</span>
            </h5>
        </div>
        <div class="card-body">
            <form action="" method="post">
                @csrf
                @php($language=\App\Models\BusinessSetting::where('key','language')->first())
                @php($language = $language->value ?? null)
                @php($defaultLang = str_replace('_', '-', app()->getLocale()))
                @if($language)
                    <ul class="nav nav-tabs mb-4">
                        <li class="nav-item">
                            <a class="nav-link lang_link active"
                            href="#"
                            id="default-link">{{translate('messages.default')}}</a>
                        </li>
                        @foreach (json_decode($language) as $lang)
                            <li class="nav-item">
                                <a class="nav-link lang_link"
                                    href="#"
                                    id="{{ $lang }}-link">{{ \App\CentralLogics\Helpers::get_language_name($lang) . '(' . strtoupper($lang) . ')' }}</a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="lang_form" id="default-form">
                        <div class="form-group">
                            <label class="input-label" for="default_title">{{translate('messages.role_name')}} ({{translate('messages.default')}})</label>
                            <input type="text" name="name[]" id="default_title" class="form-control" placeholder="{{translate('role_name_example')}}" value="{{$role?->getRawOriginal('name')}}"  >
                        </div>
                        <input type="hidden" name="lang[]" value="default">
                    </div>
                    @foreach(json_decode($language) as $lang)
                        <?php
                            if(count($role['translations'])){
                                $translate = [];
                                foreach($role['translations'] as $t)
                                {
                                    if($t->locale == $lang && $t->key=="name"){
                                        $translate[$lang]['name'] = $t->value;
                                    }
                                }
                            }
                        ?>
                        <div class="d-none lang_form" id="{{$lang}}-form">
                            <div class="form-group">
                                <label class="input-label" for="{{$lang}}_title">{{translate('messages.role_name')}} ({{strtoupper($lang)}})</label>
                                <input type="text" name="name[]" id="{{$lang}}_title" class="form-control" placeholder="{{translate('role_name_example')}}" value="{{$translate[$lang]['name']??''}}"  >
                            </div>
                            <input type="hidden" name="lang[]" value="{{$lang}}">
                        </div>
                    @endforeach
                @else
                <div id="default-form">
                    <div class="form-group">
                        <label class="input-label" for="name">{{translate('messages.role_name')}} ({{ translate('messages.default') }})</label>
                        <input type="text" id="name" name="name[]" class="form-control" placeholder="{{translate('role_name_example')}}" value="{{$role['name']}}" maxlength="100" required>
                    </div>
                    <input type="hidden" name="lang[]" value="default">
                </div>
                @endif

                <h5>{{translate('messages.module_permission')}} : </h5>
                <hr>
                <div class="check--item-wrapper mx-0">
                    <div class="check-item">
                        <div class="form-group form-check form--check">
                            <input type="checkbox" name="modules[]" value="booking" class="form-check-input"
                                    id="booking" {{in_array('booking',(array)json_decode($role['modules']))?'checked':''}}>
                            <label class="form-check-label " for="booking">{{translate('messages.booking')}}</label>
                        </div>
                    </div>
                    <div class="check-item">
                        <div class="form-group form-check form--check">
                            <input type="checkbox" name="modules[]" value="help_support" class="form-check-input"
                                   id="help_support" {{in_array('help_support',(array)json_decode($role['modules']))?'checked':''}}>
                            <label class="form-check-label input-label " for="help_support">{{translate('messages.help_&_support')}}</label>
                        </div>
                    </div>
                    <div class="check-item">
                        <div class="form-group form-check form--check">
                            <input type="checkbox" name="modules[]" value="promotion" class="form-check-input" id="promotion"
                                {{in_array('promotion',(array)json_decode($role['modules']))?'checked':''}}>
                            <label class="form-check-label input-label " for="promotion">{{translate('messages.promotion')}}</label>
                        </div>
                    </div>
                    <div class="check-item">
                        <div class="form-group form-check form--check">
                            <input type="checkbox" name="modules[]" value="service" class="form-check-input"
                                   id="service" {{in_array('service',(array)json_decode($role['modules']))?'checked':''}}>
                            <label class="form-check-label input-label " for="service">{{translate('messages.service')}}</label>
                        </div>
                    </div>
                    <div class="check-item">
                        <div class="form-group form-check form--check">
                            <input type="checkbox" name="modules[]" value="user" class="form-check-input"
                                   id="user" {{in_array('user',(array)json_decode($role['modules']))?'checked':''}}>
                            <label class="form-check-label input-label " for="user">{{translate('messages.user')}}</label>
                        </div>
                    </div>
                    <div class="check-item">
                        <div class="form-group form-check form--check">
                            <input type="checkbox" name="modules[]" value="report_analytics" class="form-check-input"
                                   id="report_analytics" {{in_array('report_analytics',(array)json_decode($role['modules']))?'checked':''}}>
                            <label class="form-check-label input-label " for="report_analytics">{{translate('messages.report_&_analytics')}}</label>
                        </div>
                    </div>
                    <div class="check-item">
                        <div class="form-group form-check form--check">
                            <input type="checkbox" name="modules[]" value="business" class="form-check-input"
                                   id="business" {{in_array('business',(array)json_decode($role['modules']))?'checked':''}}>
                            <label class="form-check-label input-label " for="business">{{translate('messages.business')}}</label>
                        </div>
                    </div>
                    <div class="check-item">
                        <div class="form-group form-check form--check">
                            <input type="checkbox" name="modules[]" value="employee" class="form-check-input"
                                   id="employee" {{in_array('employee',(array)json_decode($role['modules']))?'checked':''}}>
                            <label class="form-check-label input-label " for="employee">{{translate('messages.Employees')}}</label>
                        </div>
                    </div>
                </div>
                <div class="btn--container justify-content-end mt-4">
                    <button type="reset" class="btn btn--reset">{{translate('messages.reset')}}</button>
                    <button type="submit" class="btn btn--primary">{{translate('messages.update')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

