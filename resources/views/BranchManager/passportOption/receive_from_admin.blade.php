@extends('BranchManager.layouts.master')

@push('title')
 Branch Manager Passport Options
@endpush
@push('datatableCSS')
<!-- DataTables -->
<link href="{{ asset('assets/branch-manager/plugins/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/branch-manager/plugins/datatables/buttons.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/branch-manager/plugins/datatables/fixedHeader.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/branch-manager/plugins/datatables/responsive.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/branch-manager/plugins/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/branch-manager/plugins/datatables/scroller.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
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
                        <li><a href="{{ route('branchManager.dashboard') }}">Branch Manager Panel</a></li>
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
                <div class="col-md-2" style="margin-top: 35px;">
                    <a class="btn btn-primary btn-md btn-block text-white" onclick="searchOptions()"><i class="fa fa-search"></i>&nbsp;Search</a>
                </div>
            </div>
        </div>

        <div class="row mt-5" style="margin-top: 70px;">
            @include('Others.message')
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading" style="background-color: #01ba9a !important;">
                        <span class="panel-title">Passport Receive From Admin </span>
                        <!-- Button trigger modal for adding new Category -->

                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3" >
                                <label for="date">Search By Passport Type</label>
                                <select class="form-control" name="onchange_option_id" id="onchange_option_id" onchange="openLink('{{ url('branch-manager/passport-options/receive-from-embassy') }}/'+'&'+'&'+'&'+'&'+$('#onchange_option_id').val())">
                                    @if(passportOptions()[0])
                                    @foreach (passportOptions() as $key => $passort)
                                        <option value="{{$key}}"   {{ $option == $key ? 'selected' : '' }}   >&nbsp;&nbsp;&nbsp;&nbsp;{{$passort}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <form action="#" method="post" id="main-form">
                            @csrf
                            <div style="margin-top: 20px; margin-bottom: 20px;" class="row text-center">
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-md btn-info delivery-to-user-btn">Delivery to User</button>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-control mt-2 de_id" name="de_id" >
                                        <option value="" selected disabled>Select One</option>
                                        @foreach (get_all_data_enterers_under_a_branch_manager() as $dataEnterer)
                                            <option value="{{ $dataEnterer->id }}">{{ $dataEnterer->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-md btn-info assign-de-for-bio-btn">Assign Data Enterer for Bio</button>
                                </div>
                            </div>
                            <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>
                                            <label><input type="checkbox" name="select_option" id="select_option" onclick="checkedAll.call(this);">&nbsp;Select All / Unsellect All</label>
                                        </th>
                                        <th>Name</th>
                                        <th>Civil ID</th>
                                        <th>Phone</th>
                                        <th>Passport Type</th>
                                        <th>Bio Enrollment ID</th>
                                        <th>New MRP Passport No.</th>
                                        <th style="width: 150px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($options as $key => $passport)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="all_option[]" value="{{ $passport->id }}">
                                            <input type="hidden" name="passport_option" value="{{ $option }}">
                                        </td>
                                        <td>{{ $passport->name }}</td>
                                        <td>{{ $passport->civil_id }}</td>
                                        <td>{{ $passport->bd_phone }}</td>
                                        <td>
                                            {{ passportOptions()[$option] }}
                                        </td>
                                        <td>
                                            <form method="POST" class="enrollment-form mb-1">
                                                @csrf
                                                <input type="hidden"  class="p_id" name="id" value="{{ $passport->id }}">
                                                <input type="text"  class="bio_enrollment_id" name="bio_enrollment_id" value="{{ $passport->bio_enrollment_id }}">
                                                <input type="hidden" class="option" name="option" value="{{ $option }}">
                                            </form>
                                            @if ($passport->bio_enrollment_id == null)
                                                @if ($passport->de_id_for_bio)
                                                    <span class="badge badge-warning">Assigned to {{ $passport->deForBio->name }}</span>
                                                @endif
                                           @endif
                                        </td>
                                        <td>
                                            <form method="POST" class="new-mrp-passport-form mb-1">
                                                @csrf
                                                <input type="hidden"  class="p_id" name="id" value="{{ $passport->id }}">
                                                <input type="text"  class="new_mrp_passport_no" name="new_mrp_passport_no" value="{{ $passport->new_mrp_passport_no }}">
                                                <input type="hidden" class="option" name="option" value="{{ $option }}">
                                            </form>
                                            @if ($passport->new_mrp_passport_no == null)
                                                @if ($passport->de_id_for_bio)
                                                    <span class="badge badge-warning">Assigned to {{ $passport->deForBio->name }}</span>
                                                @endif
                                           @endif
                                        </td>
                                        <td>
                                            @if($passport->branch_status == 1)
                                                <span class="badge badge-pill badge-danger">Pending Delivery</span>
                                                <span class="badge badge-pill badge-success">Recieved From Admin</span>
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
    <script>
        function searchOptions() {
            window.open("{{ url('branch-manager/passport-options/receive-from-embassy') }}/"+$('#civil_id').val()+"&"+$('#mobile').val()+"&"+$('#from_date').val()+"&"+$('#to_date').val()+"&"+$('#option_id').val(),"_parent");
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
        $('.bio_enrollment_id').keypress(function(e) {
            if (e.keyCode == 13) {
                e.preventDefault();

                var id = $(this).parent().find('.p_id').val();
                var option = $(this).parent().find('.option').val();
                var bio_enrollment_id = $(this).val();
                console.log(bio_enrollment_id);
                var url = "{{ url('branch-manager/passport-options/receive-from-embassy/bio-enrollment-id') }}/"+id;
                var formData = new FormData();
                formData.append('id',id);
                formData.append('bio_enrollment_id', bio_enrollment_id);
                formData.append('option', option);
                $.ajax({
                    method: 'POST',
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        Swal.fire({
                            position: 'top-end',
                            icon: data.type,
                            title: data.message,
                            showConfirmButton: false,
                            // timer: 1500
                        })
                        setTimeout(function() {
                            location.reload();
                        }, 1000); //
                        console.log(data);
                    },
                    error: function(xhr) {
                        var errorMessage = '<div class="card bg-danger">\n' +
                            '                        <div class="card-body text-center p-5">\n' +
                            '                            <span class="text-white">';
                        $.each(xhr.responseJSON.errors, function(key, value) {
                            errorMessage += ('' + value + '<br>');
                        });
                        errorMessage += '</span>\n' +
                            '                        </div>\n' +
                            '                    </div>';
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            footer: errorMessage
                        })
                    },
                });
            }
        });
        $('.new_mrp_passport_no').keypress(function(e) {
            if (e.keyCode == 13) {

                e.preventDefault();

                var id = $(this).parent().find('.p_id').val();
                var option = $(this).parent().find('.option').val();
                var new_mrp_passport_no = $(this).val();
                console.log(new_mrp_passport_no);
                var url = "{{ url('branch-manager/passport-options/receive-from-embassy/new-mrp-passport-no') }}/"+id;

                var formData = new FormData();
                formData.append('id',id);
                formData.append('new_mrp_passport_no', new_mrp_passport_no);
                formData.append('option', option);

                $.ajax({
                    method: 'POST',
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        Swal.fire({
                            position: 'top-end',
                            icon: data.type,
                            title: data.message,
                            showConfirmButton: false,
                            // timer: 1500
                        })
                        setTimeout(function() {
                            location.reload();
                        }, 1000); //
                        console.log(data);
                    },
                    error: function(xhr) {
                        var errorMessage = '<div class="card bg-danger">\n' +
                            '                        <div class="card-body text-center p-5">\n' +
                            '                            <span class="text-white">';
                        $.each(xhr.responseJSON.errors, function(key, value) {
                            errorMessage += ('' + value + '<br>');
                        });
                        errorMessage += '</span>\n' +
                            '                        </div>\n' +
                            '                    </div>';
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            footer: errorMessage
                        })
                    },
                });
            }
        });
        $('.delivery-to-user-btn').on('click', function(e) {
            e.preventDefault();
            $('#main-form').attr('action', "{{ route('branchManager.passportOption.deliveryToUser.store') }}");
            $('#main-form').submit();
        });
        $('.assign-de-for-bio-btn').on('click', function(e) {
            e.preventDefault();
            $('#main-form').attr('action', "{{ route('branchManager.passportOption.assignDeForBio') }}");
            $('#main-form').submit();
        });
    </script>
    @include('Others.toaster_message')

@endsection

@push('datatableJS')
<!-- Datatables-->
<script src="{{ asset('assets/branch-manager/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/branch-manager/plugins/datatables/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('assets/branch-manager/plugins/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/branch-manager/plugins/datatables/buttons.bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/branch-manager/plugins/datatables/jszip.min.js') }}"></script>
<script src="{{ asset('assets/branch-manager/plugins/datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/branch-manager/plugins/datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/branch-manager/plugins/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/branch-manager/plugins/datatables/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/branch-manager/plugins/datatables/dataTables.fixedHeader.min.js') }}"></script>
<script src="{{ asset('assets/branch-manager/plugins/datatables/dataTables.keyTable.min.js') }}"></script>
<script src="{{ asset('assets/branch-manager/plugins/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/branch-manager/plugins/datatables/responsive.bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/branch-manager/plugins/datatables/dataTables.scroller.min.js') }}"></script>
<!-- Datatable init js -->
<script src="{{ asset('assets/branch-manager/pages/datatables.init.js') }}"></script>
@endpush
