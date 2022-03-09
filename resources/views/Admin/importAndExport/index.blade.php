@extends('Admin.layouts.master')

@push('title')
    Import Export
@endpush
@push('datatableCSS')
    <!-- DataTables -->
    <link href="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/admin/plugins/datatables/buttons.bootstrap.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/admin/plugins/datatables/fixedHeader.bootstrap.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/admin/plugins/datatables/responsive.bootstrap.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/admin/plugins/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/admin/plugins/datatables/scroller.bootstrap.min.css') }}" rel="stylesheet"
        type="text/css" />
@endpush
@section('content')

    <style>
        td,
        th {
            text-align: center;
        }
        .error-table{
            line-height: 25px;
            color: red !important;
        }
        .error-msg{
            padding-left: 18px;
        }
        .errors_container{
            height: 700px;
            overflow: scroll;
            overflow-x: hidden;
            background-color: rgba(0, 0, 0, 0.247);
            color: red !important;
            padding-left: 40px;
            padding-top: 20px;
            border: 10px !important;
        }
        .errors_container table td{
            color: red !important;

        }
    </style>

    <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-header-title">
                        <h4 class="pull-left page-title">Data Import/Export</h4>
                        <ol class="breadcrumb pull-right">
                            <li><a href="{{ route('admin.dashboard') }}">Admin Panel</a></li>
                            <li class="active">import/export</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-lg-10">
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Lost Passport</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form class="form-inline" action="{{ route('admin.lostPassportImport') }}" method="POST" role="form" enctype="multipart/form-data">
                                                @csrf

                                                <div class="form-group m-l-10">
                                                    <label class="sr-only" for="exampleInputPassword2">Password</label>
                                                    <input type="file" name="lost_passport" class="form-control" id="exampleInputPassword2" placeholder="Password">

                                                </div>

                                                <button type="submit" class="btn btn-warning waves-effect waves-light m-l-10"><i class="ion-ios7-cloud-upload-outline"></i> Import</button>

                                                <a href="{{ route('admin.lostPassportExportDownlode') }}" class="btn btn-success waves-effect waves-light m-l-10"><i class="ion-ios7-cloud-download-outline"></i> Export</a>

                                            </form>
                                        </div>

                                        <div class="col-md-12 P-2">
                                            @error('lost_passport')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Manual Passport </h3>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form class="form-inline" action="{{ route('admin.ManualPassportImport') }}" method="POST" role="form" enctype="multipart/form-data">
                                                @csrf

                                                <div class="form-group m-l-10">
                                                    <label class="sr-only" for="exampleInputPassword2">Password</label>
                                                    <input type="file" name="manual_passport" class="form-control" id="exampleInputPassword2" placeholder="Password">

                                                </div>

                                                <button type="submit" class="btn btn-warning waves-effect waves-light m-l-10"><i class="ion-ios7-cloud-upload-outline"></i> Import</button>

                                                <a href="{{ route('admin.ManualPassportExportDownlode') }}" class="btn btn-success waves-effect waves-light m-l-10"><i class="ion-ios7-cloud-download-outline"></i> Export</a>

                                            </form>
                                        </div>

                                        <div class="col-md-12 P-2">
                                            @error('manual_passport')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Renew Passport</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form class="form-inline" action="{{ route('admin.RenewPassportImport') }}" method="POST" role="form" enctype="multipart/form-data">
                                                @csrf

                                                <div class="form-group m-l-10">
                                                    <label class="sr-only" for="exampleInputPassword2">Password</label>
                                                    <input type="file" name="renew_passport" class="form-control" id="exampleInputPassword2" placeholder="Password">

                                                </div>

                                                <button type="submit" class="btn btn-warning waves-effect waves-light m-l-10"><i class="ion-ios7-cloud-upload-outline"></i> Import</button>

                                                <a href="{{ route('admin.RenewPassportExportDownlode') }}" class="btn btn-success waves-effect waves-light m-l-10"><i class="ion-ios7-cloud-download-outline"></i> Export</a>

                                            </form>
                                        </div>

                                        <div class="col-md-12 P-2">
                                            @error('renew_passport')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">New Born baby Passport</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form class="form-inline" action="{{ route('admin.babyPassportImport') }}" method="POST" role="form" enctype="multipart/form-data">
                                                @csrf

                                                <div class="form-group m-l-10">
                                                    <label class="sr-only" for="exampleInputPassword2">Password</label>
                                                    <input type="file" name="baby_passport" class="form-control" id="exampleInputPassword2" placeholder="Password">

                                                </div>

                                                <button type="submit" class="btn btn-warning waves-effect waves-light m-l-10"><i class="ion-ios7-cloud-upload-outline"></i> Import</button>

                                                <a href="{{ route('admin.babyPassportExportDownlode') }}" class="btn btn-success waves-effect waves-light m-l-10"><i class="ion-ios7-cloud-download-outline"></i> Export</a>

                                            </form>
                                        </div>

                                        <div class="col-md-12 P-2">
                                            @error('baby_passport')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Other Services</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form class="form-inline" action="{{ route('admin.OtherServiceImport') }}" method="POST" role="form" enctype="multipart/form-data">
                                                @csrf

                                                <div class="form-group m-l-10">
                                                    <label class="sr-only" for="exampleInputPassword2">Password</label>
                                                    <input type="file" name="other_service" class="form-control" id="exampleInputPassword2" placeholder="Password">

                                                </div>

                                                <button type="submit" class="btn btn-warning waves-effect waves-light m-l-10"><i class="ion-ios7-cloud-upload-outline"></i> Import</button>

                                                <a href="{{ route('admin.OtherServiceExportDownlode') }}" class="btn btn-success waves-effect waves-light m-l-10"><i class="ion-ios7-cloud-download-outline"></i> Export</a>

                                            </form>
                                        </div>

                                        <div class="col-md-12 P-2">
                                            @error('other_service')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 py-5">

                    @if (isset($errors) && $errors->any())
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach


                    @endif

                    @if (session() ->has('error'))
                    <div class="errors_container">
                        {{ session() ->get('error') }}
                    </div>
                    @endif
                    @if (session() ->has ('failures'))
                    <div class="errors_container">
                        @foreach (session()->get ('failures') as $validation)
                        <table class="error-table">

                            <tr>
                                <td><i class="fa fa-exclamation-triangle py-5" aria-hidden="true"></i> Row ({{ $validation->row() }})</td>
                                <td class="error-msg">

                                        @foreach ($validation->errors () as $e)
                                             {{ $e }}

                                        @endforeach

                                </td>
                                {{-- <td>
                                {{ $validation->values () [$validation->attribute()]}}
                                </td> --}}
                            </tr>
                        </table>
                        @endforeach
                    </div>
                     @endif
                </div>
            </div> <!-- End Row -->
        </div> <!-- container -->
    </div> <!-- content -->

    @if (session()->has('success'))
    <script type="text/javascript">
        $(document).ready(function() {
            // notify('{{ session()->get('success') }}','success');
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: '{{ Session::get('success') }}',
                showConfirmButton: false,
                timer: 1500
            })
        });
    </script>
    @endif
    @if (session() ->has('error'))
    <script type="text/javascript">
        $(document).ready(function() {
            // notify('{{ session()->get('success') }}','success');
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Here is some Problem in file',
                showConfirmButton: false,
                timer: 1500
            })
        });
    </script>
    @endif


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
