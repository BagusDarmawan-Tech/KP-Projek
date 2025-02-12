<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasFactory;

    protected $table = 'galeri_anak';

    protected $fillable = ['nama', 'caption','deskripsi','gambar','is_active', 'dibuatOleh'];
}
