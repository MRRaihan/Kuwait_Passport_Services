@extends('CallCenter.layouts.master')

@push('title')
Passport Options
@endpush
@push('datatableCSS')
<!-- DataTables -->
<link href="{{ asset('assets/call-center/plugins/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/call-center/plugins/datatables/buttons.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/call-center/plugins/datatables/fixedHeader.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/call-center/plugins/datatables/responsive.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/call-center/plugins/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/call-center/plugins/datatables/scroller.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
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
                        <li><a href="{{ route('callCenter.dashboard') }}">Admin Panel</a></li>
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
                    <a class="btn btn-md btn-block text-white" onclick="searchOptions()" style="background-color:#71A832"><i class="fa fa-search"></i>&nbsp;Search</a>
                </div>
            </div>
        </div>



        <div class="row mt-5" style="margin-top: 20px;">
            @include('Others.message')
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading" style="background-color: #71A832; color:white!important;">
                        <span class="panel-title">Passport Delivery
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('callCenter.passportOption.delivery.store') }}" method="post">
                            @csrf
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
                                            <form method="POST" class="remarks-form">
                                                @csrf

                                                    @if ($passport->remarks != null)
                                                        <span class="badge badge-pill
                                                            {{ $passport->id.' '.$passport->remarks }}
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

                                                    <input type="hidden"  class="p_id" name="id" value="{{ $passport->id }}">
                                                    <input type="hidden"  class="option" name="option" value="{{ $option }}">

                                                    <div class="other-div" style="display: none">

                                                        <label>
                                                        <input id="remarks_other" class="remarks_other form-control" name="remarks_other">
                                                        </label>
                                                    </div>

                                                <select class="remarks mySelect" name="remarks" id="mySelect" onChange="defualtRemarks('{{ $option }}','{{ $passport->id }}',this)">
                                                    <option value="-1">Choose Remark</option>

                                                    @foreach (remarks() as $key => $remark)
                                                         <option value="{{ $key }}" @if ($passport->remarks === '0' || $passport->remarks === '1' || $passport->remarks === '2' || $passport->remarks === '3')
                                                               {{ $passport->remarks != null && $passport->remarks == $key ? 'selected' : ''}}
                                                            @endif
                                                        >{{ $remark }}</option>
                                                    @endforeach
                                                </select>



                                                <input type="hidden" id="remarks_by" class="remarks_by" name="remarks_by" value="{{auth()->user()->id }}">
                                            </form>
                                        </td>
                                        <td>{{ $passport->remarksBy ? $passport->remarksBy->name : '' }}</td>
                                        <td>
                                            @if($passport->brnach_status == 3)
                                                <span class="badge badge-pill badge-success">Already Delivered</span>
                                            @else
                                                <span class="badge badge-pill badge-danger" >Pending Delivered</span>
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
         window.open("{{ url('call-center/passport-options/delivery') }}/"+$('#civil_id').val()+"&"+$('#mobile').val()+"&"+$('#from_date').val()+"&"+$('#to_date').val()+"&"+$('#option_id').val(),"_parent");
    }

    function checkedAll() {

        var elements = document.querySelectorAll('input[type="checkbox"]');
            for (var i = elements.length; i--; ) {
                if (elements[i].type == 'checkbox') {
                    elements[i].checked = this.checked;
                }
            }
    }



    function defualtRemarks(option,id,select) {
       var mySelect = $(select).val();
        console.log(mySelect);

        if (mySelect == '4') {
            $(select).parent().find('.other-div').attr('style', 'display:block;');
        }else{
            $(select).parent().find('.other-div').attr('style', 'display:none;');
        }



       var url = "{{ url('call-center/passport-options/delivery/deafult-remarks') }}/"+option+'&'+id+'&'+mySelect;


        if (mySelect != 4) {
                $.ajax({
                method: 'POST',
                url: url,
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                },
                success: function(data) {
                    if (data.type == 'success') {
                        Swal.fire(
                            'Remarks !', 'Remarks Added Successfully. ' + data.message, 'success'
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


    }

    $('.remarks_other').keypress(function(e) {

            if (e.keyCode == 13) {

                e.preventDefault();

                var id = $(this).parent().parent().parent().find('.p_id').val();
                var option = $(this).parent().parent().parent().find('.option').val();
                var remarks = $(this).val();

                var url = "{{ url('call-center/passport-options/delivery/remarks') }}/"+id;

                var formData = new FormData();
                formData.append('id',id);
                formData.append('remarks', remarks);
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
</script>

@endsection

@push('datatableJS')
<!-- Datatables-->
<script src="{{ asset('assets/call-center/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/call-center/plugins/datatables/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('assets/call-center/plugins/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/call-center/plugins/datatables/buttons.bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/call-center/plugins/datatables/jszip.min.js') }}"></script>
<script src="{{ asset('assets/call-center/plugins/datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/call-center/plugins/datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/call-center/plugins/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/call-center/plugins/datatables/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/call-center/plugins/datatables/dataTables.fixedHeader.min.js') }}"></script>
<script src="{{ asset('assets/call-center/plugins/datatables/dataTables.keyTable.min.js') }}"></script>
<script src="{{ asset('assets/call-center/plugins/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/call-center/plugins/datatables/responsive.bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/call-center/plugins/datatables/dataTables.scroller.min.js') }}"></script>
<!-- Datatable init js -->
<script src="{{ asset('assets/call-center/pages/datatables.init.js') }}"></script>
@endpush
