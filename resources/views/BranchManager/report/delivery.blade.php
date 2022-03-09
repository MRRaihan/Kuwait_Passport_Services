@extends('BranchManager.layouts.master')

@push('title')
Branch Manager
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
                        <li><a href="{{ route('branchManager.dashboard') }}">Branch Manager Panel</a></li>
                        <li class="active">Reports</li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        <div class="row text-left">
            <div class="panel bg-info" style="background-color: #01ba9a !important;">
                <h4 class="pull-left page-title" style="color: white">&nbsp;&nbsp;Date Wise Delivery Report</h4>
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

        <br><br>
        <div class="row" style="margin-top: 100px;">
            <div class="panel bg-info" style="background-color: #01ba9a !important;">
                <h4 class="pull-left page-title" style="color: white">&nbsp;&nbsp; Delivery Report</h4>
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
                                                <h4 class="panel-title" style="color: #2a323c;">Total Passport's</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{ $total_passport }}</b></h3>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-lg-6">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading panel-bg-default">
                                                <h4 class="panel-title" style="color: #2a323c;">Total Passport's Fee</h4>
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
                        <div class="panel panel-primary">
                            <div class="panel-heading text-center" style="background: #01BA9A;">
                                <h3 class="panel-title">Total Passport's Service</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">

                                    <div class="col-sm-6 col-lg-6">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading panel-bg-default">
                                                <h4 class="panel-title"> Renew Passport's</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{ $total_renew_passport }}</b></h3>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-lg-6">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading panel-bg-default">
                                                <h4 class="panel-title"> Manual Passport's</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{ $total_manual_passport }}</b></h3>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-lg-6">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading panel-bg-default">
                                                <h4 class="panel-title"> Lost Passport's</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{ $total_lost_passport }}</b></h3>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-lg-6">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading panel-bg-default">
                                                <h4 class="panel-title"> New Born Baby Passport's</h4>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class=""><b>{{ $total_new_baby_passport }}</b></h3>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
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
                        <div class="panel panel-default">
                            <div class="panel-body">
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
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h4 class="m-t-0">Lost Passport's Fee</h4>
                                <ul class="list-inline m-t-30 widget-chart text-center">
                                    <li>
                                        <i class="mdi mdi-arrow-up-bold-circle text-success"></i>
                                        <h4 class=""><b>{{ $total_lost_passport_fee }}</b></h4>
                                        <h5 class="text-muted m-b-0">Total Fee</h5>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-arrow-down-bold-circle text-danger"></i>
                                        <h4 class=""><b>{{ $monthly_lost_passport_fee }}</b></h4>
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
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h4 class="m-t-0">New Baby Born Passports Fee</h4>
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
                                <h4 class="panel-title" style="color: #2a323c;"> Renew Passport's</h4>
                            </div>
                            <div class="panel-body">
                                <h3 class=""><b>{{ $monthly_renew_passport }}</b></h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <div class="panel panel-default text-center">
                            <div class="panel-heading panel-bg-default">
                                <h4 class="panel-title" style="color: #2a323c;"> Manual Passport's</h4>
                            </div>
                            <div class="panel-body">
                                <h3 class=""><b>{{ $monthly_manual_passport }}</b></h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <div class="panel panel-default text-center">
                            <div class="panel-heading panel-bg-default">
                                <h4 class="panel-title" style="color: #2a323c;"> Lost Passport's</h4>
                            </div>
                            <div class="panel-body">
                                <h3 class=""><b>{{ $monthly_lost_passport }}</b></h3>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-6 col-lg-3">
                        <div class="panel panel-default text-center">
                            <div class="panel-heading panel-bg-default">
                                <h4 class="panel-title" style="color: #2a323c;"> New Born Baby Passport's</h4>
                            </div>
                            <div class="panel-body">
                                <h3 class=""><b>{{ $monthly_new_baby_passport }}</b></h3>
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
                                <h4 class="panel-title" style="color: #2a323c;"> Renew Passport's</h4>
                            </div>
                            <div class="panel-body">
                                <h3 class=""><b>{{ $daily_renew_passport }}</b></h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <div class="panel panel-default text-center">
                            <div class="panel-heading panel-bg-default">
                                <h4 class="panel-title" style="color: #2a323c;"> Manual Passport's</h4>
                            </div>
                            <div class="panel-body">
                                <h3 class=""><b>{{ $daily_manual_passport }}</b></h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <div class="panel panel-default text-center">
                            <div class="panel-heading panel-bg-default">
                                <h4 class="panel-title" style="color: #2a323c;"> Lost Passport's</h4>
                            </div>
                            <div class="panel-body">
                                <h3 class=""><b>{{ $daily_lost_passport }}</b></h3>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-6 col-lg-3">
                        <div class="panel panel-default text-center">
                            <div class="panel-heading panel-bg-default">
                                <h4 class="panel-title" style="color: #2a323c;">Daily New Born Baby Passport's</h4>
                            </div>
                            <div class="panel-body">
                                <h3 class=""><b>{{ $daily_new_baby_passport }}</b></h3>
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

    function searchOptions() {
          window.open("{{ url('branch-manager/delivery-report') }}/"+$('#from_date').val()+"&"+$('#to_date').val()+"&"+$('#option_id').val(),"_blank");
    }
</script>


@endsection

@push('script')
{{-- <script src="{{ asset('assets/branch-manager/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script> --}}
<script src="{{ asset('assets/branch-manager/pages/dashborad.js') }}"></script>
@endpush
