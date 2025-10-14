@extends('layouts.admin.app')

@section('title', translate('messages.add_new_provider'))

@push('css_or_js')
<link rel="stylesheet" type="text/css" href="{{asset('public/assets/admin/vendor/daterangepicker/daterangepicker.css')}}"/>
@endpush

@section('content')

<div class="content container-fluid">
    <!-- Page Title -->
    <h2 class="h1 mb-sm-3 mb-2 text-capitalize d-flex align-items-center gap-2">
        {{ translate('messages.add_new_provider') }}
    </h2>
    <form action="{{ route('admin.service.provider.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <!-- Nav -->
        <div class="js-nav-scroller hs-nav-scroller-horizontal mb-20">
            <ul class="nav nav-tabs align-items-start border-0 gap-20px nav--tabs tabs__style-border" id="myTab"
                role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" href="#0" id="home-tab" data-toggle="tab" data-target="#home" type="button"
                        role="tab" aria-controls="home" aria-selected="true">{{ translate('messages.business_basic_setup') }}</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="#0" id="profile-tab" data-toggle="tab" data-target="#profile" type="button"
                        role="tab" aria-controls="profile" aria-selected="false">{{ translate('messages.business_plan_setup') }}</a>
                </li>
            </ul>
        </div>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">                
                <div class="card mb-20">
                    <div class="p-20 border-bottom">
                        <h4 class="mb-1">{{ translate('messages.general_info') }}</h4>
                        <p class="m-0">{{ translate('messages.vendor_logo_and_covers') }}</p>
                    </div>
                    <div class="card-body p-20">
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="d-flex flex-column gap-4">
                                    <div class="bg-light rounded p-3 py-4">
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
                                        <div class="lang_form" id="default-form">
                                            <div class="mb-20">
                                                <label class="form-label">{{ translate('name') }} ({{ translate('Default') }})</label>
                                                <input type="text" class="form-control" name="name[]"
                                                    value="{{ old('name.0') }}" placeholder="{{ translate('name') }}" maxlength="255"
                                                    data-preview-text="preview-title">
                                            </div>
                                            <div class="mb-20">
                                                <label class="form-label">{{ translate('address') }} ({{ translate('Default') }})</label>
                                                <textarea name="address[]" rows="3" class="form-control" placeholder="{{ translate('address') }}">{{ old('address.0') }}</textarea>
                                            </div>
                                            <input type="hidden" name="lang[]" value="default">
                                        </div>
                                        @foreach ($language as $key => $lang)
                                            <div class="d-none lang_form" id="{{ $lang }}-form">
                                                <div class="mb-20">
                                                <label class="form-label">{{ translate('name') }} ({{ strtoupper($lang) }})</label>
                                                <input type="text" class="form-control" name="name[]"
                                                    value="{{ old('name.'.$key) }}" placeholder="{{ translate('name') }}" maxlength="255"
                                                    data-preview-text="preview-title">
                                            </div>
                                            <div class="mb-20">
                                                <label class="form-label">{{ translate('address') }} ({{ strtoupper($lang) }})</label>
                                                <textarea name="address[]" rows="3" class="form-control" placeholder="{{ translate('address') }}">{{ old('address.'.$key) }}</textarea>
                                            </div>
                                            <input type="hidden" name="lang[]" value="{{ $lang }}">
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="form-group mb-0">
                                        <label class="input-label" for="phone">{{ translate('messages.business_phone_number') }} <span class="text-danger">*</span></label>
                                        <input type="tel" id="phone" name="phone" class="form-control"
                                        placeholder="{{ translate('messages.Ex:') }} 017********"
                                        required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="d-flex flex-column gap-3">  
                                    <div>
                                        <div class="mb-xl-3 mb-2">
                                            <h5 class="mb-1">{{ translate('messages.logo') }}</h5>
                                            <span class="fz-12px">{{ translate('messages.JPG, JPEG, PNG Less Than 1 MB') }}</span>
                                        </div>
                                        <div class="global-image-upload ratio-1 border-dashed rounded-10 bg-light position-relative max-w-100 overflow-hidden border-dashed h-130 d-center">
                                            <input type="file" accept="image/*" required style="position: absolute; width: 100%; height: 100%; opacity: 0; cursor: pointer;">                                
                                            <div class="global-upload-box">
                                                <div class="upload-content text-center">
                                                    <img src="{{asset('Modules/Service/public/assets/img/admin/do-upload.png')}}" alt="upload-your-image" class="mb-2">
                                                    <div class="d-grid align-items-center gap-1 justify-content-center">
                                                        <span class="fz-12px text-theme d-block">{{ translate('messages.click_to_upload') }}</span> <span class="fz-12px text-title d-block">{{ translate('messages.or_drag_and_drop') }}</span>
                                                    </div>
                                                </div>
                                            </div>                                
                                            <img class="global-image-preview d-none" src="" alt="Preview" style="max-height: 100%; max-width: 100%;" />
                                            <div class="overlay-icons d-none">
                                                <button type="button" class="btn btn--info p-2 action-btn view-icon" title="{{ translate('messages.view') }}" data-toggle="modal" data-target="#imageShowingMOdal">
                                                    <i class="tio-invisible"></i>
                                                </button>
                                                <button type="button" class="btn btn--info p-2 action-btn edit-icon" title="{{ translate('messages.edit') }}">
                                                    <i class="tio-edit"></i>
                                                </button>
                                            </div>
                                            <div class="image-file-name d-none mt-2 text-center text-muted" style="font-size: 12px;"></div>
                                        </div>
                                    </div>                              
                                    <div>
                                        <div class="mb-xl-3 mb-2">
                                            <h5 class="mb-1">{{ translate('messages.cover_image') }}</h5>
                                            <span class="fz-12px">{{ translate('messages.JPG, JPEG, PNG Less Than 1 MB') }} <strong>({{ translate('messages.Ratio 3:1') }})</strong></span>
                                        </div>
                                        <div class="global-image-upload ratio-3-1 border-dashed rounded-10 bg-light position-relative max-w-100 overflow-hidden border-dashed h-130 d-center">
                                            <input type="file" accept="image/*" required style="position: absolute; width: 100%; height: 100%; opacity: 0; cursor: pointer;">                                
                                            <div class="global-upload-box">
                                                <div class="upload-content text-center">
                                                    <img src="{{asset('Modules/Service/public/assets/img/admin/do-upload.png')}}" alt="upload-your-image" class="mb-2">
                                                    <div class="d-flex align-items-center gap-1 justify-content-center">
                                                        <span class="fz-12px text-theme d-block">{{ translate('messages.click_to_upload') }}</span> <span class="fz-12px text-title d-block">{{ translate('messages.or_drag_and_drop') }}</span>
                                                    </div>
                                                </div>
                                            </div>                                
                                            <img class="global-image-preview d-none" src="" alt="Preview" style="max-height: 100%; max-width: 100%;" />
                                            <div class="overlay-icons d-none">
                                                <button type="button" class="btn btn--info p-2 action-btn view-icon" title="{{ translate('messages.view') }}" data-toggle="modal" data-target="#imageShowingMOdal">
                                                    <i class="tio-invisible"></i>
                                                </button>
                                                <button type="button" class="btn btn--info p-2 action-btn edit-icon" title="{{ translate('messages.edit') }}">
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
                </div>
                <div class="card mb-20">
                    <div class="p-20 border-bottom">
                        <h4 class="mb-1">{{ translate('messages.business_info') }}</h4>
                        <p class="m-0">{{ translate('messages.vendor_logo_and_covers') }}</p>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="d-flex flex-column gap-4">
                                    <div class="form-group mb-0">
                                        <label class="input-label font-medium fz--14px"
                                            for="choice_zones">{{ translate('messages.business_zone') }}
                                            <span class="form-label-secondary" data-toggle="tooltip"
                                                data-placement="right"
                                                data-original-title="{{ translate('messages.Select the zone from where the business will be operated') }}">
                                                <i class="tio-info text--title opacity-60"></i>
                                            </span>
                                        </label>
                                        <select name="zone_id" id="choice_zones" required
                                                class="form-control js-select2-custom"  data-placeholder="{{translate('messages.select_zone')}}">
                                                <option value="" selected disabled>{{translate('messages.select_zone')}}</option>
                                                @foreach($zones as $zone)
                                                    <option value="{{$zone->id}}">{{$zone->name}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                    <div class="position-relative">
                                        <label class="input-label font-medium fz--14px" for="tax">{{ translate('messages.approx_service_time') }}</label>
                                        <div class="custom-group-btn flex-sm-nowrap flex-wrap">
                                            <div class="item flex-sm-grow-1">
                                                <label class="floating-label" for="min">{{ translate('messages.min') }}:</label>
                                                <input id="min" type="number" name="minimum_delivery_time" value="" class="form-control h--45px border-0" placeholder="Ex : 20" pattern="^[0-9]{2}$" required="">
                                            </div>
                                            <div class="separator d-sm-flex d-none"></div>
                                            <div class="item flex-sm-grow-1">
                                                <label class="floating-label" for="max">{{ translate('messages.max') }}:</label>
                                                <input id="max" type="number" name="maximum_delivery_time" value="" class="form-control h--45px border-0" placeholder="Ex : 30" pattern="[0-9]{2}$" required="">
                                            </div>
                                            <div class="separator d-sm-flex d-none"></div>
                                            <div class="item flex-shrink-0">
                                                <select name="delivery_time_type" id="delivery_time_type" class="custom-select border-0">
                                                    <option value="min">
                                                        {{ translate('messages.minutes') }}
                                                    </option>
                                                    <option value="hours">
                                                        {{ translate('messages.hours') }}
                                                    </option>
                                                    <option value="days">
                                                        {{ translate('messages.days') }}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                               <div id="map"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-20">
                    <div class="p-20 border-bottom">
                        <h4 class="mb-1">{{ translate('messages.owner_information') }}</h4>
                        <p class="m-0">{{ translate('messages.vendor_logo_and_covers') }}</p>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-lg-4 col-sm-6">
                                <div class="form-group mb-0">
                                    <label class="input-label" for="f_name">{{ translate('messages.first_name') }}</label>
                                    <input type="text" name="f_name" class="form-control" id="f_name" placeholder="{{ translate('messages.first_name') }}" value="" required="">
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="form-group mb-0">
                                    <label class="input-label" for="l_name">{{ translate('messages.last_name') }}</label>
                                    <input type="text" name="l_name" class="form-control" id="l_name" placeholder="{{ translate('messages.last_name') }}" value="" required="">
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="form-group mb-0">
                                    <label class="input-label"
                                        for="phone">{{ translate('messages.Business Phone Number') }} <span class="text-danger">*</span></label>
                                    <input type="tel" id="phone" name="business_phone" class="form-control"
                                        placeholder="{{ translate('messages.Ex:') }} 017********" value="{{old('phone')}}"
                                        required>
                                </div>
                            </div>
                        </div>     
                    </div>
                </div>
                <div class="card mb-20">
                    <div class="p-20 border-bottom">
                        <h4 class="mb-1">{{ translate('messages.account_information') }}</h4>
                        <p class="m-0">{{ translate('messages.vendor_logo_and_covers') }}</p>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-sm-6 col-lg-4">
                                <div class="form-group mb-0">
                                    <label for="emails" class="form-label font-normal fz--14px">
                                        {{ translate('messages.emails') }}
                                    </label>
                                    <input type="text" class="form-control h--45px" name="email" id="emails" placeholder="{{ translate('messages.type_emails') }}">
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <div class="form-group mb-0">
                                    <label for="password" class="form-label font-normal fz--14px">
                                        {{ translate('messages.password') }}
                                    </label>
                                    <div class="d-flex border rounded align-items-center bg-white justify-content-between" style="padding-inline-end: 16px;">
                                        <input type="password" name="password" id="password" placeholder="{{ translate('messages.password') }}" class="w-100 form-control border-0" value="">
                                        <i class="toggle-password tio-hidden-outlined"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <div class="form-group mb-0">
                                    <label for="Confirmpassword" class="form-label font-normal fz--14px">
                                        {{ translate('messages.confirm_password') }}
                                    </label>
                                    <div class="d-flex border rounded align-items-center bg-white justify-content-between" style="padding-inline-end: 16px;">
                                        <input type="password" name="password_confirmation" id="Confirmpassword" placeholder="{{ translate('messages.password') }}" class="w-100 form-control border-0" value="">
                                        <i class="toggle-password tio-hidden-outlined"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-20">
                    <div class="p-20 border-bottom">
                        <h4 class="mb-1">{{ translate('messages.identity_information') }}</h4>
                        <p class="m-0">{{ translate('messages.vendor_logo_and_covers') }}</p>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label for="identity_type" class="form-label font-normal fz--14px">
                                    {{ translate('messages.identity_type') }}
                                </label>
                                <select name="identity"  class="form-control js-select2-custom"
                                    data-placeholder="{{ translate('messages.select_zone') }}">
                                    <option selected disabled>{{translate('Select_Identity_Type')}}</option>
                                    <option value="passport"
                                        {{old('identity_type') == 'passport' ? 'selected': ''}}>
                                        {{translate('Passport')}}</option>
                                    <option value="driving_license"
                                        {{old('identity_type') == 'driving_license' ? 'selected': ''}}>
                                        {{translate('Driving_License')}}</option>
                                    <option value="nid"
                                        {{old('identity_type') == 'passport' ? 'selected': ''}}>
                                        {{translate('nid')}}</option>
                                    <option value="trade_license"
                                        {{old('identity_type') == 'nid' ? 'selected': ''}}>
                                        {{translate('Trade_License')}}</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-0">
                                    <label for="names" class="form-label font-normal fz--14px">
                                        {{ translate('messages.taxpayer_identification_number_tin') }} <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control h--45px" name="identification_number" id="names" placeholder="{{ translate('messages.type_your_user_name') }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div>
                                    <div class="mb-xl-3 mb-2">
                                        <h5 class="mb-1">{{ translate('messages.identity_documents') }}</h5>
                                        <span class="fz-12px">{{ translate('messages.pdf_doc_jpg_file_size_max_2_mb') }}</span>
                                    </div>
                                    <div id="coba" class="row"></div>
                                </div>
                                      
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="card mb-20">
                    <div class="p-20 border-bottom">
                        <h4 class="mb-1">{{ translate('messages.choose_business_plan') }}</h4>
                        <p class="m-0">{{ translate('messages.vendor_logo_and_covers') }}</p>
                    </div>
                    <div class="card-body p-20">
                        <ul class="nav nav-tabs flex-sm-nowrap flex-wrap subscription-tabs pb-4 align-items-start border-0 gap-20px" id="myTab"
                            role="tablist">
                            <li class="nav-item w-100" role="presentation">
                                <a class="nav-link bg-white w-100 border rounded-8 p-20 active" href="#0" id="commussion-tab" data-toggle="tab" data-target="#commussion" type="button"
                                    role="tab" aria-controls="commussion" aria-selected="true">
                                    <div class="d-flex mb-2 align-items-center justify-content-between gap-1">
                                        <h4 class="mb-0">{{ translate('messages.commission_base') }}</h4>
                                        <i class="tio-checkmark-circle d--none"></i>
                                    </div>
                                    <p class="fz--14px font-400 mb-0 max-w-487" data-text-color="#334257B2">
                                        {{ translate('messages.you_have_to_give_a_certain_percentage_of_commission_to_admin_for_every_trip_request') }}
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item w-100" role="presentation">
                                <a class="nav-link bg-white w-100 border rounded-8 p-20" href="#0" id="subscribtion-tab" data-toggle="tab" data-target="#subscribption" type="button"
                                    role="tab" aria-controls="subscribption" aria-selected="false">
                                    <div class="d-flex mb-2 align-items-center justify-content-between gap-1">
                                        <h4 class="mb-0">{{ translate('messages.subscription_base') }}</h4>
                                        <i class="tio-checkmark-circle d--none"></i>
                                    </div>
                                    <p class="fz--14px font-400 mb-0 max-w-487" data-text-color="#334257B2">
                                        {{ translate('messages.you_have_to_pay_certain_amount_in_every_month_year_to_admin_as_subscription_fee') }}
                                    </p>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="commussion" role="tabpanel" aria-labelledby="commussion-tab">
                                {{-- <h4 class="text-center mb-20">{{ translate('messages.choose_subscription_package') }}</h4>
                                <div class="steps-integration-wrap position-relative z-index-2">
                                    <div class="step-integration-inner justify-content-lg-center d-flex     scrollbar-w-0 nav flex-nowrap overflow-x-auto text-nowrap white-nowrap gap-20px">
                                            <div class="pricing-box-items bg-white rounded-8 min-w-200 max-w-200px position-relative z-index-2">
                                                <img src="{{asset('/public/assets/admin/img/pricing-element2.png')}}" alt="" class="position-absolute top-0 end-cus-0 zn-1">
                                                <div class="text-center mb-4">
                                                    <h5 class="mb-2 text-uppercase text--primary">{{ translate('messages.basic') }}</h5>
                                                    <div>
                                                        <h2 class="mb-0 fz-30px text--primary">$20</h2>
                                                        <span class="fs-10 d-block border-bottom pb-2" data-text-color="#93A2AE">
                                                            60 {{ translate('messages.days') }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <ul class="most-popular d-flex flex-column gap-2">
                                                    <li class="m-0 d-flex justify-content-start align-items-center gap-2 fs-10">
                                                        <i class="tio-checkmark-circle fs-12" data-text-color="#039D55"></i> {{ translate('messages.free_support_24_7') }}
                                                    </li>
                                                    <li class="m-0 border-bottom"></li>
                                                    <li class="m-0 d-flex justify-content-start align-items-center gap-2 fs-10">
                                                        <i class="tio-checkmark-circle fs-12" data-text-color="#039D55"></i> {{ translate('messages.databases') }}
                                                    </li>
                                                    <li class="m-0 border-bottom"></li>
                                                    <li class="m-0 d-flex justify-content-start align-items-center gap-2 fs-10">
                                                        <i class="tio-checkmark-circle fs-12" data-text-color="#039D55"></i> 200 {{ translate('messages.monthly_trip') }}
                                                    </li>
                                                    <li class="m-0 border-bottom"></li>
                                                    <li class="m-0 d-flex justify-content-start align-items-center gap-2 fs-10">
                                                        <i class="tio-checkmark-circle fs-12" data-text-color="#039D55"></i> 5 {{ translate('messages.vehicle_add') }}
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="pricing-box-items pricing-standard bg-primary rounded-8 min-w-200 max-w-200px position-relative z-index-2 overflow-hidden">
                                                <img src="{{asset('/public/assets/admin/img/pricing-element.png')}}" alt="" class="position-absolute top-0 end-cus-0 zn-1">
                                                <div class="text-center mb-4">
                                                    <h5 class="mb-2 text-uppercase text-white">{{ translate('messages.standared') }}</h5>
                                                    <div>
                                                        <h2 class="mb-0 fz-30px text-white">$30</h2>
                                                        <span class="fs-10 d-block border-bottom pb-2" data-text-color="#FFFFFFCC">
                                                            120 {{ translate('messages.days') }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <ul class="most-popular d-flex flex-column gap-2">
                                                    <li class="m-0 d-flex justify-content-start align-items-center gap-2 fs-10">
                                                        <i class="tio-checkmark-circle text-white fs-12" data-text-color="#039D55"></i> {{ translate('messages.free_support_24_7') }}
                                                    </li>
                                                    <li class="m-0 border-bottom"></li>
                                                    <li class="m-0 d-flex justify-content-start align-items-center gap-2 fs-10">
                                                        <i class="tio-checkmark-circle text-white fs-12" data-text-color="#039D55"></i> {{ translate('messages.databases') }}
                                                    </li>
                                                    <li class="m-0 border-bottom"></li>
                                                    <li class="m-0 d-flex justify-content-start align-items-center gap-2 fs-10">
                                                        <i class="tio-checkmark-circle text-white fs-12" data-text-color="#039D55"></i> 1000 {{ translate('messages.monthly_trip') }}
                                                    </li>
                                                    <li class="m-0 border-bottom"></li>
                                                    <li class="m-0 d-flex justify-content-start align-items-center gap-2 fs-10">
                                                        <i class="tio-checkmark-circle text-white fs-12" data-text-color="#039D55"></i> 15 {{ translate('messages.vehicle_add') }}
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="pricing-box-items bg-white rounded-8 min-w-200 max-w-200px position-relative z-index-2">
                                                <img src="{{asset('/public/assets/admin/img/pricing-element2.png')}}" alt="" class="position-absolute top-0 end-cus-0 zn-1">
                                                <div class="text-center mb-4">
                                                    <h5 class="mb-2 text-uppercase text--primary">{{ translate('messages.premium') }}</h5>
                                                    <div>
                                                        <h2 class="mb-0 fz-30px text--primary">$50</h2>
                                                        <span class="fs-10 d-block border-bottom pb-2" data-text-color="#93A2AE">
                                                            365 {{ translate('messages.days') }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <ul class="most-popular d-flex flex-column gap-2">
                                                    <li class="m-0 d-flex justify-content-start align-items-center gap-2 fs-10">
                                                        <i class="tio-checkmark-circle fs-12" data-text-color="#039D55"></i> {{ translate('messages.free_support_24_7') }}
                                                    </li>
                                                    <li class="m-0 border-bottom"></li>
                                                    <li class="m-0 d-flex justify-content-start align-items-center gap-2 fs-10">
                                                        <i class="tio-checkmark-circle fs-12" data-text-color="#039D55"></i> {{ translate('messages.databases') }}
                                                    </li>
                                                    <li class="m-0 border-bottom"></li>
                                                    <li class="m-0 d-flex justify-content-start align-items-center gap-2 fs-10">
                                                        <i class="tio-checkmark-circle fs-12" data-text-color="#039D55"></i> {{ translate('messages.unlimited_trip') }}
                                                    </li>
                                                    <li class="m-0 border-bottom"></li>
                                                    <li class="m-0 d-flex justify-content-start align-items-center gap-2 fs-10">
                                                        <i class="tio-checkmark-circle fs-12" data-text-color="#039D55"></i> {{ translate('messages.unlimited_vehicle_add') }}
                                                    </li>
                                                </ul>
                                            </div>
                                    </div>
                                     <div class="slide-cus__prev position-absolute z-2 top-50">
                                        <button class="border-0 shadow-md w-35px h-35px d-flex align-items-center justify-content-center p-0 bg-step rounded-circle text-white">
                                            <i class="tio-arrow-long-left fz-18 text-title"></i>
                                        </button>
                                    </div>
                                    <div class="slide-cus__next position-absolute z-2 top-50">
                                        <button class="border-0 shadow-md w-35px h-35px d-flex align-items-center justify-content-center p-0 bg-step rounded-circle text-white">
                                            <i class="tio-arrow-long-right fz-18 text-title"></i>
                                        </button>
                                    </div>
                                </div> --}}
                            </div>  
                            <div class="tab-pane fade" id="subscribption" role="tabpanel" aria-labelledby="subscribtion-tab">
                                <h4 class="text-center mb-20">{{ translate('messages.choose_subscription_package') }}</h4>
                                <div class="steps-integration-wrap position-relative z-index-2">
                                    <div class="step-integration-inner justify-content-lg-center d-flex     scrollbar-w-0 nav flex-nowrap overflow-x-auto text-nowrap white-nowrap gap-20px">
                                            <div class="pricing-box-items bg-white rounded-8 min-w-200 max-w-200px position-relative z-index-2">
                                                <img src="{{asset('/public/assets/admin/img/pricing-element2.png')}}" alt="" class="position-absolute top-0 end-cus-0 zn-1">
                                                <div class="text-center mb-4">
                                                    <h5 class="mb-2 text-uppercase text--primary">{{ translate('messages.basic') }}</h5>
                                                    <div>
                                                        <h2 class="mb-0 fz-30px text--primary">$20</h2>
                                                        <span class="fs-10 d-block border-bottom pb-2" data-text-color="#93A2AE">
                                                            60 {{ translate('messages.days') }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <ul class="most-popular d-flex flex-column gap-2">
                                                    <li class="m-0 d-flex justify-content-start align-items-center gap-2 fs-10">
                                                        <i class="tio-checkmark-circle fs-12" data-text-color="#039D55"></i> {{ translate('messages.free_support_24_7') }}
                                                    </li>
                                                    <li class="m-0 border-bottom"></li>
                                                    <li class="m-0 d-flex justify-content-start align-items-center gap-2 fs-10">
                                                        <i class="tio-checkmark-circle fs-12" data-text-color="#039D55"></i> {{ translate('messages.databases') }}
                                                    </li>
                                                    <li class="m-0 border-bottom"></li>
                                                    <li class="m-0 d-flex justify-content-start align-items-center gap-2 fs-10">
                                                        <i class="tio-checkmark-circle fs-12" data-text-color="#039D55"></i> 200 {{ translate('messages.monthly_trip') }}
                                                    </li>
                                                    <li class="m-0 border-bottom"></li>
                                                    <li class="m-0 d-flex justify-content-start align-items-center gap-2 fs-10">
                                                        <i class="tio-checkmark-circle fs-12" data-text-color="#039D55"></i> 5 {{ translate('messages.vehicle_add') }}
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="pricing-box-items pricing-standard bg-primary rounded-8 min-w-200 max-w-200px position-relative z-index-2 overflow-hidden">
                                                <img src="{{asset('/public/assets/admin/img/pricing-element.png')}}" alt="" class="position-absolute top-0 end-cus-0 zn-1">
                                                <div class="text-center mb-4">
                                                    <h5 class="mb-2 text-uppercase text-white">{{ translate('messages.standared') }}</h5>
                                                    <div>
                                                        <h2 class="mb-0 fz-30px text-white">$30</h2>
                                                        <span class="fs-10 d-block border-bottom pb-2" data-text-color="#FFFFFFCC">
                                                            120 {{ translate('messages.days') }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <ul class="most-popular d-flex flex-column gap-2">
                                                    <li class="m-0 d-flex justify-content-start align-items-center gap-2 fs-10">
                                                        <i class="tio-checkmark-circle text-white fs-12" data-text-color="#039D55"></i> {{ translate('messages.free_support_24_7') }}
                                                    </li>
                                                    <li class="m-0 border-bottom"></li>
                                                    <li class="m-0 d-flex justify-content-start align-items-center gap-2 fs-10">
                                                        <i class="tio-checkmark-circle text-white fs-12" data-text-color="#039D55"></i> {{ translate('messages.databases') }}
                                                    </li>
                                                    <li class="m-0 border-bottom"></li>
                                                    <li class="m-0 d-flex justify-content-start align-items-center gap-2 fs-10">
                                                        <i class="tio-checkmark-circle text-white fs-12" data-text-color="#039D55"></i> 1000 {{ translate('messages.monthly_trip') }}
                                                    </li>
                                                    <li class="m-0 border-bottom"></li>
                                                    <li class="m-0 d-flex justify-content-start align-items-center gap-2 fs-10">
                                                        <i class="tio-checkmark-circle text-white fs-12" data-text-color="#039D55"></i> 15 {{ translate('messages.vehicle_add') }}
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="pricing-box-items bg-white rounded-8 min-w-200 max-w-200px position-relative z-index-2">
                                                <img src="{{asset('/public/assets/admin/img/pricing-element2.png')}}" alt="" class="position-absolute top-0 end-cus-0 zn-1">
                                                <div class="text-center mb-4">
                                                    <h5 class="mb-2 text-uppercase text--primary">{{ translate('messages.premium') }}</h5>
                                                    <div>
                                                        <h2 class="mb-0 fz-30px text--primary">$50</h2>
                                                        <span class="fs-10 d-block border-bottom pb-2" data-text-color="#93A2AE">
                                                            365 {{ translate('messages.days') }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <ul class="most-popular d-flex flex-column gap-2">
                                                    <li class="m-0 d-flex justify-content-start align-items-center gap-2 fs-10">
                                                        <i class="tio-checkmark-circle fs-12" data-text-color="#039D55"></i> {{ translate('messages.free_support_24_7') }}
                                                    </li>
                                                    <li class="m-0 border-bottom"></li>
                                                    <li class="m-0 d-flex justify-content-start align-items-center gap-2 fs-10">
                                                        <i class="tio-checkmark-circle fs-12" data-text-color="#039D55"></i> {{ translate('messages.databases') }}
                                                    </li>
                                                    <li class="m-0 border-bottom"></li>
                                                    <li class="m-0 d-flex justify-content-start align-items-center gap-2 fs-10">
                                                        <i class="tio-checkmark-circle fs-12" data-text-color="#039D55"></i> {{ translate('messages.unlimited_trip') }}
                                                    </li>
                                                    <li class="m-0 border-bottom"></li>
                                                    <li class="m-0 d-flex justify-content-start align-items-center gap-2 fs-10">
                                                        <i class="tio-checkmark-circle fs-12" data-text-color="#039D55"></i> {{ translate('messages.unlimited_vehicle_add') }}
                                                    </li>
                                                </ul>
                                            </div>
                                    </div>
                                     <div class="slide-cus__prev position-absolute z-2 top-50">
                                        <button class="border-0 shadow-md w-35px h-35px d-flex align-items-center justify-content-center p-0 bg-step rounded-circle text-white">
                                            <i class="tio-arrow-long-left fz-18 text-title"></i>
                                        </button>
                                    </div>
                                    <div class="slide-cus__next position-absolute z-2 top-50">
                                        <button class="border-0 shadow-md w-35px h-35px d-flex align-items-center justify-content-center p-0 bg-step rounded-circle text-white">
                                            <i class="tio-arrow-long-right fz-18 text-title"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>              
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="btn--container justify-content-end mt-3">
            <button type="reset" class="btn min-w-120 btn--reset">{{ translate('messages.reset') }}</button>
            <button type="submit" class="btn min-w-120 btn--primary call-demo">{{ translate('messages.submit') }}</button>
        </div>
    </form>

    <!--image showing--> 
    <div class="modal fade custom-confirmation-modal" id="imageShowingMOdal" tabindex="-1" aria-labelledby="imageShowingMOdalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body py-3 px-sm-4 px-3"> 
                    <button type="button" class="btn-close image-show__close bg-light rounded-full" data-dismiss="modal" aria-label="{{ translate('messages.close') }}">
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
    <script type="text/javascript" src="{{asset('public/assets/admin/vendor/daterangepicker/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/admin/vendor/daterangepicker/daterangepicker.min.js')}}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{\App\Models\BusinessSetting::where('key', 'map_api_key')->first()->value}}&libraries=places&callback=initMap&v=3.45.8"></script>
    <script src="{{ asset('public/assets/admin/js/spartan-multi-image-picker.js') }}"></script>
    <script>
        $(".toggle-password").click(function() {
            $(this).toggleClass("tio-invisible");
            input = $(this).parent().find("input");
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    </script>
    <script>
        //Custom Slider Menu
        function checkNavOverflow() {
            try {
                $(".step-integration-inner").each(function () {
                    let $nav = $(this);
                    let $btnNext = $nav
                        .closest(".position-relative")
                        .find(".slide-cus__next");
                    let $btnPrev = $nav
                        .closest(".position-relative")
                        .find(".slide-cus__prev");
                    let isRTL = $("html").attr("dir") === "rtl";
                    let navScrollWidth = $nav[0].scrollWidth;
                    let navClientWidth = $nav[0].clientWidth;
                    let scrollLeft = Math.abs($nav.scrollLeft());

                    if (isRTL) {
                        let maxScrollLeft = navScrollWidth - navClientWidth;
                        let scrollRight = maxScrollLeft - scrollLeft;

                        $btnNext.toggle(scrollRight > 1);
                        $btnPrev.toggle(scrollLeft > 1);
                    } else {
                        $btnNext.toggle(
                            navScrollWidth > navClientWidth &&
                                scrollLeft + navClientWidth < navScrollWidth
                        );
                        $btnPrev.toggle(scrollLeft > 1);
                    }
                });
            } catch (error) {
                console.error(error);
            }
        }
        $(".step-integration-inner").each(function () {
            let $nav = $(this);
            checkNavOverflow($nav);
            $(window).on("resize", function () {
                checkNavOverflow($nav);
            });
            $nav.on("scroll", function () {
                checkNavOverflow($nav);
            });
            $nav.siblings(".slide-cus__next").on("click", function () {
                let scrollWidth = $nav.find("li").outerWidth(true);
                let isRTL = $("html").attr("dir") === "rtl";
                if (isRTL) {
                    $nav.animate(
                        { scrollLeft: $nav.scrollLeft() - scrollWidth },
                        300,
                        function () {
                            checkNavOverflow($nav);
                        }
                    );
                } else {
                    $nav.animate(
                        { scrollLeft: $nav.scrollLeft() + scrollWidth },
                        300,
                        function () {
                            checkNavOverflow($nav);
                        }
                    );
                }
            });
            $nav.siblings(".slide-cus__prev").on("click", function () {
                let scrollWidth = $nav.find("li").outerWidth(true);
                let isRTL = $("html").attr("dir") === "rtl";

                if (isRTL) {
                    $nav.animate(
                        { scrollLeft: $nav.scrollLeft() + scrollWidth },
                        300,
                        function () {
                            checkNavOverflow($nav);
                        }
                    );
                } else {
                    $nav.animate(
                        { scrollLeft: $nav.scrollLeft() - scrollWidth },
                        300,
                        function () {
                            checkNavOverflow($nav);
                        }
                    );
                }
            });
        });
    </script>

    <script>
        @php($default_location=\App\Models\BusinessSetting::where('key','default_location')->first())
        @php($default_location=$default_location->value?json_decode($default_location->value, true):0)
        let myLatlng = { lat: {{$default_location?$default_location['lat']:'23.757989'}}, lng: {{$default_location?$default_location['lng']:'90.360587'}} };
        let map = new google.maps.Map(document.getElementById("map"), {
                zoom: 13,
                center: myLatlng,
            });
        let zonePolygon = null;
        let infoWindow = new google.maps.InfoWindow({
                content: "Click the map to get Lat/Lng!",
                position: myLatlng,
            });
        let bounds = new google.maps.LatLngBounds();
        function initMap() {
            // Create the initial InfoWindow.
            // infoWindow.open(map);
             //get current location block
             infoWindow = new google.maps.InfoWindow();
            // Try HTML5 geolocation.
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                    myLatlng = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude,
                    };
                    // infoWindow.setPosition(myLatlng);
                    // infoWindow.setContent("Location found.");
                    infoWindow.open(map);
                    map.setCenter(myLatlng);
                },
                () => {
                    handleLocationError(true, infoWindow, map.getCenter());
                    }
                );
            } else {
            // Browser doesn't support Geolocation
                handleLocationError(false, infoWindow, map.getCenter());
            }
            //-----end block------
            const input = document.getElementById("pac-input");
            const searchBox = new google.maps.places.SearchBox(input);
            map.controls[google.maps.ControlPosition.TOP_CENTER].push(input);
            let markers = [];
            searchBox.addListener("places_changed", () => {
                const places = searchBox.getPlaces();

                if (places.length == 0) {
                return;
                }
                // Clear out the old markers.
                markers.forEach((marker) => {
                marker.setMap(null);
                });
                markers = [];
                // For each place, get the icon, name and location.
                const bounds = new google.maps.LatLngBounds();
                places.forEach((place) => {
                    // document.getElementById('latitude').value = place.geometry.location.lat();
                    // document.getElementById('longitude').value = place.geometry.location.lng();
                    if (!place.geometry || !place.geometry.location) {
                        console.log("Returned place contains no geometry");
                        return;
                    }
                    const icon = {
                        url: place.icon,
                        size: new google.maps.Size(71, 71),
                        origin: new google.maps.Point(0, 0),
                        anchor: new google.maps.Point(17, 34),
                        scaledSize: new google.maps.Size(25, 25),
                    };
                    // Create a marker for each place.
                    markers.push(
                        new google.maps.Marker({
                        map,
                        icon,
                        title: place.name,
                        position: place.geometry.location,
                        })
                    );

                    if (place.geometry.viewport) {
                        // Only geocodes have viewport.
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }
                });
                map.fitBounds(bounds);
            });
        }
        initMap();
        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            infoWindow.setPosition(pos);
            infoWindow.setContent(
                browserHasGeolocation
                ? "Error: The Geolocation service failed."
                : "Error: Your browser doesn't support geolocation."
            );
            infoWindow.open(map);
        }
        $('#choice_zones').on('change', function(){
            let id = $(this).val();
            $.get({
                url: '{{url('/')}}/admin/zone/get-coordinates/'+id,
                dataType: 'json',
                success: function (data) {
                    if(zonePolygon)
                    {
                        zonePolygon.setMap(null);
                    }
                    zonePolygon = new google.maps.Polygon({
                        paths: data.coordinates,
                        strokeColor: "#FF0000",
                        strokeOpacity: 0.8,
                        strokeWeight: 2,
                        fillColor: 'white',
                        fillOpacity: 0,
                    });
                    zonePolygon.setMap(map);
                    zonePolygon.getPaths().forEach(function(path) {
                        path.forEach(function(latlng) {
                            bounds.extend(latlng);
                            map.fitBounds(bounds);
                        });
                    });
                    map.setCenter(data.center);
                    // map.setZoom(12);
                    google.maps.event.addListener(zonePolygon, 'click', function (mapsMouseEvent) {
                        infoWindow.close();
                        // Create a new InfoWindow.
                        infoWindow = new google.maps.InfoWindow({
                        position: mapsMouseEvent.latLng,
                        content: JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2),
                        });
                        let coordinates = JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2);
                        coordinates = JSON.parse(coordinates);
                        // document.getElementById('latitude').value = coordinates['lat'];
                        // document.getElementById('longitude').value = coordinates['lng'];
                        infoWindow.open(map);
                    });
                },
            });
        });



        $(function() {
            $("#coba").spartanMultiImagePicker({
                fieldName: 'identity_image[]',
                maxCount: 2,
                rowHeight: '150px',
                rowWidth: '100%',
                groupClassName: 'col-6 col-md-4 spartan_item_wrapper size--md',
                maxFileSize: '',
                placeholderImage: {
                    image: '{{ asset('public/assets/admin/img/400x400/img2.jpg') }}',
                    width: '100%'
                },
                dropFileLabel: "Drop Here",
                onAddRow: function(index, file) {

                },
                onRenderedPreview: function(index) {

                },
                onRemoveRow: function(index) {

                },
                onExtensionErr: function(index, file) {
                    toastr.error(
                    '{{ translate('messages.please_only_input_png_or_jpg_type_file') }}', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                },
                onSizeErr: function(index, file) {
                    toastr.error('{{ translate('messages.file_size_too_big') }}', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }
            });
        });
    </script>
@endpush