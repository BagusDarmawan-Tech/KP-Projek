<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriArtikel extends Model
{
    use HasFactory;
    protected $table = 'kategori_artikel';

    protected $fillable = ['nama', 'is_active', 'dibuatOleh'];

    public function artikels()
    {
        return $this->hasMany(Artikel::class, 'kategoriartikelid');
    }
}
