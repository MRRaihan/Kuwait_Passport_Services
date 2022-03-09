@extends('Others.print')

@section('print')
    @php
     $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
     $p_type ='VL'.date('mY').'Kuwait'.sprintf('%05d', $passport->id).', ATM : '.number_format((float)$passport->fee, 3, '.', '');
    @endphp

    <img height="35" width="300" style="margin-top: 5px;" src="data:image/png;base64,{{ base64_encode($generatorPNG->getBarcode($p_type, $generatorPNG::TYPE_CODE_128)) }}">
    <b class="bar_text"> {{ $p_type }}</b><br>
        Name :  {{ $passport->name }} <br>
        Passport No:  {{ $passport->passport_number }} <br>
        Emirates ID:  {{ $passport->emirates_id }} <br>
        Phone: {{ $passport->kuwait_phone }}

@endsection
