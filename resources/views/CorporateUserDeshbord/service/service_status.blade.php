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
            <li id="payment">
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
         <a href="{{ route('corporateUser.service.index',$type) }}">
          <button class="btn submit-btn1 w-50 text-light fw-bold back">
            Back
          </button>
         </a>
        </div>
      </div>
    </div>
  </div>

<div class="col-md-8">

  <div class="row pb-4">

    <div class="review-inforamtion col-md-8">

      <a href="{{ route('corporateUser.service.status',$type.'&'.$passport->id.'&edit') }}">
        <div class="infor-edit">
          <i class="fa fa-pencil" aria-hidden="true"></i>
        </div>
      </a>

      <h5 class="info-title">Review information</h5>
      <div class="py-5">

        <table class="review-infomation-container ">

            <tr class="review-infomation-item">
              <td class="custom-label">Passport Type</td>
              <td>{{ $passport->model_name }}</td>
            </tr>
            <tr class="review-infomation-item">
              <td class="custom-label">Passport Number</td>
              <td>{{ $passport->passport_number }}</td>
            </tr>
            <tr class="review-infomation-item">
              <td class="custom-label">Full name</td>
              <td>{{ $passport->name }}</td>
            </tr>
            <tr class="review-infomation-item">
              <td class="custom-label">Profession</td>
              <td>{{ $passport->profession ? $passport->profession->name : '' }}</td>
            </tr>
            <tr class="review-infomation-item">
              <td class="custom-label">Emirate ID</td>
              <td>{{ $passport->emirates_id }}</td>
            </tr>
            <tr class="review-infomation-item">
              <td class="custom-label">Phone number<span class="county-phone">BD</span></td>
              <td>{{ $passport->bd_phone }}</td>
            </tr>
            <tr class="review-infomation-item">
              <td class="custom-label">Phone number<span class="county-phone">Kuwait</span></td>
              <td>{{ $passport->kuwait_phone }}</td>
            </tr>
            <tr class="review-infomation-item">
              <td class="custom-label">Malling address</td>
              <td>{{ $passport->mailing_address }}</td>
            </tr>
            <tr class="review-infomation-item">
              <td class="custom-label">Bangladesh permanent address</td>
              <td>{{ $passport->permanent_address }}</td>
            </tr>


        </table>
      </div>
    </div>
    <div class="review-payment-status col-md-8">
      <div id="reload" class="infor-edit" style="cursor:progress">
        <i class="fa fa-repeat" aria-hidden="true"></i>
      </div>
      <h5 class="info-title">Review Status</h5>
      <p class="payment-info-lavel">Applied : {{ date('d-m-Y',strtotime($passport->created_at)).', '.date('H:i A',strtotime($passport->created_at)) }}</p>
      <div class="payment-info-content">

        <p>A general request can take up to 48 hours. If your request is declined, please contact our team.</p>

      </div>
      <h5 class="payment-thankyour">Thank you for being with us.</h5>
      <div class="payment-pending">
        <img src="{{ asset("/frontend_assets/img/Landing-page/images/Raw/panding.png") }}" alt="">
      </div>
      <p class="payment-info-lavel">status</p>
      <a href="" class="btn payment-pending-btn">Pending</a>
    </div>
  </div>
  <a class="btn btn-md previous btn_step_2 action-button-previous"  href=""> <i class="fa fa-arrow-left text-white"></i> Previous</a>
  @if ($passport->status == 1)
    <a href="{{ route('corporateUser.service.payment',$type.'&'.$passport->id) }}" style="margin-left: 31%" class="next rounded-pill px-5 btn badge-pill btn-primary action-button"> Next <i class="fa fa-arrow-right text-white"></i>
    </a>
  @endif

</div>

  <script>
    document.getElementById("reload").addEventListener("click", function() {
        location.reload();
    });
  </script>
@endsection
