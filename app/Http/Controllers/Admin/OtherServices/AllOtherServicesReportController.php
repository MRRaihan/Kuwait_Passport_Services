<?php

namespace App\Http\Controllers\Admin\OtherServices;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\ExpressService;
use App\Models\PremierService;
use App\Models\LegalComplaintsService;
use App\Models\Other;
use App\Models\ImmigrationGovementService;
use Carbon\Carbon;

class AllOtherServicesReportController extends Controller
{

    public function index()
    {
        return $this->show('0');
    }

    public function show($option){

        $branch = isset($option) ? $option : 0;

        // total other services
        $total_premier_services = PremierService::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
                                                        return $query->where('branch_id', $branch);
                                                    })
                                                    ->count();

        $total_express_services = ExpressService::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
                                                    return $query->where('branch_id', $branch);
                                                })
                                                ->count();

        $total_legal_services = LegalComplaintsService::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
                                                            return $query->where('branch_id', $branch);
                                                        })
                                                        ->count();

        $total_immigration_services = ImmigrationGovementService::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
                                                                    return $query->where('branch_id', $branch);
                                                                })
                                                                ->count();

        $total_other_service = Other::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
                                        return $query->where('branch_id', $branch);
                                    })
                                    ->count();

        
         // total other services with branch
         $total_services = $total_premier_services + $total_express_services + $total_legal_services + $total_immigration_services + $total_other_service;

         // All type of daily Services with branch
        $daily_premier_service = PremierService::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
            return $query->where('branch_id', $branch);
        })
            ->whereDate('created_at', Carbon::today())
            ->count();

        $daily_express_service = ExpressService::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
            return $query->where('branch_id', $branch);
        })
            ->whereDate('created_at', Carbon::today())
            ->count();

        $daily_legal_service = LegalComplaintsService::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
            return $query->where('branch_id', $branch);
        })
            ->whereDate('created_at', Carbon::today())
            ->count();
        $daily_immigration_service = ImmigrationGovementService::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
            return $query->where('branch_id', $branch);
        })
            ->whereDate('created_at', Carbon::today())
            ->count();

        $daily_other_service = Other::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
            return $query->where('branch_id', $branch);
        })
            ->whereDate('created_at', Carbon::today())
            ->count();


        // All type of Monthly Services with branch
        $monthly_premier_service = PremierService::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
            return $query->where('branch_id', $branch);
        })
            ->where('created_at', '>', Carbon::now()->startOfMonth())
            ->where('created_at', '<', Carbon::now()->endOfMonth())
            ->count();

        $monthly_express_service = ExpressService::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
            return $query->where('branch_id', $branch);
        })
            ->where('created_at', '>', Carbon::now()->startOfMonth())
            ->where('created_at', '<', Carbon::now()->endOfMonth())
            ->count();

        $monthly_legal_service = LegalComplaintsService::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
            return $query->where('branch_id', $branch);
        })
            ->where('created_at', '>', Carbon::now()->startOfMonth())
            ->where('created_at', '<', Carbon::now()->endOfMonth())
            ->count();
        $monthly_immigration_service = ImmigrationGovementService::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
            return $query->where('branch_id', $branch);
        })
            ->where('created_at', '>', Carbon::now()->startOfMonth())
            ->where('created_at', '<', Carbon::now()->endOfMonth())
            ->count();

        $monthly_other_service = Other::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
            return $query->where('branch_id', $branch);
        })
            ->where('created_at', '>', Carbon::now()->startOfMonth())
            ->where('created_at', '<', Carbon::now()->endOfMonth())
            ->count();

        // All type of total services fee with branch
        $total_premier_service_fee = PremierService::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
            return $query->where('branch_id', $branch);
        })
            ->sum('total_fee');

        $total_express_service_fee = ExpressService::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
            return $query->where('branch_id', $branch);
        })
            ->sum('total_fee');

        $total_legal_service_fee = LegalComplaintsService::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
            return $query->where('branch_id', $branch);
        })
            ->sum('total_fee');
        $total_immigration_service_fee = ImmigrationGovementService::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
            return $query->where('branch_id', $branch);
        })
            ->sum('total_fee');

        $total_other_service_fee = Other::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
            return $query->where('branch_id', $branch);
        })
            ->sum('fee');

        // Total Passport Fee with branch
        $total_service_fee = $total_premier_service_fee + $total_express_service_fee + $total_legal_service_fee + $total_immigration_service_fee + $total_other_service_fee;


        // All type of daily services fee with branch
        $daily_premier_fee = PremierService::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
            return $query->where('branch_id', $branch);
        })
            ->whereDate('created_at', Carbon::today())
            ->sum('total_fee');

        $daily_express_fee = ExpressService::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
            return $query->where('branch_id', $branch);
        })
            ->whereDate('created_at', Carbon::today())
            ->sum('total_fee');

        $daily_legal_fee = LegalComplaintsService::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
            return $query->where('branch_id', $branch);
        })
            ->whereDate('created_at', Carbon::today())
            ->sum('total_fee');

        $daily_immigration_fee = ImmigrationGovementService::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
            return $query->where('branch_id', $branch);
        })
            ->whereDate('created_at', Carbon::today())
            ->sum('total_fee');

        $daily_other_fee = Other::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
            return $query->where('branch_id', $branch);
        })
            ->whereDate('created_at', Carbon::today())
            ->sum('fee');
        
            // All type of daily services fee with branch
        $monthly_premier_fee = PremierService::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
            return $query->where('branch_id', $branch);
        })
            ->where('created_at', '>', Carbon::now()->startOfMonth())
            ->where('created_at', '<', Carbon::now()->endOfMonth())
            ->sum('total_fee');

        $monthly_express_fee = ExpressService::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
            return $query->where('branch_id', $branch);
        })
            ->where('created_at', '>', Carbon::now()->startOfMonth())
            ->where('created_at', '<', Carbon::now()->endOfMonth())
            ->sum('total_fee');

        $monthly_legal_fee = LegalComplaintsService::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
            return $query->where('branch_id', $branch);
        })
            ->where('created_at', '>', Carbon::now()->startOfMonth())
            ->where('created_at', '<', Carbon::now()->endOfMonth())
            ->sum('total_fee');

        $monthly_immigration_fee = ImmigrationGovementService::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
            return $query->where('branch_id', $branch);
        })
            ->where('created_at', '>', Carbon::now()->startOfMonth())
            ->where('created_at', '<', Carbon::now()->endOfMonth())
            ->sum('total_fee');

        $monthly_other_fee = Other::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
            return $query->where('branch_id', $branch);
        })
            ->where('created_at', '>', Carbon::now()->startOfMonth())
            ->where('created_at', '<', Carbon::now()->endOfMonth())
            ->sum('fee');



        $data = [
            'branches' => Branch::orderBy('name', 'asc')->where('status', 1)->get(),
            'branch_id' => $branch,
            'option' => -1,

            'total_services' => $total_services,

            'total_premier_services' => $total_premier_services,
            'total_express_services' => $total_express_services,
            'total_legal_services' => $total_legal_services,
            'total_immigration_services' => $total_immigration_services,
            'total_other_service' => $total_other_service,

            'daily_premier_service' => $daily_premier_service,
            'daily_express_service' => $daily_express_service,
            'daily_legal_service' => $daily_legal_service,
            'daily_immigration_service' => $daily_immigration_service,
            'daily_other_service' => $daily_other_service,

            'monthly_premier_service' => $monthly_premier_service,
            'monthly_express_service' => $monthly_express_service,
            'monthly_legal_service' => $monthly_legal_service,
            'monthly_immigration_service' => $monthly_immigration_service,
            'monthly_other_service' => $monthly_other_service,

            'total_premier_service_fee' => $total_premier_service_fee,
            'total_express_service_fee' => $total_express_service_fee,
            'total_legal_service_fee' => $total_legal_service_fee,
            'total_immigration_service_fee' => $total_immigration_service_fee,
            'total_other_service_fee' => $total_other_service_fee,

            'total_service_fee' => $total_service_fee,

            'monthly_premier_fee' => $monthly_premier_fee,
            'monthly_express_fee' => $monthly_express_fee,
            'monthly_legal_fee' => $monthly_legal_fee,
            'monthly_immigration_fee' => $monthly_immigration_fee,
            'monthly_other_fee' => $monthly_other_fee,

            'daily_premier_fee' => $daily_premier_fee,
            'daily_express_fee' => $daily_express_fee,
            'daily_legal_fee' => $daily_legal_fee,
            'daily_immigration_fee' => $daily_immigration_fee,
            'daily_other_fee' => $daily_other_fee,
        ];
        return view('Admin.report.otherServices.all_other_report', $data);
    }
}
