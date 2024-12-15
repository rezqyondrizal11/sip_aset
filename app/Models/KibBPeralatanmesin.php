<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KibBPeralatanmesin extends Model
{

    protected $table = 'kib_b_peralatanmesin';
    protected $fillable = [
        'id_at',
        'merk_type',
        'ukuran_cc',
        'bahan',
        'no_pabrik',
        'no_rangka',
        'no_mesin',
        'no_polisi',
        'no_bpkb',
        'tahun_pengadaan',
    ];
    public function asetTetap()
    {
        return $this->hasOne(AsetTetap::class, 'id', 'id_at');
    }
}
