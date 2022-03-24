<?php


namespace App\Http\Controllers\BranchManager;

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
        $manualPassports = ManualPassport::where('branch_id', Auth::user()->branch_id)->where('status', 1)->orderBy('created_at', 'DESC')->get();
        return view('BranchManager.manualPassport.index', compact('manualPassports', 'flag', 'professions'));
    }

    public function userManualPassportIndex()
    {

        $manualPassports = ManualPassport::where('branch_id', Auth::user()->branch_id)->where('status', 0)->orderBy('id', 'DESC')->get();

        return view('BranchManager.manualPassport.user.index', compact('manualPassports'));
    }


    public function create()
    {
        $professions = Profession::where('status', 1)->orderBy('id', 'DESC')->get();

        $manualPassportFees = PassportFee::orderBy('id', 'DESC')->where('type', 'manual-passport')->get();
        return view('BranchManager.manualPassport.create', compact('professions', 'manualPassportFees'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'civil_id' => 'required',
            'kuwait_phone' => 'required',

            'passport_number' => 'required',
            'passport_type_id' => 'required',
            // 'profession_id' => 'required',
            'passport_number' => 'required',
            // 'bd_phone' => 'required',
            // 'salary' => 'required',
            // 'delivery_date' => 'required',
            //'delivery_branch' => 'required',
            // 'mailing_address' => 'required',
            'kuwait_phone' => 'required',

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
        $manualPassport->delivery_branch = Auth::user()->branch_id;

        $manualPassport->civil_id = $request->civil_id;
        $manualPassport->profession_id = $request->profession_id;
        $manualPassport->passport_number = $request->passport_number;
        $manualPassport->kuwait_phone = $request->kuwait_phone;
        $manualPassport->mailing_address = $request->mailing_address;

        $manualPassport->extended_to = $request->extended_to;
        $manualPassport->delivery_date = get_manual_passport_dalivery();

        $manualPassport->entry_person = Auth::user()->id;
        $manualPassport->user_creator_id = Auth::user()->id;
        $manualPassport->branch_id = Auth::user()->branch_id;
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

        return view('BranchManager.manualPassport.printRecipt', compact('passport', 'onload'));
    }
    public function printSticker($id)
    {
        $passport = ManualPassport::findOrFail($id);
        $onload = true;

        return view('BranchManager.manualPassport.printSticker', compact('passport', 'onload'));
    }


    public function show($id)
    {
        $passport = ManualPassport::findOrFail($id);
        $onload = false;
        $print = true;
        $bold = true;
        return view('BranchManager.manualPassport.view', compact('passport', 'onload', 'print', 'bold'));
    }


    public function edit($id)
    {
        $professions = Profession::where('status', 1)->orderBy('id', 'DESC')->get();

        $manualPassportFees = PassportFee::orderBy('id', 'DESC')->where('type', 'manual-passport')->get();
        $manualPassport = ManualPassport::findOrFail($id);
        return view('BranchManager.manualPassport.edit', compact('manualPassport', 'professions', 'manualPassportFees'));
    }

    public function userManualPassportReview($id)
    {
        $professions = Profession::where('status', 1)->orderBy('id', 'DESC')->get();

        $manualPassportFees = PassportFee::orderBy('id', 'DESC')->where('type', 'manual-passport')->get();
        $manualPassport = ManualPassport::findOrFail($id);
        return view('BranchManager.manualPassport.user.edit', compact('manualPassport', 'professions', 'manualPassportFees'));
    }

    public function dismissComplain($id)
    {
        $manualPassport = ManualPassport::findOrFail($id);
        $manualPassport->is_shifted_to_branch_manager = null;
        try {
            $manualPassport->save();
            return response()->json([
                'type' => 'success',
                'message' => 'This complain has been dismissed successfully. '
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'type' => 'error',
                'message' => $exception->getMessage()
            ]);
        }
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
            //'delivery_branch' => 'required',
            // 'mailing_address' => 'required',
            'kuwait_phone' => 'required',

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
        $manualPassport->delivery_branch = Auth::user()->branch_id;

        $manualPassport->civil_id = $request->civil_id;
        $manualPassport->profession_id = $request->profession_id;
        $manualPassport->passport_number = $request->passport_number;
        $manualPassport->kuwait_phone = $request->kuwait_phone;
        $manualPassport->mailing_address = $request->mailing_address;

        $manualPassport->extended_to = $request->extended_to;
        $manualPassport->delivery_date = get_manual_passport_dalivery();

        $manualPassport->post_office = $request->post_office;

        $manualPassport->passport_type_title = $type_title;
        $manualPassport->passport_type_government_fee = $type_govt_fee;
        $manualPassport->passport_type_versatilo_fee =  $type_versatilo_fee;
        $manualPassport->passport_type_fees_total = $total_fee;
        $manualPassport->ems = 'MP' . time() . 'Kuwait';

        if (isset($request->status)) {
            $manualPassport->status = $request->status;
        }

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

        if (isset($request->status)) {
            return redirect()->route('branchManager.userManualPassport.index')->with('success', 'Manual passport review successfull');
        }

        return redirect()->route('branchManager.manualPassport.index')->with('success', 'Manual passport update successfull');
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

    public function createSecond()
    {
        $professions = Profession::where('status', 1)->orderBy('id', 'DESC')->get();

        $manualPassportFees = PassportFee::orderBy('id', 'DESC')->where('type', 'manual-passport')->get();
        return view('BranchManager.manualPassport.create-second', compact('professions', 'manualPassportFees'));
    }


    public function storeSecond(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'civil_id' => 'required',
            'kuwait_phone' => 'required',

            'passport_number' => 'required',
            'passport_type_id' => 'required',
            // 'profession_id' => 'required',
            'passport_number' => 'required',
            // 'bd_phone' => 'required',
            // 'salary' => 'required',
            // 'delivery_date' => 'required',
            //'delivery_branch' => 'required',
            // 'mailing_address' => 'required',
            'kuwait_phone' => 'required',

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
        $manualPassport->delivery_branch = Auth::user()->branch_id;

        $manualPassport->civil_id = $request->civil_id;
        $manualPassport->profession_id = $request->profession_id;
        $manualPassport->passport_number = $request->passport_number;
        $manualPassport->kuwait_phone = $request->kuwait_phone;
        $manualPassport->mailing_address = $request->mailing_address;

        $manualPassport->extended_to = $request->extended_to;
        $manualPassport->delivery_date = get_manual_passport_dalivery();

        $manualPassport->entry_person = Auth::user()->id;
        $manualPassport->user_creator_id = Auth::user()->id;
        $manualPassport->branch_id = Auth::user()->branch_id;
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
        return redirect()->route('branchManager.manualPassport.index');
    }


    /***
     * renew to manual
     */

    public function addManualByRenewId($renew_id)
    {
        return view('BranchManager.renewManual.edit');
    }

    public function search_by_civil(Request $req)
    {
        $manualPassports = ManualPassport::where('branch_id', Auth::user()->branch_id)->where('civil_id', 'like', '%' . $req->input('civil_id') . '%')->orderBy('id', 'DESC')->get();
        return view('BranchManager.manualPassport.search', compact('manualPassports'));
    }
    public function search_by_passport_number(Request $req)
    {
        $manualPassports = ManualPassport::where('branch_id', Auth::user()->branch_id)->where('passport_number', 'like', '%' . $req->input('passport_number') . '%')->orderBy('id', 'DESC')->get();
        return view('BranchManager.manualPassport.search', compact('manualPassports'));
    }
    public function search_by_new_mrp_passport_no(Request $req)
    {
        $manualPassports = ManualPassport::where('branch_id', Auth::user()->branch_id)->where('new_mrp_passport_no', 'like', '%' . $req->input('new_mrp_passport_no') . '%')->orderBy('id', 'DESC')->get();
        return view('BranchManager.manualPassport.search', compact('manualPassports'));
    }
    public function search_by_bio_enrollment_id(Request $req)
    {
        $manualPassports = ManualPassport::where('branch_id', Auth::user()->branch_id)->where('bio_enrollment_id', 'like', '%' . $req->input('bio_enrollment_id') . '%')->orderBy('id', 'DESC')->get();
        return view('BranchManager.manualPassport.search', compact('manualPassports'));
    }
    public function search_by_profession_id(Request $req)
    {
        $manualPassports = ManualPassport::where('branch_id', Auth::user()->branch_id)->where('profession_id', $req->profession_id)->orderBy('id', 'DESC')->get();
        return view('BranchManager.manualPassport.search', compact('manualPassports'));
    }
}
