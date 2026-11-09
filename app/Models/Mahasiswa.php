<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    /** @use HasFactory<\Database\Factories\MahasiswaFactory> */
    use HasFactory;
    protected $fillable = ['nama', 'nrp', 'departemen', 'is_active'];
    protected $casts = ['is_active' => 'boolean'];
}

