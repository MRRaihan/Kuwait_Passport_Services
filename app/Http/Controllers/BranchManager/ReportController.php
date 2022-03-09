<?php

namespace App\Http\Controllers\BranchManager;

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
use App\Models\PremierService;
use App\Models\ExpressService;
use App\Models\LegalComplaintsService;
use App\Models\ImmigrationGovementService;
use App\Models\User;

class ReportController extends Controller
{

    public function index(){
       
        return $this->show('0');
    }

    public function show($option){


         $branch = isset($option) ? $option : 0;

        //All type of total passort with branch
         $total_renew_passport = RenewPassport::where('branch_id', Auth::user()->branch_id)
                                                ->count();
         $total_manual_passport = ManualPassport::where('branch_id', Auth::user()->branch_id)
                                                ->count();
         $total_lost_passport = LostPassport::where('branch_id', Auth::user()->branch_id)
                                            ->count();
         $total_other_passport = Other::where('branch_id', Auth::user()->branch_id)
                                        ->count();

         $total_new_baby_passport = NewBornBabyPassport::where('branch_id',Auth::user()->branch_id)
                                                        ->count();
        // total  passport with brach
         $total_passport = $total_renew_passport+$total_manual_passport+$total_lost_passport+$total_other_passport+$total_new_baby_passport;

         // All type of daily passport with branch
         $daily_renew_passport = RenewPassport::whereDate('created_at', Carbon::today())
                                                ->where('branch_id', Auth::user()->branch_id)
                                                ->count();

         $daily_manual_passport = ManualPassport::whereDate('created_at', Carbon::today())
                                                ->where('branch_id', Auth::user()->branch_id)
                                                ->count();

         $daily_lost_passport= LostPassport::whereDate('created_at', Carbon::today())
                                                ->where('branch_id', Auth::user()->branch_id)
                                                ->count();

         $daily_other_passport = Other::whereDate('created_at', Carbon::today())
                                                ->where('branch_id', Auth::user()->branch_id)
                                                ->count();

         $daily_new_baby_passport = NewBornBabyPassport::whereDate('created_at', Carbon::today())
                                                ->where('branch_id', Auth::user()->branch_id)
                                                ->count();

        // All type of Monthly passport with branch

         $monthly_renew_passport = RenewPassport::where('created_at', '>', Carbon::now()->startOfMonth())
                                                ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                ->where('branch_id', Auth::user()->branch_id)
                                                ->count();
         $monthly_manual_passport = ManualPassport::where('created_at', '>', Carbon::now()->startOfMonth())
                                                ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                ->where('branch_id', Auth::user()->branch_id)
                                                ->count();
         $monthly_lost_passport = LostPassport::where('created_at', '>', Carbon::now()->startOfMonth())
                                                ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                ->where('branch_id', Auth::user()->branch_id)
                                                ->count();

         $monthly_other_passport = Other::where('created_at', '>', Carbon::now()->startOfMonth())
                                                ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                ->where('branch_id', Auth::user()->branch_id)
                                                ->count();

         $monthly_new_baby_passport = NewBornBabyPassport::where('created_at', '>', Carbon::now()->startOfMonth())
                                                ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                ->where('branch_id', Auth::user()->branch_id)
                                                ->count();

         // All type of total passport fee with branch
         $total_renew_passport_fee = RenewPassport::where('branch_id', Auth::user()->branch_id)
                                                    ->sum('passport_type_fees_total');
         $total_manual_passport_fee = ManualPassport::where('branch_id', Auth::user()->branch_id)
                                                    ->sum('passport_type_fees_total');

         $total_lost_passport_fee = LostPassport::where('branch_id', Auth::user()->branch_id)
                                                    ->sum('passport_type_fees_total');

         $total_other_passport_fee = Other::where('branch_id', Auth::user()->branch_id)
                                                    ->sum('fee');

         $total_new_baby_passport_fee = NewBornBabyPassport::where('branch_id', Auth::user()->branch_id)
                                                            ->sum('passport_type_fees_total');

            // Total Passport Fee with branch
         $total_passport_fee = $total_renew_passport_fee+$total_manual_passport_fee+$total_lost_passport_fee +$total_other_passport_fee+$total_new_baby_passport_fee;                                    
        

         // All type of daily passport fee with branch
         $daily_renew_passport_fee = RenewPassport::whereDate('created_at', Carbon::today())
                                                    ->where('branch_id', Auth::user()->branch_id)
                                                    ->sum('passport_type_fees_total');

         $daily_manual_passport_fee = ManualPassport::whereDate('created_at', Carbon::today())
                                                    ->where('branch_id', Auth::user()->branch_id)
                                                    ->sum('passport_type_fees_total');

         $daily_lost_passport_fee = LostPassport::whereDate('created_at', Carbon::today())
                                                    ->where('branch_id', Auth::user()->branch_id)
                                                    ->sum('passport_type_fees_total');

         $daily_other_passport_fee = Other::whereDate('created_at', Carbon::today())
                                                    ->where('branch_id', Auth::user()->branch_id)
                                                    ->sum('fee');

         $daily_new_baby_passport_fee = NewBornBabyPassport::whereDate('created_at', Carbon::today())
                                                    ->where('branch_id', Auth::user()->branch_id)
                                                    ->sum('passport_type_fees_total');
                                                    
        // All type of monthly passport fee with branch
         $monthly_renew_passport_fee = RenewPassport::where('created_at', '>', Carbon::now()->startOfMonth())
                                                    ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                    ->where('branch_id', Auth::user()->branch_id)
                                                    ->sum('passport_type_fees_total');

         $monthly_manual_passport_fee = ManualPassport::where('created_at', '>', Carbon::now()->startOfMonth())
                                                    ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                    ->where('branch_id', Auth::user()->branch_id)
                                                    ->sum('passport_type_fees_total');

         $monthly_lost_passport_fee = LostPassport::where('created_at', '>', Carbon::now()->startOfMonth())
                                                    ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                    ->where('branch_id', Auth::user()->branch_id)
                                                    ->sum('passport_type_fees_total');

         $monthly_other_passport_fee = Other::where('created_at', '>', Carbon::now()->startOfMonth())
                                                    ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                    ->where('branch_id', Auth::user()->branch_id)
                                                    ->sum('fee');

         $monthly_new_baby_passport_fee = NewBornBabyPassport::where('created_at', '>', Carbon::now()->startOfMonth())
                                                            ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                            ->where('branch_id', Auth::user()->branch_id)
                                                            ->sum('passport_type_fees_total');


         $data = [
            
            'branch_id' => Auth::user()->branch_id,
            'option' => 0, 

            'total_passport' => $total_passport,

            'total_renew_passport' => $total_renew_passport,
            'total_manual_passport' => $total_manual_passport,
            'total_lost_passport' => $total_lost_passport,
            'total_new_baby_passport' => $total_new_baby_passport,
            'total_other_passport' => $total_other_passport,

            'daily_renew_passport' => $daily_renew_passport,
            'daily_manual_passport' => $daily_manual_passport,
            'daily_lost_passport' => $daily_lost_passport,
            'daily_new_baby_passport' => $daily_new_baby_passport,
            'daily_other_passport' => $daily_other_passport,

            'monthly_renew_passport' => $monthly_renew_passport,
            'monthly_manual_passport' => $monthly_manual_passport,
            'monthly_lost_passport' => $monthly_lost_passport,
            'monthly_new_baby_passport' => $monthly_new_baby_passport,
            'monthly_other_passport' => $monthly_other_passport,

            'total_renew_passport_fee' => $total_renew_passport_fee,
            'total_manual_passport_fee' => $total_manual_passport_fee,
            'total_lost_passport_fee' => $total_lost_passport_fee,
            'total_new_baby_passport_fee' => $total_new_baby_passport_fee,
            'total_other_passport_fee' => $total_other_passport_fee,


            'total_passport_fee' => $total_passport_fee,

            'monthly_renew_passport_fee' => $monthly_renew_passport_fee,
            'monthly_manual_passport_fee' => $monthly_manual_passport_fee,
            'monthly_lost_passport_fee' => $monthly_lost_passport_fee,
            'monthly_new_baby_passport_fee' => $monthly_new_baby_passport_fee,
            'monthly_other_passport_fee' => $monthly_other_passport_fee,

            'daily_renew_passport_fee' => $daily_renew_passport_fee,
            'daily_manual_passport_fee' => $daily_manual_passport_fee,
            'daily_lost_passport_fee' => $daily_lost_passport_fee,
            'daily_new_baby_passport_fee' => $daily_new_baby_passport_fee,
            'daily_other_passport_fee' => $daily_other_passport_fee,

        ];

        $data['totalDataEnterer'] = User::where('created_by', Auth::user()->id)->get();

        // Total Lost/Manual/Other/Renue count
        $data['totalLostPassport'] = LostPassport::where('branch_id', Auth::user()->branch_id)->count();
        $data['totalManualPassport'] = ManualPassport::where('branch_id', Auth::user()->branch_id)->count();
        $data['totalOther'] = NewBornBabyPassport::where('branch_id', Auth::user()->branch_id)->count();
        $data['totalRenewPassword'] = RenewPassport::where('branch_id', Auth::user()->branch_id)->count();

        // Total Others Services
        $data['totalPremierService'] = PremierService::where('branch_id', Auth::user()->branch_id)->count();
        $data['totalExpressService'] = ExpressService::where('branch_id', Auth::user()->branch_id)->count();
        $data['totalLegalComplaintsService'] = LegalComplaintsService::where('branch_id', Auth::user()->branch_id)->count();
        $data['totalImmigrationService'] = ImmigrationGovementService::where('branch_id', Auth::user()->branch_id)->count();
        $data['totalOtherService'] = Other::where('branch_id', Auth::user()->branch_id)->count();


        //All Passport count
      	$data['totalPassport'] = $data['totalLostPassport'] + $data['totalManualPassport'] + $data['totalOther'] + $data['totalRenewPassword'];


        // Daily Passport(Lost/Manual/Other/Renue) count
        $data['dailyLostPassport'] = LostPassport::whereDate('created_at', Carbon::today())
                                                    ->where('branch_id', Auth::user()->branch_id)
                                                    ->count();

        $data['dailyManualPassport'] = ManualPassport::whereDate('created_at', Carbon::today())
                                                    ->where('branch_id', Auth::user()->branch_id)
                                                    ->count();
        $data['dailyOther'] = NewBornBabyPassport::whereDate('created_at', Carbon::today())
                                                    ->where('branch_id', Auth::user()->branch_id)
                                                    ->count();
        $data['dailyRenewPassword'] = RenewPassport::whereDate('created_at', Carbon::today())
                                                    ->where('branch_id', Auth::user()->branch_id)
                                                    ->count();

        // Monthly Passport(Lost/Manual/Other/Renue) count
        $data['monthlyLostPassport'] = LostPassport::where('created_at', '>', Carbon::now()->startOfMonth())
                                                    ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                    ->where('branch_id', Auth::user()->branch_id)
                                                    ->count();

        $data['monthlyManualPassport'] = ManualPassport::where('created_at', '>', Carbon::now()->startOfMonth())
                                                        ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                        ->where('branch_id', Auth::user()->branch_id)
                                                        ->count();
        $data['monthlyOther'] = NewBornBabyPassport::where('created_at', '>', Carbon::now()->startOfMonth())
                                                    ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                    ->where('branch_id', Auth::user()->branch_id)
                                                    ->count();
        $data['monthlyRenewPassword'] = RenewPassport::where('created_at', '>', Carbon::now()->startOfMonth())
                                                    ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                    ->where('branch_id', Auth::user()->branch_id)
                                                    ->count();
        //Daily Others services
        $data['dailyPremierService'] = PremierService::whereDate('created_at', Carbon::today())
                                                    ->where('branch_id', Auth::user()->branch_id)
                                                    ->count();

        $data['dailyExpressService'] = ExpressService::whereDate('created_at', Carbon::today())
                                                        ->where('branch_id', Auth::user()->branch_id)
                                                        ->count();
        $data['dailyLegalComplaintsService'] = LegalComplaintsService::whereDate('created_at', Carbon::today())
                                                                    ->where('branch_id', Auth::user()->branch_id)
                                                                    ->count();
        $data['dailyImmigrationService'] = ImmigrationGovementService::whereDate('created_at', Carbon::today())
                                                                    ->where('branch_id', Auth::user()->branch_id)
                                                                    ->count();
        $data['dailyOtherService'] = Other::whereDate('created_at', Carbon::today())
                                            ->where('branch_id', Auth::user()->branch_id)
                                            ->count();


        //Monthly Others services
        $data['monthlyPremierService'] = PremierService::where('created_at', '>', Carbon::now()->startOfMonth())
                                                        ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                        ->where('branch_id', Auth::user()->branch_id)
                                                        ->count();

        $data['monthlyExpressService'] = ExpressService::where('created_at', '>', Carbon::now()->startOfMonth())
                                                        ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                        ->where('branch_id', Auth::user()->branch_id)
                                                        ->count();

        $data['monthlyLegalComplaintsService'] = LegalComplaintsService::where('created_at', '>', Carbon::now()->startOfMonth())
                                                                        ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                                        ->where('branch_id', Auth::user()->branch_id)
                                                                        ->count();
        $data['monthlyImmigrationService'] = ImmigrationGovementService::where('created_at', '>', Carbon::now()->startOfMonth())
                                                                        ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                                        ->where('branch_id', Auth::user()->branch_id)
                                                                        ->count();
        $data['monthlyOtherService'] = Other::where('created_at', '>', Carbon::now()->startOfMonth())
                                            ->where('created_at', '<', Carbon::now()->endOfMonth())
                                            ->where('branch_id', Auth::user()->branch_id)
                                            ->count();

        // Total Services Count
        $data['totalServices'] = $data['totalPremierService'] + $data['totalExpressService'] + $data['totalLegalComplaintsService'] + $data['totalImmigrationService']+ $data['totalOtherService'];


        // Lost Password Total Fee
        $data['totalLostPassportFees'] = LostPassport::where('branch_id', Auth::user()->branch_id)
                                                    ->sum('passport_type_fees_total');
        $data['monthlyLostPassportFees'] = LostPassport::where('created_at', '>', Carbon::now()->startOfMonth())
                                            ->where('created_at', '<', Carbon::now()->endOfMonth())
                                            ->where('branch_id', Auth::user()->branch_id)
                                            ->sum('passport_type_fees_total');
        $data['dailyLostPassportFees'] = LostPassport::whereDate('created_at', Carbon::today())
                                            ->where('branch_id', Auth::user()->branch_id)
                                            ->sum('passport_type_fees_total');


        // Manual Pasport Fee
        $data['totalManualPassportFees'] = ManualPassport::where('branch_id', Auth::user()->branch_id)
                                                            ->sum('passport_type_fees_total');
        $data['monthlyManualPassportFees'] = ManualPassport::where('created_at', '>', Carbon::now()->startOfMonth())
                                            ->where('created_at', '<', Carbon::now()->endOfMonth())
                                            ->where('branch_id', Auth::user()->branch_id)
                                            ->sum('passport_type_fees_total');
        $data['dailyManualPassportFees'] = ManualPassport::whereDate('created_at', Carbon::today())
                                            ->where('branch_id', Auth::user()->branch_id)
                                            ->sum('passport_type_fees_total');


        // Total other fee

        $data['totalNewBornFees'] = NewBornBabyPassport::where('branch_id', Auth::user()->branch_id)
                                                        ->sum('passport_type_fees_total');

        $data['monthlyNewBornFees'] = NewBornBabyPassport::where('created_at', '>', Carbon::now()->startOfMonth())
                                                           ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                           ->where('branch_id', Auth::user()->branch_id)
                                                           ->sum('passport_type_fees_total');

        $data['dailyNewBornFees'] = NewBornBabyPassport::whereDate('created_at', Carbon::today())
                                                        ->where('branch_id', Auth::user()->branch_id)
                                                        ->sum('passport_type_fees_total');




        //Total Renue Fee

        $data['totalRenewPasswordFees'] = RenewPassport::where('branch_id', Auth::user()->branch_id)
                                                         ->sum('passport_type_fees_total');

        $data['monthlyRenewPasswordFees'] = RenewPassport::where('created_at', '>', Carbon::now()->startOfMonth())
                                                           ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                           ->where('branch_id', Auth::user()->branch_id)
                                                           ->sum('passport_type_fees_total');
        $data['dailyRenewPasswordFees'] = RenewPassport::whereDate('created_at', Carbon::today())
                                                        ->where('branch_id', Auth::user()->branch_id)
                                                        ->sum('passport_type_fees_total');
        // Others Services total fees

        // Total Premier Service fee
        $data['totalPremierServiceFee'] = PremierService::where('branch_id', Auth::user()->branch_id)->sum('total_fee');

        $data['monthlyPremierServiceFee'] = PremierService::where('created_at', '>', Carbon::now()->startOfMonth())
                                                            ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                            ->where('branch_id', Auth::user()->branch_id)
                                                            ->sum('total_fee');
        $data['dailyPremierServiceFee'] = PremierService::whereDate('created_at', Carbon::today())
                                                        ->where('branch_id', Auth::user()->branch_id)
                                                        ->sum('total_fee');

        // Total Express Service fee
        $data['totalExpressServiceFee'] = ExpressService::where('branch_id', Auth::user()->branch_id)->sum('total_fee');

        $data['monthlyExpressServiceFee'] = ExpressService::where('created_at', '>', Carbon::now()->startOfMonth())
                                                            ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                            ->where('branch_id', Auth::user()->branch_id)
                                                            ->sum('total_fee');
        $data['dailyExpressServiceFee'] = ExpressService::whereDate('created_at', Carbon::today())
                                                        ->where('branch_id', Auth::user()->branch_id)
                                                        ->sum('total_fee');

        // Total Legal Complaints Service fee
        $data['totalLegalComplaintsServiceFee'] = LegalComplaintsService::where('branch_id', Auth::user()->branch_id)->sum('total_fee');

        $data['monthlyLegalComplaintsServiceFee'] = LegalComplaintsService::where('created_at', '>', Carbon::now()->startOfMonth())
                                                                            ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                                            ->where('branch_id', Auth::user()->branch_id)
                                                                            ->sum('total_fee');
        $data['dailyLegalComplaintsServiceFee'] = LegalComplaintsService::whereDate('created_at', Carbon::today())
                                                                        ->where('branch_id', Auth::user()->branch_id)
                                                                        ->sum('total_fee');

        // Total Immigration Government Service fee
        $data['totalImmigrationGovementServiceFee'] = ImmigrationGovementService::where('branch_id', Auth::user()->branch_id)->sum('total_fee');

        $data['monthlyImmigrationGovementServiceFee'] = ImmigrationGovementService::where('created_at', '>', Carbon::now()->startOfMonth())
                                                                                    ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                                                    ->where('branch_id', Auth::user()->branch_id)
                                                                                    ->sum('total_fee');
        $data['dailyImmigrationGovementServiceFee'] = ImmigrationGovementService::whereDate('created_at', Carbon::today())
                                                                                 ->where('branch_id', Auth::user()->branch_id)
                                                                                 ->sum('total_fee');


        // Total Other Service fee
        $data['totalOtherFee'] = Other::where('branch_id', Auth::user()->branch_id)->sum('fee');

        $data['monthlyOtherFee'] = Other::where('created_at', '>', Carbon::now()->startOfMonth())
                                        ->where('created_at', '<', Carbon::now()->endOfMonth())
                                        ->where('branch_id', Auth::user()->branch_id)
                                        ->sum('fee');
        $data['dailyOtherFee'] = Other::whereDate('created_at', Carbon::today())
                                        ->where('branch_id', Auth::user()->branch_id)
                                        ->sum('fee');
        // All Other Services Fees

        $data ['TotalServicesFees'] = $data['totalPremierServiceFee']+$data['totalExpressServiceFee']+$data['totalLegalComplaintsServiceFee']+$data['totalImmigrationGovementServiceFee']+$data['totalOtherFee'];



        // All Passport Fee
        $data['totalPassportFees'] = $data['totalRenewPasswordFees'] + $data['totalNewBornFees'] + $data['totalManualPassportFees'] + $data['totalLostPassportFees'];
        
        return view('BranchManager.report.index',$data);
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
                                ->where('branch_id', Auth::user()->branch_id)
                                ->orderBy('id','desc')
                                ->get();

        $manual = ManualPassport::when($from_date != '' && $to_date != '',function($query) use($from_date,$to_date){
                                            return $query->whereDate('created_at','>=',$from_date)->whereDate('created_at','<=',$to_date);
                                        })
                                    ->where('branch_id', Auth::user()->branch_id)
                                    ->orderBy('id','desc')
                                    ->get();

        $renew = RenewPassport::when($from_date != '' && $to_date != '',function($query) use($from_date,$to_date){
                                    return $query->whereDate('created_at','>=',$from_date)->whereDate('created_at','<=',$to_date);
                                })
                                ->orderBy('id','desc')
                                ->where('branch_id', Auth::user()->branch_id)
                                ->get();

       $new_born_baby = NewBornBabyPassport::when($from_date != '' && $to_date != '',function($query) use($from_date,$to_date){
                                return $query->whereDate('created_at','>=',$from_date)->whereDate('created_at','<=',$to_date);
                            })
                        ->orderBy('id','desc')
                        ->where('branch_id', Auth::user()->branch_id)
                        ->get();

      

       

            if ($option == -1) {
                $data = [
                    'passports' => $renew->concat($manual)->concat($lost)->concat($new_born_baby),
                    'from_date' => $from_date,
                    'to_date' => $to_date,
                    'branch_id' => Auth::user()->branch_id,
                    'option' => $option,
                    'onload' => false,
                    'all_report' => true,
                    'total_renew' => $renew->count(),
                    'total_manual' => $manual->count(),
                    'total_lost' => $lost->count(),
                    'total_new_born_baby' => $new_born_baby->count(),
                 ];

                if (isset($all_report) && $all_report == true) {
                    return downloadExcel('BranchManager.report.all_report_excel',$data,'all_passport','xlsx');
                }else{
                    return view('BranchManager.report.search_report',$data);
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
                    'all_report' => true,
                ];

                if (isset($all_report) && $all_report == true) {
                    return downloadExcel('BranchManager.report.all_report_excel',$data,'renew_passport','xlsx');
                }else{
                    return view('BranchManager.report.search_report',$data);
                }
            }
            
            if ($option == 1) {
                $data = [
                    'passports' =>$manual, 
                    'from_date' => $from_date,
                    'to_date' => $to_date,
                    'branch_id' => Auth::user()->id,
                    'option' => $option,
                    'onload' => false,
                    'all_report' => true,
                ];
                if (isset($all_report) && $all_report == true) {
                    return downloadExcel('BranchManager.report.all_report_excel',$data,'manual_passport','xlsx');
                }else{
                    return view('BranchManager.report.search_report',$data);
                }
            }

        if ($option == 2) {
            $data = [
                'passports' => $lost,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'branch_id' => Auth::user()->branch_id,
                'option' => $option,
                'onload' => false,
                'all_report' => true,
            ];
            if (isset($all_report) && $all_report == true) {
                    return downloadExcel('BranchManager.report.all_report_excel',$data,'lost_passport','xlsx');
                }else{
                    return view('BranchManager.report.search_report',$data);
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
                'all_report' => true,
            ];
            if (isset($all_report) && $all_report == true) {
                    return downloadExcel('BranchManager.report.all_report_excel',$data,'new_born_baby','xlsx');
                }else{
                    return view('BranchManager.report.search_report',$data);
            }
        }

    }


