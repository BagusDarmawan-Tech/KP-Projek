<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LingkunganKeluarga extends Model
{
    use HasFactory;
    protected $table = 'lingkungankeluarga';


    protected $fillable = [
        'nama',
        'keterangan',
        'file',
    ];
}
