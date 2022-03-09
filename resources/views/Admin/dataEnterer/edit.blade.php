<form enctype="multipart/form-data"  id="edit-form">
    @csrf
    <input type="hidden" name="_method" value="PUT">
    <div class="form-group">
        <label for="branch_id"> Branch  </label>
        <select class="form-control" id="branch_id" name="branch_id">
                @foreach ($branchs as $branch)
                    @if ($branch->id == $enterer->branch_id)
                         <option value="{{ $branch->id }}" selected>{{ $branch->name }}</option>
                    @endif
                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                @endforeach

        </select>
    </div>
    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" class="form-control" id="name" name="name" placeholder="Enter Fist Name" value="{{ $enterer->name }}">
    </div>

    <div class="form-group">
        <label for="name">Phone</label>
        <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone" value="{{ $enterer->phone }}">
    </div>

    <div class="form-group">
        <label for="name">Email</label>
        <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email" value="{{ $enterer->email }}">
    </div>

    <span class="row">
          <div class="form-group col-md-6">
              <label for="image">Image</label>
              <br><img id="image1" onchange="validateMultipleImage('image1')" alt="icon" src="{{ asset($enterer->image) }}" height="180px" width="180px" onerror="this.onerror=null;this.src='{{ asset(get_static_option('no_image')) }}';" required/>
              <br><br><input type="file" class="mt-2" id="image" name="image" onchange="document.getElementById('image1').src = window.URL.createObjectURL(this.files[0]); show(this)" accept=".jfif,.jpg,.jpeg,.png,.gif" required>
        </div>
    </span>

    <button type="submit" id="btnUpdateDataEnterer" class="btn btn-info">Update Enterer</button>


  </form>

  <script>
    $(document).on('click','#btnUpdateDataEnterer',function (event) {
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
         url: "{{ route('admin.dataEnterer.update',$enterer->id) }}",// your request url
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
