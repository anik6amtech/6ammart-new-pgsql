@extends('layouts.admin.app')

@section('title',$provider->company_name."'s ".translate('messages.reviews'))

@push('css_or_js')
    <!-- Custom styles for this page -->
    <link href="{{asset('public/assets/admin/css/croppie.css')}}" rel="stylesheet">

@endpush

@section('content')
<div class="content container-fluid">
    @include('service::admin.provider-management.provider.detail.partials._header',['provider'=>$provider])

    <!-- Page Heading -->
    <div class="tab-content">
        <div class="tab-pane fade show active" id="product">
            <div class="resturant-review-top" id="store_details">
                <div class="resturant-review-left mb-3">
                    @php($user_rating = null)
                    @php($total_rating = 0)
                    @php($total_reviews = $provider->rating_count)
                    @php($avgRating = $provider->avg_rating)
                    @php($totalReviews = $provider->rating_count)
                    @php($excellentCount = $provider->reviews->where('is_active', 1)->where('review_rating',5)->count())
                    @php($goodCount = $provider->reviews->where('is_active', 1)->where('review_rating',4)->count())
                    @php($averageCount = $provider->reviews->where('is_active', 1)->where('review_rating',3)->count())
                    @php($belowAverageCount = $provider->reviews->where('is_active', 1)->where('review_rating',2)->count())
                    @php($poorCount = $provider->reviews->where('is_active', 1)->where('review_rating',1)->count())

                    <h1 class="title">{{ number_format($avgRating, 1)}}<span class="out-of">/5</span></h1>
                    <div class="rating">
                        @for($i=1; $i<=5; $i++)
                            @if ($i <= $avgRating)
                                <span><i class="tio-star"></i></span>
                            @elseif ($i == ceil($avgRating))
                                <span><i class="tio-star-half"></i></span>
                            @else
                                <span><i class="tio-star-outlined"></i></span>
                            @endif
                        @endfor
                    </div>

                    <div class="info">
                        <span>{{$totalReviews}} {{translate('messages.reviews')}}</span>
                    </div>
                </div>
                <div class="resturant-review-right">
                    <ul class="list-unstyled list-unstyled-py-2 mb-0">
                        <!-- Review Ratings -->
                        <li class="d-flex align-items-center font-size-sm">
                            <span class="progress-name mr-3">{{translate('messages.excellent')}}</span>
                            <div class="progress flex-grow-1">
                                <div class="progress-bar" role="progressbar"
                                     style="width: {{ $totalReviews > 0 ? ($excellentCount / $totalReviews) * 100 : 0 }}%;"
                                     aria-valuenow="{{ $totalReviews > 0 ? ($excellentCount / $totalReviews) * 100 : 0 }}"
                                     aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span class="ml-3">{{$excellentCount}}</span>
                        </li>
                        <!-- End Review Ratings -->

                        <!-- Review Ratings -->
                        <li class="d-flex align-items-center font-size-sm">
                            <span class="progress-name mr-3">{{translate('messages.good')}}</span>
                            <div class="progress flex-grow-1">
                                <div class="progress-bar" role="progressbar"
                                     style="width: {{ $totalReviews > 0 ? ($goodCount / $totalReviews) * 100 : 0 }}%;"
                                     aria-valuenow="{{ $totalReviews > 0 ? ($goodCount / $totalReviews) * 100 : 0 }}"
                                     aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span class="ml-3">{{$goodCount}}</span>
                        </li>
                        <!-- End Review Ratings -->

                        <!-- Review Ratings -->
                        <li class="d-flex align-items-center font-size-sm">
                            <span class="progress-name mr-3">{{translate('messages.average')}}</span>
                            <div class="progress flex-grow-1">
                                <div class="progress-bar" role="progressbar"
                                     style="width: {{ $totalReviews > 0 ? ($averageCount / $totalReviews) * 100 : 0 }}%;"
                                     aria-valuenow="{{ $totalReviews > 0 ? ($averageCount / $totalReviews) * 100 : 0 }}"
                                     aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span class="ml-3">{{$averageCount}}</span>
                        </li>
                        <!-- End Review Ratings -->

                        <!-- Review Ratings -->
                        <li class="d-flex align-items-center font-size-sm">
                            <span class="progress-name mr-3">{{translate('messages.below_average')}}</span>
                            <div class="progress flex-grow-1">
                                <div class="progress-bar" role="progressbar"
                                     style="width: {{ $totalReviews > 0 ? ($belowAverageCount / $totalReviews) * 100 : 0 }}%;"
                                     aria-valuenow="{{ $totalReviews > 0 ? ($belowAverageCount / $totalReviews) * 100 : 0 }}"
                                     aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span class="ml-3">{{$belowAverageCount}}</span>
                        </li>
                        <!-- End Review Ratings -->

                        <!-- Review Ratings -->
                        <li class="d-flex align-items-center font-size-sm">
                            <span class="progress-name mr-3">{{translate('messages.poor')}}</span>
                            <div class="progress flex-grow-1">
                                <div class="progress-bar" role="progressbar"
                                     style="width: {{ $totalReviews > 0 ? ($poorCount / $totalReviews) * 100 : 0 }}%;"
                                     aria-valuenow="{{ $totalReviews > 0 ? ($poorCount / $totalReviews) * 100 : 0 }}"
                                     aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span class="ml-3">{{$poorCount}}</span>
                        </li>
                        <!-- End Review Ratings -->
                    </ul>
                </div>
            </div>
            <div class="card">

                    <!-- Header -->
            <div class="card-header py-2">
                <div class="search--button-wrapper">
                    <h5 class="card-title">{{translate('messages.Review_list')}}

                        <span class="badge badge-soft-dark ml-2"
                        id="itemCount">{{ 0 }}</span>
                    </h5>
                    {{-- <form  class="search-form">
                                    <!-- Search -->
                        @csrf
                        <div class="input-group input--group">
                            <input id="datatableSearch_" type="search" value="{{ request()?->search ?? null }}" name="search" class="form-control"
                                    placeholder="{{translate('ex_:_Search_Store_Name')}}" aria-label="{{translate('messages.search')}}" >
                            <button type="submit" class="btn btn--secondary"><i class="tio-search"></i></button>

                        </div>
                        <!-- End Search -->
                    </form> --}}
                    <!-- Unfold -->
                    <div class="hs-unfold mr-2">
                        <a class="js-hs-unfold-invoker btn btn-sm btn-white dropdown-toggle min-height-40" href="javascript:;"
                            data-hs-unfold-options='{
                                    "target": "#usersExportDropdown",
                                    "type": "css-animation"
                                }'>
                            <i class="tio-download-to mr-1"></i> {{ translate('messages.export') }}
                        </a>

                        <div id="usersExportDropdown"
                            class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right">

                            <span class="dropdown-header">{{ translate('messages.download_options') }}</span>
                            <a id="export-excel" class="dropdown-item" href="{{route('admin.service.provider.reviews.download')}}?search={{$search}}">
                                <img class="avatar avatar-xss avatar-4by3 mr-2"
                                    src="{{ asset('public/assets/admin') }}/svg/components/excel.svg"
                                    alt="Image Description">
                                {{ translate('messages.excel') }}
                            </a>

                        </div>
                    </div>
                    <!-- End Unfold -->
                </div>
            </div>


                <div class="card-body p-0 verticle-align-middle-table">
                    <div class="table-responsive datatable-custom">
                        <table id="columnSearchDatatable"
                               class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                            <thead class="thead-light">
                            <tr>
                                <th>{{translate('SL')}}</th>
                                <th>{{translate('Review ID')}}</th>
                                <th>{{translate('reviewer')}}</th>
                                <th>{{translate('date')}}</th>
                                <th>{{translate('ratings')}}</th>
                                <th>{{translate('reviews')}}</th>
                                <th>{{translate('reply')}}</th>
                                <th>{{translate('status')}}</th>
                                <th class="text-center">{{translate('action')}}</th>
                            </tr>
                            </thead>

                            <tbody id="set-rows">
                            @foreach($reviews as $bookingId => $review)
                                @if($review->reviews->count() > 1)
                                    @php($getReviewInfo = $review->reviews->first())
                                    <tr class="clickable-row" data-toggle="collapse"
                                        data-target="#group-{{$bookingId}}" aria-expanded="false">
                                        <td>{{$bookingId+$reviews?->firstItem()}}</td>
                                        <td>
                                            {{ Str::limit($review->reviews->pluck('id')->implode(', '), 18) }}
                                        </td>
                                        <td>
                                            @if(isset($getReviewInfo->customer))
                                                <span>{{$getReviewInfo->customer->f_name . ' ' .$getReviewInfo->customer->l_name}}</span>
                                                <br>
                                                <span>{{ translate('Booking ID #') . $review->id ?? 'N/A' }}</span>
                                            @else
                                                <span
                                                    class="opacity-50">{{translate('Customer_not_available')}}</span>
                                            @endif
                                        </td>
                                        <td>{{$getReviewInfo->created_at}}</td>
                                        <td>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="15"
                                                    viewBox="0 0 14 15" fill="none">
                                                <path
                                                    d="M7 1.81445L8.854 5.76398L13 6.4012L10 9.47376L10.708 13.8145L7 11.764L3.292 13.8145L4 9.47376L1 6.4012L5.146 5.76398L7 1.81445Z"
                                                    fill="#FFB900" stroke="#FFB900" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <span>{{ number_format($review->reviews->pluck('review_rating')->avg(),1) }}</span>

                                        </td>
                                        <td><a href="">{{translate('see_all')}}</a></td>
                                        <td><a href="">{{translate('see_all')}}</a></td>
                                        <td><a href="">{{translate('see_all')}}</a></td>
                                        <td><a href="">{{translate('see_all')}}</a></td>
                                    </tr>
                                    <tr id="group-{{$bookingId}}" class="collapse">
                                        <td colspan="9">
                                            <table class="table align-middle">
                                                @foreach($review->reviews as $key => $providerReview)
                                                    <tr>
                                                        <td></td>
                                                        <td>{{ $providerReview->id == 0 ? 'N/A' : $providerReview->id }}</td>
                                                        <td width="21%" class="test-center">
                                                            @if(isset($providerReview->service))
                                                                <img class="img-fluid"
                                                                        src="{{$providerReview->service->cover_image_full_path}}"
                                                                        alt="" width="25%" height="25%">
                                                                <span>{{ Str::limit($providerReview->service->name, 15) }}</span>
                                                            @endif
                                                        </td>
                                                        <td>{{$providerReview->created_at}}</td>
                                                        <td>
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                                    height="15" viewBox="0 0 14 15" fill="none">
                                                                <path
                                                                    d="M7 1.81445L8.854 5.76398L13 6.4012L10 9.47376L10.708 13.8145L7 11.764L3.292 13.8145L4 9.47376L1 6.4012L5.146 5.76398L7 1.81445Z"
                                                                    fill="#FFB900" stroke="#FFB900"
                                                                    stroke-width="2" stroke-linecap="round"
                                                                    stroke-linejoin="round"/>
                                                            </svg>
                                                            {{$providerReview->review_rating}}
                                                        </td>
                                                        <td data-bs-custom-class="review-tooltip" data-bs-toggle="tooltip" title="{{$providerReview->review_comment}}">{{ Str::limit($providerReview->review_comment, 100) ?? translate('No review yet') }}</td>
                                                        <td data-bs-custom-class="review-tooltip" data-bs-toggle="tooltip" title="{{$providerReview->reviewReply?->reply}}">{{ Str::limit($providerReview->reviewReply?->reply, 100) ?? translate('No reply yet') }}</td>
                                                        <td>
                                                            @if(!empty($providerReview->review_comment))
                                                                <label class="switcher">
                                                                    <input class="switcher_input route-alert"
                                                                            data-route="{{ route('admin.service.service.review-status-update', $providerReview->id) }}"
                                                                            data-message="{{translate('want_to_update_status')}}"
                                                                            type="checkbox" {{ $providerReview->is_active ? 'checked' : '' }}>
                                                                    <span class="switcher_control"></span>
                                                                </label>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if(!empty($providerReview->review_comment))
                                                                <div
                                                                    class="d-flex gap-2 justify-content-center">
                                                                    <button class="action-btn btn--light-primary fw-medium text-capitalize fz-14" data-toggle="modal" id="replyModalBtn"
                                                                            data-target="#replyModal"
                                                                            data-booking_id ="{{$providerReview->booking->id}}"
                                                                            data-readable_id ="{{$providerReview->id}}"
                                                                            data-service_name="{{$providerReview->service->name}}"
                                                                            data-service_img="{{$providerReview->service->cover_image_full_path}}"
                                                                            data-review="{{$providerReview->review_comment ?? translate('No review yet')}}"
                                                                            data-review_reply="{{$providerReview->reviewReply?->reply ?? translate('No reply yet')}}"
                                                                            data-variant_key="{{ $providerReview->service?->bookings[0]?->variant_key }}"
                                                                    >
                                                                    <span
                                                                        class="material-icons">visibility</span>
                                                                    </button>
                                                                </div>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                    </tr>
                                @else
                                    @php($getReview = $review->reviews->first())
                                    <tr>
                                        <td>{{$bookingId+$reviews?->firstItem()}}</td>
                                        <td>{{ $getReview->id == 0 ? 'N/A' : $getReview->id }}</td>
                                        <td>
                                            @if(isset($review->customer))
                                                <span>{{$review->customer->f_name . ' ' .$review->customer->l_name}}</span>
                                                <br>
                                                <span>{{ translate('Booking ID #') . $review->id ?? 'N/A' }}</span>
                                            @else
                                                <span
                                                    class="opacity-50">{{translate('Customer_not_available')}}</span>
                                            @endif
                                        </td>
                                        <td>{{$getReview->created_at}}</td>
                                        <td>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="15"
                                                    viewBox="0 0 14 15" fill="none">
                                                <path
                                                    d="M7 1.81445L8.854 5.76398L13 6.4012L10 9.47376L10.708 13.8145L7 11.764L3.292 13.8145L4 9.47376L1 6.4012L5.146 5.76398L7 1.81445Z"
                                                    fill="#FFB900" stroke="#FFB900" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            {{$getReview->review_rating}}
                                        </td>
                                        <td  data-bs-custom-class="review-tooltip" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="{{$getReview->review_comment}}">{{ Str::limit($getReview->review_comment, 100) ?? translate('No review yet') }}</td>
                                        <td  data-bs-custom-class="review-tooltip" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="{{$getReview->reviewReply?->reply}}">{{ Str::limit($getReview->reviewReply?->reply, 100) ?? translate('No reply yet') }}</td>
                                        <td>
                                            @if(!empty($getReview->review_comment))
                                                {{-- <label class="switcher">
                                                    <input class="switcher_input route-alert"
                                                            data-route="{{ route('admin.service.service.review-status-update', $getReview->id) }}"
                                                            data-message="{{translate('want_to_update_status')}}"
                                                            type="checkbox" {{ $getReview->is_active ? 'checked' : '' }}>
                                                    <span class="switcher_control"></span>
                                                </label> --}}
                                                <div class="d-flex justify-content-center">
                                                    <label class="toggle-switch toggle-switch-sm" for="statusCheckbox{{$getReview->id}}">
                                                        <input type="checkbox"
                                                        data-id="statusCheckbox{{$getReview->id}}"
                                                        data-type="status"
                                                        data-image-on="{{ asset('/public/assets/admin/img/modal/basic_campaign_on.png') }}"
                                                        data-image-off="{{ asset('/public/assets/admin/img/modal/basic_campaign_off.png') }}"
                                                        data-title-on="{{ translate('By_Turning_ON_review!') }}"
                                                        data-title-off="{{ translate('By_Turning_OFF_review!') }}"
                                                        data-text-on="<p>{{ translate('If_you_turn_on_this_status,_it_will_show_on_user_app.') }}</p>"
                                                        data-text-off="<p>{{ translate('If_you_turn_off_this_status,_it_won’t_show_on_user_app') }}</p>"
                                                        class="toggle-switch-input  dynamic-checkbox" id="statusCheckbox{{$getReview->id}}" {{$getReview->is_active?'checked':''}}>
                                                        <span class="toggle-switch-label">
                                                            <span class="toggle-switch-indicator"></span>
                                                        </span>
                                                    </label>
                                                    <form action="{{ route('admin.service.service.review-status-update', $getReview->id) }}"
                                                    method="get" id="statusCheckbox{{$getReview->id}}_form">
                                                        <input type="hidden" name="status" value="{{$getReview->is_active?0:1}}">
                                                        <input type="hidden" name="id" value="{{$getReview->id}}">
                                                    </form>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            @if(!empty($getReview->review_comment))
                                                <div class="d-flex gap-2 justify-content-center">
                                                    <button
                                                        class="btn action-btn btn--primary btn-outline-primary"
                                                        data-toggle="modal" id="replyModalBtn"
                                                        data-target="#replyModal"
                                                        data-booking_id="{{$getReview?->booking?->id}}"
                                                        data-readable_id="{{$getReview->id}}"
                                                        data-service_name="{{$getReview->service->name}}"
                                                        data-service_img="{{$getReview->service->cover_image_full_path}}"
                                                        data-review="{{$getReview->review_comment ?? translate('No review yet')}}"
                                                        data-review_reply="{{$getReview->reviewReply?->reply ?? translate('No reply yet')}}"
                                                        data-variant_key="{{ $getReview->booking?->detail[0]?->variant_key }}"
                                                    >
                                                        <i class="tio-visible"></i>
                                                    </button>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                    @if(count($reviews) !== 0)
                        <hr>
                    @endif
                    <div class="page-area mt-3">
                        {!! $reviews->appends($_GET)->links() !!}
                    </div>
                    @if(count($reviews) === 0)
                        <div class="empty--data">
                            <img src="{{asset('/public/assets/admin/svg/illustrations/sorry.svg')}}" alt="public">
                            <h5>
                                {{translate('no_data_found')}}
                            </h5>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div id="title" data-title="{{ translate('Are_you_sure?') }}"></div>
