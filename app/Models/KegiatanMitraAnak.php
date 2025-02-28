<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanMitraAnak extends Model
{
    use HasFactory;
    protected $table = 'kegiatan_mitra_anak';

    protected $fillable = ['nama', 'caption','deskripsi','gambar','dibuatOleh','is_active'];
    public function user()
    {
        return $this->belongsTo(User::class, 'dibuatOleh');
    }

}
