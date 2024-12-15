<form id="createForm" action="{{ route('asettetap.update') }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <input type="hidden" value="{{ $data->id }}" name="id">
        <input type="hidden" value="{{ $data->id_kategori_aset }}" name="id_kategori_aset">

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
        <label for="nama_barang" class="form-label">Nama Barang</label>
        <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="{{ $data->nama_barang }}">
        @error('nama_barang')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="kode" class="form-label">Kode</label>
        <input type="text" class="form-control" id="kode" name="kode" value="{{ $data->kode }}">
        @error('kode')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="register" class="form-label">Register</label>
        <input type="text" class="form-control" id="register" name="register" value="{{ $data->register }}">
        @error('register')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="merk_type" class="form-label">Merk/Type</label>
        <input type="text" class="form-control" id="merk_type" name="merk_type" value="{{ $data->KibBPeralatanmesin->merk_type }}">
        @error('merk_type')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="ukuran_cc" class="form-label">Ukuran CC</label>
        <input type="text" class="form-control" id="ukuran_cc" name="ukuran_cc" value="{{ $data->KibBPeralatanmesin->ukuran_cc }}">
        @error('ukuran_cc')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="bahan" class="form-label">Bahan</label>
        <input type="text" class="form-control" id="bahan" name="bahan" value="{{ $data->KibBPeralatanmesin->bahan }}">
        @error('bahan')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="tahun_pengadaan" class="form-label">Tahun Pembelian</label>
        <input type="number" class="form-control" id="tahun_pengadaan" name="tahun_pengadaan" min="1900"
            max="{{ date('Y') }}" step="1" value="{{ $data->KibBPeralatanmesin->tahun_pengadaan }}">
        @error('tahun_pengadaan_pengadaan')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="no_pabrik" class="form-label">Nomor Pabrik</label>
        <input type="text" class="form-control" id="no_pabrik" name="no_pabrik" value="{{ $data->KibBPeralatanmesin->no_pabrik }}">
        @error('no_pabrik')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="no_rangka" class="form-label">Nomor Rangka</label>
        <input type="text" class="form-control" id="no_rangka" name="no_rangka" value="{{ $data->KibBPeralatanmesin->no_rangka }}">
        @error('no_rangka')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="no_mesin" class="form-label">Nomor Mesin</label>
        <input type="text" class="form-control" id="no_mesin" name="no_mesin" value="{{ $data->KibBPeralatanmesin->no_mesin }}">
        @error('no_mesin')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="no_polisi" class="form-label">Nomor Polisi</label>
        <input type="text" class="form-control" id="no_polisi" name="no_polisi" value="{{ $data->KibBPeralatanmesin->no_polisi }}">
        @error('no_polisi')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="no_bpkb" class="form-label">Nomor BPKB</label>
        <input type="text" class="form-control" id="no_bpkb" name="no_bpkb" value="{{ $data->KibBPeralatanmesin->no_bpkb }}">
        @error('no_bpkb')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="asal_usul" class="form-label">Asal Usul</label>

        <select class="form-control" id="asal_usul" name="asal_usul">
            <option value="" disabled selected>Pilih Asal</option>
            <option value="Pembelian" {{ $data->asal_usul == 'Pembelian' ? 'selected' : '' }}>Pembelian</option>
            <option value="Inventaris" {{ $data->asal_usul == 'Inventaris' ? 'selected' : '' }}>Inventaris</option>
            <option value="Hibah" {{ $data->asal_usul == 'Hibah' ? 'selected' : '' }}>Hibah</option>
            <option value="Donasi" {{ $data->asal_usul == 'Donasi' ? 'selected' : '' }}>Donasi</option>
            <option value="Wakaf" {{ $data->asal_usul == 'Wakaf' ? 'selected' : '' }}>Wakaf</option>
            <option value="Swadaya" {{ $data->asal_usul == 'Swadaya' ? 'selected' : '' }}>Swadaya</option>
        </select>
        @error('asal_usul')
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
        <label for="ket" class="form-label">Keterangan</label>
        <input type="text" class="form-control" id="ket" name="ket" value="{{ $data->ket }}">
        @error('ket')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="tanggal_perolehan" class="form-label">Tanggal Perolehan Aset</label>
        <input type="date" class="form-control" id="tanggal_perolehan" name="tanggal_perolehan"
            value="{{ $data->tanggal_perolehan }}">
        @error('tanggal_perolehan')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>


<script src="{{ asset('admin') }}/plugins/jQuery/jQuery-2.2.0.min.js"></script>

<script>
    $('#createForm').submit(function(e) {
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
