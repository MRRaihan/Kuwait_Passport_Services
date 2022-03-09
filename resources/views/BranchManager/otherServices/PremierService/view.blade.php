@extends('Others.print')

@section('print')

    <h2> {{ env('APP_NAME') }} </h2>

        <h3> Happy Center <br/> Premier Service Table </h3>

        <div class="padding"></div>

        EMS : {{ $premierService->ems }}<div class="padding"></div>

        Full Name : {{ $premierService->name }}<div class="padding"></div>

        Passport Number : {{ $premierService->passport_number }}<div class="padding"></div>

        Entry Date : {{ date('m-d-Y',strtotime($premierService->created_at)) }}<div class="padding"></div>



        {{-- Profession : {{ $premierService->profession->name }} <div class="padding"></div> --}}

        @if (!empty($premierService->gd_report_uae))
            GD Report UAE : <a style="color:red;font-weight:bold" href="{{ asset($premierService->gd_report_uae) }}" target="_blank"> View </a> <div class="padding"></div>
        @endif
        @if (!empty($premierService->passport_photocopy))
            Passport Photocopy : <a style="color:red;font-weight:bold" href="{{ asset($premierService->passport_photocopy) }}" target="_blank"> View </a> <div class="padding"></div>
        @endif
        @if (!empty($premierService->application_form))
            Application Form : <a style="color:red;font-weight:bold" href="{{ asset($premierService->application_form) }}" target="_blank"> View </a> <div class="padding"></div>
        @endif

        Bangladesh Phone :  {{ $premierService->bd_phone }}
        <div class="padding"></div>

        Kuwait Phone : {{ $premierService->uae_phone }}
        <div class="padding"></div>


        Mailing Address :  {{  $premierService->mailing_address}}<div class="padding"></div>

        Bangladesh Permanent Address : {{  $premierService->permanent_address}}<div class="padding"></div>

        Special Skill : {{ $premierService->special_skill }}<div class="padding"></div>

        Residence Emirates ID / Phone No : {{ $premierService->residence }}<div class="padding"></div>

        Entry Person : {{ $premierService->user->name }} <div class="padding"></div>

        Branch Office :  {{ $premierService->branch->name }}<div class="padding"></div>
        Taken Services :  @foreach (json_decode($premierService->service_taken) as $item)  {{ get_other_service_fee_name_by_id($item) }} , @endforeach

        <div class="border"></div>

        <div class="padding"></div>

        {{-- @php
            $v = ( $premierService->salary == 1) ? 4 : 4;
            $e = ( $premierService->salary == 1) ? 13 : 41.50;
            $total = $v + $e
        @endphp --}}


        Versatilo Fee :<span style="float:right"> {{ number_format((float)$premierService->versetilo_fee, 3, '.', '') }} </span>

        <div class="padding"></div>

        Agency Fee : <span style="float:right">{{ number_format((float)$premierService->agency_fee, 3, '.', '') }}</span>

        <div class="padding"></div>

        Govt Fee : <span style="float:right">{{ number_format((float)$premierService->govt_fee, 3, '.', '') }}</span>

        <div class="padding"></div>

        Consulttants Fee : <span style="float:right">{{ number_format((float)$premierService->consulttants_fee, 3, '.', '') }}</span>

        <div class="padding"></div>

        Others Fee : <span style="float:right">{{ number_format((float)$premierService->other_fee, 3, '.', '') }}</span>

        <div class="padding"></div>

        <div class="border"></div>

        <div class="padding"></div>

        <b> Net Amount :  <span style="float:right"> {{ number_format((float)$premierService->total_fee, 2, '.', '') }} </span> </b>


@endsection
