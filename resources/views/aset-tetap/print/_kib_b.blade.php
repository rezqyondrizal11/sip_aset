<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Aset {{ $cat->name }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .box {
            border: 1px solid #000;
            margin: 20px;
            padding: 10px;
            width: 95%;
        }

        .box-header,
        .box-body {
            padding: 10px;
        }

        .box-header {
            background-color: #f2f2f2;
            text-align: center;
        }

        .box-title {
            margin: 0;
            text-align: center;
            font-size: 18px;
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
            font-size: 11px;
        }

        .text-center {
            text-align: center;
        }

        @media print {
            body {
                color: #000;
            }

            .box {
                border: none;
            }

            .box-header {
                background-color: #dcdcdc;
            }

            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body onload="window.print()">

    <div class="box">
        <div class="box-header">
            <table style="width:100%;border:none;">
                <tr>
                    <td class="text-center"><img width="100px" src="{{ asset('image') }}/logo.PNG"></td>
                    <td>
                        <h3 class="box-title">LAPORAN ASET TETAP {{ strtoupper($cat->name) }} <br>
                            KANTOR WALI NAGARI SIPINANG, PALEMBAYAN KAB. AGAM <br> TAHUN <?= date('Y') ?>
                        </h3>
                    </td>
                    <td class="text-center"><img width="100px" src="{{ asset('image') }}/logo-sumbar.png"></td>
                </tr>
            </table>
        </div>

        <div class="box-body">
            <h3 class="box-title">ASET {{ strtoupper($cat->name) }}</h3>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Jenis Barang / Nama Barang</th>
                        <th>No. Kode</th>
                        <th>No. Register</th>
                        <th>Merk/Type</th>
                        <th>Ukuran CC</th>
                        <th>Bahan</th>
                        <th>No. Pabrik</th>
                        <th>No. Rangka</th>
                        <th>No. Mesin</th>
                        <th>No. Polisi</th>
                        <th>No. BPKB</th>
                        <th>Tahun Pengadaan</th>
                        <th>Asal Usul</th>
                        <th>Harga Beli</th>
                        <th>Harga</th>
                        <th>Tanggal Perolehan</th>
                        <th>Usia Aset</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = $total1 = 0; @endphp
                    @foreach ($cat->asettetap as $keyy => $aset)
                        @php
                            $total += $aset->harga;
                            $total1 += $aset->harga_beli;
                            $usiaAset = $aset->tanggal_perolehan
                                ? \Carbon\Carbon::parse($aset->tanggal_perolehan)->diff(now())
                                : null;
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $aset->jenisaset->name }} / {{ $aset->nama_barang }}</td>
                            <td>{{ $aset->kode }}</td>
                            <td>{{ $aset->register }}</td>
                            <td>{{ $aset->KibBPeralatanmesin->merk_type }}</td>
                            <td>{{ $aset->KibBPeralatanmesin->ukuran_cc }}</td>
                            <td>{{ $aset->KibBPeralatanmesin->bahan }}</td>
                            <td>{{ $aset->KibBPeralatanmesin->no_pabrik }}</td>
                            <td>{{ $aset->KibBPeralatanmesin->no_rangka }}</td>
                            <td>{{ $aset->KibBPeralatanmesin->no_mesin }}</td>
                            <td>{{ $aset->KibBPeralatanmesin->no_polisi }}</td>
                            <td>{{ $aset->KibBPeralatanmesin->no_bpkb }}</td>
                            <td>{{ $aset->KibBPeralatanmesin->tahun_pengadaan }}</td>
                            <td>{{ $aset->asal_usul }}</td>
                            <td>Rp {{ number_format($aset->harga_beli, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($aset->harga, 0, ',', '.') }}</td>
                            <td>{{ date('d-M-Y', strtotime($aset->tanggal_perolehan)) }}</td>
                            <td>{{ $usiaAset->y ?? 0 }} Tahun, {{ $usiaAset->m ?? 0 }} Bulan</td>
                            <td>{{ $aset->ket }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <th colspan="14">Total Harga</th>
                        <th>Rp {{ number_format($total1, 0, ',', '.') }}</th>
                        <th colspan="4">Rp {{ number_format($total, 0, ',', '.') }}</th>
                    </tr>
                </tbody>
            </table>
        </div>

        @php
            $walinagari = App\Models\User::where('role', 'walinagari')->where('status', 1)->first();
        @endphp
        <div class="box-body">
            <table>
                <tr>
                    <th class="text-center">
                        Mengetahui,<br>Wali Nagari<br><br><br><br><br>({{ $walinagari->name }})
                    </th>
                    <th class="text-center">
                        Sipinang, <?= date('l d M Y') ?><br>Pengurus
                        Aset<br><br><br><br><br>({{ Auth::user()->name ?? '' }})
                    </th>
                </tr>
            </table>
        </div>
    </div>

</body>

</html>
