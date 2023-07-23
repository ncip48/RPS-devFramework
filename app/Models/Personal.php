<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Personal extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'id_institute',
        'name',
        'email',
        'password',
        'id_teacher',
        'photo',
    ];
}
