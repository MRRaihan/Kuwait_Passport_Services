@extends('Others.print')

@section('print')

    <h2> {{ env('APP_NAME') }} </h2>

        <h3> Happy Center <br/> Immigration And Government </h3>

        <div class="padding"></div>

        EMS : {{ $immigrationGovementService->ems }}<div class="padding"></div>

        Full Name : {{ $immigrationGovementService->name }}<div class="padding"></div>

        Passport Number : {{ $immigrationGovementService->passport_number }}<div class="padding"></div>

        Entry Date : {{ date('m-d-Y',strtotime($immigrationGovementService->created_at)) }}<div class="padding"></div>



        {{-- Profession : {{ $immigrationGovementService->profession->name }} <div class="padding"></div> --}}

        @if (!empty($immigrationGovementService->gd_report_kuwait))
            GD Report Kuwait : <a style="color:red;font-weight:bold" href="{{ asset($immigrationGovementService->gd_report_kuwait) }}" target="_blank"> View </a> <div class="padding"></div>
        @endif
        @if (!empty($immigrationGovementService->passport_photocopy))
            Passport Photocopy : <a style="color:red;font-weight:bold" href="{{ asset($immigrationGovementService->passport_photocopy) }}" target="_blank"> View </a> <div class="padding"></div>
        @endif
        @if (!empty($immigrationGovementService->application_form))
            Application Form : <a style="color:red;font-weight:bold" href="{{ asset($immigrationGovementService->application_form) }}" target="_blank"> View </a> <div class="padding"></div>
        @endif

        Bangladesh Phone :  {{ $immigrationGovementService->bd_phone }}
        <div class="padding"></div>

        Kuwait Phone : {{ $immigrationGovementService->kuwait_phone }}
        <div class="padding"></div>


        Mailing Address :  {{  $immigrationGovementService->mailing_address}}<div class="padding"></div>

        Bangladesh Permanent Address : {{  $immigrationGovementService->permanent_address}}<div class="padding"></div>

        Special Skill : {{ $immigrationGovementService->special_skill }}<div class="padding"></div>

        Residence Emirates ID / Phone No : {{ $immigrationGovementService->residence }}<div class="padding"></div>

        Entry Person : {{ $immigrationGovementService->user->name }} <div class="padding"></div>

        Branch Office :  {{ $immigrationGovementService->branch->name }}<div class="padding"></div>
        Taken Services :  @foreach (json_decode($immigrationGovementService->service_taken) as $item)  {{ get_other_service_fee_name_by_id($item) }} , @endforeach

        <div class="border"></div>

        <div class="padding"></div>

        {{-- @php
            $v = ( $immigrationGovementService->salary == 1) ? 4 : 4;
            $e = ( $immigrationGovementService->salary == 1) ? 13 : 41.50;
            $total = $v + $e
        @endphp --}}


        Versatilo Fee :<span style="float:right"> {{ number_format((float)$immigrationGovementService->versetilo_fee, 3, '.', '') }} </span>

        <div class="padding"></div>

        Agency Fee : <span style="float:right">{{ number_format((float)$immigrationGovementService->agency_fee, 3, '.', '') }}</span>

        <div class="padding"></div>

        Govt Fee : <span style="float:right">{{ number_format((float)$immigrationGovementService->govt_fee, 3, '.', '') }}</span>

        <div class="padding"></div>

        Consulttants Fee : <span style="float:right">{{ number_format((float)$immigrationGovementService->consulttants_fee, 3, '.', '') }}</span>

        <div class="padding"></div>

        Others Fee : <span style="float:right">{{ number_format((float)$immigrationGovementService->other_fee, 3, '.', '') }}</span>

        <div class="padding"></div>

        <div class="border"></div>

        <div class="padding"></div>

        <b> Net Amount :  <span style="float:right"> {{ number_format((float)$immigrationGovementService->total_fee, 2, '.', '') }} </span> </b>


@endsection
