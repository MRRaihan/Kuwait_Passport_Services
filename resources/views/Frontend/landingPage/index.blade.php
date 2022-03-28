<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href=" {{ asset('assets/data-enterer/images/favicon.ico') }}">
    <!-- .....................bootstarap 5................................... -->
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/bootstrap.min.css') }}" />
    <!-- .....................font awesome................................... -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- .....................custom css................................... -->
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/style.css') }}" />
    <!-- .....................responsive css................................... -->
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/responsive.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <!-- .....................Owl carousel................................... -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />
    <title>{{ env('APP_NAME') }}</title>

</head>

<body>
    <!--============= Header Design start ==================-->
    <header class="sticky-top shadow">
        <nav class="navbar navbar-expand-lg navbar-light header-bar">
            <div class="container">
                <a class="navbar-brand" href="/"><img
                        src="{{ asset('frontend_assets/img/Versetailo-logo/Varsa-lo2.png') }}" class="img-fluid"
                        alt="" /></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse text-center" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0" id="link">
                        <li class="nav-item">
                            <a class="nav-link btn1 active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn1" href="#services">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn1" href="#pricing-plan">Pricing plan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn1" href="#passport"> Check Passport</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn1" href="#trusted-user">Testimonial</a>
                        </li>


                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle btn1" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                User Login
                            </a>
                            <ul class="dropdown-menu " aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('userLogin') }}">Normal User</a></li>
                                <li><a class="dropdown-item" href="{{ route('corporate.login') }}">Corporate User</a>
                                </li>



                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle btn1" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Administrator Login
                            </a>
                            <ul class="dropdown-menu " aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('accountManager.login') }}">Account
                                        Manager</a></li>
                                <li><a class="dropdown-item" href="{{ route('branchManager.login') }}">Branch
                                        Manager</a></li>


                                <li><a class="dropdown-item" href="{{ route('dataEntry.login') }}">Data Enterer</a>
                                </li>
                                <li><a class="dropdown-item" href="{{ route('callCenter.login') }}">Call center</a>
                                </li>
                                <li><a class="dropdown-item" href="{{ route('embassy.login') }}">Embassy</a></li>

                            </ul>
                        </li>


                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle btn1" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Language
                            </a>
                            <ul class="dropdown-menu text-center" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Arabic</a></li>
                                <li><a class="dropdown-item" href="#">English</a></li>


                                <li><a class="dropdown-item" href="#">Bangla</a></li>

                            </ul>

                        </li>

                        @if (isset(Auth::user()->id) && Auth::user()->user_type == 'normal-user')
                            <li class="nav-item">
                                <a class="nav-link btn1" href="{{ route('normalUser.dashbord') }}">Dashboard</a>
                            </li>
                        @endif
                        @if (isset(Auth::user()->id) && Auth::user()->user_type == 'corporate-user')
                            <li class="nav-item">
                                <a class="nav-link btn1" href="{{ route('corporateUser.dashbord') }}">Dashboard</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Header Design end -->

    <!-- Top banner design start -->
    <section id="home">
        <div class="container-fluid px-0 top-banner mt-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 d-flex justify-content-center align-items-center">
                        <div class="mt-2 header-content">
                            {!! get_static_option('banner_text') !!}
                            {{-- <h2>BE A HAPPY USER OF</h2>
                            <h2>HAPPY CENTRE</h2>
                            <p class="mt-3 text-justify">
                                Happy Centre is working on behalf of the Bangladesh Embassy in Kuwait to provide passport
                                and legalization services for the Bangladeshi workers in Kuwait. It Provides you with the
                                latest information and guidelines on the passport application procedures involved in
                                making the application for a Bangladeshi passport from Kuwait. Happy Centre is one of the
                                most established name in Kuwait. We provide easy to understand passport and visa overviews,
                                instructions and forms, as well as technology including real time order tracking,
                                on-line chat services, automated email updating, fully dynamic website feeding off the
                                most up-to-date requirement changes, and the highest levels of digital security
                                available. We have also running our Happy Centre Operation in Bahrain and Kuwait on
                                behalf of Bangladesh Embassy.
                            </p> --}}
                            <div class="checking pb-5">
                                <a href="{{ get_static_option('banner_btn_url') }}" class="btn header-btn my-3 text-light fw-bold px-3 py-2">
                                    {{ get_static_option('banner_btn_text') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <img src="{{ asset(get_static_option('banner_image')) }}" class="img-fluid"
                            alt="Banner-img" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Top banner design end -->

    <!-- project status start -->
    <section id="project-status">
        <div class="container">
            <div class="card shadow main-card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-sm-12 d-flex justify-content-center">
                            <div class="main-content d-flex p-3">
                                <img src="{{ asset('frontend_assets/img/Icons/Done1.png') }}" alt="" />
                                <div class="content mx-1">
                                    <p class="fw-bold status-number">12000</p>
                                    <p class="m-0 p-0 status-info">Projects done</p>
                                </div>
                                <div class="vl mx-5"></div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-12 d-flex justify-content-center">
                            <div class="main-content d-flex p-3">
                                <img src="{{ asset('frontend_assets/img/Icons/congratulation (2).png') }}" alt="" />
                                <div class="content mx-1">
                                    <p class="fw-bold status-number">97%</p>
                                    <p class="m-0 p-0 status-info">Satisfied Client</p>
                                </div>
                                <div class="vl mx-5"></div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-12 d-flex justify-content-center">
                            <div class="main-content d-flex p-3">
                                <img src="{{ asset('frontend_assets/img/Icons/Done1.png') }}" alt="" />
                                <div class="content mx-1">
                                    <p class="fw-bold status-number">5 Country</p>
                                    <p class="m-0 p-0 status-info">Project running</p>
                                </div>
                                <div class="vl mx-5"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- project status end -->

    <!--===== services status start =========-->
    @include('Frontend.landingPage.includes.our_services')
    <!--===== services status end =========-->
    <!--============ why choosing us section start========= -->
    @include('Frontend.landingPage.includes.choosing_us')
    <!--============ why choosing us section end========= -->
    <!--===================== pricing plan start============== -->
    @include('Frontend.landingPage.includes.pricing_plan')
    <!--===================== pricing plan end============== -->
    <!-- =================passport checking page start============ -->
    @include('Frontend.landingPage.includes.passport_checking')
    <!-- =================passport checking page end============ -->
    <!-- ================Trusted user section start here========== -->
    @include('Frontend.landingPage.includes.trusted_user')
    <!-- ================Trusted user section end here========== -->
    <!--================ footer start here====================== -->
    @include('Frontend.landingPage.includes.footer')
    <!--================ footer end here====================== -->
    @include('Frontend.landingPage.includes.foot')
</body>

</html>
