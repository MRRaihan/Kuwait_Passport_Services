@extends('DataEnterer.layouts.master')

@push('title')
    Data Enterer
@endpush

@push('css')

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
                            <li><a href="{{ route('dataEnterer.dashboard') }}">Data Enterer Panel</a></li>
                            <li class="active">Reports</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row text-left">
                <div class="panel" style="background-color: #46bdc6">
                    <h4 class="pull-left page-title" style="color: white">&nbsp;&nbsp;Date Wise Passport Report</h4>
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
                        <label for="date">Passport Type</label>
                        <select class="form-control" name="option_id" id="option_id">
                            <option value="-1">&nbsp;&nbsp;&nbsp;&nbsp;All Passport</option>
                            @if(passportOptions()[0])
                                @foreach (passportOptions() as $key => $passort)
                                    <option value="{{$key}}">&nbsp;&nbsp;&nbsp;&nbsp;{{$passort}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="from_date">Click to view</label>
                        <a class="btn btn-success btn-md btn-block text-white" onclick="searchOptions()"><i
                                class="fa fa-search"></i>&nbsp;View Report</a>
                    </div>
                </div>
            </div>

            <div class="row text-left" style="margin-top: 10px;">
                <div class="panel" style="background-color: #46bdc6">
                    <h4 class="pull-left page-title" style="color: white">&nbsp;&nbsp;Date Wise Other Services Report</h4>
                    <div class="clearfix"></div>
                </div>

                <div class="col-sm-12">

                    <div class="col-md-3">
                        <label for="other_from_date">From</label>
                        <input type="date" name="other_from_date" id="other_from_date" class="form-control">
                    </div>

                    <div class="col-md-3">
                        <label for="other_to_date">To</label>
                        <input type="date" name="other_to_date" id="other_to_date" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label for="date">Service Type</label>
                        <select class="form-control" name="other_option_id" id="other_option_id">
                            <option value="-1">&nbsp;&nbsp;&nbsp;&nbsp;All Services</option>
                            @if(otherServiesOptions()[0])
                                @foreach (otherServiesOptions() as $key => $service)
                                    <option value="{{$key}}">&nbsp;&nbsp;&nbsp;&nbsp;{{$service}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="from_date">Click to view</label>
                        <a class="btn btn-success btn-md btn-block text-white" onclick="searchOtherServices()"><i
                                class="fa fa-search"></i>&nbsp;View Report</a>
                    </div>
                </div>
            </div>


            <br>
            <div class="row text-left" style="margin-top: 100px;">
                <div class="panel" style="background-color: #46bdc6">
                    <h4 class="pull-left page-title" style="color: white">&nbsp;&nbsp;Over View Report</h4>
                    <div class="clearfix"></div>
                </div>
            </div>
            <hr>
            <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-color panel-info">
                            <div class="panel-heading" style="text-align: center; background-color: #46bdc6 !important;">
                                <h3 class="panel-title">Passport's Count & Fee</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-6 col-lg-6">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading panel-bg-default">
                                                <h4 class="panel-title text-dark">Total Passport's</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{ $total_passport }}</b></h3>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-lg-6">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading panel-bg-default">
                                                <h4 class="panel-title text-dark">Total Passport's Fee</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{ $total_passport_fee }}</b></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="panel panel-color panel-info">
                            <div class="panel-heading" style="text-align: center; background-color: #46bdc6 !important;">
                                <h3 class="panel-title">Other Service's Count & Fee</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-6 col-lg-6">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading panel-bg-default">
                                                <h4 class="panel-title text-dark">Total Other Service's</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{ $totalOtherServices }}</b></h3>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-lg-6">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading panel-bg-default" style="">
                                                <h4 class="panel-title text-dark">Total Other Service's Fee</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{ $totalOtherServiceFees }}</b></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="panel panel-color panel-primary">
                            <div class="panel-heading" style="text-align: center; background-color: #46bdc6 !important;">
                                <h3 class="panel-title">Total Passport's Service</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">

                                    <div class="col-sm-6 col-lg-6">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading panel-bg-default" style="">
                                                <h4 class="panel-title text-dark"> Renew Passport's</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{ $total_renew_passport }}</b></h3>
                                                <!-- <p class="text-muted"><b><a href="{{ route('dataEnterer.renewPassport.index') }}"
                                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> -->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-lg-6">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading panel-bg-default" style="">
                                                <h4 class="panel-title text-dark"> Manual Passport's</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{ $total_manual_passport }}</b></h3>
                                                <!-- <p class="text-muted"><b><a href="{{ route('dataEnterer.manualPassport.index') }}"
                                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> -->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-lg-6">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading panel-bg-default" style="">
                                                <h4 class="panel-title text-dark"> Lost Passport's</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{ $total_lost_passport }}</b></h3>
                                                <!-- <p class="text-muted"><b><a href="{{ route('dataEnterer.lostPassport.index') }}"
                                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> -->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-lg-6">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading panel-bg-default" style="">
                                                <h4 class="panel-title text-dark"> New Born Baby Passport's</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{ $total_new_baby_passport }}</b></h3>
                                                <!-- <p class="text-muted"><b><a href="{{ route('dataEnterer.newBornBabyPassport.index') }}"
                                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> -->
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="panel panel-color panel-primary">
                            <div class="panel-heading" style="text-align: center; background-color: #46bdc6 !important;">
                                <h3 class="panel-title">Total Other's Service</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">

                                    <div class="col-sm-4 col-lg-6">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading panel-bg-default" style="">
                                                <h4 class="panel-title text-dark"> Premier Service's</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{ $totalPremierService }}</b></h3>
                                                <!-- <p class="text-muted"><b><a href="{{ route('dataEnterer.PremierService.index') }}"
                                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> -->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 col-lg-6">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading panel-bg-default" style="">
                                                <h4 class="panel-title text-dark"> Express Service's</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{ $totalExpressService }}</b></h3>
                                                <!-- <p class="text-muted"><b><a href="{{ route('dataEnterer.expressService.index') }}"
                                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> -->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 col-lg-12">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading panel-bg-default" style="">
                                                <h4 class="panel-title text-dark"> Legal & Complaints Service's</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{ $totalLegalComplaintsService }}</b></h3>
                                                <!-- <p class="text-muted"><b><a href="{{ route('dataEnterer.legalComplaintsService.index') }}"
                                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> -->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 col-lg-6">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading panel-bg-default" style="">
                                                <h4 class="panel-title text-dark"> Immigration Service's</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{ $totalImmigrationGovementService }}</b></h3>
                                                <!-- <p class="text-muted"><b><a href="{{ route('dataEnterer.immigrationGovementService.index') }}"
                                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> -->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 col-lg-6">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading panel-bg-default" style="">
                                                <h4 class="panel-title text-dark"> Other Service's</h4>
                                            </div>
                                            <div class="panel-body">

                                                <h3 class=""><b>{{ $totalOther }}</b></h3>

                                                <!-- <p class="text-muted"><b><a href="{{ route('dataEnterer.otherService.index') }}"
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
                        <div class="panel panel-primary">
                            <div class="panel-body" style="background-color: #e1e1e1 !important;">
                                <h4 class="m-t-0"> Renew Passport's Fee</h4>
                                <ul class="list-inline m-t-30 widget-chart text-center">
                                    <li>
                                        <i class="mdi mdi-arrow-up-bold-circle text-success"></i>
                                        <h4 class=""><b>{{ $total_renew_passport_fee }}</b></h4>
                                        <h5 class="text-muted m-b-0">Total fee</h5>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-arrow-down-bold-circle text-danger"></i>
                                        <h4 class=""><b>{{ $monthly_renew_passport_fee }}</b></h4>
                                        <h5 class="text-muted m-b-0">Monthly</h5>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-arrow-up-bold-circle text-success"></i>
                                        <h4 class=""><b>{{ $daily_renew_passport_fee }}</b></h4>
                                        <h5 class="text-muted m-b-0">Daily</h5>
                                    </li>
                                </ul>
                                <div id="sparkline3" style="margin: 0 -21px -22px -22px;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="panel panel-primary">
                            <div class="panel-body" style="background-color: #e1e1e1 !important;">
                                <h4 class="m-t-0">Manual Passport's Fee</h4>
                                <ul class="list-inline m-t-30 widget-chart text-center">
                                    <li>
                                        <i class="mdi mdi-arrow-up-bold-circle text-success"></i>
                                        <h4 class=""><b>{{ $total_manual_passport_fee }}</b></h4>
                                        <h5 class="text-muted m-b-0">Total Fee</h5>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-arrow-down-bold-circle text-danger"></i>
                                        <h4 class=""><b>{{ $monthly_manual_passport_fee }}</b></h4>
                                        <h5 class="text-muted m-b-0">Monthly</h5>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-arrow-up-bold-circle text-success"></i>
                                        <h4 class=""><b>{{ $daily_manual_passport_fee }}</b></h4>
                                        <h5 class="text-muted m-b-0">Daily</h5>
                                    </li>
                                </ul>
                                <div id="sparkline2" style="margin: 0 -21px -22px -22px;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="panel panel-primary">
                            <div class="panel-body" style="background-color: #e1e1e1 !important;">
                                <h4 class="m-t-0">Lost Passport's Fee</h4>
                                <ul class="list-inline m-t-30 widget-chart text-center">
                                    <li>
                                        <i class="mdi mdi-arrow-up-bold-circle text-success"></i>
                                        <h4 class=""><b>{{ $total_lost_passport_fee }}</b></h4>
                                        <h5 class="text-muted m-b-0">Total Fee</h5>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-arrow-down-bold-circle text-danger"></i>
                                        <h4 class=""><b>{{ $monthly_lost_passport_fee}}</b></h4>
                                        <h5 class="text-muted m-b-0">Monthly</h5>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-arrow-up-bold-circle text-success"></i>
                                        <h4 class=""><b>{{ $daily_lost_passport_fee }}</b></h4>
                                        <h5 class="text-muted m-b-0">Daily</h5>
                                    </li>
                                </ul>
                                <div id="sparkline1" style="margin: 0 -21px -22px -22px;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="panel panel-primary">
                            <div class="panel-body" style="background-color: #e1e1e1 !important;">
                                <h4 class="m-t-0">New born baby Service's Fee</h4>
                                <ul class="list-inline m-t-30 widget-chart text-center">
                                    <li>
                                        <i class="mdi mdi-arrow-up-bold-circle text-success"></i>
                                        <h4 class=""><b>{{ $total_new_baby_passport_fee }}</b></h4>
                                        <h5 class="text-muted m-b-0">Total Fee</h5>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-arrow-down-bold-circle text-danger"></i>
                                        <h4 class=""><b>{{ $monthly_new_baby_passport_fee }}</b></h4>
                                        <h5 class="text-muted m-b-0">Monthly</h5>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-arrow-up-bold-circle text-success"></i>
                                        <h4 class=""><b>{{ $daily_new_baby_passport_fee }}</b></h4>
                                        <h5 class="text-muted m-b-0">Daily</h5>
                                    </li>
                                </ul>
                                <div id="sparkline3" style="margin: 0 -21px -22px -22px;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="panel panel-primary">
                            <div class="panel-body" style="background-color: #e1e1e1 !important;">
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
                        <div class="panel panel-primary">
                            <div class="panel-body" style="background-color: #e1e1e1 !important;">
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
                        <div class="panel panel-primary">
                            <div class="panel-body" style="background-color: #e1e1e1 !important;">
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
                        <div class="panel panel-primary">
                            <div class="panel-body" style="background-color: #e1e1e1 !important;">
                                <h4 class="m-t-0"> Immegration Service's Fee</h4>
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
                        <div class="panel panel-primary">
                            <div class="panel-body" style="background-color: #e1e1e1 !important;">
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

        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-color panel-success">
                    <div class="panel-heading" style="text-align: center; background-color: #46bdc6 !important;">
                        <h3 class="panel-title">Monthly Passport's Service</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">

                            <div class="col-sm-6 col-lg-6">
                                <div class="panel panel-default text-center">
                                    <div class="panel-heading panel-bg-default" style="">
                                        <h4 class="panel-title text-dark"> Renew Passport's</h4>
                                    </div>
                                    <div class="panel-body">
                                        <h3 class=""><b>{{ $monthly_renew_passport }}</b></h3>
                                        <!-- <p class="text-muted"><b><a href="{{ url('data-enterer/renuePassport/report/monthly') }}"
                                                                    target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> -->
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-6">
                                <div class="panel panel-default text-center">
                                    <div class="panel-heading panel-bg-default" style="">
                                        <h4 class="panel-title text-dark"> Manual Passport's</h4>
                                    </div>
                                    <div class="panel-body">
                                        <h3 class=""><b>{{ $monthly_manual_passport }}</b></h3>
                                        <!-- <p class="text-muted"><b><a href="{{ url('data-enterer/manualPassport/report/monthly') }}"
                                                                    target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> -->
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-6">
                                <div class="panel panel-default text-center">
                                    <div class="panel-heading panel-bg-default" style="">
                                        <h4 class="panel-title text-dark"> Lost Passport's</h4>
                                    </div>
                                    <div class="panel-body">
                                        <h3 class=""><b>{{ $monthly_lost_passport }}</b></h3>
                                        <!-- <p class="text-muted"><b><a href="{{ url('data-enterer/lostPassport/report/monthly') }}"
                                                                    target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> -->
                                    </div>
                                </div>
                            </div>


                            <div class="col-sm-6 col-lg-6">
                                <div class="panel panel-default text-center">
                                    <div class="panel-heading panel-bg-default" style="">
                                        <h4 class="panel-title text-dark"> New Born Baby Passport's</h4>
                                    </div>
                                    <div class="panel-body">
                                        <h3 class=""><b>{{ $monthly_new_baby_passport }}</b></h3>
                                        <!-- <p class="text-muted"><b><a href="{{ url('data-enterer/newBornBaby/report/monthly') }}"
                                                                    target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> -->
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-color panel-primary">
                    <div class="panel-heading" style="text-align: center; background-color: #46bdc6 !important;">
                        <h3 class="panel-title">Monthly Other's Service</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">

                            <div class="col-sm-6 col-lg-6">
                                <div class="panel panel-default text-center">
                                    <div class="panel-heading panel-bg-default" style="">
                                        <h4 class="panel-title text-dark"> Premier Service's</h4>
                                    </div>
                                    <div class="panel-body">
                                        <h3 class=""><b>{{ $monthlyPremierService }}</b></h3>
                                        <!-- <p class="text-muted"><b><a href="{{ url('data-enterer/premierPassport/report/monthly') }}"
                                                                    target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> -->
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-6">
                                <div class="panel panel-default text-center">
                                    <div class="panel-heading panel-bg-default" style="">
                                        <h4 class="panel-title text-dark"> Express Service's</h4>
                                    </div>
                                    <div class="panel-body">
                                        <h3 class=""><b>{{ $monthlyExpressService }}</b></h3>
                                        <!-- <p class="text-muted"><b><a href="{{ url('data-enterer/expressPassport/report/monthly') }}"
                                                                    target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> -->
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-lg-12">
                                <div class="panel panel-default text-center">
                                    <div class="panel-heading panel-bg-default" style="">
                                        <h4 class="panel-title text-dark"> Legal & Complaints Service's</h4>
                                    </div>
                                    <div class="panel-body">
                                        <h3 class=""><b>{{ $monthlyLegalComplaintsService }}</b></h3>
                                        <!-- <p class="text-muted"><b><a href="{{ url('data-enterer/legalComplaintsPassport/report/monthly') }}"
                                                                    target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> -->
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-6">
                                <div class="panel panel-default text-center">
                                    <div class="panel-heading panel-bg-default" style="">
                                        <h4 class="panel-title text-dark"> Immigration Service's</h4>
                                    </div>
                                    <div class="panel-body">
                                        <h3 class=""><b>{{ $monthlyImmigrationGovementService }}</b></h3>
                                        <!-- <p class="text-muted"><b><a href="{{ url('data-enterer/immigrationGovementService/report/monthly') }}"
                                                                    target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> -->
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-6">
                                <div class="panel panel-default text-center">
                                    <div class="panel-heading panel-bg-default" style="">
                                        <h4 class="panel-title text-dark"> Other Service's</h4>
                                    </div>
                                    <div class="panel-body">
                                        <h3 class=""><b>{{ $monthlyOther }}</b></h3>
                                        <!-- <p class="text-muted"><b><a href="{{ url('data-enterer/other/report/monthly') }}"
                                                                    target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> -->
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-color panel-primary">
                    <div class="panel-heading" style="text-align: center; background-color: #46bdc6 !important;">
                        <h3 class="panel-title">Daily Passport's Service</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">

                            <div class="col-sm-6 col-lg-6">
                                <div class="panel panel-default text-center">
                                    <div class="panel-heading panel-bg-default" style="">
                                        <h4 class="panel-title text-dark"> Renew Passport's</h4>
                                    </div>
                                    <div class="panel-body">
                                        <h3 class=""><b>{{ $daily_renew_passport }}</b></h3>
                                        <!-- <p class="text-muted"><b><a href="{{ url('data-enterer/renuePassport/report/daily') }}"
                                                                    target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> -->
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-6">
                                <div class="panel panel-default text-center">
                                    <div class="panel-heading panel-bg-default" style="">
                                        <h4 class="panel-title text-dark"> Manual Passport's</h4>
                                    </div>
                                    <div class="panel-body">
                                        <h3 class=""><b>{{ $daily_manual_passport }}</b></h3>
                                        <!-- <p class="text-muted"><b><a href="{{ url('data-enterer/manualPassport/report/daily') }}"
                                                                    target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> -->
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-6">
                                <div class="panel panel-default text-center">
                                    <div class="panel-heading panel-bg-default" style="">
                                        <h4 class="panel-title text-dark"> Lost Passport's</h4>
                                    </div>
                                    <div class="panel-body">
                                        <h3 class=""><b>{{ $daily_lost_passport }}</b></h3>
                                        <!-- <p class="text-muted"><b><a href="{{ url('data-enterer/lostPassport/report/daily') }}"
                                                                    target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> -->
                                    </div>
                                </div>
                            </div>


                            <div class="col-sm-6 col-lg-6">
                                <div class="panel panel-default text-center">
                                    <div class="panel-heading panel-bg-default" style="">
                                        <h4 class="panel-title text-dark">New Born Baby Passport's</h4>
                                    </div>
                                    <div class="panel-body">
                                        <h3 class=""><b>{{ $daily_new_baby_passport }}</b></h3>
                                        <!-- <p class="text-muted"><b><a href="{{ url('data-enterer/newBornBaby/report/daily') }}"
                                                                    target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> -->
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-color panel-primary">
                    <div class="panel-heading" style="text-align: center; background-color: #46bdc6 !important;">
                        <h3 class="panel-title">Daily Other's Service</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">

                            <div class="col-sm-6 col-lg-6">
                                <div class="panel panel-default text-center">
                                    <div class="panel-heading panel-bg-default" style="">
                                        <h4 class="panel-title text-dark"> Premier Service's</h4>
                                    </div>
                                    <div class="panel-body">
                                        <h3 class=""><b>{{ $dailyPremierService }}</b></h3>
                                        <!-- <p class="text-muted"><b><a href="{{ url('data-enterer/premierPassport/report/daily') }}"
                                                                    target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> -->
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-6">
                                <div class="panel panel-default text-center">
                                    <div class="panel-heading panel-bg-default" style="">
                                        <h4 class="panel-title text-dark"> Express Service's</h4>
                                    </div>
                                    <div class="panel-body">
                                        <h3 class=""><b>{{ $dailyExpressService }}</b></h3>
                                        <!-- <p class="text-muted"><b><a href="{{ url('data-enterer/expressPassport/report/daily') }}"
                                                                    target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> -->
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-lg-12">
                                <div class="panel panel-default text-center">
                                    <div class="panel-heading panel-bg-default" style="">
                                        <h4 class="panel-title text-dark"> Legal & Complaints Service's</h4>
                                    </div>
                                    <div class="panel-body">
                                        <h3 class=""><b>{{ $dailyLegalComplaintsService }}</b></h3>
                                        <!-- <p class="text-muted"><b><a href="{{ url('data-enterer/legalComplaintsPassport/report/daily') }}"
                                                                    target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> -->
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-6">
                                <div class="panel panel-default text-center">
                                    <div class="panel-heading panel-bg-default" style="">
                                        <h4 class="panel-title text-dark"> Immigration Service's</h4>
                                    </div>
                                    <div class="panel-body">
                                        <h3 class=""><b>{{ $dailyImmigrationGovementService }}</b></h3>
                                        <!-- <p class="text-muted"><b><a href="{{ url('data-enterer/immigrationGovementService/report/daily') }}"
                                                                    target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> -->
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-6">
                                <div class="panel panel-default text-center">
                                    <div class="panel-heading panel-bg-default" style="">
                                        <h4 class="panel-title text-dark"> Other Service's</h4>
                                    </div>
                                    <div class="panel-body">
                                        <h3 class=""><b>{{ $dailyOther }}</b></h3>
                                        <!-- <p class="text-muted"><b><a href="{{ url('data-enterer/other/report/daily') }}"
                                                                    target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> -->
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

        function searchOptions() {
            window.open("{{ url('data-enterer/get-report') }}/" + $('#from_date').val() + "&" + $('#to_date').val() + "&" + $('#option_id').val(), "_blank");
        }

        function searchOtherServices() {
            window.open("{{ url('data-enterer/get-other-services-report') }}/" + $('#from_date').val() + "&" + $('#to_date').val() + "&" + $('#option_id').val(), "_blank");
        }

    </script>


@endsection

@push('script')
    {{-- <script src="{{ asset('assets/data-enterer/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script> --}}
    <script src="{{ asset('assets/data-enterer/pages/dashborad.js') }}"></script>
@endpush
