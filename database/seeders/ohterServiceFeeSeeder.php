<?php

namespace Database\Seeders;

use App\Models\OtherServiceFee;
use Illuminate\Database\Seeder;

class ohterServiceFeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //premiem service
        $otherServiceFee = new OtherServiceFee();
        $otherServiceFee->title = 'photo copy';
        $otherServiceFee->service_type = 'premier-service';
        $otherServiceFee->versetilo_fee = 60;
        $otherServiceFee->agency_fee = 70;
        $otherServiceFee->govt_fee = 80;
        $otherServiceFee->consultants_fee = 90;
        $otherServiceFee->other_fee = 0;
        $otherServiceFee->service_status = "2";
        $otherServiceFee->save();

        $otherServiceFee = new OtherServiceFee();
        $otherServiceFee->title = 'print';
        $otherServiceFee->service_type = 'premier-service';
        $otherServiceFee->versetilo_fee = 60;
        $otherServiceFee->agency_fee = 70;
        $otherServiceFee->govt_fee = 80;
        $otherServiceFee->consultants_fee = 90;
        $otherServiceFee->other_fee = 0;
        $otherServiceFee->service_status = "2";
        $otherServiceFee->save();

        //expresss service
        $otherServiceFee = new OtherServiceFee();
        $otherServiceFee->title = 'food';
        $otherServiceFee->service_type = 'express-service';
        $otherServiceFee->versetilo_fee = 60;
        $otherServiceFee->agency_fee = 70;
        $otherServiceFee->govt_fee = 80;
        $otherServiceFee->consultants_fee = 90;
        $otherServiceFee->other_fee = 0;
        $otherServiceFee->service_status = "2";
        $otherServiceFee->save();

        //legel service
        $otherServiceFee = new OtherServiceFee();
        $otherServiceFee->title = 'divorce papers';
        $otherServiceFee->service_type = 'legal-complaints-service';
        $otherServiceFee->versetilo_fee = 60;
        $otherServiceFee->agency_fee = 70;
        $otherServiceFee->govt_fee = 80;
        $otherServiceFee->consultants_fee = 90;
        $otherServiceFee->other_fee = 0;
        $otherServiceFee->service_status = "2";
        $otherServiceFee->save();


        //legel service
        $otherServiceFee = new OtherServiceFee();
        $otherServiceFee->title = 'NID';
        $otherServiceFee->service_type = 'immigration-govement-service';
        $otherServiceFee->versetilo_fee = 60;
        $otherServiceFee->agency_fee = 70;
        $otherServiceFee->govt_fee = 80;
        $otherServiceFee->consultants_fee = 90;
        $otherServiceFee->other_fee = 0;
        $otherServiceFee->service_status = "2";
        $otherServiceFee->save();
    }
}
