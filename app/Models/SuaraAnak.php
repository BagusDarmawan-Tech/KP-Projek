<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuaraAnak extends Model
{
    use HasFactory;
    protected $table = 'suara_anak';

    protected $fillable = ['nomorSuara', 'is_active','tanggal','perihal','deskripsi','pemohon','tanggalTindakLanjut','tindakLanjut','file'];
    public function user()
    {
        return $this->belongsTo(User::class, 'pemohon');
    }
}
