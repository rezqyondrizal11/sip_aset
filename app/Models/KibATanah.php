<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KibATanah extends Model
{

    protected $table = 'kib_a_tanah';
    protected $fillable = [
        'id_at',
        'luas',
        'tahun_pengadaan',
        'alamat',
        'status_tanah',
        'sertifikat_tgl',
        'sertifikat_no',
        'penggunaan',

    ];
    public function asetTetap()
    {
        return $this->hasOne(AsetTetap::class, 'id', 'id_at');
    }
}
