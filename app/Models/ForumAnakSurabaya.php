<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumAnakSurabaya extends Model
{
    use HasFactory;

    protected $table = 'kegiatan_forum_anak_surabaya';

    protected $fillable = ['nama', 'keterangan','gambar','is_active','dibuatOleh','tanggal'];
}
