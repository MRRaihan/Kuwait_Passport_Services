@extends('Admin.layouts.master')

@push('title')
    Links
@endpush
@push('datatableCSS')
    <!-- DataTables -->

@endpush
@section('content')
    <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-header-title">
                        <h4 class="pull-left page-title">Links</h4>
                        <ol class="breadcrumb pull-right">
                            <li><a href="{{ route('admin.dashboard') }}">Admin Panel</a></li>
                            <li class="active">Passport</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <span class="panel-title">Links</span>
                        </div>
                        <div class="panel-body">
                            <div class="box-body">
                                <form action="{{ route('admin.landingSetting.linkUpdate') }}" method="post" id="basic-form"
                                    enctype="multipart/form-data" novalidate="novalidate">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="uae_office_link"> UAE Office Link <span style="color: red;">*</span> </label>
                                                <input name="uae_office_link" value='{{ get_static_option('uae_office_link') }}'
                                                class="form-control required"  id="uae_office_link" autocomplete="off" aria-required="true">
                                                @error('uae_office_link')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="kuwait_office_link"> Kuwait Office Link <span style="color: red;">*</span> </label>
                                                <input name="kuwait_office_link" value='{{ get_static_option('kuwait_office_link') }}'
                                                class="form-control required"  id="kuwait_office_link" autocomplete="off" aria-required="true">
                                                @error('kuwait_office_link')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="bahrain_office_link"> Bahrain Office Link <span style="color: red;">*</span> </label>
                                                <input name="bahrain_office_link" value='{{ get_static_option('bahrain_office_link') }}'
                                                class="form-control required"  id="bahrain_office_link" autocomplete="off" aria-required="true">
                                                @error('bahrain_office_link')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="facebook_link">Facebook link <span style="color: red;">*</span> </label>
                                                <input name="facebook_link" value='{{ get_static_option('facebook_link') }}'
                                                class="form-control required"  id="facebook_link" autocomplete="off" aria-required="true">
                                                @error('facebook_link')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="instagram_link">Instagram link <span style="color: red;">*</span> </label>
                                                <input name="instagram_link" value='{{ get_static_option('instagram_link') }}'
                                                class="form-control required"  id="instagram_link" autocomplete="off" aria-required="true">
                                                @error('instagram_link')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="linkedin_link">Linkedin link <span style="color: red;">*</span> </label>
                                                <input name="linkedin_link" value='{{ get_static_option('linkedin_link') }}'
                                                class="form-control required"  id="linkedin_link" autocomplete="off" aria-required="true">
                                                @error('linkedin_link')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="twitter_link">Twitter link <span style="color: red;">*</span> </label>
                                                <input name="twitter_link" value='{{ get_static_option('twitter_link') }}'
                                                class="form-control required"  id="twitter_link" autocomplete="off" aria-required="true">
                                                @error('twitter_link')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12 text-right">
                                            <button type="submit" class="btn btn-primary"> Update </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- End Row -->
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
@endsection

@push('datatableJS')

@endpush
