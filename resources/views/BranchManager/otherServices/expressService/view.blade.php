@extends('Others.print')

@section('print')

    <h2> {{ env('APP_NAME') }} </h2>

        <h3> Happy Center <br/> Express Service </h3>

        <div class="padding"></div>

        EMS : {{ $expressService->ems }}<div class="padding"></div>

        Full Name : {{ $expressService->name }}<div class="padding"></div>

        Passport Number : {{ $expressService->passport_number }}<div class="padding"></div>

        Entry Date : {{ date('m-d-Y',strtotime($expressService->created_at)) }}<div class="padding"></div>



        {{-- Profession : {{ $expressService->profession->name }} <div class="padding"></div> --}}

        @if (!empty($expressService->gd_report_uae))
            GD Report UAE : <a style="color:red;font-weight:bold" href="{{ asset($expressService->gd_report_uae) }}" target="_blank"> View </a> <div class="padding"></div>
        @endif
        @if (!empty($expressService->passport_photocopy))
            Passport Photocopy : <a style="color:red;font-weight:bold" href="{{ asset($expressService->passport_photocopy) }}" target="_blank"> View </a> <div class="padding"></div>
        @endif
        @if (!empty($expressService->application_form))
            Application Form : <a style="color:red;font-weight:bold" href="{{ asset($expressService->application_form) }}" target="_blank"> View </a> <div class="padding"></div>
        @endif

        Bangladesh Mobile :  {{ $expressService->bd_phone }}
        <div class="padding"></div>

        Kuwait Phone : {{ $expressService->uae_phone }}
        <div class="padding"></div>


        Mailing Address :  {{  $expressService->mailing_address}}<div class="padding"></div>

        Bangladesh Permanent Address : {{  $expressService->permanent_address}}<div class="padding"></div>

        Special Skill : {{ $expressService->special_skill }}<div class="padding"></div>

        Residence Emirates ID / Mobile No : {{ $expressService->residence }}<div class="padding"></div>

        Entry Person : {{ $expressService->user->name }} <div class="padding"></div>

        Branch Office :  {{ $expressService->branch->name }}<div class="padding"></div>
        Taken Services :  @foreach (json_decode($expressService->service_taken) as $item)  {{ get_other_service_fee_name_by_id($item) }} , @endforeach

        <div class="border"></div>

        <div class="padding"></div>

        {{-- @php
            $v = ( $expressService->salary == 1) ? 4 : 4;
            $e = ( $expressService->salary == 1) ? 13 : 41.50;
            $total = $v + $e
        @endphp --}}


        Versatilo Fee :<span style="float:right"> {{ number_format((float)$expressService->versetilo_fee, 3, '.', '') }} </span>

        <div class="padding"></div>

        Agency Fee : <span style="float:right">{{ number_format((float)$expressService->agency_fee, 3, '.', '') }}</span>

        <div class="padding"></div>

        Govt Fee : <span style="float:right">{{ number_format((float)$expressService->govt_fee, 3, '.', '') }}</span>

        <div class="padding"></div>

        Consulttants Fee : <span style="float:right">{{ number_format((float)$expressService->consulttants_fee, 3, '.', '') }}</span>

        <div class="padding"></div>

        Others Fee : <span style="float:right">{{ number_format((float)$expressService->other_fee, 3, '.', '') }}</span>

        <div class="padding"></div>

        <div class="border"></div>

        <div class="padding"></div>

        <b> Net Amount :  <span style="float:right"> {{ number_format((float)$expressService->total_fee, 2, '.', '') }} </span> </b>


@endsection
