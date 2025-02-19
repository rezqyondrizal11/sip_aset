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
        'asal_usul',
        'harga_beli',
        'harga',
        'tanggal_perolehan',
        'ket',
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

    public function kibATanah()
    {
        return $this->hasOne(KibATanah::class, 'id_at', 'id');
    }

    public function KibBPeralatanmesin()
    {
        return $this->hasOne(KibBPeralatanmesin::class, 'id_at', 'id');
    }
    public function KibCGedungbangunan()
    {
        return $this->hasOne(KibCGedungbangunan::class, 'id_at', 'id');
    }
    public function KibDJalanirigasi()
    {
        return $this->hasOne(KibDJalanirigasi::class, 'id_at', 'id');
    }

    public function KibEAsetlainnya()
    {
        return $this->hasOne(KibEAsetlainnya::class, 'id_at', 'id');
    }
}
