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
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('registration', [AuthController::class, 'userRegistration']);
Route::get('email-verify', [AuthController::class, 'emailVerify']);
Route::post('user-info', [AuthController::class, 'userInfo']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/auth/access-token', [LoginApiController::class, 'createToken']);
