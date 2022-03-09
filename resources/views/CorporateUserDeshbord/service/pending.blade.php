@extends('CorporateUserDeshbord.layouts.app')
@push('title')
Pending
@endpush
@section('body')
<div class="col-md-9 p-3">

   
       @include('CorporateUserDeshbord.service.pending_page',[
           'passports' => $renew_pendings,
           'model_name' => 'Renew'
       ])

       @include('CorporateUserDeshbord.service.pending_page',[
           'passports' => $manual_pendings,
           'model_name' => 'Manual'
       ])

       @include('CorporateUserDeshbord.service.pending_page',[
           'passports' => $lost_pendings,
           'model_name' => 'Lost'
       ])

       @include('CorporateUserDeshbord.service.pending_page',[
           'passports' => $new_baby_pendings,
           'model_name' => 'New'
       ])

       
  </div>

@endsection
