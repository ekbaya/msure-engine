<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;


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

Route::prefix('v1')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('verify-otp', [AuthController::class, 'verifyOtp']);
});

Route::group(['middleware' => 'auth:api', 'prefix' => 'v1'], function () {
    Route::get('/user', function (Request $request) {
        log::info('++++ Incoming Request ++++++' . $request);
        return $request->user();
    });
    Route::get('user-status', [UserController::class, 'status']);
    Route::get('products', [ProductsController::class, 'index']);
    Route::post('products/buy', [ProductsController::class, 'purchasepolicy']);
});
