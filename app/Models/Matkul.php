<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matkul extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_prodi',
        'id_dosen',
        'kode_matkul',
        'nama_matkul'
    ];
}
