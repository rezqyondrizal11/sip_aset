<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Aset Tidak Tetap</title>
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
    @php
        use Carbon\Carbon;
    @endphp
    <div class="box">
        <div class="box-header">
            <table style="width:100%;border: none !important;" align="center">
                <tr>
                    <td style="text-align:center;"><img width="100px" src="{{ asset('image') }}/logo.PNG"></td>
                    <td>
                        <h3 class="box-title">LAPORAN ASET TIDAK TETAP KANTOR WALI NAGARI SIPINANG <br>
                            PALEMBAYAN KAB. AGAM, SUMATERA BARAT <br> TAHUN <?= date('Y') ?></h3>
                    </td>
                    <td style="text-align:center"><img width="100px" src="{{ asset('image') }}/logo-sumbar.png"></td>
                </tr>
            </table>
        </div>


        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>

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

                    </tr>
                </thead>
                @php
                    $harga = 0;
                    $awal = 0;
                    $masuk = 0;
                    $keluar = 0;
                    $sisa = 0;
                @endphp
                @foreach ($data as $row)
                    @php
                        $id = $row->id;
                        $iterationNumber = $loop->index + 1;
                        // Menghitung usia

                        $tanggalPerolehan = $row->tgl_perolehan_aset ? Carbon::parse($row->tgl_perolehan_aset) : null;
                        $usiaAsetTahun = $tanggalPerolehan ? now()->diffInYears($tanggalPerolehan) : 0;
                        $usiaAsetBulan = $tanggalPerolehan ? now()->diffInMonths($tanggalPerolehan) % 12 : 0;
                        $usia = "$usiaAsetTahun Tahun, $usiaAsetBulan Bulan";

                        $harga += $row->harga;
                        $awal += $row->jumlah_awal;
                        $masuk += $row->jumlah_masuk;
                        $keluar += $row->jumlah_keluar;
                        $sisa += $row->sisa;

                    @endphp

                    <tr>
                        <td>{{ $iterationNumber }}</td>

                        <td><?= $row->jenisaset->name ?></td>
                        <td><?= $row->nama ?></td>
                        <td><?= number_format($row->harga) ?></td>
                        <td><?= $row->asal_perolehan ?></td>
                        <td><?= number_format($row->jumlah_awal) ?></td>
                        <td>
                            <?= number_format($row->jumlah_masuk) ?>

                        </td>
                        <td>

                            </a><?= number_format($row->jumlah_keluar) ?>

                        </td>
                        <td><?= $row->sisa ?></td>
                        <td><?= $row->keterangan ?></td>
                        <td><?= date('d-M-Y', strtotime($row->tgl_beli)) ?></td>

                        <td><?= date('d-M-Y', strtotime($row->tgl_pakai)) ?></td>
                        <td><?= date('d-M-Y', strtotime($row->tgl_perolehan_aset)) ?></td>
                        <td><?= $usia ?></td>

                    </tr>
                @endforeach
                <tr>
                    <th colspan="3">Total : </th>
                    <th><?= number_format($harga) ?></th>
                    <th></th>
                    <th><?= number_format($awal) ?></th>
                    <th><?= number_format($masuk) ?></th>
                    <th><?= number_format($keluar) ?></th>
                    <th><?= number_format($sisa) ?></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>

                </tr>
            </table>
        </div>



        <div class="box-body">
            <table>
                <tr>
                    <th style="text-align:center;">Mengetahui,
                        <br>
                        Wali Nagari
                        <br><br>
                        <br><br>
                        <br><br>
                        (...................................)
                    </th>
                    <th style="text-align:center;">Sipinang, <?= date('l d M Y') ?>
                        <br>
                        Pengurus Aset
                        <br><br>
                        <br><br>
                        <br><br>
                        (...................................)
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
