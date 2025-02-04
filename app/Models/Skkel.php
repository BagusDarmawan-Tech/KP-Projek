<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skkel extends Model
{
    use HasFactory;
    protected $table = 'skkels';

    // Tentukan kolom mana yang dapat diisi (Mass Assignment)
    protected $fillable = [
        'penguploud',
        'kategori',
        'nama',
        'keterangan',
        'file',
    ];

    // Tentukan jika Anda ingin menggunakan timestamp
    public $timestamps = true;
}
