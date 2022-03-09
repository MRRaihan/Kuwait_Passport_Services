@extends('Admin.layouts.master')

@push('title')
    All Other Services Report
@endpush

@section('content')
    <div class="content">
        <div class="container">

            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-header-title">
                        <h4 class="pull-left page-title">Reports</h4>
                        <ol class="breadcrumb pull-right">
                            <li><a href="{{ route('admin.dashboard') }}">Admin Panel</a></li>
                            <li class="active">Reports</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row text-left">
                <div class="panel bg-info">
                    <h4 class="pull-left page-title" style="color: white">&nbsp;&nbsp;Date Wise All Other Services Report
                    </h4>
                    <div class="clearfix"></div>
                </div>

                <div class="col-sm-12">

                    <div class="col-md-3">
                        <label for="from_date">From</label>
                        <input type="date" name="from_date" id="from_date" class="form-control">
                    </div>

                    <div class="col-md-3">
                        <label for="to_date">To</label>
                        <input type="date" name="to_date" id="to_date" class="form-control">
                    </div>

                    <div class="col-md-3">
                        <label for="branch">Branch</label>
                        <select class="form-control" name="branch_id" id="branch_id">
                            <option value="0">&nbsp;&nbsp;&nbsp;&nbsp;All Branch</option>
                            @if (isset($branches[0]))
                                @foreach ($branches as $key => $branch)
                                    <option value="{{ $branch->id }}" {{ $branch->id == $branch_id ? 'selected' : '' }}>
                                        &nbsp;&nbsp;&nbsp;&nbsp;{{ $branch->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="date">Service Type</label>
                        <select class="form-control" name="option_id" id="option_id">
                            <option value="-1">&nbsp;&nbsp;&nbsp;&nbsp;All Services</option>
                            @if (otherServiesOptions()[0])
                                @foreach (otherServiesOptions() as $key => $service)
                                    <option value="{{ $key }}">&nbsp;&nbsp;&nbsp;&nbsp;{{ $service }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="col-md-2" style="margin-top: 25px;">
                        <a class="btn btn-primary btn-md btn-block text-white" onclick="otherServicesReport()"><i
                                class="fa fa-search"></i>&nbsp;View Report</a>
                    </div>
                </div>
            </div>


            <br>
            <div class="row" style="margin-top: 50px;">

                <div class="panel bg-info">
                    <h4 class="pull-left page-title" style="color: white;">&nbsp;&nbsp;View Report</h4>
                    <div class="clearfix"></div>
                </div>

                <div class="col-md-10 col-md-offset-4">
                    <div class="row">
                        <div class="col-md-3" style="margin-bottom: 10px;">
                            <label for="branch">Branch Wise Search</label>
                            <select class="form-control" name="branch_id_search" id="branch_id_search"
                                onchange="openLink('{{ url('admin/all-other-services-report') }}/'+$('#branch_id_search').val())">
                                <option value="0">&nbsp;&nbsp;&nbsp;&nbsp;All Branch</option>
                                @if (isset($branches[0]))
                                    @foreach ($branches as $key => $branch)

                                        <option value="{{ $branch->id }}"
                                            {{ $branch->id == $branch_id ? 'selected' : '' }}>
                                            &nbsp;&nbsp;&nbsp;&nbsp;{{ $branch->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </div>


                <div class="col-sm-6 col-lg-5 col-md-offset-1">
                    <div class="panel panel-primary text-center">
                        <div class="panel-heading bg-info">
                            <h4 class="panel-title">Total Services</h4>
                        </div>
                        <div class="panel-body">
                            <h3 class=""><b>{{ $total_services }}</b></h3>
                            {{-- <p class="text-muted"><b><a href="{{ route('admin.renewPassport.index') }}" target="__blank">View All</a></b></p> --}}
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-5">
                    <div class="panel panel-primary text-center">
                        <div class="panel-heading bg-success">
                            <h4 class="panel-title">Total Service Fees</h4>
                        </div>
                        <div class="panel-body">
                            <h3 class=""><b>{{ $total_service_fee }}</b></h3>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-6 col-lg-12">
                        <div class="panel panel-primary text-center">
                            <div class="panel-heading bg-info">
                                <h4 class="panel-title">Total All Services</h4>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-6 col-lg-2 col-md-offset-1">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading panel-bg-default">
                                                <h4 class="panel-title">Total Premier Services</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{ $total_premier_services }}</b></h3>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-lg-2">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading panel-bg-default">
                                                <h4 class="panel-title">Total Express Services</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{ $total_express_services }}</b></h3>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-lg-2">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading panel-bg-default">
                                                <h4 class="panel-title">Total Legal Services</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{ $total_legal_services }}</b></h3>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-sm-6 col-lg-2">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading panel-bg-default" >
                                                <h4 class="panel-title">Total Immigration Services</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{ $total_immigration_services }}</b></h3>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-sm-6 col-lg-2">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading panel-bg-default" >
                                                <h4 class="panel-title">Total Other Services</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{ $total_other_service }}</b></h3>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

               




                <div class="row">
                    <div class="col-sm-6 col-lg-12">
                        <div class="panel panel-primary text-center">
                            <div class="panel-heading bg-info">
                                <h4 class="panel-title">Mothly All Services</h4>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-6 col-lg-2 col-md-offset-1">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading panel-bg-default">
                                                <h4 class="panel-title">Monthly Premier Services</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{ $monthly_premier_service }}</b></h3>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-lg-2 ">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading panel-bg-default">
                                                <h4 class="panel-title">Monthly Express Services</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{ $monthly_express_service }}</b></h3>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-lg-2">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading panel-bg-default">
                                                <h4 class="panel-title">Monthly Legal Services</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{ $monthly_legal_service }}</b></h3>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-sm-6 col-lg-2">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading panel-bg-default">
                                                <h4 class="panel-title">Monthly Immigration Services</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{ $monthly_immigration_service }}</b>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="col-sm-6 col-lg-2">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading panel-bg-default">
                                                <h4 class="panel-title">Monthly Other Services</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{ $monthly_other_service }}</b></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6 col-lg-12">
                    <div class="panel panel-primary text-center">
                        <div class="panel-heading bg-info">
                            <h4 class="panel-title">Daily All Services</h4>
                        </div>
                        <div class="panel-body">
                            <div class="row">

                                <div class="col-sm-6 col-lg-2 col-md-offset-1">
                                    <div class="panel panel-default text-center">
                                        <div class="panel-heading panel-bg-default">
                                            <h4 class="panel-title">Daily Premier Services</h4>
                                        </div>
                                        <div class="panel-body">
                                            <h3 class=""><b>{{ $daily_premier_service }}</b></h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-lg-2 ">
                                    <div class="panel panel-default text-center">
                                        <div class="panel-heading panel-bg-default">
                                            <h4 class="panel-title">Daily Express Services</h4>
                                        </div>
                                        <div class="panel-body">
                                            <h3 class=""><b>{{ $daily_express_service }}</b></h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-lg-2 ">
                                    <div class="panel panel-default text-center">
                                        <div class="panel-heading panel-bg-default">
                                            <h4 class="panel-title">Daily Legal Services</h4>
                                        </div>
                                        <div class="panel-body">
                                            <h3 class=""><b>{{ $daily_legal_service }}</b></h3>
                                        </div>
                                    </div>
                                </div>



                                <div class="col-sm-6 col-lg-2 ">
                                    <div class="panel panel-default text-center">
                                        <div class="panel-heading panel-bg-default">
                                            <h4 class="panel-title">Daily Immigration Services</h4>
                                        </div>
                                        <div class="panel-body">
                                            <h3 class=""><b>{{ $daily_immigration_service }}</b></h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-lg-2 ">
                                    <div class="panel panel-default text-center">
                                        <div class="panel-heading panel-bg-default">
                                            <h4 class="panel-title">Daily Other Services</h4>
                                        </div>
                                        <div class="panel-body">
                                            <h3 class=""><b>{{ $daily_other_service }}</b></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-sm-6 col-lg-12">
                    <div class="panel panel-primary text-center">
                        <div class="panel-heading bg-info">
                            <h4 class="panel-title">Other Services Fee</h4>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-4 ">
                                    <div class="panel panel-primary ">
                                        <div class="panel-body">
                                            <h4 class="m-t-0"> Premier Services Fee</h4>
                                            <ul class="list-inline m-t-30 widget-chart text-center">
                                                <li>
                                                    <i class="mdi mdi-arrow-up-bold-circle text-success"></i>
                                                    <h4 class="">
                                                        <b>{{ $total_premier_service_fee }}</b>
                                                    </h4>
                                                    <h5 class="text-muted m-b-0">Total fee</h5>
                                                </li>
                                                <li>
                                                    <i class="mdi mdi-arrow-down-bold-circle text-danger"></i>
                                                    <h4 class=""><b>{{ $monthly_premier_fee }}</b>
                                                    </h4>
                                                    <h5 class="text-muted m-b-0">Monthly</h5>
                                                </li>
                                                <li>
                                                    <i class="mdi mdi-arrow-up-bold-circle text-success"></i>
                                                    <h4 class=""><b>{{ $daily_premier_fee }}</b></h4>
                                                    <h5 class="text-muted m-b-0">Daily</h5>
                                                </li>
                                            </ul>
                                            <div id="sparkline3" style="margin: 0 -21px -22px -22px;"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-4">
                                    <div class="panel panel-primary">
                                        <div class="panel-body">
                                            <h4 class="m-t-0">Express Services Fee</h4>
                                            <ul class="list-inline m-t-30 widget-chart text-center">
                                                <li>
                                                    <i class="mdi mdi-arrow-up-bold-circle text-success"></i>
                                                    <h4 class="">
                                                        <b>{{ $total_express_service_fee }}</b>
                                                    </h4>
                                                    <h5 class="text-muted m-b-0">Total Fee</h5>
                                                </li>
                                                <li>
                                                    <i class="mdi mdi-arrow-down-bold-circle text-danger"></i>
                                                    <h4 class=""><b>{{ $monthly_express_fee }}</b>
                                                    </h4>
                                                    <h5 class="text-muted m-b-0">Monthly</h5>
                                                </li>
                                                <li>
                                                    <i class="mdi mdi-arrow-up-bold-circle text-success"></i>
                                                    <h4 class=""><b>{{ $daily_express_fee }}</b></h4>
                                                    <h5 class="text-muted m-b-0">Daily</h5>
                                                </li>
                                            </ul>
                                            <div id="sparkline2" style="margin: 0 -21px -22px -22px;"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-4">
                                    <div class="panel panel-primary">
                                        <div class="panel-body">
                                            <h4 class="m-t-0">Legal Services Fee</h4>
                                            <ul class="list-inline m-t-30 widget-chart text-center">
                                                <li>
                                                    <i class="mdi mdi-arrow-up-bold-circle text-success"></i>
                                                    <h4 class=""><b>{{ $total_legal_service_fee }}</b>
                                                    </h4>
                                                    <h5 class="text-muted m-b-0">Total Fee</h5>
                                                </li>
                                                <li>
                                                    <i class="mdi mdi-arrow-down-bold-circle text-danger"></i>
                                                    <h4 class=""><b>{{ $monthly_legal_fee }}</b></h4>
                                                    <h5 class="text-muted m-b-0">Monthly</h5>
                                                </li>
                                                <li>
                                                    <i class="mdi mdi-arrow-up-bold-circle text-success"></i>
                                                    <h4 class=""><b>{{ $daily_legal_fee }}</b></h4>
                                                    <h5 class="text-muted m-b-0">Daily</h5>
                                                </li>
                                            </ul>
                                            <div id="sparkline1" style="margin: 0 -21px -22px -22px;"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-4">
                                    <div class="panel panel-primary">
                                        <div class="panel-body ">
                                            <h4 class="m-t-0">Immigration Services Fee</h4>
                                            <ul class="list-inline m-t-30 widget-chart text-center">
                                                <li>
                                                    <i class="mdi mdi-arrow-up-bold-circle text-success"></i>
                                                    <h4 class="">
                                                        <b>{{ $total_immigration_service_fee }}</b>
                                                    </h4>
                                                    <h5 class="text-muted m-b-0">Total Fee</h5>
                                                </li>
                                                <li>
                                                    <i class="mdi mdi-arrow-down-bold-circle text-danger"></i>
                                                    <h4 class=""><b>{{ $monthly_immigration_fee }}</b>
                                                    </h4>
                                                    <h5 class="text-muted m-b-0">Monthly</h5>
                                                </li>
                                                <li>
                                                    <i class="mdi mdi-arrow-up-bold-circle text-success"></i>
                                                    <h4 class=""><b>{{ $daily_immigration_fee }}</b>
                                                    </h4>
                                                    <h5 class="text-muted m-b-0">Daily</h5>
                                                </li>
                                            </ul>
                                            <div id="sparkline3" style="margin: 0 -21px -22px -22px;"></div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-3 col-md-3 col-sm-4">
                                    <div class="panel panel-primary">
                                        <div class="panel-body ">
                                            <h4 class="m-t-0">Other Services Fee</h4>
                                            <ul class="list-inline m-t-30 widget-chart text-center">
                                                <li>
                                                    <i class="mdi mdi-arrow-up-bold-circle text-success"></i>
                                                    <h4 class=""><b>{{ $total_other_service_fee }}</b>
                                                    </h4>
                                                    <h5 class="text-muted m-b-0">Total Fee</h5>
                                                </li>
                                                <li>
                                                    <i class="mdi mdi-arrow-down-bold-circle text-danger"></i>
                                                    <h4 class=""><b>{{ $monthly_other_fee }}</b></h4>
                                                    <h5 class="text-muted m-b-0">Monthly</h5>
                                                </li>
                                                <li>
                                                    <i class="mdi mdi-arrow-up-bold-circle text-success"></i>
                                                    <h4 class=""><b>{{ $daily_other_fee }}</b></h4>
                                                    <h5 class="text-muted m-b-0">Daily</h5>
                                                </li>
                                            </ul>
                                            <div id="sparkline3" style="margin: 0 -21px -22px -22px;"></div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>






        </div>



    </div>
    </div> <!-- container -->
    </div> <!-- content -->

    <script>
        function openLink(link, type = '_parent') {
            window.open(link, type);
        }

        function otherServicesReport() {
            window.open("{{ url('admin/other-services-report') }}/" + $('#from_date').val() + "&" + $('#to_date').val() +
                "&" + $('#branch_id').val() + "&" + $('#option_id').val(), "_blank");
        }
    </script>


@endsection

@push('script')
    {{-- <script src="{{ asset('assets/admin/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script> --}}
    <script src="{{ asset('assets/admin/pages/dashborad.js') }}"></script>
@endpush
