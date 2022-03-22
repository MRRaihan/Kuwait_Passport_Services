@extends('BranchManager.layouts.master')

@push('title')
    Manual Passport Edit
@endpush
@push('datatableCSS')
    <!-- DataTables -->
    <link href="{{ asset('assets/branch-manager/plugins/datatables/jquery.dataTables.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/branch-manager/plugins/datatables/buttons.bootstrap.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/branch-manager/plugins/datatables/fixedHeader.bootstrap.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/branch-manager/plugins/datatables/responsive.bootstrap.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/branch-manager/plugins/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/branch-manager/plugins/datatables/scroller.bootstrap.min.css') }}" rel="stylesheet"
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
                        <h4 class="pull-left page-title">User lost Passport Review</h4>
                        <ol class="breadcrumb pull-right">
                            <li><a href="{{ route('branchManager.dashboard') }}">Branch Manager Panel</a></li>
                            <li class="active">Manual Passport</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading" style="background-color: #01ba9a !important;">
                            <span class="panel-title">Manual Passport Review
                                <!-- Button trigger modal for adding new Category -->
                                <div class="col-sm-12">
                                    <a class="btn btn-warning btn-sm"
                                        href="{{ route('branchManager.newBornBabyPassport.index') }}"
                                        style="float: right; margin-bottom: 10px; margin-top:-26px;"><i
                                            class="ion-chevron-left"></i>&nbsp; Back</a>
                                </div>
                        </div>
                        <div class="panel-body">
                            <div class="box-body">
                                <form action="{{ route('branchManager.newBornBabyPassport.update', $newBornBabyPassport->id) }}"
                                    method="post" id="basic-form" enctype="multipart/form-data" novalidate="novalidate">
                                    @csrf
                                    @method('PUT')
                                    {{-- @include('Others.message') --}}

                                    <div class="row">
                                        <!-----fast col start------>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="passport_type_id"> Passport Type <span style="color: red;">*</span> </label>
                                                <select class="form-control" id="passport_type_id" name="passport_type_id">
                                                    <option disabled selected>-- Select Type --</option>
                                                    @foreach ($newBornBabyPassportFees as $passportFee)
                                                        <option {{ $passportFee->id == $newBornBabyPassport->passport_type_id ? 'selected' : '' }} value="{{ $passportFee->id }}" @if ($newBornBabyPassport->passport_type_id == $passportFee->id) selected @endif>
                                                            {{ $passportFee->title }}</option>
                                                    @endforeach

                                                </select>
                                                  @error('passport_type_id')
                                                    <p class="text-danger">Passport type field is required.</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                      <label for="name"> Full Name <span style="color: red;">*</span> </label>
                                                <input name="name" value='{{ $newBornBabyPassport->name }}'
                                                    class="form-control required" placeholder="Enter Full Name"
                                                    id="name" autocomplete="off" required="" aria-required="true">
                                                @error('name')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                @if($newBornBabyPassport->profession_file)
                                                    <a href="{{ asset($newBornBabyPassport->profession_file) }}" target="_blank">View File</a>
                                                @else
                                                    <a href="#">No File Found</a>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label for="profession_file"> Profession File (Only PDF) </label>
                                                <input name="profession_file" class="form-control"
                                                    type="file" accept = "application/pdf">
                                                @error('profession_file')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                @if($newBornBabyPassport->application_form)
                                                    <a href="{{ asset($newBornBabyPassport->application_form) }}" target="_blank">View File</a>
                                                @else
                                                    <a href="#">No File Found</a>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="application_form"> Application Form (Only PDF) </label>
                                                <input name="application_form" class="form-control"
                                                    type="file" accept="application/pdf">
                                                @error('application_form')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>



                                            <div class="form-group">
                                                <img id="passport_photocopy" src="{{ asset($newBornBabyPassport->passport_photocopy ?? get_static_option('no_image'))  }}" alt="your image" width="100" height="100" />
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
                                                <label for="bd_phone"> Bangladesh Phone Number </label>
                                                <input name="bd_phone" value='{{ $newBornBabyPassport->bd_phone }}' type="text"
                                                    class="form-control" placeholder="Enter Bangladesh Phone Number "
                                                    id="bd_phone">
                                                @error('bd_phone')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="permanent_address"> Bangladesh Permanent Address </label>
                                                <textarea class="form-control" rows="4" cols="50" name="permanent_address"  placeholder="Enter Bangladesh Permanent Address">{{ $newBornBabyPassport->permanent_address }}</textarea>
                                                @error('permanent_address')
                                                    <p class="text-danger">(*){{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="expiry_date"> Passport Expiry Date </label>
                                                <input name="expiry_date" value="{{ $newBornBabyPassport->expiry_date == null ? '' : \Carbon\Carbon::parse($newBornBabyPassport->expiry_date)->format('Y-m-d') }}"
                                                    class="form-control" type="date">
                                                @error('expiry_date')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="dob"> Date Of Birth </label>
                                                <input name="dob" value="{{ $newBornBabyPassport->dob == null ? '' : \Carbon\Carbon::parse($newBornBabyPassport->dob)->format('Y-m-d') }}"
                                                    class="form-control" type="date">
                                                @error('dob')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            {{-- <div class="form-group">
                                                <label for="delivery_branch">Delivery Branch <span style="color: red;">*</span></label>
                                                <select class="form-control" name="delivery_branch">
                                                    <option value="">-- Select Branch --</option>
                                                    @foreach ($branchs as $key => $branch)

                                                        <option value="{{ $branch->id }}" @if ($newBornBabyPassport->delivery_branch == $branch->id) selected @endif>
                                                            {{ $branch->name }}</option>
                                                    @endforeach

                                                </select>
                                                @error('delivery_branch')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div> --}}
                                            {{-- <div class="form-group">
                                                <label for="residence"> Residence Civil ID / Phone No  </label>
                                                <input name="residence" value='{{ $newBornBabyPassport->residence }}' class="form-control"
                                                    placeholder="Residence Civil ID / Phone No" id="residence" autocomplete="off" required=""
                                                    aria-required="true">
                                                @error('residence')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div> --}}
                                        </div>
                                        <!---fast col end--->

                                        <!---second col start-->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="civil_id"> Civil ID <span style="color: red;">*</span> </label>
                                                <input name="civil_id" value='{{ $newBornBabyPassport->civil_id }}' class="form-control"
                                                    placeholder="Enter Civil ID" id="civil_id" autocomplete="off" required=""
                                                    aria-required="true">
                                                @error('civil_id')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group" id="prv">
                                                <label for="profession"> Profession </label>
                                                <select class="form-control" id="profession" name="profession_id">
                                                    <option value="">-- Select Profession --</option>
                                                    @foreach ($professions as $key => $profession)
                                                        <option value="{{ $profession->id }}" @if ($newBornBabyPassport->profession_id == $profession->id) selected @endif>
                                                            {{ $profession->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('profession_id')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror

                                            </div>
                                            <div class="form-group">
                                                <label for="passport_number"> Passport No <span style="color: red;">*</span> </label>
                                                <input name="passport_number" value='{{ $newBornBabyPassport->passport_number }}' type="text"
                                                    class="form-control" placeholder="Enter Passport Number"
                                                    id="passport_number">
                                                @error('passport_number')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="kuwait_phone"> Kuwait Phone No  <span style="color: red;">*</span> </label>
                                                <input name="kuwait_phone" value='{{ $newBornBabyPassport->kuwait_phone }}' type="text"
                                                    class="form-control" placeholder="Kuwait Phone No"
                                                    id="kuwait_phone">
                                                @error('kuwait_phone')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="mailing_address"> Mailing Address </label>
                                                <textarea class="form-control" rows="4" cols="50" name="mailing_address"
                                                    autocomplete="off"
                                                    placeholder="Enter Mailing Address">{{ $newBornBabyPassport->mailing_address }}</textarea>
                                                @error('mailing_address')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            {{-- <div class="form-group">
                                                <label for="special_skill"> Special Skill </label>
                                                <input name="special_skill" value='{{ $newBornBabyPassport->special_skill }}' type="text"
                                                    class="form-control" placeholder="Enter Special Skill"
                                                    id="special_skill">
                                                @error('special_skill')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div> --}}
                                            <div class="form-group">
                                                <label for="extended_to">Passport Extending To</label>
                                                <input value='{{ $newBornBabyPassport->extended_to == null ? '' : \Carbon\Carbon::parse($newBornBabyPassport->extended_to)->format('Y-m-d') }}' name="extended_to" type="date"
                                                    class="form-control" placeholder="Passport Extending To"
                                                    id="extended_to">
                                                @error('extended_to')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="post_office"> Post Office ID </label>
                                                <input name="post_office" value='{{ $newBornBabyPassport->post_office }}'
                                                    type="text" class="form-control" placeholder="Enter Post Office ID"
                                                    id="post_office">
                                                @error('post_office')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="delivery_date"> Delivery Date </label>
                                                <input value='{{ $newBornBabyPassport->delivery_date == null ? '' : \Carbon\Carbon::parse($newBornBabyPassport->delivery_date)->format('Y-m-d') }}' class="form-control datepicker"
                                                    name="delivery_date" type="date" placeholder="Enter Deliver Date"
                                                    id="delivery_date" value="" autocomplete="off">
                                                @error('delivery_date')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="form-group" style="margin-top: 100px">
                                                <div class="radio radio-info radio-inline">
                                                    <input type="radio" id="active" value="1" {{ $newBornBabyPassport->status == 1 ? 'checked' : '' }} name="status">
                                                    <label for="active"> Approved </label>
                                                </div>
                                                <div class="radio radio-danger radio-inline">
                                                    <input type="radio" id="Inactive" value="0" name="status" {{ $newBornBabyPassport->status == 0 ? 'checked' : '' }}>
                                                    <label for="Inactive"> Unapprove </label>
                                                </div><br>
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
