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

  <link rel="stylesheet" href="{{ asset('frontend_assets/css/UserDashboard.css') }}" />

  <!--------------------- responsive css---------------------------- -->
  <link rel="stylesheet" href="../assest/css/responsive.css" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <title>User Form</title>
</head>

<body>
    @include('NormalUserDeshbord.layouts.header')
    <div class="container-fluid my-5">
      <div class="row">

        @yield('passport_service')

      </div>
    </div>

    <!-- progressbar -->


  <!------------------------------- javascript and jquery files ------------------------------------------>

  <script type="text/javascript" src="../assest/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="../assest/js/popper.min.js"></script>
      <!------------------------------- javascript files ------------------------------------------>
<script type="text/javascript" src="{{ asset('frontend_assets/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend_assets/js/popper.min.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@include('sweetalert::alert')
</body>

</html>
