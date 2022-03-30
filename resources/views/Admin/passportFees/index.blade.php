@extends('Admin.layouts.master')

@push('title')
    Passport Fees
@endpush
@push('datatableCSS')
    <!-- DataTables -->
    <link href="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/admin/plugins/datatables/buttons.bootstrap.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/admin/plugins/datatables/fixedHeader.bootstrap.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/admin/plugins/datatables/responsive.bootstrap.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/admin/plugins/datatables/scroller.bootstrap.min.css') }}" rel="stylesheet"
        type="text/css" />
@endpush
@section('content')

    <style>
        td,
        th {
            text-align: center;
        }

        .input-fild-group {
            display: flex;
            gap: 10px;
        }

        .panel-body {
            height: 400px;
            overflow-y: scroll;
            padding-bottom: 15px;
        }
    </style>

    <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-header-title">
                        <h4 class="pull-left page-title">Passport Fees List</h4>
                        <ol class="breadcrumb pull-right">
                            <li><a href="{{ route('admin.dashboard') }}">Admin Panel</a></li>
                            <li class="active">Passports Fees</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>



            <div class="row mt-5">

                <div class="col-lg-6">
                    <form id="lostPasportForm" action="{{ route('admin.passportFee.store') }}" method="POST">
                        @include('Others.message')
                        @csrf
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title text-white">Lost Passports</h3>

                            </div>
                            <div class="panel-body">

                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#SL</th>
                                            <th>Title</th>
                                            <th>Govt. Fee</th>
                                            <th>Versatilo Fee</th>
                                        </tr>
                                    </thead>
                                    <tbody id="lost_passports">
                                        @if (isset($lostPassportFees[0]))
                                            @foreach ($lostPassportFees as $key => $value)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>
                                                        <input type="text" name="title[]" value="{{ $value->title }}"
                                                            class="form-control">
                                                        <input type="hidden" name="id[]" value="{{ $value->id }}"
                                                            class="form-control">
                                                        <input type="hidden" name="p_type[]" value="lost-passport"
                                                            class="form-control">
                                                    </td>
                                                    <td>
                                                        <input type="number" step="any" min="0" name="govt_fee[]"
                                                            value="{{ $value->government_fee }}" class="form-control">
                                                    </td>
                                                    <td>
                                                        <input type="number" step="any" min="0" name="versatilo_fee[]"
                                                            value="{{ $value->versatilo_fee }}" class="form-control">
                                                    </td>
                                                    <td>
                                                        @if (!isset($key))
                                                            <a class="btn btn-danger text-white"
                                                                onclick="removeItem($(this))"><i
                                                                    class="fa fa-times"></i></a>
                                                        @endif

                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="5" class="text-center">
                                                <a class="btn btn-primary text-white" onclick="newItem()"><i
                                                        class="fa fa-plus"></i>&nbsp; Add More</a>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="panel-footer bg-defult" style="padding: 10px">

                                <button class="btn btn-info" type="submit" id="btnLostPassport">SAVE</button>

                            </div>
                        </div>
                    </form>

                </div>

                <div class="col-lg-6">
                    <form id="lostPasportForm" action="{{ route('admin.passportFee.store') }}" method="POST">
                        @include('Others.message')
                        @csrf
                        <div class="panel panel-warning">
                            <div class="panel-heading">
                                <h3 class="panel-title text-white">Manual Passports</h3>

                            </div>
                            <div class="panel-body">

                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#SL</th>
                                            <th>Title</th>
                                            <th>Govt. Fee</th>
                                            <th>Versatilo Fee</th>
                                        </tr>
                                    </thead>
                                    <tbody id="manual_passports">
                                        @if (isset($manualPassportFees[0]))
                                            @foreach ($manualPassportFees as $key => $value)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <input type="text" name="title[]" value="{{ $value->title }}"
                                                            class="form-control">
                                                        <input type="hidden" name="id[]" value="{{ $value->id }}"
                                                            class="form-control">
                                                        <input type="hidden" name="p_type[]" value="manual-passport"
                                                            class="form-control">
                                                    </td>
                                                    <td>
                                                        <input type="number" step="any" min="0" name="govt_fee[]"
                                                            value="{{ $value->government_fee }}" class="form-control">
                                                    </td>
                                                    <td>
                                                        <input type="number" step="any" min="0" name="versatilo_fee[]"
                                                            value="{{ $value->versatilo_fee }}" class="form-control">
                                                    </td>
                                                    <td>
                                                        @if (!isset($key))
                                                            <a class="btn btn-danger text-white"
                                                                onclick="removeItemManual($(this))"><i
                                                                    class="fa fa-times"></i></a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="5" class="text-center">
                                                <a class="btn btn-warning text-white" onclick="newItemManual()"><i
                                                        class="fa fa-plus"></i>&nbsp; Add More</a>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="panel-footer bg-defult" style="padding: 10px">

                                <button class="btn btn-warning" type="submit" id="btnLostPassport">SAVE</button>

                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-lg-6">
                    <form id="lostPasportForm" action="{{ route('admin.passportFee.store') }}" method="POST">
                        @include('Others.message')
                        @csrf
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h3 class="panel-title text-white">Renew Passports</h3>

                            </div>
                            <div class="panel-body">

                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#SL</th>
                                            <th>Title</th>
                                            <th>Govt. Fee</th>
                                            <th>Versatilo Fee</th>
                                        </tr>
                                    </thead>
                                    <tbody id="renew_passports">
                                        @if (isset($renewPassportFees[0]))
                                            @foreach ($renewPassportFees as $key => $value)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <input type="text" name="title[]" value="{{ $value->title }}"
                                                            class="form-control">
                                                        <input type="hidden" name="id[]" value="{{ $value->id }}"
                                                            class="form-control">
                                                        <input type="hidden" name="p_type[]" value="renew-passport"
                                                            class="form-control">
                                                    </td>
                                                    <td>
                                                        <input type="number" step="any" min="0" name="govt_fee[]"
                                                            value="{{ $value->government_fee }}" class="form-control">
                                                    </td>
                                                    <td>
                                                        <input type="number" step="any" min="0" name="versatilo_fee[]"
                                                            value="{{ $value->versatilo_fee }}" class="form-control">
                                                    </td>
                                                    <td>
                                                        @if (!isset($key))
                                                            <a class="btn btn-danger text-white"
                                                                onclick="removeItemRenew($(this))"><i
                                                                    class="fa fa-times"></i></a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="5" class="text-center">
                                                <a class="btn btn-success text-white" onclick="newItemRenew()"><i
                                                        class="fa fa-plus"></i>&nbsp; Add More</a>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="panel-footer bg-defult" style="padding: 10px">

                                <button class="btn btn-success" type="submit" id="btnLostPassport">SAVE</button>

                            </div>
                        </div>
                    </form>
                </div>


                <div class="col-lg-6">
                    <form id="lostPasportForm" action="{{ route('admin.passportFee.store') }}" method="POST">
                        @include('Others.message')
                        @csrf
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title text-white">New Born Baby Passports</h3>

                            </div>
                            <div class="panel-body">

                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#SL</th>
                                            <th>Title</th>
                                            <th>Govt. Fee</th>
                                            <th>Versatilo Fee</th>
                                        </tr>
                                    </thead>
                                    <tbody id="newBorn_passports">
                                        @if (isset($newbornPassportFees[0]))
                                            @foreach ($newbornPassportFees as $key => $value)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <input type="text" name="title[]" value="{{ $value->title }}"
                                                            class="form-control">
                                                        <input type="hidden" name="id[]" value="{{ $value->id }}"
                                                            class="form-control">
                                                        <input type="hidden" name="p_type[]" value="new-born-baby-passport"
                                                            class="form-control">
                                                    </td>
                                                    <td>
                                                        <input type="number" step="any" min="0" name="govt_fee[]"
                                                            value="{{ $value->government_fee }}" class="form-control">
                                                    </td>
                                                    <td>
                                                        <input type="number" step="any" min="0" name="versatilo_fee[]"
                                                            value="{{ $value->versatilo_fee }}" class="form-control">
                                                    </td>
                                                    <td>
                                                        @if (!isset($key))
                                                            <a class="btn btn-danger text-white"
                                                                onclick="removeItemRenew($(this))"><i
                                                                    class="fa fa-times"></i></a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="5" class="text-center">
                                                <a class="btn btn-success text-white" onclick="newItemNewBorn()"><i
                                                        class="fa fa-plus"></i>&nbsp; Add More</a>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="panel-footer bg-defult" style="padding: 10px">

                                <button class="btn btn-success" type="submit" id="btnLostPassport">SAVE</button>

                            </div>
                        </div>
                    </form>
                </div>

            </div> <!-- End Row -->
        </div> <!-- container -->
    </div> <!-- content -->

    <script>
        // Lost Passport
        function newItem() {
            $('#lost_passports').append(
                '<tr>' +
                '<td></td>' +
                '<td>' +
                '<input type="text" name="title[]" class="form-control">' +
                '<input type="hidden" name="id[]" value="" class="form-control">' +
                '<input type="hidden" name="p_type[]" value="lost-passport" class="form-control">' +
                '</td>' +
                '<td>' +
                '<input type="number" step="any" min="0"  name="govt_fee[]" class="form-control">' +
                '</td>' +
                '<td>' +
                '<input type="number" step="any" min="0"  name="versatilo_fee[]" class="form-control">' +
                '</td>' +
                '<td>' +
                '<a class="btn btn-danger text-white" onclick="removeItem($(this))"><i class="fa fa-times"></i></a>' +
                '</td>' +
                '</tr>'
            );
            maintainSerial()
        }

        function maintainSerial() {
            var count = 0;
            $.each($('#lost_passports tr'), function(index, val) {
                count++;
                $(this).find("td:first").html(count);
            });
            $('#lost_passports').find('tr:first').find('td:last').html('');
        }

        function removeItem(element) {
            var count = 0;
            $.each($('#lost_passports tr'), function(index, val) {
                count++;
            });

            if (count > 1) {
                element.parent().parent().remove();
                maintainSerial();
            }
        }

        // Manual  Passport

        function newItemManual() {
            $('#manual_passports').append(
                '<tr>' +
                '<td></td>' +
                '<td>' +
                '<input type="text" name="title[]" class="form-control">' +
                '<input type="hidden" name="id[]" value="" class="form-control">' +
                '<input type="hidden" name="p_type[]" value="manual-passport" class="form-control">' +
                '</td>' +
                '<td>' +
                '<input type="number" step="any" min="0"  name="govt_fee[]" class="form-control">' +
                '</td>' +
                '<td>' +
                '<input type="number" step="any" min="0"  name="versatilo_fee[]" class="form-control">' +
                '</td>' +
                '<td>' +
                '<a class="btn btn-danger text-white" onclick="removeItemManual($(this))"><i class="fa fa-times"></i></a>' +
                '</td>' +
                '</tr>'
            );
            maintainSerialManual()
        }

        function maintainSerialManual() {
            var count = 0;
            $.each($('#manual_passports tr'), function(index, val) {
                count++;
                $(this).find("td:first").html(count);
            });
            $('#manual_passports').find('tr:first').find('td:last').html('');
        }

        function removeItemManual(element) {
            var count = 0;
            $.each($('#manual_passports tr'), function(index, val) {
                count++;
            });

            if (count > 1) {
                element.parent().parent().remove();
                maintainSerialManual();
            }
        }

        // Renew Passport
        function newItemRenew() {
            $('#renew_passports').append(
                '<tr>' +
                '<td></td>' +
                '<td>' +
                '<input type="text" name="title[]" class="form-control">' +
                '<input type="hidden" name="id[]" value="" class="form-control">' +
                '<input type="hidden" name="p_type[]" value="renew-passport" class="form-control">' +
                '</td>' +
                '<td>' +
                '<input type="number" step="any" min="0"  name="govt_fee[]" class="form-control">' +
                '</td>' +
                '<td>' +
                '<input type="number" step="any" min="0"  name="versatilo_fee[]" class="form-control">' +
                '</td>' +
                '<td>' +
                '<a class="btn btn-danger text-white" onclick="removeItemRenew($(this))"><i class="fa fa-times"></i></a>' +
                '</td>' +
                '</tr>'
            );
            maintainSerialRenew()
        }


        function maintainSerialRenew() {
            var count = 0;
            $.each($('#renew_passports tr'), function(index, val) {
                count++;
                $(this).find("td:first").html(count);
            });
            $('#renew_passports').find('tr:first').find('td:last').html('');
        }

        function removeItemRenew(element) {
            var count = 0;
            $.each($('#renew_passports tr'), function(index, val) {
                count++;
            });

            if (count > 1) {
                element.parent().parent().remove();
                maintainSerialRenew();
            }
        }

        //new born-baby Passport
        function newItemNewBorn() {
            $('#newBorn_passports').append(
                '<tr>' +
                '<td></td>' +
                '<td>' +
                '<input type="text" name="title[]" class="form-control">' +
                '<input type="hidden" name="id[]" value="" class="form-control">' +
                '<input type="hidden" name="p_type[]" value="new-born-baby-passport" class="form-control">' +
                '</td>' +
                '<td>' +
                '<input type="number" step="any" min="0"  name="govt_fee[]" class="form-control">' +
                '</td>' +
                '<td>' +
                '<input type="number" step="any" min="0"  name="versatilo_fee[]" class="form-control">' +
                '</td>' +
                '<td>' +
                '<a class="btn btn-danger text-white" onclick="removeItemNewBorn($(this))"><i class="fa fa-times"></i></a>' +
                '</td>' +
                '</tr>'
            );
            maintainSerialNewBorn()
        }


        function maintainSerialNewBorn() {
            var count = 0;
            $.each($('#newBorn_passports tr'), function(index, val) {
                count++;
                $(this).find("td:first").html(count);
            });
            $('#newBorn_passports').find('tr:first').find('td:last').html('');
        }

        function removeItemNewBorn(element) {
            var count = 0;
            $.each($('#newBorn_passports tr'), function(index, val) {
                count++;
            });

            if (count > 1) {
                element.parent().parent().remove();
                maintainSerialNewBorn();
            }
        }


    </script>

    @if (session()->has('success'))
        <script type="text/javascript">
            $(document).ready(function() {
                // notify('{{ session()->get('success') }}','success');
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: '{{ Session::get('success') }}',
                    showConfirmButton: false,
                    timer: 1500
                })
            });
        </script>


    @endif
@endsection

@push('datatableJS')
    <!-- Datatables-->
    <script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/datatables/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/datatables/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/datatables/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/datatables/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/datatables/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/datatables/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/datatables/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/datatables/responsive.bootstrap.min.js') }}"></script>
    <!--repeter--->
    <script src="{{ asset('assets/admin/js/jquery.repeater.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/custome.js') }}"></script>
@endpush
