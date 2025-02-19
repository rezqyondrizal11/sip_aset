<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Aset {{ $cat->name }}</title>
    <link rel="stylesheet" href="path/to/your/font-awesome/css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .box {
            border: 1px solid #000;
            margin: 20px;
            padding: 10px;
            width: 95%;
        }

        .box-header {
            background-color: #f2f2f2;
            padding: 10px;
        }

        .box-title {
            margin: 0;
            text-align: center;
        }

        .box-body {
            padding: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }

        /* Media print settings */
        @media print {
            body {
                font-size: 12px;
                /* Mengatur ukuran font untuk print */
                color: #000;
                /* Mengatur warna font agar lebih jelas */
            }

            /* Hanya menghilangkan border pada elemen .box saat mencetak */
            .box {
                border: none;
                /* Menghilangkan border pada .box */
            }

            .box-header {
                background-color: #dcdcdc;
                /* Mengubah warna background header */
            }

            table {
                width: 100%;
                /* Pastikan tabel menggunakan lebar penuh */
                border: 1px solid #000;
                /* Memastikan border tabel tetap ada */
            }

            th,
            td {
                padding: 8px;
                /* Menambah ruang dalam sel untuk pencetakan */
                font-size: 11px;
                /* Mengurangi ukuran font dalam tabel untuk ruang yang lebih efisien */
                border: 1px solid #000;
                /* Memastikan border pada tabel tetap ada */
            }

            .no-print {
                display: none;
                /* Menyembunyikan elemen dengan kelas 'no-print' saat pencetakan */
            }
        }
    </style>


</head>

<body>

    <div class="box">
        <div class="box-header">
            <table style="width:100%;border: none !important;" align="center">
                <tr>
                    <td style="text-align:center;"><img width="100px" src="{{ asset('image') }}/logo.PNG"></td>
                    <td>
                        <h3 class="box-title">LAPORAN ASET TETAP {{ strtoupper($cat->name) }}
                            KANTOR WALI NAGARI SIPINANG <br>
                            PALEMBAYAN KAB. AGAM, SUMATERA BARAT <br> TAHUN <?= date('Y') ?></h3>
                    </td>
                    <td style="text-align:center"><img width="100px" src="{{ asset('image') }}/logo-sumbar.png"></td>
                </tr>
            </table>
        </div>

        <div class="box-body">
            <h3 style="text-align:left !important;" class="box-title">ASET {{ strtoupper($cat->name) }}
            </h3>
        </div>
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
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
                        <th>Harga Beli</th>
                        <th>Harga</th>
                        <th>Tanggal Perolehan Aset</th>
                        <th>Usia Aset</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total = 0;
                        $total1 = 0;
                    @endphp
                    @foreach ($cat->asettetap as $keyy => $aset)
                        @php
                            $id = $aset->id;
                            $iterationNumber = $loop->index + 1;
                            $total += $aset->harga;
                            $total1 += $aset->harga_beli;

                        @endphp
                        <tr>
                            <td>{{ $iterationNumber }}</td>

                            <td>{{ $aset->jenisaset->name }} / {{ $aset->nama_barang }}
                            </td>
                            <td>{{ $aset->kode }}</td>
                            <td>{{ $aset->register }}</td>
                            <td>{{ $aset->kibATanah->luas }}</td>
                            <td>{{ $aset->kibATanah->tahun_pengadaan }}</td>
                            <td>{{ $aset->kibATanah->alamat }}</td>
                            <td>{{ $aset->kibATanah->status_tanah }}</td>
                            <td>{{ date('d-M-Y', strtotime($aset->kibATanah->sertifikat_tgl)) }}</td>
                            <td>{{ $aset->kibATanah->sertifikat_no }}</td>
                            <td>{{ $aset->kibATanah->penggunaan }}</td>
                            <td>{{ $aset->asal_usul }}</td>
                            <td>Rp {{ number_format($aset->harga_beli, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($aset->harga, 0, ',', '.') }}</td>
                            <td>{{ date('d-M-Y', strtotime($aset->tanggal_perolehan)) }}
                            </td>


                            <td>
                                @php
                                    // Menggunakan Carbon langsung tanpa 'use'
                                    $tanggalPerolehan = $aset->tanggal_perolehan
                                        ? \Carbon\Carbon::parse($aset->tanggal_perolehan)
                                        : null;
                                    $usiaAsetTahun = $tanggalPerolehan ? now()->diffInYears($tanggalPerolehan) : 0;
                                    $usiaAsetBulan = $tanggalPerolehan
                                        ? now()->diffInMonths($tanggalPerolehan) % 12
                                        : 0;
                                @endphp
                                {{ $usiaAsetTahun }} Tahun, {{ $usiaAsetBulan }} Bulan
                            </td>
                            <td>{{ $aset->ket }}</td>
                        </tr>
                    @endforeach

                    <tr>
                        <th colspan="12">Total Harga</th>
                        <th colspan="1">Rp {{ number_format($total1, 0, ',', '.') }}</th>
                        <th colspan="4">Rp {{ number_format($total, 0, ',', '.') }}</th>
                    </tr>
                </tbody>
            </table>
        </div>


        @php
            use App\Models\User;
            $walinagari = User::where('role', 'walinagari')->where('status', 1)->first();

        @endphp
        <div class="box-body">
            <table>
                <tr>
                    <th style="text-align:center;">Mengetahui,
                        <br>
                        Wali Nagari
                        <br><br>
                        <br><br>
                        <br><br>
                        ({{ $walinagari->name }})
                    </th>
                    <th style="text-align:center;">Sipinang, <?= date('l d M Y') ?>
                        <br>
                        Pengurus Aset
                        <br><br>
                        <br><br>
                        <br><br>
                        ({{ Auth::user() ? Auth::user()->name : '' }})
                    </th>
                </tr>
            </table>
        </div>
    </div>

    <script>
        window.print();
    </script>

</body>

</html>
