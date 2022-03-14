<?php


namespace App\Http\Controllers\Embassy;

use App\Http\Controllers\Controller;
use App\Models\Other;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\LostPassport;
use App\Models\ManualPassport;
use App\Models\RenewPassport;
use App\Models\NewBornBabyPassport;
use Illuminate\Support\Facades\Session;

class PassportOptionsController extends Controller
{


 // Received To Embassay Passport Option By Monir


   public function receiveToEmbassy(){
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
                            ->where('embassy_status',1)
                            ->orderBy('id','desc')
                            ->get()
        ];
        return view('Embassy.passportOption.receive_to_embassy',$data);
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
                            ->where('embassy_status',1)
                            ->orderBy('id','desc')
                            ->get()
        ];
        return view('Embassy.passportOption.receive_to_embassy',$data);
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
                            ->where('embassy_status',1)
                            ->orderBy('id','desc')
                            ->get()
        ];
        return view('Embassy.passportOption.receive_to_embassy',$data);
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
                            ->where('embassy_status',1)
                            ->orderBy('id','desc')
                            ->get()
        ];
        return view('Embassy.passportOption.receive_to_embassy',$data);
     }

     return redirect()->back();
   }

   public function receiveToEmbassyStore(Request $request){
        $request->validate([
            'all_option' => 'required',
        ],
        [
            'all_option.required' => 'Please Select Some Data!!',
        ]
        );

        if ($request->passport_option == 0) {
            RenewPassport::whereIn('id',$request->all_option)->update([
                    'embassy_status' => 2,
                ]);
                Session::flash('success','Renew Passport Received to Embasssay Successfully!!');
                return redirect()->back();
        }

        if ($request->passport_option == 1) {
                ManualPassport::whereIn('id',$request->all_option)->update([
                    'embassy_status' => 2,
                ]);
                Session::flash('success','Manual Passport Received to Embasssay Successfully!!');
                return redirect()->back();
        }
        if ($request->passport_option == 2) {
            LostPassport::whereIn('id',$request->all_option)->update([
                    'embassy_status' => 2,
                ]);
                Session::flash('success','Lost Passport Received to Embasssay Successfully!!');
                return redirect()->back();
        }
        if ($request->passport_option == 3) {
                NewBornBabyPassport::whereIn('id',$request->all_option)->update([
                    'embassy_status' => 2,
                ]);
                Session::flash('success','New Born Baby Passsport Received to Embasssay Successfully!!');
                return redirect()->back();
        }


        Session::flash('error', 'Something Went Wrong');
        return redirect()->back();
   }

   public function receiveToEmbassyUndo($data){

    $option = explode('&', $data)[0];
    $id = explode('&', $data)[1];


    if (isset($option) && isset($id)) {

        if ($option == 0) {
            RenewPassport::where('id',$id)->update([
                'embassy_status' => 1,
            ]);
            return response()->json([
                'type' => 'success',
                'message' => 'Successfully Undo'
            ]);
       }

       if ($option == 1) {
            ManualPassport::where('id',$id)->update([
                'embassy_status' => 1,
            ]);
            return response()->json([
                'type' => 'success',
                'message' => 'Successfully Undo'
            ]);
       }
       if ($option == 2) {
            LostPassport::where('id',$id)->update([
                'embassy_status' => 1,
            ]);
            return response()->json([
                'type' => 'success',
                'message' => 'Successfully Undo'
            ]);
       }


       if ($option == 3) {
            NewBornBabyPassport::where('id',$id)->update([
                'embassy_status' => 1,
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
                            ->where('embassy_status',2)
                            ->orderBy('id','desc')
                            ->get()
        ];
        return view('Embassy.passportOption.delivery_to_admin',$data);
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
                            ->where('embassy_status',2)
                            ->orderBy('id','desc')
                            ->get()
        ];
        return view('Embassy.passportOption.delivery_to_admin',$data);
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
                            ->where('embassy_status',2)
                            ->orderBy('id','desc')
                            ->get()
        ];
        return view('Embassy.passportOption.delivery_to_admin',$data);
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
                            ->where('embassy_status',2)
                            ->orderBy('id','desc')
                            ->get()
        ];
        return view('Embassy.passportOption.delivery_to_admin',$data);
     }

     return redirect()->back();
   }

   public function deliveryStore(Request $request){
        $request->validate([
            'all_option' => 'required',
        ],
        [
            'all_option.required' => 'Please Select Some Data!!',
        ]
        );

        if ($request->passport_option == 0) {
                RenewPassport::whereIn('id',$request->all_option)->update([
                    'embassy_status' => 3,
                ]);
                Session::flash('success','Renew Passport Delivery to Admin Successfully!!');
                return redirect()->back();
        }

        if ($request->passport_option == 1) {
                ManualPassport::whereIn('id',$request->all_option)->update([
                    'embassy_status' => 3,
                ]);
                Session::flash('success','Manual Passport Delivery to Admin Successfully!!');
                return redirect()->back();
        }
        if ($request->passport_option == 2) {
            LostPassport::whereIn('id',$request->all_option)->update([
                    'embassy_status' => 3,
                ]);
                Session::flash('success','Lost Passport Delivery to Admin Successfully!!');
                return redirect()->back();
        }


        if ($request->passport_option == 3) {
                NewBornBabyPassport::whereIn('id',$request->all_option)->update([
                    'embassy_status' => 3,
                ]);
                Session::flash('success','New Born Baby Passport Delivery to Admin Successfully!!');
                return redirect()->back();
        }

        Session::flash('error', 'Something Went Wrong');
        return redirect()->back();
   }

   public function deliveryUndo($data){

    $option = explode('&', $data)[0];
    $id = explode('&', $data)[1];


    if (isset($option) && isset($id)) {

        if ($option == 0) {
            RenewPassport::where('id',$id)->update([
                'is_delivered' => 0,
            ]);
            return response()->json([
                'type' => 'success',
                'message' => 'Successfully Undo'
            ]);
       }

       if ($option == 1) {
            ManualPassport::where('id',$id)->update([
                'is_delivered' => 0,
            ]);
            return response()->json([
                'type' => 'success',
                'message' => 'Successfully Undo'
            ]);
       }
       if ($option == 2) {
            LostPassport::where('id',$id)->update([
                'is_delivered' => 0,
            ]);
            return response()->json([
                'type' => 'success',
                'message' => 'Successfully Undo'
            ]);
       }


       if ($option == 3) {
            NewBornBabyPassport::where('id',$id)->update([
                'is_delivered' => 0,
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


// All Delivery

public function allDelivery(){
    return $this->searchAllDelivery('&&&&0');
}

public function searchAllDelivery($data){

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
                         ->where('embassy_status',3)
                         ->orderBy('id','desc')
                         ->get()
     ];
     return view('Embassy.passportOption.all_delivery',$data);
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
                         ->where('embassy_status',3)
                         ->orderBy('id','desc')
                         ->get()
     ];
     return view('Embassy.passportOption.all_delivery',$data);
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
                         ->where('embassy_status',3)
                         ->orderBy('id','desc')
                         ->get()
     ];
     return view('Embassy.passportOption.all_delivery',$data);
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
                            ->where('embassy_status',3)
                            ->orderBy('id','desc')
                            ->get()
        ];
        return view('Embassy.passportOption.all_delivery',$data);
    }

    return redirect()->back();
}


}
