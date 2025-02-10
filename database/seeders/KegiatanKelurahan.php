<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KegiatanKelurahan extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kegiatan_kelurahan')->insert([
            ['kelurahanid'=>1,'dibuatOleh' => 'bagus','nama' => 'kelurahan A','gambar'=>'/test/test','keterangan'=>'lorem100','is_active'=>true],
            ['kelurahanid'=>2,'dibuatOleh' => 'bagus','nama' => 'kelurahan B','gambar'=>'/test/test','keterangan'=>'lorem100','is_active'=>true],
            ['kelurahanid'=>3,'dibuatOleh' => 'bagus','nama' => 'kelurahan C','gambar'=>'/test/test','keterangan'=>'lorem100','is_active'=>true],
        ]);

    }
}
