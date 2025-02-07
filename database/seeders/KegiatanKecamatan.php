<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KegiatanKecamatan extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kegiatan_kecamatan')->insert([
            ['kecamatanid'=>'1','nama' => 'Kecamatan A','gambar'=>'/test/test','keterangan'=>'lorem100','is_active'=>true],
            ['kecamatanid'=>'1','nama' => 'Kecamatan B','gambar'=>'/test/test','keterangan'=>'lorem100','is_active'=>true],
            ['kecamatanid'=>'1','nama' => 'Kecamatan C','gambar'=>'/test/test','keterangan'=>'lorem100','is_active'=>true],
        ]);
    }
}
