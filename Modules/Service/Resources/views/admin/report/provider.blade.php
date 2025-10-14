@extends('layouts.admin.app')

@section('title', translate('Provider_Report'))

@push('css_or_js')

@endpush

@section('content')
    <div class="main-content content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-wrap mb-3">
                        <h2 class="page-title">{{translate('Provider_Reports')}}</h2>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3 fs-16 text-dark">{{translate('Search_Data')}}</div>

                            <form action="{{url()->current()}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-4 col-sm-6 mb-20 search-data__field">
                                        <label class="mb-2 fs-14 text-dark">{{translate('zone')}}</label>
                                        <select class="js-select2-custom js-select2-counting zone-select" name="zone_ids[]" id="zone_selector__select"  multiple>
                                            <option value="all">{{translate('Select All')}}</option>
                                            @foreach($zones as $zone)
                                                <option
                                                    value="{{$zone['id']}}" {{array_key_exists('zone_ids', $queryParams) && in_array($zone['id'], $queryParams['zone_ids']) ? 'selected' : '' }}>{{$zone['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-sm-6 mb-20 search-data__field">
                                        <label class="mb-2 fs-14 text-dark">{{translate('provider')}}</label>
                                        <select class="js-select2-custom js-select2-counting provider-select" name="provider_ids[]" id="provider_selector__select"  multiple>
                                            <option value="all">{{translate('Select All')}}</option>
                                            @foreach($providers as $provider)
                                                <option
                                                    value="{{$provider['id']}}" {{array_key_exists('provider_ids', $queryParams) && in_array($provider['id'], $queryParams['provider_ids']) ? 'selected' : '' }}>{{$provider['company_name']}}
                                                    ({{$provider['company_phone']}})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-sm-6 mb-20 search-data__field">
                                        <label class="mb-2 fs-14 text-dark">{{translate('sub_category')}}
                                            <i class="tio-info fs-14 text-muted" data-toggle="tooltip"
                                        data-title="{{translate('Content Need')}}"></i>
                                        </label>
                                        <select class="js-select2-custom js-select2-counting sub-category-select" name="sub_category_ids[]" id="sub_category_selector__select" multiple>
                                            <option value="all">{{translate('Select All')}}</option>
                                            @foreach($sub_categories as $sub_category)
                                                <option
                                                    value="{{$sub_category['id']}}" {{array_key_exists('sub_category_ids', $queryParams) && in_array($sub_category['id'], $queryParams['sub_category_ids']) ? 'selected' : '' }}>{{$sub_category['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-sm-6 mb-20 search-data__field">
                                        <label class="mb-2 fs-14 text-dark">{{translate('date_range')}}</label>
                                        <select class="js-select h-40 fs-12 form-control" id="date-range" name="date_range">
                                            <option value="0" disabled selected>{{translate('Select Date Range')}}</option>
                                            <option
                                                value="all_time" {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='all_time'?'selected':''}}>{{translate('All_Time')}}</option>
                                            <option
                                                value="this_week" {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='this_week'?'selected':''}}>{{translate('This_Week')}}</option>
                                            <option
                                                value="last_week" {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='last_week'?'selected':''}}>{{translate('Last_Week')}}</option>
                                            <option
                                                value="this_month" {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='this_month'?'selected':''}}>{{translate('This_Month')}}</option>
                                            <option
                                                value="last_month" {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='last_month'?'selected':''}}>{{translate('Last_Month')}}</option>
                                            <option
                                                value="last_15_days" {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='last_15_days'?'selected':''}}>{{translate('Last_15_Days')}}</option>
                                            <option
                                                value="this_year" {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='this_year'?'selected':''}}>{{translate('This_Year')}}</option>
                                            <option
                                                value="last_year" {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='last_year'?'selected':''}}>{{translate('Last_Year')}}</option>
                                            <option
                                                value="last_6_month" {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='last_6_month'?'selected':''}}>{{translate('Last_6_Month')}}</option>
                                            <option
                                                value="this_year_1st_quarter" {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='this_year_1st_quarter'?'selected':''}}>{{translate('This_Year_1st_Quarter')}}</option>
                                            <option
                                                value="this_year_2nd_quarter" {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='this_year_2nd_quarter'?'selected':''}}>{{translate('This_Year_2nd_Quarter')}}</option>
                                            <option
                                                value="this_year_3rd_quarter" {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='this_year_3rd_quarter'?'selected':''}}>{{translate('This_Year_3rd_Quarter')}}</option>
                                            <option
                                                value="this_year_4th_quarter" {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='this_year_4th_quarter'?'selected':''}}>{{translate('this_year_4th_quarter')}}</option>
                                            <option
                                                value="custom_date" {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='custom_date'?'selected':''}}>{{translate('Custom_Date')}}</option>
                                        </select>
                                    </div>
                                    <div
                                        class="col-lg-4 col-sm-6 {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='custom_date'?'':'d-none'}}"
                                        id="from-filter__div">
                                        <div class="form-floating mb-30">
                                            <label for="from" class="mb-2 text--clr fs-14">{{translate('From')}}</label>
                                            <input type="date" class="form-control" id="from" name="from"
                                                   value="{{array_key_exists('from', $queryParams)?$queryParams['from']:''}}">
                                        </div>
                                    </div>
                                    <div
                                        class="col-lg-4 col-sm-6 {{array_key_exists('date_range', $queryParams) && $queryParams['date_range']=='custom_date'?'':'d-none'}}"
                                        id="to-filter__div">
                                        <div class="form-floating mb-30">
                                            <label for="to" class="mb-2 text--clr fs-14">{{translate('To')}}</label>
                                            <input type="date" class="form-control" id="to" name="to"
                                                   value="{{array_key_exists('to', $queryParams)?$queryParams['to']:''}}">
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex gap-3 justify-content-end">
                                        <button type="reset" class="btn btn--reset btn-sm">{{translate('Reset')}}</button>
                                        <button type="submit" class="btn btn--primary btn-sm">{{translate('Submit')}}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card mt-2">
                        <div class="card-body p-0">
                            <div class="data-table-top py-3 px-3 d-flex align-items-center flex-wrap gap-3 justify-content-between">
                                <div class="d-flex align-items-center justiy-content-end gap-3 flex-wrap">
                                    <form action="{{url()->current()}}" class="search-form rounded overflow-hidden d-flex align-items-center search-form_style-two" method="GET">
                                        <div class="input-group d-flex search-form__input_group">
                                            <!-- <span class="search-form__icon">
                                                <span class="material-icons">search</span>
                                            </span> -->
                                            <input type="search" class="theme-input-style form-control rounded-0 h-40 search-form__input"
                                               value="{{$search??''}}" name="search"
                                               placeholder="{{translate('search by provider info')}}">
                                        </div>
                                        <button type="submit" class="btn px-sm-3 px-2  btn--primary h-40 rounded-0"><i class="tio-search"></i></button>
                                    </form>
                                </div>
                                <div class="d-flex flex-wrap align-items-center gap-3">
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-sm text-capitalize min-height-40 font-medium rounded border text--title dropdown-toggle"
                                            data-toggle="dropdown">
                                            <i class="tio-download-to"></i> {{translate('Export')}}
                                        </button>
                                        <ul class="dropdown-menu z--2 bg-white dropdown-menu-lg dropdown-menu-right">
                                            <li><a class="dropdown-item"
                                                href="{{route('admin.transactions.service.report.provider.download').'?'.http_build_query($queryParams)}}">{{translate('Excel')}}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                {{-- @can('report_export')
                                <div class="d-flex flex-wrap align-items-center gap-3">
                                    <div class="dropdown">
                                        <button type="button" class="btn btn--secondary text-capitalize dropdown-toggle"
                                            data-toggle="dropdown">
                                            <span class="material-icons">file_download</span> {{translate('download')}}
                                        </button>
                                        <ul class="dropdown-menu bg-white dropdown-menu-lg dropdown-menu-right">
                                            <li><a class="dropdown-item"
                                                href="{{route('admin.transactions.service.report.provider.download').'?'.http_build_query($queryParams)}}">{{translate('Excel')}}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                @endcan --}}
                            </div>

                            <div class="table-responsive pb-0">
                                <table class="table align-middle-cus table-borderless m-0">
                                    <thead class="text-nowrap z--0" data-bg-color="#F3F8F8">
                                    <tr>
                                        <th class="border-0">{{translate('SL')}}</th>
                                        <th class="border-0">{{translate('Provider_Info')}}</th>
                                        <th class="border-0">{{translate('Subscribed_Sub_Categories')}}</th>
                                        <th class="border-0">{{translate('Service Men')}}</th>
                                        <th class="border-0">{{translate('Total_Bookings')}}</th>
                                        <th class="border-0">{{translate('Total_Earnings')}}</th>
                                        <th class="border-0">{{translate('Commission_Given')}}</th>
                                        <th class="border-0">{{translate('Completion_Rate')}}</th>
                                        <th class="border-0">{{translate('Action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($filtered_providers as $key=>$provider)
                                        <tr>
                                            <td>{{$filtered_providers->firstitem()+$key}}</td>
                                            <td>
                                                <h5 class="fw-medium mb-1">
                                                    <a href="{{route('admin.service.provider.details',[$provider->id, 'web_page'=>'overview'])}}" class="text--clr fs-12">
                                                        {{$provider['company_name']}}
                                                    </a>
                                                </h5>
                                                <span class="common-list_rating d-flex align-items-center gap-1">
                                                    <span class="material-icons">star</span>
                                                    {{$provider['avg_rating']}}
                                                </span>
                                            </td>
                                            <td>{{$provider->subscribed_services_count}}</td>
                                            <td>{{$provider->servicemen_count}}</td>
                                            <td>{{$provider->bookings_count}}</td>
                                            <td>{{\App\CentralLogics\Helpers::format_currency($provider?->account?->received_balance +  + $provider?->account?->total_withdrawn)}}</td>
                                            <td>
                                                @php($commissions = [])
                                                @foreach($provider?->transactions_for_from_user ?? [] as $transaction)
                                                    @php($commissions[] = $transaction['debit'] + $transaction['credit'])
                                                @endforeach
                                                <br/>
                                                {{ \App\CentralLogics\Helpers::format_currency(array_sum($commissions)) }}
                                            </td>
                                            <td>
                                                @if($provider->bookings_count == 0)
                                                    0%
                                                @elseif($provider->incomplete_bookings_count == 0)
                                                    100%
                                                @else
                                                    @php($completion_rate = 100 - ($provider->incomplete_bookings_count*100)/$provider->bookings_count )
                                                    {{ number_format($completion_rate, 2) }}%
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{route('admin.service.provider.details',[$provider->id, 'web_page'=>'overview'])}}"
                                                   class="action-btn btn btn-outline-primary" style="--size: 30px">
                                                   <i class="tio-invisible"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="text-center">
                                            <td colspan="10">
                                                <div class="empty--data">
                                                    <img src="{{asset('/public/assets/admin/svg/illustrations/sorry.svg')}}" alt="public">
                                                    <h5>
                                                        {{translate('no_data_found')}}
                                                    </h5>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-end pt-3">
                                {!! $filtered_providers->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script_2')
    <script>
        "use strict";


        $('#zone_selector__select').on('change', function() {
            var selectedValues = $(this).val();
            if (selectedValues !== null && selectedValues.includes('all')) {
                $(this).find('option').not(':disabled').prop('selected', 'selected');
                $(this).find('option[value="all"]').prop('selected', false);
            }
        });

        $('#provider_selector__select').on('change', function() {
            var selectedValues = $(this).val();
            if (selectedValues !== null && selectedValues.includes('all')) {
                $(this).find('option').not(':disabled').prop('selected', 'selected');
                $(this).find('option[value="all"]').prop('selected', false);
            }
        });

        $('#sub_category_selector__select').on('change', function() {
            var selectedValues = $(this).val();
            if (selectedValues !== null && selectedValues.includes('all')) {
                $(this).find('option').not(':disabled').prop('selected', 'selected');
                $(this).find('option[value="all"]').prop('selected', false);
            }
        });

        $(document).ready(function () {
            $('.zone-select').select2({
                placeholder: "{{translate('Select_zone')}}",
            });
            $('.provider-select').select2({
                placeholder: "{{translate('Select_provider')}}",
            });
            $('.sub-category-select').select2({
                placeholder: "{{translate('Select_sub_category')}}",
            });
        });

        $(document).ready(function () {
            $('#date-range').on('change', function () {
                if (this.value === 'custom_date') {
                    $('#from-filter__div').removeClass('d-none');
                    $('#to-filter__div').removeClass('d-none');
                }

                if (this.value !== 'custom_date') {
                    $('#from-filter__div').addClass('d-none');
                    $('#to-filter__div').addClass('d-none');
                }
            });
        });
    </script>
@endpush
