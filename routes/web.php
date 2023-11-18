<?php

use App\Http\Controllers\AppraisalController;
use App\Http\Controllers\AppSettingsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BankInfoController;
use App\Http\Controllers\BranchInfoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DesignationInfoController;
use App\Http\Controllers\DesignationLabelController;
use App\Http\Controllers\EmployeeInfoController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

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

Route::middleware(['guest'])->group(
    function () {
        Route::get('/login', [AuthController::class, 'adminLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'adminLoginData']);
        Route::post('/registration', [AuthController::class, 'userRegistration']);
    }
);

Route::middleware(['auth'])->group(
    function () {
        Route::get('/logout', [AuthController::class, 'logout']);
        // Dashboard page--
        Route::get('/', [DashboardController::class, 'getDashboard'])->name('dashboard');
        //user
        Route::prefix('user')->middleware("permission:user-list")->group(
            function () {
                Route::get('index', [UserController::class, 'getUserList'])->name('user-list');
                Route::get('create', [UserController::class, 'userCreate'])->name('user-create');
                Route::post('store', [UserController::class, 'userStore']);
                Route::get('edit/{id}', [UserController::class, 'userEdit'])->name('user-edit');
                Route::patch('update/{id}', [UserController::class, 'userUpdate']);
                Route::get('delete/{id}', [UserController::class, 'userDelete']);
                Route::post('send-notification', [UserController::class, 'mailNotification']);
            }
        );
        //kyc
        Route::prefix('kyc')->middleware("permission:user-list")->group(
            function () {
                Route::get('index', [UserController::class, 'getKycData'])->name('kyc-list');
                Route::get('edit/{id}', [UserController::class, 'getKycEdit'])->name('kyc-edit');
                Route::post('status-update', [UserController::class, 'kycStatusUpdate']);
            }
        );
        //app settings
        Route::prefix('setting')->middleware("permission:user-list")->group(
            function () {
                Route::get('index', [AppSettingsController::class, 'index'])->name('app-index');
                Route::post('gold-price-set', [AppSettingsController::class, 'goldPriceSet']);
                Route::post('gold-order-set', [AppSettingsController::class, 'goldOrderDataSet']);
                Route::post('bank-info', [BankInfoController::class, 'storeBankInfo']);
            }
        );

        //payment
        Route::prefix('payment')->middleware("permission:user-list")->group(
            function () {
                Route::get('index', [PaymentController::class, 'index'])->name('payment-index');
                Route::post('add-wallet', [PaymentController::class, 'addWalletAmount']);
            }
        );
        Route::get('order', [PaymentController::class, 'getOrderList'])->name('Order-index');


        //role & permission
        Route::prefix('role')->middleware("permission:role-list")->group(
            function () {
                Route::get('index', [RoleController::class, 'getRoleList'])->name('role-list');
                Route::get('create', [RoleController::class, 'roleCreate'])->name('role-create');
                Route::post('store', [RoleController::class, 'roleStore']);
                Route::get('edit/{id}', [RoleController::class, 'roleEdit'])->name('role-edit');
                Route::patch('update/{id}', [RoleController::class, 'roleUpdate']);
                Route::get('delete/{id}', [RoleController::class, 'roleDelete']);
                Route::get('permission', [RoleController::class, 'getPermissionList'])->name('permission-list');
                Route::post('permission', [RoleController::class, 'setPermission']);
            }
        );
    }
);
