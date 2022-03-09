<?php

namespace App\Http\Controllers\CallCenter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\LostPassport;
use App\Models\Profession;
use App\Models\RenewPassport;
use App\Models\ManualPassport;
use App\Models\Other;
use App\Models\NewBornBabyPassport;
use Illuminate\Support\Facades\Auth;


class ReportController extends Controller
{
    public function index(){

        $renew_received = RenewPassport::where('remarks_by',Auth::user()->id)->where('remarks',0)->count();
        $renew_not_received = RenewPassport::where('remarks_by',Auth::user()->id)->where('remarks',1)->count();
        $renew_call_busy = RenewPassport::where('remarks_by',Auth::user()->id)->where('remarks',2)->count();
        $renew_phone_off = RenewPassport::where('remarks_by',Auth::user()->id)->where('remarks',3)->count();
        $renew_other = RenewPassport::where('remarks_by',Auth::user()->id)->where('remarks',4)->count();

        $manual_received = ManualPassport::where('remarks_by',Auth::user()->id)->where('remarks',0)->count();
        $manual_not_received = ManualPassport::where('remarks_by',Auth::user()->id)->where('remarks',1)->count();
        $manual_call_busy = ManualPassport::where('remarks_by',Auth::user()->id)->where('remarks',2)->count();
        $manual_phone_off = ManualPassport::where('remarks_by',Auth::user()->id)->where('remarks',3)->count();
        $manual_other = ManualPassport::where('remarks_by',Auth::user()->id)->where('remarks',4)->count();

        $lost_received = LostPassport::where('remarks_by',Auth::user()->id)->where('remarks',0)->count();
        $lost_not_received = LostPassport::where('remarks_by',Auth::user()->id)->where('remarks',1)->count();
        $lost_call_busy = LostPassport::where('remarks_by',Auth::user()->id)->where('remarks',2)->count();
        $lost_phone_off = LostPassport::where('remarks_by',Auth::user()->id)->where('remarks',3)->count();
        $lost_other = LostPassport::where('remarks_by',Auth::user()->id)->where('remarks',4)->count();

        $new_baby_received = NewBornBabyPassport::where('remarks_by',Auth::user()->id)->where('remarks',0)->count();
        $new_baby_not_received = NewBornBabyPassport::where('remarks_by',Auth::user()->id)->where('remarks',1)->count();
        $new_baby_call_busy = NewBornBabyPassport::where('remarks_by',Auth::user()->id)->where('remarks',2)->count();
        $new_baby_phone_off = NewBornBabyPassport::where('remarks_by',Auth::user()->id)->where('remarks',3)->count();
        $new_baby_other = NewBornBabyPassport::where('remarks_by',Auth::user()->id)->where('remarks',4)->count();

        $data = [
            'branches' => Branch::where('status',1)->orderBy('name','asc')->get(), 
            'excel_export' => true,
            'branch_id' => 0,

            'total_received' => $renew_received + $manual_received + $lost_received + $new_baby_received,
            'total_not_received' => $renew_not_received + $manual_not_received + $lost_not_received + $new_baby_not_received,
            'total_call_busy' => $renew_call_busy + $manual_call_busy + $lost_call_busy + $new_baby_call_busy,
            'total_phone_off' => $renew_phone_off + $manual_phone_off + $lost_phone_off + $new_baby_phone_off,
            'total_other' => $renew_other + $manual_other + $lost_other + $new_baby_other,
        ];
        return view('CallCenter.report.index',$data);
    }

