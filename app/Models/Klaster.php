<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klaster extends Model
{
    use HasFactory;
    
    protected $table = 'kluster';

    protected $fillable = ['icon','nama','gambar','slug', 'is_active', 'dibuatOleh'];

    public function user()
    {
        return $this->belongsTo(User::class, 'dibuatOleh');
    }
}
