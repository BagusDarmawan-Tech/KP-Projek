<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KesehatanDasar extends Model
{
    use HasFactory;
    protected $table = 'kesehatandasar';


    protected $fillable = [
        'nama',
        'keterangan',
        'file',
    ];
}
