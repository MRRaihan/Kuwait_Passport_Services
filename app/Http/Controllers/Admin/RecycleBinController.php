<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExpressService;
use App\Models\ImmigrationGovementService;
use App\Models\LegalComplaintsService;
use App\Models\LostPassport;
use App\Models\ManualPassport;
use App\Models\NewBornBabyPassport;
use App\Models\Other;
use App\Models\PremierService;
use App\Models\RenewPassport;
use Illuminate\Http\Request;

class RecycleBinController extends Controller
{
    public function renew()
    {
        $renewPassports = RenewPassport::onlyTrashed()->orderBy('id', 'DESC')->get();
        return view('Admin.recycleBin.renew', compact('renewPassports'));
    }
    public function manual()
    {
        $manualPassports = ManualPassport::onlyTrashed()->orderBy('id', 'DESC')->get();
        return view('Admin.recycleBin.manual', compact('manualPassports'));
    }
    public function lost()
    {
        $lostPassports = LostPassport::onlyTrashed()->orderBy('id', 'DESC')->get();
        return view('Admin.recycleBin.lost', compact('lostPassports'));
    }
    public function newBornBaby()
    {
        $newBornBabyPassports = NewBornBabyPassport::onlyTrashed()->orderBy('id', 'DESC')->get();
        return view('Admin.recycleBin.newBornBaby', compact('newBornBabyPassports'));
    }
    public function express()
    {
        $expressServices = ExpressService::onlyTrashed()->orderBy('id', 'DESC')->get();
        return view('Admin.recycleBin.express', compact('expressServices'));
    }
    public function immigrationGovt()
    {
        $immigrationGovementServices = ImmigrationGovementService::onlyTrashed()->orderBy('id', 'DESC')->get();
        return view('Admin.recycleBin.immigrationGovt', compact('immigrationGovementServices'));
    }
    public function legalComplaints()
    {
        $legalComplaintsServices = LegalComplaintsService::onlyTrashed()->orderBy('id', 'DESC')->get();
        return view('Admin.recycleBin.legalComplaints', compact('legalComplaintsServices'));
    }
    public function premier()
    {
        $premierServices = PremierService::onlyTrashed()->orderBy('id', 'DESC')->get();
        return view('Admin.recycleBin.premier', compact('premierServices'));
    }
    public function other()
    {
        $others = Other::onlyTrashed()->orderBy('id', 'DESC')->get();
        return view('Admin.recycleBin.other', compact('others'));
    }
}
