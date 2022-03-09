<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;
use App\Models\Branch;
use App\Models\ManualPassport;
use App\Models\PassportFee;
use App\Models\Profession;
use App\Models\Salary;
use App\Models\User;
use App\Models\LostPassport;
use App\Models\Other;
use App\Models\RenewPassport;
use Carbon\Carbon;
use App\Models\PremierService;
use App\Models\ExpressService;
use App\Models\LegalComplaintsService;
use App\Models\ImmigrationGovementService;
use App\Models\NewBornBabyPassport;

class DashboardReportController extends Controller
{

  public function seeBranchData()
  {
    $branchManagers = User::orderBy('id', 'DESC')->where('user_type', 'branch-manager')->get();
    return view('Admin.branchManager.data', compact('branchManagers'));
  }
  public function seeDataEntryData($id)
  {
    $user = User::where('id', $id)->first();

    $data['dataEntriers'] = User::where('created_by', $user->id)->get();


    // Total Lost/Manual/Other/Renue count / Other Service
    $data['totalLostPassport'] = LostPassport::where('branch_id', $user->branch_id)->count();
    $data['totalManualPassport'] = ManualPassport::where('branch_id', $user->branch_id)->count();
    $data['totalNewBornBaby'] = NewBornBabyPassport::where('branch_id', $user->branch_id)->count();
    $data['totalRenewPassport'] = RenewPassport::where('branch_id', $user->branch_id)->count();

    $data['totalPremierService'] = PremierService::where('branch_id', $user->branch_id)->count();
    $data['totalExpressService'] = ExpressService::where('branch_id', $user->branch_id)->count();
    $data['totalLegalComplaintsService'] = LegalComplaintsService::where('branch_id', $user->branch_id)->count();
    $data['totalImmigrationGovementService'] = ImmigrationGovementService::where('branch_id', $user->branch_id)->count();
    $data['totalOther'] = Other::where('branch_id', $user->branch_id)->count();


    //All Passport count
    $data['totalPassport'] = $data['totalLostPassport'] + $data['totalManualPassport'] + $data['totalNewBornBaby'] + $data['totalRenewPassport'];
    //All Other Service count
    $data['totalOtherService'] = $data['totalPremierService'] + $data['totalExpressService'] + $data['totalLegalComplaintsService'] + $data['totalImmigrationGovementService'] + $data['totalOther'];


    // Daily Passport(Lost/Manual/Other/Renue) count
    $data['dailyLostPassport'] = LostPassport::where('branch_id', $user->branch_id)->whereDate('created_at', Carbon::today())->count();

    $data['dailyManualPassport'] = ManualPassport::where('branch_id', $user->branch_id)->whereDate('created_at', Carbon::today())->count();

    $data['dailyNewBornPassport'] = NewBornBabyPassport::where('branch_id', $user->branch_id)->whereDate('created_at', Carbon::today())->count();

    $data['dailyRenewPassport'] = RenewPassport::where('branch_id', $user->branch_id)->whereDate('created_at', Carbon::today())->count();

    $data['dailyPremierService'] = PremierService::where('branch_id', $user->branch_id)->whereDate('created_at', Carbon::today())->count();
    $data['dailyExpressService'] = ExpressService::where('branch_id', $user->branch_id)->whereDate('created_at', Carbon::today())->count();
    $data['dailyLegalComplaintsService'] = LegalComplaintsService::where('branch_id', $user->branch_id)->whereDate('created_at', Carbon::today())->count();
    $data['dailyImmigrationGovementService'] = ImmigrationGovementService::where('branch_id', $user->branch_id)->whereDate('created_at', Carbon::today())->count();
    $data['dailyOther'] = Other::where('branch_id', $user->branch_id)->whereDate('created_at', Carbon::today())->count();


    // Monthly Passport(Lost/Manual/Other/Renue) count
    $data['monthlyLostPassport'] = LostPassport::where('branch_id', $user->branch_id)->where('created_at', '>', Carbon::now()->startOfMonth())->where('created_at', '<', Carbon::now()->endOfMonth())->count();
    $data['monthlyManualPassport'] = ManualPassport::where('branch_id', $user->branch_id)->where('created_at', '>', Carbon::now()->startOfMonth())->where('created_at', '<', Carbon::now()->endOfMonth())->count();
    $data['monthlyNewBornBaby'] = NewBornBabyPassport::where('branch_id', $user->branch_id)->where('created_at', '>', Carbon::now()->startOfMonth())
      ->where('created_at', '<', Carbon::now()->endOfMonth())
      ->count();
    $data['monthlyRenewPassport'] = RenewPassport::where('branch_id', $user->branch_id)->where('created_at', '>', Carbon::now()->startOfMonth())->where('created_at', '<', Carbon::now()->endOfMonth())->count();
    $data['monthlyPremierService'] = PremierService::where('branch_id', $user->branch_id)->where('created_at', '>', Carbon::now()->startOfMonth())->where('created_at', '<', Carbon::now()->endOfMonth())->count();
    $data['monthlyExpressService'] = ExpressService::where('branch_id', $user->branch_id)->where('created_at', '>', Carbon::now()->startOfMonth())->where('created_at', '<', Carbon::now()->endOfMonth())->count();
    $data['monthlyLegalComplaintsService'] = LegalComplaintsService::where('branch_id', $user->branch_id)->where('created_at', '>', Carbon::now()->startOfMonth())->where('created_at', '<', Carbon::now()->endOfMonth())->count();
    $data['monthlyImmigrationGovementService'] = ImmigrationGovementService::where('branch_id', $user->branch_id)->where('created_at', '>', Carbon::now()->startOfMonth())->where('created_at', '<', Carbon::now()->endOfMonth())->count();
    $data['monthlyOther'] = Other::where('branch_id', $user->branch_id)->where('created_at', '>', Carbon::now()->startOfMonth())->where('created_at', '<', Carbon::now()->endOfMonth())->count();


    // Lost Passport Total Fee
    $data['totalLostPassportFees'] = LostPassport::where('branch_id', $user->branch_id)->sum('passport_type_fees_total');
    $data['monthlyLostPassportFees'] = LostPassport::where('branch_id', $user->branch_id)->where('created_at', '>', Carbon::now()->startOfMonth())
      ->where('created_at', '<', Carbon::now()->endOfMonth())
      ->sum('passport_type_fees_total');
    $data['dailyLostPassportFees'] = LostPassport::where('branch_id', $user->branch_id)->whereDate('created_at', Carbon::today())
      ->sum('passport_type_fees_total');



    // Manual Pasport Fee
    $data['totalManualPassportFees'] = ManualPassport::where('branch_id', $user->branch_id)->sum('passport_type_fees_total');
    $data['monthlyManualPassportFees'] = ManualPassport::where('branch_id', $user->branch_id)->where('created_at', '>', Carbon::now()->startOfMonth())
      ->where('created_at', '<', Carbon::now()->endOfMonth())
      ->sum('passport_type_fees_total');
    $data['dailyManualPassportFees'] = ManualPassport::where('branch_id', $user->branch_id)->whereDate('created_at', Carbon::today())
      ->sum('passport_type_fees_total');


    // Total New Born Baby fee
    $data['totalNewBornFees'] = NewBornBabyPassport::where('branch_id', $user->branch_id)->sum('passport_type_fees_total');
    $data['monthlyNewBornFees'] = NewBornBabyPassport::where('branch_id', $user->branch_id)->where('created_at', '>', Carbon::now()->startOfMonth())
      ->where('created_at', '<', Carbon::now()->endOfMonth())
      ->sum('passport_type_fees_total');
    $data['dailyNewBornFees'] = NewBornBabyPassport::where('branch_id', $user->branch_id)->whereDate('created_at', Carbon::today())->sum('passport_type_fees_total');


    //Total Renue Fee
    $data['totalRenewPassportFees'] = RenewPassport::where('branch_id', $user->branch_id)->sum('passport_type_fees_total');
    $data['monthlyRenewPassportFees'] = RenewPassport::where('branch_id', $user->branch_id)->where('created_at', '>', Carbon::now()->startOfMonth())
      ->where('created_at', '<', Carbon::now()->endOfMonth())
      ->sum('passport_type_fees_total');
    $data['dailyRenewPassportFees'] = RenewPassport::where('branch_id', $user->branch_id)->whereDate('created_at', Carbon::today())
      ->sum('passport_type_fees_total');

    // Total Premier Service fee
    $data['totalPremierServiceFee'] = PremierService::where('branch_id', $user->branch_id)->sum('total_fee');
    $data['monthlyPremierServiceFee'] = PremierService::where('branch_id', $user->branch_id)->where('created_at', '>', Carbon::now()->startOfMonth())
      ->where('created_at', '<', Carbon::now()->endOfMonth())
      ->sum('total_fee');
    $data['dailyPremierServiceFee'] = PremierService::where('branch_id', $user->branch_id)->whereDate('created_at', Carbon::today())->sum('total_fee');

    // Total Express Service fee
    $data['totalExpressServiceFee'] = ExpressService::where('branch_id', $user->branch_id)->sum('total_fee');
    $data['monthlyExpressServiceFee'] = ExpressService::where('branch_id', $user->branch_id)->where('created_at', '>', Carbon::now()->startOfMonth())
      ->where('created_at', '<', Carbon::now()->endOfMonth())
      ->sum('total_fee');
    $data['dailyExpressServiceFee'] = ExpressService::where('branch_id', $user->branch_id)->whereDate('created_at', Carbon::today())->sum('total_fee');

    // Total Legal Complaints Service fee
    $data['totalLegalComplaintsServiceFee'] = LegalComplaintsService::where('branch_id', $user->branch_id)->sum('total_fee');
    $data['monthlyLegalComplaintsServiceFee'] = LegalComplaintsService::where('branch_id', $user->branch_id)->where('created_at', '>', Carbon::now()->startOfMonth())
      ->where('created_at', '<', Carbon::now()->endOfMonth())
      ->sum('total_fee');
    $data['dailyLegalComplaintsServiceFee'] = LegalComplaintsService::where('branch_id', $user->branch_id)->whereDate('created_at', Carbon::today())->sum('total_fee');

    // Total Immigration Government Service fee
    $data['totalImmigrationGovementServiceFee'] = ImmigrationGovementService::where('branch_id', $user->branch_id)->sum('total_fee');
    $data['monthlyImmigrationGovementServiceFee'] = ImmigrationGovementService::where('branch_id', $user->branch_id)->where('created_at', '>', Carbon::now()->startOfMonth())
      ->where('created_at', '<', Carbon::now()->endOfMonth())
      ->sum('total_fee');
    $data['dailyImmigrationGovementServiceFee'] = ImmigrationGovementService::where('branch_id', $user->branch_id)->whereDate('created_at', Carbon::today())->sum('total_fee');


    // Total Other Service fee
    $data['totalOtherFee'] = Other::where('branch_id', $user->branch_id)->sum('fee');
    $data['monthlyOtherFee'] = Other::where('branch_id', $user->branch_id)->where('created_at', '>', Carbon::now()->startOfMonth())
      ->where('created_at', '<', Carbon::now()->endOfMonth())
      ->sum('fee');
    $data['dailyOtherFee'] = Other::where('branch_id', $user->branch_id)->whereDate('created_at', Carbon::today())->sum('fee');





    // All Passport Fee
    $data['totalPassportFees'] = $data['totalRenewPassportFees'] + $data['totalNewBornFees'] + $data['totalManualPassportFees'] + $data['totalLostPassportFees'];
    // All Other Service Fee
    $data['totalOtherServiceFees'] = $data['totalOtherFee'] + $data['totalImmigrationGovementServiceFee'] + $data['totalLegalComplaintsServiceFee'] + $data['totalExpressServiceFee'] + $data['totalPremierServiceFee'];



    return view('Admin.branchManager.data-entry', $data);
  }

