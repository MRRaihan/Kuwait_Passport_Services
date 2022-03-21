<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DashboardReportController;
use App\Http\Controllers\Admin\BranchManagerController;
use App\Http\Controllers\Admin\CallCenterController;
use App\Http\Controllers\Admin\AccountManagerController;
use App\Http\Controllers\Admin\EmbassyController;
use App\Http\Controllers\Admin\LostPassportController;
use App\Http\Controllers\Admin\NewBornBabyPassportController;
use App\Http\Controllers\Admin\DataEntererController;
use App\Http\Controllers\Admin\ManualPassportController;
use App\Http\Controllers\Admin\RenewPassportController;
use App\Http\Controllers\Admin\OtherServices\OtherServiceController;
use App\Http\Controllers\Admin\PassportOptionsController;
use App\Http\Controllers\Admin\ProfessionController;
use App\Http\Controllers\Admin\BranchContoller;
use App\Http\Controllers\Admin\PassportFeeController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\AllPassportReportController;
use App\Http\Controllers\Admin\RenewManualPassportController;
use App\Http\Controllers\Admin\SalaryController;
use App\Http\Controllers\Admin\DeliveryController;
use App\Http\Controllers\Admin\ExtraServiceAddController;
use App\Http\Controllers\Admin\OtherServiceFeeController;
use App\Http\Controllers\Admin\ImportExportController;
use App\Http\Controllers\Admin\OtherServices\OtherServicesReportController;
use App\Http\Controllers\Admin\OtherServices\ExpressServiceController;
use App\Http\Controllers\Admin\OtherServices\ImmigrationGovementServiceController;
use App\Http\Controllers\Admin\OtherServices\PremierServiceController;
use App\Http\Controllers\Admin\OtherServices\LegalComplaintsServiceController;
use App\Http\Controllers\Admin\OtherServices\AllOtherServicesReportController;
use App\Http\Controllers\Admin\RecycleBinController;
use App\Http\Controllers\Admin\landingPage\FrontendSettingController;
use App\Http\Controllers\Admin\landingPage\LandingPagePricingController;
use App\Http\Controllers\Admin\landingPage\ServicesController;
use Illuminate\Support\Facades\Route;

