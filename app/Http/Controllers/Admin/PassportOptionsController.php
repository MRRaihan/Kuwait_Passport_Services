<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Other;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use App\Models\LostPassport;
use App\Models\ManualPassport;
use App\Models\RenewPassport;
use App\Models\NewBornBabyPassport;

class PassportOptionsController extends Controller
{

    // Shift To Embassay Passport Option By Monir

    public function shiftToEmbassy()
    {
        return $this->search('&&&&0');
    }

    public function search($data)
    {
        $civil_id = explode('&', $data)[0] ? explode('&', $data)[0] : '';
        $mobile = explode('&', $data)[1] ? explode('&', $data)[1] : '';
        $from_date = explode('&', $data)[2] ? explode('&', $data)[2] : '';
        $to_date = explode('&', $data)[3] ? explode('&', $data)[3] : '';
        $option = explode('&', $data)[4] ? explode('&', $data)[4] : 0;

        $data = [
            'civil_id' => $civil_id,
            'mobile' => $mobile,
            'from_date' => $from_date,
            'to_date' => $to_date,
            'option' => $option,
            'options' => get_passport_model_name_by_option($option)::when($civil_id != '', function ($query) use ($civil_id) {
                return $query->where('civil_id', 'LIKE', '%' . $civil_id . '%');
            })
                ->when($mobile != '', function ($query) use ($mobile) {
                    return $query->where('bd_phone', 'LIKE', '%' . $mobile . '%');
                })
                ->when($from_date != '' && $to_date != '', function ($query) use ($from_date, $to_date) {
                    return $query->whereDate('created_at', '>=', $from_date)->whereDate('created_at', '<=', $to_date);
                })
                ->where('shift_to_admin', 1)
                ->orderBy('id', 'desc')
                ->get()
        ];
        return view('Admin.passportOption.shift_to_embassy', $data);
    }

    public function shiftToEmbassyStore(Request $request)
    {
        $request->validate(
            [
                'all_option' => 'required',
            ],
            [
                'all_option.required' => 'Please Select Some Data!!',
            ]
        );

        get_passport_model_name_by_option($request->passport_option)::whereIn('id', $request->all_option)->update([
            'embassy_status' => 1,
        ]);
        Session::flash('success', 'Passport Shift to Embasssay Successfully!!');
        return redirect()->back();
    }


    public function shiftToEmbassyUndo($data)
    {
        $option = explode('&', $data)[0];
        $id = explode('&', $data)[1];

        if (isset($option) && isset($id)) {

            get_passport_model_name_by_option($option)::where('id', $id)->update([
                'embassy_status' => 0,
            ]);
            return response()->json([
                'type' => 'success',
                'message' => 'Successfully Undo'
            ]);
        } else {
            return response()->json([
                'type' => 'error',
                'message' => 'Something Went Wrong'
            ]);
        }
    }

    // Received From Embassay Passport Option By Monir


    public function receiveFromEmbassy()
    {
        return $this->searchReceive('&&&&0');
    }

    public function searchReceive($data)
    {
        $civil_id = explode('&', $data)[0] ? explode('&', $data)[0] : '';
        $mobile = explode('&', $data)[1] ? explode('&', $data)[1] : '';
        $from_date = explode('&', $data)[2] ? explode('&', $data)[2] : '';
        $to_date = explode('&', $data)[3] ? explode('&', $data)[3] : '';
        $option = explode('&', $data)[4] ? explode('&', $data)[4] : 0;

        $data = [
            'civil_id' => $civil_id,
            'mobile' => $mobile,
            'from_date' => $from_date,
            'to_date' => $to_date,
            'option' => $option,
            'options' => get_passport_model_name_by_option($option)::when($civil_id != '', function ($query) use ($civil_id) {
                return $query->where('civil_id', $civil_id);
            })
                ->when($mobile != '', function ($query) use ($mobile) {
                    return $query->where('bd_phone', $mobile);
                })
                ->when($from_date != '' && $to_date != '', function ($query) use ($from_date, $to_date) {
                    return $query->whereDate('updated_at', '>=', $from_date)->whereDate('updated_at', '<=', $to_date);
                })
                ->where('embassy_status', 3)
                ->where('branch_status', '<=', 0)
                ->orderBy('id', 'desc')
                ->get()
        ];
        return view('Admin.passportOption.receive_from_embassy', $data);
    }

    // Shift To Branch Store

    public function shfitToBranchStore(Request $request)
    {
        $request->validate(
            [
                'all_option' => 'required',
            ],
            [
                'all_option.required' => 'Please Select Some Data!!',
            ]
        );

        if ($request->passport_option) {
            get_passport_model_name_by_option($request->passport_option)::whereIn('id', $request->all_option)->whereIn('branch_id', $request->branch_id)->update([
                'branch_status' => 1,
            ]);
            Session::flash('success', 'Passport Shift to Branch Successfully!!');
            return redirect()->back();
        }
        Session::flash('error', 'Something Went Wrong');
        return redirect()->back();
    }

