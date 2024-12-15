<?php

namespace App\Http\Controllers;

use App\Helpers\EncryptionHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AsetTetap;
use App\Models\JenisBarang;
use App\Models\KategoriAset;
use App\Models\Unit;
use App\Models\User;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Hash as FacadesHash;
use Yajra\DataTables\Facades\DataTables;


class PenghapusanAsetController extends Controller
{

    public function index(Request $request)
    {
        $year = 0;

        $cat = KategoriAset::where('status', 1)

            ->get();
        $years = AsetTetap::selectRaw('YEAR(tanggal_perolehan) as year')->distinct()->pluck('year');
        if (Auth::user()->role == 'pegawai') {
            return view('penghapusan-aset.index', compact('cat', 'years', 'year'));
        } else {
            return view('penghapusan-aset.index-wali', compact('cat', 'years', 'year'));
        }
    }

    public function print($id, $year)
    {
        // Jika ada tahun yang dipilih, filter berdasarkan tahun dan status asettetap == 1
        if ($year != "null" && $year != 0) {
            $cat = KategoriAset::with(['asettetap' => function ($query) use ($year) {
                $query->whereYear('tahun_pengadaan', $year)  // Menyaring berdasarkan tahun
                    ->where('status', 0);  // Menambahkan filter status asettetap == 1
            }])->find($id);
        } else {
            // Jika tidak ada tahun, ambil data tanpa filter tahun dan hanya status asettetap == 1
            $cat = KategoriAset::with(['asettetap' => function ($query) {
                $query->where('status', 0);  // Menambahkan filter status asettetap == 1
            }])->find($id);
        }


        // Jika kategori tidak ditemukan, bisa mengembalikan error atau redirect
        if (!$cat) {
            return redirect()->route('asettetap.index')->with('error', 'Kategori Aset tidak ditemukan.');
        }

        if ($cat->id == 1) {
            return view('penghapusan-aset.print._kib_a', compact('cat'));
        } elseif ($cat->id == 2) {
            return view('penghapusan-aset.print._kib_b', compact('cat'));
        } elseif ($cat->id == 3) {
            return view('penghapusan-aset.print._kib_c', compact('cat'));
        } elseif ($cat->id == 4) {
            return view('penghapusan-aset.print._kib_d', compact('cat'));
        } elseif ($cat->id == 5) {
            return view('penghapusan-aset.print._kib_e', compact('cat'));
        }
    }

    public function getData(Request $request, $categoryId)
    {
        $query = AsetTetap::where('id_kategori_aset', $categoryId)
            ->where('status', 0);
        if ($request->has('year') && $request->year) {

            $query->whereYear('tanggal_perolehan', $request->year);
        }

        session(['year' => $request->year]);
        switch ($categoryId) {
            case 1:
                return $this->data1($query);
            case 2:
                return $this->data2($query);
            case 3:
                return $this->data3($query);
            case 4:
                return $this->data4($query);
            case 5:
                return $this->data5($query);
            default:
                return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
        }
    }

