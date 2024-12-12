<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriAset extends Model
{

    protected $table = 'kategori_aset';
    protected $fillable = [
        'name',
        'status',


    ];
    public function asetTetap()
    {
        return $this->hasMany(AsetTetap::class, 'id_kategori_aset', 'id');
    }
}
