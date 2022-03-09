@extends('NormalUserDeshbord.service.master')

@section('passport_service')
<div class="col-md-4 mb-3">
    <div class="card shadow mx-auto first-card">
      <div class="card-body">
        <div class="d-flex my-2">

          <img src="{{ isset(auth()->user()->image) ? asset((auth()->user()->image)) : asset('frontend_assets/img/Portals/person.jpeg') }}" class="img-fluid person-img" alt="" />

          <div class="other mx-2">
            <h6 class="m-0 p-0">{{ auth()->user()->name }}</h6>
            <small class="m-0 p-0">{{ auth()->user()->address }}</small>
          </div>
        </div>
        <h5 class="my-5 mx-3 lost-title">{{ passportOptionsUsers()[$type] }}</h5>

        <div class="my-4">
          <ul id="progressbar">
            <li class="active" id="account">
              <strong class="mx-1">Enter details <sub>(step-1)</sub>
              </strong>
            </li>
            <li id="personal">
              <strong class="mx-1">Review <sub>(step-2)</sub></strong>
            </li>
            <li id="payment">
              <strong class="mx-1">Payment <sub>(step-3)</sub></strong>
            </li>
            <!-- <li id="confirm"><strong class="mx-1">Finish</strong></li> -->
          </ul>
        </div>

        <div class="container py-3">
          <div class="card left-content-card">
            <div class="card-body">
              <p class="text-light m-0 p-0">$ Cost list</p>
            </div>
            <div class="
                  d-flex
                  container
                  justify-content-between
                  text-light
                ">
              <span>Service Cost</span>
              <span>$20</span>
            </div>
            <div class="
                  d-flex
                  container
                  justify-content-between
                  text-light
                  my-2
                ">
              <span>Courier Fee</span>
              <span>$20</span>
            </div>
            <div class="
                  d-flex
                  container
                  justify-content-between
                  text-light
                  mb-3
                ">
              <span>Home Delevery fee</span>
              <span>$20</span>
            </div>
          </div>
        </div>

        <div class="text-center my-4">
          <a href="{{ route('normalUser.dashbord') }}">
            <button class="btn submit-btn1 w-50 text-light fw-bold back">
              Back
            </button>
          </a>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-8">
    <form action="{{ route('corporateUser.service.update',$type.'&'.$passport->id) }}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <div class="first-card mx-auto">
              <h5 class="info-title">Edit your information</h5>

              <div class="my-3">
                <label class="form-label">Select Passport Fees</label>
                <select class="form-select select-forms text-muted" name="passport_type_id" id="passport_type_id" aria-label="Default select example">
                  <option value="">Select a Passport Fees</option>
                    @if (isset($passport_fees[0]))
                        @foreach ($passport_fees as $fee)
                          <option value="{{ $fee->id }}" @if ($passport->passport_type_id == $fee->id) selected @endif>
                          {{ $fee->title }} (
                          govt: {{ $fee->government_fee }}| Ver fee:
                          {{ $fee->versatilo_fee }})</option>
                        @endforeach
                    @endif
                </select>
                @if($errors->has('passport_type_id'))
                    <span class="text-danger">{{ $errors->first('passport_type_id') }}</span>
                @endif
              </div>

              <div class="my-3">
                <label class="form-label">Select Branch</label>
                <select class="form-select select-forms text-muted" name="branch_id" id="branch_id" aria-label="Default select example">
                  <option value="">Select a Branch</option>
                    @if (isset($branches[0]))
                        @foreach ($branches as $key => $branch )
                          <option {{ $passport->branch_id == $branch->id ? 'selected' : ''  }} value="{{ $branch->id }}">{{ $branch->name }}</option>
                        @endforeach
                    @endif
                </select>
                @if($errors->has('branch_id'))
                    <span class="text-danger">{{ $errors->first('branch_id') }}</span>
                @endif
              </div>

              <div class="my-3">
                <label class="form-label">Passport type</label>
                <select class="form-select select-forms text-muted" name="passport_type" id="passport_type" aria-label="Default select example">
                  <option value="">Select Passport type</option>
                    @if (isset(passportOptionsUsers()[0]))
                        @foreach (passportOptionsUsers() as $key => $passport_option )
                          <option {{ $type == $key ? 'selected' : 'disabled' }} value="{{ $key }}">{{ $passport_option }}</option>
                        @endforeach
                    @endif
                </select>
                @if($errors->has('passport_type'))
                    <span class="text-danger">{{ $errors->first('passport_type') }}</span>
                @endif
              </div>

              <div class="my-4">
                <label for="exampleFormControlInput1" class="form-label">Passport Number</label>
                <input type="text" class="form-control select-forms" name="passport_number" value="{{ old('passport_number',$passport->passport_number) }}" id="passport_number"
                  placeholder="Enter Passport Number" />
                  @if($errors->has('passport_number'))
                    <span class="text-danger">{{ $errors->first('passport_number') }}</span>
                @endif
              </div>

              <div class="my-4">
                <label for="exampleFormControlInput1" class="form-label">Full Name</label>
                <input type="text" class="form-control select-forms" name="name" id="name" value="{{ old('name',$passport->name) }}"
                  placeholder="Enter Full Name" />
                  @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                  @endif
              </div>

              <div class="my-3">
                <label class="form-label">Profession</label>
                <select class="form-select select-forms text-muted" name="profession_id" id="profession_id" aria-label="Default select example">
                  <option value="">Select Profession</option>
                  @if (isset($professions[0]))
                      @foreach ($professions as $key => $profession)
                        <option {{ $passport->profession_id == $profession->id ? 'selected' : '' }} value="{{ $profession->id }}">{{ $profession->name }}</option>
                      @endforeach
                  @endif
                </select>
                  @if($errors->has('profession_id'))
                    <span class="text-danger">{{ $errors->first('profession_id') }}</span>
                  @endif
              </div>

              <div class="my-4">
                <label for="emirates_id" class="form-label">Emirates ID</label>
                <input type="text" class="form-control select-forms" name="emirates_id" value="{{ old('emirates_id',$passport->emirates_id) }}" id="emirates_id"
                  placeholder="Enter Civil ID" />
                  @if($errors->has('emirates_id'))
                    <span class="text-danger">{{ $errors->first('emirates_id') }}</span>
                  @endif
              </div>

              <div class="my-4">
                <label for="bd_phone" class="form-label">Phone Number <sup>BD</sup>
                </label>
                <input type="text" class="form-control select-forms" name="bd_phone" value="{{ old('bd_phone',$passport->bd_phone) }}" id="bd_phone"
                  placeholder="+880" />
                  @if($errors->has('bd_phone'))
                    <span class="text-danger">{{ $errors->first('bd_phone') }}</span>
                  @endif
              </div>

              <div class="my-4">
                <label for="kuwait_phone" class="form-label">Phone Number <sup>Kuwait</sup>
                </label>
                <input type="text" class="form-control select-forms" name="kuwait_phone" value="{{ old('kuwait_phone',$passport->kuwait_phone) }}" id="kuwait_phone"
                  placeholder="+971" />
                  @if($errors->has('kuwait_phone'))
                  <span class="text-danger">{{ $errors->first('kuwait_phone') }}</span>
                @endif
              </div>

              @if ($type == 0 || $type == 1)
                  <div class="custom">
                    <label for="expiry_date" class="form-label">Passport Expiry Date</label>
                    <input type="date" class="form-control select-forms" name="expiry_date" value="{{ old('expiry_date',date('Y-m-d',strtotime($passport->expiry_date))) }}" id="expiry_date" />
                      @if($errors->has('expiry_date'))
                        <span class="text-danger">{{ $errors->first('expiry_date') }}</span>
                      @endif
                  </div>
                @endif

                <div class="custom">
                  <label for="dob" class="form-label">Date Of Birth</label>
                  <input type="date" class="form-control select-forms" name="dob" value="{{ old('dob',date('Y-m-d',strtotime($passport->dob))) }}" id="dob" />
                    @if($errors->has('dob'))
                      <span class="text-danger">{{ $errors->first('dob') }}</span>
                    @endif
                </div>

                @if ($type == 3)
                  <div class="custom">
                    <label for="dob_id" class="form-label">Date Of Birth ID</label>
                    <input type="text" class="form-control select-forms" name="dob_id" value="{{ old('dob_id',$passport->dob_id) }}" id="dob_id" />
                      @if($errors->has('dob_id'))
                        <span class="text-danger">{{ $errors->first('dob_id') }}</span>
                      @endif
                  </div>

                  <div class="custom">
                    <label for="residence" class="form-label">Residence Emirates ID / Phone No</label>
                    <input type="text" class="form-control select-forms" name="residence" value="{{ old('residence',$passport->residence) }}" id="residence" />
                      @if($errors->has('residence'))
                        <span class="text-danger">{{ $errors->first('residence') }}</span>
                      @endif
                  </div>
                @endif

            </div>
          </div>

          <div class="col-md-6">
            <div class="first-card mx-auto">
              <div class="custom">
                <label for="mailing_address" class="form-label">Mailing Address</label>
                <input type="text" class="form-control select-forms" name="mailing_address" value="{{ old('mailing_address',$passport->mailing_address) }}" id="mailing_address"
                  placeholder="Enter Mailing Address" />
                  @if($errors->has('mailing_address'))
                    <span class="text-danger">{{ $errors->first('mailing_address') }}</span>
                  @endif
              </div>

              <div class="my-4">
                <label for="permanent_address" class="form-label">Bangladesh Permanent Address</label>
                <input type="text" class="form-control select-forms" name="permanent_address" value="{{ old('permanent_address',$passport->permanent_address) }}" id="permanent_address"
                  placeholder="+971" />
                  @if($errors->has('permanent_address'))
                    <span class="text-danger">{{ $errors->first('permanent_address') }}</span>
                @endif
              </div>

              @if ($type == 0 || $type == 1)
                <div class="form-group">
                  @if($passport->profession_file)
                      <a href="{{ asset($passport->profession_file) }}" target="_blank">View File</a>
                  @else
                      <a href="#">No File Found</a>
                  @endif
                </div>

                <div class="my-4">
                  <label for="profession_file" class="form-label">Profession File (Only PDF)</sup></label>
                  <input type="file" class="form-control select-forms" accept = "application/pdf" name="profession_file"  id="profession_file"
                    placeholder="+971" />
                    @if($errors->has('profession_file'))
                      <span class="text-danger">{{ $errors->first('profession_file') }}</span>
                    @endif
                </div>
              @endif

              @if ($type == 2)
                <div class="form-group">
                  @if($passport->gd_report_uae)
                      <a href="{{ asset($passport->gd_report_uae) }}" target="_blank">View File</a>
                  @else
                      <a href="#">No File Found</a>
                  @endif
                </div>

                <div class="my-4">
                  <label for="gd_report_uae" class="form-label">GD Report (Kuwait Only PDF)</sup></label>
                  <input type="file" class="form-control select-forms" accept = "application/pdf" name="gd_report_uae"  id="gd_report_uae"
                    placeholder="+971" />
                    @if($errors->has('gd_report_uae'))
                      <span class="text-danger">{{ $errors->first('gd_report_uae') }}</span>
                    @endif
                </div>
              @endif

              @if ($type == 3)
                <div class="form-group">
                  @if($passport->dob_file)
                      <a href="{{ asset($passport->dob_file) }}" target="_blank">View File</a>
                  @else
                      <a href="#">No File Found</a>
                  @endif
                </div>

                <div class="my-4">
                  <label for="dob_file" class="form-label">Date Of Birth File (Only PDF)</sup></label>
                  <input type="file" class="form-control select-forms" accept = "application/pdf" name="dob_file"  id="dob_file"
                    placeholder="+971" />
                    @if($errors->has('dob_file'))
                      <span class="text-danger">{{ $errors->first('dob_file') }}</span>
                    @endif
                </div>
              @endif

              <div class="form-group">
                @if($passport->application_form)
                    <a href="{{ asset($passport->application_form) }}" target="_blank">View File</a>
                @else
                    <a href="#">No File Found</a>
                @endif
              </div>

              <div class="my-4">
                <label for="application_form" class="form-label">Application Form (Only PDF)</label>
                <input type="file" class="form-control select-forms" accept = "application/pdf" name="application_form" id="application_form"
                  placeholder="+971" />
                  @if($errors->has('application_form'))
                  <span class="text-danger">{{ $errors->first('application_form') }}</span>
                  @endif
              </div>

              <div class="form-group">
                <img id="passport_photocopy" src="{{ asset($passport->passport_photocopy ?? get_static_option('no_image'))  }}" alt="your image" width="100" height="100" />
            </div>

              <div class="my-4">
                <label for="passport_photocopy" class="form-label">Passport Photo copy</label>
                <input type="file" class="form-control select-forms"  name="passport_photocopy" id="passport_photocopy" onchange="document.getElementById('passport_photocopy').src = window.URL.createObjectURL(this.files[0])" accept="image/*" />
                  @if($errors->has('passport_photocopy'))
                  <span class="text-danger">{{ $errors->first('passport_photocopy') }}</span>
                  @endif
              </div>

            @if ($type == 0 || $type == 2 )
              <div class="my-4">
                <label for="special_skill" class="form-label">Special Skill</label>
                <input type="text" class="form-control select-forms" name="special_skill" id="special_skill" value="{{ old('special_skill',$passport->special_skill) }}"
                  placeholder="Enter Your Special Skill" />
                  @if($errors->has('special_skill'))
                    <span class="text-danger">{{ $errors->first('special_skill') }}</span>
                  @endif
              </div>
            @endif



            @if ($type == 0 || $type == 1)
                <div class="custom">
                  <label for="extended_to" class="form-label">Passport Extending To</label>
                  <input type="date" class="form-control select-forms" name="extended_to" value="{{ old('extended_to',date('Y-m-d',strtotime($passport->extended_to))) }}" id="extended_to" />
                    @if($errors->has('extended_to'))
                      <span class="text-danger">{{ $errors->first('extended_to') }}</span>
                    @endif
                </div>
              @endif

              <div class="my-4">
                <label for="govt_passport_id" class="form-label">Govt Passport ID</label>
                <input type="text" class="form-control select-forms" name="govt_passport_id" id="govt_passport_id" value="{{ old('govt_passport_id',$passport->govt_passport_id) }}"
                  placeholder="Enter Your Special Skill" />
                  @if($errors->has('govt_passport_id'))
                    <span class="text-danger">{{ $errors->first('govt_passport_id') }}</span>
                  @endif
              </div>

              @if ($type == 1)
                <div class="my-4">
                  <label for="post_office" class="form-label">Post Office ID</label>
                  <input type="text" class="form-control select-forms" name="post_office" id="post_office" value="{{ old('post_office',$passport->post_office) }}"
                    placeholder="Enter Your Special Skill" />
                    @if($errors->has('post_office'))
                      <span class="text-danger">{{ $errors->first('post_office') }}</span>
                    @endif
                </div>
              @endif

              <div class="my-3">
                <label class="form-label">Delivery Method</label>
                <select class="form-select select-forms text-muted" name="delivery_id" id="delivery_id" aria-label="Default select example">
                  <option value="">Select Delivery Method</option>
                  @if (isset($delivery_methods[0]))
                      @foreach ($delivery_methods as $key => $delivery)
                        <option {{ $passport->delivery_method  == $delivery->id ? 'selected' : '' }} value="{{ $delivery->id }}">{{ $delivery->name }}</option>
                      @endforeach
                  @endif
                </select>
                  @if($errors->has('delivery_id'))
                    <span class="text-danger">{{ $errors->first('delivery_id') }}</span>
                  @endif
              </div>



            </div>

          </div>
        </div>
      </div>
      <input type="submit" style="margin-top: 15px;" class="next btn_next_step_1 btn submit-btn1 text-white action-button" value="Update" />
   </form>
  </div>

@endsection
