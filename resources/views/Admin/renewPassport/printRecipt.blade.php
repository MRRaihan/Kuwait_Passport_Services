@extends('Others.print')

@section('print')

<h2> {{ env('APP_NAME') }} </h2>

    <h3> Happy Center <br/> Renewal Passport </h3>

    <div class="padding"></div>

    Date :  {{ date('d-m-y',strtotime($passport->created_at)) }} &nbsp; &nbsp; &nbsp; Receipt :
     <span class="psn">{{ sprintf('%05d', $passport->id) }}</span> <div class="padding"></div>

    User : {{ $passport->id }} &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Pay Mode : Cash <div class="padding"></div>

    Office : {{ $passport->deliveryBranch->name }} <div class="padding"></div>

    EMS : {{ $passport->ems }} <div class="padding"></div>

    Name : {{ $passport->name }} <div class="padding"></div>

    MRP Passport Number : <span class="psn"> {{ $passport->passport_number }}</span><div class="padding"></div>

    <div class="border"></div>

    <div class="padding"></div>

    Profession : {{ $passport->profession?  $passport->profession->name : ""}} <div class="padding"></div>

    Phone : {{ $passport->kuwait_phone }} <div class="padding"></div>

    Civil ID : {{ $passport->civil_id }} <div class="padding"></div>

    Entry Person : {{ $passport->creator->name }} <div class="padding"></div>

    Delivery Date : {{ \Carbon\Carbon::parse($passport->delivery_date)->format('Y-m-d') }} <div class="padding"></div>

    Delivery Branch : {{ $passport->deliveryBranch->name }} <div class="padding"></div>

    <div class="border"></div>

    <div class="padding"></div>


    Versatilo Fee : <span style="float:right"> {{ number_format((float)$passport->passport_type_versatilo_fee, 2, '.', '') }} </span>

    <div class="padding"></div>

    Embassy Fee : <span style="float:right"> {{ number_format((float)$passport->passport_type_government_fee, 2, '.', '') }} </span>
    <div class="padding"></div>

    <div class="border"></div>

    <div class="padding"></div>

    <b> Net Amount :  <span style="float:right"> {{ number_format((float)$passport->passport_type_fees_total, 2, '.', '') }} </span> </b>

    @php
        $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
        $p_type ='EP'.date('mY').'Kuwait'.sprintf('%05d', $passport->id).', KWD : '.number_format((float)$passport->passport_type_fees_total, 3, '.', '');
    @endphp

    <img height="30" width="300" style="margin-top: 5px;" src="data:image/png;base64,{{ base64_encode($generatorPNG->getBarcode($p_type, $generatorPNG::TYPE_CODE_128)) }}">

    <b class="bar_text"> {{ $p_type }}
</b>
<p>নতুন পাসপোর্ট নেওয়ার জন্য অবশ্যই পুরাতন পাসপোর্ট নিয়ে আসবেন ।</p>
 @endsection
