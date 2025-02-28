<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumAnak extends Model
{
    use HasFactory;
    protected $table = 'forum_anak';

    protected $fillable = ['nama', 'caption','deskripsi','gambar','is_active', 'dibuatOleh'];

    public function user()
    {
        return $this->belongsTo(User::class, 'dibuatOleh');
    }
}
