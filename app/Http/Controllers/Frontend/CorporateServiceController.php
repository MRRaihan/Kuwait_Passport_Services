<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\Branch;
use App\Models\Delivery;
use App\Models\LostPassport;
use App\Models\ManualPassport;
use App\Models\NewBornBabyPassport;
use App\Models\PassportDelivery;
use App\Models\PassportFee;
use App\Models\Profession;
use App\Models\RenewPassport;

class CorporateServiceController extends Controller
{
    /**
     * Corporate services list
     */
    public function index($type)
    {

        if ($type == 0) {
            $passport = RenewPassport::where('user_creator_id', Auth::user()->id)->paginate(10);
        }
        if ($type == 1) {
            $passport = ManualPassport::where('user_creator_id', Auth::user()->id)->paginate(10);
        }
        if ($type == 2) {
            $passport = LostPassport::where('user_creator_id', Auth::user()->id)->paginate(10);
        }
        if ($type == 3) {
            $passport = NewBornBabyPassport::where('user_creator_id', Auth::user()->id)->paginate(10);
        }
        $data = [
            'passports' => $passport,
            'type' => $type,
        ];

        return view('CorporateUserDeshbord.service.index', $data);
    }

    public function create($type)
    {

        if ($type == 0) {
            $fees = PassportFee::orderBy('id', 'DESC')->where('type', 'renew-passport')->get();
       }
       if ($type == 1) {
            $fees = PassportFee::orderBy('id', 'DESC')->where('type', 'manual-passport')->get();
       }
       if ($type == 2) {
            $fees = PassportFee::orderBy('id', 'DESC')->where('type', 'lost-passport')->get();
       }
       if ($type == 3) {
            $fees = PassportFee::orderBy('id', 'DESC')->where('type', 'new-born-baby-passport')->get();
       }

        $data = [
            'type' => $type,
            'professions' => Profession::orderBy('name', 'asc')->where('status', 1)->get(),
            'branches' => Branch::orderBy('name', 'asc')->where('status', 1)->get(),
            'delivery_methods' => Delivery::orderBy('name', 'asc')->where('status', 1)->get(),
            'passport_fees' => $fees,
        ];

        return view('CorporateUserDeshbord.service.create', $data);
    }

