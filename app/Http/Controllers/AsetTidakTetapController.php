<?php

namespace App\Http\Controllers;

use App\Helpers\EncryptionHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AsetTetap;
use App\Models\AsetTidakTetap;
use App\Models\DetailAsetTidakTetap;
use App\Models\JenisBarang;
use App\Models\KategoriAset;
use App\Models\Unit;
use App\Models\User;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Hash as FacadesHash;
use Yajra\DataTables\Facades\DataTables;


class AsetTidakTetapController extends Controller
{

    public function index(Request $request)
    {

        $query = AsetTidakTetap::with('jenisaset');
        $year = 0;
        // Filter berdasarkan tahun jika ada parameter filterYear
        if ($request->filled('filterYear')) {
            $query->whereYear('tgl_perolehan_aset', $request->filterYear);
            $year =  $request->filterYear;
        }

        $data = $query->get();

        // Dapatkan daftar tahun untuk filter
        $years = AsetTidakTetap::selectRaw('YEAR(tgl_perolehan_aset) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        return view('aset-tidak-tetap.index', compact('data', 'years', 'year'));
    }


    public function indexwali(Request $request)
    {
        $query = AsetTidakTetap::with('jenisaset');
        $year = 0;
        // Filter berdasarkan tahun jika ada parameter filterYear
        if ($request->filled('filterYear')) {
            $query->whereYear('tgl_perolehan_aset', $request->filterYear);
            $year =  $request->filterYear;
        }

        $data = $query->get();

        // Dapatkan daftar tahun untuk filter
        $years = AsetTidakTetap::selectRaw('YEAR(tgl_perolehan_aset) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');
        return view('aset-tidak-tetap.index-wali', compact('data', 'year', 'years'));
    }


    public function create()
    {
        $jenis = JenisBarang::orderBy('name', 'ASC')
            ->get();
        return view('aset-tidak-tetap.create', compact('jenis'));
    }
    public function store(Request $request)
    {
        $request->merge([
            'harga' => str_replace(['Rp ', '.'], '', $request->harga),
        ]);
        // Validasi input
        $validatedData = $request->validate([
            'id' => 'required|exists:aset_tidak_tetap,id',
            'id_jenis_barang' => 'required|integer',
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'asal_perolehan' => 'required|string|max:255',
            'jumlah_awal' => 'required|integer|min:0',
            'keterangan' => 'nullable|string',
            'tgl_pakai' => [
                'required',
                'date',
                'after_or_equal:tgl_beli',
                'after_or_equal:tgl_perolehan_aset',
            ],
            'tgl_beli' => 'required|date',
            'tgl_perolehan_aset' => 'required|date',
        ], [
            'tgl_pakai.after_or_equal:tgl_beli' => 'Tanggal pakai harus lebih besar atau sama dengan tanggal beli.',
            'tgl_pakai.after_or_equal:tgl_perolehan_aset' => 'Tanggal pakai harus lebih besar atau sama dengan tanggal perolehan aset.',
        ]);


        // Logika untuk menghitung jumlah masuk, keluar, dan sisa
        $validatedData['jumlah_masuk'] = $validatedData['jumlah_awal'];
        $validatedData['jumlah_keluar'] = 0;
        $validatedData['sisa'] = $validatedData['jumlah_awal'];

        // Menyimpan data ke database
        $data = AsetTidakTetap::create($validatedData);
        $detail = new DetailAsetTidakTetap();
        $detail->id_att = $data->id;
        $detail->awal = $validatedData['jumlah_awal'];
        $detail->masuk = 0;
        $detail->keluar = 0;
        $detail->sisa = $validatedData['jumlah_awal'];
        $detail->save();
        // Redirect dengan pesan sukses
        return redirect()->route('asettidaktetap.index')
            ->with('success', 'Aset Tidak Tetap berhasil dibuat.');
    }





    public function edit($id)
    {

        $data = AsetTidakTetap::find($id);
        $jenis = JenisBarang::orderBy('name', 'ASC')
            ->get();
        return view('aset-tidak-tetap.edit', compact('data', 'jenis'));
    }


    public function update(Request $request)
    {
        $request->merge([

            'harga' => str_replace(['Rp ', '.'], '', $request->harga),
        ]);
        // Validasi input
        $validatedData = $request->validate([
            'id' => 'required|exists:aset_tidak_tetap,id',
            'id_jenis_barang' => 'required|integer',
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'asal_perolehan' => 'required|string|max:255',
            'jumlah_awal' => 'required|integer|min:0',
            'keterangan' => 'nullable|string',
            'tgl_pakai' => [
                'required',
                'date',
                'after_or_equal:tgl_beli',
                'after_or_equal:tgl_perolehan_aset',
            ],
            'tgl_beli' => 'required|date',
            'tgl_perolehan_aset' => 'required|date',
        ], [
            'tgl_pakai.after_or_equal:tgl_beli' => 'Tanggal pakai harus lebih besar atau sama dengan tanggal beli.',
            'tgl_pakai.after_or_equal:tgl_perolehan_aset' => 'Tanggal pakai harus lebih besar atau sama dengan tanggal perolehan aset.',
        ]);


        // Cari data yang akan diperbarui
        $data = AsetTidakTetap::find($request->id);
        if (!$data) {
            return redirect()->route('asettidaktetap.index')
                ->with('error', 'Aset Tidak Tetap tidak ditemukan.');
        }



        // Periksa apakah detail aset perlu diperbarui
        $count = DetailAsetTidakTetap::where('id_att', $request->id)->count();
        if ($count == 1) {
            // Logika untuk menghitung jumlah masuk, keluar, dan sisa
            $validatedData['jumlah_masuk'] = $validatedData['jumlah_awal'];
            $validatedData['sisa'] = $validatedData['jumlah_awal'];

            $detail = DetailAsetTidakTetap::where('id_att', $request->id)->first();
            $detail->awal = $validatedData['jumlah_awal'];
            $detail->masuk = 0;
            $detail->keluar = 0;
            $detail->sisa = $validatedData['jumlah_awal'];
            $detail->save();
        }
        // Perbarui data utama
        $data->update($validatedData);
        return redirect()->route('asettidaktetap.index')
            ->with('success', 'Aset Tidak Tetap berhasil diperbarui.');
    }

    public function masuk($id)
    {

        $data = AsetTidakTetap::find($id);
        $detail = DetailAsetTidakTetap::where('id_att', $id)
            ->orderBy('id', 'desc') // Mengurutkan berdasarkan 'id' secara menurun
            ->get();

        return view('aset-tidak-tetap.masuk', compact('data', 'detail'));
    }
    public function updatemasuk(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'id_att' => 'required|integer',
            'masuk' => 'required|string|max:255',

        ]);

