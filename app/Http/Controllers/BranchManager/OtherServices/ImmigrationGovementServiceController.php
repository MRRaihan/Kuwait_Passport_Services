<?php

namespace App\Http\Controllers\BranchManager\OtherServices;

use App\Http\Controllers\Controller;
use App\Models\ImmigrationGovementService;
use App\Models\OtherServiceFee;
use App\Models\Profession;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ImmigrationGovementServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flag = 1;
        $takenImmigrationService = ImmigrationGovementService::where('branch_id', Auth::user()->branch_id)->orderBy('created_at', 'DESC')->get();
        return view('BranchManager.otherServices.immigrationGovementService.index', compact('takenImmigrationService', 'flag'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $professions = Profession::orderBy('name', 'ASC')->where('status', '1')->get();
        $immigrationGovementServices = OtherServiceFee::orderBy('id', 'DESC')->where('service_type', 'immigration-govement-service')->get();
        return view('BranchManager.otherServices.immigrationGovementService.create', compact('immigrationGovementServices', 'professions'));
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

            'passport_number' => 'required',
            'civil_id' => 'required',
            'kuwait_phone' => 'required',
            'services' => 'required',


        ]);
        // dd($request->all());

        //menual and fix fee count start
        $fixAgency = [];
        $fixVersatilo = [];
        $fixGovt = [];
        $fixConsultants = [];
        $fixOhters = [];

        foreach ($request->services as $key => $service_id) {

            $fixFee = OtherServiceFee::find($service_id);
            $fix_manual_check = "service_fee_" . $fixFee->id;

            if ($request->$fix_manual_check == 0) {
                array_push($fixAgency, $fixFee->agency_fee);
                array_push($fixVersatilo, $fixFee->versetilo_fee);
                array_push($fixGovt, $fixFee->govt_fee);
                array_push($fixConsultants, $fixFee->consultants_fee);
                array_push($fixOhters, $fixFee->other_fee);
            }
        }
        $agency = array_sum(array_merge($request->agency, $fixAgency));
        $govt = array_sum(array_merge($request->govt, $fixGovt));
        $consultants = array_sum(array_merge($request->consultants, $fixConsultants));
        $ohters = array_sum(array_merge($request->ohters, $fixOhters));
        $versatilo = array_sum(array_merge($request->versatilo, $fixVersatilo));
        //menual and fix fee count end

        $Services = new ImmigrationGovementService();

        $Services->name = $request->name;
        $Services->passport_number = $request->passport_number;
        $Services->kuwait_phone = $request->kuwait_phone;
        $Services->bd_phone = $request->bd_phone;
        $Services->special_skill = $request->special_skill;
        $Services->residence = $request->residence;
        $Services->mailing_address = $request->mailing_address;
        $Services->permanent_address = $request->permanent_address;
        $Services->service_taken = json_encode($request->services);
        $Services->total_fee =  $agency + $govt + $consultants + $ohters +  $versatilo;
        $Services->creator_id = Auth::user()->id;
        $Services->branch_id = Auth::user()->branch_id;
        $Services->ems = 'IS' . time() . 'Kuwait';

        $Services->versetilo_fee = $versatilo;
        $Services->agency_fee = $agency;
        $Services->govt_fee = $govt;
        $Services->consulttants_fee = $consultants;
        $Services->other_fee = $ohters;
        if ($request->hasFile('passport_photoCopy')) {

            $pdf             = $request->passport_photoCopy;
            $folder_path       = 'uploads/add_on_service/documents/';
            $pdf_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $pdf->getClientOriginalExtension();
            // save to server
            $request->passport_photoCopy->move(public_path($folder_path), $pdf_new_name);
            $Services->passport_photocopy = $folder_path . $pdf_new_name;
        }
        $Services->save();

        return redirect()->route('branchManager.immigrationGovementService.index')->with('success', 'Services Added successfull');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $immigrationGovementService = ImmigrationGovementService::findOrFail($id);
        $onload = false;
        $print = true;
        return view('BranchManager.otherServices.immigrationGovementService.view', compact('immigrationGovementService', 'onload', 'print'));
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
        $immigrationService = ImmigrationGovementService::findOrFail($id);

        try {
            $immigrationService->deleted_at = Carbon::now();
            $immigrationService->deleted_by = Auth::user()->id;
            $immigrationService->save();
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
