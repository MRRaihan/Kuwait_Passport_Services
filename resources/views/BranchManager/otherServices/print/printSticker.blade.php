@extends('Others.print')

@section('print')
@php
// $v=02.250;
// $e=30.250;
// $total = $v + $e;
$generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();

$p_type = $servicesData->ems;

@endphp



    <img height="35" width="300" style="margin-top: 5px;" src="data:image/png;base64,{{ base64_encode($generatorPNG->getBarcode($p_type, $generatorPNG::TYPE_CODE_128)) }}">
    <b class="bar_text"> {{ $p_type }},
        Branch : {{ $servicesData->branch ? $servicesData->branch->name : ''}} </b><br>
        Name :  {{ $servicesData->name }} <br>
        MRP No :  {{ $servicesData->passport_number }} <br>
        Service Name: {{ $serviceType }} <br>
        Total Fee :  {{ $servicesData->total_fee }} <br>
        Phone: {{ $servicesData->uae_phone }}<br>
        Entry Date : {{ date('d-m-Y', strtotime($servicesData->created_at)) }}

@endsection
