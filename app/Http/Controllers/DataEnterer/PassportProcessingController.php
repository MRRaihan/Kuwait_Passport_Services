<?php

namespace App\Http\Controllers\DataEnterer;

use App\Http\Controllers\Controller;
use App\Models\LostPassport;
use App\Models\ManualPassport;
use App\Models\NewBornBabyPassport;
use App\Models\RenewPassport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PassportProcessingController extends Controller
{
    public function receivedFromBranchManager()
    {
        return $this->searchReceive('&&&&0');
    }

    public function searchReceive($data)
    {
        $civil_id = explode('&', $data)[0] ?? '';
        $mobile = explode('&', $data)[1] ?? '';
        $from_date = explode('&', $data)[2] ?? '';
        $to_date = explode('&', $data)[3] ?? '';
        $option = explode('&', $data)[4] ?? 0;

        $data = [
            'civil_id' => $civil_id,
            'mobile' => $mobile,
            'from_date' => $from_date,
            'to_date' => $to_date,
            'option' => $option,
            'options' => get_passport_model_name_by_option($option)::when($civil_id != '', function ($query) use ($civil_id) {
                return $query->where('civil_id', $civil_id);
            })->when($mobile != '', function ($query) use ($mobile) {
                return $query->where('bd_phone', $mobile);
            })->when($from_date != '' && $to_date != '', function ($query) use ($from_date, $to_date) {
                return $query->whereDate('created_at', '>=', $from_date)->whereDate('created_at', '<=', $to_date);
            })->where('bio_enrollment_id', null)
              ->where('de_id_for_bio', Auth::user()->id)
              ->orderBy('id', 'desc')
              ->get()
        ];
        return view('DataEnterer.passportProcessing.receive_from_branch_manager', $data);
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
                'message' => 'Bio Enrollment Id Added Successfully!'
            ]);
        }

        return response()->json([
            'type' => 'error',
            'message' => 'Something Went Wrong!!'
        ]);
    }
}
