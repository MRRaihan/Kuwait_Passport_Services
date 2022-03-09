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
                    <h4 class="pull-left page-title">Branch Manager</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ route('admin.dashboard') }}">Admin Panel</a></li>
                        <li class="active">Branch Manager</li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach($branchManagers as $key => $value)

                <div class="col-sm-4 col-lg-3">
                    <div class="panel panel-primary text-center">
                        @if($key%2 == 0)
                            <div class="panel-heading" style="background: rgba(96,183,54,0.82);">
                                <h4 class="panel-title">Branch Manager Profile</h4>
                            </div>
                        @else
                            <div class="panel-heading" style="background: rgb(79 96 71 / 82%);">
                                <h4 class="panel-title">Branch Manager Profile</h4>
                            </div>
                        @endif
                        <div class="panel-body">
                            <div class="user-details">
                                <div class="text-center" style="position: relative; z-index: 1">
                                    @if($value->image)
                                    <img src="{{asset($value->image) }}" alt="" class="img-circle">
                                    @else
                                    <img src="/uploads/images/setting/user.png" alt="" class="img-circle">
                                    @endif
                                </div>
                            </div>

                            <div class="user-info">
                                <p class="text-muted"><i class="fa fa-dot-circle-o text-success"></i>{{ $value->status == 1 ? 'Active' : 'InActive' }}</p>
                                <p class="text-muted"><i class="fa fa-user text-success"></i> Name : {{ $value->name }}</p>
                                <p class="text-muted"><i class="fa fa-envelope text-success"></i> Email: {{ $value->email }}</p>
                                <p class="text-muted"><i class="fa fa-phone text-success"></i> Phone: {{ $value->phone }}</p>
                                <hr>
                                <p>
                                    <a href="{{ route('admin.seeDataEntryData',$value->id) }}" class="btn btn-primary"><i class="fa fa-eye" title="View Profile"></i></a>

                                    @if ($value->status == 0)
                                        <button class="btn btn-success" onclick="activeNow(this)" value="{{ route('admin.branchManager.activeNow',$value->id) }}">
                                            <i class="mdi mdi-check"></i>
                                        </button>
                                        @elseif($value->status == 1)
                                        <button class="btn btn-danger" onclick="inactiveNow(this)" value="{{ route('admin.branchManager.inactiveNow',$value->id) }}">
                                            <i class="mdi mdi-close"></i>
                                        </button>
                                        @endif
                                    {{-- <a href="#" class="badge badge-danger"><i class="fa fa-eye" title="View Profile">View</i></a> --}}
                                </p>
                            </div>
                       </div>
                    </div>
                </div>
            @endforeach
        </div>

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
