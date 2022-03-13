
@extends('Others.print')

@section('print')
@php
$generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();

$p_type = $passport->ems;

@endphp



    <img height="35" width="300" style="margin-top: 5px;" src="data:image/png;base64,{{ base64_encode($generatorPNG->getBarcode($p_type, $generatorPNG::TYPE_CODE_128)) }}">
    <b class="bar_text"> {{ $p_type }}658 , KWD: {{ number_format((float)$passport->passport_type_fees_total, 3, '.', '') }} ,
        B: {{ $passport->branch ? substr(strtoupper($passport->branch->name),0,3) : ''}} <br>
        Name :  {{ $passport->name }} <br>
        Service Name: Manual Passport , Phone: {{ $passport->kuwait_phone }}<br>
        Emirates ID :  {{ $passport->civil_id }} , MRP No : {{ $passport->passport_number }}<br>
        Entry Date : {{ date('d-m-Y', strtotime($passport->created_at)) }} , Delivary date: {{ date('d-m-Y', strtotime($passport->delivery_date)) }}
    </b>
@endsection