    public function shiftReport()
    {
        $branch = 0;
        $data = [
            'branch_id' => Auth::user()->branch_id,
            'option' => 0, 
        ];

        return view('BranchManager.report.shift_to_admin',$data);

    }

    public function getShiftReport($data)
    {
        $from_date = explode('&', $data)[0] ? explode('&', $data)[0] : '';
        $to_date = explode('&', $data)[1] ? explode('&', $data)[1] : '';
        $option = explode('&', $data)[2];

        if (isset(explode('&', $data)[3] )) {
            $shift_to_admin = explode('&', $data)[3] ? explode('&', $data)[3] : false;
        }


        $lost = LostPassport::when($from_date != '' && $to_date != '',function($query) use($from_date,$to_date){
                                    return $query->whereDate('updated_at','>=',$from_date)->whereDate('updated_at','<=',$to_date);
                                })
                                ->where('shift_to_admin',1)
                                ->where('branch_status','<=',1)
                                ->where('branch_id', Auth::user()->branch_id)
                                ->orderBy('id','desc')
                                ->get();

        $manual = ManualPassport::when($from_date != '' && $to_date != '',function($query) use($from_date,$to_date){
                                        return $query->whereDate('updated_at','>=',$from_date)->whereDate('updated_at','<=',$to_date);
                                    })
                                    ->where('shift_to_admin',1)
                                    ->where('branch_status','<=',1)
                                    ->where('branch_id', Auth::user()->branch_id)
                                    ->orderBy('id','desc')
                                    ->get();

        $renew = RenewPassport::when($from_date != '' && $to_date != '',function($query) use($from_date,$to_date){
                                    return $query->whereDate('updated_at','>=',$from_date)->whereDate('updated_at','<=',$to_date);
                                })
                                ->where('shift_to_admin',1)
                                ->where('branch_status','<=',1)
                                ->where('branch_id', Auth::user()->branch_id)
                                ->orderBy('id','desc')
                                ->get();

       $new_born_baby = NewBornBabyPassport::when($from_date != '' && $to_date != '',function($query) use($from_date,$to_date){
                                                return $query->whereDate('updated_at','>=',$from_date)->whereDate('updated_at','<=',$to_date);
                                            })
                                            ->where('shift_to_admin',1)
                                            ->where('branch_status','<=',1)
                                            ->orderBy('id','desc')
                                            ->where('branch_id', Auth::user()->branch_id)
                                            ->get();



            //    return $lost->concat($manual)->concat($renew);

            if ($option == -1) {
                $data = [
                    'passports' => $renew->concat($manual)->concat($lost)->concat($new_born_baby),
                    'from_date' => $from_date,
                    'to_date' => $to_date,
                    'branch_id' => Auth::user()->branch_id,
                    'option' => $option,
                    'onload' => false,
                    'shift_to_admin' => true,
                    'total_renew' => $renew->count(),
                    'total_manual' => $manual->count(),
                    'total_lost' => $lost->count(),
                    'total_new_born_baby' => $new_born_baby->count(),
                ];
                if (isset($shift_to_admin) && $shift_to_admin == true) {
                    return downloadExcel('BranchManager.report.all_report_excel',$data,'shift_all_passport','xlsx');
                }else{
                    return view('BranchManager.report.search_report',$data);
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
                    'shift_to_admin' => true,
                ];

                if (isset($shift_to_admin) && $shift_to_admin == true) {
                    return downloadExcel('BranchManager.report.all_report_excel',$data,'shift_renew_passport','xlsx');
                }else{
                    return view('BranchManager.report.search_report',$data);
                }
            }
        
            if ($option == 1) {
                $data = [
                    'passports' =>$manual, 
                    'from_date' => $from_date,
                    'to_date' => $to_date,
                    'branch_id' => Auth::user()->branch_id,
                    'option' => $option,
                    'onload' => false,
                    'shift_to_admin' => true,
                ];
                if (isset($shift_to_admin) && $shift_to_admin == true) {
                    return downloadExcel('BranchManager.report.all_report_excel',$data,'shift_manual_passport','xlsx');
                }else{
                    return view('BranchManager.report.search_report',$data);
                }
            }

        if ($option == 2) {
            $data = [
                'passports' =>$lost,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'branch_id' => Auth::user()->branch_id,
                'option' => $option,
                'onload' => false,
                'shift_to_admin' => true,
            ];
            if (isset($shift_to_admin) && $shift_to_admin == true) {
                return downloadExcel('BranchManager.report.all_report_excel',$data,'shift_lost_passport','xlsx');
            }else{
                return view('BranchManager.report.search_report',$data);
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
                'shift_to_admin' => true,
            ];
            if (isset($shift_to_admin) && $shift_to_admin == true) {
                return downloadExcel('BranchManager.report.all_report_excel',$data,'shift_new_born_baby_passport','xlsx');
            }else{
                return view('BranchManager.report.search_report',$data);
            }
        }
    }

