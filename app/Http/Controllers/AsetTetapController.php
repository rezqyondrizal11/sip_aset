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
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Hash as FacadesHash;
use Yajra\DataTables\Facades\DataTables;


class AsetTetapController extends Controller
{

    public function index(Request $request)
    {
        $year = 0;

        $cat = KategoriAset::where('status', 1)

            ->get();
        $years = AsetTetap::selectRaw('YEAR(tahun_pengadaan) as year')->distinct()->pluck('year');

        return view('aset-tetap.index', compact('cat', 'years', 'year'));
    }
    public function indexwali(Request $request)
    {
        $year = 0;


        $cat = KategoriAset::where('status', 1)

            ->get();
        $years = AsetTetap::selectRaw('YEAR(tahun_pengadaan) as year')->distinct()->pluck('year');

        return view('aset-tetap.index-wali', compact('cat', 'years', 'year'));
    }

    public function create($id)
    {
        $jenis = JenisBarang::orderBy('name', 'ASC')
            ->get();
        return view('aset-tetap.create', compact('jenis', 'id'));
    }

    public function print($id, $year)
    {
        // Jika ada tahun yang dipilih, filter berdasarkan tahun dan status asettetap == 1
        if ($year != "null" && $year != 0) {
            $cat = KategoriAset::with(['asettetap' => function ($query) use ($year) {
                $query->whereYear('tahun_pengadaan', $year)  // Menyaring berdasarkan tahun
                    ->where('status', 1);  // Menambahkan filter status asettetap == 1
            }])->find($id);
        } else {
            // Jika tidak ada tahun, ambil data tanpa filter tahun dan hanya status asettetap == 1
            $cat = KategoriAset::with(['asettetap' => function ($query) {
                $query->where('status', 1);  // Menambahkan filter status asettetap == 1
            }])->find($id);
        }


        // Jika kategori tidak ditemukan, bisa mengembalikan error atau redirect
        if (!$cat) {
            return redirect()->route('asettetap.index')->with('error', 'Kategori Aset tidak ditemukan.');
        }

        // Mengirim data ke view
        return view('aset-tetap.print', compact('cat'));
    }

    public function getData(Request $request, $categoryId)
    {
        $query = AsetTetap::where('id_kategori_aset', $categoryId)
            ->where('status', 1);
        if ($request->has('year') && $request->year) {

            $query->whereYear('tahun_pengadaan', $request->year);
        }

        session(['year' => $request->year]);

        return DataTables::of($query)
            ->addIndexColumn()

            ->addColumn('aksi', function ($row) {
                $deleteUrl = route('asettetap.destroy', ['id' => $row->id]);
                return '
                <a href="#" class="btn btn-primary openUpdateModal" 
                    data-toggle="modal" data-target="#updateModal" 
                    data-id="' . $row->id . '">
                    <i class="fa fa-edit"></i>
                </a>
                <a href="#" onclick="return klikDelete(\'' . $deleteUrl . '\');" class="btn btn-danger">
                    <i class="fa fa-trash"></i>
                </a>';
            })
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
            ->rawColumns(['aksi'])
            ->make(true);
    }
    public function getDataWali(Request $request, $categoryId)
    {
        $query = AsetTetap::where('id_kategori_aset', $categoryId)->where('status', 1);

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

    public function store(Request $request)
    {
        $this->validate($request, [
            'id_kategori_aset' => 'required',

            'id_jenis_barang' => 'required',
            'nama_barang' => 'required',
            'kode' => 'required',
            'register' => 'required',
            'luas' => 'required',
            'tahun_pengadaan' => 'required',
            'alamat' => 'required',
            'status_tanah' => 'required',
            'sertifikat_tgl' => 'required',
            'sertifikat_no' => 'required',
            'penggunaan' => 'required',
            'asal_usul' => 'required',
            'harga' => 'required',
            'ket' => 'required',
            'tanggal_perolehan' => 'required',
        ]);

        $input = $request->all();

        $data = AsetTetap::create($input);
        return redirect()->route('asettetap.index')
            ->with('success', 'Aset Tetap created successfully');
    }


    public function edit($id)
    {

        $data = AsetTetap::find($id);
        $jenis = JenisBarang::orderBy('name', 'ASC')
            ->get();
        return view('aset-tetap.edit', compact('data', 'jenis'));
    }

    public function update(Request $request)
    {

        $this->validate($request, [
            'id_kategori_aset' => 'required',

            'id_jenis_barang' => 'required',
            'nama_barang' => 'required',
            'kode' => 'required',
            'register' => 'required',
            'luas' => 'required',
            'tahun_pengadaan' => 'required',
            'alamat' => 'required',
            'status_tanah' => 'required',
            'sertifikat_tgl' => 'required',
            'sertifikat_no' => 'required',
            'penggunaan' => 'required',
            'asal_usul' => 'required',
            'harga' => 'required',
            'ket' => 'required',
            'tanggal_perolehan' => 'required',
        ]);


        $input = $request->all();

        $data = AsetTetap::find($request->id);
        $data->update($input);

        return redirect()->route('asettetap.index')
            ->with('success', 'Aset Tetap updated successfully');
    }




    public function destroy($id)
    {
        $data =    AsetTetap::find($id);
        $data->status = 0;
        $data->save();
        return redirect()->route('asettetap.index')
            ->with('success', 'Aset Tetap deleted successfully');
    }
}
