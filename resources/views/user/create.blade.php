<form id="createuserForm" action="{{ route('user.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
        @error('name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}">
        @error('username')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
        @error('email')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password">
        @error('password')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="confirm_password" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" id="confirm_password" name="confirm-password">
        @error('confirm-password')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="role" class="form-label">Role</label>

        <select class="form-control" id="role" name="role">
            <option value="" disabled selected>Select role</option>
            <option value="admin">Admin</option>
            <option value="pegawai">pegawai</option>
            <option value="walinagari">Wali Nagari</option>
        </select>
        @error('role')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>


<script src="{{ asset('admin') }}/plugins/jQuery/jQuery-2.2.0.min.js"></script>

<script>
    $('#createuserForm').submit(function(e) {
        e.preventDefault();

        var form = $(this);
        var actionUrl = form.attr('action');
        var formData = form.serialize();
        var password = $('#password').val();
        var confirmPassword = $('#confirm_password').val();


        if (password != confirmPassword) {
            e.preventDefault(); // Mencegah form submit jika password tidak cocok
            alert('Password and Confirm Password do not match!');
        }
        var submitButton = form.find('button[type="submit"]');

        // Menonaktifkan tombol submit
        submitButton.prop('disabled', true);
        submitButton.text('Processing...'); // Mengubah teks tombol
        $.ajax({
            url: actionUrl,
            method: 'POST',
            data: formData,
            success: function(response) {

                location.reload(); // Or update your table dynamically
            },
            error: function(xhr) {
                var errors = xhr.responseJSON.errors;
                // Clear previous error messages
                $('.text-danger').remove();

                // Show new error messages
                $.each(errors, function(field, messages) {
                    var input = $('[name="' + field + '"]');
                    input.after('<div class="text-danger">' + messages.join(
                        ', ') + '</div>');
                });
                submitButton.prop('disabled', false);
                submitButton.text('Submit'); // Mengubah teks tombol
            }
        });
    });
</script>
