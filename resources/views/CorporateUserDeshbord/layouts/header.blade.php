<div class="corporateHader">
    <header class="container">
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
          <img src="../../../assest/img/Varsa-lo.png" alt="" srcset="" />
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div
            class="collapse navbar-collapse justify-content-end"
            id="navbarNavAltMarkup"
          >
            <div class="navbar-nav">
              <a class="nav-link active ms-4" aria-current="page" href="{{ route('corporateUser.dashbord')  }}"
                ><strong>Home</strong></a
              >
              <a class="nav-link ms-4" href="{{ route('forntend.index') }}#services"
                ><strong>Service</strong></a
              >
              <a class="nav-link ms-4" href="#About-us"
                ><strong>Contact Us</strong></a
              >
              <a
                class="nav-link ms-4 px-2 py-2 corporateLoginNameColor"
                href="#Contact-us"
              >
                <div class="d-flex">

                  <strong>{{ Auth::user()->name }}</strong>
                  <img
                    class="img-fluid userLoginPhoto ms-2"
                    @if (isset(Auth::user()->image))
                        src="{{ asset(Auth::user()->image) }}"
                    @else
                        src="{{ asset('frontend_assets/img/person.jpg') }}"
                    @endif
                    alt=""
                  />
                </div>
              </a>
            </div>
          </div>
        </div>
      </nav>
    </header>
  </div>
