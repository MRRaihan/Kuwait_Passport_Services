<?php

namespace App\Http\Controllers\BranchManager\OtherServices;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Other;
use App\Models\Profession;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class OtherServiceController extends Controller
{
    public function index()
    {
        $flag = 1;
        $otherServices = Other::where('branch_id', Auth::user()->branch_id)->orderBy('created_at', 'DESC')->get();
        return view('BranchManager.otherServices.otherService.index', compact('otherServices', 'flag'));
    }


    public function create()
    {
        $professions = Profession::where('status', 1)->orderBy('id', 'DESC')->get();
        $branchs = Branch::where('status', 1)->orderBy('id', 'DESC')->get();
        return view('BranchManager.otherServices.otherService.create', compact('branchs', 'professions'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            // 'civil_id' => 'required',
            'kuwait_phone' => 'required',
            // 'profession' => 'required',
            'passport_number' => 'required',
            // 'fee' => 'required',
            // 'bd_phone' => 'required',
            // 'salary' => 'required',
            // 'delivery_date' => 'required',
            'delivery_branch' => 'required',
            // 'entry_person' => 'required',
            // 'profession_file' => 'required',
            // 'passport_file' => 'required',
            // 'special_skill' => 'required',
            // 'residence' => 'required',
            // 'mailing_address' => 'required',
            // 'permanent_address' => 'required',
            // 'profession_file' => 'required',
            // 'passport_file' => 'required',


            'civil_id' => 'required',
            'kuwait_phone' => 'required',
            'delivery_branch' => 'required',
            'passport_number' => 'required',
            'passport_type_id' => 'required',
        ]);

        $otherPassport = new Other();
        $otherPassport->name = $request->name;
        $otherPassport->branch_id = Auth::user()->branch_id;
        $otherPassport->civil_id = $request->civil_id;
        $otherPassport->profession_id = $request->profession_id;
        $otherPassport->passport_number = $request->passport_number;
        $otherPassport->kuwait_phone = $request->kuwait_phone;
        $otherPassport->fee = $request->fee;
        $otherPassport->bd_phone = $request->bd_phone;
        $otherPassport->salary = $request->salary;
        $otherPassport->delivery_date = $request->delivery_date;
        $otherPassport->delivery_branch = $request->delivery_branch;
        $otherPassport->entry_person = $request->entry_person;
        $otherPassport->special_skill = $request->special_skill;
        $otherPassport->residence = $request->residence;
        $otherPassport->mailing_address = $request->mailing_address;
        $otherPassport->permanent_address = $request->permanent_address;
        $otherPassport->ems = 'OS' . time() . 'Kuwait';

        if ($request->hasFile('profession_file')) {

            $pdf             = $request->profession_file;
            $folder_path       = 'uploads/service/documents/';
            $pdf_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $pdf->getClientOriginalExtension();
            // save to server
            $request->profession_file->move(public_path($folder_path), $pdf_new_name);
            $otherPassport->profession_file = $folder_path . $pdf_new_name;
        }

        if ($request->hasFile('passport_photocopy')) {

            $pdf             = $request->passport_photocopy;
            $folder_path       = 'uploads/service/documents/';
            $pdf_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $pdf->getClientOriginalExtension();
            // save to server
            $request->passport_photocopy->move(public_path($folder_path), $pdf_new_name);
            $otherPassport->passport_photocopy = $folder_path . $pdf_new_name;
        }

        $otherPassport->save();

        Session::flash('success', 'Other Passport Added successfully!');
        return redirect()->route('branchManager.otherService.index');
    }


    public function printReceipt($id)
    {
        $serviceData = Other::findOrFail($id);
        $onload = true;

        return view('BranchManager.otherServices.otherService.printRecipt', compact('serviceData', 'onload'));
    }

    public function printSticker($id)
    {
        $serviceData = Other::findOrFail($id);
        $onload = true;

        return view('BranchManager.otherServices.otherService.printSticker', compact('serviceData', 'onload'));
    }


    public function show($id)
    {
        $serviceData = Other::findOrFail($id);
        $onload = false;
        $print = true;
        $bold = true;
        return view('BranchManager.otherServices.otherService.view', compact('serviceData', 'onload', 'print', 'bold'));
    }


    public function edit($id)
    {
        $professions = Profession::where('status', 1)->orderBy('id', 'DESC')->get();
        $branchs = Branch::where('status', 1)->orderBy('id', 'DESC')->get();
        $otherService = Other::findOrfail($id);
        return view('BranchManager.otherServices.otherService.edit', compact('branchs', 'otherService', 'professions'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'kuwait_phone' => 'required',
            // 'civil_id' => 'required',
            // 'profession' => 'required',
            'passport_number' => 'required',
            // 'fee' => 'required',
            // 'bd_phone' => 'required',
            // 'salary' => 'required',
            // 'delivery_date' => 'required',
            'delivery_branch' => 'required',
            // 'entry_person' => 'required',
            // 'special_skill' => 'required',
            // 'residence' => 'required',
            // 'mailing_address' => 'required',
            // 'permanent_address' => 'required',


            'civil_id' => 'required',
            'kuwait_phone' => 'required',
            'delivery_branch' => 'required',
            'passport_number' => 'required',
            'passport_type_id' => 'required',

        ]);

        $otherPassport = Other::findOrfail($id);
        $otherPassport->fill($request->all());


        if ($request->hasFile('profession_file')) {

            $pdf             = $request->profession_file;
            $folder_path       = 'uploads/service/documents/';
            $pdf_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $pdf->getClientOriginalExtension();
            // save to server
            $request->profession_file->move(public_path($folder_path), $pdf_new_name);
            $otherPassport->profession_file = $folder_path . $pdf_new_name;
        }

        if ($request->hasFile('passport_photocopy')) {

            $pdf             = $request->passport_photocopy;
            $folder_path       = 'uploads/service/documents/';
            $pdf_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $pdf->getClientOriginalExtension();
            // save to server
            $request->passport_photocopy->move(public_path($folder_path), $pdf_new_name);
            $otherPassport->passport_photocopy = $folder_path . $pdf_new_name;
        }

        $otherPassport->save();

        return redirect()->route('branchManager.otherService.index')->with('success', 'Passport Update successfull');
    }


    public function destroy($id)
    {
        $otherPassport = Other::findOrFail($id);

        try {
            $otherPassport->deleted_at = Carbon::now();
            $otherPassport->deleted_by = Auth::user()->id;
            $otherPassport->save();
            return response()->json([
                'type' => 'success',
                'message' => 'Successfully Deleted'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'type' => 'error',
                'message' => $exception->getMessage()
            ]);
        }
    }
}
