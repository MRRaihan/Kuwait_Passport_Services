<?php

namespace App\Http\Controllers\DataEnterer\OtherServices;

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
use Illuminate\Support\Str;

class OtherServicesReportController extends Controller
{
    public function getReport($data)
    {

        $from_date = explode('&', $data)[0] ? explode('&', $data)[0] : '';
        $to_date = explode('&', $data)[1] ? explode('&', $data)[1] : '';
        $option = explode('&', $data)[2];

        if (isset(explode('&', $data)[3])) {
            $excel_export = explode('&', $data)[3] ? explode('&', $data)[3] : 0;
        }

        $creator_id = Auth::user()->id;
        $branch_id = Auth::user()->branch_id;


        $premier = PremierService::when($from_date != '' && $to_date != '', function ($query) use ($from_date, $to_date) {
                                        return $query->whereDate('created_at', '>=', $from_date)->whereDate('created_at', '<=', $to_date);
                                    })
                                    ->where('creator_id',$creator_id)
                                    ->orderBy('id', 'desc')
                                    ->get();

        $express = ExpressService::when($from_date != '' && $to_date != '', function ($query) use ($from_date, $to_date) {
                                        return $query->whereDate('created_at', '>=', $from_date)->whereDate('created_at', '<=', $to_date);
                                    })
                                    ->where('creator_id',$creator_id)
                                    ->orderBy('id', 'desc')
                                    ->get();

        $legal = LegalComplaintsService::when($from_date != '' && $to_date != '', function ($query) use ($from_date, $to_date) {
                                            return $query->whereDate('created_at', '>=', $from_date)->whereDate('created_at', '<=', $to_date);
                                        })
                                        ->where('creator_id',$creator_id)
                                        ->orderBy('id', 'desc')
                                        ->get();
        $immigration = ImmigrationGovementService::when($from_date != '' && $to_date != '', function ($query) use ($from_date, $to_date) {
                                                        return $query->whereDate('created_at', '>=', $from_date)->whereDate('created_at', '<=', $to_date);
                                                    })
                                                    ->where('creator_id',$creator_id)
                                                    ->orderBy('id', 'desc')
                                                    ->get();

        $other = Other::when($from_date != '' && $to_date != '', function ($query) use ($from_date, $to_date) {
                            return $query->whereDate('created_at', '>=', $from_date)->whereDate('created_at', '<=', $to_date);
                        })
                        ->where('creator_id',$creator_id)
                        ->orderBy('id', 'desc')
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
                return downloadExcel('DataEnterer.report.otherServices.report_excel', $data, 'all_services', 'xlsx');
            }
            return view('DataEnterer.report.otherServices.report', $data);
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
                return downloadExcel('DataEnterer.report.otherServices.report_excel', $data, 'premier', 'xlsx');
            }
            return view('DataEnterer.report.otherServices.report', $data);
        }

        if ($option == 1) {
            $data = [
                'services' => $express,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'branch_id' => $branch_id,
                'option' => $option,
                'onload' => false,
                'excel_export' => true,
            ];
            if (isset($excel_export) && $excel_export == true) {
                return downloadExcel('DataEnterer.report.otherServices.report_excel', $data, 'express', 'xlsx');
            }
            return view('DataEnterer.report.otherServices.report', $data);
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
                return downloadExcel('DataEnterer.report.otherServices.report_excel', $data, 'legal', 'xlsx');
            }
            return view('DataEnterer.report.otherServices.report', $data);
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
                return downloadExcel('DataEnterer.report.otherServices.report_excel', $data, 'immigration', 'xlsx');
            }
            return view('DataEnterer.report.otherServices.report', $data);
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
                return downloadExcel('DataEnterer.report.otherServices.report_excel', $data, 'other', 'xlsx');
            }
            return view('DataEnterer.report.otherServices.report', $data);
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

        $other = Other::when($branch_id > 0, function ($query) use ($branch_id) {
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
                'passports' => $renew->concat($manual)->concat($lost)->concat($new_born_baby)->concat($other),
                'from_date' => $from_date,
                'to_date' => $to_date,
                'branch_id' => $branch_id,
                'option' => $option,
                'onload' => false,
                'total_renew' => $renew->count(),
                'total_manual' => $manual->count(),
                'total_lost' => $lost->count(),
                'total_other' => $other->count(),
                'total_new_born_baby' => $new_born_baby->count(),
            ];

            return downloadExcel('DataEnterer.report.all_report_excel', $data, 'all_passport', 'xlsx');
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

            return downloadExcel('DataEnterer.report.all_report_excel', $data, 'renew_passport', 'xlsx');
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
            return downloadExcel('DataEnterer.report.all_report_excel', $data, 'manual_passport', 'xlsx');
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
            return downloadExcel('DataEnterer.report.all_report_excel', $data, 'lost_passport', 'xlsx');
        }

        if ($option == 3) {
            $data = [
                'passports' => $other,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'branch_id' => $branch_id,
                'option' => $option,
                'onload' => false,
            ];
            return downloadExcel('DataEnterer.report.all_report_excel', $data, 'other_passport', 'xlsx');
        }

        if ($option == 4) {
            $data = [
                'passports' => $new_born_baby,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'branch_id' => $branch_id,
                'option' => $option,
                'onload' => false,
            ];
            return downloadExcel('DataEnterer.report.all_report_excel', $data, 'new_born_baby_passport', 'xlsx');
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

        return view('DataEnterer.report.shift_to_embassy', $data);
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

        $other = Other::when($branch_id > 0, function ($query) use ($branch_id) {
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
                'passports' => $renew->concat($manual)->concat($lost)->concat($new_born_baby)->concat($other),
                'from_date' => $from_date,
                'to_date' => $to_date,
                'branch_id' => $branch_id,
                'option' => $option,
                'onload' => false,
                'shift_to_embassy' => true,
                'total_renew' => $renew->count(),
                'total_manual' => $manual->count(),
                'total_lost' => $lost->count(),
                'total_other' => $other->count(),
                'total_new_born_baby' => $new_born_baby->count(),
            ];
            if (isset($shift_to_embassy) && $shift_to_embassy == true) {
                return downloadExcel('DataEnterer.report.all_report_excel', $data, 'all_passport', 'xlsx');
            } else {
                return view('DataEnterer.report.search_report', $data);
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
                return downloadExcel('DataEnterer.report.all_report_excel', $data, 'renew_passport', 'xlsx');
            } else {
                return view('DataEnterer.report.search_report', $data);
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
                return downloadExcel('DataEnterer.report.all_report_excel', $data, 'manual_passport', 'xlsx');
            } else {
                return view('DataEnterer.report.search_report', $data);
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
                return downloadExcel('DataEnterer.report.all_report_excel', $data, 'lost_passport', 'xlsx');
            } else {
                return view('DataEnterer.report.search_report', $data);
            }
        }

        if ($option == 3) {
            $data = [
                'passports' => $other,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'branch_id' => $branch_id,
                'option' => $option,
                'onload' => false,
                'shift_to_embassy' => true,
            ];
            if (isset($shift_to_embassy) && $shift_to_embassy == true) {
                return downloadExcel('DataEnterer.report.all_report_excel', $data, 'other_passport', 'xlsx');
            } else {
                return view('DataEnterer.report.search_report', $data);
            }
        }

        if ($option == 4) {
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
                return downloadExcel('DataEnterer.report.all_report_excel', $data, 'new_born_baby_passport', 'xlsx');
            } else {
                return view('DataEnterer.report.search_report', $data);
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

        return view('DataEnterer.report.receive_from_embassy', $data);
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

        $other = Other::when($branch_id > 0, function ($query) use ($branch_id) {
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
                'passports' => $renew->concat($manual)->concat($lost)->concat($new_born_baby)->concat($other),
                'from_date' => $from_date,
                'to_date' => $to_date,
                'branch_id' => $branch_id,
                'option' => $option,
                'onload' => false,
                'receive_from_embassy' => true,
                'total_renew' => $renew->count(),
                'total_manual' => $manual->count(),
                'total_lost' => $lost->count(),
                'total_other' => $other->count(),
                'total_new_born_baby' => $new_born_baby->count(),
            ];
            if (isset($receive_from_embassy) && $receive_from_embassy == true) {
                return downloadExcel('DataEnterer.report.all_report_excel', $data, 'all_recieve_passport', 'xlsx');
            } else {
                return view('DataEnterer.report.search_report', $data);
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
                return downloadExcel('DataEnterer.report.all_report_excel', $data, 'recieve_renew_passport', 'xlsx');
            } else {
                return view('DataEnterer.report.search_report', $data);
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
                return downloadExcel('DataEnterer.report.all_report_excel', $data, 'recieve_manual_passport', 'xlsx');
            } else {
                return view('DataEnterer.report.search_report', $data);
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
                return downloadExcel('DataEnterer.report.all_report_excel', $data, 'recieve_lost_passport', 'xlsx');
            } else {
                return view('DataEnterer.report.search_report', $data);
            }
        }

        if ($option == 3) {
            $data = [
                'passports' => $other,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'branch_id' => $branch_id,
                'option' => $option,
                'onload' => false,
                'receive_from_embassy' => true,
            ];
            if (isset($receive_from_embassy) && $receive_from_embassy == true) {
                return downloadExcel('DataEnterer.report.all_report_excel', $data, 'recieve_other_passport', 'xlsx');
            } else {
                return view('DataEnterer.report.search_report', $data);
            }
        }

        if ($option == 4) {
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
                return downloadExcel('DataEnterer.report.all_report_excel', $data, 'recieve_new_born_baby_passport', 'xlsx');
            } else {
                return view('DataEnterer.report.search_report', $data);
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

        return view('DataEnterer.report.delivery_to_branch', $data);
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

        $other = Other::when($branch_id > 0, function ($query) use ($branch_id) {
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
                'passports' => $renew->concat($manual)->concat($lost)->concat($new_born_baby)->concat($other),
                'from_date' => $from_date,
                'to_date' => $to_date,
                'branch_id' => $branch_id,
                'option' => $option,
                'onload' => false,
                'delivery_to_branch' => true,
                'total_renew' => $renew->count(),
                'total_manual' => $manual->count(),
                'total_lost' => $lost->count(),
                'total_other' => $other->count(),
                'total_new_born_baby' => $new_born_baby->count(),
            ];
            if (isset($delivery_to_branch) && $delivery_to_branch == true) {
                return downloadExcel('DataEnterer.report.all_report_excel', $data, 'delivery_branch_all_passport', 'xlsx');
            } else {
                return view('DataEnterer.report.search_report', $data);
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
                return downloadExcel('DataEnterer.report.all_report_excel', $data, 'delivery_branch_renew_passport', 'xlsx');
            } else {
                return view('DataEnterer.report.search_report', $data);
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
                return downloadExcel('DataEnterer.report.all_report_excel', $data, 'delivery_branch_manual_passport', 'xlsx');
            } else {
                return view('DataEnterer.report.search_report', $data);
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
                return downloadExcel('DataEnterer.report.all_report_excel', $data, 'delivery_branch_lost_passport', 'xlsx');
            } else {
                return view('DataEnterer.report.search_report', $data);
            }
        }

        if ($option == 3) {
            $data = [
                'passports' => $other,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'branch_id' => $branch_id,
                'option' => $option,
                'onload' => false,
                'delivery_to_branch' => true,
            ];
            if (isset($delivery_to_branch) && $delivery_to_branch == true) {
                return downloadExcel('DataEnterer.report.all_report_excel', $data, 'delivery_branch_other_passport', 'xlsx');
            } else {
                return view('DataEnterer.report.search_report', $data);
            }
        }

        if ($option == 4) {
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
                return downloadExcel('DataEnterer.report.all_report_excel', $data, 'delivery_branch_new_born_baby_passport', 'xlsx');
            } else {
                return view('DataEnterer.report.search_report', $data);
            }
        }
    }


    public function deliveryReport()
    {
        $branch = 0;
        $data = [

            'branches' => Branch::orderBy('name', 'asc')->where('status', 1)->get(),

            'branch_id' => $branch,
            'option' => 0,
        ];

        return view('DataEnterer.report.delivery', $data);
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

        $other = Other::when($branch_id > 0, function ($query) use ($branch_id) {
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
                'passports' => $renew->concat($manual)->concat($lost)->concat($new_born_baby)->concat($other),
                'from_date' => $from_date,
                'to_date' => $to_date,
                'branch_id' => $branch_id,
                'option' => $option,
                'onload' => false,
                'delivery' => true,
                'total_renew' => $renew->count(),
                'total_manual' => $manual->count(),
                'total_lost' => $lost->count(),
                'total_other' => $other->count(),
                'total_new_born_baby' => $new_born_baby->count(),
            ];
            if (isset($delivery_to_user) && $delivery_to_user == true) {
                return downloadExcel('DataEnterer.report.all_report_excel', $data, 'delivery_user_all_passport', 'xlsx');
            } else {
                return view('DataEnterer.report.search_report', $data);
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
                return downloadExcel('DataEnterer.report.all_report_excel', $data, 'delivery_user_renew_passport', 'xlsx');
            } else {
                return view('DataEnterer.report.search_report', $data);
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
                return downloadExcel('DataEnterer.report.all_report_excel', $data, 'delivery_user_manual_passport', 'xlsx');
            } else {
                return view('DataEnterer.report.search_report', $data);
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
                return downloadExcel('DataEnterer.report.all_report_excel', $data, 'delivery_user_lost_passport', 'xlsx');
            } else {
                return view('DataEnterer.report.search_report', $data);
            }
        }

        if ($option == 3) {
            $data = [
                'passports' => $other,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'branch_id' => $branch_id,
                'option' => $option,
                'onload' => false,
                'delivery' => true,
            ];
            if (isset($delivery_to_user) && $delivery_to_user == true) {
                return downloadExcel('DataEnterer.report.all_report_excel', $data, 'delivery_user_other_passport', 'xlsx');
            } else {
                return view('DataEnterer.report.search_report', $data);
            }
        }

        if ($option == 4) {
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
                return downloadExcel('DataEnterer.report.all_report_excel', $data, 'delivery_user_new_born_baby_passport', 'xlsx');
            } else {
                return view('DataEnterer.report.search_report', $data);
            }
        }
    }
}
