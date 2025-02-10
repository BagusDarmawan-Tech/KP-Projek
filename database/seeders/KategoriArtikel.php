<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KategoriArtikel extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kategori_artikel')->insert([
            ['nama' => 'artikel','dibuatOleh'=>'bagus','is_active'=>true],
            ['nama' => 'berita','dibuatOleh'=>'bagus','is_active'=>true],
            ['nama' => 'pendidikan','dibuatOleh'=>'bagus','is_active'=>true],
            ['nama' => 'artikel mitra','dibuatOleh'=>'bagus','is_active'=>true],
        ]);
    }
}
