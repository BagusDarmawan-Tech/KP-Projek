<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OPD extends Model
{
    use HasFactory;

    protected $table = 'OPD';

    protected $fillable = ['nama','is_active'];
}
