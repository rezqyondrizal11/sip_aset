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
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createModal"
                    id="openCreateModal">
                    <i class="fa fa-plus"></i> Tambah Data
                </button>
                <a href="{{ route('asettidaktetap.print', ['year' => $year]) }}" target="_blank" id="btnPrintPDF"
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
                @if (Session::has('dangerrr'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ Session::get('dangerrr') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <!-- Form pencarian -->
                <form method="GET" action="{{ route('asettidaktetap.index') }}">
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
                            <th>Aksi</th>
                            <th>Jenis Barang</th>
                            <th>Nama Barang</th>
                            <th> Harga</th>
                            <th>Asal Perolehan</th>
                            <th>Stok</th>
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
                                <td class="text-center">
                                    <a href="#" class="btn btn-primary openUpdateModal" data-toggle="modal"
                                        data-target="#updateModal" data-id="{{ $id }}">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <a href="#"
                                        onclick="return klikDelete('{{ route('asettidaktetap.destroy', ['id' => $id]) }}');"
                                        class="btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </a>

                                </td>
                                <td><?= $row->jenisaset->name ?></td>
                                <td><?= $row->nama ?></td>
                                <td><?= 'Rp ' . number_format($row->harga, 0, ',', '.') ?></td>
                                <td><?= $row->asal_perolehan ?></td>
                                <td> <?= number_format($row->jumlah_awal, 0, ',', '.') ?></td>
                                <td>
                                    <?= number_format($row->jumlah_masuk, 0, ',', '.') ?>
                                    <a href="#" class="btn btn-primary openUpdateMasukModal" data-toggle="modal"
                                        data-target="#updateMasukModal" data-id="{{ $id }}">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </td>
                                <td>

                                    </a> <?= number_format($row->jumlah_keluar, 0, ',', '.') ?>
                                    <a href="#" class="btn btn-primary openUpdateKeluarModal" data-toggle="modal"
                                        data-target="#updateKeluarModal" data-id="{{ $id }}">
                                        <i class="fa fa-plus"></i>
                                    </a>
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
        <?php
        $modals = [
            [
                'id' => 'createModal',
                'title' => 'Create Aset Tidak Tetap',
                'containerId' => 'CreateFormContainer',
                'trigger' => 'openCreateModal',
                'route' => route('asettidaktetap.create'),
            ],
            [
                'id' => 'updateModal',
                'title' => 'Update Aset Tidak Tetap',
                'containerId' => 'UpdateFormContainer',
                'trigger' => 'openUpdateModal',
                'route' => route('asettidaktetap.edit', ':id'), // Placeholder untuk ID
            ],
            [
                'id' => 'updateMasukModal',
                'title' => 'Update Barang Masuk',
                'containerId' => 'UpdateMasukFormContainer',
                'trigger' => 'openUpdateMasukModal',
                'route' => route('asettidaktetap.masuk', ':id'), // Placeholder untuk ID
            ],
            [
                'id' => 'updateKeluarModal',
                'title' => 'Update Barang Keluar',
                'containerId' => 'UpdateKeluarFormContainer',
                'trigger' => 'openUpdateKeluarModal',
                'route' => route('asettidaktetap.keluar', ':id'), // Placeholder untuk ID
            ],
        ];
        ?>

        <!-- Generate Modal -->
        <?php foreach ($modals as $modal): ?>
        <div class="modal fade" id="<?= $modal['id'] ?>" tabindex="-1" role="dialog"
            aria-labelledby="<?= $modal['id'] ?>Label" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="modal-title" id="<?= $modal['id'] ?>Label"><?= $modal['title'] ?></h5>


                    </div>
                    <div class="modal-body">
                        <div id="<?= $modal['containerId'] ?>">
                            <!-- Konten dari AJAX akan dimuat di sini -->
                            <p class="text-center">Loading...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>



    @endsection

    @section('script')
        <script>
            $(document).ready(function() {
                // Fungsi reusable untuk memuat konten modal
                function loadModalContent(container, url, modalLabel = null) {
                    if (modalLabel) $('#ModalLabel').text(modalLabel); // Set judul modal jika diberikan
                    $(container).html(
                        '<p class="text-center">Loading...</p>'); // Kosongkan isi modal dengan placeholder
                    $.ajax({
                        url: url,
                        method: "GET",
                        success: function(response) {
                            $(container).html(response); // Isi modal dengan konten yang diterima
                        },
                        error: function() {
                            $(container).html(
                                '<p class="text-center text-danger">Failed to load form. Please try again.</p>'
                            );
                        },
                    });
                }

                // Event ketika tombol Create diklik
                $('#openCreateModal').click(function() {
                    loadModalContent('#CreateFormContainer', "{{ route('asettidaktetap.create') }}");
                });

                // Event untuk tombol Update
                $('.openUpdateModal').click(function() {
                    var userId = $(this).data('id');
                    if (userId) {
                        loadModalContent(
                            '#UpdateFormContainer',
                            "{{ route('asettidaktetap.edit', ':id') }}".replace(':id', userId),
                            'Update Aset Tidak Tetap'
                        );
                    } else {
                        console.error("ID is missing.");
                    }
                });

                // Event untuk tombol Update Barang Masuk
                $('.openUpdateMasukModal').click(function() {
                    var userId = $(this).data('id');
                    if (userId) {
                        loadModalContent(
                            '#UpdateMasukFormContainer',
                            "{{ route('asettidaktetap.masuk', ':id') }}".replace(':id', userId),
                            'Update Barang Masuk'
                        );
                    } else {
                        console.error("ID is missing.");
                    }
                });

                // Event untuk tombol Update Barang Keluar
                $('.openUpdateKeluarModal').click(function() {
                    var userId = $(this).data('id');
                    if (userId) {
                        loadModalContent(
                            '#UpdateKeluarFormContainer',
                            "{{ route('asettidaktetap.keluar', ':id') }}".replace(':id', userId),
                            'Update Barang Keluar'
                        );
                    } else {
                        console.error("ID is missing.");
                    }
                });

                document.getElementById('filterYear').addEventListener('change', function() {
                    const filterYear = this.value;

                    fetch(`{{ route('asettidaktetap.index') }}?filterYear=${filterYear}`, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            const tableBody = document.getElementById('tableBody');
                            tableBody.innerHTML = '';

                            data.forEach((row, index) => {
                                const usia = `${row.usia_tahun} Tahun, ${row.usia_bulan} Bulan`;

                                tableBody.innerHTML += `
                <tr>
                    <td>${index + 1}</td>
                    <td class="text-center">
                        <a href="#" class="btn btn-primary openUpdateModal" data-id="${row.id}">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a href="#" onclick="return klikDelete('/asettidaktetap/destroy/${row.id}');" class="btn btn-danger">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                    <td>${row.jenisaset.name}</td>
                    <td>${row.nama}</td>
                    <td>${new Intl.NumberFormat().format(row.harga)}</td>
                    <td>${row.asal_perolehan}</td>
                    <td>${new Intl.NumberFormat().format(row.jumlah_awal)}</td>
                    <td>${new Intl.NumberFormat().format(row.jumlah_masuk)}</td>
                    <td>${new Intl.NumberFormat().format(row.jumlah_keluar)}</td>
                    <td>${row.sisa}</td>
                    <td>${row.keterangan}</td>
                    <td>${row.tgl_beli}</td>
                    <td>${row.tgl_pakai}</td>
                    <td>${row.tgl_perolehan_aset}</td>
                    <td>${usia}</td>
                    <td>${row.updated_at}</td>
                </tr>
            `;
                            });
                        })
                        .catch(error => console.error('Error:', error));
                });

            });
        </script>

    @endsection
