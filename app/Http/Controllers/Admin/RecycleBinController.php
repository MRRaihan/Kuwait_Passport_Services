<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExpressService;
use App\Models\ImmigrationGovementService;
use App\Models\LegalComplaintsService;
use App\Models\LostPassport;
use App\Models\ManualPassport;
use App\Models\NewBornBabyPassport;
use App\Models\Other;
use App\Models\PremierService;
use App\Models\RenewPassport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class RecycleBinController extends Controller
{
    public function renew()
    {
        $renewPassports = RenewPassport::onlyTrashed()->orderBy('id', 'DESC')->get();
        return view('Admin.recycleBin.renew', compact('renewPassports'));
    }
    public function manual()
    {
        $manualPassports = ManualPassport::onlyTrashed()->orderBy('id', 'DESC')->get();
        return view('Admin.recycleBin.manual', compact('manualPassports'));
    }
    public function lost()
    {
        $lostPassports = LostPassport::onlyTrashed()->orderBy('id', 'DESC')->get();
        return view('Admin.recycleBin.lost', compact('lostPassports'));
    }
    public function newBornBaby()
    {
        $newBornBabyPassports = NewBornBabyPassport::onlyTrashed()->orderBy('id', 'DESC')->get();
        return view('Admin.recycleBin.newBornBaby', compact('newBornBabyPassports'));
    }
    public function premier()
    {
        $premierServices = PremierService::onlyTrashed()->orderBy('id', 'DESC')->get();
        return view('Admin.recycleBin.premier', compact('premierServices'));
    }
    public function express()
    {
        $expressServices = ExpressService::onlyTrashed()->orderBy('id', 'DESC')->get();
        return view('Admin.recycleBin.express', compact('expressServices'));
    }
    public function legalComplaints()
    {
        $legalComplaintsServices = LegalComplaintsService::onlyTrashed()->orderBy('id', 'DESC')->get();
        return view('Admin.recycleBin.legalComplaints', compact('legalComplaintsServices'));
    }
    public function immigrationGovt()
    {
        $immigrationGovementServices = ImmigrationGovementService::onlyTrashed()->orderBy('id', 'DESC')->get();
        return view('Admin.recycleBin.immigrationGovt', compact('immigrationGovementServices'));
    }
    public function other()
    {
        $others = Other::onlyTrashed()->orderBy('id', 'DESC')->get();
        return view('Admin.recycleBin.other', compact('others'));
    }

    public function otherServiceRestore($data){
        $service_id = explode('&', $data)[0] ?? '';
        $service_type = explode('&', $data)[1] ?? '';

        if($service_type == 0){
            $service = PremierService::withTrashed()->find($service_id);
        }
        if($service_type == 1){
            $service = ExpressService::withTrashed()->find($service_id);
        }
        if($service_type == 2){
            $service = LegalComplaintsService::withTrashed()->find($service_id);
        }
        if($service_type == 3){
            $service = ImmigrationGovementService::withTrashed()->find($service_id);
        }
        if($service_type == 4){
            $service = Other::withTrashed()->find($service_id);
        }

        try {
            $service->deleted_by = null;
            $service->save();
            $service->restore();
            return response()->json([
                'type' => 'success',
                'message' => 'This service has been successfully restored !'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'type' => 'error',
                'message' => $exception->getMessage()
            ]);
        }
    }

    public function otherServicePermanentDelete($data){
        $service_id = explode('&', $data)[0] ?? '';
        $service_type = explode('&', $data)[1] ?? '';

        if($service_type == 0){
            $service = PremierService::withTrashed()->find($service_id);
        }
        if($service_type == 1){
            $service = ExpressService::withTrashed()->find($service_id);
        }
        if($service_type == 2){
            $service = LegalComplaintsService::withTrashed()->find($service_id);
        }
        if($service_type == 3){
            $service = ImmigrationGovementService::withTrashed()->find($service_id);
        }
        if($service_type == 4){
            $service = Other::withTrashed()->find($service_id);
        }

        try {

            if ($service->profession_file != null)
                File::delete(public_path($service->profession_file)); //Old image delete
            if ($service->passport_photocopy != null)
                File::delete(public_path($service->passport_photocopy)); //Old pdf delete
            $service->forceDelete();
            return response()->json([
                'type' => 'success',
                'message' => 'This service has been permanently deleted !'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'type' => 'error',
                'message' => $exception->getMessage()
            ]);
        }
    }
}
