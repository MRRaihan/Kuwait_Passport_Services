<?php

namespace App\Http\Controllers\DataEnterer;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\NewBornBabyPassport;
use App\Models\PassportFee;
use App\Models\Profession;
use App\Models\Salary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class NewBornBabyPassportController extends Controller
{
    public function index()
    {
        $flag = 1;
        $professions = Profession::where('status', 1)->orderBy('name', 'ASC')->get();
        $newBornBabyPassports = NewBornBabyPassport::where('user_creator_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
        return view('DataEnterer.newBornBabyPassport.index', compact('newBornBabyPassports', 'flag', 'professions'));
    }


    public function create()
    {
        // $professions = Profession::where('status', 1)->orderBy('id', 'DESC')->get();

        $newBornBabyPassportFees = PassportFee::orderBy('id', 'DESC')->where('type', 'new-born-baby-passport')->get();
        return view('DataEnterer.newBornBabyPassport.create', compact('newBornBabyPassportFees'));
    }

    public function store(Request $request)
    {


        $request->validate([
            'name' => 'required',
            'emirates_id' => 'required',
            'passport_number' => 'required',
            'kuwait_phone' => 'required',
            // 'bd_phone' => 'required',
            // 'delivery_date' => 'required',
            //'delivery_branch' => 'required',
            // 'special_skill' => 'required',
            // 'residence' => 'required',
            // 'mailing_address' => 'required',
            // 'permanent_address' => 'required',
            'passport_type_id' => 'required',
        ]);

        //count passport fee
        $fee = PassportFee::findOrfail($request->passport_type_id);
        $type_title = $fee->title;
        $type_govt_fee = $fee->government_fee;
        $type_versatilo_fee = $fee->versatilo_fee;
        $total_fee = $type_govt_fee + $type_versatilo_fee;


        $newBornBabyPassport = new NewBornBabyPassport();
        $newBornBabyPassport->name = $request->name;
        $newBornBabyPassport->emirates_id = $request->emirates_id;
        $newBornBabyPassport->passport_number = $request->passport_number;
        $newBornBabyPassport->kuwait_phone = $request->kuwait_phone;
        $newBornBabyPassport->bd_phone = $request->bd_phone;
        $newBornBabyPassport->delivery_date = get_threeMonth_tenDays();
        $newBornBabyPassport->dob = $request->dob;
        $newBornBabyPassport->dob_id = $request->dob_id;
        $newBornBabyPassport->branch_id = Auth::user()->branch_id;

        $newBornBabyPassport->delivery_branch = Auth::user()->branch_id;
        $newBornBabyPassport->user_creator_id = Auth::user()->id;

        $newBornBabyPassport->entry_person = Auth::user()->id;

        $newBornBabyPassport->residence = $request->residence;
        $newBornBabyPassport->mailing_address = $request->mailing_address;
        $newBornBabyPassport->permanent_address = $request->permanent_address;
        $newBornBabyPassport->passport_type_id = $request->passport_type_id;
        $newBornBabyPassport->passport_type_title = $type_title;
        $newBornBabyPassport->passport_type_government_fee = $type_govt_fee;
        $newBornBabyPassport->passport_type_versatilo_fee =  $type_versatilo_fee;
        $newBornBabyPassport->passport_type_fees_total = $total_fee;
        $newBornBabyPassport->ems = 'EP' . time() . 'Kuwait';

        if ($request->hasFile('dob_file')) {
            $pdf             = $request->dob_file;
            $folder_path       = 'uploads/passport/documents/';
            $pdf_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $pdf->getClientOriginalExtension();
            // save to server
            $request->dob_file->move(public_path($folder_path), $pdf_new_name);
            $newBornBabyPassport->dob_file = $folder_path . $pdf_new_name;
        }
        if ($request->hasFile('application_form')) {
            $pdf             = $request->application_form;
            $folder_path       = 'uploads/passport/documents/';
            $pdf_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $pdf->getClientOriginalExtension();
            // save to server
            $request->application_form->move(public_path($folder_path), $pdf_new_name);
            $newBornBabyPassport->application_form = $folder_path . $pdf_new_name;
        }
        if ($request->hasFile('passport_photocopy')) {
            $image             = $request->file('passport_photocopy');
            $folder_path       = 'uploads/passport/documents/';
            $image_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->save($folder_path . $image_new_name, 100);
            $newBornBabyPassport->passport_photocopy   = $folder_path . $image_new_name;
        }

        $newBornBabyPassport->save();
        Session::flash('success', 'New Born Baby Passport Added successfully!');
        return back();
    }


    public function printReceipt($id)
    {
        $newBornBabyPassport = NewBornBabyPassport::findOrFail($id);
        $onload = true;


        return view('DataEnterer.newBornBabyPassport.printRecipt', compact('newBornBabyPassport', 'onload'));
        // $pdf = PDF::loadView('DataEnterer.newBornBabyPassport.printRecipt',compact('newBornBabyPassport'));
    }
    public function printSticker($id)
    {
        $newBornBabyPassport = NewBornBabyPassport::findOrFail($id);

        $onload = true;
        return view('DataEnterer.newBornBabyPassport.printSticker', compact('newBornBabyPassport', 'onload'));

        // $pdf = PDF::loadView('DataEnterer.newBornBabyPassport.printSticker',compact('newBornBabyPassport'));
    }

    public function shiftToBranchManagerNow($id)
    {
        $newBornBabyPassport = NewBornBabyPassport::findOrFail($id);
        $newBornBabyPassport->is_shifted_to_branch_manager = 1;
        try {
            $newBornBabyPassport->save();
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
        $newBornBabyPassport = NewBornBabyPassport::findOrFail($id);
        $onload = false;
        $print = true;
        return view('DataEnterer.newBornBabyPassport.view', compact('newBornBabyPassport', 'onload', 'print'));
    }


    public function edit($id)
    {
        // $professions = Profession::where('status', 1)->orderBy('id', 'DESC')->get();
        $newBornBabyPassportFees = PassportFee::orderBy('id', 'DESC')->where('type', 'new-born-baby-passport')->get();
        $newBornBabyPassport = NewBornBabyPassport::findOrfail($id);

        return view('DataEnterer.newBornBabyPassport.edit', compact('newBornBabyPassport', 'newBornBabyPassportFees'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'emirates_id' => 'required',
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

        $newBornBabyPassport = NewBornBabyPassport::findOrfail($id);
        $newBornBabyPassport->name = $request->name;
        $newBornBabyPassport->emirates_id = $request->emirates_id;
        $newBornBabyPassport->passport_number = $request->passport_number;
        $newBornBabyPassport->kuwait_phone = $request->kuwait_phone;
        $newBornBabyPassport->bd_phone = $request->bd_phone;
        $newBornBabyPassport->delivery_date = get_threeMonth_tenDays();
        $newBornBabyPassport->dob = $request->dob;
        $newBornBabyPassport->dob_id = $request->dob_id;


        $newBornBabyPassport->delivery_branch = Auth::user()->branch_id;

        $newBornBabyPassport->residence = $request->residence;
        $newBornBabyPassport->mailing_address = $request->mailing_address;
        $newBornBabyPassport->permanent_address = $request->permanent_address;
        $newBornBabyPassport->passport_type_id = $request->passport_type_id;
        $newBornBabyPassport->passport_type_title = $type_title;
        $newBornBabyPassport->passport_type_government_fee = $type_govt_fee;
        $newBornBabyPassport->passport_type_versatilo_fee =  $type_versatilo_fee;
        $newBornBabyPassport->passport_type_fees_total = $total_fee;
        $newBornBabyPassport->ems = 'EP' . time() . 'Kuwait';

        if ($request->hasFile('dob_file')) {
            if ($newBornBabyPassport->dob_file != null)
                File::delete(public_path($newBornBabyPassport->dob_file)); //Old pdf delete
            $pdf             = $request->dob_file;
            $folder_path       = 'uploads/passport/documents/';
            $pdf_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $pdf->getClientOriginalExtension();
            // save to server
            $request->dob_file->move(public_path($folder_path), $pdf_new_name);
            $newBornBabyPassport->dob_file = $folder_path . $pdf_new_name;
        }
        if ($request->hasFile('application_form')) {
            if ($newBornBabyPassport->application_form != null)
                File::delete(public_path($newBornBabyPassport->application_form)); //Old pdf delete
            $pdf             = $request->application_form;
            $folder_path       = 'uploads/passport/documents/';
            $pdf_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $pdf->getClientOriginalExtension();
            // save to server
            $request->application_form->move(public_path($folder_path), $pdf_new_name);
            $newBornBabyPassport->application_form = $folder_path . $pdf_new_name;
        }
        if ($request->hasFile('passport_photocopy')) {
            if ($newBornBabyPassport->passport_photocopy != null)
                File::delete(public_path($newBornBabyPassport->passport_photocopy)); //Old image delete
            $image             = $request->file('passport_photocopy');
            $folder_path       = 'uploads/passport/documents/';
            $image_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->save($folder_path . $image_new_name, 100);
            $newBornBabyPassport->passport_photocopy   = $folder_path . $image_new_name;
        }

        $newBornBabyPassport->save();

        return redirect()->route('dataEnterer.newBornBabyPassport.index')->with('success', 'Pasport update successfull');
    }

    // public function agreement($id)
    // {
    //     $newBornBabyPassport = NewBornBabyPassport::findOrFail($id);
    //     $onload = false;
    //     $print = true;
    //     return view('DataEnterer.newBornBabyPassport.agreement', compact('newBornBabyPassport', 'onload', 'print'));
    // }

    public function createSecond()
    {
        // $professions = Profession::where('status', 1)->orderBy('id', 'DESC')->get();

        $newBornBabyPassportFees = PassportFee::orderBy('id', 'DESC')->where('type', 'new-born-baby-passport')->get();
        return view('DataEnterer.newBornBabyPassport.create-second', compact('newBornBabyPassportFees'));
    }

    public function storeSecond(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'emirates_id' => 'required',
            'passport_number' => 'required',
            'kuwait_phone' => 'required',
            // 'bd_phone' => 'required',
            // 'delivery_date' => 'required',
            //'delivery_branch' => 'required',
            // 'special_skill' => 'required',
            // 'residence' => 'required',
            // 'mailing_address' => 'required',
            // 'permanent_address' => 'required',
            'passport_type_id' => 'required',
        ]);

        //count passport fee
        $fee = PassportFee::findOrfail($request->passport_type_id);
        $type_title = $fee->title;
        $type_govt_fee = $fee->government_fee;
        $type_versatilo_fee = $fee->versatilo_fee;
        $total_fee = $type_govt_fee + $type_versatilo_fee;


        $newBornBabyPassport = new NewBornBabyPassport();
        $newBornBabyPassport->name = $request->name;
        $newBornBabyPassport->emirates_id = $request->emirates_id;
        $newBornBabyPassport->passport_number = $request->passport_number;
        $newBornBabyPassport->kuwait_phone = $request->kuwait_phone;
        $newBornBabyPassport->bd_phone = $request->bd_phone;
        $newBornBabyPassport->delivery_date = get_threeMonth_tenDays();
        $newBornBabyPassport->dob = $request->dob;
        $newBornBabyPassport->dob_id = $request->dob_id;
        $newBornBabyPassport->branch_id = Auth::user()->branch_id;

        $newBornBabyPassport->delivery_branch = Auth::user()->branch_id;
        $newBornBabyPassport->user_creator_id = Auth::user()->id;
        $newBornBabyPassport->entry_person = Auth::user()->id;
        // $newBornBabyPassport->special_skill = $request->special_skill;
        $newBornBabyPassport->residence = $request->residence;
        $newBornBabyPassport->mailing_address = $request->mailing_address;
        $newBornBabyPassport->permanent_address = $request->permanent_address;
        $newBornBabyPassport->passport_type_id = $request->passport_type_id;
        $newBornBabyPassport->passport_type_title = $type_title;
        $newBornBabyPassport->passport_type_government_fee = $type_govt_fee;
        $newBornBabyPassport->passport_type_versatilo_fee =  $type_versatilo_fee;
        $newBornBabyPassport->passport_type_fees_total = $total_fee;
        $newBornBabyPassport->ems = 'EP' . time() . 'Kuwait';

        if ($request->hasFile('dob_file')) {
            $pdf             = $request->dob_file;
            $folder_path       = 'uploads/passport/documents/';
            $pdf_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $pdf->getClientOriginalExtension();
            // save to server
            $request->dob_file->move(public_path($folder_path), $pdf_new_name);
            $newBornBabyPassport->dob_file = $folder_path . $pdf_new_name;
        }
        if ($request->hasFile('application_form')) {
            $pdf             = $request->application_form;
            $folder_path       = 'uploads/passport/documents/';
            $pdf_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $pdf->getClientOriginalExtension();
            // save to server
            $request->application_form->move(public_path($folder_path), $pdf_new_name);
            $newBornBabyPassport->application_form = $folder_path . $pdf_new_name;
        }
        if ($request->hasFile('passport_photocopy')) {
            $image             = $request->file('passport_photocopy');
            $folder_path       = 'uploads/passport/documents/';
            $image_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->save($folder_path . $image_new_name, 100);
            $newBornBabyPassport->passport_photocopy   = $folder_path . $image_new_name;
        }
        $newBornBabyPassport->save();
        Session::flash('success', 'New Born Baby Passport Added successfully!');
        return redirect()->route('dataEnterer.newBornBabyPassport.index');
    }


    public function destroy($id)
    {
        $newBornBabyPassport = NewBornBabyPassport::findOrFail($id);

        try {
            $newBornBabyPassport->deleted_at = Carbon::now();
            $newBornBabyPassport->save();
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

    public function search_by_emirats(Request $req)
    {
        $newBornBabyPassports = NewBornBabyPassport::where('user_creator_id', Auth::user()->id)->where('emirates_id', 'like', '%' . $req->input('emirats_id') . '%')->orderBy('id', 'DESC')->get();
        return view('DataEnterer.newBornBabyPassport.search', compact('newBornBabyPassports'));
    }

    public function search_by_passport_number(Request $req)
    {
        $newBornBabyPassports = NewBornBabyPassport::where('user_creator_id', Auth::user()->id)->where('passport_number', 'like', '%' . $req->input('passport_number') . '%')->orderBy('id', 'DESC')->get();
        return view('DataEnterer.newBornBabyPassport.search', compact('newBornBabyPassports'));
    }

    public function search_by_profession(Request $req)
    {
        $newBornBabyPassports = NewBornBabyPassport::where('user_creator_id', Auth::user()->id)->where('profession_id', $req->input('profession_id'))->orderBy('id', 'DESC')->get();
        return view('DataEnterer.newBornBabyPassport.search', compact('newBornBabyPassports'));
    }
}
