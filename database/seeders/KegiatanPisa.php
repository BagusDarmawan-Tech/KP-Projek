<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KegiatanPisa extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kegiatan_pisa')->insert([
            ['dibuatOleh' => 'bagus','nama' => 'kelurahan A','gambar'=>'/test/test','caption'=>'kegiatan harian','deskripsi'=>'lorem100','is_active'=>true],
            ['dibuatOleh' => 'bagus','nama' => 'kelurahan B','gambar'=>'/test/test','caption'=>'kegiatan harian','deskripsi'=>'lorem100','is_active'=>true],
            ['dibuatOleh' => 'bagus','nama' => 'kelurahan C','gambar'=>'/test/test','caption'=>'kegiatan harian','deskripsi'=>'lorem100','is_active'=>true],
        ]);
    }
}
