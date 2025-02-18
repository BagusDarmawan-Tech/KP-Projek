<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanKelurahan extends Model
{
    use HasFactory;
    protected $table = 'kegiatan_kelurahan';

    protected $fillable = ['nama', 'kelurahanid','gambar','keterangan','dibuatOleh','is_active'];

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'kelurahanid');
    }

}
