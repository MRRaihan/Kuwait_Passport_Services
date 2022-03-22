@extends('Admin.layouts.master')

@push('title')
    Other Service Fees Table
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

        .radio_custom radio-inline {
            float: left !important;
        }
    </style>

    <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-header-title">
                        <h4 class="pull-left page-title">Other Service Fees Table</h4>
                        <ol class="breadcrumb pull-right">
                            <li><a href="{{ route('admin.dashboard') }}">Admin Panel</a></li>
                            <li class="active">Other Service Fees</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>



            <div class="row mt-5">

                <div class="col-lg-12">
                    <form id="lostPasportForm" action="{{ route('admin.otherServiceFee.store') }}" method="POST">
                        @include('Others.message')
                        @csrf
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title text-white">Premier Service</h3>

                            </div>
                            <div class="panel-body">

                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th style="width: 30%">Title</th>
                                            <th>Government Fee</th>
                                            <th>Versatilo Fee</th>
                                            <th>Consultants Fee</th>
                                            <th>Agency Fee</th>
                                            <th style="width: 15%;">Status </th>
                                        </tr>

                                    </thead>
                                    <tbody id="premier_service_tab">
                                        <input type="hidden" value="{{ count($premierService) }}" id="primeServiceCount">
                                        @if (isset($premierService[0]))
                                            @foreach ($premierService as $key => $value)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>
                                                        <input type="text" name="title[]" value="{{ $value->title }}"
                                                            class="form-control">
                                                        <input type="hidden" name="id[]" value="{{ $value->id }}"
                                                            class="form-control">
                                                        <input type="hidden" name="service_type[]" value="premier-service"
                                                            class="form-control">
                                                    </td>
                                                    <td>
                                                        <input onkeypress="return /[0-9.]/i.test(event.key)" min="0"
                                                            name="govt_fee[]" value="{{ $value->govt_fee }}"
                                                            class="form-control">
                                                    </td>
                                                    <td>
                                                        <input onkeypress="return /[0-9.]/i.test(event.key)" min="0"
                                                            name="versatilo_fee[]" value="{{ $value->versetilo_fee }}"
                                                            class="form-control">
                                                    </td>
                                                    <td>
                                                        <input onkeypress="return /[0-9.]/i.test(event.key)" min="0"
                                                            name="consultants_fee[]"
                                                            value="{{ $value->consultants_fee }}" class="form-control">
                                                    </td>
                                                    <td>
                                                        <input onkeypress="return /[0-9.]/i.test(event.key)" min="0"
                                                            name="agency_fee[]" value="{{ $value->agency_fee }}"
                                                            class="form-control">
                                                    </td>
                                                    <td>

                                                        <div class="radio radio_custom radio-inline radio-success ">
                                                            <input type="radio" id="inlineRadio1{{ $key }}"
                                                                value="0" name="service_status{{ $key }}"
                                                                @if ($value->service_status == 0) checked @endif>
                                                            <label for="inlineRadio1">Fix</label>
                                                        </div>
                                                        <div class="radio radio_custom radio-inline  radio-info">
                                                            <input type="radio" id="inlineRadio2{{ $key }}"
                                                                value="1" name="service_status{{ $key }}"
                                                                @if ($value->service_status == 1) checked @endif>
                                                            <label for="inlineRadio2">Manual</label>
                                                        </div>
                                                        <div class="radio radio_custom radio-inline  radio-warning">
                                                            <input type="radio" id="inlineRadio2{{ $key }}"
                                                                value="2" name="service_status{{ $key }}"
                                                                @if ($value->service_status == 2) checked @endif>
                                                            <label for="inlineRadio2">Both</label>
                                                        </div>

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
                                                <a class="btn btn-primary text-white" onclick="newPremierService()"><i
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

                <div class="col-lg-12">
                    <form id="lostPasportForm" action="{{ route('admin.otherServiceFee.store') }}" method="POST">
                        @include('Others.message')
                        @csrf
                        <div class="panel panel-warning">
                            <div class="panel-heading">
                                <h3 class="panel-title text-white">Express Service</h3>

                            </div>
                            <div class="panel-body">

                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th style="width: 30%">Title</th>
                                            <th>Government Fee</th>
                                            <th>Versatilo Fee</th>
                                            <th>Consultants Fee</th>
                                            <th>Agency Fee</th>
                                            <th style="width: 15%;">Status </th>
                                        </tr>
                                    </thead>
                                    <tbody id="express_service_tab">
                                        <input type="hidden" value="{{ count($expressService) }}"
                                            id="expressServiceCount">
                                        @if (isset($expressService[0]))
                                            @foreach ($expressService as $key => $value)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>
                                                        <input type="text" name="title[]" value="{{ $value->title }}"
                                                            class="form-control">
                                                        <input type="hidden" name="id[]" value="{{ $value->id }}"
                                                            class="form-control">
                                                        <input type="hidden" name="service_type[]" value="express-service"
                                                            class="form-control">
                                                    </td>
                                                    <td>
                                                        <input onkeypress="return /[0-9.]/i.test(event.key)" min="0"
                                                            name="govt_fee[]" value="{{ $value->govt_fee }}"
                                                            class="form-control">
                                                    </td>
                                                    <td>
                                                        <input onkeypress="return /[0-9.]/i.test(event.key)" min="0"
                                                            name="versatilo_fee[]" value="{{ $value->versetilo_fee }}"
                                                            class="form-control">
                                                    </td>
                                                    <td>
                                                        <input onkeypress="return /[0-9.]/i.test(event.key)" min="0"
                                                            name="consultants_fee[]"
                                                            value="{{ $value->consultants_fee }}" class="form-control">
                                                    </td>
                                                    <td>
                                                        <input onkeypress="return /[0-9.]/i.test(event.key)" min="0"
                                                            name="agency_fee[]" value="{{ $value->agency_fee }}"
                                                            class="form-control">
                                                    </td>
                                                    <td>

                                                        <div class="radio radio_custom radio-inline radio-success">
                                                            <input type="radio" id="inlineRadio1{{ $key }}"
                                                                value="0" name="service_status{{ $key }}"
                                                                @if ($value->service_status == 0) checked @endif>
                                                            <label for="inlineRadio1">Fix</label>
                                                        </div>
                                                        <div class="radio radio_custom radio-inline  radio-info">
                                                            <input type="radio" id="inlineRadio2{{ $key }}"
                                                                value="1" name="service_status{{ $key }}"
                                                                @if ($value->service_status == 1) checked @endif>
                                                            <label for="inlineRadio2">Manual</label>
                                                        </div>
                                                        <div class="radio radio_custom radio-inline  radio-warning">
                                                            <input type="radio" id="inlineRadio2{{ $key }}"
                                                                value="2" name="service_status{{ $key }}"
                                                                @if ($value->service_status == 2) checked @endif>
                                                            <label for="inlineRadio2">Both</label>
                                                        </div>

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
                                                <a class="btn btn-primary text-white" onclick="newExpressService()"><i
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

                <div class="col-lg-12">
                    <form id="lostPasportForm" action="{{ route('admin.otherServiceFee.store') }}" method="POST">
                        @include('Others.message')
                        @csrf
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h3 class="panel-title text-white">Legal and Complaints Service</h3>

                            </div>
                            <div class="panel-body">

                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th style="width: 30%">Title</th>
                                            <th>Government Fee</th>
                                            <th>Versatilo Fee</th>
                                            <th>Consultants Fee</th>
                                            <th>Agency Fee</th>
                                            <th style="width: 15%;">Status </th>
                                        </tr>
                                    </thead>
                                    <tbody id="complaints_service_tab">
                                        <input type="hidden" value="{{ count($legalComplaintsService) }}"
                                            id="legalComplaintsService">
                                        @if (isset($legalComplaintsService[0]))
                                            @foreach ($legalComplaintsService as $key => $value)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>
                                                        <input type="text" name="title[]" value="{{ $value->title }}"
                                                            class="form-control">
                                                        <input type="hidden" name="id[]" value="{{ $value->id }}"
                                                            class="form-control">
                                                        <input type="hidden" name="service_type[]"
                                                            value="legal-complaints-service" class="form-control">
                                                    </td>
                                                    <td>
                                                        <input onkeypress="return /[0-9.]/i.test(event.key)" min="0"
                                                            name="govt_fee[]" value="{{ $value->govt_fee }}"
                                                            class="form-control">
                                                    </td>
                                                    <td>
                                                        <input onkeypress="return /[0-9.]/i.test(event.key)" min="0"
                                                            name="versatilo_fee[]" value="{{ $value->versetilo_fee }}"
                                                            class="form-control">
                                                    </td>
                                                    <td>
                                                        <input onkeypress="return /[0-9.]/i.test(event.key)" min="0"
                                                            name="consultants_fee[]"
                                                            value="{{ $value->consultants_fee }}" class="form-control">
                                                    </td>
                                                    <td>
                                                        <input onkeypress="return /[0-9.]/i.test(event.key)" min="0"
                                                            name="agency_fee[]" value="{{ $value->agency_fee }}"
                                                            class="form-control">
                                                    </td>
                                                    <td>

                                                        <div class="radio radio_custom radio-inline radio-success ">
                                                            <input type="radio" id="inlineRadio1{{ $key }}"
                                                                value="0" name="service_status{{ $key }}"
                                                                @if ($value->service_status == 0) checked @endif>
                                                            <label for="inlineRadio1">Fix</label>
                                                        </div>
                                                        <div class="radio radio_custom radio-inline  radio-info">
                                                            <input type="radio" id="inlineRadio2{{ $key }}"
                                                                value="1" name="service_status{{ $key }}"
                                                                @if ($value->service_status == 1) checked @endif>
                                                            <label for="inlineRadio2">Manual</label>
                                                        </div>
                                                        <div class="radio radio_custom radio-inline  radio-warning">
                                                            <input type="radio" id="inlineRadio2{{ $key }}"
                                                                value="2" name="service_status{{ $key }}"
                                                                @if ($value->service_status == 2) checked @endif>
                                                            <label for="inlineRadio2">Both</label>
                                                        </div>

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
                                                <a class="btn btn-primary text-white" onclick="newItemComplaints()"><i
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

                <div class="col-lg-12">
                    <form id="lostPasportForm" action="{{ route('admin.otherServiceFee.store') }}" method="POST">
                        @include('Others.message')
                        @csrf
                        <div class="panel panel-warning">
                            <div class="panel-heading">
                                <h3 class="panel-title text-white">Immigration and Government Service</h3>

                            </div>
                            <div class="panel-body">

                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th style="width: 30%">Title</th>
                                            <th>Government Fee</th>
                                            <th>Versatilo Fee</th>
                                            <th>Consultants Fee</th>
                                            <th>Agency Fee</th>
                                            <th style="width: 15%;">Status </th>
                                        </tr>
                                    </thead>
                                    <tbody id="govement_service_tab">
                                        <input type="hidden" value="{{ count($immigrationGovementService) }}"
                                            id="immigrationGovementService">
                                        @if (isset($immigrationGovementService[0]))
                                            @foreach ($immigrationGovementService as $key => $value)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>
                                                        <input type="text" name="title[]" value="{{ $value->title }}"
                                                            class="form-control">
                                                        <input type="hidden" name="id[]" value="{{ $value->id }}"
                                                            class="form-control">
                                                        <input type="hidden" name="service_type[]"
                                                            value="immigration-govement-service" class="form-control">
                                                    </td>
                                                    <td>
                                                        <input onkeypress="return /[0-9.]/i.test(event.key)" min="0"
                                                            name="govt_fee[]" value="{{ $value->govt_fee }}"
                                                            class="form-control">
                                                    </td>
                                                    <td>
                                                        <input onkeypress="return /[0-9.]/i.test(event.key)" min="0"
                                                            name="versatilo_fee[]" value="{{ $value->versetilo_fee }}"
                                                            class="form-control">
                                                    </td>
                                                    <td>
                                                        <input onkeypress="return /[0-9.]/i.test(event.key)" min="0"
                                                            name="consultants_fee[]"
                                                            value="{{ $value->consultants_fee }}" class="form-control">
                                                    </td>
                                                    <td>
                                                        <input onkeypress="return /[0-9.]/i.test(event.key)" min="0"
                                                            name="agency_fee[]" value="{{ $value->agency_fee }}"
                                                            class="form-control">
                                                    </td>
                                                    <td>

                                                        <div class="radio radio_custom radio-inline radio-success ">
                                                            <input type="radio" id="inlineRadio1{{ $key }}"
                                                                value="0" name="service_status{{ $key }}"
                                                                @if ($value->service_status == 0) checked @endif>
                                                            <label for="inlineRadio1">Fix</label>
                                                        </div>
                                                        <div class="radio radio_custom radio-inline  radio-info">
                                                            <input type="radio" id="inlineRadio2{{ $key }}"
                                                                value="1" name="service_status{{ $key }}"
                                                                @if ($value->service_status == 1) checked @endif>
                                                            <label for="inlineRadio2">Manual</label>
                                                        </div>
                                                        <div class="radio radio_custom radio-inline  radio-warning">
                                                            <input type="radio" id="inlineRadio2{{ $key }}"
                                                                value="2" name="service_status{{ $key }}"
                                                                @if ($value->service_status == 2) checked @endif>
                                                            <label for="inlineRadio2">Both</label>
                                                        </div>

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
                                                <a class="btn btn-primary text-white" onclick="newGovementService()"><i
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

            </div> <!-- End Row -->
        </div> <!-- container -->
    </div> <!-- content -->

    <script>
        // premier service
        function newPremierService() {
            let count = parseInt($('#primeServiceCount').val());
            if (count == null) count = 0;
            $('#primeServiceCount').val(count + 1);

            $('#premier_service_tab').append(
                '<tr>' +
                '<td></td>' +
                '<td>' +
                '<input type="text" name="title[]" class="form-control">' +
                '<input type="hidden" name="id[]" value="" class="form-control">' +
                '<input type="hidden" name="service_type[]" value="premier-service" class="form-control">' +
                '</td>' +
                '<td>' +
                '<input onkeypress="return /[0-9.]/i.test(event.key)" min="0"  name="govt_fee[]" class="form-control">' +
                '</td>' +
                '<td>' +
                '<input onkeypress="return /[0-9.]/i.test(event.key)" min="0"  name="versatilo_fee[]" class="form-control">' +
                '</td>' +
                '<td>' +
                '<input onkeypress="return /[0-9.]/i.test(event.key)" min="0"  name="consultants_fee[]" class="form-control">' +
                '</td>' +
                '<td>' +
                '<input onkeypress="return /[0-9.]/i.test(event.key)" min="0"  name="agency_fee[]" class="form-control">' +
                '</td>' +
                '<td>' +
                '<div class="radio radio_custom radio-inline radio-success ">' +
                '<input type="radio" id="inlineRadio1' + count + '" value="0" name="service_status' + count +
                '" checked="checked">' +
                '<label for="inlineRadio1' + count + '">Fix</label>' +
                '</div>' +
                '<div class="radio radio_custom radio-inline radio-info ">' +
                '<input type="radio" id="inlineRadio2' + count + '" value="1" name="service_status' + count +
                '">' +
                '<label for="inlineRadio2' + count + '">Manual</label>' +
                '</div>' +
                '<div class="radio radio_custom radio-inline radio-warning ">' +
                '<input type="radio" id="inlineRadio3' + count + '" value="2" name="service_status' + count +
                '">' +
                '<label for="inlineRadio3' + count + '">Both</label>' +
                '</div>' +
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
            $.each($('#premier_service_tab tr'), function(index, val) {
                count++;
                $(this).find("td:first").html(count);
            });
            $('#premier_service_tab').find('tr:first').find('td:last').html('');
        }

        function removeItem(element) {
            var count = 0;
            $.each($('#premier_service_tab tr'), function(index, val) {
                count++;
            });

            if (count > 1) {
                element.parent().parent().remove();
                maintainSerial();
            }
        }

        // Express service

        function newExpressService() {
            let count = parseInt($('#expressServiceCount').val());
            if (count == null) count = 0;
            $('#expressServiceCount').val(count + 1);
            $('#express_service_tab').append(
                '<tr>' +
                '<td></td>' +
                '<td>' +
                '<input type="text" name="title[]" class="form-control">' +
                '<input type="hidden" name="id[]" value="" class="form-control">' +
                '<input type="hidden" name="service_type[]" value="express-service" class="form-control">' +
                '</td>' +
                '<td>' +
                '<input onkeypress="return /[0-9.]/i.test(event.key)" min="0"  name="govt_fee[]" class="form-control">' +
                '</td>' +
                '<td>' +
                '<input onkeypress="return /[0-9.]/i.test(event.key)" min="0"  name="versatilo_fee[]" class="form-control">' +
                '</td>' +
                '<td>' +
                '<input onkeypress="return /[0-9.]/i.test(event.key)" min="0"  name="consultants_fee[]" class="form-control">' +
                '</td>' +
                '<td>' +
                '<input onkeypress="return /[0-9.]/i.test(event.key)" min="0"  name="agency_fee[]" class="form-control">' +
                '</td>' +
                '<td>' +
                '<div class="radio radio_custom radio-inline radio-success ">' +
                '<input type="radio" id="inlineRadio1' + count + '" value="0" name="service_status' + count +
                '" checked="checked">' +
                '<label for="inlineRadio1' + count + '">Fix</label>' +
                '</div>' +
                '<div class="radio radio_custom radio-inline radio-info ">' +
                '<input type="radio" id="inlineRadio2' + count + '" value="1" name="service_status' + count +
                '">' +
                '<label for="inlineRadio2' + count + '">Manual</label>' +
                '</div>' +
                '<div class="radio radio_custom radio-inline radio-warning ">' +
                '<input type="radio" id="inlineRadio3' + count + '" value="2" name="service_status' + count +
                '">' +
                '<label for="inlineRadio3' + count + '">Both</label>' +
                '</div>' +
                '</td>' +
                '<td>' +
                '<a class="btn btn-danger text-white" onclick="removeItemExpress($(this))"><i class="fa fa-times"></i></a>' +
                '</td>' +
                '</tr>'
            );
            maintainSerialManualExpress()
        }

        function maintainSerialManualExpress() {
            var count = 0;
            $.each($('#express_service_tab tr'), function(index, val) {
                count++;
                $(this).find("td:first").html(count);
            });
            $('#express_service_tab').find('tr:first').find('td:last').html('');
        }

        function removeItemExpress(element) {
            var count = 0;
            $.each($('#express_service_tab tr'), function(index, val) {
                count++;
            });

            if (count > 1) {
                element.parent().parent().remove();
                maintainSerialManualExpress();
            }
        }

        // Complaints service
        function newItemComplaints() {
            let count = parseInt($('#legalComplaintsService').val());
            if (count == null) count = 0;
            $('#legalComplaintsService').val(count + 1);
            $('#complaints_service_tab').append(
                '<tr>' +
                '<td></td>' +
                '<td>' +
                '<input type="text" name="title[]" class="form-control">' +
                '<input type="hidden" name="id[]" value="" class="form-control">' +
                '<input type="hidden" name="service_type[]" value="legal-complaints-service" class="form-control">' +
                '</td>' +
                '<td>' +
                '<input onkeypress="return /[0-9.]/i.test(event.key)" min="0"  name="govt_fee[]" class="form-control">' +
                '</td>' +
                '<td>' +
                '<input onkeypress="return /[0-9.]/i.test(event.key)" min="0"  name="versatilo_fee[]" class="form-control">' +
                '</td>' +
                '<td>' +
                '<input onkeypress="return /[0-9.]/i.test(event.key)" min="0"  name="consultants_fee[]" class="form-control">' +
                '</td>' +
                '<td>' +
                '<input onkeypress="return /[0-9.]/i.test(event.key)" min="0"  name="agency_fee[]" class="form-control">' +
                '</td>' +
                '<td>' +
                '<div class="radio radio_custom radio-inline radio-success ">' +
                '<input type="radio" id="inlineRadio1' + count + '" value="0" name="service_status' + count +
                '" checked="checked">' +
                '<label for="inlineRadio1' + count + '">Fix</label>' +
                '</div>' +
                '<div class="radio radio_custom radio-inline radio-info ">' +
                '<input type="radio" id="inlineRadio2' + count + '" value="1" name="service_status' + count +
                '">' +
                '<label for="inlineRadio2' + count + '">Manual</label>' +
                '</div>' +
                '<div class="radio radio_custom radio-inline radio-warning ">' +
                '<input type="radio" id="inlineRadio3' + count + '" value="2" name="service_status' + count +
                '">' +
                '<label for="inlineRadio3' + count + '">Both</label>' +
                '</div>' +
                '</td>' +
                '<td>' +
                '<a class="btn btn-danger text-white" onclick="removeItemComplaints($(this))"><i class="fa fa-times"></i></a>' +
                '</td>' +
                '</tr>'
            );
            maintainSerialManualComplaints()
        }

        function maintainSerialManualComplaints() {
            var count = 0;
            $.each($('#complaints_service_tab tr'), function(index, val) {
                count++;
                $(this).find("td:first").html(count);
            });
            $('#complaints_service_tab').find('tr:first').find('td:last').html('');
        }

        function removeItemComplaints(element) {
            var count = 0;
            $.each($('#complaints_service_tab tr'), function(index, val) {
                count++;
            });

            if (count > 1) {
                element.parent().parent().remove();
                maintainSerialManualComplaints()
            }
        }

        //Govement Service
        function newGovementService() {
            let count = parseInt($('#immigrationGovementService').val());
            if (count == null) count = 0;
            $('#immigrationGovementService').val(count + 1);
            $('#govement_service_tab').append(
                '<tr>' +
                '<td></td>' +
                '<td>' +
                '<input type="text" name="title[]" class="form-control">' +
                '<input type="hidden" name="id[]" value="" class="form-control">' +
                '<input type="hidden" name="service_type[]" value="immigration-govement-service" class="form-control">' +
                '</td>' +
                '<td>' +
                '<input onkeypress="return /[0-9.]/i.test(event.key)" min="0"  name="govt_fee[]" class="form-control">' +
                '</td>' +
                '<td>' +
                '<input onkeypress="return /[0-9.]/i.test(event.key)" min="0"  name="versatilo_fee[]" class="form-control">' +
                '</td>' +
                '<td>' +
                '<input onkeypress="return /[0-9.]/i.test(event.key)" min="0"  name="consultants_fee[]" class="form-control">' +
                '</td>' +
                '<td>' +
                '<input onkeypress="return /[0-9.]/i.test(event.key)" min="0"  name="agency_fee[]" class="form-control">' +
                '</td>' +
                '<td>' +
                '<div class="radio radio_custom radio-inline radio-success ">' +
                '<input type="radio" id="inlineRadio1' + count + '" value="0" name="service_status' + count +
                '" checked="checked">' +
                '<label for="inlineRadio1' + count + '">Fix</label>' +
                '</div>' +
                '<div class="radio radio_custom radio-inline radio-info ">' +
                '<input type="radio" id="inlineRadio2' + count + '" value="1" name="service_status' + count +
                '">' +
                '<label for="inlineRadio2' + count + '">Manual</label>' +
                '</div>' +
                '<div class="radio radio_custom radio-inline radio-warning ">' +
                '<input type="radio" id="inlineRadio3' + count + '" value="2" name="service_status' + count +
                '">' +
                '<label for="inlineRadio3' + count + '">Both</label>' +
                '</div>' +
                '</td>' +
                '<td>' +
                '<a class="btn btn-danger text-white" onclick="removeItemGovementService($(this))"><i class="fa fa-times"></i></a>' +
                '</td>' +
                '</tr>'
            );
            maintainSerialGovementService()
        }

        function maintainSerialGovementService() {
            var count = 0;
            $.each($('#govement_service_tab tr'), function(index, val) {
                count++;
                $(this).find("td:first").html(count);
            });
            $('#govement_service_tab').find('tr:first').find('td:last').html('');
        }

        function removeItemGovementService(element) {
            var count = 0;
            $.each($('#govement_service_tab tr'), function(index, val) {
                count++;
            });

            if (count > 1) {
                element.parent().parent().remove();
                maintainSerialGovementService();
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
