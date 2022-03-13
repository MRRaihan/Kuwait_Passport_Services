<?php


namespace App\Http\Controllers\DataEnterer;

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
        $lostPassports = LostPassport::where('user_creator_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
        return view('DataEnterer.lostPassport.index', compact('lostPassports', 'flag', 'professions'));
    }


    public function create()
    {
        $professions = Profession::where('status', 1)->orderBy('id', 'DESC')->get();

        $lostPassportFees = PassportFee::orderBy('id', 'DESC')->where('type', 'lost-passport')->get();
        return view('DataEnterer.lostPassport.create', compact('lostPassportFees', 'professions'));
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
        $lostPassport->govt_passport_id = $request->govt_passport_id;
        $lostPassport->passport_number = $request->passport_number;
        $lostPassport->kuwait_phone = $request->kuwait_phone;
        $lostPassport->bd_phone = $request->bd_phone;
        $lostPassport->delivery_date = get_threeMonth_tenDays();
        $lostPassport->delivery_branch = Auth::user()->branch_id;
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
        return view('DataEnterer.lostPassport.printRecipt', compact('lostPassport', 'onload'));
    }
    public function printSticker($id)
    {
        $lostPassport = LostPassport::findOrFail($id);

        $onload = true;
        return view('DataEnterer.lostPassport.printSticker', compact('lostPassport', 'onload'));
    }

    public function shiftToBranchManagerNow($id)
    {
        $lostPassport = LostPassport::findOrFail($id);
        $lostPassport->is_shifted_to_branch_manager = 1;
        try {
            $lostPassport->save();
            return response()->json([
                'type' => 'success',
                'message' => 'This passport has been shifted successfully. '
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'type' => 'error',
                'message' => $exception->getMessage()
            ]);
        }
    }


    public function show($id)
    {
        $lostPassport = LostPassport::findOrFail($id);
        $onload = false;
        $print = true;
        return view('DataEnterer.lostPassport.view', compact('lostPassport', 'onload', 'print'));
    }


    public function edit($id)
    {
        $professions = Profession::where('status', 1)->orderBy('id', 'DESC')->get();
        $lostPassportFees = PassportFee::orderBy('id', 'DESC')->where('type', 'lost-passport')->get();
        $lostPassport = LostPassport::findOrfail($id);

        return view('DataEnterer.lostPassport.edit', compact('lostPassport', 'lostPassportFees', 'professions'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            // 'civil_id' => 'required',
            'civil_id' => 'required',
            'kuwait_phone' => 'required',

            'passport_number' => 'required',
            'passport_type_id' => 'required',
            // 'profession_id' => 'required',
            'passport_number' => 'required',
            'kuwait_phone' => 'required',
            // 'bd_phone' => 'required',
            // 'salary' => 'required',
            // 'delivery_date' => 'required',
            //'delivery_branch' => 'required',
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
        $lostPassport->govt_passport_id = $request->govt_passport_id;
        $lostPassport->passport_number = $request->passport_number;
        $lostPassport->kuwait_phone = $request->kuwait_phone;
        $lostPassport->bd_phone = $request->bd_phone;
        $lostPassport->delivery_date = get_threeMonth_tenDays();
        $lostPassport->delivery_branch = Auth::user()->branch_id;

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

        return redirect()->route('dataEnterer.lostPassport.index')->with('success', 'Pasport update successfull');
    }

    public function agreement($id)
    {
        $lostPassport = LostPassport::findOrFail($id);
        $onload = false;
        $print = true;
        return view('DataEnterer.lostPassport.agreement', compact('lostPassport', 'onload', 'print'));
    }


    public function destroy($id)
    {
        $lostPassport = LostPassport::findOrFail($id);

        try {
            $lostPassport->deleted_at = Carbon::now();
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

    public function createSecond()
    {
        $professions = Profession::where('status', 1)->orderBy('id', 'DESC')->get();

        $lostPassportFees = PassportFee::orderBy('id', 'DESC')->where('type', 'lost-passport')->get();
        return view('DataEnterer.lostPassport.create-second', compact('lostPassportFees', 'professions'));
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
        $lostPassport->govt_passport_id = $request->govt_passport_id;
        $lostPassport->passport_number = $request->passport_number;
        $lostPassport->kuwait_phone = $request->kuwait_phone;
        $lostPassport->bd_phone = $request->bd_phone;
        $lostPassport->delivery_date = get_threeMonth_tenDays();
        $lostPassport->delivery_branch = Auth::user()->branch_id;
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
        return redirect()->route('dataEnterer.lostPassport.index');
    }

    public function search_by_emirats(Request $req)
    {
        $lostPassports = LostPassport::where('user_creator_id', Auth::user()->id)->where('civil_id', 'like', '%' . $req->input('emirats_id') . '%')->orderBy('id', 'DESC')->get();
        return view('DataEnterer.lostPassport.search', compact('lostPassports'));
    }

    public function search_by_passport_number(Request $req)
    {
        $lostPassports = LostPassport::where('user_creator_id', Auth::user()->id)->where('passport_number', 'like', '%' . $req->input('passport_number') . '%')->orderBy('id', 'DESC')->get();
        return view('DataEnterer.lostPassport.search', compact('lostPassports'));
    }

    public function search_by_profession(Request $req)
    {
        $lostPassports = LostPassport::where('user_creator_id', Auth::user()->id)->where('profession_id', $req->input('profession_id'))->orderBy('id', 'DESC')->get();
        return view('DataEnterer.lostPassport.search', compact('lostPassports'));
    }
}
