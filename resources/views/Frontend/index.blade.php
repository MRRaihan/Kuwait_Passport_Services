<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
    <title>Versatilo london</title>
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
    <section id="services">
        <div class="container wrapper">
            <h1 class="text-center fw-bold">Our Services</h1>
            <div class="d-flex justify-content-center">
                <div class="line my-2"></div>
            </div>

            <div class="row my-4">
                <div class="col-md-6 mt-4">
                    <a href="{{ route('service',0) }}">
                        <div class="card service-card mb-2 shadow">
                            <div class="card-body">
                                <div class="text-center">
                                    <img src="{{ asset('frontend_assets/img/Icons/new(3).png') }}"
                                        class="service-img my-2" alt="" />
                                    <h2 class="my-3 text-light">Renew Passport</h2>
                                    <p class="my-2 text-light text-justify">
                                        Individuals whose passports are expired or closed to the expiry date can get
                                        their passport renewal services through all our branches throughout Kuwait.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-6 mt-4">
                    <a href="{{ route('service',1) }}">
                        <div class="card service-card mb-2 shadow">
                            <div class="card-body">
                                <div class="text-center">
                                    <img src="{{ asset('frontend_assets/img/Icons/manual.png') }}"
                                        class="service-img my-2" alt="" />
                                    <h2 class="my-3 text-light">Manual Passport</h2>
                                    <p class="my-2 text-light text-justify">
                                        This service is mainly for individuals with urgent need of their passports whose
                                        expiry dates have been attained.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-6 mt-4">
                    <a href="{{ route('service',2) }}">
                        <div class="card service-card mb-2 shadow">
                            <div class="card-body">
                                <div class="text-center">
                                    <img src="{{ asset('frontend_assets/img/Icons/questions.png') }}"
                                        class="service-img my-2" alt="" />
                                    <h2 class="my-3 text-light">Lost Passport</h2>
                                    <p class="my-2 text-light text-justify">
                                        For those who have lost their passports and wish to get a new one, our happy
                                        centers can provide you with the necessary service to get issued with a new
                                        passport without you going to the embassy
                                        <br>
                                        <br>
                                        <br>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-6 mt-4">
                    <a href="{{ route('service',3) }}">
                        <div class="card service-card mb-2 shadow">
                            <div class="card-body">
                                <div class="text-center">
                                    <img src="{{ asset('frontend_assets/img/Icons/baby.png') }}"
                                        class="service-img my-2" alt="" />
                                    <h2 class="my-3 text-light">New Born Baby Passport</h2>
                                    <p class="my-2 text-light">
                                        For any queries employees have either with their employers such as no salary
                                        payment, or any abuse of their rights, our legal service and welfare department
                                        is available and ready to see into restoring the joy of the complaining
                                        employee. Also, individuals with cases including police or court that threatens
                                        their peaceful stay in the United Arab Emirates, can get solutions from our
                                        legal team.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>



                <div class="col-md-12 mt-4">
                    <a href="">
                        <div class="card service-card other-card w-50  mx-auto mb-2 shadow">
                            <div class="card-body">
                                <div class="text-center">
                                    <img src="{{ asset('frontend_assets/img/Icons/planet.png') }}"
                                        class="service-img my-2" alt="" />
                                    <h2 class="my-3 text-light">E-Passport</h2>
                                    <p class="my-2 text-light">
                                        Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                                        Atque, hic?Lorem, ipsum dolor sit amet consectetur
                                        adipisicing elit. Ducimus sapiente tempore ea et suscipit
                                        eius.
                                        Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                                        Atque, hic?Lorem, ipsum dolor sit amet consectetur
                                        adipisicing elit. Ducimus sapiente tempore ea et suscipit
                                        eius.
                                        Atque, hic?Lorem, ipsum dolor sit amet consectetur
                                        suscipitAtque, hic?
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>





        </div>
    </section>

    <!--===== services status end =========-->

    <!--============ why choosing us section start========= -->
    <section class="choosing-us">
        <div class="container my-3">
            <div class="row">
                <div class="col-md-6 d-flex justify-content-center align-items-center">
                    <div class="choose-content">
                        <h2 class="my-3 fw-bold">Why Choose Us?</h2>
                        <div class="line2"></div>
                        {!! get_static_option('why_chose_section') !!}
                        {{-- <ul class="b my-3">
                            <li>Salary and insurance related legal aid.</li>
                            <li>Jail, penalty related legal aid.</li>
                            <li>Immigration related legal aid.</li>
                            <li>Police and court related legal aid.</li>
                            <li>Any other visa and passport related legal aid.</li>
                        </ul> --}}
                    </div>
                </div>

                <div class="col-md-6">
                    <img src="{{ asset('frontend_assets/img/Banner/Feb-Business_9 [Converted].png') }}"
                        class="img-fluid" alt="" />
                </div>
            </div>
        </div>
    </section>
    <!--============ why choosing us section end========= -->

    <!--===================== pricing plan start============== -->
    <section id="pricing-plan">
        <div class="container-fluid px-0 wrapper pricing">
            <div class="container-fluid">
                <h2 class="text-center fw-bold">Checkout Pricing plan</h2>
                <div class="d-flex justify-content-center">
                    <div class="line3 my-2"></div>
                </div>

                <div class="my-3">
                <div class="container-fluid">
                    <div class="pricing_container">

                        @foreach ($pricingPlans as $key => $pricingPlan)
                        <div class="pricing-iteam col-lg-2">
                            <div class="card  mb-2 shadow">
                                <div class="card-body">
                                    <div class="text-center">
                                        <img src="{{ asset('frontend_assets/img/Icons/done.png') }}"
                                            class="service-img my-2" alt="" />
                                        <h5 class="my-3 status-info">Lost Passport</h5>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <ol class="card-bottom">
                                                {!! $pricingPlan->content_samary !!}
                                            <div id="dots{{ $key }}"></div>

                                            <div id="more{{ $key }}" class="more_text">
                                                {!! $pricingPlan->content_details !!}
                                            </div>
                                        </ol>
                                    </div>
                                    <div class="text-center">
                                        <button  id="myBtn{{ $key }}" loop_id="{{ $key }}"
                                            class="btn header-btn text-light px-4 py-2 fw-bold show_more">
                                            See More
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        {{-- <div class="col-md-4 col-lg-2">
                            <div class="card  mb-2 shadow">
                                <div class="card-body">
                                    <div class="text-center">
                                        <img src="{{ asset('frontend_assets/img/Icons/done.png') }}"
                                            class="service-img my-2" alt="" />
                                        <h5 class="my-3 status-info">Renew Passport</h5>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <ol class="card-bottom">
                                            <li>Name</li>
                                            <li>Emirates ID</li>
                                            <li>Passport Copy</li>
                                            <li>Mailing Address</li>
                                            <li>Kuwait Phone</li>

                                            <div id="dots2"></div>

                                            <div id="more2">
                                                <li>Name</li>
                                                <li>Emirates ID</li>
                                                <li>Passport Copy</li>
                                                <li>Mailing Address</li>
                                                <li>Kuwait Phone</li>
                                                <li>Bangladesh Permanet Address</li>
                                                <li>Bangladesh Phone Number</li>
                                                <li>Special Skill</li>
                                                <li>Residence with Family/ Spouse Emirates ID/ Phone no.</li>
                                                <li>Business and passport no. ted to Versatilo</li>
                                                <li>Versatilo renewal receive number</li>
                                                <li>Salary less than د.إ 250- Fee 2.5 د.إ</li>
                                                <li>Salary Greater than د.إ 250 Fee 2.5 د.إ</li>
                                            </div>
                                        </ol>
                                    </div>
                                    <div class="text-center">
                                        <button onclick="myFunction2()" id="myBtn2"
                                            class="btn header-btn text-light px-4 py-2 fw-bold">
                                            See More
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-2">
                            <div class="card  mb-2 shadow">
                                <div class="card-body">
                                    <div class="text-center">
                                        <img src="{{ asset('frontend_assets/img/Icons/done.png') }}"
                                            class="service-img my-2" alt="" />
                                        <h5 class="my-3 status-info">Manual Extension</h5>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <ol class="card-bottom">
                                            <li>Name</li>
                                            <li>Emirates ID</li>
                                            <li>Passport Copy</li>
                                            <li>Mailing Address</li>
                                            <li>Kuwait Phone</li>

                                            <div id="dots3"></div>

                                            <div id="more3">
                                                <li>Bangladesh Permanet Address</li>
                                                <li>Bangladesh Phone Number</li>
                                                <li>Special Skill</li>
                                                <li>Residence with Family/ Spouse Emirates ID/ Phone no.</li>
                                                <li>Business and passport no. ted to Versatilo</li>
                                                <li>Versatilo renewal receive number</li>
                                                <li>Salary less than د.إ 250- Fee 2.5 د.إ</li>
                                                <li>Salary Greater than د.إ 250 Fee 2.5 د.إ</li>
                                            </div>
                                        </ol>
                                    </div>
                                    <div class="text-center">
                                        <button onclick="myFunction3()" id="myBtn3"
                                            class="btn header-btn text-light px-4 py-2 fw-bold">
                                            See More
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-2">
                            <div class="card  mb-2 shadow">
                                <div class="card-body">
                                    <div class="text-center">
                                        <img src="{{ asset('frontend_assets/img/Icons/done.png') }}"
                                            class="service-img my-2" alt="" />
                                        <h5 class="my-3 status-info">E-passport</h5>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <ol class="card-bottom">
                                            <li>Name</li>
                                            <li>Emirates ID</li>
                                            <li>Passport Copy</li>
                                            <li>Mailing Address</li>
                                            <li>Kuwait Phone</li>
                                            <div id="dots4"></div>

                                            <div id="more4">
                                                <li>Bangladesh Permanet Address</li>
                                                <li>Bangladesh Phone Number</li>
                                                <li>Special Skill</li>
                                                <li>Residence with Family/ Spouse Emirates ID/ Phone no.</li>
                                                <li>Business and passport no. ted to Versatilo</li>
                                                <li>Versatilo renewal receive number</li>
                                                <li>Salary less than د.إ 250- Fee 2.5 د.إ</li>
                                                <li>Salary Greater than د.إ 250 Fee 2.5 د.إ</li>
                                            </div>
                                        </ol>
                                    </div>
                                    <div class="text-center">
                                        <button onclick="myFunction4()" id="myBtn4"
                                            class="btn header-btn text-light px-4 py-2 fw-bold">
                                            See More
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-2">
                            <div class="card  mb-2 shadow">
                                <div class="card-body">
                                    <div class="text-center">
                                        <img src="{{ asset('frontend_assets/img/Icons/done.png') }}"
                                            class="service-img my-2" alt="" />
                                        <h5 class="my-3 status-info">Newborn</h5>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <ol class="card-bottom">
                                            <li>Name</li>
                                            <li>Emirates ID</li>
                                            <li>Passport Copy</li>
                                            <li>Mailing Address</li>
                                            <li>Kuwait Phone</li>
                                            <div id="dots5"></div>

                                            <div id="more5">
                                                <li>Bangladesh Permanet Address</li>
                                                <li>Bangladesh Phone Number</li>
                                                <li>Special Skill</li>
                                                <li>Residence with Family/ Spouse Emirates ID/ Phone no.</li>
                                                <li>Business and passport no. ted to Versatilo</li>
                                                <li>Versatilo renewal receive number</li>
                                                <li>Salary less than د.إ 250- Fee 2.5 د.إ</li>
                                                <li>Salary Greater than د.إ 250 Fee 2.5 د.إ</li>
                                            </div>
                                        </ol>
                                    </div>
                                    <div class="text-center">
                                        <button onclick="myFunction5()" id="myBtn5"
                                            class="btn header-btn text-light px-4 py-2 fw-bold">
                                            See More
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-2">
                            <div class="card  mb-2 shadow">
                                <div class="card-body">
                                    <div class="text-center">
                                        <img src="{{ asset('frontend_assets/img/Icons/done.png') }}"
                                            class="service-img my-2" alt="" />
                                        <h5 class="my-3 status-info">Newborn</h5>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <ol class="card-bottom">
                                            <li>Name</li>
                                            <li>Emirates ID</li>
                                            <li>Passport Copy</li>
                                            <li>Mailing Address</li>
                                            <li>Kuwait Phone</li>
                                            <div id="dots5"></div>

                                            <div id="more5">
                                                <li>Bangladesh Permanet Address</li>
                                                <li>Bangladesh Phone Number</li>
                                                <li>Special Skill</li>
                                                <li>Residence with Family/ Spouse Emirates ID/ Phone no.</li>
                                                <li>Business and passport no. ted to Versatilo</li>
                                                <li>Versatilo renewal receive number</li>
                                                <li>Salary less than د.إ 250- Fee 2.5 د.إ</li>
                                                <li>Salary Greater than د.إ 250 Fee 2.5 د.إ</li>
                                            </div>
                                        </ol>
                                    </div>
                                    <div class="text-center">
                                        <button onclick="myFunction5()" id="myBtn5"
                                            class="btn header-btn text-light px-4 py-2 fw-bold">
                                            See More
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                    </div>
                </div>



                </div>
            </div>
        </div>
    </section>

    <!--===================== pricing plan end============== -->

    <!-- =================passport checking page start============ -->
    <section id="passport">
        <div class="container wrapper">
            <div class="row">
                <div class="col-md-5 col-sm-12">
                    <div class="passport-content my-5">
                        <div class="d-flex justify-content-center">
                            <div class="passport-head">
                                <h3 class="fw-bold check text-center">Check Your Passport</h3>
                                <div class="line3 my-2"></div>
                            </div>
                        </div>
                    </div>

                    <div class="card my-5 passport-card shadow">
                        <div class="card-body">
                            <!-- <form action="#"> -->
                            <form action="" method="get">

                                <div class="my-4">
                                    <input type="text" name="emirates_id" id="emirates_id" class="form-control"
                                        placeholder="Emirates ID" />
                                </div>
                                <div class="mb-4">
                                    <input type="text" name="kuwait_phone" id="kuwait_phone" class="form-control"
                                        placeholder="Kuwait Phone" />
                                </div>

                                <div class="mb-4">
                                    <select class="form-select form-select-md mb-3 text-muted" id="passport_type"
                                        name="passport_type" aria-label=".form-select-lg example ">
                                        <option value="">Passport type</option>
                                        @foreach (passportOptionsUsers() as $key => $passport)
                                            <option value="{{ $key }}">{{ $passport }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="text-center">



                                    <button class="btn passport-btn px-5 py-2 fw-bold shadow" id="checkPassportStatus">
                                        Check
                                    </button>
                            </form>

                            <!-- Modal start-->
                            {{-- <div class="modal fade" id="exampleModal" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered  modal-lg ">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title w-100 text-center " id="exampleModalLabel">Passport
                                                Status</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container1">
                                                <section class="step-indicator  my-5">
                                                    <div class="step step1 ">
                                                        <div class="step-icon"><i class="fas fa-desktop"></i>
                                                        </div>
                                                        <p>Pending</p>
                                                    </div>
                                                    <div class="indicator-line "></div>
                                                    <div class="step step2">
                                                        <div class="step-icon"><i class="fas fa-recycle"></i>
                                                        </div>
                                                        <p>Processing</p>
                                                    </div>
                                                    <div class="indicator-line"></div>
                                                    <div class="step step3">
                                                        <div class="step-icon"><i class="fas fa-dolly"></i>
                                                        </div>
                                                        <p>Ready to Delivered</p>
                                                    </div>
                                                    <div class="indicator-line"></div>
                                                    <div class="step step3">
                                                        <div class="step-icon"><i class="fas fa-check"></i>
                                                        </div>
                                                        <p>Delivered</p>
                                                    </div>
                                                </section>
                                            </div>




                                            <div class="mt-5">
                                                <!-- accordion work start -->
                                                <div class="accordion" id="accordionPanelsStayOpenExample">

                                                    <div class="accordion-item">
                                                        <div id="panelsStayOpen-collapseTwo"
                                                            class="accordion-collapse collapse"
                                                            aria-labelledby="panelsStayOpen-headingTwo">
                                                            <div class="accordion-body">
                                                                <div
                                                                    class="d-flex justify-content-center align-items-center">
                                                                    <div class="my-3">
                                                                        <div class="d-flex">
                                                                            <p class="fw-bold">Service:</p>
                                                                            <p class="mx-2">Renew Passport
                                                                            </p>
                                                                        </div>
                                                                        <div class="d-flex">
                                                                            <p class="fw-bold">Branch:</p>
                                                                            <p class="mx-2">Kuwait</p>
                                                                        </div>
                                                                        <div class="d-flex">
                                                                            <p class="fw-bold">Passport no:</p>
                                                                            <p class="mx-2">BQ07809</p>
                                                                        </div>
                                                                        <div class="d-flex">
                                                                            <p class="fw-bold">Passport Holder
                                                                                Name:</p>
                                                                            <p class="mx-2">Mr. Raihan</p>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#panelsStayOpen-collapseTwo"
                                                                aria-expanded="false"
                                                                aria-controls="panelsStayOpen-collapseTwo">

                                                            </button>
                                                        </h2>

                                                    </div>

                                                </div>
                                                <!-- accordion work end -->
                                            </div>



                                        </div>
                                        <!-- <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                      </div> -->
                                    </div>
                                </div>
                            </div> --}}





                            <div class="modal fade" id="modal">
                                <div class="modal-dialog modal-lg" id="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title w-100 text-center " id="modal-title"></h5>
                                            <button type="button" class="close"
                                                data-bs-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body" id="modal-body">

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" id="modalClose" class="btn btn-danger"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal end-->

                        </div>
                        <!-- </form> -->
                    </div>
                </div>
            </div>
            <div class="col-md-7 col-sm-12">
                <img src="{{ asset('frontend_assets/img/Banner/Mask Group 3.png') }}" class="img-fluid mx-3"
                    width="83%" alt="" />
            </div>
        </div>
        </div>
    </section>

    <!-- =================passport checking page end============ -->

    <!-- ================Trusted user section start here========== -->
    <section id="trusted-user" class="pricing">
        <div class="container wrapper">
            <div class="text-center">
                <h1 class="fw-bold">Trused by</h1>
                <h1 class="fw-bold">Thousand of Happy Users</h1>
                <div class="d-flex justify-content-center">
                    <div class="line4 my-2"></div>
                </div>
            </div>

            <div class="owl-start my-5">
                <div class="owl-carousel owl-theme">
                    <div class="item">
                        <div class="card owl-card">
                            <div class="card-body">
                                <div class="text-center d-flex justify-content-center">
                                    <div class="person-img p-2">
                                        <img src="{{ asset('frontend_assets/img/person.jpg') }}"
                                            class="img-fluid" alt="" />
                                    </div>
                                </div>
                                <div class="text-center my-4">
                                    <h4 class="text-light">Al Amin</h4>
                                    <p class="my-3 text-light">
                                        They were very hepful and responsive over the phone and
                                        email. I will recommend this to anyone i know. Best
                                        service.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="item">
                        <div class="card owl-card">
                            <div class="card-body">
                                <div class="text-center d-flex justify-content-center">
                                    <div class="person-img p-2">
                                        <img src="{{ asset('frontend_assets/img/person.jpg') }}"
                                            class="img-fluid" alt="" />
                                    </div>
                                </div>
                                <div class="text-center my-4">
                                    <h4 class="text-light">Mizanur Rahman Raihan</h4>
                                    <p class="my-3 text-light">
                                        They were very hepful and responsive over the phone and
                                        email. I will recommend this to anyone i know. Best
                                        service.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="card owl-card">
                            <div class="card-body">
                                <div class="text-center d-flex justify-content-center">
                                    <div class="person-img p-2">
                                        <img src="{{ asset('frontend_assets/img/person.jpg') }}"
                                            class="img-fluid" alt="" />
                                    </div>
                                </div>
                                <div class="text-center my-4">
                                    <h4 class="text-light">Imdadul</h4>
                                    <p class="my-3 text-light">
                                        They were very hepful and responsive over the phone and
                                        email. I will recommend this to anyone i know. Best
                                        service.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="item">
                        <div class="card owl-card">
                            <div class="card-body">
                                <div class="text-center d-flex justify-content-center">
                                    <div class="person-img p-2">
                                        <img src="{{ asset('frontend_assets/img/person.jpg') }}"
                                            class="img-fluid" alt="" />
                                    </div>
                                </div>
                                <div class="text-center my-4">
                                    <h4 class="text-light">Rayhan kabir</h4>
                                    <p class="my-3 text-light">
                                        They were very hepful and responsive over the phone and
                                        email. I will recommend this to anyone i know. Best
                                        service.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="item">
                        <div class="card owl-card">
                            <div class="card-body">
                                <div class="text-center d-flex justify-content-center">
                                    <div class="person-img p-2">
                                        <img src="{{ asset('frontend_assets/img/person.jpg') }}"
                                            class="img-fluid" alt="" />
                                    </div>
                                </div>
                                <div class="text-center my-4">
                                    <h4 class="text-light">Rayhan kabir</h4>
                                    <p class="my-3 text-light">
                                        They were very hepful and responsive over the phone and
                                        email. I will recommend this to anyone i know. Best
                                        service.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ================Trusted user section end here========== -->

    <!--================ footer start here====================== -->
    <footer id="footer">
        <div class="footer py-5">
            <div class="container">
                <h2 class="text-light fw-bold footer-text">Versatilo London</h2>

                <div class="row my-4">
                    <div class="col-md-3 col-sm-6 footer-text">
                        <div class="p-2">
                            <h5 class="text-light">Solutions</h5>
                            <ul class="footer-list">
                                <li><a href="#">Lost passport</a></li>
                                <li><a href="#">Renew passport</a></li>
                                <li><a href="#">Manual extension</a></li>
                                <li><a href="#">E-Passport</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 footer-text">
                        <div class="p-2">
                            <h5 class="text-light">Company</h5>
                            <ul class="footer-list">
                                <li><a href="#">About us</a></li>
                                <li><a href="#">Career</a></li>
                                <li><a href="#">News room</a></li>
                                <li><a href="#">Contact us</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 footer-text">
                        <div class="p-2">
                            <h5 class="text-light">Office</h5>
                            <ul class="footer-list">
                                <li><a href="#">UAE</a></li>
                                <li><a href="#">Bahrain</a></li>
                                <li><a href="#">Kuwait</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="card footer-card my-2 shadow">
                            <div
                                class="
                    card-body
                    d-flex
                    justify-content-center
                    align-items-center
                  ">
                                <ul class="footer-list">
                                    <li>
                                        <i class="fas fa-phone mx-1 icon-circle"></i> {{ get_static_option('footer_phone') }}
                                    </li>
                                    <li>
                                        <i class="fas fa-envelope mx-1"></i> {{ get_static_option('footer_email') }}
                                    </li>
                                    <li>
                                        <i class="fas fa-location-arrow mx-1"></i> {!! get_static_option('footer_address') !!}
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="buttons text-center text-light my-3">
                            <a href="#"> <i class="fab fa-facebook-square fa-2x mx-3"></i></a>
                            <a href="#"> <i class="fab fa-instagram fa-2x mx-3"></i></a>
                            <a href="#"> <i class="fab fa-linkedin fa-2x mx-3"></i></a>
                            <a href="#"> <i class="fab fa-twitter-square fa-2x mx-3"></i></a>
                        </div>
                    </div>
                </div>
                <div class="text-light text-center my-1">
                    &copy;
                    <span id="copyright">
                        <script>
                            document
                                .getElementById("copyright")
                                .appendChild(
                                    document.createTextNode(new Date().getFullYear())
                                );
                        </script>
                    </span>
                    TFP Solutions Bangladesh Ltd.
                </div>
            </div>
        </div>
    </footer>

    <!--================ footer start here====================== -->

    <!------------------------------- javascript files ------------------------------------------>
    <script type="text/javascript" src="{{ asset('frontend_assets/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend_assets/js/popper.min.js') }}"></script>

    <!-- latest jquery file -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>



    <script type="text/javascript">
        (function($) {
            "use strict";
            $(".owl-carousel").owlCarousel({
                loop: true,
                margin: 20,
                nav: false,
                dots: true,
                responsive: {
                    0: {
                        items: 1,
                    },
                    600: {
                        items: 3,
                    },
                    1000: {
                        items: 3,
                    },
                },
            });
        })(jQuery);
    </script>
    <script type="text/javascript" src="{{ asset('frontend_assets/js/main.js') }}"></script>

    <script>
        // function Show(title, link, style = '') {
        //     var emirates_id = $('#emirates_id').val();
        //     var kuwait_phone = $('#kuwait_phone').val();
        //     var passport_type = $('#passport_type').val();
        //     // alert();
        //     $('#modal').modal('show');
        //     $('#modal-title').html(title);
        //     $('#modal-body').html('<h1 class="text-center"><strong>Please Wait...</strong></h1>');
        //     $('#modal-dialog').attr('style', style);
        //     $.ajax({
        //             url: link+'/'+emirates_id+'&'+kuwait_phone+'&'+passport_type,
        //             type: 'GET',
        //             data: {},
        //         })
        //         .done(function(response) {
        //             $('#modal-body').html(response);
        //         });
        // }

        $('#checkPassportStatus').click(function (e) {
          e.preventDefault();
            var emirates_id = $('#emirates_id').val();
            var kuwait_phone = $('#kuwait_phone').val();
            var passport_type = $('#passport_type').val();
            // alert();

            var link = '{{ url('check-passport-status') }}';
            console.log(emirates_id,kuwait_phone);
            $('#modal').modal('show');
            $('#modal-title').html('Passport Status');
            $('#modal-body').html('<h1 class="text-center"><strong>Please Wait...</strong></h1>');
            // $('#modal-dialog').attr('style', style);
            $.ajax({
                    url: link+'/'+emirates_id+'&'+kuwait_phone+'&'+passport_type,
                    type: 'GET',
                    data: {},
                })
                .done(function(response) {
                    $('#modal-body').html(response);
                });
        });
    </script>
</body>

</html>
