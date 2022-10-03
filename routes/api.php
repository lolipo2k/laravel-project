<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('promocode/check', [\App\Http\Controllers\Api\PromocodeController::class, 'check']);
Route::get('service/get/additionals', [\App\Http\Controllers\Api\ServiceController::class, 'getAdditionals']);
Route::get('service/get/furniture', [\App\Http\Controllers\Api\ServiceController::class, 'getFurniture']);
Route::post('orders/create', [\App\Http\Controllers\Api\OrdersController::class, 'createNewOrder']);
Route::post('user/check/email', [\App\Http\Controllers\Api\UserController::class, 'checkEmail']);
