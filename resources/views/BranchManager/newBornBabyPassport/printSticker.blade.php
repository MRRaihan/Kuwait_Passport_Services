
@extends('Others.print')

@section('print')
@php
$generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();

$p_type = $newBornBabyPassport->ems;

@endphp



    <img height="35" width="300" style="margin-top: 5px;" src="data:image/png;base64,{{ base64_encode($generatorPNG->getBarcode($p_type, $generatorPNG::TYPE_CODE_128)) }}">
    <b class="bar_text"> {{ $p_type }}658 , AED: {{ number_format((float)$newBornBabyPassport->passport_type_fees_total, 3, '.', '') }} ,
        B: {{ $newBornBabyPassport->branch ? substr(strtoupper($newBornBabyPassport->branch->name),0,3) : ''}} <br>
        Name :  {{ $newBornBabyPassport->name }} <br>
        Service Name: Baby Passport , Phone: {{ $newBornBabyPassport->kuwait_phone }}<br>
        Emirates ID :  {{ $newBornBabyPassport->emirates_id }} , MRP No : {{ $newBornBabyPassport->passport_number }}<br>
        Entry Date : {{ date('d-m-Y', strtotime($newBornBabyPassport->created_at)) }} , Delivary date: {{ date('d-m-Y', strtotime($newBornBabyPassport->delivery_date)) }}
    </b>
@endsection