    public function getReport($data)
    {
        $from_date = explode('&', $data)[0] ? explode('&', $data)[0] : '';
        $to_date = explode('&', $data)[1] ? explode('&', $data)[1] : '';
        $branch_id = explode('&', $data)[2] ? explode('&', $data)[2] : 0;
        $option = explode('&', $data)[3];

        if (isset(explode('&', $data)[4])) {
            $excel_export = explode('&', $data)[4] ? explode('&', $data)[4] : 0;
        }
        



        $lost = LostPassport::when($branch_id > 0,function($query) use($branch_id){
                                return $query->where('branch_id',$branch_id);
                                })
                                ->when($from_date != '' && $to_date != '',function($query) use($from_date,$to_date){
                                    return $query->whereDate('updated_at','>=',$from_date)->whereDate('updated_at','<=',$to_date);
                                })
                                ->where('remarks_by',Auth::user()->id)
                                ->orderBy('id','desc')
                                ->get();

        $manual = ManualPassport::when($branch_id > 0,function($query) use($branch_id){
                                        return $query->where('branch_id',$branch_id);
                                        })
                                        ->when($from_date != '' && $to_date != '',function($query) use($from_date,$to_date){
                                            return $query->whereDate('updated_at','>=',$from_date)->whereDate('updated_at','<=',$to_date);
                                        })
                                    ->where('remarks_by',Auth::user()->id)
                                    ->orderBy('id','desc')
                                    ->get();

        $renew = RenewPassport::when($branch_id > 0,function($query) use($branch_id){
                                    return $query->where('branch_id',$branch_id);
                                    })
                                ->when($from_date != '' && $to_date != '',function($query) use($from_date,$to_date){
                                    return $query->whereDate('updated_at','>=',$from_date)->whereDate('updated_at','<=',$to_date);
                                })
                                ->where('remarks_by',Auth::user()->id)
                                ->orderBy('id','desc')
                                ->get();

      
                        
       $new_born_baby = NewBornBabyPassport::when($branch_id > 0,function($query) use($branch_id){
                                            return $query->where('branch_id',$branch_id);
                                        })
                                        ->when($from_date != '' && $to_date != '',function($query) use($from_date,$to_date){
                                            return $query->whereDate('updated_at','>=',$from_date)->whereDate('updated_at','<=',$to_date);
                                        })
                                        ->where('remarks_by',Auth::user()->id)
                                        ->orderBy('id','desc')
                                        ->get();

       // Here Option Means Passport Type , $option == -1 means All Type of Passport $option == 0 means Lost Passport, 1 means Manual, 2 Renew, 3 New Born Baby.

        if ($option == -1) {
            $data = [
             'passports' => $renew->concat($manual)->concat($lost)->concat($new_born_baby),
             'from_date' => $from_date,
             'to_date' => $to_date,
             'branch_id' => $branch_id,
             'option' => $option,
             'onload' => false,
             'excel_export' => true,
             'total_renew' => $renew->count(),
             'total_manual' => $manual->count(),
             'total_lost' => $lost->count(),
             'total_new_born_baby' => $new_born_baby->count(),
           ];
           if (isset($excel_export) && $excel_export == true) {
                return downloadExcel('CallCenter.report.all_report_excel',$data,'all_passport','xlsx');
           }
           return view('CallCenter.report.report',$data);
        }

        if ($option == 0) {
            $data = [
            'passports' => $renew,
            'from_date' => $from_date,
            'to_date' => $to_date,
            'branch_id' => $branch_id,
            'option' => $option,
            'onload' => false,
            'excel_export' => true,
           ];

           if (isset($excel_export) && $excel_export == true) {
                return downloadExcel('CallCenter.report.all_report_excel',$data,'all_passport','xlsx');
            }
            return view('CallCenter.report.report',$data);
        }
        
        if ($option == 1) {
            $data = [
                'passports' =>$manual, 
                'from_date' => $from_date,
                'to_date' => $to_date,
                'branch_id' => $branch_id,
                'option' => $option,
                'onload' => false,
                'excel_export' => true,
            ];
            if (isset($excel_export) && $excel_export == true) {
                return downloadExcel('CallCenter.report.all_report_excel',$data,'all_passport','xlsx');
            }
            return view('CallCenter.report.report',$data);
        }

        if ($option == 2) {
            $data = [
                'passports' => $lost,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'branch_id' => $branch_id,
                'option' => $option,
                'onload' => false,
                'excel_export' => true,
            ];
            if (isset($excel_export) && $excel_export == true) {
                return downloadExcel('CallCenter.report.all_report_excel',$data,'all_passport','xlsx');
            }
            return view('CallCenter.report.report',$data);
        }

        if ($option == 3) {
            $data = [
                'passports' => $new_born_baby,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'branch_id' => $branch_id,
                'option' => $option,
                'onload' => false,
                'excel_export' => true,
            ];
            if (isset($excel_export) && $excel_export == true) {
                return downloadExcel('CallCenter.report.all_report_excel',$data,'all_passport','xlsx');
            }
            return view('CallCenter.report.report',$data);
        }
    }
}
