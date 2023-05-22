<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'id_fakultas',
        'id_kaprodi',
        'id_sekprodi'
    ];

    // public function fakultas()
    // {
    //     return $this->belongsTo(User::class, 'id_dosen');
    // }

    // public function kaprodi()
    // {
    //     return $this->belongsTo(Dosen::class, 'nip');
    // }

    // public function sekprodi()
    // {
    //     return $this->belongsTo(Dosen::class, 'nip');
    // }

}
