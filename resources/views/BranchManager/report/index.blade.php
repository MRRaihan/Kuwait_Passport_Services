@extends('BranchManager.layouts.master')

@push('title')
Branch Manager
@endpush

@push('css')

@endpush

@section('content')
<style>
    .title-dark{
        color:black !important;
    }
</style>
<div class="content">
    <div class="container">




        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-header-title">
                    <h4 class="pull-left page-title">Reports</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ route('branchManager.dashboard') }}">Branch Manager Panel</a></li>
                        <li class="active">Reports</li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        <div class="row text-left" >
            <div class="panel bg-info" style="background-color: #01ba9a !important;">
                <h4 class="pull-left page-title" style="color: white">&nbsp;&nbsp;Date Wise Passport Report</h4>
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
                    <label for="date">Passport Type</label>
                    <select class="form-control" name="option_id" id="option_id">
                        <option value="-1">&nbsp;&nbsp;&nbsp;&nbsp;All Passport</option>
                        @if(passportOptions()[0])
                        @foreach (passportOptions() as $key => $passort)
                            <option value="{{$key}}" >&nbsp;&nbsp;&nbsp;&nbsp;{{$passort}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>

                <div class="col-md-2" style="margin-top: 25px;">
                    <a class="btn btn-primary btn-md btn-block text-white" onclick="searchOptions()"><i class="fa fa-search"></i>&nbsp;View Report</a>
                </div>
            </div>
        </div>

        <div class="row text-left" style="margin-top: 50px;">
            <div class="panel bg-info" style="background-color: #01ba9a !important;">
                <h4 class="pull-left page-title" style="color: white">&nbsp;&nbsp;Date Wise Other Services Report</h4>
                <div class="clearfix"></div>
            </div>

            <div class="col-sm-12">

                <div class="col-md-3">
                    <label for="other_from_date">From</label>
                    <input type="date" name="other_from_date" id="other_from_date"  class="form-control">
                </div>

                <div class="col-md-3">
                    <label for="other_to_date">To</label>
                    <input type="date" name="other_to_date" id="other_to_date"  class="form-control">
                </div>

                <div class="col-md-3">
                    <label for="date">Service Type</label>
                    <select class="form-control" name="other_option_id" id="other_option_id">
                        <option value="-1">&nbsp;&nbsp;&nbsp;&nbsp;All Services</option>
                        @if(otherServiesOptions()[0])
                        @foreach (otherServiesOptions() as $key => $service)
                            <option value="{{$key}}" >&nbsp;&nbsp;&nbsp;&nbsp;{{$service}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>

                <div class="col-md-2" style="margin-top: 25px;">
                    <a class="btn btn-primary btn-md btn-block text-white" onclick="searchOtherServices()"><i class="fa fa-search"></i>&nbsp;View Report</a>
                </div>
            </div>
        </div>

        <div class="row text-left" style="margin-top: 100px;">
            <div class="panel bg-info" style="background-color: #01ba9a !important;">
                <h4 class="pull-left page-title" style="color: white">&nbsp;&nbsp;View Report</h4>
                <div class="clearfix"></div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-6">
                <div class="row">

                    <div class="col-md-12">
                        <div class="panel panel-color panel-danger">
                            <div class="panel-heading text-center" style="background: #01BA9A;">
                                <h3 class="panel-title">Passport's Count & Fee</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-6 col-lg-6">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading panel-bg-default ">
                                                <h4 class="panel-title title-dark">Total Passport's</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{ $totalPassport }}</b></h3>
                                                {{-- <p class="text-muted"><b><a href="{{ route('branchManager.lostPassport.index') }}" target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> --}}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-lg-6">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading panel-bg-default">
                                                <h4 class="panel-title title-dark">Total Passport's Fee</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{ $totalPassportFees }}</b></h3>
                                                {{-- <p class="text-muted"><b><a href="{{ route('branchManager.lostPassport.index') }}" target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="panel panel-color panel-danger">
                            <div class="panel-heading text-center" style="background: #01BA9A;">
                                <h3 class="panel-title">Total Other Services and &amp; Fees</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-6 col-lg-6">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading panel-bg-default">
                                                <h4 class="panel-title title-dark">Total Services</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{$totalServices}}</b></h3>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-lg-6">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading panel-bg-default">
                                                <h4 class="panel-title title-dark">Total Service Fees</h4>
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
                    <div class="col-md-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading text-center" style="background: #01BA9A;">
                                <h3 class="panel-title">Total Passport's Service</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">

                                    <div class="col-sm-6 col-lg-6">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading panel-bg-default">
                                                <h4 class="panel-title title-dark"> Renew Passport's</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{ $totalRenewPassword }}</b></h3>
                                                <!-- <p class="text-muted"><b><a href="{{ route('branchManager.renewPassport.index') }}"
                                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> -->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-lg-6">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading panel-bg-default">
                                                <h4 class="panel-title title-dark"> Manual Passport's</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{ $totalManualPassport }}</b></h3>
                                                <!-- <p class="text-muted"><b><a href="{{ route('branchManager.manualPassport.index') }}"
                                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> -->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-lg-6">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading panel-bg-default">
                                                <h4 class="panel-title title-dark"> Lost Passport's</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{ $totalLostPassport }}</b></h3>
                                                <!-- <p class="text-muted"><b><a href="{{ route('branchManager.lostPassport.index') }}"
                                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> -->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-lg-6">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading panel-bg-default">
                                                <h4 class="panel-title title-dark"> New Born Baby Passport's</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{ $totalOther }}</b></h3>
                                                <!-- <p class="text-muted"><b><a href="{{ route('branchManager.newBornBabyPassport.index') }}"
                                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> -->
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
                                                <h4 class="panel-title title-dark"> Premier Service's</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{ $totalPremierService }}</b></h3>
                                                <!-- <p class="text-muted"><b><a href="{{ route('branchManager.PremierService.index') }}"
                                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> -->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 col-lg-6">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading panel-bg-default">
                                                <h4 class="panel-title title-dark"> Express Service's</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{ $totalExpressService }}</b></h3>
                                                <!-- <p class="text-muted"><b><a href="{{ route('branchManager.expressService.index') }}"
                                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> -->
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
                                                <!-- <p class="text-muted"><b><a href="{{ route('branchManager.legalComplaintsService.index') }}"
                                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> -->
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
                                                <!-- <p class="text-muted"><b><a href="{{ route('branchManager.immigrationGovementService.index') }}"
                                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> -->
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
                                                <!-- <p class="text-muted"><b><a href="{{ route('branchManager.otherService.index') }}"
                                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> -->
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h4 class="m-t-0"> Renew Passports Fee</h4>
                                <ul class="list-inline m-t-30 widget-chart text-center">
                                    <li>
                                        <i class="mdi mdi-arrow-up-bold-circle text-success"></i>
                                        <h4 class=""><b>{{ $totalRenewPasswordFees }}</b></h4>
                                        <h5 class="text-muted m-b-0">Total fee</h5>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-arrow-down-bold-circle text-danger"></i>
                                        <h4 class=""><b>{{ $monthlyRenewPasswordFees }}</b></h4>
                                        <h5 class="text-muted m-b-0">Monthly</h5>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-arrow-up-bold-circle text-success"></i>
                                        <h4 class=""><b>{{ $dailyRenewPasswordFees }}</b></h4>
                                        <h5 class="text-muted m-b-0">Daily</h5>
                                    </li>
                                </ul>
                                <div id="sparkline3" style="margin: 0 -21px -22px -22px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h4 class="m-t-0">Manual Passport's Fee</h4>
                                <ul class="list-inline m-t-30 widget-chart text-center">
                                    <li>
                                        <i class="mdi mdi-arrow-up-bold-circle text-success"></i>
                                        <h4 class=""><b>{{ $totalManualPassportFees }}</b></h4>
                                        <h5 class="text-muted m-b-0">Total Fee</h5>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-arrow-down-bold-circle text-danger"></i>
                                        <h4 class=""><b>{{ $monthlyManualPassportFees }}</b></h4>
                                        <h5 class="text-muted m-b-0">Monthly</h5>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-arrow-up-bold-circle text-success"></i>
                                        <h4 class=""><b>{{ $dailyManualPassportFees }}</b></h4>
                                        <h5 class="text-muted m-b-0">Daily</h5>
                                    </li>
                                </ul>
                                <div id="sparkline2" style="margin: 0 -21px -22px -22px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h4 class="m-t-0">Lost Passport's Fee</h4>
                                <ul class="list-inline m-t-30 widget-chart text-center">
                                    <li>
                                        <i class="mdi mdi-arrow-up-bold-circle text-success"></i>
                                        <h4 class=""><b>{{ $totalLostPassportFees }}</b></h4>
                                        <h5 class="text-muted m-b-0">Total Fee</h5>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-arrow-down-bold-circle text-danger"></i>
                                        <h4 class=""><b>{{ $monthlyLostPassportFees }}</b></h4>
                                        <h5 class="text-muted m-b-0">Monthly</h5>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-arrow-up-bold-circle text-success"></i>
                                        <h4 class=""><b>{{ $dailyLostPassportFees }}</b></h4>
                                        <h5 class="text-muted m-b-0">Daily</h5>
                                    </li>
                                </ul>
                                <div id="sparkline1" style="margin: 0 -21px -22px -22px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h4 class="m-t-0">New Baby Born Passports Fee</h4>
                                <ul class="list-inline m-t-30 widget-chart text-center">
                                    <li>
                                        <i class="mdi mdi-arrow-up-bold-circle text-success"></i>
                                        <h4 class=""><b>{{ $totalNewBornFees }}</b></h4>
                                        <h5 class="text-muted m-b-0">Total Fee</h5>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-arrow-down-bold-circle text-danger"></i>
                                        <h4 class=""><b>{{ $monthlyNewBornFees }}</b></h4>
                                        <h5 class="text-muted m-b-0">Monthly</h5>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-arrow-up-bold-circle text-success"></i>
                                        <h4 class=""><b>{{ $dailyNewBornFees }}</b></h4>
                                        <h5 class="text-muted m-b-0">Daily</h5>
                                    </li>
                                </ul>
                                <div id="sparkline3" style="margin: 0 -21px -22px -22px;"></div>
                            </div>
                        </div>
                    </div>



                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h4 class="m-t-0">Premier Service's Fee</h4>
                                <ul class="list-inline m-t-30 widget-chart text-center">
                                    <li>
                                        <i class="mdi mdi-arrow-up-bold-circle text-success"></i>
                                        <h4 class=""><b>{{ $totalPremierServiceFee }}</b></h4>
                                        <h5 class="text-muted m-b-0">Total Fee</h5>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-arrow-down-bold-circle text-danger"></i>
                                        <h4 class=""><b>{{ $monthlyPremierServiceFee }}</b></h4>
                                        <h5 class="text-muted m-b-0">Monthly</h5>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-arrow-up-bold-circle text-success"></i>
                                        <h4 class=""><b>{{ $dailyPremierServiceFee }}</b></h4>
                                        <h5 class="text-muted m-b-0">Daily</h5>
                                    </li>
                                </ul>
                                <div id="sparkline1" style="margin: 0 -21px -22px -22px;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h4 class="m-t-0">Express Service's Fee</h4>
                                <ul class="list-inline m-t-30 widget-chart text-center">
                                    <li>
                                        <i class="mdi mdi-arrow-up-bold-circle text-success"></i>
                                        <h4 class=""><b>{{ $totalExpressServiceFee }}</b></h4>
                                        <h5 class="text-muted m-b-0">Total Fee</h5>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-arrow-down-bold-circle text-danger"></i>
                                        <h4 class=""><b>{{ $monthlyExpressServiceFee }}</b></h4>
                                        <h5 class="text-muted m-b-0">Monthly</h5>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-arrow-up-bold-circle text-success"></i>
                                        <h4 class=""><b>{{ $dailyExpressServiceFee }}</b></h4>
                                        <h5 class="text-muted m-b-0">Daily</h5>
                                    </li>
                                </ul>
                                <div id="sparkline2" style="margin: 0 -21px -22px -22px;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h4 class="m-t-0">Legal & Complaints Service's Fee</h4>
                                <ul class="list-inline m-t-30 widget-chart text-center">
                                    <li>
                                        <i class="mdi mdi-arrow-up-bold-circle text-success"></i>
                                        <h4 class=""><b>{{ $totalLegalComplaintsServiceFee }}</b></h4>
                                        <h5 class="text-muted m-b-0">Total Fee</h5>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-arrow-down-bold-circle text-danger"></i>
                                        <h4 class=""><b>{{ $monthlyLegalComplaintsServiceFee }}</b></h4>
                                        <h5 class="text-muted m-b-0">Monthly</h5>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-arrow-up-bold-circle text-success"></i>
                                        <h4 class=""><b>{{ $dailyLegalComplaintsServiceFee }}</b></h4>
                                        <h5 class="text-muted m-b-0">Daily</h5>
                                    </li>
                                </ul>
                                <div id="sparkline3" style="margin: 0 -21px -22px -22px;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h4 class="m-t-0"> Immigration Service's Fee</h4>
                                <ul class="list-inline m-t-30 widget-chart text-center">
                                    <li>
                                        <i class="mdi mdi-arrow-up-bold-circle text-success"></i>
                                        <h4 class=""><b>{{ $totalImmigrationGovementServiceFee }}</b></h4>
                                        <h5 class="text-muted m-b-0">Total fee</h5>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-arrow-down-bold-circle text-danger"></i>
                                        <h4 class=""><b>{{ $monthlyImmigrationGovementServiceFee }}</b></h4>
                                        <h5 class="text-muted m-b-0">Monthly</h5>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-arrow-up-bold-circle text-success"></i>
                                        <h4 class=""><b>{{ $dailyImmigrationGovementServiceFee }}</b></h4>
                                        <h5 class="text-muted m-b-0">Daily</h5>
                                    </li>
                                </ul>
                                <div id="sparkline3" style="margin: 0 -21px -22px -22px;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h4 class="m-t-0"> Other Service's Fee</h4>
                                <ul class="list-inline m-t-30 widget-chart text-center">
                                    <li>
                                        <i class="mdi mdi-arrow-up-bold-circle text-success"></i>
                                        <h4 class=""><b>{{ $totalOtherFee }}</b></h4>
                                        <h5 class="text-muted m-b-0">Total fee</h5>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-arrow-down-bold-circle text-danger"></i>
                                        <h4 class=""><b>{{ $monthlyOtherFee }}</b></h4>
                                        <h5 class="text-muted m-b-0">Monthly</h5>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-arrow-up-bold-circle text-success"></i>
                                        <h4 class=""><b>{{ $dailyOtherFee }}</b></h4>
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


        <hr>

        <div class="panel panel-color panel-success">
            <div class="panel-heading" style="text-align: center;">
                <h3 class="panel-title">Monthly Passport's Service</h3>
            </div>
            <div class="panel-body">
                <div class="row">

                    <div class="col-sm-6 col-lg-3">
                        <div class="panel panel-default text-center">
                            <div class="panel-heading panel-bg-default ">
                                <h4 class="panel-title title-dark"> Renew Passport's</h4>
                            </div>
                            <div class="panel-body">
                                <h3 class=""><b>{{ $monthlyRenewPassword }}</b></h3>
                                <!-- <p class="text-muted"><b><a href="{{ url('branch-manager/renuePassport/report/monthly') }}"
                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> -->
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <div class="panel panel-default text-center">
                            <div class="panel-heading panel-bg-default">
                                <h4 class="panel-title title-dark"> Manual Passport's</h4>
                            </div>
                            <div class="panel-body">
                                <h3 class=""><b>{{ $monthlyManualPassport }}</b></h3>
                                <!-- <p class="text-muted"><b><a href="{{ url('branch-manager/manualPassport/report/monthly') }}"
                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> -->
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <div class="panel panel-default text-center">
                            <div class="panel-heading panel-bg-default">
                                <h4 class="panel-title title-dark"> Lost Passport's</h4>
                            </div>
                            <div class="panel-body">
                                <h3 class=""><b>{{ $monthlyLostPassport }}</b></h3>
                                <!-- <p class="text-muted"><b><a href="{{ url('branch-manager/lostPassport/report/monthly') }}"
                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> -->
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-6 col-lg-3">
                        <div class="panel panel-default text-center">
                            <div class="panel-heading panel-bg-default">
                                <h4 class="panel-title title-dark"> New Born Baby Passport's</h4>
                            </div>
                            <div class="panel-body">
                                <h3 class=""><b>{{ $monthlyOther }}</b></h3>
                                <!-- <p class="text-muted"><b><a href="{{ url('branch-manager/newBornBabyPassport/report/monthly') }}"
                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> -->
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
                                <h4 class="panel-title title-dark"> Premier Service's</h4>
                            </div>
                            <div class="panel-body">
                                <h3 class=""><b>{{ $monthlyPremierService }}</b></h3>
                                <!-- <p class="text-muted"><b><a href="{{ route('branchManager.PremierService.index') }}"
                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> -->
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 col-lg-2">
                        <div class="panel panel-default text-center">
                            <div class="panel-heading panel-bg-default">
                                <h4 class="panel-title title-dark"> Express Service's</h4>
                            </div>
                            <div class="panel-body">
                                <h3 class=""><b>{{ $monthlyExpressService }}</b></h3>
                                <!-- <p class="text-muted"><b><a href="{{ route('branchManager.expressService.index') }}"
                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> -->
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 col-lg-4">
                        <div class="panel panel-default text-center">
                            <div class="panel-heading panel-bg-default">
                                <h4 class="panel-title title-dark"> Legal & Complaints Service's</h4>
                            </div>
                            <div class="panel-body">
                                <h3 class=""><b>{{ $monthlyLegalComplaintsService }}</b></h3>
                                <!-- <p class="text-muted"><b><a href="{{ route('branchManager.legalComplaintsService.index') }}"
                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> -->
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 col-lg-2">
                        <div class="panel panel-default text-center">
                            <div class="panel-heading panel-bg-default">
                                <h4 class="panel-title title-dark"> Immigration Service's</h4>
                            </div>
                            <div class="panel-body">
                                <h3 class=""><b>{{ $monthlyImmigrationService }}</b></h3>
                                <!-- <p class="text-muted"><b><a href="{{ route('branchManager.immigrationGovementService.index') }}"
                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> -->
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 col-lg-2">
                        <div class="panel panel-default text-center">
                            <div class="panel-heading panel-bg-default">
                                <h4 class="panel-title title-dark"> Other Service's</h4>
                            </div>
                            <div class="panel-body">
                                <h3 class=""><b>{{ $monthlyOtherService }}</b></h3>
                                <!-- <p class="text-muted"><b><a href="{{ route('branchManager.otherService.index') }}"
                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> -->
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <hr>

        <div class="panel panel-color panel-success">
            <div class="panel-heading text-center">
                <h3 class="panel-title">Daily Passport's Service</h3>
            </div>
            <div class="panel-body">
                <div class="row">

                    <div class="col-sm-6 col-lg-3">
                        <div class="panel panel-default text-center">
                            <div class="panel-heading panel-bg-default">
                                <h4 class="panel-title title-dark"> Renew Passport's</h4>
                            </div>
                            <div class="panel-body">
                                <h3 class=""><b>{{ $dailyRenewPassword }}</b></h3>
                                <!-- <p class="text-muted"><b><a href="{{ url('branch-manager/renuePassport/report/daily') }}"
                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> -->
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <div class="panel panel-default text-center">
                            <div class="panel-heading panel-bg-default">
                                <h4 class="panel-title title-dark"> Manual Passport's</h4>
                            </div>
                            <div class="panel-body">
                                <h3 class=""><b>{{ $dailyManualPassport }}</b></h3>
                                <!-- <p class="text-muted"><b><a href="{{ url('branch-manager/manualPassport/report/daily') }}"
                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> -->
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <div class="panel panel-default text-center">
                            <div class="panel-heading panel-bg-default">
                                <h4 class="panel-title title-dark"> Lost Passport's</h4>
                            </div>
                            <div class="panel-body">
                                <h3 class=""><b>{{ $dailyLostPassport }}</b></h3>
                                <!-- <p class="text-muted"><b><a href="{{ url('branch-manager/lostPassport/report/daily') }}"
                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> -->
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-6 col-lg-3">
                        <div class="panel panel-default text-center">
                            <div class="panel-heading panel-bg-default">
                                <h4 class="panel-title title-dark">New Born Baby Passport's</h4>
                            </div>
                            <div class="panel-body">
                                <h3 class=""><b>{{ $dailyOther }}</b></h3>
                                <!-- <p class="text-muted"><b><a href="{{ url('branch-manager/newBornBabyPassport/report/daily') }}"
                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> -->
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
                                <h4 class="panel-title title-dark"> Premier Service's</h4>
                            </div>
                            <div class="panel-body">
                                <h3 class=""><b>{{ $dailyPremierService }}</b></h3>
                                <!-- <p class="text-muted"><b><a href="{{ route('branchManager.PremierService.index') }}"
                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> -->
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 col-lg-2">
                        <div class="panel panel-default text-center">
                            <div class="panel-heading panel-bg-default">
                                <h4 class="panel-title title-dark"> Express Service's</h4>
                            </div>
                            <div class="panel-body">
                                <h3 class=""><b>{{ $dailyExpressService }}</b></h3>
                                <!-- <p class="text-muted"><b><a href="{{ route('branchManager.expressService.index') }}"
                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> -->
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 col-lg-4">
                        <div class="panel panel-default text-center">
                            <div class="panel-heading panel-bg-default">
                                <h4 class="panel-title title-dark"> Legal & Complaints Service's</h4>
                            </div>
                            <div class="panel-body">
                                <h3 class=""><b>{{ $dailyLegalComplaintsService }}</b></h3>
                                <!-- <p class="text-muted"><b><a href="{{ route('branchManager.legalComplaintsService.index') }}"
                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> -->
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 col-lg-2">
                        <div class="panel panel-default text-center">
                            <div class="panel-heading panel-bg-default">
                                <h4 class="panel-title title-dark"> Immigration Service's</h4>
                            </div>
                            <div class="panel-body">
                                <h3 class=""><b>{{ $dailyImmigrationService }}</b></h3>
                                <!-- <p class="text-muted"><b><a href="{{ route('branchManager.immigrationGovementService.index') }}"
                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> -->
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 col-lg-2">
                        <div class="panel panel-default text-center">
                            <div class="panel-heading panel-bg-default">
                                <h4 class="panel-title title-dark"> Other Service's</h4>
                            </div>
                            <div class="panel-body">
                                <h3 class=""><b>{{ $dailyOtherService }}</b></h3>
                                <!-- <p class="text-muted"><b><a href="{{ route('branchManager.otherService.index') }}"
                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> -->
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <hr>

    </div> <!-- container -->
</div> <!-- content -->

<script>
    function openLink(link,type='_parent'){
      window.open(link,type);
    }

    function searchOptions() {
          window.open("{{ url('branch-manager/get-report') }}/"+$('#from_date').val()+"&"+$('#to_date').val()+"&"+$('#option_id').val(),"_blank");
    }

    function searchOtherServices() {
          window.open("{{ url('branch-manager/get-other-services-report') }}/"+$('#other_from_date').val()+"&"+$('#other_to_date').val()+"&"+$('#other_option_id').val(),"_blank");
    }

</script>


@endsection

@push('script')
{{-- <script src="{{ asset('assets/branch-manager/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script> --}}
<script src="{{ asset('assets/branch-manager/pages/dashborad.js') }}"></script>
@endpush
