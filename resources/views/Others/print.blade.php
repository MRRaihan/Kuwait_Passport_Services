<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> {{ env('APP_NAME') }} - Print - <?php time(); ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

<style>

@if (!isset($bold))
  body{ font-weight:bold; }
@endif

.recpt{
    top: 50%;
    left: 50%;
    transform: translate(-50% , -49%);
    position: absolute;
    width: 360px;
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
  .psn{
      font-size:20px;
  }


  </style>

@yield('style')

<style type="text/css" media="print">
   body{ font-weight:bold; }
   .recpt{
    top: 30%! important;
   }

    @page
    {
        size: auto;   /* auto is the initial value */
        margin: 0mm;  /* this affects the margin in the printer settings */
    }

    @media print {
  #printPageButton {
    display: none;
  }
}
</style>
  </head>
  <body @if($onload == true) onload="window.print();"  @endif >
    @if(isset($print))
    <button id="printPageButton" style="color: #fff;background-color: #337ab7; border-color: #2e6da4;float:right;padding:20px;cursor:pointer" onclick="window.print()" class="btn btn-primary">  Print</button>
    @endif

    <div class="recpt" style="margin-top: 50px;">
      <section class="main">
          @yield('print')
      </section>
    </div>
  </body>
  </html>
