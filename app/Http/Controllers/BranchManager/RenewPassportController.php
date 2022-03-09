<?php


namespace App\Http\Controllers\BranchManager;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\PassportFee;
use App\Models\Profession;
use App\Models\RenewPassport;
use App\Models\Salary;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;
use PDF;
use Illuminate\Support\Facades\Session;

class RenewPassportController extends Controller
{

    public function index()
    {
        $flag = 1;
        $professions = Profession::where('status', 1)->orderBy('name', 'ASC')->get();
        $renewPassports = RenewPassport::where('branch_id', Auth::user()->branch_id)->where('status', 1)->orderBy('created_at', 'DESC')->get();
        return view('BranchManager.renewPassport.index', compact('renewPassports', 'flag', 'professions'));
    }

    public function userRenewPassportIndex()
    {

        $professions = Profession::where('status', 1)->orderBy('name', 'ASC')->get();
        $renewPassports = RenewPassport::where('branch_id', Auth::user()->branch_id)->where('status', 0)->orderBy('id', 'DESC')->get();
        return view('BranchManager.renewPassport.user.index', compact('renewPassports', 'professions'));
    }


    public function create()
    {
        $salaries = Salary::where('status', 1)->get();
        $professions = Profession::where('status', 1)->orderBy('id', 'DESC')->get();

        $renewPassportFees = PassportFee::orderBy('id', 'DESC')->where('type', 'renew-passport')->get();
        return view('BranchManager.renewPassport.create', compact('professions', 'renewPassportFees', 'salaries'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            // 'emirates_id' => 'required',
            'passport_number' => 'required',
            // 'bd_phone' => 'required',
            // 'salary' => 'required',
            // 'delivery_date' => 'required',
            // 'delivery_branch' => 'required',
            // 'mailing_address' => 'required',
            'uae_phone' => 'required',
            // 'govt_passport_id' => 'required',
            // 'expiry_date' => 'required',
            // 'extended_to' => 'required',
            'passport_type_id' => 'required',

            'emirates_id' => 'required',
            'uae_phone' => 'required',

            // 'passport_number' => 'required',
            // 'passport_type_id' => 'required',


        ]);
        //count passport fee
        $fee = PassportFee::findOrfail($request->passport_type_id);
        $type_title = $fee->title;
        $type_govt_fee = $fee->government_fee;
        $type_versatilo_fee = $fee->versatilo_fee;
        $total_fee = $type_govt_fee + $type_versatilo_fee;

        $renewPassport = new RenewPassport();
        $renewPassport->passport_type_id = $request->passport_type_id;
        $renewPassport->name = $request->name;
        $renewPassport->bd_phone = $request->bd_phone;
        $renewPassport->permanent_address = $request->permanent_address;
        $renewPassport->expiry_date = $request->expiry_date;
        $renewPassport->dob = $request->dob;
        $renewPassport->delivery_branch = Auth::user()->branch_id;
        $renewPassport->residence = $request->residence;
        $renewPassport->emirates_id = $request->emirates_id;
        $renewPassport->profession_id = $request->profession_id;
        $renewPassport->passport_number = $request->passport_number;
        $renewPassport->uae_phone = $request->uae_phone;
        $renewPassport->mailing_address = $request->mailing_address;
        $renewPassport->special_skill = $request->special_skill;
        $renewPassport->extended_to = $request->extended_to;
        $renewPassport->govt_passport_id = $request->govt_passport_id;
        $renewPassport->delivery_date = get_threeMonth_tenDays();
        $renewPassport->salary = $request->salary;
        $renewPassport->entry_person = Auth::user()->id;
        $renewPassport->user_creator_id = Auth::user()->id;
        $renewPassport->branch_id = Auth::user()->branch_id;
        $renewPassport->passport_type_title = $type_title;
        $renewPassport->passport_type_government_fee = $type_govt_fee;
        $renewPassport->passport_type_versatilo_fee =  $type_versatilo_fee;
        $renewPassport->passport_type_fees_total = $total_fee;
        $renewPassport->ems = 'RP' . time() . 'Kuwait';

        if ($request->hasFile('profession_file')) {

            $pdf             = $request->profession_file;
            $folder_path       = 'uploads/passport/documents/';
            $pdf_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $pdf->getClientOriginalExtension();
            // save to server
            $request->profession_file->move(public_path($folder_path), $pdf_new_name);
            $renewPassport->profession_file = $folder_path . $pdf_new_name;
        }
        if ($request->hasFile('application_form')) {

            $pdf             = $request->application_form;
            $folder_path       = 'uploads/passport/documents/';
            $pdf_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $pdf->getClientOriginalExtension();
            // save to server
            $request->application_form->move(public_path($folder_path), $pdf_new_name);
            $renewPassport->application_form = $folder_path . $pdf_new_name;
        }
        if ($request->hasFile('passport_photocopy')) {
            $image             = $request->file('passport_photocopy');
            $folder_path       = 'uploads/passport/documents/';
            $image_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->save($folder_path . $image_new_name, 100);
            $renewPassport->passport_photocopy   = $folder_path . $image_new_name;
        }

        $renewPassport->save();
        Session::flash('success', 'Renew Passport Add successfull');
        return redirect()->back();
    }

