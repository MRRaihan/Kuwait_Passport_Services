<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OtherServiceFee;
use Illuminate\Http\Request;

class OtherServiceFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $premierService = OtherServiceFee::orderBy('id', 'DESC')->where('service_type', 'premier-service')->get();
        $expressService = OtherServiceFee::orderBy('id', 'DESC')->where('service_type', 'express-service')->get();
        $legalComplaintsService = OtherServiceFee::orderBy('id', 'DESC')->where('service_type', 'legal-complaints-service')->get();
        $immigrationGovementService = OtherServiceFee::orderBy('id', 'DESC')->where('service_type', 'immigration-govement-service')->get();
        return view('Admin.otherServiceFee.index', compact('premierService', 'expressService', 'legalComplaintsService', 'immigrationGovementService'));
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
        // dd($request->all());
        if (isset($request->title[0])) {
            foreach ($request->title as $key => $value) {
                if ($request->title[$key] != "" && $request->versatilo_fee[$key] != "" && $request->consultants_fee[$key] != "" && $request->agency_fee[$key] != "") {

                    $service_ststus_request = "service_status" . $key;


                    if (isset($request->id[$key]) && $request->id[$key]  != null) {

                        $otherServicefee = OtherServiceFee::where('id', $request->id[$key])->update([
                            'service_type' => $request->service_type[$key],
                            'title' => $request->title[$key],
                            'govt_fee' => $request->govt_fee[$key],
                            'versetilo_fee' => $request->versatilo_fee[$key],
                            'consultants_fee' => $request->consultants_fee[$key],
                            'agency_fee' => $request->agency_fee[$key],
                            'service_status' => $request->$service_ststus_request,

                        ]);
                    } else {
                        $otherServicefee = OtherServiceFee::create([
                            'service_type' => $request->service_type[$key],
                            'title' => $request->title[$key],
                            'govt_fee' => $request->govt_fee[$key],
                            'versetilo_fee' => $request->versatilo_fee[$key],
                            'consultants_fee' => $request->consultants_fee[$key],
                            'agency_fee' => $request->agency_fee[$key],
                            'service_status' => $request->$service_ststus_request,

                        ]);
                    }
                }
            }
            $msg = "Other Service Fee Added successfull";
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
