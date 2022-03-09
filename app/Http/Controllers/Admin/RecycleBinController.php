<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LostPassport;
use App\Models\ManualPassport;
use App\Models\NewBornBabyPassport;
use App\Models\RenewPassport;
use Illuminate\Http\Request;

class RecycleBinController extends Controller
{
    public function renewList()
    {
        $renewPassports = RenewPassport::onlyTrashed()->orderBy('id', 'DESC')->get();
        return view('Admin.recycleBin.renewList', compact('renewPassports'));
    }
    public function manualList()
    {
        $manualPassports = ManualPassport::onlyTrashed()->orderBy('id', 'DESC')->get();
        return view('Admin.recycleBin.manualList', compact('manualPassports'));
    }
    public function lostList()
    {
        $lostPassports = LostPassport::onlyTrashed()->orderBy('id', 'DESC')->get();
        return view('Admin.recycleBin.lostList', compact('lostPassports'));
    }
    public function newBornBabyList()
    {
        $newBornBabyPassports = NewBornBabyPassport::onlyTrashed()->orderBy('id', 'DESC')->get();
        return view('Admin.recycleBin.newBornBabyList', compact('newBornBabyPassports'));
    }
}
