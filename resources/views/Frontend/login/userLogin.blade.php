<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href=" {{ asset('assets/account-manager/images/favicon.ico') }}">

    @include('frontend.layouts.head')
    <title>User Login</title>
  </head>
  <body>
    <section class="userLoginBackground d-flex justify-content-center align-items-center">
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
              <form id="loginForm" class="formDivMain login" method="POST" action="{{ route('login') }}">
                @csrf
                <h2 class="userFormHeading font-weight-bold py-3">
                  USER LOG IN
                </h2>

                <input type="hidden" name="user_type" value="normal-user">
                <div class="form-row my-3">
                  <div class="noBorderField">
                    <b>Email</b>
                    <input
                      type="email"
                      placeholder="Enter Your Email"
                      class="form-control input-field"
                      name="email"
                    />
                    @error('email')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
                <div class="form-row my-3 py-4">
                  <div class="noBorderField">
                    <b>Password</b>
                    <input
                      type="password"
                      placeholder="********"
                      class="form-control input-field"
                      name="password"
                    />
                    @error('password')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                </div>

                <div class="form-row my-3 buttonPaddingTop py-4 text-center">
                  <button

                    type="submit"
                    class="form-control btn-1 p-3 text-white font-weight-bold"
                  >
                    <h5>Log in</h5>
                  </button>
                  <p class="text-center pb-5 py-5">
                    Don't have a account?
                    <a class="buttonText click-action" href="{{ route('userReg') }}">Create Account</a>
                  </p>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


    @include('Others.toaster_message')

    @include('frontend.layouts.foot')
  </body>
</html>
