@php
    use App\Models\User;
    use App\Helpers\EncryptionHelper;
    $id = $data->id;
@endphp
<form id="updateForm" method="POST" action="{{ route('asettidaktetap.updatemasuk') }}">
    @csrf

    <input type="hidden" value="{{ $id }}" name="id_att">

    <div class="form-group">
        <label for="masuk" class="form-label">Masuk</label>
        <input type="text" class="form-control" id="masuk" name="masuk">
        @error('masuk')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="d-flex justify-content-end">

        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>




<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Stok</th>
            <th>Masuk</th>
            <th>Keluar</th>
            <th>Sisa</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($detail as $row)
            @php

                $iterationNumber = $loop->index + 1;

            @endphp

            <tr>
                <td>{{ $iterationNumber }}</td>
                <td><?= date('d-M-Y H:i:s', strtotime($row->created_at)) ?></td>


                <td><?= number_format($row->stok) ?></td>
                <td>
                    <?= number_format($row->masuk) ?>

                </td>
                <td>

                    </a><?= number_format($row->keluar) ?>

                </td>
                <td>

                    </a><?= number_format($row->sisa) ?>

                </td>

            </tr>
        @endforeach
    </tbody>
</table>
<script src="{{ asset('admin') }}/plugins/jQuery/jQuery-2.2.0.min.js"></script>

<script>
    $('#updateForm').submit(function(e) {
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
