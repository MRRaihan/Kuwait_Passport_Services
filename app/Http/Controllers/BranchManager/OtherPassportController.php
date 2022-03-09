<?php


namespace App\Http\Controllers\BranchManager;

use App\Http\Controllers\Controller;
use App\Models\Other;
use Carbon\Carbon;
use App\Models\Profession;
use App\Models\Branch;
use App\Models\LostPassport;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class OtherPassportController extends Controller
{

    public function index()
    {
        $flag = 1;
        $otherPassports = Other::where('branch_id', Auth::user()->branch_id)->orderBy('created_at', 'DESC')->get();
        return view('BranchManager.otherPassport.index', compact('otherPassports', 'flag'));
    }


    public function create()
    {

        $professions = Profession::where('status', 1)->orderBy('id', 'DESC')->get();
        //

        return view('BranchManager.otherPassport.create', compact('professions'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'emirates_id' => 'required',
            'uae_phone' => 'required',
            // 'profession' => 'required',
            'passport_number' => 'required',
            // 'fee' => 'required',
            // 'bd_phone' => 'required',
            // 'salary' => 'required',
            // 'delivery_date' => 'required',

            // 'entry_person' => 'required',
            // 'profession_file' => 'required',
            // 'passport_file' => 'required',
            // 'special_skill' => 'required',
            // 'residence' => 'required',
            // 'mailing_address' => 'required',
            // 'permanent_address' => 'required',
            // 'profession_file' => 'required',
            // 'passport_file' => 'required',
        ]);

        $otherPassport = new Other();
        $otherPassport->name = $request->name;
        $otherPassport->emirates_id = $request->emirates_id;
        $otherPassport->profession_id = $request->profession_id;
        $otherPassport->passport_number = $request->passport_number;
        $otherPassport->uae_phone = $request->uae_phone;
        $otherPassport->fee = $request->fee;
        $otherPassport->bd_phone = $request->bd_phone;
        $otherPassport->salary = $request->salary;
        $otherPassport->branch_id = Auth::user()->branch_id;
        $otherPassport->delivery_date = $request->delivery_date;
        $otherPassport->delivery_branch = Auth::user()->branch_id;
        $otherPassport->entry_person = $request->entry_person;
        $otherPassport->special_skill = $request->special_skill;
        $otherPassport->residence = $request->residence;
        $otherPassport->mailing_address = $request->mailing_address;
        $otherPassport->permanent_address = $request->permanent_address;
        $otherPassport->ems = 'EP' . time() . 'Kuwait';

        if ($request->hasFile('profession_file')) {

            $pdf             = $request->profession_file;
            $folder_path       = 'uploads/passport/documents/';
            $pdf_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $pdf->getClientOriginalExtension();
            // save to server
            $request->profession_file->move(public_path($folder_path), $pdf_new_name);
            $otherPassport->profession_file = $folder_path . $pdf_new_name;
        }

        if ($request->hasFile('passport_file')) {

            $pdf             = $request->passport_file;
            $folder_path       = 'uploads/passport/documents/';
            $pdf_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $pdf->getClientOriginalExtension();
            // save to server
            $request->passport_file->move(public_path($folder_path), $pdf_new_name);
            $otherPassport->passport_photocopy = $folder_path . $pdf_new_name;
        }

        $otherPassport->save();

        return redirect()->route('branchManager.otherPassport.index')->with('success', 'Passport add successfull');
    }


    public function printReceipt($id)
    {
        $passport = Other::findOrFail($id);
        $onload = true;

        return view('BranchManager.otherPassport.printRecipt', compact('passport', 'onload'));
    }

    public function printSticker($id)
    {
        $passport = Other::findOrFail($id);
        $onload = true;

        return view('BranchManager.otherPassport.printSticker', compact('passport', 'onload'));
    }


    public function show($id)
    {
        $passport = Other::findOrFail($id);
        $onload = false;
        $print = true;
        $bold = true;
        return view('BranchManager.otherPassport.view', compact('passport', 'onload', 'print', 'bold'));
    }


    public function edit($id)
    {
        $otherPassport = Other::findOrfail($id);
        $professions = Profession::where('status', 1)->orderBy('id', 'DESC')->get();

        $lostPassport = LostPassport::findOrfail($id);
        return view('BranchManager.otherPassport.edit', compact('otherPassport', 'professions', 'lostPassport'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'uae_phone' => 'required',
            'emirates_id' => 'required',
            // 'profession' => 'required',
            'passport_number' => 'required',
            // 'fee' => 'required',
            // 'bd_phone' => 'required',
            // 'salary' => 'required',
            // 'delivery_date' => 'required',

            // 'entry_person' => 'required',
            // 'special_skill' => 'required',
            // 'residence' => 'required',
            // 'mailing_address' => 'required',
            // 'permanent_address' => 'required',

        ]);

        $otherPassport = Other::findOrfail($id);
        $otherPassport->fill($request->all());

        if ($request->hasFile('profession_file')) {

            $pdf             = $request->profession_file;
            $folder_path       = 'uploads/passport/documents/';
            $pdf_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $pdf->getClientOriginalExtension();
            // save to server
            $request->profession_file->move(public_path($folder_path), $pdf_new_name);
            $otherPassport->profession_file = $folder_path . $pdf_new_name;
        }

        if ($request->hasFile('passport_file')) {

            $pdf             = $request->passport_file;
            $folder_path       = 'uploads/passport/documents/';
            $pdf_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $pdf->getClientOriginalExtension();
            // save to server
            $request->passport_file->move(public_path($folder_path), $pdf_new_name);
            $otherPassport->passport_photocopy = $folder_path . $pdf_new_name;
        }

        $otherPassport->save();

        return redirect()->route('branchManager.otherPassport.index')->with('success', 'Passport Update successfull');
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
