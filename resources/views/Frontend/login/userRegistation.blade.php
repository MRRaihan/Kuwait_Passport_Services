<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href=" {{ asset('assets/account-manager/images/favicon.ico') }}">

    @include('frontend.layouts.head')
    <title>User Registration/</title>
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


              <form id="createAccountForm" class="formDivMain" action="{{ route('userStore') }}" method="POST">
                @csrf
                <h2 class="userFormHeading font-weight-bold py-3">
                  CREATE ACCOUNT
                </h2>
                <div class="form-row my-3">
                  <div class="noBorderField">
                    <b>Mobile No</b>
                    <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Enter Your mobile" class="form-control input-field" onkeypress="return /[0-9+]/i.test(event.key)"/>
                    @error('phone')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
                <div class="form-row my-3 py-2">
                  <div class="noBorderField">
                    <b>Email</b>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter Your email" class="form-control input-field"/>
                    @error('email')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
                <div class="form-row my-3 py-2">
                  <div class="noBorderField">
                    <b>Password</b>
                    <input type="password" name="password"  placeholder="********" class="form-control input-field"/>
                    @error('password')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
                <div class="form-row my-3 py-2">
                  <div class="noBorderField">
                    <b>Confirm Password</b>
                    <input
                      type="password"
                      placeholder="********"
                      class="form-control input-field"
                      name="confirm_password"

                    />
                    @error('confirm_password')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                </div>

                <div class="form-row my-3 buttonPaddingTop py-4 text-center">
                  <button type="submit" class="form-control btn-1 p-3 text-white font-weight-bold">
                    <h5>Sign Up</h5></button>

                  <p class="text-center pb-5 py-3">
                    Already have a account?
                    <a class="buttonText click-action" href="{{ route('userLogin') }}"
                      >Login</a>
                  </p>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

    {{-- @include('Others.toaster_message') --}}

    @include('frontend.layouts.foot')
  </body>
</html>
