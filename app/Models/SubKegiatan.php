<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubKegiatan extends Model
{
    use HasFactory;
    protected $table = 'sub_kegiatan';

    protected $fillable = ['klusterid','nama','dataPendukung', 'keterangan','is_active', 'dibuatOleh'];

    public function klaster()
    {
        return $this->belongsTo(Klaster::class, 'klusterid');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'dibuatOleh');
    }
}
