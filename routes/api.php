<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
});

Route::get('productplan/getplan/{id}', [App\Http\Controllers\ProductPlanController::class, 'getPlan'])->name('product.plan.getplan');
Route::get('billing/sedingmode/{id}/{value}', [App\Http\Controllers\BillingController::class, 'updateSendingMethod'])->name('billing.updatemode');

Route::get('notice', [App\Http\Controllers\NotificationController::class, 'index'])->name('notice');
Route::get('messaging/test', [App\Http\Controllers\NotificationController::class, 'test'])->name('messaging.alert.test');