  public function seeDataEntryReport($id)
  {
    $user = User::where('id', $id)->first();


    // Total Lost/Manual/Other/Renue count / Other Service
    $data['totalLostPassport'] = LostPassport::where('user_creator_id', $user->id)->count();
    $data['totalManualPassport'] = ManualPassport::where('user_creator_id', $user->id)->count();
    $data['totalNewBornBaby'] = NewBornBabyPassport::where('user_creator_id', $user->id)->count();
    $data['totalRenewPassport'] = RenewPassport::where('user_creator_id', $user->id)->count();

    $data['totalPremierService'] = PremierService::where('creator_id', $user->id)->count();
    $data['totalExpressService'] = ExpressService::where('creator_id', $user->id)->count();
    $data['totalLegalComplaintsService'] = LegalComplaintsService::where('creator_id', $user->id)->count();
    $data['totalImmigrationGovementService'] = ImmigrationGovementService::where('creator_id', $user->id)->count();
    $data['totalOther'] = Other::where('creator_id', $user->id)->count();


    //All Passport count
    $data['totalOtherService'] = $data['totalLostPassport'] + $data['totalManualPassport'] + $data['totalNewBornBaby'] + $data['totalRenewPassport'];
    //All Other Service count
    $data['totalPassport'] = $data['totalPremierService'] + $data['totalExpressService'] + $data['totalLegalComplaintsService'] + $data['totalImmigrationGovementService'] + $data['totalOther'];


    // Daily Passport(Lost/Manual/Other/Renue) count
    $data['dailyLostPassport'] = LostPassport::where('user_creator_id', $user->id)->whereDate('created_at', Carbon::today())->count();

    $data['dailyManualPassport'] = ManualPassport::where('user_creator_id', $user->id)->whereDate('created_at', Carbon::today())->count();

    $data['dailyNewBornPassport'] = NewBornBabyPassport::where('user_creator_id', $user->id)->whereDate('created_at', Carbon::today())->count();

    $data['dailyRenewPassport'] = RenewPassport::where('user_creator_id', $user->id)->whereDate('created_at', Carbon::today())->count();

    $data['dailyPremierService'] = PremierService::where('creator_id', $user->id)->whereDate('created_at', Carbon::today())->count();
    $data['dailyExpressService'] = ExpressService::where('creator_id', $user->id)->whereDate('created_at', Carbon::today())->count();
    $data['dailyLegalComplaintsService'] = LegalComplaintsService::where('creator_id', $user->id)->whereDate('created_at', Carbon::today())->count();
    $data['dailyImmigrationGovementService'] = ImmigrationGovementService::where('creator_id', $user->id)->whereDate('created_at', Carbon::today())->count();
    $data['dailyOther'] = Other::where('creator_id', $user->id)->whereDate('created_at', Carbon::today())->count();


    // Monthly Passport(Lost/Manual/Other/Renue) count
    $data['monthlyLostPassport'] = LostPassport::where('user_creator_id', $user->id)->where('created_at', '>', Carbon::now()->startOfMonth())->where('created_at', '<', Carbon::now()->endOfMonth())->count();
    $data['monthlyManualPassport'] = ManualPassport::where('user_creator_id', $user->id)->where('created_at', '>', Carbon::now()->startOfMonth())->where('created_at', '<', Carbon::now()->endOfMonth())->count();
    $data['monthlyNewBornBaby'] = NewBornBabyPassport::where('user_creator_id', $user->id)->where('created_at', '>', Carbon::now()->startOfMonth())
      ->where('created_at', '<', Carbon::now()->endOfMonth())
      ->count();
    $data['monthlyRenewPassport'] = RenewPassport::where('user_creator_id', $user->id)->where('created_at', '>', Carbon::now()->startOfMonth())->where('created_at', '<', Carbon::now()->endOfMonth())->count();
    $data['monthlyPremierService'] = PremierService::where('creator_id', $user->id)->where('created_at', '>', Carbon::now()->startOfMonth())->where('created_at', '<', Carbon::now()->endOfMonth())->count();
    $data['monthlyExpressService'] = ExpressService::where('creator_id', $user->id)->where('created_at', '>', Carbon::now()->startOfMonth())->where('created_at', '<', Carbon::now()->endOfMonth())->count();
    $data['monthlyLegalComplaintsService'] = LegalComplaintsService::where('creator_id', $user->id)->where('created_at', '>', Carbon::now()->startOfMonth())->where('created_at', '<', Carbon::now()->endOfMonth())->count();
    $data['monthlyImmigrationGovementService'] = ImmigrationGovementService::where('creator_id', $user->id)->where('created_at', '>', Carbon::now()->startOfMonth())->where('created_at', '<', Carbon::now()->endOfMonth())->count();
    $data['monthlyOther'] = Other::where('creator_id', $user->id)->where('created_at', '>', Carbon::now()->startOfMonth())->where('created_at', '<', Carbon::now()->endOfMonth())->count();


    // Lost Passport Total Fee
    $data['totalLostPassportFees'] = LostPassport::where('user_creator_id', $user->id)->sum('passport_type_fees_total');
    $data['monthlyLostPassportFees'] = LostPassport::where('user_creator_id', $user->id)->where('created_at', '>', Carbon::now()->startOfMonth())
      ->where('created_at', '<', Carbon::now()->endOfMonth())
      ->sum('passport_type_fees_total');
    $data['dailyLostPassportFees'] = LostPassport::where('user_creator_id', $user->id)->whereDate('created_at', Carbon::today())
      ->sum('passport_type_fees_total');



    // Manual Pasport Fee
    $data['totalManualPassportFees'] = ManualPassport::where('user_creator_id', $user->id)->sum('passport_type_fees_total');
    $data['monthlyManualPassportFees'] = ManualPassport::where('user_creator_id', $user->id)->where('created_at', '>', Carbon::now()->startOfMonth())
      ->where('created_at', '<', Carbon::now()->endOfMonth())
      ->sum('passport_type_fees_total');
    $data['dailyManualPassportFees'] = ManualPassport::where('user_creator_id', $user->id)->whereDate('created_at', Carbon::today())
      ->sum('passport_type_fees_total');


    // Total New Born Baby fee
    $data['totalNewBornFees'] = NewBornBabyPassport::where('user_creator_id', $user->id)->sum('passport_type_fees_total');
    $data['monthlyNewBornFees'] = NewBornBabyPassport::where('user_creator_id', $user->id)->where('created_at', '>', Carbon::now()->startOfMonth())
      ->where('created_at', '<', Carbon::now()->endOfMonth())
      ->sum('passport_type_fees_total');
    $data['dailyNewBornFees'] = NewBornBabyPassport::where('user_creator_id', $user->id)->whereDate('created_at', Carbon::today())->sum('passport_type_fees_total');


    //Total Renue Fee
    $data['totalRenewPassportFees'] = RenewPassport::where('user_creator_id', $user->id)->sum('passport_type_fees_total');
    $data['monthlyRenewPassportFees'] = RenewPassport::where('user_creator_id', $user->id)->where('created_at', '>', Carbon::now()->startOfMonth())
      ->where('created_at', '<', Carbon::now()->endOfMonth())
      ->sum('passport_type_fees_total');
    $data['dailyRenewPassportFees'] = RenewPassport::where('user_creator_id', $user->id)->whereDate('created_at', Carbon::today())
      ->sum('passport_type_fees_total');

    // Total Premier Service fee
    $data['totalPremierServiceFee'] = PremierService::where('creator_id', $user->id)->sum('total_fee');
    $data['monthlyPremierServiceFee'] = PremierService::where('creator_id', $user->id)->where('created_at', '>', Carbon::now()->startOfMonth())
      ->where('created_at', '<', Carbon::now()->endOfMonth())
      ->sum('total_fee');
    $data['dailyPremierServiceFee'] = PremierService::where('creator_id', $user->id)->whereDate('created_at', Carbon::today())->sum('total_fee');

    // Total Express Service fee
    $data['totalExpressServiceFee'] = ExpressService::where('creator_id', $user->id)->sum('total_fee');
    $data['monthlyExpressServiceFee'] = ExpressService::where('creator_id', $user->id)->where('created_at', '>', Carbon::now()->startOfMonth())
      ->where('created_at', '<', Carbon::now()->endOfMonth())
      ->sum('total_fee');
    $data['dailyExpressServiceFee'] = ExpressService::where('creator_id', $user->id)->whereDate('created_at', Carbon::today())->sum('total_fee');

    // Total Legal Complaints Service fee
    $data['totalLegalComplaintsServiceFee'] = LegalComplaintsService::where('creator_id', $user->id)->sum('total_fee');
    $data['monthlyLegalComplaintsServiceFee'] = LegalComplaintsService::where('creator_id', $user->id)->where('created_at', '>', Carbon::now()->startOfMonth())
      ->where('created_at', '<', Carbon::now()->endOfMonth())
      ->sum('total_fee');
    $data['dailyLegalComplaintsServiceFee'] = LegalComplaintsService::where('creator_id', $user->id)->whereDate('created_at', Carbon::today())->sum('total_fee');

    // Total Immigration Government Service fee
    $data['totalImmigrationGovementServiceFee'] = ImmigrationGovementService::where('creator_id', $user->id)->sum('total_fee');
    $data['monthlyImmigrationGovementServiceFee'] = ImmigrationGovementService::where('creator_id', $user->id)->where('created_at', '>', Carbon::now()->startOfMonth())
      ->where('created_at', '<', Carbon::now()->endOfMonth())
      ->sum('total_fee');
    $data['dailyImmigrationGovementServiceFee'] = ImmigrationGovementService::where('creator_id', $user->id)->whereDate('created_at', Carbon::today())->sum('total_fee');


    // Total Other Service fee
    $data['totalOtherFee'] = Other::where('creator_id', $user->id)->sum('fee');
    $data['monthlyOtherFee'] = Other::where('creator_id', $user->id)->where('created_at', '>', Carbon::now()->startOfMonth())
      ->where('created_at', '<', Carbon::now()->endOfMonth())
      ->sum('fee');
    $data['dailyOtherFee'] = Other::where('creator_id', $user->id)->whereDate('created_at', Carbon::today())->sum('fee');





    // All Passport Fee
    $data['totalPassportFees'] = $data['totalRenewPassportFees'] + $data['totalNewBornFees'] + $data['totalManualPassportFees'] + $data['totalLostPassportFees'];
    // All Other Service Fee
    $data['totalOtherServiceFees'] = $data['totalOtherFee'] + $data['totalImmigrationGovementServiceFee'] + $data['totalLegalComplaintsServiceFee'] + $data['totalExpressServiceFee'] + $data['totalPremierServiceFee'];


    return view('Admin.branchManager.dataentry-report', $data);
  }
}
