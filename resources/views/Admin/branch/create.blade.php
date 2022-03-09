<form action="javascript:void(0)" method="POST" id="branch_add">
    @csrf
    <div class="form-group">
        <br>
        <label for="name">Name</label>
        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Brance Name">
        <b>Branch Status</b><br>
        <br>
        <div class="radio radio-info radio-inline">
            <input type="radio" id="active" value=1 name="status">
            <label for="active"> Active </label>
        </div>
        <div class="radio radio-danger radio-inline">
            <input type="radio" id="Inactive" value=0 name="status" checked="checked">
            <label for="Inactive"> Inactive </label>
        </div><br>
    </div>
    <button type="submit" id="btnSaveBranch" class="btn btn-info">Save Branch</button>

</form>

<script>
    $(document).ready(function() {
        $('#btnSaveBranch').click(function() {
            // event.preventDefault();

            var form = $('#branch_add')[0];
            var formData = new FormData(form);
            //  console.log(formData);
            formData.append('_method', 'POST');

            $.ajax({
                method: 'POST',
                url: "{{ route('admin.branch.store') }}",
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
