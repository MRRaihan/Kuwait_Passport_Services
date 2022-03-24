<?php


namespace App\Http\Controllers\BranchManager;

use App\Http\Controllers\Controller;
use App\Models\Other;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\LostPassport;
use App\Models\ManualPassport;
use App\Models\RenewPassport;
use App\Models\NewBornBabyPassport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PassportOptionsController extends Controller
{

 // Shift To Admin Passport Option By Monir

   public function shiftToAdmin(){
     return $this->search('&&&&0');

   }


   public function search($data){
        $civil_id = explode('&', $data)[0] ? explode('&', $data)[0] : '';
        $mobile = explode('&', $data)[1] ? explode('&', $data)[1] : '';
        $from_date = explode('&', $data)[2] ? explode('&', $data)[2] : '';
        $to_date = explode('&', $data)[3] ? explode('&', $data)[3] : '';
        $option = explode('&', $data)[4] ? explode('&', $data)[4] : 0;

        $passports = get_passport_model_name_by_option($option)::when($civil_id != '',function($query) use($civil_id){
                        return $query->where('civil_id',$civil_id);
                    })->when($mobile != '',function($query) use($mobile){
                        return $query->where('bd_phone',$mobile);
                    })->when($from_date != '' && $to_date != '',function($query) use($from_date,$to_date){
                        return $query->whereDate('created_at','>=',$from_date)->whereDate('created_at','<=',$to_date);
                    })->where('branch_id',Auth::user()->branch_id)
                        ->where('is_shifted_to_branch_manager',null)
                        ->orderBy('id','desc')
                        ->get();
        $data=[
            'civil_id' => $civil_id,
            'mobile' => $mobile,
            'from_date' => $from_date,
            'to_date' => $to_date,
            'option' => $option,
            'passports' => $passports,
        ];
        return view('BranchManager.passportOption.shift_to_admin',$data);
   }

   public function shiftToAdminStore(Request $request){
        $request->validate([
            'all_option' => 'required',
           ],
           [
               'all_option.required' => 'Please Select Some Data!!',
           ]
        );

        get_passport_model_name_by_option($request->passport_option)::whereIn('id',$request->all_option)->update([
                'shift_to_admin' => 1,
        ]);
        Session::flash('success','Passport Shift to Admin Successfully!!');
        return redirect()->back();
   }

   public function shiftToAdminUndo($data){

        $option = explode('&', $data)[0];
        $id = explode('&', $data)[1];

        if (isset($option) && isset($id)) {
            get_passport_model_name_by_option($option)::where('id',$id)->update([
                'shift_to_admin' => 0,
            ]);
            return response()->json([
                'type' => 'success',
                'message' => 'Successfully Undo'
            ]);
        }else{
            return response()->json([
                'type' => 'error',
                'message' => 'Something Went Wrong'
            ]);
        }
   }

 // Received From Admin Passport Option By Monir


   public function receiveFromAdmin(){
       return $this->searchReceive('&&&&0');
   }

   public function searchReceive($data){

        $civil_id = explode('&', $data)[0] ? explode('&', $data)[0] : '';
        $mobile = explode('&', $data)[1] ? explode('&', $data)[1] : '';
        $from_date = explode('&', $data)[2] ? explode('&', $data)[2] : '';
        $to_date = explode('&', $data)[3] ? explode('&', $data)[3] : '';
        $option = explode('&', $data)[4] ? explode('&', $data)[4] : 0;

        if (isset($option)) {
            $data=[
                'civil_id' => $civil_id,
                'mobile' => $mobile,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'option' => $option,
                'options' => get_passport_model_name_by_option($option)::when($civil_id != '',function($query) use($civil_id){
                    return $query->where('civil_id',$civil_id);
                })
                ->when($mobile != '',function($query) use($mobile){
                    return $query->where('bd_phone',$mobile);
                })
                ->when($from_date != '' && $to_date != '',function($query) use($from_date,$to_date){
                    return $query->whereDate('created_at','>=',$from_date)->whereDate('created_at','<=',$to_date);
                })
                ->where('branch_status',1)
                ->where('branch_id',Auth::user()->branch_id)
                ->orderBy('id','desc')
                ->get()
            ];
            return view('BranchManager.passportOption.receive_from_admin',$data);
        }

        return redirect()->back();
   }

   public function deliveryToUser(Request $request){
        $request->validate([
            'all_option' => 'required',
        ],
        [
            'all_option.required' => 'Please Select Some Data!!',
        ]);

        if (isset($request->passport_option)) {
            get_passport_model_name_by_option($request->passport_option)::whereIn('id',$request->all_option)->update([
                    'branch_status' => 3,
                ]);
            Session::flash('success','Passport Received to Admin Successfully!!');
            return redirect()->back();
        }

        Session::flash('error','Something Went Wrong');
        return redirect()->back();
   }

    // Delivery Passport Option By Monir

   public function delivery(){
       return $this->searchDelivery('&&&&0');
   }

   public function searchDelivery($data){

        $civil_id = explode('&', $data)[0] ? explode('&', $data)[0] : '';
        $mobile = explode('&', $data)[1] ? explode('&', $data)[1] : '';
        $from_date = explode('&', $data)[2] ? explode('&', $data)[2] : '';
        $to_date = explode('&', $data)[3] ? explode('&', $data)[3] : '';
        $option = explode('&', $data)[4] ? explode('&', $data)[4] : 0;

        if (isset($option)) {
            $data=[
                'civil_id' => $civil_id,
                'mobile' => $mobile,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'option' => $option,
                'options' => get_passport_model_name_by_option($option)::when($civil_id != '',function($query) use($civil_id){
                    return $query->where('civil_id',$civil_id);
                })
                ->when($mobile != '',function($query) use($mobile){
                    return $query->where('bd_phone',$mobile);
                })
                ->when($from_date != '' && $to_date != '',function($query) use($from_date,$to_date){
                    return $query->whereDate('created_at','>=',$from_date)->whereDate('created_at','<=',$to_date);
                })
                ->where('branch_status',3)
                ->where('branch_id',Auth::user()->branch_id)
                ->orderBy('id','desc')
                ->get()
            ];
            return view('BranchManager.passportOption.delivery',$data);
        }

        return redirect()->back();
   }

   ////////// if requirement will change then its need /////////////////

//    public function deliveryStore(Request $request){
//         $request->validate([
//             'all_option' => 'required',
//         ],
//         [
//             'all_option.required' => 'Please Select Some Data!!',
//         ]
//         );

//             if ($request->passport_option == 0) {
//                     LostPassport::whereIn('id',$request->all_option)->update([
//                         'is_delivered' => 1,
//                     ]);
//                     Session::flash('success','Lost Passport Received to Admin Successfully!!');
//                     return redirect()->back();
//             }

//             if ($request->passport_option == 1) {
//                     ManualPassport::whereIn('id',$request->all_option)->update([
//                         'is_delivered' => 1,
//                     ]);
//                     Session::flash('success','Manual Passport Received to Admin Successfully!!');
//                     return redirect()->back();
//             }
//             if ($request->passport_option == 2) {
//                     RenewPassport::whereIn('id',$request->all_option)->update([
//                         'is_delivered' => 1,
//                     ]);
//                     Session::flash('success','Renewal Passport Received to Admin Successfully!!');
//                     return redirect()->back();
//             }
//             if ($request->passport_option == 3) {
//                     Other::whereIn('id',$request->all_option)->update([
//                         'is_delivered' => 1,
//                     ]);
//                     Session::flash('success','Renewal Passport Received to Admin Successfully!!');
//                     return redirect()->back();
//             }
//             $request->session()->flash('type', 'error');
//             $request->session()->flash('message', 'Something Went Wrong');
//             return redirect()->back();
//     }

    public function deliveryUndo($data){

        $option = explode('&', $data)[0];
        $id = explode('&', $data)[1];

        if (isset($option) && isset($id)) {
            get_passport_model_name_by_option($option)::where('id',$id)->update([
                'branch_status' => 1,
            ]);
            return response()->json([
                'type' => 'success',
                'message' => 'Successfully Undo'
            ]);
        }else{
            return response()->json([
                'type' => 'error',
                'message' => 'Something Went Wrong'
            ]);
        }
    }

    public function bioEnrollmentIdSave(Request $request,$id){

        $request->validate([
            'bio_enrollment_id' => 'required'
        ]);

        if(isset($request->option)){
            $passport = get_passport_model_name_by_option($request->option)::findOrFail($id);
            $passport->bio_enrollment_id = $request->bio_enrollment_id;
            $passport->save();
            return response()->json([
                'type' => 'success',
                'message' => 'Bio Enrollment ID Added Successfully!'
            ]);
        }

        return response()->json([
            'type' => 'error',
            'message' => 'Something Went Wrong!!'
        ]);
        return redirect()->back();
    }

    public function newMrpPassportNoSave(Request $request,$id){

        $request->validate([
            'new_mrp_passport_no' => 'required'
        ]);

        if (isset($request->option)) {
            $passport = get_passport_model_name_by_option($request->option)::findOrFail($id);
            $passport->new_mrp_passport_no = $request->new_mrp_passport_no;
            $passport->save();
            return response()->json([
                'type' => 'success',
                'message' => 'New MRP Passport No. Added Successfully!'
            ]);
        }
        return response()->json([
            'type' => 'error',
            'message' => 'Something Went Wrong!!'
        ]);
    }

    public function assignDeForBio(Request $request)
    {
        $request->validate([
                'de_id' => 'required',
                'all_option' => 'required',
            ],
            [
                'de_id.required' => 'Please select a data enterer !!',
                'all_option.required' => 'Please Select Some Data!!',
        ]);

        if (isset($request->passport_option)) {
            get_passport_model_name_by_option($request->passport_option)::whereIn('id', $request->all_option)->update([
                'de_id_for_bio' => $request->de_id,
            ]);
        }

        Session::flash('success', 'Data enterer assigned successfully !');
        return back();
    }

}
