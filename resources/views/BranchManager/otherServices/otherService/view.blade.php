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
        <h3>Other Services</h3>

        <div class="padding"></div>

        Branch Name :{{ $serviceData->branch->name }}

        EMS : {{ $serviceData->ems }}<div class="padding"></div>

        Full Name : {{ $serviceData->name }}<div class="padding"></div>

        Passport Number : {{ $serviceData->passport_number }}<div class="padding"></div>

        Entry Date : {{ date('m-d-Y',strtotime($serviceData->created_at)) }}<div class="padding"></div>

        Profession : {{ $serviceData->profession->name }} <div class="padding"></div>

        Bangladesh Phone :  {{ $serviceData->bd_phone }}
        <div class="padding"></div>

        Kuwait Phone :  {{ $serviceData->uae_phone }}

        <div class="padding"></div>


        Emirates ID :  {{ $serviceData->emirates_id }}<div class="padding"></div>

        Mailing Address :  {{  $serviceData->mailing_address}}<div class="padding"></div>

        Bangladesh Parmanent Address :  {{  $serviceData->permanent_address}}<div class="padding"></div>

        Special Skill :  {{  $serviceData->special_skill}}<div class="padding"></div>

        Residence Emirates ID / Phone No :  {{  $serviceData->residence}}<div class="padding"></div>

        Delivery Date : {{ date('d-m-Y',strtotime($serviceData->delivery_date)) }}<div class="padding"></div>

        Delivery Branch : {{ $serviceData->deliveryBranch->name }}<div class="padding"></div>

        <div class="border"></div>

        <div class="padding"></div>

        <b> Net Amount :  <span style="float:right"> {{ number_format((float)$serviceData->fee, 2, '.', '') }} </span> </b>


@endsection
