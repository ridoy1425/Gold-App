<?php

use App\Http\Controllers\AppraisalController;
use App\Http\Controllers\AppSettingsController;
use App\Http\Controllers\AuthController;
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
        // general settings--
        Route::prefix('designation')->group(
            function () {
                Route::prefix('label')->middleware("permission:designation-label")->group(
                    function () {
                        Route::get('/', [DesignationLabelController::class, 'getDegisnationLabel'])->name('designation-label');
                        Route::get('create', [DesignationLabelController::class, 'createDesignationLabel'])->name('desig-label-create');
                        Route::post('store', [DesignationLabelController::class, 'storeDesignationLabel']);
                        Route::get('edit/{id}', [DesignationLabelController::class, 'editDesignationLabel'])->name('desig-label-edit');
                        Route::patch('update/{id}', [DesignationLabelController::class, 'updateDesignationLabel']);
                        Route::get('delete/{id}', [DesignationLabelController::class, 'destroyDesignationLabel']);
                    }
                );
                Route::middleware("permission:designation-info")->group(
                    function () {
                        Route::get('info', [DesignationInfoController::class, 'getDegisnationInfo'])->name('designation-info');
                        Route::get('create', [DesignationInfoController::class, 'createDesignation'])->name('designation-create');
                        Route::post('store', [DesignationInfoController::class, 'storeDesignation']);
                        Route::get('edit/{id}', [DesignationInfoController::class, 'editDesignation'])->name('designation-edit');
                        Route::patch('update/{id}', [DesignationInfoController::class, 'updateDesignation']);
                        Route::get('delete/{id}', [DesignationInfoController::class, 'destroyDesignation']);
                    }
                );
                Route::post('get-designation', [DesignationInfoController::class, 'getDesignationByLabel']);
            }
        );
        Route::prefix('branch')->middleware("permission:branch-information")->group(
            function () {
                Route::get('info', [BranchInfoController::class, 'getBranchInfo'])->name('branch-info');
                Route::get('create', [BranchInfoController::class, 'createBranch'])->name('branch-create');
                Route::post('store', [BranchInfoController::class, 'storeBranch']);
                Route::get('edit/{id}', [BranchInfoController::class, 'editBranch'])->name('branch-edit');
                Route::patch('update/{id}', [BranchInfoController::class, 'updateBranch']);
                Route::get('delete/{id}', [BranchInfoController::class, 'destroyBranch']);
            }
        );
        // employees information--
        Route::prefix('employee')->middleware("permission:employee-information")->group(
            function () {
                Route::get('info', [EmployeeInfoController::class, 'getEmployeeInfo'])->name('employee-info');
                Route::post('store', [EmployeeInfoController::class, 'employeeInfoStore']);
                Route::post('address', [EmployeeInfoController::class, 'employeeAddressStore']);
                Route::post('profile-image', [EmployeeInfoController::class, 'profileImageStore']);
                Route::post('academic-info', [EmployeeInfoController::class, 'employeeAcademicInfo']);
                Route::post('employment-info', [EmployeeInfoController::class, 'employmentInfo']);
                Route::post('professional-info', [EmployeeInfoController::class, 'professionalInfo']);
                Route::post('training-info', [EmployeeInfoController::class, 'trainingInfo']);
                Route::post('others-info', [EmployeeInfoController::class, 'othersInfo']);
                Route::post('family-info', [EmployeeInfoController::class, 'familyInfo']);
                Route::post('nominee-info', [EmployeeInfoController::class, 'nomineeInfo']);
                Route::post('salary-info', [EmployeeInfoController::class, 'salaryInfo']);
                Route::post('promotion-info', [EmployeeInfoController::class, 'promotionInfo']);
                Route::get('search', [EmployeeInfoController::class, 'employeeSearch']);
                Route::get('report-search', [EmployeeInfoController::class, 'reportSearch'])->name('report-search');
                Route::get('edit/{id}', [EmployeeInfoController::class, 'employeeEdit']);
                Route::get('list', [EmployeeInfoController::class, 'employeeList'])->name('employee-list');
                Route::get('report-page/{id}', [EmployeeInfoController::class, 'reportPage']);
                Route::get('/get-degrees', [EmployeeInfoController::class, 'getDegree']);
                Route::get('/delete/{id}', [EmployeeInfoController::class, 'employeeDelete']);
                Route::get('summary-report', [EmployeeInfoController::class, 'staffSummaryReport'])->name('staff-summary-report');
                Route::get('search-summary-report', [EmployeeInfoController::class, 'searchSummaryReport'])->name('staff-summary-result');
            }
        );
        // employees information--
        Route::prefix('leave')->group(
            function () {
                Route::middleware("permission:leave-type")->group(
                    function () {
                        Route::get('index', [LeaveController::class, 'getLeaveType'])->name('leave-type');
                        Route::get('type', [LeaveController::class, 'leaveTypeview'])->name('leave-type-create');
                        Route::get('type/edit/{id}', [LeaveController::class, 'leaveTypeEdit'])->name('leave-type-edit');
                        Route::post('type', [LeaveController::class, 'leaveTypeStore']);
                        Route::patch('type/{id}', [LeaveController::class, 'leaveTypeUpdate']);
                        Route::get('type/delete/{id}', [LeaveController::class, 'leaveTypeDestroy']);
                    }
                );
                Route::middleware("permission:leave-entry")->group(
                    function () {
                        Route::get('entry/index', [LeaveController::class, 'getLeaveEntry'])->name('leave-entry-index');
                        Route::get('entry', [LeaveController::class, 'leaveEntry'])->name('leave-entry');
                        Route::post('entry', [LeaveController::class, 'leaveEntryStore']);
                        Route::get('entry/edit/{id}', [LeaveController::class, 'leaveEntryEdit'])->name('leave-entry-edit');
                        Route::patch('entry/update/{id}', [LeaveController::class, 'leaveEntryUpdate']);
                        Route::get('entry/delete/{id}', [LeaveController::class, 'leaveEntryDestroy']);
                    }
                );
                Route::middleware("permission:leave-approval")->group(
                    function () {
                        Route::get('approval', [LeaveController::class, 'getLeaveData'])->name('leave-approval');
                        Route::post('approval', [LeaveController::class, 'leaveApproval']);
                        Route::get('single/{id}', [LeaveController::class, 'getSingleLeave']);
                    }
                );
                Route::get('get-available-days', [LeaveController::class, 'getAvailableDays']);
                Route::get('application-form', [LeaveController::class, 'leaveApplicationForm'])->name('leave-application-form');
                Route::get('register', [LeaveController::class, 'leaveRegister'])->name('leave-register');
                Route::get('register-search', [LeaveController::class, 'leaveRegisterSearch']);
                Route::get('statement/{id}', [LeaveController::class, 'leaveStatement'])->name('leave.statement');
            }
        );

        //role & permission
        Route::prefix('appraisal')->group(
            function () {
                Route::prefix('category')->group(
                    function () {
                        Route::get('index', [AppraisalController::class, 'getCategoryList'])->name('appraisal-category');
                        Route::get('create', [AppraisalController::class, 'createCategory'])->name('category-create');
                        Route::post('store', [AppraisalController::class, 'storeCategory']);
                        Route::get('edit/{id}', [AppraisalController::class, 'editCategory']);
                        Route::patch('update/{id}', [AppraisalController::class, 'updateCategory']);
                        Route::get('delete/{id}', [AppraisalController::class, 'deleteCategory']);
                    }
                );
                Route::prefix('evaluator')->group(
                    function () {
                        Route::get('index', [AppraisalController::class, 'getEvaluatorList'])->name('appraisal-evaluator');
                        Route::get('create', [AppraisalController::class, 'createEvaluator'])->name('evaluator-create');
                        Route::post('store', [AppraisalController::class, 'storeEvaluator']);
                        Route::get('edit/{id}', [AppraisalController::class, 'editEvaluator']);
                        Route::patch('update/{id}', [AppraisalController::class, 'updateEvaluator']);
                        Route::get('delete/{id}', [AppraisalController::class, 'deleteEvaluator']);
                    }
                );
                Route::prefix('responsibility')->group(
                    function () {
                        Route::get('index', [AppraisalController::class, 'getDutyResponsibilityList'])->name('duty-responsibilities');
                        Route::get('create', [AppraisalController::class, 'createDutyResponsibility'])->name('duty-create');
                        Route::post('store', [AppraisalController::class, 'storeDutyResponsibility']);
                        Route::get('edit/{id}', [AppraisalController::class, 'editDutyResponsibility']);
                        Route::patch('update/{id}', [AppraisalController::class, 'updateDutyResponsibility']);
                        Route::get('delete/{id}', [AppraisalController::class, 'deleteDutyResponsibility']);
                    }
                );
                Route::prefix('behavior')->group(
                    function () {
                        Route::get('index', [AppraisalController::class, 'getAttitudeBehaviorList'])->name('attitude-behavior');
                        Route::get('create', [AppraisalController::class, 'createAttitudeBehavior'])->name('behavior-create');
                        Route::post('store', [AppraisalController::class, 'storeAttitudeBehavior']);
                        Route::get('edit/{id}', [AppraisalController::class, 'editAttitudeBehavior']);
                        Route::patch('update/{id}', [AppraisalController::class, 'updateAttitudeBehavior']);
                        Route::get('delete/{id}', [AppraisalController::class, 'deleteAttitudeBehavior']);
                    }
                );

                Route::get('index', [AppraisalController::class, 'getAppraisalList'])->name('evaluation-form');
                Route::get('list', [AppraisalController::class, 'reportList'])->name('evaluation-list');
                Route::get('form', [AppraisalController::class, 'evaluationForm'])->name('evaluation-edit');
                Route::post('form', [AppraisalController::class, 'evaluationFormSubmit']);
                Route::get('search', [AppraisalController::class, 'appraisalSearch']);
                Route::get('evaluation/search', [AppraisalController::class, 'evaluationSearch']);
                Route::get('report', [AppraisalController::class, 'appraisalReport'])->name('appraisal-report');
                Route::get('summary-report', [AppraisalController::class, 'appraisalSummaryReport'])->name('appraisal-summary-report');
            }
        );

        //user
        Route::prefix('user')->middleware("permission:user-list")->group(
            function () {
                Route::get('index', [UserController::class, 'getUserList'])->name('user-list');
                Route::get('create', [UserController::class, 'userCreate'])->name('user-create');
                Route::post('store', [UserController::class, 'userStore']);
                Route::get('edit/{id}', [UserController::class, 'userEdit'])->name('user-edit');
                Route::patch('update/{id}', [UserController::class, 'userUpdate']);
                Route::get('delete/{id}', [UserController::class, 'userDelete']);
            }
        );
        //kyc
        Route::prefix('kyc')->middleware("permission:user-list")->group(
            function () {
                Route::get('index', [UserController::class, 'getKycData'])->name('kyc-list');
                Route::get('edit/{id}', [UserController::class, 'getKycEdit'])->name('kyc-edit');
            }
        );
        //app settings
        Route::prefix('app')->middleware("permission:user-list")->group(
            function () {
                Route::get('index', [AppSettingsController::class, 'index'])->name('app-index');
            }
        );

        //payment
        Route::prefix('payment')->middleware("permission:user-list")->group(
            function () {
                Route::get('index', [PaymentController::class, 'index'])->name('payment-index');
            }
        );
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
