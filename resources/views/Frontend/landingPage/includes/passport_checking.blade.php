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
                                <input type="text" name="civil_id" id="civil_id" class="form-control"
                                    placeholder="Civil ID" />
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
