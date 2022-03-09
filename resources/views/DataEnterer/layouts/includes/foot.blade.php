<!-- Start JS -->
<script src="{{ asset('assets/data-enterer/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/data-enterer/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/data-enterer/js/modernizr.min.js') }}"></script>
<script src="{{ asset('assets/data-enterer/js/detect.js') }}"></script>
<script src="{{ asset('assets/data-enterer/js/fastclick.js') }}"></script>
<script src="{{ asset('assets/data-enterer/js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('assets/data-enterer/js/jquery.blockUI.js') }}"></script>
<script src="{{ asset('assets/data-enterer/js/waves.js') }}"></script>
<script src="{{ asset('assets/data-enterer/js/wow.min.js') }}"></script>
<script src="{{ asset('assets/data-enterer/js/jquery.nicescroll.js') }}"></script>
<script src="{{ asset('assets/data-enterer/js/jquery.scrollTo.min.js') }}"></script>

<script src="{{ asset('assets/data-enterer/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
{{-- <script src="{{ asset('assets/data-enterer/pages/dashborad.js') }}"></script> --}}


<!-- End JS -->

<script src="{{ asset('assets/helper.js') }}" type="text/javascript"></script>


<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@include('sweetalert::alert')
{{-- @include('Others.sweetalert-js'); --}}

@stack('datatableJS')

<script src="{{ asset('assets/data-enterer/js/app.js') }}"></script>

@stack('script')


