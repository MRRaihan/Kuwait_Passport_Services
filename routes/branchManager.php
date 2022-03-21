<?php


use App\Http\Controllers\BranchManager\DashboardController;
use App\Http\Controllers\BranchManager\DataEntererController;
use App\Http\Controllers\BranchManager\LostPassportController;
use App\Http\Controllers\BranchManager\NewBornBabyPassportController;
use App\Http\Controllers\BranchManager\ManualPassportController;
use App\Http\Controllers\BranchManager\OtherServices\OtherServiceController;
use App\Http\Controllers\BranchManager\RenewPassportController;
use App\Http\Controllers\BranchManager\RenewManualPassportController;
use App\Http\Controllers\BranchManager\ReportController;
use App\Http\Controllers\BranchManager\PassportOptionsController;
use App\Http\Controllers\BranchManager\AllPassportReportController;
use App\Http\Controllers\BranchManager\ExtraServiceAddController;
use App\Http\Controllers\BranchManager\OtherServices\ExpressServiceController;
use App\Http\Controllers\BranchManager\OtherServices\ImmigrationGovementServiceController;
use App\Http\Controllers\BranchManager\OtherServices\PremierServiceController;
use App\Http\Controllers\BranchManager\OtherServices\LegalComplaintsServiceController;
use App\Http\Controllers\BranchManager\OtherServices\AllOtherServicesReportController;


use Illuminate\Support\Facades\Route;

