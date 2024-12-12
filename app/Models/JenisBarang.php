<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisBarang extends Model
{

    protected $table = 'jenis_barang';
    protected $fillable = [
        'name',
        'status',


    ];
}
