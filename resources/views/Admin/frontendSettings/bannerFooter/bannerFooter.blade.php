@extends('Admin.layouts.master')

@push('title')
    Banner,Footer
@endpush
@push('datatableCSS')
    <!-- DataTables -->
    <link href="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/admin/plugins/datatables/buttons.bootstrap.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/admin/plugins/datatables/fixedHeader.bootstrap.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/admin/plugins/datatables/responsive.bootstrap.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/admin/plugins/datatables/scroller.bootstrap.min.css') }}" rel="stylesheet"
        type="text/css" />

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
        #Banner_image{
            width: 100%;
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
                        <h4 class="pull-left page-title">Banner And Footer</h4>
                        <ol class="breadcrumb pull-right">
                            <li><a href="{{ route('admin.dashboard') }}">Admin Panel</a></li>
                            <li class="active">Banner , Footer</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <form action="{{ route('admin.bannerUpdate') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-sm-12" style="margin-bottom: 25px;">
                            <label for="banner-text">Banner Text</label>
                            <textarea id="banner-text" class="summernote form-control banner_text" name="banner_text" rows="9">{!! get_static_option('banner_text') !!}</textarea>
                            @error('banner')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                    </div>
                    <div class="col-sm-4">
                        <label for="">Banner Image</label>
                        <div class="image-container">
                            <label  for="pic">
                                <img id="Banner_image"
                                src="{{ asset(get_static_option('banner_image')) }}"
                                alt="">
                            </label>
                          <input name="banner_image" id="pic" class="upload_banner hidden" code="up_44"  type="file" accept=".png, .jpg">
                          @error('banner_image')
                          <p class="text-danger">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label >Button Text</label>
                                    <input type="text" class="form-control" name="banner_btn_text" value="{{ get_static_option('banner_btn_text') }}">
                                      @error('banner_btn_text')
                                        <p class="text-danger">{{ $message }}</p>
                                      @enderror
                                </div>
                                <div class="form-group">
                                    <label >Button Url</label>
                                    <input type="text" class="form-control" name="banner_btn_url" value="{{ get_static_option('banner_btn_url') }}">
                                      @error('banner_btn_url')
                                        <p class="text-danger">{{ $message }}</p>
                                      @enderror
                                </div>
                                <div class="form-group">
                                    <label >Phone</label>
                                    <input type="text" class="form-control" name="footer_phone" value="{{ get_static_option('footer_phone') }}">
                                      @error('footer_phone')
                                        <p class="text-danger">{{ $message }}</p>
                                      @enderror
                                </div>
                                <div class="form-group">
                                    <label >Email</label>
                                    <input type="text" class="form-control" name="footer_email" value="{{ get_static_option('footer_email') }}">
                                      @error('footer_email')
                                        <p class="text-danger">{{ $message }}</p>
                                      @enderror
                                </div>
                                <div class="form-group">
                                    <label >Address</label>
                                    <textarea class="form-control" cols="10" name="footer_address" rows="4">{{ get_static_option('footer_address') }}</textarea>
                                      @error('footer_address')
                                        <p class="text-danger">{{ $message }}</p>
                                      @enderror
                                </div>

                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label >Why Chose us? Section</label>
                                    <textarea class="form-control why_choseME" cols="10" name="why_chose_section" rows="4">{!! get_static_option('why_chose_section') !!}</textarea>
                                      @error('why_chose_section')
                                        <p class="text-danger">{{ $message }}</p>
                                      @enderror
                                </div>
                                <button class="btn btn-info btn-xl">UPDATE</button>
                            </div>
                        </div>
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
                    title: '{{ Session::get('success') }}',
                    showConfirmButton: false,
                    timer: 1500
                })
            });
        </script>
    @endif
    <script>
        // uplode photo view
          $(document).on('change', 'input.upload_banner', function (e) {
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

    <<!--Summernote js-->
    <script src="{{  asset('assets/admin/plugins/summernote/summernote.min.js') }}"></script>
    <script>

        jQuery(document).ready(function(){
            $('.wysihtml5').wysihtml5();

            $('.summernote').summernote({
                height: 300,
                // set editor height

                minHeight: null,             // set minimum height of editor
                maxHeight: null,             // set maximum height of editor

                focus: true                 // set focus to editable area after initializing summernote
            });
            $('.why_choseME').summernote({
                height: 300,
                // set editor height

                minHeight: null,             // set minimum height of editor
                maxHeight: null,             // set maximum height of editor

                focus: true                 // set focus to editable area after initializing summernote
            });

        });
    </script>
@endpush
