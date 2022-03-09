@extends('Admin.layouts.master')

@push('title')
Manual Passport Table
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
                    <h4 class="pull-left page-title">Manual Passport</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ route('admin.dashboard') }}">Admin Panel</a></li>
                        <li class="active">Manual Passport</li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        @if ($flag != 0)
        <!-- Inline Form -->
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">

                    <div class="panel-body row">

                        <div class="col-md-4">
                            <form class="form-group" method="POST" action="{{ route('admin.manualPassport.search_by_emirats') }}">
                                @csrf
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" id="inputEmail3" placeholder="Search by Emirats ID" name="emirats_id">
                                </div>
                                <button type="submit" class="col-sm-3 btn btn-success">Search</button>
                            </form>
                        </div>


                        <div class="col-md-4">
                            <form class="form-group" method="POST" action="{{ route('admin.manualPassport.search_by_passport_number') }}">
                                @csrf
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" id="inputEmail3" placeholder="Search by MRP Passport No." name="passport_number">
                                </div>
                                <button type="submit" class="col-sm-3 btn btn-success">Search</button>
                            </form>
                        </div>


                        <div class="col-md-4">
                            <form class="form-group" method="POST" action="{{ route('admin.manualPassport.search_by_profession') }}">
                                @csrf
                                <div class="col-sm-9">
                                  <select class="form-control" name="profession_id">
                                      <option selected disabled>Search By Profession</option>
                                      @foreach ($professions as $data)
                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                      @endforeach
                                  </select>
                                </div>
                                <button type="submit" class="col-sm-3 btn btn-success">Search</button>
                            </form>
                        </div>

                    </div> <!-- panel-body -->
                </div> <!-- panel -->
            </div> <!-- col -->

        </div> <!-- End row -->
        @endif


        <div class="row text-right">
            <div class="col-sm-12">
                @if($flag!=0)
                <a class="btn btn-success btn-sm" href="{{ route('admin.manualPassport.createSecond') }}" style="float: right; margin-bottom: 10px;" ><i class=" fa fa-plus"></i>&nbsp;Add New Manual Passport</a>
                @endif
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <span class="panel-title">Manual Passports Table
                        <!-- Button trigger modal for adding new Category -->

                    </div>
                    <div class="panel-body">
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>SL.</th>
                                    <th>Name</th>
                                    <th>MRP Passport Number</th>
                                    <th>Emirates ID</th>
                                    <th>Kuwait Phone</th>
                                    <th>Total Fee</th>
                                    <th>EMS</th>
                                    <th>Profession</th>
                                    <th>Status</th>
                                    <th style="width: 150px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($manualPassports as $manualPassport)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $manualPassport->name }}</td>
                                    <td>{{ $manualPassport->passport_number }}</td>
                                    <td>{{ $manualPassport->emirates_id }}</td>
                                    <td>{{ $manualPassport->uae_phone }}</td>
                                    <td>{{ $manualPassport->passport_type_fees_total }}</td>
                                    <td>{{ $manualPassport->ems }}</td>
                                    <td>{{ $manualPassport->profession->name }}</td>
                                    <td>
                                        @if ($manualPassport->branch_status == 3)
                                            <span class="badge badge-pill badge-success">Delivered</span>
                                        @elseif($manualPassport->embassy_status >= 1)
                                            <span class="badge badge-pill badge-warning">Passport Processing</span>
                                            @else
                                            <span class="badge badge-pill badge-danger">Pending Shift</span>
                                        @endif
                                    </td>
                                    <td style="width: 150px">

                                        <a href="{{ route('admin.manualPassport.receipt',$manualPassport->id) }}" target="_blank" class="btn btn-success"><i class="fa fa-print"></i>Receipt</a>

                                        <a href="{{ route('admin.manualPassport.sticker',$manualPassport->id) }}" target="_blank" class="btn btn-warning"><i class="fa fa-print"></i>Sticker</a>

                                        <a href="{{ route('admin.manualPassport.show',$manualPassport->id) }}" target="_blank" class="btn btn-primary"><i class="fa fa-eye"></i></a>

                                        <a href="{{ route('admin.manualPassport.edit',$manualPassport) }}" class="btn btn-info"><i class="fa fa-edit"></i></a>

                                        <button class="btn btn-danger" onclick="delete_function(this)" value="{{ route('admin.manualPassport.destroy',$manualPassport) }}"><i class="fa fa-trash"></i> </button>

                                        <a href="{{ route('admin.serviceAddOn',[$manualPassport->id,"manual-passport"]) }}"
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
