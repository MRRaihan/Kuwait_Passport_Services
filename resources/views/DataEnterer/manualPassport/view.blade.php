@extends('Others.print')

@section('style')
<style>
    .recpt{
        top: 50%;
        left: 50%;
        transform: translate(-50% , -49%);
        position: absolute;
        width: 1000px;
    }
      .recpt h1, h2, h3, h4, h5, h6{
          text-align: center;
          margin-top:2px;
          margin-bottom:2px;
      }
      .border{
          width:100%;
          border-bottom:1px solid;
      }
      .padding{
          padding-top:10px;
      }

      p.inline {display: inline-block;}
      .bar_code { margin-left: -8px;
    }

      .bar_text{
    font-size: 14px;
  }
      </style>

    <style type="text/css" media="print">
       .recpt{
        top: 30%! important;
        width: 400px;
       }

       .btn{
           display:none;
       }

        @page
        {
            size: auto;   /* auto is the initial value */
            margin: 0mm;  /* this affects the margin in the printer settings */

        }
    </style>
@endsection

@section('print')

        <h2> {{ env('APP_NAME') }} </h2>

        <h3> Happy Center <br/> Manual Extension </h3>

        <div class="padding"></div>

        EMS : {{ $passport->ems }}<div class="padding"></div>

        Name : {{ $passport->name }}<div class="padding"></div>

        Passport Number : {{ $passport->passport_number }}<div class="padding"></div>

        Entry Date : {{ date('m-d-Y',strtotime($passport->created_at)) }}<div class="padding"></div>

        Profession : {{ $passport->profession?  $passport->profession->name : ""}} <div class="padding"></div>

        @if (!empty($passport->profession_file))
            Profession File : <a style="color:red;font-weight:bold" href="{{ asset($passport->profession_file) }}" target="_blank"> View </a> <div class="padding"></div>
        @endif
        @if (!empty($passport->application_form))
            Application form : <a style="color:red;font-weight:bold" href="{{ asset($passport->application_form) }}" target="_blank"> View </a> <div class="padding"></div>
        @endif
        @if (!empty($passport->passport_photocopy))
            Passport photocopy : <a style="color:red;font-weight:bold" href="{{ asset($passport->passport_photocopy) }}" target="_blank"> View </a> <div class="padding"></div>
        @endif

        Phone :  {{ $passport->bd_phone }}
        <div class="padding"></div>

        Emirates ID :  {{ $passport->civil_id }}<div class="padding"></div>

        Address :  {{  $passport->mailing_address}}<div class="padding"></div>

        Post Office Id : {{  $passport->post_office}}<div class="padding"></div>

        Passport Expiry Date : {{ $passport->expiry_date }}<div class="padding"></div>

        Passport Extended To : {{ $passport->extended_to }}<div class="padding"></div>

        Entry Person : {{ $passport->creator->name }}<div class="padding"></div>

        Delivery Date : {{ date('d-m-Y',strtotime($passport->delivery_date)) }}<div class="padding"></div>

        Delivery Branch : {{ $passport->deliveryBranch->name }}<div class="padding"></div>

        <div class="border"></div>

        <div class="padding"></div>

        Versatilo Fee : <span style="float:right"> {{ number_format((float)$passport->passport_type_versatilo_fee, 2, '.', '') }} </span>

        <div class="padding"></div>

        Embassy Fee : <span style="float:right"> {{ number_format((float)$passport->passport_type_government_fee, 2, '.', '') }} </span>
        <div class="padding"></div>

        <div class="border"></div>

        <div class="padding"></div>

        <b> Net Amount :  <span style="float:right"> {{ number_format((float)$passport->passport_type_fees_total, 2, '.', '') }} </span> </b>


@endsection
