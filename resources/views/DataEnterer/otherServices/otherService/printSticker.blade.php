@extends('Others.print')

@section('print')
    @php
     $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
     $p_type ='VL'.date('mY').'Kuwait'.sprintf('%05d', $serviceData->id).', KWD : '.number_format((float)$serviceData->fee, 3, '.', '');
    @endphp

    <img height="35" width="300" style="margin-top: 5px;" src="data:image/png;base64,{{ base64_encode($generatorPNG->getBarcode($p_type, $generatorPNG::TYPE_CODE_128)) }}">
    <b class="bar_text"> {{ $p_type }}</b><br>
        Name :  {{ $serviceData->name }} <br>
        Passport No:  {{ $serviceData->passport_number }} <br>
        Civil ID:  {{ $serviceData->civil_id }} <br>
        Phone: {{ $serviceData->kuwait_phone }}

@endsection
