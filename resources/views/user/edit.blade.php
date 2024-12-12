@php
    use App\Models\User;
    use App\Helpers\EncryptionHelper;
    $id = $data->id;
@endphp
<form id="updateUserForm" method="POST" action="{{ route('user.update') }}">
    @csrf
    @method('PUT')
    <input type="hidden" value="{{ $id }}" name="id">

    <div class="form-group">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $data->name }}">
        @error('name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" value="{{ $data->username }}">
        @error('username')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ $data->email }}">
        @error('email')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="role" class="form-label">Role</label>

        <select class="form-control" id="role" name="role">
            <option value="" disabled selected>Select role</option>
            <option value="admin" {{ $data->role == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="pegawai" {{ $data->role == 'pegawai' ? 'selected' : '' }}>pegawai</option>
            <option value="walinagari" {{ $data->role == 'walinagari' ? 'selected' : '' }}>Wali Nagari</option>
        </select>
        @error('role')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="d-flex justify-content-end">

        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

<script src="{{ asset('admin') }}/plugins/jQuery/jQuery-2.2.0.min.js"></script>

<script>
    $('#updateUserForm').submit(function(e) {
        e.preventDefault();

        var form = $(this);
        var actionUrl = form.attr('action');
        var formData = form.serialize();

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
