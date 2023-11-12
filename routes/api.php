<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Auth\LoginApiController;
use App\Http\Controllers\AuthController;

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

// authentication 
Route::post('login', [AuthController::class, 'userLogin']);
Route::post('registration', [AuthController::class, 'userRegistration']);
Route::get('email-verify', [AuthController::class, 'emailVerify']);
Route::post('user-info', [AuthController::class, 'userInfo']);

Route::middleware('auth:sanctum')->group(
    function () {
        //user
        Route::prefix('user')->middleware("permission:user-list")->group(
            function () {
                Route::post('details', [UserController::class, 'storeUserDetails']);
                Route::post('nominee', [UserController::class, 'storeNomineeInfo']);
            }
        );
    }
);

Route::get('/auth/access-token', [LoginApiController::class, 'createToken']);
