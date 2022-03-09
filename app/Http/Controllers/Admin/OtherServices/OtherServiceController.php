<?php

namespace App\Http\Controllers\Admin\OtherServices;

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
        $otherServices = Other::orderBy('created_at', 'DESC')->get();
        return view('Admin.otherServices.otherService.index', compact('otherServices', 'flag'));
    }


    public function create()
    {
        $professions = Profession::where('status', 1)->orderBy('id', 'DESC')->get();
        $branchs = Branch::where('status', 1)->orderBy('id', 'DESC')->get();
        return view('Admin.otherServices.otherService.create', compact('branchs', 'professions'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            // 'emirates_id' => 'required',
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


            'emirates_id' => 'required',
            'kuwait_phone' => 'required',
            'delivery_branch' => 'required',
            'passport_number' => 'required',
            'passport_type_id' => 'required',
        ]);

        $otherService = new Other();
        $otherService->name = $request->name;
        $otherService->branch_id = Auth::user()->branch_id;
        $otherService->creator_id = Auth::user()->id;
        $otherService->emirates_id = $request->emirates_id;
        $otherService->profession_id = $request->profession_id;
        $otherService->passport_number = $request->passport_number;
        $otherService->kuwait_phone = $request->kuwait_phone;
        $otherService->fee = $request->fee;
        $otherService->bd_phone = $request->bd_phone;
        $otherService->salary = $request->salary;
        // $otherService->shift_to_admin = 1;
        $otherService->delivery_date = $request->delivery_date;
        $otherService->delivery_branch = $request->delivery_branch;
        $otherService->entry_person = $request->entry_person;
        $otherService->special_skill = $request->special_skill;
        $otherService->residence = $request->residence;
        $otherService->mailing_address = $request->mailing_address;
        $otherService->permanent_address = $request->permanent_address;
        $otherService->ems = 'OS' . time() . 'Kuwait';

        if ($request->hasFile('profession_file')) {

            $pdf             = $request->profession_file;
            $folder_path       = 'uploads/service/documents/';
            $pdf_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $pdf->getClientOriginalExtension();
            // save to server
            $request->profession_file->move(public_path($folder_path), $pdf_new_name);
            $otherService->profession_file = $folder_path . $pdf_new_name;
        }

        if ($request->hasFile('passport_photocopy')) {

            $pdf             = $request->passport_photocopy;
            $folder_path       = 'uploads/service/documents/';
            $pdf_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $pdf->getClientOriginalExtension();
            // save to server
            $request->passport_photocopy->move(public_path($folder_path), $pdf_new_name);
            $otherService->passport_photocopy = $folder_path . $pdf_new_name;
        }

        $otherService->save();

        Session::flash('success', 'Other Passport Added successfully!');
        return redirect()->route('admin.otherService.index');
    }


    public function printReceipt($id)
    {
        $serviceData = Other::findOrFail($id);
        $onload = true;

        return view('Admin.otherServices.otherService.printRecipt', compact('serviceData', 'onload'));
    }

    public function printSticker($id)
    {
        $serviceData = Other::findOrFail($id);
        $onload = true;

        return view('Admin.otherServices.otherService.printSticker', compact('serviceData', 'onload'));
    }


    public function show($id)
    {
        $serviceData = Other::findOrFail($id);
        $onload = false;
        $print = true;
        $bold = true;
        return view('Admin.otherServices.otherService.view', compact('serviceData', 'onload', 'print', 'bold'));
    }


    public function edit($id)
    {
        $professions = Profession::where('status', 1)->orderBy('id', 'DESC')->get();
        $branchs = Branch::where('status', 1)->orderBy('id', 'DESC')->get();
        $otherService = Other::findOrfail($id);
        return view('Admin.otherServices.otherService.edit', compact('branchs', 'otherService', 'professions'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'kuwait_phone' => 'required',
            // 'emirates_id' => 'required',
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


            'emirates_id' => 'required',
            'kuwait_phone' => 'required',
            'delivery_branch' => 'required',
            'passport_number' => 'required',
            'passport_type_id' => 'required',

        ]);

        $otherService = Other::findOrfail($id);
        $otherService->fill($request->all());


        if ($request->hasFile('profession_file')) {

            $pdf             = $request->profession_file;
            $folder_path       = 'uploads/service/documents/';
            $pdf_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $pdf->getClientOriginalExtension();
            // save to server
            $request->profession_file->move(public_path($folder_path), $pdf_new_name);
            $otherService->profession_file = $folder_path . $pdf_new_name;
        }

        if ($request->hasFile('passport_photocopy')) {

            $pdf             = $request->passport_photocopy;
            $folder_path       = 'uploads/service/documents/';
            $pdf_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $pdf->getClientOriginalExtension();
            // save to server
            $request->passport_photocopy->move(public_path($folder_path), $pdf_new_name);
            $otherService->passport_photocopy = $folder_path . $pdf_new_name;
        }

        $otherService->save();

        return redirect()->route('admin.otherService.index')->with('success', 'Passport Update successfull');
    }


    public function destroy($id)
    {
        $otherService = Other::findOrFail($id);

        try {
            $otherService->deleted_at = Carbon::now();
            $otherService->deleted_by = Auth::user()->id;
            $otherService->save();
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
