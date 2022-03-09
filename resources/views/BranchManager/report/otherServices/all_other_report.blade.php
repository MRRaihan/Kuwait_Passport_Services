@extends('BranchManager.layouts.master')

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
                        <li><a href="{{ route('branchManager.dashboard') }}">Branch Manager</a></li>
                        <li class="active">Reports</li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        <div class="row text-left">
            <div class="panel bg-success">
                <h4 class="pull-left page-title" style="color: white">&nbsp;&nbsp;Date Wise All Other Services Report</h4>
                <div class="clearfix"></div>
            </div>

            <div class="col-sm-12">

                <div class="col-md-3">
                    <label for="from_date">From</label>
                    <input type="date" name="from_date" id="from_date"  class="form-control">
                </div>

                <div class="col-md-3">
                    <label for="to_date">To</label>
                    <input type="date" name="to_date" id="to_date"  class="form-control">
                </div>

                <div class="col-md-3">
                    <label for="date">Service Type</label>
                    <select class="form-control" name="option_id" id="option_id">
                        <option value="-1">&nbsp;&nbsp;&nbsp;&nbsp;All Services</option>
                        @if(otherServiesOptions()[0])
                        @foreach (otherServiesOptions() as $key => $service)
                            <option value="{{$key}}" >&nbsp;&nbsp;&nbsp;&nbsp;{{$service}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>

                <div class="col-md-2" style="margin-top: 25px;">
                    <a class="btn btn-primary btn-md btn-block text-white" onclick="otherServicesReport()"><i class="fa fa-search"></i>&nbsp;View Report</a>
                </div>
            </div>
        </div>

        <br><br>




        <div class="row" style="margin-top: 50px;">
            <div class="col-md-12">
                <div class="row">

                    <div class="col-md-12">
                        <div class="panel panel-color panel-danger">
                            <div class="panel-heading text-center" style="background: #01BA9A;">
                                <h3 class="panel-title">Total Other Services &amp; Fees</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">

                                    <div class="col-sm-6 col-lg-6">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading panel-bg-default">
                                                <h4 class="panel-title" style="color: #2a323c;">Total Services</h4>
                                            </div>
                                            <div class="panel-body panel-default">
                                                <h3 class=""><b>{{$totalServices}}</b></h3>

                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-sm-6 col-lg-6">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading panel-bg-default">
                                                <h4 class="panel-title" style="color: #2a323c;">Total Service Fees</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{$TotalServicesFees}}</b></h3>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="col-md-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading text-center" style="background: #01BA9A;">
                                <h3 class="panel-title">Total Other's Service</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">

                                    <div class="col-sm-4 col-lg-6">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading panel-bg-default">
                                                <h4 class="panel-title "> Premier Service's</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{ $totalPremierService }}</b></h3>
                                                <p class="text-muted"><b><a href="{{ route('branchManager.PremierService.index') }}"
                                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p>
                                            </div>
                                        </div>
                                    </div>

                               
                                    <div class="col-sm-4 col-lg-6">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading panel-bg-default">
                                                <h4 class="panel-title "> Express Service's</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{ $totalExpressService }}</b></h3>
                                                <p class="text-muted"><b><a href="{{ route('branchManager.expressService.index') }}"
                                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 col-lg-12">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading panel-bg-default">
                                                <h4 class="panel-title"> Legal & Complaints Service's</h4>
                                            </div>
                                            <div class="panel-body panel-default">
                                                <h3 class=""><b>{{ $totalLegalComplaintsService }}</b></h3>
                                                <p class="text-muted"><b><a href="{{ route('branchManager.legalComplaintsService.index') }}"
                                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 col-lg-6">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading panel-bg-default">
                                                <h4 class="panel-title title-dark"> Immigration Service's</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{ $totalImmigrationService }}</b></h3>
                                                <p class="text-muted"><b><a href="{{ route('branchManager.immigrationGovementService.index') }}"
                                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 col-lg-6">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading panel-bg-default">
                                                <h4 class="panel-title title-dark"> Other Service's</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{ $totalOtherService }}</b></h3>
                                                <p class="text-muted"><b><a href="{{ route('branchManager.otherService.index') }}"
                                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p>
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

        <hr>

        <div class="panel panel-color panel-success">
            <div class="panel-heading text-center">
                <h3 class="panel-title">Monthly Other's Service</h3>
            </div>
            <div class="panel-body">
                <div class="row">

                    <div class="col-sm-4 col-lg-2">
                        <div class="panel panel-default text-center">
                            <div class="panel-heading panel-bg-default">
                                <h4 class="panel-title " style="color: #2a323c;"> Premier Service's</h4>
                            </div>
                            <div class="panel-body">
                                <h3 class=""><b>{{ $monthlyPremierService }}</b></h3>
                                <p class="text-muted"><b><a href="{{ route('branchManager.PremierService.index') }}"
                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 col-lg-2">
                        <div class="panel panel-default text-center">
                            <div class="panel-heading panel-bg-default">
                                <h4 class="panel-title " style="color: #2a323c;"> Express Service's</h4>
                            </div>
                            <div class="panel-body">
                                <h3 class=""><b>{{ $monthlyExpressService }}</b></h3>
                                <p class="text-muted"><b><a href="{{ route('branchManager.expressService.index') }}"
                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 col-lg-4">
                        <div class="panel panel-default text-center">
                            <div class="panel-heading panel-bg-default">
                                <h4 class="panel-title " style="color: #2a323c;"> Legal & Complaints Service's</h4>
                            </div>
                            <div class="panel-body">
                                <h3 class=""><b>{{ $monthlyLegalComplaintsService }}</b></h3>
                                <p class="text-muted"><b><a href="{{ route('branchManager.legalComplaintsService.index') }}"
                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 col-lg-2">
                        <div class="panel panel-default text-center">
                            <div class="panel-heading panel-bg-default">
                                <h4 class="panel-title " style="color: #2a323c;"> Immigration Service's</h4>
                            </div>
                            <div class="panel-body">
                                <h3 class=""><b>{{ $monthlyImmigrationService }}</b></h3>
                                <p class="text-muted"><b><a href="{{ route('branchManager.immigrationGovementService.index') }}"
                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 col-lg-2">
                        <div class="panel panel-default text-center">
                            <div class="panel-heading panel-bg-default">
                                <h4 class="panel-title " style="color: #2a323c;"> Other Service's</h4>
                            </div>
                            <div class="panel-body">
                                <h3 class=""><b>{{ $monthlyOtherService }}</b></h3>
                                <p class="text-muted"><b><a href="{{ route('branchManager.otherService.index') }}"
                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <hr>

        <div class="panel panel-color panel-success">
            <div class="panel-heading text-center">
                <h3 class="panel-title">Daily Other's Service</h3>
            </div>
            <div class="panel-body">
                <div class="row">

                    <div class="col-sm-4 col-lg-2">
                        <div class="panel panel-default text-center">
                            <div class="panel-heading panel-bg-default">
                                <h4 class="panel-title" style="color: #2a323c;"> Premier Service's</h4>
                            </div>
                            <div class="panel-body">
                                <h3 class=""><b>{{ $dailyPremierService }}</b></h3>
                                <p class="text-muted"><b><a href="{{ route('branchManager.PremierService.index') }}"
                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 col-lg-2">
                        <div class="panel panel-default text-center">
                            <div class="panel-heading panel-bg-default">
                                <h4 class="panel-title" style="color: #2a323c;"> Express Service's</h4>
                            </div>
                            <div class="panel-body">
                                <h3 class=""><b>{{ $dailyExpressService }}</b></h3>
                                <p class="text-muted"><b><a href="{{ route('branchManager.expressService.index') }}"
                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 col-lg-4">
                        <div class="panel panel-default text-center">
                            <div class="panel-heading panel-bg-default">
                                <h4 class="panel-title" style="color: #2a323c;"> Legal & Complaints Service's</h4>
                            </div>
                            <div class="panel-body">
                                <h3 class=""><b>{{ $dailyLegalComplaintsService }}</b></h3>
                                <p class="text-muted"><b><a href="{{ route('branchManager.legalComplaintsService.index') }}"
                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 col-lg-2">
                        <div class="panel panel-default text-center">
                            <div class="panel-heading panel-bg-default">
                                <h4 class="panel-title" style="color: #2a323c;"> Immigration Service's</h4>
                            </div>
                            <div class="panel-body">
                                <h3 class=""><b>{{ $dailyImmigrationService }}</b></h3>
                                <p class="text-muted"><b><a href="{{ route('branchManager.immigrationGovementService.index') }}"
                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 col-lg-2">
                        <div class="panel panel-default text-center">
                            <div class="panel-heading panel-bg-default">
                                <h4 class="panel-title" style="color: #2a323c;"> Other Service's</h4>
                            </div>
                            <div class="panel-body">
                                <h3 class=""><b>{{ $dailyOtherService }}</b></h3>
                                <p class="text-muted"><b><a href="{{ route('branchManager.otherService.index') }}"
                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <hr>





        </div>
    </div> <!-- container -->
</div> <!-- content -->

<script>
    function openLink(link,type='_parent'){
      window.open(link,type);
    }

    function otherServicesReport() {
          window.open("{{ url('branch-manager/get-other-services-report') }}/"+$('#from_date').val()+"&"+$('#to_date').val()+"&"+$('#option_id').val(),"_blank");
    }
</script>


@endsection

@push('script')
{{-- <script src="{{ asset('assets/admin/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script> --}}
<script src="{{ asset('assets/branch-manager/pages/dashborad.js') }}"></script>
@endpush
