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

        // return $data;

        $emirates_id = explode('&', $data)[0] ? explode('&', $data)[0] : '';
        $mobile = explode('&', $data)[1] ? explode('&', $data)[1] : '';
        $from_date = explode('&', $data)[2] ? explode('&', $data)[2] : '';
        $to_date = explode('&', $data)[3] ? explode('&', $data)[3] : '';
        $option = explode('&', $data)[4] ? explode('&', $data)[4] : 0;

        if ($option == 0) {
            $data = [
                'emirates_id' => $emirates_id,
                'mobile' => $mobile,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'option' => $option,
                'options' => RenewPassport::when($emirates_id != '', function ($query) use ($emirates_id) {
                    return $query->where('emirates_id', $emirates_id);
                })
                    ->when($mobile != '', function ($query) use ($mobile) {
                        return $query->where('bd_phone', $mobile);
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
        if ($option == 1) {
            $data = [
                'emirates_id' => $emirates_id,
                'mobile' => $mobile,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'option' => $option,
                'options' => ManualPassport::when($emirates_id != '', function ($query) use ($emirates_id) {
                    return $query->where('emirates_id', $emirates_id);
                })
                    ->when($mobile != '', function ($query) use ($mobile) {
                        return $query->where('bd_phone', $mobile);
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

        if ($option == 2) {
            $data = [
                'emirates_id' => $emirates_id,
                'mobile' => $mobile,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'option' => $option,
                'options' => LostPassport::when($emirates_id != '', function ($query) use ($emirates_id) {
                    return $query->where('emirates_id', $emirates_id);
                })
                    ->when($mobile != '', function ($query) use ($mobile) {
                        return $query->where('bd_phone', $mobile);
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

        if ($option == 3) {
            $data = [
                'emirates_id' => $emirates_id,
                'mobile' => $mobile,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'option' => $option,
                'options' => NewBornBabyPassport::when($emirates_id != '', function ($query) use ($emirates_id) {
                    return $query->where('emirates_id', 'LIKE', '%' . $emirates_id . '%');
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

        return redirect()->back();
    }

    public function shiftToEmbassyStore(Request $request)
    {
        $request->validate(
            [
                'all_option' => 'required',
            ],
            [
                'all_option.required' => 'Please Sellect Some Data!!',
            ]
        );

        if ($request->passport_option == 0) {
            RenewPassport::whereIn('id', $request->all_option)->update([
                'embassy_status' => 1,
            ]);

            Session::flash('success', 'Lost Passport Shift to Embasssay Successfully!!');
            return redirect()->back();
        }

        if ($request->passport_option == 1) {
            ManualPassport::whereIn('id', $request->all_option)->update([
                'embassy_status' => 1,
            ]);
            Session::flash('success', 'Manual Passport Shift to Embasssay Successfully!!');
            return redirect()->back();
        }
        if ($request->passport_option == 2) {
            LostPassport::whereIn('id', $request->all_option)->update([
                'embassy_status' => 1,
            ]);
            Session::flash('success', 'Renewal Passport Shift to Embasssay Successfully!!');
            return redirect()->back();
        }

        if ($request->passport_option == 3) {
            NewBornBabyPassport::whereIn('id', $request->all_option)->update([
                'embassy_status' => 1,
            ]);
            Session::flash('success', 'New Born Baby Passport Shift to Embasssay Successfully!!');
            return redirect()->back();
        }

        return redirect()->back();
    }


    public function shiftToEmbassyUndo($data)
    {

        $option = explode('&', $data)[0];
        $id = explode('&', $data)[1];


        if (isset($option) && isset($id)) {

            if ($option == 0) {
                RenewPassport::where('id', $id)->update([
                    'embassy_status' => 0,
                ]);
                return response()->json([
                    'type' => 'success',
                    'message' => 'Successfully Undo'
                ]);
            }

            if ($option == 1) {
                ManualPassport::where('id', $id)->update([
                    'embassy_status' => 0,
                ]);
                return response()->json([
                    'type' => 'success',
                    'message' => 'Successfully Undo'
                ]);
            }
            if ($option == 2) {
                LostPassport::where('id', $id)->update([
                    'embassy_status' => 0,
                ]);
                return response()->json([
                    'type' => 'success',
                    'message' => 'Successfully Undo'
                ]);
            }


            if ($option == 3) {
                NewBornBabyPassport::where('id', $id)->update([
                    'embassy_status' => 0,
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

        $emirates_id = explode('&', $data)[0] ? explode('&', $data)[0] : '';
        $mobile = explode('&', $data)[1] ? explode('&', $data)[1] : '';
        $from_date = explode('&', $data)[2] ? explode('&', $data)[2] : '';
        $to_date = explode('&', $data)[3] ? explode('&', $data)[3] : '';
        $option = explode('&', $data)[4] ? explode('&', $data)[4] : 0;

        if ($option == 0) {
            $data = [
                'emirates_id' => $emirates_id,
                'mobile' => $mobile,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'option' => $option,
                'options' => RenewPassport::when($emirates_id != '', function ($query) use ($emirates_id) {
                    return $query->where('emirates_id', $emirates_id);
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

        if ($option == 1) {
            $data = [
                'emirates_id' => $emirates_id,
                'mobile' => $mobile,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'option' => $option,
                'options' => ManualPassport::when($emirates_id != '', function ($query) use ($emirates_id) {
                    return $query->where('emirates_id', $emirates_id);
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

        if ($option == 2) {
            $data = [
                'emirates_id' => $emirates_id,
                'mobile' => $mobile,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'option' => $option,
                'options' => LostPassport::when($emirates_id != '', function ($query) use ($emirates_id) {
                    return $query->where('emirates_id', $emirates_id);
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

        if ($option == 3) {
            $data = [
                'emirates_id' => $emirates_id,
                'mobile' => $mobile,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'option' => $option,
                'options' => NewBornBabyPassport::when($emirates_id != '', function ($query) use ($emirates_id) {
                        return $query->where('emirates_id', $emirates_id);
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

        return redirect()->back();
    }


    // Shift To Branch Store

    public function shfitToBranchStore(Request $request)
    {
        //    dd($request->all());
        $request->validate(
            [
                'all_option' => 'required',
            ],
            [
                'all_option.required' => 'Please Sellect Some Data!!',
            ]
        );

        if ($request->passport_option == 0) {
            RenewPassport::whereIn('id', $request->all_option)->whereIn('branch_id', $request->branch_id)->update([
                'branch_status' => 1,
            ]);
            Session::flash('success', 'Renew Passport Shift to Branch Successfully!!');
            return redirect()->back();
        }

        if ($request->passport_option == 1) {
            ManualPassport::whereIn('id', $request->all_option)->whereIn('branch_id', $request->branch_id)->update([
                'branch_status' => 1,
            ]);
            Session::flash('success', 'Manual Passport Shift to Branch Successfully!!');
            return redirect()->back();
        }
        if ($request->passport_option == 2) {
            LostPassport::whereIn('id', $request->all_option)->whereIn('branch_id', $request->branch_id)->update([
                'branch_status' => 1,
            ]);
            Session::flash('success', 'Lost Passport Shift to Branch Successfully!!');
            return redirect()->back();
        }

        if ($request->passport_option == 3) {
            NewBornBabyPassport::whereIn('id', $request->all_option)->whereIn('branch_id', $request->branch_id)->update([
                'branch_status' => 1,
            ]);
            Session::flash('success', 'New Born Baby Passport Shift to Branch Successfully!!');
            return redirect()->back();
        }
        Session::flash('error', 'Something Went Wrong');
        return redirect()->back();
    }

    public function receiveFromEmbassyUndo($data)
    {

        $option = explode('&', $data)[0];
        $id = explode('&', $data)[1];


        if (isset($option) && isset($id)) {

            if ($option == 0) {
                RenewPassport::where('id', $id)->update([
                    'is_received' => 0,
                ]);
                return response()->json([
                    'type' => 'success',
                    'message' => 'Successfully Undo'
                ]);
            }

            if ($option == 1) {
                ManualPassport::where('id', $id)->update([
                    'is_received' => 0,
                ]);
                return response()->json([
                    'type' => 'success',
                    'message' => 'Successfully Undo'
                ]);
            }
            if ($option == 2) {
                LostPassport::where('id', $id)->update([
                    'is_received' => 0,
                ]);
                return response()->json([
                    'type' => 'success',
                    'message' => 'Successfully Undo'
                ]);
            }

            if ($option == 3) {
                NewBornBabyPassport::where('id', $id)->update([
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
        } else {
            return response()->json([
                'type' => 'error',
                'message' => 'Something Went Wrong'
            ]);
        }
    }

    public function receiveFromEmbassyStore(Request $request)
    {
        $request->validate(
            [
                'all_option' => 'required',
            ],
            [
                'all_option.required' => 'Please Sellect Some Data!!',
            ]
        );

        if ($request->passport_option == 0) {
            RenewPassport::whereIn('id', $request->all_option)->update([
                'is_received' => 1,
            ]);
            Session::flash('success', 'Renew Passport Received to Embasssay Successfully!!');
            return redirect()->back();
        }

        if ($request->passport_option == 1) {
            ManualPassport::whereIn('id', $request->all_option)->update([
                'is_received' => 1,
            ]);
            Session::flash('success', 'Manual Passport Received to Embasssay Successfully!!');
            return redirect()->back();
        }
        if ($request->passport_option == 2) {
            LostPassport::whereIn('id', $request->all_option)->update([
                'is_received' => 1,
            ]);
            Session::flash('success', 'Lost Passport Received to Embasssay Successfully!!');
            return redirect()->back();
        }


        if ($request->passport_option == 3) {
            NewBornBabyPassport::whereIn('id', $request->all_option)->update([
                'is_received' => 1,
            ]);
            Session::flash('success', 'New Born Baby Passport Received to Embasssay Successfully!!');
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

        // return $request->option;

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

    public function delivery()
    {
        return $this->searchDelivery('&&&&0');
    }

    public function searchDelivery($data)
    {

        $emirates_id = explode('&', $data)[0] ? explode('&', $data)[0] : '';
        $mobile = explode('&', $data)[1] ? explode('&', $data)[1] : '';
        $from_date = explode('&', $data)[2] ? explode('&', $data)[2] : '';
        $to_date = explode('&', $data)[3] ? explode('&', $data)[3] : '';
        $option = explode('&', $data)[4] ? explode('&', $data)[4] : 0;

        if ($option == 0) {
            $data = [
                'emirates_id' => $emirates_id,
                'mobile' => $mobile,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'option' => $option,
                'options' => RenewPassport::when($emirates_id != '', function ($query) use ($emirates_id) {
                    return $query->where('emirates_id', $emirates_id);
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

        if ($option == 1) {
            $data = [
                'emirates_id' => $emirates_id,
                'mobile' => $mobile,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'option' => $option,
                'options' => ManualPassport::when($emirates_id != '', function ($query) use ($emirates_id) {
                    return $query->where('emirates_id', $emirates_id);
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

        if ($option == 2) {
            $data = [
                'emirates_id' => $emirates_id,
                'mobile' => $mobile,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'option' => $option,
                'options' => LostPassport::when($emirates_id != '', function ($query) use ($emirates_id) {
                    return $query->where('emirates_id', $emirates_id);
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


        if ($option == 3) {
            $data = [
                'emirates_id' => $emirates_id,
                'mobile' => $mobile,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'option' => $option,
                'options' => NewBornBabyPassport::when($emirates_id != '', function ($query) use ($emirates_id) {
                        return $query->where('emirates_id', $emirates_id);
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
                'all_option.required' => 'Please Sellect Some Data!!',
            ]
        );

        if ($request->passport_option == 0) {
            RenewPassport::whereIn('id', $request->all_option)->update([
                'is_delivered' => 1,
            ]);
            Session::flash('success', 'Renew Passport Received to Embasssay Successfully!!');
            return redirect()->back();
        }

        if ($request->passport_option == 1) {
            ManualPassport::whereIn('id', $request->all_option)->update([
                'is_delivered' => 1,
            ]);
            Session::flash('success', 'Manual Passport Received to Embasssay Successfully!!');
            return redirect()->back();
        }
        if ($request->passport_option == 2) {
            LostPassport::whereIn('id', $request->all_option)->update([
                'is_delivered' => 1,
            ]);
            Session::flash('success', 'Lost Passport Received to Embasssay Successfully!!');
            return redirect()->back();
        }

        if ($request->passport_option == 3) {
            NewBornBabyPassport::whereIn('id', $request->all_option)->update([
                'is_delivered' => 1,
            ]);
            Session::flash('success', 'New Born Baby Passport Received to Embasssay Successfully!!');
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

            if ($option == 0) {
                RenewPassport::where('id', $id)->update([
                    'is_delivered' => 0,
                ]);
                return response()->json([
                    'type' => 'success',
                    'message' => 'Successfully Undo'
                ]);
            }

            if ($option == 1) {
                ManualPassport::where('id', $id)->update([
                    'is_delivered' => 0,
                ]);
                return response()->json([
                    'type' => 'success',
                    'message' => 'Successfully Undo'
                ]);
            }
            if ($option == 2) {
                LostPassport::where('id', $id)->update([
                    'is_delivered' => 0,
                ]);
                return response()->json([
                    'type' => 'success',
                    'message' => 'Successfully Undo'
                ]);
            }
            if ($option == 3) {
                NewBornBabyPassport::where('id', $id)->update([
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

        $emirates_id = explode('&', $data)[0] ? explode('&', $data)[0] : '';
        $mobile = explode('&', $data)[1] ? explode('&', $data)[1] : '';
        $from_date = explode('&', $data)[2] ? explode('&', $data)[2] : '';
        $to_date = explode('&', $data)[3] ? explode('&', $data)[3] : '';
        $option = explode('&', $data)[4] ? explode('&', $data)[4] : 0;

        if ($option == 0) {
            $data = [
                'emirates_id' => $emirates_id,
                'mobile' => $mobile,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'option' => $option,
                'options' => RenewPassport::when($emirates_id != '', function ($query) use ($emirates_id) {
                    return $query->where('emirates_id', $emirates_id);
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

        if ($option == 1) {
            $data = [
                'emirates_id' => $emirates_id,
                'mobile' => $mobile,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'option' => $option,
                'options' => ManualPassport::when($emirates_id != '', function ($query) use ($emirates_id) {
                    return $query->where('emirates_id', $emirates_id);
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

        if ($option == 2) {
            $data = [
                'emirates_id' => $emirates_id,
                'mobile' => $mobile,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'option' => $option,
                'options' => LostPassport::when($emirates_id != '', function ($query) use ($emirates_id) {
                    return $query->where('emirates_id', $emirates_id);
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

        if ($option == 3) {
            $data = [
                'emirates_id' => $emirates_id,
                'mobile' => $mobile,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'option' => $option,
                'options' => NewBornBabyPassport::when($emirates_id != '', function ($query) use ($emirates_id) {
                    return $query->where('emirates_id', $emirates_id);
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

        $emirates_id = explode('&', $data)[0] ? explode('&', $data)[0] : '';
        $mobile = explode('&', $data)[1] ? explode('&', $data)[1] : '';
        $from_date = explode('&', $data)[2] ? explode('&', $data)[2] : '';
        $to_date = explode('&', $data)[3] ? explode('&', $data)[3] : '';
        $option = explode('&', $data)[4] ? explode('&', $data)[4] : 0;

        if ($option == 0) {
            $data = [
                'emirates_id' => $emirates_id,
                'mobile' => $mobile,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'option' => $option,
                'options' => RenewPassport::when($emirates_id != '', function ($query) use ($emirates_id) {
                    return $query->where('emirates_id', $emirates_id);
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

        if ($option == 1) {
            $data = [
                'emirates_id' => $emirates_id,
                'mobile' => $mobile,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'option' => $option,
                'options' => ManualPassport::when($emirates_id != '', function ($query) use ($emirates_id) {
                    return $query->where('emirates_id', $emirates_id);
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

        if ($option == 2) {
            $data = [
                'emirates_id' => $emirates_id,
                'mobile' => $mobile,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'option' => $option,
                'options' => LostPassport::when($emirates_id != '', function ($query) use ($emirates_id) {
                    return $query->where('emirates_id', $emirates_id);
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

        if ($option == 3) {
            $data = [
                'emirates_id' => $emirates_id,
                'mobile' => $mobile,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'option' => $option,
                'options' => NewBornBabyPassport::when($emirates_id != '', function ($query) use ($emirates_id) {
                    return $query->where('emirates_id', $emirates_id);
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
