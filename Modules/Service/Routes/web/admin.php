<?php


use Illuminate\Support\Facades\Route;
use Modules\Service\Http\Controllers\Web\Admin\BidModule\PostController;
use Modules\Service\Http\Controllers\Web\Admin\BookingModule\BookingController;
use Modules\Service\Http\Controllers\Web\Admin\BusinessSetup\BusinessSettingsController;
use Modules\Service\Http\Controllers\Web\Admin\DashboardController;
use Modules\Service\Http\Controllers\Web\Admin\ProviderManagement\ProviderController;
use Modules\Service\Http\Controllers\Web\Admin\Report\Analytics\SearchController;
use Modules\Service\Http\Controllers\Web\Admin\Report\BookingReportController;
use Modules\Service\Http\Controllers\Web\Admin\Report\Business\EarningReportController;
use Modules\Service\Http\Controllers\Web\Admin\Report\Business\ExpenseReportController;
use Modules\Service\Http\Controllers\Web\Admin\Report\Business\OverviewReportController;
use Modules\Service\Http\Controllers\Web\Admin\Report\ProviderReportController;
use Modules\Service\Http\Controllers\Web\Admin\Report\TransactionReportController;

Route::group(['middleware' => ['admin', 'current-module']], function () {
    Route::group(['prefix' => 'service', 'as' => 'service.','middleware' => 'admin-service-module'], function () {
        Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
        Route::get('update-dashboard-earning-graph', [DashboardController::class, 'updateDashboardEarningGraph'])->name('update-dashboard-earning-graph');

        Route::group(['namespace' => 'Web\Admin', 'middleware' => ['admin']], function () {
            Route::group(['namespace' => 'CategoryManagement', 'middleware' => ['module:service']], function () {
                Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
                    Route::any('create', 'CategoryController@create')->name('create');
                    Route::post('store', 'CategoryController@store')->name('store');
                    Route::get('edit/{id}', 'CategoryController@edit')->name('edit');
                    Route::put('update/{id}', 'CategoryController@update')->name('update');
                    Route::any('status-update/{id}', 'CategoryController@statusUpdate')->name('status-update');
                    Route::any('featured-update/{id}', 'CategoryController@featuredUpdate')->name('featured-update');
                    Route::delete('delete/{id}', 'CategoryController@destroy')->name('delete');
                    Route::get('childes', 'CategoryController@childes');
                    Route::get('ajax-childes/{id}', 'CategoryController@ajaxChildes')->name('ajax-childes');
                    Route::get('ajax-childes-only/{id}', 'CategoryController@ajaxChildesOnly')->name('ajax-childes-only');
                    Route::get('download', 'CategoryController@download')->name('download');
                    Route::get('table', 'CategoryController@getTable')->name('table');
                });

                Route::group(['prefix' => 'sub-category', 'as' => 'sub-category.'], function () {
                    Route::any('create', 'SubCategoryController@create')->name('create');
                    Route::post('store', 'SubCategoryController@store')->name('store');
                    Route::get('edit/{id}', 'SubCategoryController@edit')->name('edit');
                    Route::put('update/{id}', 'SubCategoryController@update')->name('update');
                    Route::any('status-update/{id}', 'SubCategoryController@statusUpdate')->name('status-update');
                    Route::delete('delete/{id}', 'SubCategoryController@destroy')->name('delete');
                    Route::get('download', 'SubCategoryController@download')->name('download');
                });
            });

            Route::group(['namespace' => 'PromotionManagement', 'middleware' => ['module:service_promotion']], function () {
                Route::group(['prefix' => 'coupon', 'as' => 'coupon.'], function () {
                    Route::any('create', 'CouponController@create')->name('create');
                    Route::any('list', 'CouponController@index')->name('list');
                    Route::post('store', 'CouponController@store')->name('store');
                    Route::get('edit/{id}', 'CouponController@edit')->name('edit');
                    Route::put('update/{id}', 'CouponController@update')->name('update');
                    Route::any('status-update/{id}', 'CouponController@statusUpdate')->name('status-update');
                    Route::delete('delete/{id}', 'CouponController@destroy')->name('delete');
                    Route::any('download', 'CouponController@download')->name('download');
                });

                Route::group(['prefix' => 'discount', 'as' => 'discount.'], function () {
                    Route::any('create', 'DiscountController@create')->name('create');
                    Route::any('list', 'DiscountController@index')->name('list');
                    Route::post('store', 'DiscountController@store')->name('store');
                    Route::get('edit/{id}', 'DiscountController@edit')->name('edit');
                    Route::put('update/{id}', 'DiscountController@update')->name('update');
                    Route::any('status-update/{id}', 'DiscountController@statusUpdate')->name('status-update');
                    Route::delete('delete/{id}', 'DiscountController@destroy')->name('delete');
                    Route::any('download', 'DiscountController@download')->name('download');
                });

                Route::group(['prefix' => 'banner', 'as' => 'banner.'], function () {
                    Route::any('create', 'BannerController@create')->name('create');
                    Route::post('store', 'BannerController@store')->name('store');
                    Route::get('edit/{id}', 'BannerController@edit')->name('edit');
                    Route::put('update/{id}', 'BannerController@update')->name('update');
                    Route::any('status-update/{id}', 'BannerController@statusUpdate')->name('status-update');
                    Route::delete('delete/{id}', 'BannerController@destroy')->name('delete');
                    Route::any('download', 'BannerController@download')->name('download');

                });

                Route::group(['prefix' => 'campaign', 'as' => 'campaign.'], function () {
                    Route::any('create', 'CampaignController@create')->name('create');
                    Route::any('list', 'CampaignController@index')->name('list');
                    Route::post('store', 'CampaignController@store')->name('store');
                    Route::get('edit/{id}', 'CampaignController@edit')->name('edit');
                    Route::put('update/{id}', 'CampaignController@update')->name('update');
                    Route::any('status-update/{id}', 'CampaignController@statusUpdate')->name('status-update');
                    Route::delete('delete/{id}', 'CampaignController@destroy')->name('delete');
                    Route::any('download', 'CampaignController@download')->name('download');
                });

                Route::group([ 'prefix' => 'advertisement', 'as' => 'advertisement.' ,'middleware' => ['module:advertisement']], function () {

                    Route::get('/', 'AdvertisementController@index')->name('index');
                    Route::get('create/', 'AdvertisementController@create')->name('create');
                    Route::get('details/{advertisement}', 'AdvertisementController@show')->name('show');
                    Route::get('{advertisement}/edit', 'AdvertisementController@edit')->name('edit');
                    Route::post('store', 'AdvertisementController@store')->name('store');
                    Route::put('update/{advertisement}', 'AdvertisementController@update')->name('update');
                    Route::delete('delete/{id}', 'AdvertisementController@destroy')->name('destroy');

                    Route::get('/status', 'AdvertisementController@status')->name('status');
                    Route::get('/paidStatus', 'AdvertisementController@paidStatus')->name('paidStatus');
                    Route::get('/priority', 'AdvertisementController@priority')->name('priority');
                    Route::get('/requests', 'AdvertisementController@requestList')->name('requestList');
                    Route::get('/copy-advertisement/{advertisement}', 'AdvertisementController@copyAdd')->name('copyAdd');
                    Route::get('/updateDate/{advertisement}', 'AdvertisementController@updateDate')->name('updateDate');
                    Route::post('/copy-add-post/{advertisement}', 'AdvertisementController@copyAddPost')->name('copyAddPost');

                });
            });

            Route::group(['namespace' => 'ServiceManagement', 'middleware' => ['module:service']], function() {
                Route::group(['prefix' => 'service', 'as' => 'service.'], function () {
                    Route::any('list', 'ServiceController@index')->name('index');
                    Route::any('create', 'ServiceController@create')->name('create');
                    Route::post('store', 'ServiceController@store')->name('store');
                    Route::any('detail/{id}', 'ServiceController@show')->name('detail');
                    Route::get('edit/{id}', 'ServiceController@edit')->name('edit');
                    Route::put('update/{id}', 'ServiceController@update')->name('update');
                    Route::any('status-update/{id}', 'ServiceController@statusUpdate')->name('status-update');
                    Route::delete('delete/{id}', 'ServiceController@destroy')->name('delete');
                    Route::any('download', 'ServiceController@download')->name('download');
                    Route::any('reviews/download', 'ServiceController@reviewsDownload')->name('reviews.download');

                    Route::any('request/list', 'ServiceController@requestList')->name('request.list');
                    Route::any('request/update/{id}', 'ServiceController@updateStatus')->name('request.update');

                    Route::any('review-status-update/{id}', 'ServiceController@reviewStatusUpdate')->name('review-status-update');

                    Route::any('export', 'ServiceController@export')->name('export');


                    //ajax routes
                    Route::any('ajax-add-variant', 'ServiceController@ajaxAddVariant')->name('ajax-add-variant')->withoutMiddleware('csrf');
                    Route::any('ajax-remove-variant/{variant_key}', 'ServiceController@ajaxRemoveVariant')->name('ajax-remove-variant')->withoutMiddleware('csrf');
                    Route::any('ajax-delete-db-variant/{variant_key}/{service_id}', 'ServiceController@ajaxDeleteDbVariant')->name('ajax-delete-db-variant')->withoutMiddleware('csrf');


                    Route::group(['prefix' => 'faq', 'as' => 'faq.'], function () {
                        Route::post('{service_id}/store', 'FAQController@store')->name('store');
                        Route::get('{service_id}/edit/{id}', 'FAQController@edit')->name('edit');
                        Route::any('{service_id}/update/{id}', 'FAQController@update')->name('update');
                        Route::any('{service_id}/status-update/{id}', 'FAQController@statusUpdate')->name('status-update');
                        Route::any('{service_id}/delete/{id}', 'FAQController@destroy')->name('delete');
                    });
                });
            });

            Route::group(['prefix' => 'booking', 'as' => 'booking.', 'middleware' => ['module:booking']], function () {
                Route::any('list', [BookingController::class, 'index'])->name('list');
                Route::any('list/verification', [BookingController::class, 'bookingVerificationList'])->name('list.verification');
                Route::any('list/offline-payment', [BookingController::class, 'bookingOfflinePaymentList'])->name('offline.payment');
                Route::get('check', [BookingController::class, 'checkBooking'])->name('check');
                Route::get('details/{id}', [BookingController::class, 'details'])->name('details');
                Route::get('repeat-details/{id}', [BookingController::class, 'repeatDetails'])->name('repeat_details');
                Route::get('repeat-single-details/{id}', [BookingController::class, 'repeatSingleDetails'])->name('repeat_single_details');
                Route::get('repeat-log/{id}', [BookingController::class, 'repeatLog'])->name('repeat_log');
                Route::put('status-update/{id}', [BookingController::class, 'statusUpdate'])->name('status_update');
                Route::get('up-coming-booking-cancel/{id}', [BookingController::class, 'upComingBookingCancel'])->name('up_coming_booking_cancel');
                Route::get('verification-status-update/{id}', [BookingController::class, 'verificationUpdate'])->name('verification_status_update');
                Route::post('verification-status/{id}', [BookingController::class, 'verificationStatus'])->name('verification-status');
                Route::put('payment-update/{id}', [BookingController::class, 'paymentUpdate'])->name('payment_update');
                Route::any('schedule-update/{id}', [BookingController::class, 'scheduleUpdate'])->name('schedule_update');
                Route::any('up-coming-booking-schedule-update/{id}', [BookingController::class, 'upComingBookingScheduleUpdate'])->name('up_coming_booking_schedule_update');
                Route::put('serviceman-update/{id}', [BookingController::class, 'servicemanUpdate'])->name('serviceman_update');
                Route::post('service-address-update/{id}', [BookingController::class, 'serviceAddressUpdate'])->name('service_address_update');
                Route::any('download', [BookingController::class, 'download'])->name('download');
                Route::any('download-verification-list', [BookingController::class, 'downloadVerificationList'])->name('download.verification.list');
                Route::any('invoice/{id}', [BookingController::class, 'invoice'])->name('invoice');
                Route::any('single-repeat-invoice/{id}', [BookingController::class, 'fullBookingSingleInvoice'])->name('single_invoice');
                Route::any('full-repeat-invoice/{id}', [BookingController::class, 'fullBookingInvoice'])->name('full_repeat_invoice');
                Route::any('customer-fullbooking-single-invoice/{id}/{lang}', [BookingController::class, 'customerFullBookingSingleInvoice'])->withoutMiddleware(['admin', 'admin-service-module', 'current-module', 'module:booking']);
                Route::any('customer-fullbooking-invoice/{id}/{lang}', [BookingController::class, 'customerFullBookingInvoice'])->withoutMiddleware(['admin', 'admin-service-module', 'current-module', 'module:booking']);
                Route::any('provider-fullbooking-single-invoice/{id}/{lang}', [BookingController::class, 'providerFullBookingSingleInvoice'])->withoutMiddleware(['admin', 'admin-service-module', 'current-module', 'module:booking']);
                Route::any('provider-fullbooking-invoice/{id}/{lang}', [BookingController::class, 'providerFullBookingInvoice'])->withoutMiddleware(['admin', 'admin-service-module', 'current-module', 'module:booking']);
                Route::any('serviceman-fullbooking-single-invoice/{id}/{lang}', [BookingController::class, 'servicemanFullBookingSingleInvoice'])->withoutMiddleware(['admin', 'admin-service-module', 'current-module', 'module:booking']);
                Route::any('customer-invoice/{id}/{lang}', [BookingController::class, 'customerInvoice'])->withoutMiddleware(['admin', 'admin-service-module', 'current-module', 'module:booking']);
                Route::any('provider-invoice/{id}/{lang}', [BookingController::class, 'providerInvoice'])->withoutMiddleware(['admin', 'admin-service-module', 'current-module', 'module:booking']);
                Route::any('serviceman-invoice/{id}/{lang}', [BookingController::class, 'servicemanInvoice'])->withoutMiddleware(['admin', 'admin-service-module', 'current-module', 'module:booking']);
                Route::any('available-provider', [BookingController::class, 'availableProviderList'])->name('available-provider-list');
                Route::any('reassign-provider/{id}', [BookingController::class, 'reassignProvider'])->name('reassign-provider');


                Route::any('switch-payment-method/{id}', [BookingController::class, 'switchPaymentMethod'])->name('switch-payment-method');

                Route::any('offline-payment/verify', [BookingController::class, 'verifyOfflinePayment'])->name('offline-payment.verify');
                Route::any('offline-payment/download', [BookingController::class, 'downloadOfflinePayment'])->name('offline-payment.download');

                Route::group(['prefix' => 'service', 'as' => 'service.'], function () {
                    Route::put('update-booking-service', [BookingController::class, 'updateBookingService'])->name('update_booking_service');
                    Route::put('update-repeat-booking-service', [BookingController::class, 'updateRepeatBookingService'])->name('update_repeat_booking_service');
                    Route::get('ajax-get-service-info', [BookingController::class, 'ajaxGetServiceInfo'])->name('ajax-get-service-info');
                    Route::get('ajax-get-variation', [BookingController::class, 'ajaxGetVariant'])->name('ajax-get-variant');
                });

                Route::get('rebooking/details/{id}', [BookingController::class, 'reBookingDetails'])->name('rebooking.details');
                Route::get('rebooking/ongoing/{id}', [BookingController::class, 'reBookingOngoing'])->name('rebooking.ongoing');

                Route::post('change-service-location/{id}', [BookingController::class, 'changeServiceLocation'])->name('change-service-location');
                Route::post('repeat-change-service-location/{id}', [BookingController::class, 'repeatChangeServiceLocation'])->name('repeat.change-service-location');

                Route::group(['prefix' => 'post', 'as' => 'post.'], function () {
                    Route::any('/', [PostController::class, 'index'])->name('list');
                    Route::any('export', [PostController::class, 'export'])->name('export');
                    Route::any('details/{id}', [PostController::class, 'details'])->name('details');
                    Route::post('delete/{id}', [PostController::class, 'delete'])->name('delete');
                    Route::post('multi-remove', [PostController::class, 'multiDelete'])->name('multi-remove');
                });

            });

            Route::group(['prefix' => 'provider', 'as' => 'provider.', 'namespace' => 'ProviderManagement', 'middleware' => ['module:service_provider']], function () {
                Route::any('get-providers', 'ProviderController@getProviders')->name('get-providers');
                Route::any('get-account-data/{provider_id}', 'ProviderController@getAccountData')->name('get-account-data');
                Route::any('list', 'ProviderController@index')->name('list');
                Route::any('status-update/{id}', 'ProviderController@statusUpdate')->name('status_update');
                Route::post('commission-update/{id}', 'ProviderController@commissionUpdate')->name('commission_update');
                Route::get('cancel-subscription/{id}/{subscription_id}', 'ProviderController@cancelSubscription')->name('cancel_subscription');
                Route::get('package-view/{id}/{store_id}', 'ProviderController@subscriptionPackageView')->name('subscription_package_view');
                Route::post('subscribe-package', 'ProviderController@subscribePackage')->name('subscribe_package');
                Route::get('switch-to-commission/{id}', 'ProviderController@switchToCommission')->name('switch_to_commission');
                Route::get('create', 'ProviderController@create')->name('create');
                Route::post('store', 'ProviderController@store')->name('store');
                Route::get('edit/{id}', 'ProviderController@edit')->name('edit');
                Route::put('update/{id}', 'ProviderController@update')->name('update');
                Route::delete('delete/{id}', 'ProviderController@destroy')->name('delete');
                Route::any('details/{id}', 'ProviderController@details')->name('details');
                Route::put('update-meta-data/{id}', 'ProviderController@updateMetaData')->name('update-meta-data');
                Route::post('update-settings/{id}', 'ProviderController@updateSettings')->name('update-settings');
                Route::put('update-subscription/{id}', 'ProviderController@updateSubscription')->name('update_subscription');
                Route::any('download', 'ProviderController@download')->name('download');
                Route::any('reviews/download', 'ProviderController@reviewsDownload')->name('reviews.download');

                //provider schedule
                Route::post('add-schedule', 'ProviderController@add_schedule')->name('add-schedule');
                Route::get('remove-schedule/{store_schedule}', 'ProviderController@remove_schedule')->name('remove-schedule');

                Route::group(['prefix' => '{id}/serviceman', 'as' => 'serviceman.'], function () {
                    Route::get('create', 'ServicemanController@create')->name('create');
                    Route::post('store', 'ServicemanController@store')->name('store');
                    Route::get('edit/{serviceman_id}', 'ServicemanController@edit')->name('edit');
                    Route::put('update/{serviceman_id}', 'ServicemanController@update')->name('update');
                    Route::delete('delete/{serviceman_id}', 'ServicemanController@destroy')->name('delete');
                    Route::any('status-update/{serviceman_id}', 'ServicemanController@statusUpdate')->name('status_update');
                    Route::any('details/{serviceman_id}', 'ServicemanController@details')->name('details');
                });

                /* Route::any('service-availability/{id}', 'ProviderController@serviceAvailability')->name('service_availability');
                Route::any('suspend-update/{id}', 'ProviderController@suspendUpdate')->name('suspend_update');

                Route::get('available-provider', 'ProviderController@availableProviderList')->name('available-provider-list');
                Route::get('provider-info', 'ProviderController@providerInfo')->name('provider-info');
                Route::put('reassign-provider/{id}', 'ProviderController@reassignProvider')->name('reassign-provider');

                Route::any('download', 'ProviderController@download')->name('download');
                Route::any('reviews/download', 'ProviderController@reviewsDownload')->name('reviews.download');

                Route::get('get-provider-info/{provider_id}', 'ProviderController@getProviderInfo')->name('get-provider-info')->withoutMiddleware('admin');

                Route::group(['prefix' => 'subscription-package', 'as' => 'subscription-package.'], function () {
                    Route::post('to-commission', 'SubscriptionController@toCommission')->name('to.commission');
                    Route::post('renew-payment', 'SubscriptionController@renewPayment')->name('renew.payment');
                    Route::post('renew-ajax', 'SubscriptionController@ajaxRenewPackage')->name('renew.ajax');
                    Route::post('shift-payment', 'SubscriptionController@shiftPayment')->name('shift.payment');
                    Route::post('shift-ajax', 'SubscriptionController@ajaxShiftPackage')->name('shift.ajax');
                    Route::post('purchase-payment', 'SubscriptionController@purchasePayment')->name('purchase.payment');
                    Route::post('purchase-ajax', 'SubscriptionController@ajaxPurchasePackage')->name('purchase.ajax');
                    Route::post('cancel', 'SubscriptionController@cancel')->name('cancel');
                }); */

                /* Route::group(['prefix' => 'account', 'as' => 'account.'], function () {
                    Route::post('update/{id}', 'ProviderController@updateAccountInfo')->name('update');
                    Route::get('delete/{id}', 'ProviderController@deleteAccountInfo')->name('delete');
                }); */

                /* Route::group(['prefix' => 'sub-category', 'as' => 'sub_category.'], function () {
                    Route::get('update-subscription/{id}', 'ProviderController@updateSubscription')->name('update_subscription');
                }); */

                Route::any('onboarding/request', 'ProviderController@onboardingRequest')->name('onboarding_request');
                Route::get('onboarding/details/{id}', 'ProviderController@onboardingDetails')->name('onboarding_details');
                Route::get('update-approval/{id}/{status}', 'ProviderController@updateApproval')->name('update-approval');

                /* Route::group(['prefix' => 'collect-cash', 'as' => 'collect_cash.'], function () {
                    Route::get('/{id}', 'CollectCashController@index')->name('list');
                    Route::post('/', 'CollectCashController@collectCash')->name('store');
                }); */
                Route::group(['prefix' => 'message', 'as' => 'message.'], function () {
                    Route::get('{conversation_id}/{user_id}', 'ProviderController@conversation_view')->name('view');
                    Route::get('list', 'ProviderController@conversation_list')->name('list');
                });
            });
        });
    });




    Route::group(['prefix' => 'business-settings', 'as' => 'business-settings.', 'middleware' => ['module:settings', 'actch']], function () {
        Route::group(['prefix' => 'service', 'as' => 'service.'], function () {
            Route::controller(BusinessSettingsController::class)->group(function () {
                Route::get('business-setup', 'getBusinessSetting')->name('get-business-settings');
                Route::put('update-business-setting', 'updateBusinessSetting')->name('update-business-setting');

                Route::get('notification-setup/{type}/{tab?}','notificationSetup')->name('notification-setup');
                Route::post('notification-setup/{key}/{user_type}/{type}', 'updateNotification')->name('update-notification');
            });
        });
    });

    Route::group(['prefix' => 'transactions', 'as' => 'transactions.'], function () {
        Route::group(['prefix' => 'service', 'as' => 'service.'], function () {
            Route::group(['prefix' => 'report', 'as' => 'report.', 'namespace' => 'Report', 'middleware' => ['module:service_report']], function () {
                Route::any('transaction', [TransactionReportController::class, 'getTransactionReport'])->name('transaction');
                Route::any('transaction/download', [TransactionReportController::class, 'downloadTransactionReport'])->name('transaction.download');

                Route::any('booking', [BookingReportController::class, 'getBookingReport'])->name('booking');
                Route::any('booking/download', [BookingReportController::class, 'getBookingReportDownload'])->name('booking.download');

                Route::any('provider', [ProviderReportController::class, 'getProviderReport'])->name('provider');
                Route::any('provider/download', [ProviderReportController::class, 'getProviderReportDownload'])->name('provider.download');

                Route::group(['prefix' => 'business', 'as' => 'business.'], function () {
                    Route::any('overview', [OverviewReportController::class, 'getBusinessOverviewReport'])->name('overview');
                    Route::any('overview/download', [OverviewReportController::class, 'getBusinessOverviewReportDownload'])->name('overview.download');
                    Route::any('earning', [EarningReportController::class, 'getBusinessEarningReport'])->name('earning');
                    Route::any('subscription-earning', [EarningReportController::class, 'getBusinessSubscriptionEarningReport'])->name('subscription-earning');
                    Route::any('commission-earning', [EarningReportController::class, 'getBusinessCommissionEarningReport'])->name('commission-earning');
                    Route::any('earning/download', [EarningReportController::class, 'getBusinessEarningReportDownload'])->name('earning.download');
                    Route::any('expense', [ExpenseReportController::class, 'getBusinessExpenseReport'])->name('expense');
                    Route::any('expense/download', [ExpenseReportController::class, 'getBusinessExpenseReportDownload'])->name('expense.download');
                    Route::any('subscription-earning/download', [EarningReportController::class, 'subEarningDownload'])->name('subscription.download');
                    Route::any('commission-earning/download', [EarningReportController::class, 'comEarningDownload'])->name('commission.download');
                });
            });


            Route::group(['prefix' => 'analytics', 'as' => 'analytics.', 'namespace' => 'Analytics'], function () {
                Route::group(['prefix' => 'search', 'as' => 'search.'], function () {
                    Route::any('keyword', [SearchController::class, 'getKeywordSearchAnalytics'])->name('keyword');
                    Route::any('customer', [SearchController::class, 'getCustomerSearchAnalytics'])->name('customer');
                });
            });

            Route::group(['prefix' => 'provider', 'as' => 'provider.'], function () {
                Route::post('status-filter', [ProviderController::class, 'status_filter'])->name('status-filter');
                Route::post('withdraw-status/{id}', [ProviderController::class, 'withdrawStatus'])->name('withdraw_status');
                Route::get('withdraw_list', [ProviderController::class, 'withdraw_list'])->name('withdraw_list');
                Route::post('withdraw_search', [ProviderController::class, 'withdraw_search'])->name('withdraw_search');
                Route::get('withdraw_export', [ProviderController::class, 'withdraw_export'])->name('withdraw_export');
                Route::get('withdraw-view/{withdraw_id}/{seller_id}', [ProviderController::class, 'withdraw_view'])->name('withdraw_view');
                Route::get('get-Withdraw-Details', [ProviderController::class, 'getWithdrawDetails'])->name('getWithdrawDetails');

            });
        });
    });
});
