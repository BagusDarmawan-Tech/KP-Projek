<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Artikel extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('artikel')->insert([
            ['subkegiatanid' => 1,'kategoriartikelid' => 1,'judul' => 'Kegiatan A' ,'slug' => '/diproses','tag' => 'semangat' ,'gambar'=>'/test/gambar2','dibuatOleh'=>'bagus','konten'=>'lorem100','is_active'=>true],
            ['subkegiatanid' => 1,'kategoriartikelid' => 1,'judul' => 'Kegiatan B','slug' => '/diproses','tag' => 'semangat' ,'gambar'=>'/test/gambar2','dibuatOleh'=>'bagus','konten'=>'lorem100','is_active'=>true],
            ['subkegiatanid' => 1,'kategoriartikelid' => 1,'judul' => 'Kegiatan C','slug' => '/diproses','tag' => 'semangat' ,'gambar'=>'/test/gambar2','dibuatOleh'=>'bagus','konten'=>'lorem100','is_active'=>true]
        ]);
    }
}
