<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DokumenPisa extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('dokumen_pisa')->insert([
            ['dibuatOleh' => 'bagus','nama' => 'kelurahan A','dataPendukung'=>'/test/test','keterangan'=>'kegiatan harian lorem 100','is_active'=>true],
            ['dibuatOleh' => 'bagus','nama' => 'kelurahan B','dataPendukung'=>'/test/test','keterangan'=>'kegiatan harian lorem 100','is_active'=>true],
            ['dibuatOleh' => 'bagus','nama' => 'kelurahan C','dataPendukung'=>'/test/test','keterangan'=>'kegiatan harian lorem 100','is_active'=>true],
        ]);
    }
}
