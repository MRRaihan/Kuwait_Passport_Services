<?php


use App\Http\Controllers\Embassy\DashboardController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Embassy\PassportOptionsController;
use App\Http\Controllers\Embassy\ReportController;

// embassy route
Route::group(['prefix' => 'embassy/', 'as' => 'embassy.', 'middleware' => ['auth', 'embassy','prevent-back-history']], function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    Route::get('/edit-profile', [DashboardController::class, 'editProfile'])->name('editProfile');
    Route::post('/update-profile', [DashboardController::class, 'updateProfile'])->name('updateProfile');

    // Receive To Embassy
    Route::get('/passport-option/receive-to-embassy', [PassportOptionsController::class, 'receiveToEmbassy'])->name('passportOption.receiveToEmbassy');
    Route::post('passport-options/receive-to-embassy/store', [PassportOptionsController::class,'receiveToEmbassyStore'])->name('passportOption.receiveToEmbassy.store');
    Route::get('passport-options/receive-to-embassy/{data}', [PassportOptionsController::class,'searchReceive']);
    Route::post('passport-options/receive-to-embassy/undo/{option}', [PassportOptionsController::class,'receiveToEmbassyUndo'])->name('passportOption.receiveToEmbassy.undo');
    Route::post('passport-options/receive-to-embassy/bio-enrollment-id/{id}', [PassportOptionsController::class,'bioEnrollmentIdSave'])->name('passportOption.receiveToEmbassy.bioEnrollmentId');

    // Passport Delivery
    Route::get('/passport-option/delivery', [PassportOptionsController::class, 'delivery'])->name('passportOption.delivery');
    Route::get('/passport-option/all-delivery', [PassportOptionsController::class, 'allDelivery'])->name('passportOption.allDelivery');
    Route::get('/passport-option/all-delivery/{data}', [PassportOptionsController::class, 'searchAllDelivery']);
    Route::post('passport-options/delivery/store', [PassportOptionsController::class,'deliveryStore'])->name('passportOption.delivery.store');
    Route::get('passport-options/delivery/{data}', [PassportOptionsController::class,'searchDelivery']);
    Route::post('passport-options/delivery/undo/{option}', [PassportOptionsController::class,'deliveryUndo'])->name('passportOption.delivery.undo');
    Route::post('passport-options/delivery/remarks/{id}', [PassportOptionsController::class,'remarksSave'])->name('passportOption.delivery.remarks');

    // Embassy Interact Report Route
    Route::get('delivery-report', [ReportController::class, 'deliveryReport'])->name('deliveryreport.index');
    Route::get('delivery-report/{data}', [ReportController::class, 'getDeliveryReport'])->name('deliveryToAdminReport.excelExport');
});
