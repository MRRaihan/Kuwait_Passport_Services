@extends('NormalUserDeshbord.layouts.app')
@push('title')
Security update
@endpush
@section('body')

<div class="col-md-9 p-3 password-change">
    <div class="row p-5">
        <div class="col-6 set-password p-4">
          <p>Enter Current Password</p>
          <form  method="POST" id="old_password">
                <div class="my-4">
                @csrf
                <input name="user_id"  type="hidden" id="user_id" value="{{ Auth::user()->id }}">
                <input name="password" type="password" id="old_password_input" class="form-control select-forms d-inline" id="exampleFormControlInput1" placeholder="*********" />
                <i class="fa fa-eye d-inline cursor-pointer show-password" aria-hidden="true"></i>
                <p class="text-danger error-password"></p>
              </div>

              <div>
                <button type="submit" id="confirm-pass" class="btn password-btn text-white py-2 px-5 d-inline ">Next</button>
                <p class="d-inline text-info px-5 cursor-pointer">Forget Password</p>
              </div>
            </form>
        </div>
    </div>


    <form action="" method="POST" id="change_password_form">
    <div class="row px-5" id="set-new-password">
            @csrf
            <div class="col-6 set-password p-4">
                <p>Set new password</p>
                <div class="my-4">
                <input type="password" id="password" class="form-control select-forms d-inline" id="exampleFormControlInput1" placeholder="*********" />
                <i class="fa fa-eye d-inline cursor-pointer show-password" aria-hidden="true"></i>
                </div>

            </div>
            <div class="col-6 set-password p-4">
                <p>Confirm new password</p>
                <div class="my-4">
                <input type="password" id="con_password" class="form-control select-forms d-inline" id="exampleFormControlInput1" placeholder="*********" />
                <i class="fa fa-eye d-inline cursor-pointer show-password" aria-hidden="true"></i>
                </div>

                <div class="float-end px-5">
                <button type="submit" class="btn password-btn text-white py-2 px-5 d-inline m-1">Save</button>
                </div>
            </div>

        </div>
    </form>





  </div>
</div>
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="passwordChange" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content">

    <div class="modal-body password-modal">
        <img src="/assest/img/New folder/consgratuation.png" width="50%" alt="">
        <h5 class="info-title pb-3">Password changed successfully !</h5>
        <button id="save-password" class="btn password-btn text-white py-2 px-5 d-inline m-1">Done</button>
    </div>

  </div>
</div>
</div>
<!---modal end--->
<script>
    //old password check
    $('#old_password').submit(function(e){
        e.preventDefault();

        var formData = new FormData(this);
            formData.append('password', $('#old_password_input').val());
            formData.append('user_id', $('#user_id').val());
            $.ajax({
                method: 'POST',
                url: "{{ route('normalUser.passwordCheck') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data == 1) {
                        $('#set-new-password').css('visibility','visible')
                        $('.error-password').html("")
                    } else {
                        $('#set-new-password').css('visibility','hidden')
                        $('.error-password').html(data)
                    }
                },
                error: function(xhr) {
                    var errorMessage = '<div class="card bg-danger">\n' +
                        '                        <div class="card-body text-center p-5">\n' +
                        '                            <span class="text-white">';
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        errorMessage += ('' + value + '<br>');
                    });
                    errorMessage += '</span>\n' +
                        '                        </div>\n' +
                        '                    </div>';
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        footer: errorMessage
                    })
                },
            })
    })

    //password update
    $('#change_password_form').submit(function(e){
        e.preventDefault()

        var formData = new FormData(this);
            formData.append('user_id', $('#user_id').val());
            formData.append('password', $('#password').val());
            formData.append('confirmation_password', $('#con_password').val());

            $.ajax({
                method: 'POST',
                url: "{{ route('normalUser.passwordUpdate') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    console.log(data);
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: data,
                        showConfirmButton: false,
                        // timer: 1500
                    })
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                },
                error: function(xhr) {
                    var errorMessage = '<div class="card bg-danger">\n' +
                        '                        <div class="card-body text-center p-5">\n' +
                        '                            <span class="text-white">';
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        errorMessage += ('' + value + '<br>');
                    });
                    errorMessage += '</span>\n' +
                        '                        </div>\n' +
                        '                    </div>';
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        footer: errorMessage
                    })
                },
            })
    })


//   $('#save-password').click(function(){
//     $('#passwordChange').modal('show')
//   })


    //password show
  $('.show-password').click(function (e) {
    if($( this ).prev().attr('type') == 'text'){
        $( this ).prev().attr('type','password');
        $(this).parent().css('color','black');

    }else{
      $( this ).prev().attr('type','text');
      $(this).parent().css('color','red');
    }

   });
</script>
@endsection
