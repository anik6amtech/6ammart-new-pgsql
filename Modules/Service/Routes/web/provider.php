<?php


use Illuminate\Support\Facades\Route;

use Modules\Service\Http\Controllers\Web\Provider\BidModule\PostController;
use Modules\Service\Http\Controllers\Web\Provider\BookingModule\BookingController;
use Modules\Service\Http\Controllers\Web\Provider\BusinessManagement\BusinessSettingsController;
use Modules\Service\Http\Controllers\Web\Provider\ChattingModule\ConversationController;
use Modules\Service\Http\Controllers\Web\Provider\DashboardController;
use Modules\Service\Http\Controllers\Web\Provider\EmployeeManagement\CustomRoleController;
use Modules\Service\Http\Controllers\Web\Provider\EmployeeManagement\EmployeeController;
use Modules\Service\Http\Controllers\Web\Provider\PromotionManagement\AdvertisementController;
use Modules\Service\Http\Controllers\Web\Provider\ProviderManagement\NotificationController;
use Modules\Service\Http\Controllers\Web\Provider\ProviderManagement\ProviderController;
use Modules\Service\Http\Controllers\Web\Provider\ProviderManagement\SubscriptionController;
use Modules\Service\Http\Controllers\Web\Provider\ProviderManagement\SubscriptionPackageController;
use Modules\Service\Http\Controllers\Web\Provider\Report\BookingReportController;
use Modules\Service\Http\Controllers\Web\Provider\Report\Business\EarningReportController;
use Modules\Service\Http\Controllers\Web\Provider\Report\Business\ExpenseReportController;
use Modules\Service\Http\Controllers\Web\Provider\Report\Business\OverviewReportController;
use Modules\Service\Http\Controllers\Web\Provider\Report\TransactionReportController;
use Modules\Service\Http\Controllers\Web\Provider\SearchRoutingController;
use Modules\Service\Http\Controllers\Web\Provider\ServiceManagement\ServiceController;
use Modules\Service\Http\Controllers\Web\Provider\UserManagement\ServicemanController;
use Modules\Service\Http\Controllers\Web\Provider\WalletController;
use Modules\Service\Http\Controllers\Web\Provider\WalletMethodController;
use Modules\Service\Http\Controllers\Web\Provider\WithdrawController;

