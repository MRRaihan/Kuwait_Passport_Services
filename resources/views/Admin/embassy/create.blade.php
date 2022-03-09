<form action="javascript:void(0)" method="POST" >
        @csrf
        {{-- <div class="form-group">
            <label for="branch_id"> Branch  </label>
            <select class="form-control" id="branch_id" name="branch_id">
                    <option value="">-- select  branch --</option>
                    @foreach ($branchs as $branch)

                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                    @endforeach

            </select>
        </div> --}}
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter Fist Name">
        </div>

        <div class="form-group">
            <label for="name">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone">
        </div>

        <div class="form-group">
            <label for="name">Email</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email">
        </div>

        <span class="row">
                <div class="form-group col-md-6">
                    <label for="image">Image</label>
                    <br><img id="image1" onchange="validateMultipleImage('image1')" alt="icon" src="" height="180px" width="180px" onerror="this.onerror=null;this.src='{{ asset(get_static_option('no_image')) }}';" required/>
                    <br><br><input type="file" class="mt-2" id="image" name="image" onchange="document.getElementById('image1').src = window.URL.createObjectURL(this.files[0]); show(this)" accept=".jfif,.jpg,.jpeg,.png,.gif" required>
            </div>
        </span>
        <button type="submit" id="btnAddAccountEmploy" class="btn btn-info">Add Embassy</button>
</form>

<script>
    $(document).ready(function() {
        $('#btnAddAccountEmploy').click(function() {
            // event.preventDefault();

            var formData = new FormData();
            formData.append('name', $('#first_name').val());
            formData.append('phone', $('#phone').val());
            formData.append('email', $('#email').val());
            formData.append('branch_id', $('#branch_id').val());
            formData.append('image', $('#image')[0].files[0]);
            $.ajax({
                method: 'POST',
                url: "{{ route('admin.embassy.store') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    console.log(data);
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
        });
    });
</script>
