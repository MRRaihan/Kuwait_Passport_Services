@extends('BranchManager.layouts.master')

@push('title')
Branch Manager
@endpush

@push('css')

@endpush


@section('content')
    <style>
        .panel-default{
            background-color: #9af6d1 !important;
        }
        .title-dark{
            color: #1a1e21 !important;
        }
    </style>
<div class="content">
    <div class="container">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-header-title">
                    <h4 class="pull-left page-title">Dashboard</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ route('branchManager.dashboard') }}">Branch Manager Panel</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        {{--Data Enterer Profile--}}
        <div class="row">
            @foreach($totalDataEnterer as $key => $value)

                <div class="col-sm-6 col-lg-4">
                    <div class="panel panel-default text-center">
                        @if($key%2 == 0)
                            <div class="panel-heading" style="background: rgba(96,183,54,0.82);">
                                <h4 class="panel-title">Data Enterer Profile</h4>
                            </div>
                        @else
                            <div class="panel-heading" style="background: rgb(79 96 71 / 82%);">
                                <h4 class="panel-title">Data Enterer Profile</h4>
                            </div>
                        @endif
                        <div class="panel-body">
                            <div class="user-details">
                                <div class="text-center" style="position: relative; z-index: 1">
                                    @if($value->image)
                                    <img src="{{asset($value->image) }}" alt="" class="img-circle">
                                    @else
                                    <img src="/uploads/images/setting/user.png" alt="" class="img-circle">
                                    @endif
                                </div>
                            </div>

                            <div class="user-info">
                                <p class="text-muted"><i class="fa fa-dot-circle-o text-success"></i>{{ $value->entry_status == 1 ? 'Active' : 'InActive' }}</p>
                                <p class="text-muted"><i class="fa fa-user text-success"></i> Name : {{ $value->name }}</p>
                                <p class="text-muted"><i class="fa fa-envelope text-success"></i> Email: {{ $value->email }}</p>
                                <p class="text-muted"><i class="fa fa-phone text-success"></i> Phone: {{ $value->phone }}</p>
                                <hr>
                                <p>
                                    {{-- <a href="#" class="badge badge-primary"><i class="fa fa-eye" title="View Profile">Status</i></a> --}}
                                    @if ($value->entry_status == 0)
                                        <button class="btn btn-success btn-sm" onclick="activeEntryNow(this)" value="{{ route('branchManager.dataentry.activeEntryNow',$value->id) }}">
                                            <i class="mdi mdi-check" title="Active Now"></i>
                                        </button>
                                    @elseif($value->entry_status == 1)
                                        <button class="btn btn-danger" onclick="inactiveEntryNow(this)" value="{{ route('branchManager.dataentry.inactiveEntryNow',$value->id) }}">
                                            <i class="mdi mdi-close" title="InActive Now"></i>
                                        </button>
                                    @endif
                                    {{-- <a href="#" class="badge badge-danger"><i class="fa fa-eye" title="View Profile">View</i></a> --}}
                                </p>
                            </div>
                       </div>
                    </div>
                </div>
            @endforeach
        </div>


        <div class="row">
            <div class="col-md-6">
                <div class="row">

                    <div class="col-md-12">
                        <div class="panel panel-color panel-danger">
                            <div class="panel-heading text-center" style="background: #01BA9A;">
                                <h3 class="panel-title">Passport's Count and Fee</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-6 col-lg-6">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading">
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
                                            <div class="panel-heading">
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
                                <h3 class="panel-title">Total Other Services and Fees</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-6 col-lg-6">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading">
                                                <h4 class="panel-title title-dark">Total Services</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{$totalServices}}</b></h3>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-lg-6">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading">
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
                                            <div class="panel-heading">
                                                <h4 class="panel-title title-dark"> Renew Passport's</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{ $totalRenewPassword }}</b></h3>
                                                <p class="text-muted"><b><a href="{{ route('branchManager.renewPassport.index') }}"
                                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-lg-6">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading">
                                                <h4 class="panel-title title-dark"> Manual Passport's</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{ $totalManualPassport }}</b></h3>
                                                <p class="text-muted"><b><a href="{{ route('branchManager.manualPassport.index') }}"
                                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-lg-6">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading">
                                                <h4 class="panel-title title-dark"> Lost Passport's</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{ $totalLostPassport }}</b></h3>
                                                <p class="text-muted"><b><a href="{{ route('branchManager.lostPassport.index') }}"
                                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-lg-6">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading">
                                                <h4 class="panel-title title-dark"> New Born Baby Passport's</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{ $totalOther }}</b></h3>
                                                <p class="text-muted"><b><a href="{{ route('branchManager.otherPassport.index') }}"
                                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p>
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
                                            <div class="panel-heading">
                                                <h4 class="panel-title title-dark"> Premier Service's</h4>
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
                                            <div class="panel-heading">
                                                <h4 class="panel-title title-dark"> Express Service's</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{ $totalExpressService }}</b></h3>
                                                <p class="text-muted"><b><a href="{{ route('branchManager.expressService.index') }}"
                                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 col-lg-12">
                                        <div class="panel panel-primary text-center">
                                            <div class="panel-heading" style="background: #01BA9A;">
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
                                            <div class="panel-heading">
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
                                            <div class="panel-heading">
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
                            <div class="panel-heading ">
                                <h4 class="panel-title title-dark"> Renew Passport's</h4>
                            </div>
                            <div class="panel-body">
                                <h3 class=""><b>{{ $monthlyRenewPassword }}</b></h3>
                                <p class="text-muted"><b><a href="{{ url('branch-manager/renuePassport/report/monthly') }}"
                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <div class="panel panel-default text-center">
                            <div class="panel-heading">
                                <h4 class="panel-title title-dark"> Manual Passport's</h4>
                            </div>
                            <div class="panel-body">
                                <h3 class=""><b>{{ $monthlyManualPassport }}</b></h3>
                                <p class="text-muted"><b><a href="{{ url('branch-manager/manualPassport/report/monthly') }}"
                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <div class="panel panel-default text-center">
                            <div class="panel-heading">
                                <h4 class="panel-title title-dark"> Lost Passport's</h4>
                            </div>
                            <div class="panel-body">
                                <h3 class=""><b>{{ $monthlyLostPassport }}</b></h3>
                                <p class="text-muted"><b><a href="{{ url('branch-manager/lostPassport/report/monthly') }}"
                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-6 col-lg-3">
                        <div class="panel panel-default text-center">
                            <div class="panel-heading">
                                <h4 class="panel-title title-dark"> New Born Baby Passport's</h4>
                            </div>
                            <div class="panel-body">
                                <h3 class=""><b>{{ $monthlyOther }}</b></h3>
                                <p class="text-muted"><b><a href="{{ url('branch-manager/otherPassport/report/monthly') }}"
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
                <h3 class="panel-title">Monthly Other's Service</h3>
            </div>
            <div class="panel-body">
                <div class="row">

                    <div class="col-sm-4 col-lg-2">
                        <div class="panel panel-default text-center">
                            <div class="panel-heading">
                                <h4 class="panel-title title-dark"> Premier Service's</h4>
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
                            <div class="panel-heading">
                                <h4 class="panel-title title-dark"> Express Service's</h4>
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
                            <div class="panel-heading">
                                <h4 class="panel-title title-dark"> Legal & Complaints Service's</h4>
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
                            <div class="panel-heading">
                                <h4 class="panel-title title-dark"> Immigration Service's</h4>
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
                            <div class="panel-heading">
                                <h4 class="panel-title title-dark"> Other Service's</h4>
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
                <h3 class="panel-title">Daily Passport's Service</h3>
            </div>
            <div class="panel-body">
                <div class="row">

                    <div class="col-sm-6 col-lg-3">
                        <div class="panel panel-default text-center">
                            <div class="panel-heading">
                                <h4 class="panel-title title-dark"> Renew Passport's</h4>
                            </div>
                            <div class="panel-body">
                                <h3 class=""><b>{{ $dailyRenewPassword }}</b></h3>
                                <p class="text-muted"><b><a href="{{ url('branch-manager/renuePassport/report/daily') }}"
                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <div class="panel panel-default text-center">
                            <div class="panel-heading">
                                <h4 class="panel-title title-dark"> Manual Passport's</h4>
                            </div>
                            <div class="panel-body">
                                <h3 class=""><b>{{ $dailyManualPassport }}</b></h3>
                                <p class="text-muted"><b><a href="{{ url('branch-manager/manualPassport/report/daily') }}"
                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <div class="panel panel-default text-center">
                            <div class="panel-heading">
                                <h4 class="panel-title title-dark"> Lost Passport's</h4>
                            </div>
                            <div class="panel-body">
                                <h3 class=""><b>{{ $dailyLostPassport }}</b></h3>
                                <p class="text-muted"><b><a href="{{ url('branch-manager/lostPassport/report/daily') }}"
                                                            target="__blank"><i class="fa fa-eye"></i> View All</a></b></p>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-6 col-lg-3">
                        <div class="panel panel-default text-center">
                            <div class="panel-heading">
                                <h4 class="panel-title title-dark">Daily New Born Baby Passport's</h4>
                            </div>
                            <div class="panel-body">
                                <h3 class=""><b>{{ $dailyOther }}</b></h3>
                                <p class="text-muted"><b><a href="{{ url('branch-manager/otherPassport/report/daily') }}"
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
                            <div class="panel-heading">
                                <h4 class="panel-title title-dark"> Premier Service's</h4>
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
                            <div class="panel-heading">
                                <h4 class="panel-title title-dark"> Express Service's</h4>
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
                            <div class="panel-heading">
                                <h4 class="panel-title title-dark"> Legal & Complaints Service's</h4>
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
                            <div class="panel-heading">
                                <h4 class="panel-title title-dark"> Immigration Service's</h4>
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
                            <div class="panel-heading">
                                <h4 class="panel-title title-dark"> Other Service's</h4>
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



    </div> <!-- container -->
</div> <!-- content -->

<script>
    function activeEntryNow(objButton) {
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

    function inactiveEntryNow(objButton) {
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

@push('script')
{{-- <script src="{{ asset('assets/branch-manager/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script> --}}
<script src="{{ asset('assets/branch-manager/pages/dashborad.js') }}"></script>
@endpush
