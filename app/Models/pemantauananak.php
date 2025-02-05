<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pemantauananak extends Model
{
    use HasFactory;
    
    protected $table = 'pemantauananak';

    protected $fillable = [
        'usulananak',
        'OPDpelaksana',
        'statustindak',
        'keterangan',
    ];

    
    public $timestamps = true;
}
