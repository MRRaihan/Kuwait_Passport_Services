@extends('DataEnterer.layouts.master')

@push('title')
Others Services
@endpush
@push('datatableCSS')
<!-- DataTables -->
<link href="{{ asset('assets/data-enterer/plugins/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/data-enterer/plugins/datatables/buttons.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/data-enterer/plugins/datatables/fixedHeader.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/data-enterer/plugins/datatables/responsive.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/data-enterer/plugins/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/data-enterer/plugins/datatables/scroller.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
@endpush
@section('content')

<style>
    td, th{
        text-align: center;
    }
</style>

<div class="content">
    <div class="container">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-header-title">
                    <h4 class="pull-left page-title">Other Services</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ route('dataEnterer.dashboard') }}">Data Enterer</a></li>
                        <li class="active">Other Services</li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        <div class="row text-right">
            <div class="col-sm-12">
                @if($flag!=0)
                <a class="btn btn-success btn-sm" href="{{ route('dataEnterer.otherService.create') }}" style="float: right; margin-bottom: 10px;" ><i class=" fa fa-plus"></i>&nbsp;Add New Service</a>
                @endif
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading" style="background-color: #46bdc6 !important;">
                        <span class="panel-title">Others Services Table
                        <!-- Button trigger modal for adding new Category -->

                    </div>
                    <div class="panel-body">
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>SL.</th>
                                    <th>Name</th>
                                    <th>Emirates ID</th>
                                    <th>Phone</th>
                                    <th>EMS</th>
                                    <th>Time</th>

                                    <th style="width: 150px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($otherServices as $key => $otherPassport)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $otherPassport->name }} {{ $otherPassport->last_name }}</td>
                                    <td>{{ $otherPassport->civil_id }}</td>
                                    <td>{{ $otherPassport->bd_phone }}</td>
                                    <td>{{ $otherPassport->ems }}</td>
                                    <td>{{ $otherPassport->created_at->diffForHumans() }}</td>
                                    <td style="width: 150px">
                                        <a href="{{ route('dataEnterer.otherService.receipt',$otherPassport->id) }}" target="_blank" class="btn btn-success"><i class="fa fa-print"></i>Receipt</a>

                                        <a href="{{ route('dataEnterer.otherService.sticker',$otherPassport->id) }}" target="_blank" class="btn btn-warning"><i class="fa fa-print"></i>Sticker</a>

                                        <a href="{{ route('dataEnterer.otherService.show',$otherPassport->id) }}" target="_blank" class="btn btn-primary"><i class="fa fa-eye"></i></a>

                                        <a href="{{ route('dataEnterer.otherService.edit',$otherPassport) }}" class="btn btn-info"><i class="fa fa-edit"></i></a>

                                        <button class="btn btn-danger" onclick="delete_function(this)" value="{{ route('dataEnterer.otherService.destroy',$otherPassport) }}"><i class="fa fa-trash"></i> </button>
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
<script src="{{ asset('assets/data-enterer/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/data-enterer/plugins/datatables/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('assets/data-enterer/plugins/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/data-enterer/plugins/datatables/buttons.bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/data-enterer/plugins/datatables/jszip.min.js') }}"></script>
<script src="{{ asset('assets/data-enterer/plugins/datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/data-enterer/plugins/datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/data-enterer/plugins/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/data-enterer/plugins/datatables/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/data-enterer/plugins/datatables/dataTables.fixedHeader.min.js') }}"></script>
<script src="{{ asset('assets/data-enterer/plugins/datatables/dataTables.keyTable.min.js') }}"></script>
<script src="{{ asset('assets/data-enterer/plugins/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/data-enterer/plugins/datatables/responsive.bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/data-enterer/plugins/datatables/dataTables.scroller.min.js') }}"></script>
<!-- Datatable init js -->
<script src="{{ asset('assets/data-enterer/pages/datatables.init.js') }}"></script>
@endpush
