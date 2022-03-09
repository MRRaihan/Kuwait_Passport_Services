<form enctype="multipart/form-data" id="edit-form">
    @csrf
    <input type="hidden" name="_method" value="PUT">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Fist Name"
            value="{{ $profession->name }}">
    </div>
    <b>Status</b><br>
    <br>
    <div class="radio radio-info radio-inline">
        <input type="radio" id="active" value=1 name="status" @if ($profession->status == 1) checked="checked" @endif>
        <label for="active"> Active </label>
    </div>
    <div class="radio radio-danger radio-inline">
        <input type="radio" id="Inactive" value=0 name="status" @if ($profession->status == 0) checked="checked" @endif>
        <label for="Inactive"> Inactive </label>
    </div><br>
    <br>


    <button type="submit" id="btnUpdateProfession" class="btn btn-info">Update Profession</button>


</form>

<script>
    $(document).on('click', '#btnUpdateProfession', function(event) {
        event.preventDefault();
        var form = $('#edit-form')[0];
        var formData = new FormData(form);
        //  console.log(formData);
        formData.append('_method', 'PUT');
        // Set header if need any otherwise remove setup part
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="token"]').attr('value')
            }
        });

        $.ajax({
            url: "{{ route('admin.profession.update', $profession->id) }}", // your request url
            data: formData,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function(data) {
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
            error: function(data) {
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
