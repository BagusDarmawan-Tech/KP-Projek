<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenKecamatan extends Model
{
    use HasFactory;
    protected $table = 'dokumen_kecamatan';

    protected $fillable = ['nama','jenis_suratid','kecamatanid','keterangan','dataPendukung','dibuatOleh','is_active'];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatanid');
    }

    public function surat()
    {
        return $this->belongsTo(JenisSurat::class, 'jenis_suratid');
    }
}
