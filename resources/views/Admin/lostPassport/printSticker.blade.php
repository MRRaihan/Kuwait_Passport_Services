@extends('Others.print')

@section('print')
@php
$generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();

$p_type = $lostPassport->ems;

@endphp



    <img height="35" width="300" style="margin-top: 5px;" src="data:image/png;base64,{{ base64_encode($generatorPNG->getBarcode($p_type, $generatorPNG::TYPE_CODE_128)) }}">
    <b class="bar_text"> {{ $p_type }}658 , KWD: {{ number_format((float)$lostPassport->passport_type_fees_total, 3, '.', '') }} ,
        B: {{ $lostPassport->branch ? substr(strtoupper($lostPassport->branch->name),0,3) : ''}} <br>
        Name :  {{ $lostPassport->name }} <br>
        Entry Person :  {{ $lostPassport->creator->name }} <br>
        Service Name: Lost Passport , Phone: {{ $lostPassport->kuwait_phone }}<br>
        Civil ID :  {{ $lostPassport->civil_id }} , MRP No : {{ $lostPassport->passport_number }}<br>
        Entry Date : {{ date('d-m-Y', strtotime($lostPassport->created_at)) }} , Delivary date: {{ date('d-m-Y', strtotime($lostPassport->delivery_date)) }}
    </b>
@endsection
