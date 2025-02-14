<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuaraAnak extends Model
{
    use HasFactory;
    protected $table = 'suara_anak';

    protected $fillable = ['nomorSuara', 'tanggal','perihal','deskripsi','pemohon','tanggalTindakLanjut','tindakLanjut','file'];
}