        $data = AsetTidakTetap::find($validatedData['id_att']);
        $sisa = $data->sisa + $validatedData['masuk'];


        $detail = new DetailAsetTidakTetap();
        $detail->id_att =  $validatedData['id_att'];
        $detail->awal =  $data->sisa;
        $detail->masuk = $validatedData['masuk'];
        $detail->keluar = 0;
        $detail->sisa = $sisa;
        $detail->save();

        $data->jumlah_masuk = $data->jumlah_masuk + $detail->masuk;
        $data->sisa =   $data->jumlah_masuk  -  $data->jumlah_keluar;
        $data->save();

        // Redirect dengan pesan sukses
        return redirect()->route('asettidaktetap.index')
            ->with('success', 'Aset Tidak Tetap berhasil diupdate.');
    }

    public function updatekeluar(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'id_att' => 'required|integer|exists:aset_tidak_tetap,id', // Pastikan ID valid
            'keluar' => 'required|numeric|min:1', // Pastikan angka positif
        ]);

        $data = AsetTidakTetap::find($validatedData['id_att']);

        // Jika data tidak ditemukan (sudah dicek di validasi, tapi untuk jaga-jaga)
        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan.'
            ]);
        }

        // Hitung sisa setelah keluar
        $sisa = $data->sisa - $validatedData['keluar'];

        // Cek stok cukup atau tidak
        if ($sisa < 0) {
            return response()->json([
                'success' => false,
                'message' => 'STOK TIDAK CUKUP, PERMINTAAN TIDAK BISA DIPROSES.'
            ]);
        }

        // Simpan transaksi ke DetailAsetTidakTetap
        $detail = new DetailAsetTidakTetap();
        $detail->id_att = $validatedData['id_att'];
        $detail->awal = $data->sisa;
        $detail->keluar = $validatedData['keluar'];
        $detail->masuk = 0;
        $detail->sisa = $sisa;
        $detail->save();

        // Update jumlah keluar & sisa di AsetTidakTetap
        $data->jumlah_keluar += $validatedData['keluar'];
        $data->sisa = $data->jumlah_masuk - $data->jumlah_keluar;
        $data->save();

        // Beri respons sukses
        return response()->json([
            'success' => true,
            'message' => 'Permintaan berhasil diproses.'
        ]);
    }

    public function keluar($id)
    {

        $data = AsetTidakTetap::find($id);
        $detail = DetailAsetTidakTetap::where('id_att', $id)
            ->orderBy('id', 'desc') // Mengurutkan berdasarkan 'id' secara menurun
            ->get();

        return view('aset-tidak-tetap.keluar', compact('data', 'detail'));
    }
    public function destroy($id)
    {
        // Mencari data berdasarkan ID
        $data = AsetTidakTetap::find($id);

        // Jika data tidak ditemukan, kembalikan dengan pesan error
        if (!$data) {
            return redirect()->route('asettidaktetap.index')
                ->with('error', 'Aset Tidak Tetap tidak ditemukan.');
        }

        // Menghapus data
        $data->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('asettidaktetap.index')
            ->with('success', 'Aset Tidak Tetap berhasil dihapus.');
    }

    public function print($year)
    {

        if ($year == 0) {
            $data = AsetTidakTetap::get();
        } else {
            $data = AsetTidakTetap::whereYear('tgl_perolehan_aset', $year)
                ->get();
        }

        // Mengirim data ke view
        return view('aset-tidak-tetap.print', compact('data'));
    }
}
