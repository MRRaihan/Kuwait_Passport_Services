<?php


use App\Http\Controllers\CallCenter\DashboardController;
use App\Http\Controllers\CallCenter\CallcenterController;
use App\Http\Controllers\CallCenter\ReportController;
use Illuminate\Support\Facades\Route;


// call-center route
Route::group(['prefix' => 'call-center/', 'as' => 'callCenter.', 'middleware' => ['auth', 'callCenter','prevent-back-history']], function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    Route::get('/edit-profile', [DashboardController::class, 'editProfile'])->name('editProfile');
    Route::post('/update-profile', [DashboardController::class, 'updateProfile'])->name('updateProfile');

    // Passport Option Delivery
    Route::get('passport-options/delivery', [CallcenterController::class,'delivery'])->name('passportOption.delivery');
    Route::post('passport-options/delivery/store', [CallcenterController::class,'deliveryStore'])->name('passportOption.delivery.store');
    Route::get('passport-options/delivery/{data}', [CallcenterController::class,'searchDelivery']);
    Route::post('passport-options/delivery/undo/{option}', [CallcenterController::class,'deliveryUndo'])->name('passportOption.delivery.undo');

    Route::post('passport-options/delivery/remarks/{id}', [CallcenterController::class,'remarksSave'])->name('passportOption.delivery.remarks');
    Route::post('passport-options/delivery/deafult-remarks/{data}', [CallcenterController::class,'deafultRemarksSave'])->name('passportOption.deafultRemarks');
    // All report
    Route::get('report', [ReportController::class, 'index'])->name('report.index');
    Route::get('remarks-report/{data}', [ReportController::class, 'getReport'])->name('report.excelExport');

});