    public function store(Request $request)
    {

        $request->validate([
            'passport_type_id' => 'required',
            'branch_id' => 'required',
            'passport_type' => 'required',
            'passport_number' => 'required',
            'name' => 'required',
            'profession_id' => 'required',
            'emirates_id' => 'required',
            'bd_phone' => 'required',
            'kuwait_phone' => 'required',
            'mailing_address' => 'required',
            'permanent_address' => 'required',

        ]);

        if ($request->passport_type == 0) {
            $passport = new RenewPassport();
            $passport->fill($request->except(['profession_file', 'application_form', 'passport_photocopy', 'passport_type','delivery_id']));
            $passport->delivery_date = get_threeMonth_tenDays();
            $passport->ems = 'RP' . time() . 'Kuwait';

        }


        if ($request->passport_type == 1) {
            $passport = new ManualPassport();
            $passport->fill($request->except(['profession_file', 'application_form', 'passport_photocopy', 'passport_type','delivery_id']));
            $passport->delivery_date = get_threeMonth_tenDays();
            $passport->ems = 'MP' . time() . 'Kuwait';
        }


        if ($request->passport_type == 2) {
            $passport = new LostPassport();
            $passport->fill($request->except(['gd_report_uae', 'application_form', 'passport_photocopy', 'passport_type','delivery_id']));
            $passport->delivery_date = get_threeMonth_tenDays();
            $passport->ems = 'LP' . time() . 'Kuwait';
        }


        if ($request->passport_type == 3) {
            $passport = new NewBornBabyPassport();
            $passport->fill($request->except(['dob_file', 'application_form', 'passport_photocopy', 'passport_type','delivery_id']));
            $passport->ems = 'EP' . time() . 'Kuwait';
        }



        $fee = PassportFee::findOrfail($request->passport_type_id);
        $type_title = $fee->title;
        $type_govt_fee = $fee->government_fee;
        $type_versatilo_fee = $fee->versatilo_fee;
        $total_fee = $type_govt_fee + $type_versatilo_fee;

        $passport->passport_type_title = $type_title;
        $passport->passport_type_government_fee = $type_govt_fee;
        $passport->passport_type_versatilo_fee =  $type_versatilo_fee;
        $passport->passport_type_fees_total = $total_fee;


        $passport->user_creator_id = Auth::user()->id;
        $passport->entry_person = Auth::user()->id;
        $passport->delivery_branch = $request->branch_id;
        $passport->delivery_method = $request->delivery_id;
        $passport->status = 0;

        if ($request->hasFile('dob_file')) {

            $pdf             = $request->dob_file;
            $folder_path       = 'uploads/passport/documents/';
            $pdf_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $pdf->getClientOriginalExtension();
            // save to server
            $request->dob_file->move(public_path($folder_path), $pdf_new_name);
            $passport->dob_file = $folder_path . $pdf_new_name;
        }

        if ($request->hasFile('gd_report_uae')) {

            $pdf             = $request->gd_report_uae;
            $folder_path       = 'uploads/passport/documents/';
            $pdf_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $pdf->getClientOriginalExtension();
            // save to server
            $request->gd_report_uae->move(public_path($folder_path), $pdf_new_name);
            $passport->gd_report_uae = $folder_path . $pdf_new_name;
        }

        if ($request->hasFile('profession_file')) {

            $pdf             = $request->profession_file;
            $folder_path       = 'uploads/passport/documents/';
            $pdf_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $pdf->getClientOriginalExtension();
            // save to server
            $request->profession_file->move(public_path($folder_path), $pdf_new_name);
            $passport->profession_file = $folder_path . $pdf_new_name;
        }

        if ($request->hasFile('application_form')) {

            $pdf             = $request->application_form;
            $folder_path       = 'uploads/passport/documents/';
            $pdf_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $pdf->getClientOriginalExtension();
            // save to server
            $request->application_form->move(public_path($folder_path), $pdf_new_name);
            $passport->application_form = $folder_path . $pdf_new_name;
        }

        if ($request->hasFile('passport_photocopy')) {
            $image             = $request->file('passport_photocopy');
            $folder_path       = 'uploads/passport/documents/';
            $image_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->save($folder_path . $image_new_name, 100);
            $passport->passport_photocopy   = $folder_path . $image_new_name;
        }
        $passport->save();

        try {
            return response()->json([
                'type' => 'success',
                'message' => 'Passport Created Successfully!',
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'type' => 'error',
                'message' => 'Failed!',
            ]);
        }

    }

    public function edit($data)
    {

        $passport_type = explode('&', $data)[0];
        $passport_id = explode('&', $data)[1] ? explode('&', $data)[1] : '';

        if (isset(explode('&', $data)[2])) {
            $passport_edit = explode('&', $data)[2] ? explode('&', $data)[2] : '';
        }


        if (isset($passport_type) && $passport_type == 0) {
            $passport = RenewPassport::findOrFail($passport_id);
            $fees = PassportFee::orderBy('id', 'DESC')->where('type', 'renew-passport')->get();
        }

        if (isset($passport_type) && $passport_type == 1) {
            $passport = ManualPassport::findOrFail($passport_id);
            $fees = PassportFee::orderBy('id', 'DESC')->where('type', 'manual-passport')->get();
        }

        if (isset($passport_type) && $passport_type == 2) {
            $passport = LostPassport::findOrFail($passport_id);
            $fees = PassportFee::orderBy('id', 'DESC')->where('type', 'lost-passport')->get();
        }

        if (isset($passport_type) && $passport_type == 3) {
            $passport = NewBornBabyPassport::findOrFail($passport_id);
            $fees = PassportFee::orderBy('id', 'DESC')->where('type', 'new-born-baby-passport')->get();
        }

        $data = [
            'passport' => $passport,
            'professions' => Profession::orderBy('name', 'asc')->where('status', 1)->get(),
            'branches' => Branch::orderBy('name', 'asc')->where('status', 1)->get(),
            'delivery_methods' => Delivery::orderBy('name', 'asc')->where('status', 1)->get(),
            'type' => $passport_type,
            'passport_fees' => $fees,
        ];


        if (isset($passport_edit) && $passport_edit == 'edit') {
            $data['edit'] = true;
            return view('CorporateUserDeshbord.service.edit', $data);
        }
        return view('CorporateUserDeshbord.service.service_status', $data);
    }

