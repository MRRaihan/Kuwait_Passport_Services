<form action="javascript:void(0)" method="POST" >
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Passport Fees">
        </div>
        <div class="form-group">
            <label for="name">Government Fee</label>
            <input type="text" class="form-control" id="government_fee" name="government_fee" placeholder="1000" onkeypress="return /[0-9.]/i.test(event.key)">
        </div>
        <div class="form-group">
            <label for="name">Versatilo Fee</label>
            <input type="text" class="form-control" id="versatilo_fee" name="versatilo_fee" placeholder="2000" onkeypress="return /[0-9.]/i.test(event.key)">
        </div>
        <button type="submit" id="btnAddManager" class="btn btn-info">Add profession</button>
</form>

<script>
    $(document).ready(function() {
        $('#btnAddManager').click(function() {
            // event.preventDefault();

            var formData = new FormData();
            formData.append('title', $('#first_name').val());
            formData.append('government_fee', $('#government_fee').val());
            formData.append('versatilo_fee', $('#versatilo_fee').val());
            $.ajax({
                method: 'POST',
                url: "{{ route('admin.passportFee.store') }}",
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