<div id="buttonCancel" data-no="{{ translate('no') }}"></div>
<div id="buttonApprove" data-yes="{{ translate('yes') }}"></div>

<div class="modal fade" id="replyModal" tabindex="-1" aria-labelledby="replyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pt-0">
                <div class="p-3 pt-0">
                    <div class="d-flex gap-3">
                        <img src="" class="rounded aspect-square object-fit-cover" width="80" alt="Service Image">
                        <div class="w-0 flex-grow-1">
                            <div class="mb-2">
                                <span>{{translate('Booking ID #')}}</span> <label class="booking_id"></label>
                            </div>
                            <h5 class="service_name"></h5>
                            <div class="mt-2">
                                <span class="variant_key"></span>
                            </div>
                        </div>
                    </div>
                    <div class="review_section mb-3 mt-3">
                        <h4 class="mb-2">{{translate('Review')}}</h4>
                        <div class="p-3 rounded bg--secondary">
                            <p class="review_content"></p>
                        </div>
                    </div>
                    <div class="reply_section">
                        <div>
                            <h4 class="mb-3">{{translate('Reply')}}</h4>
                            <div class="form-group">
                                <textarea id="reply_content" class="form-control" name="reply_content" rows="4"
                                            readonly disabled></textarea>
                                <input type="hidden" class="form-control" name="readable_id" value="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script_2')
    <script src="{{asset('Modules/Rental/public/assets/js/admin/view-pages/provider-review.js')}}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var clickableRows = document.querySelectorAll('.clickable-row');
            clickableRows.forEach(function (row) {
                row.addEventListener('click', function () {
                    var target = row.getAttribute('data-target');
                    var collapseElement = document.querySelector(target);
                    collapseElement.classList.toggle('show');
                });
            });
        });

        $('#replyModal').on('show.bs.modal', function (event) {
            const button = $(event.relatedTarget);
            const modal = $(this);
            const serviceImg = button.data('service_img');
            const serviceName = button.data('service_name');
            const bookingID = button.data('booking_id');
            const readableID = button.data('readable_id');
            const review = button.data('review');
            const reviewReply = button.data('review_reply');
            const variantKey = button.data('variant_key');
            const action = button.data('action');

            modal.find('.service_name').text(serviceName);
            modal.find('.variant_key').text(variantKey);
            modal.find('.booking_id').text(bookingID);
            modal.find('.review_content').text(review);
            modal.find('img').attr('src', serviceImg);

            modal.find('textarea[name=reply_content]').val(reviewReply);
            modal.find('input[name=readable_id]').val(readableID);
            modal.find('form').attr('action', action);
        });
    </script>
@endpush
