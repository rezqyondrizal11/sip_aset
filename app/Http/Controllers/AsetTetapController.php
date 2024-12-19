<?php

namespace App\Http\Controllers;

use App\Helpers\EncryptionHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AsetTetap;
use App\Models\JenisBarang;
use App\Models\KategoriAset;
use App\Models\KibATanah;
use App\Models\KibBPeralatanmesin;
use App\Models\KibCGedungbangunan;
use App\Models\KibDJalanirigasi;
use App\Models\KibEAsetlainnya;
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
        $years = AsetTetap::selectRaw('YEAR(tanggal_perolehan) as year')->distinct()->pluck('year');

        return view('aset-tetap.index', compact('cat', 'years', 'year'));
    }

    public function indexwali(Request $request)
    {
        $year = 0;


        $cat = KategoriAset::where('status', 1)

            ->get();
        $years = AsetTetap::selectRaw('YEAR(tanggal_perolehan) as year')->distinct()->pluck('year');

        return view('aset-tetap.index-wali', compact('cat', 'years', 'year'));
    }

    public function create($id)
    {
        $jenis = JenisBarang::orderBy('name', 'ASC')
            ->get();
        if ($id == 1) {
            return view('aset-tetap.create._kib_a', compact('jenis', 'id'));
        } elseif ($id == 2) {
            return view('aset-tetap.create._kib_b', compact('jenis', 'id'));
        } elseif ($id == 3) {
            return view('aset-tetap.create._kib_c', compact('jenis', 'id'));
        } elseif ($id == 4) {
            return view('aset-tetap.create._kib_d', compact('jenis', 'id'));
        } elseif ($id == 5) {
            return view('aset-tetap.create._kib_e', compact('jenis', 'id'));
        }

        // return view('aset-tetap.create', compact('jenis', 'id'));
    }
    public function store(Request $request)
    {
        if ($request->id_kategori_aset == 1) {
            // Validasi input
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
                'sertifikat_tgl' => 'required|date', // Sertifikat tanggal harus berupa tanggal valid
                'sertifikat_no' => 'required',
                'penggunaan' => 'required',
                'asal_usul' => 'required',
                'harga' => 'required|numeric', // Harga harus berupa angka
                'ket' => 'required',
                'tanggal_perolehan' => 'required|date', // Tanggal perolehan harus berupa tanggal valid
            ]);

            // Mengambil semua input dari request
            $input = $request->all();

            // Membuat data aset tetap
            $data = AsetTetap::create($input);

            // Menambahkan id_at ke input untuk tabel KibATanah
            $input['id_at'] = $data->id;

            // Membuat data untuk KibATanah
            $kat = KibATanah::create($input); // Menggunakan `create` alih-alih `created`

        } elseif ($request->id_kategori_aset == 2) {
            // Validasi input
            $this->validate($request, [
                'id_kategori_aset' => 'required',
                'id_jenis_barang' => 'required',
                'nama_barang' => 'required',
                'kode' => 'required',
                'register' => 'required',
                'merk_type' => 'required',
                'ukuran_cc' => 'required',
                'bahan' => 'required',
                'no_pabrik' => 'required',
                'no_rangka' => 'required', // Sertifikat tanggal harus berupa tanggal valid
                'no_mesin' => 'required',
                'no_polisi' => 'required',
                'no_bpkb' => 'required',
                'asal_usul' => 'required',
                'tahun_pengadaan' => 'required',
                'harga' => 'required|numeric', // Harga harus berupa angka
                'ket' => 'required',
                'tanggal_perolehan' => 'required|date', // Tanggal perolehan harus berupa tanggal valid
            ]);

            // Mengambil semua input dari request
            $input = $request->all();

            // Membuat data aset tetap
            $data = AsetTetap::create($input);

            // Menambahkan id_at ke input untuk tabel KibATanah
            $input['id_at'] = $data->id;

            // Membuat data untuk KibATanah
            $kat = KibBPeralatanmesin::create($input); // Menggunakan `create` alih-alih `created`

        } elseif ($request->id_kategori_aset == 3) {
            // Validasi input
            $this->validate($request, [
                'id_kategori_aset' => 'required',
                'id_jenis_barang' => 'required',
                'nama_barang' => 'required',
                'kode' => 'required',
                'register' => 'required',
                'kondisi_bangunan' => 'required',
                'bertingkat' => 'required',
                'beton' => 'required',
                'luas_lantai' => 'required',
                'dok_tgl' => 'required', // Sertifikat tanggal harus berupa tanggal valid
                'dok_no' => 'required',
                'luas' => 'required',
                'status_tanah' => 'required',
                'no_kode_tanah' => 'required',
                'asal_usul' => 'required',
                'harga' => 'required|numeric', // Harga harus berupa angka
                'ket' => 'required',
                'tanggal_perolehan' => 'required|date', // Tanggal perolehan harus berupa tanggal valid
            ]);

            // Mengambil semua input dari request
            $input = $request->all();

            // Membuat data aset tetap
            $data = AsetTetap::create($input);

            // Menambahkan id_at ke input untuk tabel KibATanah
            $input['id_at'] = $data->id;

            // Membuat data untuk KibATanah
            $kat = KibCGedungbangunan::create($input); // Menggunakan `create` alih-alih `created`

        } elseif ($request->id_kategori_aset == 4) {
            // Validasi input
            $this->validate($request, [
                'id_kategori_aset' => 'required',
                'id_jenis_barang' => 'required',
                'nama_barang' => 'required',
                'kode' => 'required',
                'register' => 'required',
                'konstruksi' => 'required',
                'panjang' => 'required',
                'lebar' => 'required',
                'luas' => 'required',
                'kondisi' => 'required',

                'alamat' => 'required', // Sertifikat tanggal harus berupa tanggal valid
                'dok_tgl' => 'required',
                'dok_no' => 'required',
                'status_tanah' => 'required',
                'no_kode_tanah' => 'required',

                'asal_usul' => 'required',
                'harga' => 'required|numeric', // Harga harus berupa angka
                'ket' => 'required',
                'tanggal_perolehan' => 'required|date', // Tanggal perolehan harus berupa tanggal valid
            ]);

            // Mengambil semua input dari request
            $input = $request->all();

            // Membuat data aset tetap
            $data = AsetTetap::create($input);

            // Menambahkan id_at ke input untuk tabel KibATanah
            $input['id_at'] = $data->id;

            // Membuat data untuk KibATanah
            $kat = KibDJalanirigasi::create($input); // Menggunakan `create` alih-alih `created`

        } elseif ($request->id_kategori_aset == 5) {
            // Validasi input
            $this->validate($request, [
                'id_kategori_aset' => 'required',
                'id_jenis_barang' => 'required',
                'nama_barang' => 'required',
                'kode' => 'required',
                'register' => 'required',
                'judul' => 'required',
                'pencipta' => 'required',
                'spesifikasi' => 'required',
                'asal_daerah' => 'required',
                'bahan' => 'required',

                'jenis' => 'required', // Sertifikat tanggal harus berupa tanggal valid
                'ukuran' => 'required',
                'jumlah' => 'required',
                'tahun' => 'required',
                'asal_usul' => 'required',
                'harga' => 'required|numeric', // Harga harus berupa angka
                'ket' => 'required',
                'tanggal_perolehan' => 'required|date', // Tanggal perolehan harus berupa tanggal valid
            ]);

            // Mengambil semua input dari request
            $input = $request->all();

            // Membuat data aset tetap
            $data = AsetTetap::create($input);

            // Menambahkan id_at ke input untuk tabel KibATanah
            $input['id_at'] = $data->id;

            // Membuat data untuk KibATanah
            $kat = KibEAsetlainnya::create($input); // Menggunakan `create` alih-alih `created`

        }

        return redirect()->route('asettetap.index')
            ->with('success', 'Aset Tetap created successfully');
    }

    public function print($id, $year)
    {
        // Jika ada tahun yang dipilih, filter berdasarkan tahun dan status asettetap == 1
        if ($year != "null" && $year != 0) {
            $cat = KategoriAset::with(['asettetap' => function ($query) use ($year) {
                $query->whereYear('tanggal_perolehan', $year)  // Menyaring berdasarkan tahun
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
        if ($cat->id == 1) {
            return view('aset-tetap.print._kib_a', compact('cat'));
        } elseif ($cat->id == 2) {
            return view('aset-tetap.print._kib_b', compact('cat'));
        } elseif ($cat->id == 3) {
            return view('aset-tetap.print._kib_c', compact('cat'));
        } elseif ($cat->id == 4) {
            return view('aset-tetap.print._kib_d', compact('cat'));
        } elseif ($cat->id == 5) {
            return view('aset-tetap.print._kib_e', compact('cat'));
        }
    }

    public function getData(Request $request, $categoryId)
    {
        $query = AsetTetap::where('id_kategori_aset', $categoryId)
            ->where('status', 1);
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
    public function getDataWali(Request $request, $categoryId)
    {
        $query = AsetTetap::where('id_kategori_aset', $categoryId)->where('status', 1);

        if ($request->has('year') && $request->year) {
            $query->whereYear('tanggal_perolehan', $request->year);
        }


        switch ($categoryId) {
            case 1:
                return $this->datawali1($query);
            case 2:
                return $this->datawali2($query);
            case 3:
                return $this->datawali3($query);
            case 4:
                return $this->datawali4($query);
            case 5:
                return $this->datawali5($query);
            default:
                return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
        }
    }
    private function datawali1($query)
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
    private function datawali2($query)
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
    private function datawali3($query)
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
    private function datawali4($query)
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

    private function datawali5($query)
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
    public function edit($id)
    {

        $data = AsetTetap::find($id);

        $jenis = JenisBarang::orderBy('name', 'ASC')
            ->get();

        if ($data->kategoriAset->id == 1) {
            return view('aset-tetap.edit._kib_a', compact('jenis', 'data'));
        } elseif ($data->kategoriAset->id == 2) {
            return view('aset-tetap.edit._kib_b', compact('jenis', 'data'));
        } elseif ($data->kategoriAset->id == 3) {
            return view('aset-tetap.edit._kib_c', compact('jenis', 'data'));
        } elseif ($data->kategoriAset->id == 4) {
            return view('aset-tetap.edit._kib_d', compact('jenis', 'data'));
        } elseif ($data->kategoriAset->id == 5) {
            return view('aset-tetap.edit._kib_e', compact('jenis', 'data'));
        }
    }

    public function update(Request $request)
    {
        if ($request->id_kategori_aset == 1) {
            // Validasi input
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
                'sertifikat_tgl' => 'required|date', // Sertifikat tanggal harus berupa tanggal valid
                'sertifikat_no' => 'required',
                'penggunaan' => 'required',
                'asal_usul' => 'required',
                'harga' => 'required|numeric', // Harga harus berupa angka
                'ket' => 'required',
                'tanggal_perolehan' => 'required|date', // Tanggal perolehan harus berupa tanggal valid
            ]);

            // Mengambil semua input dari request
            $input = $request->all();

            // Membuat data aset tetap
            $data = AsetTetap::find($request->id);
            $data->update($input);

            // Membuat data untuk KibATanah
            $kat = KibATanah::where('id_at', $request->id)->first();
            $kat->update($input);
        } elseif ($request->id_kategori_aset == 2) {
            // Validasi input
            $this->validate($request, [
                'id_kategori_aset' => 'required',
                'id_jenis_barang' => 'required',
                'nama_barang' => 'required',
                'kode' => 'required',
                'register' => 'required',
                'merk_type' => 'required',
                'ukuran_cc' => 'required',
                'bahan' => 'required',
                'no_pabrik' => 'required',
                'no_rangka' => 'required', // Sertifikat tanggal harus berupa tanggal valid
                'no_mesin' => 'required',
                'no_polisi' => 'required',
                'no_bpkb' => 'required',
                'asal_usul' => 'required',
                'tahun_pengadaan' => 'required',
                'harga' => 'required|numeric', // Harga harus berupa angka
                'ket' => 'required',
                'tanggal_perolehan' => 'required|date', // Tanggal perolehan harus berupa tanggal valid
            ]);

            // Mengambil semua input dari request
            $input = $request->all();

            // Membuat data aset tetap
            $data = AsetTetap::find($request->id);
            $data->update($input);

            // Membuat data untuk KibATanah
            $kat = KibBPeralatanmesin::where('id_at', $request->id)->first();
            $kat->update($input);
        } elseif ($request->id_kategori_aset == 3) {
            // Validasi input
            $this->validate($request, [
                'id_kategori_aset' => 'required',
                'id_jenis_barang' => 'required',
                'nama_barang' => 'required',
                'kode' => 'required',
                'register' => 'required',
                'kondisi_bangunan' => 'required',
                'bertingkat' => 'required',
                'beton' => 'required',
                'luas_lantai' => 'required',
                'dok_tgl' => 'required', // Sertifikat tanggal harus berupa tanggal valid
                'dok_no' => 'required',
                'luas' => 'required',
                'status_tanah' => 'required',
                'no_kode_tanah' => 'required',
                'asal_usul' => 'required',
                'harga' => 'required|numeric', // Harga harus berupa angka
                'ket' => 'required',
                'tanggal_perolehan' => 'required|date', // Tanggal perolehan harus berupa tanggal valid
            ]);

            // Mengambil semua input dari request
            $input = $request->all();

            // Membuat data aset tetap
            $data = AsetTetap::find($request->id);
            $data->update($input);

            // Membuat data untuk KibATanah
            $kat = KibCGedungbangunan::where('id_at', $request->id)->first();
            $kat->update($input);
        } elseif ($request->id_kategori_aset == 4) {
            // Validasi input
            $this->validate($request, [
                'id_kategori_aset' => 'required',
                'id_jenis_barang' => 'required',
                'nama_barang' => 'required',
                'kode' => 'required',
                'register' => 'required',
                'konstruksi' => 'required',
                'panjang' => 'required',
                'lebar' => 'required',
                'luas' => 'required',
                'kondisi' => 'required',

                'alamat' => 'required', // Sertifikat tanggal harus berupa tanggal valid
                'dok_tgl' => 'required',
                'dok_no' => 'required',
                'status_tanah' => 'required',
                'no_kode_tanah' => 'required',

                'asal_usul' => 'required',
                'harga' => 'required|numeric', // Harga harus berupa angka
                'ket' => 'required',
                'tanggal_perolehan' => 'required|date', // Tanggal perolehan harus berupa tanggal valid
            ]);

            // Mengambil semua input dari request
            $input = $request->all();

            // Membuat data aset tetap
            $data = AsetTetap::find($request->id);
            $data->update($input);

            // Membuat data untuk KibATanah
            $kat = KibDJalanirigasi::where('id_at', $request->id)->first();
            $kat->update($input);
        } elseif ($request->id_kategori_aset == 5) {
            // Validasi input
            $this->validate($request, [
                'id_kategori_aset' => 'required',
                'id_jenis_barang' => 'required',
                'nama_barang' => 'required',
                'kode' => 'required',
                'register' => 'required',
                'judul' => 'required',
                'pencipta' => 'required',
                'spesifikasi' => 'required',
                'asal_daerah' => 'required',
                'bahan' => 'required',

                'jenis' => 'required', // Sertifikat tanggal harus berupa tanggal valid
                'ukuran' => 'required',
                'jumlah' => 'required',
                'tahun' => 'required',
                'asal_usul' => 'required',
                'harga' => 'required|numeric', // Harga harus berupa angka
                'ket' => 'required',
                'tanggal_perolehan' => 'required|date', // Tanggal perolehan harus berupa tanggal valid
            ]);

            // Mengambil semua input dari request
            $input = $request->all();
            // Membuat data aset tetap
            $data = AsetTetap::find($request->id);
            $data->update($input);

            // Membuat data untuk KibATanah
            $kat = KibEAsetlainnya::where('id_at', $request->id)->first();
            $kat->update($input);
        }



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
