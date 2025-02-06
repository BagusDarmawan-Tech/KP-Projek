<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cfcisk extends Model
{
    protected $table ='cfcisks';
    use HasFactory;

    protected $filllable =[
    'nama',
    'keteragan',
    'file',
    ];
    public $timestamps = true;
}


