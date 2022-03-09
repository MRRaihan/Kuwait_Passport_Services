<?php

namespace App\Http\Controllers\DataEnterer;

use App\Http\Controllers\Controller;
use App\Models\LostPassport;
use App\Models\ManualPassport;
use App\Models\Other;
use App\Models\RenewPassport;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;
use App\Models\PremierService;
use App\Models\ExpressService;
use App\Models\LegalComplaintsService;
use App\Models\ImmigrationGovementService;
use App\Models\NewBornBabyPassport;

class DashboardController extends Controller
{

    public function dashboard()
    {

        // Total Lost/Manual/Other/Renue count / Other Service
        $data['totalLostPassport'] = LostPassport::where('user_creator_id', Auth()->user()->id)->count();
        $data['totalManualPassport'] = ManualPassport::where('user_creator_id', Auth()->user()->id)->count();
        $data['totalNewBornBaby'] = NewBornBabyPassport::where('user_creator_id', Auth()->user()->id)->count();
        $data['totalRenewPassport'] = RenewPassport::where('user_creator_id', Auth()->user()->id)->count();

        $data['totalPremierService'] = PremierService::where('creator_id', Auth()->user()->id)->count();
        $data['totalExpressService'] = ExpressService::where('creator_id', Auth()->user()->id)->count();
        $data['totalLegalComplaintsService'] = LegalComplaintsService::where('creator_id', Auth()->user()->id)->count();
        $data['totalImmigrationGovementService'] = ImmigrationGovementService::where('creator_id', Auth()->user()->id)->count();
        $data['totalOther'] = Other::where('creator_id', Auth()->user()->id)->count();


        //All Passport count
      	$data['totalPassport'] = $data['totalLostPassport'] + $data['totalManualPassport'] + $data['totalNewBornBaby'] + $data['totalRenewPassport'];

        //All Other services's count
      	$data['totalOtherServices'] = $data['totalPremierService'] + $data['totalExpressService'] + $data['totalLegalComplaintsService'] + $data['totalImmigrationGovementService'] + $data['totalOther'];


        // Daily Passport(Lost/Manual/Other/Renue) count
        $data['dailyLostPassport'] = LostPassport::where('user_creator_id', Auth()->user()->id)->whereDate('created_at', Carbon::today())->count();
        $data['dailyManualPassport'] = ManualPassport::where('user_creator_id', Auth()->user()->id)->whereDate('created_at', Carbon::today())->count();
        $data['dailyNewBornPassport'] = NewBornBabyPassport::where('user_creator_id', Auth()->user()->id)->whereDate('created_at', Carbon::today())->count();
        $data['dailyRenewPassport'] = RenewPassport::where('user_creator_id', Auth()->user()->id)->whereDate('created_at', Carbon::today())->count();
        $data['dailyPremierService'] = PremierService::where('creator_id', Auth()->user()->id)->whereDate('created_at', Carbon::today())->count();
        $data['dailyExpressService'] = ExpressService::where('creator_id', Auth()->user()->id)->whereDate('created_at', Carbon::today())->count();
        $data['dailyLegalComplaintsService'] = LegalComplaintsService::where('creator_id', Auth()->user()->id)->whereDate('created_at', Carbon::today())->count();
        $data['dailyImmigrationGovementService'] = ImmigrationGovementService::where('creator_id', Auth()->user()->id)->whereDate('created_at', Carbon::today())->count();
        $data['dailyOther'] = Other::where('creator_id', Auth()->user()->id)->whereDate('created_at', Carbon::today())->count();


        // Monthly Passport(Lost/Manual/Other/Renue) count
        $data['monthlyLostPassport'] = LostPassport::where('user_creator_id', Auth()->user()->id)->where('created_at', '>', Carbon::now()->startOfMonth()) ->where('created_at', '<', Carbon::now()->endOfMonth()) ->count();
        $data['monthlyManualPassport'] = ManualPassport::where('user_creator_id', Auth()->user()->id)->where('created_at', '>', Carbon::now()->startOfMonth()) ->where('created_at', '<', Carbon::now()->endOfMonth()) ->count();
        $data['monthlyNewBornBaby'] = NewBornBabyPassport::where('user_creator_id', Auth()->user()->id)->where('created_at', '>', Carbon::now()->startOfMonth())
                                        ->where('created_at', '<', Carbon::now()->endOfMonth())
                                        ->count();
        $data['monthlyRenewPassport'] = RenewPassport::where('user_creator_id', Auth()->user()->id)->where('created_at', '>', Carbon::now()->startOfMonth()) ->where('created_at', '<', Carbon::now()->endOfMonth()) ->count();
        $data['monthlyPremierService'] = PremierService::where('creator_id', Auth()->user()->id)->where('created_at', '>', Carbon::now()->startOfMonth()) ->where('created_at', '<', Carbon::now()->endOfMonth()) ->count();
        $data['monthlyExpressService'] = ExpressService::where('creator_id', Auth()->user()->id)->where('created_at', '>', Carbon::now()->startOfMonth()) ->where('created_at', '<', Carbon::now()->endOfMonth()) ->count();
        $data['monthlyLegalComplaintsService'] = LegalComplaintsService::where('creator_id', Auth()->user()->id)->where('created_at', '>', Carbon::now()->startOfMonth()) ->where('created_at', '<', Carbon::now()->endOfMonth()) ->count();
        $data['monthlyImmigrationGovementService'] = ImmigrationGovementService::where('creator_id', Auth()->user()->id)->where('created_at', '>', Carbon::now()->startOfMonth()) ->where('created_at', '<', Carbon::now()->endOfMonth()) ->count();
        $data['monthlyOther'] = Other::where('creator_id', Auth()->user()->id)->where('created_at', '>', Carbon::now()->startOfMonth()) ->where('created_at', '<', Carbon::now()->endOfMonth()) ->count();


        // Lost Passport Total Fee
        $data['totalLostPassportFees'] = LostPassport::where('user_creator_id', Auth()->user()->id)->sum('passport_type_fees_total');
        $data['monthlyLostPassportFees'] = LostPassport::where('user_creator_id', Auth()->user()->id)->where('created_at', '>', Carbon::now()->startOfMonth())
                                            ->where('created_at', '<', Carbon::now()->endOfMonth())
                                            ->sum('passport_type_fees_total');
        $data['dailyLostPassportFees'] = LostPassport::where('user_creator_id', Auth()->user()->id)->whereDate('created_at', Carbon::today())
                                            ->sum('passport_type_fees_total');
        


        // Manual Pasport Fee
        $data['totalManualPassportFees'] = ManualPassport::where('user_creator_id', Auth()->user()->id)->sum('passport_type_fees_total');
        $data['monthlyManualPassportFees'] = ManualPassport::where('user_creator_id', Auth()->user()->id)->where('created_at', '>', Carbon::now()->startOfMonth())
                                            ->where('created_at', '<', Carbon::now()->endOfMonth())
                                            ->sum('passport_type_fees_total');
        $data['dailyManualPassportFees'] = ManualPassport::where('user_creator_id', Auth()->user()->id)->whereDate('created_at', Carbon::today())
                                            ->sum('passport_type_fees_total');


        // Total New Born Baby fee
        $data['totalNewBornFees'] = NewBornBabyPassport::where('user_creator_id', Auth()->user()->id)->sum('passport_type_fees_total');
        $data['monthlyNewBornFees'] = NewBornBabyPassport::where('user_creator_id', Auth()->user()->id)->where('created_at', '>', Carbon::now()->startOfMonth())
                                    ->where('created_at', '<', Carbon::now()->endOfMonth())
                                    ->sum('passport_type_fees_total');
        $data['dailyNewBornFees'] = NewBornBabyPassport::where('user_creator_id', Auth()->user()->id)->whereDate('created_at', Carbon::today())->sum('passport_type_fees_total');


        //Total Renue Fee
        $data['totalRenewPassportFees'] = RenewPassport::where('user_creator_id', Auth()->user()->id)->sum('passport_type_fees_total');
        $data['monthlyRenewPassportFees'] = RenewPassport::where('user_creator_id', Auth()->user()->id)->where('created_at', '>', Carbon::now()->startOfMonth())
                                                            ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                            ->sum('passport_type_fees_total');
        $data['dailyRenewPassportFees'] = RenewPassport::where('user_creator_id', Auth()->user()->id)->whereDate('created_at', Carbon::today())
                                                            ->sum('passport_type_fees_total');

        // Total Premier Service fee
        $data['totalPremierServiceFee'] = PremierService::where('creator_id', Auth()->user()->id)->sum('total_fee');
        $data['monthlyPremierServiceFee'] = PremierService::where('creator_id', Auth()->user()->id)->where('created_at', '>', Carbon::now()->startOfMonth())
                                    ->where('created_at', '<', Carbon::now()->endOfMonth())
                                    ->sum('total_fee');
        $data['dailyPremierServiceFee'] = PremierService::where('creator_id', Auth()->user()->id)->whereDate('created_at', Carbon::today())->sum('total_fee');

        // Total Express Service fee
        $data['totalExpressServiceFee'] = ExpressService::where('creator_id', Auth()->user()->id)->sum('total_fee');
        $data['monthlyExpressServiceFee'] = ExpressService::where('creator_id', Auth()->user()->id)->where('created_at', '>', Carbon::now()->startOfMonth())
                                    ->where('created_at', '<', Carbon::now()->endOfMonth())
                                    ->sum('total_fee');
        $data['dailyExpressServiceFee'] = ExpressService::where('creator_id', Auth()->user()->id)->whereDate('created_at', Carbon::today())->sum('total_fee');

        // Total Legal Complaints Service fee
        $data['totalLegalComplaintsServiceFee'] = LegalComplaintsService::where('creator_id', Auth()->user()->id)->sum('total_fee');
        $data['monthlyLegalComplaintsServiceFee'] = LegalComplaintsService::where('creator_id', Auth()->user()->id)->where('created_at', '>', Carbon::now()->startOfMonth())
                                    ->where('created_at', '<', Carbon::now()->endOfMonth())
                                    ->sum('total_fee');
        $data['dailyLegalComplaintsServiceFee'] = LegalComplaintsService::where('creator_id', Auth()->user()->id)->whereDate('created_at', Carbon::today())->sum('total_fee');

        // Total Immigration Government Service fee
        $data['totalImmigrationGovementServiceFee'] = ImmigrationGovementService::where('creator_id', Auth()->user()->id)->sum('total_fee');
        $data['monthlyImmigrationGovementServiceFee'] = ImmigrationGovementService::where('creator_id', Auth()->user()->id)->where('created_at', '>', Carbon::now()->startOfMonth())
                                    ->where('created_at', '<', Carbon::now()->endOfMonth())
                                    ->sum('total_fee');
        $data['dailyImmigrationGovementServiceFee'] = ImmigrationGovementService::where('creator_id', Auth()->user()->id)->whereDate('created_at', Carbon::today())->sum('total_fee');


        // Total Other Service fee
        $data['totalOtherFee'] = Other::where('creator_id', Auth()->user()->id)->sum('fee');
        $data['monthlyOtherFee'] = Other::where('creator_id', Auth()->user()->id)->where('created_at', '>', Carbon::now()->startOfMonth())
                                    ->where('created_at', '<', Carbon::now()->endOfMonth())
                                    ->sum('fee');
        $data['dailyOtherFee'] = Other::where('creator_id', Auth()->user()->id)->whereDate('created_at', Carbon::today())->sum('fee');


        // All Passport Fee
        $data['totalPassportFees'] = $data['totalRenewPassportFees'] + $data['totalNewBornFees'] + $data['totalManualPassportFees'] + $data['totalLostPassportFees'];
        // All Passport Fee
        $data['totalOtherServiceFees'] = $data['totalOtherFee'] + $data['totalImmigrationGovementServiceFee'] + $data['totalLegalComplaintsServiceFee'] + $data['totalExpressServiceFee'] + $data['totalPremierServiceFee'];


        return view('DataEnterer.dashboard', $data);
    }

