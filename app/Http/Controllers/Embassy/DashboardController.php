<?php

namespace App\Http\Controllers\Embassy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use App\Models\RenewPassport;
use App\Models\ManualPassport;
use App\Models\LostPassport;
use App\Models\NewBornBabyPassport;
use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;


class DashboardController extends Controller
{

    public function dashboard()
    {
        $branch = 0;

        //All type of total passort with branch
        $total_renew_passport = RenewPassport::where('embassy_status',3)->count(); 

        $total_manual_passport = ManualPassport::where('embassy_status',3)->count();

        $total_lost_passport = LostPassport::where('embassy_status',3)->count();

        $total_new_baby_passport = NewBornBabyPassport::where('embassy_status',3)->count();

        // total  passport with brach
        $total_passport = $total_renew_passport+$total_manual_passport+$total_lost_passport+$total_new_baby_passport;

         // All type of daily passport with branch
         $daily_renew_passport = RenewPassport::whereDate('created_at', Carbon::today())
                                                ->where('embassy_status',3)
                                                ->count();

         $daily_manual_passport = ManualPassport::whereDate('created_at', Carbon::today())
                                                ->where('embassy_status',3)
                                                ->count();

         $daily_lost_passport= LostPassport::whereDate('created_at', Carbon::today())
                                                ->where('embassy_status',3)
                                                ->count();

         $daily_new_baby_passport = NewBornBabyPassport::whereDate('created_at', Carbon::today())
                                                ->where('embassy_status',3)
                                                ->count();

        // All type of Monthly passport with branch
         $monthly_renew_passport = RenewPassport::where('created_at', '>', Carbon::now()->startOfMonth())
                                                ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                ->where('embassy_status',3)
                                                ->count();

         $monthly_manual_passport = ManualPassport::where('created_at', '>', Carbon::now()->startOfMonth())
                                                ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                ->where('embassy_status',3)
                                                ->count();

         $monthly_lost_passport = LostPassport::where('created_at', '>', Carbon::now()->startOfMonth())
                                                ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                ->where('embassy_status',3)
                                                ->count();

         $monthly_new_baby_passport = NewBornBabyPassport::where('created_at', '>', Carbon::now()->startOfMonth())
                                                ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                ->where('embassy_status',3)
                                                ->count();

         // All type of total passport fee with branch
         $total_renew_passport_fee = RenewPassport::where('branch_id', Auth::user()->branch_id)
                                                    ->where('embassy_status',3)
                                                    ->sum('passport_type_fees_total');
         $total_manual_passport_fee = ManualPassport::where('branch_id', Auth::user()->branch_id)
                                                    ->where('embassy_status',3)
                                                    ->sum('passport_type_fees_total');

         $total_lost_passport_fee = LostPassport::where('branch_id', Auth::user()->branch_id)
                                                ->where('embassy_status',3)
                                                ->sum('passport_type_fees_total');

         $total_new_baby_passport_fee = NewBornBabyPassport::where('branch_id', Auth::user()->branch_id)
                                                            ->where('embassy_status',3)
                                                            ->sum('passport_type_fees_total');

            // Total Passport Fee with branch
         $total_passport_fee = $total_renew_passport_fee+$total_manual_passport_fee+$total_lost_passport_fee+$total_new_baby_passport_fee;                                    
        

         // All type of daily passport fee with branch
         $daily_renew_passport_fee = RenewPassport::whereDate('created_at', Carbon::today())
                                                    ->where('embassy_status',3)
                                                    ->sum('passport_type_fees_total');

         $daily_manual_passport_fee = ManualPassport::whereDate('created_at', Carbon::today())
                                                    ->where('embassy_status',3)
                                                    ->sum('passport_type_fees_total');

         $daily_lost_passport_fee = LostPassport::whereDate('created_at', Carbon::today())
                                                    ->where('embassy_status',3)
                                                    ->sum('passport_type_fees_total');

         $daily_new_baby_passport_fee = NewBornBabyPassport::whereDate('created_at', Carbon::today())
                                                    ->where('embassy_status',3)
                                                    ->sum('passport_type_fees_total');
                                                    
        // All type of monthly passport fee with branch
         $monthly_renew_passport_fee = RenewPassport::where('created_at', '>', Carbon::now()->startOfMonth())
                                                    ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                    ->where('embassy_status',3)
                                                    ->sum('passport_type_fees_total');

         $monthly_manual_passport_fee = ManualPassport::where('created_at', '>', Carbon::now()->startOfMonth())
                                                    ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                    ->where('embassy_status',3)
                                                    ->sum('passport_type_fees_total');

         $monthly_lost_passport_fee = LostPassport::where('created_at', '>', Carbon::now()->startOfMonth())
                                                    ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                    ->where('embassy_status',3)
                                                    ->sum('passport_type_fees_total');

         $monthly_new_baby_passport_fee = NewBornBabyPassport::where('created_at', '>', Carbon::now()->startOfMonth())
                                                            ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                            ->where('embassy_status',3)
                                                            ->sum('passport_type_fees_total');

        $data = [
            'branch_id' => Auth::user()->branch_id,
            'option' => 0, 

            'total_passport' => $total_passport,

            'total_renew_passport' => $total_renew_passport,
            'total_manual_passport' => $total_manual_passport,
            'total_lost_passport' => $total_lost_passport,
            'total_new_baby_passport' => $total_new_baby_passport,

            'daily_renew_passport' => $daily_renew_passport,
            'daily_manual_passport' => $daily_manual_passport,
            'daily_lost_passport' => $daily_lost_passport,
            'daily_new_baby_passport' => $daily_new_baby_passport,

            'monthly_renew_passport' => $monthly_renew_passport,
            'monthly_manual_passport' => $monthly_manual_passport,
            'monthly_lost_passport' => $monthly_lost_passport,
            'monthly_new_baby_passport' => $monthly_new_baby_passport,

            'total_renew_passport_fee' => $total_renew_passport_fee,
            'total_manual_passport_fee' => $total_manual_passport_fee,
            'total_lost_passport_fee' => $total_lost_passport_fee,
            'total_new_baby_passport_fee' => $total_new_baby_passport_fee,


            'total_passport_fee' => $total_passport_fee,

            'monthly_renew_passport_fee' => $monthly_renew_passport_fee,
            'monthly_manual_passport_fee' => $monthly_manual_passport_fee,
            'monthly_lost_passport_fee' => $monthly_lost_passport_fee,
            'monthly_new_baby_passport_fee' => $monthly_new_baby_passport_fee,

            'daily_renew_passport_fee' => $daily_renew_passport_fee,
            'daily_manual_passport_fee' => $daily_manual_passport_fee,
            'daily_lost_passport_fee' => $daily_lost_passport_fee,
            'daily_new_baby_passport_fee' => $daily_new_baby_passport_fee,
        ];

        return view('Embassy.dashboard',$data);
    }

    public function profile()
    {
        $user = Auth::user();
        return view('Embassy.profile.index', compact('user'));
    }

    public function editProfile(){
        $user = Auth::user();
        return view('Embassy.profile.edit', compact('user'));
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
