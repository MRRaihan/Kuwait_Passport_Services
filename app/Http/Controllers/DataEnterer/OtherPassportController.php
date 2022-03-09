<?php


namespace App\Http\Controllers\DataEnterer;

use App\Http\Controllers\Controller;
use App\Models\Other;
use App\Models\Salary;
use App\Models\Profession;
use App\Models\Branch;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class OtherPassportController extends Controller
{

    public function index()
    {
        $flag = 1;
        $otherPassports = Other::where('user_creator_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        return view('DataEnterer.otherPassport.index', compact('otherPassports', 'flag'));
    }


    public function create()
    {
        $salaries = Salary::where('status', 1)->get();
        $professions = Profession::where('status', 1)->orderBy('id', 'DESC')->get();
        $branch = Branch::findOrFail(Auth::user()->branch_id);
        return view('DataEnterer.otherPassport.create', compact('professions', 'branch', 'salaries'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'emirates_id' => 'required',
            'uae_phone' => 'required',
            // 'profession_id' => 'required',
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
        $otherPassport->user_creator_id = Auth::user()->id;
        $otherPassport->branch_id = Auth::user()->branch_id;
        $otherPassport->emirates_id = $request->emirates_id;
        $otherPassport->profession_id = $request->profession_id;
        $otherPassport->passport_number = $request->passport_number;
        $otherPassport->uae_phone = $request->uae_phone;
        $otherPassport->fee = $request->fee;
        $otherPassport->bd_phone = $request->bd_phone;
        $otherPassport->salary = $request->salary;
        $otherPassport->delivery_date = $request->delivery_date;
        $otherPassport->delivery_branch = Auth::user()->branch_id;
        $otherPassport->entry_person = $request->entry_person;
        $otherPassport->special_skill = $request->special_skill;
        $otherPassport->residence = $request->residence;
        $otherPassport->mailing_address = $request->mailing_address;
        $otherPassport->permanent_address = $request->permanent_address;
        $otherPassport->ems = 'EP' . time() . 'UAE';

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

        return redirect()->route('dataEnterer.otherPassport.index')->with('success', 'Passport add successfull');
    }


    public function printReceipt($id)
    {
        $passport = Other::findOrFail($id);
        $onload = true;

        return view('DataEnterer.otherPassport.printRecipt', compact('passport', 'onload'));
    }

    public function printSticker($id)
    {
        $passport = Other::findOrFail($id);
        $onload = true;

        return view('DataEnterer.otherPassport.printSticker', compact('passport', 'onload'));
    }


    public function show($id)
    {
        $passport = Other::findOrFail($id);
        $onload = false;
        $print = true;
        $bold = true;
        return view('DataEnterer.otherPassport.view', compact('passport', 'onload', 'print', 'bold'));
    }


    public function edit($id)
    {
        $otherPassport = Other::findOrfail($id);
        return view('DataEnterer.otherPassport.edit', compact('otherPassport'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'uae_phone' => 'required',
            'emirates_id' => 'required',
            'profession' => 'required',
            'passport_number' => 'required',
            'fee' => 'required',
            'bd_phone' => 'required',
            'salary' => 'required',
            'delivery_date' => 'required',

            'entry_person' => 'required',
            'special_skill' => 'required',
            'residence' => 'required',
            'mailing_address' => 'required',
            'permanent_address' => 'required',

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

        return redirect()->route('dataEnterer.otherPassport.index')->with('success', 'Passport Update successfull');
    }


    public function destroy($id)
    {
        $otherPassport = Other::findOrFail($id);

        try {
            $otherPassport->deleted_at = Carbon::now();
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
