<!-- Start JS -->
<script src="{{ asset('assets/branch-manager/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/branch-manager/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/branch-manager/js/modernizr.min.js') }}"></script>
<script src="{{ asset('assets/branch-manager/js/detect.js') }}"></script>
<script src="{{ asset('assets/branch-manager/js/fastclick.js') }}"></script>
<script src="{{ asset('assets/branch-manager/js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('assets/branch-manager/js/jquery.blockUI.js') }}"></script>
<script src="{{ asset('assets/branch-manager/js/waves.js') }}"></script>
<script src="{{ asset('assets/branch-manager/js/wow.min.js') }}"></script>
<script src="{{ asset('assets/branch-manager/js/jquery.nicescroll.js') }}"></script>
<script src="{{ asset('assets/branch-manager/js/jquery.scrollTo.min.js') }}"></script>

<script src="{{ asset('assets/branch-manager/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
{{-- <script src="{{ asset('assets/branch-manager/pages/dashborad.js') }}"></script> --}}


<!-- End JS -->

<script src="{{ asset('assets/helper.js') }}" type="text/javascript"></script>


<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@include('sweetalert::alert')
{{-- @include('Others.sweetalert-js'); --}}

@stack('datatableJS')

<script src="{{ asset('assets/branch-manager/js/app.js') }}"></script>

@stack('script')


