<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Rpa extends Model
{
    use HasFactory;
    // Tentukan nama tabel jika tabel tidak mengikuti konvensi plural dari nama model
    protected $table = 'rpa';

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
