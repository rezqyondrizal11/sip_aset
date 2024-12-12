@extends('layout.system.main')
@section('title', 'Data Aset Tetap')
@section('content')
    {{-- <style>
        /* Mencegah teks di dalam th dan td untuk terpotong ke bawah */
        th,
        td {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            /* Menambahkan elipsis (...) jika teks terlalu panjang */
        }

        /* Menambahkan pengguliran horizontal pada tabel */
        .table-responsive {
            overflow-x: auto;
        }
    </style> --}}
    <section class="content">

        <div class="box">
            <div class="box-header">
                <h1>Data Aset Tetap</h1>
            </div>
            <div class="box-body">
                <div class="nav-tabs-custom">


                    <ul class="nav nav-tabs">
                        @foreach ($cat as $key => $c)
                            <li class="{{ $key === 0 ? 'active' : '' }}">
                                <a href="#tab{{ $key }}" data-toggle="tab">{{ $c->name }}</a>
                            </li>
                        @endforeach

                    </ul>



                    <div class="tab-content">
                        <!-- Dynamic Tabs -->
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($cat as $key => $c)
                            <div class="tab-pane {{ $key === 0 ? 'active' : '' }}" id="tab{{ $key }}">
                                <div class="box">
                                    <div class="box-header">

                                        <h4> Data {{ $c->name }}</h4>
                                    </div>
                                    <div class="box-header">
                                        <button type="button" class="btn btn-success" data-toggle="modal"
                                            data-target="#createModal{{ $key }}" data-id="{{ $c->id }}"
                                            id="openCreateModal{{ $key }}">
                                            <i class="fa fa-plus"></i> Tambah Data
                                        </button>
                                        <a href="{{ route('asettetap.print', ['id' => $c->id, 'year' => request('year') ?? $year]) }}"
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
                                                        <option value="{{ $year }}">{{ $year }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <br>
                                            <table id="example{{ $key }}"
                                                class="table table-bordered table-striped" style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Aksi</th>
                                                        <th>Jenis Barang / Nama Barang</th>
                                                        <th>No. Kode</th>
                                                        <th>No. Register</th>
                                                        <th>Luas</th>
                                                        <th>Tahun Pengadaan</th>
                                                        <th>Alamat</th>
                                                        <th>Status Tanah</th>
                                                        <th>Sertifikat Tanggal</th>
                                                        <th>Sertifikat No</th>
                                                        <th>Penggunaan</th>
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
                                    <div class="modal fade" id="createModal{{ $key }}" tabindex="-1"
                                        role="dialog" aria-labelledby="createModalLabel{{ $key }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="createModalLabel{{ $key }}">Tambah
                                                        Data {{ $c->name }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
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
                        @endforeach
                    </div>
                </div>
            </div>

        </div>


    </section>
    <!--begin::Post-->
    <!-- Modal untuk update -->
    <div class="modal fade" id="updateModal" tabindex="-1 " role="dialog" aria-labelledby="updateModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="updateModalLabel">Update Aset Tetap</h5>

                </div>
                <div class="modal-body">
                    <div id="UpdateFormContainer">
                        <!-- Konten dari AJAX akan dimuat di sini -->
                        <p class="text-center">Loadingsss...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
{{-- @section('datatable')
    @php
        $totalcat = count($cat);
        $no = 2; // Mulai dari angka 2
    @endphp

    <script>
        $(function() {
            @for ($index = 0; $index < $totalcat; $index++)
                $("#example{{ $no }}").DataTable({
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": true,
                    "responsive": true, // Menambahkan fitur responsif
                    "scrollX": true, // Menambahkan scroll horizontal jika diperlukan
                    "dom": '<"d-flex justify-content-between"lf>rt<"bottom"ip><"clear">'
                });
                @php $no++; @endphp
            @endfor
        });
    </script>

@endsection --}}
@section('script')
    <script>
        $(document).ready(function() {
            // Event ketika tombol create diklik
            $('[id^="openCreateModal"]').click(function() {
                var key = $(this).attr('id').replace('openCreateModal',
                    ''); // Ambil key dari ID tombol
                var idcat = $(this).data('id'); // Mengambil id user yang diklik

                // Kosongkan isi modal sebelum memuat data baru
                $('#CreateFormContainer' + key).html('<p class="text-center">Loading...</p>');

                // Panggil route untuk form create menggunakan AJAX
                $.ajax({
                    url: "{{ route('asettetap.create', ':id') }}".replace(':id',
                        idcat),
                    method: "GET",
                    success: function(response) {
                        // Isi modal dengan konten yang diterima
                        $('#CreateFormContainer' + key).html(response);
                    },
                    error: function() {
                        // Tampilkan pesan error jika terjadi masalah
                        $('#CreateFormContainer' + key).html(
                            '<p class="text-center text-danger">Failed to load form. Please try again.</p>'
                        );
                    }
                });
            });


        });
    </script>
    <script>
        $(document).ready(function() {
            // Delegasi event untuk tombol Update
            $(document).on('click', '.openUpdateModal', function() {
                var Id = $(this).data('id'); // Mengambil id aset yang diklik

                if (Id) { // Pastikan Id ada (tidak undefined)
                    // Set judul modal untuk Update
                    $('#ModalLabel').text('Update Aset Tetap');

                    // Kosongkan isi modal sebelum memuat data baru
                    $('#UpdateFormContainer').html('<p class="text-center">Loading...</p>');

                    // Panggil route untuk form update menggunakan AJAX
                    $.ajax({
                        url: "{{ route('asettetap.edit', ':id') }}".replace(':id',
                            Id), // Gantilah :id dengan Id
                        method: "GET",
                        success: function(response) {
                            // Isi modal dengan konten yang diterima
                            $('#UpdateFormContainer').html(response);
                        },
                        error: function() {
                            // Tampilkan pesan error jika terjadi masalah
                            $('#UpdateFormContainer').html(
                                '<p class="text-center text-danger">Failed to load form. Please try again.</p>'
                            );
                        }
                    });
                } else {
                    console.error("ID is missing.");
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            @foreach ($cat as $key => $c)
                let table{{ $key }} = $("#example{{ $key }}").DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('asettetap.data', $c->id) }}",
                        data: function(d) {
                            // Mengambil nilai tahun dari dropdown filter
                            d.year = $('#filterYear{{ $key }}').val();
                        }
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'aksi',
                            name: 'aksi',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'nama_barang',
                            name: 'nama_barang'
                        },
                        {
                            data: 'kode',
                            name: 'kode'
                        },
                        {
                            data: 'register',
                            name: 'register'
                        },
                        {
                            data: 'luas',
                            name: 'luas'
                        },
                        {
                            data: 'tahun_pengadaan',
                            name: 'tahun_pengadaan'
                        },
                        {
                            data: 'alamat',
                            name: 'alamat'
                        },
                        {
                            data: 'status_tanah',
                            name: 'status_tanah'
                        },
                        {
                            data: 'sertifikat_tgl',
                            name: 'sertifikat_tgl'
                        },
                        {
                            data: 'sertifikat_no',
                            name: 'sertifikat_no'
                        },
                        {
                            data: 'penggunaan',
                            name: 'penggunaan'
                        },
                        {
                            data: 'asal_usul',
                            name: 'asal_usul'
                        },
                        {
                            data: 'harga',
                            name: 'harga'
                        },
                        {
                            data: 'tanggal_perolehan',
                            name: 'tanggal_perolehan'
                        },
                        {
                            data: 'usia_aset',
                            name: 'usia_aset',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'ket',
                            name: 'ket'
                        }
                    ]
                });


                // Menangani perubahan tahun yang dipilih
                $('#filterYear{{ $key }}').change(function() {
                    table{{ $key }}.draw(); // Menyaring ulang DataTable dengan tahun yang dipilih


                    // Memperbarui URL cetak dengan tahun yang dipilih
                    let selectedYear = $('#filterYear{{ $key }}').val();
                    let printLink =
                        "{{ route('asettetap.print', ['id' => $c->id, 'year' => 'null']) }}"; // Default 'null' untuk year

                    // Jika tahun dipilih, masukkan tahun tersebut
                    if (selectedYear) {
                        printLink = printLink.replace('null',
                            selectedYear); // Ganti 'null' dengan tahun yang dipilih
                    }

                    // Memperbarui href link print
                    $('#btnPrintPDF{{ $key }}').attr('href', printLink);
                });
            @endforeach
        });
    </script>

@endsection
