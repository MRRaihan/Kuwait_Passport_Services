<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\LostPassport;
use App\Models\PassportFee;
use App\Models\Profession;
// use App\Models\Salary;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;
use PDF;

class LostPassportController extends Controller
{

    public function index()
    {
        $flag = 1;
        $professions = Profession::where('status', 1)->orderBy('name', 'ASC')->get();
        // dd($professions);
        $lostPassports = LostPassport::orderBy('created_at', 'DESC')->get();
        return view('Admin.lostPassport.index', compact('lostPassports', 'flag', 'professions'));
    }


    public function create()
    {
        $professions = Profession::where('status', 1)->orderBy('id', 'DESC')->get();
        $branchs = Branch::where('status', 1)->orderBy('id', 'DESC')->get();
        $lostPassportFees = PassportFee::orderBy('id', 'DESC')->where('type', 'lost-passport')->get();
        return view('Admin.lostPassport.create', compact('lostPassportFees', 'professions', 'branchs'));
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
            // 'delivery_date' => 'required',
            // 'special_skill' => 'required',
            // 'residence' => 'required',
            // 'mailing_address' => 'required',
            // 'permanent_address' => 'required',
        ]);

        //count passport fee
        $fee = PassportFee::findOrfail($request->passport_type_id);
        $type_title = $fee->title;
        $type_govt_fee = $fee->government_fee;
        $type_versatilo_fee = $fee->versatilo_fee;
        $total_fee = $type_govt_fee + $type_versatilo_fee;

        $lostPassport = new LostPassport();
        $lostPassport->name = $request->name;
        $lostPassport->civil_id = $request->civil_id;
        $lostPassport->profession_id = $request->profession_id;
        $lostPassport->passport_number = $request->passport_number;
        $lostPassport->kuwait_phone = $request->kuwait_phone;
        $lostPassport->bd_phone = $request->bd_phone;
        $lostPassport->shift_to_admin = 1;
        $lostPassport->delivery_date = get_three_month_five_days();
        $lostPassport->delivery_branch = $request->delivery_branch;
        $lostPassport->user_creator_id = Auth::user()->id;
        $lostPassport->entry_person = Auth::user()->id;
        $lostPassport->branch_id = Auth::user()->branch_id;
        $lostPassport->special_skill = $request->special_skill;
        $lostPassport->residence = $request->residence;
        $lostPassport->mailing_address = $request->mailing_address;
        $lostPassport->permanent_address = $request->permanent_address;
        $lostPassport->passport_type_id = $request->passport_type_id;
        $lostPassport->passport_type_title = $type_title;
        $lostPassport->passport_type_government_fee = $type_govt_fee;
        $lostPassport->passport_type_versatilo_fee =  $type_versatilo_fee;
        $lostPassport->passport_type_fees_total = $total_fee;
        $lostPassport->ems = 'LP' . time() . 'Kuwait';


        if ($request->hasFile('gd_report_kuwait')) {
            $pdf             = $request->gd_report_kuwait;
            $folder_path       = 'uploads/passport/documents/';
            $pdf_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $pdf->getClientOriginalExtension();
            // save to server
            $request->gd_report_kuwait->move(public_path($folder_path), $pdf_new_name);
            $lostPassport->gd_report_kuwait = $folder_path . $pdf_new_name;
        }
        if ($request->hasFile('application_form')) {
            $pdf             = $request->application_form;
            $folder_path       = 'uploads/passport/documents/';
            $pdf_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $pdf->getClientOriginalExtension();
            // save to server
            $request->application_form->move(public_path($folder_path), $pdf_new_name);
            $lostPassport->application_form = $folder_path . $pdf_new_name;
        }
        if ($request->hasFile('passport_photocopy')) {
            $image             = $request->file('passport_photocopy');
            $folder_path       = 'uploads/passport/documents/';
            $image_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->save($folder_path . $image_new_name, 100);
            $lostPassport->passport_photocopy   = $folder_path . $image_new_name;
        }
        $lostPassport->save();
        Session::flash('success', 'Lost Passport Added successfully!');
        return back();
    }


    public function printReceipt($id)
    {
        $lostPassport = LostPassport::findOrFail($id);
        $onload = true;
        return view('Admin.lostPassport.printRecipt', compact('lostPassport', 'onload'));
    }
    public function printSticker($id)
    {
        $lostPassport = LostPassport::findOrFail($id);

        $onload = true;
        return view('Admin.lostPassport.printSticker', compact('lostPassport', 'onload'));
    }


    public function show($id)
    {
        $lostPassport = LostPassport::findOrFail($id);
        $onload = false;
        $print = true;
        return view('Admin.lostPassport.view', compact('lostPassport', 'onload', 'print'));
    }


    public function edit($id)
    {
        $professions = Profession::where('status', 1)->orderBy('id', 'DESC')->get();
        $lostPassportFees = PassportFee::orderBy('id', 'DESC')->where('type', 'lost-passport')->get();
        $lostPassport = LostPassport::findOrfail($id);
        $branchs = Branch::where('status', 1)->orderBy('id', 'DESC')->get();
        return view('Admin.lostPassport.edit', compact('lostPassport', 'lostPassportFees', 'professions', 'branchs'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            // 'civil_id' => 'required',
            'civil_id' => 'required',
            'kuwait_phone' => 'required',
            'delivery_branch' => 'required',
            'passport_number' => 'required',
            'passport_type_id' => 'required',
            // 'profession_id' => 'required',
            'passport_number' => 'required',
            'kuwait_phone' => 'required',
            // 'bd_phone' => 'required',
            // 'salary' => 'required',
            // 'delivery_date' => 'required',
            'delivery_branch' => 'required',
            // 'special_skill' => 'required',
            // 'residence' => 'required',
            // 'mailing_address' => 'required',
            // 'permanent_address' => 'required',
            'passport_type_id' => 'required',

        ]);
        $fee = PassportFee::findOrfail($request->passport_type_id);
        $type_title = $fee->title;
        $type_govt_fee = $fee->government_fee;
        $type_versatilo_fee = $fee->versatilo_fee;
        $total_fee = $type_govt_fee + $type_versatilo_fee;

        $lostPassport = LostPassport::findOrfail($id);
        $lostPassport->name = $request->name;
        $lostPassport->civil_id = $request->civil_id;
        $lostPassport->profession_id = $request->profession_id;

        $lostPassport->passport_number = $request->passport_number;
        $lostPassport->kuwait_phone = $request->kuwait_phone;
        $lostPassport->bd_phone = $request->bd_phone;
        $lostPassport->shift_to_admin = 1;
        $lostPassport->delivery_date = get_three_month_five_days();
        $lostPassport->delivery_branch = $request->delivery_branch;
        $lostPassport->user_creator_id = Auth::user()->id;
        $lostPassport->entry_person = Auth::user()->id;
        $lostPassport->branch_id = Auth::user()->branch_id;
        $lostPassport->special_skill = $request->special_skill;
        $lostPassport->residence = $request->residence;
        $lostPassport->mailing_address = $request->mailing_address;
        $lostPassport->permanent_address = $request->permanent_address;
        $lostPassport->passport_type_id = $request->passport_type_id;
        $lostPassport->passport_type_title = $type_title;
        $lostPassport->passport_type_government_fee = $type_govt_fee;
        $lostPassport->passport_type_versatilo_fee =  $type_versatilo_fee;
        $lostPassport->passport_type_fees_total = $total_fee;
        $lostPassport->ems = 'LP' . time() . 'Kuwait';


        if ($request->hasFile('gd_report_kuwait')) {
            if ($lostPassport->gd_report_kuwait != null)
                File::delete(public_path($lostPassport->gd_report_kuwait)); //Old image delete
            $pdf             = $request->gd_report_kuwait;
            $folder_path       = 'uploads/passport/documents/';
            $pdf_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $pdf->getClientOriginalExtension();
            // save to server
            $request->gd_report_kuwait->move(public_path($folder_path), $pdf_new_name);
            $lostPassport->gd_report_kuwait = $folder_path . $pdf_new_name;
        }
        if ($request->hasFile('application_form')) {
            if ($lostPassport->application_form != null)
                File::delete(public_path($lostPassport->application_form)); //Old pdf delete
            $pdf             = $request->application_form;
            $folder_path       = 'uploads/passport/documents/';
            $pdf_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $pdf->getClientOriginalExtension();
            // save to server
            $request->application_form->move(public_path($folder_path), $pdf_new_name);
            $lostPassport->application_form = $folder_path . $pdf_new_name;
        }
        if ($request->hasFile('passport_photocopy')) {
            if ($lostPassport->passport_photocopy != null)
                File::delete(public_path($lostPassport->passport_photocopy)); //Old image delete
            $image             = $request->file('passport_photocopy');
            $folder_path       = 'uploads/passport/documents/';
            $image_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->save($folder_path . $image_new_name, 100);
            $lostPassport->passport_photocopy   = $folder_path . $image_new_name;
        }
        $lostPassport->save();

        return redirect()->route('admin.lostPassport.index')->with('success', 'Pasport update successfull');
    }

    public function agreement($id)
    {
        $lostPassport = LostPassport::findOrFail($id);
        $onload = false;
        $print = true;
        return view('Admin.lostPassport.agreement', compact('lostPassport', 'onload', 'print'));
    }


    public function destroy($id)
    {
        $lostPassport = LostPassport::findOrFail($id);

        try {
            $lostPassport->deleted_at = Carbon::now();
            $lostPassport->deleted_by = Auth::user()->id;
            $lostPassport->save();
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
        $lostPassport = LostPassport::withTrashed()->find($id);
        try {
            $lostPassport->deleted_by = null;
            $lostPassport->save();
            $lostPassport->restore();
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
        $lostPassport = LostPassport::withTrashed()->find($id);
        try {
            if ($lostPassport->gd_report_kuwait != null)
                File::delete(public_path($lostPassport->gd_report_kuwait)); //Old image delete
            if ($lostPassport->application_form != null)
                File::delete(public_path($lostPassport->application_form)); //Old pdf delete
            if ($lostPassport->passport_photocopy != null)
                File::delete(public_path($lostPassport->passport_photocopy)); //Old image delete
            $lostPassport->forceDelete();
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
        $lostPassportFees = PassportFee::orderBy('id', 'DESC')->where('type', 'lost-passport')->get();
        return view('Admin.lostPassport.create-second', compact('lostPassportFees', 'professions', 'branchs'));
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
            // 'delivery_date' => 'required',
            // 'special_skill' => 'required',
            // 'residence' => 'required',
            // 'mailing_address' => 'required',
            // 'permanent_address' => 'required',
        ]);

        //count passport fee
        $fee = PassportFee::findOrfail($request->passport_type_id);
        $type_title = $fee->title;
        $type_govt_fee = $fee->government_fee;
        $type_versatilo_fee = $fee->versatilo_fee;
        $total_fee = $type_govt_fee + $type_versatilo_fee;

        $lostPassport = new LostPassport();
        $lostPassport->name = $request->name;
        $lostPassport->civil_id = $request->civil_id;
        $lostPassport->profession_id = $request->profession_id;

        $lostPassport->passport_number = $request->passport_number;
        $lostPassport->kuwait_phone = $request->kuwait_phone;
        $lostPassport->bd_phone = $request->bd_phone;
        $lostPassport->shift_to_admin = 1;
        $lostPassport->delivery_date = get_three_month_five_days();
        $lostPassport->delivery_branch = $request->delivery_branch;
        $lostPassport->user_creator_id = Auth::user()->id;
        $lostPassport->entry_person = Auth::user()->id;
        $lostPassport->branch_id = Auth::user()->branch_id;
        $lostPassport->special_skill = $request->special_skill;
        $lostPassport->residence = $request->residence;
        $lostPassport->mailing_address = $request->mailing_address;
        $lostPassport->permanent_address = $request->permanent_address;
        $lostPassport->passport_type_id = $request->passport_type_id;
        $lostPassport->passport_type_title = $type_title;
        $lostPassport->passport_type_government_fee = $type_govt_fee;
        $lostPassport->passport_type_versatilo_fee =  $type_versatilo_fee;
        $lostPassport->passport_type_fees_total = $total_fee;
        $lostPassport->ems = 'LP' . time() . 'Kuwait';


        if ($request->hasFile('gd_report_kuwait')) {
            $pdf             = $request->gd_report_kuwait;
            $folder_path       = 'uploads/passport/documents/';
            $pdf_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $pdf->getClientOriginalExtension();
            // save to server
            $request->gd_report_kuwait->move(public_path($folder_path), $pdf_new_name);
            $lostPassport->gd_report_kuwait = $folder_path . $pdf_new_name;
        }
        if ($request->hasFile('application_form')) {
            $pdf             = $request->application_form;
            $folder_path       = 'uploads/passport/documents/';
            $pdf_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $pdf->getClientOriginalExtension();
            // save to server
            $request->application_form->move(public_path($folder_path), $pdf_new_name);
            $lostPassport->application_form = $folder_path . $pdf_new_name;
        }
        if ($request->hasFile('passport_photocopy')) {
            $image             = $request->file('passport_photocopy');
            $folder_path       = 'uploads/passport/documents/';
            $image_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->save($folder_path . $image_new_name, 100);
            $lostPassport->passport_photocopy   = $folder_path . $image_new_name;
        }

        $lostPassport->save();
        Session::flash('success', 'Lost Passport Added successfully!');
        return redirect()->route('admin.lostPassport.index');
    }

    public function search_by_civil(Request $req)
    {
        $lostPassports = LostPassport::where('civil_id', 'like', '%' . $req->input('civil_id') . '%')->orderBy('id', 'DESC')->get();
        return view('Admin.lostPassport.search', compact('lostPassports'));
    }
    public function search_by_passport_number(Request $req)
    {
        $lostPassports = LostPassport::where('passport_number', 'like', '%' . $req->input('passport_number') . '%')->orderBy('id', 'DESC')->get();
        return view('Admin.lostPassport.search', compact('lostPassports'));
    }
    public function search_by_new_mrp_passport_no(Request $req)
    {
        $lostPassports = LostPassport::where('new_mrp_passport_no', 'like', '%' . $req->input('new_mrp_passport_no') . '%')->orderBy('id', 'DESC')->get();
        return view('Admin.lostPassport.search', compact('lostPassports'));
    }
    public function search_by_bio_enrollment_id(Request $req)
    {
        $lostPassports = LostPassport::where('bio_enrollment_id', 'like', '%' . $req->input('bio_enrollment_id') . '%')->orderBy('id', 'DESC')->get();
        return view('Admin.lostPassport.search', compact('lostPassports'));
    }
    public function search_by_profession_id(Request $req)
    {
        $lostPassports = LostPassport::where('profession_id', $req->profession_id)->orderBy('id', 'DESC')->get();
        return view('Admin.lostPassport.search', compact('lostPassports'));
    }
}
