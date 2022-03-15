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


    $renew = RenewPassport::when($civil_id != '',function($query) use($civil_id){
                                return $query->where('civil_id',$civil_id);
                            })
                            ->when($mobile != '',function($query) use($mobile){
                                return $query->where('bd_phone',$mobile);
                            })
                            ->when($from_date != '' && $to_date != '',function($query) use($from_date,$to_date){
                                return $query->whereDate('created_at','>=',$from_date)->whereDate('created_at','<=',$to_date);
                            })
                            ->where('branch_id',Auth::user()->branch_id)
                            ->where('is_shifted_to_branch_manager',null)
                            ->orderBy('id','desc')
                            ->get();

    $manual = ManualPassport::when($civil_id != '',function($query) use($civil_id){
                                    return $query->where('civil_id',$civil_id);
                                })
                                ->when($mobile != '',function($query) use($mobile){
                                    return $query->where('bd_phone',$mobile);
                                })
                                ->when($from_date != '' && $to_date != '',function($query) use($from_date,$to_date){
                                    return $query->whereDate('created_at','>=',$from_date)->whereDate('created_at','<=',$to_date);
                                })
                                ->where('branch_id',Auth::user()->branch_id)
                                ->where('is_shifted_to_branch_manager',null)
                                ->orderBy('id','desc')
                                ->get();

     $lost = LostPassport::when($civil_id != '',function($query) use($civil_id){
                return $query->where('civil_id',$civil_id);
                })
                ->when($mobile != '',function($query) use($mobile){
                    return $query->where('bd_phone',$mobile);
                })
                ->when($from_date != '' && $to_date != '',function($query) use($from_date,$to_date){
                    return $query->whereDate('created_at','>=',$from_date)->whereDate('created_at','<=',$to_date);
                })
                ->where('branch_id',Auth::user()->branch_id)
                ->where('is_shifted_to_branch_manager',null)
                ->orderBy('id','desc')
                ->get();

      $other = Other::when($civil_id != '',function($query) use($civil_id){
                        return $query->where('civil_id','LIKE','%'.$civil_id.'%');
                    })
                    ->when($mobile != '',function($query) use($mobile){
                        return $query->where('bd_phone','LIKE','%'.$mobile.'%');
                    })
                    ->when($from_date != '' && $to_date != '',function($query) use($from_date,$to_date){
                    return $query->whereDate('created_at','>=',$from_date)->whereDate('created_at','<=',$to_date);
                        })
                    ->where('branch_id',Auth::user()->branch_id)
                    ->orderBy('id','desc')
                    ->get();

      $new_born = NewBornBabyPassport::when($civil_id != '',function($query) use($civil_id){
                        return $query->where('civil_id','LIKE','%'.$civil_id.'%');
                    })
                    ->when($mobile != '',function($query) use($mobile){
                        return $query->where('bd_phone','LIKE','%'.$mobile.'%');
                    })
                    ->when($from_date != '' && $to_date != '',function($query) use($from_date,$to_date){
                    return $query->whereDate('created_at','>=',$from_date)->whereDate('created_at','<=',$to_date);
                        })
                    ->where('branch_id',Auth::user()->branch_id)
                    ->where('is_shifted_to_branch_manager',null)
                    ->orderBy('id','desc')
                    ->get();

    // if ($option == -1) {
    //     $data=[
    //         'civil_id' => $civil_id,
    //         'mobile' => $mobile,
    //         'from_date' => $from_date,
    //         'to_date' => $to_date,
    //         'option' => $option,
    //         'passports' => $renew->concat($manual)->concat($lost)->concat($other),

    //     ];
    //     return view('BranchManager.passportOption.shift_to_admin',$data);
    // }

    if ($option == 0) {
           $data=[
            'civil_id' => $civil_id,
            'mobile' => $mobile,
            'from_date' => $from_date,
            'to_date' => $to_date,
            'option' => $option,
            'passports' => $renew,

        ];
        return view('BranchManager.passportOption.shift_to_admin',$data);
    }
    if ($option == 1) {
        $data=[
            'civil_id' => $civil_id,
            'mobile' => $mobile,
            'from_date' => $from_date,
            'to_date' => $to_date,
            'option' => $option,
            'passports' => $manual,
        ];
        return view('BranchManager.passportOption.shift_to_admin',$data);
    }

    if ($option == 2) {
          $data=[
            'civil_id' => $civil_id,
            'mobile' => $mobile,
            'from_date' => $from_date,
            'to_date' => $to_date,
            'option' => $option,
            'passports' => $lost,
        ];
        return view('BranchManager.passportOption.shift_to_admin',$data);
    }


    if ($option == 3) {
          $data=[
            'civil_id' => $civil_id,
            'mobile' => $mobile,
            'from_date' => $from_date,
            'to_date' => $to_date,
            'option' => $option,
            'passports' => $new_born,
        ];
        return view('BranchManager.passportOption.shift_to_admin',$data);
    }

    return redirect()->back();


   }

   public function shiftToAdminStore(Request $request){
        $request->validate([
            'all_option' => 'required',
           ],
           [
               'all_option.required' => 'Please Select Some Data!!',
           ]
        );

    //    if ($request->passport_option == -1) {

    //         RenewPassport::whereIn('id',$request->all_option)->update([
    //             'shift_to_admin' => 1,
    //         ]);

    //         ManualPassport::whereIn('id',$request->all_option)->update([
    //             'shift_to_admin' => 1,
    //         ]);

    //         LostPassport::whereIn('id',$request->all_option)->update([
    //             'shift_to_admin' => 1,
    //         ]);


    //         Other::whereIn('id',$request->all_option)->update([
    //             'shift_to_admin' => 1,
    //         ]);

    //         Session::flash('success', 'Shift to Admin Successfully!!');
    //         return redirect()->back();
    //    }

       if ($request->passport_option == 0) {
            RenewPassport::whereIn('id',$request->all_option)->update([
                'shift_to_admin' => 1,
            ]);
            Session::flash('success', 'Renew Passport Shift to Admin Successfully!!');
            return redirect()->back();
       }

       if ($request->passport_option == 1) {
            ManualPassport::whereIn('id',$request->all_option)->update([
                'shift_to_admin' => 1,
            ]);
           Session::flash('success','Manual Passport Shift to Admin Successfully!!');
            return redirect()->back();
       }
       if ($request->passport_option == 2) {
            LostPassport::whereIn('id',$request->all_option)->update([
                'shift_to_admin' => 1,
            ]);
           Session::flash('success','Lost Passport Shift to Admin Successfully!!');
            return redirect()->back();
       }
       if ($request->passport_option == 3) {
            Other::whereIn('id',$request->all_option)->update([
                'shift_to_admin' => 1,
            ]);
           Session::flash('success','Renewal Passport Shift to Admin Successfully!!');
            return redirect()->back();
       }

        return redirect()->back();
   }


   public function shiftToAdminUndo($data){

        $option = explode('&', $data)[0];
        $id = explode('&', $data)[1];


        if (isset($option) && isset($id)) {

            if ($option == 0) {
                RenewPassport::where('id',$id)->update([
                    'shift_to_admin' => 0,
                ]);
                return response()->json([
                    'type' => 'success',
                    'message' => 'Successfully Undo'
                ]);
           }

           if ($option == 1) {
                ManualPassport::where('id',$id)->update([
                    'shift_to_admin' => 0,
                ]);
                return response()->json([
                    'type' => 'success',
                    'message' => 'Successfully Undo'
                ]);
           }
           if ($option == 2) {
                LostPassport::where('id',$id)->update([
                    'shift_to_admin' => 0,
                ]);
                return response()->json([
                    'type' => 'success',
                    'message' => 'Successfully Undo'
                ]);
           }

           if ($option == 3) {
                NewBornBabyPassport::where('id',$id)->update([
                    'shift_to_admin' => 0,
                ]);
                return response()->json([
                    'type' => 'success',
                    'message' => 'Successfully Undo'
                ]);
           }

           return response()->json([
            'type' => 'error',
            'message' => 'Something Went Wrong'
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

     if ($option == 0) {
        $data=[
            'civil_id' => $civil_id,
            'mobile' => $mobile,
            'from_date' => $from_date,
            'to_date' => $to_date,
            'option' => $option,
            'options' => RenewPassport::when($civil_id != '',function($query) use($civil_id){
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

     if ($option == 1) {
        $data=[
            'civil_id' => $civil_id,
            'mobile' => $mobile,
            'from_date' => $from_date,
            'to_date' => $to_date,
            'option' => $option,
            'options' => ManualPassport::when($civil_id != '',function($query) use($civil_id){
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

     if ($option == 2) {
        $data=[
            'civil_id' => $civil_id,
            'mobile' => $mobile,
            'from_date' => $from_date,
            'to_date' => $to_date,
            'option' => $option,
            'options' => LostPassport::when($civil_id != '',function($query) use($civil_id){
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

     if ($option == 3) {
        $data=[
            'civil_id' => $civil_id,
            'mobile' => $mobile,
            'from_date' => $from_date,
            'to_date' => $to_date,
            'option' => $option,
            'options' => NewBornBabyPassport::when($civil_id != '',function($query) use($civil_id){
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
        ]
        );

        if ($request->passport_option == 0) {
            RenewPassport::whereIn('id',$request->all_option)->update([
                    'branch_status' => 3,
                ]);
               Session::flash('success','Renew Passport Received to Admin Successfully!!');
                return redirect()->back();
        }

        if ($request->passport_option == 3) {
                ManualPassport::whereIn('id',$request->all_option)->update([
                    'branch_status' => 3,
                ]);
               Session::flash('success','Manual Passport Received to Admin Successfully!!');
                return redirect()->back();
        }
        if ($request->passport_option == 2) {
            LostPassport::whereIn('id',$request->all_option)->update([
                    'branch_status' => 3,
                ]);
               Session::flash('success','Lost Passport Received to Admin Successfully!!');
                return redirect()->back();
        }

        if ($request->passport_option == 3) {
                NewBornBabyPassport::whereIn('id',$request->all_option)->update([
                    'branch_status' => 3,
                ]);
               Session::flash('success','New Born Baby Passport Received to Admin Successfully!!');
                return redirect()->back();
        }

        Session::flash('error','Something Went Wrong');
        return redirect()->back();
   }

   public function receiveFromAdminUndo($data){

    $option = explode('&', $data)[0];
    $id = explode('&', $data)[1];


    if (isset($option) && isset($id)) {

            if ($option == 0) {
                RenewPassport::where('id',$id)->update([
                    'is_received' => 0,
                ]);
                return response()->json([
                    'type' => 'success',
                    'message' => 'Successfully Undo'
                ]);
        }

        if ($option == 1) {
                ManualPassport::where('id',$id)->update([
                    'is_received' => 0,
                ]);
                return response()->json([
                    'type' => 'success',
                    'message' => 'Successfully Undo'
                ]);
        }
        if ($option == 2) {
            LostPassport::where('id',$id)->update([
                    'is_received' => 0,
                ]);
                return response()->json([
                    'type' => 'success',
                    'message' => 'Successfully Undo'
                ]);
        }
        if ($option == 3) {
                NewBornBabyPassport::where('id',$id)->update([
                    'is_received' => 0,
                ]);
                return response()->json([
                    'type' => 'success',
                    'message' => 'Successfully Undo'
                ]);
        }

        return response()->json([
            'type' => 'error',
            'message' => 'Something Went Wrong'
            ]);
        }else{
            return response()->json([
                'type' => 'error',
                'message' => 'Something Went Wrong'
            ]);
        }
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

     if ($option == 0) {
        $data=[
            'civil_id' => $civil_id,
            'mobile' => $mobile,
            'from_date' => $from_date,
            'to_date' => $to_date,
            'option' => $option,
            'options' => RenewPassport::when($civil_id != '',function($query) use($civil_id){
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

     if ($option == 1) {
        $data=[
            'civil_id' => $civil_id,
            'mobile' => $mobile,
            'from_date' => $from_date,
            'to_date' => $to_date,
            'option' => $option,
            'options' => ManualPassport::when($civil_id != '',function($query) use($civil_id){
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

     if ($option == 2) {
        $data=[
            'civil_id' => $civil_id,
            'mobile' => $mobile,
            'from_date' => $from_date,
            'to_date' => $to_date,
            'option' => $option,
            'options' => LostPassport::when($civil_id != '',function($query) use($civil_id){
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


     if ($option == 3) {
        $data=[
            'civil_id' => $civil_id,
            'mobile' => $mobile,
            'from_date' => $from_date,
            'to_date' => $to_date,
            'option' => $option,
            'options' => NewBornBabyPassport::when($civil_id != '',function($query) use($civil_id){
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

            if ($option == 0) {
                RenewPassport::where('id',$id)->update([
                    'branch_status' => 1,
                ]);
                return response()->json([
                    'type' => 'success',
                    'message' => 'Successfully Undo'
                ]);
        }

        if ($option == 1) {
                ManualPassport::where('id',$id)->update([
                    'branch_status' => 1,
                ]);
                return response()->json([
                    'type' => 'success',
                    'message' => 'Successfully Undo'
                ]);
        }
        if ($option == 2) {
            LostPassport::where('id',$id)->update([
                    'branch_status' => 1,
                ]);
                return response()->json([
                    'type' => 'success',
                    'message' => 'Successfully Undo'
                ]);
        }
        if ($option == 3) {
                Other::where('id',$id)->update([
                    'branch_status' => 1,
                ]);
                return response()->json([
                    'type' => 'success',
                    'message' => 'Successfully Undo'
                ]);
        }

        if ($option == 4) {
                NewBornBabyPassport::where('id',$id)->update([
                    'branch_status' => 1,
                ]);
                return response()->json([
                    'type' => 'success',
                    'message' => 'Successfully Undo'
                ]);
        }

        return response()->json([
            'type' => 'error',
            'message' => 'Something Went Wrong'
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



        if (isset($request->option) && $request->option == 0) {
            $renewPassport = RenewPassport::findOrFail($id);
            $renewPassport->bio_enrollment_id = $request->bio_enrollment_id;
            $renewPassport->save();
            return response()->json([
                'type' => 'success',
                'message' => 'Bio Enrollment Id Added Successfully!'
            ]);
        }

        if (isset($request->option) && $request->option == 1) {
            $manualPassport = ManualPassport::findOrFail($id);
            $manualPassport->bio_enrollment_id = $request->bio_enrollment_id;
            $manualPassport->save();
            return response()->json([
                'type' => 'success',
                'message' => 'Bio Enrollment Id Added Successfully!'
            ]);
        }

        if (isset($request->option) && $request->option == 2) {
            $lostPassport = LostPassport::findOrFail($id);
            $lostPassport->bio_enrollment_id = $request->bio_enrollment_id;
            $lostPassport->save();
            return response()->json([
                'type' => 'success',
                'message' => 'Bio Enrollment Id Added Successfully!'
            ]);
        }

        if (isset($request->option) && $request->option == 3) {
            $newBornBabyPassport = NewBornBabyPassport::findOrFail($id);
            $newBornBabyPassport->bio_enrollment_id = $request->bio_enrollment_id;
            $newBornBabyPassport->save();
            return response()->json([
                'type' => 'success',
                'message' => 'Bio Enrollment Id Added Successfully!'
            ]);
        }
        return response()->json([
            'type' => 'error',
            'message' => 'Something Went Wrong!!'
        ]);
        return redirect()->back();

    }

    public function assignDeForBio(Request $request, $id)
    {
        $request->validate([
            'de_id' => 'required'
        ]);

        if (isset($request->option) && $request->option == 0) {
            $passport = RenewPassport::findOrFail($id);
        }
        if (isset($request->option) && $request->option == 1) {
            $passport = ManualPassport::findOrFail($id);
        }
        if (isset($request->option) && $request->option == 2) {
            $passport = LostPassport::findOrFail($id);
        }
        if (isset($request->option) && $request->option == 3) {
            $passport = NewBornBabyPassport::findOrFail($id);
        }

        try {
            $passport->de_id_for_bio = $request->de_id;
            $passport->save();
            return response()->json([
                'type' => 'success',
                'message' => 'Data enterer assigned successfully!'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'type' => 'error',
                'message' => 'Something Went Wrong!! '.$exception
            ]);
        }
    }

}
