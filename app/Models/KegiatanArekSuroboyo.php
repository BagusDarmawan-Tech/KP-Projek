<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanArekSuroboyo extends Model
{
    use HasFactory;
    protected $table = 'kegiatan_arek_suroboyo';

    protected $fillable = ['judul', 'slug','tag','konten','gambar','dibuatOleh','is_active'];
}
