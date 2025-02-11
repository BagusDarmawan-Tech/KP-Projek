<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemantauanUsulan extends Model
{
    use HasFactory;
    protected $table = 'usulan';

    protected $fillable = ['namaUsulan', 'userid','tindakLanjut','keterangan','is_active'];
}