// manager Admin route
Route::group(['prefix' => 'branch-manager/', 'as' => 'branchManager.', 'middleware' => ['auth', 'branchManager','prevent-back-history']], function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');


    Route::get('/lostPassport/report/{data}', [DashboardController::class, 'reportLostPassport']);
    Route::get('/manualPassport/report/{data}', [DashboardController::class, 'reportManualPassport']);
    Route::get('/renuePassport/report/{data}', [DashboardController::class, 'reportRenuePassport']);
    Route::get('/newBornBabyPassport/report/{data}', [DashboardController::class, 'reportNewBornBabyPassport']);

    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    Route::get('/edit-profile', [DashboardController::class, 'editProfile'])->name('editProfile');
    Route::post('/update-profile', [DashboardController::class, 'updateProfile'])->name('updateProfile');

    Route::resource('dataEnterer', DataEntererController::class);
    Route::post('dataentry/active/{id}', [DataEntererController::class, 'activeEntryNow'])->name('dataentry.activeEntryNow');
    Route::post('dataentry/inactive/{id}', [DataEntererController::class, 'inactiveEntryNow'])->name('dataentry.inactiveEntryNow');



    //lost Passport
    Route::resource('lostPassport', LostPassportController::class);
    Route::get('lost-passport/create-second', [LostPassportController::class, 'createSecond'])->name('lostPassport.createSecond');
    Route::post('lost-passport/store-second', [LostPassportController::class, 'storeSecond'])->name('lostPassport.storeSecond');
    Route::get('lostPassport/receipt/{id}', [LostPassportController::class, 'printReceipt'])->name('lostPassport.receipt');
    Route::get('lostPassport/sticker/{id}', [LostPassportController::class, 'printSticker'])->name('lostPassport.sticker');
    Route::get('lostPassport/agreement/{id}', [LostPassportController::class, 'agreement'])->name('lostPassport.agreement');
    Route::post('lostPassport/dismissComplain/{id}', [LostPassportController::class, 'dismissComplain'])->name('lostPassport.dismissComplain');

    Route::post('lostPassport/search_by_civil', [LostPassportController::class, 'search_by_civil'])->name('lostPassport.search_by_civil');
    Route::post('lostPassport/search_by_passport_number', [LostPassportController::class, 'search_by_passport_number'])->name('lostPassport.search_by_passport_number');
    Route::post('lostPassport/search_by_new_mrp_passport_no', [LostPassportController::class, 'search_by_new_mrp_passport_no'])->name('lostPassport.search_by_new_mrp_passport_no');
    Route::post('lostPassport/search_by_bio_enrollment_id', [LostPassportController::class, 'search_by_bio_enrollment_id'])->name('lostPassport.search_by_bio_enrollment_id');

    // Lost Passport By User
    Route::get('user-lost-passport', [LostPassportController::class, 'userLostPassportIndex'])->name('userLostPassport.index');

    Route::get('user-lost-passport-review/{id}', [LostPassportController::class, 'userLostPassportReview'])->name('userLostPassport.review');



    // New Born Baby Passport
    Route::resource('newBornBabyPassport', NewBornBabyPassportController::class);
    Route::get('new-born-baby-passport/create-second', [NewBornBabyPassportController::class, 'createSecond'])->name('newBornBabyPassport.createSecond');
    Route::post('new-born-baby-passport/store-second', [NewBornBabyPassportController::class, 'storeSecond'])->name('newBornBabyPassport.storeSecond');
    Route::get('newBornBabyPassport/receipt/{id}', [NewBornBabyPassportController::class, 'printReceipt'])->name('newBornBabyPassport.receipt');
    Route::get('newBornBabyPassport/sticker/{id}', [NewBornBabyPassportController::class, 'printSticker'])->name('newBornBabyPassport.sticker');
    Route::post('newBornBabyPassport/dismissComplain/{id}', [NewBornBabyPassportController::class, 'dismissComplain'])->name('newBornBabyPassport.dismissComplain');
    Route::get('newBornBabyPassport/agreement/{id}', [NewBornBabyPassportController::class, 'agreement'])->name('newBornBabyPassport.agreement');

    Route::post('newBornBabyPassport/search_by_civil', [NewBornBabyPassportController::class, 'search_by_civil'])->name('newBornBabyPassport.search_by_civil');
    Route::post('newBornBabyPassport/search_by_passport_number', [NewBornBabyPassportController::class, 'search_by_passport_number'])->name('newBornBabyPassport.search_by_passport_number');
    Route::post('newBornBabyPassport/search_by_new_mrp_passport_no', [NewBornBabyPassportController::class, 'search_by_new_mrp_passport_no'])->name('newBornBabyPassport.search_by_new_mrp_passport_no');
    Route::post('newBornBabyPassport/search_by_bio_enrollment_id', [NewBornBabyPassportController::class, 'search_by_bio_enrollment_id'])->name('newBornBabyPassport.search_by_bio_enrollment_id');

    // New born baby passport by user
    Route::get('user-new-born-baby-passport', [NewBornBabyPassportController::class, 'userNewBornBabyPassportIndex'])->name('userNewBornBabyPassport.index');

    Route::get('user-new-born-baby-passport-review/{id}', [NewBornBabyPassportController::class, 'userNewBornBabyPassportReview'])->name('userNewBornBabyPassport.review');

    //manual passport
    Route::resource('manualPassport', ManualPassportController::class);
    Route::get('manual-passport/create-second', [ManualPassportController::class, 'createSecond'])->name('manualPassport.createSecond');
    Route::post('manual-passport/store-second', [ManualPassportController::class, 'storeSecond'])->name('manualPassport.storeSecond');
    Route::get('manualPassport/receipt/{id}', [ManualPassportController::class, 'printReceipt'])->name('manualPassport.receipt');
    Route::get('manualPassport/sticker/{id}', [ManualPassportController::class, 'printSticker'])->name('manualPassport.sticker');
    Route::post('manualPassport/dismissComplain/{id}', [ManualPassportController::class, 'dismissComplain'])->name('manualPassport.dismissComplain');

    Route::post('manualPassport/search_by_civil', [ManualPassportController::class, 'search_by_civil'])->name('manualPassport.search_by_civil');
    Route::post('manualPassport/search_by_passport_number', [ManualPassportController::class, 'search_by_passport_number'])->name('manualPassport.search_by_passport_number');
    Route::post('manualPassport/search_by_new_mrp_passport_no', [ManualPassportController::class, 'search_by_new_mrp_passport_no'])->name('manualPassport.search_by_new_mrp_passport_no');
    Route::post('manualPassport/search_by_bio_enrollment_id', [ManualPassportController::class, 'search_by_bio_enrollment_id'])->name('manualPassport.search_by_bio_enrollment_id');

    // Manual Passport By User
    Route::get('user-manual-passport', [ManualPassportController::class, 'userManualPassportIndex'])->name('userManualPassport.index');
    Route::get('user-manual-passport-review/{id}', [ManualPassportController::class, 'userManualPassportReview'])->name('userManualPassport.review');

    //renew passport
    Route::resource('renewPassport', RenewPassportController::class);
    Route::get('renew-passport/create-second', [RenewPassportController::class, 'createSecond'])->name('renewPassport.createSecond');
    Route::post('renew-passport/store-second', [RenewPassportController::class, 'storeSecond'])->name('renewPassport.storeSecond');
    Route::get('renewPassport/receipt/{id}', [RenewPassportController::class, 'printReceipt'])->name('renewPassport.receipt');
    Route::get('renewPassport/sticker/{id}', [RenewPassportController::class, 'printSticker'])->name('renewPassport.sticker');
    Route::post('renewPassport/dismissComplain/{id}', [RenewPassportController::class, 'dismissComplain'])->name('renewPassport.dismissComplain');

    Route::post('renewPassport/search_by_civil', [RenewPassportController::class, 'search_by_civil'])->name('renewPassport.search_by_civil');
    Route::post('renewPassport/search_by_passport_number', [RenewPassportController::class, 'search_by_passport_number'])->name('renewPassport.search_by_passport_number');
    Route::post('renewPassport/search_by_new_mrp_passport_no', [RenewPassportController::class, 'search_by_new_mrp_passport_no'])->name('renewPassport.search_by_new_mrp_passport_no');
    Route::post('renewPassport/search_by_bio_enrollment_id', [RenewPassportController::class, 'search_by_bio_enrollment_id'])->name('renewPassport.search_by_bio_enrollment_id');

    // Renew Passport By User
    Route::get('user-renew-passport', [RenewPassportController::class, 'userRenewPassportIndex'])->name('userRenewPassport.index');
    Route::get('user-renew-passport-review/{id}', [RenewPassportController::class, 'userRenewPassportReview'])->name('userRenewPassport.review');


    // renew Manual
    Route::resource('renewManual', RenewManualPassportController::class);
    Route::get('manualPassport/add-manual-by-renew-id/{renew_id}', [ManualPassportController::class, 'addManualByRenewId'])->name('manualPassport.addManualByRenewId');

    //passport option shift to Admin

    Route::get('passport-options/shift-to-admin', [PassportOptionsController::class, 'shiftToAdmin'])->name('passportOption.shiftToAdmin');
    Route::post('passport-options/shift-to-admin/store', [PassportOptionsController::class, 'shiftToAdminStore'])->name('passportOption.shiftToAdmin.store');
    Route::get('passport-options/shift-to-admin/{data}', [PassportOptionsController::class, 'search']);

    Route::post('passport-options/shift-to-admin/undo/{option}', [PassportOptionsController::class, 'shiftToAdminUndo'])->name('passportOption.shiftToAdmin.undo');

    //passport option receive from embassy

    Route::get('passport-options/receive-from-admin', [PassportOptionsController::class, 'receiveFromAdmin'])->name('passportOption.receiveFromAdmin');
    Route::post('passport-options/receive-from-admin/store', [PassportOptionsController::class, 'receiveFromAdminStore'])->name('passportOption.receiveFromAdmin.store');
    Route::post('passport-options/delivery-to-user/store', [PassportOptionsController::class, 'deliveryToUser'])->name('passportOption.deliveryToUser.store');
    Route::post('passport-options/assign-de-for-bio', [PassportOptionsController::class, 'assignDeForBio'])->name('passportOption.assignDeForBio');
    Route::get('passport-options/receive-from-embassy/{data}', [PassportOptionsController::class, 'searchReceive']);
    Route::post('passport-options/receive-from-admin/undo/{option}', [PassportOptionsController::class, 'receiveFromAdminUndo'])->name('passportOption.receiveFromAdmin.undo');

    Route::post('passport-options/receive-from-embassy/bio-enrollment-id/{id}', [PassportOptionsController::class, 'bioEnrollmentIdSave'])->name('passportOption.receiveFromAdmin.bioEnrollmentId');
    Route::post('passport-options/receive-from-embassy/new-mrp-passport-no/{id}', [PassportOptionsController::class,'newMrpPassportNoSave'])->name('passportOption.receiveFromAdmin.newMrpPassportNo');


    //passport option Delivery
    Route::get('passport-options/delivery', [PassportOptionsController::class, 'delivery'])->name('passportOption.delivery');
    Route::post('passport-options/delivery/store', [PassportOptionsController::class, 'deliveryStore'])->name('passportOption.delivery.store');
    Route::get('passport-options/delivery/{data}', [PassportOptionsController::class, 'searchDelivery']);
    Route::post('passport-options/delivery/undo/{option}', [PassportOptionsController::class, 'deliveryUndo'])->name('passportOption.delivery.undo');
    Route::post('passport-options/delivery/remarks/{id}', [PassportOptionsController::class, 'remarksSave'])->name('passportOption.delivery.remarks');

    // All Report

    Route::get('report', [ReportController::class, 'index'])->name('report.index');
    Route::get('report/{data}', [ReportController::class, 'show']);
    Route::get('get-report/{data}', [ReportController::class, 'getReport'])->name('report.excelExport');

    // All Passport Report
    Route::get('all-passport-report', [AllPassportReportController::class, 'index'])->name('allPassportReport.index');
    Route::get('all-passport-report/{data}', [AllPassportReportController::class, 'show']);

    Route::get('get-all-passport-report/{data}', [AllPassportReportController::class, 'getReport'])->name('allPassportReport.excelExport');



    // All Other Services Report
    Route::get('get-other-services-report/{data}', [AllOtherServicesReportController::class, 'getReport'])->name('otherServicesReport.excelExport');
    Route::get('all-other-services-report', [AllOtherServicesReportController::class, 'index'])->name('allOtherServicesReport.index');


    // shift to admin report
    Route::get('shift-to-admin-report', [ReportController::class, 'shiftReport'])->name('shiftToAdminReport.index');
    Route::get('shift-to-admin-report/{data}', [ReportController::class, 'getShiftReport'])->name('shiftToAdminReport.excelExport');
    // receive from admin report
    Route::get('receive-from-admin-report', [ReportController::class, 'receiveReport'])->name('receiveFromAdminReport.index');
    Route::get('receive-from-admin-report/{data}', [ReportController::class, 'getReceiveReport'])->name('receiveFromAdminReport.excelExport');
    // delivery report
    Route::get('delivery-report', [ReportController::class, 'deliveryReport'])->name('deliveryreport.index');
    Route::get('delivery-report/{data}', [ReportController::class, 'getDeliveryReport'])->name('deliveryToUserReport.excelExport');


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
