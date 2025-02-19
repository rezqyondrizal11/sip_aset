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
        <label for="konstruksi" class="form-label">Konstruksi</label>
        <input type="text" class="form-control" id="konstruksi" name="konstruksi"
            value="{{ $data->KibDJalanirigasi->konstruksi }}">
        @error('konstruksi')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="panjang" class="form-label">Panjang</label>
        <input type="text" class="form-control" id="panjang" name="panjang"
            value="{{ $data->KibDJalanirigasi->panjang }}">
        @error('panjang')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="lebar" class="form-label">Lebar</label>
        <input type="text" class="form-control" id="lebar" name="lebar"
            value="{{ $data->KibDJalanirigasi->lebar }}">
        @error('lebar')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="luas" class="form-label">Luas</label>
        <input type="text" class="form-control" id="luas" name="luas"
            value="{{ $data->KibDJalanirigasi->luas }}">
        @error('luas')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="kondisi" class="form-label">Kondisi</label>
        <input type="text" class="form-control" id="kondisi" name="kondisi"
            value="{{ $data->KibDJalanirigasi->kondisi }}">
        @error('kondisi')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="alamat" class="form-label">Alamat</label>
        <input type="text" class="form-control" id="alamat" name="alamat"
            value="{{ $data->KibDJalanirigasi->alamat }}">
        @error('alamat')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="dok_tgl" class="form-label">Dokumen Tanggal</label>
        <input type="date" class="form-control" id="dok_tgl" name="dok_tgl"
            value="{{ $data->KibDJalanirigasi->dok_tgl }}">
        @error('dok_tgl')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="dok_no" class="form-label">Dokumen Nomor</label>
        <input type="text" class="form-control" id="dok_no" name="dok_no"
            value="{{ $data->KibDJalanirigasi->dok_no }}">
        @error('dok_no')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="status_tanah" class="form-label">Status Tanah</label>
        <input type="text" class="form-control" id="status_tanah" name="status_tanah"
            value="{{ $data->KibDJalanirigasi->status_tanah }}">
        @error('status_tanah')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="no_kode_tanah" class="form-label">Nomor Kode Tanah</label>
        <input type="text" class="form-control" id="no_kode_tanah" name="no_kode_tanah"
            value="{{ $data->KibDJalanirigasi->no_kode_tanah }}">
        @error('no_kode_tanah')
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
        <label for="harga_beli" class="form-label">Harga Beli</label>
        <input type="number" class="form-control" id="harga_beli" name="harga_beli"
            value="{{ $data->harga_beli }}" value="{{ old('harga_beli') }}">
        @error('harga_beli')
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
