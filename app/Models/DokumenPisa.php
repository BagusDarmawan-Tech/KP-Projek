<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenPisa extends Model
{
    use HasFactory;
    protected $table = 'dokumen_pisa';

    protected $fillable = ['nama', 'dataPendukung','keterangan','dibuatOleh','is_active','jenisSurat'];
    public function user()
    {
        return $this->belongsTo(User::class, 'dibuatOleh');
    }
}
