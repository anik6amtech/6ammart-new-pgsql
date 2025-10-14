<?php

use Illuminate\Support\Facades\Route;
use Modules\RideShare\Http\Controllers\Web\Admin\BusinessManagement\BusinessSetup\BusinessInfoController;
use Modules\RideShare\Http\Controllers\Web\Admin\BusinessManagement\BusinessSetup\DriverSettingController;
use Modules\RideShare\Http\Controllers\Web\Admin\BusinessManagement\BusinessSetup\SafetyAndPrecautionController;
use Modules\RideShare\Http\Controllers\Web\Admin\BusinessManagement\BusinessSetup\TripFareSettingController;
use Modules\RideShare\Http\Controllers\Web\Admin\FareManagement\TripFareController;
use Modules\RideShare\Http\Controllers\Web\Admin\FleetMapViewController;
use Modules\RideShare\Http\Controllers\Web\Admin\PromotionManagement\CouponSetupController;
use Modules\RideShare\Http\Controllers\Web\Admin\PromotionManagement\DiscountSetupController;
use Modules\RideShare\Http\Controllers\Web\Admin\TransactionManagement\Report\ReportController;
use Modules\RideShare\Http\Controllers\Web\Admin\TransactionManagement\Transaction\TransactionController;
use Modules\RideShare\Http\Controllers\Web\Admin\DashboardController;
use Modules\RideShare\Http\Controllers\Web\Admin\PromotionManagement\BannerSetupController;
use Modules\RideShare\Http\Controllers\Web\Admin\TripManagement\SafetyAlertController;
use Modules\RideShare\Http\Controllers\Web\Admin\TripManagement\TripRequestController;
use Modules\RideShare\Http\Controllers\Web\Admin\VehicleManagement\VehicleBrandController;
use Modules\RideShare\Http\Controllers\Web\Admin\VehicleManagement\VehicleModelController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => ['admin', 'current-module']], function () {
    Route::group(['prefix' => 'ride-share', 'as' => 'ride-share.','middleware' => 'admin-ride-share-module'], function () {
        Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
        Route::get('zone-wise-statistics', [DashboardController::class, 'zoneWiseStatistics'])->name('zone-wise-statistics');
        Route::get('heat-map', [DashboardController::class, 'heatMap'])->name('heat-map')->middleware('module:heat_map');
        Route::get('heat-map-overview-data', [DashboardController::class, 'heatMapOverview'])->name('heat-map-overview-data')->middleware('module:heat_map');
        Route::get('heat-map-compare', [DashboardController::class, 'heatMapCompare'])->name('heat-map-compare')->middleware('module:heat_map');
        Route::get('leader-board-driver', [DashboardController::class, 'leaderBoardDriver'])->name('leader-board-driver')->middleware('module:heat_map');
        Route::get('earning-statistics', [DashboardController::class, 'adminEarningStatistics'])->name('earning-statistics')->middleware('module:heat_map');
        Route::get('safety-alert/list', [FleetMapViewController::class, 'safetyAlertRoute'])->name('safety-alerts');
        
        Route::group(['prefix' => 'promotion', 'as' => 'promotion.', 'middleware' => ['module:ride_promotion']], function(){
            Route::group(['prefix' => 'coupon-setup', 'as' => 'coupon-setup.'], function(){
                Route::controller(CouponSetupController::class)->group(function (){
                    Route::get('list', 'index')->name('index');
                    Route::get('create', 'create')->name('create');
                    Route::post('store', 'store')->name('store');
                    Route::get('edit/{id}', 'edit')->name('edit');
                    Route::put('update/{id}', 'update')->name('update');
                    Route::delete('delete/{id}', 'destroy')->name('delete');
                    Route::get('status', 'status')->name('status');
                    Route::get('export', 'export')->name('export');
                    Route::get('log', 'log')->name('log');
                    Route::get('trashed', 'trashed')->name('trashed');
                    Route::get('restore/{id}', 'restore')->name('restore');
                    Route::delete('permanent-delete/{id}', 'permanentDelete')->name('permanent-delete');
                });
            });
            Route::group(['prefix' => 'discount-setup' , 'as' => 'discount-setup.'], function (){
                Route::controller(DiscountSetupController::class)->group(function (){
                    Route::get('list', 'index')->name('index');
                    Route::get('create', 'create')->name('create');
                    Route::post('store', 'store')->name('store');
                    Route::get('edit/{id}', 'edit')->name('edit');
                    Route::put('update/{id}', 'update')->name('update');
                    Route::delete('delete/{id}', 'destroy')->name('delete');
                    Route::get('status', 'status')->name('status');
                    Route::get('export', 'export')->name('export');
                    Route::get('log', 'log')->name('log');
                    Route::get('trashed', 'trashed')->name('trashed');
                    Route::get('restore/{id}', 'restore')->name('restore');
                    Route::delete('permanent-delete/{id}', 'permanentDelete')->name('permanent-delete');
                    Route::get('test', 'test')->name('test');
                });
            });

            Route::group(['prefix' => 'banner-setup', 'as' => 'banner-setup.'], function(){
                Route::controller(BannerSetupController::class)->group(function (){
                    Route::get('/',  'index')->name('index');
                    Route::post('store',  'store')->name('store');
                    Route::get('edit/{id}',  'edit')->name('edit');
                    Route::put('update/{id}',  'update')->name('update');
                    Route::delete('delete/{id}',  'destroy')->name('delete');
                    Route::get('status',  'status')->name('status');
                    Route::get('featured',  'featured')->name('featured');
                    Route::get('export',  'export')->name('export');
                    Route::get('log',  'log')->name('log');
                    Route::get('trashed',  'trashed')->name('trashed');
                    Route::get('restore/{id}',  'restore')->name('restore');
                    Route::delete('permanent-delete/{id}',  'permanentDelete')->name('permanent-delete');
                });
            });
        });

        Route::group(['prefix' => 'fare', 'as' => 'fare.', 'middleware' => ['module:fare']], function () {
            Route::group(['prefix' => 'trip', 'as' => 'trip.'], function () {
                Route::controller(TripFareController::class)->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('create/{zone_id}', 'create')->name('create');
                    Route::post('store', 'store')->name('store');
                });
            });
        });

        Route::group(['as' => 'fleet-map.', 'middleware' => ['module:fleet_view']], function(){
            Route::get('fleet-map/{type}', [FleetMapViewController::class, 'fleetMap'])->name('fleet-map');
            Route::get('fleet-map-driver-list/{type}', [FleetMapViewController::class, 'fleetMapDriverList'])->name('fleet-map-driver-list');
            Route::get('fleet-map-driver-details/{id}', [FleetMapViewController::class, 'fleetMapDriverDetails'])->name('fleet-map-driver-details');
            Route::get('fleet-map-view-single-driver/{id}', [FleetMapViewController::class, 'fleetMapViewSingleDriver'])->name('fleet-map-view-single-driver');
            Route::get('fleet-map-customer-list/{type}', [FleetMapViewController::class, 'fleetMapCustomerList'])->name('fleet-map-customer-list');
            Route::get('fleet-map-customer-details/{id}', [FleetMapViewController::class, 'fleetMapCustomerDetails'])->name('fleet-map-customer-details');
            Route::get('fleet-map-view-single-customer/{id}', [FleetMapViewController::class, 'fleetMapViewSingleCustomer'])->name('fleet-map-view-single-customer');
            Route::get('fleet-map-view-using-ajax', [FleetMapViewController::class, 'fleetMapViewUsingAjax'])->name('fleet-map-view-using-ajax');
            Route::get('fleet-map-safety-alert-icon-in-map', [FleetMapViewController::class, 'fleetMapSafetyAlertIconInMap'])->name('fleet-map-safety-alert-icon-in-map');
            Route::get('fleet-map-zone-message', [FleetMapViewController::class, 'fleetMapZoneMessage'])->name('fleet-map-zone-message');
        });

        Route::group(['prefix' => 'vehicle', 'as' => 'vehicle.'], function () {
            Route::group(['prefix' => 'attribute-setup', 'as' => 'attribute-setup.'], function () {
                Route::group(['prefix' => 'brand', 'as' => 'brand.'], function () {
                    Route::controller(VehicleBrandController::class)->group(function () {
                        Route::get('/', 'index')->name('index');
                        Route::post('store', 'store')->name('store');
                        Route::get('edit/{id}', 'edit')->name('edit');
                        Route::put('update/{id}', 'update')->name('update');
                        Route::delete('delete/{id}', 'destroy')->name('delete');
                        Route::get('status', 'status')->name('status');
                        Route::get('trashed', 'trashed')->name('trashed');
                        Route::get('restore/{id}', 'restore')->name('restore');
                        Route::delete('permanent-delete/{id}', 'permanentDelete')->name('permanent-delete');
                        Route::get('log', 'log')->name('log');
                        Route::get('export', 'export')->name('export');
                        Route::get('all-brands', 'getAllAjax')->name('all-brands');
                    });
                });

                Route::group(['prefix' => 'model', 'as' => 'model.'], function () {
                    Route::controller(VehicleModelController::class)->group(function () {
                        Route::get('/', 'index')->name('index');
                        Route::post('store', 'store')->name('store');
                        Route::get('edit/{id}', 'edit')->name('edit');
                        Route::put('update/{id}', 'update')->name('update');
                        Route::delete('delete/{id}', 'destroy')->name('delete');
                        Route::get('status', 'status')->name('status');
                        Route::get('log', 'log')->name('log');
                        Route::get('export', 'export')->name('export');
                        Route::get('ajax-models/{id}', 'ajax_models')->name('ajax-models');
                        Route::get('ajax-models-child/{id}', 'ajax_models_child')->name('ajax-childes-only');
                        Route::get('trashed', 'trashed')->name('trashed');
                        Route::get('restore/{id}', 'restore')->name('restore');
                        Route::delete('permanent-delete/{id}', 'permanentDelete')->name('permanent-delete');
                    });
                });
            });
        });

        Route::group(['prefix' => 'ride', 'as' => 'ride.', 'middleware' => ['module:ride']], function () {
            Route::get('list/{type?}', [TripRequestController::class, 'tripList'])->name('index');
            Route::get('details/{id}', [TripRequestController::class, 'show'])->name('show');
            Route::delete('delete/{id}', [TripRequestController::class, 'destroy'])->name('delete');
            Route::get('export', [TripRequestController::class, 'export'])->name('export');

            Route::get('invoice/{id}', [TripRequestController::class, 'invoice'])->name('invoice');
            Route::get('trashed', [TripRequestController::class, 'trashed'])->name('trashed');
            Route::get('restore/{id}', [TripRequestController::class, 'restore'])->name('restore');
        });

        Route::group(['prefix' => 'safety-alert', 'as' => 'safety-alert.', 'middleware' => ['module:ride']], function () {
            Route::get('list/{type}', [SafetyAlertController::class, 'index'])->name('index');
            Route::get('export/{type}', [SafetyAlertController::class, 'export'])->name('export');
            Route::put('mark-as-solved/{id}', [SafetyAlertController::class, 'markAsSolved'])->name('mark-as-solved');
            Route::put('ajax-mark-as-solved/{id}', [SafetyAlertController::class, 'ajaxMarkAsSolved'])->name('ajax-mark-as-solved');
        });
    });



    Route::group(['prefix' => 'business-settings', 'as' => 'business-settings.', 'middleware' => ['module:settings', 'actch']], function () {
        Route::group(['prefix' => 'ride-share', 'as' => 'ride-share.'], function () {
            Route::controller(BusinessInfoController::class)->group(function () {
                Route::get('update-business-setting', 'updateBusinessSetting')->name('update-business-setting');
                Route::get('settings', 'settings')->name('settings');
                Route::post('update-settings', 'updateSettings')->name('update-settings');
            });
        });
        Route::group(['prefix' => 'ride-fare', 'as' => 'ride-fare.'], function () {
            Route::controller(TripFareSettingController::class)->group(function () {
                Route::get('penalty', 'index')->name('penalty');
                Route::get('rides', 'tripIndex')->name('rides');
                Route::post('store', 'store')->name('store');
                Route::group(['prefix' => 'cancellation-reason', 'as' => 'cancellation_reason.'], function () {
                    Route::post('store', 'storeCancellationReason')->name('store');
                    Route::get('edit/{id}', 'editCancellationReason')->name('edit');
                    Route::put('update/{id}', 'updateCancellationReason')->name('update');
                    Route::delete('delete/{id}', 'destroyCancellationReason')->name('delete');
                    Route::get('status/{id}/{status}', 'statusCancellationReason')->name('status');
                });
            });
        });

        Route::group(['prefix' => 'rider', 'as' => 'rider.'], function () {
            Route::controller(DriverSettingController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('store', 'store')->name('store');
                Route::post('vehicle-update', 'vehicleUpdate')->name('vehicle-update');
            });
        });

        Route::group(['prefix' => 'safety-precaution', 'as' => 'safety-precaution.'], function () {
            Route::controller(SafetyAndPrecautionController::class)->group(function () {
                Route::get('/{type}', 'index')->name('index');
                Route::post('store', 'store')->name('store');
                Route::group(['prefix' => 'safety-alert-reason', 'as' => 'safety-alert-reason.'], function () {
                    Route::post('store', 'storeSafetyAlertReason')->name('store');
                    Route::get('edit/{id}', 'editSafetyAlertReason')->name('edit');
                    Route::post('update/{id}', 'updateSafetyAlertReason')->name('update');
                    Route::delete('delete/{id}', 'destroySafetyAlertReason')->name('delete');
                    Route::get('status/{id}/{status}', 'statusSafetyAlertReason')->name('status');
                });
                Route::group(['prefix' => 'precaution', 'as' => 'precaution.'], function () {
                    Route::post('store', 'storeSafetyPrecaution')->name('store');
                    Route::get('edit/{id}', 'editSafetyPrecaution')->name('edit');
                    Route::post('update/{id}', 'updateSafetyPrecaution')->name('update');
                    Route::delete('delete/{id}', 'destroySafetyPrecaution')->name('delete');
                    Route::get('status', 'statusSafetyPrecaution')->name('status');
                });
                Route::group(['prefix' => 'emergency-number-for-call', 'as' => 'emergency-number-for-call.'], function () {
                    Route::post('store', 'storeEmergencyNumberForCall')->name('store');
                });
            });
        });
    });

    Route::group(['prefix' => 'transactions', 'as' => 'transactions.', 'middleware' => ['module:ride_report']], function () {

        Route::group(['prefix' => 'ride-share', 'as' => 'ride-share.'], function () {
            Route::group(['prefix' => 'transaction', 'as' => 'transaction.'], function () {
                Route::controller(TransactionController::class)->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('export', 'export')->name('export');
                });
            });
            Route::group(['prefix' => 'report', 'as' => 'report.'], function () {
                Route::controller(ReportController::class)->group(function () {
                    Route::get('earning', 'earningReport')->name('earning');
                    Route::get('earningReportExport', 'earningReportExport')->name('earningReportExport');
                    Route::get('singleEarningReportExport/{id}', 'singleEarningReportExport')->name('singleEarningReportExport');
                    Route::get('dateZoneWiseEarningStatistics', 'dateZoneWiseEarningStatistics')->name('dateZoneWiseEarningStatistics');
                    Route::get('dateRideTypeWiseEarningStatistics', 'dateRideTypeWiseEarningStatistics')->name('dateRideTypeWiseEarningStatistics');
                    Route::get('dateZoneWiseExpenseStatistics', 'dateZoneWiseExpenseStatistics')->name('dateZoneWiseExpenseStatistics');
                    Route::get('dateRideTypeWiseExpenseStatistics', 'dateRideTypeWiseExpenseStatistics')->name('dateRideTypeWiseExpenseStatistics');
                    Route::get('expense', 'expenseReport')->name('expense');
                    Route::get('expenseReportExport', 'expenseReportExport')->name('expenseReportExport');
                    Route::get('singleExpenseReportExport/{id}', 'singleExpenseReportExport')->name('singleExpenseReportExport');
                });
            });
        });
    });

});