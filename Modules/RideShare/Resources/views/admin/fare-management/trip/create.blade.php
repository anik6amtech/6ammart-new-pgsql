@extends('layouts.admin.app')

@section('title', translate('Trip_Fare_Setup'))

@section('content')
	<div class="content container-fluid">
		<!-- Page Header -->
        <div class="page-header pb-4">
            <h1 class="page-header-title text--title mb-1">
                <span>
                    {{ translate('messages.Ride_Fare_Setup') }} -
                </span>
                <span class="text--primary">
                    {{ $zone->name }}
                </span>
            </h1>
        </div>
        <!-- End Page Header -->

        <form action="{{ route('admin.ride-share.fare.trip.store') }}" method="post" id="trip-store-form">
            @csrf
			<div class="card mb-3">
				<div class="card-header">
					<div class="d-flex flex-column gap-3 w-100">
						<div>
							<h4 class="mb-3 text-capitalize">{{ translate('Available_vehicles_in_this_zone') }}</h4>
							<p class="fs-12 mb-0">{{ translate('The_following_vehicles_are_currently_assigned_to_this_zone_for_regular_Ride.__You_may_modify_vehicle_availability_for_this_zone_as_needed') }}</p>
						</div>

						<div class="d-flex flex-wrap align-items-center gap-4 gap-lg-40px p-3 rounded" data-bg-color="#F6F6F6">
                            @foreach($vehicleCategories as $vehicleCategory)
                            @php($trip = $tripFares?->where('vehicle_category_id', $vehicleCategory->id)->first())
                                <label class="form-check custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" class="custom-control-input test" name="vehicle_category_{{ $vehicleCategory->id }}"
                                        value="{{ $vehicleCategory->id }}" @if ($trip?->vehicle_category_id == $vehicleCategory->id) checked @endif>
                                    <span class="custom-control-label">{{ $vehicleCategory->name }}</span>
                                </label>
                            @endforeach
						</div>
                        <input type="hidden" name="zone_id" value="{{ $zone->id }}">
                        <input type="hidden" name="default_fare_id" value="{{ $defaultTripFare?->id }}">
					</div>
				</div>
				<div class="card-body">
					<h4 class="text--titlle mb-4 text-capitalize">{{ translate('Default_Fare_Setup') }}</h4>
					<div class="row gy-3 custom-class-fare">
						<div class="col-sm-6 col-lg-4">
							<div class="form-group mb-0">
								<label for="base_fare" class="input-label">{{ translate('Base Fare') }} ($)</label>
                                <input type="number" class="form-control part-1-input copy-value" step=".01"
                                        min="0.01" name="base_fare" id="base_fare" max="99999999"
                                        placeholder="{{ translate('Base_Fare') }}"
                                        value="{{ $defaultTripFare->base_fare ?? 0 }}" required>
							</div>
						</div>
						<div class="col-sm-6 col-lg-4">
							<div class="form-group mb-0">
								<label for="base_fare_per_km" class="input-label">{{ translate('Fare') }} ({{ translate('Per_km') }}) ($)</label>
                                <input type="number" class="form-control part-1-input copy-value" step=".01"
                                        min="0.01" max="99999999" name="base_fare_per_km"
                                        placeholder="{{ translate('Fare_(Per_km)') }}" id="base_fare_per_km"
                                        value="{{ $defaultTripFare->base_fare_per_km ?? 0 }}" required>
							</div>
						</div>
						<div class="col-sm-6 col-lg-4">
							<div class="form-group mb-0">
								<label for="cancellation_fee" class="input-label">{{ translate('Cancellation_Fee') }} (%)</label>
                                 <input type="number" name="cancellation_fee" min="0" max="100"
                                        step=".01" class="form-control part-1-input copy-value"
                                        placeholder="{{ translate('Cancellation_Fee_(%)') }}" id="cancellation_fee"
                                        value="{{ $defaultTripFare->cancellation_fee_percent ?? 0 }}" required>
							</div>
						</div>
						<div class="col-sm-6 col-lg-4">
							<div class="form-group mb-0">
								<label for="min_cancellation_fee" class="input-label">{{ translate('Minimum_Cancellation_Fee') }} ($)</label>
                                <input type="number" name="min_cancellation_fee" step=".01" min="0"
                                    max="99999999" class="form-control part-1-input copy-value"
                                    placeholder="{{ translate('Minimum_Cancellation_Fee_($)') }}"
                                    id="min_cancellation_fee" value="{{ $defaultTripFare->min_cancellation_fee ?? 0 }}"
                                    required>
							</div>
						</div>
						<div class="col-sm-6 col-lg-4">
							<div class="form-group mb-0">
								<label for="idle_fee" class="input-label">
									{{ translate('Idle_Fee') }} ({{ translate('Per_min') }}) ($)
								</label>
                                <input type="number" name="idle_fee" step=".01" max="99999999"
                                        class="form-control part-1-input copy-value"
                                        placeholder="{{ translate('Idle_Fee_(Per_min)') }}" id="idle_fee"
                                        value="{{ $defaultTripFare->idle_fee_per_min ?? 0 }}" required>
							</div>
						</div>
						<div class="col-sm-6 col-lg-4">
							<div class="form-group mb-0">
								<label for="ride_delay_fee" class="input-label">{{ translate('Trip_Delay_Fee') }} ({{ translate('Per_min') }}) ($)</label>
                                 <input type="number" name="ride_delay_fee" step=".01" max="99999999"
                                        class="form-control part-1-input copy-value"
                                        placeholder="{{ translate('Trip_Delay_Fee_(Per_min)') }}" id="ride_delay_fee"
                                        value="{{ $defaultTripFare->ride_delay_fee_per_min ?? 0 }}" required>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header">
					<div class="d-flex flex-wrap align-items-center justify-content-between gap-2 w-100">
						<div class="w-0 flex-grow-1">
							<h4 class="text--title font-bold text-capitalize mb-2">
								{{ translate('Category_wise_trip_fee') }}
							</h4>
							<div class="fs-12">
								{{ translate('You_can_set_specific_fares_for_each_vehicle_category._Turn_on_the_option_below_and_configure_your_fares') }}
							</div>
						</div>
						<label id="" class="switch--custom-label toggle-switch toggle-switch-sm d-inline-flex checked">
                            <input data-url="" type="checkbox" name="category_wise_different_fare"
                                id="use_category_wise" class="switcher_input toggle-switch-input use_category_wise"
                                {{ empty($defaultTripFare) || (!empty($defaultTripFare) && $defaultTripFare?->category_wise_different_fare == 1) ? 'checked' : '' }}
                                onchange="toggleSwitcherState(this)">
							<span class="toggle-switch-label text">
								<span class="toggle-switch-indicator"></span>
							</span>
						</label>
					</div>
				</div>
				<div class="card-body p-0">
					<div class="fade-div show" id="different-fare-div">
						<div class="p-4">
							<div class="table-responsive border rounded">
								<table class="table align-middle table-borderless table-variation">
									<thead class="border-bottom">
		                               <tr>
                                            <th>{{ translate('Fares') }}</th>
                                            <th class="text-capitalize">{{ translate('Default_Price') }}</th>
                                            @forelse($vehicleCategories as $vehicleCategory)
                                                @php($trip = $tripFares?->firstWhere('vehicle_category_id', $vehicleCategory->id))
                                                <th
                                                    class="{{ $vehicleCategory->id }} {{ $vehicleCategory->id == $trip?->vehicle_category_id ? '' : 'd-none' }}">
                                                    {{ $vehicleCategory->name }}</th>
                                            @empty
                                            @endforelse
                                        </tr>
									</thead>
									<tbody>
										<tr>
											<td>
												<div class="d-flex align-items-center gap-2 font-semibold">
													<div class="text--title text-capitalize">
                                                        {{ translate('base_fare') }}
                                                        ({{ session()->get('currency_symbol') ?? '$' }})
													</div>
													<i class="fi fi-sr-info fs-14" data-color="#14B19E" data-toggle="tooltip"
														title="{{ translate('Set_the_base_fare_for_starting_a_trip') }}">
													</i>
												</div>
											</td>
											<td>
												<input readonly type="number" class="form-control base_fare_default"
                                                        value="{{ $defaultTripFare->base_fare ?? 0 }}" required>
											</td>
                                            @foreach($vehicleCategories as $vehicleCategory)
                                                @php($trip = $tripFares?->firstWhere('vehicle_category_id', $vehicleCategory->id))
                                                <td
                                                    class="{{ $vehicleCategory->id }} {{ $vehicleCategory->id == $trip?->vehicle_category_id ? '' : 'd-none' }}">
                                                    <input type="number" step=".01" min="0.01"
                                                        max="99999999" name="base_fare_{{ $vehicleCategory->id }}"
                                                        class="form-control base_fare_default part-2-input {{ $vehicleCategory->id }}"
                                                        value="{{ $trip?->base_fare ? round($trip->base_fare, 2) : ($defaultTripFare->base_fare ?? 0) }}"
                                                        {{-- {{ $vehicleCategory->id == $trip?->vehicle_category_id ? '' : 'readonly' }} --}}
                                                        required>
                                                </td>
                                            @endforeach
										</tr>
										<tr>
											<td>
												<div class="d-flex align-items-center gap-2 font-semibold">
													<div class="text--title text-capitalize">
                                                        {{ translate('fare_per_km') }}
                                                        ({{ session()->get('currency_symbol') ?? '$' }})
													</div>
													<i class="fi fi-sr-info fs-14" data-color="#14B19E" data-toggle="tooltip"
														title="{{ translate('Set_the_fare_for_each_kilometer_added_with_the_base_fare') }}"></i>
												</div>
											</td>
											<td>
												<input readonly type="number"
                                                        class="form-control base_fare_per_km_default"
                                                        value="{{ $defaultTripFare->base_fare_per_km ?? 0 }}">
											</td>
                                            @foreach($vehicleCategories as $vehicleCategory)
                                                @php($trip = $tripFares?->firstWhere('vehicle_category_id', $vehicleCategory->id))
                                                <td
                                                    class="{{ $vehicleCategory->id }} {{ $vehicleCategory->id == $trip?->vehicle_category_id ? '' : 'd-none' }}">
                                                    <input type="number" step=".01" min=".01"
                                                        max="99999999"
                                                        name="base_fare_per_km_{{ $vehicleCategory->id }}"
                                                        class="form-control base_fare_per_km_default part-2-input {{ $vehicleCategory->id }}"
                                                        value="{{ $trip?->base_fare_per_km ? round($trip->base_fare_per_km, 2) : ($defaultTripFare->base_fare_per_km ?? 0) }}"
                                                        {{-- {{ $vehicleCategory->id == $trip?->vehicle_category_id ? '' : 'readonly' }} --}}>
                                                </td>
                                            @endforeach
										</tr>
										<tr>
											<td>
												<div class="d-flex align-items-center gap-2 font-semibold">
													<div class="text--title text-capitalize">{{ translate('cancellation_fee') }}
														(%)
													</div>
													<i class="fi fi-sr-info fs-14" data-color="#14B19E" data-toggle="tooltip"
														title="{{ translate('Set_the_trip_cancellation_fee_(in_percentage_of_the_total_trip_fee)_here._If_the_user_cancels_the_trip_they_must_pay_this_fee') }}">
													</i>
												</div>
											</td>
											<td>
												<input readonly type="number"
                                                        value="{{ $defaultTripFare->cancellation_fee_percent ?? 0 }}"
                                                        class="form-control cancellation_fee_default">
											</td>
					                        @foreach($vehicleCategories as $vehicleCategory)
                                                @php($trip = $tripFares?->firstWhere('vehicle_category_id', $vehicleCategory->id))
                                                <td
                                                    class="{{ $vehicleCategory->id }} {{ $vehicleCategory->id == $trip?->vehicle_category_id ? '' : 'd-none' }}">
                                                    <input type="number" step=".01" min="0"
                                                        max="100"
                                                        name="cancellation_fee_{{ $vehicleCategory->id }}"
                                                        value="{{ $trip?->cancellation_fee_percent ? round($trip->cancellation_fee_percent, 2) : ($defaultTripFare->cancellation_fee_percent ?? 0) }}"
                                                        class="form-control cancellation_fee_default part-2-input {{ $vehicleCategory->id }}"
                                                        {{-- {{ $vehicleCategory->id == $trip?->vehicle_category_id ? '' : 'readonly' }} --}}>
                                                </td>
                                            @endforeach
										</tr>
										<tr>
											<td>
												<div class="d-flex align-items-center gap-2 font-semibold">
													<div class="text--title text-capitalize">
                                                        {{ translate('minimum_cancellation_fee') }}
                                                        ({{ session()->get('currency_symbol') ?? '$' }})
													</div>
													<i class="fi fi-sr-info fs-14" data-color="#14B19E" data-toggle="tooltip"
														title="{{ translate('Set_the_minimum_trip_cancellation_fee_here._If_the_user_cancels_the_trip_they_must_pay_this_fee') }}">
													</i>
												</div>
											</td>
											<td>
												<input readonly type="number"
                                                        value="{{ $defaultTripFare->min_cancellation_fee ?? 0 }}"
                                                        class="form-control min_cancellation_fee_default">
											</td>
				                            @foreach($vehicleCategories as $vehicleCategory)
                                                @php($trip = $tripFares?->where('vehicle_category_id', $vehicleCategory->id)->first())
                                                <td
                                                    class="{{ $vehicleCategory->id }} {{ $vehicleCategory->id == $trip?->vehicle_category_id ? '' : 'd-none' }}">
                                                    <input type="number" step=".01" min="0" max="99999999"
                                                        name="min_cancellation_fee_{{ $vehicleCategory->id }}"
                                                        value="{{ $trip?->min_cancellation_fee ? round($trip->min_cancellation_fee, 2) : ($defaultTripFare->min_cancellation_fee ?? 0) }}"
                                                        class="form-control min_cancellation_fee_default part-2-input {{ $vehicleCategory->id }}"
                                                        {{-- {{ $vehicleCategory->id == $trip?->vehicle_category_id ? '' : 'readonly' }} --}}>
                                                </td>
                                            @endforeach
										</tr>
										<tr>
											<td>
												<div class="d-flex align-items-center gap-2 font-semibold">
													<div class="text--title text-capitalize">
														{{ translate('idle_fee') }}
                                                        ({{ session()->get('currency_symbol') ?? '$' }})
													</div>
													<i class="fi fi-sr-info fs-14" data-color="#14B19E" data-toggle="tooltip"
														title="{{ translate('Set_the_idle_fee_(per_min)_here._If_the_driver_remains_idle_then_the_user_must_pay_this_fee') }}">

													</i>
												</div>
											</td>
											<td>
												<input readonly type="number"
                                                        value="{{ $defaultTripFare->idle_fee_per_min ?? 0 }}"
                                                        class="form-control idle_fee_default">
											</td>
				                            @foreach($vehicleCategories as $vehicleCategory)
                                                @php($trip = $tripFares?->where('vehicle_category_id', $vehicleCategory->id)->first())
                                                <td
                                                    class="{{ $vehicleCategory->id }} {{ $vehicleCategory->id == $trip?->vehicle_category_id ? '' : 'd-none' }}">
                                                    <input type="number" step=".01" min="0" max="99999999"
                                                        name="idle_fee_{{ $vehicleCategory->id }}"
                                                        value="{{ $trip?->idle_fee_per_min ? round($trip->idle_fee_per_min, 2) : ($defaultTripFare->idle_fee_per_min ?? 0) }}"
                                                        class="form-control idle_fee_default part-2-input {{ $vehicleCategory->id }}"
                                                        {{-- {{ $vehicleCategory->id == $trip?->vehicle_category_id ? '' : 'readonly' }} --}}>
                                                </td>
                                            @endforeach
										</tr>
										<tr>
											<td>
												<div class="d-flex align-items-center gap-2 font-semibold">
													<div class="text--title text-capitalize">
														{{ translate('Trip_Delay_Fee_(Per_min)') }}
													</div>
													<i class="fi fi-sr-info fs-14" data-color="#14B19E" data-toggle="tooltip"
														title="{{ translate('Set_the_idle_fee_(per_min)_here._If_the_driver_remains_idle_then_the_user_must_pay_this_fee') }}">

													</i>
												</div>
											</td>
											<td>
												<input readonly type="number"
                                                        value="{{ $defaultTripFare->ride_delay_fee_per_min ?? 0 }}"
                                                        class="form-control ride_delay_fee_default">
											</td>
				                            @foreach($vehicleCategories as $vehicleCategory)
                                                @php($trip = $tripFares?->where('vehicle_category_id', $vehicleCategory->id)->first())
                                                <td
                                                    class="{{ $vehicleCategory->id }} {{ $vehicleCategory->id == $trip?->vehicle_category_id ? '' : 'd-none' }}">
                                                    <input type="number" step=".01" min="0"
                                                        max="99999999"
                                                        name="ride_delay_fee_{{ $vehicleCategory->id }}"
                                                        value="{{ $trip?->ride_delay_fee_per_min ? round($trip->ride_delay_fee_per_min, 2) : ($defaultTripFare->ride_delay_fee_per_min ?? 0) }}"
                                                        class="form-control ride_delay_fee_default part-2-input {{ $vehicleCategory->id }}"
                                                        {{-- {{ $vehicleCategory->id == $trip?->vehicle_category_id ? '' : 'readonly' }} --}}>
                                                </td>
                                            @endforeach
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="btn--container justify-content-end mt-4">
				<button type="reset" class="btn btn--reset min-w-120px">{{ translate('messages.reset') }}</button>
				<button type="submit" class="btn btn--primary min-w-120px">{{ translate('messages.submit') }}</button>
			</div>
		</form>
	</div>
