@extends('NormalUserDeshbord.service.master')

@section('passport_service')
<div class="col-md-4 mb-3">
    <div class="card shadow mx-auto first-card">
      <div class="card-body">
        <div class="d-flex my-2">

          <img src="{{ isset(auth()->user()->image) ? asset(auth()->user()->image) : asset(get_static_option('user')) }}" class="img-fluid person-img" alt="" />

          <div class="other mx-2">
            <h6 class="m-0 p-0">{{ auth()->user()->name }}</h6>
            <small class="m-0 p-0">{{ auth()->user()->address }}</small>
          </div>
        </div>
        <h5 class="my-5 mx-3 lost-title">{{ $passport->model_name }}</h5>

        <div class="my-4">
          <ul id="progressbar">
            <li class="active" id="account">
              <strong class="mx-1">Enter details <sub>(step-1)</sub>
              </strong>
            </li>
            <li class="active" id="personal">
              <strong class="mx-1">Review <sub>(step-2)</sub></strong>
            </li>
            <li class="active" id="payment">
              <strong class="mx-1">Payment <sub>(step-3)</sub></strong>
            </li>
            <!-- <li id="confirm"><strong class="mx-1">Finish</strong></li> -->
          </ul>
        </div>

        <div class="container py-3">
          <div class="card left-content-card">
            <div class="card-body">
              <p class="text-light m-0 p-0">$ Cost list</p>
            </div>
            <div class="
                  d-flex
                  container
                  justify-content-between
                  text-light
                ">
              <span>Service Cost</span>
              <span>$20</span>
            </div>
            <div class="
                  d-flex
                  container
                  justify-content-between
                  text-light
                  my-2
                ">
              <span>Courier Fee</span>
              <span>$20</span>
            </div>
            <div class="
                  d-flex
                  container
                  justify-content-between
                  text-light
                  mb-3
                ">
              <span>Home Delevery fee</span>
              <span>$20</span>
            </div>
          </div>
        </div>

        <div class="text-center my-4">
         <a href="{{ route('service',$type) }}">
          <button class="btn submit-btn1 w-50 text-light fw-bold back">
            Back
          </button>
         </a>
        </div>
      </div>
    </div>
</div>
    <div class="col-md-8">
      <h5 class="info-title">Payment Method</h5>
      <!---card section----->
      <div class="py-2">

        <div class="payment-card-container">

          <div class="payment-car-item">
            <img src="{{ asset('frontend_assets/img/New folder/Visa_Inc._logo.svg.png') }}" alt="">
          </div>

          <div class="payment-car-item">
            <img src="{{ asset('frontend_assets/img/New folder/Visa_Inc._logo.svg.png') }}" alt="">
          </div>

          <div class="payment-car-item">
            <img src="{{ asset('frontend_assets/img/New folder/Visa_Inc._logo.svg.png') }}" alt="">
          </div>

          <div class="payment-car-item">
            <img src="{{ asset('frontend_assets/img/New folder/Visa_Inc._logo.svg.png') }}" alt="">
          </div>

        </div>
        <div class="show-fee-container py-5">
          <div class="card-image">
              <img src="{{ asset('frontend_assets/img/New folder/Hello-VISA.png') }}" alt="">
          </div>
          <div class="fee-infomation-container">
            <table>

              <tr class="fee-infomation-item">
                <td class="custom-label">Service fee</td>
                <td>50$</td>
              </tr>
              <tr class="fee-infomation-item">
                <td class="custom-label">Courier fee</td>
                <td>60$</td>
              </tr>
              <tr class="fee-infomation-item" id="total_fee">
                <td class="custom-label">Total</td>
                <td>110$</td>
              </tr>

            </table>
          </div>
        </div>

      </div>
      <!---card section end----->
      <div class="">
        <div class="row py-4">
          <div class="col-md-3">
            <div class="my-4">
              <label for="exampleFormControlInput1" class="form-label">Card Number</label>
              <input type="text" class="form-control select-forms" id="exampleFormControlInput1"
                placeholder="324 2345 3425" />
            </div>
            <div class="my-4">
              <label for="exampleFormControlInput1" class="form-label">Expiration date</label>
              <input type="text" class="form-control select-forms" id="exampleFormControlInput1"
                placeholder="MM YYY" />
            </div>
          </div>

          <div class="col-md-3">
            <div class="my-4">
              <label for="exampleFormControlInput1" class="form-label">Postal code</label>
              <input type="text" class="form-control select-forms" id="exampleFormControlInput1"
                placeholder="1230" />
            </div>
            <div class="my-4">
              <label for="exampleFormControlInput1" class="form-label">CVV</label>
              <input type="text" class="form-control select-forms" id="exampleFormControlInput1"
                placeholder="456" />
            </div>
         </div>
        </div>
      </div>


   <a href="{{ route('normalUser.dashbord') }}"> <input type="button"  class=" btn btn_step_3 btn-info text-white rounded action-button" value="Confirm" id="submit_data"/></a>

</div>
@endsection
