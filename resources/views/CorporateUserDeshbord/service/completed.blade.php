@extends('CorporateUserDeshbord.layouts.app')
@push('title')
Completed
@endpush
@section('body')
<div class="col-md-9 p-3">

   
       @include('CorporateUserDeshbord.service.pending_page',[
           'passports' => $renew_completed,
           'model_name' => 'Renew',
           'status' => 'completed',
       ])

       @include('CorporateUserDeshbord.service.pending_page',[
           'passports' => $manual_completed,
           'model_name' => 'Manual',
           'status' => 'completed',
       ])

       @include('CorporateUserDeshbord.service.pending_page',[
           'passports' => $lost_completed,
           'model_name' => 'Lost',
           'status' => 'completed',
       ])

       @include('CorporateUserDeshbord.service.pending_page',[
           'passports' => $new_baby_completed,
           'model_name' => 'New',
           'status' => 'completed',
       ])

       
  </div>

@endsection
