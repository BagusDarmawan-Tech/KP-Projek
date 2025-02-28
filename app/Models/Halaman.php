<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Halaman extends Model
{
    use HasFactory;

    protected $table = 'halaman';

    protected $fillable = ['judul','slug','gambar', 'konten','is_active', 'dibuatOleh'];

    public function user()
    {
        return $this->belongsTo(User::class, 'dibuatOleh');
    }

}
