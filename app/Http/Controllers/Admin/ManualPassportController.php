<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\ManualPassport;
use App\Models\PassportFee;
use App\Models\Profession;
// use App\Models\Salary;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;
use PDF;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class ManualPassportController extends Controller
{

    public function index()
    {
        $flag = 1;
        $professions = Profession::where('status', 1)->orderBy('name', 'ASC')->get();
        $manualPassports = ManualPassport::orderBy('created_at', 'DESC')->get();
        return view('Admin.manualPassport.index', compact('manualPassports', 'flag', 'professions'));
    }


    public function create()
    {
        $professions = Profession::where('status', 1)->orderBy('id', 'DESC')->get();
        $branchs = Branch::where('status', 1)->orderBy('id', 'DESC')->get();
        $menualPassportFees = PassportFee::orderBy('id', 'DESC')->where('type', 'manual-passport')->get();
        return view('Admin.manualPassport.create', compact('professions', 'branchs', 'menualPassportFees'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'civil_id' => 'required',
            'kuwait_phone' => 'required',
            'delivery_branch' => 'required',
            'passport_number' => 'required',
            'passport_type_id' => 'required',
            // 'profession_id' => 'required',
            'passport_number' => 'required',
            // 'bd_phone' => 'required',
            // 'salary' => 'required',
            // 'delivery_date' => 'required',
            'delivery_branch' => 'required',
            // 'mailing_address' => 'required',
            'kuwait_phone' => 'required',
            // 'govt_passport_id' => 'required',
            // 'expiry_date' => 'required',
            // 'extended_to' => 'required',
            // 'post_office' => 'required',

        ]);
        //fee count
        $fee = PassportFee::findOrfail($request->passport_type_id);
        $type_title = $fee->title;
        $type_govt_fee = $fee->government_fee;
        $type_versatilo_fee = $fee->versatilo_fee;
        $total_fee = $type_govt_fee + $type_versatilo_fee;
        $manualPassport = new ManualPassport();

        $manualPassport->passport_type_id = $request->passport_type_id;
        $manualPassport->name = $request->name;

        $manualPassport->bd_phone = $request->bd_phone;
        $manualPassport->permanent_address = $request->permanent_address;
        $manualPassport->expiry_date = $request->expiry_date;
        $manualPassport->dob = $request->dob;
        $manualPassport->delivery_branch = $request->delivery_branch;
        $manualPassport->branch_id = Auth::user()->branch_id;

        $manualPassport->civil_id = $request->civil_id;
        $manualPassport->profession_id = $request->profession_id;
        $manualPassport->passport_number = $request->passport_number;
        $manualPassport->kuwait_phone = $request->kuwait_phone;
        $manualPassport->mailing_address = $request->mailing_address;

        $manualPassport->extended_to = $request->extended_to;
        $manualPassport->govt_passport_id = $request->govt_passport_id;
        $manualPassport->delivery_date = get_menual_passport_dalivery();


        $manualPassport->shift_to_admin = 1;
        $manualPassport->entry_person = Auth::user()->id;
        $manualPassport->user_creator_id = Auth::user()->id;
        $manualPassport->post_office = $request->post_office;

        $manualPassport->passport_type_title = $type_title;
        $manualPassport->passport_type_government_fee = $type_govt_fee;
        $manualPassport->passport_type_versatilo_fee =  $type_versatilo_fee;
        $manualPassport->passport_type_fees_total = $total_fee;
        $manualPassport->ems = 'MP' . time() . 'Kuwait';


        if ($request->hasFile('profession_file')) {

            $pdf             = $request->profession_file;
            $folder_path       = 'uploads/passport/documents/';
            $pdf_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $pdf->getClientOriginalExtension();
            // save to server
            $request->profession_file->move(public_path($folder_path), $pdf_new_name);
            $manualPassport->profession_file = $folder_path . $pdf_new_name;
        }
        if ($request->hasFile('application_form')) {

            $pdf             = $request->application_form;
            $folder_path       = 'uploads/passport/documents/';
            $pdf_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $pdf->getClientOriginalExtension();
            // save to server
            $request->application_form->move(public_path($folder_path), $pdf_new_name);
            $manualPassport->application_form = $folder_path . $pdf_new_name;
        }
        if ($request->hasFile('passport_photocopy')) {
            $image             = $request->file('passport_photocopy');
            $folder_path       = 'uploads/passport/documents/';
            $image_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->save($folder_path . $image_new_name, 100);
            $manualPassport->passport_photocopy   = $folder_path . $image_new_name;
        }
        $manualPassport->save();

        Session::flash('success', 'Manual Passport Added successfully!');
        return redirect()->back();
    }

    public function printReceipt($id)
    {
        $passport = ManualPassport::findOrFail($id);
        $onload = true;

        return view('Admin.manualPassport.printRecipt', compact('passport', 'onload'));
    }
    public function printSticker($id)
    {
        $passport = ManualPassport::findOrFail($id);
        $onload = true;

        return view('Admin.manualPassport.printSticker', compact('passport', 'onload'));
    }


    public function show($id)
    {
        $passport = ManualPassport::findOrFail($id);
        $onload = false;
        $print = true;
        $bold = true;
        return view('Admin.manualPassport.view', compact('passport', 'onload', 'print', 'bold'));
    }


    public function edit($id)
    {
        $professions = Profession::where('status', 1)->orderBy('id', 'DESC')->get();
        $branchs = Branch::where('status', 1)->orderBy('id', 'DESC')->get();
        $menualPassportFees = PassportFee::orderBy('id', 'DESC')->where('type', 'manual-passport')->get();
        $manualPassport = ManualPassport::findOrFail($id);
        return view('Admin.manualPassport.edit', compact('manualPassport', 'professions', 'branchs', 'menualPassportFees'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'civil_id' => 'required',
            'profession_id' => 'required',
            'passport_number' => 'required',
            // 'bd_phone' => 'required',
            // 'salary' => 'required',
            // 'delivery_date' => 'required',
            'delivery_branch' => 'required',
            // 'mailing_address' => 'required',
            'kuwait_phone' => 'required',
            // 'govt_passport_id' => 'required',
            // 'expiry_date' => 'required',
            // 'extended_to' => 'required',
            // 'post_office' => 'required',
        ]);
        //fee count
        $fee = PassportFee::findOrfail($request->passport_type_id);
        $type_title = $fee->title;
        $type_govt_fee = $fee->government_fee;
        $type_versatilo_fee = $fee->versatilo_fee;
        $total_fee = $type_govt_fee + $type_versatilo_fee;

        $manualPassport =   ManualPassport::findOrfail($id);
        $manualPassport->passport_type_id = $request->passport_type_id;
        $manualPassport->name = $request->name;

        $manualPassport->bd_phone = $request->bd_phone;
        $manualPassport->permanent_address = $request->permanent_address;
        $manualPassport->expiry_date = $request->expiry_date;
        $manualPassport->dob = $request->dob;
        $manualPassport->delivery_branch = $request->delivery_branch;
        $manualPassport->branch_id = Auth::user()->branch_id;

        $manualPassport->civil_id = $request->civil_id;
        $manualPassport->profession_id = $request->profession_id;
        $manualPassport->passport_number = $request->passport_number;
        $manualPassport->kuwait_phone = $request->kuwait_phone;
        $manualPassport->mailing_address = $request->mailing_address;

        $manualPassport->extended_to = $request->extended_to;
        $manualPassport->govt_passport_id = $request->govt_passport_id;
        $manualPassport->delivery_date = get_menual_passport_dalivery();


        $manualPassport->post_office = $request->post_office;

        $manualPassport->passport_type_title = $type_title;
        $manualPassport->passport_type_government_fee = $type_govt_fee;
        $manualPassport->passport_type_versatilo_fee =  $type_versatilo_fee;
        $manualPassport->passport_type_fees_total = $total_fee;
        $manualPassport->ems = 'MP' . time() . 'Kuwait';


        if ($request->hasFile('profession_file')) {
            if ($manualPassport->profession_file != null)
                File::delete(public_path($manualPassport->profession_file)); //Old pdf delete

            $pdf             = $request->profession_file;
            $folder_path       = 'uploads/passport/documents/';
            $pdf_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $pdf->getClientOriginalExtension();
            // save to server
            $request->profession_file->move(public_path($folder_path), $pdf_new_name);
            $manualPassport->profession_file = $folder_path . $pdf_new_name;
        }
        if ($request->hasFile('application_form')) {
            if ($manualPassport->application_form != null)
                File::delete(public_path($manualPassport->application_form)); //Old pdf delete

            $pdf             = $request->application_form;
            $folder_path       = 'uploads/passport/documents/';
            $pdf_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $pdf->getClientOriginalExtension();
            // save to server
            $request->application_form->move(public_path($folder_path), $pdf_new_name);
            $manualPassport->application_form = $folder_path . $pdf_new_name;
        }
        if ($request->hasFile('passport_photocopy')) {
            if ($manualPassport->passport_photocopy != null)
                File::delete(public_path($manualPassport->passport_photocopy)); //Old image delete
            $image             = $request->file('passport_photocopy');
            $folder_path       = 'uploads/passport/documents/';
            $image_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->save($folder_path . $image_new_name, 100);
            $manualPassport->passport_photocopy   = $folder_path . $image_new_name;
        }

        $manualPassport->save();

        return redirect()->route('admin.manualPassport.index')->with('success', 'Menual passport update successfull');
    }


    public function destroy($id)
    {
        $ManualPassport = ManualPassport::findOrFail($id);

        try {
            $ManualPassport->deleted_at = Carbon::now();
            $ManualPassport->deleted_by = Auth::user()->id;
            $ManualPassport->save();
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

    public function restore($id)
    {
        $manualPassport = ManualPassport::withTrashed()->find($id);
        try {
            $manualPassport->deleted_by = null;
            $manualPassport->save();
            $manualPassport->restore();
            return response()->json([
                'type' => 'success',
                'message' => 'This passport has been successfully restored !'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'type' => 'error',
                'message' => $exception->getMessage()
            ]);
        }
    }

    public function permanentDelete($id)
    {
        $manualPassport = ManualPassport::withTrashed()->find($id);
        try {
            $manualPassport->forceDelete();
            return response()->json([
                'type' => 'success',
                'message' => 'This passport has been permanently deleted !'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'type' => 'error',
                'message' => $exception->getMessage()
            ]);
        }
    }

    public function createSecond()
    {
        $professions = Profession::where('status', 1)->orderBy('id', 'DESC')->get();
        $branchs = Branch::where('status', 1)->orderBy('id', 'DESC')->get();
        $menualPassportFees = PassportFee::orderBy('id', 'DESC')->where('type', 'manual-passport')->get();
        return view('Admin.manualPassport.create-second', compact('professions', 'branchs', 'menualPassportFees'));
    }


    public function storeSecond(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'civil_id' => 'required',
            'kuwait_phone' => 'required',
            'delivery_branch' => 'required',
            'passport_number' => 'required',
            'passport_type_id' => 'required',
            // 'profession_id' => 'required',
            'passport_number' => 'required',
            // 'bd_phone' => 'required',
            // 'salary' => 'required',
            // 'delivery_date' => 'required',
            'delivery_branch' => 'required',
            // 'mailing_address' => 'required',
            'kuwait_phone' => 'required',
            // 'govt_passport_id' => 'required',
            // 'expiry_date' => 'required',
            // 'extended_to' => 'required',
            // 'post_office' => 'required',

        ]);
        //fee count
        $fee = PassportFee::findOrfail($request->passport_type_id);
        $type_title = $fee->title;
        $type_govt_fee = $fee->government_fee;
        $type_versatilo_fee = $fee->versatilo_fee;
        $total_fee = $type_govt_fee + $type_versatilo_fee;

        $manualPassport = new ManualPassport();

        $manualPassport->passport_type_id = $request->passport_type_id;
        $manualPassport->name = $request->name;

        $manualPassport->bd_phone = $request->bd_phone;
        $manualPassport->permanent_address = $request->permanent_address;
        $manualPassport->expiry_date = $request->expiry_date;
        $manualPassport->dob = $request->dob;
        $manualPassport->delivery_branch = $request->delivery_branch;
        $manualPassport->branch_id = Auth::user()->branch_id;

        $manualPassport->civil_id = $request->civil_id;
        $manualPassport->profession_id = $request->profession_id;
        $manualPassport->passport_number = $request->passport_number;
        $manualPassport->kuwait_phone = $request->kuwait_phone;
        $manualPassport->mailing_address = $request->mailing_address;

        $manualPassport->extended_to = $request->extended_to;
        $manualPassport->govt_passport_id = $request->govt_passport_id;
        $manualPassport->delivery_date = get_menual_passport_dalivery();




        $manualPassport->shift_to_admin = 1;
        $manualPassport->entry_person = Auth::user()->id;
        $manualPassport->user_creator_id = Auth::user()->id;
        $manualPassport->post_office = $request->post_office;

        $manualPassport->passport_type_title = $type_title;
        $manualPassport->passport_type_government_fee = $type_govt_fee;
        $manualPassport->passport_type_versatilo_fee =  $type_versatilo_fee;
        $manualPassport->passport_type_fees_total = $total_fee;
        $manualPassport->ems = 'MP' . time() . 'Kuwait';

        if ($request->hasFile('profession_file')) {

            $pdf             = $request->profession_file;
            $folder_path       = 'uploads/passport/documents/';
            $pdf_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $pdf->getClientOriginalExtension();
            // save to server
            $request->profession_file->move(public_path($folder_path), $pdf_new_name);
            $manualPassport->profession_file = $folder_path . $pdf_new_name;
        }
        if ($request->hasFile('application_form')) {

            $pdf             = $request->application_form;
            $folder_path       = 'uploads/passport/documents/';
            $pdf_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $pdf->getClientOriginalExtension();
            // save to server
            $request->application_form->move(public_path($folder_path), $pdf_new_name);
            $manualPassport->application_form = $folder_path . $pdf_new_name;
        }
        if ($request->hasFile('passport_photocopy')) {
            $image             = $request->file('passport_photocopy');
            $folder_path       = 'uploads/passport/documents/';
            $image_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->save($folder_path . $image_new_name, 100);
            $manualPassport->passport_photocopy   = $folder_path . $image_new_name;
        }

        $manualPassport->save();

        Session::flash('success', 'Manual Passport Added successfully!');
        return redirect()->route('admin.manualPassport.index');
    }


    /***
     * renew to manual
     */

    public function addManualByRenewId($renew_id)
    {
        return view('Admin.renewManual.edit');
    }

    public function search_by_emirats(Request $req)
    {
        $manualPassport = ManualPassport::where('civil_id', 'like', '%' . $req->input('emirats_id') . '%')->orderBy('id', 'DESC')->get();
        return view('Admin.manualPassport.search', compact('manualPassport'));
    }

    public function search_by_passport_number(Request $req)
    {
        $manualPassport = ManualPassport::where('passport_number', 'like', '%' . $req->input('passport_number') . '%')->orderBy('id', 'DESC')->get();
        return view('Admin.manualPassport.search', compact('manualPassport'));
    }

    public function search_by_profession(Request $req)
    {
        $manualPassport = ManualPassport::where('profession_id', $req->input('profession_id'))->orderBy('id', 'DESC')->get();
        return view('Admin.manualPassport.search', compact('manualPassport'));
    }
}