@endsection

@push('script_2')
    <script>
        "use strict";
        $(document).ready(function () {
            if ($("input[name='category_wise_different_fare']:checked").val() == 0) {
                $('#different-fare-div').addClass('d-none')
                $('#different-fare-div input').attr("disabled",true)
            } else {
                $('#different-fare-div').removeClass('d-none')
                $('#different-fare-div input').attr("disabled",false)
            }

            $('input[type="checkbox"]').click(function () {
                var inputValue = $(this).attr("value");
                if ($(this).is(":checked")) {
                    $("." + inputValue).removeClass('d-none');
                    $("." + inputValue).removeAttr('disabled');
                } else {
                    $("." + inputValue).addClass('d-none');
                    $("." + inputValue).attr('disabled', 'disabled');
                }
            });

        });

        $('.copy-value').on('change',function () {
            $('.' + $(this).attr('id') + '_default').val($(this).val());
        })
        $('.copy-value').keyup(function () {
            $('.' + $(this).attr('id') + '_default').val($(this).val());
        })

        $(".use_category_wise").click(function () {
            if ($(this).val() == 0) {
                $('#different-fare-div').addClass('d-none')
                $('#different-fare-div input').attr("disabled",true)

            } else if ($(this).val() == 1) {
                $('#different-fare-div').removeClass('d-none')
                $('#different-fare-div input').attr("disabled",false)
            }
        });
    </script>

    <script>

        const inputCustomElements = document.querySelectorAll('.custom-class-fare input[type="number"]');

        inputCustomElements.forEach(input => {
            input.addEventListener('input', function() {
                if (parseFloat(this.value) < 0) {
                    // this.value = 1;
                    toastr.error('{{ translate('the_value_must_greater_than_0') }}')
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('trip-store-form');
            const part1Inputs = Array.from(form.querySelectorAll('.part-1-input'));
            const part2Inputs = Array.from(form.querySelectorAll('.part-2-input'));
            form.addEventListener('submit', function(event) {
                if ($('input[type="checkbox"]:checked').length <= 0) {
                    event.preventDefault();
                    toastr.error('{{ translate('must_select_at_least_one_vehicle_category') }}')
                    return false;
                }
                const part1Filled = part1Inputs.some(input => input.value.trim() !== '');
                const part2Filled = part2Inputs.some(input => input.value.trim() !== '');

                if (!part1Filled && !part2Filled) {
                    event.preventDefault();
                    toastr.error(
                        '{{ translate('please_enter_vehicle_wise_or_category_wise_information') }}')
                }
            });
        });

        const inputDifferentElements = document.querySelectorAll('#different-fare-div input[type="number"]');

        inputDifferentElements.forEach(input => {
            input.addEventListener('input', function() {
                if (parseFloat(this.value) < 0) {
                    // this.value = 1;
                    toastr.error('{{ translate('the_value_must_greater_than_0') }}')
                }
            });
        });
    </script>
    <script>
        // Category wise table show / hide
        function toggleSwitcherState(checkbox) {
            const differentFareDiv = $('#different-fare-div');

            if (checkbox.checked) {
                differentFareDiv.addClass('show');
            } else {
                differentFareDiv.removeClass('show');
            }
            updateFooter();
        }

        document.addEventListener('DOMContentLoaded', function() {
            const useCategoryWiseCheckbox = document.getElementById('use_category_wise');
            toggleSwitcherState(useCategoryWiseCheckbox);
            updateFooter();
        });

        // ------ Footer Sticky
        function updateFooter() {
            const $footer = $('.footer-sticky');
            const scrollPosition = $(window).scrollTop() + $(window).height();
            const documentHeight = $(document).height();

            if (scrollPosition >= documentHeight - 5) {
                $footer.addClass('no-shadow');
            } else {
                $footer.removeClass('no-shadow');
            }
        }

        $(window).on('scroll resize', updateFooter);
    </script>
@endpush
