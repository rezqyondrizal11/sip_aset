<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailAsetTidakTetap extends Model
{

    protected $table = 'detail_aset_tidak_tetap';
    protected $fillable = [
        'id_att',
        'awal',
        'masuk',
        'keluar',
        'sisa',

    ];
}