    public function bioEnrollmentIdSave(Request $request, $id)
    {
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

    public function delivery()
    {
        return $this->searchDelivery('&&&&0');
    }

    public function searchDelivery($data)
    {

        $civil_id = explode('&', $data)[0] ? explode('&', $data)[0] : '';
        $mobile = explode('&', $data)[1] ? explode('&', $data)[1] : '';
        $from_date = explode('&', $data)[2] ? explode('&', $data)[2] : '';
        $to_date = explode('&', $data)[3] ? explode('&', $data)[3] : '';
        $option = explode('&', $data)[4] ? explode('&', $data)[4] : 0;

        if ($option) {
            $data = [
                'civil_id' => $civil_id,
                'mobile' => $mobile,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'option' => $option,
                'options' => get_passport_model_name_by_option($option)::when($civil_id != '', function ($query) use ($civil_id) {
                        return $query->where('civil_id', $civil_id);
                    })
                    ->when($mobile != '', function ($query) use ($mobile) {
                        return $query->where('bd_phone', $mobile);
                    })
                    ->when($from_date != '' && $to_date != '', function ($query) use ($from_date, $to_date) {
                        return $query->whereDate('updated_at', '>=', $from_date)->whereDate('updated_at', '<=', $to_date);
                    })
                    ->orderBy('id', 'desc')
                    ->get()
            ];
            return view('Admin.passportOption.delivery', $data);
        }
        return redirect()->back();
    }

    public function deliveryStore(Request $request)
    {
        $request->validate(
            [
                'all_option' => 'required',
            ],
            [
                'all_option.required' => 'Please Select Some Data!!',
            ]
        );

        if ($request->passport_option) {
            get_passport_model_name_by_option($request->passport_option)::whereIn('id', $request->all_option)->update([
                'is_delivered' => 1,
            ]);
            Session::flash('success', 'Passport Received to Embasssay Successfully!!');
            return redirect()->back();
        }

        $request->session()->flash('type', 'error');
        $request->session()->flash('message', 'Something Went Wrong');
        return redirect()->back();
    }

    public function deliveryUndo($data)
    {
        $option = explode('&', $data)[0];
        $id = explode('&', $data)[1];


        if (isset($option) && isset($id)) {

            get_passport_model_name_by_option($option)::where('id', $id)->update([
                'is_delivered' => 0,
            ]);
            return response()->json([
                'type' => 'success',
                'message' => 'Successfully Undo'
            ]);
        } else {
            return response()->json([
                'type' => 'error',
                'message' => 'Something Went Wrong'
            ]);
        }
    }

    public function callCenterStatus()
    {
        return $this->searchCallCenterStatus('&&&&0');
    }

    public function searchCallCenterStatus($data)
    {
        $civil_id = explode('&', $data)[0] ? explode('&', $data)[0] : '';
        $mobile = explode('&', $data)[1] ? explode('&', $data)[1] : '';
        $from_date = explode('&', $data)[2] ? explode('&', $data)[2] : '';
        $to_date = explode('&', $data)[3] ? explode('&', $data)[3] : '';
        $option = explode('&', $data)[4] ? explode('&', $data)[4] : 0;

        if ($option) {
            $data = [
                'civil_id' => $civil_id,
                'mobile' => $mobile,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'option' => $option,
                'options' => get_passport_model_name_by_option($option)::when($civil_id != '', function ($query) use ($civil_id) {
                    return $query->where('civil_id', $civil_id);
                })
                    ->when($mobile != '', function ($query) use ($mobile) {
                        return $query->where('bd_phone', $mobile);
                    })
                    ->when($from_date != '' && $to_date != '', function ($query) use ($from_date, $to_date) {
                        return $query->whereDate('created_at', '>=', $from_date)->whereDate('created_at', '<=', $to_date);
                    })
                    ->where('embassy_status', 3)
                    ->orderBy('id', 'desc')
                    ->get()
            ];
            return view('Admin.passportOption.call_center_status', $data);
        }
        return redirect()->back();
    }


    public function allDeliveryFromBranch()
    {
        return $this->searchAllDeliveryFromBranch('&&&&0');
    }

    public function searchAllDeliveryFromBranch($data)
    {
        $civil_id = explode('&', $data)[0] ? explode('&', $data)[0] : '';
        $mobile = explode('&', $data)[1] ? explode('&', $data)[1] : '';
        $from_date = explode('&', $data)[2] ? explode('&', $data)[2] : '';
        $to_date = explode('&', $data)[3] ? explode('&', $data)[3] : '';
        $option = explode('&', $data)[4] ? explode('&', $data)[4] : 0;

        if ($option) {
            $data = [
                'civil_id' => $civil_id,
                'mobile' => $mobile,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'option' => $option,
                'options' => get_passport_model_name_by_option($option)::when($civil_id != '', function ($query) use ($civil_id) {
                    return $query->where('civil_id', $civil_id);
                })
                    ->when($mobile != '', function ($query) use ($mobile) {
                        return $query->where('bd_phone', $mobile);
                    })
                    ->when($from_date != '' && $to_date != '', function ($query) use ($from_date, $to_date) {
                        return $query->whereDate('created_at', '>=', $from_date)->whereDate('created_at', '<=', $to_date);
                    })
                    ->where('branch_status', 3)
                    ->orderBy('id', 'desc')
                    ->get()
            ];
            return view('Admin.passportOption.all_delivery_from_branch', $data);
        }
        return redirect()->back();
    }
}
