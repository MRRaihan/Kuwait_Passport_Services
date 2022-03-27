@extends('DataEnterer.layouts.master')

@push('title')
Passport Options
@endpush
@push('datatableCSS')
<!-- DataTables -->
<link href="{{ asset('assets/data-enterer/plugins/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/data-enterer/plugins/datatables/buttons.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/data-enterer/plugins/datatables/fixedHeader.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/data-enterer/plugins/datatables/responsive.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/data-enterer/plugins/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/data-enterer/plugins/datatables/scroller.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
@endpush
@section('content')

<style>
    td, th{
        text-align: center;
    }
</style>

<div class="content">
    <div class="container">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-header-title">
                    <h4 class="pull-left page-title">Passport Options</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ route('dataEnterer.dashboard') }}">Admin Panel</a></li>
                        <li class="active">Passport Options</li>
                    </ol>
                    <div class="clearfix">

                    </div>
                </div>
            </div>
        </div>

        <div class="row text-right">
            <div class="col-sm-12">

                <div class="col-md-3">
                    <label for="date">Civil ID</label>
                    <input type="text" name="civil_id" id="civil_id" value="{{ isset($civil_id) ? $civil_id : '' }}" class="form-control" placeholder="search by Civil ID">
                </div>

                <div class="col-md-3">
                    <label for="mobile">Phone Number</label>
                    <input type="text" name="mobile" id="mobile" value="{{ isset($mobile) ? $mobile : '' }}" class="form-control" placeholder="search by Phone Number">
                </div>

                <div class="col-md-3">
                    <label for="from_date">From</label>
                    <input type="date" name="from_date" id="from_date" value="{{ isset($from_date) ? $from_date : '' }}" class="form-control">
                </div>
                <div class="col-md-3">
                    <label for="to_date">To</label>
                    <input type="date" name="to_date" id="to_date" value="{{ isset($to_date) ? $to_date : ''  }}" class="form-control">
                </div>

                <div class="col-md-3">
                    <label for="date">Passport Type</label>
                    <select class="form-control" name="option_id" id="option_id">
                        @if(passportOptions()[0])
                        @foreach (passportOptions() as $key => $passort)
                            <option value="{{$key}}"   {{ $option == $key ? 'selected' : '' }}   >&nbsp;&nbsp;&nbsp;&nbsp;{{$passort}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-md-2" style="margin-top: 25px;">
                    <a class="btn btn-md btn-block text-white" onclick="searchOptions()" style="background-color:#46bdc6"><i class="fa fa-search"></i>&nbsp;Search</a>
                </div>
            </div>
        </div>

        <div class="row mt-5" style="margin-top: 20px;">
            @include('Others.message')
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading" style="background-color: #46bdc6; color:white!important;">
                        <span class="panel-title">Passport Delivery
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3" >
                                <label for="date">Search By Passport Type</label>
                                <select class="form-control" name="onchange_option_id" id="onchange_option_id" onchange="openLink('{{ url('data-enterer/passport-options/delivery') }}/'+'&'+'&'+'&'+'&'+$('#onchange_option_id').val())">
                                    @if(passportOptions()[0])
                                    @foreach (passportOptions() as $key => $passort)
                                        <option value="{{$key}}"   {{ $option == $key ? 'selected' : '' }}   >&nbsp;&nbsp;&nbsp;&nbsp;{{$passort}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Civil ID</th>
                                    <th>Phone</th>
                                    <th>Passport Type</th>
                                    <th>Remarks</th>
                                    <th>Remarks By</th>
                                    <th style="width: 150px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($options as $key => $passport)
                                <tr>
                                    <td>{{ $passport->name }}</td>
                                    <td>{{ $passport->civil_id }}</td>
                                    <td>{{ $passport->bd_phone }}</td>
                                    <td>
                                        {{ $passport->model_name }}
                                    </td>
                                    <td>
                                        @if ($passport->remarks != null)
                                            <span class="badge badge-pill {{ $passport->id.' '.$passport->remarks }}
                                                @if ($passport->remarks == 0) badge-success @endif
                                                @if ($passport->remarks == 1) badge-danger @endif
                                                @if ($passport->remarks == 2) badge-warning @endif
                                                @if ($passport->remarks == 3) badge-warning @endif">
                                                @if ($passport->remarks === '0' || $passport->remarks === '1' || $passport->remarks === '2' || $passport->remarks === '3')
                                                    {{ remarks()[$passport->remarks]}}
                                                    @else
                                                    {{ $passport->remarks }}
                                                @endif
                                            </span>
                                        @endif
                                    </td>
                                    <td>{{ $passport->remarksBy ? $passport->remarksBy->name : '' }}</td>
                                    <td>
                                        @if($passport->branch_status == 3)
                                            <span class="badge badge-pill badge-success">Already Delivered</span>
                                        @else
                                            <span class="badge badge-pill badge-danger" >Pending Delivered</span>
                                        @endif
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

<script>
    function searchOptions() {
         window.open("{{ url('data-enterer/passport-options/delivery') }}/"+$('#civil_id').val()+"&"+$('#mobile').val()+"&"+$('#from_date').val()+"&"+$('#to_date').val()+"&"+$('#option_id').val(),"_parent");
    }
    function openLink(link,type='_parent'){
        window.open(link,type);
    }
</script>

@endsection

@push('datatableJS')
<!-- Datatables-->
<script src="{{ asset('assets/data-enterer/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/data-enterer/plugins/datatables/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('assets/data-enterer/plugins/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/data-enterer/plugins/datatables/buttons.bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/data-enterer/plugins/datatables/jszip.min.js') }}"></script>
<script src="{{ asset('assets/data-enterer/plugins/datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/data-enterer/plugins/datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/data-enterer/plugins/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/data-enterer/plugins/datatables/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/data-enterer/plugins/datatables/dataTables.fixedHeader.min.js') }}"></script>
<script src="{{ asset('assets/data-enterer/plugins/datatables/dataTables.keyTable.min.js') }}"></script>
<script src="{{ asset('assets/data-enterer/plugins/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/data-enterer/plugins/datatables/responsive.bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/data-enterer/plugins/datatables/dataTables.scroller.min.js') }}"></script>
<!-- Datatable init js -->
<script src="{{ asset('assets/data-enterer/pages/datatables.init.js') }}"></script>
@endpush
