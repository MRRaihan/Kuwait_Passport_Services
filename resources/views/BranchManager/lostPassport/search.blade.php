@extends('BranchManager.layouts.master')

@push('title')
Lost Passport
@endpush
@push('datatableCSS')
    <!-- DataTables -->
    <link href="{{ asset('assets/branch-manager/plugins/datatables/jquery.dataTables.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/branch-manager/plugins/datatables/buttons.bootstrap.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/branch-manager/plugins/datatables/fixedHeader.bootstrap.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/branch-manager/plugins/datatables/responsive.bootstrap.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/branch-manager/plugins/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/branch-manager/plugins/datatables/scroller.bootstrap.min.css') }}" rel="stylesheet"
        type="text/css" />
@endpush
@section('content')

    <style>
        td,
        th {
            text-align: center;
        }
    </style>

    <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-header-title">
                        <h4 class="pull-left page-title">Search Result For Lost Passports:</h4>
                        <ol class="breadcrumb pull-right">
                            <li><a href="{{ route('branchManager.dashboard') }}">Branch Manager Panel</a></li>
                            <li class="active">Passport</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>



            <div class="row mt-5">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading" style="background-color: #01ba9a !important;">
                            <span class="panel-title">Lost Passports Table
                                <!-- Button trigger modal for adding new Category -->

                        </div>
                        <div class="panel-body">
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                                cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Civil ID</th>
                                        <th>MRP Passport Number</th>
                                        <th>New MRP Passport Number</th>
                                        <th>Bio Enrollment ID</th>
                                        <th>Phone</th>
                                        <th>EMS</th>
                                        <th>Time</th>
                                        <th style="width: 150px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lostPassports as $key => $lostPassport)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $lostPassport->name }} {{ $lostPassport->last_name }}</td>
                                            <td>{{ $lostPassport->civil_id }}</td>
                                            <td>{{ $lostPassport->passport_number }}</td>
                                            <td>{{ $lostPassport->new_mrp_passport_no }}</td>
                                            <td>{{ $lostPassport->bio_enrollment_id }}</td>
                                            <td>{{ $lostPassport->bd_phone }}</td>
                                            <td>{{ $lostPassport->ems }}</td>
                                            <td>{{ $lostPassport->created_at ? $lostPassport->created_at->diffForHumans() : '' }}
                                            </td>
                                            <td style="width: 150px">
                                                <a href="{{ route('branchManager.lostPassport.receipt', $lostPassport->id) }}"
                                                    target="_blank" class="btn btn-success"><i
                                                        class="fa fa-print"></i>Receipt</a>
                                                <a href="{{ route('branchManager.lostPassport.sticker', $lostPassport->id) }}"
                                                    target="_blank" class="btn btn-warning"><i
                                                        class="fa fa-print"></i>Sticker</a>
                                                <a href="{{ route('branchManager.lostPassport.show', $lostPassport->id) }}"
                                                    target="_blank" class="btn btn-primary"><i
                                                        class="fa fa-eye"></i></a>
                                                <a href="{{ route('branchManager.lostPassport.agreement', $lostPassport->id) }}"
                                                    target="_blank" class="btn btn-primary"><i
                                                        class="fa fa-eye">Agreement</i></a>

                                                <a href="{{ route('branchManager.lostPassport.edit', $lostPassport) }}"
                                                    class="btn btn-info"><i class="fa fa-edit"></i></a>

                                                <button class="btn btn-danger" onclick="delete_function(this)"
                                                    value="{{ route('branchManager.lostPassport.destroy', $lostPassport) }}"><i
                                                        class="fa fa-trash"></i> </button>

                                                <a href="{{ route('branchManager.addExtraService.index') }}"
                                                    class="btn btn-info"><i class="fa fa-edit">Add Service</i></a>

                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div> <!-- End Row -->
        </div> <!-- container -->
    </div> <!-- content -->
    @include('Others.toaster_message')

@endsection

@push('datatableJS')
    <!-- Datatables-->
    <script src="{{ asset('assets/branch-manager/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/branch-manager/plugins/datatables/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('assets/branch-manager/plugins/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/branch-manager/plugins/datatables/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/branch-manager/plugins/datatables/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/branch-manager/plugins/datatables/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/branch-manager/plugins/datatables/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/branch-manager/plugins/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/branch-manager/plugins/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/branch-manager/plugins/datatables/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset('assets/branch-manager/plugins/datatables/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('assets/branch-manager/plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/branch-manager/plugins/datatables/responsive.bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/branch-manager/plugins/datatables/dataTables.scroller.min.js') }}"></script>
    <!-- Datatable init js -->
    <script src="{{ asset('assets/branch-manager/pages/datatables.init.js') }}"></script>
@endpush
