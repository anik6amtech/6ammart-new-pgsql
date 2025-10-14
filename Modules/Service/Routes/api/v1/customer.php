<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Service\Http\Controllers\Api\Customer\BidModule\PostBidController;
use Modules\Service\Http\Controllers\Api\Customer\BidModule\PostController;
use Modules\Service\Http\Controllers\Api\Customer\BookingModule\BookingController;
use Modules\Service\Http\Controllers\Api\Customer\CartModule\CartController;
use Modules\Service\Http\Controllers\Api\Customer\CategoryManagement\CategoryController;
use Modules\Service\Http\Controllers\Api\Customer\CustomerModule\CustomerController;
use Modules\Service\Http\Controllers\Api\Customer\PromotionManagement\AdvertisementsController;
use Modules\Service\Http\Controllers\Api\Customer\PromotionManagement\BannerController;
use Modules\Service\Http\Controllers\Api\Customer\PromotionManagement\CampaignController;
use Modules\Service\Http\Controllers\Api\Customer\PromotionManagement\CouponController;
use Modules\Service\Http\Controllers\Api\Customer\ProviderManagement\FavoriteProviderController;
use Modules\Service\Http\Controllers\Api\Customer\ProviderManagement\ProviderController;
use Modules\Service\Http\Controllers\Api\Customer\ReviewModule\ReviewController;
use Modules\Service\Http\Controllers\Api\Customer\ServiceManagement\FavoriteServiceController;
use Modules\Service\Http\Controllers\Api\Customer\ServiceManagement\ServiceController;

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
    Route::group(['middleware'=>['module-check', 'zone-adder']], function(){

        Route::group(['prefix' => 'service'], function () {
            Route::get('/', [ServiceController::class, 'index']);
            Route::post('search', [ServiceController::class, 'search']);
            Route::get('search-suggestion', [ServiceController::class, 'searchSuggestions']);
            Route::get('search/recommended', [ServiceController::class, 'searchRecommended']);
            Route::get('popular', [ServiceController::class, 'popular']);
            Route::get('recommended', [ServiceController::class, 'recommended']);
            Route::get('trending', [ServiceController::class, 'trending']);
            Route::get('recently-viewed', [ServiceController::class, 'recentlyViewed'])->middleware('auth:api');
            Route::get('offers', [ServiceController::class, 'offers']);
            Route::get('detail/{id}', [ServiceController::class, 'show']);
            Route::get('review/{service_id}', [ServiceController::class, 'review']);
            Route::get('sub-category/{sub_category_id}', [ServiceController::class, 'servicesBySubcategory']);

            Route::post('area-availability', [ServiceController::class, 'serviceAreaAvailability']);

            Route::group(['prefix' => 'request'], function () {
                Route::post('make', [ServiceController::class, 'makeRequest'])->middleware('auth:api');
                Route::get('list', [ServiceController::class, 'requestList'])->middleware('auth:api');
            });

            Route::group(['prefix' => 'favorite', 'middleware' => ['auth:api']], function () {
                Route::get('service-list', [FavoriteServiceController::class, 'list']);
                Route::post('service', [FavoriteServiceController::class, 'store']);
                Route::post('service-delete/{service_id}', [FavoriteServiceController::class, 'destroy']);
            });
        });

        Route::get('recently-searched-keywords', [ServiceController::class, 'recentlySearchedKeywords'])->middleware('auth:api');
        Route::get('remove-searched-keywords', [ServiceController::class, 'removeSearchedKeywords'])->middleware('auth:api');



        Route::group(['prefix' => 'provider'], function () {
            Route::post('list', [ProviderController::class, 'getProviderList']);
            Route::get('details', [ProviderController::class, 'getProviderDetails']);
            Route::get('list-by-sub-category', [ProviderController::class, 'getProviderListBySubCategory']);
            Route::post('available-provider', [ProviderController::class, 'getAvailableProvider']);
            Route::post('available-service', [ProviderController::class, 'getAvailableService']);
            Route::post('rebooking-information', [ProviderController::class, 'rebookingInformation']);

            Route::group(['prefix' => 'favorite', 'as' => 'favorite.', 'middleware' => ['auth:api']], function () {
                Route::get('provider-list', [FavoriteProviderController::class, 'list']);
                Route::post('provider', [FavoriteProviderController::class, 'store']);
                Route::post('provider-destroy/{provider_id}', [FavoriteProviderController::class, 'destroy']);
            });
        });


        Route::group(['prefix' => 'banner'], function () {
            Route::get('/', [BannerController::class, 'index']);
        });

        /* Route::group(['prefix' => 'notification', 'as' => 'notification.',], function () {
            Route::get('/', 'NotificationController@index');
        }); */

        Route::get('campaign', [CampaignController::class, 'index']);
        Route::get('campaign/data/items', [CampaignController::class, 'campaignItems']);
        Route::group(['prefix' => 'advertisements'], function () {
            Route::get('ads-list', [AdvertisementsController::class, 'AdsList']);
        });


        Route::group(['prefix' => 'category', 'as'=>'category.'], function () {
            Route::get('/', [CategoryController::class, 'index']);
            Route::get('childes', [CategoryController::class, 'childes']);
        });

        Route::get('sub-categories', [CategoryController::class, 'subCategoryList']);
        Route::get('featured-categories', [CategoryController::class, 'featured']);

        Route::group(['prefix' => 'favorite', 'as' => 'favorite.', 'middleware' => ['auth:api']], function () {
            Route::get('service-list', [FavoriteServiceController::class, 'list']);
            Route::post('service', [FavoriteServiceController::class, 'store']);
            Route::delete('service-delete/{service_id}', [FavoriteServiceController::class, 'destroy']);
        });

        // Cart routes start
        Route::group(['prefix' => 'cart'], function () {
            Route::post('add', [CartController::class, 'addToCart']);
            Route::get('list', [CartController::class, 'list']);
            Route::put('update-quantity/{id}', [CartController::class, 'updateQty']);
            Route::put('update/provider', [CartController::class, 'updateProvider']);
            Route::delete('remove/{id}', [CartController::class, 'remove']);
            Route::delete('data/empty', [CartController::class, 'emptyCart']);
        });

        Route::group(['prefix' => 'rebook'], function () {
            Route::post('cart-add', [CartController::class, 'rebookAddToCart']);
        });
        // Cart routes end

        // Booking routes start
        Route::group(['prefix' => 'booking', 'middleware' => 'auth:api'], function () {
            Route::get('/', [BookingController::class, 'index'])->withoutMiddleware(['zone-adder', 'module-check']);
            Route::get('/{booking_id}', [BookingController::class, 'show'])->withoutMiddleware('zone-adder');
            Route::get('single/{booking_id}', [BookingController::class, 'singleDetails'])->withoutMiddleware('zone-adder');
            Route::post('request/send', [BookingController::class, 'placeRequest'])->withoutMiddleware('auth:api');
            Route::put('status-update/{booking_id}', [BookingController::class, 'statusUpdate'])->withoutMiddleware('zone-adder');
            Route::post('single-repeat-cancel/{repeat_id}', [BookingController::class, 'singleBookingCancel'])->withoutMiddleware('zone-adder');
            Route::post('track/{readable_id}', [BookingController::class, 'track'])->withoutMiddleware('auth:api')->withoutMiddleware('zone-adder');
            Route::post('store-offline-payment-data', [BookingController::class, 'storeOfflinePaymentData'])->withoutMiddleware('auth:api')->withoutMiddleware('zone-adder');
            Route::post('switch-payment-method', [BookingController::class, 'switchPaymentMethod'])->withoutMiddleware('auth:api')->withoutMiddleware('zone-adder');
        });
        // Booking routes end

        Route::group(['prefix' => 'coupon', 'as' => 'coupon.'], function () {
            Route::get('/', [CouponController::class, 'index']);
            Route::get('remove', [CouponController::class, 'removeCoupon']);
            Route::post('apply', [CouponController::class, 'applyCoupon']);
            Route::get('applicable', [CouponController::class, 'applicable']);
        });

        Route::group(['prefix' => 'post', 'middleware' => 'auth:api', 'ensureBiddingIsActive'], function () {
            Route::get('/', [PostController::class, 'index']);
            Route::get('/details/{id}', [PostController::class, 'show']);
            Route::post('/', [PostController::class, 'store']);
            Route::put('update-info', [PostController::class, 'updateInfo']);

            Route::group(['prefix' => 'bid'], function () {
                Route::get('/', [PostBidController::class, 'index']);
                Route::get('details', [PostBidController::class, 'show']);
                Route::put('update-status', [PostBidController::class, 'update']);
            });
        });

        Route::group(['prefix' => 'review', 'middleware' => 'auth:api', 'as' => 'review.',], function () {
            Route::get('/', [ReviewController::class, 'index'])->withoutMiddleware('zone-adder');
            Route::post('submit', [ReviewController::class, 'store'])->withoutMiddleware('zone-adder');
        });

        Route::post('check-existing-customer', [CustomerController::class, 'checkExistingCustomer']);

    });

    Route::get('get-zone-id', [CustomerController::class, 'getZone']);
});
