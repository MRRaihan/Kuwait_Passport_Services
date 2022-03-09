<?php


namespace App\Http\Controllers\DataEnterer;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\ManualPassport;
use App\Models\PassportFee;
use App\Models\Profession;
use App\Models\RenewPassport;
use App\Models\Salary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManagerStatic as Image;


class RenewManualPassportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'emirates_id' => 'required',
            'uae_phone' => 'required',

            'passport_number' => 'required',
            'passport_type_id' => 'required',
            // 'profession_id' => 'required',
            'passport_number' => 'required',
            // 'bd_phone' => 'required',
            // 'salary' => 'required',
            // 'delivery_date' => 'required',
            //'delivery_branch' => 'required',
            // 'mailing_address' => 'required',
            'uae_phone' => 'required',
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
        $manualPassport->delivery_branch = Auth::user()->branch_id;
        $manualPassport->emirates_id = $request->emirates_id;
        $manualPassport->profession_id = $request->profession_id;
        $manualPassport->passport_number = $request->passport_number;
        $manualPassport->uae_phone = $request->uae_phone;
        $manualPassport->mailing_address = $request->mailing_address;
        $manualPassport->extended_to = $request->extended_to;
        $manualPassport->govt_passport_id = $request->govt_passport_id;
        $manualPassport->delivery_date = get_menual_passport_dalivery();
        $manualPassport->entry_person = Auth::user()->id;
        $manualPassport->user_creator_id = Auth::user()->id;
        $manualPassport->branch_id = Auth::user()->branch_id;
        $manualPassport->post_office = $request->post_office;

        $manualPassport->passport_type_title = $type_title;
        $manualPassport->passport_type_government_fee = $type_govt_fee;
        $manualPassport->passport_type_versatilo_fee =  $type_versatilo_fee;
        $manualPassport->passport_type_fees_total = $total_fee;
        $manualPassport->ems = 'MP' . time() . 'UAE';

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

        //update renew tabale
        $renewPassport = RenewPassport::findOrfail($request->renew_id);
        $renewPassport->is_manual = 1;
        $renewPassport->save();

        Session::flash('success', 'Renew Passport Added successfully!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $salaries = Salary::where('status', 1)->get();

        $professions = Profession::where('status', 1)->orderBy('id', 'DESC')->get();
        $renewPassport = RenewPassport::findOrfail($id);
        $menualPassportFees = PassportFee::orderBy('id', 'DESC')->where('type', 'manual-passport')->get();
        return view('DataEnterer.renewManual.edit', compact('renewPassport', 'menualPassportFees', 'professions', 'salaries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