    public function printReceipt($id)
    {
        $passport = RenewPassport::findOrFail($id);
        $onload = true;

        return view('BranchManager.renewPassport.printRecipt', compact('passport', 'onload'));
    }

    public function printSticker($id)
    {
        $passport = RenewPassport::findOrFail($id);
        $onload = true;

        return view('BranchManager.renewPassport.printSticker', compact('passport', 'onload'));
    }


    public function show($id)
    {
        $passport = RenewPassport::findOrFail($id);
        $onload = false;
        $print = true;
        $bold = true;
        return view('BranchManager.renewPassport.view', compact('passport', 'onload', 'print', 'bold'));
    }

    public function dismissComplain($id)
    {
        $passport = RenewPassport::findOrFail($id);
        $passport->is_shifted_to_branch_manager = null;
        try {
            $passport->save();
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

    public function edit($id)
    {

        $salaries = Salary::where('status', 1)->get();

        $professions = Profession::where('status', 1)->orderBy('id', 'DESC')->get();
        $renewPassport = RenewPassport::findOrfail($id);
        $renewPassportFees = PassportFee::orderBy('id', 'DESC')->where('type', 'renew-passport')->get();
        return view('BranchManager.renewPassport.edit', compact('renewPassport', 'renewPassportFees', 'professions', 'salaries'));
    }


    public function userRenewPassportReview($id)
    {

        $salaries = Salary::where('status', 1)->get();

        $professions = Profession::where('status', 1)->orderBy('id', 'DESC')->get();
        $renewPassport = RenewPassport::findOrfail($id);
        $renewPassportFees = PassportFee::orderBy('id', 'DESC')->where('type', 'renew-passport')->get();
        return view('BranchManager.renewPassport.user.review', compact('renewPassport', 'renewPassportFees', 'professions', 'salaries'));
    }




    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            // 'emirates_id' => 'required',
            'emirates_id' => 'required',
            'uae_phone' => 'required',

            'passport_number' => 'required',
            'passport_type_id' => 'required',
            // 'profession_id' => 'required',
            'passport_number' => 'required',
            // 'bd_phone' => 'required',
            // 'salary' => 'required',
            // 'delivery_date' => 'required',
            // 'delivery_branch' => 'required',
            // 'mailing_address' => 'required',
            'uae_phone' => 'required',
            // 'govt_passport_id' => 'required',
            // 'expiry_date' => 'required',
            // 'extended_to' => 'required',

        ]);
        $fee = PassportFee::findOrfail($request->passport_type_id);
        $type_title = $fee->title;
        $type_govt_fee = $fee->government_fee;
        $type_versatilo_fee = $fee->versatilo_fee;
        $total_fee = $type_govt_fee + $type_versatilo_fee;


