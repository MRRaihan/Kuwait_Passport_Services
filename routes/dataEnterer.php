<?php


use App\Http\Controllers\DataEnterer\DashboardController;
use App\Http\Controllers\DataEnterer\LostPassportController;
use App\Http\Controllers\DataEnterer\NewBornBabyPassportController;
use App\Http\Controllers\DataEnterer\ManualPassportController;
use App\Http\Controllers\DataEnterer\RenewPassportController;
use App\Http\Controllers\DataEnterer\RenewManualPassportController;
use App\Http\Controllers\DataEnterer\ExtraServiceAddController;
use App\Http\Controllers\DataEnterer\ReportController;
use App\Http\Controllers\DataEnterer\PassportProcessingController;

use App\Http\Controllers\DataEnterer\OtherServices\OtherServiceController;
use App\Http\Controllers\DataEnterer\OtherServices\ExpressServiceController;
use App\Http\Controllers\DataEnterer\OtherServices\ImmigrationGovementServiceController;
use App\Http\Controllers\DataEnterer\OtherServices\PremierServiceController;
use App\Http\Controllers\DataEnterer\OtherServices\LegalComplaintsServiceController;
use App\Http\Controllers\DataEnterer\OtherServices\OtherServicesReportController;
use Illuminate\Support\Facades\Route;

