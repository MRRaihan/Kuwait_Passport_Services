<?php

namespace App\Http\Controllers\AccountManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\RenewPassport;
use App\Models\ManualPassport;
use App\Models\LostPassport;
use App\Models\Other;
use App\Models\NewBornBabyPassport;
use Carbon\Carbon;

class AllPassportReportController extends Controller
{

    public function index(){
       
        return $this->show('0');
    }

    public function show($option){


         $branch = isset($option) ? $option : 0;

        //All type of total passort with branch
         $total_renew_passport = RenewPassport::when(isset($branch) && $branch > 0,function($query) use($branch){
                                                    return $query->where('branch_id',$branch);
                                                })
                                                ->count();
         $total_manual_passport = ManualPassport::when(isset($branch) && $branch > 0,function($query) use($branch){
                                                    return $query->where('branch_id',$branch);
                                                })
                                                ->count();
         $total_lost_passport = LostPassport::when(isset($branch) && $branch > 0,function($query) use($branch){
                                                return $query->where('branch_id',$branch);
                                            })
                                            ->count();
         $total_new_baby_passport = NewBornBabyPassport::when(isset($branch) && $branch > 0,function($query) use($branch){
                                                            return $query->where('branch_id',$branch);
                                                        })
                                                        ->count();
        // total  passport with brach
         $total_passport = $total_renew_passport+$total_manual_passport+$total_lost_passport+$total_new_baby_passport;

         // All type of daily passport with branch
         $daily_renew_passport = RenewPassport::when(isset($branch) && $branch > 0,function($query) use($branch){
                                                    return $query->where('branch_id',$branch);
                                                })
                                                ->whereDate('created_at', Carbon::today())
                                                ->count();

         $daily_manual_passport = ManualPassport::when(isset($branch) && $branch > 0,function($query) use($branch){
                                                    return $query->where('branch_id',$branch);
                                                })
                                                ->whereDate('created_at', Carbon::today())
                                                ->count();

         $daily_lost_passport= LostPassport::when(isset($branch) && $branch > 0,function($query) use($branch){
                                                    return $query->where('branch_id',$branch);
                                                })
                                                ->whereDate('created_at', Carbon::today())
                                                ->count();

         $daily_new_baby_passport = NewBornBabyPassport::when(isset($branch) && $branch > 0,function($query) use($branch){
                                                    return $query->where('branch_id',$branch);
                                                })
                                                ->whereDate('created_at', Carbon::today())
                                                ->count();

        // All type of Monthly passport with branch

         $monthly_renew_passport = RenewPassport::when(isset($branch) && $branch > 0,function($query) use($branch){
                                                     return $query->where('branch_id',$branch);
                                                })
                                                ->where('created_at', '>', Carbon::now()->startOfMonth())
                                                ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                ->count();
         $monthly_manual_passport = ManualPassport::when(isset($branch) && $branch > 0,function($query) use($branch){
                                                     return $query->where('branch_id',$branch);
                                                })
                                                ->where('created_at', '>', Carbon::now()->startOfMonth())
                                                ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                ->count();
         $monthly_lost_passport = LostPassport::when(isset($branch) && $branch > 0,function($query) use($branch){
                                                     return $query->where('branch_id',$branch);
                                                })
                                                ->where('created_at', '>', Carbon::now()->startOfMonth())
                                                ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                ->count();

         $monthly_new_baby_passport = NewBornBabyPassport::when(isset($branch) && $branch > 0,function($query) use($branch){
                                                            return $query->where('branch_id',$branch);
                                                        })
                                                        ->where('created_at', '>', Carbon::now()->startOfMonth())
                                                        ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                        ->count();

         // All type of total passport fee with branch
         $total_renew_passport_fee = RenewPassport::when(isset($branch) && $branch > 0,function($query) use($branch){
                                                        return $query->where('branch_id',$branch);
                                                    })
                                                    ->sum('passport_type_fees_total');
         $total_manual_passport_fee = ManualPassport::when(isset($branch) && $branch > 0,function($query) use($branch){
                                                        return $query->where('branch_id',$branch);
                                                    })
                                                    ->sum('passport_type_fees_total');

         $total_lost_passport_fee = LostPassport::when(isset($branch) && $branch > 0,function($query) use($branch){
                                                        return $query->where('branch_id',$branch);
                                                    })
                                                    ->sum('passport_type_fees_total');

         $total_new_baby_passport_fee = NewBornBabyPassport::when(isset($branch) && $branch > 0,function($query) use($branch){
                                                return $query->where('branch_id',$branch);
                                            })
                                            ->sum('passport_type_fees_total');

            // Total Passport Fee with branch
         $total_passport_fee = $total_renew_passport_fee+$total_manual_passport_fee+$total_lost_passport_fee+$total_new_baby_passport_fee;                         
        

         // All type of daily passport fee with branch
         $daily_renew_passport_fee = RenewPassport::when(isset($branch) && $branch > 0,function($query) use($branch){
                                                        return $query->where('branch_id',$branch);
                                                    })
                                                    ->whereDate('created_at', Carbon::today())
                                                    ->sum('passport_type_fees_total');

         $daily_manual_passport_fee = ManualPassport::when(isset($branch) && $branch > 0,function($query) use($branch){
                                                        return $query->where('branch_id',$branch);
                                                    })
                                                    ->whereDate('created_at', Carbon::today())
                                                    ->sum('passport_type_fees_total');

         $daily_lost_passport_fee = LostPassport::when(isset($branch) && $branch > 0,function($query) use($branch){
                                                    return $query->where('branch_id',$branch);
                                                })
                                                ->whereDate('created_at', Carbon::today())
                                                ->sum('passport_type_fees_total');

         $daily_new_baby_passport_fee = NewBornBabyPassport::when(isset($branch) && $branch > 0,function($query) use($branch){
                                                            return $query->where('branch_id',$branch);
                                                        })
                                                        ->whereDate('created_at', Carbon::today())
                                                        ->sum('passport_type_fees_total');
                                                    
        // All type of monthly passport fee with branch
         $monthly_renew_passport_fee = RenewPassport::when(isset($branch) && $branch > 0,function($query) use($branch){
                                                        return $query->where('branch_id',$branch);
                                                    })
                                                    ->where('created_at', '>', Carbon::now()->startOfMonth())
                                                    ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                    ->sum('passport_type_fees_total');

         $monthly_manual_passport_fee = ManualPassport::when(isset($branch) && $branch > 0,function($query) use($branch){
                                                        return $query->where('branch_id',$branch);
                                                    })
                                                    ->where('created_at', '>', Carbon::now()->startOfMonth())
                                                    ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                    ->sum('passport_type_fees_total');

         $monthly_lost_passport_fee = LostPassport::when(isset($branch) && $branch > 0,function($query) use($branch){
                                                        return $query->where('branch_id',$branch);
                                                    })
                                                    ->where('created_at', '>', Carbon::now()->startOfMonth())
                                                    ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                    ->sum('passport_type_fees_total');

         $monthly_new_baby_passport_fee = NewBornBabyPassport::when(isset($branch) && $branch > 0,function($query) use($branch){
                                                                return $query->where('branch_id',$branch);
                                                            })
                                                            ->where('created_at', '>', Carbon::now()->startOfMonth())
                                                            ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                            ->sum('passport_type_fees_total');


         $data = [
            'branches' => Branch::orderBy('name','asc')->where('status',1)->get(),
            'branch_id' => $branch,
            'option' => 0, 

            'total_passport' => $total_passport,

            'total_renew_passport' => $total_renew_passport,
            'total_manual_passport' => $total_manual_passport,
            'total_lost_passport' => $total_lost_passport,
            'total_new_baby_passport' => $total_new_baby_passport,

            'daily_renew_passport' => $daily_renew_passport,
            'daily_manual_passport' => $daily_manual_passport,
            'daily_lost_passport' => $daily_lost_passport,
            'daily_new_baby_passport' => $daily_new_baby_passport,

            'monthly_renew_passport' => $monthly_renew_passport,
            'monthly_manual_passport' => $monthly_manual_passport,
            'monthly_lost_passport' => $monthly_lost_passport,
            'monthly_new_baby_passport' => $monthly_new_baby_passport,

            'total_renew_passport_fee' => $total_renew_passport_fee,
            'total_manual_passport_fee' => $total_manual_passport_fee,
            'total_lost_passport_fee' => $total_lost_passport_fee,
            'total_new_baby_passport_fee' => $total_new_baby_passport_fee,


            'total_passport_fee' => $total_passport_fee,

            'monthly_renew_passport_fee' => $monthly_renew_passport_fee,
            'monthly_manual_passport_fee' => $monthly_manual_passport_fee,
            'monthly_lost_passport_fee' => $monthly_lost_passport_fee,
            'monthly_new_baby_passport_fee' => $monthly_new_baby_passport_fee,

            'daily_renew_passport_fee' => $daily_renew_passport_fee,
            'daily_manual_passport_fee' => $daily_manual_passport_fee,
            'daily_lost_passport_fee' => $daily_lost_passport_fee,
            'daily_new_baby_passport_fee' => $daily_new_baby_passport_fee,

        ];
        return view('AccountManager.report.all_passport_report',$data);
    }

