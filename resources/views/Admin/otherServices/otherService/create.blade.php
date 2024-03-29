@extends('Admin.layouts.master')

@push('title')
    Others Passport Create
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
    <link href="{{ asset('assets/admin/plugins/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/admin/plugins/datatables/scroller.bootstrap.min.css') }}" rel="stylesheet"
        type="text/css" />
@endpush
@section('content')

    <style>
        td,
        th {
            text-align: center;
        }
    </style>

    <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-header-title">
                        <h4 class="pull-left page-title">Others Service Create</h4>
                        <ol class="breadcrumb pull-right">
                            <li><a href="{{ route('admin.dashboard') }}">Admin Panel</a></li>
                            <li class="active">Others Service</li>
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
                        <div class="panel-heading">
                            <span class="panel-title">Others Service Create
                                <!-- Button trigger modal for adding new Category -->
                                <div class="col-sm-12">
                                    <a class="btn btn-warning btn-sm" href="{{ route('admin.otherService.index') }}"
                                        style="float: right; margin-bottom: 10px; margin-top:-26px;"><i
                                            class="ion-chevron-left"></i>&nbsp; Back</a>
                                </div>
                        </div>
                        <div class="panel-body">
                            <div class="box-body">
                                <form action="{{ route('admin.otherService.store') }}" method="post" id="basic-form"
                                    enctype="multipart/form-data" novalidate="novalidate">
                                    @csrf
                                    {{-- @include('Others.message') --}}
                                    <div class="row">
                                        <!-----fast col start------>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="full_name"> Full Name </label>
                                                <input name="name" value='{{ old('name') }}' class="form-control required"
                                                    placeholder="Enter Full Name" id="full_name" autocomplete="off"
                                                    required="" aria-required="true">
                                                @error('name')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="civil_id"> Civil ID <span style="color: red;">*</span>
                                                </label>
                                                <input name="civil_id" value='{{ old('civil_id') }}'
                                                    class="form-control" placeholder="Enter Civil ID" id="civil_id"
                                                    autocomplete="off" required="" aria-required="true">
                                                @error('civil_id')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="form-group" id="prv">
                                                <label for="profession"> Profession </label>
                                                <select class="form-control" value='{{ old('profession') }}'
                                                    id="profession" name="profession_id">
                                                    <option value="">--select--</option>
                                                    @foreach ($professions as $key => $profession)
                                                    <option value="{{ $profession->id }}" @if (old('profession_id') == $profession->id) selected @endif>
                                                        {{ $profession->name }}</option>
                                                @endforeach
                                                </select>
                                                @error('profession')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror

                                            </div>
                                            <div class="form-group">
                                                <label for="passport_number"> Passport No <span style="color: red;">*</span>
                                                </label>
                                                <input name="passport_number" value='{{ old('passport_number') }}'
                                                    type="text" class="form-control" placeholder="Enter Passport Number"
                                                    id="passport_number">
                                                @error('passport_number')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <a id="profession_file" href="#" target="">No File Chosen</a>
                                            </div>
                                            <div class="form-group">
                                                <label for="profession_file"> Profession File (Image/PDF) </label>
                                                <input name="profession_file" class="form-control"
                                                    type="file" accept = "application/pdf,image/jpeg,image/png,image/jpg" onchange="document.getElementById('profession_file').href = window.URL.createObjectURL(this.files[0])
                                                    document.getElementById('profession_file').innerText = 'Click to view selected file'
                                                    document.getElementById('profession_file').target = '_blank'
                                                    ">
                                                @error('profession_file')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <img id="passport_photocopy" src="{{ asset(get_static_option('no_image'))  }}" alt="your image" width="100" height="100" />
                                            </div>

                                            <div class="form-group">
                                                <label for="passport_photocopy"> Passport Photocopy </label>
                                                <input name="passport_photocopy" class="form-control"
                                                    type="file" onchange="document.getElementById('passport_photocopy').src = window.URL.createObjectURL(this.files[0])" accept="image/*">
                                                @error('passport_photocopy')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="bd_phone"> Bangladesh phone Number </label>
                                                <input name="bd_phone" value='{{ old('bd_phone') }}' type="number"
                                                    class="form-control" placeholder="Enter Bangladesh phone Number "
                                                    id="bd_phone">
                                                @error('bd_phone')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="salary">Salary</label>
                                                <select class="form-control" id="salary" value='{{ old('salary') }}'
                                                    name="salary">
                                                    <option value="" disabled selected>---select--</option>
                                                    <option value="Less Than BD 250">Less Than BD 250</option>
                                                    <option value="Equal or Greater Than BD 250">Equal or Greater Than BD 250</option>
                                                </select>
                                                @error('salary')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="fee"> Fee </label>
                                                <input name="fee" value='{{ old('fee') }}' type="number"
                                                    class="form-control" placeholder="Fee" id="fee">
                                                @error('fee')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                        </div>
                                        <!---fast col end--->

                                        <!---second col start-->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="kuwait_phone"> Kuwait Phone No <span style="color: red;">*</span>
                                                </label>
                                                <input value='{{ old('kuwait_phone') }}' class="form-control datepicker"
                                                    name="kuwait_phone" type="text" placeholder="Kuwait Phone" id="kuwait_phone"
                                                    value="" autocomplete="off">
                                                @error('kuwait_phone')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                             {{-- <div class="form-group">
                                                <label for="delivery_date"> Delivery Date </label>
                                                <input value='{{ old('delivery_date') }}' class="form-control datepicker"
                                                    name="delivery_date" type="date" placeholder="Enter Deliver Date"
                                                    id="delivery_date" value="" autocomplete="off">
                                                @error('delivery_date')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div> --}}
                                            <div class="form-group">
                                                <label for="delivery_branch">Delivery Branch <span
                                                        style="color: red;">*</span></label>
                                                <select class="form-control" value='{{ old('salary') }}' id="salary"
                                                    name="delivery_branch">
                                                    @foreach ($branchs as $key => $branch)
                                                        <option value="{{ $branch->id }}" @if (old('delivery_branch') == $branch->id) selected @endif>
                                                            {{ $branch->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('salary')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="entry_person">Entry Person</label>
                                                <input value='{{ old('entry_person') }}' class="form-control"
                                                    name="entry_person" type="text" placeholder="Entry Person Name"
                                                    id="entry_person">
                                                @error('entry_person')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="special_skill"> Special Skill </label>
                                                <input value='{{ old('special_skill') }}' name="special_skill"
                                                    type="text" class="form-control" placeholder="Enter Special Skill "
                                                    id="special_skill">
                                                @error('special_skill')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="residence"> Residence Civil ID / phone No </label>
                                                <input value='{{ old('residence') }}' name="residence" type="text"
                                                    class="form-control"
                                                    placeholder="Enter Residence Civil ID / phone No " id="residence">
                                                @error('residence')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="mailing_address"> Mailing Address </label>
                                                <textarea class="form-control" rows="4" cols="50" name="mailing_address"
                                                    autocomplete="off"
                                                    placeholder="Enter Mailing Address">{{ old('mailing_address') }}</textarea>
                                                @error('mailing_address')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="permanent_address"> Bangladesh Permanent Address </label>
                                                <textarea class="form-control" rows="4" cols="50" name="permanent_address"
                                                    autocomplete="off"
                                                    placeholder="Enter Bangladesh PermanentAddress">{{ old('permanent_address') }}</textarea>
                                                @error('permanent_address')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12 text-right">
                                            <button type="submit" class="btn btn-primary"> Submit </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Row -->
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
