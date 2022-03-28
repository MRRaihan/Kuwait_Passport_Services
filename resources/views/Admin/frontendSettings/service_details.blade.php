@extends('Admin.layouts.master')

@push('title')
    Service details
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
                        <h4 class="pull-left page-title">Service details</h4>
                        <ol class="breadcrumb pull-right">
                            <li><a href="{{ route('admin.dashboard') }}">Admin Panel</a></li>
                            <li class="active">Service details</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <span class="panel-title">Service details</span>
                        </div>
                        <div class="panel-body">
                            <div class="box-body">
                                <form action="{{ route('admin.landingSetting.serviceDetailsUpdate') }}" method="post" id="basic-form"
                                    enctype="multipart/form-data" novalidate="novalidate">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="renew_passport_service_details">Renew <span style="color: red;">*</span> </label>
                                                <input name="renew_passport_service_details" value='{{ get_static_option('renew_passport_service_details') }}'
                                                class="form-control required"  id="renew_passport_service_details" autocomplete="off" aria-required="true">
                                                @error('renew_passport_service_details')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="manual_passport_service_details">Manual <span style="color: red;">*</span> </label>
                                                <input name="manual_passport_service_details" value='{{ get_static_option('manual_passport_service_details') }}'
                                                class="form-control required"  id="manual_passport_service_details" autocomplete="off" aria-required="true">
                                                @error('manual_passport_service_details')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="lost_passport_service_details">Lost <span style="color: red;">*</span> </label>
                                                <input name="lost_passport_service_details" value='{{ get_static_option('lost_passport_service_details') }}'
                                                class="form-control required"  id="lost_passport_service_details" autocomplete="off" aria-required="true">
                                                @error('lost_passport_service_details')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="new_born_passport_service_details">New Born Baby <span style="color: red;">*</span> </label>
                                                <input name="new_born_passport_service_details" value='{{ get_static_option('new_born_passport_service_details') }}'
                                                class="form-control required"  id="new_born_passport_service_details" autocomplete="off" aria-required="true">
                                                @error('new_born_passport_service_details')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="e_passport_service_details">E-passport <span style="color: red;">*</span> </label>
                                                <input name="e_passport_service_details" value='{{ get_static_option('e_passport_service_details') }}'
                                                class="form-control required"  id="e_passport_service_details" autocomplete="off" aria-required="true">
                                                @error('e_passport_service_details')
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