    public function reportLostPassport($data)
    {
        $flag = 0;
        if ($data == 'monthly') {
            $lostPassports = LostPassport::where('user_creator_id', auth()->user()->id)->where('created_at', '>', Carbon::now()->startOfMonth())->where('created_at', '<', Carbon::now()->endOfMonth())->get();
            return view('DataEnterer.lostPassport.index', compact('lostPassports', 'flag'));
        } else {
            $lostPassports = LostPassport::where('user_creator_id', auth()->user()->id)->whereDate('created_at', Carbon::today())->get();

            return view('DataEnterer.lostPassport.index', compact('lostPassports', 'flag'));
        }
    }

    public function reportManualPassport($data)
    {
        $flag = 0;
        if ($data == 'monthly') {
            $manualPassports = ManualPassport::where('user_creator_id', auth()->user()->id)->where('created_at', '>', Carbon::now()->startOfMonth())->where('created_at', '<', Carbon::now()->endOfMonth())->get();
            return view('DataEnterer.manualPassport.index', compact('manualPassports', 'flag'));
        } else {
            $manualPassports = ManualPassport::where('user_creator_id', auth()->user()->id)->whereDate('created_at', Carbon::today())->get();

            return view('DataEnterer.manualPassport.index', compact('manualPassports', 'flag'));
        }
    }

