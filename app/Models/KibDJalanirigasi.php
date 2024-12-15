<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KibDJalanirigasi extends Model
{

    protected $table = 'kib_d_jalanirigasi';
    protected $fillable = [
        'id_at',
        'konstruksi',
        'panjang',
        'lebar',
        'luas',
        'alamat',
        'dok_tgl',
        'dok_no',
        'status_tanah',
        'no_kode_tanah',
        'kondisi',

    ];
    public function asetTetap()
    {
        return $this->hasOne(AsetTetap::class, 'id', 'id_at');
    }
}
