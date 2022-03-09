<?php


namespace App\Http\Controllers\DataEnterer;


use App\Http\Controllers\Controller;
use App\Models\ExpressService;
use App\Models\LegalComplaintsService;
use App\Models\LostPassport;
use App\Models\OtherServiceFee;
use App\Models\ImmigrationGovementService;
use App\Models\ManualPassport;
use App\Models\NewBornBabyPassport;
use App\Models\PremierService;
use App\Models\Profession;
use App\Models\RenewPassport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;
use PDF;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class ExtraServiceAddController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
            'passport_number' => 'required',
            'services' => 'required',
            'passport_type_id' => 'required',

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
        if ($request->service_type == "premiem_service") {
            $Services = new PremierService();
            $ems = 'PS' . time() . 'Kuwait';
        } elseif ($request->service_type == "express_service") {
            $Services = new ExpressService();
            $ems = 'ES' . time() . 'Kuwait';
        } elseif ($request->service_type == "legel_service") {
            $Services = new LegalComplaintsService();
            $ems = 'LS' . time() . 'Kuwait';
        } elseif ($request->service_type == "immegraion_service") {
            $Services = new ImmigrationGovementService();
            $ems = 'IS' . time() . 'Kuwait';
        }
        $Services->name = $request->name;
        $Services->passport_number = $request->passport_number;
        $Services->uae_phone = $request->uae_phone;
        $Services->special_skill = $request->special_skill;
        $Services->residence = $request->residence;
        $Services->mailing_address = $request->mailing_address;
        $Services->permanent_address = $request->permanent_address;
        $Services->passport_type = $request->passport_type;
        $Services->passport_id = $request->passport_id;
        $Services->bd_phone = $request->bd_phone;
        $Services->service_taken = json_encode($request->services);
        $Services->total_fee =  $agency + $govt + $consultants + $ohters +  $versatilo;
        $Services->creator_id = Auth::user()->id;
        $Services->branch_id = Auth::user()->branch_id;
        $Services->ems = $ems;

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
        } else {
            $Services->passport_photocopy = $request->old_passport_photoCopy;
        }
        $Services->save();

        return redirect()->back()->with('success', 'Services Added successfull');
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

    public function addOnService($id, $type)
    {

        $professions = Profession::orderBy('name', 'ASC')->where('status', '1')->get();
        if ($type == "lost-passport") {
            $passportData = LostPassport::find($id);
        } elseif ($type == "manual-passport") {
            $passportData = ManualPassport::find($id);
        } elseif ($type == "new-born-baby-passport") {
            $passportData = NewBornBabyPassport::find($id);
        } elseif ($type == "renew-passport") {
            $passportData = RenewPassport::find($id);
        }
        //take service
        $premierData = PremierService::where('passport_id', $id)->where('passport_type', $type)->get();
        $expressData = ExpressService::where('passport_id', $id)->where('passport_type', $type)->get();
        $legalComplaintsData = LegalComplaintsService::where('passport_id', $id)->where('passport_type', $type)->get();
        $immigrationGovementData = ImmigrationGovementService::where('passport_id', $id)->where('passport_type', $type)->get();
        $totalTakenServices = $premierData->concat($expressData)->concat($legalComplaintsData)->concat($immigrationGovementData);

        //services
        $premierServices = OtherServiceFee::orderBy('id', 'DESC')->where('service_type', 'premier-service')->get();
        $expressServices = OtherServiceFee::orderBy('id', 'DESC')->where('service_type', 'express-service')->get();
        $legalComplaintsServices = OtherServiceFee::orderBy('id', 'DESC')->where('service_type', 'legal-complaints-service')->get();
        $immigrationGovementServices = OtherServiceFee::orderBy('id', 'DESC')->where('service_type', 'immigration-govement-service')->get();
        return view('DataEnterer.service_addon.index', compact('premierServices', 'expressServices', 'legalComplaintsServices', 'immigrationGovementServices', 'professions', 'passportData', 'type', 'totalTakenServices'));
    }
}
