@extends('service::provider.layouts.app')

@section('title', translate('messages.available_services'))

@push('css_or_js')

@endpush

@section('content')

    <div class="content container-fluid">
        <!-- Page Header -->
        <h2 class="h1 text-capitalize d-flex align-items-center gap-2 mb-20">
            <img width="24" height="24" src="{{asset('Modules/Service/public/assets/img/admin/review-man.png')}}" alt="services"> My Reviews
        </h2>

        <div class="card mb-20">
            <div class="card-body">
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
            </div>
        </div>
        <div class="card">
            <div class="data-table-top border-bottom d-flex align-items-center flex-wrap gap-3 justify-content-between p-3">
                <h4 class="text-title mb-0">Reviews</h4>
                <div class="d-flex flex-wrap align-items-center gap-3">
                    <form action="#0" method="GET">
                        <div class="input-group input-group-custom input-group-merge">
                            <input id="datatableSearch_" type="search" name="search" class="form-control"
                                placeholder="Search by name" aria-label="Search by ID or name" value="{{ request()->search }}" required="">
                            <button type="submit" class="btn btn--primary input-group-text"><i
                                    class="tio-search fz-15px"></i></button>
                        </div>
                    </form>
                    {{-- <div class="hs-unfold mr-2">
                        <a class="js-hs-unfold-invoker btn btn-sm btn-white dropdown-toggle h--45px border" href="javascript:;" data-hs-unfold-options="{
                                &quot;target&quot;: &quot;#usersExportDropdown&quot;,
                                &quot;type&quot;: &quot;css-animation&quot;
                            }" data-hs-unfold-target="#usersExportDropdown" data-hs-unfold-invoker="">
                            <i class="tio-download-to mr-1"></i> Export
                        </a>

                        <div id="usersExportDropdown" class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right hs-unfold-content-initialized hs-unfold-css-animation animated hs-unfold-hidden" data-hs-target-height="131.516" data-hs-unfold-content="" data-hs-unfold-content-animation-in="slideInUp" data-hs-unfold-content-animation-out="fadeOut" style="animation-duration: 300ms;">
                            <span class="dropdown-header">Download options</span>
                            <a id="export-excel" class="dropdown-item" href="javascript:;">
                                <img class="avatar avatar-xss avatar-4by3 mr-2" src="{{asset('/public/assets/admin/svg/components/excel.svg')}}" alt="Image Description">
                                Excel
                            </a>
                            <a id="export-csv" class="dropdown-item" href="javascript:;">
                                <img class="avatar avatar-xss avatar-4by3 mr-2" src="{{asset('/public/assets/admin/svg/components/placeholder-csv-format.svg')}}" alt="Image Description">
                                .Csv
                            </a>
                        </div>
                    </div> --}}
                </div>
            </div>
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table align-middle">
                            <thead>
                            <tr>
                                <th>{{translate('SL')}}</th>
                                <th>{{translate('Review ID')}}</th>
                                <th>{{translate('reviewer')}}</th>
                                <th>{{translate('date')}}</th>
                                <th>{{translate('ratings')}}</th>
                                <th>{{translate('reviews')}}</th>
                                <th>{{translate('reply')}}</th>
                                <th class="text-center">{{translate('action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($reviews as $bookingId => $review)
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
                                    </tr>
                                    <tr id="group-{{$bookingId}}" class="collapse">
                                        <td colspan="9">
                                            <table class="table align-middle">
                                                @foreach($review->reviews->where('is_active', 1) as $key => $providerReview)
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
                                                                <div
                                                                    class="d-flex gap-2 justify-content-center">
                                                                    <button class="action-btn btn btn-primary fw-medium text-capitalize fz-14" data-bs-toggle="modal" id="replyModalBtn"
                                                                            data-bs-target="#replyModal"
                                                                            data-booking_id ="{{$providerReview->booking->id}}"
                                                                            data-readable_id ="{{$providerReview->id}}"
                                                                            data-review_id ="{{$providerReview->id}}"
                                                                            data-service_name="{{$providerReview->service->name}}"
                                                                            data-service_img="{{$providerReview->service->cover_image_full_path}}"
                                                                            data-review="{{$providerReview->review_comment ?? translate('No review yet')}}"
                                                                            data-review_reply="{{$providerReview->reviewReply?->reply ?? translate('No reply yet')}}"
                                                                            data-variant_key="{{ $providerReview->service?->bookings[0]?->variant_key }}"
                                                                            data-action="{{ route('provider.service.reviews.reply') }}"
                                                                    >
                                                                            <i class="tio-visible"></i>
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
                                        <td data-bs-toggle="tooltip"
                                            title="{{$getReview->review_comment}}">{{ Str::limit($getReview->review_comment, 100) ?? translate('No review yet') }}</td>
                                        <td data-bs-toggle="tooltip"
                                            title="{{$getReview->reviewReply?->reply}}">{{ Str::limit($getReview->reviewReply?->reply, 100) ?? translate('No reply yet') }}</td>
                                        <td>
                                            @if(!empty($getReview->review_comment))
                                                <div class="d-flex gap-2 justify-content-center">
                                                    <button
                                                        class="action-btn btn btn-primary fw-medium text-capitalize fz-14"
                                                        data-toggle="modal" id="replyModalBtn"
                                                        data-target="#replyModal"
                                                        data-booking_id="{{$getReview?->booking?->id}}"
                                                        data-readable_id="{{$getReview->id}}"
                                                        data-review_id ="{{$getReview->id}}"
                                                        data-service_name="{{$getReview->service->name}}"
                                                        data-service_img="{{$getReview->service->cover_image_full_path}}"
                                                        data-review="{{$getReview->review_comment ?? translate('No review yet')}}"
                                                        data-review_reply="{{$getReview->reviewReply?->reply ?? translate('No reply yet')}}"
                                                        data-variant_key="{{ $getReview->booking?->detail[0]?->variant_key }}"
                                                        data-action="{{ route('provider.service.reviews.reply') }}"
                                                    >
                                                        <i class="tio-visible"></i>
                                                    </button>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @empty
                                <tr>
                                    <td class="text-center" colspan="8">
                                        {{ translate('You don’t have any reviews yet.') }}
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Reviews Popup -->
    {{-- <div class="modal fade" id="reviewsBtn" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header pb-0">
                    <h3 class="text-center m-0"></h3>
                    <button type="button" class="close bg-white text-dark d-center w-30px h-30 rounded-circle" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body py-4">
                    <div class="d-flex align-items-center gap-3 mb-20 pb-xl-3">
                        <img width="50" height="50" class="rounded" src="{{asset('/public/assets/admin/img/400x400/img4.jpg')}}" alt="images">
                        <div>
                            <h4 class="mb-0">Jhon Doe</h4>
                            <span class="fs-12">Review ID #10003278</span>
                        </div>
                    </div>
                    <div class="mb-20">
                        <h5 class="mb-1">Review</h5>
                        <p class="fs-12 mb-0">
                            Gas Stove is very important in our daily life, most importantly it cooks food. So, when a gas stove breaks down it requires urgent servicing.
                        </p>
                    </div>
                    <form action="#0">
                        <textarea name="reviewBox" placeholder="Write your reply here.." class="form-control" rows="4"></textarea>
                        <div class="text-end mt-20">
                            <button type="submit" class="btn btn--primary">Send Reply</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
<?php
    $reviewPermission = business_config('provider_can_reply_review')->value;
    ?>
    <div class="modal fade" id="replyModal" tabindex="-1" aria-labelledby="replyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-0">
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
                        <form action="" method="post">
                            @csrf
                            <div class="reply_section">
                                <div>
                                    <h4 class="mb-3">{{translate('Reply')}}</h4>
                                    <div class="form-group">
                                        <textarea id="reply_content" class="form-control" name="reply_content" rows="4" {{$reviewPermission ? '' : 'readonly disabled'}}></textarea>
                                        <input type="hidden" class="form-control" name="review_id" value="">
                                    </div>
                                </div>
                            </div>
                            @if($reviewPermission)
                                <div class="text-end mt-3">
                                    <button class="btn btn--primary" type="submit">{{ translate('submit') }}</button>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script_2')
    <script>
        "use strict"

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
            const reviewID = button.data('review_id');
            const review = button.data('review');
            const variantKey = button.data('variant_key');
            const reviewReply = button.data('review_reply');
            const action = button.data('action');
            console.log(serviceImg)

            modal.find('.service_name').text(serviceName);
            modal.find('.booking_id').text(bookingID);
            modal.find('.review_content').text(review);
            modal.find('.variant_key').text(variantKey);
            modal.find('img').attr('src', serviceImg);

            modal.find('textarea[name=reply_content]').val(reviewReply);
            modal.find('input[name=review_id]').val(reviewID);
            modal.find('form').attr('action',action);
        });
    </script>
@endpush