Route::group(['middleware' => ['current-module', 'multi_auth:provider,provider_employee']], function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('update-dashboard-earning-graph', [DashboardController::class, 'updateDashboardEarningGraph'])->name('update-dashboard-earning-graph');

    //provider schedule
    Route::post('add-schedule', [ProviderController::class, 'add_schedule'])->name('add-schedule')->middleware('module:business');
    Route::get('remove-schedule/{store_schedule}', [ProviderController::class, 'remove_schedule'])->name('remove-schedule')->middleware('module:business');

    Route::group(['as' => 'service.'], function () {

        Route::group(['prefix' => 'booking', 'as' => 'booking.', 'middleware' => ['module:booking']], function () {
            Route::any('list', [BookingController::class, 'index'])->name('list');
            Route::get('check', [BookingController::class, 'checkBooking'])->name('check');
            Route::get('details/{id}', [BookingController::class, 'details'])->name('details');
            Route::get('repeat-details/{id}', [BookingController::class, 'repeatDetails'])->name('repeat_details');
            Route::get('repeat-single-details/{id}', [BookingController::class, 'repeatSingleDetails'])->name('repeat_single_details');
            Route::get('request-accept/{booking_id}', [BookingController::class, 'requestAccept'])->name('accept');
            Route::get('request-ignore/{booking_id}', [BookingController::class, 'requestIgnore'])->name('ignore');
            Route::any('status-update/{id}', [BookingController::class, 'statusUpdate'])->name('status_update');
            Route::any('payment-update/{id}', [BookingController::class, 'paymentUpdate'])->name('payment_update');
            Route::any('schedule-update/{id}', [BookingController::class, 'scheduleUpdate'])->name('schedule_update');
            Route::put('serviceman-update/{id}', [BookingController::class, 'servicemanUpdate'])->name('serviceman_update');
            Route::put('service-address-update/{id}', [BookingController::class, 'serviceAddressUpdate'])->name('service_address_update');
            Route::get('up-coming-booking-cancel/{id}', [BookingController::class, 'upComingBookingCancel'])->name('up_coming_booking_cancel');
            Route::any('up-coming-booking-schedule-update/{id}', [BookingController::class, 'upComingBookingScheduleUpdate'])->name('up_coming_booking_schedule_update');
            Route::any('download', [BookingController::class, 'download'])->name('download');
            Route::any('invoice/{id}', [BookingController::class, 'invoice'])->name('invoice');
            Route::any('single-repeat-invoice/{id}', [BookingController::class, 'fullBookingSingleInvoice'])->name('single_invoice');
            Route::any('full-repeat-invoice/{id}', [BookingController::class, 'fullBookingInvoice'])->name('full_repeat_invoice');
            Route::post('evidence-photos-upload/{id}', [BookingController::class, 'evidencePhotosUpload'])->name('evidence_photos_upload');
            Route::get('otp/resend', [BookingController::class, 'resendOtp'])->name('otp.resend');

            Route::group(['prefix' => 'service', 'as' => 'service.'], function () {
                Route::put('update-booking-service', [BookingController::class, 'updateBookingService'])->name('update_booking_service');
                Route::put('update-repeat-booking-service', [BookingController::class, 'updateRepeatBookingService'])->name('update_repeat_booking_service');
                Route::get('ajax-get-service-info', [BookingController::class, 'ajaxGetServiceInfo'])->name('ajax-get-service-info');
                Route::get('ajax-get-variation', [BookingController::class, 'ajaxGetVariant'])->name('ajax-get-variant');
            });

            Route::group(['prefix' => 'post', 'as' => 'post.','middleware' => 'service_subscription:bidding'], function () {
                Route::any('/', [PostController::class, 'index'])->name('list');
                Route::any('export', [PostController::class, 'export'])->name('export');
                Route::any('details/{id}', [PostController::class, 'details'])->name('details');
                Route::any('update-status/{id}', [PostController::class, 'updateStatus'])->name('update_status');
                Route::post('multi-ignore', [PostController::class, 'multiIgnore'])->name('multi-ignore');
                Route::any('withdraw/{id}', [PostController::class, 'withdraw'])->name('withdraw');

                Route::any('check-all', [PostController::class, 'check_all'])->name('check_all');
            });

            Route::post('change-service-location/{id}', [BookingController::class, 'changeServiceLocation'])->name('change-service-location');
            Route::post('repeat-change-service-location/{id}', [BookingController::class, 'repeatChangeServiceLocation'])->name('repeat.change-service-location');

        });

        Route::group(['prefix' => 'serviceman', 'as' => 'serviceman.', 'middleware' => ['module:user']], function () {
            Route::get('/', [ServicemanController::class, 'index'])->name('index');
            Route::get('create', [ServicemanController::class, 'create'])->name('create');
            Route::post('store', [ServicemanController::class, 'store'])->name('store');
            Route::get('edit/{id}', [ServicemanController::class, 'edit'])->name('edit');
            Route::put('update/{id}', [ServicemanController::class, 'update'])->name('update');
            Route::delete('delete/{id}', [ServicemanController::class, 'destroy'])->name('delete');
            Route::any('status-update/{id}', [ServicemanController::class, 'statusUpdate'])->name('status_update');
            Route::any('details/{id}', [ServicemanController::class, 'details'])->name('details');
            Route::any('download', [ServicemanController::class, 'download'])->name('download');
        });


        Route::group(['namespace' => 'PromotionManagement'], function () {

            Route::group([ 'prefix' => 'advertisement', 'as' => 'advertisement.', 'middleware' => ['module:promotion','service_subscription:advertisement']], function () {

                Route::get('/', [AdvertisementController::class, 'index'])->name('index');
                Route::get('create/', [AdvertisementController::class, 'create'])->name('create');
                Route::get('details/{advertisement}', [AdvertisementController::class, 'show'])->name('show');
                Route::get('{advertisement}/edit', [AdvertisementController::class, 'edit'])->name('edit');
                Route::post('store', [AdvertisementController::class, 'store'])->name('store');
                Route::put('update/{advertisement}', [AdvertisementController::class, 'update'])->name('update');
                Route::delete('delete/{id}', [AdvertisementController::class, 'destroy'])->name('destroy');
                Route::get('status', [AdvertisementController::class, 'status'])->name('status');
            });
        });

        Route::group(['prefix' => 'service', 'as' => 'service.', 'middleware' => ['module:service']], function () {
            Route::get('subscribed', [ServiceController::class, 'subscribedSubCategories'])->name('subscribed');
            Route::get('available', [ServiceController::class, 'index'])->name('available');
            Route::get('request-list', [ServiceController::class, 'requestList'])->name('request-list')->middleware('service_subscription:service_request');
            Route::post('request-list', [ServiceController::class, 'storeRequest']);
            Route::put('update-subscription', [ServiceController::class, 'updateSubscription'])->name('update-subscription');
            Route::any('detail/{id}', [ServiceController::class, 'show'])->name('service-details');
            Route::post('review-reply', [ServiceController::class, 'reviewReply'])->name('review.reply');
            Route::any('reviews/download', [ServiceController::class, 'reviewsDownload'])->name('reviews.download');

            Route::any('export', [ServiceController::class, 'export'])->name('export');
        });

        Route::group(['prefix' => 'subscription' , 'as' => 'subscriptionackage.', 'middleware' => ['module:business']], function () {
            Route::get('/subscriber-detail',  [SubscriptionController::class, 'subscriberDetail'])->name('subscriberDetail');

            Route::get('/invoice/{id}',  [SubscriptionController::class, 'invoice'])->name('invoice');
            Route::get('/subscriber-list',  [SubscriptionController::class, 'subscriberList'])->name('subscriberList');
            Route::post('/cancel-subscription/{id}',  [SubscriptionController::class, 'cancelSubscription'])->name('cancelSubscription');
            Route::post('/switch-to-commission/{id}',  [SubscriptionController::class, 'switchToCommission'])->name('switchToCommission');
            Route::get('/package-view/{id}/{store_id}',  [SubscriptionController::class, 'packageView'])->name('packageView');
            Route::get('/subscriber-transactions/{id}',  [SubscriptionController::class, 'subscriberTransactions'])->name('subscriberTransactions');
            Route::get('/subscriber-transaction-export',  [SubscriptionController::class, 'subscriberTransactionExport'])->name('subscriberTransactionExport');
            Route::get('/subscriber-wallet-transactions',  [SubscriptionController::class, 'subscriberWalletTransactions'])->name('subscriberWalletTransactions');

            Route::post('/package-buy',  [SubscriptionController::class, 'packageBuy'])->name('packageBuy');
            Route::post('/add-to-session',  [SubscriptionController::class, 'addToSession'])->name('addToSession');
        });

        Route::group(['prefix' => 'business-settings' , 'as' => 'business-settings.', 'middleware' => ['module:business']], function () {
            Route::get('/provider-setup',  [BusinessSettingsController::class, 'providerSetup'])->name('provider-setup');
            Route::post('/update-setup',  [BusinessSettingsController::class, 'updateSetup'])->name('update-setup');
        });

        Route::group(['prefix' => 'withdraw-method', 'as' => 'wallet-method.', 'middleware' => ['module:business']], function () {
            Route::get('/', [WalletMethodController::class, 'index'])->name('index');
            Route::post('store/', [WalletMethodController::class, 'store'])->name('store');
            Route::get('default/{id}/{default}', [WalletMethodController::class, 'default'])->name('default');
            Route::delete('delete/{id}', [WalletMethodController::class, 'delete'])->name('delete');
            Route::get('method-list/', [WalletMethodController::class, 'methodList'])->name('method-list');
        });

        Route::get('get-notification-setting', [NotificationController::class, 'notificationSettingsGet'])->name('get-notification-setting')->middleware('module:business');
        Route::get('set-notification-setting/{user_type}/{key}/{type}', [NotificationController::class, 'notificationSettingsSet'])->name('set-notification-setting')->middleware('module:business');

        Route::get('profile-update', [ProviderController::class, 'profileInfo'])->name('profile.update');
        Route::get('my-account', [ProviderController::class, 'accountInfo'])->name('my.account')->middleware('module:business');
        Route::post('profile-update', [ProviderController::class, 'updateProfile']);

        Route::get('my-reviews', [ProviderController::class, 'providerReviews'])->name('my.reviews')->middleware('module:business');
        Route::post('reviews/reply', [ProviderController::class, 'providerReviewsReply'])->name('reviews.reply')->middleware('module:business');
        Route::get('promotional-costing', [ProviderController::class, 'promotionalCosting'])->name('promotional-costing')->middleware('module:business');

        Route::group(['prefix' => 'message', 'as' => 'message.', 'middleware' => ['module:help_support','service_subscription:chat']], function () {
            Route::get('list', [ConversationController::class, 'list'])->name('list');
            Route::post('store/{user_id}/{user_type}', [ConversationController::class, 'store'])->name('store');
            Route::get('view/{conversation_id}/{user_id}', [ConversationController::class, 'view'])->name('view');
        });


        Route::group(['prefix' => 'report', 'as' => 'report.', 'namespace' => 'Report', 'middleware' => ['module:report_analytics' ,'service_subscription:reports_and_analytics']], function () {
            //Transaction Report
            Route::any('transaction', [TransactionReportController::class, 'getTransactionReport'])->name('transaction');
            Route::any('transaction/download', [TransactionReportController::class, 'downloadTransactionReport'])->name('transaction.download');

            //Booking Report
            Route::any('booking', [BookingReportController::class, 'getBookingReport'])->name('booking');
            Route::any('booking/download', [BookingReportController::class, 'getBookingReportDownload'])->name('booking.download');

            //Business Report
            Route::group(['prefix' => 'business', 'as' => 'business.'], function () {
                Route::any('overview', [OverviewReportController::class, 'getBusinessOverviewReport'])->name('overview');
                Route::any('overview/download', [OverviewReportController::class, 'getBusinessOverviewReportDownload'])->name('overview.download');
                Route::any('earning', [EarningReportController::class, 'getBusinessEarningReport'])->name('earning');
                Route::any('earning/download', [EarningReportController::class, 'getBusinessEarningReportDownload'])->name('earning.download');
                Route::any('expense', [ExpenseReportController::class, 'getBusinessExpenseReport'])->name('expense');
                Route::any('expense/download', [ExpenseReportController::class, 'getBusinessExpenseReportDownload'])->name('expense.download');
            });
        });

        Route::group(['prefix' => 'wallet', 'as' => 'wallet.', 'middleware' => ['module:business']], function () {
            Route::get('/', [WalletController::class, 'index'])->name('index');
            Route::get('method-list', [WalletController::class, 'method_list'])->name('method-list');

        });

        Route::group(['prefix' => 'withdraw', 'as' => 'withdraw.', 'middleware' => ['module:business']], function () {
            Route::any('/', [WithdrawController::class, 'index'])->name('list');
            Route::post('/store', [WithdrawController::class, 'withdraw'])->name('store');
            Route::any('download', [WithdrawController::class, 'download'])->name('download');
        });

        Route::group([
            'prefix' => 'custom-role',
            'as' => 'custom-role.',
            'middleware' => ['module:employee']
        ], function () {
            Route::get('list', [CustomRoleController::class, 'create'])->name('list');
            Route::post('list', [CustomRoleController::class, 'store']);
            Route::get('edit/{id}', [CustomRoleController::class, 'edit'])->name('edit');
            Route::post('edit/{id}', [CustomRoleController::class, 'update']);
            Route::delete('delete/{id}', [CustomRoleController::class, 'distroy'])->name('delete');
        });

        Route::group(['prefix' => 'employee', 'as' => 'employee.',
            'middleware' => ['module:employee']
        ], function () {
            Route::get('list', [EmployeeController::class, 'list'])->name('list');
            Route::get('add-new', [EmployeeController::class, 'add_new'])->name('add-new');
            Route::post('add-new', [EmployeeController::class, 'store']);
            Route::get('edit/{id}', [EmployeeController::class, 'edit'])->name('edit');
            Route::post('edit/{id}', [EmployeeController::class, 'update']);
            Route::delete('delete/{id}', [EmployeeController::class, 'distroy'])->name('delete');
            Route::get('list-export', [EmployeeController::class, 'list_export'])->name('export-employee');
        });

    });

    Route::post('search-routing', [SearchRoutingController::class, 'index'])->name('search.routing');
    Route::get('recent-search', [SearchRoutingController::class, 'recentSearch'])->name('recent.search');
    Route::post('clicked-route', [SearchRoutingController::class, 'providerClickedRoute'])->name('clicked.route');
});
