<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Auth\LoginApiController;
use App\Http\Controllers\AppSettingsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BankInfoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;

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

// request()->headers->set('Accept', 'application/json');
// authentication
Route::post('login', [AuthController::class, 'userLogin']);
Route::post('registration', [AuthController::class, 'userRegistration']);
Route::get('email-verify', [AuthController::class, 'emailVerify']);
Route::post('user-info', [AuthController::class, 'userInfo']);
Route::get('payload', [DashboardController::class, 'getPayloadData']);

Route::prefix('password')->group(function () {
    Route::post('forgot', [AuthController::class, 'forgotPassword']);
    Route::post('token/verify', [AuthController::class, 'verifyForgotPasswordToken']);
    Route::post('reset', [AuthController::class, 'resetPassword']);
});

Route::middleware('auth:sanctum')->group(
    function () {
        Route::get('auth-user', [AuthController::class, 'getAuthUser']);
        Route::get('logout', [AuthController::class, 'userLogout']);

        //user
        Route::prefix('user')->group(
            function () {
                Route::post('details', [UserController::class, 'storeUserDetails']);
                Route::post('nominee', [UserController::class, 'storeNomineeInfo']);
                Route::post('bank-info', [BankInfoController::class, 'storeBankInfo']);
                Route::post('mobile-banking', [BankInfoController::class, 'storeMobileBankingInfo']);
                Route::post('delivery-info', [BankInfoController::class, 'storeDeliveryInfo']);
                Route::get('check', [UserController::class, 'userCheck']);
            }
        );

        Route::prefix('payment')->group(
            function () {
                Route::post('request', [PaymentController::class, 'paymentRequest']);
                Route::post('transfer', [PaymentController::class, 'paymentTransfer']);
                Route::post('withdraw', [PaymentController::class, 'withdrawRequest']);
            }
        );
        Route::get('package/list', [AppSettingsController::class, 'packageList']);
        Route::get('transactions-data', [OrderController::class, 'transactionData']);
        //user
        Route::prefix('order')->group(
            function () {
                Route::get('list', [OrderController::class, 'getOrderList']);
                Route::post('create', [OrderController::class, 'orderCreate']);
                Route::get('gold-price', [OrderController::class, 'goldPrice']);
                Route::post('profit', [OrderController::class, 'profitCalculation']);
                Route::post('collect-request', [OrderController::class, 'collectRequest']);
            }
        );

        Route::prefix('settings')->group(
            function () {
                Route::get('index', [AppSettingsController::class, 'index'])->name('app-index');
            }
        );

        Route::prefix('message')->group(
            function () {
                Route::get('list', [NotificationController::class, 'index']);
                Route::get('mark-as-read', [NotificationController::class, 'markAsRead']);
                Route::get('count', [NotificationController::class, 'messageCount']);
                Route::post('send', [NotificationController::class, 'sendMessage']);
            }
        );
    }
);
