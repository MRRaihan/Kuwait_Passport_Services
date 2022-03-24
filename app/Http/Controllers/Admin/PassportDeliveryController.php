<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PassportDeliveryController extends Controller
{
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
            return view('Admin.passportDelivery.delivery',$data);
        }
        return redirect()->back();
    }
}