    public function receiveReport()
    {
        $branch = 0;
        $data = [
            'branch_id' => Auth::user()->branch_id,
            'option' => 0, 
        ];

        return view('BranchManager.report.receive_from_admin_report',$data);

    }

    public function getReceiveReport($data)
    {
        $from_date = explode('&', $data)[0] ? explode('&', $data)[0] : '';
        $to_date = explode('&', $data)[1] ? explode('&', $data)[1] : '';
        $option = explode('&', $data)[2];

        if (isset(explode('&', $data)[3] )) {
            $recieve_from_admin = explode('&', $data)[3] ? explode('&', $data)[3] : false;
        }

        $lost = LostPassport::when($from_date != '' && $to_date != '',function($query) use($from_date,$to_date){
                                    return $query->whereDate('updated_at','>=',$from_date)->whereDate('updated_at','<=',$to_date);
                                })
                                ->where('branch_status',1)
                                ->where('branch_id', Auth::user()->branch_id)
                                ->orderBy('id','desc')
                                ->get();

        $manual = ManualPassport::when($from_date != '' && $to_date != '',function($query) use($from_date,$to_date){
                                        return $query->whereDate('updated_at','>=',$from_date)->whereDate('updated_at','<=',$to_date);
                                    })
                                    ->where('branch_status',1)
                                    ->where('branch_id', Auth::user()->branch_id)
                                    ->orderBy('id','desc')
                                    ->get();

        $renew = RenewPassport::when($from_date != '' && $to_date != '',function($query) use($from_date,$to_date){
                                    return $query->whereDate('updated_at','>=',$from_date)->whereDate('updated_at','<=',$to_date);
                                })
                                ->where('branch_status',1)
                                ->where('branch_id', Auth::user()->branch_id)
                                ->orderBy('id','desc')
                                ->get();

        $new_born_baby = NewBornBabyPassport::when($from_date != '' && $to_date != '',function($query) use($from_date,$to_date){
                                                return $query->whereDate('updated_at','>=',$from_date)->whereDate('updated_at','<=',$to_date);
                                            })
                                            ->where('branch_status',1)
                                            ->where('branch_id', Auth::user()->branch_id)
                                            ->orderBy('id','desc')
                                            ->get();

        //    return $lost->concat($manual)->concat($renew);

            if ($option == -1) {
                $data = [
                    'passports' => $renew->concat($manual)->concat($lost)->concat($new_born_baby),
                    'from_date' => $from_date,
                    'to_date' => $to_date,
                    'branch_id' => Auth::user()->branch_id,
                    'option' => $option,
                    'onload' => false,
                    'receive_from_admin' => true,
                    'total_renew' => $renew->count(),
                    'total_manual' => $manual->count(),
                    'total_lost' => $lost->count(),
                    'total_new_born_baby' => $new_born_baby->count(),
                ];
                if (isset($recieve_from_admin) && $recieve_from_admin == true) {
                return downloadExcel('BranchManager.report.all_report_excel',$data,'recieve_all_passport','xlsx');
            }else{
                return view('BranchManager.report.search_report',$data);
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
                'receive_from_admin' => true,
                ];

                if (isset($recieve_from_admin) && $recieve_from_admin == true) {
                return downloadExcel('BranchManager.report.all_report_excel',$data,'recieve_renew_passport','xlsx');
            }else{
                return view('BranchManager.report.search_report',$data);
            }
            }
        
            if ($option == 1) {
                $data = [
                    'passports' =>$manual, 
                    'from_date' => $from_date,
                    'to_date' => $to_date,
                    'branch_id' => Auth::user()->branch_id,
                    'option' => $option,
                    'onload' => false,
                    'receive_from_admin' => true,
                ];
                if (isset($recieve_from_admin) && $recieve_from_admin == true) {
                return downloadExcel('BranchManager.report.all_report_excel',$data,'recieve_manual_passport','xlsx');
            }else{
                return view('BranchManager.report.search_report',$data);
            }
            }

        if ($option == 2) {
            $data = [
                'passports' =>$lost,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'branch_id' => Auth::user()->branch_id,
                'option' => $option,
                'onload' => false,
                'receive_from_admin' => true,
            ];
            if (isset($recieve_from_admin) && $recieve_from_admin == true) {
                return downloadExcel('BranchManager.report.all_report_excel',$data,'recieve_lost_passport','xlsx');
            }else{
                return view('BranchManager.report.search_report',$data);
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
                'receive_from_admin' => true,
            ];
            if (isset($recieve_from_admin) && $recieve_from_admin == true) {
                return downloadExcel('BranchManager.report.all_report_excel',$data,'shift_new_born_baby_passport','xlsx');
            }else{
                return view('BranchManager.report.search_report',$data);
            }
        }
    }


