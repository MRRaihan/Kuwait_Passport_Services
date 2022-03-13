@extends('Others.print')

@section('print')

        <h2> {{ env('APP_NAME') }} </h2>
        <h3> Happy Center <br/> New Born Baby Passport </h3>
        <div class="padding"></div>

        Date : {{  date('d-m-Y',strtotime($newBornBabyPassport->created_at)) }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

        Receipt :  <span class="psn"> {{ sprintf('%05d', $newBornBabyPassport->id) }}</span> <div class="padding"></div>

        User :{{ '2000'.$newBornBabyPassport->id }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Pay Mode : Cash <div class="padding"></div>

        Branch Office : {{ $newBornBabyPassport->branch->name }}<div class="padding"></div>

        EMS : {{ $newBornBabyPassport->ems }}<div class="padding"></div>

        Name : {{ $newBornBabyPassport->name }}<div class="padding"></div>

        MRP Passport No : {{ $newBornBabyPassport->passport_number }}<span class="psn"> </span><div class="padding"></div>

        <div class="border"></div>

        <div class="padding"></div>

        Phone :  {{ $newBornBabyPassport->kuwait_phone }}<div class="padding"></div>

        Emirates ID :  {{ $newBornBabyPassport->civil_id }}<div class="padding"></div>

        Entry Person : {{ $newBornBabyPassport->creator->name }} <div class="padding"></div>

        Delivery Date : {{ date('d-m-Y', strtotime($newBornBabyPassport->created_at. ' + 95 days')) }}<div class="padding"></div>




        Delivery Branch : {{ $newBornBabyPassport->branch->name }}<div class="padding"></div>
        <div class="border"></div>

        <div class="padding"></div>


        {{-- @php

                $v=02.250;
                $e=30.250;
                $total = $v + $e;
        @endphp --}}

        Versatilo Fee :<span style="float:right"> {{ number_format((float)$newBornBabyPassport->passport_type_versatilo_fee, 3, '.', '') }} </span>

        <div class="padding"></div>

        Embassy Fee : <span style="float:right">{{ number_format((float)$newBornBabyPassport->passport_type_government_fee, 3, '.', '') }}</span>
        <div class="padding"></div>

        <div class="border"></div>

        <div class="padding"></div>

        <b> Net Amount :  <span style="float:right"> {{ number_format((float)$newBornBabyPassport->passport_type_fees_total, 3, '.', '') }}</span> </b>

        <br>

        @php
            $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();

            $p_type = $newBornBabyPassport->ems;

        @endphp

        <img height="30" width="300" style="margin-top: 5px;" src="data:image/png;base64,{{ base64_encode($generatorPNG->getBarcode($p_type, $generatorPNG::TYPE_CODE_128)) }}">

        <b class="bar_text"> {{ $p_type }}, Branch : {{ $newBornBabyPassport->branch ? $newBornBabyPassport->branch->name : ''}}
        </b>


 @endsection
