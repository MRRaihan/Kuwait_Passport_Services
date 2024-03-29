@extends('Admin.layouts.master')

@push('title')
    Immigration Government Service
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
    </style>

    <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-header-title">
                        <h4 class="pull-left page-title">Immigration Government Service</h4>
                        <ol class="breadcrumb pull-right">
                            <li><a href="{{ route('admin.dashboard') }}">Admin Panel</a></li>
                            <li class="active">Immigration Government Service</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row text-right">
                <div class="col-sm-12">
                    @if ($flag != 0)
                    <a class="btn btn-success btn-sm" href="{{ route('admin.immigrationGovementService.create') }}"
                        style="float: right; margin-bottom: 10px;"><i class=" fa fa-plus"></i>&nbsp;Add New
                        Service</a>
                    @endif
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <span class="panel-title">Immigration Government Service Table
                                <!-- Button trigger modal for adding new Category -->

                        </div>
                        <div class="panel-body">
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                            cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>SL.</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Taken Services</th>
                                    <th>Total Cost</th>
                                    <th>Time</th>

                                    <th style="width: 150px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($takenImmigrationService as $key => $immigrationService)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $immigrationService->name }} {{ $immigrationService->last_name }}</td>
                                <td>{{ $immigrationService->kuwait_phone }}</td>
                                <td>
                                    @foreach (json_decode($immigrationService->service_taken) as $item)
                                    <span class="badge badge-primary">{{ get_other_service_fee_name_by_id($item) }}</span>
                                @endforeach
                                </td>
                                <td>{{ $immigrationService->total_fee }}</td>
                                <td>{{ \Carbon\Carbon::parse($immigrationService->created_at)->format('Y-m-d') }}</td>
                                <td style="width: 150px">

                                    <a href="{{ route('admin.immigrationGovementService.show',$immigrationService->id) }}"
                                        target="_blank" class="btn btn-primary"><i
                                            class="fa fa-eye"></i></a>


                                    <a href="{{ route('printReceipt',[$immigrationService->id,"Immigration_Services"]) }}" target="_blank" class="btn btn-success"><i class="fa fa-print"></i>Receipt</a>

                                    <a href="{{ route('printSticker',[$immigrationService->id,"Immigration_Services"]) }}" target="_blank" class="btn btn-info"><i class="fa fa-print"></i>Sticker</a>

                                    <button class="btn btn-danger" onclick="delete_function(this)" value="{{ route('admin.immigrationGovementService.destroy',$immigrationService) }}"><i class="fa fa-trash"></i> </button>
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
