<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtikelMitraAnak extends Model
{
    use HasFactory;
    protected $table = 'artikel_mitra_anak';

    protected $fillable = ['kategoriartikelid', 'judul','slug','tag','gambar','konten','dibuatOleh','is_active'];

    public function kategori()
    {
        return $this->belongsTo(KategoriArtikel::class, 'kategoriartikelid');
    }
}
