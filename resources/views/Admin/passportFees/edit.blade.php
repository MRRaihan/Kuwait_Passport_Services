<form enctype="multipart/form-data" id="edit-form">
    @csrf
    <input type="hidden" name="_method" value="PUT">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="tile" name="title" value="{{ $passportFee->title }}" placeholder="Passport Fees">
    </div>
    <div class="form-group">
        <label for="name">Government Fee</label>
        <input type="text" class="form-control" id="government_fee" name="government_fee" value="{{ $passportFee->government_fee }}" placeholder="1000" onkeypress="return /[0-9.]/i.test(event.key)">
    </div>
    <div class="form-group">
        <label for="name">Versatilo Fee</label>
        <input type="text" class="form-control" id="versatilo_fee" name="versatilo_fee" value="{{ $passportFee->versatilo_fee }}" placeholder="2000" onkeypress="return /[0-9.]/i.test(event.key)">
    </div>

    <button type="submit" id="btnUpdateType" class="btn btn-info">Update Passport Fees</button>


  </form>

  <script>
    $(document).on('click','#btnUpdateType',function (event) {
     event.preventDefault();
     var form = $('#edit-form')[0];
     var formData = new FormData(form);
    //  console.log(formData);
     formData.append('_method','PUT');
     // Set header if need any otherwise remove setup part
     $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="token"]').attr('value')
         }
     });

     $.ajax({
         url: "{{ route('admin.passportFee.update',$passportFee->id) }}",// your request url
         data: formData,
         processData: false,
         contentType: false,
         type: 'POST',
         success: function (data) {
             Swal.fire({
                 position: 'top-end',
                 icon: data.type,
                 title: data.message,
                 showConfirmButton: false,
                 // timer: 1500
             })
                 setTimeout(function() {
                     location.reload();
                 }, 1000);
             console.log(data);
         },
         error: function (data) {
             console.log(data);
             var errorMessage = '<div class="card bg-danger">\n' +
                         '<div class="card-body text-center p-5">\n' +
                         '<span class="text-white">';
                     $.each(data.responseJSON.errors, function(key, value) {
                         errorMessage += ('' + value + '<br>');
                     });
                     errorMessage += '</span>\n' +
                         '</div>\n' +
                         '</div>';
                     Swal.fire({
                         icon: 'error',
                         title: 'Oops...',
                         footer: errorMessage
                     })
         }
     });

 });
 </script>
