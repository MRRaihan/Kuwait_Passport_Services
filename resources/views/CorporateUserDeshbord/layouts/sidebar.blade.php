<div class="col-md-3 corporateSidebar mt-3 shadow">
    <div class=" py-4">
      <section class="d-flex justify-content-center text-center">
        <div>
          <img
            class="userDashImg img-fluid"
            @if (isset(Auth::user()->image))
                src="{{ asset(Auth::user()->image) }}"
            @else
                src="{{ asset('frontend_assets/img/person.jpg') }}"
            @endif
            alt=""
            width="120px"
          />
          <a href="{{ route('corporateUser.dashbord') }}"><h5 class="userNameColor text-center py-3">{{ Auth::user()->name }}</h5></a>
        </div>
      </section>
      <section class="user-sidebar">
        <div class="d-flex justify-content-center">
          <div>
                <!---deshbord--->
                <div>
                  <a href="{{ route('corporateUser.dashbord') }}">
                      <button class="btn-lightWhite my-1 p-2 {{\Illuminate\Support\Facades\Request::is('corporate/dashboard/index') ? 'user-sidebar-active': ''}}">
                      <i class="fas fa-dashboard mx-2"></i>Dashboard
                      </button>
                  </a>
                  </div>

                <div class="py-1"></div>

                <div class="accordion custome_accordion" id="accordionExample3">
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                      <button class="accordion-button  deshbord_btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      <i class="fas fa-columns mx-2"></i>Passport Status
                      </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse {{\Illuminate\Support\Facades\Request::is('corporate/service-*') ? 'show': ''}}" aria-labelledby="headingThree" data-bs-parent="#accordionExample3">
                      <div class="accordion-body custom_accordion_body">
                          <ul class="desbord-item-container">
                              <li class="">
                                  <a class="dropdown-item {{\Illuminate\Support\Facades\Request::is('corporate/service-pending') ? 'user-sidebar-active': ''}}" href="{{ route('corporateUser.service.pending') }}">Pending</a>
                              </li>
                              <li class="">
                                <a class="dropdown-item {{\Illuminate\Support\Facades\Request::is('corporate/service-reviewed') ? 'user-sidebar-active': ''}}" href="{{ route('corporateUser.service.reviewed') }}">Reviewed</a>
                              </li>
                              <li class="">
                                <a class="dropdown-item {{\Illuminate\Support\Facades\Request::is('corporate/service-completed') ? 'user-sidebar-active': ''}}" href="{{ route('corporateUser.service.completed') }}">Completed</a>
                              </li>
                            </ul>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="py-1"></div>
                <!---services--->
                <div class="accordion custome_accordion" id="accordionExample">

                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button  deshbord_btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsethree" aria-expanded="false" aria-controls="collapseTwo">
                        <i class="fas fa-id-card mx-2"></i>Services
                        </button>
                      </h2>
                      <div id="collapsethree" class="accordion-collapse collapse {{\Illuminate\Support\Facades\Request::is('corporate/services/*') ? 'show': ''}}" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body custom_accordion_body">
                            <ul class="desbord-item-container">
                                <li class="">
                                    <a class="dropdown-item" href="{{ route('corporateUser.service.index',0) }}">Renew Passport</a>
                                </li>
                                <li class="">
                                  <a class="dropdown-item" href="{{ route('corporateUser.service.index',1) }}">Manual Passport</a>
                                </li>
                                <li class="">
                                  <a class="dropdown-item" href="{{ route('corporateUser.service.index',2) }}">Lost Passport</a>
                                </li>
                                <li class="">
                                  <a class="dropdown-item" href="{{ route('corporateUser.service.index',3) }}">Baby Passport</a>
                                </li>
                              </ul>
                        </div>
                      </div>
                    </div>

                </div>
                <div class="py-1"></div>
                <div>
                <a href="{{ route('corporateUser.service.paymentList') }}">
                    <button class="btn-lightWhite my-1 p-2 {{\Illuminate\Support\Facades\Request::is('corporate/services-payment-list') ? 'user-sidebar-active': ''}}">
                    <i class="fas fa-dollar-sign mx-2"></i>Payment
                    </button>
                </a>
                </div>
                <div>
                    <a href="{{ route('corporateUser.profile.update') }}">
                        <button class="btn-lightWhite my-1 p-2 {{\Illuminate\Support\Facades\Request::is('corporate/profile-update') ? 'user-sidebar-active': ''}}">
                        <i class="far fa-address-card mx-2"></i>Profile
                        </button>
                    </a>
                </div>
                <div>
                <a href="{{ route('corporateUser.security.view') }}">
                <button class="btn-lightWhite my-1 p-2 {{\Illuminate\Support\Facades\Request::is('corporate/profile-security') ? 'user-sidebar-active': ''}}">
                    <i class="fas fa-cog mx-2"></i>Security
                </button>
                </a>
                </div>
                <div>
                <button class="btn-lightWhite my-1 p-2 logout-btn">
                    <i class="fas fa-sign-out-alt mx-2 "></i>Logout
                </button>
                </div>
          </div>
        </div>
      </section>
      <footer class="footerClass d-flex justify-content-center">
        <p class="text-center">
          © Versatilo London W.L.L (Kuwait) {{ date('Y') }}
        </p>
      </footer>
    </div>


    </div>
