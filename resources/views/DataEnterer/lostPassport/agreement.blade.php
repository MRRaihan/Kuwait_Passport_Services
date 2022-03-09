@extends('Others.print')

@section('print')

    
    <h2> <u>অঙ্গীকারনামা</u> </h2>

    <div class="padding"></div>
    <div class="padding"></div><div class="padding"></div>[ স্বরাষ্ট্র মন্ত্রণালয়ের পত্র নং-৪৪,০০,০০০০,০৩৮,০২,০০১,১১-১৬৩ তারিখঃ ২০ জানুয়ারী, ২০১৬ অনুযায়ী।নং-বিডিবি
    ]
    <div class="padding"></div>
    <div class="padding"></div>
    <div class="padding"></div>

    নং-বিডিবি/এমএরপি /হারানো-12083


    <span style="float:right"> {{ date('d M Y') }} </span>

    <div class="padding"></div>
    <div class="padding"></div>

    <div class="padding"></div><div class="padding"></div>

    <div class="padding"></div><div class="padding"></div>


    আমি {{$lostPassport->name}} পূর্বের পাসপোর্ট নাং- {{$lostPassport->passport_number}} ,আমি সংযুক্ত আরব আমিরাতে আগমনের পর আমার পূর্বের মেশিন রিডেবল পাসপোর্ট মালিক ফেরত দেয়নি ।

    <div class="padding"></div>
    <div class="padding"></div>
    <div class="padding"></div>
    <div class="padding"></div>
    <div class="padding"></div>


    আমি {{$lostPassport->name}} এই মর্মে দূতাবাসের নিকট অঙ্গীকার করছি উপরোক্ত তথ্য সঠিক এবং কোন ভুল তথ্য দিয়ে থাকলে আইনত দন্ডনীয় হবে।



    <div class="padding"></div>
    <div class="padding"></div>
    <div class="padding"></div>
    <div class="padding"></div>
    <div class="padding"></div>


    <span style="float:right">
আপনার একান্ত অনুগত
<br><br> নাম : {{$lostPassport->name}}
<br><br>মোবাইল : {{$lostPassport->bd_phone}}

</span>


    <style>
        .recpt {
            top: 40%;
            left: 50%;
            transform: translate(-50% , -49%);
            position: absolute;
            width: 752px;
        }
    </style>





    <script type="text/javascript">
        window.onload = function() { window.print(); }
    </script>



@endsection

