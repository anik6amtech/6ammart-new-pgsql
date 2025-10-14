<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Service\Http\Controllers\Api\ServiceMan\Auth\LoginController;
use Modules\Service\Http\Controllers\Api\ServiceMan\Auth\SMPasswordResetController;
use Modules\Service\Http\Controllers\Api\ServiceMan\BookingModule\BookingController;
use Modules\Service\Http\Controllers\Api\ServiceMan\ChattingModule\ConversationController;
use Modules\Service\Http\Controllers\Api\ServiceMan\ServiceManagement\ServiceController;
use Modules\Service\Http\Controllers\Api\ServiceMan\ServiceManManagement\ServicemanController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware'=>'localization'], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', [LoginController::class, 'login']);
    });

    Route::post('forgot-password', [SMPasswordResetController::class, 'reset_password_request']);
    Route::post('verify-token', [SMPasswordResetController::class, 'verify_token']);
    Route::post('firebase-verify-token', [SMPasswordResetController::class, 'firebase_auth_verify']);
    Route::put('reset-password', [SMPasswordResetController::class, 'reset_password_submit']);

    Route::put('update-fcm-token', [ServicemanController::class, 'update_fcm_token'])->middleware('service.serviceman.token');

    Route::group(['middleware'=>['module-check']], function(){

        Route::group(['middleware' => 'service.serviceman.token'], function () {
            Route::get('dashboard', [ServicemanController::class, 'dashboard']);
            Route::get('info', [ServicemanController::class, 'index']);
            Route::post('update/profile', [ServicemanController::class, 'updateProfile']);
            Route::put('update/fcm-token', [ServicemanController::class, 'updateFcmToken']);
            Route::get('notifications', [ServicemanController::class, 'pushNotifications']);

            Route::get('service/data/sub-category-wise', [ServiceController::class, 'servicesBySubcategory']);

            Route::group(['prefix' => 'booking', 'as' => 'booking.'], function () {
                Route::put('status-update/{booking_id}', [BookingController::class, 'statusUpdate']);
                Route::put('single-repeat-status-update/{booking_id}', [BookingController::class, 'singleBookingStatusUpdate']);
                Route::put('payment-status-update/{booking_id}', [BookingController::class, 'paymentStatusUpdate']);

                Route::get('list', [BookingController::class, 'bookingList']);
                Route::get('detail/{id}', [BookingController::class, 'bookingDetails']);
                Route::get('single/detail/{id}', [BookingController::class, 'singleBookingDetails']);

                Route::get('opt/notification-send', [BookingController::class, 'notificationSend']);

                Route::get('service/info', [BookingController::class, 'getServiceInfo']);
                Route::put('service/edit/update-booking', [BookingController::class, 'updateBooking']);
                Route::put('repeat/service/edit/update-booking', [BookingController::class, 'updateBookingRepeat']);
                Route::put('service/edit/remove-service', [BookingController::class, 'removeService']);
            });

            // Chatting
            Route::group(['prefix' => 'message'], function () {
                Route::get('list', [ConversationController::class, 'conversations']);
                Route::get('search-list', [ConversationController::class, 'search_conversations']);
                Route::get('details', [ConversationController::class, 'messages']);
                Route::post('send', [ConversationController::class, 'messages_store']);
            });

        });
    });
});
