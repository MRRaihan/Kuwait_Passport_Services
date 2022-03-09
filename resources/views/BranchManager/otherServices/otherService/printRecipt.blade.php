@extends('Others.print')

@section('print')

<h2> {{ env('APP_NAME') }} </h2>

<h3> Happy Center </h3>

<div class="padding"></div>

Date : {{ date('d-m-y',strtotime($serviceData->created_at)) }} &nbsp; &nbsp; &nbsp; Receipt :  <span class="psn"> <?php echo sprintf('%05d', $serviceData->id); ?></span> <div class="padding"></div>

User : {{ date('d-m-y',strtotime($serviceData->created_at)) }}  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Pay Mode : Cash <div class="padding"></div>

Branch Name :{{ $serviceData->branch->name }}<div class="padding"></div>

EMS : {{ $serviceData->ems }}<div class="padding"></div>

Name : {{ $serviceData->name }}<div class="padding"></div>

Passport Number : {{ $serviceData->passport_number }}</span><div class="padding"></div>

<div class="border"></div>

<div class="padding"></div>

Profession : {{ $serviceData->profession->name }} <div class="padding"></div>

Mobile : {{ $serviceData->uae_phone }} <div class="padding"></div>

Emirates ID : {{ $serviceData->emirates_id }} <div class="padding"></div>
Delivery Branch : {{ $serviceData->deliveryBranch->name }} <div class="padding"></div>

{{-- Remarks : {{ $serviceData->remarks }} <div class="padding"></div> --}}

{{-- Delivery Date : {{ $serviceData->delivery_date }} <div class="padding"></div> --}}




<div class="border"></div>

<div class="padding"></div>

<b> Net Amount :  <span style="float:right"> {{ number_format((float)$serviceData->fee, 2, '.', '') }} </span> </b>

    @php
        $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();

    @endphp

    <img height="30" width="300" style="margin-top: 5px;" src="data:image/png;base64,{{ base64_encode($generatorPNG->getBarcode($serviceData->ems, $generatorPNG::TYPE_CODE_128)) }}">

    <b class="bar_text"> {{ $serviceData->ems }}
</b>

 @endsection