        $renewPassport =   RenewPassport::findOrfail($id);
        $renewPassport->passport_type_id = $request->passport_type_id;
        $renewPassport->name = $request->name;
        $renewPassport->bd_phone = $request->bd_phone;
        $renewPassport->permanent_address = $request->permanent_address;
        $renewPassport->expiry_date = $request->expiry_date;
        $renewPassport->dob = $request->dob;
        $renewPassport->delivery_branch = Auth::user()->branch_id;
        $renewPassport->residence = $request->residence;
        $renewPassport->emirates_id = $request->emirates_id;
        $renewPassport->profession_id = $request->profession_id;
        $renewPassport->passport_number = $request->passport_number;
        $renewPassport->uae_phone = $request->uae_phone;
        $renewPassport->mailing_address = $request->mailing_address;
        $renewPassport->special_skill = $request->special_skill;
        $renewPassport->extended_to = $request->extended_to;
        $renewPassport->govt_passport_id = $request->govt_passport_id;
        $renewPassport->delivery_date = get_threeMonth_tenDays();
        $renewPassport->salary = $request->salary;

        $renewPassport->passport_type_title = $type_title;
        $renewPassport->passport_type_government_fee = $type_govt_fee;
        $renewPassport->passport_type_versatilo_fee =  $type_versatilo_fee;
        $renewPassport->passport_type_fees_total = $total_fee;

        if (isset($request->status)) {
            $renewPassport->status = $request->status;
        }

        if ($request->hasFile('profession_file')) {
            if ($renewPassport->profession_file != null)
                File::delete(public_path($renewPassport->profession_file)); //Old pdf delete

            $pdf             = $request->profession_file;
            $folder_path       = 'uploads/passport/documents/';
            $pdf_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $pdf->getClientOriginalExtension();
            // save to server
            $request->profession_file->move(public_path($folder_path), $pdf_new_name);
            $renewPassport->profession_file = $folder_path . $pdf_new_name;
        }
        if ($request->hasFile('application_form')) {
            if ($renewPassport->application_form != null)
                File::delete(public_path($renewPassport->application_form)); //Old pdf delete

            $pdf             = $request->application_form;
            $folder_path       = 'uploads/passport/documents/';
            $pdf_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $pdf->getClientOriginalExtension();
            // save to server
            $request->application_form->move(public_path($folder_path), $pdf_new_name);
            $renewPassport->application_form = $folder_path . $pdf_new_name;
        }
        if ($request->hasFile('passport_photocopy')) {
            if ($renewPassport->passport_photocopy != null)
                File::delete(public_path($renewPassport->passport_photocopy)); //Old image delete
            $image             = $request->file('passport_photocopy');
            $folder_path       = 'uploads/passport/documents/';
            $image_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->save($folder_path . $image_new_name, 100);
            $renewPassport->passport_photocopy   = $folder_path . $image_new_name;
        }

