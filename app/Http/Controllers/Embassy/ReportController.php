<?php

namespace App\Http\Controllers\Embassy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\RenewPassport;
use App\Models\ManualPassport;
use App\Models\LostPassport;
use App\Models\Other;
use App\Models\NewBornBabyPassport;
use Carbon\Carbon;
use Auth;

class ReportController extends Controller
{
    public function deliveryReport()
    {
        $branch = 0;

         //All type of total passort with branch
         $total_renew_passport = RenewPassport::where('embassy_status',3)->count(); 

         $total_manual_passport = ManualPassport::where('embassy_status',3)->count();
 
         $total_lost_passport = LostPassport::where('embassy_status',3)->count();
 
         $total_new_baby_passport = NewBornBabyPassport::where('embassy_status',3)->count();

         // total  passport with brach
         $total_passport = $total_renew_passport+$total_manual_passport+$total_lost_passport+$total_new_baby_passport;
 
          // All type of daily passport with branch
          $daily_renew_passport = RenewPassport::whereDate('created_at', Carbon::today())
                                                 ->where('embassy_status',3)
                                                 ->count();
 
          $daily_manual_passport = ManualPassport::whereDate('created_at', Carbon::today())
                                                 ->where('embassy_status',3)
                                                 ->count();
 
          $daily_lost_passport= LostPassport::whereDate('created_at', Carbon::today())
                                                 ->where('embassy_status',3)
                                                 ->count();
 
          $daily_new_baby_passport = NewBornBabyPassport::whereDate('created_at', Carbon::today())
                                                 ->where('embassy_status',3)
                                                 ->count();
 
         // All type of Monthly passport with branch
          $monthly_renew_passport = RenewPassport::where('created_at', '>', Carbon::now()->startOfMonth())
                                                 ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                 ->where('embassy_status',3)
                                                 ->count();

          $monthly_manual_passport = ManualPassport::where('created_at', '>', Carbon::now()->startOfMonth())
                                                 ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                 ->where('embassy_status',3)
                                                 ->count();

          $monthly_lost_passport = LostPassport::where('created_at', '>', Carbon::now()->startOfMonth())
                                                 ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                 ->where('embassy_status',3)
                                                 ->count();
 
          $monthly_new_baby_passport = NewBornBabyPassport::where('created_at', '>', Carbon::now()->startOfMonth())
                                                 ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                 ->where('embassy_status',3)
                                                 ->count();
 
          // All type of total passport fee with branch
          $total_renew_passport_fee = RenewPassport::where('embassy_status',3)
                                                     ->sum('passport_type_fees_total');

          $total_manual_passport_fee = ManualPassport::where('embassy_status',3)
                                                     ->sum('passport_type_fees_total');
 
          $total_lost_passport_fee = LostPassport::where('embassy_status',3)
                                                 ->sum('passport_type_fees_total');
 
          $total_new_baby_passport_fee = NewBornBabyPassport::where('embassy_status',3)
                                                             ->sum('passport_type_fees_total');
 
             // Total Passport Fee with branch
          $total_passport_fee = $total_renew_passport_fee+$total_manual_passport_fee+$total_lost_passport_fee+$total_new_baby_passport_fee;                                    
         
 
          // All type of daily passport fee with branch
          $daily_renew_passport_fee = RenewPassport::whereDate('created_at', Carbon::today())
                                                     ->where('embassy_status',3)
                                                     ->sum('passport_type_fees_total');
 
          $daily_manual_passport_fee = ManualPassport::whereDate('created_at', Carbon::today())
                                                     ->where('embassy_status',3)
                                                     ->sum('passport_type_fees_total');
 
          $daily_lost_passport_fee = LostPassport::whereDate('created_at', Carbon::today())
                                                     ->where('embassy_status',3)
                                                     ->sum('passport_type_fees_total');
 
          $daily_new_baby_passport_fee = NewBornBabyPassport::whereDate('created_at', Carbon::today())
                                                     ->where('embassy_status',3)
                                                     ->sum('passport_type_fees_total');
                                                     
         // All type of monthly passport fee with branch
          $monthly_renew_passport_fee = RenewPassport::where('created_at', '>', Carbon::now()->startOfMonth())
                                                     ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                     ->where('embassy_status',3)
                                                     ->sum('passport_type_fees_total');
 
          $monthly_manual_passport_fee = ManualPassport::where('created_at', '>', Carbon::now()->startOfMonth())
                                                     ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                     ->where('embassy_status',3)
                                                     ->sum('passport_type_fees_total');
 
          $monthly_lost_passport_fee = LostPassport::where('created_at', '>', Carbon::now()->startOfMonth())
                                                     ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                     ->where('embassy_status',3)
                                                     ->sum('passport_type_fees_total');
 
          $monthly_new_baby_passport_fee = NewBornBabyPassport::where('created_at', '>', Carbon::now()->startOfMonth())
                                                             ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                             ->where('embassy_status',3)
                                                             ->sum('passport_type_fees_total');
 
         $data = [
             'branch_id' => Auth::user()->branch_id,
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

        return view('Embassy.report.delivery',$data);

    }


    public function getDeliveryReport($data)
    {
        $from_date = explode('&', $data)[0] ? explode('&', $data)[0] : '';
        $to_date = explode('&', $data)[1] ? explode('&', $data)[1] : '';
        $option = explode('&', $data)[2];

        if (isset(explode('&', $data)[3] )) {
             $delivery_to_user = explode('&', $data)[3] ? explode('&', $data)[3] : false;
        }

        $lost = LostPassport::when($from_date != '' && $to_date != '',function($query) use($from_date,$to_date){
                                    return $query->whereDate('updated_at','>=',$from_date)->whereDate('updated_at','<=',$to_date);
                                })
                                ->where('embassy_status',3)
                                ->orderBy('id','desc')
                                ->get();

        $manual = ManualPassport::when($from_date != '' && $to_date != '',function($query) use($from_date,$to_date){
                                        return $query->whereDate('updated_at','>=',$from_date)->whereDate('updated_at','<=',$to_date);
                                    })
                                    ->where('embassy_status',3)
                                    ->orderBy('id','desc')
                                    ->get();

        $renew = RenewPassport::when($from_date != '' && $to_date != '',function($query) use($from_date,$to_date){
                                    return $query->whereDate('updated_at','>=',$from_date)->whereDate('updated_at','<=',$to_date);
                                })
                                ->where('embassy_status',3)
                                ->orderBy('id','desc')
                                ->get();

       $new_born_baby = NewBornBabyPassport::when($from_date != '' && $to_date != '',function($query) use($from_date,$to_date){
                            return $query->whereDate('updated_at','>=',$from_date)->whereDate('updated_at','<=',$to_date);
                        })
                        ->where('embassy_status',3)
                        ->orderBy('id','desc')
                        ->get();

        //    return $lost->concat($manual)->concat($renew)->concat($other);

            if ($option == -1) {
                $data = [
                    'passports' => $renew->concat($manual)->concat($lost)->concat($new_born_baby),
                    'from_date' => $from_date,
                    'to_date' => $to_date,
                    'branch_id' => Auth::user()->branch_id,
                    'option' => $option,
                    'onload' => false,
                    'delivery_to_user' => true,
                    'total_renew' => $renew->count(),
                    'total_manual' => $manual->count(),
                    'total_lost' => $lost->count(),
                    'total_new_born_baby' => $new_born_baby->count(),
                ];
                if (isset($delivery_to_user) && $delivery_to_user == true) {
                return downloadExcel('Embassy.report.all_report_excel',$data,'delivery_all_passport','xlsx');
            }else{
                return view('Embassy.report.report',$data);
            }
            }

            if ($option == 0) {
                $data = [
                    'passports' => $renew,
                    'from_date' => $from_date,
                    'to_date' => $to_date,
                    'branch_id' => Auth::user()->branch_id,
                    'option' => $option,
                    'onload' => false,
                    'delivery_to_user' => true,
                ];

                if (isset($delivery_to_user) && $delivery_to_user == true) {
                    return downloadExcel('Embassy.report.all_report_excel',$data,'delivery_renew_passport','xlsx');
                }
                return view('Embassy.report.report',$data);
                
            }
        
            if ($option == 1) {
                 $data = [
                    'passports' =>$manual, 
                    'from_date' => $from_date,
                    'to_date' => $to_date,
                    'branch_id' => Auth::user()->branch_id,
                    'option' => $option,
                    'onload' => false,
                    'delivery_to_user' => true,
                ];
                if (isset($delivery_to_user) && $delivery_to_user == true) {
                    
                    return downloadExcel('Embassy.report.all_report_excel',$data,'delivery_manual_passport','xlsx');
                }

                return view('Embassy.report.report',$data);
              
            }

        if ($option == 2) {
            $data = [
                'passports' =>$lost,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'branch_id' => Auth::user()->branch_id,
                'option' => $option,
                'onload' => false,
                'delivery_to_user' => true,
            ];
            if (isset($delivery_to_user) && $delivery_to_user == true) {
                return downloadExcel('Embassy.report.all_report_excel',$data,'delivery_lost_passport','xlsx');
            }else{
                return view('Embassy.report.report',$data);
            }
        }


        if ($option == 3) {
            $data = [
                'passports' => $new_born_baby,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'branch_id' => Auth::user()->branch_id,
                'option' => $option,
                'onload' => false,
                'delivery_to_user' => true,
            ];
            if (isset($delivery_to_user) && $delivery_to_user == true) {
                return downloadExcel('Embassy.report.all_report_excel',$data,'delivery_new_born_baby_passport','xlsx');
            }else{
                return view('Embassy.report.report',$data);
            }
        }
    }



     


}
