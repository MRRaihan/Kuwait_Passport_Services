@extends('BranchManager.layouts.master')

@push('title')
    User Renew Passport Table
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
                        <h4 class="pull-left page-title">User Renew Passports</h4>
                        <ol class="breadcrumb pull-right">
                            <li><a href="{{ route('branchManager.dashboard') }}">Branch Manager Panel</a></li>
                            <li class="active">Renew Passport</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <!-- Inline Form -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary">

                        <div class="panel-body row">

                            <div class="col-md-4">
                                <form class="form-group" method="POST" action="{{ route('branchManager.renewPassport.search_by_civil') }}">
                                    @csrf
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" id="inputEmail3" placeholder="Search by Civil ID" name="civil_id">
                                    </div>
                                    <button type="submit" class="col-sm-3 btn btn-success">Search</button>
                                </form>
                            </div>


                            {{-- <div class="col-md-4">
                                <form class="form-group" method="POST" action="{{ route('branchManager.renewPassport.search_by_ems') }}">
                                    @csrf
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" id="inputEmail3" placeholder="Search by EMS" name="ems">
                                    </div>
                                    <button type="submit" class="col-sm-3 btn btn-success">Search</button>
                                </form>
                            </div> --}}


                            <div class="col-md-4">
                                <form class="form-group" method="POST" action="{{ route('branchManager.renewPassport.search_by_profession') }}">
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



            {{-- <div class="row text-right">
                <div class="col-sm-12">
                    @if($flag!=0)
                    <a class="btn btn-success btn-sm" href="{{ route('branchManager.renewPassport.createSecond') }}"
                        style="float: right; margin-bottom: 10px;"><i class=" fa fa-plus"></i>&nbsp;Add New Renew
                        Passport</a>
                    @endif
                </div>
            </div> --}}

            <div class="row mt-5">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading" style="background-color: #01ba9a !important;">
                            <span class="panel-title">Renew Passports Table
                                <!-- Button trigger modal for adding new Category -->

                        </div>
                        <div class="panel-body">
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                                cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>SL.</th>
                                        <th>Name</th>
                                        <th>MRP Passport Number</th>
                                        <th>Kuwait Phone</th>
                                        <th>Total Fee</th>
                                        <th>Profession</th>
                                        <th>Status</th>
                                        <th style="width: 150px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($renewPassports[0]))

                                    @foreach ($renewPassports as $key => $renewPassport)
                                        <tr @if($renewPassport->is_shifted_to_branch_manager != null) style="background-color: #787471; color:white;" @endif>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $renewPassport->name }}</td>
                                            <td>{{ $renewPassport->passport_number }}</td>
                                            <td>{{ $renewPassport->kuwait_phone }}</td>
                                            <td>{{ $renewPassport->passport_type_fees_total }}</td>
                                            <td>{{ $renewPassport->profession ? $renewPassport->profession->name : '' }}</td>
                                            <td>
                                                @if ($renewPassport->status == 1)
                                                    <span class="badge badge-pill badge-success">Approved</span>
                                                @else
                                                    <span class="badge badge-pill badge-danger">Not Approved</span>
                                                @endif
                                            </td>
                                            <td style="width: 150px">

                                                <a href="{{ route('branchManager.renewPassport.show', $renewPassport->id) }}"
                                                    target="_blank" class="btn btn-primary"><i
                                                        class="fa fa-eye"></i></a>

                                                <a href="{{ route('branchManager.userRenewPassport.review', $renewPassport->id) }}"
                                                    class="btn btn-info"><i class="fa fa-edit"></i>&nbsp; Review</a>

                                                <button class="btn btn-danger" onclick="delete_function(this)"
                                                    value="{{ route('branchManager.renewPassport.destroy', $renewPassport) }}"><i
                                                        class="fa fa-trash"></i> </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @endif
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
