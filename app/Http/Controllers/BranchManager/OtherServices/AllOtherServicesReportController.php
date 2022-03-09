<?php

namespace App\Http\Controllers\BranchManager\OtherServices;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\ExpressService;
use App\Models\PremierService;
use App\Models\LegalComplaintsService;
use App\Models\Other;
use App\Models\ImmigrationGovementService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AllOtherServicesReportController extends Controller
{

    public function index(){
       
        $branch = isset($option) ? $option : 0;

        $data = [
           'branches' => Branch::orderBy('name','asc')->where('status',1)->get(),
           'branch_id' => $branch,
           'option' => -1, 
       ];


       $data['totalDataEnterer'] = User::where('created_by', Auth::user()->id)->get();


       // Total Others Services
       $data['totalPremierService'] = PremierService::where('branch_id', Auth::user()->branch_id)->count();
       $data['totalExpressService'] = ExpressService::where('branch_id', Auth::user()->branch_id)->count();
       $data['totalLegalComplaintsService'] = LegalComplaintsService::where('branch_id', Auth::user()->branch_id)->count();
       $data['totalImmigrationService'] = ImmigrationGovementService::where('branch_id', Auth::user()->branch_id)->count();
       $data['totalOtherService'] = Other::where('branch_id', Auth::user()->branch_id)->count();


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



       // Total Premier Service fee
       $data['totalPremierServiceFee'] = PremierService::where('branch_id', Auth::user()->branch_id)
           ->sum('total_fee');
       $data['monthlyPremierServiceFee'] = PremierService::where('created_at', '>', Carbon::now()->startOfMonth())
           ->where('created_at', '<', Carbon::now()->endOfMonth())
           ->where('branch_id', Auth::user()->branch_id)
           ->sum('total_fee');
       $data['dailyPremierServiceFee'] = PremierService::whereDate('created_at', Carbon::today())->where('branch_id', Auth::user()->branch_id)
           ->sum('total_fee');

       // Total Express Service fee
       $data['totalExpressServiceFee'] = ExpressService::where('branch_id', Auth::user()->branch_id)
           ->sum('total_fee');
       $data['monthlyExpressServiceFee'] = ExpressService::where('created_at', '>', Carbon::now()->startOfMonth())
           ->where('created_at', '<', Carbon::now()->endOfMonth())
           ->where('branch_id', Auth::user()->branch_id)
           ->sum('total_fee');
       $data['dailyExpressServiceFee'] = ExpressService::whereDate('created_at', Carbon::today())->where('branch_id', Auth::user()->branch_id)
           ->sum('total_fee');

       // Total Legal Complaints Service fee
       $data['totalLegalComplaintsServiceFee'] = LegalComplaintsService::where('branch_id', Auth::user()->branch_id)
           ->sum('total_fee');
       $data['monthlyLegalComplaintsServiceFee'] = LegalComplaintsService::where('created_at', '>', Carbon::now()->startOfMonth())
           ->where('created_at', '<', Carbon::now()->endOfMonth())
           ->where('branch_id', Auth::user()->branch_id)
           ->sum('total_fee');
       $data['dailyLegalComplaintsServiceFee'] = LegalComplaintsService::whereDate('created_at', Carbon::today())->where('branch_id', Auth::user()->branch_id)
           ->sum('total_fee');

       // Total Immigration Government Service fee
       $data['totalImmigrationGovementServiceFee'] = ImmigrationGovementService::where('branch_id', Auth::user()->branch_id)
           ->sum('total_fee');
       $data['monthlyImmigrationGovementServiceFee'] = ImmigrationGovementService::where('created_at', '>', Carbon::now()->startOfMonth())
           ->where('created_at', '<', Carbon::now()->endOfMonth())
           ->where('branch_id', Auth::user()->branch_id)
           ->sum('total_fee');
       $data['dailyImmigrationGovementServiceFee'] = ImmigrationGovementService::whereDate('created_at', Carbon::today())->where('branch_id', Auth::user()->branch_id)
           ->sum('total_fee');


       // Total Other Service fee
       $data['totalOtherFee'] = Other::where('branch_id', Auth::user()->branch_id)
           ->sum('fee');
       $data['monthlyOtherFee'] = Other::where('created_at', '>', Carbon::now()->startOfMonth())
           ->where('created_at', '<', Carbon::now()->endOfMonth())
           ->where('branch_id', Auth::user()->branch_id)
           ->sum('fee');
       $data['dailyOtherFee'] = Other::whereDate('created_at', Carbon::today())->where('branch_id', Auth::user()->branch_id)
           ->sum('fee');
       // All Other Services Fees

       $data ['TotalServicesFees'] = $data['totalPremierServiceFee']+$data['totalExpressServiceFee']+$data['totalLegalComplaintsServiceFee']+$data['totalImmigrationGovementServiceFee']+$data['totalOtherFee'];

       return view('BranchManager.report.otherServices.all_other_report',$data);
    }

  
    public function getReport($data){

        $from_date = explode('&', $data)[0] ? explode('&', $data)[0] : '';
        $to_date = explode('&', $data)[1] ? explode('&', $data)[1] : '';
        $option = explode('&', $data)[2];

        if (isset(explode('&', $data)[3])) {
            $excel_export = explode('&', $data)[3] ? explode('&', $data)[3] : 0;
        }

        $branch_id = Auth::user()->branch_id;

       
        


        $premier = PremierService::when($from_date != '' && $to_date != '',function($query) use($from_date,$to_date){
                                    return $query->whereDate('created_at','>=',$from_date)->whereDate('created_at','<=',$to_date);
                                })
                                ->where('branch_id',$branch_id)
                                ->orderBy('id','desc')
                                ->get();

        $express = ExpressService::when($from_date != '' && $to_date != '',function($query) use($from_date,$to_date){
                                            return $query->whereDate('created_at','>=',$from_date)->whereDate('created_at','<=',$to_date);
                                        })
                                    ->where('branch_id',$branch_id)
                                    ->orderBy('id','desc')
                                    ->get();

        $legal = LegalComplaintsService::when($from_date != '' && $to_date != '',function($query) use($from_date,$to_date){
                                            return $query->whereDate('created_at','>=',$from_date)->whereDate('created_at','<=',$to_date);
                                        })
                                        ->where('branch_id',$branch_id)
                                        ->orderBy('id','desc')
                                        ->get();
        $immigration = ImmigrationGovementService::when($from_date != '' && $to_date != '',function($query) use($from_date,$to_date){
                                                return $query->whereDate('created_at','>=',$from_date)->whereDate('created_at','<=',$to_date);
                                            })
                                            ->where('branch_id',$branch_id)
                                            ->orderBy('id','desc')
                                            ->get();

       $other = Other::when($from_date != '' && $to_date != '',function($query) use($from_date,$to_date){
                                return $query->whereDate('created_at','>=',$from_date)->whereDate('created_at','<=',$to_date);
                            })
                        ->where('branch_id',$branch_id)
                        ->orderBy('id','desc')
                        ->get();

                        
                        
     

       // Here Option Means Passport Type , $option == -1 means All Type of Other Services $option == 0 means Premier, 1 means Express, 2 Legal,3 immigration, 4 Other.

        if ($option == -1) {
            $data = [
             'services' => $premier->concat($express)->concat($legal)->concat($immigration)->concat($other),
             'from_date' => $from_date,
             'to_date' => $to_date,
             'branch_id' => $branch_id,
             'option' => $option,
             'onload' => false,
             'excel_export' => true,
             'total_primier' => $premier->count(),
             'total_express' => $express->count(),
             'total_legal' => $legal->count(),
             'total_immigration' => $immigration->count(),
             'total_other' => $other->count(),
             
           ];
           if (isset($excel_export) && $excel_export == true) {
                return downloadExcel('BranchManager.report.otherServices.report_excel',$data,'all_services','xlsx');
           }
           return view('BranchManager.report.otherServices.report',$data);
        }

        if ($option == 0) {
            $data = [
            'services' => $premier,
            'from_date' => $from_date,
            'to_date' => $to_date,
            'branch_id' => $branch_id,
            'option' => $option,
            'onload' => false,
            'excel_export' => true,
           ];
           if (isset($excel_export) && $excel_export == true) {
                return downloadExcel('BranchManager.report.otherServices.report_excel',$data,'premier','xlsx');
            }
            return view('BranchManager.report.otherServices.report',$data);
        }
        
        if ($option == 1) {
            $data = [
                'services' =>$express, 
                'from_date' => $from_date,
                'to_date' => $to_date,
                'branch_id' => $branch_id,
                'option' => $option,
                'onload' => false,
                'excel_export' => true,
            ];
            if (isset($excel_export) && $excel_export == true) {
                return downloadExcel('BranchManager.report.otherServices.report_excel',$data,'express','xlsx');
            }
            return view('BranchManager.report.otherServices.report',$data);
        }

      if ($option == 2) {
        $data = [
            'services' => $legal,
            'from_date' => $from_date,
            'to_date' => $to_date,
            'branch_id' => $branch_id,
            'option' => $option,
            'onload' => false,
            'excel_export' => true,
        ];
        if (isset($excel_export) && $excel_export == true) {
            return downloadExcel('BranchManager.report.otherServices.report_excel',$data,'legal','xlsx');
        }
        return view('BranchManager.report.otherServices.report',$data);
      }

        if ($option == 3) {
            $data = [
                'services' => $immigration,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'branch_id' => $branch_id,
                'option' => $option,
                'onload' => false,
                'excel_export' => true,
            ];
            if (isset($excel_export) && $excel_export == true) {
                return downloadExcel('BranchManager.report.otherServices.report_excel',$data,'immigration','xlsx');
            }
            return view('BranchManager.report.otherServices.report',$data);
        }
        

        if ($option == 4) {
            $data = [
                'services' => $other,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'branch_id' => $branch_id,
                'option' => $option,
                'onload' => false,
                'excel_export' => true,
            ];
            if (isset($excel_export) && $excel_export == true) {
                return downloadExcel('BranchManager.report.otherServices.report_excel',$data,'other','xlsx');
            }
            return view('BranchManager.report.otherServices.report',$data);
        }

    }

   

}
