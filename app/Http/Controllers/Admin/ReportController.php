<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\RenewPassport;
use App\Models\ManualPassport;
use App\Models\LostPassport;
use App\Models\NewBornBabyPassport;
use App\Models\Other;
use App\Models\ExpressService;
use App\Models\ImmigrationGovementService;
use App\Models\LegalComplaintsService;
use App\Models\PremierService;
use Carbon\Carbon;

class ReportController extends Controller
{

    public function index()
    {

        return $this->show('0');
    }

    public function show($option)
    {


        $branch = isset($option) ? $option : 0;

        //All type of total passort with branch
        $total_renew_passport = RenewPassport::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
                                                    return $query->where('branch_id', $branch);
                                                })
                                                ->count();

        $total_manual_passport = ManualPassport::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
                                                    return $query->where('branch_id', $branch);
                                                })
                                                ->count();
        $total_lost_passport = LostPassport::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
                                                return $query->where('branch_id', $branch);
                                            })
                                            ->count();


        $total_new_baby_passport = NewBornBabyPassport::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
            return $query->where('branch_id', $branch);
        })
            ->count();

        // Other Services Report
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


        // total  passport with branch
        $total_passport = $total_renew_passport + $total_manual_passport + $total_lost_passport + $total_new_baby_passport;

        // total other services with branch
        $total_services = $total_premier_services + $total_express_services + $total_legal_services + $total_immigration_services + $total_other_service;

        // All type of daily passport with branch
        $daily_renew_passport = RenewPassport::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
                                                return $query->where('branch_id', $branch);
                                            })
                                            ->whereDate('created_at', Carbon::today())
                                            ->count();

        $daily_manual_passport = ManualPassport::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
                                                    return $query->where('branch_id', $branch);
                                                })
                                                ->whereDate('created_at', Carbon::today())
                                                ->count();

        $daily_lost_passport = LostPassport::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
                                                return $query->where('branch_id', $branch);
                                            })
                                            ->whereDate('created_at', Carbon::today())
                                            ->count();

        $daily_new_baby_passport = NewBornBabyPassport::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
                                                        return $query->where('branch_id', $branch);
                                                    })
                                                    ->whereDate('created_at', Carbon::today())
                                                    ->count();

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


        // All type of Monthly passport with branch

        $monthly_renew_passport = RenewPassport::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
            return $query->where('branch_id', $branch);
        })
            ->where('created_at', '>', Carbon::now()->startOfMonth())
            ->where('created_at', '<', Carbon::now()->endOfMonth())
            ->count();
        $monthly_manual_passport = ManualPassport::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
            return $query->where('branch_id', $branch);
        })
            ->where('created_at', '>', Carbon::now()->startOfMonth())
            ->where('created_at', '<', Carbon::now()->endOfMonth())
            ->count();
        $monthly_lost_passport = LostPassport::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
            return $query->where('branch_id', $branch);
        })
            ->where('created_at', '>', Carbon::now()->startOfMonth())
            ->where('created_at', '<', Carbon::now()->endOfMonth())
            ->count();

        $monthly_new_baby_passport = NewBornBabyPassport::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
            return $query->where('branch_id', $branch);
        })
            ->where('created_at', '>', Carbon::now()->startOfMonth())
            ->where('created_at', '<', Carbon::now()->endOfMonth())
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

        // All type of total passport fee with branch
        $total_renew_passport_fee = RenewPassport::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
                                                    return $query->where('branch_id', $branch);
                                                })
                                                ->sum('passport_type_fees_total');
        $total_manual_passport_fee = ManualPassport::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
                                                        return $query->where('branch_id', $branch);
                                                    })
                                                    ->sum('passport_type_fees_total');

        $total_lost_passport_fee = LostPassport::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
                                                    return $query->where('branch_id', $branch);
                                                })
                                                ->sum('passport_type_fees_total');

        $total_new_baby_passport_fee = NewBornBabyPassport::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
                                                            return $query->where('branch_id', $branch);
                                                        })
                                                        ->sum('passport_type_fees_total');

        // Total Passport Fee with branch
        $total_passport_fee = $total_renew_passport_fee + $total_manual_passport_fee + $total_lost_passport_fee + $total_new_baby_passport_fee;

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


        // All type of daily passport fee with branch
        $daily_renew_passport_fee = RenewPassport::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
                                                    return $query->where('branch_id', $branch);
                                                })
                                                ->whereDate('created_at', Carbon::today())
                                                ->sum('passport_type_fees_total');

        $daily_manual_passport_fee = ManualPassport::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
                                        return $query->where('branch_id', $branch);
                                    })
                                    ->whereDate('created_at', Carbon::today())
                                    ->sum('passport_type_fees_total');

        $daily_lost_passport_fee = LostPassport::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
                                                    return $query->where('branch_id', $branch);
                                                })
                                                ->whereDate('created_at', Carbon::today())
                                                ->sum('passport_type_fees_total');

        $daily_new_baby_passport_fee = NewBornBabyPassport::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
                                                            return $query->where('branch_id', $branch);
                                                        })
                                                        ->whereDate('created_at', Carbon::today())
                                                        ->sum('passport_type_fees_total');


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

        // All type of monthly passport fee with branch
        $monthly_renew_passport_fee = RenewPassport::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
                                                        return $query->where('branch_id', $branch);
                                                    })
                                                    ->where('created_at', '>', Carbon::now()->startOfMonth())
                                                    ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                    ->sum('passport_type_fees_total');

        $monthly_manual_passport_fee = ManualPassport::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
                                                        return $query->where('branch_id', $branch);
                                                    })
                                                    ->where('created_at', '>', Carbon::now()->startOfMonth())
                                                    ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                    ->sum('passport_type_fees_total');

        $monthly_lost_passport_fee = LostPassport::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
                                                    return $query->where('branch_id', $branch);
                                                })
                                                ->where('created_at', '>', Carbon::now()->startOfMonth())
                                                ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                ->sum('passport_type_fees_total');

        $monthly_new_baby_passport_fee = NewBornBabyPassport::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
                                                                return $query->where('branch_id', $branch);
                                                            })
                                                            ->where('created_at', '>', Carbon::now()->startOfMonth())
                                                            ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                            ->sum('passport_type_fees_total');

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
            'option' => 0,

            'total_passport' => $total_passport,
            'total_services' => $total_services,

            'total_renew_passport' => $total_renew_passport,
            'total_manual_passport' => $total_manual_passport,
            'total_lost_passport' => $total_lost_passport,
            'total_new_baby_passport' => $total_new_baby_passport,


            'total_premier_services' => $total_premier_services,
            'total_express_services' => $total_express_services,
            'total_legal_services' => $total_legal_services,
            'total_immigration_services' => $total_immigration_services,
            'total_other_service' => $total_other_service,


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

            'monthly_renew_passport_fee' => $monthly_renew_passport_fee,
            'monthly_manual_passport_fee' => $monthly_manual_passport_fee,
            'monthly_lost_passport_fee' => $monthly_lost_passport_fee,
            'monthly_new_baby_passport_fee' => $monthly_new_baby_passport_fee,

            'monthly_premier_fee' => $monthly_premier_fee,
            'monthly_express_fee' => $monthly_express_fee,
            'monthly_legal_fee' => $monthly_legal_fee,
            'monthly_immigration_fee' => $monthly_immigration_fee,
            'monthly_other_fee' => $monthly_other_fee,

            'daily_renew_passport_fee' => $daily_renew_passport_fee,
            'daily_manual_passport_fee' => $daily_manual_passport_fee,
            'daily_lost_passport_fee' => $daily_lost_passport_fee,
            'daily_new_baby_passport_fee' => $daily_new_baby_passport_fee,

            'daily_premier_fee' => $daily_premier_fee,
            'daily_express_fee' => $daily_express_fee,
            'daily_legal_fee' => $daily_legal_fee,
            'daily_immigration_fee' => $daily_immigration_fee,
            'daily_immigration_fee' => $daily_immigration_fee,
            'daily_other_fee' => $daily_other_fee,

        ];
        return view('Admin.report.index', $data);
    }

    public function getReport($data)
    {

        $from_date = explode('&', $data)[0] ? explode('&', $data)[0] : '';
        $to_date = explode('&', $data)[1] ? explode('&', $data)[1] : '';
        $branch_id = explode('&', $data)[2] ? explode('&', $data)[2] : 0;
        $option = explode('&', $data)[3];


        $lost = LostPassport::when($branch_id > 0, function ($query) use ($branch_id) {
            return $query->where('branch_id', $branch_id);
        })
            ->when($from_date != '' && $to_date != '', function ($query) use ($from_date, $to_date) {
                return $query->whereDate('created_at', '>=', $from_date)->whereDate('created_at', '<=', $to_date);
            })
            ->orderBy('id', 'desc')
            ->get();

        $manual = ManualPassport::when($branch_id > 0, function ($query) use ($branch_id) {
            return $query->where('branch_id', $branch_id);
        })
            ->when($from_date != '' && $to_date != '', function ($query) use ($from_date, $to_date) {
                return $query->whereDate('created_at', '>=', $from_date)->whereDate('created_at', '<=', $to_date);
            })
            ->orderBy('id', 'desc')
            ->get();

        $renew = RenewPassport::when($branch_id > 0, function ($query) use ($branch_id) {
            return $query->where('branch_id', $branch_id);
        })
            ->when($from_date != '' && $to_date != '', function ($query) use ($from_date, $to_date) {
                return $query->whereDate('created_at', '>=', $from_date)->whereDate('created_at', '<=', $to_date);
            })
            ->orderBy('id', 'desc')
            ->get();



        $new_born_baby = NewBornBabyPassport::when($branch_id > 0, function ($query) use ($branch_id) {
            return $query->where('branch_id', $branch_id);
        })
            ->when($from_date != '' && $to_date != '', function ($query) use ($from_date, $to_date) {
                return $query->whereDate('created_at', '>=', $from_date)->whereDate('created_at', '<=', $to_date);
            })
            ->orderBy('id', 'desc')
            ->get();

        // Here Option Means Passport Type , $option == -1 means All Type of Passport $option == 0 means Lost Passport, 1 means Manual, 2 Renew, 3 New Bron Baby.

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
            return view('Admin.report.search_report', $data);
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

            return view('Admin.report.search_report', $data);
        }

        if ($option == 1) {
            $data = [
                'passports' => $manual,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'branch_id' => $branch_id,
                'option' => $option,
                'onload' => false,
            ];
            return view('Admin.report.search_report', $data);
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
            return view('Admin.report.search_report', $data);
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
            return view('Admin.report.search_report', $data);
        }
    }

    public function excelExport($data)
    {

        $from_date = explode('&', $data)[0] ? explode('&', $data)[0] : '';
        $to_date = explode('&', $data)[1] ? explode('&', $data)[1] : '';
        $branch_id = explode('&', $data)[2] ? explode('&', $data)[2] : 0;
        $option = explode('&', $data)[3];



        $lost = LostPassport::when($branch_id > 0, function ($query) use ($branch_id) {
            return $query->where('branch_id', $branch_id);
        })
            ->when($from_date != '' && $to_date != '', function ($query) use ($from_date, $to_date) {
                return $query->whereDate('created_at', '>=', $from_date)->whereDate('created_at', '<=', $to_date);
            })
            ->orderBy('id', 'desc')
            ->get();

        $manual = ManualPassport::when($branch_id > 0, function ($query) use ($branch_id) {
            return $query->where('branch_id', $branch_id);
        })
            ->when($from_date != '' && $to_date != '', function ($query) use ($from_date, $to_date) {
                return $query->whereDate('created_at', '>=', $from_date)->whereDate('created_at', '<=', $to_date);
            })
            ->orderBy('id', 'desc')
            ->get();

        $renew = RenewPassport::when($branch_id > 0, function ($query) use ($branch_id) {
            return $query->where('branch_id', $branch_id);
        })
            ->when($from_date != '' && $to_date != '', function ($query) use ($from_date, $to_date) {
                return $query->whereDate('created_at', '>=', $from_date)->whereDate('created_at', '<=', $to_date);
            })
            ->orderBy('id', 'desc')
            ->get();

        $new_born_baby = NewBornBabyPassport::when($branch_id > 0, function ($query) use ($branch_id) {
            return $query->where('branch_id', $branch_id);
        })
            ->when($from_date != '' && $to_date != '', function ($query) use ($from_date, $to_date) {
                return $query->whereDate('created_at', '>=', $from_date)->whereDate('created_at', '<=', $to_date);
            })
            ->orderBy('id', 'desc')
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

            return downloadExcel('Admin.report.all_report_excel', $data, 'all_passport', 'xlsx');
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

            return downloadExcel('Admin.report.all_report_excel', $data, 'renew_passport', 'xlsx');
        }

        if ($option == 1) {
            $data = [
                'passports' => $manual,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'branch_id' => $branch_id,
                'option' => $option,
                'onload' => false,
            ];
            return downloadExcel('Admin.report.all_report_excel', $data, 'manual_passport', 'xlsx');
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
            return downloadExcel('Admin.report.all_report_excel', $data, 'lost_passport', 'xlsx');
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
            return downloadExcel('Admin.report.all_report_excel', $data, 'new_born_baby_passport', 'xlsx');
        }
    }





    public function shiftReport()
    {
        $branch = 0;
        $data = [

            'branches' => Branch::orderBy('name', 'asc')->where('status', 1)->get(),

            'branch_id' => $branch,
            'option' => 0,
        ];

        return view('Admin.report.shift_to_embassy', $data);
    }



    public function getShiftReport($data)
    {
        $from_date = explode('&', $data)[0] ? explode('&', $data)[0] : '';
        $to_date = explode('&', $data)[1] ? explode('&', $data)[1] : '';
        $branch_id = explode('&', $data)[2] ? explode('&', $data)[2] : 0;

        $option = explode('&', $data)[3];

        if (isset(explode('&', $data)[4])) {
            $shift_to_embassy = explode('&', $data)[4] ? explode('&', $data)[4] : false;
        }



        $lost = LostPassport::when($branch_id > 0, function ($query) use ($branch_id) {
            return $query->where('branch_id', $branch_id);
        })
            ->when($from_date != '' && $to_date != '', function ($query) use ($from_date, $to_date) {
                return $query->whereDate('updated_at', '>=', $from_date)->whereDate('updated_at', '<=', $to_date);
            })
            ->where('embassy_status', 1)
            ->orderBy('id', 'desc')
            ->get();

        $manual = ManualPassport::when($branch_id > 0, function ($query) use ($branch_id) {
            return $query->where('branch_id', $branch_id);
        })
            ->when($from_date != '' && $to_date != '', function ($query) use ($from_date, $to_date) {
                return $query->whereDate('updated_at', '>=', $from_date)->whereDate('updated_at', '<=', $to_date);
            })
            ->where('embassy_status', 1)
            ->orderBy('id', 'desc')
            ->get();

        $renew = RenewPassport::when($branch_id > 0, function ($query) use ($branch_id) {
            return $query->where('branch_id', $branch_id);
        })
            ->when($from_date != '' && $to_date != '', function ($query) use ($from_date, $to_date) {
                return $query->whereDate('updated_at', '>=', $from_date)->whereDate('updated_at', '<=', $to_date);
            })
            ->where('embassy_status', 1)
            ->orderBy('id', 'desc')
            ->get();

        $new_born_baby = NewBornBabyPassport::when($branch_id > 0, function ($query) use ($branch_id) {
            return $query->where('branch_id', $branch_id);
        })
            ->when($from_date != '' && $to_date != '', function ($query) use ($from_date, $to_date) {
                return $query->whereDate('updated_at', '>=', $from_date)->whereDate('updated_at', '<=', $to_date);
            })
            ->where('embassy_status', 1)
            ->orderBy('id', 'desc')
            ->get();

        // Here Option == -1 means all passport , option = 0 means renew Passport 1 means manual 2 means lost 3 menas other and 4 menas new born baby
        if ($option == -1) {
            $data = [
                'passports' => $renew->concat($manual)->concat($lost)->concat($new_born_baby),
                'from_date' => $from_date,
                'to_date' => $to_date,
                'branch_id' => $branch_id,
                'option' => $option,
                'onload' => false,
                'shift_to_embassy' => true,
                'total_renew' => $renew->count(),
                'total_manual' => $manual->count(),
                'total_lost' => $lost->count(),
                'total_new_born_baby' => $new_born_baby->count(),
            ];
            if (isset($shift_to_embassy) && $shift_to_embassy == true) {
                return downloadExcel('Admin.report.all_report_excel', $data, 'all_passport', 'xlsx');
            } else {
                return view('Admin.report.search_report', $data);
            }
        }

        if ($option == 0) {
            $data = [
                'passports' => $renew,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'branch_id' => $branch_id,
                'option' => $option,
                'onload' => false,
                'shift_to_embassy' => true,
            ];

            if (isset($shift_to_embassy) && $shift_to_embassy == true) {
                return downloadExcel('Admin.report.all_report_excel', $data, 'renew_passport', 'xlsx');
            } else {
                return view('Admin.report.search_report', $data);
            }
        }

        if ($option == 1) {
            $data = [
                'passports' => $manual,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'branch_id' => $branch_id,
                'option' => $option,
                'onload' => false,
                'shift_to_embassy' => true,
            ];
            if (isset($shift_to_embassy) && $shift_to_embassy == true) {
                return downloadExcel('Admin.report.all_report_excel', $data, 'manual_passport', 'xlsx');
            } else {
                return view('Admin.report.search_report', $data);
            }
        }

        if ($option == 2) {
            $data = [
                'passports' => $lost,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'branch_id' => $branch_id,
                'option' => $option,
                'onload' => false,
                'shift_to_embassy' => true,
            ];
            if (isset($shift_to_embassy) && $shift_to_embassy == true) {
                return downloadExcel('Admin.report.all_report_excel', $data, 'lost_passport', 'xlsx');
            } else {
                return view('Admin.report.search_report', $data);
            }
        }

        if ($option == 3) {
            $data = [
                'passports' => $new_born_baby,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'branch_id' => $branch_id,
                'option' => $option,
                'onload' => false,
                'shift_to_embassy' => true,
            ];
            if (isset($shift_to_embassy) && $shift_to_embassy == true) {
                return downloadExcel('Admin.report.all_report_excel', $data, 'new_born_baby_passport', 'xlsx');
            } else {
                return view('Admin.report.search_report', $data);
            }
        }
    }



    public function receiveReport()
    {
        $branch = 0;
        $data = [

            'branches' => Branch::orderBy('name', 'asc')->where('status', 1)->get(),

            'branch_id' => $branch,
            'option' => 0,
        ];

        return view('Admin.report.receive_from_embassy', $data);
    }

    public function getReceiveReport($data)
    {
        $from_date = explode('&', $data)[0] ? explode('&', $data)[0] : '';
        $to_date = explode('&', $data)[1] ? explode('&', $data)[1] : '';
        $branch_id = explode('&', $data)[2] ? explode('&', $data)[2] : 0;
        $option = explode('&', $data)[3];

        if (isset(explode('&', $data)[4])) {
            $receive_from_embassy = explode('&', $data)[4] ? explode('&', $data)[4] : false;
        }

        $lost = LostPassport::when($branch_id > 0, function ($query) use ($branch_id) {
            return $query->where('branch_id', $branch_id);
        })
            ->when($from_date != '' && $to_date != '', function ($query) use ($from_date, $to_date) {
                return $query->whereDate('updated_at', '>=', $from_date)->whereDate('updated_at', '<=', $to_date);
            })
            ->where('embassy_status', 3)
            ->where('branch_status', '<=', 0)
            ->orderBy('id', 'desc')
            ->get();

        $manual = ManualPassport::when($branch_id > 0, function ($query) use ($branch_id) {
            return $query->where('branch_id', $branch_id);
        })
            ->when($from_date != '' && $to_date != '', function ($query) use ($from_date, $to_date) {
                return $query->whereDate('updated_at', '>=', $from_date)->whereDate('updated_at', '<=', $to_date);
            })
            ->where('embassy_status', 3)
            ->where('branch_status', '<=', 0)
            ->orderBy('id', 'desc')
            ->get();

        $renew = RenewPassport::when($branch_id > 0, function ($query) use ($branch_id) {
            return $query->where('branch_id', $branch_id);
        })
            ->when($from_date != '' && $to_date != '', function ($query) use ($from_date, $to_date) {
                return $query->whereDate('updated_at', '>=', $from_date)->whereDate('updated_at', '<=', $to_date);
            })
            ->where('embassy_status', 3)
            ->where('branch_status', '<=', 0)
            ->orderBy('id', 'desc')
            ->get();

        $new_born_baby = NewBornBabyPassport::when($branch_id > 0, function ($query) use ($branch_id) {
            return $query->where('branch_id', $branch_id);
        })
            ->when($from_date != '' && $to_date != '', function ($query) use ($from_date, $to_date) {
                return $query->whereDate('updated_at', '>=', $from_date)->whereDate('updated_at', '<=', $to_date);
            })
            ->where('embassy_status', 3)
            ->where('branch_status', '<=', 0)
            ->orderBy('id', 'desc')
            ->get();

        // Here Option == -1 means all passport , option = 0 means renew Passport 1 means manual 2 means lost 3 menas other and 4 menas new born baby
        if ($option == -1) {
            $data = [
                'passports' => $renew->concat($manual)->concat($lost)->concat($new_born_baby),
                'from_date' => $from_date,
                'to_date' => $to_date,
                'branch_id' => $branch_id,
                'option' => $option,
                'onload' => false,
                'receive_from_embassy' => true,
                'total_renew' => $renew->count(),
                'total_manual' => $manual->count(),
                'total_lost' => $lost->count(),
                'total_new_born_baby' => $new_born_baby->count(),
            ];
            if (isset($receive_from_embassy) && $receive_from_embassy == true) {
                return downloadExcel('Admin.report.all_report_excel', $data, 'all_recieve_passport', 'xlsx');
            } else {
                return view('Admin.report.search_report', $data);
            }
        }

        if ($option == 0) {
            $data = [
                'passports' => $renew,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'branch_id' => $branch_id,
                'option' => $option,
                'onload' => false,
                'receive_from_embassy' => true,
            ];

            if (isset($receive_from_embassy) && $receive_from_embassy == true) {
                return downloadExcel('Admin.report.all_report_excel', $data, 'recieve_renew_passport', 'xlsx');
            } else {
                return view('Admin.report.search_report', $data);
            }
        }

        if ($option == 1) {
            $data = [
                'passports' => $manual,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'branch_id' => $branch_id,
                'option' => $option,
                'onload' => false,
                'receive_from_embassy' => true,
            ];
            if (isset($receive_from_embassy) && $receive_from_embassy == true) {
                return downloadExcel('Admin.report.all_report_excel', $data, 'recieve_manual_passport', 'xlsx');
            } else {
                return view('Admin.report.search_report', $data);
            }
        }

        if ($option == 2) {
            $data = [
                'passports' => $lost,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'branch_id' => $branch_id,
                'option' => $option,
                'onload' => false,
                'receive_from_embassy' => true,
            ];
            if (isset($receive_from_embassy) && $receive_from_embassy == true) {
                return downloadExcel('Admin.report.all_report_excel', $data, 'recieve_lost_passport', 'xlsx');
            } else {
                return view('Admin.report.search_report', $data);
            }
        }

        if ($option == 3) {
            $data = [
                'passports' => $new_born_baby,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'branch_id' => $branch_id,
                'option' => $option,
                'onload' => false,
                'receive_from_embassy' => true,
            ];
            if (isset($receive_from_embassy) && $receive_from_embassy == true) {
                return downloadExcel('Admin.report.all_report_excel', $data, 'recieve_new_born_baby_passport', 'xlsx');
            } else {
                return view('Admin.report.search_report', $data);
            }
        }
    }


    public function deliveryToBranchReport()
    {
        $branch = 0;
        $data = [
            'branches' => Branch::orderBy('name', 'asc')->where('status', 1)->get(),
            'branch_id' => $branch,
            'option' => 0,
        ];

        return view('Admin.report.delivery_to_branch', $data);
    }

    public function getDeliveryToBranchReport($data)
    {
        $from_date = explode('&', $data)[0] ? explode('&', $data)[0] : '';
        $to_date = explode('&', $data)[1] ? explode('&', $data)[1] : '';
        $branch_id = explode('&', $data)[2] ? explode('&', $data)[2] : 0;
        $option = explode('&', $data)[3];

        if (isset(explode('&', $data)[4])) {
            $delivery_to_branch = explode('&', $data)[4] ? explode('&', $data)[4] : false;
        }

        $lost = LostPassport::when($branch_id > 0, function ($query) use ($branch_id) {
            return $query->where('branch_id', $branch_id);
        })
            ->when($from_date != '' && $to_date != '', function ($query) use ($from_date, $to_date) {
                return $query->whereDate('updated_at', '>=', $from_date)->whereDate('updated_at', '<=', $to_date);
            })
            ->where('branch_status', 1)
            ->orderBy('id', 'desc')
            ->get();

        $manual = ManualPassport::when($branch_id > 0, function ($query) use ($branch_id) {
            return $query->where('branch_id', $branch_id);
        })
            ->when($from_date != '' && $to_date != '', function ($query) use ($from_date, $to_date) {
                return $query->whereDate('updated_at', '>=', $from_date)->whereDate('updated_at', '<=', $to_date);
            })
            ->where('branch_status', 1)
            ->orderBy('id', 'desc')
            ->get();

        $renew = RenewPassport::when($branch_id > 0, function ($query) use ($branch_id) {
            return $query->where('branch_id', $branch_id);
        })
            ->when($from_date != '' && $to_date != '', function ($query) use ($from_date, $to_date) {
                return $query->whereDate('updated_at', '>=', $from_date)->whereDate('updated_at', '<=', $to_date);
            })
            ->where('branch_status', 1)
            ->orderBy('id', 'desc')
            ->get();

        $new_born_baby = NewBornBabyPassport::when($branch_id > 0, function ($query) use ($branch_id) {
            return $query->where('branch_id', $branch_id);
        })
            ->when($from_date != '' && $to_date != '', function ($query) use ($from_date, $to_date) {
                return $query->whereDate('updated_at', '>=', $from_date)->whereDate('updated_at', '<=', $to_date);
            })
            ->where('branch_status', 1)
            ->orderBy('id', 'desc')
            ->get();

        // Here Option == -1 means all passport , option = 0 means renew Passport 1 means manual 2 means lost 3 menas other and 4 menas new born baby

        if ($option == -1) {
            $data = [
                'passports' => $renew->concat($manual)->concat($lost)->concat($new_born_baby),
                'from_date' => $from_date,
                'to_date' => $to_date,
                'branch_id' => $branch_id,
                'option' => $option,
                'onload' => false,
                'delivery_to_branch' => true,
                'total_renew' => $renew->count(),
                'total_manual' => $manual->count(),
                'total_lost' => $lost->count(),
                'total_new_born_baby' => $new_born_baby->count(),
            ];
            if (isset($delivery_to_branch) && $delivery_to_branch == true) {
                return downloadExcel('Admin.report.all_report_excel', $data, 'delivery_branch_all_passport', 'xlsx');
            } else {
                return view('Admin.report.search_report', $data);
            }
        }

        if ($option == 0) {
            $data = [
                'passports' => $renew,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'branch_id' => $branch_id,
                'option' => $option,
                'onload' => false,
                'delivery_to_branch' => true,
            ];

            if (isset($delivery_to_branch) && $delivery_to_branch == true) {
                return downloadExcel('Admin.report.all_report_excel', $data, 'delivery_branch_renew_passport', 'xlsx');
            } else {
                return view('Admin.report.search_report', $data);
            }
        }

        if ($option == 1) {
            $data = [
                'passports' => $manual,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'branch_id' => $branch_id,
                'option' => $option,
                'onload' => false,
                'delivery_to_branch' => true,
            ];
            if (isset($delivery_to_branch) && $delivery_to_branch == true) {
                return downloadExcel('Admin.report.all_report_excel', $data, 'delivery_branch_manual_passport', 'xlsx');
            } else {
                return view('Admin.report.search_report', $data);
            }
        }

        if ($option == 2) {
            $data = [
                'passports' => $lost,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'branch_id' => $branch_id,
                'option' => $option,
                'onload' => false,
                'delivery_to_branch' => true,
            ];
            if (isset($delivery_to_branch) && $delivery_to_branch == true) {
                return downloadExcel('Admin.report.all_report_excel', $data, 'delivery_branch_lost_passport', 'xlsx');
            } else {
                return view('Admin.report.search_report', $data);
            }
        }

        if ($option == 3) {
            $data = [
                'passports' => $new_born_baby,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'branch_id' => $branch_id,
                'option' => $option,
                'onload' => false,
                'delivery_to_branch' => true,
            ];
            if (isset($delivery_to_branch) && $delivery_to_branch == true) {
                return downloadExcel('Admin.report.all_report_excel', $data, 'delivery_branch_new_born_baby_passport', 'xlsx');
            } else {
                return view('Admin.report.search_report', $data);
            }
        }
    }
    



    public function deliveryReport()
    {

        return $this->deliveryView('0');
        
    }

    public function deliveryView($option){

        $branch = isset($option) ? $option : 0;

        //All type of total passort with branch
        $total_renew_passport = RenewPassport::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
                                                return $query->where('branch_id', $branch);
                                            })
                                            ->where('branch_status',3)
                                            ->count();
        $total_manual_passport = ManualPassport::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
                                                    return $query->where('branch_id', $branch);
                                                })
                                                ->where('branch_status',3)
                                                ->count();
        $total_lost_passport = LostPassport::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
                                                return $query->where('branch_id', $branch);
                                            })
                                            ->where('branch_status',3)
                                            ->count();
        $total_new_baby_passport = NewBornBabyPassport::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
                                                            return $query->where('branch_id', $branch);
                                                        })
                                                        ->where('branch_status',3)
                                                        ->count();

        // total  passport with brach
        $total_passport = $total_renew_passport + $total_manual_passport + $total_lost_passport + $total_new_baby_passport;

        // All type of daily passport with branch
        $daily_renew_passport = RenewPassport::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
                                                return $query->where('branch_id', $branch);
                                            })
                                            ->whereDate('created_at', Carbon::today())
                                            ->where('branch_status',3)
                                            ->count();

        $daily_manual_passport = ManualPassport::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
                                                        return $query->where('branch_id', $branch);
                                                })
                                                ->whereDate('created_at', Carbon::today())
                                                ->where('branch_status',3)
                                                ->count();

        $daily_lost_passport = LostPassport::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
                                                return $query->where('branch_id', $branch);
                                            })
                                            ->whereDate('created_at', Carbon::today())
                                            ->where('branch_status',3)
                                            ->count();

        $daily_new_baby_passport = NewBornBabyPassport::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
                                                            return $query->where('branch_id', $branch);
                                                        })
                                                        ->whereDate('created_at', Carbon::today())
                                                        ->where('branch_status',3)
                                                        ->count();

        // All type of Monthly passport with branch

        $monthly_renew_passport = RenewPassport::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
                                                    return $query->where('branch_id', $branch);
                                                })
                                                ->where('created_at', '>', Carbon::now()->startOfMonth())
                                                ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                ->where('branch_status',3)
                                                ->count();
        $monthly_manual_passport = ManualPassport::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
                                                        return $query->where('branch_id', $branch);
                                                })
                                                ->where('created_at', '>', Carbon::now()->startOfMonth())
                                                ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                ->where('branch_status',3)
                                                ->count();
        $monthly_lost_passport = LostPassport::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
                                                    return $query->where('branch_id', $branch);
                                            })
                                            ->where('created_at', '>', Carbon::now()->startOfMonth())
                                            ->where('created_at', '<', Carbon::now()->endOfMonth())
                                            ->where('branch_status',3)
                                            ->count();

        $monthly_new_baby_passport = NewBornBabyPassport::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
                                                        return $query->where('branch_id', $branch);
                                                    })
                                                    ->where('created_at', '>', Carbon::now()->startOfMonth())
                                                    ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                    ->where('branch_status',3)
                                                    ->count();

        // All type of total passport fee with branch
        $total_renew_passport_fee = RenewPassport::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
                                                    return $query->where('branch_id', $branch);
                                                })
                                                ->where('branch_status',3)
                                                ->sum('passport_type_fees_total');
        $total_manual_passport_fee = ManualPassport::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
                                                        return $query->where('branch_id', $branch);
                                                })
                                                ->where('branch_status',3)
                                                ->sum('passport_type_fees_total');

        $total_lost_passport_fee = LostPassport::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
                                            return $query->where('branch_id', $branch);
                                        })
                                        ->where('branch_status',3)
                                        ->sum('passport_type_fees_total');

        $total_new_baby_passport_fee = NewBornBabyPassport::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
                                                            return $query->where('branch_id', $branch);
                                                        })
                                                        ->where('branch_status',3)
                                                        ->sum('passport_type_fees_total');

        // Total Passport Fee with branch
        $total_passport_fee = $total_renew_passport_fee + $total_manual_passport_fee + $total_lost_passport_fee + $total_new_baby_passport_fee;


        // All type of daily passport fee with branch
        $daily_renew_passport_fee = RenewPassport::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
                                                    return $query->where('branch_id', $branch);
                                                })
                                                ->whereDate('created_at', Carbon::today())
                                                ->where('branch_status',3)
                                                ->sum('passport_type_fees_total');

        $daily_manual_passport_fee = ManualPassport::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
                                                        return $query->where('branch_id', $branch);
                                                    })
                                                    ->whereDate('created_at', Carbon::today())
                                                    ->where('branch_status',3)
                                                    ->sum('passport_type_fees_total');

        $daily_lost_passport_fee = LostPassport::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
                                                    return $query->where('branch_id', $branch);
                                                })
                                                ->whereDate('created_at', Carbon::today())
                                                ->where('branch_status',3)
                                                ->sum('passport_type_fees_total');

        $daily_new_baby_passport_fee = NewBornBabyPassport::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
                                                            return $query->where('branch_id', $branch);
                                                        })
                                                        ->whereDate('created_at', Carbon::today())
                                                        ->where('branch_status',3)
                                                        ->sum('passport_type_fees_total');

        // All type of monthly passport fee with branch
        $monthly_renew_passport_fee = RenewPassport::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
                                                        return $query->where('branch_id', $branch);
                                                    })
                                                    ->where('created_at', '>', Carbon::now()->startOfMonth())
                                                    ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                    ->where('branch_status',3)
                                                    ->sum('passport_type_fees_total');

        $monthly_manual_passport_fee = ManualPassport::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
                                                        return $query->where('branch_id', $branch);
                                                    })
                                                    ->where('created_at', '>', Carbon::now()->startOfMonth())
                                                    ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                    ->where('branch_status',3)
                                                    ->sum('passport_type_fees_total');

        $monthly_lost_passport_fee = LostPassport::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
                                                    return $query->where('branch_id', $branch);
                                                })
                                                ->where('created_at', '>', Carbon::now()->startOfMonth())
                                                ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                ->where('branch_status',3)
                                                ->sum('passport_type_fees_total');

        $monthly_new_baby_passport_fee = NewBornBabyPassport::when(isset($branch) && $branch > 0, function ($query) use ($branch) {
                                                            return $query->where('branch_id', $branch);
                                                        })
                                                        ->where('created_at', '>', Carbon::now()->startOfMonth())
                                                        ->where('created_at', '<', Carbon::now()->endOfMonth())
                                                        ->where('branch_status',3)
                                                        ->sum('passport_type_fees_total');


         $data = [
            'branches' => Branch::orderBy('name', 'asc')->where('status', 1)->get(),
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
        return view('Admin.report.delivery', $data);
    }





    public function getDeliveryReport($data)
    {
        $from_date = explode('&', $data)[0] ? explode('&', $data)[0] : '';
        $to_date = explode('&', $data)[1] ? explode('&', $data)[1] : '';
        $branch_id = explode('&', $data)[2] ? explode('&', $data)[2] : 0;
        $option = explode('&', $data)[3];

        if (isset(explode('&', $data)[4])) {
            $delivery_to_user = explode('&', $data)[4] ? explode('&', $data)[4] : false;
        }

        $lost = LostPassport::when($branch_id > 0, function ($query) use ($branch_id) {
            return $query->where('branch_id', $branch_id);
        })
            ->when($from_date != '' && $to_date != '', function ($query) use ($from_date, $to_date) {
                return $query->whereDate('updated_at', '>=', $from_date)->whereDate('updated_at', '<=', $to_date);
            })
            ->where('branch_status', 3)
            ->orderBy('id', 'desc')
            ->get();

        $manual = ManualPassport::when($branch_id > 0, function ($query) use ($branch_id) {
            return $query->where('branch_id', $branch_id);
        })
            ->when($from_date != '' && $to_date != '', function ($query) use ($from_date, $to_date) {
                return $query->whereDate('updated_at', '>=', $from_date)->whereDate('updated_at', '<=', $to_date);
            })
            ->where('branch_status', 3)
            ->orderBy('id', 'desc')
            ->get();

        $renew = RenewPassport::when($branch_id > 0, function ($query) use ($branch_id) {
            return $query->where('branch_id', $branch_id);
        })
            ->when($from_date != '' && $to_date != '', function ($query) use ($from_date, $to_date) {
                return $query->whereDate('updated_at', '>=', $from_date)->whereDate('updated_at', '<=', $to_date);
            })
            ->where('branch_status', 3)
            ->orderBy('id', 'desc')
            ->get();

        $new_born_baby = NewBornBabyPassport::when($branch_id > 0, function ($query) use ($branch_id) {
            return $query->where('branch_id', $branch_id);
        })
            ->when($from_date != '' && $to_date != '', function ($query) use ($from_date, $to_date) {
                return $query->whereDate('updated_at', '>=', $from_date)->whereDate('updated_at', '<=', $to_date);
            })
            ->where('branch_status', 3)
            ->orderBy('id', 'desc')
            ->get();

        // Here Option == -1 means all passport , option = 0 means renew Passport 1 means manual 2 means lost 3 menas other and 4 menas new born baby

        if ($option == -1) {
            $data = [
                'passports' => $renew->concat($manual)->concat($lost)->concat($new_born_baby),
                'from_date' => $from_date,
                'to_date' => $to_date,
                'branch_id' => $branch_id,
                'option' => $option,
                'onload' => false,
                'delivery' => true,
                'total_renew' => $renew->count(),
                'total_manual' => $manual->count(),
                'total_lost' => $lost->count(),
                'total_new_born_baby' => $new_born_baby->count(),
            ];
            if (isset($delivery_to_user) && $delivery_to_user == true) {
                return downloadExcel('Admin.report.all_report_excel', $data, 'delivery_user_all_passport', 'xlsx');
            } else {
                return view('Admin.report.search_report', $data);
            }
        }

        if ($option == 0) {
            $data = [
                'passports' => $renew,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'branch_id' => $branch_id,
                'option' => $option,
                'onload' => false,
                'delivery' => true,
            ];

            if (isset($delivery_to_user) && $delivery_to_user == true) {
                return downloadExcel('Admin.report.all_report_excel', $data, 'delivery_user_renew_passport', 'xlsx');
            } else {
                return view('Admin.report.search_report', $data);
            }
        }

        if ($option == 1) {
            $data = [
                'passports' => $manual,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'branch_id' => $branch_id,
                'option' => $option,
                'onload' => false,
                'delivery' => true,
            ];
            if (isset($delivery_to_user) && $delivery_to_user == true) {
                return downloadExcel('Admin.report.all_report_excel', $data, 'delivery_user_manual_passport', 'xlsx');
            } else {
                return view('Admin.report.search_report', $data);
            }
        }

        if ($option == 2) {
            $data = [
                'passports' => $lost,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'branch_id' => $branch_id,
                'option' => $option,
                'onload' => false,
                'delivery' => true,
            ];
            if (isset($delivery_to_user) && $delivery_to_user == true) {
                return downloadExcel('Admin.report.all_report_excel', $data, 'delivery_user_lost_passport', 'xlsx');
            } else {
                return view('Admin.report.search_report', $data);
            }
        }

        if ($option == 3) {
            $data = [
                'passports' => $new_born_baby,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'branch_id' => $branch_id,
                'option' => $option,
                'onload' => false,
                'delivery' => true,
            ];
            if (isset($delivery_to_user) && $delivery_to_user == true) {
                return downloadExcel('Admin.report.all_report_excel', $data, 'delivery_user_new_born_baby_passport', 'xlsx');
            } else {
                return view('Admin.report.search_report', $data);
            }
        }
    }
}
