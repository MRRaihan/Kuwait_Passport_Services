@extends('Admin.layouts.master')

@push('title')
Admin
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
                    <h4 class="pull-left page-title">All Data Enterer</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ route('admin.dashboard') }}">Admin Panel</a></li>
                        <li class="active">Data Enterer</li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        {{-- <div class="row text-right">
            <div class="col-sm-12">
                <a class="btn btn-success btn-sm" style="float: right; margin-bottom: 10px;" onclick="Show('New Data Enterer','{{ route('admin.dataEnterer.create') }}')"><i class=" fa fa-plus"></i>&nbsp;New Data Enterer</a>
            </div>
        </div> --}}

        <div class="row mt-5">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <span class="panel-title">Data Enterer List</span>
                        <!-- Button trigger modal for adding new Category -->

                    </div>
                    <div class="panel-body">
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#SL</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Branch Manager</th>
                                    <th>Approval Status</th>
                                    <th>Action Status</th>
                                    <th style="width: 150px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataEnterers as $enterer)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $enterer->name }} {{ $enterer->last_name }}</td>
                                    <td>{{ $enterer->phone }}</td>
                                    <td>{{ $enterer->email }}</td>
                                    <td>{{ $enterer->parent->name ?? '' }}</td>
                                    <td>
                                        @if($enterer->status == 1)
                                            <span class="badge badge-pill badge-success">Approved</span>
                                        @else
                                            <span class="badge badge-pill badge-danger">Pending</span>
                                        @endif

                                            @if ($enterer->status != 1)
                                                <button class="btn btn-success" onclick="activeNow(this)" value="{{ route('admin.dataEnterer.activeNow', $enterer->id) }}">
                                                    <i class="mdi mdi-check"></i>
                                                </button>
                                            @else
                                                <button class="btn btn-danger" onclick="inactiveNow(this)" value="{{ route('admin.dataEnterer.inactiveNow', $enterer->id) }}">
                                                    <i class="mdi mdi-close"></i>
                                                </button>
                                            @endif
                                    </td>
                                    <td>
                                        @if($enterer->entry_status == 1)
                                            <span class="badge badge-pill badge-success">Active</span>
                                        @else
                                            <span class="badge badge-pill badge-danger">InActive</span>
                                        @endif

                                            @if ($enterer->entry_status != 1)
                                                <button class="btn btn-success" onclick="dataActiveNow(this)" value="{{ route('admin.dataEnterer.entryActiveNow', $enterer->id) }}">
                                                    <i class="mdi mdi-check"></i>
                                                </button>
                                            @else
                                                <button class="btn btn-danger" onclick="dataInactiveNow(this)" value="{{ route('admin.dataEnterer.entryInactiveNow', $enterer->id) }}">
                                                    <i class="mdi mdi-close"></i>
                                                </button>
                                            @endif
                                    </td>
                                    <td style="width: 150px">

                                        <a onclick="Show('{{ $enterer->name }} Edit','{{ route('admin.dataEnterer.edit',$enterer->id) }}',)" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                        <button class="btn btn-danger" onclick="delete_function(this)" value="{{ route('admin.dataEnterer.destroy',$enterer) }}"><i class="fa fa-trash"></i> </button>
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

<script>
    function dataActiveNow(objButton) {
        var url = objButton.value;
        // alert(objButton.value)
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Active !'
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    method: 'POST'
                    , url: url
                    , headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        , }
                    , success: function(data) {
                        if (data.type == 'success') {
                            Swal.fire(
                                'Activated !', 'This account has been Activated. ' + data.message, 'success'
                            )
                            setTimeout(function() {
                                location.reload();
                            }, 800); //
                        } else {
                            Swal.fire(
                                'Wrong !', 'Something going wrong. ' + data.message, 'warning'
                            )
                        }
                    }
                    , })
            }
        })
    }


    function dataInactiveNow(objButton) {
        var url = objButton.value;
        // alert(objButton.value)
        Swal.fire({
            title: 'Are you sure?'
            , text: "You won't be able to revert this!"
            , icon: 'warning'
            , showCancelButton: true
            , confirmButtonColor: '#3085d6'
            , cancelButtonColor: '#d33'
            , confirmButtonText: 'Yes, Inactive !'
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    method: 'POST'
                    , url: url
                    , headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        , }
                    , success: function(data) {
                        if (data.type == 'success') {
                            Swal.fire(
                                'Inactivated !', 'This account has been Inactivated. ' + data.message, 'success'
                            )
                            setTimeout(function() {
                                location.reload();
                            }, 800); //
                        } else {
                            Swal.fire(
                                'Wrong !', 'Something going wrong. ' + data.message, 'warning'
                            )
                        }
                    }
                    , })
            }
        })
    }


    function activeNow(objButton) {
     var url = objButton.value;
     // alert(objButton.value)
     Swal.fire({
         title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, Active !'
     }).then((result) => {
         if (result.isConfirmed) {

             $.ajax({
                 method: 'POST'
                 , url: url
                 , headers: {
                     'X-CSRF-TOKEN': "{{ csrf_token() }}"
                 , }
                 , success: function(data) {
                     if (data.type == 'success') {
                         Swal.fire(
                             'Activated !', 'This account has been Activated. ' + data.message, 'success'
                         )
                         setTimeout(function() {
                             location.reload();
                         }, 800); //
                     } else {
                         Swal.fire(
                             'Wrong !', 'Something going wrong. ' + data.message, 'warning'
                         )
                     }
                 }
             , })
         }
     })
 }

 function inactiveNow(objButton) {
     var url = objButton.value;
     // alert(objButton.value)
     Swal.fire({
         title: 'Are you sure?'
         , text: "You won't be able to revert this!"
         , icon: 'warning'
         , showCancelButton: true
         , confirmButtonColor: '#3085d6'
         , cancelButtonColor: '#d33'
         , confirmButtonText: 'Yes, Inactive !'
     }).then((result) => {
         if (result.isConfirmed) {

             $.ajax({
                 method: 'POST'
                 , url: url
                 , headers: {
                     'X-CSRF-TOKEN': "{{ csrf_token() }}"
                 , }
                 , success: function(data) {
                     if (data.type == 'success') {
                         Swal.fire(
                             'Inactivated !', 'This account has been Inactivated. ' + data.message, 'success'
                         )
                         setTimeout(function() {
                             location.reload();
                         }, 800); //
                     } else {
                         Swal.fire(
                             'Wrong !', 'Something going wrong. ' + data.message, 'warning'
                         )
                     }
                 }
             , })
         }
     })
 }

</script>

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
