<!DOCTYPE html>
<html lang="en">
    @include('CorporateUserDeshbord.layouts.head')
  <body>
    <!-- Nav Design Part -->
    @include('CorporateUserDeshbord.layouts.header')

    <!-- User Main Dashboard -->
    <div class="container dashboardContainer">
      <div class="row py-3">

        @include('CorporateUserDeshbord.layouts.sidebar')

        @section('body')

        @show


      </div>
    </div>

     @include('Others.modal')
      <!-- Modal -->
        <div class="modal fade text-center" id="logout-user" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

              <div class="modal-body logout-modal">
                  <img src="/assest/img/New folder/consgratuation.png" width="50%" alt="">
                  <h5 class="info-title pb-3">Are you sure to Log out!</h5>
                  <div class="">
                    <button id="save-password" class="btn password-btn text-white py-2 px-5 d-inline m-1">Cancel</button>
                    <button id="save-password" class="btn border-dark py-2 px-5 d-inline m-1">Log out</button>

                  </div>
              </div>

            </div>
          </div>
        </div>
       

        @if(Auth::check())
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @endif

      <script>
        $('#user-logout').click(function(){
          $('#logout-user').modal('show')
        })
      </script>
    <!------------------------------- javascript files ------------------------------------------>
    <script src="{{ asset('assets/helper.js') }}" type="text/javascript"></script>


    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    @include('sweetalert::alert')

    <script type="text/javascript" src="{{ asset('frontend_assets/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend_assets/js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend_assets/js/main.js') }}"></script>
   
  </body>
</html>
