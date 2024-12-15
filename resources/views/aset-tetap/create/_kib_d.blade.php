<form id="createForm" action="{{ route('asettetap.store') }}" method="POST">
    @csrf
    <input type="hidden" value="{{ $id }}" name="id_kategori_aset">

    <div class="form-group">
        <label for="jenis" class="form-label">Jenis Barang</label>

        <select class="form-control" id="jenis" name="id_jenis_barang">
            <option value="" disabled selected>Pilih Jenis Barang</option>
            @foreach ($jenis as $j)
                <option value="{{ $j->id }}">{{ $j->name }}</option>
            @endforeach

        </select>
        @error('id_jenis_barang')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="nama_barang" class="form-label">Nama Barang</label>
        <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="{{ old('nama_barang') }}">
        @error('nama_barang')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="kode" class="form-label">Kode</label>
        <input type="text" class="form-control" id="kode" name="kode" value="{{ old('kode') }}">
        @error('kode')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="register" class="form-label">Register</label>
        <input type="text" class="form-control" id="register" name="register" value="{{ old('register') }}">
        @error('register')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

  
    <div class="form-group">
        <label for="konstruksi" class="form-label">Konstruksi</label>
        <input type="text" class="form-control" id="konstruksi" name="konstruksi" value="{{ old('konstruksi') }}">
        @error('konstruksi')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="panjang" class="form-label">Panjang</label>
        <input type="text" class="form-control" id="panjang" name="panjang" value="{{ old('panjang') }}">
        @error('panjang')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="lebar" class="form-label">Lebar</label>
        <input type="text" class="form-control" id="lebar" name="lebar" value="{{ old('lebar') }}">
        @error('lebar')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="luas" class="form-label">Luas</label>
        <input type="text" class="form-control" id="luas" name="luas" value="{{ old('luas') }}">
        @error('luas')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="kondisi" class="form-label">Kondisi</label>
        <input type="text" class="form-control" id="kondisi" name="kondisi" value="{{ old('kondisi') }}">
        @error('kondisi')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="alamat" class="form-label">Alamat</label>
        <input type="text" class="form-control" id="alamat" name="alamat" value="{{ old('alamat') }}">
        @error('alamat')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="dok_tgl" class="form-label">Dokumen Tanggal</label>
        <input type="date" class="form-control" id="dok_tgl" name="dok_tgl" value="{{ old('dok_tgl') }}">
        @error('dok_tgl')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="dok_no" class="form-label">Dokumen Nomor</label>
        <input type="text" class="form-control" id="dok_no" name="dok_no" value="{{ old('dok_no') }}">
        @error('dok_no')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="status_tanah" class="form-label">Status Tanah</label>
        <input type="text" class="form-control" id="status_tanah" name="status_tanah" value="{{ old('status_tanah') }}">
        @error('status_tanah')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="no_kode_tanah" class="form-label">Nomor Kode Tanah</label>
        <input type="text" class="form-control" id="no_kode_tanah" name="no_kode_tanah" value="{{ old('no_kode_tanah') }}">
        @error('no_kode_tanah')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
  
    <div class="form-group">
        <label for="asal_usul" class="form-label">Asal Usul</label>

        <select class="form-control" id="asal_usul" name="asal_usul">
            <option value="" disabled selected>Pilih Asal</option>
            <option value="Pembelian">Pembelian</option>
            <option value="Inventaris">Inventaris</option>
            <option value="Hibah">Hibah</option>
            <option value="Donasi">Donasi</option>
            <option value="Wakaf">Wakaf</option>
            <option value="Swadaya">Swadaya</option>
        </select>
        @error('asal_usul')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="harga" class="form-label">Harga</label>
        <input type="number" class="form-control" id="harga" name="harga" value="{{ old('harga') }}">
        @error('harga')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="ket" class="form-label">Keterangan</label>
        <input type="text" class="form-control" id="ket" name="ket" value="{{ old('ket') }}">
        @error('ket')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="tanggal_perolehan" class="form-label">Tanggal Perolehan Aset</label>
        <input type="date" class="form-control" id="tanggal_perolehan" name="tanggal_perolehan"
            value="{{ old('tanggal_perolehan') }}">
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