    public function reportRenuePassport($data)
    {
        $flag = 0;
        if ($data == 'monthly') {
            $renewPassports = RenewPassport::where('user_creator_id', auth()->user()->id)->where('created_at', '>', Carbon::now()->startOfMonth())->where('created_at', '<', Carbon::now()->endOfMonth())->get();
            return view('DataEnterer.renewPassport.index', compact('renewPassports', 'flag'));
        } else {
            $renewPassports = RenewPassport::where('user_creator_id', auth()->user()->id)->whereDate('created_at', Carbon::today())->get();

            return view('DataEnterer.renewPassport.index', compact('renewPassports', 'flag'));
        }
    }

    public function reportNewBornBaby($data)
    {
        $flag = 0;
        if ($data == 'monthly') {
            $newBornBabyPassports = NewBornBabyPassport::where('creator_id', Auth()->user()->id)->where('user_creator_id', auth()->user()->id)->where('created_at', '>', Carbon::now()->startOfMonth())->where('created_at', '<', Carbon::now()->endOfMonth())->get();
            return view('DataEnterer.newBornBabyPassport.index', compact('newBornBabyPassports', 'flag'));
        } else {
            $newBornBabyPassports = NewBornBabyPassport::where('creator_id', Auth()->user()->id)->where('user_creator_id', auth()->user()->id)->whereDate('created_at', Carbon::today())->get();

            return view('DataEnterer.newBornBabyPassport.index', compact('newBornBabyPassports', 'flag'));
        }
    }
    public function reportPremierService($data){
        $flag = 0;
        if ($data == 'monthly') {
            $takenPremierServices = PremierService::where('creator_id', Auth()->user()->id)->where('created_at', '>', Carbon::now()->startOfMonth()) ->where('created_at', '<', Carbon::now()->endOfMonth()) ->get();
            return view('DataEnterer.otherServices.PremierService.index', compact('takenPremierServices', 'flag'));
        }else{
            $takenPremierServices = PremierService::where('creator_id', Auth()->user()->id)->whereDate('created_at', Carbon::today())->get();
            
            return view('DataEnterer.otherServices.PremierService.index', compact('takenPremierServices', 'flag'));
        }
    }

