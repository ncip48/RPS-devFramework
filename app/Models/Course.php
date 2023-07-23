<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_institute',
        'id_department',
        'id_teacher',
        'code',
        'name',
        'credit',
    ];
}
