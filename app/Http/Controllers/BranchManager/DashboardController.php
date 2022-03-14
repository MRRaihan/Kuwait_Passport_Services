<?php

namespace App\Http\Controllers\BranchManager;

use App\Http\Controllers\Controller;
use App\Models\ExpressService;
use App\Models\ImmigrationGovementService;
use App\Models\LegalComplaintsService;
use App\Models\Other;
use App\Models\PremierService;
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
use App\Models\NewBornBabyPassport;
use App\Models\RenewPassport;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $data['totalDataEnterer'] = User::where('created_by', Auth::user()->id)->get();

        // Total Lost/Manual/Other/Renue count
        $data['totalLostPassport'] = LostPassport::where('branch_id', Auth::user()->branch_id)->count();
        $data['totalManualPassport'] = ManualPassport::where('branch_id', Auth::user()->branch_id)->count();
        $data['totalNewBornBabyPassport'] = NewBornBabyPassport::where('branch_id', Auth::user()->branch_id)->count();
        $data['totalRenewPassword'] = RenewPassport::where('branch_id', Auth::user()->branch_id)->count();

        // Total Others Services
        $data['totalPremierService'] = PremierService::where('branch_id', Auth::user()->branch_id)->count();
        $data['totalExpressService'] = ExpressService::where('branch_id', Auth::user()->branch_id)->count();
        $data['totalLegalComplaintsService'] = LegalComplaintsService::where('branch_id', Auth::user()->branch_id)->count();
        $data['totalImmigrationService'] = ImmigrationGovementService::where('branch_id', Auth::user()->branch_id)->count();
        $data['totalOtherService'] = Other::where('branch_id', Auth::user()->branch_id)->count();


        //All Passport count
      	$data['totalPassport'] = $data['totalLostPassport'] + $data['totalManualPassport'] + $data['totalNewBornBabyPassport'] + $data['totalRenewPassword'];


        // Daily Passport(Lost/Manual/Other/Renue) count
        $data['dailyLostPassport'] = LostPassport::whereDate('created_at', Carbon::today())
                                                    ->where('branch_id', Auth::user()->branch_id)
                                                    ->count();

        $data['dailyManualPassport'] = ManualPassport::whereDate('created_at', Carbon::today())
                                                    ->where('branch_id', Auth::user()->branch_id)
                                                    ->count();
        $data['dailyOther'] = NewBornBabyPassport::whereDate('created_at', Carbon::today())
                                        ->where('branch_id', Auth::user()->branch_id)
                                        ->count();
        $data['dailyRenewPassword'] = RenewPassport::whereDate('created_at', Carbon::today())
                                                    ->where('branch_id', Auth::user()->branch_id)
                                                    ->count();

        // Monthly Passport(Lost/Manual/Other/Renue) count
        $data['monthlyLostPassport'] = LostPassport::where('created_at', '>', Carbon::now()->startOfMonth())                                           ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                    ->where('branch_id', Auth::user()->branch_id)
                                                    ->count();
        $data['monthlyManualPassport'] = ManualPassport::where('created_at', '>', Carbon::now()->startOfMonth())                                   ->where('created_at', '<', Carbon::now()->endOfMonth())
                                            ->where('branch_id', Auth::user()->branch_id)
                                            ->count();
        $data['monthlyOther'] = NewBornBabyPassport::where('created_at', '>', Carbon::now()->startOfMonth())
                                        ->where('created_at', '<', Carbon::now()->endOfMonth())
                                        ->where('branch_id', Auth::user()->branch_id)
                                        ->count();
        $data['monthlyRenewPassword'] = RenewPassport::where('created_at', '>', Carbon::now()->startOfMonth())
                                                        ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                        ->where('branch_id', Auth::user()->branch_id)
                                                        ->count();
        //Daily Others services
        $data['dailyPremierService'] = PremierService::whereDate('created_at', Carbon::today())
            ->where('branch_id', Auth::user()->branch_id)
            ->count();
        $data['dailyExpressService'] = ExpressService::whereDate('created_at', Carbon::today())
            ->where('branch_id', Auth::user()->branch_id)
            ->count();
        $data['dailyLegalComplaintsService'] = LegalComplaintsService::whereDate('created_at', Carbon::today())
            ->where('branch_id', Auth::user()->branch_id)
            ->count();
        $data['dailyImmigrationService'] = ImmigrationGovementService::whereDate('created_at', Carbon::today())
            ->where('branch_id', Auth::user()->branch_id)
            ->count();
        $data['dailyOtherService'] = Other::whereDate('created_at', Carbon::today())
            ->where('branch_id', Auth::user()->branch_id)
            ->count();


        //Monthly Others services
        $data['monthlyPremierService'] = PremierService::where('created_at', '>', Carbon::now()->startOfMonth())
            ->where('created_at', '<', Carbon::now()->endOfMonth())
            ->where('branch_id', Auth::user()->branch_id)
            ->count();
        $data['monthlyExpressService'] = ExpressService::where('created_at', '>', Carbon::now()->startOfMonth())
            ->where('created_at', '<', Carbon::now()->endOfMonth())
            ->where('branch_id', Auth::user()->branch_id)
            ->count();
        $data['monthlyLegalComplaintsService'] = LegalComplaintsService::where('created_at', '>', Carbon::now()->startOfMonth())
            ->where('created_at', '<', Carbon::now()->endOfMonth())
            ->where('branch_id', Auth::user()->branch_id)
            ->count();
        $data['monthlyImmigrationService'] = ImmigrationGovementService::where('created_at', '>', Carbon::now()->startOfMonth())
            ->where('created_at', '<', Carbon::now()->endOfMonth())
            ->where('branch_id', Auth::user()->branch_id)
            ->count();
        $data['monthlyOtherService'] = Other::where('created_at', '>', Carbon::now()->startOfMonth())
            ->where('created_at', '<', Carbon::now()->endOfMonth())
            ->where('branch_id', Auth::user()->branch_id)
            ->count();

        // Total Services Count
        $data['totalServices'] = $data['totalPremierService'] + $data['totalExpressService'] + $data['totalLegalComplaintsService'] + $data['totalImmigrationService']+ $data['totalOtherService'];


        // Lost Password Total Fee
        $data['totalLostPassportFees'] = LostPassport::where('branch_id', Auth::user()->branch_id)
                                                    ->sum('passport_type_fees_total');
        $data['monthlyLostPassportFees'] = LostPassport::where('created_at', '>', Carbon::now()->startOfMonth())
                                            ->where('created_at', '<', Carbon::now()->endOfMonth())
                                            ->where('branch_id', Auth::user()->branch_id)
                                            ->sum('passport_type_fees_total');
        $data['dailyLostPassportFees'] = LostPassport::whereDate('created_at', Carbon::today())
                                            ->where('branch_id', Auth::user()->branch_id)
                                            ->sum('passport_type_fees_total');


        // Manual Pasport Fee
        $data['totalManualPassportFees'] = ManualPassport::where('branch_id', Auth::user()->branch_id)
                                                            ->sum('passport_type_fees_total');
        $data['monthlyManualPassportFees'] = ManualPassport::where('created_at', '>', Carbon::now()->startOfMonth())
                                            ->where('created_at', '<', Carbon::now()->endOfMonth())
                                            ->where('branch_id', Auth::user()->branch_id)
                                            ->sum('passport_type_fees_total');
        $data['dailyManualPassportFees'] = ManualPassport::whereDate('created_at', Carbon::today())
                                            ->where('branch_id', Auth::user()->branch_id)
                                            ->sum('passport_type_fees_total');


        // Total other fee

        $data['totalNewBornFees'] = NewBornBabyPassport::where('branch_id', Auth::user()->branch_id)
                                        ->sum('passport_type_fees_total');
        $data['monthlyNewBornFees'] = NewBornBabyPassport::where('created_at', '>', Carbon::now()->startOfMonth())
                                    ->where('created_at', '<', Carbon::now()->endOfMonth())
                                    ->where('branch_id', Auth::user()->branch_id)
                                    ->sum('passport_type_fees_total');
        $data['dailyNewBornFees'] = NewBornBabyPassport::whereDate('created_at', Carbon::today())
                                    ->where('branch_id', Auth::user()->branch_id)
                                    ->sum('passport_type_fees_total');




        //Total Renue Fee

        $data['totalRenewPasswordFees'] = RenewPassport::where('branch_id', Auth::user()->branch_id)
                                                            ->sum('passport_type_fees_total');

        $data['monthlyRenewPasswordFees'] = RenewPassport::where('created_at', '>', Carbon::now()->startOfMonth())
                                                            ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                            ->where('branch_id', Auth::user()->branch_id)
                                                            ->sum('passport_type_fees_total');
        $data['dailyRenewPasswordFees'] = RenewPassport::whereDate('created_at', Carbon::today())
                                                            ->where('branch_id', Auth::user()->branch_id)
                                                            ->sum('passport_type_fees_total');
        // Others Services total fees

        // Total Premier Service fee
        $data['totalPremierServiceFee'] = PremierService::where('branch_id', Auth::user()->branch_id)
            ->sum('total_fee');
        $data['monthlyPremierServiceFee'] = PremierService::where('created_at', '>', Carbon::now()->startOfMonth())
            ->where('created_at', '<', Carbon::now()->endOfMonth())
            ->where('branch_id', Auth::user()->branch_id)
            ->sum('total_fee');
        $data['dailyPremierServiceFee'] = PremierService::whereDate('created_at', Carbon::today())->where('branch_id', Auth::user()->branch_id)
            ->sum('total_fee');

        // Total Express Service fee
        $data['totalExpressServiceFee'] = ExpressService::where('branch_id', Auth::user()->branch_id)
            ->sum('total_fee');
        $data['monthlyExpressServiceFee'] = ExpressService::where('created_at', '>', Carbon::now()->startOfMonth())
            ->where('created_at', '<', Carbon::now()->endOfMonth())
            ->where('branch_id', Auth::user()->branch_id)
            ->sum('total_fee');
        $data['dailyExpressServiceFee'] = ExpressService::whereDate('created_at', Carbon::today())->where('branch_id', Auth::user()->branch_id)
            ->sum('total_fee');

        // Total Legal Complaints Service fee
        $data['totalLegalComplaintsServiceFee'] = LegalComplaintsService::where('branch_id', Auth::user()->branch_id)
            ->sum('total_fee');
        $data['monthlyLegalComplaintsServiceFee'] = LegalComplaintsService::where('created_at', '>', Carbon::now()->startOfMonth())
            ->where('created_at', '<', Carbon::now()->endOfMonth())
            ->where('branch_id', Auth::user()->branch_id)
            ->sum('total_fee');
        $data['dailyLegalComplaintsServiceFee'] = LegalComplaintsService::whereDate('created_at', Carbon::today())->where('branch_id', Auth::user()->branch_id)
            ->sum('total_fee');

        // Total Immigration Government Service fee
        $data['totalImmigrationGovementServiceFee'] = ImmigrationGovementService::where('branch_id', Auth::user()->branch_id)
            ->sum('total_fee');
        $data['monthlyImmigrationGovementServiceFee'] = ImmigrationGovementService::where('created_at', '>', Carbon::now()->startOfMonth())
            ->where('created_at', '<', Carbon::now()->endOfMonth())
            ->where('branch_id', Auth::user()->branch_id)
            ->sum('total_fee');
        $data['dailyImmigrationGovementServiceFee'] = ImmigrationGovementService::whereDate('created_at', Carbon::today())->where('branch_id', Auth::user()->branch_id)
            ->sum('total_fee');


        // Total Other Service fee
        $data['totalOtherFee'] = Other::where('branch_id', Auth::user()->branch_id)
            ->sum('fee');
        $data['monthlyOtherFee'] = Other::where('created_at', '>', Carbon::now()->startOfMonth())
            ->where('created_at', '<', Carbon::now()->endOfMonth())
            ->where('branch_id', Auth::user()->branch_id)
            ->sum('fee');
        $data['dailyOtherFee'] = Other::whereDate('created_at', Carbon::today())->where('branch_id', Auth::user()->branch_id)
            ->sum('fee');
        // All Other Services Fees

        $data ['TotalServicesFees'] = $data['totalPremierServiceFee']+$data['totalExpressServiceFee']+$data['totalLegalComplaintsServiceFee']+$data['totalImmigrationGovementServiceFee']+$data['totalOtherFee'];



        // All Passport Fee
        $data['totalPassportFees'] = $data['totalRenewPasswordFees'] + $data['totalNewBornFees'] + $data['totalManualPassportFees'] + $data['totalLostPassportFees'];

        return view('BranchManager.dashboard', $data);

    }





    public function reportLostPassport($data){
        $flag = 0;
        if ($data == 'monthly') {
            $lostPassports = LostPassport::where('created_at', '>', Carbon::now()->startOfMonth())
                                ->where('created_at', '<', Carbon::now()->endOfMonth())
                                ->where('branch_id', Auth::user()->branch_id)
                                ->get();
            return view('BranchManager.lostPassport.index', compact('lostPassports', 'flag'));
        }else{
            $lostPassports = LostPassport::whereDate('created_at', Carbon::today())
                                            ->where('branch_id', Auth::user()->branch_id)
                                            ->get();

            return view('BranchManager.lostPassport.index', compact('lostPassports', 'flag'));
        }
    }
    public function reportManualPassport($data){
        $flag = 0;
        if ($data == 'monthly') {
            $manualPassports = ManualPassport::where('created_at', '>', Carbon::now()->startOfMonth())
                                            ->where('created_at', '<', Carbon::now()->endOfMonth())
                                            ->where('branch_id', Auth::user()->branch_id)
                                            ->get();
            return view('BranchManager.manualPassport.index', compact('manualPassports', 'flag'));
        }else{
            $manualPassports = ManualPassport::whereDate('created_at', Carbon::today())
                                                ->where('branch_id', Auth::user()->branch_id)
                                                ->get();

            return view('BranchManager.manualPassport.index', compact('manualPassports', 'flag'));
        }
    }
    public function reportRenuePassport($data){
        $flag = 0;
        if ($data == 'monthly') {
            $renewPassports = RenewPassport::where('created_at', '>', Carbon::now()->startOfMonth())
                                            ->where('created_at', '<', Carbon::now()->endOfMonth())
                                            ->where('branch_id', Auth::user()->branch_id)
                                            ->get();
            return view('BranchManager.renewPassport.index', compact('renewPassports', 'flag'));
        }else{
            $renewPassports = RenewPassport::whereDate('created_at', Carbon::today())
                                    ->where('branch_id', Auth::user()->branch_id)
                                    ->get();

            return view('BranchManager.renewPassport.index', compact('renewPassports', 'flag'));
        }
    }
    public function reportNewBornBabyPassport($data){
        $flag = 0;
        if ($data == 'monthly') {
            $newBornBabyPassports = NewBornBabyPassport::where('created_at', '>', Carbon::now()->startOfMonth())
                                    ->where('created_at', '<', Carbon::now()->endOfMonth())
                                    ->where('branch_id', Auth::user()->branch_id)
                                    ->get();
            return view('BranchManager.newBornBabyPassport.index', compact('newBornBabyPassports', 'flag'));
        }else{
            $newBornBabyPassports = NewBornBabyPassport::whereDate('created_at', Carbon::today())
                                        ->where('branch_id', Auth::user()->branch_id)
                                        ->get();

            return view('BranchManager.newBornBabyPassport.index', compact('newBornBabyPassports', 'flag'));
        }
    }


    public function profile()
    {
        $user = Auth::user();
        return view('BranchManager.profile.index', compact('user'));
    }

    public function editProfile(){
        $user = Auth::user();
        return view('BranchManager.profile.edit', compact('user'));
    }

    public function updateProfile(Request $request){
        $request->validate([
            'name' => 'required',
            'image' => 'nullable|image',
        ]);
        $user = Auth::user();

        $user->name = $request->name;
        if($request->hasFile('image')){
            if ($user->image != null)
                File::delete(public_path($user->image)); //Old image delete
            $image             = $request->file('image');
            $folder_path       = 'uploads/images/users/';
            $image_new_name    = Str::random(20).'-'.now()->timestamp.'.'.$image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->save($folder_path.$image_new_name);
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
