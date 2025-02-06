<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerlindunganKhusus extends Model
{
    use HasFactory;
    protected $table = 'perlindungankhusus';


    protected $fillable = [
        'nama',
        'keterangan',
        'file',
    ];
}
