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
                                                return $query->whereDate('updated_at','>=',$from_date)->whereDate('updated_at','<=',$to_date);
                                            })
                                            ->orderBy('id','desc')
                                            ->where('branch_status',1)
                                            ->get()
            ];
            return view('CallCenter.passportOption.delivery',$data);
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
                                                    return $query->whereDate('updated_at','>=',$from_date)->whereDate('updated_at','<=',$to_date);
                                                })
                                                ->where('branch_status',1)
                                                ->orderBy('id','desc')
                                                ->get()
            ];
            return view('CallCenter.passportOption.delivery',$data);
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
                                                return $query->whereDate('updated_at','>=',$from_date)->whereDate('updated_at','<=',$to_date);
                                            })
                                            ->where('branch_status',1)
                                            ->orderBy('id','desc')
                                            ->get()
            ];
            return view('CallCenter.passportOption.delivery',$data);
        }

        if ($option == 3) {
            $data=[
                'civil_id' => $civil_id,
                'mobile' => $mobile,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'option' => $option,
                'options' => Other::when($civil_id != '',function($query) use($civil_id){
                                    return $query->where('civil_id',$civil_id);
                                })
                                ->when($mobile != '',function($query) use($mobile){
                                    return $query->where('bd_phone',$mobile);
                                })
                                ->when($from_date != '' && $to_date != '',function($query) use($from_date,$to_date){
                                    return $query->whereDate('updated_at','>=',$from_date)->whereDate('updated_at','<=',$to_date);
                                })
                                ->where('branch_status',1)
                                ->orderBy('id','desc')
                                ->get()
            ];
            return view('CallCenter.passportOption.delivery',$data);
        }

        if ($option == 4) {
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
                                                    return $query->whereDate('updated_at','>=',$from_date)->whereDate('updated_at','<=',$to_date);
                                                })
                                                ->where('branch_status',1)
                                                ->orderBy('id','desc')
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

        if ($request->passport_option == 0) {
            LostPassport::whereIn('id',$request->all_option)->update([
                'is_delivered' => 1,
            ]);
            $request->session()->flash('type', 'success');
            $request->session()->flash('message', 'Lost Passport Received to Embasssay Successfully!!');
            return redirect()->back();
        }

        if ($request->passport_option == 1) {
            ManualPassport::whereIn('id',$request->all_option)->update([
                'is_delivered' => 1,
            ]);
            $request->session()->flash('type', 'success');
            $request->session()->flash('message', 'Manual Passport Received to Embasssay Successfully!!');
            return redirect()->back();
        }
        if ($request->passport_option == 2) {
            RenewPassport::whereIn('id',$request->all_option)->update([
                'is_delivered' => 1,
            ]);
            $request->session()->flash('type', 'success');
            $request->session()->flash('message', 'Renewal Passport Received to Embasssay Successfully!!');
            return redirect()->back();
        }
        if ($request->passport_option == 3) {
            Other::whereIn('id',$request->all_option)->update([
                'is_delivered' => 1,
            ]);
            $request->session()->flash('type', 'success');
            $request->session()->flash('message', 'Renewal Passport Received to Embasssay Successfully!!');
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

            if ($option == 0) {
                LostPassport::where('id',$id)->update([
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
                RenewPassport::where('id',$id)->update([
                    'is_delivered' => 0,
                ]);
                return response()->json([
                    'type' => 'success',
                    'message' => 'Successfully Undo'
                ]);
            }
            if ($option == 3) {
                Other::where('id',$id)->update([
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

            if ($option == 0) {
                RenewPassport::where('id',$id)->update([
                    'remarks' => $mySelect,
                    'remarks_by' => Auth::user()->id,
                ]);
                return response()->json([
                    'type' => 'success',
                    'message' => 'Successfully Remarks'
                ]);
            }

            if ($option == 1) {
                ManualPassport::where('id',$id)->update([
                    'remarks' => $mySelect,
                    'remarks_by' => Auth::user()->id,
                ]);
                return response()->json([
                    'type' => 'success',
                    'message' => 'Successfully Remarks'
                ]);
            }
            if ($option == 2) {
                LostPassport::where('id',$id)->update([
                    'remarks' => $mySelect,
                    'remarks_by' => Auth::user()->id,
                ]);
                return response()->json([
                    'type' => 'success',
                    'message' => 'Successfully Remarks'
                ]);
            }
            if ($option == 3) {
                Other::where('id',$id)->update([
                    'remarks' => $mySelect,
                    'remarks_by' => Auth::user()->id,
                ]);
                return response()->json([
                    'type' => 'success',
                    'message' => 'Successfully Remarks'
                ]);
            }

            if ($option == 4) {
                NewBornBabyPassport::where('id',$id)->update([
                    'remarks' => $mySelect,
                    'remarks_by' => Auth::user()->id,
                ]);
                return response()->json([
                    'type' => 'success',
                    'message' => 'Successfully Remarks'
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

    public function remarksSave(Request $request,$id){



        $request->validate([
            'remarks' => 'required'
        ]);



        if (isset($request->option) && $request->option == 0) {
            $lostPassport = RenewPassport::findOrFail($id);
            $lostPassport->remarks = $request->remarks;
            $lostPassport->remarks_by = Auth::user()->id;
            $lostPassport->save();
            return response()->json([
                'type' => 'success',
                'message' => 'Remarks Added Successfully!'
            ]);
        }

        if (isset($request->option) && $request->option == 1) {
            $manualPassport = ManualPassport::findOrFail($id);
            $manualPassport->remarks = $request->remarks;
            $manualPassport->remarks_by = Auth::user()->id;
            $manualPassport->save();
            return response()->json([
                'type' => 'success',
                'message' => 'Remarks Added Successfully!'
            ]);
        }

        if (isset($request->option) && $request->option == 2) {
            $renewPassport = LostPassport::findOrFail($id);
            $renewPassport->remarks = $request->remarks;
            $renewPassport->remarks_by = Auth::user()->id;
            $renewPassport->save();
            return response()->json([
                'type' => 'success',
                'message' => 'Remarks Added Successfully!'
            ]);
        }

        if (isset($request->option) && $request->option == 3) {
            $newBornBabyPassport = NewBornBabyPassport::findOrFail($id);
            $newBornBabyPassport->remarks = $request->remarks;
            $newBornBabyPassport->remarks_by = Auth::user()->id;
            $newBornBabyPassport->save();
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
