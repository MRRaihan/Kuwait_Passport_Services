<?php

use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\CorporateController;
use App\Http\Controllers\Frontend\CorporateServiceController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrintController;
use Illuminate\Support\Carbon;

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

Route::get('/', [FrontendController::class, 'landingPage'])->name('forntend.index');

Route::get('/accountManager/login', function () {
    return view('Frontend.login.accountsLogin');
})->name('accountManager.login');

Route::get('/branchManager/login', function () {
    return view('Frontend.login.managerLogin');
})->name('branchManager.login');

Route::get('/dataEntry/login', function () {
    return view('Frontend.login.dataEntryLogin');
})->name('dataEntry.login');

Route::get('/callCenter/login', function () {
    return view('Frontend.login.callCenterLogin');
})->name('callCenter.login');

Route::get('/embassy/login', function () {
    return view('Frontend.login.embassyLogin');
})->name('embassy.login');

Route::get('/admin-login', function () {
    // return view('welcome');
    return view('custom-welcome');
})->name('forntend.login');

// For system reboot
Route::get('/reboot', [FrontendController::class, 'reboot']);

Route::post('change-password', [HomeController::class, 'changePassword'])->name('changePassword');

//print controller
Route::get('service-print-receipt/{id}/{type}', [PrintController::class, 'printReceipt'])->name('printReceipt');
Route::get('service-print-sticker/{id}/{type}', [PrintController::class, 'printSticker'])->name('printSticker');


// user route start
Route::get('/service-list/{data}', [FrontendController::class, 'index'])->name('service.list');
Route::get('/service/{data}', [FrontendController::class, 'service'])->name('service');

Route::post('/user/service-store', [FrontendController::class, 'serviceStore'])->name('service.store');
Route::post('/user/service-update/{data}', [FrontendController::class, 'serviceUpdate'])->name('service.update');

Route::get('/user/service-status/{data}', [FrontendController::class, 'serviceStatus'])->name('service.status');
Route::get('/user/service-payment/{data}', [FrontendController::class, 'servicePayment'])->name('service.payment');

Route::get('/user-login', [UserController::class, 'userLogin'])->name('userLogin');

Route::get('/user-registration', [UserController::class, 'userReg'])->name('userReg');
Route::post('/user/user-store', [UserController::class, 'userStore'])->name('userStore');
Route::get('/user/otp_Sent_Again/{phone}', [UserController::class, 'otpSentAgain'])->name('userOtpSentAgain');
Route::get('user/view-otp', [UserController::class, 'userOtp'])->name('userOtp');
Route::post('user/otp-check', [UserController::class, 'checkOtp'])->name('otpCheck');

Route::get('/view-information', [UserController::class, 'userPersonalInformation'])->name('userPersonalInformation');
Route::post('/information-store', [UserController::class, 'informationStore'])->name('informationStore');

Route::get('check-passport-status/{data}', [UserController::class, 'passportStatus'])->name('passport.status');

//normal user deshbord

Route::group(['prefix' => 'user/', 'as' => 'normalUser.', 'middleware' => ['auth', 'normalUser']], function () {

    Route::get('dashboard/index', [UserController::class, 'index'])->name('dashbord');

    Route::get('user-payment', [UserController::class, 'userPayment'])->name('payment');
    Route::get('user-security', [UserController::class, 'securityUpdate'])->name('security');
    Route::get('user-profile', [UserController::class, 'profileUpdate'])->name('profile');
    Route::get('dashboard/status-pending', [UserController::class, 'statusPending'])->name('statusPending');
    Route::get('dashboard/status-review', [UserController::class, 'statusReview'])->name('statusReview');
    Route::get('dashboard/status-completed', [UserController::class, 'statusCompleted'])->name('statusCompleted');
    Route::post('profile-information-update', [UserController::class, 'profileInformationUpdate'])->name('profileInformationUpdate');
    Route::post('/password-check', [UserController::class, 'passwordCheck'])->name('passwordCheck');
    Route::post('/password-update', [UserController::class, 'passwordUpdate'])->name('passwordUpdate');
});
//user route end


// Corporate user start

Route::get('/corporate-login', [CorporateController::class, 'corporateLogin'])->name('corporate.login');
Route::get('/corporate-registration', [CorporateController::class, 'corporateRegistration'])->name('corporate.registration');
Route::post('/corporate-user-store', [CorporateController::class, 'corporateUserStore'])->name('corporateUserStore');
Route::get('/corporate-otp', [CorporateController::class, 'corporateOtp'])->name('corporateOtp');
Route::post('/corporate-otp', [CorporateController::class, 'corporateCheckOtp'])->name('corporateCheckOtp');
Route::get('/corporate-otp-agin/{phone}', [CorporateController::class, 'otpSentAgain'])->name('corporateOtpSentAgain');
Route::get('/corporate-infor-update', [CorporateController::class, 'informationInput'])->name('corporateInforStore');
Route::post('/corporate-infor-update', [CorporateController::class, 'informationStore'])->name('corporateInforUpdate');


//cormporate deshbord
Route::group(['prefix' => 'corporate/', 'as' => 'corporateUser.', 'middleware' => ['auth', 'corporateUser']], function () {

    Route::get('dashboard/index', function () {
        return view('CorporateUserDeshbord.index');
    })->name('dashbord');

    Route::get('profile-update', [CorporateController::class, 'profileInformationView'])->name('profile.update');
    Route::post('profile-update', [CorporateController::class, 'profileInformationUpdate'])->name('profile.updatePost');
    Route::get('profile-security', [CorporateController::class, 'securityView'])->name('security.view');
    Route::post('/password-check', [CorporateController::class, 'passwordCheck'])->name('passwordCheck');
    Route::post('/password-update', [CorporateController::class, 'passwordUpdate'])->name('passwordUpdate');

    Route::get('services/{data}', [CorporateServiceController::class, 'index'])->name('service.index');
    Route::get('service-create/{data}', [CorporateServiceController::class, 'create'])->name('service.create');
    Route::post('service-store', [CorporateServiceController::class, 'store'])->name('service.store');
    Route::get('service-edit/{data}', [CorporateServiceController::class, 'edit'])->name('service.edit');
    Route::post('service-update/{data}', [CorporateServiceController::class, 'update'])->name('service.update');
    Route::get('service-status/{data}', [CorporateServiceController::class, 'edit'])->name('service.status');
    Route::get('service-payment/{data}', [CorporateServiceController::class, 'payment'])->name('service.payment');


    Route::get('service-pending', [CorporateServiceController::class, 'pending'])->name('service.pending');
    Route::get('service-reviewed', [CorporateServiceController::class, 'reviewed'])->name('service.reviewed');
    Route::get('service-completed', [CorporateServiceController::class, 'completed'])->name('service.completed');
    Route::get('services-payment-list', [CorporateServiceController::class, 'paymentList'])->name('service.paymentList');
});

//Corporate user end

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/branchManager.php';
require __DIR__ . '/dataEnterer.php';
require __DIR__ . '/callCenter.php';
require __DIR__ . '/accountManager.php';
require __DIR__ . '/embassy.php';
