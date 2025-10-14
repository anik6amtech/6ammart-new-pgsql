<?php
namespace Modules\RideShare;
use Illuminate\Support\Facades\Route;
use Modules\RideShare\Http\Controllers\Api\BusinessManagement\Customer\ConfigController;
use Modules\RideShare\Http\Controllers\Api\PromotionManagement\Customer\BannerSetupController;
use Modules\RideShare\Http\Controllers\Api\PromotionManagement\Customer\CouponSetupController;
use Modules\RideShare\Http\Controllers\Api\PromotionManagement\Customer\DiscountSetupController;
use Modules\RideShare\Http\Controllers\Api\ReviewModule\ReviewController;
use Modules\RideShare\Http\Controllers\Api\TripManagement\Customer\SafetyAlertController;
use Modules\RideShare\Http\Controllers\Api\TripManagement\Customer\TripRequestController;
use Modules\RideShare\Http\Controllers\Api\TripManagement\PaymentController;
use Modules\RideShare\Http\Controllers\Api\UserManagement\User\LocationController;
use Modules\RideShare\Http\Controllers\Api\VehicleManagement\Customer\VehicleCategoryController;

Route::group(['middleware'=>'localization'], function () {
    Route::group(['middleware'=>['module-check']], function(){
        Route::group(['prefix' => 'customer'], function (){
            Route::group(['prefix' => 'banner'], function(){
                Route::controller(BannerSetupController::class)->group(function () {
                    Route::get('list', 'list');
                Route::post('update-redirection-count', 'RedirectionCount');
                });

            });
            Route::group(['prefix' => 'coupon', 'middleware' => ['auth:api']], function(){
                Route::controller(CouponSetupController::class)->group(function () {
                    Route::get('list', 'list');
                    Route::post('apply', 'apply');
                });
            });
            Route::group(['prefix' => 'discount', 'middleware' => ['auth:api']], function(){
                Route::controller(DiscountSetupController::class)->group(function () {
                    Route::get('list', 'list');
                });
            });
            Route::group(['prefix' => 'vehicle'], function () {//, 'middleware' => ['auth:api']
                Route::group(['prefix' => 'category'], function () {
                    Route::controller(VehicleCategoryController::class)->group(function () {
                        Route::get('/', 'categoryFareList');
                    });
                });
            });
            Route::group(['middleware' => ['auth:api']], function () {
                Route::get('drivers-near-me', [TripRequestController::class, 'driversNearMe'])->withoutMiddleware(['auth:api']);
                Route::group(['prefix' => 'ride'], function () {
                    Route::controller(TripRequestController::class)->group(function () {
                        Route::post('get-estimated-fare', 'getEstimatedFare');
                        Route::post('create', 'createRideRequest');
                        Route::put('ignore-bidding', 'ignoreBidding');
                        Route::get('bidding-list/{ride_request_id}', 'biddingList');
                        Route::put('update-status/{ride_request_id}', 'rideStatusUpdate');
                        Route::get('details/{ride_request_id}', 'rideDetails');
                        Route::get('list', 'rideList');
                        Route::get('list-{status}', 'filteredRideList')->withoutMiddleware(['module-check']);
                        Route::get('final-fare', 'finalFareCalculation');
                        Route::post('trip-action', 'requestAction');
                        Route::get('ride-resume-status', 'rideResumeStatus');
                        Route::put('arrival-time', 'arrivalTime');
                        Route::put('coordinate-arrival', 'coordinateArrival');
                    });
                    Route::post('track-location', [TripRequestController::class, 'trackLocation']);
                    Route::get('payment', [PaymentController::class, 'payment']);
                    Route::get('digital-payment', [PaymentController::class, 'digitalPayment'])->withoutMiddleware(['auth:api','module-check']);
                });

                Route::group(['prefix' => 'safety-alert'], function () {
                    Route::controller(SafetyAlertController::class)->group(function () {
                        Route::post('store', 'storeSafetyAlert');
                        Route::put('resend/{ride_request_id}', 'resendSafetyAlert');
                        Route::put('mark-as-solved/{ride_request_id}', 'markAsSolvedSafetyAlert');
                        Route::get('show/{ride_request_id}', 'showSafetyAlert');
                        Route::delete('undo/{ride_request_id}', 'deleteSafetyAlert');
                    });
                });
            });

            Route::group(['prefix' => 'review', 'middleware' => ['auth:api']], function () {
                Route::controller(ReviewController::class)->group(function () {
                    Route::get('list', 'index');
                    Route::post('store', 'store');
                    Route::put('check-submission', 'checkSubmission');
                });
            });
        });
    });
    Route::group(['prefix' => 'customer'], function () {
    Route::controller(ConfigController::class)->group(function () {
            // Route::get('configuration', 'configuration');
            // Route::get('pages/{page_name}', 'pages');
            Route::group(['prefix' => 'config'], function () {
                Route::get('get-zone-id', 'getZone');
                Route::get('place-api-autocomplete', 'placeApiAutocomplete');
                Route::get('distance-api', 'distanceApi');
                Route::get('place-api-details', 'placeApiDetails');
                Route::get('geocode-api', 'geocodeApi');
                Route::post('get-routes', 'getRoutes');
                // Route::get('get-payment-methods', 'getPaymentMethods');
                Route::get('cancellation-reason-list', 'cancellationReasonList');
                Route::get('other-emergency-contact-list', 'otherEmergencyContactList');
                Route::get('safety-alert-reason-list', 'safetyAlertReasonList');
                Route::get('safety-precaution-list', 'safetyPrecautionList');
            });
        });
    });
});
Route::group(['prefix' => 'user'], function () {
    Route::controller(LocationController::class)->group(function () {
        Route::post('store-live-location', 'storeLastLocation');
        Route::post('get-live-location', 'getLastLocation');
    });

});