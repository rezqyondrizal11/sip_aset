<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KibEAsetlainnya extends Model
{

    protected $table = 'kib_e_asetlainnya';
    protected $fillable = [
        'id_at',
        'judul',
        'pencipta',
        'spesifikasi',
        'asal_daerah',
        'bahan',
        'jenis',
        'ukuran',
        'jumlah',
        'tahun',


    ];
    public function asetTetap()
    {
        return $this->hasOne(AsetTetap::class, 'id', 'id_at');
    }
}
