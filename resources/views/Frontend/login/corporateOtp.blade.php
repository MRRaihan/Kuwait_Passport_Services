<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href=" {{ asset('assets/account-manager/images/favicon.ico') }}">

    @include('Frontend.layouts.head')
    <title>Corporate OTP</title>
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
              src="{{ asset('frontend_assets/img/New folder/Logo-02.png') }}"
              alt=""
            />
          </div>

          <div
            class="px-5 pt-5 d-flex justify-content-center formContainerResponsive"
          >
            <div class="pb-5">
                <form action="{{ route('corporateCheckOtp') }}" method="post">
                    @csrf


                    <input type="hidden" name="old_mobile" value="{{ Session::get('mobile') }}">
                    <div class="otp-text-container">
                        <h2 class="userFormHeading font-weight-bold py-2">
                          OTP VERIFICATION
                        </h2>
                        <p>An OTP is sent to your provided number {{ Session::get('mobile') }}</p>
                    </div>
                    <h5 class="userFormHeading font-weight-bold py-3">
                    Enter OTP
                    </h5>
                    <div class="otp-input-container pb-4">
                    <input type="text" value="{{ old('otp1') }}" class="otp-input-item" maxlength="1" id="first" name="otp1" onkeyup="movetoNext(this, 'second')">
                    <input type="text" value="{{ old('otp2') }}" class="otp-input-item" maxlength="1" id="second" name="otp2" onkeyup="movetoNext(this, 'third')">
                    <input type="text" value="{{ old('otp3') }}" class="otp-input-item" maxlength="1" id="third" name="otp3" onkeyup="movetoNext(this, 'fourth')">
                    <input type="text" value="{{ old('otp4') }}" class="otp-input-item" maxlength="1" id="fourth" name="otp4" onkeyup="movetoNext(this, 'fivth')">
                    <input type="text" value="{{ old('otp5') }}" class="otp-input-item" maxlength="1" id="fivth" name="otp5" onkeyup="movetoNext(this, 'sixth')">
                    <input type="text" value="{{ old('otp6') }}" class="otp-input-item" maxlength="1" id="sixth" name="otp6" >
                    </div>
                    @if ($errors->any())
                    <p class="text-danger">Please provide valid OTP</p>
                    @endif
                    @if (session()->has('error'))
                        <p class="text-danger">{{ Session::get('error') }}</p>
                    @endif

                    <p>
                        Didn't get OTP.
                        <span class="px-1 text-primary" id="time"></span>
                        <a href=""class="text-info sent-agin-otp" >Send again</a>
                    </p>

                    <button class="form-control btn-1 p-3 text-white font-weight-bold mb-5 mt-5" type="submit" id="otp-btn">Confirm</button>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script>
      $(document).ready(function(){
        resentCounter()
      })

    //otp resent________________________________________
    $(document).on('click','.sent-agin-otp',function(e){
        e.preventDefault();
            $.ajax({
                method: 'GET',
                url: '/corporate-otp-agin/{{ Session::get('mobile') }}',
                processData: false,
                contentType: false,
                success: function(data) {
                    resentCounter();

                },
                error: function(xhr) {
                    var errorMessage = '<div class="card bg-danger">\n' +
                        '                        <div class="card-body text-center p-5">\n' +
                        '                            <span class="text-white">';
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        errorMessage += ('' + value + '<br>');
                    });
                    errorMessage += '</span>\n' +
                        '                        </div>\n' +
                        '                    </div>';
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        footer: errorMessage
                    })
                },
            });
    })
    //otp resent counter_______________________
    function resentCounter(){
        $('.sent-agin-otp').css('visibility','hidden')
        var counter = 60;
        var interval = setInterval(function() {
        counter--;
        if (counter <= 0) {
            clearInterval(interval);
            $('#time').text("");
            $('.sent-agin-otp').css('visibility','visible')
            return;
            }else{
                $('#time').text(counter);
            }
        }, 1000);
    }

    //otp input______________________________
    function movetoNext(current, nextFieldID) {
        if (current.value.length >= current.maxLength) {
            document.getElementById(nextFieldID).focus();
        }
    }

  </script>
    {{-- @include('Others.toaster_message') --}}

    @include('Frontend.layouts.foot')
  </body>
</html>
