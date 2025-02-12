<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;

    protected $table = 'artikel';

    protected $fillable = ['judul', 'slug','tag','gambar','subkegiatanid','konten','kategoriartikelid','is_active', 'dibuatOleh'];
    public function kategori()
    {
        return $this->belongsTo(KategoriArtikel::class, 'kategoriartikelid');
    }
}

