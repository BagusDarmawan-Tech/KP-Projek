<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelembagaan extends Model
{
    use HasFactory;
    protected $table = 'kelembagaan';


    protected $fillable = [
        'nama',
        'keterangan',
        'file',
    ];

    
    public $timestamps = true;
}
