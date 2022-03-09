@extends('Others.print')

@section('print')

<h2> {{ env('APP_NAME') }} </h2>

<h3> Happy Center </h3>

<div class="padding"></div>

Date : {{ date('d-m-y',strtotime($passport->created_at)) }} &nbsp; &nbsp; &nbsp; Receipt :  <span class="psn"> <?php echo sprintf('%05d', $passport->id); ?></span> <div class="padding"></div>

User : {{ date('d-m-y',strtotime($passport->created_at)) }}  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Pay Mode : Cash <div class="padding"></div>

Office : {{ $passport->office }} <div class="padding"></div>

EMS : {{ $passport->ems }}<div class="padding"></div>

Name : {{ $passport->full_name }}<div class="padding"></div>

Passport Number : {{ $passport->passport_number }}</span><div class="padding"></div>

<div class="border"></div>

<div class="padding"></div>

Profession : {{ $passport->profession_id }} <div class="padding"></div>

Phone : {{ $passport->uae_phone }} <div class="padding"></div>

Emirates ID : {{ $passport->emirates_id }} <div class="padding"></div>

Remarks : {{ $passport->remarks }} <div class="padding"></div>

Delivery Date : {{ $passport->delivery_date }} <div class="padding"></div>


Delivery Branch : {{ $passport->deliveryBranch->name }}<div class="padding"></div>

<div class="border"></div>

<div class="padding"></div>

<b> Net Amount :  <span style="float:right"> {{ number_format((float)$passport->fee, 2, '.', '') }} </span> </b>

    @php
        $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
        $p_type ='VL'.date('mY').'Kuwait'.sprintf('%05d', $passport->id).', ATM : '.number_format((float)$passport->fee, 3, '.', '');
    @endphp

    <img height="30" width="300" style="margin-top: 5px;" src="data:image/png;base64,{{ base64_encode($generatorPNG->getBarcode($p_type, $generatorPNG::TYPE_CODE_128)) }}">

    <b class="bar_text"> {{ $p_type }}
</b>

 @endsection
