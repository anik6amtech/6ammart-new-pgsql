<?php
use Illuminate\Support\Facades\Route;
use Modules\RideShare\Http\Controllers\Api\BusinessManagement\Rider\ConfigController;
use Modules\RideShare\Http\Controllers\Api\ReviewModule\ReviewController;
use Modules\RideShare\Http\Controllers\Api\TransactionManagement\Rider\DriverTransactionController;
use Modules\RideShare\Http\Controllers\Api\TripManagement\Rider\TripRequestController;
use Modules\RideShare\Http\Controllers\Api\TripManagement\Customer\TripRequestController as CustomerTripRequestController;
use Modules\RideShare\Http\Controllers\Api\TripManagement\PaymentController;
use Modules\RideShare\Http\Controllers\Api\TripManagement\Rider\SafetyAlertController;
use Modules\RideShare\Http\Controllers\Api\UserManagement\Rider\DriverActivityController;
use Modules\RideShare\Http\Controllers\Api\UserManagement\Rider\DriverController;
use Modules\RideShare\Http\Controllers\Api\UserManagement\Rider\DriverLevelController;
use Modules\RideShare\Http\Controllers\Api\UserManagement\Rider\LoyaltyPointController;
use Modules\RideShare\Http\Controllers\Api\UserManagement\Rider\TimeTrackController;
use Modules\RideShare\Http\Controllers\Api\VehicleManagement\Rider\VehicleBrandController;
use Modules\RideShare\Http\Controllers\Api\VehicleManagement\Rider\VehicleCategoryController;
use Modules\RideShare\Http\Controllers\Api\VehicleManagement\Rider\VehicleController;
use Modules\RideShare\Http\Controllers\Api\VehicleManagement\Rider\VehicleModelController;

Route::group(['middleware'=>'localization'], function () {
    Route::group(['middleware'=>['dm.api']], function(){

        //rider routes start
        Route::get('my-activity', [DriverController::class, 'myActivity']);
        Route::get('level', [DriverLevelController::class, 'getDriverLevelWithTrip']);
        Route::get('income-statement', [DriverController::class, 'incomeStatement']);
        Route::get('referral-details', [DriverController::class, 'referralDetails']);
        //rider routes end
        
        //ride routes start
        Route::group(['prefix' => 'ride'], function() {
            Route::get('show-ride-details', [TripRequestController::class, 'showRideDetails']);
            Route::get('all-ride-list', [TripRequestController::class, 'allRideList']);
            Route::put('ride-waiting', [TripRequestController::class, 'rideWaiting']);
            Route::get('list', [TripRequestController::class, 'rideList']);
            Route::put('arrival-time', [TripRequestController::class, 'arrivalTime']);
            Route::put('coordinate-arrival', [TripRequestController::class, 'coordinateArrival']);
            Route::get('ongoing-parcel-list', [TripRequestController::class, 'pendingParcelList']);
            Route::get('unpaid-parcel-list', [TripRequestController::class, 'unpaidParcelRequest']);
            Route::put('resend-otp', [TripRequestController::class, 'resendOtp']);
            Route::post('match-otp', [TripRequestController::class, 'matchOtp']);
            Route::post('track-location', [TripRequestController::class, 'trackLocation']);
            Route::get('details/{ride_request_id}', [TripRequestController::class, 'rideDetails']);
            Route::get('pending-ride-list', [TripRequestController::class, 'pendingRideList']);
            Route::put('returned-parcel', [TripRequestController::class, 'returnedParcel']);
            Route::get('overview', [TripRequestController::class, 'tripOverview']);
            Route::post('ignore-trip-notification', [TripRequestController::class, 'ignoreTripNotification']);
            Route::put('update-status', [TripRequestController::class, 'rideStatusUpdate']);
            Route::post('trip-action', [TripRequestController::class, 'requestAction']);
            Route::post('bid', [TripRequestController::class, 'bid']);

            Route::get('last-ride-details', [TripRequestController::class, 'lastRideDetails']);
            Route::post('store-screenshot', [TripRequestController::class, 'storeScreenshot']);
            Route::post('get-routes', [TripRequestController::class, 'getRoutes']);

            Route::get('final-fare', [CustomerTripRequestController::class, 'finalFareCalculation']);

            Route::get('payment', [PaymentController::class, 'payment']);
        });
        //ride routes end

        Route::controller(TimeTrackController::class)->group(function () {
            Route::get('time-tracking', 'store');
            Route::post('update-online-status', 'onlineStatus');
        });

         Route::group(['prefix' => 'activity'], function () {
            Route::controller(DriverActivityController::class)->group(function () {
                Route::get('leaderboard', 'leaderboard');
                Route::get('daily-income', 'dailyIncome');
            });
        });

        //safety alert routes start
        Route::group(['prefix' => 'safety-alert'], function () {
            Route::controller(SafetyAlertController::class)->group(function () {
                Route::post('store', 'storeSafetyAlert');
                Route::put('resend/{trip_request_id}', 'resendSafetyAlert');
                Route::put('mark-as-solved/{trip_request_id}', 'markAsSolvedSafetyAlert');
                Route::get('show/{trip_request_id}', 'showSafetyAlert');
                Route::delete('undo/{trip_request_id}', 'deleteSafetyAlert');
            });
        });
        //safety alert routes end

        //vehicle routes start
        Route::group(['prefix' => 'vehicle'], function () {
            Route::post('store', [VehicleController::class, 'store']);
            Route::post('update/{id}', [VehicleController::class, 'update']);
            
            Route::get('category/list', [VehicleCategoryController::class, 'list']);
            Route::get('brand/list', [VehicleBrandController::class, 'brandList']);
            Route::get('model/list', [VehicleModelController::class, 'modelList']);
        });
        //vehicle routes end

        //config routes start
        Route::group(['prefix' => 'config'], function () {
            Route::get('cancellation-reason-list', [ConfigController::class, 'cancellationReasonList']);
            Route::get('safety-alert-reason-list', [ConfigController::class, 'safetyAlertReasonList']);
            Route::get('safety-precaution-list', [ConfigController::class, 'safetyPrecautionList']);
            Route::get('other-emergency-contact-list', [ConfigController::class, 'otherEmergencyContactList']);
            Route::get('get-zone-id', [ConfigController::class, 'getZone']);
        });
        //config routes end

        //review routes start
        Route::prefix('review')->group(function () {
            Route::get('list', [ReviewController::class, 'index']);
            Route::post('store', [ReviewController::class, 'store']);
            Route::put('save/{id}', [ReviewController::class, 'save']);
        });
        //review routes end

        //loyalty point routes start
        Route::group(['prefix' => 'loyalty-points'], function () {
            Route::controller(LoyaltyPointController::class)->group(function () {
                Route::get('list', 'index');
                Route::post('convert', 'convert');
            });
        });
        //loyalty point routes end

        Route::group(['prefix' => 'transaction'], function () {

            Route::controller(DriverTransactionController::class)->group(function () {
                Route::get('list', 'list');
                Route::get('referral-earning-list', 'referralEarningHistory');
                Route::get('payable-list', 'payableTransactionHistory');
                Route::get('cash-collect-list', 'cashCollectTransactionHistory');
                Route::get('wallet-list', 'walletTransactionHistory');
            });
        });
    });
});