<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CorporateController extends Controller
{
    /**
     * Corporate login view
     */
    public function corporateLogin()
    {
        return view('Frontend.login.corporetUserLogin');
    }

    /**
     * corporate registration view
     */
    public function corporateRegistration()
    {
        return view('Frontend.login.corporateRegistation');
    }
    /**
     * user create corporate user account
     */
    public function corporateUserStore(Request $request)
    {
        $mobile = Session::put('mobile', $request->phone);

        $request->validate([
            'phone' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5',
            'confirm_password' => 'required_with:password|same:password',
        ]);

        $otp = rand(100000, 999999);
        $corporateUser = new User();
        $corporateUser->phone = $request->phone;
        $corporateUser->email = $request->email;
        $corporateUser->password = Hash::make($request->password);
        $corporateUser->user_type = 'corporate-user';
        $corporateUser->otp = $otp;
        $corporateUser->save();
        $corporateUser->assignRole('corporate-user');

        try {
            // send sms via helper function
            send_sms('Welcome to ' . env('APP_NAME') . ', your Corporate OTP is : ' . $otp, $request->phone);
        } catch (\Exception $exception) {
            return response()->json([
                'type' => 'error',
                'message' => 'Opps somthing went wrong. ' . $exception->getMessage(),
            ]);
        }

        // return redirect()->route('userOtp');

        return redirect()->route('corporateOtp');
    }

    /**
     * corporate otp view
     */
    public function corporateOtp()
    {
        return view('Frontend.login.corporateOtp');
    }
    /**
     * otp store
     */
    public function corporateCheckOtp(Request $request)
    {
        $request->validate([
            'otp1' => 'required',
            'otp2' => 'required',
            'otp3' => 'required',
            'otp4' => 'required',
            'otp5' => 'required',
            'otp6' => 'required',
        ]);

        $corporateUser = User::where('phone', $request->old_mobile)->first();
        $otp1 = $request->otp1;
        $otp2 = $request->otp2;
        $otp3 = $request->otp3;
        $otp4 = $request->otp4;
        $otp5 = $request->otp5;
        $otp6 = $request->otp6;
        $newOtp = $otp1 . $otp2 . $otp3 . $otp4 . $otp5 . $otp6;
        if ($corporateUser->otp == $newOtp) {
            return redirect()->route('corporateInforStore');
        } else {
            return redirect()->route('userOtp')->with('error', 'OTP not match');
        }
    }

    /**
     * otp sent again
     */
    public function otpSentAgain($phone)
    {
        $otp = rand(100000, 999999);
        $corporateUser = User::where('phone', $phone)->first();
        $corporateUser->otp = $otp;
        try {
            // send sms via helper function
            send_sms('Welcome to ' . env('APP_NAME') . ', your OTP is : ' . $otp, $phone);
        } catch (\Exception $exception) {
            return response()->json([
                'type' => 'error',
                'message' => 'Opps somthing went wrong. ' . $exception->getMessage(),
            ]);
        }
        $corporateUser->save();
    }
    /**
     * corporate user information create view
     */
    public function informationInput()
    {
        return view('Frontend.login.corporate-personal-information');
    }

    /**
     * corporate user information create store
     */
    public function informationStore(Request $request)
    {
        $corporateUser = User::where('phone', Session::get('mobile'))->first();

        $request->validate([
            'name' => 'required',
            'address' => 'required',
        ]);

        $corporateUser = User::find($corporateUser->id);
        $corporateUser->name = $request->name;
        $corporateUser->address = $request->address;
        $corporateUser->status = '1';
        $corporateUser->save();
        session()->forget('mobile');

        return redirect()->route('corporate.login');
    }
    /**
     * profile infor view
     */
    public function profileInformationView()
    {
        $user = Auth::user();
        return view('CorporateUserDeshbord.profile', compact('user'));
    }
    /**
     * corporate profile update
     */
    public function profileInformationUpdate(Request $request)
    {
        $user = User::find($request->user_id);
        $user->fill($request->except('user_id','image'));

        if ($request->hasFile('image')) {

            if ($user->image != null)
                File::delete(public_path($user->image)); //Old image delete

            $image             = $request->file('image');
            $folder_path       = 'uploads/images/users/';
            $image_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->resize(600, 600)->save($folder_path . $image_new_name, 100);
            $user->image   = $folder_path . $image_new_name;
        }
        $user->save();
        return redirect()->back();
    }
    /**
     * security page view
     */
    public function securityView()
    {
        return view('CorporateUserDeshbord.security');
    }

    /**
     * old password check
     */
    public function passwordCheck(Request $request)
    {


        $request->validate([
            'password' => 'required',
        ]);

        $user = User::find($request->user_id);

        if (Hash::check($request->password, $user->password)) {
            return 1;
        } else {
            return "Password Not Match";
        }
    }
    /**
     * password update
     */
    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'password' => 'required|min:5',
            'confirmation_password' => 'required_with:password|same:password',

        ]);
        $user = User::find($request->user_id);
        $user->password = Hash::make($request->password);
        $user->save();

        return "Password change successfully";
    }
}
