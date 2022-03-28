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
                                    {{ get_static_option('renew_passport_service_details') }}
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
                                    {{ get_static_option('manual_passport_service_details') }}
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
                                    {{ get_static_option('lost_passport_service_details') }}
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
                                    {{ get_static_option('new_born_passport_service_details') }}
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
                                    {{ get_static_option('e_passport_service_details') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
