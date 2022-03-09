<!-- Start JS -->
<script src="{{ asset('assets/embassy/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/embassy/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/embassy/js/modernizr.min.js') }}"></script>
<script src="{{ asset('assets/embassy/js/detect.js') }}"></script>
<script src="{{ asset('assets/embassy/js/fastclick.js') }}"></script>
<script src="{{ asset('assets/embassy/js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('assets/embassy/js/jquery.blockUI.js') }}"></script>
<script src="{{ asset('assets/embassy/js/waves.js') }}"></script>
<script src="{{ asset('assets/embassy/js/wow.min.js') }}"></script>
<script src="{{ asset('assets/embassy/js/jquery.nicescroll.js') }}"></script>
<script src="{{ asset('assets/embassy/js/jquery.scrollTo.min.js') }}"></script>

<script src="{{ asset('assets/embassy/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
{{-- <script src="{{ asset('assets/embassy/pages/dashborad.js') }}"></script> --}}


<!-- End JS -->

<script src="{{ asset('assets/helper.js') }}" type="text/javascript"></script>


<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@include('sweetalert::alert')
{{-- @include('Others.sweetalert-js'); --}}

@stack('datatableJS')

<script src="{{ asset('assets/embassy/js/app.js') }}"></script>

@stack('script')


