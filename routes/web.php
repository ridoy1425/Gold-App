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
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PrivacyController;
use App\Http\Controllers\RefundController;
use App\Http\Controllers\TermsController;
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

Route::get('/', [FrontendController::class, 'showLandingPage']);
Route::get('/privacy/policy', [FrontendController::class, 'privacyPage'])->name('privacy.Page');
Route::get('/refund/policy', [FrontendController::class, 'refund_policyPage'])->name('refund.policy.Page');
Route::get('/terms', [FrontendController::class, 'termsPage'])->name('terms.Page');

Route::middleware(['guest'])->group(
    function () {
        Route::get('/login', [AuthController::class, 'adminLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'adminLoginData']);
        Route::post('/registration', [AuthController::class, 'userRegistration']);
        Route::post('/admin-registration', [AuthController::class, 'adminRegistration']);
    }
);

Route::middleware(['auth'])->group(
    function () {
        Route::get('/logout', [AuthController::class, 'logout']);
        // Dashboard page--
        Route::get('/dashboard', [DashboardController::class, 'getDashboard'])->name('dashboard');
        //user
        Route::prefix('user')->middleware("permission:users")->group(
            function () {
                Route::get('index', [UserController::class, 'getUserList'])->name('user-list');
                Route::get('create', [UserController::class, 'userCreate'])->name('user-create');
                Route::post('store', [UserController::class, 'userStore']);
                Route::get('edit/{id}', [UserController::class, 'userEdit'])->name('user-edit');
                Route::post('update/{id}', [UserController::class, 'userUpdate']);
                Route::get('delete/{id}', [UserController::class, 'userDelete']);
                Route::post('send-notification', [UserController::class, 'mailNotification']);
                Route::post('password-change/{id}', [UserController::class, 'passwordUpdate']);
                Route::post('wallet', [UserController::class, 'updateWallet']);
                Route::post('/filter', [UserController::class, 'filterFormData']);
            }
        );
        //kyc
        Route::prefix('kyc')->middleware("permission:kyc")->group(
            function () {
                Route::get('index', [UserController::class, 'getKycData'])->name('kyc-list');
                Route::get('edit/{id}', [UserController::class, 'getKycEdit'])->name('kyc-edit');
                Route::post('status-update', [UserController::class, 'kycStatusUpdate']);
            }
        );
        //app settings
        Route::prefix('setting')->middleware("permission:app-settings")->group(
            function () {
                Route::get('index', [AppSettingsController::class, 'index'])->name('app-index');
                Route::post('gold-price-set', [AppSettingsController::class, 'goldPriceSet']);
                Route::post('gold-order-set', [AppSettingsController::class, 'goldOrderDataSet']);
                Route::post('minimum-price-set', [AppSettingsController::class, 'minimumPriceSet']);
                Route::post('profit-package-set', [AppSettingsController::class, 'profitPackageSet']);
                Route::get('package-delete/{id}', [AppSettingsController::class, 'packageDelete']);
                Route::post('add-poster', [AppSettingsController::class, 'addPoster']);
                Route::get('poster-delete/{id}', [AppSettingsController::class, 'posterDelete']);
                Route::post('bank-info', [BankInfoController::class, 'storeBankInfo']);
            }
        );

        //payment
        Route::prefix('payment')->middleware("permission:payments")->group(
            function () {
                Route::get('index', [PaymentController::class, 'index'])->name('payment-index');
                Route::post('add-wallet', [PaymentController::class, 'addWalletAmount']);
                Route::get('delete/{id}', [PaymentController::class, 'paymentDelete']);
                Route::get('transfer', [PaymentController::class, 'transferList'])->name('transfer-list');
                Route::get('withdraw', [PaymentController::class, 'withdrawList'])->name('withdraw-list');
                Route::post('/filter', [PaymentController::class, 'filterFormData'])->name('payment-filter');
            }
        );
        Route::get('transfer-delete/{id}', [PaymentController::class, 'transferDelete']);
        Route::post('transfer/filter', [PaymentController::class, 'filterTransferData'])->name('transfer-filter');
        Route::get('withdraw-delete/{id}', [PaymentController::class, 'withdrawDelete']);
        Route::post('withdraw-status', [PaymentController::class, 'changeWithdrawStatus']);
        Route::post('withdraw/filter', [PaymentController::class, 'filterWithdrawData'])->name('withdraw-filter');

        Route::prefix('order')->middleware("permission:orders")->group(
            function () {
                Route::get('/', [OrderController::class, 'getOrderList'])->name('Order-index');
                Route::get('profit-cancel/{id}', [OrderController::class, 'profitCancel']);
                Route::get('delete/{id}', [OrderController::class, 'orderDelete']);
                Route::post('status-change', [OrderController::class, 'changeOrderStatus']);
                Route::post('/filter', [OrderController::class, 'filterFormData'])->name('order-filter');
            }
        );

        Route::get('collect-request', [OrderController::class, 'getCollectRequestList'])->name('collect-request');
        Route::post('collect/filter', [OrderController::class, 'filterCollectionData'])->name('collect-filter');
        Route::post('change-collection-status', [OrderController::class, 'changeCollectionStatus']);
        Route::get('collection-delete/{id}', [OrderController::class, 'collectionDelete']);
        Route::post('change-profit-status', [OrderController::class, 'changeProfitStatus']);

        Route::prefix('message')->group(
            function () {
                Route::get('list', [NotificationController::class, 'index'])->name('message-inbox');
                Route::get('sent-message', [NotificationController::class, 'sentMessageList'])->name('sent-message');
                Route::get('mark-as-read', [NotificationController::class, 'markAsRead']);
                Route::get('count', [NotificationController::class, 'messageCount']);
                Route::post('send', [NotificationController::class, 'sendMessage']);
                Route::get('sendbox', [NotificationController::class, 'messagingSendBox'])->name('sendbox-index');
                Route::post('send-to-users', [NotificationController::class, 'messageSendToUser']);
                Route::prefix('template')->group(
                    function () {
                        Route::get('/', [NotificationController::class, 'messagingTemplate'])->name('template-index');
                        Route::get('create', [NotificationController::class, 'createTemplate'])->name('template-create');
                        Route::post('create', [NotificationController::class, 'saveTemplateData']);
                        Route::get('edit/{id}', [NotificationController::class, 'editTemplateData']);
                        Route::post('update/{id}', [NotificationController::class, 'updateTemplateData']);
                        Route::post('single', [NotificationController::class, 'singleTemplateData']);
                        Route::get('delete/{id}', [NotificationController::class, 'deleteTemplateData']);
                    }
                );
            }
        );
        //role & permission
        Route::prefix('role')->middleware("permission:manage-role")->group(
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

        //Privacy Page
        Route::prefix('privacy')->group(
            function () {
                Route::get('index', [PrivacyController::class, 'privacyIndex'])->name('privacy.Index');
                Route::get('privacy/list', [PrivacyController::class, 'privacyList'])->name('privacy.List');
                Route::post('privacy/create', [PrivacyController::class, 'privacyCreate'])->name('privacy.Create');
            }
        );

        //Refund Policies Page
        Route::prefix('refund')->group(
            function () {
                Route::get('index', [RefundController::class, 'refundIndex'])->name('refund.Index');
                Route::get('refund/list', [RefundController::class, 'refundList'])->name('refund.List');
                Route::get('refund/create', [RefundController::class, 'refundCreate'])->name('refund.Create');
            }
        );

        //Terms Page
        Route::prefix('terms')->group(
            function () {
                Route::get('index', [TermsController::class, 'termsIndex'])->name('terms.Index');
                Route::get('terms/list', [TermsController::class, 'termsList'])->name('terms.List');
                Route::post('terms/create', [TermsController::class, 'termsCreate'])->name('terms.Create');
            }
        );
        //Home Page
        Route::prefix('home')->group(
            function () {
                Route::get('about/index', [HomeController::class, 'aboutIndex'])->name('about.Index');
                Route::get('about/list', [HomeController::class, 'aboutList'])->name('about.List');
                Route::post('about/create', [HomeController::class, 'aboutCreate'])->name('about.Create');

                Route::get('question/index', [HomeController::class, 'questionIndex'])->name('question.Index');
                Route::get('question/list', [HomeController::class, 'questionList'])->name('question.List');
                Route::post('question/create', [HomeController::class, 'questionCreate'])->name('question.Create');

                Route::get('contact/index', [HomeController::class, 'contactIndex'])->name('contact.Index');
                Route::get('contact/list', [HomeController::class, 'contactList'])->name('contact.List');
                Route::post('contact/create', [HomeController::class, 'contactCreate'])->name('contact.Create');
            }
        );
    }
);
