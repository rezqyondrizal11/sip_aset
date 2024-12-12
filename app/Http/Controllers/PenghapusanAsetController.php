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
        $years = AsetTetap::selectRaw('YEAR(tahun_pengadaan) as year')->distinct()->pluck('year');
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

        // Mengirim data ke view
        return view('penghapusan-aset.print', compact('cat'));
    }

    public function getData(Request $request, $categoryId)
    {
        $query = AsetTetap::where('id_kategori_aset', $categoryId)->where('status', 0);

        if ($request->has('year') && $request->year) {
            $query->whereYear('tahun_pengadaan', $request->year);
        }


        return DataTables::of($query)
            ->addIndexColumn()


            ->addColumn('nama_barang', function ($row) {
                $name = $row->jenisaset->name  . ' / ' .  $row->nama_barang;
                return $name;
            })
            ->addColumn('sertifikat_tgl', function ($row) {
                if ($row->sertifikat_tgl) {
                    return date('d-M-Y', strtotime($row->sertifikat_tgl));
                }
                return '-';
            })->addColumn('tanggal_perolehan', function ($row) {
                if ($row->tanggal_perolehan) {
                    return date('d-M-Y', strtotime($row->tanggal_perolehan));
                }
                return '-';
            })
            ->addColumn('usia_aset', function ($row) {
                $tanggalPerolehan = $row->tanggal_perolehan ? Carbon::parse($row->tanggal_perolehan) : null;
                $usiaAsetTahun = $tanggalPerolehan ? now()->diffInYears($tanggalPerolehan) : 0;
                $usiaAsetBulan = $tanggalPerolehan ? now()->diffInMonths($tanggalPerolehan) % 12 : 0;
                return "$usiaAsetTahun Tahun, $usiaAsetBulan Bulan";
            })

            ->make(true);
    }
}
