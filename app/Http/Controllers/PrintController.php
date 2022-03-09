<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\ExpressService;
use App\Models\LegalComplaintsService;
use App\Models\PremierService;
use App\Models\ImmigrationGovementService;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function printReceipt($id, $type)
    {
        if ($type == "premiem_service") {
            $servicesData = PremierService::findOrFail($id);
            $serviceType = "Premiem Services";
        } elseif ($type == "express_service") {
            $servicesData = ExpressService::findOrFail($id);
            $serviceType = "Express Services";
        } elseif ($type == "legel_service") {
            $servicesData = LegalComplaintsService::findOrFail($id);
            $serviceType = "Express Services";
        } elseif ($type == "Immigration_Services") {
            $servicesData = ImmigrationGovementService::findOrFail($id);
            $serviceType = "Immigration Govement Services";
        }

        $onload = true;

        return view('Others.print.printRecipt', compact('servicesData', 'onload', 'serviceType'));
    }

    public function printSticker($id, $type)
    {

        if ($type == "premiem_service") {
            $servicesData = PremierService::findOrFail($id);
            $serviceType = "Premiem Services";
        } elseif ($type == "express_service") {
            $servicesData = ExpressService::findOrFail($id);
            $serviceType = "Express Services";
        } elseif ($type == "legel_service") {
            $servicesData = LegalComplaintsService::findOrFail($id);
            $serviceType = "Legel Service";
        } elseif ($type == "Immigration_Services") {
            $servicesData = ImmigrationGovementService::findOrFail($id);
            $serviceType = "Immigration Govement Services";
        }

        $onload = true;
        return view('Others.print.printSticker', compact('servicesData', 'onload', 'serviceType'));
    }
}
