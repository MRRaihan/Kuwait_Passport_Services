
@extends('DataEnterer.layouts.master')

@push('title')
    Data Enterer Other passport update
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
                    <h4 class="pull-left page-title">Other passport update Form</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ route('dataEnterer.dashboard') }}">Data Enterer Panel</a></li>
                        <li class="active">Other passport</li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        <div class="row text-right">

        </div>

        <div class="row mt-5">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading" style="background-color: #FCC603">
                        <span class="panel-title">Form
                        <!-- Button trigger modal for adding new Category -->
                        <div class="col-sm-12">
                            <a class="btn btn-warning btn-sm" href="{{ route('dataEnterer.otherPassport.index') }}" style="float: right; margin-bottom: 10px; margin-top:-26px;" ><i class="ion-chevron-left"></i>&nbsp; Back</a>
                        </div>
                    </div>
                    <div class="panel-body">


                    <div class="box-body">
                        <form action="{{ route('dataEnterer.otherPassport.update',$otherPassport) }}" method="post" id="basic-form" enctype="multipart/form-data" novalidate="novalidate">
                        @csrf
                        @method('PUT')
                        <div class="row">
                                <!-----fast col start------>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="full_name"> Full Name </label>
                                    <input name="name" value="{{ $otherPassport->name }}" class="form-control required" placeholder="Enter Full Name" id="full_name" autocomplete="off" required="" aria-required="true">
                                    @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="civil_id"> Emirates ID <span style="color: red;">*</span> </label>
                                    <input name="civil_id" value="{{ $otherPassport->civil_id }}" class="form-control" placeholder="Enter Emirates ID" id="civil_id" autocomplete="off" required="" aria-required="true">
                                    @error('civil_id')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group" id="prv">
                                    <label for="profession"> Profession  </label>
                                    <select class="form-control"  id="profession" name="profession">
                                            <option value="{{ $otherPassport->profession_id }}" selected>{{ $otherPassport->profession_id }}</option>
                                            <option value="House Driver">House Driver</option>
                                            <option value="Delivery Man">Delivery Man</option>
                                            <option value="Flexible Worker">Flexible Worker</option>
                                            <option value="Mason">Mason</option>
                                            <option value="Labour">Labour</option>
                                            <option value="Worker">Worker</option>
                                            <option value="Tailor">Tailor</option>
                                            <option value="Graphic Designer">Graphic Designer</option>
                                            <option value="Cleaner">Cleaner</option>
                                            <option value="Florist">Florist</option>
                                            <option value="Painter">Painter</option>
                                            <option value="Cashier">Cashier</option>
                                            <option value="Accountant">Accountant</option>
                                            <option value="Housewife">Housewife</option>
                                            <option value="Counsultant">Counsultant</option>
                                            <option value="Gardener">Gardener</option>
                                            <option value="Nurse">Nurse</option>
                                            <option value="Beautician">Beautician</option>
                                            <option value="Florist">Florist</option>
                                            <option value="Clerk">Clerk</option>
                                            <option value="Salesman">Salesman</option>
                                            <option value="Supervisor">Supervisor</option>
                                            <option value="Manager">Manager</option>
                                            <option value="Electrician">Electrician</option>
                                            <option value="Receptionist">Receptionist</option>
                                            <option value="Plumber">Plumber</option>
                                            <option value="Doctor">Doctor</option>
                                            <option value="Carpenter">Carpenter</option>
                                            <option value="Farmer">Farmer</option>
                                            <option value="Teacher">Teacher</option>
                                            <option value="Businessman">Businessman</option>
                                            <option value="Student">Student</option>
                                        <option value="other"> Other </option>
                                    </select>
                                    @error('profession')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <label for="passport_number"> Passport No <span style="color: red;">*</span> </label>
                                    <input name="passport_number" value="{{ $otherPassport->passport_number }}" type="text" class="form-control" placeholder="Enter Passport Number" id="passport_number">
                                    @error('passport_number')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="photocopy1"> Profession File </label>
                                    <input name="profession_file" class="form-control" id="photocopy1" type="file">
                                    @error('profession_file')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="photocopy"> Passport Photo Copy (Only PDF) </label>
                                    <input name="passport_file" class="form-control" id="photocopy" type="file">
                                    @error('passport_file')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="bd_phone"> Bangladesh phone Number </label>
                                    <input name="bd_phone" value="{{ $otherPassport->bd_phone }}" type="number" class="form-control" placeholder="Enter Bangladesh phone Number " id="bd_phone">
                                    @error('bd_phone')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="salary">Salary</label>
                                    <select class="form-control" id="salary" value="{{ $otherPassport->salary }}" name="salary">
                                        <option value="1">Less Than BD 250</option>
                                        <option value="2">Equal or Greater Than BD 250</option>
                                    </select>
                                    @error('salary')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="fee"> Fee </label>
                                    <input name="fee" value="{{ $otherPassport->fee }}" type="number" class="form-control" placeholder="Enter Fee " id="fee">
                                    @error('fee')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                            </div>
                            <!---fast col end--->

                            <!---second col start-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kuwait_phone"> Kuwait Phone No <span style="color: red;">*</span> </label>
                                    <input value='{{  $otherPassport->kuwait_phone }}' class="form-control datepicker" name="kuwait_phone" type="text" placeholder="Kuwait Phone" id="kuwait_phone" value="" autocomplete="off">
                                    @error('kuwait_phone')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="delivery_date"> Delivery Date  </label>
                                    <input class="form-control datepicker" name="delivery_date" value="{{\Carbon\Carbon::parse($otherPassport->delivery_date)->format('Y-m-d')}}" type="date" placeholder="Enter Deliver Date" id="delivery_date" value="" autocomplete="off">
                                    @error('delivery_date')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                {{-- <div class="form-group">
                                    <label for="delivery_branch">Delivery Branch <span style="color: red;">*</span></label>
                                    <select class="form-control" id="salary" name="delivery_branch">
                                            <option value="{{ $otherPassport->delivery_branch }}" selected>{{ $otherPassport->delivery_branch }}</option>
                                            <option value="42">Manama</option>
                                            <option value="41">Muharraq</option>
                                            <option value="39">Jidhafs</option>
                                            <option value="38">Barbar</option>
                                            <option value="28">Manager</option>
                                        </select>
                                        @error('salary')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                </div> --}}

                                <div class="form-group">
                                    <label for="entry_person">Entry Person</label>
                                    <input class="form-control" name="entry_person" value="{{ $otherPassport->entry_person }}" type="text" placeholder="Entry Person Name" id="entry_person">
                                    @error('entry_person')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="special_skill"> Special Skill </label>
                                    <input name="special_skill" value="{{ $otherPassport->special_skill }}" type="text" class="form-control" placeholder="Enter Special Skill " id="special_skill">
                                    @error('special_skill')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="residence"> Residence Emirates ID / phone No  </label>
                                    <input name="residence" value="{{ $otherPassport->residence }}" type="text" class="form-control" placeholder="Enter Residence Emirates ID / phone No " id="residence">
                                    @error('residence')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="mailing_address"> Mailing Address </label>
                                    <textarea class="form-control" rows="4" cols="50" name="mailing_address" autocomplete="off" placeholder="Enter Mailing Address">{{ $otherPassport->mailing_address }}"</textarea>
                                    @error('mailing_address')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="permanent_address"> Bangladesh Permanent Address </label>
                                    <textarea class="form-control" rows="4" cols="50" name="permanent_address" autocomplete="off" placeholder="Enter Bangladesh PermanentAddress">{{ $otherPassport->permanent_address }}"</textarea>
                                    @error('permanent_address')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                        <button type="submit" class="btn btn-primary"> Submit </button>
                        </form>

                    </div>


                    </div>
                </div>
            </div>
        </div> <!-- End Row -->
    </div> <!-- container -->
</div> <!-- content -->

@if(session()->has('success'))
<script type="text/javascript">
  $(document).ready(function() {
    // notify('{{session()->get('success')}}','success');
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