    public function update(Request $request, $data)
    {

        $request->validate([
            'branch_id' => 'required',
            'passport_type' => 'required',
            'passport_number' => 'required',
            'name' => 'required',
            'profession_id' => 'required',
            'emirates_id' => 'required',
            'bd_phone' => 'required',
            'kuwait_phone' => 'required',
            'mailing_address' => 'required',
            'permanent_address' => 'required',
        ]);


        $passport_type = explode('&', $data)[0];
        $passport_id = explode('&', $data)[1] ? explode('&', $data)[1] : '';

        if ($passport_type == 0) {
            $passport = RenewPassport::findOrFail($passport_id);
            $passport->fill($request->except(['profession_file', 'application_form', 'passport_photocopy', 'passport_type','delivery_id']));
        }
        if ($passport_type == 1) {
            $passport = ManualPassport::findOrFail($passport_id);
            $passport->fill($request->except(['profession_file', 'application_form', 'passport_photocopy', 'passport_type','delivery_id','post_office','passport_type_id']));
            $passport->post_office = $request->post_office;
        }

        if ($passport_type == 2) {
            $passport = LostPassport::findOrFail($passport_id);
            $passport->fill($request->except(['gd_report_uae', 'application_form', 'passport_photocopy', 'passport_type','delivery_id','passport_type_id']));
        }
        if ($passport_type == 3) {
            $passport = NewBornBabyPassport::findOrFail($passport_id);
            $passport->fill($request->except(['dob_file', 'application_form', 'passport_photocopy', 'passport_type','delivery_id','passport_type_id']));
        }


            $fee = PassportFee::findOrfail($request->passport_type_id);
            $type_title = $fee->title;
            $type_govt_fee = $fee->government_fee;
            $type_versatilo_fee = $fee->versatilo_fee;
            $total_fee = $type_govt_fee + $type_versatilo_fee;

            $passport->passport_type_title = $type_title;
            $passport->passport_type_government_fee = $type_govt_fee;
            $passport->passport_type_versatilo_fee =  $type_versatilo_fee;
            $passport->passport_type_fees_total = $total_fee;


            $passport->delivery_branch = $request->branch_id;
            $passport->delivery_method = $request->delivery_id;


        if ($request->hasFile('dob_file')) {
            if ($passport->dob_file != null)
                File::delete(public_path($passport->dob_file)); //Old pdf delete

            $pdf             = $request->dob_file;
            $folder_path       = 'uploads/passport/documents/';
            $pdf_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $pdf->getClientOriginalExtension();
            // save to server
            $request->dob_file->move(public_path($folder_path), $pdf_new_name);
            $passport->dob_file = $folder_path . $pdf_new_name;
        }

        if ($request->hasFile('gd_report_uae')) {
            if ($passport->gd_report_uae != null)
                File::delete(public_path($passport->gd_report_uae)); //Old pdf delete

            $pdf             = $request->gd_report_uae;
            $folder_path       = 'uploads/passport/documents/';
            $pdf_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $pdf->getClientOriginalExtension();
            // save to server
            $request->gd_report_uae->move(public_path($folder_path), $pdf_new_name);
            $passport->gd_report_uae = $folder_path . $pdf_new_name;
        }

        if ($request->hasFile('passport_photocopy')) {
            if ($passport->passport_photocopy != null)
                File::delete(public_path($passport->passport_photocopy)); //Old image delete


            $image             = $request->file('passport_photocopy');
            $folder_path       = 'uploads/passport/documents/';
            $image_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->save($folder_path . $image_new_name, 100);
            $passport->passport_photocopy   = $folder_path . $image_new_name;
        }

        if ($request->hasFile('profession_file')) {
            if ($passport->profession_file != null)
                File::delete(public_path($passport->profession_file)); //Old pdf delete

            $pdf             = $request->profession_file;
            $folder_path       = 'uploads/passport/documents/';
            $pdf_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $pdf->getClientOriginalExtension();
            // save to server
            $request->profession_file->move(public_path($folder_path), $pdf_new_name);
            $passport->profession_file = $folder_path . $pdf_new_name;
        }

        if ($request->hasFile('application_form')) {
            if ($passport->application_form != null)
                File::delete(public_path($passport->application_form)); //Old pdf delete

            $pdf             = $request->application_form;
            $folder_path       = 'uploads/passport/documents/';
            $pdf_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $pdf->getClientOriginalExtension();
            // save to server
            $request->application_form->move(public_path($folder_path), $pdf_new_name);
            $passport->application_form = $folder_path . $pdf_new_name;
        }


        $passport->save();

        return redirect()->route('corporateUser.service.status', $request->passport_type . '&' . $passport->id);
    }

