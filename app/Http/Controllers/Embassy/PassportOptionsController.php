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
    public function receiveToEmbassy(){
        return $this->searchReceive('&&&&0');
    }

    public function searchReceive($data){

    $civil_id = explode('&', $data)[0] ? explode('&', $data)[0] : '';
    $mobile = explode('&', $data)[1] ? explode('&', $data)[1] : '';
    $from_date = explode('&', $data)[2] ? explode('&', $data)[2] : '';
    $to_date = explode('&', $data)[3] ? explode('&', $data)[3] : '';
    $option = explode('&', $data)[4] ? explode('&', $data)[4] : 0;

        $data=[
            'civil_id' => $civil_id,
            'mobile' => $mobile,
            'from_date' => $from_date,
            'to_date' => $to_date,
            'option' => $option,
            'options' => get_passport_model_name_by_option($option)::when($civil_id != '',function($query) use($civil_id){
                            return $query->where('civil_id',$civil_id);
                        })->when($mobile != '',function($query) use($mobile){
                            return $query->where('bd_phone',$mobile);
                        })->when($from_date != '' && $to_date != '',function($query) use($from_date,$to_date){
                            return $query->whereDate('created_at','>=',$from_date)->whereDate('created_at','<=',$to_date);
                        })->where('embassy_status',1)
                        ->orderBy('id','desc')
                        ->get()
        ];
    return view('Embassy.passportOption.receive_to_embassy',$data);
   }

    public function receiveToEmbassyStore(Request $request){
        $request->validate([
            'all_option' => 'required',
        ],
        [
            'all_option.required' => 'Please Select Some Data!!',
        ]
        );

        get_passport_model_name_by_option($request->passport_option)::whereIn('id',$request->all_option)->update([
            'embassy_status' => 2,
        ]);
        Session::flash('success','Passport Received to Embasssay Successfully!!');
        return redirect()->back();
    }

    public function receiveToEmbassyUndo($data){
        $option = explode('&', $data)[0];
        $id = explode('&', $data)[1];

        if (isset($option) && isset($id)) {

            get_passport_model_name_by_option($option)::where('id',$id)->update([
                    'embassy_status' => 1,
                ]);
                return response()->json([
                    'type' => 'success',
                    'message' => 'Successfully Undo'
                ]);
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

        if (isset($request->option)) {
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

        $data=[
            'civil_id' => $civil_id,
            'mobile' => $mobile,
            'from_date' => $from_date,
            'to_date' => $to_date,
            'option' => $option,
            'options' => get_passport_model_name_by_option($option)::when($civil_id != '',function($query) use($civil_id){
                            return $query->where('civil_id',$civil_id);
                        })->when($mobile != '',function($query) use($mobile){
                            return $query->where('bd_phone',$mobile);
                        })->when($from_date != '' && $to_date != '',function($query) use($from_date,$to_date){
                            return $query->whereDate('created_at','>=',$from_date)->whereDate('created_at','<=',$to_date);
                        })->where('embassy_status',2)
                        ->orderBy('id','desc')
                        ->get()
        ];
        return view('Embassy.passportOption.delivery_to_admin',$data);
    }

    public function deliveryStore(Request $request){
        $request->validate([
            'all_option' => 'required',
        ],
        [
            'all_option.required' => 'Please Select Some Data!!',
        ]
        );
        get_passport_model_name_by_option($request->passport_option)::whereIn('id',$request->all_option)->update([
            'embassy_status' => 3,
        ]);
        Session::flash('success','Passport Delivery to Admin Successfully!!');
        return redirect()->back();
    }

    public function deliveryUndo($data){
        $option = explode('&', $data)[0];
        $id = explode('&', $data)[1];

        if (isset($option) && isset($id)) {
            get_passport_model_name_by_option($option)::where('id',$id)->update([
                'is_delivered' => 0,
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

        $data=[
            'civil_id' => $civil_id,
            'mobile' => $mobile,
            'from_date' => $from_date,
            'to_date' => $to_date,
            'option' => $option,
            'options' => get_passport_model_name_by_option($option)::when($civil_id != '',function($query) use($civil_id){
                            return $query->where('civil_id',$civil_id);
                        })->when($mobile != '',function($query) use($mobile){
                            return $query->where('bd_phone',$mobile);
                        })->when($from_date != '' && $to_date != '',function($query) use($from_date,$to_date){
                                return $query->whereDate('created_at','>=',$from_date)->whereDate('created_at','<=',$to_date);
                        })->where('embassy_status',3)
                            ->orderBy('id','desc')
                            ->get()
        ];
        return view('Embassy.passportOption.all_delivery',$data);
    }
}
