<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenKelurahan extends Model
{
    use HasFactory;
    protected $table = 'dokumen_kelurahan';

    protected $fillable = ['nama','kelurahanid','jenis_suratid','keterangan','dataPendukung','dibuatOleh','is_active'];

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'kelurahanid');
    }

    public function surat()
    {
        return $this->belongsTo(JenisSurat::class, 'jenis_suratid');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'dibuatOleh');
    }
}
