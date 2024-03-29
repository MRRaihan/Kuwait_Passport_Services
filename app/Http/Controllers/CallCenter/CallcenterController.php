<?php

namespace App\Http\Controllers\CallCenter;

use App\Http\Controllers\Controller;
use App\Models\LostPassport;
use App\Models\ManualPassport;
use App\Models\Other;
use App\Models\RenewPassport;
use App\Models\NewBornBabyPassport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CallcenterController extends Controller
{
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
                                                return $query->whereDate('updated_at','>=',$from_date)->whereDate('updated_at','<=',$to_date);
                                            })
                                            ->orderBy('id','desc')
                                            ->where('branch_status',1)
                                            ->get()
            ];
            return view('CallCenter.passportOption.delivery',$data);
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

        if (isset($request->passport_option)) {
            get_passport_model_name_by_option($request->passport_option)::whereIn('id',$request->all_option)->update([
                'is_delivered' => 1,
            ]);
            $request->session()->flash('type', 'success');
            $request->session()->flash('message', 'Passport Received to Embasssay Successfully!!');
            return redirect()->back();
        }
        $request->session()->flash('type', 'error');
        $request->session()->flash('message', 'Something Went Wrong');
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

    public function deafultRemarksSave($data){
         $option = explode('&', $data)[0] ? explode('&', $data)[0] : '';
         $id = explode('&', $data)[1] ? explode('&', $data)[1] : '';
         $mySelect = explode('&', $data)[2];

        if (isset($option) && isset($id)) {

            if ($mySelect == -1) {
                return response()->json([
                    'type' => 'Error',
                    'message' => 'Please Select Valid Option!'
                ]);
            }

            get_passport_model_name_by_option($option)::where('id',$id)->update([
                'remarks' => $mySelect,
                'remarks_by' => Auth::user()->id,
            ]);
            return response()->json([
                'type' => 'success',
                'message' => 'Successfully Remarks'
            ]);
        }else{
            return response()->json([
                'type' => 'error',
                'message' => 'Something Went Wrong'
            ]);
        }
    }

    public function remarksSave(Request $request,$id){
        $request->validate([
            'remarks' => 'required'
        ]);

        if (isset($request->option)) {
            $passport = get_passport_model_name_by_option($request->option)::findOrFail($id);
            $passport->remarks = $request->remarks;
            $passport->remarks_by = Auth::user()->id;
            $passport->save();
            return response()->json([
                'type' => 'success',
                'message' => 'Remarks Added Successfully!'
            ]);
        }
        return response()->json([
            'type' => 'error',
            'message' => 'Something Went Wrong!!'
        ]);
        return redirect()->back();
    }
}