    public function deliveryReport()
    {
        $branch = 0;

        //All type of total passort with branch
        $total_renew_passport = RenewPassport::where('branch_id', Auth::user()->branch_id)->where('branch_status',3)->count(); 

        $total_manual_passport = ManualPassport::where('branch_id', Auth::user()->branch_id)->where('branch_status',3)->count();

        $total_lost_passport = LostPassport::where('branch_id', Auth::user()->branch_id)->where('branch_status',3)->count();

        $total_new_baby_passport = NewBornBabyPassport::where('branch_id',Auth::user()->branch_id)->where('branch_status',3)->count();
        // total  passport with brach
        $total_passport = $total_renew_passport+$total_manual_passport+$total_lost_passport+$total_new_baby_passport;

         // All type of daily passport with branch
         $daily_renew_passport = RenewPassport::whereDate('created_at', Carbon::today())
                                                ->where('branch_id', Auth::user()->branch_id)
                                                ->where('branch_status',3)
                                                ->count();

         $daily_manual_passport = ManualPassport::whereDate('created_at', Carbon::today())
                                                ->where('branch_id', Auth::user()->branch_id)
                                                ->where('branch_status',3)
                                                ->count();

         $daily_lost_passport= LostPassport::whereDate('created_at', Carbon::today())
                                                ->where('branch_id', Auth::user()->branch_id)
                                                ->where('branch_status',3)
                                                ->count();

         $daily_new_baby_passport = NewBornBabyPassport::whereDate('created_at', Carbon::today())
                                                ->where('branch_id', Auth::user()->branch_id)
                                                ->where('branch_status',3)
                                                ->count();

        // All type of Monthly passport with branch

         $monthly_renew_passport = RenewPassport::where('created_at', '>', Carbon::now()->startOfMonth())
                                                ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                ->where('branch_id', Auth::user()->branch_id)
                                                ->where('branch_status',3)
                                                ->count();
         $monthly_manual_passport = ManualPassport::where('created_at', '>', Carbon::now()->startOfMonth())
                                                ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                ->where('branch_id', Auth::user()->branch_id)
                                                ->where('branch_status',3)
                                                ->count();
         $monthly_lost_passport = LostPassport::where('created_at', '>', Carbon::now()->startOfMonth())
                                                ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                ->where('branch_id', Auth::user()->branch_id)
                                                ->where('branch_status',3)
                                                ->count();

         $monthly_new_baby_passport = NewBornBabyPassport::where('created_at', '>', Carbon::now()->startOfMonth())
                                                ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                ->where('branch_id', Auth::user()->branch_id)
                                                ->where('branch_status',3)
                                                ->count();

         // All type of total passport fee with branch
         $total_renew_passport_fee = RenewPassport::where('branch_id', Auth::user()->branch_id)
                                                    ->where('branch_status',3)
                                                    ->sum('passport_type_fees_total');
         $total_manual_passport_fee = ManualPassport::where('branch_id', Auth::user()->branch_id)
                                                    ->where('branch_status',3)
                                                    ->sum('passport_type_fees_total');

         $total_lost_passport_fee = LostPassport::where('branch_id', Auth::user()->branch_id)
                                                ->where('branch_status',3)
                                                ->sum('passport_type_fees_total');

         $total_new_baby_passport_fee = NewBornBabyPassport::where('branch_id', Auth::user()->branch_id)
                                                            ->where('branch_status',3)
                                                            ->sum('passport_type_fees_total');

            // Total Passport Fee with branch
         $total_passport_fee = $total_renew_passport_fee+$total_manual_passport_fee+$total_lost_passport_fee+$total_new_baby_passport_fee;                                    
        

         // All type of daily passport fee with branch
         $daily_renew_passport_fee = RenewPassport::whereDate('created_at', Carbon::today())
                                                    ->where('branch_id', Auth::user()->branch_id)
                                                    ->where('branch_status',3)
                                                    ->sum('passport_type_fees_total');

         $daily_manual_passport_fee = ManualPassport::whereDate('created_at', Carbon::today())
                                                    ->where('branch_id', Auth::user()->branch_id)
                                                    ->where('branch_status',3)
                                                    ->sum('passport_type_fees_total');

         $daily_lost_passport_fee = LostPassport::whereDate('created_at', Carbon::today())
                                                    ->where('branch_id', Auth::user()->branch_id)
                                                    ->where('branch_status',3)
                                                    ->sum('passport_type_fees_total');

         $daily_new_baby_passport_fee = NewBornBabyPassport::whereDate('created_at', Carbon::today())
                                                    ->where('branch_id', Auth::user()->branch_id)
                                                    ->where('branch_status',3)
                                                    ->sum('passport_type_fees_total');
                                                    
        // All type of monthly passport fee with branch
         $monthly_renew_passport_fee = RenewPassport::where('created_at', '>', Carbon::now()->startOfMonth())
                                                    ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                    ->where('branch_id', Auth::user()->branch_id)
                                                    ->where('branch_status',3)
                                                    ->sum('passport_type_fees_total');

         $monthly_manual_passport_fee = ManualPassport::where('created_at', '>', Carbon::now()->startOfMonth())
                                                    ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                    ->where('branch_id', Auth::user()->branch_id)
                                                    ->where('branch_status',3)
                                                    ->sum('passport_type_fees_total');

         $monthly_lost_passport_fee = LostPassport::where('created_at', '>', Carbon::now()->startOfMonth())
                                                    ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                    ->where('branch_id', Auth::user()->branch_id)
                                                    ->where('branch_status',3)
                                                    ->sum('passport_type_fees_total');

         $monthly_new_baby_passport_fee = NewBornBabyPassport::where('created_at', '>', Carbon::now()->startOfMonth())
                                                            ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                            ->where('branch_id', Auth::user()->branch_id)
                                                            ->where('branch_status',3)
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

        return view('BranchManager.report.delivery',$data);

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
                                ->where('branch_status',3)
                                ->where('branch_id', Auth::user()->branch_id)
                                ->orderBy('id','desc')
                                ->get();

        $manual = ManualPassport::when($from_date != '' && $to_date != '',function($query) use($from_date,$to_date){
                                        return $query->whereDate('updated_at','>=',$from_date)->whereDate('updated_at','<=',$to_date);
                                    })
                                    ->where('branch_status',3)
                                    ->where('branch_id', Auth::user()->branch_id)
                                    ->orderBy('id','desc')
                                    ->get();

        $renew = RenewPassport::when($from_date != '' && $to_date != '',function($query) use($from_date,$to_date){
                                    return $query->whereDate('updated_at','>=',$from_date)->whereDate('updated_at','<=',$to_date);
                                })
                                ->where('branch_status',3)
                                ->where('branch_id', Auth::user()->branch_id)
                                ->orderBy('id','desc')
                                ->get();

       $new_born_baby = NewBornBabyPassport::when($from_date != '' && $to_date != '',function($query) use($from_date,$to_date){
                            return $query->whereDate('updated_at','>=',$from_date)->whereDate('updated_at','<=',$to_date);
                        })
                        ->where('branch_status',3)
                        ->where('branch_id', Auth::user()->branch_id)
                        ->orderBy('id','desc')
                        ->get();

        //    return $lost->concat($manual)->concat($renew);

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
                return downloadExcel('BranchManager.report.all_report_excel',$data,'delivery_all_passport','xlsx');
            }else{
                return view('BranchManager.report.search_report',$data);
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
                return downloadExcel('BranchManager.report.all_report_excel',$data,'delivery_renew_passport','xlsx');
            }else{
                return view('BranchManager.report.search_report',$data);
            }
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
                return downloadExcel('BranchManager.report.all_report_excel',$data,'delivery_manual_passport','xlsx');
            }else{
                return view('BranchManager.report.search_report',$data);
            }
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
                return downloadExcel('BranchManager.report.all_report_excel',$data,'delivery_lost_passport','xlsx');
            }else{
                return view('BranchManager.report.search_report',$data);
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
                return downloadExcel('BranchManager.report.all_report_excel',$data,'delivery_new_born_baby_passport','xlsx');
            }else{
                return view('BranchManager.report.search_report',$data);
            }
        }
    }



     


}
