<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanKecamatan extends Model
{
    use HasFactory;
    protected $table = 'kegiatan_kecamatan';

    protected $fillable = ['nama', 'kecamatanid','gambar','keterangan','dibuatOleh','is_active'];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatanid');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'dibuatOleh');
    }
}
