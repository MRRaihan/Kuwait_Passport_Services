@extends('BranchManager.layouts.master')

@push('title')
Lost Passport Edit
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
                        <h4 class="pull-left page-title">Lost Passport Edit</h4>
                        <ol class="breadcrumb pull-right">
                            <li><a href="{{ route('branchManager.dashboard') }}">Branch Manager Panel</a></li>
                            <li class="active">Passport</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading" style="background-color: #01ba9a !important;">
                            <span class="panel-title">Lost Passport Edit
                                <!-- Button trigger modal for adding new Category -->
                                <div class="col-sm-12">
                                    <a class="btn btn-warning btn-sm" href="{{ route('branchManager.lostPassport.index') }}"
                                        style="float: right; margin-bottom: 10px; margin-top:-26px;"><i
                                            class="ion-chevron-left"></i>&nbsp; Back</a>
                                </div>
                        </div>
                        <div class="panel-body">

                            {{-- @include('Others.message') --}}
                            <div class="box-body">
                                <form action="{{ route('branchManager.lostPassport.update', $lostPassport) }}" method="post"
                                    id="basic-form" enctype="multipart/form-data" novalidate="novalidate">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <!-----fast col start------>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="passport_type_id"> Passport Type <span style="color: red;">*</span> </label>
                                                <select class="form-control" id="passport_type_id" name="passport_type_id">
                                                    <option disabled selected>-- Select Type --</option>
                                                    @foreach ($lostPassportFees as $passportFee)
                                                        <option value="{{ $passportFee->id }}" @if ($lostPassport->passport_type_id == $passportFee->id) selected @endif>
                                                            {{ $passportFee->title }}</option>
                                                    @endforeach

                                                </select>
                                                  @error('passport_type_id')
                                                    <p class="text-danger">Passport type field is required.</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                      <label for="name"> Full Name <span style="color: red;">*</span> </label>
                                                <input name="name" value='{{ $lostPassport->name }}'
                                                    class="form-control required" placeholder="Enter Full Name"
                                                    id="name" autocomplete="off" required="" aria-required="true">
                                                @error('name')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                @if($lostPassport->gd_report_kuwait)
                                                    <a href="{{ asset($lostPassport->gd_report_kuwait) }}" target="_blank">View File</a>
                                                @else
                                                    <a href="#">No File Found</a>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label for="gd_report_kuwait"> GD Report (Kuwait - Only PDF) </label>
                                                <input name="gd_report_kuwait" class="form-control"
                                                    type="file" accept="application/pdf">
                                                @error('gd_report_kuwait')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                @if($lostPassport->application_form)
                                                    <a href="{{ asset($lostPassport->application_form) }}" target="_blank">View old file</a><br>
                                                @endif
                                                <a id="application_form" href="#" target="">{{ $lostPassport->application_form ? '' : 'No File Found' }}</a>
                                            </div>
                                            <div class="form-group">
                                                <label for="application_form"> Application Form (Image/PDF) </label>
                                                <input name="application_form" class="form-control"
                                                    type="file" accept = "application/pdf,image/jpeg,image/png,image/jpg" onchange="document.getElementById('application_form').href = window.URL.createObjectURL(this.files[0])
                                                    document.getElementById('application_form').innerText = 'Click to view selected file'
                                                    document.getElementById('application_form').target = '_blank'
                                                    ">
                                                @error('application_form')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <img id="passport_photocopy" src="{{ asset($lostPassport->passport_photocopy ?? get_static_option('no_image'))  }}" alt="your image" width="100" height="100" />
                                            </div>

                                            <div class="form-group">
                                                <label for="passport_photocopy"> Passport Photo Copy </label>
                                                <input name="passport_photocopy" class="form-control"
                                                    type="file" onchange="document.getElementById('passport_photocopy').src = window.URL.createObjectURL(this.files[0])" accept="image/*">
                                                @error('passport_photocopy')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="bd_phone"> Bangladesh phone Number </label>
                                                <input name="bd_phone" value='{{ $lostPassport->bd_phone }}' type="text"
                                                    class="form-control" placeholder="Enter Bangladesh phone Number "
                                                    id="bd_phone">
                                                @error('bd_phone')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="permanent_address"> Bangladesh Permanent Address </label>
                                                <textarea class="form-control" rows="4" cols="50" name="permanent_address"  placeholder="Enter Bangladesh Permanent Address">{{ $lostPassport->permanent_address }}</textarea>
                                                @error('permanent_address')
                                                    <p class="text-danger">(*){{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="expiry_date"> Passport Expiry Date </label>
                                                <input name="expiry_date" value="{{ \Carbon\Carbon::parse($lostPassport->expiry_date)->format('Y-m-d') }}"
                                                    class="form-control" type="date">
                                                @error('expiry_date')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="dob"> Date Of Birth </label>
                                                <input name="dob" value="{{ \Carbon\Carbon::parse($lostPassport->dob)->format('Y-m-d') }}" class="form-control" type="date">
                                                @error('dob')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            {{-- <div class="form-group">
                                                <label for="delivery_branch">Delivery Branch <span style="color: red;">*</span></label>
                                                <select class="form-control" name="delivery_branch">
                                                    <option value="">-- Select Branch --</option>
                                                    @foreach ($branchs as $key => $branch)
                                                        <option value="{{ $branch->id }}" @if ($lostPassport->delivery_branch == $branch->id) selected @endif>
                                                            {{ $branch->name }}</option>
                                                    @endforeach

                                                </select>
                                                @error('delivery_branch')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div> --}}
                                        </div>
                                        <!---fast col end--->

                                        <!---second col start-->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="residence"> Residence Civil ID / Phone No  </label>
                                                <input name="residence" value='{{ $lostPassport->residence }}' class="form-control"
                                                    placeholder="Residence Civil ID / Phone No" id="residence" autocomplete="off" required=""
                                                    aria-required="true">
                                                @error('residence')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="civil_id"> Civil ID <span style="color: red;">*</span> </label>
                                                <input name="civil_id" value='{{ $lostPassport->civil_id }}' class="form-control"
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
                                                        <option value="{{ $profession->id }}" @if ($lostPassport->profession_id == $profession->id) selected @endif>
                                                            {{ $profession->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('profession_id')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror

                                            </div>
                                            <div class="form-group">
                                                <label for="passport_number"> Passport No <span style="color: red;">*</span> </label>
                                                <input name="passport_number" value='{{ $lostPassport->passport_number }}' type="text"
                                                    class="form-control" placeholder="Enter Passport Number"
                                                    id="passport_number">
                                                @error('passport_number')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="kuwait_phone"> Kuwait Phone No  <span style="color: red;">*</span> </label>
                                                <input name="kuwait_phone" value='{{ $lostPassport->kuwait_phone }}' type="text"
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
                                                    placeholder="Enter Mailing Address">{{ $lostPassport->mailing_address }}</textarea>
                                                @error('mailing_address')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="special_skill"> Special Skill </label>
                                                <input name="special_skill" value='{{ $lostPassport->special_skill }}' type="text"
                                                    class="form-control" placeholder="Enter Special Skill"
                                                    id="special_skill">
                                                @error('special_skill')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            {{-- <div class="form-group">
                                                <label for="extended_to">Passport Extending To</label>
                                                <input value='{{ $lostPassport->extended_to }}' name="extended_to" type="date"
                                                    class="form-control" placeholder="Passport Extending To"
                                                    id="extended_to">
                                                @error('extended_to')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div> --}}

                                            {{-- <div class="form-group">
                                                <label for="delivery_date"> Delivery Date </label>
                                                <input value='{{ \Carbon\Carbon::parse($lostPassport->delivery_date)->format('Y-m-d') }}' class="form-control datepicker"
                                                    name="delivery_date" type="date" placeholder="Enter Deliver Date"
                                                    id="delivery_date" value="" autocomplete="off">
                                                @error('delivery_date')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div> --}}
                                            {{-- <div class="form-group">
                                                <label for="salary">Salary</label>
                                                <select class="form-control" id="salary" name="salary">
                                                    <option disabled selected>-- Select salary --</option>
                                                    @foreach ($salaries as $key => $salary)
                                                        <option value="{{ $salary->id }}" @if ($lostPassport->salary == $salary->id) selected @endif>
                                                            {{ $salary->title }} ({{ $salary->amount }})</option>
                                                    @endforeach
                                                </select>
                                                @error('salary')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div> --}}
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
        </div>
    </div>

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