// data-enterer route
Route::group(['prefix' => 'data-enterer/', 'as' => 'dataEnterer.', 'middleware' => ['auth', 'dataEnterer','prevent-back-history']], function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    Route::get('/edit-profile', [DashboardController::class, 'editProfile'])->name('editProfile');
    Route::post('/update-profile', [DashboardController::class, 'updateProfile'])->name('updateProfile');

    // Dashboard
    Route::get('/lostPassport/report/{data}', [DashboardController::class, 'reportLostPassport']);
    Route::get('/manualPassport/report/{data}', [DashboardController::class, 'reportManualPassport']);
    Route::get('/renuePassport/report/{data}', [DashboardController::class, 'reportRenuePassport']);
    Route::get('/newBornBaby/report/{data}', [DashboardController::class, 'reportNewBornBaby']);

    Route::get('/premierPassport/report/{data}', [DashboardController::class, 'reportPremierService']);
    Route::get('/expressPassport/report/{data}', [DashboardController::class, 'reportExpressService']);
    Route::get('/legalComplaintsPassport/report/{data}', [DashboardController::class, 'reportLegalComplaintsService']);
    Route::get('/immigrationGovementService/report/{data}', [DashboardController::class, 'reportImmigrationGovementService']);
    Route::get('/other/report/{data}', [DashboardController::class, 'reportOtherService']);
    //lost Passport
    Route::resource('lostPassport', LostPassportController::class);
    Route::get('lost-passport/create-second', [LostPassportController::class, 'createSecond'])->name('lostPassport.createSecond');
    Route::post('lost-passport/store-second', [LostPassportController::class, 'storeSecond'])->name('lostPassport.storeSecond');
    Route::get('lostPassport/receipt/{id}', [LostPassportController::class, 'printReceipt'])->name('lostPassport.receipt');
    Route::get('lostPassport/sticker/{id}', [LostPassportController::class, 'printSticker'])->name('lostPassport.sticker');
    Route::post('lostPassport/shiftToBranchManagerNow/{id}', [LostPassportController::class, 'shiftToBranchManagerNow'])->name('lostPassport.shiftToBranchManagerNow');
    Route::get('lostPassport/agreement/{id}', [LostPassportController::class, 'agreement'])->name('lostPassport.agreement');


    Route::post('lostPassport/search_by_civil', [LostPassportController::class, 'search_by_civil'])->name('lostPassport.search_by_civil');
    Route::post('lostPassport/search_by_passport_number', [LostPassportController::class, 'search_by_passport_number'])->name('lostPassport.search_by_passport_number');
    Route::post('lostPassport/search_by_profession', [LostPassportController::class, 'search_by_profession'])->name('lostPassport.search_by_profession');


    // New Born Baby Passport
    Route::resource('newBornBabyPassport', NewBornBabyPassportController::class);
    Route::get('new-born-baby-passport/create-second', [NewBornBabyPassportController::class, 'createSecond'])->name('newBornBabyPassport.createSecond');
    Route::post('new-born-baby-passport/store-second', [NewBornBabyPassportController::class, 'storeSecond'])->name('newBornBabyPassport.storeSecond');
    Route::get('newBornBabyPassport/receipt/{id}', [NewBornBabyPassportController::class, 'printReceipt'])->name('newBornBabyPassport.receipt');
    Route::get('newBornBabyPassport/sticker/{id}', [NewBornBabyPassportController::class, 'printSticker'])->name('newBornBabyPassport.sticker');
    Route::post('newBornBabyPassport/shiftToBranchManagerNow/{id}', [NewBornBabyPassportController::class, 'shiftToBranchManagerNow'])->name('newBornBabyPassport.shiftToBranchManagerNow');
    Route::get('newBornBabyPassport/agreement/{id}', [NewBornBabyPassportController::class, 'agreement'])->name('newBornBabyPassport.agreement');

    Route::post('newBornBabyPassport/search_by_civil', [NewBornBabyPassportController::class, 'search_by_civil'])->name('newBornBabyPassport.search_by_civil');
    Route::post('newBornBabyPassport/search_by_passport_number', [NewBornBabyPassportController::class, 'search_by_passport_number'])->name('newBornBabyPassport.search_by_passport_number');
    Route::post('newBornBabyPassport/search_by_profession', [NewBornBabyPassportController::class, 'search_by_profession'])->name('newBornBabyPassport.search_by_profession');


    //manual passport
    Route::resource('manualPassport', ManualPassportController::class);
    Route::get('manual-passport/create-second', [ManualPassportController::class, 'createSecond'])->name('manualPassport.createSecond');
    Route::post('manual-passport/store-second', [ManualPassportController::class, 'storeSecond'])->name('manualPassport.storeSecond');
    Route::get('manualPassport/receipt/{id}', [ManualPassportController::class, 'printReceipt'])->name('manualPassport.receipt');
    Route::get('manualPassport/sticker/{id}', [ManualPassportController::class, 'printSticker'])->name('manualPassport.sticker');
    Route::post('manualPassport/shiftToBranchManagerNow/{id}', [ManualPassportController::class, 'shiftToBranchManagerNow'])->name('manualPassport.shiftToBranchManagerNow');

    Route::post('manualPassport/search_by_civil', [ManualPassportController::class, 'search_by_civil'])->name('manualPassport.search_by_civil');
    Route::post('manualPassport/search_by_passport_number', [ManualPassportController::class, 'search_by_passport_number'])->name('manualPassport.search_by_passport_number');
    Route::post('manualPassport/search_by_profession', [ManualPassportController::class, 'search_by_profession'])->name('manualPassport.search_by_profession');

    // Renew to Manual
    Route::resource('renewManual', RenewManualPassportController::class);
    Route::get('manualPassport/add-manual-by-renew-id/{renew_id}', [ManualPassportController::class, 'addManualByRenewId'])->name('manualPassport.addManualByRenewId');

    // Renew Passport
    Route::resource('renewPassport', RenewPassportController::class);
    Route::get('renew-passport/create-second', [RenewPassportController::class, 'createSecond'])->name('renewPassport.createSecond');
    Route::post('renew-passport/store-second', [RenewPassportController::class, 'storeSecond'])->name('renewPassport.storeSecond');
    Route::get('renewPassport/receipt/{id}', [RenewPassportController::class, 'printReceipt'])->name('renewPassport.receipt');
    Route::get('renewPassport/sticker/{id}', [RenewPassportController::class, 'printSticker'])->name('renewPassport.sticker');
    Route::post('renewPassport/shiftToBranchManagerNow/{id}', [RenewPassportController::class, 'shiftToBranchManagerNow'])->name('renewPassport.shiftToBranchManagerNow');

    Route::post('renewPassport/search_by_civil', [RenewPassportController::class, 'search_by_civil'])->name('renewPassport.search_by_civil');
    Route::post('renewPassport/search_by_passport_number', [RenewPassportController::class, 'search_by_passport_number'])->name('renewPassport.search_by_passport_number');
    Route::post('renewPassport/search_by_profession', [RenewPassportController::class, 'search_by_profession'])->name('renewPassport.search_by_profession');

    // passport processing
    Route::get('passport-processing/received-from-branch-manager', [PassportProcessingController::class, 'receivedFromBranchManager'])->name('passportProcessing.receivedFromBranchManager');
    Route::get('passport-processing/received-from-branch-manager/{data}', [PassportProcessingController::class, 'searchReceive'])->name('passportProcessing.searchReceive');
    Route::post('passport-options/received-from-branch-manager/bio-enrollment-id/{id}', [PassportProcessingController::class, 'bioEnrollmentIdSave'])->name('passportProcessing.bioEnrollmentIdSave');


    // All Report
    Route::get('report', [ReportController::class, 'index'])->name('report.index');
    Route::get('report/{data}', [ReportController::class, 'show']);
    Route::get('get-report/{data}', [ReportController::class, 'getReport'])->name('allReport.excelExport');

    // All Other Services Report
    Route::get('get-other-services-report/{data}', [OtherServicesReportController::class, 'getReport'])->name('otherServicesReport.excelExport');



    /**
     * add on service
     */

    //extra add on service form passportdata controller
    Route::resource('addExtraService', ExtraServiceAddController::class);
    Route::get('services-add/{id}/{type}', [ExtraServiceAddController::class, 'addOnService'])->name('serviceAddOn');

    // other service
    Route::resource('otherService', OtherServiceController::class);
    Route::get('otherService/receipt/{id}', [OtherServiceController::class, 'printReceipt'])->name('otherService.receipt');
    Route::get('otherService/sticker/{id}', [OtherServiceController::class, 'printSticker'])->name('otherService.sticker');

    //premium service
    Route::resource('PremierService', PremierServiceController::class);

    //express service
    Route::resource('expressService', ExpressServiceController::class);

    //legal and complain service
    Route::resource('legalComplaintsService', LegalComplaintsServiceController::class);

    //govement service
    Route::resource('immigrationGovementService', ImmigrationGovementServiceController::class);
});
