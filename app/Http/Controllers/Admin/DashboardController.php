<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;
use App\Models\ManualPassport;
use App\Models\User;
use App\Models\LostPassport;
use App\Models\PremierService;
use App\Models\ExpressService;
use App\Models\LegalComplaintsService;
use App\Models\ImmigrationGovementService;
use App\Models\Other;
use App\Models\NewBornBabyPassport;
use App\Models\RenewPassport;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function dashboard()
    {

        // Total Branch Manager/Call Center/Data Entre/Accounts count
        $data['totalBranches'] = User::where('user_type', "branch-manager")->count();
        $data['totalCallCenters'] = User::where('user_type', "call-center")->count();
        $data['totalAccounts'] = User::where('user_type', "account-manager")->count();
        $data['totalDataEntre'] = User::where('user_type', "data-enterer")->count();


        // Total Lost/Manual/Other/Renue count / Other Service
        $data['totalLostPassport'] = LostPassport::count();
        $data['totalManualPassport'] = ManualPassport::count();
        $data['totalNewBornBaby'] = NewBornBabyPassport::count();
        $data['totalRenewPassport'] = RenewPassport::count();

        $data['totalPremierService'] = PremierService::count();
        $data['totalExpressService'] = ExpressService::count();
        $data['totalLegalComplaintsService'] = LegalComplaintsService::count();
        $data['totalImmigrationGovementService'] = ImmigrationGovementService::count();
        $data['totalOther'] = Other::count();


        //All Passport count

        $data['totalPassport'] = $data['totalLostPassport'] + $data['totalManualPassport'] + $data['totalNewBornBaby'] + $data['totalRenewPassport'];
        //All Passport count
        $data['totalOtherServices'] = $data['totalPremierService'] + $data['totalExpressService'] + $data['totalLegalComplaintsService'] + $data['totalImmigrationGovementService'] + $data['totalOther'];


        // Daily Passport(Lost/Manual/Other/Renue) count
        $data['dailyLostPassport'] = LostPassport::whereDate('created_at', Carbon::today())->count();

        $data['dailyManualPassport'] = ManualPassport::whereDate('created_at', Carbon::today())->count();

        $data['dailyNewBornPassport'] = NewBornBabyPassport::whereDate('created_at', Carbon::today())->count();

        $data['dailyRenewPassport'] = RenewPassport::whereDate('created_at', Carbon::today())->count();

        $data['dailyPremierService'] = PremierService::whereDate('created_at', Carbon::today())->count();
        $data['dailyExpressService'] = ExpressService::whereDate('created_at', Carbon::today())->count();
        $data['dailyLegalComplaintsService'] = LegalComplaintsService::whereDate('created_at', Carbon::today())->count();
        $data['dailyImmigrationGovementService'] = ImmigrationGovementService::whereDate('created_at', Carbon::today())->count();
        $data['dailyOther'] = Other::whereDate('created_at', Carbon::today())->count();


        // Monthly Passport(Lost/Manual/Other/Renue) count
        $data['monthlyLostPassport'] = LostPassport::where('created_at', '>', Carbon::now()->startOfMonth())->where('created_at', '<', Carbon::now()->endOfMonth())->count();
        $data['monthlyManualPassport'] = ManualPassport::where('created_at', '>', Carbon::now()->startOfMonth())->where('created_at', '<', Carbon::now()->endOfMonth())->count();
        $data['monthlyNewBornBaby'] = NewBornBabyPassport::where('created_at', '>', Carbon::now()->startOfMonth())
            ->where('created_at', '<', Carbon::now()->endOfMonth())
            ->count();
        $data['monthlyRenewPassport'] = RenewPassport::where('created_at', '>', Carbon::now()->startOfMonth())->where('created_at', '<', Carbon::now()->endOfMonth())->count();
        $data['monthlyPremierService'] = PremierService::where('created_at', '>', Carbon::now()->startOfMonth())->where('created_at', '<', Carbon::now()->endOfMonth())->count();
        $data['monthlyExpressService'] = ExpressService::where('created_at', '>', Carbon::now()->startOfMonth())->where('created_at', '<', Carbon::now()->endOfMonth())->count();
        $data['monthlyLegalComplaintsService'] = LegalComplaintsService::where('created_at', '>', Carbon::now()->startOfMonth())->where('created_at', '<', Carbon::now()->endOfMonth())->count();
        $data['monthlyImmigrationGovementService'] = ImmigrationGovementService::where('created_at', '>', Carbon::now()->startOfMonth())->where('created_at', '<', Carbon::now()->endOfMonth())->count();
        $data['monthlyOther'] = Other::where('created_at', '>', Carbon::now()->startOfMonth())->where('created_at', '<', Carbon::now()->endOfMonth())->count();


        // Lost Passport Total Fee
        $data['totalLostPassportFees'] = LostPassport::sum('passport_type_fees_total');
        $data['monthlyLostPassportFees'] = LostPassport::where('created_at', '>', Carbon::now()->startOfMonth())
            ->where('created_at', '<', Carbon::now()->endOfMonth())
            ->sum('passport_type_fees_total');
        $data['dailyLostPassportFees'] = LostPassport::whereDate('created_at', Carbon::today())
            ->sum('passport_type_fees_total');



        // Manual Pasport Fee
        $data['totalManualPassportFees'] = ManualPassport::sum('passport_type_fees_total');
        $data['monthlyManualPassportFees'] = ManualPassport::where('created_at', '>', Carbon::now()->startOfMonth())
            ->where('created_at', '<', Carbon::now()->endOfMonth())
            ->sum('passport_type_fees_total');
        $data['dailyManualPassportFees'] = ManualPassport::whereDate('created_at', Carbon::today())
            ->sum('passport_type_fees_total');


        // Total New Born Baby fee
        $data['totalNewBornFees'] = NewBornBabyPassport::sum('passport_type_fees_total');
        $data['monthlyNewBornFees'] = NewBornBabyPassport::where('created_at', '>', Carbon::now()->startOfMonth())
            ->where('created_at', '<', Carbon::now()->endOfMonth())
            ->sum('passport_type_fees_total');
        $data['dailyNewBornFees'] = NewBornBabyPassport::whereDate('created_at', Carbon::today())->sum('passport_type_fees_total');


        //Total Renue Fee
        $data['totalRenewPassportFees'] = RenewPassport::sum('passport_type_fees_total');
        $data['monthlyRenewPassportFees'] = RenewPassport::where('created_at', '>', Carbon::now()->startOfMonth())
            ->where('created_at', '<', Carbon::now()->endOfMonth())
            ->sum('passport_type_fees_total');
        $data['dailyRenewPassportFees'] = RenewPassport::whereDate('created_at', Carbon::today())
            ->sum('passport_type_fees_total');

        // Total Premier Service fee
        $data['totalPremierServiceFee'] = PremierService::sum('total_fee');
        $data['monthlyPremierServiceFee'] = PremierService::where('created_at', '>', Carbon::now()->startOfMonth())
            ->where('created_at', '<', Carbon::now()->endOfMonth())
            ->sum('total_fee');
        $data['dailyPremierServiceFee'] = PremierService::whereDate('created_at', Carbon::today())->sum('total_fee');

        // Total Express Service fee
        $data['totalExpressServiceFee'] = ExpressService::sum('total_fee');
        $data['monthlyExpressServiceFee'] = ExpressService::where('created_at', '>', Carbon::now()->startOfMonth())
            ->where('created_at', '<', Carbon::now()->endOfMonth())
            ->sum('total_fee');
        $data['dailyExpressServiceFee'] = ExpressService::whereDate('created_at', Carbon::today())->sum('total_fee');

        // Total Legal Complaints Service fee
        $data['totalLegalComplaintsServiceFee'] = LegalComplaintsService::sum('total_fee');
        $data['monthlyLegalComplaintsServiceFee'] = LegalComplaintsService::where('created_at', '>', Carbon::now()->startOfMonth())
            ->where('created_at', '<', Carbon::now()->endOfMonth())
            ->sum('total_fee');
        $data['dailyLegalComplaintsServiceFee'] = LegalComplaintsService::whereDate('created_at', Carbon::today())->sum('total_fee');

        // Total Immigration Government Service fee
        $data['totalImmigrationGovementServiceFee'] = ImmigrationGovementService::sum('total_fee');
        $data['monthlyImmigrationGovementServiceFee'] = ImmigrationGovementService::where('created_at', '>', Carbon::now()->startOfMonth())
            ->where('created_at', '<', Carbon::now()->endOfMonth())
            ->sum('total_fee');
        $data['dailyImmigrationGovementServiceFee'] = ImmigrationGovementService::whereDate('created_at', Carbon::today())->sum('total_fee');


        // Total Other Service fee
        $data['totalOtherFee'] = Other::sum('fee');
        $data['monthlyOtherFee'] = Other::where('created_at', '>', Carbon::now()->startOfMonth())
            ->where('created_at', '<', Carbon::now()->endOfMonth())
            ->sum('fee');
        $data['dailyOtherFee'] = Other::whereDate('created_at', Carbon::today())->sum('fee');





        // All Passport Fee
        $data['totalPassportFees'] = $data['totalRenewPassportFees'] + $data['totalNewBornFees'] + $data['totalManualPassportFees'] + $data['totalLostPassportFees'];
        // All Passport Fee
        $data['totalOtherServiceFees'] = $data['totalOtherFee'] + $data['totalImmigrationGovementServiceFee'] + $data['totalLegalComplaintsServiceFee'] + $data['totalExpressServiceFee'] + $data['totalPremierServiceFee'];


        return view('Admin.dashboard', $data);
    }

    public function reportLostPassport($data)
    {
        $flag = 0;
        if ($data == 'monthly') {
            $lostPassports = LostPassport::where('created_at', '>', Carbon::now()->startOfMonth())->where('created_at', '<', Carbon::now()->endOfMonth())->get();
            return view('Admin.lostPassport.index', compact('lostPassports', 'flag'));
        } else {
            $lostPassports = LostPassport::whereDate('created_at', Carbon::today())->get();

            return view('Admin.lostPassport.index', compact('lostPassports', 'flag'));
        }
    }
    public function reportManualPassport($data)
    {
        $flag = 0;
        if ($data == 'monthly') {
            $manualPassports = ManualPassport::where('created_at', '>', Carbon::now()->startOfMonth())->where('created_at', '<', Carbon::now()->endOfMonth())->get();
            return view('Admin.manualPassport.index', compact('manualPassports', 'flag'));
        } else {
            $manualPassports = ManualPassport::whereDate('created_at', Carbon::today())->get();

            return view('Admin.manualPassport.index', compact('manualPassports', 'flag'));
        }
    }
    public function reportRenuePassport($data)
    {
        $flag = 0;
        if ($data == 'monthly') {
            $renewPassports = RenewPassport::where('created_at', '>', Carbon::now()->startOfMonth())->where('created_at', '<', Carbon::now()->endOfMonth())->get();
            return view('Admin.renewPassport.index', compact('renewPassports', 'flag'));
        } else {
            $renewPassports = RenewPassport::whereDate('created_at', Carbon::today())->get();

            return view('Admin.renewPassport.index', compact('renewPassports', 'flag'));
        }
    }
    public function reportNewBornPassport($data)
    {
        $flag = 0;
        if ($data == 'monthly') {
            $newBornBabyPassports = NewBornBabyPassport::where('created_at', '>', Carbon::now()->startOfMonth())->where('created_at', '<', Carbon::now()->endOfMonth())->get();
            return view('Admin.newBornBabyPassport.index', compact('newBornBabyPassports', 'flag'));
        } else {
            $newBornBabyPassports = NewBornBabyPassport::whereDate('created_at', Carbon::today())->get();

            return view('Admin.newBornBabyPassport.index', compact('newBornBabyPassports', 'flag'));
        }
    }
    public function reportPremierService($data)
    {
        $flag = 0;
        if ($data == 'monthly') {
            $takenPremierServices = PremierService::where('created_at', '>', Carbon::now()->startOfMonth())->where('created_at', '<', Carbon::now()->endOfMonth())->get();
            return view('Admin.otherServices.PremierService.index', compact('takenPremierServices', 'flag'));
        } else {
            $takenPremierServices = PremierService::whereDate('created_at', Carbon::today())->get();

            return view('Admin.otherServices.PremierService.index', compact('takenPremierServices', 'flag'));
        }
    }

    public function reportExpressService($data)
    {
        $flag = 0;
        if ($data == 'monthly') {
            $takenExpressService = ExpressService::where('created_at', '>', Carbon::now()->startOfMonth())->where('created_at', '<', Carbon::now()->endOfMonth())->get();
            return view('Admin.otherServices.ExpressService.index', compact('takenExpressService', 'flag'));
        } else {
            $takenExpressService = ExpressService::whereDate('created_at', Carbon::today())->get();

            return view('Admin.otherServices.ExpressService.index', compact('takenExpressService', 'flag'));
        }
    }
    public function reportLegalComplaintsService($data)
    {
        $flag = 0;
        if ($data == 'monthly') {
            $takenLegalComplaintsServices = LegalComplaintsService::where('created_at', '>', Carbon::now()->startOfMonth())->where('created_at', '<', Carbon::now()->endOfMonth())->get();
            return view('Admin.otherServices.LegalComplainService.index', compact('takenLegalComplaintsServices', 'flag'));
        } else {
            $takenLegalComplaintsServices = LegalComplaintsService::whereDate('created_at', Carbon::today())->get();

            return view('Admin.otherServices.LegalComplainService.index', compact('takenLegalComplaintsServices', 'flag'));
        }
    }
    public function reportImmigrationGovementService($data)
    {
        $flag = 0;
        if ($data == 'monthly') {
            $takenImmigrationService = ImmigrationGovementService::where('created_at', '>', Carbon::now()->startOfMonth())->where('created_at', '<', Carbon::now()->endOfMonth())->get();
            return view('Admin.otherServices.immigrationGovementService.index', compact('takenImmigrationService', 'flag'));
        } else {
            $takenImmigrationService = ImmigrationGovementService::whereDate('created_at', Carbon::today())->get();

            return view('Admin.otherServices.immigrationGovementService.index', compact('takenImmigrationService', 'flag'));
        }
    }
    public function reportOtherService($data)
    {
        $flag = 0;
        if ($data == 'monthly') {
            $otherPassports = Other::where('created_at', '>', Carbon::now()->startOfMonth())->where('created_at', '<', Carbon::now()->endOfMonth())->get();
            return view('Admin.otherServices.index', compact('otherPassports', 'flag'));
        } else {
            $otherPassports = Other::whereDate('created_at', Carbon::today())->get();

            return view('Admin.otherServices.index', compact('otherPassports', 'flag'));
        }
    }

    public function profile()
    {
        $user = Auth::user();
        return view('Admin.profile.index', compact('user'));
    }

    public function editProfile()
    {
        $user = Auth::user();
        return view('Admin.profile.edit', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'nullable|image',
        ]);
        $user = Auth::user();

        $user->name = $request->name;
        if ($request->hasFile('image')) {
            if ($user->image != null)
                File::delete(public_path($user->image)); //Old image delete
            $image             = $request->file('image');
            $folder_path       = 'uploads/images/users/';
            $image_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->save($folder_path . $image_new_name);
            $user->image   = $folder_path . $image_new_name;
        }
        try {
            $user->save();
            // return back()->withSuccess('Updated successfully!');
            Session::flash('success', 'Successfully Updated !!');
            return redirect()->back();
        } catch (\Exception $exception) {
            // return back()->withErrors( 'Something went wrong !'.$exception->getMessage());
            Session::flash('danger', $exception->getMessage());
            return redirect()->back();
        }
    }
}
