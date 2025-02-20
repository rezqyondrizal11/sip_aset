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
        <label for="kondisi_bangunan" class="form-label">Kondisi Bangunan</label>
        <input type="text" class="form-control" id="kondisi_bangunan" name="kondisi_bangunan"
            value="{{ $data->KibCGedungbangunan->kondisi_bangunan }}">
        @error('kondisi_bangunan')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="bertingkat" class="form-label">Bertingkat</label>

        <select class="form-control" id="bertingkat" name="bertingkat">
            <option value="" disabled selected>Pilih Item</option>

            <option value="Bertingkat"{{ $data->KibCGedungbangunan->bertingkat == 'Bertingkat' ? 'selected' : '' }}>
                Bertingkat</option>
            <option
                value="Tidak Bertingkat"{{ $data->KibCGedungbangunan->bertingkat == 'Tidak Bertingkat' ? 'selected' : '' }}>
                Tidak Bertingkat</option>


        </select>
        @error('bertingkat')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="Beton" class="form-label">Beton</label>

        <select class="form-control" id="Beton" name="beton">
            <option value="" disabled selected>Pilih Item</option>

            <option value="Beton" {{ $data->KibCGedungbangunan->beton == 'Beton' ? 'selected' : '' }}>Beton</option>
            <option value="Tidak Beton" {{ $data->KibCGedungbangunan->beton == 'Tidak Beton' ? 'selected' : '' }}>Tidak
                Beton</option>


        </select>
        @error('Beton')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="luas_lantai" class="form-label">Luas Lantai</label>
        <input type="text" class="form-control" id="luas_lantai" name="luas_lantai"
            value="{{ $data->KibCGedungbangunan->luas_lantai }}">
        @error('luas_lantai')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="dok_tgl" class="form-label">Dokumen Tanggal</label>
        <input type="date" class="form-control" id="dok_tgl" name="dok_tgl"
            value="{{ $data->KibCGedungbangunan->dok_tgl }}">
        @error('dok_tgl')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="dok_no" class="form-label">Dokumen Nomor</label>
        <input type="text" class="form-control" id="dok_no" name="dok_no"
            value="{{ $data->KibCGedungbangunan->dok_no }}">
        @error('dok_no')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="luas" class="form-label">Luas</label>
        <input type="text" class="form-control" id="luas" name="luas"
            value="{{ $data->KibCGedungbangunan->luas }}">
        @error('luas')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="status_tanah" class="form-label">Status Tanah</label>
        <input type="text" class="form-control" id="status_tanah" name="status_tanah"
            value="{{ $data->KibCGedungbangunan->status_tanah }}">
        @error('status_tanah')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="no_kode_tanah" class="form-label">Nomor Kode Tanah</label>
        <input type="text" class="form-control" id="no_kode_tanah" name="no_kode_tanah"
            value="{{ $data->KibCGedungbangunan->no_kode_tanah }}">
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
        <input type="text" class="form-control rupiah" id="harga_beli" name="harga_beli"
            value="{{ old('harga_beli', $data->harga_beli) }}">
        @error('harga_beli')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="harga" class="form-label">Harga</label>
        <input type="text" class="form-control rupiah" id="harga" name="harga"
            value="{{ old('harga', $data->harga) }}">
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
    function formatRupiah(angka, prefix = 'Rp ') {
        let numberString = angka.replace(/[^,\d]/g, '').toString();
        let split = numberString.split(',');
        let sisa = split[0].length % 3;
        let rupiah = split[0].substr(0, sisa);
        let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            let separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix + rupiah;
    }

    document.querySelectorAll('.rupiah').forEach(input => {
        // Format saat halaman dimuat
        if (input.value) {
            input.value = formatRupiah(input.value);
        }

        // Format saat pengguna mengetik
        input.addEventListener('input', function(e) {
            let value = this.value.replace(/[^0-9]/g, '');
            this.value = value ? formatRupiah(value) : '';
        });
    });
</script>

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