    public function payment($data)
    {

        $passport_type = explode('&', $data)[0];
        $passport_id = explode('&', $data)[1] ? explode('&', $data)[1] : '';


        if (isset($passport_type) && $passport_type == 0) {
            $passport = RenewPassport::findOrFail($passport_id);
        }

        if (isset($passport_type) && $passport_type == 1) {
            $passport = ManualPassport::findOrFail($passport_id);
        }

        if (isset($passport_type) && $passport_type == 2) {
            $passport = LostPassport::findOrFail($passport_id);
        }

        if (isset($passport_type) && $passport_type == 3) {
            $passport = NewBornBabyPassport::findOrFail($passport_id);
        }

        $data = [
            'passport' => $passport,
            'professions' => Profession::orderBy('name', 'asc')->where('status', 1)->get(),
            'branches' => Branch::orderBy('name', 'asc')->where('status', 1)->get(),
            'delivery_methods' => Delivery::orderBy('name', 'asc')->where('status', 1)->get(),
            'type' => $passport_type,
        ];

        return view('CorporateUserDeshbord.service.payment', $data);
    }

    public function pending()
    {
        $data = [
            'renew_pendings' => RenewPassport::where('user_creator_id', Auth::user()->id)->where('status', 0)->get(),
            'manual_pendings' => ManualPassport::where('user_creator_id', Auth::user()->id)->where('status', 0)->get(),
            'lost_pendings' => LostPassport::where('user_creator_id', Auth::user()->id)->where('status', 0)->get(),
            'new_baby_pendings' => NewBornBabyPassport::where('user_creator_id', Auth::user()->id)->where('status', 0)->get(),
        ];

        return view('CorporateUserDeshbord.service.pending', $data);
    }

    public function reviewed()
    {
        $data = [
            'renew_reviewed' => RenewPassport::where('user_creator_id', Auth::user()->id)->where('status', 1)->get(),
            'manual_reviewed' => ManualPassport::where('user_creator_id', Auth::user()->id)->where('status', 1)->get(),
            'lost_reviewed' => LostPassport::where('user_creator_id', Auth::user()->id)->where('status', 1)->get(),
            'new_baby_reviewed' => NewBornBabyPassport::where('user_creator_id', Auth::user()->id)->where('status', 1)->get(),
        ];

        return view('CorporateUserDeshbord.service.reviewed', $data);
    }

    public function completed()
    {
        $data = [
            'renew_completed' => RenewPassport::where('user_creator_id', Auth::user()->id)->where('status', 3)->get(),
            'manual_completed' => ManualPassport::where('user_creator_id', Auth::user()->id)->where('status', 3)->get(),
            'lost_completed' => LostPassport::where('user_creator_id', Auth::user()->id)->where('status', 3)->get(),
            'new_baby_completed' => NewBornBabyPassport::where('user_creator_id', Auth::user()->id)->where('status', 3)->get(),
        ];

        return view('CorporateUserDeshbord.service.completed', $data);
    }

    public function paymentList()
    {
        $data = [
            'renew' => RenewPassport::where('user_creator_id', Auth::user()->id)->where('status', 1)->paginate(10),
            'manual' => ManualPassport::where('user_creator_id', Auth::user()->id)->where('status', 1)->paginate(10),
            'lost' => LostPassport::where('user_creator_id', Auth::user()->id)->where('status', 1)->paginate(10),
            'new_baby' => NewBornBabyPassport::where('user_creator_id', Auth::user()->id)->where('status', 1)->paginate(10),
        ];

        return view('CorporateUserDeshbord.service.payment_list', $data);
    }

}
