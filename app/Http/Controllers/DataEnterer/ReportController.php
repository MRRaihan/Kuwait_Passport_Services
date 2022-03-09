<?php

namespace App\Http\Controllers\DataEnterer;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\LostPassport;
use App\Models\ManualPassport;
use App\Models\Other;
use App\Models\RenewPassport;
use App\Models\NewBornBabyPassport;
use App\Models\PremierService;
use App\Models\ExpressService;
use App\Models\LegalComplaintsService;
use App\Models\ImmigrationGovementService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(){

        return $this->show('0');
    }

    public function show($option){


        $branch = isset($option) ? $option : 0;

        //All type of total passort with branch
        $total_renew_passport = RenewPassport::where('user_creator_id',auth()->user()->id)->count();
        $total_manual_passport = ManualPassport::where('user_creator_id',auth()->user()->id)->count();
        $total_lost_passport = LostPassport::where('user_creator_id',auth()->user()->id)->count();
        $totalOther = Other::where('creator_id',auth()->user()->id)->count();
        $total_new_baby_passport = NewBornBabyPassport::where('user_creator_id',auth()->user()->id)->count();

        //total other services

        $totalPremierService = PremierService::where('creator_id', Auth()->user()->id)->count();
        $totalExpressService = ExpressService::where('creator_id', Auth()->user()->id)->count();
        $totalLegalComplaintsService= LegalComplaintsService::where('creator_id', Auth()->user()->id)->count();
        $totalImmigrationGovementService= ImmigrationGovementService::where('creator_id', Auth()->user()->id)->count();

        // total other services
      	$totalOtherServices = $totalPremierService + $totalExpressService + $totalLegalComplaintsService + $totalImmigrationGovementService + $totalOther;

        // total  passport with branch
        $total_passport = $total_renew_passport+$total_manual_passport+$total_lost_passport+$total_new_baby_passport;

        // All type of daily passport with branch
        $daily_renew_passport = RenewPassport::where('user_creator_id',auth()->user()->id)
                                            ->whereDate('created_at', Carbon::today())
                                            ->count();

        $daily_manual_passport = ManualPassport::where('user_creator_id',auth()->user()->id)
                                                ->whereDate('created_at', Carbon::today())
                                                ->count();
                                                
        $daily_lost_passport= LostPassport::where('user_creator_id',auth()->user()->id)
                                            ->whereDate('created_at', Carbon::today())
                                            ->count();

        $dailyOther = Other::where('creator_id',auth()->user()->id)
                                        ->whereDate('created_at', Carbon::today())
                                        ->count();

        $daily_new_baby_passport = NewBornBabyPassport::where('user_creator_id',auth()->user()->id)
                                        ->whereDate('created_at', Carbon::today())
                                        ->count();
        //daily other services
        $dailyPremierService = PremierService::where('creator_id', Auth()->user()->id)->whereDate('created_at', Carbon::today())->count();
        $dailyExpressService = ExpressService::where('creator_id', Auth()->user()->id)->whereDate('created_at', Carbon::today())->count();
        $dailyLegalComplaintsService = LegalComplaintsService::where('creator_id', Auth()->user()->id)->whereDate('created_at', Carbon::today())->count();
        $dailyImmigrationGovementService = ImmigrationGovementService::where('creator_id', Auth()->user()->id)->whereDate('created_at', Carbon::today())->count();

        // All type of Monthly passport with branch

        $monthly_renew_passport = RenewPassport::where('user_creator_id',auth()->user()->id)
                                                ->where('created_at', '>', Carbon::now()->startOfMonth())
                                                ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                ->count();

        $monthly_manual_passport = ManualPassport::where('user_creator_id',auth()->user()->id)
                                                ->where('created_at', '>', Carbon::now()->startOfMonth())
                                                ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                ->count();

        $monthly_lost_passport = LostPassport::where('user_creator_id',auth()->user()->id)
                                            ->where('created_at', '>', Carbon::now()->startOfMonth())
                                            ->where('created_at', '<', Carbon::now()->endOfMonth())
                                            ->count();

        $monthlyOther = Other::where('creator_id',auth()->user()->id)
                                        ->where('created_at', '>', Carbon::now()->startOfMonth())
                                        ->where('created_at', '<', Carbon::now()->endOfMonth())
                                        ->count();
        $monthly_new_baby_passport = NewBornBabyPassport::where('user_creator_id',auth()->user()->id)
                                                        ->where('created_at', '>', Carbon::now()->startOfMonth())
                                                        ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                        ->count();
        //monthly others services
        $monthlyPremierService= PremierService::where('creator_id', Auth()->user()->id)->where('created_at', '>', Carbon::now()->startOfMonth()) ->where('created_at', '<', Carbon::now()->endOfMonth()) ->count();
        $monthlyExpressService= ExpressService::where('creator_id', Auth()->user()->id)->where('created_at', '>', Carbon::now()->startOfMonth()) ->where('created_at', '<', Carbon::now()->endOfMonth()) ->count();
        $monthlyLegalComplaintsService = LegalComplaintsService::where('creator_id', Auth()->user()->id)->where('created_at', '>', Carbon::now()->startOfMonth()) ->where('created_at', '<', Carbon::now()->endOfMonth()) ->count();
        $monthlyImmigrationGovementService = ImmigrationGovementService::where('creator_id', Auth()->user()->id)->where('created_at', '>', Carbon::now()->startOfMonth()) ->where('created_at', '<', Carbon::now()->endOfMonth()) ->count();
    

        // All type of total passport fee with branch
        $total_renew_passport_fee = RenewPassport::where('user_creator_id',auth()->user()->id)->sum('passport_type_fees_total');

        $total_manual_passport_fee = ManualPassport::where('user_creator_id',auth()->user()->id)->sum('passport_type_fees_total');

        $total_lost_passport_fee = LostPassport::where('user_creator_id',auth()->user()->id)->sum('passport_type_fees_total');

        $totalOtherFee = Other::where('creator_id',auth()->user()->id)->sum('fee');

        $total_new_baby_passport_fee = NewBornBabyPassport::where('user_creator_id',auth()->user()->id)->sum('passport_type_fees_total');

        // Total Passport Fee with branch
        $total_passport_fee = $total_renew_passport_fee+$total_manual_passport_fee+$total_lost_passport_fee +$totalOtherFee;

        // <=============Total other services fee==================>//

        //premier services fee
        $totalPremierServiceFee = PremierService::where('creator_id', Auth()->user()->id)->sum('total_fee');
        $monthlyPremierServiceFee = PremierService::where('creator_id', Auth()->user()->id)->where('created_at', '>', Carbon::now()->startOfMonth())
                                    ->where('created_at', '<', Carbon::now()->endOfMonth())
                                    ->sum('total_fee');
        $dailyPremierServiceFee = PremierService::where('creator_id', Auth()->user()->id)->whereDate('created_at', Carbon::today())->sum('total_fee');

        //express services fee
        $totalExpressServiceFee = ExpressService::where('creator_id', Auth()->user()->id)->sum('total_fee');
        $monthlyExpressServiceFee = ExpressService::where('creator_id', Auth()->user()->id)->where('created_at', '>', Carbon::now()->startOfMonth())
                                    ->where('created_at', '<', Carbon::now()->endOfMonth())
                                    ->sum('total_fee');
        $dailyExpressServiceFee= ExpressService::where('creator_id', Auth()->user()->id)->whereDate('created_at', Carbon::today())->sum('total_fee');

           // Total Legal Complaints Service fee
        $totalLegalComplaintsServiceFee = LegalComplaintsService::where('creator_id', Auth()->user()->id)->sum('total_fee');
        $monthlyLegalComplaintsServiceFee = LegalComplaintsService::where('creator_id', Auth()->user()->id)->where('created_at', '>', Carbon::now()->startOfMonth())
                                        ->where('created_at', '<', Carbon::now()->endOfMonth())
                                        ->sum('total_fee');
        $dailyLegalComplaintsServiceFee = LegalComplaintsService::where('creator_id', Auth()->user()->id)->whereDate('created_at', Carbon::today())->sum('total_fee');
         
        // Total Immigration Government Service fee
         $totalImmigrationGovementServiceFee = ImmigrationGovementService::where('creator_id', Auth()->user()->id)->sum('total_fee');
         $monthlyImmigrationGovementServiceFee = ImmigrationGovementService::where('creator_id', Auth()->user()->id)->where('created_at', '>', Carbon::now()->startOfMonth())
                                     ->where('created_at', '<', Carbon::now()->endOfMonth())
                                     ->sum('total_fee');
         $dailyImmigrationGovementServiceFee = ImmigrationGovementService::where('creator_id', Auth()->user()->id)->whereDate('created_at', Carbon::today())->sum('total_fee');
 
        // Total Other services fee
        $totalOtherServiceFees = $totalPremierServiceFee+$totalOtherFee + $totalImmigrationGovementServiceFee + $totalLegalComplaintsServiceFee+ $totalExpressServiceFee;



        // All type of daily passport fee with branch

        $daily_renew_passport_fee = RenewPassport::where('user_creator_id',auth()->user()->id)
                                                  ->whereDate('created_at', Carbon::today())
                                                  ->sum('passport_type_fees_total');

        $daily_manual_passport_fee = ManualPassport::where('user_creator_id',auth()->user()->id)
                                                    ->whereDate('created_at', Carbon::today())
                                                    ->sum('passport_type_fees_total');

        $daily_lost_passport_fee = LostPassport::where('user_creator_id',auth()->user()->id)
                                                ->whereDate('created_at', Carbon::today())
                                                ->sum('passport_type_fees_total');

        $dailyOtherFee = Other::where('creator_id',auth()->user()->id)
                                ->whereDate('created_at', Carbon::today())
                                ->sum('fee');


        $daily_new_baby_passport_fee = NewBornBabyPassport::where('user_creator_id',auth()->user()->id)
                                                            ->whereDate('created_at', Carbon::today())
                                                            ->sum('passport_type_fees_total');

        // All type of monthly passport fee with branch
        $monthly_renew_passport_fee = RenewPassport::where('user_creator_id',auth()->user()->id)
                                                    ->where('created_at', '>', Carbon::now()->startOfMonth())
                                                    ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                    ->sum('passport_type_fees_total');

        $monthly_manual_passport_fee = ManualPassport::where('user_creator_id',auth()->user()->id)
                                                        ->where('created_at', '>', Carbon::now()->startOfMonth())
                                                        ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                        ->sum('passport_type_fees_total');
                                                        
        $monthly_lost_passport_fee = LostPassport::where('user_creator_id',auth()->user()->id)
                                                    ->where('created_at', '>', Carbon::now()->startOfMonth())
                                                    ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                    ->sum('passport_type_fees_total');

        $monthlyOtherFee = Other::where('creator_id',auth()->user()->id)
                                  ->where('created_at', '>', Carbon::now()->startOfMonth())
                                  ->where('created_at', '<', Carbon::now()->endOfMonth())
                                  ->sum('fee');

        $monthly_new_baby_passport_fee = NewBornBabyPassport::where('user_creator_id',auth()->user()->id)
                                                            ->where('created_at', '>', Carbon::now()->startOfMonth())
                                                            ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                            ->sum('passport_type_fees_total');


        $data = [
            'branches' => Branch::where('status', 1)->orderBy('name','asc')->get(),
            'branch_id' => $branch,
            'option' => 0,

            'total_passport' => $total_passport,
            'totalOtherServices'=>$totalOtherServices,

            'total_renew_passport' => $total_renew_passport,
            'total_manual_passport' => $total_manual_passport,
            'total_lost_passport' => $total_lost_passport,
            'totalOther' => $totalOther,
            'total_new_baby_passport' => $total_new_baby_passport,

            //total ohter services
            'totalPremierService'=> $totalPremierService,
            'totalExpressService'=> $totalExpressService,
            'totalLegalComplaintsService'=> $totalLegalComplaintsService,
            'totalImmigrationGovementService'=> $totalImmigrationGovementService,


            'daily_renew_passport' => $daily_renew_passport,
            'daily_manual_passport' => $daily_manual_passport,
            'daily_lost_passport' => $daily_lost_passport,
            'dailyOther' => $dailyOther,
            'daily_new_baby_passport' => $daily_new_baby_passport,

            //daily other
            'dailyPremierService'=>$dailyPremierService,
            'dailyExpressService'=>$dailyExpressService,
            'dailyLegalComplaintsService'=>$dailyLegalComplaintsService,
            'dailyImmigrationGovementService'=>$dailyImmigrationGovementService,
   
            'monthly_renew_passport' => $monthly_renew_passport,
            'monthly_manual_passport' => $monthly_manual_passport,
            'monthly_lost_passport' => $monthly_lost_passport,
            'monthlyOther' => $monthlyOther,
            'monthly_new_baby_passport' => $monthly_new_baby_passport,

            //daily other
            'monthlyPremierService'=>$dailyPremierService,
            'monthlyExpressService'=>$dailyExpressService,
            'monthlyLegalComplaintsService'=>$dailyLegalComplaintsService,
            'monthlyImmigrationGovementService'=>$dailyImmigrationGovementService,


            'total_renew_passport_fee' => $total_renew_passport_fee,
            'total_manual_passport_fee' => $total_manual_passport_fee,
            'total_lost_passport_fee' => $total_lost_passport_fee,
            'totalOtherFee' => $totalOtherFee,
            'total_new_baby_passport_fee' => $total_new_baby_passport_fee,

            // total others fee
            'totalPremierServiceFee' => $totalPremierServiceFee,
            'totalExpressServiceFee' => $totalExpressServiceFee,
            'totalLegalComplaintsServiceFee' => $totalLegalComplaintsServiceFee,
            'totalImmigrationGovementServiceFee' => $totalImmigrationGovementServiceFee,


            'total_passport_fee' => $total_passport_fee,
            'totalOtherServiceFees'=>$totalOtherServiceFees,
            
            

            'monthly_renew_passport_fee' => $monthly_renew_passport_fee,
            'monthly_manual_passport_fee' => $monthly_manual_passport_fee,
            'monthly_lost_passport_fee' => $monthly_lost_passport_fee,
            'monthlyOtherFee' => $monthlyOtherFee,
            'monthly_new_baby_passport_fee' => $monthly_new_baby_passport_fee,

            //monthly other services fee
    
            'monthlyPremierServiceFee' => $totalPremierServiceFee,
            'monthlyExpressServiceFee' => $totalExpressServiceFee,
            'monthlyLegalComplaintsServiceFee' => $totalLegalComplaintsServiceFee,
            'monthlyImmigrationGovementServiceFee' => $totalImmigrationGovementServiceFee,

            'daily_renew_passport_fee' => $daily_renew_passport_fee,
            'daily_manual_passport_fee' => $daily_manual_passport_fee,
            'daily_lost_passport_fee' => $daily_lost_passport_fee,
            'dailyOtherFee' => $dailyOtherFee,
            'daily_new_baby_passport_fee' => $daily_new_baby_passport_fee,

            //daily other services fee
    
            'dailyPremierServiceFee' => $totalPremierServiceFee,
            'dailyExpressServiceFee' => $totalExpressServiceFee,
            'dailyLegalComplaintsServiceFee' => $totalLegalComplaintsServiceFee,
            'dailyImmigrationGovementServiceFee' => $totalImmigrationGovementServiceFee,



        ];
        return view('DataEnterer.report.index',$data);
    }

    public function getReport($data){

        $from_date = explode('&', $data)[0] ? explode('&', $data)[0] : '';
        $to_date = explode('&', $data)[1] ? explode('&', $data)[1] : '';
        $option = explode('&', $data)[2];

        if (isset(explode('&', $data)[3] )) {
            $all_report = explode('&', $data)[3] ? explode('&', $data)[3] : false;
        }

        $lost = LostPassport::when($from_date != '' && $to_date != '',function($query) use($from_date,$to_date){
                                return $query->whereDate('created_at','>=',$from_date)->whereDate('created_at','<=',$to_date);
                                })
                            ->where('user_creator_id',auth()->user()->id)
                            ->orderBy('id','desc')
                            ->get();

        $manual = ManualPassport::when($from_date != '' && $to_date != '',function($query) use($from_date,$to_date){
                                    return $query->whereDate('created_at','>=',$from_date)->whereDate('created_at','<=',$to_date);
                                })
                                ->where('user_creator_id',auth()->user()->id)
                                ->orderBy('id','desc')
                                ->get();

        $renew = RenewPassport::when($from_date != '' && $to_date != '',function($query) use($from_date,$to_date){
                                return $query->whereDate('created_at','>=',$from_date)->whereDate('created_at','<=',$to_date);
                            })
                            ->where('user_creator_id',auth()->user()->id)
                            ->orderBy('id','desc')
                            ->get();

        $new_baby = NewBornBabyPassport::when($from_date != '' && $to_date != '',function($query) use($from_date,$to_date){
                                            return $query->whereDate('created_at','>=',$from_date)->whereDate('created_at','<=',$to_date);
                                        })
                                        ->where('user_creator_id',auth()->user()->id)
                                        ->orderBy('id','desc')
                                        ->get();


        if ($option == -1) {
            $data = [
                'passports' => $renew->concat($manual)->concat($lost)->concat($new_baby),
                'from_date' => $from_date,
                'to_date' => $to_date,
                'branch_id' => auth()->user()->branch_id,
                'option' => $option,
                'onload' => false,
                'all_report' => true,
                'total_renew' => $renew->count(),
                'total_manual' => $manual->count(),
                'total_lost' => $lost->count(),
                'total_new_born_baby' => $new_baby->count(),
            ];
           if (isset($all_report) && $all_report == true) {
                return downloadExcel('DataEnterer.report.all_report_excel',$data,'all_passport','xlsx');
            }else{
                return view('DataEnterer.report.search_report',$data);
            }
        }

        if ($option == 0) {
            $data = [
                'passports' => $renew,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'branch_id' => auth()->user()->branch_id,
                'option' => $option,
                'onload' => false,
                'all_report' => true,
            ];

           if (isset($all_report) && $all_report == true) {
                return downloadExcel('DataEnterer.report.all_report_excel',$data,'renew_passport','xlsx');
            }else{
                return view('DataEnterer.report.search_report',$data);
            }
        }

        if ($option == 1) {
            $data = [
                'passports' =>$manual,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'branch_id' => auth()->user()->branch_id,
                'option' => $option,
                'onload' => false,
                'all_report' => true,
            ];
           if (isset($all_report) && $all_report == true) {
                return downloadExcel('DataEnterer.report.all_report_excel',$data,'manual_passport','xlsx');
            }else{
                return view('DataEnterer.report.search_report',$data);
            }
        }

        if ($option == 2) {
            $data = [
                'passports' => $lost,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'branch_id' => auth()->user()->branch_id,
                'option' => $option,
                'onload' => false,
                'all_report' => true,
            ];
           if (isset($all_report) && $all_report == true) {
                return downloadExcel('DataEnterer.report.all_report_excel',$data,'lost_passport','xlsx');
            }else{
                return view('DataEnterer.report.search_report',$data);
            }
        }

        if ($option == 3) {
            $data = [
                'passports' => $new_baby,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'branch_id' => auth()->user()->branch_id,
                'option' => $option,
                'onload' => false,
                'all_report' => true,
            ];
           if (isset($all_report) && $all_report == true) {
                return downloadExcel('DataEnterer.report.all_report_excel',$data,'new_born_baby_passport','xlsx');
            }else{
                return view('DataEnterer.report.search_report',$data);
            }
        }

    }
}
