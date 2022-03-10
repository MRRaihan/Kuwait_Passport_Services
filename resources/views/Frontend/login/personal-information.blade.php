<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href=" {{ asset('assets/account-manager/images/favicon.ico') }}">

    @include('Frontend.layouts.head')
    <title>PERSONAL INFORMATION</title>
  </head>
  <body>
    <section
      class="userLoginBackground d-flex justify-content-center align-items-center"
    >
      <div class="userLoginPageContainer">
        <div class="row userLoginBgBorderRadius">
          <!-- Bg image first part -->
          <div class="col-md-6 userLoginBgImg">
            <!-- <img
              class="img-fluid userLoginBgImgChild"
              src="../assest/img/Landing-page/images/User.png"
              alt=""
            /> -->
          </div>

          <!-- Form Section -->

          <div class="col-md-6 form-section bg-white">
            <div>
              <div class="backContainer"></div>
            </div>

            <div class="d-flex justify-content-center align-items-center">
              <img
                class="img-fluid"
                src="../assest/img/New folder/Logo-02.png"
                alt=""
              />
            </div>

            <div
              class="px-5 pt-5 d-flex justify-content-center formContainerResponsive"
            >
              <div>


                <!-- Login -->
                <form id="loginForm" class="formDivMain" action="{{ route('informationStore') }}" method="POST">
                    @csrf
                  <h2 class="userFormHeading font-weight-bold py-3">
                    PERSONAL INFORMATION
                  </h2>

                  <div class="form-row my-3 py-3">
                    <div class="noBorderField">
                      <b>Full Name</b>
                      <input
                        type="text"
                        placeholder="Your name here" name="name"
                        class="form-control input-field"
                      />
                    </div>
                  </div>
                  <div class="form-row my-3 py-3">
                    <div class="noBorderField">
                      <b>Address</b>
                      <input
                        type="text" name="address"
                        placeholder="Your address here"
                        class="form-control input-field"
                      />
                    </div>
                  </div>
                  <div class="form-row my-3 py-3">
                    <div class="noBorderField">
                      <b>Contact Number</b>
                      <input
                        type="email" name="phone" value="{{ Session::get('mobile') }}" readonly
                        placeholder="Your email here"
                        class="form-control input-field"
                      />
                    </div>
                  </div>


                  <div class="form-row my-3 buttonPaddingTop py-4">
                    <button
                      type="submit"
                      class="form-control btn-1 p-3 text-white font-weight-bold mb-3"
                    >
                      <h5>Finish</h5>
                    </button>

                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    @include('Others.toaster_message')

    @include('Frontend.layouts.foot')
  </body>
</html>
