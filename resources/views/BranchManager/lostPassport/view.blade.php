@extends('Others.print')

@section('print')

    <h2> {{ env('APP_NAME') }} </h2>

        <h3> Happy Center <br/> Lost Passport </h3>

        <div class="padding"></div>

        EMS : {{ $lostPassport->ems }}<div class="padding"></div>

        Full Name : {{ $lostPassport->name }}<div class="padding"></div>

        Passport Number : {{ $lostPassport->passport_number }}<div class="padding"></div>

        Entry Date : {{ date('m-d-Y',strtotime($lostPassport->created_at)) }}<div class="padding"></div>



        Profession : {{ $lostPassport->profession->name }} <div class="padding"></div>

        @if (!empty($lostPassport->profession_file))
            Profession File : <a style="color:red;font-weight:bold" href="{{ $lostPassport->profession_file }}" target="_blank"> View </a> <div class="padding"></div>
        @endif

        @if (!empty($lostPassport->gd_report_kuwait))
            GD Report Kuwait : <a style="color:red;font-weight:bold" href="{{ asset($lostPassport->gd_report_kuwait) }}" target="_blank"> View </a> <div class="padding"></div>
        @endif
        @if (!empty($lostPassport->passport_photocopy))
            Passport Photocopy : <a style="color:red;font-weight:bold" href="{{ asset($lostPassport->passport_photocopy) }}" target="_blank"> View </a> <div class="padding"></div>
        @endif
        @if (!empty($lostPassport->application_form))
            Application Form : <a style="color:red;font-weight:bold" href="{{ asset($lostPassport->application_form) }}" target="_blank"> View </a> <div class="padding"></div>
        @endif

        Bangladesh Phone :  {{ $lostPassport->bd_phone }}
        <div class="padding"></div>

        Kuwait Phone : {{ $lostPassport->kuwait_phone }}
        <div class="padding"></div>

        Civil ID :  {{ $lostPassport->civil_id }}<div class="padding"></div>

        Mailing Address :  {{  $lostPassport->mailing_address}}<div class="padding"></div>

        Bangladesh Permanent Address : {{  $lostPassport->permanent_address}}<div class="padding"></div>

        Special Skill : {{ $lostPassport->special_skill }}<div class="padding"></div>

        Residence Civil ID / Phone No : {{ $lostPassport->residence }}<div class="padding"></div>

        Entry Person : {{ $lostPassport->creator->name }}<div class="padding"></div>

        Delivery Date : {{ date('d-m-Y',strtotime($lostPassport->delivery_date)) }}<div class="padding"></div>


        Delivery Branch : {{ $lostPassport->deliveryBranch->name }}<div class="padding"></div>

        <div class="border"></div>

        <div class="padding"></div>

        {{-- @php
            $v = ( $lostPassport->salary == 1) ? 4 : 4;
            $e = ( $lostPassport->salary == 1) ? 13 : 41.50;
            $total = $v + $e
        @endphp --}}


        Versatilo Fee : <span style="float:right"> {{ number_format((float)$lostPassport->passport_type_versatilo_fee, 2, '.', '') }} </span>

        <div class="padding"></div>

        Embassy Fee : <span style="float:right"> {{ number_format((float)$lostPassport->passport_type_government_fee, 2, '.', '') }} </span>
        <div class="padding"></div>

        <div class="border"></div>

        <div class="padding"></div>

        <b> Net Amount :  <span style="float:right"> {{ number_format((float)$lostPassport->passport_type_fees_total, 2, '.', '') }} </span> </b>


@endsection
