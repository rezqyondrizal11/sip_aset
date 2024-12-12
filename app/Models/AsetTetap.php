<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsetTetap extends Model
{

    protected $table = 'aset_tetap';
    protected $fillable = [
        'id_kategori_aset',
        'id_jenis_barang',
        'nama_barang',
        'kode',
        'register',
        'luas',
        'tahun_pengadaan',
        'alamat',
        'status_tanah',
        'sertifikat_tgl',
        'sertifikat_no',
        'penggunaan',
        'asal_usul',
        'harga',
        'ket',
        'tanggal_perolehan',
        'status',
    ];
    public function kategoriAset()
    {
        return $this->hasOne(KategoriAset::class, 'id', 'id_kategori_aset');
    }
    public function jenisAset()
    {
        return $this->hasOne(JenisBarang::class, 'id', 'id_jenis_barang');
    }
}
