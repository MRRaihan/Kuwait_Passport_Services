@extends('DataEnterer.layouts.master')

@push('title')
Manual Passport Table
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
                    <h4 class="pull-left page-title">Manual Passport</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ route('dataEnterer.dashboard') }}">Data Enterer Panel</a></li>
                        <li class="active">Manual Passport</li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        <!-- Inline Form -->
        @if($flag)
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">

                    <div class="panel-body row">

                        <div class="col-md-4">
                            <form class="form-group" method="POST" action="{{ route('dataEnterer.manualPassport.search_by_emirats') }}">
                                @csrf
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" id="inputEmail3" placeholder="Search by Emirats ID" name="emirats_id">
                                </div>
                                <button type="submit" class="col-sm-3 btn btn-success">Search</button>
                            </form>
                        </div>


                        <div class="col-md-4">
                            <form class="form-group" method="POST" action="{{ route('dataEnterer.manualPassport.search_by_passport_number') }}">
                                @csrf
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" id="passport_number" placeholder="Search by MRP Passport No." name="passport_number">
                                </div>
                                <button type="submit" class="col-sm-3 btn btn-success">Search</button>
                            </form>
                        </div>

                        <div class="col-md-4">
                            <form class="form-group" method="POST" action="{{ route('dataEnterer.manualPassport.search_by_profession') }}">
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
                @if($flag)
                <a class="btn btn-success btn-sm" href="{{ route('dataEnterer.manualPassport.createSecond') }}" style="float: right; margin-bottom: 10px;" ><i class=" fa fa-plus"></i>&nbsp;Add New Manual Passport</a>
                @endif
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading" style="background-color: #46bdc6 !important;">
                        <span class="panel-title">Manual Passports List
                        <!-- Button trigger modal for adding new Category -->

                    </div>
                    <div class="panel-body">
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>SL.</th>
                                    <th>Name</th>
                                    <th>Emirates ID</th>
                                    <th>Mobile</th>
                                    <th>EMS</th>
                                    <th>Time</th>

                                    <th>Status</th>
                                    <th style="width: 150px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($manualPassports as $manualPassport)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $manualPassport->name }} {{ $manualPassport->last_name }}</td>
                                    <td>{{ $manualPassport->emirates_id }}</td>
                                    <td>{{ $manualPassport->bd_phone }}</td>
                                    <td>{{ $manualPassport->ems }}</td>
                                    <td>{{ $manualPassport->created_at->diffForHumans() }}</td>
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

                                        <a href="{{ route('dataEnterer.manualPassport.receipt',$manualPassport->id) }}" target="_blank" class="btn btn-success"><i class="fa fa-print"></i>Receipt</a>

                                        <a href="{{ route('dataEnterer.manualPassport.sticker',$manualPassport->id) }}" target="_blank" class="btn btn-warning"><i class="fa fa-print"></i>Sticker</a>

                                        <a href="{{ route('dataEnterer.manualPassport.show',$manualPassport->id) }}" target="_blank" class="btn btn-primary"><i class="fa fa-eye"></i></a>

                                        <button class="btn btn-success" @if ($manualPassport->is_shifted_to_branch_manager != null) disabled @endif  onclick="shiftToBranchManagerNow(this)" value="{{ route('dataEnterer.manualPassport.shiftToBranchManagerNow', $manualPassport->id) }}">Shift to Branch Manager
                                            <i class="fa fa-external-link"></i>
                                        </button>

                                        <a href="{{ route('dataEnterer.manualPassport.edit',$manualPassport) }}" class="btn btn-info"><i class="fa fa-edit"></i></a>

                                        <a href="{{ route('dataEnterer.serviceAddOn',[$manualPassport->id,"manual-passport"]) }}"
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
<script>
    function shiftToBranchManagerNow(objButton) {
     var url = objButton.value;
     // alert(objButton.value)
     Swal.fire({
         title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, Shift !'
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
                            'Shifted !',
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
