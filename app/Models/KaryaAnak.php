<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KaryaAnak extends Model
{
    use HasFactory;

    protected $table = 'karya_anak';

    protected $fillable = ['kreator','tingkatKarya', 'tanggal','judul','gambar','pemohon','deskripsi','status'];
    public function user()
    {
        return $this->belongsTo(User::class, 'pemohon');
    }

}
