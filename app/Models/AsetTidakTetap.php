<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsetTidakTetap extends Model
{

    protected $table = 'aset_tidak_tetap';
    protected $fillable = [
        'id_jenis_barang',
        'nama',
        'harga',
        'asal_perolehan',
        'jumlah_awal',
        'jumlah_masuk',
        'jumlah_keluar',
        'sisa',
        'keterangan',
        'tgl_pakai',
        'tgl_beli',
        'tgl_perolehan_aset',


    ];
    public function jenisAset()
    {
        return $this->hasOne(JenisBarang::class, 'id', 'id_jenis_barang');
    }
    public function detailAset()
    {
        return $this->hasMany(DetailAsetTidakTetap::class, 'id_att', 'id');
    }
}
