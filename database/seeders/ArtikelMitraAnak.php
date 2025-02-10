<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ArtikelMitraAnak extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('artikel_mitra_anak')->insert([
            ['kategoriartikelid' => 1,'judul' => 'Kegiatan A' ,'slug' => '/diproses','tag' => 'semangat' ,'gambar'=>'/test/gambar2','dibuatOleh'=>'bagus','konten'=>'lorem100','is_active'=>true],
            ['kategoriartikelid' => 1,'judul' => 'Kegiatan B','slug' => '/diproses','tag' => 'semangat' ,'gambar'=>'/test/gambar2','dibuatOleh'=>'bagus','konten'=>'lorem100','is_active'=>true],
            ['kategoriartikelid' => 1,'judul' => 'Kegiatan C','slug' => '/diproses','tag' => 'semangat' ,'gambar'=>'/test/gambar2','dibuatOleh'=>'bagus','konten'=>'lorem100','is_active'=>true]
        ]);
    }
}
