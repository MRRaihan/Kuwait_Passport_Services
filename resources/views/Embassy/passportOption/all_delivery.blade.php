@extends('Embassy.layouts.master')

@push('title')
Passport Options
@endpush
@push('datatableCSS')
<!-- DataTables -->
<link href="{{ asset('assets/embassy/plugins/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/embassy/plugins/datatables/buttons.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/embassy/plugins/datatables/fixedHeader.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/embassy/plugins/datatables/responsive.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/embassy/plugins/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/embassy/plugins/datatables/scroller.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
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
                        <li><a href="{{ route('embassy.dashboard') }}">Embassy Panel</a></li>
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
                    <a class="btn btn-success btn-md btn-block text-white" onclick="searchOptions()"><i class="fa fa-search"></i>&nbsp;Search</a>
                </div>
            </div>
        </div>

        <div class="row mt-5" style="margin-top: 70px;">
            @include('Others.message')
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading" style="background-color: #00674C;">
                        <span class="panel-title">Passport Delivery</span>
                        <!-- Button trigger modal for adding new Category -->

                    </div>
                    <div class="panel-body">

                        <div class="row" style="margin-bottom: 10px;">
                            <div class="col-md-3" >
                                <label for="date">Search By Passport Type</label>
                                <select class="form-control" name="onchange_option_id" id="onchange_option_id" onchange="openLink('{{ url('embassy/passport-option/all-delivery') }}/'+'&'+'&'+'&'+'&'+$('#onchange_option_id').val())">
                                    @if(passportOptions()[0])
                                    @foreach (passportOptions() as $key => $passort)
                                        <option value="{{$key}}"   {{ $option == $key ? 'selected' : '' }}   >&nbsp;&nbsp;&nbsp;&nbsp;{{$passort}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>


                        <form action="{{ route('embassy.passportOption.delivery.store') }}" method="post">
                            @csrf
                            <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Civil ID</th>
                                        <th>Phone</th>
                                        <th>Passport Type</th>
                                        <th>Bio Enrollment Id</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($options as $key => $passport)
                                    <tr>
                                        <td>{{ $passport->name }}</td>
                                        <td>{{ $passport->civil_id }}</td>
                                        <td>{{ $passport->bd_phone }}</td>
                                        <td>
                                            {{ passportOptions()[$option] }}
                                        </td>
                                        <td>
                                            <form method="POST" class="enrollment-form">
                                                @csrf
                                                <input type="hidden"  class="p_id" name="id" value="{{ $passport->id }}">
                                                <input type="text"  class="bio_enrollment_id" name="bio_enrollment_id" value="{{ $passport->bio_enrollment_id }}">
                                                <input type="hidden" class="option" name="option" value="{{ $option }}">
                                            </form>
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
         window.open("{{ url('embassy/passport-option/all-delivery') }}/"+$('#civil_id').val()+"&"+$('#mobile').val()+"&"+$('#from_date').val()+"&"+$('#to_date').val()+"&"+$('#option_id').val(),"_parent");
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
                    url: '{{ route('embassy.passportOption.delivery.undo',$option) }}'+'&'+id,
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

    $('.remarks').keypress(function(e) {

        if (e.keyCode == 13) {

            e.preventDefault();

            var id = $(this).parent().find('.p_id').val();
            var option = $(this).parent().find('.option').val();
            var remarks = $(this).val();
            console.log(remarks);

            var url = "{{ url('embassy/passport-options/delivery/remarks') }}/"+id;

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


    $('.bio_enrollment_id').keypress(function(e) {

        if (e.keyCode == 13) {

        e.preventDefault();

        var id = $(this).parent().find('.p_id').val();
        var option = $(this).parent().find('.option').val();
        var bio_enrollemnt_id = $(this).val();
        console.log(bio_enrollemnt_id);
        var url = "{{ url('embassy/passport-options/receive-to-embassy/bio-enrollment-id') }}/"+id;

        var formData = new FormData();
        formData.append('id',id);
        formData.append('bio_enrollment_id', bio_enrollemnt_id);
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
<script src="{{ asset('assets/embassy/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/embassy/plugins/datatables/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('assets/embassy/plugins/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/embassy/plugins/datatables/buttons.bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/embassy/plugins/datatables/jszip.min.js') }}"></script>
<script src="{{ asset('assets/embassy/plugins/datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/embassy/plugins/datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/embassy/plugins/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/embassy/plugins/datatables/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/embassy/plugins/datatables/dataTables.fixedHeader.min.js') }}"></script>
<script src="{{ asset('assets/embassy/plugins/datatables/dataTables.keyTable.min.js') }}"></script>
<script src="{{ asset('assets/embassy/plugins/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/embassy/plugins/datatables/responsive.bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/embassy/plugins/datatables/dataTables.scroller.min.js') }}"></script>
<!-- Datatable init js -->
<script src="{{ asset('assets/embassy/pages/datatables.init.js') }}"></script>
@endpush
