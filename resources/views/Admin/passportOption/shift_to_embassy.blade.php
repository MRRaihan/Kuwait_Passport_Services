@extends('Admin.layouts.master')

@push('title')
Passport Options
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

<div class="content">
    <div class="container">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-header-title">
                    <h4 class="pull-left page-title">Passport Options</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ route('admin.dashboard') }}">Admin Panel</a></li>
                        <li class="active">Passport Options</li>
                    </ol>
                    <div class="clearfix">

                    </div>
                </div>
            </div>
        </div>

        <div class="row text-left">
            <div class="col-sm-12">

                <div class="col-md-3">
                    <label for="date">Emirates ID</label>
                    <input type="text" name="emirates_id" id="emirates_id" value="{{ $emirates_id }}" class="form-control" placeholder="search by Emirates ID">
                </div>

                <div class="col-md-3">
                    <label for="mobile">Mobile Number</label>
                    <input type="text" name="mobile" id="mobile" value="{{ $mobile }}" class="form-control" placeholder="search by Mobile Number">
                </div>

                <div class="col-md-3">
                    <label for="from_date">From</label>
                    <input type="date" name="from_date" id="from_date" value="{{ $from_date }}" class="form-control">
                </div>
                <div class="col-md-3">
                    <label for="to_date">To</label>
                    <input type="date" name="to_date" id="to_date" value="{{ $to_date }}" class="form-control">
                </div>

                <div class="col-md-3" style="margin-top: 10px;">
                    <label for="date">Passport Type</label>
                    <select class="form-control" name="option_id" id="option_id" onchange="getSubmenu()">
                        @if(passportOptions()[0])
                        @foreach (passportOptions() as $key => $passort)
                            <option value="{{$key}}"   {{ $option == $key ? 'selected' : '' }}   >&nbsp;&nbsp;&nbsp;&nbsp;{{$passort}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-md-2"  style="margin-top: 35px;">
                    <a class="btn btn-primary btn-md btn-block text-white" onclick="searchOptions()"><i class="fa fa-search"></i>&nbsp;Search</a>
                </div>
            </div>
        </div>

        <div class="row mt-5" style="margin-top: 70px;">
            @include('Others.message')
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <span class="panel-title">Passport Options
                        <!-- Button trigger modal for adding new Category -->

                    </div>
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-md-3" >
                                <label for="date">Search By Passport Type</label>
                                <select class="form-control" name="onchange_option_id" id="onchange_option_id" onchange="openLink('{{ url('admin/passport-options/shift-to-embassy') }}/'+'&'+'&'+'&'+'&'+$('#onchange_option_id').val())">
                                    @if(passportOptions()[0])
                                    @foreach (passportOptions() as $key => $passort)
                                        <option value="{{$key}}"   {{ $option == $key ? 'selected' : '' }}   >&nbsp;&nbsp;&nbsp;&nbsp;{{$passort}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>


                        <form action="{{ route('admin.passportOption.shiftToEmbassy.store') }}" method="post">
                            @csrf
                            <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <center><button type="submit" class="btn btn-md btn-info">Shift To Embassy</button></center>
                                <thead>
                                    <tr>
                                        <th>
                                            <label><input type="checkbox" name="select_option" id="select_option" onclick="checkedAll.call(this);">&nbsp;Select/Unsellect All</label>
                                        </th>
                                        <th>Name</th>
                                        <th>Emirates ID</th>
                                        <th>Mobile</th>
                                        <th>Passport Type</th>
                                        <th>Brnach Name</th>
                                        <th style="width: 150px">Embassy Status</th>
                                        <th style="width: 150px">Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($options as $key => $passport)
                                    <tr>
                                        @if ($passport->embassy_status >= 1)
                                            <td></td>
                                        @else
                                            <td>
                                                <input type="checkbox" name="all_option[]" value="{{ $passport->id }}">
                                                <input type="hidden" name="passport_option" value="{{ $option }}">
                                            </td>
                                        @endif
                                        <td>{{ $passport->name }}</td>
                                        <td>{{ $passport->emirates_id }}</td>
                                        <td>{{ $passport->bd_phone }}</td>
                                        <td>
                                            {{ passportOptions()[$option] }}
                                        </td>
                                        <td>
                                            {{ $passport->branch ? $passport->branch->name : 'Created By Admin' }}
                                        </td>
                                        <td>
                                            @if($passport->embassy_status == 0 )
                                            <span class="badge badge-pill badge-danger">Pending Shift</span>
                                            @endif

                                            @if($passport->embassy_status == 1)
                                                <span class="badge badge-pill badge-success">Already Shifted</span>
                                               <a onclick="undo('{{ $passport->id }}')" style="cursor: pointer;"><span class="badge badge-pill badge-warning"><i class="fa fa-undo"></i>&nbsp;Undo</span></a>
                                            @endif


                                            @if($passport->embassy_status == 2)
                                                <span class="badge badge-pill badge-success">Embassy Recieved</span>
                                            @endif

                                            @if($passport->embassy_status == 3)
                                                <span class="badge badge-pill badge-success">Procession Done</span>
                                            @endif

                                        </td>
                                        <td>


                                            @if($passport->shift_to_admin == 1)
                                                <span class="badge badge-pill badge-success">Received from branch</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </form>


                    </div>
                </div>
            </div>
        </div> <!-- End Row -->
    </div> <!-- container -->
</div> <!-- content -->

@include('Others.toaster_message')

<script>
    function searchOptions() {
         window.open("{{ url('admin/passport-options/shift-to-embassy') }}/"+$('#emirates_id').val()+"&"+$('#mobile').val()+"&"+$('#from_date').val()+"&"+$('#to_date').val()+"&"+$('#option_id').val(),"_parent");
    }

    function openLink(link,type='_parent'){
      window.open(link,type);
    }

    function checkedAll() {

        var elements = document.querySelectorAll('input[type="checkbox"]');
            for (var i = elements.length; i--; ) {
                if (elements[i].type == 'checkbox') {
                    elements[i].checked = this.checked;
                }
            }
    }

    function undo(id) {

        // alert(objButton.value)
        Swal.fire({
            title: 'Are you sure?',
             text: "You won't be able to undo this!",
             icon: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Yes, Undo !'
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    method: 'POST',
                    url: '{{ route('admin.passportOption.shiftToEmbassy.undo',$option) }}'+'&'+id,
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    },
                    success: function(data) {
                        if (data.type == 'success') {
                            Swal.fire(
                                'Undo !', 'This Passport Status has been Undo. ' + data.message, 'success'
                            )
                            setTimeout(function() {
                                location.reload();
                            }, 800); //
                        } else {
                            Swal.fire(
                                'Wrong !',
                                'Something going wrong. ' + data.message,
                                'warning'
                            )
                        }
                    },
            })
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
