@extends('Others.print')

@section('print')

    <h2> {{ env('APP_NAME') }} </h2>

        <h3> Happy Center <br/> Legal and Complaints Service </h3>

        <div class="padding"></div>

        EMS : {{ $legalComplaintsService->ems }}<div class="padding"></div>

        Full Name : {{ $legalComplaintsService->name }}<div class="padding"></div>

        Passport Number : {{ $legalComplaintsService->passport_number }}<div class="padding"></div>

        Entry Date : {{ date('m-d-Y',strtotime($legalComplaintsService->created_at)) }}<div class="padding"></div>



        {{-- Profession : {{ $legalComplaintsService->profession->name }} <div class="padding"></div> --}}

        @if (!empty($legalComplaintsService->gd_report_uae))
            GD Report UAE : <a style="color:red;font-weight:bold" href="{{ asset($legalComplaintsService->gd_report_uae) }}" target="_blank"> View </a> <div class="padding"></div>
        @endif
        @if (!empty($legalComplaintsService->passport_photocopy))
            Passport Photocopy : <a style="color:red;font-weight:bold" href="{{ asset($legalComplaintsService->passport_photocopy) }}" target="_blank"> View </a> <div class="padding"></div>
        @endif
        @if (!empty($legalComplaintsService->application_form))
            Application Form : <a style="color:red;font-weight:bold" href="{{ asset($legalComplaintsService->application_form) }}" target="_blank"> View </a> <div class="padding"></div>
        @endif

        Bangladesh Mobile :  {{ $legalComplaintsService->bd_phone }}
        <div class="padding"></div>

        UAE Phone : {{ $legalComplaintsService->uae_phone }}
        <div class="padding"></div>


        Mailing Address :  {{  $legalComplaintsService->mailing_address}}<div class="padding"></div>

        Bangladesh Permanent Address : {{  $legalComplaintsService->permanent_address}}<div class="padding"></div>

        Special Skill : {{ $legalComplaintsService->special_skill }}<div class="padding"></div>

        Residence Emirates ID / Mobile No : {{ $legalComplaintsService->residence }}<div class="padding"></div>

        Entry Person : {{ $legalComplaintsService->user->name }} <div class="padding"></div>

        Branch Office :  {{ $legalComplaintsService->branch->name }}<div class="padding"></div>
        Taken Services :  @foreach (json_decode($legalComplaintsService->service_taken) as $item)  {{ get_other_service_fee_name_by_id($item) }} , @endforeach

        <div class="border"></div>

        <div class="padding"></div>

        {{-- @php
            $v = ( $legalComplaintsService->salary == 1) ? 4 : 4;
            $e = ( $legalComplaintsService->salary == 1) ? 13 : 41.50;
            $total = $v + $e
        @endphp --}}


        Versatilo Fee :<span style="float:right"> {{ number_format((float)$legalComplaintsService->versetilo_fee, 3, '.', '') }} </span>

        <div class="padding"></div>

        Agency Fee : <span style="float:right">{{ number_format((float)$legalComplaintsService->agency_fee, 3, '.', '') }}</span>

        <div class="padding"></div>

        Govt Fee : <span style="float:right">{{ number_format((float)$legalComplaintsService->govt_fee, 3, '.', '') }}</span>

        <div class="padding"></div>

        Consulttants Fee : <span style="float:right">{{ number_format((float)$legalComplaintsService->consulttants_fee, 3, '.', '') }}</span>

        <div class="padding"></div>

        Others Fee : <span style="float:right">{{ number_format((float)$legalComplaintsService->other_fee, 3, '.', '') }}</span>

        <div class="padding"></div>

        <div class="border"></div>

        <div class="padding"></div>

        <b> Net Amount :  <span style="float:right"> {{ number_format((float)$legalComplaintsService->total_fee, 2, '.', '') }} </span> </b>


@endsection
