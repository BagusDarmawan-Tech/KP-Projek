<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KegiatanCfci extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kegiatan_cfci')->insert([
            ['nama' => 1,'caption' => 'Kegiatan A lorem10' ,'deskripsi' => 'lorem100' ,'gambar'=>'/test/gambar2','dibuatOleh'=>'bagus','is_active'=>true],
            ['nama' => 1,'caption' => 'Kegiatan B lorem10','deskripsi' => 'lorem100' ,'gambar'=>'/test/gambar2','dibuatOleh'=>'bagus','is_active'=>true],
            ['nama' => 1,'caption' => 'Kegiatan C lorem10','deskripsi' => 'lorem100' ,'gambar'=>'/test/gambar2','dibuatOleh'=>'bagus','is_active'=>true]
        ]);
    }
}
