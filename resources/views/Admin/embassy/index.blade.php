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
                    <h4 class="pull-left page-title">Embassy</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ route('admin.dashboard') }}">Admin Panel</a></li>
                        <li class="active">Embassy</li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        <div class="row text-right">
            <div class="col-sm-12">
                <a class="btn btn-success btn-sm" style="float: right; margin-bottom: 10px;" onclick="Show('New Embassy','{{ route('admin.embassy.create') }}')"><i class=" fa fa-plus"></i>&nbsp;New Embassy</a>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <span class="panel-title">Embassy List
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
                                    <th>Image</th>

                                    <th>Status</th>
                                    <th style="width: 150px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($embassys as $key => $data)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $data->name }} {{ $data->last_name }}</td>
                                    <td>{{ $data->phone }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td>
                                        <img src="{{ asset($data->image) }}" alt="" height="50" width="50" onerror="this.onerror=null;this.src='{{ asset(get_static_option('no_image')) }}';">
                                    </td>


                                    <td>
                                        @if($data->status == 1)
                                            <span class="badge badge-pill badge-success">Active</span>
                                        @else
                                            <span class="badge badge-pill badge-danger">InActive</span>
                                        @endif
                                    </td>
                                    <td style="width: 150px">

                                        @if ($data->status == 0)
                                            <button class="btn btn-success" onclick="activeNow(this)" value="{{ route('admin.embassy.activeNow', $data->id) }}">
                                                <i class="mdi mdi-check"></i>
                                            </button>
                                        @elseif($data->status == 1)
                                            <button class="btn btn-danger" onclick="inactiveNow(this)" value="{{ route('admin.embassy.inactiveNow', $data->id) }}">
                                                <i class="mdi mdi-close"></i>
                                            </button>
                                        @endif

                                        <a onclick="Show('{{ $data->name }} Edit','{{ route('admin.embassy.edit',$data->id) }}',)" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                        <button class="btn btn-danger" onclick="delete_function(this)" value="{{ route('admin.embassy.destroy',$data) }}"><i class="fa fa-trash"></i> </button>
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
