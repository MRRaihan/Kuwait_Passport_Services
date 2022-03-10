@extends('Admin.layouts.master')

@push('title')
Admin | Data Entry
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
<style>
    .panel-default{
    background-color: #e1e1e1 !important;
}
</style>
<div class="content">

    <div class="container">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-header-title">
                    <h4 class="pull-left page-title">Data Entry Report</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ route('admin.dashboard') }}">Admin Panel</a></li>
                        <li class="active">Data Entry</li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-color panel-danger">
                            <div class="panel-heading" style="text-align: center;">
                                <h3 class="panel-title">Passport's Count & Fee</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-6 col-lg-6">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading">
                                                <h4 class="panel-title text-dark">Total Passport's</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{ $totalPassport }}</b></h3>
                                                {{-- <p class="text-muted"><b><a href="{{ route('admin.lostPassport.index') }}" target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> --}}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-lg-6">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading" style="">
                                                <h4 class="panel-title text-dark">Total Passport's Fee</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{ $totalPassportFees }}</b></h3>
                                                {{-- <p class="text-muted"><b><a href="{{ route('admin.lostPassport.index') }}" target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="panel panel-color panel-primary">
                            <div class="panel-heading" style="text-align: center;">
                                <h3 class="panel-title">Total Passport's Service</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">

                                    <div class="col-sm-6 col-lg-6">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading" style="">
                                                <h4 class="panel-title text-dark"> Renew Passport's</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{ $totalRenewPassport }}</b></h3>
                                                {{-- <p class="text-muted"><b><a href="{{ route('admin.renewPassport.index') }}"
                                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> --}}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-lg-6">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading" style="">
                                                <h4 class="panel-title text-dark"> Manual Passport's</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{ $totalManualPassport }}</b></h3>
                                                {{-- <p class="text-muted"><b><a href="{{ route('admin.manualPassport.index') }}"
                                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> --}}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-lg-6">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading" style="">
                                                <h4 class="panel-title text-dark"> Lost Passport's</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{ $totalLostPassport }}</b></h3>
                                                {{-- <p class="text-muted"><b><a href="{{ route('admin.lostPassport.index') }}"
                                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> --}}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-lg-6">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading" style="">
                                                <h4 class="panel-title text-dark"> New Born Baby Passport's</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{ $totalOther }}</b></h3>
                                                {{-- <p class="text-muted"><b><a href="{{ route('admin.newBornBabyPassport.index') }}"
                                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> --}}
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="panel panel-color panel-danger">
                            <div class="panel-heading" style="text-align: center;">
                                <h3 class="panel-title">Other Service's Count & Fee</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-6 col-lg-6">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading">
                                                <h4 class="panel-title text-dark">Other Service's</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{ $totalOtherService }}</b></h3>
                                                {{-- <p class="text-muted"><b><a href="{{ route('admin.lostPassport.index') }}" target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> --}}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-lg-6">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading" style="">
                                                <h4 class="panel-title text-dark">Other Service's Fee</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{ $totalOtherServiceFees }}</b></h3>
                                                {{-- <p class="text-muted"><b><a href="{{ route('admin.lostPassport.index') }}" target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="panel panel-color panel-primary">
                            <div class="panel-heading" style="text-align: center;">
                                <h3 class="panel-title">Total Other's Service</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">

                                    <div class="col-sm-4 col-lg-6">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading" style="">
                                                <h4 class="panel-title text-dark"> Premier Service's</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{ $totalPremierService }}</b></h3>
                                                {{-- <p class="text-muted"><b><a href="{{ route('admin.PremierService.index') }}"
                                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> --}}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 col-lg-6">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading" style="">
                                                <h4 class="panel-title text-dark"> Express Service's</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{ $totalExpressService }}</b></h3>
                                                {{-- <p class="text-muted"><b><a href="{{ route('admin.expressService.index') }}"
                                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> --}}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 col-lg-12">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading" style="">
                                                <h4 class="panel-title text-dark"> Legal & Complaints Service's</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{ $totalLegalComplaintsService }}</b></h3>
                                                {{-- <p class="text-muted"><b><a href="{{ route('admin.legalComplaintsService.index') }}"
                                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> --}}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 col-lg-6">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading" style="">
                                                <h4 class="panel-title text-dark"> Immigration Service's</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{ $totalImmigrationGovementService }}</b></h3>
                                                {{-- <p class="text-muted"><b><a href="{{ route('admin.immigrationGovementService.index') }}"
                                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> --}}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 col-lg-6">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading" style="">
                                                <h4 class="panel-title text-dark"> Other Service's</h4>
                                            </div>
                                            <div class="panel-body">

                                                <h3 class=""><b>{{ $totalOther }}</b></h3>

                                                {{-- <p class="text-muted"><b><a href="{{ route('admin.otherService.index') }}"
                                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> --}}
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
                                <h4 class="m-t-0"> Renew Passport Fee</h4>
                                <ul class="list-inline m-t-30 widget-chart text-center">
                                    <li>
                                        <i class="mdi mdi-arrow-up-bold-circle text-success"></i>
                                        <h4 class=""><b>{{ $totalRenewPassportFees }}</b></h4>
                                        <h5 class="text-muted m-b-0">Total fee</h5>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-arrow-down-bold-circle text-danger"></i>
                                        <h4 class=""><b>{{ $monthlyRenewPassportFees }}</b></h4>
                                        <h5 class="text-muted m-b-0">Monthly</h5>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-arrow-up-bold-circle text-success"></i>
                                        <h4 class=""><b>{{ $dailyRenewPassportFees }}</b></h4>
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
                        <div class="panel panel-primary">
                            <div class="panel-body" style="background-color: #e1e1e1 !important;">
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
                        <div class="panel panel-primary">
                            <div class="panel-body" style="background-color: #e1e1e1 !important;">
                                <h4 class="m-t-0">New born baby Passport</h4>
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
                    <div class="panel-heading" style="text-align: center;">
                        <h3 class="panel-title">Monthly Passport's Service</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">

                            <div class="col-sm-6 col-lg-6">
                                <div class="panel panel-default text-center">
                                    <div class="panel-heading" style="">
                                        <h4 class="panel-title text-dark"> Renew Passport's</h4>
                                    </div>
                                    <div class="panel-body">
                                        <h3 class=""><b>{{ $monthlyRenewPassport }}</b></h3>
                                        {{-- <p class="text-muted"><b><a href="{{ url('admin/renuePassport/report/monthly') }}"
                                                                    target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> --}}
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-6">
                                <div class="panel panel-default text-center">
                                    <div class="panel-heading" style="">
                                        <h4 class="panel-title text-dark"> Manual Passport's</h4>
                                    </div>
                                    <div class="panel-body">
                                        <h3 class=""><b>{{ $monthlyManualPassport }}</b></h3>
                                        {{-- <p class="text-muted"><b><a href="{{ url('admin/manualPassport/report/monthly') }}"
                                                                    target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> --}}
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-6">
                                <div class="panel panel-default text-center">
                                    <div class="panel-heading" style="">
                                        <h4 class="panel-title text-dark"> Lost Passport's</h4>
                                    </div>
                                    <div class="panel-body">
                                        <h3 class=""><b>{{ $monthlyLostPassport }}</b></h3>
                                        {{-- <p class="text-muted"><b><a href="{{ url('admin/lostPassport/report/monthly') }}"
                                                                    target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> --}}
                                    </div>
                                </div>
                            </div>


                            <div class="col-sm-6 col-lg-6">
                                <div class="panel panel-default text-center">
                                    <div class="panel-heading" style="">
                                        <h4 class="panel-title text-dark"> New Born Baby Passport's</h4>
                                    </div>
                                    <div class="panel-body">
                                        <h3 class=""><b>{{ $monthlyNewBornBaby }}</b></h3>
                                        {{-- <p class="text-muted"><b><a href="{{ url('admin/newBornPassport/report/monthly') }}"
                                                                    target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> --}}
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-color panel-primary">
                    <div class="panel-heading" style="text-align: center;">
                        <h3 class="panel-title">Monthly Other's Service</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">

                            <div class="col-sm-6 col-lg-6">
                                <div class="panel panel-default text-center">
                                    <div class="panel-heading" style="">
                                        <h4 class="panel-title text-dark"> Premier Service's</h4>
                                    </div>
                                    <div class="panel-body">
                                        <h3 class=""><b>{{ $monthlyPremierService }}</b></h3>
                                        {{-- <p class="text-muted"><b><a href="{{ url('admin/premierPassport/report/monthly') }}"
                                                                    target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> --}}
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-6">
                                <div class="panel panel-default text-center">
                                    <div class="panel-heading" style="">
                                        <h4 class="panel-title text-dark"> Express Service's</h4>
                                    </div>
                                    <div class="panel-body">
                                        <h3 class=""><b>{{ $monthlyExpressService }}</b></h3>
                                        {{-- <p class="text-muted"><b><a href="{{ url('admin/expressPassport/report/monthly') }}"
                                                                    target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> --}}
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-lg-12">
                                <div class="panel panel-default text-center">
                                    <div class="panel-heading" style="">
                                        <h4 class="panel-title text-dark"> Legal & Complaints Service's</h4>
                                    </div>
                                    <div class="panel-body">
                                        <h3 class=""><b>{{ $monthlyLegalComplaintsService }}</b></h3>
                                        {{-- <p class="text-muted"><b><a href="{{ url('admin/legalComplaintsPassport/report/monthly') }}"
                                                                    target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> --}}
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-6">
                                <div class="panel panel-default text-center">
                                    <div class="panel-heading" style="">
                                        <h4 class="panel-title text-dark"> Immigration Service's</h4>
                                    </div>
                                    <div class="panel-body">
                                        <h3 class=""><b>{{ $monthlyImmigrationGovementService }}</b></h3>
                                        {{-- <p class="text-muted"><b><a href="{{ url('admin/immigrationGovementService/report/monthly') }}"
                                                                    target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> --}}
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-6">
                                <div class="panel panel-default text-center">
                                    <div class="panel-heading" style="">
                                        <h4 class="panel-title text-dark"> Other Service's</h4>
                                    </div>
                                    <div class="panel-body">
                                        <h3 class=""><b>{{ $monthlyOther }}</b></h3>
                                        {{-- <p class="text-muted"><b><a href="{{ url('admin/other/report/monthly') }}"
                                                                    target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> --}}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-color panel-primary">
                    <div class="panel-heading" style="text-align: center;">
                        <h3 class="panel-title">Daily Passport's Service</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">

                            <div class="col-sm-6 col-lg-6">
                                <div class="panel panel-default text-center">
                                    <div class="panel-heading" style="">
                                        <h4 class="panel-title text-dark"> Renew Passport's</h4>
                                    </div>
                                    <div class="panel-body">
                                        <h3 class=""><b>{{ $dailyRenewPassport }}</b></h3>
                                        {{-- <p class="text-muted"><b><a href="{{ url('admin/renuePassport/report/daily') }}"
                                                                    target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> --}}
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-6">
                                <div class="panel panel-default text-center">
                                    <div class="panel-heading" style="">
                                        <h4 class="panel-title text-dark"> Manual Passport's</h4>
                                    </div>
                                    <div class="panel-body">
                                        <h3 class=""><b>{{ $dailyManualPassport }}</b></h3>
                                        {{-- <p class="text-muted"><b><a href="{{ url('admin/manualPassport/report/daily') }}"
                                                                    target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> --}}
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-6">
                                <div class="panel panel-default text-center">
                                    <div class="panel-heading" style="">
                                        <h4 class="panel-title text-dark"> Lost Passport's</h4>
                                    </div>
                                    <div class="panel-body">
                                        <h3 class=""><b>{{ $dailyLostPassport }}</b></h3>
                                        {{-- <p class="text-muted"><b><a href="{{ url('admin/lostPassport/report/daily') }}"
                                                                    target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> --}}
                                    </div>
                                </div>
                            </div>


                            <div class="col-sm-6 col-lg-6">
                                <div class="panel panel-default text-center">
                                    <div class="panel-heading" style="">
                                        <h4 class="panel-title text-dark">New Born Baby Passport's</h4>
                                    </div>
                                    <div class="panel-body">
                                        <h3 class=""><b>{{ $dailyNewBornPassport }}</b></h3>
                                        {{-- <p class="text-muted"><b><a href="{{ url('admin/newBornPassport/report/daily') }}"
                                                                    target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> --}}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-color panel-primary">
                    <div class="panel-heading" style="text-align: center;">
                        <h3 class="panel-title">Daily Other's Service</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">

                            <div class="col-sm-6 col-lg-6">
                                <div class="panel panel-default text-center">
                                    <div class="panel-heading" style="">
                                        <h4 class="panel-title text-dark"> Premier Service's</h4>
                                    </div>
                                    <div class="panel-body">
                                        <h3 class=""><b>{{ $dailyPremierService }}</b></h3>
                                        {{-- <p class="text-muted"><b><a href="{{ url('admin/premierPassport/report/daily') }}"
                                                                    target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> --}}
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-6">
                                <div class="panel panel-default text-center">
                                    <div class="panel-heading" style="">
                                        <h4 class="panel-title text-dark"> Express Service's</h4>
                                    </div>
                                    <div class="panel-body">
                                        <h3 class=""><b>{{ $dailyExpressService }}</b></h3>
                                        {{-- <p class="text-muted"><b><a href="{{ url('admin/expressPassport/report/daily') }}"
                                                                    target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> --}}
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-lg-12">
                                <div class="panel panel-default text-center">
                                    <div class="panel-heading" style="">
                                        <h4 class="panel-title text-dark"> Legal & Complaints Service's</h4>
                                    </div>
                                    <div class="panel-body">
                                        <h3 class=""><b>{{ $dailyLegalComplaintsService }}</b></h3>
                                        {{-- <p class="text-muted"><b><a href="{{ url('admin/legalComplaintsPassport/report/daily') }}"
                                                                    target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> --}}
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-6">
                                <div class="panel panel-default text-center">
                                    <div class="panel-heading" style="">
                                        <h4 class="panel-title text-dark"> Immigration Service's</h4>
                                    </div>
                                    <div class="panel-body">
                                        <h3 class=""><b>{{ $dailyImmigrationGovementService }}</b></h3>
                                        {{-- <p class="text-muted"><b><a href="{{ url('admin/immigrationGovementService/report/daily') }}"
                                                                    target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> --}}
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-6">
                                <div class="panel panel-default text-center">
                                    <div class="panel-heading" style="">
                                        <h4 class="panel-title text-dark"> Other Service's</h4>
                                    </div>
                                    <div class="panel-body">
                                        <h3 class=""><b>{{ $dailyOther }}</b></h3>
                                        {{-- <p class="text-muted"><b><a href="{{ url('admin/other/report/daily') }}"
                                                                    target="__blank"><i class="fa fa-eye"></i> View All</a></b></p> --}}
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
