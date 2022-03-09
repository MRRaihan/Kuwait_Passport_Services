@extends('NormalUserDeshbord.layouts.app')
@push('title')
Profile Update
@endpush
@section('body')


<div class="col-md-9 p-3">
        <form action="{{ route('normalUser.profileInformationUpdate') }}" method="POST" enctype="multipart/form-data">
            @csrf
        <div class="row p-5">
          <div class="col-md-6 profile-head">
            <p>Welcome</p>
            <h1>{{ Auth::user()->name }}</h1>
          </div>
          <div class="col-md-6 profile-edit-imge">
            <div class="image-container">
                <label  for="user_pro_pic">
                    <img id="pro_pic_view" width="150px" src="{{ asset('frontend_assets/img/person.jpg') }}" alt="">
                    <i  class="fa fa-pencil" aria-hidden="true"></i>
                </label>
              <input name="image" id="user_pro_pic" class="upload_image hidden" code="up_44"  type="file" accept=".png, .jpg">
            </div>
          </div>
        </div>


            <div class="row">
              <div class="col-md-6">
                <div class="first-card mx-auto">
                  <div class="my-4">
                    <label for="exampleFormControlInput1" class="form-label">Name</label>
                    <input type="text" class="form-control select-forms" id="exampleFormControlInput1"   name="name" value="{{ $user->name }}"/>
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                  </div>

                  <div class="my-4">
                    <label for="exampleFormControlInput1" class="form-label">Phone Number <sup>UAE</sup>
                    </label>
                    <input type="text" class="form-control select-forms" id="exampleFormControlInput1"   name="uae_phone" value="{{ $user->uae_phone }}"/>
                  </div>

                  <div class="my-4">
                    <label for="exampleFormControlInput1" class="form-label">Email</label>
                    <input type="text" class="form-control select-forms" id="exampleFormControlInput1"  name="email" value="{{ $user->email }}"/>
                  </div>

                  <div class="my-4">
                    <label for="exampleFormControlInput1" class="form-label">Present Address</label>
                    <input type="text" class="form-control select-forms" id="exampleFormControlInput1"   name="address" value="{{ $user->address }}"/>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="first-card mx-auto pt-5">


                  <div class="my-4 mt-5">
                    <label for="exampleFormControlInput1" class="form-label mt-3">Phone Number <sup>BD</sup>
                    </label>
                    <input type="text" class="form-control select-forms" id="exampleFormControlInput1"   name="phone" value="{{ $user->phone }}"/>
                  </div>

                  <div class="my-4">
                    <label for="exampleFormControlInput1" class="form-label">Date of birth
                    </label>
                    <input type="date" class="form-control select-forms" id="exampleFormControlInput1" name="birth_date" value="{{ \Carbon\Carbon::parse($user->birth_date)->format('Y-m-d') }}"/>
                  </div>

                  <div class="my-4">
                    <label for="exampleFormControlInput1" class="form-label">Place of birth
                    </label>
                    <input type="text" class="form-control select-forms" id="exampleFormControlInput1"  name="birth_place" value="{{ $user->birth_place }}"/>
                  </div>

                </div>
              </div>
              <div class="col-sm-6">
                <div class="first-card mx-auto pt-5">
                  <button type="submit" class="btn profile-edit-save text-white py-3 px-5">Update</button>
                </div>
              </div>
            </div>

        </form>
    </div>


  <script>
      // uplode photo view
        $(document).on('change', 'input.upload_image', function (e) {
            e.preventDefault()
            let product_photo = URL.createObjectURL(e.target.files[0])
            $('#pro_pic_view').attr('src', product_photo)
        });
  </script>
@endsection
