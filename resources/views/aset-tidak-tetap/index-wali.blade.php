@extends('layout.system.main')

@section('title', 'Data Aset Tidak Tetap')
@section('content')

    @php
        use Carbon\Carbon;

    @endphp
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h1>Data Aset Tidak Tetap</h1>
            </div>
            <div class="box-header">

                <a href="{{ route('asettidaktetapwali.print', ['year' => $year]) }}" target="_blank" id="btnPrintPDF"
                    class="btn btn-primary">
                    <i class="fa fa-file-pdf-o"></i> Print
                </a>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <!-- Form pencarian -->
                <form method="GET" action="{{ route('asettidaktetapwali.index') }}">
                    <div class="row mb-4">
                        <!-- Filter Tahun -->
                        <div class="col-md-12 col-lg-10">
                            <label for="filterYear" class="control-label">Filter Tahun:</label>
                            <select id="filterYear" name="filterYear" class="form-control">
                                <option value="">Semua Tahun</option>
                                @foreach ($years as $year)
                                    <option value="{{ $year }}"
                                        {{ request('filterYear') == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <!-- Tombol Cari -->
                    <div class="d-flex justify-content-end mb-4">
                        <label class="control-label">&nbsp;</label>
                        <button type="submit" class="btn btn-primary form-control">
                            <i class="fa fa-search"></i> Cari
                        </button>
                    </div>
                </form>

                <br>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>

                            <th>Jenis Barang</th>
                            <th>Nama Barang</th>
                            <th> Harga</th>
                            <th>Asal Perolehan</th>
                            <th>Jumlah Awal</th>
                            <th>Jumal Masuk</th>
                            <th>Jumlah Keluar</th>
                            <th>Sisa</th>
                            <th>Keterangan</th>
                            <th>Tanggal Beli</th>
                            <th>Tanggal Pakai</th>
                            <th>Tanggal Perolehan Aset</th>
                            <th>Usia</th>
                            <th>Tanggal Update</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $row)
                            @php
                                $id = $row->id;
                                $iterationNumber = $loop->index + 1;
                                // Menghitung usia

                                $tanggalPerolehan = $row->tgl_perolehan_aset
                                    ? Carbon::parse($row->tgl_perolehan_aset)
                                    : null;
                                $usiaAsetTahun = $tanggalPerolehan ? now()->diffInYears($tanggalPerolehan) : 0;
                                $usiaAsetBulan = $tanggalPerolehan ? now()->diffInMonths($tanggalPerolehan) % 12 : 0;
                                $usia = "$usiaAsetTahun Tahun, $usiaAsetBulan Bulan";
                            @endphp

                            <tr>
                                <td>{{ $iterationNumber }}</td>

                                <td><?= $row->jenisaset->name ?></td>
                                <td><?= $row->nama ?></td>
                                <td>Rp <?= number_format($row->harga, 0, ',', '.') ?></td>
                                <td><?= $row->asal_perolehan ?></td>
                                <td> <?= number_format($row->jumlah_awal, 0, ',', '.') ?></td>
                                <td>
                                    <?= number_format($row->jumlah_masuk, 0, ',', '.') ?>

                                </td>
                                <td>

                                    </a><?= number_format($row->jumlah_keluar, 0, ',', '.') ?>

                                </td>
                                <td><?= $row->sisa ?></td>
                                <td><?= $row->keterangan ?></td>
                                <td><?= date('d-M-Y', strtotime($row->tgl_beli)) ?></td>

                                <td><?= date('d-M-Y', strtotime($row->tgl_pakai)) ?></td>
                                <td><?= date('d-M-Y', strtotime($row->tgl_perolehan_aset)) ?></td>
                                <td><?= $usia ?></td>
                                <td><?= date('d-M-Y', strtotime($row->updated_at)) ?></td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>

    </section>


@endsection
