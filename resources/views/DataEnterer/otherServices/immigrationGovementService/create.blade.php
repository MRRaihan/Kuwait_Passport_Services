@extends('DataEnterer.layouts.master')

@push('title')
    Immigration Government Service Create
@endpush
@push('datatableCSS')
    <!-- DataTables -->
    <link href="{{ asset('assets/data-enterer/plugins/datatables/jquery.dataTables.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/data-enterer/plugins/datatables/buttons.bootstrap.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/data-enterer/plugins/datatables/fixedHeader.bootstrap.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/data-enterer/plugins/datatables/responsive.bootstrap.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/data-enterer/plugins/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/data-enterer/plugins/datatables/scroller.bootstrap.min.css') }}" rel="stylesheet"
        type="text/css" />
        <!--services selection--->
        <link href="{{ asset('assets/services_asset/services.css') }}" rel="stylesheet" type="text/css" />
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
                        <h4 class="pull-left page-title">Immigration Government Service Create</h4>
                        <ol class="breadcrumb pull-right">
                            <li><a href="{{ route('dataEnterer.dashboard') }}">Data Enterer</a></li>
                            <li class="active">Immigration Government Service</li>
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
                        <div class="panel-heading" style="background-color: #46bdc6 !important;">
                            <span class="panel-title">Immigration Government Service Create
                                <!-- Button trigger modal for adding new Category -->
                                <div class="col-sm-12">
                                    <a class="btn btn-warning btn-sm"
                                        href="{{ route('dataEnterer.immigrationGovementService.index') }}"
                                        style="float: right; margin-bottom: 10px; margin-top:-26px;"><i
                                            class="ion-chevron-left"></i>&nbsp; Back</a>
                                </div>
                        </div>
                        <div class="panel-body">



                            <div class="row">
                                <form action="{{ route('dataEnterer.immigrationGovementService.store') }}" method="post" id="basic-form" enctype="multipart/form-data" novalidate="novalidate">
                                    @csrf
                                    {{-- @include('Others.message') --}}
                                    <div class="row">
                                         {{-- service add on  start --}}
                                         <label class="sercice_label">Add Services</label>
                                         <div class="add-on-container shadow">
                                             @foreach ($immigrationGovementServices as $service)
                                                 <div class="add-on-item-parent row">
                                                     <div class="col-md-3">
                                                         <div class="checkbox checkbox-primary">
                                                             <input id="service_{{ $service->id }}"
                                                                 class="add-on-service" type="checkbox"
                                                                 value="{{ $service->id }}"
                                                                 name="services[]">
                                                             <label for="service_{{ $service->id }}">
                                                                 {{ $service->title }}
                                                             </label>
                                                         </div>
                                                     </div>
                                                     <div class="col-md-9">
                                                         <div class="add-option-container">
                                                             <div class="add-option">
                                                                 <div class="radio radio-success radio-inline custome_radio">
                                                                     <input type="radio"
                                                                         id="inlineRadio{{ $service->id }}"
                                                                         value="0"
                                                                         name="service_fee_{{ $service->id }}"
                                                                         @if ($service->service_status != 0 && $service->service_status != 2) disabled @else checked  @endif
                                                                         class="fee-on-selection">
                                                                     <label for="inlineRadio{{ $service->id }}">
                                                                         Fix </label>
                                                                 </div>
                                                                 <div class="radio radio-inline radio-primary custome_radio">
                                                                     <input type="radio"
                                                                         id="inlineRadio2{{ $service->id }}"
                                                                         value="1"
                                                                         name="service_fee_{{ $service->id }}"
                                                                         @if ($service->service_status != 1 && $service->service_status != 2) disabled @elseif($service->service_status == 1) checked  @endif
                                                                         class="fee-on-selection">
                                                                     <label for="inlineRadio2{{ $service->id }}">
                                                                         Manual </label>
                                                                 </div>
                                                                 <div class="manual-fee-input-container @if ($service->service_status != 1 ) @else manual-fee-input-container-block  @endif" >
                                                                     <div class="manual-fee-input" >
                                                                         <input type="text" class="form-control"  name="versatilo[]" onkeypress="return /[0-9.]/i.test(event.key)" placeholder="Versatilo">
                                                                         <input type="text" class="form-control"  name="agency[]" onkeypress="return /[0-9.]/i.test(event.key)" placeholder="Agency">
                                                                         <input type="text" class="form-control"  name="govt[]" onkeypress="return /[0-9.]/i.test(event.key)" placeholder="Govt">
                                                                         <input type="text" class="form-control"  name="consultants[]" onkeypress="return /[0-9.]/i.test(event.key)" placeholder="Consultants">
                                                                         <input type="text" class="form-control"  name="ohters[]" onkeypress="return /[0-9.]/i.test(event.key)" placeholder="Ohters">
                                                                     </div>
                                                                 </div>

                                                             </div>
                                                         </div>

                                                     </div>

                                                 </div>
                                             @endforeach


                                         </div><br>
                                    </div>
                                    @error('services')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    <div class="row">
                                        <!-----fast col start------>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="full_name"> Full Name </label>
                                                <input name="name" value='{{ old('name') }}'
                                                    class="form-control required" placeholder="Enter Full Name"
                                                    id="full_name" autocomplete="off" required="" aria-required="true">
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
                                                <select class="form-control"
                                                    id="profession" name="profession">
                                                    <option value="" selected disabled>--select--</option>
                                                    @foreach ($professions as  $profession)

                                                    <option value="{{ $profession->id }}" {{ (old("profession") == $profession->id ? "selected":"") }}>{{ $profession->name }}</option>
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

                                                <label for="passport_photoCopy"> Passport PhotoCopy (Only PDF) </label>
                                                <input name="passport_photoCopy" class="form-control"
                                                    type="file" accept = "application/pdf">
                                                @error('passport_photoCopy')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="bd_phone"> bd Phone No
                                                </label>
                                                <input value='{{ old('bd_phone') }}' class="form-control datepicker"
                                                    name="bd_phone" type="text" placeholder="bd Phone" id="bd_phone"
                                                    value="" autocomplete="off">
                                                @error('bd_phone')
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
       <!--services selection--->
       <script src="{{ asset('assets/services_asset/services.js') }}"></script>
@endpush
