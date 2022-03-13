@if (isset($passport))

<style>
    .line-color{
        background: #15b3ee;
    }

</style>
<div class="container1">
    <section class="step-indicator   my-5  " >
        <div class="step step1 " >
            <div class="{{ $passport->status > 0 ? 'active-step-icon' : 'step-icon' }}"><i class="fas fa-desktop"  style="background-color: #01010 !important;"></i>
            </div>
            <p>Pending</p>
        </div>
        <div class="indicator-line {{ $passport->status > 0 ? 'line-color' : '' }}"></div>
        <div class="step step2">
            <div class="{{ $passport->status == 1 ? 'active-step-icon' : 'step-icon' }}"><i class="fas fa-recycle"></i>
            </div>
            <p>Processing</p>
        </div>
        <div class="indicator-line {{ $passport->branch_status == 3 ? 'line-color' : '' }}"></div>
        <div class="step step3">
            <div class="{{ $passport->branch_status == 3 ? 'active-step-icon' : 'step-icon' }}"><i class="fas fa-dolly"></i>
            </div>
            <p>Ready to Delivered</p>
        </div>
        <div class="indicator-line {{ $passport->branch_status == 3 ? 'line-color' : '' }}"></div>
        <div class="step step3">
            <div class="{{ $passport->branch_status == 3 ? 'active-step-icon' : 'step-icon' }}"><i class="fas fa-check"></i>
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
                                <p class="mx-2">{{ $passport->model_name }}
                                </p>
                            </div>
                            <div class="d-flex">
                                <p class="fw-bold">Branch:</p>
                                <p class="mx-2">{{ $passport->branch ? $passport->branch->name : '' }}</p>
                            </div>
                            <div class="d-flex">
                                <p class="fw-bold">Passport no:</p>
                                <p class="mx-2">{{ $passport->passport_number }}</p>
                            </div>
                            <div class="d-flex">
                                <p class="fw-bold">Passport Holder
                                    Name:</p>
                                <p class="mx-2">{{ $passport->name }}</p>
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
@else
<div class="row">
    <div class="col-md-12">
        <img src="{{ asset('frontend_assets/img/pngwing.com.png') }}" height="300px;" alt="">
    </div>
</div>
<h1 class="text-danger">{{ $message }}</h1>
{{-- <h1>{{ $kuwait_phone }}</h1>
<h1>{{ $civil_id }}</h1>
<h1>{{ $passport_type }}</h1> --}}
@endif
