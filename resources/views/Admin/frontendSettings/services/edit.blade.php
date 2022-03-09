@extends('Admin.layouts.master')

@push('title')
Service
@endpush
@push('datatableCSS')
<!-- DataTables -->
<link href="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/admin/plugins/datatables/buttons.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/admin/plugins/datatables/fixedHeader.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/admin/plugins/datatables/responsive.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/admin/plugins/datatables/scroller.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

<!-- Summernote css -->
<link href="{{ asset('assets/admin/plugins/summernote/summernote.css') }}" rel="stylesheet" />
<!--bootstrap-wysihtml5-->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css') }}">
@endpush
@section('content')

<style>
    td,
    th {
        text-align: center;
    }

    .input-fild-group {
        display: flex;
        gap: 10px;
    }

    .panel-body {
        height: 100%;
        overflow-y: scroll;
        padding-bottom: 15px;
    }

    #Banner_image {
        width: 450px;
        height: 400px;
        position: cover;
        border: 1px solid #2AA9F4;
        cursor: copy;
        border-radius: 5px;
    }
</style>

<div class="content">
    <div class="container">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-header-title">
                    <h4 class="pull-left page-title">Services</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ route('admin.dashboard') }}">Admin Panel</a></li>
                        <li class="active">Service</li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <br>
            <div class="col-sm-12">
                <a class="btn btn-warning btn-sm" href="{{ route('admin.pageServices.index') }}" style="float: right; margin-bottom: 10px; margin-top:-26px;"><i class="ion-chevron-left"></i>&nbsp; Back</a>
            </div>
        </div>
        <form action="{{ route('admin.pageServices.update',$service) }}" method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-12">

                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" value="{{ $service->title }}" placeholder="Service Title">
                        @error('title')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">

                    <div class="form-group">
                        <label>Logo</label>
                        <input type="file" class="form-control" name="logo" value="" placeholder="Logo">
                        <span><img src="{{asset($service->logo)}}" width="75px" height="75px" alt=""></span>

                        @error('logo')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">

                    <div class="form-group">
                        <label>URL</label>
                        <input type="text" class="form-control" name="url" value="{{ $service->url }}" placeholder="Pricing Plan Title">
                        @error('url')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <b>Status</b><br>
                    <br>
                    <div class="radio radio-info radio-inline">
                        <input type="radio" class="form-control" id="active" value=1 name="status" @if ( $service->status == 1) checked="checked" @endif>
                        <label for="active"> Active </label>
                    </div>
                    <div class="radio radio-danger radio-inline">
                        <input type="radio" class="form-control" id="Inactive" value=0 name="status" @if ( $service->status == 0) checked="checked" @endif>
                        <label for="Inactive"> Inactive </label>
                    </div><br>
                    <br>
                </div>
                <div class="col-sm-12" style="margin-bottom: 25px;">
                    <label for="banner-text">content</label>
                    <textarea id="banner-text" class="summernote form-control banner_text" name="content" rows="9">{!! $service->content !!}</textarea>
                    @error('content')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-md-12">

                    <button type="submit" class="btn btn-success mx-4" style="float: right; margin-bottom: 10px; margin-top:-26px;">Update</button>
                </div>

            </div>
        </form>
        <!-- End row -->
    </div> <!-- container -->
</div> <!-- content -->


@if (session()->has('success'))
<script type="text/javascript">
    $(document).ready(function() {
        // notify('{{ session()->get('success') }}','success');
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: '{{ Session::get('
            success ') }}',
            showConfirmButton: false,
            timer: 1500
        })
    });
</script>
@endif
<script>
    // uplode photo view
    $(document).on('change', 'input.upload_banner', function(e) {
        e.preventDefault()
        let banner_photo = URL.createObjectURL(e.target.files[0])
        $('#Banner_image').attr('src', banner_photo)
    });
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
<!--repeter--->
<script src="{{ asset('assets/admin/js/jquery.repeater.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/custome.js') }}"></script>
<!-- Wysihtml js -->
<script type="text/javascript" src="{{  asset('assets/admin/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js') }}"></script>
<script type="text/javascript" src="{{  asset('assets/admin/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js') }}"></script>

<!--Summernote js-->
<script src="{{  asset('assets/admin/plugins/summernote/summernote.min.js') }}"></script>
<script>
    jQuery(document).ready(function() {
        $('.wysihtml5').wysihtml5();

        $('.summernote').summernote({
            height: 400,
            // set editor height

            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor

            focus: true // set focus to editable area after initializing summernote
        });
    });
</script>
@endpush