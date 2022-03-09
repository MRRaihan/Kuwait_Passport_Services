<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\LostPassport;
use App\Models\ManualPassport;
use App\Models\NewBornBabyPassport;
use App\Models\RenewPassport;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class UserController extends Controller
{

    public function index()
    {

        $pending_renew = RenewPassport::where('user_creator_id', Auth::user()->id)->where('status', 0)->get();
        $pending_manual = ManualPassport::where('user_creator_id', Auth::user()->id)->where('status', 0)->get();
        $pending_lost = LostPassport::where('user_creator_id', Auth::user()->id)->where('status', 0)->get();
        $pending_new_baby = NewBornBabyPassport::where('user_creator_id', Auth::user()->id)->where('status', 0)->get();

        $review_renew = RenewPassport::where('user_creator_id', Auth::user()->id)->where('status', 1)->get();
        $review_manual = ManualPassport::where('user_creator_id', Auth::user()->id)->where('status', 1)->get();
        $review_lost = LostPassport::where('user_creator_id', Auth::user()->id)->where('status', 1)->get();
        $review_new_baby = NewBornBabyPassport::where('user_creator_id', Auth::user()->id)->where('status', 1)->get();

        $complete_renew = RenewPassport::where('user_creator_id', Auth::user()->id)->where('status', 3)->get();
        $complete_manual = ManualPassport::where('user_creator_id', Auth::user()->id)->where('status', 3)->get();
        $complete_lost = LostPassport::where('user_creator_id', Auth::user()->id)->where('status', 3)->get();
        $complete_new_baby = NewBornBabyPassport::where('user_creator_id', Auth::user()->id)->where('status', 3)->get();

        $data = [
            'total_pending' => $pending_renew->count() + $pending_manual->count() + $pending_lost->count() + $pending_new_baby->count(),
            'total_review' => $review_renew->count() + $review_manual->count() + $review_lost->count() + $review_new_baby->count(),
            'total_complete' => $complete_renew->count() + $complete_manual->count() + $complete_lost->count() + $complete_new_baby->count(),
        ];

        return view('NormalUserDeshbord.index', $data);
    }
    /**
     * user login view
     */
    public function userLogin()
    {
        if (isset(Auth::user()->id) && Auth::user()->user_type == "normal-user") {
            return redirect()->route('normalUser.dashbord');
        } else {
            return view('Frontend.login.userLogin');
        }
    }
    /**
     * user registation view
     */
    public function userReg()
    {
        return view('Frontend.login.userRegistation');
    }

    /**
     * user create user account
     */
    public function userStore(Request $request)
    {
        $mobile = Session::put('mobile', $request->phone);

        $request->validate([
            'phone' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5',
            'confirm_password' => 'required_with:password|same:password',
        ]);

        $otp = rand(100000, 999999);
        $user = new User();
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->user_type = 'normal-user';
        $user->otp = $otp;
        $user->save();
        $user->assignRole('normal-user');

        try {
            // send sms via helper function
            send_sms('Welcome to ' . env('APP_NAME') . ', your OTP is : ' . $otp, $request->phone);
        } catch (\Exception $exception) {
            return response()->json([
                'type' => 'error',
                'message' => 'Opps somthing went wrong. ' . $exception->getMessage(),
            ]);
        }

        return redirect()->route('userOtp');
    }
    /**
     * otp sent again
     */
    public function otpSentAgain($phone)
    {
        $otp = rand(100000, 999999);
        $user = User::where('phone', $phone)->first();
        $user->otp = $otp;
        try {
            // send sms via helper function
            send_sms('Welcome to ' . env('APP_NAME') . ', your OTP is : ' . $otp, $phone);
        } catch (\Exception $exception) {
            return response()->json([
                'type' => 'error',
                'message' => 'Opps somthing went wrong. ' . $exception->getMessage(),
            ]);
        }
        $user->save();
    }

    /**
     * user otp view
     */
    public function userOtp()
    {
        return view('Frontend.login.userOtp');
    }

    public function checkOtp(Request $request)
    {

        // dd($request->all());
        $request->validate([
            'otp1' => 'required',
            'otp2' => 'required',
            'otp3' => 'required',
            'otp4' => 'required',
            'otp5' => 'required',
            'otp6' => 'required',
        ]);



        $user = User::where('phone', $request->old_mobile)->first();
        $otp1 = $request->otp1;
        $otp2 = $request->otp2;
        $otp3 = $request->otp3;
        $otp4 = $request->otp4;
        $otp5 = $request->otp5;
        $otp6 = $request->otp6;
        $newOtp = $otp1 . $otp2 . $otp3 . $otp4 . $otp5 . $otp6;
        // dd($newOtp);
        if ($user->otp == $newOtp) {
            return redirect()->route('userPersonalInformation');
        } else {
            return redirect()->route('userOtp')->with('error', 'OTP not match');
        }
    }
    /**
     * user information create update view
     */
    public function userPersonalInformation()
    {
        return view('Frontend.login.personal-information');
    }

    /**
     * user information create store
     */
    public function informationStore(Request $request)
    {
        $user = User::where('phone', Session::get('mobile'))->first();

        $request->validate([
            'name' => 'required',
            'address' => 'required',
        ]);

        $user = User::find($user->id);
        $user->name = $request->name;
        $user->address = $request->address;
        $user->status = '1';
        $user->save();
        session()->forget('mobile');

        return redirect()->route('userLogin');
    }
    /**
     * deshbord profile update
     */
    public function profileInformationUpdate(Request $request)
    {
        $user = User::find($request->user_id);
        $user->fill($request->except('user_id'));

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
     * user payment table
     */
    public function userPayment()
    {
        return view('NormalUserDeshbord.payment');
    }

    /**
     * user password change table
     */
    public function securityUpdate()
    {
        return view('NormalUserDeshbord.security');
    }

    /**
     * user profile update table
     */
    public function profileUpdate()
    {
        $user = Auth::user();
        return view('NormalUserDeshbord.profile', compact('user'));
    }
    /**
     * status pending
     */
    public function statusPending()
    {
        $renew = RenewPassport::where('status', 0)->where('user_creator_id', Auth::user()->id)->get();
        $manual = ManualPassport::where('status', 0)->where('user_creator_id', Auth::user()->id)->get();
        $lost = LostPassport::where('status', 0)->where('user_creator_id', Auth::user()->id)->get();
        $new_born_baby = NewBornBabyPassport::where('status', 0)->where('user_creator_id', Auth::user()->id)->get();
        $data = [
            'passports' => $renew->concat($manual)->concat($lost)->concat($new_born_baby)
        ];

        return view('NormalUserDeshbord.statusPending', $data);
    }
    /**
     * status review
     */
    public function statusReview()
    {
        $renew = RenewPassport::where('status', 1)->where('user_creator_id', Auth::user()->id)->get();
        $manual = ManualPassport::where('status', 1)->where('user_creator_id', Auth::user()->id)->get();
        $lost = LostPassport::where('status', 1)->where('user_creator_id', Auth::user()->id)->get();
        $new_born_baby = NewBornBabyPassport::where('status', 1)->where('user_creator_id', Auth::user()->id)->get();
        $data = [
            'passports' => $renew->concat($manual)->concat($lost)->concat($new_born_baby)
        ];
        return view('NormalUserDeshbord.statusReview', $data);
    }
    /**
     * status completed
     */
    public function statusCompleted()
    {
        $renew = RenewPassport::where('branch_status', 3)->where('user_creator_id', Auth::user()->id)->get();
        $manual = ManualPassport::where('branch_status', 3)->where('user_creator_id', Auth::user()->id)->get();
        $lost = LostPassport::where('branch_status', 3)->where('user_creator_id', Auth::user()->id)->get();
        $new_born_baby = NewBornBabyPassport::where('branch_status', 3)->where('user_creator_id', Auth::user()->id)->get();
        $data = [
            'passports' => $renew->concat($manual)->concat($lost)->concat($new_born_baby)
        ];
        return view('NormalUserDeshbord.statusCompleted', $data);
    }
    /**
     * old password check
     */
    public function passwordCheck(Request $request)
    {
        // return $request->all();

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


    public function passportStatus($data)
    {

        $emirates_id = explode('&', $data)[0] ? explode('&', $data)[0] : '';
        $uae_phone = explode('&', $data)[1] ? explode('&', $data)[1] : '';
        $passport_type = explode('&', $data)[2];

        if ($emirates_id != '' && $uae_phone != '' && isset($passport_type)) {

            if ($passport_type == 0) {
                $passport = RenewPassport::where('emirates_id', $emirates_id)->where('uae_phone', $uae_phone)->first();
            }

            if ($passport_type == 1) {
                $passport = ManualPassport::where('emirates_id', $emirates_id)->where('uae_phone', $uae_phone)->first();
            }

            if ($passport_type == 2) {
                $passport = LostPassport::where('emirates_id', $emirates_id)->where('uae_phone', $uae_phone)->first();
            }

            if ($passport_type == 3) {
                $passport = NewBornBabyPassport::where('emirates_id', $emirates_id)->where('uae_phone', $uae_phone)->first();
            }


            $data = [
                'passport' => $passport,

                'message' => 'Passport Not Found!!',
            ];
            return view('Frontend.check_status', $data);

            // return view('Frontend.check_status',$data);

        } else {
            $data = [
                'message' => 'Please Fill All the Fields and Try Again!',
            ];
            return view('Frontend.check_status', $data);
        }
    }
}
