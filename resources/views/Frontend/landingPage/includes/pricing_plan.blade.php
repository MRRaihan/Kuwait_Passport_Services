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
                                        <h5 class="my-3 status-info">{{ $pricingPlan->title }}</h5>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
