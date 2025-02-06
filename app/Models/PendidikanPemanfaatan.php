<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendidikanPemanfaatan extends Model
{
    use HasFactory;
    protected $table = 'pendidikanpemanfaatan';


    protected $fillable = [
        'nama',
        'keterangan',
        'file',
    ];
}
