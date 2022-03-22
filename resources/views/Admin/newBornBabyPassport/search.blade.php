@extends('Admin.layouts.master')

@push('title')
New Born Baby Passport
@endpush
@push('datatableCSS')
<!-- DataTables -->
<link href="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/admin/plugins/datatables/buttons.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/admin/plugins/datatables/fixedHeader.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/admin/plugins/datatables/responsive.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/admin/plugins/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/admin/plugins/datatables/scroller.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
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
                    <h4 class="pull-left page-title">Search Result For New Born Baby Passport:</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ route('admin.dashboard') }}">Admin Panel</a></li>
                        <li class="active">New Born Baby Passport</li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <span class="panel-title">New Born Baby Passports Table
                        <!-- Button trigger modal for adding new Category -->

                    </div>
                    <div class="panel-body">
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
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
                                @foreach ($newBornBabyPassports as $key => $newBornBabyPassport)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $newBornBabyPassport->name }} {{ $newBornBabyPassport->last_name }}</td>
                                    <td>{{ $newBornBabyPassport->civil_id }}</td>
                                    <td>{{ $newBornBabyPassport->passport_number }}</td>
                                    <td>{{ $newBornBabyPassport->new_mrp_passport_no }}</td>
                                    <td>{{ $newBornBabyPassport->bio_enrollment_id }}</td>
                                    <td>{{ $newBornBabyPassport->bd_phone }}</td>
                                    <td>{{ $newBornBabyPassport->ems }}</td>
                                    <td>{{ $newBornBabyPassport->created_at ? $newBornBabyPassport->created_at->diffForHumans() : ''}}</td>
                                    <td style="width: 150px">
                                        <a href="{{ route('admin.newBornBabyPassport.receipt',$newBornBabyPassport->id) }}" target="_blank" class="btn btn-success"><i class="fa fa-print"></i>Receipt</a>
                                        <a href="{{ route('admin.newBornBabyPassport.sticker',$newBornBabyPassport->id) }}" target="_blank" class="btn btn-warning"><i class="fa fa-print"></i>Sticker</a>
                                        <a href="{{ route('admin.newBornBabyPassport.show',$newBornBabyPassport->id) }}" target="_blank" class="btn btn-primary"><i class="fa fa-eye"></i></a>

                                        <a href="{{ route('admin.newBornBabyPassport.edit',$newBornBabyPassport) }}" class="btn btn-info"><i class="fa fa-edit"></i></a>

                                        <button class="btn btn-danger" onclick="delete_function(this)" value="{{ route('admin.newBornBabyPassport.destroy',$newBornBabyPassport) }}"><i class="fa fa-trash"></i> </button>

                                        <a href="{{ route('admin.serviceAddOn',[$newBornBabyPassport->id,"new-born-baby-passport"]) }}"
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
<script src="{{ asset('assets/admin/plugins/datatables/dataTables.scroller.min.js') }}"></script>
<!-- Datatable init js -->
<script src="{{ asset('assets/admin/pages/datatables.init.js') }}"></script>
@endpush
