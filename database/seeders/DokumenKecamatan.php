<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DokumenKecamatan extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('dokumen_kecamatan')->insert([
            ['jenis_suratid' => 1,'kecamatanid' => 1,'nama' => 'Dokumen A' ,'dataPendukung' => '/test/1' ,'keterangan'=>'lorem100','is_active'=>true],
            ['jenis_suratid' => 2,'kecamatanid' => 2,'nama' => 'Dokumen B','dataPendukung' => '/test/2' ,'keterangan'=>'lorem100','is_active'=>true],
            ['jenis_suratid' => 3,'kecamatanid' => 3,'nama' => 'Dokumen C','dataPendukung' => '/test/3' ,'keterangan'=>'lorem100','is_active'=>true]
        ]);
    }
}
