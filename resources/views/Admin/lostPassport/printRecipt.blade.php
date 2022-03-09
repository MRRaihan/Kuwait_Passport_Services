@extends('Others.print')

@section('print')

        <h2> {{ env('APP_NAME') }} </h2>
        <h3> Happy Center <br/> Lost Passport </h3>
        <div class="padding"></div>

        Date : {{  date('d-m-Y',strtotime($lostPassport->created_at)) }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

        Receipt :  <span class="psn"> {{ sprintf('%05d', $lostPassport->id) }}</span> <div class="padding"></div>

        User :{{ '2000'.$lostPassport->id }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Pay Mode : Cash <div class="padding"></div>

        Branch Office :  {{ $lostPassport->branch->name }}<div class="padding"></div>

        EMS : {{ $lostPassport->ems }}<div class="padding"></div>

        Name : {{ $lostPassport->name }}<div class="padding"></div>

        MRP Passport No : {{ $lostPassport->passport_number }}<span class="psn"> </span><div class="padding"></div>

        <div class="border"></div>

        <div class="padding"></div>

        Profession :  {{ $lostPassport->profession->name }}<div class="padding"></div>

        Mobile :  {{ $lostPassport->uae_phone }}<div class="padding"></div>

        Emirates ID :  {{ $lostPassport->emirates_id }}<div class="padding"></div>

        Entry Person : {{ $lostPassport->creator->name }} <div class="padding"></div>

        Delivery Date : {{ date('d-m-Y', strtotime($lostPassport->created_at. ' + 95 days')) }}<div class="padding"></div>




        Delivery Branch :{{ $lostPassport->deliveryBranch->name }} <div class="padding"></div>

        <div class="border"></div>

        <div class="padding"></div>

        Versatilo Fee :<span style="float:right"> {{ number_format((float)$lostPassport->passport_type_versatilo_fee, 3, '.', '') }} </span>

        <div class="padding"></div>

        Embassy Fee : <span style="float:right">{{ number_format((float)$lostPassport->passport_type_government_fee, 3, '.', '') }}</span>
        <div class="padding"></div>

        <div class="border"></div>

        <div class="padding"></div>

        <b> Net Amount :  <span style="float:right"> {{ number_format((float)$lostPassport->passport_type_fees_total, 3, '.', '') }}</span> </b>

        <br>

        @php
            $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();

            $p_type = $lostPassport->ems;

        @endphp

        <img height="30" width="300" style="margin-top: 5px;" src="data:image/png;base64,{{ base64_encode($generatorPNG->getBarcode($p_type, $generatorPNG::TYPE_CODE_128)) }}">



        <b class="bar_text"> {{ $p_type }}, Branch : {{ $lostPassport->branch ? $lostPassport->branch->name : ''}}
        </b>

 @endsection
