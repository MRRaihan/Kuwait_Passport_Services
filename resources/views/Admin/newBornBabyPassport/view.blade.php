@extends('Others.print')

@section('print')

    <h2> {{ env('APP_NAME') }} </h2>

        <h3> Happy Center <br/> New Born Baby Passport </h3>

        <div class="padding"></div>

        EMS : {{ $newBornBabyPassport->ems }}<div class="padding"></div>

        Full Name : {{ $newBornBabyPassport->name }}<div class="padding"></div>

        Passport Number : {{ $newBornBabyPassport->passport_number }}<div class="padding"></div>

        Entry Date : {{ date('m-d-Y',strtotime($newBornBabyPassport->created_at)) }}<div class="padding"></div>



        {{-- Profession : {{ $newBornBabyPassport->profession_id }} <div class="padding"></div> --}}

        @if (!empty($newBornBabyPassport->dob_file))
            Date Of Birth File : <a style="color:red;font-weight:bold" href="{{ $newBornBabyPassport->dob_file }}" target="_blank"> View </a> <div class="padding"></div>
        @endif
        @if (!empty($newBornBabyPassport->application_form))
            Application Form : <a style="color:red;font-weight:bold" href="{{ $newBornBabyPassport->application_form }}" target="_blank"> View </a> <div class="padding"></div>
        @endif

        @if (!empty($newBornBabyPassport->passport_photocopy))
            Passport Photocopy : <a style="color:red;font-weight:bold" href="{{ $newBornBabyPassport->passport_photocopy }}" target="_blank"> View </a> <div class="padding"></div>
        @endif

        Bangladesh Phone :  {{ $newBornBabyPassport->bd_phone }}
        <div class="padding"></div>

        Kuwait Phone : {{ $newBornBabyPassport->uae_phone }}
        <div class="padding"></div>

        Emirates ID :  {{ $newBornBabyPassport->emirates_id }}<div class="padding"></div>

        Mailing Address :  {{  $newBornBabyPassport->mailing_address }}<div class="padding"></div>

        Bangladesh Permanent Address : {{  $newBornBabyPassport->permanent_address}}<div class="padding"></div>

        {{-- Special Skill : {{ $newBornBabyPassport->special_skill }}<div class="padding"></div> --}}

        Residence Emirates ID / Phone No : {{ $newBornBabyPassport->residence }}<div class="padding"></div>

        Entry Person : {{ $newBornBabyPassport->creator->name }}<div class="padding"></div>

        Delivery Date : {{ date('d-m-Y',strtotime($newBornBabyPassport->delivery_date)) }}<div class="padding"></div>


        Delivery Branch : {{ $newBornBabyPassport->branch->name }}<div class="padding"></div>

        <div class="border"></div>

        <div class="padding"></div>

        {{-- @php
            $v = ( $newBornBabyPassport->salary == 1) ? 4 : 4;
            $e = ( $newBornBabyPassport->salary == 1) ? 13 : 41.50;
            $total = $v + $e
        @endphp --}}


        Versatilo Fee : <span style="float:right"> {{ number_format((float)$newBornBabyPassport->passport_type_versatilo_fee, 2, '.', '') }} </span>

        <div class="padding"></div>

        Embassy Fee : <span style="float:right"> {{ number_format((float)$newBornBabyPassport->passport_type_government_fee, 2, '.', '') }} </span>
        <div class="padding"></div>

        <div class="border"></div>

        <div class="padding"></div>

        <b> Net Amount :  <span style="float:right"> {{ number_format((float)$newBornBabyPassport->passport_type_fees_total, 2, '.', '') }} </span> </b>


@endsection
