@extends('Others.print')

@section('print')

        <h2> {{ env('APP_NAME') }} </h2>
        <h3> Happy Center <br/> {{ $serviceType }} </h3>
        <div class="padding"></div>

        Date : {{  date('d-m-Y',strtotime($servicesData->created_at)) }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

        Receipt :  <span class="psn"> {{ sprintf('%05d', $servicesData->id) }}</span> <div class="padding"></div>

        User :{{ '2000'.$servicesData->id }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Pay Mode : Cash <div class="padding"></div>

        Branch Office :  {{ $servicesData->branch->name }}<div class="padding"></div>

        EMS : {{ $servicesData->ems }}<div class="padding"></div>

        Name : {{ $servicesData->name }}<div class="padding"></div>

        Phone :  {{ $servicesData->uae_phone }}<div class="padding"></div>

        MRP Passport No : {{ $servicesData->passport_number }}<span class="psn"> </span><div class="padding"></div>

        <div class="border"></div>

        <div class="padding"></div>



        Entry Person : {{ $servicesData->user->name }} <div class="padding"></div>

        Services :  @foreach (json_decode($servicesData->service_taken) as $item)  {{ get_other_service_fee_name_by_id($item) }} , @endforeach<div class="padding"></div>




        <div class="border"></div>

        <div class="padding"></div>

        Versatilo Fee :<span style="float:right"> {{ number_format((float)$servicesData->versetilo_fee, 3, '.', '') }} </span>

        <div class="padding"></div>

        Agency Fee : <span style="float:right">{{ number_format((float)$servicesData->agency_fee, 3, '.', '') }}</span>

        <div class="padding"></div>

        Govt Fee : <span style="float:right">{{ number_format((float)$servicesData->govt_fee, 3, '.', '') }}</span>

        <div class="padding"></div>

        Consulttants Fee : <span style="float:right">{{ number_format((float)$servicesData->consulttants_fee, 3, '.', '') }}</span>

        <div class="padding"></div>

        Others Fee : <span style="float:right">{{ number_format((float)$servicesData->other_fee, 3, '.', '') }}</span>

        <div class="padding"></div>

        <div class="border"></div>

        <div class="padding"></div>

        <b> Net Amount :  <span style="float:right"> {{ number_format((float)$servicesData->total_fee, 3, '.', '') }}</span> </b>

        <br>

        @php
            $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
            $p_type = $servicesData->ems;

        @endphp

        <img height="30" width="300" style="margin-top: 5px;" src="data:image/png;base64,{{ base64_encode($generatorPNG->getBarcode($p_type, $generatorPNG::TYPE_CODE_128)) }}">



        <b class="bar_text"> {{ $p_type }}, Branch : {{ $servicesData->branch ? $servicesData->branch->name : ''}}
        </b>
        {{-- <p> নতুন পাসপোর্ট নেওয়ার জন্য পুরাতন পাসপোর্ট নিয়ে আসুন। </p> --}}

 @endsection
