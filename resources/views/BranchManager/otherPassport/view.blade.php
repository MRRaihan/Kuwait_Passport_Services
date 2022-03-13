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

        <h3> Happy Center </h3>

        <div class="padding"></div>

        EMS : {{ $passport->ems }}<div class="padding"></div>

        Full Name : {{ $passport->name }}<div class="padding"></div>

        Passport Number : {{ $passport->passport_number }}<div class="padding"></div>

        Entry Date : {{ date('m-d-Y',strtotime($passport->created_at)) }}<div class="padding"></div>

        Profession : {{ $passport->profession_id }} <div class="padding"></div>

        Bangladesh Phone :  {{ $passport->bd_mobile }}
        <div class="padding"></div>

        Kuwait Phone :  {{ $passport->kuwait_phone }}

        <div class="padding"></div>


        Emirates ID :  {{ $passport->civil_id }}<div class="padding"></div>

        Remarks :  {{ $passport->remarks }}<div class="padding"></div>

        Mailing Address :  {{  $passport->mailing_address}}<div class="padding"></div>

        Bangladesh Parmanent Address :  {{  $passport->permanent_address}}<div class="padding"></div>

        Special Skill :  {{  $passport->special_skill}}<div class="padding"></div>

        Residence Emirates ID / Phone No :  {{  $passport->residence}}<div class="padding"></div>

        Delivery Date : {{ date('d-m-Y',strtotime($passport->delivery_date)) }}<div class="padding"></div>

        Delivery Branch : {{ $passport->deliveryBranch->name }}<div class="padding"></div>

        <div class="border"></div>

        <div class="padding"></div>

        <b> Net Amount :  <span style="float:right"> {{ number_format((float)$passport->fee, 2, '.', '') }} </span> </b>


@endsection
