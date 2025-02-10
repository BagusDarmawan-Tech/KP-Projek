<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Usulan extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('usulan')->insert([
            ['userid' => 1,'namaUsulan' => 'Kegiatan A' ,'tindakLanjut' => 'diproses' ,'keterangan'=>'lorem100','is_active'=>true],
            ['userid' => 1,'namaUsulan' => 'Kegiatan B','tindakLanjut' => 'diproses' ,'keterangan'=>'lorem100','is_active'=>true],
            ['userid' => 1,'namaUsulan' => 'Kegiatan C','tindakLanjut' => 'diproses' ,'keterangan'=>'lorem100','is_active'=>true]
        ]);
    }
}