// Admin route
Route::group(['prefix' => 'admin/', 'as' => 'admin.', 'middleware' => ['auth', 'admin','prevent-back-history']], function () {

    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::get('/lostPassport/report/{data}', [DashboardController::class, 'reportLostPassport']);
    Route::get('/manualPassport/report/{data}', [DashboardController::class, 'reportManualPassport']);
    Route::get('/renuePassport/report/{data}', [DashboardController::class, 'reportRenuePassport']);
    Route::get('/newBornPassport/report/{data}', [DashboardController::class, 'reportNewBornPassport']);
    Route::get('/premierPassport/report/{data}', [DashboardController::class, 'reportPremierService']);
    Route::get('/expressPassport/report/{data}', [DashboardController::class, 'reportExpressService']);
    Route::get('/legalComplaintsPassport/report/{data}', [DashboardController::class, 'reportLegalComplaintsService']);
    Route::get('/immigrationGovementService/report/{data}', [DashboardController::class, 'reportImmigrationGovementService']);
    Route::get('/other/report/{data}', [DashboardController::class, 'reportOtherService']);

    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    Route::get('/edit-profile', [DashboardController::class, 'editProfile'])->name('editProfile');
    Route::post('/update-profile', [DashboardController::class, 'updateProfile'])->name('updateProfile');

    //branch manager
    Route::resource('branchManager', BranchManagerController::class);
    Route::post('branchManager/active/{id}', [BranchManagerController::class, 'activeNow'])->name('branchManager.activeNow');
    Route::post('branchManager/inactive/{id}', [BranchManagerController::class, 'inactiveNow'])->name('branchManager.inactiveNow');

    //branch manager
    Route::resource('delivery', DeliveryController::class);
    Route::post('delivery/active/{id}', [DeliveryController::class, 'activeNow'])->name('delivery.activeNow');
    Route::post('delivery/inactive/{id}', [DeliveryController::class, 'inactiveNow'])->name('delivery.inactiveNow');

    // Dashboard Report
    Route::get('/branch-manager/view', [DashboardReportController::class, 'seeBranchData'])->name('seeBranchData');
    Route::get('/branch-manager/view/{id}', [DashboardReportController::class, 'seeDataEntryData'])->name('seeDataEntryData');
    Route::get('/data-entry/view/{id}', [DashboardReportController::class, 'seeDataEntryReport'])->name('seeDataEntryReport');

    //call-center
    Route::resource('callCenter', CallCenterController::class);
    Route::post('callCenter/active/{id}', [CallCenterController::class, 'activeNow'])->name('callCenter.activeNow');
    Route::post('callCenter/inactive/{id}', [CallCenterController::class, 'inactiveNow'])->name('callCenter.inactiveNow');

    //account-manager
    Route::resource('accountManager', AccountManagerController::class);
    Route::post('accountManager/active/{id}', [AccountManagerController::class, 'activeNow'])->name('accountManager.activeNow');
    Route::post('accountManager/inactive/{id}', [AccountManagerController::class, 'inactiveNow'])->name('accountManager.inactiveNow');

    //embassy
    Route::resource('embassy', EmbassyController::class);
    Route::post('embassy/active/{id}', [EmbassyController::class, 'activeNow'])->name('embassy.activeNow');
    Route::post('embassy/inactive/{id}', [EmbassyController::class, 'inactiveNow'])->name('embassy.inactiveNow');

    //lost Passport
    Route::resource('lostPassport', LostPassportController::class);
    Route::get('lost-passport/create-second', [LostPassportController::class, 'createSecond'])->name('lostPassport.createSecond');
    Route::post('lost-passport/store-second', [LostPassportController::class, 'storeSecond'])->name('lostPassport.storeSecond');
    Route::get('lostPassport/receipt/{id}', [LostPassportController::class, 'printReceipt'])->name('lostPassport.receipt');
    Route::get('lostPassport/sticker/{id}', [LostPassportController::class, 'printSticker'])->name('lostPassport.sticker');
    Route::post('lostPassport/restore/{id}', [LostPassportController::class, 'restore'])->name('lostPassport.restore');
    Route::post('lostPassport/permanentDelete/{id}', [LostPassportController::class, 'permanentDelete'])->name('lostPassport.permanentDelete');
    Route::get('lostPassport/agreement/{id}', [LostPassportController::class, 'agreement'])->name('lostPassport.agreement');

    Route::post('lostPassport/search_by_civil', [LostPassportController::class, 'search_by_civil'])->name('lostPassport.search_by_civil');
    Route::post('lostPassport/search_by_passport_number', [LostPassportController::class, 'search_by_passport_number'])->name('lostPassport.search_by_passport_number');
    Route::post('lostPassport/search_by_new_mrp_passport_no', [LostPassportController::class, 'search_by_new_mrp_passport_no'])->name('lostPassport.search_by_new_mrp_passport_no');
    Route::post('lostPassport/search_by_bio_enrollment_id', [LostPassportController::class, 'search_by_bio_enrollment_id'])->name('lostPassport.search_by_bio_enrollment_id');;

    // New Born Baby Passport
    Route::resource('newBornBabyPassport', NewBornBabyPassportController::class);
    Route::get('new-born-baby-passport/create-second', [NewBornBabyPassportController::class, 'createSecond'])->name('newBornBabyPassport.createSecond');
    Route::post('new-born-baby-passport/store-second', [NewBornBabyPassportController::class, 'storeSecond'])->name('newBornBabyPassport.storeSecond');
    Route::get('newBornBabyPassport/receipt/{id}', [NewBornBabyPassportController::class, 'printReceipt'])->name('newBornBabyPassport.receipt');
    Route::get('newBornBabyPassport/sticker/{id}', [NewBornBabyPassportController::class, 'printSticker'])->name('newBornBabyPassport.sticker');
    Route::post('newBornBabyPassport/restore/{id}', [NewBornBabyPassportController::class, 'restore'])->name('newBornBabyPassport.restore');
    Route::post('newBornBabyPassport/permanentDelete/{id}', [NewBornBabyPassportController::class, 'permanentDelete'])->name('newBornBabyPassport.permanentDelete');
    Route::get('newBornBabyPassport/agreement/{id}', [NewBornBabyPassportController::class, 'agreement'])->name('newBornBabyPassport.agreement');

    Route::post('newBornBabyPassport/search_by_civil', [NewBornBabyPassportController::class, 'search_by_civil'])->name('newBornBabyPassport.search_by_civil');
    Route::post('newBornBabyPassport/search_by_passport_number', [NewBornBabyPassportController::class, 'search_by_passport_number'])->name('newBornBabyPassport.search_by_passport_number');
    Route::post('newBornBabyPassport/search_by_new_mrp_passport_no', [NewBornBabyPassportController::class, 'search_by_new_mrp_passport_no'])->name('newBornBabyPassport.search_by_new_mrp_passport_no');
    Route::post('newBornBabyPassport/search_by_bio_enrollment_id', [NewBornBabyPassportController::class, 'search_by_bio_enrollment_id'])->name('newBornBabyPassport.search_by_bio_enrollment_id');

    // manual passport
    Route::resource('manualPassport', ManualPassportController::class);
    Route::get('manual-passport/create-second', [ManualPassportController::class, 'createSecond'])->name('manualPassport.createSecond');
    Route::post('manual-passport/store-second', [ManualPassportController::class, 'storeSecond'])->name('manualPassport.storeSecond');
    Route::get('manualPassport/receipt/{id}', [ManualPassportController::class, 'printReceipt'])->name('manualPassport.receipt');
    Route::get('manualPassport/sticker/{id}', [ManualPassportController::class, 'printSticker'])->name('manualPassport.sticker');
    Route::post('manualPassport/restore/{id}', [ManualPassportController::class, 'restore'])->name('manualPassport.restore');
    Route::post('manualPassport/permanentDelete/{id}', [ManualPassportController::class, 'permanentDelete'])->name('manualPassport.permanentDelete');

    Route::post('manualPassport/search_by_civil', [ManualPassportController::class, 'search_by_civil'])->name('manualPassport.search_by_civil');
    Route::post('manualPassport/search_by_passport_number', [ManualPassportController::class, 'search_by_passport_number'])->name('manualPassport.search_by_passport_number');
    Route::post('manualPassport/search_by_new_mrp_passport_no', [ManualPassportController::class, 'search_by_new_mrp_passport_no'])->name('manualPassport.search_by_new_mrp_passport_no');
    Route::post('manualPassport/search_by_bio_enrollment_id', [ManualPassportController::class, 'search_by_bio_enrollment_id'])->name('manualPassport.search_by_bio_enrollment_id');



    // renew Manual
    Route::resource('renewManual', RenewManualPassportController::class);
    Route::get('manualPassport/add-manual-by-renew-id/{renew_id}', [ManualPassportController::class, 'addManualByRenewId'])->name('manualPassport.addManualByRenewId');


    //renew passport
    Route::resource('renewPassport', RenewPassportController::class);
    Route::get('renew-passport/create-second', [RenewPassportController::class, 'createSecond'])->name('renewPassport.createSecond');
    Route::post('renew-passport/store-second', [RenewPassportController::class, 'storeSecond'])->name('renewPassport.storeSecond');
    Route::get('renewPassport/receipt/{id}', [RenewPassportController::class, 'printReceipt'])->name('renewPassport.receipt');
    Route::get('renewPassport/sticker/{id}', [RenewPassportController::class, 'printSticker'])->name('renewPassport.sticker');
    Route::post('renewPassport/restore/{id}', [RenewPassportController::class, 'restore'])->name('renewPassport.restore');
    Route::post('renewPassport/permanentDelete/{id}', [RenewPassportController::class, 'permanentDelete'])->name('renewPassport.permanentDelete');

    Route::post('renewPassport/search_by_civil', [RenewPassportController::class, 'search_by_civil'])->name('renewPassport.search_by_civil');
    Route::post('renewPassport/search_by_passport_number', [RenewPassportController::class, 'search_by_passport_number'])->name('renewPassport.search_by_passport_number');
    Route::post('renewPassport/search_by_new_mrp_passport_no', [RenewPassportController::class, 'search_by_new_mrp_passport_no'])->name('renewPassport.search_by_new_mrp_passport_no');
    Route::post('renewPassport/search_by_bio_enrollment_id', [RenewPassportController::class, 'search_by_bio_enrollment_id'])->name('renewPassport.search_by_bio_enrollment_id');

    //Recycle Bin
    Route::group(['prefix' => 'recycle-bin/', 'as' => 'recycleBin.'], function () {
        Route::group(['prefix' => 'passport/', 'as' => 'passport.'], function () {
            Route::get('renew', [RecycleBinController::class, 'renew'])->name('renew');
            Route::get('manual', [RecycleBinController::class, 'manual'])->name('manual');
            Route::get('lost', [RecycleBinController::class, 'lost'])->name('lost');
            Route::get('new-born-baby', [RecycleBinController::class, 'newBornBaby'])->name('newBornBaby');
        });
        Route::group(['prefix' => 'other/', 'as' => 'other.'], function () {
            Route::get('premier', [RecycleBinController::class, 'premier'])->name('premier');
            Route::get('express', [RecycleBinController::class, 'express'])->name('express');
            Route::get('legal-complaints', [RecycleBinController::class, 'legalComplaints'])->name('legalComplaints');
            Route::get('immigration-govt', [RecycleBinController::class, 'immigrationGovt'])->name('immigrationGovt');
            Route::get('other', [RecycleBinController::class, 'other'])->name('other');

            // permanent delete & restore
            Route::post('restore/{data}', [RecycleBinController::class, 'otherServiceRestore'])->name('otherServiceRestore');
            Route::post('permanent-delete/{data}', [RecycleBinController::class, 'otherServicePermanentDelete'])->name('otherServicePermanentDelete');
        });
    });

    //passport option shift to embassy

    Route::get('passport-options/shift-to-embassy', [PassportOptionsController::class, 'shiftToEmbassy'])->name('passportOption.shiftToEmbassy');
    Route::post('passport-options/shift-to-embassy/store', [PassportOptionsController::class, 'shiftToEmbassyStore'])->name('passportOption.shiftToEmbassy.store');
    Route::get('passport-options/shift-to-embassy/{data}', [PassportOptionsController::class, 'search']);
    Route::post('passport-options/shift-to-embassy/undo/{option}', [PassportOptionsController::class, 'shiftToEmbassyUndo'])->name('passportOption.shiftToEmbassy.undo');


    //passport option receive from embassy

    Route::get('passport-options/receive-from-embassy', [PassportOptionsController::class, 'receiveFromEmbassy'])->name('passportOption.receiveFromEmbassy');
    Route::post('passport-options/receive-from-embassy/store', [PassportOptionsController::class, 'receiveFromEmbassyStore'])->name('passportOption.receiveFromEmbassy.store');

    Route::post('passport-options/shift-to-branch/store', [PassportOptionsController::class, 'shfitToBranchStore'])->name('passportOption.shfitToBranchStore');

    Route::get('passport-options/receive-from-embassy/{data}', [PassportOptionsController::class, 'searchReceive']);
    Route::post('passport-options/receive-from-embassy/undo/{option}', [PassportOptionsController::class, 'receiveFromEmbassyUndo'])->name('passportOption.receiveFromEmbassy.undo');
    Route::post('passport-options/receive-from-embassy/bio-enrollment-id/{id}', [PassportOptionsController::class, 'bioEnrollmentIdSave'])->name('passportOption.receiveFromEmbassy.bioEnrollmentId');
    Route::post('passport-options/receive-from-embassy/new-mrp-passport-no/{id}', [PassportOptionsController::class, 'newMrpPassportNoSave'])->name('passportOption.receiveFromEmbassy.newMrpPassportNo');

    // call center status
    Route::get('passport-options/call-center-status/', [PassportOptionsController::class, 'callCenterStatus'])->name('passportOption.callCenterStatus');
    Route::get('passport-options/call-center-status/{data}', [PassportOptionsController::class, 'searchCallCenterStatus'])->name('passportOption.searchCallCenterStatus');

    // all delivery from branch
    Route::get('passport-options/delivery-from-branch/', [PassportOptionsController::class, 'allDeliveryFromBranch'])->name('passportOption.allDeliveryFromBranch');
    Route::get('passport-options/delivery-from-branch/{data}', [PassportOptionsController::class, 'searchAllDeliveryFromBranch'])->name('passportOption.searchAllDeliveryFromBranch');



    //passport option Delivery
    Route::get('passport-options/delivery', [PassportOptionsController::class, 'delivery'])->name('passportOption.delivery');
    Route::post('passport-options/delivery/store', [PassportOptionsController::class, 'deliveryStore'])->name('passportOption.delivery.store');
    Route::get('passport-options/delivery/{data}', [PassportOptionsController::class, 'searchDelivery']);
    Route::post('passport-options/delivery/undo/{option}', [PassportOptionsController::class, 'deliveryUndo'])->name('passportOption.delivery.undo');
    Route::post('passport-options/delivery/remarks/{id}', [PassportOptionsController::class, 'remarksSave'])->name('passportOption.delivery.remarks');



    //profession
    Route::resource('profession', ProfessionController::class);
    Route::post('profession/active/{id}', [ProfessionController::class, 'activeNow'])->name('profession.activeNow');
    Route::post('profession/inactive/{id}', [ProfessionController::class, 'inactiveNow'])->name('profession.inactiveNow');

    //profession
    Route::resource('passportFee', PassportFeeController::class);

    //BranchContoller
    Route::resource('branch', BranchContoller::class);
    Route::post('branch/active/{id}', [BranchContoller::class, 'activeNow'])->name('branch.activeNow');
    Route::post('branch/inactive/{id}', [BranchContoller::class, 'inactiveNow'])->name('branch.inactiveNow');



    //Salary Controller to manual
    Route::resource('salary', SalaryController::class);

    // data-enterer
    Route::resource('dataEnterer', DataEntererController::class);
    Route::post('dataEnterer/active/{id}', [DataEntererController::class, 'activeNow'])->name('dataEnterer.activeNow');
    Route::post('dataEnterer/inactive/{id}', [DataEntererController::class, 'inactiveNow'])->name('dataEnterer.inactiveNow');
    Route::post('dataEnterer/entry/active/{id}', [DataEntererController::class, 'entryActiveNow'])->name('dataEnterer.entryActiveNow');
    Route::post('dataEnterer/entry/inactive/{id}', [DataEntererController::class, 'entryInactiveNow'])->name('dataEnterer.entryInactiveNow');


    // All Report Route
    Route::get('report', [ReportController::class, 'index'])->name('report.index');
    Route::get('report/{data}', [ReportController::class, 'show']);
    Route::get('get-report/{data}', [ReportController::class, 'getReport']);
    Route::get('report-excel-export/{data}', [ReportController::class, 'excelExport'])->name('report.excelExport');

    Route::get('other-services-report/{data}', [OtherServicesReportController::class, 'getReport'])->name('otherReport.excelExport');


    // all passport report
    Route::get('all-passport-report', [AllPassportReportController::class, 'index'])->name('allPassportReport');
    Route::get('all-passport-report/{data}', [AllPassportReportController::class, 'show']);
    Route::get('get-all-passport-report/{data}', [AllPassportReportController::class, 'getReport']);
    Route::get('all-passport-report-excel-export/{data}', [AllPassportReportController::class, 'excelExport'])->name('allPassportReport.excelExport');

    // all other services report
    Route::get('all-other-services-report', [AllOtherServicesReportController::class, 'index'])->name('allOtherServicesReport.index');
    Route::get('all-other-services-report/{data}', [AllOtherServicesReportController::class, 'show'])->name('allOtherServicesReport.show');


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



    /**
     * add on service
     */
    //extra add on service service form passportdata
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

    //other service fee add
    Route::resource('otherServiceFee', OtherServiceFeeController::class);


    /**
     * import export
     */

    Route::get('import-export', [ImportExportController::class, 'index'])->name('importExport');
    //lost passport
    Route::get('lost-passport-download', [ImportExportController::class, 'lostPassportExport'])->name('lostPassportExportDownlode');
    Route::post('lost-passport-import', [ImportExportController::class, 'lostPassportImport'])->name('lostPassportImport');

    //manual passport
    Route::get('manaul-passport-download', [ImportExportController::class, 'ManualPassportExport'])->name('ManualPassportExportDownlode');
    Route::post('manual-passport-import', [ImportExportController::class, 'ManualPassportImport'])->name('ManualPassportImport');

    //renew passport
    Route::get('renew-passport-download', [ImportExportController::class, 'RenewPassportExport'])->name('RenewPassportExportDownlode');
    Route::post('renew-passport-import', [ImportExportController::class, 'RenewPassportImport'])->name('RenewPassportImport');

    //baby passport
    Route::get('baby-passport-download', [ImportExportController::class, 'BabyPassportExport'])->name('babyPassportExportDownlode');
    Route::post('baby-passport-import', [ImportExportController::class, 'BabyPassportImport'])->name('babyPassportImport');

    //other service export
    Route::get('other-service-download', [ImportExportController::class, 'OtherServiceExport'])->name('OtherServiceExportDownlode');
    Route::post('other-service-import', [ImportExportController::class, 'OtherServiceImport'])->name('OtherServiceImport');

    /**
     * frontend setiing
     */

    //banner footer
    Route::get('banner-edit', [FrontendSettingController::class, 'BannerFooter'])->name('bannerEdit');
    Route::post('banner-edit', [FrontendSettingController::class, 'BannerFooterUpdate'])->name('bannerUpdate');

    //pricing plan
    Route::resource('pricingPlan', LandingPagePricingController::class);

    //Services
    Route::resource('pageServices', ServicesController::class);
});
