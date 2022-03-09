<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Salary;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Salaries = Salary::all();
        return view('Admin.salary.index', compact('Salaries'));
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
        $request->validate(
            [
                'title' => 'required',
                'amount' => 'required'
            ]
        );

        if (isset($request->title[0])) {
            foreach ($request->title as $key => $value) {
                if (isset($request->id[$key]) && $request->id[$key]  != null) {
                    $passportFee = Salary::where('id', $request->id[$key])->update([
                        'title' => $request->title[$key],
                        'amount' => $request->amount[$key],

                    ]);
                } else {
                    if ($request->title[$key] != "" && $request->amount[$key] != "") {
                        $passportFee = Salary::create([
                            'title' => $request->title[$key],
                            'amount' => $request->amount[$key],
                        ]);
                    }
                }
            }
            $msg = "Salary Added successfull";
            return redirect()->back()->with('success', $msg);
        } else {
            $msg = "Plsease Add some Data";
            return redirect()->back()->with('error', $msg);
        }
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
        //
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
