<?php


use App\Http\Controllers\AccountManager\DashboardController;
use App\Http\Controllers\AccountManager\ReportController;
use App\Http\Controllers\AccountManager\AllPassportReportController;
use App\Http\Controllers\AccountManager\OtherServices\AllOtherServicesReportController;

use Illuminate\Support\Facades\Route;

// account-manager route
Route::group(['prefix' => 'account-manager/', 'as' => 'accountManager.', 'middleware' => ['auth', 'accountManager']], function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    Route::get('/edit-profile', [DashboardController::class, 'editProfile'])->name('editProfile');
    Route::post('/update-profile', [DashboardController::class, 'updateProfile'])->name('updateProfile');

     // All Report Route
     Route::get('report', [ReportController::class, 'index'])->name('report.index');
     Route::get('report/{data}', [ReportController::class, 'show']);
     Route::get('get-report/{data}', [ReportController::class, 'getReport']);
     Route::get('report-excel-export/{data}', [ReportController::class, 'excelExport'])->name('report.excelExport');

     // All Other Services
     Route::get('other-services-report', [AllOtherServicesReportController::class, 'index'])->name('allOtherServicesReport.index');
     Route::get('other-services-report/{data}', [AllOtherServicesReportController::class, 'getReport'])->name('otherReport.excelExport');
     Route::get('all-other-services-report/{data}', [AllOtherServicesReportController::class, 'show']);
    
     // all passport report
     Route::get('all-passport-report', [AllPassportReportController::class, 'index'])->name('allPassportReport');
     Route::get('all-passport-report/{data}', [AllPassportReportController::class, 'show']);
     Route::get('get-all-passport-report/{data}', [AllPassportReportController::class, 'getReport']);
     Route::get('all-passport-report-excel-export/{data}', [AllPassportReportController::class, 'excelExport'])->name('allPassportReport.excelExport');
 
     // shift to embassy report
     Route::get('shift-to-embassy-report', [ReportController::class, 'shiftReport'])->name('shiftToEmbassyreport.index');
     Route::get('shift-to-embassy-report/{data}', [ReportController::class, 'getShiftReport'])->name('shiftToEmbassyReport.excelExport');
     
     // recieve form embassy report
     Route::get('receive-from-embassy-report', [ReportController::class, 'receiveReport'])->name('receiveFromEmbassyreport.index');
     Route::get('receive-from-embassy-report/{data}', [ReportController::class, 'getReceiveReport'])->name('receiveFromEmbassyReport.excelExport');
 
     // delivery to branch
     Route::get('delivery-to-branch-report', [ReportController::class, 'deliveryToBranchReport'])->name('deliveryBranchreport.index');
     Route::get('delivery-to-branch-report/{data}', [ReportController::class, 'getDeliveryToBranchReport'])->name('deliveryToBranchReport.excelExport');
 
     // delivery to user
     Route::get('delivery-report', [ReportController::class, 'deliveryReport'])->name('deliveryreport.index');
     Route::get('delivery-report/{data}', [ReportController::class, 'deliveryView'])->name('deliveryreport.view');
     Route::get('get-delivery-report/{data}', [ReportController::class, 'getDeliveryReport']);

});
