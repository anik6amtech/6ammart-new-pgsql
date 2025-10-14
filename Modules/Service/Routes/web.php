<?php

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

use Illuminate\Support\Facades\Route;
use Modules\Service\Http\Controllers\PaymentController;
use Modules\Service\Http\Controllers\Web\Provider\ProviderManagement\ProviderController;

Route::match(['get', 'post'],'payment', [PaymentController::class, 'index']);
Route::post('provider-payment', [ProviderController::class, 'payment'])->name('provider.payment');
Route::get('provider-final-step', [ProviderController::class, 'final_step'])->name('provider.final_step');
