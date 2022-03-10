<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- ....................Bootstarp css ............................-->
  <link rel="stylesheet" href="{{ asset('frontend_assets/css/bootstrap.min.css') }}" />
  <!-- .................font awesome...................................... -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!--------------------- custom css---------------------------- -->
  <link rel="stylesheet" href="{{ asset('frontend_assets/css/UserForm(14).css') }}" />

  <!--------------------- responsive css---------------------------- -->
  <link rel="stylesheet" href="../assest/css/responsive.css" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <title>User Form</title>
</head>

<body>

    <div class="container-fluid my-5">
      <div class="row">
        <div class="col-md-4 mb-3">
          <div class="card shadow mx-auto first-card">
            <div class="card-body">
              <div class="d-flex my-2">

                <img src="{{ isset(auth()->user()->image) ? public_path(auth()->user()->image) : asset(get_static_option('user')) }}" class="img-fluid person-img" alt="" />

                <div class="other mx-2">
                  <h6 class="m-0 p-0">{{ auth()->user()->name }}</h6>
                  <small class="m-0 p-0">{{ auth()->user()->address }}</small>
                </div>
              </div>
              <h5 class="my-5 mx-3 lost-title">Lost Passport</h5>

              <div class="my-4">
                <ul id="progressbar">
                  <li class="active" id="account">
                    <strong class="mx-1">Enter details <sub>(step-1)</sub>
                    </strong>
                  </li>
                  <li id="personal">
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
                <button class="btn submit-btn1 w-50 text-light fw-bold back">
                  Back
                </button>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-8">
          <!--===================== step-1 work start==================== -->

          {{-- <fieldset class=""> --}}
          <form action="{{ route('service.store') }}" method="post">
            @csrf
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-6">
                  <div class="first-card mx-auto">
                    <h5 class="info-title">Enter your information</h5>

                    <div class="my-3">
                      <label class="form-label">Passport type</label>
                      <select class="form-select select-forms text-muted" name="passport_type" id="passport_type" aria-label="Default select example">
                        <option value="">Select Passport type</option>
                          @if (isset(passportOptionsUsers()[0]))
                              @foreach (passportOptionsUsers() as $key => $passport )
                                <option {{ $type == $passport ? 'selected' : '' }} value="{{ $key }}">{{ $passport }}</option>
                              @endforeach
                          @endif
                      </select>
                    </div>
                    <div class="my-4">
                      <label for="exampleFormControlInput1" class="form-label">Passport Number</label>
                      <input type="text" class="form-control select-forms" name="passport_number" id="passport_number"
                        placeholder="Enter Passport Number" />
                    </div>

                    <div class="my-4">
                      <label for="exampleFormControlInput1" class="form-label">Full Name</label>
                      <input type="text" class="form-control select-forms" name="name" id="name"
                        placeholder="Enter Full Name" />
                    </div>

                    <div class="my-3">
                      <label class="form-label">Profession</label>
                      <select class="form-select select-forms text-muted" aria-label="Default select example">
                        <option selected>Select Profession</option>
                        @if (isset($professions[0]))
                            @foreach ($professions as $key => $profession)
                              <option value="{{ $profession->id }}">{{ $profession->name }}</option>
                            @endforeach
                        @endif
                      </select>
                    </div>

                    <div class="my-4">
                      <label for="emirates_id" class="form-label">Emirates ID</label>
                      <input type="text" class="form-control select-forms" name="emirates_id" id="emirates_id"
                        placeholder="Enter Civil ID" />
                    </div>

                    <div class="my-4">
                      <label for="bd_phone" class="form-label">Phone Number <sup>BD</sup>
                      </label>
                      <input type="text" class="form-control select-forms" name="bd_phone" id="bd_phone"
                        placeholder="+880" />
                    </div>

                    <div class="my-4">
                      <label for="kuwait_phone" class="form-label">Phone Number <sup>Kuwait</sup>
                      </label>
                      <input type="text" class="form-control select-forms" name="kuwait_phone" id="kuwait_phone"
                        placeholder="+971" />
                    </div>

                  </div>
                </div>

                <div class="col-md-6">
                  <div class="first-card mx-auto">
                    <div class="custom">
                      <label for="mailing_address" class="form-label">Mailing Address</label>
                      <input type="text" class="form-control select-forms" name="mailing_address" id="mailing_address"
                        placeholder="Enter Mailing Address" />
                    </div>
                    <div class="my-4">
                      <label for="permanent_address" class="form-label">Bangladesh Permanent Address</label>
                      <input type="text" class="form-control select-forms" name="permanent_address" id="permanent_address"
                        placeholder="+971" />
                    </div>
                    <div class="my-4">
                      <label for="gd_report_kuwait" class="form-label">GD report <sup>Kuwait</sup></label>
                      <input type="file" class="form-control select-forms" name="gd_report_kuwait" id="gd_report_kuwait"
                        placeholder="+971" />
                    </div>

                    <div class="my-4">
                      <label for="application_form" class="form-label">Application form upload</label>
                      <input type="file" class="form-control select-forms" name="application_form" id="application_form"
                        placeholder="+971" />
                    </div>

                    <div class="my-4">
                      <label for="passport_photocopy" class="form-label">Passport Photo copy</label>
                      <input type="file" class="form-control select-forms" name="passport_photo_copy" id="passport_photo_copy"
                        placeholder="+971" />
                    </div>

                    <div class="my-5">
                      <label for="exampleFormControlInput1" class="form-label">Delevery method</label>
                      <br />
                      <input class="form-check-input" type="radio" checked value="1" id="courier" name="delivery_method"/>
                      <label class="form-check-label" for="courier">
                        Courier
                      </label>
                      <div class="mx-2 d-inline">
                        <input class="form-check-input" type="radio" value="2" name="delivery_method" id="home_delivery" />
                        <label class="form-check-label" for="home_delivery">
                          Home Delivery
                        </label>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
            {{-- <button class="next btn_next_step1 btn action-button" type="submit">Next</button> --}}
            <input type="submit"  name="next" class="next btn_next_step_1 btn submit-btn1 text-white action-button" value="Next" />
          </form>
          {{-- </fieldset> --}}
          <!--===================== step-1 work end==================== -->

          <!--===================== step-2 work start==================== -->
          <fieldset>


          </fieldset>
          <!--===================== step-2 work end==================== -->

          <!--===================== step-3 work start==================== -->
          <fieldset>
            <div>
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

            </div>

            <input type="button"  class=" btn btn_step_3 action-button" value="Confirm" id="submit_data"/>
          </fieldset>

          <!--===================== step-3 work end==================== -->

          <!-- <fieldset>
            <div class="form-card">
              <div class="row">
                <div class="col-7"></div>
                <div class="col-5"></div>
              </div>
              <br /><br />
              <h2 class="purple-text text-center">
                <strong>SUCCESS !</strong>
              </h2>
              <br />
              <div class="row justify-content-center">
                <div class="col-3">
                  <img src="https://i.imgur.com/GwStPmg.png" class="fit-image" />
                </div>
              </div>
              <br /><br />
              <div class="row justify-content-center">
                <div class="col-7 text-center">
                  <h5 class="purple-text text-center">
                    You Have Successfully Signed Up
                  </h5>
                </div>
              </div>
            </div>
          </fieldset> -->

          <!---modal start--->
          <!-- Modal -->
            <div class="modal fade" id="confermModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">

                  <div class="modal-body congrats-modal">
                      <img src="{{ asset('frontend_assets/img/New folder/consgratuation.png') }}" alt="">
                      <h5 class="info-title">Congrats !</h5>
                      <p class="p-3 text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum assumenda autem enim facere perferendis quia mollitia commodi possimus voluptatibus nesciunt magnam aliquam impedit quisquam eos temporibus accusamus maxime deleniti recusandae</p>
                      <a href="{{ route('forntend.index') }}" class=" btn w-50 action-button mb-3">
                        Dashbord
                      </a>
                  </div>

                </div>
              </div>
            </div>

          <!---modal end--->
        </div>
      </div>
    </div>

    <!-- progressbar -->


  <!------------------------------- javascript and jquery files ------------------------------------------>

  <script type="text/javascript" src="../assest/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="../assest/js/popper.min.js"></script>
  <script>
    // $(document).on('click','#submit_data',function(){
    //   $('#confermModal').modal('show')

    // })
    // $(document).ready(function () {
    //   var current_fs, next_fs, previous_fs; //fieldsets
    //   var opacity;
    //   var current = 1;
    //   var steps = $("fieldset").length;

    //   setProgressBar(current);


    //   $(".next").click(function () {
    //     current_fs = $(this).parent();
    //     next_fs = $(this).parent().next();

    //     //Add Class Active
    //     $("#progressbar li")
    //       .eq($("fieldset").index(next_fs))
    //       .addClass("active");

    //     //show the next fieldset
    //     next_fs.show();
    //     //hide the current fieldset with style
    //     current_fs.animate({
    //       opacity: 0,
    //     }, {
    //       step: function (now) {
    //         // for making fielset appear animation
    //         opacity = 1 - now;

    //         current_fs.css({
    //           display: "none",
    //           position: "relative",
    //         });
    //         next_fs.css({
    //           opacity: opacity,
    //         });
    //       },
    //       duration: 500,
    //     });
    //     setProgressBar(++current);
    //   });



    //   //test end

    //   $(".previous").click(function () {
    //     current_fs = $(this).parent();
    //     previous_fs = $(this).parent().prev();

    //     //Remove class active
    //     $("#progressbar li")
    //       .eq($("fieldset").index(current_fs))
    //       .removeClass("active");

    //     //show the previous fieldset
    //     previous_fs.show();

    //     //hide the current fieldset with style
    //     current_fs.animate({
    //       opacity: 0,
    //     }, {
    //       step: function (now) {
    //         // for making fielset appear animation
    //         opacity = 1 - now;

    //         current_fs.css({
    //           display: "none",
    //           position: "relative",
    //         });
    //         previous_fs.css({
    //           opacity: opacity,
    //         });
    //       },
    //       duration: 500,
    //     });
    //     setProgressBar(--current);
    //   });

    //   function setProgressBar(curStep) {
    //     var percent = parseFloat(100 / steps) * curStep;
    //     percent = percent.toFixed();
    //     $(".progress-bar").css("width", percent + "%");
    //   }

    //   $(".submit").click(function () {
    //     return false;
    //   });



    // });
  </script>
      <!------------------------------- javascript files ------------------------------------------>
      <script type="text/javascript" src="{{ asset('frontend_assets/js/bootstrap.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('frontend_assets/js/popper.min.js') }}"></script>
</body>

</html>
