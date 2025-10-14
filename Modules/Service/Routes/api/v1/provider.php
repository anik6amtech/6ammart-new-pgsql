<?php

use Illuminate\Support\Facades\Route;
use Modules\Service\Http\Controllers\Api\Provider\Auth\LoginController;
use Modules\Service\Http\Controllers\Api\Provider\Auth\ProviderPasswordResetController;
use Modules\Service\Http\Controllers\Api\Provider\BidModule\PostBidController;
use Modules\Service\Http\Controllers\Api\Provider\BidModule\PostController;
use Modules\Service\Http\Controllers\Api\Provider\BookingModule\BookingController;
use Modules\Service\Http\Controllers\Api\Provider\BusinessSettingsModule\BusinessInformationController;
use Modules\Service\Http\Controllers\Api\Provider\BusinessSettingsModule\ConfigurationController;
use Modules\Service\Http\Controllers\Api\Provider\CategoryManagement\CategoryController;
use Modules\Service\Http\Controllers\Api\Provider\ChattingModule\ConversationController;
use Modules\Service\Http\Controllers\Api\Provider\PromotionManagement\AdvertisementsController;
use Modules\Service\Http\Controllers\Api\Provider\ProviderModule\AccountController;
use Modules\Service\Http\Controllers\Api\Provider\ProviderModule\ProviderController;
use Modules\Service\Http\Controllers\Api\Provider\ProviderModule\TimeScheduleController;
use Modules\Service\Http\Controllers\Api\Provider\ProviderModule\WithdrawController;
use Modules\Service\Http\Controllers\Api\Provider\Report\BookingReportController;
use Modules\Service\Http\Controllers\Api\Provider\Report\BusinessReportController;
use Modules\Service\Http\Controllers\Api\Provider\Report\TransactionReportController;
use Modules\Service\Http\Controllers\Api\Provider\ReviewModule\ReviewController;
use Modules\Service\Http\Controllers\Api\Provider\ServiceManagement\FAQController;
use Modules\Service\Http\Controllers\Api\Provider\ServiceManagement\ServiceController;
use Modules\Service\Http\Controllers\Api\Provider\ServiceManagement\ServiceRequestController;
use Modules\Service\Http\Controllers\Api\Provider\ServiceManManagement\ServiceManController;
use Modules\Service\Http\Controllers\Api\Provider\SubscriptionModule\SubscriptionController;

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
        Route::post('registration', [LoginController::class, 'register']);
        Route::post('login', [LoginController::class, 'login']);
    });

    Route::post('forgot-password', [ProviderPasswordResetController::class, 'reset_password_request']);
    Route::post('verify-token', [ProviderPasswordResetController::class, 'verify_token']);
    Route::post('firebase-verify-token', [ProviderPasswordResetController::class, 'firebase_auth_verify']);
    Route::put('reset-password', [ProviderPasswordResetController::class, 'reset_password_submit']);

    Route::put('update-fcm-token', [ProviderController::class, 'update_fcm_token'])->middleware('service.provider.token');

    Route::group(['middleware'=>['module-check']], function(){
        Route::group(['middleware' => 'service.provider.token'], function () {

            Route::get('dashboard', [ProviderController::class, 'dashboard']);
            Route::put('update/profile', [ProviderController::class, 'updateProfile']);
            Route::put('update-password', [ProviderController::class, 'resetPassword']);
            Route::get('subscribed/sub-categories', [ProviderController::class, 'subscribedSubCategories']);
            Route::get('adjust', [ProviderController::class, 'adjust']);
            Route::get('transaction', [ProviderController::class, 'transaction']);
            Route::get('review', [ProviderController::class, 'review']);
            Route::get('notifications', [ProviderController::class, 'notifications']);
            Route::delete('delete', [ProviderController::class, 'deleteProvider']);

            Route::post('schedule/store', [TimeScheduleController::class, 'add_schedule']);
            Route::delete('schedule/remove/{store_schedule}', [TimeScheduleController::class, 'remove_schedule']);


            Route::group(['prefix' => 'account', 'as' => 'account.'], function () {
                Route::get('overview', [AccountController::class, 'overview']);
                Route::get('account-edit', [AccountController::class, 'accountEdit']);
                Route::put('account-update', [AccountController::class, 'accountUpdate']);
                Route::get('commission-info', [AccountController::class, 'commissionInfo']);
            });

            Route::group(['prefix' => 'serviceman'], function () {
                Route::get('/', [ServicemanController::class, 'index']);
                Route::post('/', [ServicemanController::class, 'store']);
                Route::get('{id}/edit', [ServicemanController::class, 'edit']);
                Route::post('{id}', [ServicemanController::class, 'update']);
                Route::get('{id}', [ServicemanController::class, 'show']);

                Route::delete('delete', [ServicemanController::class, 'destroy']);
                Route::post('status/update', [ServicemanController::class, 'changeActiveStatus']);
            });

            Route::group(['prefix' => 'post'], function () {
                Route::get('/', [PostController::class, 'index']);
                Route::get('details/{id}', [PostController::class, 'show']);
                Route::post('/', [PostController::class, 'decline']);

                Route::group(['prefix' => 'bid'], function () {
                    Route::get('/', [PostBidController::class, 'index']);
                    Route::post('/', [PostBidController::class, 'store']);
                    Route::post('/withdraw', [PostBidController::class, 'withdraw']);
                });
            });

            Route::group(['prefix' => 'booking', 'as' => 'booking.'], function () {
                Route::post('/', [BookingController::class, 'index']);
                Route::get('{id}', [BookingController::class, 'show']);
                Route::get('single/{id}', [BookingController::class, 'singleDetails']);
                Route::put('request-accept/{booking_id}', [BookingController::class, 'requestAccept']);
                Route::post('request-ignore/{booking_id}', [BookingController::class, 'requestIgnore']);
                Route::post('single-repeat-cancel/{repeat_id}', [BookingController::class, 'singleBookingCancel']);
                Route::put('single-repeat-status-update/{repeat_id}', [BookingController::class, 'singleBookingStatusUpdate']);
                Route::put('status-update/{booking_id}', [BookingController::class, 'statusUpdate']);
                Route::put('schedule-update/{booking_id}', [BookingController::class, 'scheduleUpdate']);
                Route::put('assign-serviceman/{booking_id}', [BookingController::class, 'assignServiceman']);
                Route::get('data/download', [BookingController::class, 'download']);

                Route::get('opt/notification-send', [BookingController::class, 'notificationSend']);

                Route::get('service/info', [BookingController::class, 'getServiceInfo']);
                Route::put('service/edit/update-booking', [BookingController::class, 'updateBooking']);
                Route::put('repeat/service/edit/update-booking', [BookingController::class, 'updateBookingRepeat']);
                Route::put('service/edit/remove-service', [BookingController::class, 'removeService']);
                Route::post('change-service-location', [BookingController::class, 'changeServiceLocation']);
            });

            Route::group(['prefix' => 'category', 'as'=>'category.'], function () {
                Route::get('/', [CategoryController::class, 'index']);
                Route::get('childes', [CategoryController::class, 'childes']);
                Route::get('sub-categories', [CategoryController::class, 'subCategory']);
            });

            Route::group(['prefix' => 'service', 'as'=>'service.'], function () {
                Route::get('/', [ServiceController::class, 'index']);
                Route::get('{id}', [ServiceController::class, 'show'])->where('id', '[0-9]+');
                Route::get('data/search', [ServiceController::class, 'search']);
                Route::put('status/update', [ServiceController::class, 'statusUpdate']);
                Route::get('review/{service_id}', [ServiceController::class, 'review']);
                Route::post('review-reply', [ServiceController::class, 'reviewReply']);
                Route::get('data/sub-category-wise', [ServiceController::class, 'servicesBySubcategory']);

                Route::post('update-subscription', [ServiceController::class, 'updateSubscription']);

                Route::get('request', [ServiceRequestController::class, 'index']);
                Route::post('request', [ServiceRequestController::class, 'makeRequest']);
            });

            Route::group(['prefix' => 'faq', 'as'=>'faq.'], function () {
                Route::get('/', [FAQController::class, 'index']);
                Route::get('{id}', [FAQController::class, 'show']);
            });

            // Chatting
            Route::group(['prefix' => 'message', 'as'=>'message.'], function () {
                Route::get('list', [ConversationController::class, 'conversations']);
                Route::get('search-list', [ConversationController::class, 'search_conversations']);
                Route::get('details', [ConversationController::class, 'messages']);
                Route::post('send', [ConversationController::class, 'messages_store']);
            });

            Route::prefix('advertisements')->group(function () {
                Route::get('ads-list', [AdvertisementsController::class, 'AdsList']);
                Route::post('ads-store', [AdvertisementsController::class, 'AdsStore']);
                Route::get('details/{id}', [AdvertisementsController::class, 'details']);
                Route::get('edit/{id}', [AdvertisementsController::class, 'edit']);
                Route::post('update/{id}', [AdvertisementsController::class, 'update']);
                Route::any('status-update/{id}', [AdvertisementsController::class, 'statusUpdate']);
                Route::delete('delete/{id}', [AdvertisementsController::class, 'destroy']);
                Route::post('store-re-submit/{id}', [AdvertisementsController::class, 'storeReSubmit']);
            });

            Route::group(['prefix' => 'review'], function () {
                Route::get('list', [ReviewController::class, 'index']);
                Route::post('review-reply', [ReviewController::class, 'reviewReply']);
                Route::get('service/review/{service_id}', [ReviewController::class, 'serviceReview']);
                Route::get('data/search', [ReviewController::class, 'search']);
            });

            Route::group(['prefix' => 'withdraw'], function () {
                Route::get('/', [WithdrawController::class, 'index']);
                Route::post('/', [WithdrawController::class, 'store']);
                Route::get('methods', [WithdrawController::class, 'getMethods']);
            });

            //REPORT
            Route::group(['prefix' => 'report', 'namespace' => 'Report'], function () {
                //Transaction Report
                Route::post('transaction', [TransactionReportController::class, 'getTransactionReport']);
                Route::post('transaction/download', [TransactionReportController::class, 'downloadTransactionReport']);

                //Booking Report
                Route::post('booking', [BookingReportController::class, 'getBookingReport']);
                Route::post('booking/download', [BookingReportController::class, 'getBookingReportDownload']);

                //Business Report
                Route::group(['prefix' => 'business', 'as' => 'business.'], function () {
                    Route::post('overview', [BusinessReportController::class, 'getBusinessOverviewReport']);
                    Route::post('earning', [BusinessReportController::class, 'getBusinessEarningReport']);
                    Route::post('expense', [BusinessReportController::class, 'getBusinessExpenseReport']);
                });
            });

            Route::group(['prefix' => 'configuration', 'as' => 'configuration.'], function () {
                Route::get('get-notification-setting',  [ConfigurationController::class, 'notificationSettingsGet']);
                Route::post('update-notification-status',  [ConfigurationController::class, 'updateStatus']);
            });

            Route::group(['prefix' => 'subscription'], function () {
                Route::get('transactions', [SubscriptionController::class, 'transaction']);
            });

            Route::group(['prefix' => 'business-settings'], function () {
                Route::get('get-business-settings', [BusinessInformationController::class, 'businessSettingsGet']);
                Route::put('set-business-settings', [BusinessInformationController::class, 'businessSettingsSet']);
            });
        });
    });
    Route::group(['prefix' => 'subscription'], function () {
        Route::get('package-view', [SubscriptionController::class, 'package_view']);
        Route::post('business_plan', [SubscriptionController::class, 'business_plan']);
        Route::post('cancel-subscription', [SubscriptionController::class, 'cancelSubscription']);
        Route::get('check-product-limits', [SubscriptionController::class, 'checkProductLimits']);
    });
});

Route::get('zones', 'PublicZoneController@index');
