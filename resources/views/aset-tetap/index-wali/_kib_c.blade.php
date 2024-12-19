<div class="tab-pane {{ $key === 0 ? 'active' : '' }}" id="tab{{ $key }}">
    <div class="box">
        <div class="box-header">

            <h4> Data {{ $c->name }}</h4>
        </div>
        <div class="box-header">

            <a href="{{ route('asettetap.printwali', ['id' => $c->id, 'year' => request('year') ?? $year]) }}"
                target="_blank" id="btnPrintPDF{{ $key }}" class="btn btn-primary">
                <i class="fa fa-file-pdf-o"></i> Print
            </a>



        </div>
        <div class="box-body">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <div class="table-responsive">
                <div class="mb-3 ">
                    <label for="filterYear{{ $key }}">Filter Tahun:</label>
                    <select id="filterYear{{ $key }}" class="form-control">
                        <option value="">Semua Tahun</option>
                        @foreach ($years as $year)
                            <option value="{{ $year }}">{{ $year }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <br>
                <table id="example{{ $key }}" class="table table-bordered table-striped" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>No</th>

                            <th>Jenis Barang / Nama Barang</th>
                            <th>No. Kode</th>
                            <th>No. Register</th>
                            <th>Kondisi Bangunan</th>
                            <th>Bertingkat</th>
                            <th>Beton</th>
                            <th>Luas Lantai</th>
                            <th>Dokumen Tanggal</th>
                            <th>Dokumen Nomor</th>
                            <th>Luas</th>
                            <th>Status Tanah</th>
                            <th>Nomor Kode Tanah</th>
                            <th>Asal Usul</th>
                            <th>Harga</th>
                            <th>Tanggal Perolehan Aset</th>
                            <th>Usia Aset</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="createModal{{ $key }}" tabindex="-1" role="dialog"
            aria-labelledby="createModalLabel{{ $key }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel{{ $key }}">
                            Tambah
                            Data {{ $c->name }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="CreateFormContainer{{ $key }}">
                        <p class="text-center">Loading...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
