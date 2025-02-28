<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanCfci extends Model
{
    use HasFactory;
    protected $table = 'kegiatan_cfci';

    protected $fillable = ['nama', 'caption','deskripsi','gambar','dibuatOleh','is_active'];

    public function user()
    {
        return $this->belongsTo(User::class, 'dibuatOleh');
    }
}