        $renewPassport->save();
        if (isset($request->status)) {
            return redirect()->route('branchManager.userRenewPassport.index')->with('success', 'Renew passport review successfull');
        }
        return redirect()->route('branchManager.renewPassport.index')->with('success', 'Renew passport update successfull');
    }



    public function destroy($id)
    {
        $RenewPassport = RenewPassport::findOrFail($id);

        try {
            $RenewPassport->deleted_at = Carbon::now();
            $RenewPassport->deleted_by = Auth::user()->id;
            $RenewPassport->save();
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
        $salaries = Salary::where('status', 1)->get();
        $professions = Profession::where('status', 1)->orderBy('id', 'DESC')->get();

        $renewPassportFees = PassportFee::orderBy('id', 'DESC')->where('type', 'renew-passport')->get();
        return view('BranchManager.renewPassport.create-second', compact('professions', 'renewPassportFees', 'salaries'));
    }


    public function storeSecond(Request $request)
    {
        $request->validate([
            'name' => 'required',
            // 'emirates_id' => 'required',
            'passport_number' => 'required',
            // 'bd_phone' => 'required',
            // 'salary' => 'required',
            // 'delivery_date' => 'required',
            // 'delivery_branch' => 'required',
            // 'mailing_address' => 'required',
            'uae_phone' => 'required',
            // 'govt_passport_id' => 'required',
            // 'expiry_date' => 'required',
            // 'extended_to' => 'required',
            'passport_type_id' => 'required',

            'emirates_id' => 'required',
            'uae_phone' => 'required',

            // 'passport_number' => 'required',
            // 'passport_type_id' => 'required',


        ]);
        //count passport fee
        $fee = PassportFee::findOrfail($request->passport_type_id);
        $type_title = $fee->title;
        $type_govt_fee = $fee->government_fee;
        $type_versatilo_fee = $fee->versatilo_fee;
        $total_fee = $type_govt_fee + $type_versatilo_fee;

        $renewPassport = new RenewPassport();
        $renewPassport->passport_type_id = $request->passport_type_id;
        $renewPassport->name = $request->name;
        $renewPassport->bd_phone = $request->bd_phone;
        $renewPassport->permanent_address = $request->permanent_address;
        $renewPassport->expiry_date = $request->expiry_date;
        $renewPassport->dob = $request->dob;
        $renewPassport->delivery_branch = Auth::user()->branch_id;
        $renewPassport->residence = $request->residence;
        $renewPassport->emirates_id = $request->emirates_id;
        $renewPassport->profession_id = $request->profession_id;
        $renewPassport->passport_number = $request->passport_number;
        $renewPassport->uae_phone = $request->uae_phone;
        $renewPassport->mailing_address = $request->mailing_address;
        $renewPassport->special_skill = $request->special_skill;
        $renewPassport->extended_to = $request->extended_to;
        $renewPassport->govt_passport_id = $request->govt_passport_id;
        $renewPassport->delivery_date = get_threeMonth_tenDays();
        $renewPassport->salary = $request->salary;
        $renewPassport->entry_person = Auth::user()->id;
        $renewPassport->user_creator_id = Auth::user()->id;
        $renewPassport->branch_id = Auth::user()->branch_id;
        $renewPassport->passport_type_title = $type_title;
        $renewPassport->passport_type_government_fee = $type_govt_fee;
        $renewPassport->passport_type_versatilo_fee =  $type_versatilo_fee;
        $renewPassport->passport_type_fees_total = $total_fee;
        $renewPassport->ems = 'RP' . time() . 'Kuwait';

        if ($request->hasFile('profession_file')) {

            $pdf             = $request->profession_file;
            $folder_path       = 'uploads/passport/documents/';
            $pdf_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $pdf->getClientOriginalExtension();
            // save to server
            $request->profession_file->move(public_path($folder_path), $pdf_new_name);
            $renewPassport->profession_file = $folder_path . $pdf_new_name;
        }
        if ($request->hasFile('application_form')) {

            $pdf             = $request->application_form;
            $folder_path       = 'uploads/passport/documents/';
            $pdf_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $pdf->getClientOriginalExtension();
            // save to server
            $request->application_form->move(public_path($folder_path), $pdf_new_name);
            $renewPassport->application_form = $folder_path . $pdf_new_name;
        }
        if ($request->hasFile('passport_photocopy')) {
            $image             = $request->file('passport_photocopy');
            $folder_path       = 'uploads/passport/documents/';
            $image_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->save($folder_path . $image_new_name, 100);
            $renewPassport->passport_photocopy   = $folder_path . $image_new_name;
        }

        $renewPassport->save();
        Session::flash('success', 'Renew Passport Add successfull');

        return redirect()->route('branchManager.renewPassport.index')->with('success', 'Renew Passport Add successfull');
    }


    public function search_by_emirats(Request $req)
    {
        $renewPassports = RenewPassport::where('branch_id', Auth::user()->branch_id)->where('emirates_id', 'like', '%' . $req->input('emirats_id') . '%')->orderBy('id', 'DESC')->get();
        return view('BranchManager.renewPassport.search', compact('renewPassports'));
    }

    public function search_by_mrp(Request $req)
    {
        $renewPassports = RenewPassport::where('branch_id', Auth::user()->branch_id)->where('passport_number', 'like', '%' . $req->input('mrp_no') . '%')->orderBy('id', 'DESC')->get();
        return view('BranchManager.renewPassport.search', compact('renewPassports'));
    }

    public function search_by_profession(Request $req)
    {
        $renewPassports = RenewPassport::where('branch_id', Auth::user()->branch_id)->where('profession_id', $req->input('profession_id'))->orderBy('id', 'DESC')->get();
        return view('BranchManager.renewPassport.search', compact('renewPassports'));
    }
}