    public function getReport($data){

        $from_date = explode('&', $data)[0] ? explode('&', $data)[0] : '';
        $to_date = explode('&', $data)[1] ? explode('&', $data)[1] : '';
        $branch_id = explode('&', $data)[2] ? explode('&', $data)[2] : 0;
        $option = explode('&', $data)[3];


        $lost = LostPassport::when($branch_id > 0,function($query) use($branch_id){
                                return $query->where('branch_id',$branch_id);
                                })
                                ->when($from_date != '' && $to_date != '',function($query) use($from_date,$to_date){
                                    return $query->whereDate('created_at','>=',$from_date)->whereDate('created_at','<=',$to_date);
                                })
                                ->orderBy('id','desc')
                                ->get();

        $manual = ManualPassport::when($branch_id > 0,function($query) use($branch_id){
                                        return $query->where('branch_id',$branch_id);
                                        })
                                        ->when($from_date != '' && $to_date != '',function($query) use($from_date,$to_date){
                                            return $query->whereDate('created_at','>=',$from_date)->whereDate('created_at','<=',$to_date);
                                        })
                                    ->orderBy('id','desc')
                                    ->get();

        $renew = RenewPassport::when($branch_id > 0,function($query) use($branch_id){
                                    return $query->where('branch_id',$branch_id);
                                    })
                                ->when($from_date != '' && $to_date != '',function($query) use($from_date,$to_date){
                                    return $query->whereDate('created_at','>=',$from_date)->whereDate('created_at','<=',$to_date);
                                })
                                ->orderBy('id','desc')
                                ->get();

   
                        
       $new_born_baby = NewBornBabyPassport::when($branch_id > 0,function($query) use($branch_id){
                                            return $query->where('branch_id',$branch_id);
                                        })
                                        ->when($from_date != '' && $to_date != '',function($query) use($from_date,$to_date){
                                            return $query->whereDate('created_at','>=',$from_date)->whereDate('created_at','<=',$to_date);
                                        })
                                        ->orderBy('id','desc')
                                        ->get();

       // Here Option Means Passport Type , $option == -1 means All Type of Passport $option == 0 means Lost Passport, 1 means Manual, 2 Renew, 3 Other.

        if ($option == -1) {
            $data = [
            'passports' => $renew->concat($manual)->concat($lost)->concat($new_born_baby),
             'from_date' => $from_date,
             'to_date' => $to_date,
             'branch_id' => $branch_id,
             'option' => $option,
             'onload' => false,
             'total_renew' => $renew->count(),
             'total_manual' => $manual->count(),
             'total_lost' => $lost->count(),
             'total_new_born_baby' => $new_born_baby->count(),
           ];
           return view('AccountManager.report.search_all_passport_report',$data);
        }

        if ($option == 0) {
            $data = [
            'passports' => $renew,
            'from_date' => $from_date,
            'to_date' => $to_date,
            'branch_id' => $branch_id,
            'option' => $option,
            'onload' => false,
           ];

            return view('AccountManager.report.search_all_passport_report',$data);
        }
        
        if ($option == 1) {
            $data = [
                'passports' =>$manual, 
                'from_date' => $from_date,
                'to_date' => $to_date,
                'branch_id' => $branch_id,
                'option' => $option,
                'onload' => false,
            ];
            return view('AccountManager.report.search_all_passport_report',$data);
        }

      if ($option == 2) {
        $data = [
            'passports' => $lost,
            'from_date' => $from_date,
            'to_date' => $to_date,
            'branch_id' => $branch_id,
            'option' => $option,
            'onload' => false,
        ];
        return view('AccountManager.report.search_all_passport_report',$data);
      }

        if ($option == 3) {
            $data = [
                'passports' => $new_born_baby,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'branch_id' => $branch_id,
                'option' => $option,
                'onload' => false,
            ];
            return view('AccountManager.report.search_all_passport_report',$data);
        }

    }


