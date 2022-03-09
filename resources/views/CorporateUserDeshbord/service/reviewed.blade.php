@extends('CorporateUserDeshbord.layouts.app')
@push('title')
Reviewed
@endpush
@section('body')
<div class="col-md-9 p-3">

   
       @include('CorporateUserDeshbord.service.pending_page',[
           'passports' => $renew_reviewed,
           'model_name' => 'Renew',
           'active' => true,
       ])

       @include('CorporateUserDeshbord.service.pending_page',[
           'passports' => $manual_reviewed,
           'model_name' => 'Manual',
           'active' => true,
       ])

       @include('CorporateUserDeshbord.service.pending_page',[
           'passports' => $lost_reviewed,
           'model_name' => 'Lost',
           'active' => true,
       ])

       @include('CorporateUserDeshbord.service.pending_page',[
           'passports' => $new_baby_reviewed,
           'model_name' => 'New',
           'active' => true,
       ])

       
  </div>

@endsection