    private function data1($query)
    {
        return DataTables::of($query)
            ->addIndexColumn()

            ->addColumn('nama_barang', function ($row) {
                return $row->jenisAset->name . ' / ' . $row->nama_barang;
            })
            ->addColumn('sertifikat_tgl', function ($row) {
                return $row->kibATanah && $row->kibATanah->sertifikat_tgl
                    ? date('d-M-Y', strtotime($row->kibATanah->sertifikat_tgl))
                    : '-';
            })
            ->addColumn('luas', function ($row) {
                return $row->kibATanah->luas ?? '-'; // Jika relasi kosong, tampilkan "-"
            })
            ->addColumn('tahun_pengadaan', function ($row) {
                return $row->kibATanah->tahun_pengadaan ?? '-';
            })
            ->addColumn('alamat', function ($row) {
                return $row->kibATanah->alamat ?? '-';
            })
            ->addColumn('status_tanah', function ($row) {
                return $row->kibATanah->status_tanah ?? '-';
            })
            ->addColumn('sertifikat_tgl', function ($row) {
                return $row->kibATanah->sertifikat_tgl
                    ? Carbon::parse($row->kibATanah->sertifikat_tgl)->format('d-m-Y') // Format tanggal
                    : '-';
            })
            ->addColumn('sertifikat_no', function ($row) {
                return $row->kibATanah->sertifikat_no ?? '-';
            })
            ->addColumn('penggunaan', function ($row) {
                return $row->kibATanah->penggunaan ?? '-';
            })

            ->addColumn('tanggal_perolehan', function ($row) {
                return $row->tanggal_perolehan
                    ? date('d-M-Y', strtotime($row->tanggal_perolehan))
                    : '-';
            })
            ->addColumn('usia_aset', function ($row) {
                $tanggalPerolehan = $row->tanggal_perolehan ? Carbon::parse($row->tanggal_perolehan) : null;
                $usiaAsetTahun = $tanggalPerolehan ? now()->diffInYears($tanggalPerolehan) : 0;
                $usiaAsetBulan = $tanggalPerolehan ? now()->diffInMonths($tanggalPerolehan) % 12 : 0;
                return "$usiaAsetTahun Tahun, $usiaAsetBulan Bulan";
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
    private function data2($query)
    {
        return DataTables::of($query)
            ->addIndexColumn()

            ->addColumn('nama_barang', function ($row) {
                return $row->jenisAset->name . ' / ' . $row->nama_barang;
            })

            ->addColumn('merk', function ($row) {
                return $row->KibBPeralatanmesin->merk_type ?? '-'; // Jika relasi kosong, tampilkan "-"
            })
            ->addColumn('ukuran', function ($row) {
                return $row->KibBPeralatanmesin->ukuran_cc ?? '-';
            })
            ->addColumn('bahan', function ($row) {
                return $row->KibBPeralatanmesin->bahan ?? '-';
            })
            ->addColumn('nomor_pabrik', function ($row) {
                return $row->KibBPeralatanmesin->no_pabrik ?? '-';
            })
            ->addColumn('nomor_rangka', function ($row) {
                return $row->KibBPeralatanmesin->no_rangka ?? '-';
            })

            ->addColumn('nomor_mesin', function ($row) {
                return $row->KibBPeralatanmesin->no_mesin ?? '-';
            })
            ->addColumn('nomor_polisi', function ($row) {
                return $row->KibBPeralatanmesin->no_polisi ?? '-';
            })
            ->addColumn('nomor_bpkb', function ($row) {
                return $row->KibBPeralatanmesin->no_bpkb ?? '-';
            })
            ->addColumn('tahun_pengadaan', function ($row) {
                return $row->KibBPeralatanmesin->tahun_pengadaan ?? '-';
            })
            ->addColumn('tanggal_perolehan', function ($row) {
                return $row->tanggal_perolehan
                    ? date('d-M-Y', strtotime($row->tanggal_perolehan))
                    : '-';
            })
            ->addColumn('usia_aset', function ($row) {
                $tanggalPerolehan = $row->tanggal_perolehan ? Carbon::parse($row->tanggal_perolehan) : null;
                $usiaAsetTahun = $tanggalPerolehan ? now()->diffInYears($tanggalPerolehan) : 0;
                $usiaAsetBulan = $tanggalPerolehan ? now()->diffInMonths($tanggalPerolehan) % 12 : 0;
                return "$usiaAsetTahun Tahun, $usiaAsetBulan Bulan";
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
    private function data3($query)
    {
        return DataTables::of($query)
            ->addIndexColumn()

            ->addColumn('nama_barang', function ($row) {
                return $row->jenisAset->name . ' / ' . $row->nama_barang;
            })

            ->addColumn('kondisi_bangunan', function ($row) {
                return $row->KibCGedungbangunan->kondisi_bangunan ?? '-'; // Jika relasi kosong, tampilkan "-"
            })
            ->addColumn('bertingkat', function ($row) {
                return $row->KibCGedungbangunan->bertingkat ?? '-';
            })
            ->addColumn('beton', function ($row) {
                return $row->KibCGedungbangunan->beton ?? '-';
            })
            ->addColumn('luas_lantai', function ($row) {
                return $row->KibCGedungbangunan->luas_lantai ?? '-';
            })
            ->addColumn('dokumen_tanggal', function ($row) {
                return $row->KibCGedungbangunan->dok_tgl ?? '-';
            })

            ->addColumn('dokumen_nomor', function ($row) {
                return $row->KibCGedungbangunan->dok_no ?? '-';
            })
            ->addColumn('luas', function ($row) {
                return $row->KibCGedungbangunan->luas ?? '-';
            })
            ->addColumn('status_tanah', function ($row) {
                return $row->KibCGedungbangunan->status_tanah ?? '-';
            })
            ->addColumn('nomor_kode_tanah', function ($row) {
                return $row->KibCGedungbangunan->no_kode_tanah ?? '-';
            })
            ->addColumn('tanggal_perolehan', function ($row) {
                return $row->tanggal_perolehan
                    ? date('d-M-Y', strtotime($row->tanggal_perolehan))
                    : '-';
            })
            ->addColumn('usia_aset', function ($row) {
                $tanggalPerolehan = $row->tanggal_perolehan ? Carbon::parse($row->tanggal_perolehan) : null;
                $usiaAsetTahun = $tanggalPerolehan ? now()->diffInYears($tanggalPerolehan) : 0;
                $usiaAsetBulan = $tanggalPerolehan ? now()->diffInMonths($tanggalPerolehan) % 12 : 0;
                return "$usiaAsetTahun Tahun, $usiaAsetBulan Bulan";
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
    private function data4($query)
    {
        return DataTables::of($query)
            ->addIndexColumn()

            ->addColumn('nama_barang', function ($row) {
                return $row->jenisAset->name . ' / ' . $row->nama_barang;
            })

            ->addColumn('konstruksi', function ($row) {
                return $row->KibDJalanirigasi->konstruksi ?? '-'; // Jika relasi kosong, tampilkan "-"
            })
            ->addColumn('panjang', function ($row) {
                return $row->KibDJalanirigasi->panjang ?? '-';
            })
            ->addColumn('lebar', function ($row) {
                return $row->KibDJalanirigasi->lebar ?? '-';
            })
            ->addColumn('luas', function ($row) {
                return $row->KibDJalanirigasi->luas ?? '-';
            })
            ->addColumn('alamat', function ($row) {
                return $row->KibDJalanirigasi->alamat ?? '-';
            })
            ->addColumn('kondisi', function ($row) {
                return $row->KibDJalanirigasi->kondisi ?? '-';
            })
            ->addColumn('dokumen_tanggal', function ($row) {
                return $row->KibDJalanirigasi->dok_tgl ?? '-';
            })

            ->addColumn('dokumen_nomor', function ($row) {
                return $row->KibDJalanirigasi->dok_no ?? '-';
            })
            ->addColumn('status_tanah', function ($row) {
                return $row->KibDJalanirigasi->status_tanah ?? '-';
            })
            ->addColumn('nomor_kode_tanah', function ($row) {
                return $row->KibDJalanirigasi->no_kode_tanah ?? '-';
            })

            ->addColumn('tanggal_perolehan', function ($row) {
                return $row->tanggal_perolehan
                    ? date('d-M-Y', strtotime($row->tanggal_perolehan))
                    : '-';
            })
            ->addColumn('usia_aset', function ($row) {
                $tanggalPerolehan = $row->tanggal_perolehan ? Carbon::parse($row->tanggal_perolehan) : null;
                $usiaAsetTahun = $tanggalPerolehan ? now()->diffInYears($tanggalPerolehan) : 0;
                $usiaAsetBulan = $tanggalPerolehan ? now()->diffInMonths($tanggalPerolehan) % 12 : 0;
                return "$usiaAsetTahun Tahun, $usiaAsetBulan Bulan";
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    private function data5($query)
    {
        return DataTables::of($query)
            ->addIndexColumn()

            ->addColumn('nama_barang', function ($row) {
                return $row->jenisAset->name . ' / ' . $row->nama_barang;
            })

            ->addColumn('judul', function ($row) {
                return $row->KibEAsetlainnya->judul ?? '-'; // Jika relasi kosong, tampilkan "-"
            })
            ->addColumn('pencipta', function ($row) {
                return $row->KibEAsetlainnya->pencipta ?? '-';
            })
            ->addColumn('spesifikasi', function ($row) {
                return $row->KibEAsetlainnya->spesifikasi ?? '-';
            })
            ->addColumn('asal_daerah', function ($row) {
                return $row->KibEAsetlainnya->asal_daerah ?? '-';
            })
            ->addColumn('bahan', function ($row) {
                return $row->KibEAsetlainnya->bahan ?? '-';
            })
            ->addColumn('jenis', function ($row) {
                return $row->KibEAsetlainnya->jenis ?? '-';
            })
            ->addColumn('ukuran', function ($row) {
                return $row->KibEAsetlainnya->ukuran ?? '-';
            })

            ->addColumn('jumlah', function ($row) {
                return $row->KibEAsetlainnya->jumlah ?? '-';
            })

            ->addColumn('tanggal_perolehan', function ($row) {
                return $row->tanggal_perolehan
                    ? date('d-M-Y', strtotime($row->tanggal_perolehan))
                    : '-';
            })
            ->addColumn('usia_aset', function ($row) {
                $tanggalPerolehan = $row->tanggal_perolehan ? Carbon::parse($row->tanggal_perolehan) : null;
                $usiaAsetTahun = $tanggalPerolehan ? now()->diffInYears($tanggalPerolehan) : 0;
                $usiaAsetBulan = $tanggalPerolehan ? now()->diffInMonths($tanggalPerolehan) % 12 : 0;
                return "$usiaAsetTahun Tahun, $usiaAsetBulan Bulan";
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
}
