<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Halaman extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('halaman')->insert([
            ['judul' => 'A','slug'=>'/semangat','konten'=>'lorem100','gambar'=>'/test/test','dibuatOleh'=>'bagus','is_active'=>true],
            ['judul' => 'B','slug'=>'/semangat','konten'=>'lorem100','gambar'=>'/test/test','dibuatOleh'=>'bagus','is_active'=>true],
            ['judul' => 'C','slug'=>'/semangat','konten'=>'lorem100','gambar'=>'/test/test','dibuatOleh'=>'bagus','is_active'=>true],
        ]);
    }
}
