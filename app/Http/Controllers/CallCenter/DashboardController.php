<?php

namespace App\Http\Controllers\CallCenter;

use App\Http\Controllers\Controller;
use App\Models\LostPassport;
use App\Models\ManualPassport;
use App\Models\NewBornBabyPassport;
use App\Models\RenewPassport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;


class DashboardController extends Controller
{

    public function dashboard()
    {
        $renew_received = RenewPassport::where('remarks_by',Auth::user()->id)->where('remarks',0)->count();
        $renew_not_received = RenewPassport::where('remarks_by',Auth::user()->id)->where('remarks',1)->count();
        $renew_call_busy = RenewPassport::where('remarks_by',Auth::user()->id)->where('remarks',2)->count();
        $renew_phone_off = RenewPassport::where('remarks_by',Auth::user()->id)->where('remarks',3)->count();
        $renew_other = RenewPassport::where('remarks_by',Auth::user()->id)->where('remarks',4)->count();

        $manual_received = ManualPassport::where('remarks_by',Auth::user()->id)->where('remarks',0)->count();
        $manual_not_received = ManualPassport::where('remarks_by',Auth::user()->id)->where('remarks',1)->count();
        $manual_call_busy = ManualPassport::where('remarks_by',Auth::user()->id)->where('remarks',2)->count();
        $manual_phone_off = ManualPassport::where('remarks_by',Auth::user()->id)->where('remarks',3)->count();
        $manual_other = ManualPassport::where('remarks_by',Auth::user()->id)->where('remarks',4)->count();

        $lost_received = LostPassport::where('remarks_by',Auth::user()->id)->where('remarks',0)->count();
        $lost_not_received = LostPassport::where('remarks_by',Auth::user()->id)->where('remarks',1)->count();
        $lost_call_busy = LostPassport::where('remarks_by',Auth::user()->id)->where('remarks',2)->count();
        $lost_phone_off = LostPassport::where('remarks_by',Auth::user()->id)->where('remarks',3)->count();
        $lost_other = LostPassport::where('remarks_by',Auth::user()->id)->where('remarks',4)->count();

        $new_baby_received = NewBornBabyPassport::where('remarks_by',Auth::user()->id)->where('remarks',0)->count();
        $new_baby_not_received = NewBornBabyPassport::where('remarks_by',Auth::user()->id)->where('remarks',1)->count();
        $new_baby_call_busy = NewBornBabyPassport::where('remarks_by',Auth::user()->id)->where('remarks',2)->count();
        $new_baby_phone_off = NewBornBabyPassport::where('remarks_by',Auth::user()->id)->where('remarks',3)->count();
        $new_baby_other = NewBornBabyPassport::where('remarks_by',Auth::user()->id)->where('remarks',4)->count();


        $data = [
            'total_received' => $renew_received + $manual_received + $lost_received + $new_baby_received,
            'total_not_received' => $renew_not_received + $manual_not_received + $lost_not_received + $new_baby_not_received,
            'total_call_busy' => $renew_call_busy + $manual_call_busy + $lost_call_busy + $new_baby_call_busy,
            'total_phone_off' => $renew_phone_off + $manual_phone_off + $lost_phone_off + $new_baby_phone_off,
            'total_other' => $renew_other + $manual_other + $lost_other + $new_baby_other,
        ];
        return view('CallCenter.dashboard',$data);
    }

    public function profile()
    {
        $user = Auth::user();
        return view('CallCenter.profile.index', compact('user'));
    }

    public function editProfile(){
        $user = Auth::user();
        return view('CallCenter.profile.edit', compact('user'));
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
            Session::flash('type', 'success');
            return redirect()->back();
        } catch (\Exception $exception) {
            // return back()->withErrors( 'Something went wrong !'.$exception->getMessage());
            Session::flash('danger', $exception->getMessage());
            return redirect()->back();
        }
    }
}
