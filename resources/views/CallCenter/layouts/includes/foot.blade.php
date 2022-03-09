<!-- Start JS -->
<script src="{{ asset('assets/call-center/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/call-center/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/call-center/js/modernizr.min.js') }}"></script>
<script src="{{ asset('assets/call-center/js/detect.js') }}"></script>
<script src="{{ asset('assets/call-center/js/fastclick.js') }}"></script>
<script src="{{ asset('assets/call-center/js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('assets/call-center/js/jquery.blockUI.js') }}"></script>
<script src="{{ asset('assets/call-center/js/waves.js') }}"></script>
<script src="{{ asset('assets/call-center/js/wow.min.js') }}"></script>
<script src="{{ asset('assets/call-center/js/jquery.nicescroll.js') }}"></script>
<script src="{{ asset('assets/call-center/js/jquery.scrollTo.min.js') }}"></script>

<script src="{{ asset('assets/call-center/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
{{-- <script src="{{ asset('assets/call-center/pages/dashborad.js') }}"></script> --}}


<!-- End JS -->

<script src="{{ asset('assets/helper.js') }}" type="text/javascript"></script>


<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@include('sweetalert::alert')
{{-- @include('Others.sweetalert-js'); --}}

@stack('datatableJS')

<script src="{{ asset('assets/call-center/js/app.js') }}"></script>

@stack('script')


