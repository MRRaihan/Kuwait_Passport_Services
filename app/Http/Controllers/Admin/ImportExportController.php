<?php

namespace App\Http\Controllers\Admin;

use App\Exports\BabyPassportExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LostPassportExport;
use App\Exports\ManualPassportExport;
use App\Exports\OtherExport;
use App\Exports\RenewPassportExport;
use App\Imports\LostPassportImport;
use App\Http\Controllers\Controller;
use App\Imports\BabyPassportImport;
use App\Imports\ManualPassportImport;
use App\Imports\OtherImport;
use App\Imports\RenewPassportImport;
use Illuminate\Http\Request;

class ImportExportController extends Controller
{
    /**
     * import export view page
     */
    public function index()
    {
        return view('Admin.importAndExport.index');
    }

    /**
     * lost passport export
     */
    public function lostPassportExport()
    {
        return  new LostPassportExport;
    }
    /**
     * lost passport import
     */
    public function lostPassportImport(Request $request)
    {
        $request->validate([
            'lost_passport' => 'required',
        ]);


        $import = new LostPassportImport;
        $import->import($request->file('lost_passport'));


        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }

        if ($import->errors()->isNotEmpty()) {
            // dd($import->errors());
            return redirect()->back()->with('error', $import->errors());
        }
        return redirect()->back()->with('success', 'Data Added successfull');
    }

    /**
     * Manual Passport export
     */
    public function ManualPassportExport()
    {
        return new ManualPassportExport;
    }
    /**
     * Manual passport import
     */
    public function ManualPassportImport(Request $request)
    {
        $request->validate([
            'manual_passport' => 'required',
        ]);


        $import = new ManualPassportImport();
        $import->import($request->file('manual_passport'));


        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }

        if ($import->errors()->isNotEmpty()) {
            // dd($import->errors());
            return redirect()->back()->with('error', $import->errors());
        }
        return redirect()->back()->with('success', 'Data Added successfull');
    }
    /**
     * renew passport export
     */
    public function RenewPassportExport()
    {
        return new RenewPassportExport;
    }
    /**
     * renew passport import
     */
    public function RenewPassportImport(Request $request)
    {
        $request->validate([
            'renew_passport' => 'required',
        ]);


        $import = new RenewPassportImport();
        $import->import($request->file('renew_passport'));


        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }

        if ($import->errors()->isNotEmpty()) {
            // dd($import->errors());
            return redirect()->back()->with('error', $import->errors());
        }
        return redirect()->back()->with('success', 'Data Added successfull');
    }
    /**
     * baby passport export
     */
    public function BabyPassportExport()
    {
        return new BabyPassportExport;
    }
    /**
     * baby passport import
     */
    public function BabyPassportImport(Request $request)
    {
        $request->validate([
            'baby_passport' => 'required',
        ]);


        $import = new BabyPassportImport();
        $import->import($request->file('baby_passport'));


        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }

        if ($import->errors()->isNotEmpty()) {
            // dd($import->errors());
            return redirect()->back()->with('error', $import->errors());
        }
        return redirect()->back()->with('success', 'Data Added successfull');
    }
    /**
     * other service export
     */
    public function OtherServiceExport()
    {
        return new OtherExport;
    }
    /**
     * other service import
     */
    public function OtherServiceImport(Request $request)
    {
        $request->validate([
            'other_service' => 'required',
        ]);


        $import = new OtherImport();
        $import->import($request->file('other_service'));


        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }

        if ($import->errors()->isNotEmpty()) {
            // dd($import->errors());
            return redirect()->back()->with('error', $import->errors());
        }
        return redirect()->back()->with('success', 'Data Added successfull');
    }
}
