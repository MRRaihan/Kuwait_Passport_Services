@extends('BranchManager.layouts.master')

@push('title')
Manual Passport Table
@endpush
@push('datatableCSS')
<!-- DataTables -->
<link href="{{ asset('assets/branch-manager/plugins/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/branch-manager/plugins/datatables/buttons.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/branch-manager/plugins/datatables/fixedHeader.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/branch-manager/plugins/datatables/responsive.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/branch-manager/plugins/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/branch-manager/plugins/datatables/scroller.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
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
                    <h4 class="pull-left page-title">User Lost Passport</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ route('branchManager.dashboard') }}">Branch Manager Panel</a></li>
                        <li class="active">User Manual Passport</li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-body row">
                        <div class="col-md-4">
                            <form class="form-group" method="POST" action="{{ route('branchManager.lostPassport.search_by_civil') }}">
                                @csrf
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputEmail3" placeholder="Search by Civil ID" name="civil_id">
                                </div>
                                <button type="submit" class="col-sm-3 btn btn-success">Search</button>
                            </form>
                        </div>
                        <div class="col-md-4">
                            <form class="form-group" method="POST" action="{{ route('branchManager.lostPassport.search_by_passport_number') }}">
                                @csrf
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="passport_number" placeholder="Search by MRP Passport No." name="passport_number">
                                </div>
                                <button type="submit" class="col-sm-3 btn btn-success">Search</button>
                            </form>
                        </div>
                        <div class="col-md-4">
                            <form class="form-group" method="POST" action="{{ route('branchManager.lostPassport.search_by_new_mrp_passport_no') }}">
                                @csrf
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="new_mrp_passport_no" placeholder="Search by New MRP Passport No." name="new_mrp_passport_no">
                                </div>
                                <button type="submit" class="col-sm-3 btn btn-success">Search</button>
                            </form>
                        </div>
                        <div class="col-md-4">
                            <form class="form-group" method="POST" action="{{ route('branchManager.lostPassport.search_by_bio_enrollment_id') }}">
                                @csrf
                                <div class="col-sm-9">
                                <input type="text" class="form-control" id="bio_enrollment_id" placeholder="Search by Bio Enrollment ID" name="bio_enrollment_id">
                                </div>
                                <button type="submit" class="col-sm-3 btn btn-success">Search</button>
                            </form>
                        </div>
                    </div> <!-- panel-body -->
                </div> <!-- panel -->
            </div> <!-- col -->
        </div> <!-- End row -->

        {{-- <div class="row text-right">
            <div class="col-sm-12">

                <a class="btn btn-success btn-sm" href="{{ route('branchManager.lostPassport.createSecond') }}" style="float: right; margin-bottom: 10px;" ><i class=" fa fa-plus"></i>&nbsp;Add New Manual Passport</a>
            </div>
        </div> --}}

        <div class="row mt-5">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading" style="background-color: #01ba9a !important;">
                        <span class="panel-title">User Manual Passports List
                        <!-- Button trigger modal for adding new Category -->

                    </div>
                    <div class="panel-body">
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#SL</th>
                                    <th>Name</th>
                                    <th>MRP Passport Number</th>
                                    <th>New MRP Passport Number</th>
                                    <th>Bio Enrollment ID</th>
                                    <th>Civil ID</th>
                                    <th>Phone</th>
                                    <th>Time</th>

                                    <th>Status</th>
                                    <th style="width: 150px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lostPassports as $key => $lostPassport)
                                <tr @if($lostPassport->is_shifted_to_branch_manager != null) style="background-color: #787471; color:white;" @endif>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $lostPassport->name }} {{ $lostPassport->last_name }}</td>
                                    <td>{{ $lostPassport->passport_number }}</td>
                                    <td>{{ $lostPassport->new_mrp_passport_no }}</td>
                                    <td>{{ $lostPassport->bio_enrollment_id }}</td>
                                    <td>{{ $lostPassport->civil_id }}</td>
                                    <td>{{ $lostPassport->bd_phone }}</td>
                                    <td>{{ $lostPassport->created_at->diffForHumans() }}</td>
                                    <td>
                                        @if ($lostPassport->embassy_status >= 1)
                                        <span class="badge badge-pill badge-success">Passport Processing</span>
                                        @elseif ($lostPassport->shift_to_admin == 1)
                                        <span class="badge badge-pill badge-success">Shifted To Admin</span>
                                        @else
                                        <span class="badge badge-pill badge-warning">Pending Shift</span>
                                        @endif
                                    </td>
                                    <td style="width: 150px">
                                        <a href="{{ route('branchManager.lostPassport.show',$lostPassport->id) }}" target="_blank" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                        <a href="{{ route('branchManager.userLostPassport.review',$lostPassport->id) }}" class="btn btn-info"><i class="fa fa-edit"></i>&nbsp;Review</a>

                                        <button class="btn btn-danger" onclick="delete_function(this)" value="{{ route('branchManager.lostPassport.destroy',$lostPassport) }}"><i class="fa fa-trash"></i> </button>
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
    function dismissComplain(objButton) {
        var url = objButton.value;
        // alert(objButton.value)
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Dismiss !'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: 'POST',
                    url: url,
                    headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    ,},
                    success: function(data) {
                        if (data.type == 'success') {
                                Swal.fire(
                                'Dismissed !',
                                data.message,
                                data.type
                                )
                                setTimeout(function() {
                                    location.reload();
                                }, 800); //
                            } else {
                                Swal.fire(
                                'Wrong !',
                                'Something going wrong. ' + data.message,
                                'warning'
                                )
                            }
                    }
                ,})
            }
        })
    }
</script>
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
