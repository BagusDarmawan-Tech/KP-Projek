<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KegiatanMitraAnak extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kegiatan_mitra_anak')->insert([
            ['nama' => 'cfci A','gambar'=>'/test/test','caption'=>'kegiatan harian','deskripsi'=>'lorem100','is_active'=>true,'dibuatOleh'=>'bagus'],
            ['nama' => 'cfci B','gambar'=>'/test/test','caption'=>'kegiatan harian','deskripsi'=>'lorem100','is_active'=>true,'dibuatOleh'=>'bagus'],
            ['nama' => 'cfci C','gambar'=>'/test/test','caption'=>'kegiatan harian','deskripsi'=>'lorem100','is_active'=>true,'dibuatOleh'=>'bagus'],
        ]);
    }
}
