<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    /** @use HasFactory<\Database\Factories\TugasFactory> */
    use HasFactory;
    protected $fillable = ['judul', 'deskripsi', 'deadline', 'is_active'];

    protected $casts = [
        'deadline' => 'datetime',
        'is_active' => 'boolean',
    ];
}
