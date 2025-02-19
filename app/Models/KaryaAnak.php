<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KaryaAnak extends Model
{
    use HasFactory;

    protected $table = 'karya_anak';

    protected $fillable = ['kreator', 'tanggal','judul','gambar','pemohon','deskripsi','status'];
}
