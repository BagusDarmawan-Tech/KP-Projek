<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemantauanUsulan extends Model
{
    use HasFactory;
    protected $table = 'usulan';

    protected $fillable = ['namaUsulan','opdId', 'userid','tindakLanjut','keterangan','is_active'];

    public function user()
    {
        return $this->belongsTo(User::class, 'userid');
    }
    public function opd()
    {
        return $this->belongsTo(OPD::class, 'opdId');
    }
}