    public function excelExport($data)
    {
        $from_date = explode('&', $data)[0] ? explode('&', $data)[0] : '';
        $to_date = explode('&', $data)[1] ? explode('&', $data)[1] : '';
        $branch_id = explode('&', $data)[2] ? explode('&', $data)[2] : 0;
        $option = explode('&', $data)[3];


        $lost = LostPassport::when($branch_id > 0,function($query) use($branch_id){
                                return $query->where('branch_id',$branch_id);
                                })
                                ->when($from_date != '' && $to_date != '',function($query) use($from_date,$to_date){
                                    return $query->whereDate('created_at','>=',$from_date)->whereDate('created_at','<=',$to_date);
                                })
                                ->orderBy('id','desc')
                                ->get();

        $manual = ManualPassport::when($branch_id > 0,function($query) use($branch_id){
                                        return $query->where('branch_id',$branch_id);
                                        })
                                        ->when($from_date != '' && $to_date != '',function($query) use($from_date,$to_date){
                                            return $query->whereDate('created_at','>=',$from_date)->whereDate('created_at','<=',$to_date);
                                        })
                                    ->orderBy('id','desc')
                                    ->get();

        $renew = RenewPassport::when($branch_id > 0,function($query) use($branch_id){
                                    return $query->where('branch_id',$branch_id);
                                    })
                                ->when($from_date != '' && $to_date != '',function($query) use($from_date,$to_date){
                                    return $query->whereDate('created_at','>=',$from_date)->whereDate('created_at','<=',$to_date);
                                })
                                ->orderBy('id','desc')
                                ->get();

   
                        
       $new_born_baby = NewBornBabyPassport::when($branch_id > 0,function($query) use($branch_id){
                                            return $query->where('branch_id',$branch_id);
                                        })
                                        ->when($from_date != '' && $to_date != '',function($query) use($from_date,$to_date){
                                            return $query->whereDate('created_at','>=',$from_date)->whereDate('created_at','<=',$to_date);
                                        })
                                        ->orderBy('id','desc')
                                        ->get();

       // Here Option Means Passport Type , $option == -1 means All Type of Passport $option == 0 means Lost Passport, 1 means Manual, 2 Renew, 3 Other.

        if ($option == -1) {
            $data = [
            'passports' => $renew->concat($manual)->concat($lost)->concat($new_born_baby),
             'from_date' => $from_date,
             'to_date' => $to_date,
             'branch_id' => $branch_id,
             'option' => $option,
             'onload' => false,
             'total_renew' => $renew->count(),
             'total_manual' => $manual->count(),
             'total_lost' => $lost->count(),
             'total_new_born_baby' => $new_born_baby->count(),
           ];
       
           return downloadExcel('AccountManager.report.all_report_excel',$data,'all_passport','xlsx');
        }

        if ($option == 0) {
            $data = [
            'passports' => $renew,
            'from_date' => $from_date,
            'to_date' => $to_date,
            'branch_id' => $branch_id,
            'option' => $option,
            'onload' => false,
           ];

           return downloadExcel('AccountManager.report.all_report_excel',$data,'renew_passport','xlsx');
        }
        
        if ($option == 1) {
            $data = [
                'passports' =>$manual, 
                'from_date' => $from_date,
                'to_date' => $to_date,
                'branch_id' => $branch_id,
                'option' => $option,
                'onload' => false,
            ];
            return downloadExcel('AccountManager.report.all_report_excel',$data,'manual_passport','xlsx');
        }

      if ($option == 2) {
        $data = [
            'passports' => $lost,
            'from_date' => $from_date,
            'to_date' => $to_date,
            'branch_id' => $branch_id,
            'option' => $option,
            'onload' => false,
        ];
        return downloadExcel('AccountManager.report.all_report_excel',$data,'lost_passport','xlsx');
      }

        if ($option == 3) {
            $data = [
                'passports' => $new_born_baby,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'branch_id' => $branch_id,
                'option' => $option,
                'onload' => false,
            ];
            return downloadExcel('AccountManager.report.all_report_excel',$data,'new_born_baby_passport','xlsx');
        }

    }

}
