<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubKegiatan extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sub_kegiatan')->insert([
            ['klusterid' => 1,'nama' => 'Kegiatan A' ,'dataPendukung' => '/test/diproses' ,'keterangan'=>'lorem100','dibuatOleh'=>'bagus','is_active'=>true],
            ['klusterid' => 1,'nama' => 'Kegiatan B','dataPendukung' => '/test/diproses' ,'keterangan'=>'lorem100','dibuatOleh'=>'bagus','is_active'=>true],
            ['klusterid' => 1,'nama' => 'Kegiatan C','dataPendukung' => '/test/diproses' ,'keterangan'=>'lorem100','dibuatOleh'=>'bagus','is_active'=>true]
        ]);
    }
}
