<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PassportFee;
use Illuminate\Http\Request;

class PassportFeeController extends Controller
{
    public function index()
    {
        $lostPassportFees = PassportFee::orderBy('id', 'DESC')->where('type', 'lost-passport')->get();
        $manualPassportFees = PassportFee::orderBy('id', 'DESC')->where('type', 'manual-passport')->get();
        $renewPassportFees = PassportFee::orderBy('id', 'DESC')->where('type', 'renew-passport')->get();
        $newbornPassportFees = PassportFee::orderBy('id', 'DESC')->where('type', 'new-born-baby-passport')->get();
        return view('Admin.passportFees.index', compact('lostPassportFees', 'manualPassportFees', 'renewPassportFees', 'newbornPassportFees'));
    }

    public function create()
    {
        return view('Admin.passportFees.create');
    }

    public function store(Request $request)
    {


        $request->validate([
            'title' => 'required',
            'govt_fee' => 'required',
            'versatilo_fee' => 'required',
        ]);


        if (isset($request->title[0])) {
            foreach ($request->title as $key => $value) {
                if (isset($request->id[$key]) && $request->id[$key]  != null) {
                    $passportFee = PassportFee::where('id', $request->id[$key])->update([
                        'type' => $request->p_type[$key],
                        'title' => $request->title[$key],
                        'government_fee' => $request->govt_fee[$key],
                        'versatilo_fee' => $request->versatilo_fee[$key],
                    ]);
                } else {
                    $passportFee = PassportFee::create([
                        'type' => $request->p_type[$key],
                        'title' => $request->title[$key],
                        'government_fee' => $request->govt_fee[$key],
                        'versatilo_fee' => $request->versatilo_fee[$key],
                    ]);
                }
            }
            $msg = "Pasport Fee Added successfull";
            return redirect()->back()->with('success', $msg);
        } else {
            $msg = "Plsease Add some Data";
            return redirect()->back()->with('error', $msg);
        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $passportFee = PassportFee::findOrfail($id);
        return view('Admin.passportFees.edit', compact('passportFee'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'government_fee' => 'required',
            'versatilo_fee' => 'required',
        ]);

        $type = PassportFee::findOrfail($id);
        $type->fill($request->all());
        try {
            $type->save();
            return response()->json([
                'type' => 'success',
                'message' => 'Successfully Update!',
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'type' => 'error',
                'message' => 'Failed!',
            ]);
        }
    }


    public function destroy($id)
    {
        //
    }
}
