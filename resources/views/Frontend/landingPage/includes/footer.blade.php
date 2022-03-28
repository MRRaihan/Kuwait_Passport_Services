<footer id="footer">
    <div class="footer py-5">
        <div class="container">
            <h2 class="text-light fw-bold footer-text">{{ env('APP_NAME') }}</h2>

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
                        <h5 class="text-light">About us</h5>
                        <ul class="footer-list">
                            <li><a href="{{ url('/#services') }}">Services</a></li>
                            <li><a href="{{ url('/#pricing-plan') }}">Pricing Plan</a></li>
                            <li><a href="{{ url('/#passport') }}">Check Passport</a></li>
                            <li><a href="{{ url('/#trusted-user') }}">Testimonial</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 footer-text">
                    <div class="p-2">
                        <h5 class="text-light">Office</h5>
                        <ul class="footer-list">
                            <li><a target="_blank" href="{{ get_static_option('uae_office_link') }}">UAE</a></li>
                            <li><a target="_blank" href="{{ get_static_option('kuwait_office_link') }}">Bahrain</a></li>
                            <li><a target="_blank" href="{{ get_static_option('bahrain_office_link') }}">Kuwait</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="card footer-card my-2 shadow">
                        <div class=" card-body d-flex justify-content-center align-items-center ">
                            <ul class="footer-list">
                                <li>
                                    <i class="fas fa-phone mx-1 icon-circle"></i>
                                    {{ get_static_option('footer_phone') }}
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
                        <a target="_blank" href="{{ get_static_option('facebook_link') }}"> <i class="fab fa-facebook-square fa-2x mx-3"></i></a>
                        <a target="_blank" href="{{ get_static_option('instagram_link') }}"> <i class="fab fa-instagram fa-2x mx-3"></i></a>
                        <a target="_blank" href="{{ get_static_option('linkedin_link') }}"> <i class="fab fa-linkedin fa-2x mx-3"></i></a>
                        <a target="_blank" href="{{ get_static_option('twitter_link') }}"> <i class="fab fa-twitter-square fa-2x mx-3"></i></a>
                    </div>
                </div>
            </div>
            <div class="text-light text-center my-1">
                Copyright &copy;
                <span id="copyright">
                    <script>
                        document
                            .getElementById("copyright")
                            .appendChild(
                                document.createTextNode(new Date().getFullYear())
                            );
                    </script>
                </span>
                <a target="_blank"
                    href="{{ route('forntend.index') }}">{{ env('APP_NAME', 'Kuwait Passport Service') }}</a> | All
                Rights Reserved.Developed by <a target="_blank" href="https://www.tfpbd.com/">TFP Solutions Bangladesh
                    Ltd.</a>
            </div>
        </div>
    </div>
</footer>
