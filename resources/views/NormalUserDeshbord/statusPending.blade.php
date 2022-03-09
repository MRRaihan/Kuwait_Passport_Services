@extends('NormalUserDeshbord.layouts.app')
@push('title')
Pending
@endpush
@section('body')
<div class="col-md-9 p-3">

    @if (isset($passports[0]))
        @foreach ($passports as $key => $passport)
        <div class="pendingContainer mb-3">
          <section>
            <div class="stepper-wrapper">
              <div class="stepper-item completed">
                <div class="step-counter fontIconColor">
                  <i class="fas fa-laptop-code"></i>
                </div>
                <small class="step-name iconTextColor">Step 1</small>
                <div class="iconTextColor">Registration</div>
              </div>
              <div class="stepper-item active">
                <div class="step-counter fontIconColor">
                  <i class="fab fa-buffer"></i>
                </div>
                <small class="step-name iconTextColor">Step 2</small>
                <div class="iconTextColor">Pending</div>
              </div>
              <div class="stepper-item">
                <div class="step-counter">
                  <i class="fas fa-building"></i>
                </div>
                <small class="step-name">Step 3</small>
                <div class="">Review</div>
              </div>
              <div class="stepper-item">
                <div class="step-counter">
                  <i class="fas fa-file-invoice-dollar"></i>
                </div>
                <small class="step-name">Step 4</small>
                <div class="">Payment</div>
              </div>
              <div class="stepper-item">
                <div class="step-counter">
                  <i class="far fa-credit-card"></i>
                </div>
                <small class="step-name">Step 5</small>
                <div class="">Delivered</div>
              </div>
            </div>
          </section>
          <section class="mt-5">
            <div class="row">
              <div class="col-md-2">
                <ul>
                  <li class="listUnstyle">Service</li>
                  <li class="listUnstyle">Branch</li>
                  <li class="listUnstyle">Order</li>
                  <li class="listUnstyle">Cost</li>
                  <li class="listUnstyle">Payment</li>
                </ul>
              </div>
              <div class="col-md-4">
                <ul>
                  <li class="listUnstyle">{{ $passport->model_name }}</li>
                  <li class="listUnstyle">{{ $passport->branch ? $passport->branch->name : '' }}</li>
                  <li class="listUnstyle">{{ date("F j, Y",strtotime($passport->created_at)) }}</li>
                  <li class="listUnstyle">$ {{ $passport->passport_type_fees_total }}</li>
                  <li class="listUnstyle">Not Paid</li>
                </ul>
              </div>
              <div class="col-md-6">
                <div>
                  <div>
                    <big>Service</big>
                    <h1>{{ $passport->passport_number }}</h1>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
        @endforeach
        @else
        <div class="pendingContainer my-3">
          <div class="row">
            <div class="col-md-12 text-center">
              <img src="{{ asset('frontend_assets/img/not_found.png') }}" alt="" height="auto" width="50%">
              <p><i class="fas fa-ban"></i>
                Any Pending Passport Not Found!!
              </p>
            </div>
          </div>
      </div>
    @endif


  </div>
@endsection
