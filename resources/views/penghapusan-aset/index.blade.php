@extends('layout.system.main')
@section('title', 'Data Penghapusan Aset')
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
                <h1>Data Penghapusan Aset</h1>
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

                                        <a href="{{ route('penghapusanaset.print', ['id' => $c->id, 'year' => request('year') ?? $year]) }}"
                                            target="_blank" id="btnPrintPDF{{ $key }}" class="btn btn-primary">
                                            <i class="fa fa-file-pdf-o"></i> Print
                                        </a>


                                    </div>
                                    <div class="box-body">
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

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>


    </section>

@endsection

@section('script')


    <script>
        $(document).ready(function() {
            @foreach ($cat as $key => $c)
                let table{{ $key }} = $("#example{{ $key }}").DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('penghapusanaset.data', $c->id) }}",
                        data: function(d) {
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
                        },
                    ]
                });


                // Menangani perubahan tahun yang dipilih
                $('#filterYear{{ $key }}').change(function() {
                    table{{ $key }}.draw(); // Menyaring ulang DataTable dengan tahun yang dipilih


                    // Memperbarui URL cetak dengan tahun yang dipilih
                    let selectedYear = $('#filterYear{{ $key }}').val();
                    let printLink =
                        "{{ route('penghapusanaset.print', ['id' => $c->id, 'year' => 'null']) }}"; // Default 'null' untuk year

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
