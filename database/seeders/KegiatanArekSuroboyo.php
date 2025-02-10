<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KegiatanArekSuroboyo extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kegiatan_arek_suroboyo')->insert([
            ['judul' => 'kegiatan 1 a','slug'=>'/kegiatan/sby','tag'=>'semnagat','dibuatOleh'=>'bagus','gambar'=>'/test/1','konten' => 'lorem100' ,'is_active'=>true],
            ['judul' => 'kegiatan 1 b','slug'=>'/kegiatan/sby','tag'=>'semnagat','dibuatOleh'=>'bagus','gambar'=>'/test/1','konten' => 'lorem100' ,'is_active'=>true],
            ['judul' => 'kegiatan 2 b','slug'=>'/kegiatan/sby','tag'=>'semnagat','dibuatOleh'=>'bagus','gambar'=>'/test/1','konten' => 'lorem100' ,'is_active'=>true]
        ]);
    }
}
