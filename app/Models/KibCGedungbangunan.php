<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KibCGedungbangunan extends Model
{

    protected $table = 'kib_c_gedungbangunan';
    protected $fillable = [
        'id_at',
        'kondisi_bangunan',
        'bertingkat',
        'beton',
        'luas_lantai',
        'dok_tgl',
        'dok_no',
        'luas',
        'status_tanah',
        'no_kode_tanah',

    ];
    public function asetTetap()
    {
        return $this->hasOne(AsetTetap::class, 'id', 'id_at');
    }
}
