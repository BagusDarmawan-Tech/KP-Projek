<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CFCIsKecam extends Model
{
     // Tentukan nama tabel jika tabel tidak mengikuti konvensi plural dari nama model
     protected $table = 'skkecam';

     // Tentukan kolom mana yang dapat diisi (Mass Assignment)
     protected $fillable = [
         'nama',
         'keterangan',
         'file',
     ];
 
     // Tentukan jika Anda ingin menggunakan timestamp
     public $timestamps = true;
}
