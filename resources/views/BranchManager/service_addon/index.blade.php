@extends('BranchManager.layouts.master')

@push('title')
Add on Services
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
    <link href="{{ asset('assets/services_asset/services.css') }}" rel="stylesheet"
            type="text/css" />
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
            height: 400px;
            overflow-y: scroll;
            padding-bottom: 15px;
        }


    </style>

    <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-header-title">
                        <h4 class="pull-left page-title">Services </h4>
                        <ol class="breadcrumb pull-right">
                            <li><a href="{{ route('branchManager.dashboard') }}">Branch Manager Panel</a></li>
                            <li class="active">Service</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            @include('Others.message')

            <div class="row mt-5">
                <div class="col-lg-12">
                    <ul class="nav nav-tabs navtab-bg ">
                        <li class="active">
                            <a href="#allService" data-toggle="tab" aria-expanded="false">
                                <span class="visible-xs"><i class="fa fa-home"></i></span>
                                <span class="hidden-xs">All Services</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="#premiem" data-toggle="tab" aria-expanded="false">
                                <span class="visible-xs"><i class="fa fa-user"></i></span>
                                <span class="hidden-xs">Premiem Service</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="#express" data-toggle="tab" aria-expanded="false">
                                <span class="visible-xs"><i class="fa fa-envelope-o"></i></span>
                                <span class="hidden-xs">Express Service</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="#complaints" data-toggle="tab" aria-expanded="false">
                                <span class="visible-xs"><i class="fa fa-cog"></i></span>
                                <span class="hidden-xs">Legal and Complaints</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="#imegration" data-toggle="tab" aria-expanded="false">
                                <span class="visible-xs"><i class="fa fa-cog"></i></span>
                                <span class="hidden-xs">Immigration Service</span>
                            </a>
                        </li>
                        {{-- <li class="">
                            <a href="#other" data-toggle="tab" aria-expanded="false">
                                <span class="visible-xs"><i class="fa fa-cog"></i></span>
                                <span class="hidden-xs">other</span>
                            </a>
                        </li> --}}
                    </ul>
                    <div class="tab-content">
                        {{-- all taken service --}}
                        <div class="tab-pane active" id="allService">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                                    cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Service taken</th>
                                                <th>Total Cost</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>


                                        <tbody>

                                            @foreach ($totalTakenServices as $totalTakenService)

                                            <tr>
                                                <td>{{ $loop->index+1 }}</td>
                                                <td>{{ $totalTakenService->name }}</td>
                                                <td>
                                                    @foreach (json_decode($totalTakenService->service_taken) as $item)
                                                        <span class="badge badge-primary">{{ get_other_service_fee_name_by_id($item) }}</span>
                                                    @endforeach


                                                </td>
                                                <td>{{ $totalTakenService->total_fee }}</td>
                                                <td>{{ \Carbon\Carbon::parse($totalTakenService->created_at)->format('Y-m-d') }}</td>

                                            </tr>
                                            @endforeach



                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                        {{-- Premiam service --}}
                        <div class="tab-pane" id="premiem">
                            <div class="row">
                                <form action="{{ route('branchManager.addExtraService.store') }}" method="post" id="basic-form"
                                    enctype="multipart/form-data" novalidate="novalidate">
                                    @csrf
                                    {{-- @include('Others.message') --}}
                                    <div class="row">
                                         {{-- service add on  start --}}
                                         <label class="sercice_label">Add On Service</label>
                                         <div class="add-on-container shadow">
                                             @foreach ($premierServices as $service)
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
                                    <div class="row">
                                        <!-----fast col start------>
                                        <div class="col-md-6">

                                            {{-- service add on  end --}}
                                            <input type="hidden" name="passport_type" value="{{ $type }}">
                                            <input type="hidden" name="passport_id" value="{{ $passportData->id }}">
                                            <input type="hidden" name="service_type" value="premiem_service">
                                            <div class="form-group">
                                                <label for="full_name"> Full Name </label>
                                                <input name="name" value='{{ $passportData->name }}'
                                                    class="form-control required" placeholder="Enter Full Name"
                                                    id="full_name" autocomplete="off" required="" aria-required="true">
                                                @error('name')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="civil_id"> Civil ID <span style="color: red;">*</span>
                                                </label>
                                                <input name="civil_id" value='{{ $passportData->civil_id }}'
                                                    class="form-control" placeholder="Enter Civil ID" id="civil_id"
                                                    autocomplete="off" required="" aria-required="true">
                                                @error('civil_id')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group" id="prv">
                                                <label for="profession"> Profession </label>
                                                <select class="form-control" value='{{ old('profession') }}'
                                                    id="profession" name="profession">
                                                    {{-- <option value="" >--select--</option> --}}
                                                    @foreach ($professions as $profession)

                                                    <option value="{{ $profession->id }}" @if ($profession->id == $passportData->profession_id) selected @endif>{{ $profession->name }}</option>
                                                    @endforeach


                                                </select>
                                                @error('profession')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror

                                            </div>
                                            <div class="form-group">
                                                <label for="passport_number"> Passport No <span style="color: red;">*</span>
                                                </label>
                                                <input name="passport_number" value='{{ $passportData->passport_number }}'
                                                    type="text" class="form-control" placeholder="Enter Passport Number"
                                                    id="passport_number">
                                                @error('passport_number')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <input type="hidden" name="old_passport_photoCopy" value="{{ $passportData->passport_photocopy }}">
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
                                                <input value='{{ $passportData->bd_phone }}' class="form-control datepicker"
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
                                                <input value='{{ $passportData->kuwait_phone }}' class="form-control datepicker"
                                                    name="kuwait_phone" type="text" placeholder="Kuwait Phone" id="kuwait_phone"
                                                    value="" autocomplete="off">
                                                @error('kuwait_phone')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="special_skill"> Special Skill </label>
                                                <input value='{{ $passportData->special_skill }}' name="special_skill"
                                                    type="text" class="form-control" placeholder="Enter Special Skill "
                                                    id="special_skill">
                                                @error('special_skill')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="residence"> Residence Civil ID / phone No </label>
                                                <input value='{{ $passportData->residence }}' name="residence" type="text"
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
                                                    placeholder="Enter Mailing Address">{{ $passportData->mailing_address }}</textarea>
                                                @error('mailing_address')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="permanent_address"> Bangladesh Permanent Address </label>
                                                <textarea class="form-control" rows="4" cols="50" name="permanent_address"
                                                    autocomplete="off"
                                                    placeholder="Enter Bangladesh PermanentAddress">{{ $passportData->permanent_address }}</textarea>
                                                @error('permanent_address')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <button type="submit" class="btn btn-primary"> Submit </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        {{-- express service --}}
                        <div class="tab-pane" id="express">
                            <div class="row">
                                <form action="{{ route('branchManager.addExtraService.store') }}" method="post" id="basic-form"
                                    enctype="multipart/form-data" novalidate="novalidate">
                                    @csrf
                                    {{-- @include('Others.message') --}}
                                    <div class="row">
                                         {{-- service add on  start --}}
                                         <label class="sercice_label">Add On Service</label>
                                         <div class="add-on-container shadow">
                                             @foreach ($expressServices as $service)
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
                                    <div class="row">
                                        <!-----fast col start------>
                                        <div class="col-md-6">

                                            {{-- service add on  end --}}
                                            <input type="hidden" name="passport_type" value="{{ $type }}">
                                            <input type="hidden" name="passport_id" value="{{ $passportData->id }}">
                                            <input type="hidden" name="service_type" value="express_service">
                                            <div class="form-group">
                                                <label for="full_name"> Full Name </label>
                                                <input name="name" value='{{ $passportData->name }}'
                                                    class="form-control required" placeholder="Enter Full Name"
                                                    id="full_name" autocomplete="off" required="" aria-required="true">
                                                @error('name')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="civil_id"> Civil ID <span style="color: red;">*</span>
                                                </label>
                                                <input name="civil_id" value='{{ $passportData->civil_id }}'
                                                    class="form-control" placeholder="Enter Civil ID" id="civil_id"
                                                    autocomplete="off" required="" aria-required="true">
                                                @error('civil_id')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group" id="prv">
                                                <label for="profession"> Profession </label>
                                                <select class="form-control" value='{{ old('profession') }}'
                                                    id="profession" name="profession">
                                                    {{-- <option value="" >--select--</option> --}}
                                                    @foreach ($professions as $profession)

                                                    <option value="{{ $profession->id }}" @if ($profession->id == $passportData->profession_id) selected @endif>{{ $profession->name }}</option>
                                                    @endforeach


                                                </select>
                                                @error('profession')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror

                                            </div>
                                            <div class="form-group">
                                                <label for="passport_number"> Passport No <span style="color: red;">*</span>
                                                </label>
                                                <input name="passport_number" value='{{ $passportData->passport_number }}'
                                                    type="text" class="form-control" placeholder="Enter Passport Number"
                                                    id="passport_number">
                                                @error('passport_number')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                           <div class="form-group">
                                                <input type="hidden" name="old_passport_photoCopy" value="{{ $passportData->passport_photocopy }}">
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
                                                <input value='{{ $passportData->bd_phone }}' class="form-control datepicker"
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
                                                <input value='{{ $passportData->kuwait_phone }}' class="form-control datepicker"
                                                    name="kuwait_phone" type="text" placeholder="Kuwait Phone" id="kuwait_phone"
                                                    value="" autocomplete="off">
                                                @error('kuwait_phone')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>


                                            <div class="form-group">
                                                <label for="special_skill"> Special Skill </label>
                                                <input value='{{ $passportData->special_skill }}' name="special_skill"
                                                    type="text" class="form-control" placeholder="Enter Special Skill "
                                                    id="special_skill">
                                                @error('special_skill')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="residence"> Residence Civil ID / phone No </label>
                                                <input value='{{ $passportData->residence }}' name="residence" type="text"
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
                                                    placeholder="Enter Mailing Address">{{ $passportData->mailing_address }}</textarea>
                                                @error('mailing_address')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="permanent_address"> Bangladesh Permanent Address </label>
                                                <textarea class="form-control" rows="4" cols="50" name="permanent_address"
                                                    autocomplete="off"
                                                    placeholder="Enter Bangladesh PermanentAddress">{{ $passportData->permanent_address }}</textarea>
                                                @error('permanent_address')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <button type="submit" class="btn btn-primary"> Submit </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        {{-- complaints service --}}
                        <div class="tab-pane" id="complaints">
                            <div class="row">
                                <form action="{{ route('branchManager.addExtraService.store') }}" method="post" id="basic-form"
                                    enctype="multipart/form-data" novalidate="novalidate">
                                    @csrf
                                    {{-- @include('Others.message') --}}
                                    <div class="row">
                                         {{-- service add on  start --}}
                                         <label class="sercice_label">Add On Service</label>
                                         <div class="add-on-container shadow">
                                             @foreach ($legalComplaintsServices as $service)
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
                                    <div class="row">
                                        <!-----fast col start------>
                                        <div class="col-md-6">

                                            {{-- service add on  end --}}
                                            <input type="hidden" name="passport_type" value="{{ $type }}">
                                            <input type="hidden" name="passport_id" value="{{ $passportData->id }}">
                                            <input type="hidden" name="service_type" value="legel_service">
                                            <div class="form-group">
                                                <label for="full_name"> Full Name </label>
                                                <input name="name" value='{{ $passportData->name }}'
                                                    class="form-control required" placeholder="Enter Full Name"
                                                    id="full_name" autocomplete="off" required="" aria-required="true">
                                                @error('name')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="civil_id"> Civil ID <span style="color: red;">*</span>
                                                </label>
                                                <input name="civil_id" value='{{ $passportData->civil_id }}'
                                                    class="form-control" placeholder="Enter Civil ID" id="civil_id"
                                                    autocomplete="off" required="" aria-required="true">
                                                @error('civil_id')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group" id="prv">
                                                <label for="profession"> Profession </label>
                                                <select class="form-control" value='{{ old('profession') }}'
                                                    id="profession" name="profession">
                                                    {{-- <option value="" >--select--</option> --}}
                                                    @foreach ($professions as $profession)

                                                    <option value="{{ $profession->id }}" @if ($profession->id == $passportData->profession_id) selected @endif>{{ $profession->name }}</option>
                                                    @endforeach


                                                </select>
                                                @error('profession')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror

                                            </div>
                                            <div class="form-group">
                                                <label for="passport_number"> Passport No <span style="color: red;">*</span>
                                                </label>
                                                <input name="passport_number" value='{{ $passportData->passport_number }}'
                                                    type="text" class="form-control" placeholder="Enter Passport Number"
                                                    id="passport_number">
                                                @error('passport_number')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                           <div class="form-group">
                                                <input type="hidden" name="old_passport_photoCopy" value="{{ $passportData->passport_photocopy }}">
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
                                                <input value='{{ $passportData->bd_phone }}' class="form-control datepicker"
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
                                                <input value='{{ $passportData->kuwait_phone }}' class="form-control datepicker"
                                                    name="kuwait_phone" type="text" placeholder="Kuwait Phone" id="kuwait_phone"
                                                    value="" autocomplete="off">
                                                @error('kuwait_phone')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>


                                            <div class="form-group">
                                                <label for="special_skill"> Special Skill </label>
                                                <input value='{{ $passportData->special_skill }}' name="special_skill"
                                                    type="text" class="form-control" placeholder="Enter Special Skill "
                                                    id="special_skill">
                                                @error('special_skill')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="residence"> Residence Civil ID / phone No </label>
                                                <input value='{{ $passportData->residence }}' name="residence" type="text"
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
                                                    placeholder="Enter Mailing Address">{{ $passportData->mailing_address }}</textarea>
                                                @error('mailing_address')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="permanent_address"> Bangladesh Permanent Address </label>
                                                <textarea class="form-control" rows="4" cols="50" name="permanent_address"
                                                    autocomplete="off"
                                                    placeholder="Enter Bangladesh PermanentAddress">{{ $passportData->permanent_address }}</textarea>
                                                @error('permanent_address')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <button type="submit" class="btn btn-primary"> Submit </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        {{-- imegration service --}}
                        <div class="tab-pane" id="imegration">
                            <div class="row">
                                <form action="{{ route('branchManager.addExtraService.store') }}" method="post" id="basic-form"
                                    enctype="multipart/form-data" novalidate="novalidate">
                                    @csrf
                                    {{-- @include('Others.message') --}}
                                    <div class="row">
                                         {{-- service add on  start --}}
                                         <label class="sercice_label">Add On Service</label>
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
                                    <div class="row">
                                        <!-----fast col start------>
                                        <div class="col-md-6">

                                            {{-- service add on  end --}}
                                            <input type="hidden" name="passport_type" value="{{ $type }}">
                                            <input type="hidden" name="passport_id" value="{{ $passportData->id }}">
                                            <input type="hidden" name="service_type" value="immegraion_service">
                                            <div class="form-group">
                                                <label for="full_name"> Full Name </label>
                                                <input name="name" value='{{ $passportData->name }}'
                                                    class="form-control required" placeholder="Enter Full Name"
                                                    id="full_name" autocomplete="off" required="" aria-required="true">
                                                @error('name')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="civil_id"> Civil ID <span style="color: red;">*</span>
                                                </label>
                                                <input name="civil_id" value='{{ $passportData->civil_id }}'
                                                    class="form-control" placeholder="Enter Civil ID" id="civil_id"
                                                    autocomplete="off" required="" aria-required="true">
                                                @error('civil_id')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group" id="prv">
                                                <label for="profession"> Profession </label>
                                                <select class="form-control" value='{{ old('profession') }}'
                                                    id="profession" name="profession">
                                                    {{-- <option value="" >--select--</option> --}}
                                                    @foreach ($professions as $profession)

                                                    <option value="{{ $profession->id }}" @if ($profession->id == $passportData->profession_id) selected @endif>{{ $profession->name }}</option>
                                                    @endforeach


                                                </select>
                                                @error('profession')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror

                                            </div>
                                            <div class="form-group">
                                                <label for="passport_number"> Passport No <span style="color: red;">*</span>
                                                </label>
                                                <input name="passport_number" value='{{ $passportData->passport_number }}'
                                                    type="text" class="form-control" placeholder="Enter Passport Number"
                                                    id="passport_number">
                                                @error('passport_number')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                           <div class="form-group">
                                                <input type="hidden" name="old_passport_photoCopy" value="{{ $passportData->passport_photocopy }}">
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
                                                <input value='{{ $passportData->bd_phone }}' class="form-control datepicker"
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
                                                <input value='{{ $passportData->kuwait_phone }}' class="form-control datepicker"
                                                    name="kuwait_phone" type="text" placeholder="Kuwait Phone" id="kuwait_phone"
                                                    value="" autocomplete="off">
                                                @error('kuwait_phone')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>


                                            <div class="form-group">
                                                <label for="special_skill"> Special Skill </label>
                                                <input value='{{ $passportData->special_skill }}' name="special_skill"
                                                    type="text" class="form-control" placeholder="Enter Special Skill "
                                                    id="special_skill">
                                                @error('special_skill')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="residence"> Residence Civil ID / phone No </label>
                                                <input value='{{ $passportData->residence }}' name="residence" type="text"
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
                                                    placeholder="Enter Mailing Address">{{ $passportData->mailing_address }}</textarea>
                                                @error('mailing_address')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="permanent_address"> Bangladesh Permanent Address </label>
                                                <textarea class="form-control" rows="4" cols="50" name="permanent_address"
                                                    autocomplete="off"
                                                    placeholder="Enter Bangladesh PermanentAddress">{{ $passportData->permanent_address }}</textarea>
                                                @error('permanent_address')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <button type="submit" class="btn btn-primary"> Submit </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        {{-- other service --}}
                        {{-- <div class="tab-pane" id="other">

                        </div> --}}
                    </div>

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
       <!--services selection--->
       <script src="{{ asset('assets/services_asset/services.js') }}"></script>
@endpush

