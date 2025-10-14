@extends('layouts.admin.app')

@section('title', translate('messages.Add_Rider_Level'))

@push('css_or_js')
@endpush

@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <h1 class="page-header-title">
                <span class="page-header-icon">
                    <img src="{{ asset('public/assets/admin/img/rider-label-logo.png') }}" class="w--22" alt="">
                </span>
                <span>
                    {{ translate('messages.Add_Rider_Level') }}
                </span>
            </h1>
        </div>

        <form action="{{route('admin.users.delivery-man.level.store')}}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="card mb-4">
                <div class="card-header">
                    <div>
                        <h4 class="mb-0">{{ translate('messages.Level_info') }}</h4>
                        <p class="text--title fs-12 mb-0">
                            {{ translate('messages.the_current_level_setup_automatically_assigns_riders_the_default_level_upon_their_initial_app_login') }}
                        </p>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs mb-3 border-0">
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
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="lang_form" id="default-form">
                                <div class="form-group">
                                    <label class="input-label text-capitalize" for="">
                                        {{ translate('messages.Level_Name') }} ({{translate('messages.default')}}) <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="name[]" class="form-control" value="{{ old('name.0') }}" placeholder="{{ translate('messages.Type_Level_Name') }}" required>
                                </div>
                                <input type="hidden" name="lang[]" value="default">
                            </div>

                            @foreach ($language as $key => $lang)
                                <div class="d-none lang_form" id="{{ $lang }}-form">
                                    <div class="form-group">
                                        <label class="input-label text-capitalize" for="">
                                            {{ translate('messages.Level_Name') }} ({{ strtoupper($lang) }})
                                        </label>
                                        <input type="text" name="name[]" class="form-control" value="{{ old('name.0') }}" placeholder="{{ translate('messages.Type_Level_Name') }}">
                                    </div>
                                    <input type="hidden" name="lang[]" value="{{ $lang }}">
                                </div>
                            @endforeach

                            <div class="form-group">
                                <label class="input-label text-capitalize" for="select_level_number">
                                    {{ translate('messages.Select_Level_Number') }} <span class="text-danger">*</span>
                                </label>
                                 <select name="sequence" id="select_level_number" class="form-control js-select2-custom"
                                    data-placeholder="{{ translate('messages.Select_Level_Number') }}" required>
                                    @foreach($sequences as $key=>$sequence)
                                        @if($key == 0)
                                            <option
                                                value="{{$sequence}}"
                                                selected>{{$sequence}}</option>
                                        @else
                                            <option
                                                value="{{$sequence}}"
                                                disabled>{{$sequence}}</option>
                                        @endif

                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="h-100">
                                <div class="text-center d-flex flex-column justify-content-center align-items-center gap-20px">
                                    <div>
                                        <label class="text--title fs-16 font-semibold mb-1">
                                            {{ translate('Level_Icon') }} <span class="text-danger">*</span>
                                        </label>
                                    </div>
                                    <div class="h-100 d-flex align-items-center flex-column">
                                        <label class="text-center my-auto position-relative d-inline-block">
                                            <img class="img--176 border" id="viewer"
                                                src="{{asset('public/assets/admin/img/upload-img.png')}}"
                                                alt="image"/>
                                            <div class="icon-file-group">
                                                <div class="icon-file">
                                                    <input type="file" name="image" id="customFileEg1" class="custom-file-input read-url" required
                                                           accept=".webp, .jpg, .png, .jpeg, .gif|image/*" >
                                                        <i class="tio-edit"></i>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                    <div>
                                        <p class="fs-12">
                                            {{ translate('WEBP, JPG, PNG, JPEG, GIF Less Than 1MB') }} <strong
                                                class="font-semibold">({{ translate('Ratio 1:1') }})</strong>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <div>
                        <h4 class="mb-0">{{ translate('messages.Set a Deserving Reward and Target for Upgrading to the Next Level.') }}</h4>
                        <p class="text--title fs-12 mb-0">
                            {{ translate('messages.setting_the_stage_for_rewards_and_targets._once_a_target_is_completed_or_fulfilled,_move_on_to_the_next_one') }}
                        </p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="__bg-FAFAFA card mb-4">
                        <div class="card-header bg-transparent">
                            <div>
                                <h4 class="mb-0">{{ translate('messages.Reward_Type') }}</h4>
                                <p class="text--title fs-12 mb-0">
                                    {{ translate('messages.the_rider_will_receive_that_reward_amount_while_completing_this_level_targets') }}
                                </p>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row g-4">
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">
                                        <label class="input-label text-capitalize" for="rewardType">{{ translate('messages.Select_Reward') }} <span class="text-danger">*</span></label>
                                        <select name="reward_type" id="rewardType" class="form-control js-select2-custom"
                                            data-placeholder="{{ translate('messages.Select_Reward_Type') }}" required>
                                            <option value="" selected
                                                        disabled>{{translate('select_reward_type')}}</option>
                                            <option
                                                value="{{NO_REWARDS}}">{{translate('no_rewards')}}</option>
                                            <option value="{{WALLET}}">{{translate('wallet')}}</option>
                                            <option
                                                value="{{LOYALTY_POINTS}}">{{translate('loyalty_points')}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 d-none" id="rewardAmountDiv">
                                    <div class="form-group mb-0">
                                        <label class="input-label text-capitalize" id="" for="rewardAmount"> <span id="rewardAmountLabel">{{ translate('messages.Reward_Amount') }} ($)</span> <span class="text-danger">*</span></label>
                                        <input type="number" name="reward_amount" value="{{old('reward_amount')}}" max="999999999" id="rewardAmount" class="form-control" placeholder="{{ translate('ex') }}: 500" min=".01" step=".01">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="__bg-FAFAFA card mb-4">
                        <div class="card-header bg-transparent">
                            <div>
                                <h4 class="mb-0">{{ translate('messages.Set_Target_to_Promote_from_This_Level') }}</h4>
                                <p class="text--title fs-12 mb-0">
                                    {{ translate('messages.must_setup_at_least_on_target') }}
                                </p>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="check-toggle-item bg-white p-10px rounded-10 user-select-none mb-3">
                                <label class="custom-control custom-checkbox mr-sm-2 mb-0">
                                    <input type="checkbox" class="custom-control-input" id="minimum_ride_complete" name="minimum_ride_complete" checked
                                        value="{{old('minimum_ride_complete')}}" {{old('minimum_ride_complete')==1?'checked':''}}>
                                     <label class="custom-control-label font-semibold text-capitalize mb-0" for="minimum_ride_complete">{{translate('minimum_ride_complete')}}</label>
                                </label>
                                <div class="check-toggle-content">
                                    <div class="row g-4 mt-2">
                                        <div class="col-sm-6">
                                            <div>
                                                <label class="input-label text-capitalize" for="">{{ translate('messages.Minimum_Ride_Number') }}<span class="text-danger">*</span></label>
                                                <input type="number" name="targeted_ride" value="{{old('targeted_ride')}}"
                                                    id="min_ride_complete" min="1" step="1" max="999999999" class="form-control"
                                                    placeholder="{{ translate('messages.Minimum_Ride_Number') }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div>
                                                <label class="input-label text-capitalize" for="">{{ translate('messages.Points') }}<span class="text-danger">*</span></label>
                                                <input type="number" name="targeted_ride_point" min="1" step="1" max="999999999"
                                                    value="{{old('targeted_ride_point')}}" id="points" class="form-control"
                                                    placeholder="{{ translate('Points') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="check-toggle-item bg-white p-10px rounded-10 user-select-none mb-3">
                                <label class="custom-control custom-checkbox mr-sm-2 mb-0">
                                    <input type="checkbox" class="custom-control-input" id="minimum_earn_amount" name="minimum_earn_amount"
                                        value="{{old('minimum_earn_amount')}}" {{old('minimum_earn_amount')==1?'checked':''}}>
                                     <label class="custom-control-label font-semibold text-capitalize mb-0" for="minimum_earn_amount">{{translate('minimum_earning_amount')}}</label>
                                </label>
                                <div class="check-toggle-content">
                                    <div class="row g-4 mt-2">
                                        <div class="col-sm-6">
                                            <label class="input-label text-capitalize" for="">{{ translate('messages.Minimum Earning Amount') }} <span class="text-danger">*</span></label>
                                            <input type="number" step=".01" min=".01" name="targeted_amount" max="999999999"
                                                value="{{old('targeted_amount')}}" id="min_earn_amount" class="form-control"
                                                placeholder="{{ translate('Minimum Earning Amount') }}">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="input-label text-capitalize" for="">{{ translate('messages.Points') }} <span class="text-danger">*</span></label>
                                            <input type="number" name="targeted_amount_point" min="1" step="1" max="999999999"
                                                value="{{old('targeted_amount_point')}}" id="points2" class="form-control"
                                                placeholder="{{ translate('Points') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="check-toggle-item bg-white p-10px rounded-10 user-select-none mb-3">
                                <label class="custom-control custom-checkbox mr-sm-2 mb-0">
                                    <input type="checkbox" class="custom-control-input" id="maximum_cancellation_rate" name="maximum_cancellation_rate"
                                        value="{{old('maximum_cancellation_rate')}}"
                                        {{old('maximum_cancellation_rate')==1?'checked':''}}>
                                     <label class="custom-control-label font-semibold text-capitalize mb-0" for="maximum_cancellation_rate">{{translate('maximum_cancellation_rate')}}</label>
                                </label>
                                <div class="check-toggle-content">
                                    <div class="row g-4 mt-2">
                                        <div class="col-sm-6">
                                            <label class="input-label text-capitalize" for="">{{ translate('messages.maximum_cancellation_rate') }} <span class="text-danger">*</span></label>
                                            <input type="number" name="targeted_cancel" value="{{old('targeted_cancel')}}"
                                                id="max_cancellation_rate" min="1" max="100" step="1" class="form-control"
                                                placeholder="{{ translate('maximum_cancellation_rate') }}">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="input-label text-capitalize" for="">{{ translate('messages.Points') }} <span class="text-danger">*</span></label>
                                            <input type="number" name="targeted_cancel_point"
                                                value="{{old('targeted_cancel_point')}}" id="points3" class="form-control" min="1"
                                                step="1" placeholder="{{ translate('Points') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="check-toggle-item bg-white p-10px rounded-10 user-select-none">
                                <label class="custom-control custom-checkbox mr-sm-2 mb-0">
                                    <input type="checkbox" class="custom-control-input" id="minimum_review_given" name="minimum_review_given"
                                        value="{{old('minimum_review_given')}}" {{old('minimum_review_given')==1?'checked':''}}>
                                     <label class="custom-control-label font-semibold text-capitalize mb-0" for="minimum_review_given">{{translate('minimum_review_given')}}</label>
                                </label>
                                <div class="check-toggle-content">
                                    <div class="row g-4 mt-2">
                                        <div class="col-sm-6">
                                            <label class="input-label text-capitalize" for="">{{ translate('messages.minimum_review_given') }} <span class="text-danger">*</span></label>
                                            <input type="number" min="1" step="1" name="targeted_review" max="999999999"
                                                value="{{old('targeted_review')}}" id="min_give_review" class="form-control"
                                                placeholder="{{ translate('minimum_review_given') }}">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="input-label text-capitalize" for="">{{ translate('messages.Points') }} <span class="text-danger">*</span></label>
                                            <input type="number" name="targeted_review_point" min="1" step="1" max="999999999"
                                                value="{{old('targeted_review_point')}}" id="points4" class="form-control"
                                                placeholder="{{translate('Points')}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <div class="btn--container justify-content-end">
                    <button type="reset" id="reset_btn" class="btn btn--reset min-w-120px">{{ translate('messages.reset') }}</button>
                    <button type="submit" class="btn btn--primary min-w-120px">{{ translate('messages.submit') }}</button>
                </div>
            </div>

        </form>

    </div>
@endsection

@push('script_2')
    <script>
        $(document).ready(function () {
            $('.check-toggle-item .custom-checkbox input').each(function () {
                if ($(this).is(':checked')) {
                    $(this).val(1);
                    $(this).closest('.check-toggle-item').find('.check-toggle-content').show();
                    $(this).closest('.check-toggle-item').find('.check-toggle-content').find('input[type="number"]').attr('required', 'required');
                } else {
                    $(this).val(0);
                    $(this).closest('.check-toggle-item').find('.check-toggle-content').hide();
                    $(this).closest('.check-toggle-item').find('.check-toggle-content').find('input[type="number"]').removeAttr('required');
                    $(this).closest('.check-toggle-item').find('.check-toggle-content').find('input[type="number"]').removeAttr('step');
                    $(this).closest('.check-toggle-item').find('.check-toggle-content').find('input[type="number"]').removeAttr('min');
                    $(this).closest('.check-toggle-item').find('.check-toggle-content').find('input[type="number"]').val(null);
                }
            });
            $('.check-toggle-item .custom-checkbox input').on('change', function () {
                if ($(this).is(':checked')) {
                    $(this).val(1);
                    $(this).closest('.check-toggle-item').find('.check-toggle-content').show();
                    $(this).closest('.check-toggle-item').find('.check-toggle-content').find('input[type="number"]').attr('required', 'required');
                    $(this).closest('.check-toggle-item').find('.check-toggle-content').find('input[type="number"]').val();
                } else {
                    $(this).val(0);
                    $(this).closest('.check-toggle-item').find('.check-toggle-content').hide();
                    $(this).closest('.check-toggle-item').find('.check-toggle-content').find('input[type="number"]').removeAttr('required');
                    $(this).closest('.check-toggle-item').find('.check-toggle-content').find('input[type="number"]').removeAttr('step');
                    $(this).closest('.check-toggle-item').find('.check-toggle-content').find('input[type="number"]').removeAttr('min');
                    $(this).closest('.check-toggle-item').find('.check-toggle-content').find('input[type="number"]').val(null);
                }
            });

            if ($('#rewardType').val() === 'no_rewards') {
                $('#rewardAmountDiv').addClass('d-none')
                hideReward()
            }
            $("#rewardType").on('change', function () {
                hideReward(this)
            })

            function hideReward() {
                let value = $('#rewardType').find(":selected").val()
                if (value !== 'no_rewards') {
                    if (value == 'wallet') {
                        $('#rewardAmountLabel').text('{{ translate('reward_amount') }} ({{session()->get('currency_symbol') ?? '$'}})')
                        $('#rewardAmount').removeAttr('step');
                        $('#rewardAmount').attr('step', '.01');
                        $('#rewardAmount').attr('min', '.01');
                    } else {
                        $('#rewardAmountLabel').text('{{ translate('reward_points') }}')
                        $('#rewardAmount').removeAttr('step');
                        $('#rewardAmount').attr('step', '1');
                        $('#rewardAmount').attr('min', '1');
                    }
                    $('#rewardAmountDiv').removeClass('d-none')
                    $('#rewardAmount').attr('required', 'required');

                } else {
                    $('#rewardAmountDiv').addClass('d-none')
                    $('#rewardAmount').removeAttr('step');
                    $('#rewardAmount').removeAttr('required');
                }
            }

            $("#customFileEg1").change(function() {
                readURL(this);
                $('#viewer').show(1000)
            });
            $('#reset_btn').click(function(){
                $('#exampleFormControlSelect1').val(null).trigger('change');
                    $('#viewer').attr('src', "{{asset('public/assets/admin/img/upload-img.png')}}");
            })
        });

    </script>
@endpush
