@extends('NormalUserDeshbord.layouts.app')
@push('title')
User Deshbord
@endpush
@section('body')

<div class="col-md-9 p-3 px-5">
  <h3>Dashboard</h3>
 
  <div class="row">
    <div class="col-md-3 pendingBox shadow m-1">
      <div class="d-flex justify-content-between p-3">
        <div class="pt-2">
          <i class="far fa-clock iconFont"></i>
          <h6>Pending</h6>
        </div>
        <div
          class="two d-flex justify-content-center align-items-center"
        >
          {{ $total_pending }}
        </div>
      </div>
    </div>
    <div class="col-md-3 reviewBox shadow m-1">
      <div class="d-flex justify-content-between p-3">
        <div class="pt-2">
          <i class="fas fa-search-location iconFont"></i>
          <h6>Reviewed</h6>
        </div>
        <div
          class="two d-flex justify-content-center align-items-center"
        >
          {{ $total_review }}
        </div>
      </div>
    </div>
    <div class="col-md-3 completeBox shadow m-1">
      <div class="d-flex justify-content-between p-3">
        <div class="pt-2">
          <i class="fas fa-check-circle iconFont"></i>
          <h6>Completed</h6>
        </div>
        <div
          class="two d-flex justify-content-center align-items-center"
        >
         {{ $total_complete }}
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-12 py-5">
    <h3>Services</h3>
    <div class="row">

      <div class="col-md-3 text-center completeBox m-1">
        <a href="{{ route('service',0) }}">
          <div class="d-flex justify-content-between p-3 ">
            <div class="pt-2 ">
              <img src="{{ asset('frontend_assets/img/Icons/new(3).png')}}" height="50" width="50" class="service-img my-2" alt="" />
              <h6>Renew Passport</h6>
            </div>

          </div>
        </a>
      </div>


      <div class="col-md-3 text-center completeBox m-1">
        <a href="{{ route('service',1) }}">
          <div class="d-flex justify-content-between p-3 ">
            <div class="pt-2 ">
              <img src="{{ asset('frontend_assets/img/Icons/manual.png')}}" height="50" width="50" class="service-img my-2" alt="" />
              <h6>Manual Passport</h6>
            </div>

          </div>
        </a>
      </div>


      <div class="col-md-3 text-center completeBox m-1">
        <a href="{{ route('service',2) }}">
          <div class="d-flex justify-content-between p-3 ">
            <div class="pt-2 ">
              <img src="{{ asset('frontend_assets/img/Icons/questions.png')}}" height="50" width="50" class="service-img my-2" alt="" />
              <h6>Lost Passport</h6>
            </div>

          </div>
        </a>
      </div>


      <div class="col-md-3 text-center completeBox m-1">
        <a href="{{ route('service',3) }}">
          <div class="d-flex justify-content-between p-3 ">
            <div class="pt-2 ">
              <img src="{{ asset('frontend_assets/img/Icons/baby.png')}}" height="50" width="50" class="service-img my-2" alt="" />
              <h6>New Born Baby Passport</h6>
            </div>

          </div>
        </a>
      </div>


      <div class="col-md-3 text-center completeBox m-1">
        <a href="{{ route('service',4) }}">
          <div class="d-flex justify-content-between p-3 ">
            <div class="pt-2 ">
              <img src="{{ asset('frontend_assets/img/Icons/planet.png')}}" height="50" width="50" class="service-img my-2" alt="" />
              <h6>E-Passport</h6>
            </div>

          </div>
        </a>
      </div>




    </div>
  </div>
</div>


@endsection
