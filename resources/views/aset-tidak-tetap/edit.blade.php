<form id="createForm" action="{{ route('asettidaktetap.update') }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <input type="hidden" value="{{ $data->id }}" name="id">
        <label for="jenis" class="form-label">Jenis Barang</label>

        <select class="form-control" id="jenis" name="id_jenis_barang">
            <option value="" disabled selected>Pilih Jenis Barang</option>
            @foreach ($jenis as $j)
                <option value="{{ $j->id }} " {{ $data->id_jenis_barang == $j->id ? 'selected' : '' }}>
                    {{ $j->name }}</option>
            @endforeach

        </select>
        @error('id_jenis_barang')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="nama" class="form-label">Nama Barang</label>
        <input type="text" class="form-control" id="nama" name="nama" value="{{ $data->nama }}">
        @error('nama')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="harga" class="form-label">Harga</label>
        <input type="number" class="form-control" id="harga" name="harga" value="{{ $data->harga }}">
        @error('harga')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="jumlah_awal" class="form-label">Jumlah</label>
        <input type="number" class="form-control" id="jumlah_awal" name="jumlah_awal"
            value="{{ $data->jumlah_awal }}">
        @error('jumlah_awal')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="asal_perolehan" class="form-label">Asal Usul</label>

        <select class="form-control" id="asal_perolehan" name="asal_perolehan">
            <option value="" disabled selected>Pilih Asal</option>
            <option value="Pembelian" {{ $data->asal_perolehan == 'Pembelian' ? 'selected' : '' }}>Pembelian</option>
            <option value="Inventaris" {{ $data->asal_perolehan == 'Inventaris' ? 'selected' : '' }}>Inventaris
            </option>
            <option value="Hibah" {{ $data->asal_perolehan == 'Hibah' ? 'selected' : '' }}>Hibah</option>
            <option value="Donasi" {{ $data->asal_perolehan == 'Donasi' ? 'selected' : '' }}>Donasi</option>
            <option value="Wakaf" {{ $data->asal_perolehan == 'Wakaf' ? 'selected' : '' }}>Wakaf</option>
            <option value="Swadaya" {{ $data->asal_perolehan == 'Swadaya' ? 'selected' : '' }}>Swadaya</option>
        </select>
        @error('asal_perolehan')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="keterangan" class="form-label">Keterangan</label>
        <input type="text" class="form-control" id="keterangan" name="keterangan" value="{{ $data->keterangan }}">
        @error('keterangan')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="tgl_beli" class="form-label">Tanggal Beli</label>
        <input type="date" class="form-control" id="tgl_beli" name="tgl_beli" value="{{ $data->tgl_beli }}">
        @error('tgl_beli')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="tgl_pakai" class="form-label">Tanggal Pakai</label>
        <input type="date" class="form-control" id="tgl_pakai" name="tgl_pakai" value="{{ $data->tgl_pakai }}">
        @error('tgl_pakai')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="tgl_perolehan_aset" class="form-label">Tanggal Perolehan Aset</label>
        <input type="date" class="form-control" id="tgl_perolehan_aset" name="tgl_perolehan_aset"
            value="{{ $data->tgl_perolehan_aset }}">
        @error('tgl_perolehan_aset')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>


<script src="{{ asset('admin') }}/plugins/jQuery/jQuery-2.2.0.min.js"></script>

<script>
    $('#creatForm').submit(function(e) {
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
