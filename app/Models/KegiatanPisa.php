<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanPisa extends Model
{
    use HasFactory;
    protected $table = 'kegiatan_pisa';

    protected $fillable = ['nama', 'caption','deskripsi','gambar','dibuatOleh','is_active'];
}
