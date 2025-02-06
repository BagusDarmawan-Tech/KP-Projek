<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HakSipilDanKebebasan extends Model
{
    use HasFactory;
    protected $table = 'haksipildankebebasan';


    protected $fillable = [
        'penguploud',
        'kategori',
        'nama',
        'keterangan',
        'file',
    ];

    
    public $timestamps = true;
}