    public function reportExpressService($data){
        $flag = 0;
        if ($data == 'monthly') {
            $takenExpressService = ExpressService::where('creator_id', Auth()->user()->id)->where('created_at', '>', Carbon::now()->startOfMonth()) ->where('created_at', '<', Carbon::now()->endOfMonth()) ->get();
            return view('DataEnterer.otherServices.ExpressService.index', compact('takenExpressService', 'flag'));
        }else{
            $takenExpressService = ExpressService::where('creator_id', Auth()->user()->id)->whereDate('created_at', Carbon::today())->get();
            
            return view('DataEnterer.otherServices.ExpressService.index', compact('takenExpressService', 'flag'));
        }
    }
    public function reportLegalComplaintsService($data){
        $flag = 0;
        if ($data == 'monthly') {
            $takenLegalComplaintsServices = LegalComplaintsService::where('creator_id', Auth()->user()->id)->where('created_at', '>', Carbon::now()->startOfMonth()) ->where('created_at', '<', Carbon::now()->endOfMonth()) ->get();
            return view('DataEnterer.otherServices.LegalComplainService.index', compact('takenLegalComplaintsServices', 'flag'));
        }else{
            $takenLegalComplaintsServices = LegalComplaintsService::where('creator_id', Auth()->user()->id)->whereDate('created_at', Carbon::today())->get();
            
            return view('DataEnterer.otherServices.LegalComplainService.index', compact('takenLegalComplaintsServices', 'flag'));
        }
    }
    public function reportImmigrationGovementService($data){
        $flag = 0;
        if ($data == 'monthly') {
            $takenImmigrationService = ImmigrationGovementService::where('creator_id', Auth()->user()->id)->where('created_at', '>', Carbon::now()->startOfMonth()) ->where('created_at', '<', Carbon::now()->endOfMonth()) ->get();
            return view('DataEnterer.otherServices.immigrationGovementService.index', compact('takenImmigrationService', 'flag'));
        }else{
            $takenImmigrationService = ImmigrationGovementService::where('creator_id', Auth()->user()->id)->whereDate('created_at', Carbon::today())->get();
            
            return view('DataEnterer.otherServices.immigrationGovementService.index', compact('takenImmigrationService', 'flag'));
        }
    }
    public function reportOtherService($data){
        $flag = 0;
        if ($data == 'monthly') {
            $otherServices = Other::where('creator_id', Auth()->user()->id)->where('created_at', '>', Carbon::now()->startOfMonth()) ->where('created_at', '<', Carbon::now()->endOfMonth()) ->get();
            return view('DataEnterer.otherServices.otherService.index', compact('otherServices', 'flag'));
        }else{
            $otherServices = Other::where('creator_id', Auth()->user()->id)->whereDate('created_at', Carbon::today())->get();
            
            return view('DataEnterer.otherServices.otherService.index', compact('otherServices', 'flag'));
        }
    }

    public function profile()
    {
        $user = Auth::user();
        return view('DataEnterer.profile.index', compact('user'));
    }

    public function editProfile()
    {
        $user = Auth::user();
        return view('DataEnterer.profile.edit', compact('user'));
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
            $image = $request->file('image');
            $folder_path = 'uploads/images/users/';
            $image_new_name = Str::random(20) . '-' . now()->timestamp . '.' . $image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->save($folder_path . $image_new_name);
            $user->image = $folder_path . $image_new_name;
        }
        try {
            $user->save();
            // return back()->withSuccess('Updated successfully!');
            Session::flash('success', 'Successfully Updated !!');
            return redirect()->back();
        } catch (\Exception $exception) {
            // return back()->withErrors( 'Something went wrong !'.$exception->getMessage());
            Session::flash('message', $exception->getMessage());
            return redirect()->back();
        }
    }
}
