<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href=" {{ asset('assets/data-enterer/images/favicon.ico') }}">
    @include('Frontend.layouts.head')
    <title>Data Entry Login</title>
  </head>
  <body>
    <section
      class="
      dataEntryBackground
        d-flex
        justify-content-center
        align-items-center
      "
    >
      <div class="userLoginPageContainer">
        <div class="row userLoginBgBorderRadius">
            <!-- Bg image first part -->
          <div class="col-md-6 userLoginBgImg">
            <img
              class="img-fluid userLoginBgImgChild"
              src="{{ asset('frontend_assets/img/Landing-page/images/Data-entry.png') }}"
              alt=""
            />
          </div>

          <!-- Form Section -->
          <div class="col-md-6 form-section bg-white">
              <div>
                <div class="backContainer"></div>
              </div>

            <div class="d-flex justify-content-center align-items-center">
              <img
                class="img-fluid verstaile-form-logo"
                src="{{ asset('frontend_assets/img/New folder/Logo-02.png') }}"
                alt=""
              />
            </div>

            <div class=" px-5 pt-5 d-flex justify-content-center formContainerResponsive">
                <form class="formDivMain" method="POST" action="{{ route('login') }}">
                    @csrf
                    <input type="hidden" name="user_type" value="data-enterer">
                    <h2 class="userFormHeading font-weight-bold py-3">DATA ENTRY LOG IN</h2>
                    <div class="form-row my-3">
                      <div class="noBorderField">
                         <b>Email</b>
                        <input
                          type="email"
                          placeholder="Enter Your Email"
                          class="form-control input-field"
                          name="email"
                          value="{{old('email')}}"
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
                    <div class="form-row my-3 buttonPaddingTop pt-4">


                          <button
                            type="submit"
                            class="form-control btn-1 p-3 text-white font-weight-bold"
                          ><h5>Log in</h5></button>
                        </div>
                      </div>
                  </form>
            </div>
          </div>
        </div>
      </div>
    </section>

    @include('Others.toaster_message')

    @include('Frontend.layouts.foot')
  </body>
</html>
