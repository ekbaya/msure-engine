<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClaimsController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PlacesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ReasonController;
use App\Http\Controllers\UserController;
use App\Models\Customer;
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
    Route::post('callbacl_url', [PaymentController::class, 'callback']);
    Route::post('reasons', [ReasonController::class, 'create']);

    // Places
    Route::get('places/regions', [PlacesController::class, 'regions']);
    Route::get('places/counties/{region_id}', [PlacesController::class, 'counties']);
    Route::get('places/sub_counties/{county_id}', [PlacesController::class, 'subCounties']);
    Route::get('places/wards/{sub_county_id}', [PlacesController::class, 'wards']);
    Route::get('places/stages/{ward_id}', [PlacesController::class, 'stages']);
});

Route::group(['middleware' => ['auth:api', 'role:customer'], 'prefix' => 'v1'], function () {
    Route::get('/user', function (Request $request) {
        log::info('++++ Incoming Request ++++++' . $request);
        $customer = Customer::query()->where('user_id', $request->user()->user_id)->firstOrFail();
        $customer->stage;//preload
        return response()->json([
            "status"=> 0,
            "sucess"=> true,
            "message"=>"User Account Fetched Sucessfully",
            "user"=>$customer,
        ]);
    });
    Route::get('users', [UserController::class, 'index']);
    Route::put('users', [UserController::class, 'update']);
    Route::put('users/profile', [UserController::class, 'updateProfile']);
    Route::get('user-status', [UserController::class, 'status']);
    Route::get('user/service-accounts', [CustomerController::class, 'serviceAccounts']);
    Route::get('user/payments', [PaymentController::class, 'userTransactions']);
    Route::get('user/payments/{filter}', [PaymentController::class, 'userTransactions']);


    Route::get('products', [ProductsController::class, 'index']);
    Route::post('policy/buy', [ProductsController::class, 'purchasePolicy']);
    Route::get('policy', [ProductsController::class, 'customerPolicy']);
    Route::get('policy/active', [ProductsController::class, 'customerActivepolicy']);
    Route::delete('policy/{id}', [ProductsController::class, 'cancelPolicy']);


    Route::get('claims', [ClaimsController::class, 'customerClaims']);
    Route::get('claims/{id}', [ClaimsController::class, 'claimDetails']);
    Route::post('claims', [ClaimsController::class, 'initiateClaim']);

    Route::get('reasons', [ReasonController::class, 'index']);
    Route::post('messages', [MessageController::class, 'create']);
    Route::get('messages', [MessageController::class, 'userMessages']);
    Route::get('messages/all', [MessageController::class, 'index']);
});


//Merchants
Route::prefix('client')->group(function () {
    Route::post('accounts', [AccountController::class, 'create']);
    Route::post('authenticate', [AccountController::class, 'authenticate']);
});
Route::group(['middleware' => ['auth:api', 'role:merchant'], 'prefix' => 'client'], function () {
    Route::get('customers', [UserController::class, 'index']);
    Route::get('payments', [PaymentController::class, 'index']);
    Route::get('customer-status', [UserController::class, 'status']);
    Route::get('products', [ProductsController::class, 'index']);
    Route::get('places/regions', [PlacesController::class, 'regions']);
    Route::get('places/counties/{region_id}', [PlacesController::class, 'counties']);
    Route::get('places/sub_counties/{county_id}', [PlacesController::class, 'subCounties']);
    Route::get('places/wards/{sub_county_id}', [PlacesController::class, 'wards']);
    Route::get('places/stages/{ward_id}', [PlacesController::class, 'stages']);
    Route::post('places/wards', [PlacesController::class, 'createWard']);
    Route::post('places/stages', [PlacesController::class, 'addStage']);
});
