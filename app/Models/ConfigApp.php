<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfigApp extends Model
{
    use HasFactory;
    protected $table = 'config_app';

    protected $fillable = ['nama', 'detail'];
}
